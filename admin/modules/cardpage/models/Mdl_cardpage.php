<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_cardpage extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->_ensure_tables();
    }

    private function _ensure_tables()
    {
        if (!$this->db->table_exists('cardpage_tabs')) {
            $this->db->query("CREATE TABLE `cardpage_tabs` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `page_slug` VARCHAR(100) NOT NULL DEFAULT 'all',
                `days_label` VARCHAR(50) NOT NULL DEFAULT '',
                `tab_title` VARCHAR(200) NOT NULL DEFAULT '',
                `hero_image` VARCHAR(255) NULL DEFAULT NULL,
                `itinerary_heading` VARCHAR(200) NULL DEFAULT NULL,
                `itinerary_subheading` VARCHAR(200) NULL DEFAULT NULL,
                `day_data` TEXT NULL DEFAULT NULL,
                `sort_order` INT(11) NOT NULL DEFAULT 0,
                `active` TINYINT(1) NOT NULL DEFAULT 1,
                `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                KEY `idx_page_slug` (`page_slug`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        }
        if (!$this->db->table_exists('cardpage_desc')) {
            $this->db->query("CREATE TABLE `cardpage_desc` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `page_slug` VARCHAR(100) NOT NULL DEFAULT 'all',
                `heading` VARCHAR(200) NULL DEFAULT NULL,
                `body` TEXT NULL DEFAULT NULL,
                `active` TINYINT(1) NOT NULL DEFAULT 1,
                `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                UNIQUE KEY `uniq_page_slug` (`page_slug`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        }
    }

    function get_tabs($slug = 'all')
    {
        return $this->db->where('page_slug', $slug)
            ->order_by('sort_order', 'asc')->order_by('id', 'asc')
            ->get('cardpage_tabs')->result_array();
    }

    function save_tab(array $data, $id = 0)
    {
        if ($id) {
            $this->db->where('id', (int) $id)->update('cardpage_tabs', $data);
            return (int) $id;
        }
        $this->db->insert('cardpage_tabs', $data);
        return (int) $this->db->insert_id();
    }

    function delete_tab($id)
    {
        $this->db->where('id', (int) $id)->delete('cardpage_tabs');
    }

    function get_desc($slug = 'all')
    {
        return $this->db->where('page_slug', $slug)->get('cardpage_desc')->row_array() ?: array();
    }

    function save_desc($slug, array $data)
    {
        $existing = $this->get_desc($slug);
        if ($existing) {
            $this->db->where('page_slug', $slug)->update('cardpage_desc', $data);
        } else {
            $data['page_slug'] = $slug;
            $this->db->insert('cardpage_desc', $data);
        }
    }
}
