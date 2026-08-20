<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_contact extends CI_Model
{
    private $table;
    
    function __construct()
    {
        parent::__construct();
        $this->table = "contacts";
        
    }
    function view_data($where=null,$select="*")
    {
        $this->db->select($select);
        if($where)
            $this->db->where($where);
        $this->db->order_by('id',"desc");
        return $this->db->get( $this->table);
    }
    function view_book($where=null,$select="*",$search=null,$date_from=null,$date_to=null)
    {
    	$this->db->select($select);
    	if($where)
    		$this->db->where($where);
        if ($date_from)
        {
            $this->db->where('DATE(timestamp) >=', $date_from);
        }
        if ($date_to)
        {
            $this->db->where('DATE(timestamp) <=', $date_to);
        }
        if ($search !== null && $search !== '')
        {
            $this->db->group_start();
            $this->db->like('name', $search);
            $this->db->or_like('email', $search);
            $this->db->or_like('phone', $search);
            $this->db->or_like('mfrom', $search);
            $this->db->or_like('mto', $search);
            $this->db->or_like('msg', $search);
            $this->db->or_like('category', $search);
            $this->db->or_like('transportation', $search);
            $this->db->or_like('configuration', $search);
            $this->db->or_like('timestamp', $search);
            $this->db->group_end();
        }
    	$this->db->order_by('id','desc');
    	return $this->db->get("bookings");
    }
    function view_booking_row($where)
    {
        $this->db->where($where);
        return $this->db->get("bookings");
    }
    function delete_booking($where)
    {
        $this->db->where($where);
        $a=$this->db->delete("bookings");
        return $this->db->affected_rows($a);
    }
    function add_data($data)
    {
        $a=$this->db->insert($this->table,$data);
        return $this->db->affected_rows($a);
    }
    function update_data($where,$data)
    {
        $this->db->where($where);
        $a=$this->db->update($this->table,$data);
        return $this->db->affected_rows($a);
    }
    function delete_data($where)
    {
        $this->db->where($where);
        $a=$this->db->delete($this->table);
        return $this->db->affected_rows($a);
    }
    
}
?>
