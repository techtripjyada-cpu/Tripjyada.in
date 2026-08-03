<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Packages_mdl extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Get all packages, optionally filtered by category slug
    public function get_packages($category_slug = '')
    {
        if ($category_slug) {
            $this->db->where('category_slug', $category_slug);
        }
        $this->db->where('status', 1);
        $this->db->order_by('sort_order', 'asc');
        $this->db->order_by('p_id', 'desc');
        return $this->db->get('packages')->result_array();
    }

    // Get a single package by its slug
    public function get_package($slug, $category_slug = '')
    {
        $this->db->where('slug', $slug);
        if ($category_slug) {
            $this->db->where('category_slug', $category_slug);
        }
        $this->db->where('status', 1);
        return $this->db->get('packages')->row_array();
    }

    // Get all categories from categories table (with package count)
    public function get_categories()
    {
        if ($this->db->table_exists('categories')) {
            $this->db->select('c.cat_id, c.name, c.slug, COUNT(p.p_id) as pkg_count', FALSE);
            $this->db->from('categories c');
            $this->db->join('packages p', 'p.category_slug = c.slug AND p.status = 1', 'left');
            $this->db->group_by('c.cat_id');
            $this->db->order_by('c.sort_order', 'asc');
            return $this->db->get()->result_array();
        }
        // Fallback: derive from packages table
        $this->db->select('category_slug as slug, category_slug as name, COUNT(*) as pkg_count', FALSE);
        $this->db->where('status', 1);
        $this->db->group_by('category_slug');
        $this->db->order_by('category_slug', 'asc');
        return $this->db->get('packages')->result_array();
    }

    // Get total count of active packages
    public function get_total_count()
    {
        $this->db->where('status', 1);
        return $this->db->count_all_results('packages');
    }

    public function get_cardpage_tabs($page_slug = 'all')
    {
        if (!$this->db->table_exists('cardpage_tabs')) return array();
        return $this->db->where('page_slug', $page_slug)->where('active', 1)
            ->order_by('sort_order', 'asc')->order_by('id', 'asc')
            ->get('cardpage_tabs')->result_array();
    }

    public function get_cardpage_desc($page_slug = 'all')
    {
        if (!$this->db->table_exists('cardpage_desc')) return array();
        $row = $this->db->where('page_slug', $page_slug)->where('active', 1)
            ->get('cardpage_desc')->row_array();
        return $row ?: array();
    }
}
