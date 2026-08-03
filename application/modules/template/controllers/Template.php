<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Template extends MX_Controller 
{   
    
    function __construct(){
        parent::__construct();
        
    }
    public function layout1($data=array())
	{
        $data=array_merge($this->comp,$data);
	    $this->load->view('header',$data);
		$this->load->view('navigation');
		$this->load->view('slider');
		$this->load->view('body');
		$this->load->view('footer',$data);
	}

	public function layout2($data)
	{
	    $data=array_merge($this->comp,$data);
		$this->load->view('header',$data);
		$this->load->view('navigation');
 		$this->load->view('body');
		$this->load->view('footer',$data);
	}
	public function layout3($data)
	{
		$data=array_merge($this->comp,$data);
		$this->load->view('header_error',$data);
		$this->load->view('navigation');
		$this->load->view('body');
		$this->load->view('footer',$data);
	}
	
}