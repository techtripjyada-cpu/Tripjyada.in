<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_offers extends CI_Model
{
    private $table;

    function __construct()
    {
        parent::__construct();
        $this->table = "offers";
        $this->_ensure_columns();
    }

    private function _ensure_columns()
    {
        if (!$this->db->table_exists($this->table)) {
            $this->db->query("
                CREATE TABLE `offers` (
                    `id`               INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                    `title`            VARCHAR(255) NOT NULL DEFAULT '',
                    `code`             VARCHAR(50)  NOT NULL DEFAULT '',
                    `discount_percent` TINYINT(3)   UNSIGNED NOT NULL DEFAULT 0,
                    `package_ids`      TEXT         NULL,
                    `date`             DATE         NULL,
                    `end_date`         DATE         NULL,
                    `details`          TEXT         NULL,
                    `image`            VARCHAR(255) NULL,
                    `status`           TINYINT(1)   NOT NULL DEFAULT 1,
                    PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8
            ");
            return;
        }

        $cols = array(
            'code'             => "ALTER TABLE `offers` ADD COLUMN `code` VARCHAR(50) NOT NULL DEFAULT ''",
            'discount_percent' => "ALTER TABLE `offers` ADD COLUMN `discount_percent` TINYINT(3) UNSIGNED NOT NULL DEFAULT 0",
            'package_ids'      => "ALTER TABLE `offers` ADD COLUMN `package_ids` TEXT NULL",
        );
        foreach ($cols as $col => $sql) {
            if (!$this->db->field_exists($col, $this->table)) {
                $this->db->query($sql);
            }
        }

        // Repair any end_dates that were saved in a wrong format (stored as 0000-00-00 or 1970-xx-xx)
        $this->db->query("UPDATE `offers` SET `end_date` = NULL WHERE `end_date` IS NOT NULL AND `end_date` < '2020-01-01'");
    }
    function view_data($where=null,$select)
    {
        $this->db->select($select);
        if($where)
            $this->db->where($where);
        $this->db->order_by('id',"desc");
//         $this->db->join('pages','page_id','left');
//         $this->db->join('menu','offers.menu=menu.menu_id','left');
        return $this->db->get( $this->table);
    }
    function add_data($data)
    {
//         print_r($_FILES);die();
        $a=$this->db->insert($this->table,$data);

        echo $this->db->affected_rows($a);
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