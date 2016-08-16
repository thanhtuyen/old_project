<?php

Class Logic_token extends MY_Model{

    public function __construct(){
        parent::__construct();
    }

    public function insert_token($params){

        $sql = "INSERT INTO token (".implode(', ',array_keys($params)).") VALUES ? ;";
        $result = $this->db->query($sql, array($params));
        return $result;
    }

    public function update_token($params){

        $value = "";
        foreach($params["value"] as $key1=>$val1){
            $value .=  "`".$key1."`='".$val1."',";
        }
        $where = "";
        foreach($params["where"] as $key2=>$val2){
            $where .=  " `".$key2."`='".$val2."' AND";
        }

        $sql = "UPDATE `token` SET ".rtrim($value,",")." WHERE " .rtrim($where,"AND");
        $result = $this->db->query($sql);

        return $result;
    }

    public function get_token_list($params){

        if(!empty($params["select"])){
            $select = "";
            foreach($params["select"] as $column)$select .= '`'. $column .'`,';
            $select = rtrim($select,",");
        }else{
            $select = "*";
        }

        $where = "";
        if(!empty($params["where"])){
            foreach($params["where"] as $key => $val)$where .= ' `'. $key .'` = "'. $val .'" AND';
            $where = rtrim($where,"AND");
        }else{
            $where = 1;
        }

        $sql = 'SELECT '.$select.' FROM `token`
                WHERE '.$where;

        $query = $this->db->query($sql);

        return $query->result_array();

    }
}