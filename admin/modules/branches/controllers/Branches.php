<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Branches extends MX_Controller
{
    //wGtRkO8VoEyUjS
    function __construct()
    {
        parent::__construct();
        $this->load->model('mdl_branches');
    }
   
    function index()
    {
        $this->load->view('form');
    }
    
    function save_data()
    {
//         print_r($_FILES); die();
//         echo "swdsds";die();
        $this->load->library('form_validation');
        $this->form_validation->set_rules("city","City","required|trim");
        $this->form_validation->set_rules("latitude","Latitude","trim");
        $this->form_validation->set_rules("longitude","Longitude","trim");
        if (isset($_POST['b_id']) && $_POST['b_id']){
        $this->form_validation->set_rules("url","SEO URL","trim");
        }else{
            $this->form_validation->set_rules("url","SEO Url","trim|is_unique[branches.url]");
        }
        $this->form_validation->set_rules("name","Name","required|trim");
        $this->form_validation->set_rules("state","State","required|trim");
        $this->form_validation->set_rules("address","Address","trim");
        $this->form_validation->set_rules("phone","phone","trim");
        $this->form_validation->set_rules("email","Email","trim"); 
        
        if ($this->form_validation->run()==TRUE)
        {
            $data['city']=ucfirst($_POST['city']);
            $data['latitude']=$_POST['latitude'];
            $data['longitude']=$_POST['longitude'];
            $data['url']=$_POST['url'];
            $data['state']=$_POST['state'];
            $data['name']=Ucfirst($_POST['name']);
            $data['address']=Ucfirst($_POST['address']);
             $data['phone']=$_POST['phone'];
            $data['email']=$_POST['email']; 
            $data['info']=@$_POST['info']?1:0; 
            $data['status']=@$_POST['status']?1:0; 
            // print_r($data);die();

          
            if (!empty($_FILES['image']['name'])) 
            {
                // $data['url_type']=0;
                $data['image']=$this->image_upload($data['city']);
                if ($_POST['old_image'])
                {
                    $this->remove_image($_POST['old_image']);
                }
            }else if ($this->input->post('image_url')){
                // $data['url_type']=1;
                $data['image']=$this->input->post('image_url');
                if ($_POST['old_image'])
                {
                    $this->remove_image($_POST['old_image']);
                }
            }
            
            if (isset($_POST['b_id']) && $_POST['b_id'])//update
            {
                $where['b_id']=$_POST['b_id'];
                echo $this->mdl_branches->update_data($where,$data);
            }
            else //add
            {
                echo $this->mdl_branches->add_data($data);
            }
        }
        else
        {
            echo validation_errors();
        }
    }
    
    function view_data()
    {
        $where=null;
        if (isset($_GET['b_id']))
	         $where['b_id']=$_GET['b_id'];
        
        if (isset($_GET['data']))
	        $select=$_GET['data'];
	    else $select="*";
	    
        $return=$this->mdl_branches->view_data($where,$select);
        $this->output->set_content_type('application/json')->set_output(json_encode($return->result_array()));
    }
    
    function delete_data()
    {
        if (isset($_GET['id']) && $_GET['id'])
        {
            
            $this->db->where('b_id', $_GET['id']);
            foreach ($this->db->get("branches")->result() as $row)
            {
                $image_delete_path1="./assets/uploads/branches/$row->image";
                 $image_delete_path2="./assets/uploads/branches/thumb/$row->image";
            }
            unlink($image_delete_path1);
            unlink($image_delete_path2);
           
            $where['b_id']=$_GET['id'];
            echo $this->mdl_branches->delete_data($where);
        }else echo "Not Deleted";
    }
        function image_upload()
        {
            $folder="branches";
            // upload coder starts here
            $config['upload_path'] = './assets/temp';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|webp|jfif|WEBP|JFIF';
            $config['new_image'] = "./assets/uploads/$folder/";
            $config['min_width']=100;
        
            $rand_number = mt_rand(0, 85);
            $timestamp = time();
//             $title = str_replace(" ", "_", $title);
            $config['file_name'] =  $rand_number . $timestamp;
        
            $config['overwrite'] = false;
            $config['remove_spaces'] = true;
        
            
            $this->load->library('upload');
            $this->upload->initialize($config);
            if (! $this->upload->do_upload('image'))
            {
                echo $this->upload->display_errors();
                die();
            }
            else
            {
                $image = $this->upload->data();
                if ($this->input->post('width'))
                {
                    $config['width'] = $this->input->post('width');
                }else{
                    if ($image['image_width']>720)
                        $config['width'] =720;
                }
                // image manipulation resizing 1
                $config['source_image'] = './assets/temp/' . $image['file_name'];
                $config['maintain_ratio'] = TRUE;
        
                $this->load->library('image_lib', $config);
                $this->image_lib->initialize($config);
        
                if (! $this->image_lib->resize())
                {
                    echo $this->image_lib->display_errors();die();
                }
        
                $this->image_lib->clear();
                // image manipulation resizing 2
                $config['source_image'] = './assets/temp/' . $image['file_name'];
                $config['new_image'] = "./assets/uploads/$folder/thumb/";
                $config['file_name'] =  $rand_number . $timestamp;
                $config['maintain_ratio'] = TRUE;
                if ($image['image_width']>100){
                    $config['width'] = 100;
                }
                $config['overwrite'] = FALSE;
                $this->load->library('image_lib', $config);
                $this->image_lib->initialize($config);
                if (! $this->image_lib->resize())
                {
                    echo $this->image_lib->display_errors();die();
                }
                else
                {
                    unlink($config['source_image']);
                    return $image['file_name'];
                }
            }
        }
        
        function remove_image($title)
        {
            if (substr($title, 0,4)!="http")
            {
                $path1="./assets/uploads/branches/".$title;
                unlink($path1);
                $path2="./assets/uploads/branches/thumb/".$title;
                unlink($path2);
            }
          
        }
        
        
}
?>