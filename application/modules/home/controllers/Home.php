<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
class Home extends MX_Controller
{
    function error()
    {
        $this->oldurl_to_newurl();
        $data['title'] = "Page Not Found | " . $this->comp['company3'];
        $data['description'] = "Sorry, the page you are looking for doesn't exist. Explore our handcrafted Bhutan tour packages at TripJyada.";
        $data['module'] = "home";
        $data['view_file'] = "error";
        echo Modules::run('template/layout2', $data);
    }
    function index()
    {
        $this->load->database();
        $this->load->library('google_business_profile_reviews');
        $this->load->library('instagram_feed');
        $data['title'] = $this->comp['company3'] . " – Bhutan Tour Packages";
        $data['description'] = "Explore handcrafted Bhutan tour packages with TripJyada. Enjoy the best prices, expert local guides, and hassle-free booking for a memorable Bhutan journey.";
        $data['keywords'] = "Bhutan tour packages, Bhutan travel packages, group tours in Bhutan, family tours in Bhutan, honeymoon tours in Bhutan, TripJyada travel";
        $data['hero_image_preloads'] = array(
            array(
                'href' => base_url('assets/images/slider/1.webp'),
                'media' => '(min-width: 768px)',
                'type' => 'image/webp',
            ),
            array(
                'href' => base_url('assets/images/slider/mobile/1.webp'),
                'media' => '(max-width: 767px)',
                'type' => 'image/webp',
            ),
        );
        $data['module'] = "home";
        $data['view_file'] = "home";
        $data['tour_packages'] = $this->get_tour_packages();
        $data['db_categories'] = $this->get_db_categories();
        $data['google_testimonials'] = $this->google_business_profile_reviews->get_reviews(10);
        $data['recent_blogs'] = $this->get_recent_blogs(4);
        $data['instagram_posts'] = $this->instagram_feed->get_posts(10);
        echo Modules::run('template/layout1', $data);
    }


    private function get_tour_packages()
    {
        $this->ensure_card_table();
        $this->sync_slugs();

        $this->db->where('status', 1);
        $this->db->order_by('sort_order', 'asc');
        $this->db->order_by('p_id', 'desc');
        $rows = $this->db->get('packages')->result_array();
        $packages = array();

        foreach ($rows as $row) {
            $category = $this->category_slug(!empty($row['category_slug']) ? $row['category_slug'] : $row['category']);
            if ($category === '') {
                $category = 'uncategorized';
            }
            if (! isset($packages[$category])) {
                $packages[$category] = array();
            }

            $amenities = array_filter(array_map('trim', explode(',', $row['amenities'])));
            $amenity_icons = $this->amenity_icon_urls($row['amenity_icons']);
            $highlights = array_filter(array_map('trim', explode(',', $row['highlights'])));

            $image_src = $this->package_image_url($row);

            $packages[$category][] = array(
                'p_id' => $row['p_id'],
                'slug' => $row['slug'],
                'category' => $category,
                'category_slug' => $category === 'uncategorized' ? '' : $category,
                'image' => $row['image'],
                'default_image' => isset($row['default_image']) ? $row['default_image'] : '',
                'image_src' => $image_src,
                'title' => $row['title'],
                'days' => $row['days'],
                'best_selling' => $row['best_selling'] ? true : false,
                'amenities' => $amenities,
                'amenity_icons' => $amenity_icons,
                'highlights' => $highlights,
                'details' => isset($row['details']) ? $row['details'] : '',
                'price'            => $row['price'],
                'price_on_request' => !empty($row['price_on_request']) ? 1 : 0,
            );
        }

        return $packages;
    }

