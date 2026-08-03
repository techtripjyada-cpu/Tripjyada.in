<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Album extends MX_Controller
{
    function __construct()
    {
         parent::__construct();
         $this->load->model('mdl_album');
         
         //privileges
//          $this->module="album";
//          $this->load->module('user_privileges');
     }
    function index()
    {
        $this->load->view('form');
    }
    function save_data()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules("title","Album title","required|trim");
        $this->form_validation->set_rules("description","Album description","trim|max_length[5000]");
        if ($this->form_validation->run()==TRUE)
        {
            $data['title']=$_POST['title'];
            $data['description']=$_POST['description'];
            
            if (isset($_POST['id']) && $_POST['id'])//update
            {
                $where['album_id']=$_POST['id'];
                echo $this->mdl_album->update_data($where,$data);
            }
            else //add
            {
                echo $this->mdl_album->add_data($data);
            }
        }
        else 
            echo validation_errors();
    }
    function view_data()
    {
//         $function="view";
//         $this->user_privileges->check_privilege($this->module,$function);
        $where=null;
        if (isset($_GET['id']))
	         $where['album_id']=$_GET['id'];
        
        if (isset($_GET['data']))
	        $select=$_GET['data'];
	    else $select="*";
	    
        $return=$this->mdl_album->view_data($where,$select);
        $this->output->set_content_type('application/json')->set_output(json_encode($return->result_array()));
    }
    function delete_data()
    {
//         $where=null;
//         $function="delete";
//         $this->user_privileges->check_privilege($this->module,$function);
        if (isset($_GET['id']) && $_GET['id'])
        {
            $where['album_id']=$_GET['id'];
            echo $this->mdl_album->delete_data($where);
        }
    }
}
?>