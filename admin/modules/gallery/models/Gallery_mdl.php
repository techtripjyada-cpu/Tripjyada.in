<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gallery_mdl extends CI_Model
{
	private $table;
	
	function __construct()
	{
		parent::__construct();
		$this->table = "gallery";
	}
     function uploadData($url)
	{
	    echo "jscbkjcs"; die();
	    
	    $title = $this->input->post('title');
	    $details = $this->input->post('details');
	    $type = $this->input->post('gallery');
	    
	    $data = array(
	        'url'       => $url,
	        'title'     => $title,
	        'details'   => $details,
	        'category'  => $type
	    );
	    
	    $this->db->insert('gallery', $data);
	}
	function add_data($data)
	{
	   $a=$this->db->insert($this->table,$data);
	   return $this->db->affected_rows($a);
	}
	function view_data($where=null,$select)
	{
	    $this->db->select($select);
	    if($where)
	        $this->db->where($where);
	    $this->db->order_by('auto_id',"desc");
	    return $this->db->get( $this->table);
	}
	function update_data($where,$data)
	{
	    $this->db->where($where);
	    return $this->db->update($this->table,$data);//affected rows not needed in updating album names..it may occur multiple affected rows
// 	    return $this->db->affected_rows($a);
	}
	function delete_data($where)
	{
	    $this->db->where($where);
	    $a=$this->db->delete($this->table);
	    return $this->db->affected_rows($a);
	}
}	
	