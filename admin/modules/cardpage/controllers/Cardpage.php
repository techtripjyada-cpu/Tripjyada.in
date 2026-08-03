<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cardpage extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('mdl_cardpage');
    }

    function index()
    {
        $this->load->view('data');
    }

    function tabs()
    {
        $this->load->view('tabs');
    }

    function desc_page()
    {
        $this->load->view('desc');
    }

    function get_tabs()
    {
        $slug = $this->input->get('slug') ?: 'all';
        $data = $this->mdl_cardpage->get_tabs($slug);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    function save_tab()
    {
        $id = (int) $this->input->post('id');
        $data = array(
            'page_slug'            => $this->input->post('page_slug') ?: 'all',
            'days_label'           => $this->input->post('days_label'),
            'tab_title'            => $this->input->post('tab_title'),
            'hero_image'           => $this->input->post('hero_image'),
            'itinerary_heading'    => $this->input->post('itinerary_heading'),
            'itinerary_subheading' => $this->input->post('itinerary_subheading'),
            'day_data'             => isset($_POST['day_data']) ? $_POST['day_data'] : '',
            'sort_order'           => (int) $this->input->post('sort_order'),
            'active'               => $this->input->post('active') ? 1 : 0,
        );
        echo $this->mdl_cardpage->save_tab($data, $id);
    }

    function delete_tab()
    {
        $id = (int) $this->input->get('id');
        if ($id) {
            $this->mdl_cardpage->delete_tab($id);
            echo '1';
        } else {
            echo '0';
        }
    }

    function get_desc()
    {
        $slug = $this->input->get('slug') ?: 'all';
        $row  = $this->mdl_cardpage->get_desc($slug);
        $this->output->set_content_type('application/json')->set_output(json_encode($row ?: new stdClass()));
    }

    function save_desc()
    {
        $slug = $this->input->post('page_slug') ?: 'all';
        $data = array(
            'heading' => $this->input->post('heading'),
            'body'    => isset($_POST['body']) ? $_POST['body'] : '',
            'active'  => $this->input->post('active') ? 1 : 0,
        );
        $this->mdl_cardpage->save_desc($slug, $data);
        echo '1';
    }
}
