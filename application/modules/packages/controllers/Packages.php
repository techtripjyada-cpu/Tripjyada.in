<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Packages extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('packages_mdl');
    }

    // ---------------------------------------------------------------
    // Listing page — /tour-package  or  /tour-package/group-tour
    // ---------------------------------------------------------------
    public function index($category_slug = '')
    {
        $category_slug = str_replace('_', '-', $category_slug);

        // Build category name map from DB if available
        $category_names = array();
        if ($this->db->table_exists('categories')) {
            foreach ($this->db->get('categories')->result_array() as $cat) {
                $category_names[$cat['slug']] = $cat['name'] . ' Packages';
            }
        }
        if (empty($category_names)) {
            $category_names = array(
                'group-tour'     => 'Group Tour Packages',
                'family-tour'    => 'Family Tour Packages',
                'honeymoon-tour' => 'Honeymoon Tour Packages',
                'luxury-tour'    => 'Luxury Tour Packages',
            );
        }

        $page_title = isset($category_names[$category_slug])
            ? $category_names[$category_slug]
            : 'All Tour Packages';

        $cp_slug = $category_slug ?: 'all';
        $data['packages']        = $this->packages_mdl->get_packages(''); // always all — filtering is client-side
        $data['categories']      = $this->packages_mdl->get_categories();
        $data['total_count']     = $this->packages_mdl->get_total_count();
        $data['category_slug']   = $category_slug; // used to pre-activate JS filter
        $data['page_title']      = $page_title;
        $data['cardpage_tabs']   = $this->packages_mdl->get_cardpage_tabs($cp_slug);
        $data['cardpage_desc']   = $this->packages_mdl->get_cardpage_desc($cp_slug);
        $data['title']          = $page_title . ' 2025 | ' . $this->comp['company3'];
        $data['description']    = 'Explore ' . $page_title . ' with TripJyada. Expert guides, visa & meals included. Book now!';
        $data['keywords']       = $page_title . ', tour packages, TripJyada, Bhutan tours';
        $data['module']         = 'packages';
        $data['view_file']      = 'packages_listing';

        echo Modules::run('template/layout2', $data);
    }

    // ---------------------------------------------------------------
    // Detail page — /group-tour/package-slug
    // ---------------------------------------------------------------
    public function detail($category_slug = '', $slug = '')
    {
        $category_slug = str_replace('_', '-', urldecode($category_slug));
        $slug          = str_replace('_', '-', urldecode($slug));

        // strip the word 'package' if it comes as a category placeholder
        if ($category_slug == 'package') {
            $category_slug = '';
        }

        // fetch from DB via model
        $package = $this->packages_mdl->get_package($slug, $category_slug);

        if (!$package) {
            show_404();
            return;
        }

        // prepare arrays
        $package['amenities']         = array_filter(array_map('trim', explode(',', $package['amenities'])));
        $package['amenity_icons']     = $this->_amenity_icon_urls($package['amenity_icons']);
        $package['highlights']        = array_filter(array_map('trim', explode(',', $package['highlights'])));
        $package['image_src']         = $this->_package_image_url($package);
        $package['details_image_src'] = $this->_details_image_url($package);

        $raw_title = $package['title'];
        $raw_desc  = trim(
            (string) (!empty($package['meta_description'])
                ? $package['meta_description']
                : (!empty($package['description'])
                    ? $package['description']
                    : strip_tags($package['details'] ?? '')))
        );

        $data['title']       = (strlen($raw_title) > 57 ? substr($raw_title, 0, 54) . '...' : $raw_title) . ' | ' . $this->comp['company3'];
        $data['description'] = strlen($raw_desc) > 150 ? substr($raw_desc, 0, 147) . '...' : ($raw_desc ?: 'Book ' . $raw_title . ' with TripJyada.');
        $data['keywords']    = $raw_title . ', tour package, TripJyada';
        $data['module']      = 'packages';
        $data['view_file']   = 'package_details';
        $data['package']     = $package;

        echo Modules::run('template/layout2', $data);
    }

    // ---------------------------------------------------------------
    // Private helpers
    // ---------------------------------------------------------------

    private function _package_image_url($row)
    {
        if (!empty($row['image'])) {
            return base_url('assets/uploads/packages/' . $row['image']);
        }
        if (!empty($row['default_image'])) {
            return base_url('assets/images/product/' . $row['default_image']);
        }
        return base_url('assets/images/product/1.jpg');
    }

    private function _details_image_url($row)
    {
        if (!empty($row['details_image'])) {
            return base_url('assets/uploads/packages/details/' . $row['details_image']);
        }
        return '';
    }

    private function _amenity_icon_urls($icons)
    {
        $urls = array();
        foreach (array_filter(array_map('trim', explode(',', $icons))) as $icon) {
            $urls[] = base_url('assets/uploads/packages/icons/' . $icon);
        }
        return $urls;
    }
}
