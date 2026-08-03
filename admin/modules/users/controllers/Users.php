<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('mdl_users');
    }

    function index()
    {
        $this->load->view('data');
    }

    function view_data()
    {
        $search = $this->input->get('search', true);
        $rows   = $this->mdl_users->get_users($search);
        $this->output->set_content_type('application/json')->set_output(json_encode($rows));
    }

    function otp_logs()
    {
        $phone = $this->input->get('phone', true);
        $rows  = $this->mdl_users->get_otp_logs($phone);
        $this->output->set_content_type('application/json')->set_output(json_encode($rows));
    }

    function stats()
    {
        $data = $this->mdl_users->get_stats();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
