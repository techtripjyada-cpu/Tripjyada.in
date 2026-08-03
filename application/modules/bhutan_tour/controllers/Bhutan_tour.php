<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bhutan_tour extends MX_Controller
{
    public function index()
    {
        redirect(site_url('group-tour'));
    }

    public function package($slug = '')
    {
        $slug      = str_replace('_', '-', strtolower(trim($slug)));
        $data_file = APPPATH . "modules/bhutan_tour/views/data/$slug.php";

        if (!file_exists($data_file)) {
            redirect(site_url('group-tour'));
            return;
        }

        // Pre-load package data so SEO meta can be set in <head>
        /** @var array $package */
        include $data_file;

        $plain_title = ucwords(str_replace('-', ' ', $slug));

        $data['wa_number']   = $this->comp['wa_number'];
        $data['slug']        = $slug;
        $data['title']       = !empty($package['meta_title'])
                                   ? $package['meta_title']
                                   : $plain_title . ' | TripJyada';
        $data['description'] = !empty($package['meta_desc'])
                                   ? $package['meta_desc']
                                   : 'Book ' . $plain_title . ' with TripJyada. Visa, meals & accommodation included.';
        $data['keywords']    = 'Bhutan tour package, ' . $plain_title . ', Bhutan travel, TripJyada, Bhutan group tour';
        $data['module']      = 'Bhutan_tour';
        $data['view_file']   = 'package_view';

        echo Modules::run('template/layout2', $data);
    }
}
