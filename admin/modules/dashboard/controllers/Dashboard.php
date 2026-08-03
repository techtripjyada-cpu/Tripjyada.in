<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MX_Controller
{
    //wGtRkO8VoEyUjS
    function index()
    {
//         $this->load->view('view');
    }
    function admin()
    {
        $this->load->view('view');
    }
    function fetch_cards_data()
    {
        $data=array(
            "bookings"=>$this->db->get('bookings')->num_rows(),
            "branches"=>$this->db->get('branches')->num_rows(),
            "gallery"=>$this->db->get('gallery')->num_rows(),
            "contact"=>$this->db->get('contacts')->num_rows(),
            "blog"=>$this->db->get('blog')->num_rows(),
            "newsletter"=>$this->db->get('newsletter')->num_rows(),
            "reviews"=>$this->db->get('reviews')->num_rows(),
            "cards"=>$this->db->table_exists('packages') ? $this->db->get('packages')->num_rows() : 0,
            "logs"=>$this->db->get('logs')->num_rows(),

        );
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }


}