    private function ensure_card_table()
    {
        if (! $this->db->table_exists('packages')) {
            $this->load->dbforge();
            $this->dbforge->add_field(array(
                'p_id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
                'category' => array('type' => 'VARCHAR', 'constraint' => 50, 'default' => 'group'),
                'category_slug' => array('type' => 'VARCHAR', 'constraint' => 100, 'default' => 'group-tour'),
                'title' => array('type' => 'VARCHAR', 'constraint' => 255),
                'slug' => array('type' => 'VARCHAR', 'constraint' => 255),
                'days' => array('type' => 'VARCHAR', 'constraint' => 100),
                'amenities' => array('type' => 'TEXT', 'null' => TRUE),
                'amenity_icons' => array('type' => 'TEXT', 'null' => TRUE),
                'highlights' => array('type' => 'TEXT', 'null' => TRUE),
                'details' => array('type' => 'TEXT', 'null' => TRUE),
                'details_image' => array('type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE),
                'price' => array('type' => 'VARCHAR', 'constraint' => 50),
                'image' => array('type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE),
                'default_image' => array('type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE),
                'best_selling' => array('type' => 'TINYINT', 'constraint' => 1, 'default' => 0),
                'status' => array('type' => 'TINYINT', 'constraint' => 1, 'default' => 1),
                'sort_order' => array('type' => 'INT', 'constraint' => 11, 'default' => 0),
            ));
            $this->dbforge->add_key('p_id', TRUE);
            $this->dbforge->create_table('packages', TRUE);
        }
        if ($this->db->table_exists('packages') && ! $this->db->field_exists('slug', 'packages')) {
            $this->load->dbforge();
            $this->dbforge->add_column('packages', array(
                'slug' => array('type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE, 'after' => 'title'),
            ));
        }
        if ($this->db->table_exists('packages') && ! $this->db->field_exists('category_slug', 'packages')) {
            $this->load->dbforge();
            $this->dbforge->add_column('packages', array(
                'category_slug' => array('type' => 'VARCHAR', 'constraint' => 100, 'null' => TRUE, 'after' => 'category'),
            ));
        }
        if ($this->db->table_exists('packages') && ! $this->db->field_exists('default_image', 'packages')) {
            $this->load->dbforge();
            $this->dbforge->add_column('packages', array(
                'default_image' => array('type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE, 'after' => 'image'),
            ));
        }
        if ($this->db->table_exists('packages') && ! $this->db->field_exists('amenity_icons', 'packages')) {
            $this->load->dbforge();
            $this->dbforge->add_column('packages', array(
                'amenity_icons' => array('type' => 'TEXT', 'null' => TRUE, 'after' => 'amenities'),
            ));
        }
        if ($this->db->table_exists('packages') && ! $this->db->field_exists('details', 'packages')) {
            $this->load->dbforge();
            $this->dbforge->add_column('packages', array(
                'details' => array('type' => 'TEXT', 'null' => TRUE, 'after' => 'highlights'),
            ));
        }
        if ($this->db->table_exists('packages') && ! $this->db->field_exists('details_image', 'packages')) {
            $this->load->dbforge();
            $this->dbforge->add_column('packages', array(
                'details_image' => array('type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE, 'after' => 'details'),
            ));
        }
        if ($this->db->table_exists('packages') && ! $this->db->field_exists('price_on_request', 'packages')) {
            $this->load->dbforge();
            $this->dbforge->add_column('packages', array(
                'price_on_request' => array('type' => 'TINYINT', 'constraint' => 1, 'default' => 0, 'after' => 'price'),
            ));
        }
        if ($this->db->table_exists('packages')) {
            $this->db->query("ALTER TABLE packages CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        }
    }

    private function seed_default_cards()
    {
        if ($this->db->count_all('packages') > 0) {
            return; // table already has data — never overwrite admin changes
        }

        foreach ($this->default_cards() as $category => $cards) {
            $sort_order = 1;
            foreach ($cards as $card) {
                $data = array(
                    'category' => $category,
                    'category_slug' => $this->category_slug($category),
                    'title' => $card['title'],
                    'slug' => $this->unique_slug($card['title']),
                    'days' => $card['days'],
                    'amenities' => implode(', ', $card['amenities']),
                    'amenity_icons' => '',
                    'highlights' => implode(', ', $card['highlights']),
                    'details' => $this->default_details_text($card),
                    'details_image' => '',
                    'price' => $card['price'],
                    'image' => '',
                    'default_image' => $card['image'],
                    'best_selling' => !empty($card['best_selling']) ? 1 : 0,
                    'status' => 1,
                    'sort_order' => $sort_order,
                );
                $this->db->insert('packages', $data);
                $sort_order++;
            }
        }
    }

    private function default_cards()
    {
        $file = APPPATH . 'modules/home/views/home.php';
        if (! file_exists($file)) {
            return array();
        }

        $source = file_get_contents($file);
        $end = strpos($source, '$promotions = array(');
        if ($end === false) {
            return array();
        }

        $source = substr($source, 0, $end);
        $source = preg_replace('/^\s*<\?php/', '', $source);
        $tours_group = $tours_family = $tours_honeymoon = $tours_luxury = array();
        eval($source);

        return array(
            'group' => $tours_group,
            'family' => $tours_family,
            'honeymoon' => $tours_honeymoon,
            'luxury' => $tours_luxury,
        );
    }

    private function package_image_url($row)
    {
        if (!empty($row['image'])) {
            return base_url('assets/uploads/packages/' . $row['image']);
        }
        if (!empty($row['default_image'])) {
            return base_url('assets/images/product/' . $row['default_image']);
        }
        return base_url('assets/images/product/1.jpg');
    }

    private function package_details_image_url($row)
    {
        if (!empty($row['details_image'])) {
            return base_url('assets/uploads/packages/details/' . $row['details_image']);
        }
        return '';
    }

    private function amenity_icon_urls($icons)
    {
        $urls = array();
        foreach (array_filter(array_map('trim', explode(',', $icons))) as $icon) {
            $urls[] = base_url('assets/uploads/packages/icons/' . $icon);
        }
        return $urls;
    }

    private function create_slug($title)
    {
        $slug = strtolower(trim($title));
        $slug = preg_replace('/[^a-z0-9]+/i', '-', $slug);
        $slug = trim($slug, '-');
        return $slug ? $slug : 'package';
    }

    private function unique_slug($title, $current_id = null)
    {
        $base = $this->create_slug($title);
        $slug = $base;
        $count = 1;

        while ($this->slug_exists($slug, $current_id)) {
            $count++;
            $slug = $base . '-' . $count;
        }

        return $slug;
    }

    private function slug_exists($slug, $current_id = null)
    {
        $this->db->where('slug', $slug);
        if ($current_id) {
            $this->db->where('p_id !=', $current_id);
        }
        return $this->db->count_all_results('packages') > 0;
    }

    private function sync_slugs()
    {
        if (! $this->db->table_exists('packages') || ! $this->db->field_exists('slug', 'packages')) {
            return;
        }

        $used = array();
        $this->db->order_by('p_id', 'asc');
        $rows = $this->db->get('packages')->result_array();

        foreach ($rows as $row) {
            $base = $this->create_slug($row['title']);
            $slug = $base;
            $count = 1;

            while (isset($used[$slug])) {
                $count++;
                $slug = $base . '-' . $count;
            }

            $used[$slug] = true;
            $category_slug = $this->category_slug(!empty($row['category']) ? $row['category'] : $row['category_slug']);
            if ($row['slug'] !== $slug || @$row['category'] !== $category_slug || @$row['category_slug'] !== $category_slug) {
                $this->db->where('p_id', $row['p_id']);
                $this->db->update('packages', array(
                    'category' => $category_slug,
                    'slug' => $slug,
                    'category_slug' => $category_slug,
                ));
            }
        }
    }

    private function find_package_by_generated_slug($slug, $category_slug = '')
    {
        $this->db->where('status', 1);
        if ($category_slug) {
            $this->db->where('category_slug', $category_slug);
        }
        $rows = $this->db->get('packages')->result_array();

        foreach ($rows as $row) {
            if ($this->create_slug($row['title']) == $slug) {
                return $row;
            }
        }

        return null;
    }

    private function category_slug($category)
    {
        $category = strtolower(trim((string) $category));
        if ($category === '') {
            return '';
        }

        $slugs = array(
            'group' => 'group-tour',
            'family' => 'family-tour',
            'honeymoon' => 'honeymoon-tour',
            'luxury' => 'luxury-tour',
        );

        if (isset($slugs[$category])) {
            return $slugs[$category];
        }

        $slug = $this->create_slug($category);
        $slug = preg_replace('/(?:-tour)+$/', '-tour', $slug);

        if (substr($slug, -5) !== '-tour') {
            $slug .= '-tour';
        }

        return $slug;
    }

    private function category_name($category)
    {
        $names = array(
            'group' => 'Group Tour',
            'family' => 'Family Tour',
            'honeymoon' => 'Honeymoon Tour',
            'luxury' => 'Luxury Tour',
        );

        return isset($names[$category]) ? $names[$category] : ucwords(str_replace('-', ' ', $category));
    }

    private function get_db_categories()
    {
        if ($this->db->table_exists('categories')) {
            return $this->db->order_by('sort_order', 'asc')->get('categories')->result_array();
        }
        return array(
            array('name' => 'Group Tour',     'slug' => 'group-tour'),
            array('name' => 'Family Tour',    'slug' => 'family-tour'),
            array('name' => 'Honeymoon Tour', 'slug' => 'honeymoon-tour'),
            array('name' => 'Luxury Tour',    'slug' => 'luxury-tour'),
        );
    }

    private function default_details_text($card)
    {
        $highlights = !empty($card['highlights']) ? implode(', ', $card['highlights']) : 'popular attractions';
        return $card['title'] . ' includes ' . $card['days'] . ' with key highlights such as ' . $highlights . '. Add full package itinerary, inclusions, exclusions, and travel notes from the admin panel.';
    }

    private function get_recent_blogs($limit = 5)
    {
        if (!$this->db->table_exists('blog')) {
            return array();
        }
        $this->db->order_by('b_id', 'desc');
        $this->db->limit($limit);
        $rows = $this->db->get('blog')->result_array();
        $blogs = array();
        foreach ($rows as $row) {
            $slug = rtrim(str_replace('--', '-', urlencode(str_replace(' ', '-', str_replace(',', ' ', $row['title'])))), '-');
            $link = strtolower(site_url('blog/read/' . $slug . '/' . $row['b_id']));
            $img  = !empty($row['image']) ? base_url('assets/uploads/blog/' . $row['image']) : '';
            $day = '--';
            $month = '--';
            $date_obj = DateTime::createFromFormat('d/m/Y', $row['date']);
            if ($date_obj) {
                $day   = $date_obj->format('d');
                $month = $date_obj->format('M');
            }
            $excerpt = implode(' ', array_slice(explode(' ', strip_tags($row['description'])), 0, 20)) . '…';
            $blogs[] = array(
                'b_id'    => $row['b_id'],
                'title'   => $row['title'],
                'author'  => !empty($row['author']) ? $row['author'] : 'TripJyada',
                'date'    => $row['date'],
                'day'     => $day,
                'month'   => $month,
                'image'   => $img,
                'link'    => $link,
                'excerpt' => $excerpt,
                'tags'    => !empty($row['tags']) ? $row['tags'] : '',
            );
        }
        return $blogs;
    }

    public function oldurl_to_newurl()
    {
        // if (@$this->uri->segment(1) == "packers-movers-bihar-india") {
        //     redirect("bihar", 'location', 301);
        // }
    }
}
