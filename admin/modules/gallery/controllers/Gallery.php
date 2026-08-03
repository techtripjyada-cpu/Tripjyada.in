<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
class Gallery extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('gallery_mdl');
    }

    function index()
    {
        $this->load->view('index');
    }

    function image_upload()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('album_id', 'Album', 'required|trim');
        $this->form_validation->set_rules('title', 'Title', 'required|trim');
//         $this->form_validation->set_rules('thumb_check', 'Thumb', 'required');
//         if (@$_POST['thumb_check']==1)
//         {
//             if (empty($_FILES['thumb']['name'])){
                
         
//             $this->form_validation->set_rules('thumb', 'Thumb Image', 'required');
//             }
//         }
        
        if (empty($_FILES['image']['name'])) {
            $this->form_validation->set_rules('image', 'Image', 'required');
        }
        if ($this->form_validation->run() == TRUE) 
        {
            // upload coder starts here
            $config['upload_path'] = './assets/temp';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            $config['new_image'] = './assets/uploads/gallery/';
            $config['min_width']=200;
         
            
            $rand_number = mt_rand(0, 85);
            $timestamp = time();
//             $title = str_replace(" ", "_", $_POST['title']);
            $config['file_name'] =  $rand_number . $timestamp;
            
            $config['overwrite'] = false;
            $config['remove_spaces'] = true;
            
            $this->load->library('upload', $config);
            if (! $this->upload->do_upload('image')) 
            {
                echo $this->upload->display_errors();
                die();
            } 
            else 
            {   
                $image = $this->upload->data();
                // image manipulation resizing 1
                $config['source_image'] = './assets/temp/' . $image['file_name'];
                $config['maintain_ratio'] = TRUE;
//                 if ($image['image_width']>720)
//                     $config['width'] = 720;
                $this->load->library('image_lib', $config);
                $this->image_lib->initialize($config);
                
                if (! $this->image_lib->resize()) 
                {
                    echo $this->image_lib->display_errors();die();
                }
                
                $this->image_lib->clear();
                // image manipulation resizing 2
                $config['source_image'] = './assets/temp/' . $image['file_name'];
                $config['new_image'] = './assets/uploads/gallery/thumb/';
                $config['file_name'] =  $rand_number . $timestamp;
                $config['maintain_ratio'] = TRUE;
//                 if ($image['image_width']>300)
//                     $config['width'] = 300;
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
                    $data['image'] = $image['file_name'];
                    $data['com_id']=$this->data['com_id'];
                    $data['title'] = $_POST['title'];
                    $depart= explode("|", $_POST['album_id']);
                    $data['album_id'] = $depart[0];
                    $data['album_name'] = $depart[1];
//                     print_r($data);die();
                    echo $this->gallery_mdl->add_data($data);
                }
            }
        }
        else echo validation_errors();
        // Upload code end
    }
   
    function view_data()
    {
        $where['com_id']=$this->data['com_id'];
        if (isset($_GET['id']))
	         $where['auto_id']=$_GET['id'];
        
        if (isset($_GET['data']))
	        $select=$_GET['data'];
	    else $select="*";
	    
        $return=$this->gallery_mdl->view_data($where,$select);
        $this->output->set_content_type('application/json')->set_output(json_encode($return->result_array()));
    }
    function delete_data()
    {
        if (isset($_GET['id']) && $_GET['id'])
        {
            
            $this->db->where('auto_id', $_GET['id']);
            foreach ($this->db->get("gallery")->result() as $row)
            {
                $image_delete_path1="./assets/uploads/gallery/$row->image";
                $image_delete_path2="./assets/uploads/gallery/thumb/$row->image";
            }
            unlink($image_delete_path1);
            unlink($image_delete_path2);
            $where['com_id']=$this->data['com_id'];
            $where['auto_id']=$_GET['id'];
            echo $this->gallery_mdl->delete_data($where);
        }else echo "Not Deleted";
    }
    function update_album_names($where,$name)
    {
        $data['album_name']=$name;
        return $this->gallery_mdl->update_data($where,$data);
    }
}