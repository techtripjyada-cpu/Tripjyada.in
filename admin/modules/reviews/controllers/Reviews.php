<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reviews extends MX_Controller
{
    //wGtRkO8VoEyUjS
    private $type;
    function __construct()
    {
        parent::__construct();
        $this->load->model('mdl_reviews');
//         $this->type=$this->session->userdata('type');
//         if ($this->type!="A")
//         {
//             echo "<br><pre><h3 align='center'>Sorry! you are not an Administrator...</h3></pre>";
//             die();
//         }
    }
    function index()
    {
        $this->load->view('data');
    }
    function save()
    {
        if($_GET['id']){
            $where['r_id']=$_GET['id'];
            $data['status']=$_GET['status'];
            echo $this->mdl_reviews->update_data($where,$data);
        }
        else 
            echo "invalid Request";
        
    }
    function view_data()
    {
        $where=null;
        if (isset($_GET['id']))
	         $where['r_id']=$_GET['id'];
        
        if (isset($_GET['data']))
	        $select=$_GET['data'];
	    else $select="r_id,name as unm,email, r_img as img,stars as rt,r_desc as cmt,posted_date as pd,r_title as t,r_type as ty,timestamp as tm,status as st";
	    
// 	    $this->db->join('products','p_id')->join('users','user_id');
	    
        $return=$this->mdl_reviews->view_data($where,$select);
        $this->output->set_content_type('application/json')->set_output(json_encode($return->result_array()));
    }
}