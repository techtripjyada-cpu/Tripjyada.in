<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class City extends MX_Controller
{
    //wGtRkO8VoEyUjS
    function __construct()
    {
        parent::__construct();
        $this->load->model('mdl_city');
    }
   
    function index()
    {
        $this->load->view('form');
    }
    
    function save_data()
    {
        // print_r($_FILES); die();
//         echo "swdsds";die();
        $this->load->library('form_validation');
        $this->form_validation->set_rules("state","State","required|trim");
        $this->form_validation->set_rules(
            "city",
            "City",
            "required|trim|is_unique[table_name.city]",
            array(
                'is_unique' => 'The %s already exists. Please choose a different one.'
            )
        );
        $this->form_validation->set_rules("title","Title","trim");
        $this->form_validation->set_rules("content","City Content","trim");
        if (isset($_POST['c_id']) && $_POST['c_id']){
            $this->form_validation->set_rules("city","City","trim");
        }else{
            $this->form_validation->set_rules("city","City","trim|is_unique[city.city]");
        }
        // $this->form_validation->set_rules("phone","phone","trim");
        // $this->form_validation->set_rules("whatsapp", "WhatsApp", "trim|required|regex_match[/^\d{10}$/]", array('regex_match' => 'Please enter a 10-digit WhatsApp number.'));
        
        if ($this->form_validation->run()==TRUE)
        {
            $data['state']=ucfirst($_POST['state']);
            $data['city']=ucfirst($_POST['city']);
            $data['title']=$_POST['title'];
            $data['content']=$_POST['content'];
             $data['phone']=$_POST['phone'];
             $data['phone2']=$_POST['phone2'];
             $data['whatsapp']=$_POST['whatsapp'];
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
            }
            
            if (isset($_POST['c_id']) && $_POST['c_id'])//update
            {
                $where['c_id']=$_POST['c_id'];
                echo $this->mdl_city->update_data($where,$data);
            }
            else //add
            {
                echo $this->mdl_city->add_data($data);
            }
            // die();
        }
        else
        {
            echo validation_errors();
        }
    }
    
    function view_data()
    {
        $where=null;
        if (isset($_GET['c_id']))
	         $where['c_id']=$_GET['c_id'];
        
        if (isset($_GET['data']))
	        $select=$_GET['data'];
	    else $select="*";
	    
        $return=$this->mdl_city->view_data($where,$select);
        $this->output->set_content_type('application/json')->set_output(json_encode($return->result_array()));
    }
    
    function delete_data()
    {
        if (isset($_GET['id']) && $_GET['id'])
        {
            
            $this->db->where('c_id', $_GET['id']);
            foreach ($this->db->get("branches")->result() as $row)
            {
                $image_delete_path1="./files/citybanner/$row->image";
                 $image_delete_path2="./files/citybanner/thumb/$row->image";
            }
            unlink($image_delete_path1);
            unlink($image_delete_path2);
           
            $where['c_id']=$_GET['id'];
            echo $this->mdl_city->delete_data($where);
        }else echo "Not Deleted";
    }
        function image_upload()
        {
            $folder="city";
            // upload coder starts here
            $config['upload_path'] = './assets/temp';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|webp|jfif|WEBP|JFIF';
            $config['new_image'] = "./files/citybanner/";
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
                $config['new_image'] = "./files/citybanner/thumb/";
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
                $path1="./files/citybanner/".$title;
                unlink($path1);
                $path2="./files/citybanner/thumb/".$title;
                unlink($path2);
            }
          
        }
        
        
}