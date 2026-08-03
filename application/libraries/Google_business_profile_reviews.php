<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Google_business_profile_reviews
{
    protected $CI;
    protected $settings = array();

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->config('google_business_profile', TRUE);
        $this->settings = (array) $this->CI->config->item('google_business_profile', 'google_business_profile');
    }

    public function get_reviews($limit = null)
    {
        if (empty($this->settings['enabled'])) {
            return array();
        }

        $limit = $limit ?: (int) ($this->settings['max_reviews'] ?? 10);
        $cacheKey = 'google_business_profile_reviews_' . $limit;
        $cached = $this->get_cached_value($cacheKey);

        if ($cached !== FALSE && is_array($cached)) {
            return $cached;
        }

        $reviews = $this->fetch_reviews($limit);
        $ttl = !empty($reviews)
            ? (int) ($this->settings['cache_ttl'] ?? 21600)
            : 600;
        $this->save_cached_value($cacheKey, $reviews, $ttl);

        return $reviews;
    }

    protected function fetch_reviews($limit)
    {
        if (!$this->has_required_settings()) {
            log_message('error', 'Google Business Profile reviews are enabled but configuration is incomplete.');
            return array();
        }

        $accessToken = $this->fetch_access_token();
        if (!$accessToken) {
            return array();
        }

        $parent = sprintf(
            'accounts/%s/locations/%s',
            rawurlencode($this->settings['account_id']),
            rawurlencode($this->settings['location_id'])
        );

        $url = 'https://mybusiness.googleapis.com/v4/' . $parent . '/reviews?pageSize=' . (int) $limit . '&orderBy=updateTime desc';
        $response = $this->http_get_json($url, array(
            'Authorization: Bearer ' . $accessToken,
            'Accept: application/json',
        ));

        if (empty($response['reviews']) || !is_array($response['reviews'])) {
            if (!empty($response['error']['message'])) {
                log_message('error', 'Google Business Profile reviews API error: ' . $response['error']['message']);
            }
            return array();
        }

        $testimonials = array();
        foreach ($response['reviews'] as $review) {
            $testimonials[] = $this->map_review($review);
        }

        return $testimonials;
    }

    protected function map_review($review)
    {
        $reviewer = isset($review['reviewer']) && is_array($review['reviewer']) ? $review['reviewer'] : array();
        $comment = trim((string) ($review['comment'] ?? ''));
        $reviewTime = $review['updateTime'] ?? ($review['createTime'] ?? '');

        return array(
            'name' => $reviewer['displayName'] ?? 'Google User',
            'location' => $reviewTime ? 'Google review • ' . $this->format_review_time($reviewTime) : 'Google review',
            'text' => $comment !== '' ? $comment : 'Shared a 5-star experience with Tripjyada on Google.',
            'title' => 'Google Review',
            'rating' => $this->map_star_rating($review['starRating'] ?? 'FIVE'),
            'image' => '2.jpg',
            'image_url' => $reviewer['profilePhotoUrl'] ?? '',
            'source' => 'google_business_profile',
        );
    }

    protected function map_star_rating($rating)
    {
        $map = array(
            'ONE' => 1,
            'TWO' => 2,
            'THREE' => 3,
            'FOUR' => 4,
            'FIVE' => 5,
        );

        if (is_numeric($rating)) {
            return max(1, min(5, (int) $rating));
        }

        return $map[strtoupper((string) $rating)] ?? 5;
    }

    protected function format_review_time($time)
    {
        $timestamp = strtotime($time);
        return $timestamp ? date('M Y', $timestamp) : 'recently';
    }

    protected function fetch_access_token()
    {
        $payload = http_build_query(array(
            'client_id' => $this->settings['client_id'],
            'client_secret' => $this->settings['client_secret'],
            'refresh_token' => $this->settings['refresh_token'],
            'grant_type' => 'refresh_token',
        ));

        $ch = curl_init('https://oauth2.googleapis.com/token');
        curl_setopt_array($ch, array(
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
            ),
        ));

        $raw = curl_exec($ch);
        $error = curl_error($ch);
        $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($raw === false || $error) {
            log_message('error', 'Google OAuth token request failed: ' . $error);
            return '';
        }

        $data = json_decode($raw, true);
        if ($status >= 400 || empty($data['access_token'])) {
            $message = !empty($data['error_description']) ? $data['error_description'] : ($data['error'] ?? 'Unknown token error');
            log_message('error', 'Google OAuth token error: ' . $message);
            return '';
        }

        return $data['access_token'];
    }

    protected function http_get_json($url, $headers = array())
    {
        $ch = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_HTTPHEADER => $headers,
        ));

        $raw = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($raw === false || $error) {
            log_message('error', 'Google Business Profile reviews request failed: ' . $error);
            return array();
        }

        $data = json_decode($raw, true);
        return is_array($data) ? $data : array();
    }

    protected function has_required_settings()
    {
        $required = array('client_id', 'client_secret', 'refresh_token', 'account_id', 'location_id');
        foreach ($required as $key) {
            if (empty($this->settings[$key])) {
                return false;
            }
        }

        return true;
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
