<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reviews extends MX_Controller {
    
    public $where;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('text');
        $this->load->database();
        $this->load->model('ReviewMdl', 'r_model');       
    }
    
    function index(){
        $this->load->library('pagination');
        $this->load->helper('text');//to wrap text
        
        $config['base_url'] = site_url('customer-feedback');
        if(@$_GET['star'] && $_GET['star']){
            $this->db->where('stars',$_GET['star']);
        }    
        $config['total_rows'] = $this->db->where('status',1)->get('reviews')->num_rows();
        $config['uri_segment']= 2;
        $config['per_page'] = 30;
        $config['num_links']= 4;
        $config['page_query_string']=TRUE;
        $config['query_string_segment']="page";
        $config['reuse_query_string']=true;

        $config['full_tag_open'] = '<ul class="styled-pagination clearfix text-center">';
        $config['full_tag_close'] = '</ul></nav>';
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
        $this->db->order_by("r_id", "desc");
        if(@$_GET['star'] && $_GET['star']){
            $this->db->where('stars',$_GET['star']);
        }
        $data['reviews'] =$this->db->where('status',1)->get('reviews',$config['per_page'],$this->uri->segment(2));
        $data['total']=$config['total_rows'];

        $data['title']=$this->comp['company3']." Customer Feedback";
        $data['description']=$this->comp['company3']." Customer Feedback";
        $data['keywords']=$this->comp['company3']." Customer Feedback";
        $data['module']="reviews";
        $data['view_file']="reviews";
        echo Modules::run('template/layout2',$data);
    }
    // function create_view(){
        // $this->db->query("drop table review_view");
        // $this->db->query("alter table reviews add views int(11) default 1");
    // }

    function view($id){
        if(@$id){
            $data['reviews']=$this->view_reviews($id);
            if($data['reviews']->num_rows()>0){
                $rev=$data['reviews']->result();
                $newview=$rev[0]->views+7;
                $this->db->where('r_id',$id)->update("reviews",array("views"=>$newview));             
                
                $data['title']=$rev[0]->r_title;
                $data['description']=$rev[0]->r_desc;
                $data['keywords']=$this->comp['company3']." Customer Feedback";
                $data['module']="reviews";
                $data['view_file']="single_review";
                echo Modules::run('template/layout2',$data);
            }else{
                echo "Invalid Link";
            }            
        }
    }
    function revw(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', ' Name', 'required', array(
            'required' => '* Please enter your name.'
        ));
        $this->form_validation->set_rules('email', ' Email', 'required', array(
            'required' => '* Please enter your email.'
        ));
        $this->form_validation->set_rules('title', ' ReviewTitle', 'required', array(
            'required' => '* Please enter Review Title.'
        ));
        $this->form_validation->set_rules('desc', 'Message', 'required', array(
            'required' => '* Please enter your message.'
        ));
        $this->form_validation->set_rules('stars', 'Stars', 'required', array(
            'required' => '* Please select the stars.'
        ));
        if ($this->form_validation->run() == true) {
            $this->load->model('contacts_mdl');
            $check = $this->contacts_mdl->insert_reviews();
            if ($check == true) {
          echo "1";
            }
        } else {
            echo "<div class='alert alert-danger'>" . validation_errors() . "</div>";
        }
    }

    function review(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', ' Name', 'required', array(
            'required' => '* Please enter your name.'
        ));
        $this->form_validation->set_rules('email', ' Email', 'required', array(
            'required' => '* Please enter your email.'
        ));
        $this->form_validation->set_rules('title', ' ReviewTitle', 'required', array(
            'required' => '* Please enter Review Title.'
        ));
        
        $this->form_validation->set_rules('stars', 'Stars', 'required', array(
            'required' => '* Please select the stars.'
        ));
      
        
        if ($this->form_validation->run() == FALSE) {
            $res=array("err"=>1,"msg"=>validation_errors());
        } else {
            $data['b_id'] = '1';
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['r_title'] = $this->input->post('title');
            $data['r_desc'] = $this->input->post('desc');
            if(@$_FILES['img']['name']){
                $data['r_img']=$this->image_upload('img','reviewimg');
            }else{
                $data['r_img']='';
            }
            $data['stars'] = $this->input->post('stars');
            $data['status'] = '1';
            
            // To check if there is a review already posted
            $chk = $this->db->select('*')->from('reviews')->where("email", $this->input->post('email'))->get()->result();
            if(!$chk){
                $result=$this->r_model->insert_reviews($data);
                if($result){
                    $res=array("err"=>0,"msg"=> "Review Posted Successfully");
                }else{
                    $res=array("err"=>1,"msg"=> "Error Posting");
                }
            }else{
                $res=array("err"=>1,"msg"=>"You have already posted your review");
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
    }
    //Post method for saving emotions
    public function emotions(){ 
        $data['b_id'] = $this->input->get('bid');
        $data['r_id'] = $this->input->get('r_id');
        $data['user_id'] = $_SESSION['user_id'];
        $data['likes'] = $this->input->get('like');
        
        $name=$this->db->select('*')->from('emotions')->where("user_id", $_SESSION['user_id'])->where("r_id", $this->input->get('r_id'))->get()->result();

        if(sizeof($name)==0){
            $result=$this->v_model->insert_emotions($data);
        }else{
            $result=$this->v_model->update_emotions($name[0]->e_id,$data);
        }
        
        if($result){
            $res=array("err"=>0,"msg"=> "Success");
        }
        else {
            $res=array("err"=>1,"msg"=>"Failed");
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
    }
    
    // For getting review data for frontend 
    function view_reviews($id=''){
        if(@$id)
            $where['r_id']=$id;
       
        $where['status']=1;
        return $this->db->order_by('r_id','desc')->where($where)->get('reviews');
    }
    
    //Method to upload images
    function image_upload($filename,$path)
    {
        // upload coder starts here
        $config['upload_path'] = './assets/temp';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG|webp';
        $config['new_image'] = "./assets/uploads/$path/";
        $config['min_width']=100;
        
        $config['file_name'] = time().mt_rand(0, 9999);
        $config['overwrite'] = false;
        $config['remove_spaces'] = true;
        
        $this->load->library('upload', $config);
        if (! $this->upload->do_upload($filename))
        {
            $res=array("err"=>1,"msg"=> $this->upload->display_errors());
            $this->output->set_content_type('application/json')->set_output(json_encode($res));die();
        }
        else
        {
            $image = $this->upload->data();
            //  image manipulation resizing 1
            //  $config['image_library'] = 'GD';
            $config['source_image'] = './assets/temp/' . $image['file_name'];
            $config['maintain_ratio'] = TRUE;
            if ($image['image_width']>700)
                $config['width'] = 700;
                $this->load->library('image_lib', $config);
                $this->image_lib->initialize($config);
                if (! $this->image_lib->resize())
                {
//                     echo  $this->image_lib->display_errors();
                    $res=array("err"=>1,"msg"=> $this->image_lib->display_errors());
                    $this->output->set_content_type('application/json')->set_output(json_encode($res));die();
                }
                
                $this->image_lib->clear();
                // image manipulation resizing 2
                //  $config['image_library'] = 'GD';
                $config['source_image'] = './assets/temp/' . $image['file_name'];
                $config['new_image'] = "./assets/uploads/$path/thumb/";
                $config['file_name'] = time().mt_rand(0, 9999);
                $config['maintain_ratio'] = TRUE;
                if ($image['image_width']>200){
                    $config['width'] = 200;
                }
                $config['overwrite'] = FALSE;
                $this->load->library('image_lib', $config);
                $this->image_lib->initialize($config);
                if (! $this->image_lib->resize())
                {
                    $res=array("err"=>1,"msg"=> $this->image_lib->display_errors());
                    $this->output->set_content_type('application/json')->set_output(json_encode($res));die();
                }
                else
                {
                    unlink($config['source_image']);
                    return $image['file_name'];
                }
        }
    }
    
    //Method to delete image
    function remove_image($path,$name)
    {
        $path1="./assets/uploads/$path/".$name;
        unlink($path1);
        $path2="./assets/uploads/$path/thumb/".$name;
        unlink($path2);
    }
    
}