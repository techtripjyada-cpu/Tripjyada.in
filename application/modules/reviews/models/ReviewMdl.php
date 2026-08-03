<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReviewMdl extends CI_Model
{
    //ADD REVIEWS
    public function insert_reviews($data)
    {
        return $this->db->insert('reviews', $data);
    }
    
}