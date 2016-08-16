<?php
Class Logic_column extends MY_Model{
    public function __construct()
    {
        parent::__construct();
    }


    public function get_category(){
        $sql = "SELECT * FROM `wp_terms`
                LEFT JOIN `wp_term_taxonomy` 
                ON `wp_terms`.`term_id`=`wp_term_taxonomy`.`term_id`
                WHERE `wp_term_taxonomy`.`count`>0";
        $query = $this->db->query($sql);
        $result = $query->result_array();

        return $result;
    }
}