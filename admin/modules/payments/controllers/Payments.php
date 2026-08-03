<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Payments extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('mdl_payments');
    }

    public function index()
    {
        $this->load->view('data');
    }

    public function view_data()
    {
        $search   = $this->input->get('search',   true);
        $dateFrom = $this->input->get('date_from', true);
        $dateTo   = $this->input->get('date_to',   true);

        $rows = $this->mdl_payments->get_transactions($search, $dateFrom, $dateTo);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($rows));
    }
}
