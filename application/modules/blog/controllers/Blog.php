<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends MX_Controller {

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index() {
        redirect('blog/view');
    }

    function view(){
        $this->load->library('pagination');
        $this->load->helper('text'); 

        $config['base_url'] = site_url('blog/view');
        $config['total_rows'] = $this->db->get('blog')->num_rows(); 
        $config['per_page'] = 4; 
        $config['num_links'] = 4; 

        $config['full_tag_open'] = '<ul class="styled-pagination clearfix text-center">';
        $config['full_tag_close'] = '</ul>';
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a href="#" class="active rc_first_hr color_dark">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['first_link'] = 'First';

        $this->pagination->initialize($config);

        $this->db->order_by("b_id", "desc"); 
        $data['query'] = $this->db->get('blog', $config['per_page'], $this->uri->segment(3));
        $data['total'] = $config['total_rows'];

        $data['title'] = "Travel Blog | TripJyada – Tips & Destinations";
        $data['description'] = "Read TripJyada's travel blog for Bhutan travel tips, destination guides, packing advice and inspiring stories from our travel experts.";
        $data['keywords'] = "travel blog, Bhutan travel tips, destination guides, TripJyada blog, holiday travel advice";
        $data['module'] = "blog";
        $data['view_file'] = "blog"; 

        echo Modules::run('template/layout2', $data);
    }

    function view_reviews($id = '') {
        if ($id) {
            $where['b_id'] = $id;
        }
        return $this->db->order_by('b_id', 'desc')->where($where)->get('blog');
    }

    function read($title = '', $bid) {
        $this->load->helper('text');

        $blg = $this->db->where('b_id', $bid)->get('blog');
        $b = $blg->result();
        $data['query'] = $b;

        if ($blg->num_rows() > 0) {
            $data['blogs'] = $this->view_reviews($bid);

            if ($data['blogs']->num_rows() > 0) {
                $rev = $data['blogs']->result();
                $newview = $rev[0]->views + 3;
                $this->db->where('b_id', $bid)->update("blog", array("views" => $newview));      
            }

            $blg = $blg->result();
            $raw_title = ucfirst($blg[0]->title);
            $data['title'] = (strlen($raw_title) > 51 ? substr($raw_title, 0, 48) . '...' : $raw_title) . ' | TripJyada';
            $raw_desc = strip_tags($blg[0]->description);
            $data['description'] = strlen($raw_desc) > 150 ? substr($raw_desc, 0, 147) . '...' : $raw_desc;
            $data['img'] = base_url('assets/uploads/blog/'.$blg[0]->image);
            $data['module'] = "blog";
            $data['view_file'] = "view"; 

            echo Modules::run('template/layout2', $data);
        } else {
            echo "Invalid blog URL"; 
        }
    }
}
