<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Instagram_feed
{
    protected $CI;
    protected $settings = array();

    // Path where the refreshed token is stored between requests
    const TOKEN_CACHE_FILE = 'instagram_token.json';
    // Refresh the token if it was last refreshed more than this many seconds ago (25 hours)
    const REFRESH_INTERVAL = 90000;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->config('instagram', TRUE);
        $this->settings = (array) $this->CI->config->item('instagram', 'instagram');
    }

    /**
     * Return an array of posts: [ ['media_url'=>'...', 'permalink'=>'...', 'media_type'=>'...'], ... ]
     * Returns an empty array if Instagram is disabled or the API fails.
     */
    public function get_posts($limit = null)
    {
        if (empty($this->settings['enabled'])) {
            return array();
        }

        $limit = (int) ($limit ?: ($this->settings['limit'] ?? 10));
        $cacheKey = 'instagram_feed_' . $limit;
        $cached = $this->get_cached_value($cacheKey);

        if ($cached !== FALSE && is_array($cached)) {
            // Opportunistically refresh the token in the background while serving cached data
            $this->maybe_refresh_token();
            return $cached;
        }

        // Cache miss — refresh token if due, then fetch fresh posts
        $this->maybe_refresh_token();
        $posts = $this->fetch_posts($limit);

        $ttl = !empty($posts)
            ? (int) ($this->settings['cache_ttl'] ?? 3600)
            : 600;
        $this->save_cached_value($cacheKey, $posts, $ttl);

        return $posts;
    }

    // ---------------------------------------------------------------
    // Private helpers
    // ---------------------------------------------------------------

    protected function fetch_posts($limit)
    {
        $token = $this->current_token();
        if (empty($token)) {
            log_message('error', 'Instagram feed: no access token available.');
            return array();
        }

        $fields = 'id,media_type,media_url,thumbnail_url,permalink,timestamp';
        $url = 'https://graph.instagram.com/me/media'
            . '?fields=' . $fields
            . '&limit=' . (int) $limit
            . '&access_token=' . rawurlencode($token);

        $response = $this->http_get_json($url);

        if (empty($response['data']) || !is_array($response['data'])) {
            if (!empty($response['error']['message'])) {
                log_message('error', 'Instagram feed API error: ' . $response['error']['message']);
            }
            return array();
        }

        $posts = array();
        foreach ($response['data'] as $item) {
            // Skip VIDEO types that have no image (use thumbnail_url instead)
            $image = !empty($item['thumbnail_url'])
                ? $item['thumbnail_url']
                : ($item['media_url'] ?? '');

            if (empty($image)) {
                continue;
            }

            $posts[] = array(
                'media_url'  => $image,
                'permalink'  => $item['permalink'] ?? 'https://www.instagram.com',
                'media_type' => $item['media_type'] ?? 'IMAGE',
                'timestamp'  => $item['timestamp'] ?? '',
            );
        }

        return $posts;
    }

    protected function maybe_refresh_token()
    {
        $state = $this->load_token_state();
        $last_refreshed = !empty($state['last_refreshed']) ? (int) $state['last_refreshed'] : 0;

        if ($last_refreshed > 0 && (time() - $last_refreshed) < self::REFRESH_INTERVAL) {
            return; // refreshed recently enough
        }

        $token = $this->current_token();
        if (empty($token)) {
            return;
        }

        $url = 'https://graph.instagram.com/refresh_access_token'
            . '?grant_type=ig_refresh_token'
            . '&access_token=' . rawurlencode($token);

        $response = $this->http_get_json($url);

        if (!empty($response['access_token'])) {
            $this->save_token_state(array(
                'access_token'   => $response['access_token'],
                'last_refreshed' => time(),
                'expires_in'     => $response['expires_in'] ?? 5183944,
            ));
        } else {
            // Just update the timestamp so we don't hammer the API on every request
            $state['last_refreshed'] = time();
            $this->save_token_state($state);

            if (!empty($response['error']['message'])) {
                log_message('error', 'Instagram token refresh error: ' . $response['error']['message']);
            }
        }
    }

    protected function current_token()
    {
        $state = $this->load_token_state();
        if (!empty($state['access_token'])) {
            return $state['access_token'];
        }
        return $this->settings['access_token'] ?? '';
    }

    protected function token_cache_path()
    {
        return APPPATH . 'cache/' . self::TOKEN_CACHE_FILE;
    }

    protected function load_token_state()
    {
        $path = $this->token_cache_path();
        if (!file_exists($path)) {
            return array();
        }
        $raw = @file_get_contents($path);
        if ($raw === false) {
            return array();
        }
        $data = json_decode($raw, true);
        return is_array($data) ? $data : array();
    }

    protected function save_token_state($state)
    {
        $path = $this->token_cache_path();
        $dir = dirname($path);
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
        @file_put_contents($path, json_encode($state, JSON_PRETTY_PRINT));
    }

    protected function http_get_json($url)
    {
        $ch = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 20,
            CURLOPT_HTTPHEADER     => array('Accept: application/json'),
            CURLOPT_SSL_VERIFYPEER => true,
        ));

        $raw   = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($raw === false || $error) {
            log_message('error', 'Instagram feed request failed: ' . $error);
            return array();
        }

        $data = json_decode($raw, true);
        return is_array($data) ? $data : array();
    }

    protected function get_cached_value($cacheKey)
    {
        $path = $this->cache_file_path($cacheKey);
        if (!is_file($path)) {
            return FALSE;
        }

        $raw = @file_get_contents($path);
        if ($raw === false) {
            return FALSE;
        }

        $payload = @unserialize($raw);
        if (!is_array($payload) || !isset($payload['expires_at'])) {
            return FALSE;
        }

        if ((int) $payload['expires_at'] < time()) {
            @unlink($path);
            return FALSE;
        }

        return $payload['data'] ?? FALSE;
    }

    protected function save_cached_value($cacheKey, $data, $ttl)
    {
        $path = $this->cache_file_path($cacheKey);
        $dir = dirname($path);
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }

        $payload = array(
            'expires_at' => time() + max(60, (int) $ttl),
            'data'       => $data,
        );

        @file_put_contents($path, serialize($payload), LOCK_EX);
    }

    protected function cache_file_path($cacheKey)
    {
        $safe = preg_replace('/[^a-z0-9_\-]/i', '_', $cacheKey);
        return APPPATH . 'cache/' . $safe . '.cache';
    }
}
