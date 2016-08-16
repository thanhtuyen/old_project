<?php
require_once 'ReadTrait.php';

Class Logic_area extends MY_Model{
    use ReadTrait;

    const DELETE_FLG_FALSE = 0;


    const PREF_ID_STATE = 0;

    /**
     * @var string table Name
     */
    public $table = 'area';


    public function __construct()
    {
        parent::__construct();
    }

    public function get_area($param){
        $query_param = array($param['pref_id'],$param['city_id'],$param['region_id'],$param['delete_flg']);
        $sql         = "SELECT * FROM `area`
                        WHERE `pref_id` IN  ?
                        AND `city_id` = ?
                        AND `region_id` = ?
                        AND `delete_flg` = ?   ";
        $query       = $this->db->query($sql, $query_param);
        $result      = $query->result_array();
        return $result;
    }

    /**
     * this sql like below
     * "SELECT `area_id` FROM `area`
     *  WHERE `pref_id` IN (13)
     *  AND `delete_flg` =0"
     * @param  [type] $params [description]
     * @return [type]         [description]
     */
    public function get_area_list($params){
        $delete_flg  = $params['delete_flg'];
        unset($params['delete_flg']);
        $where       = unite_where_in($params);

        if($where != ""){
            $sql         = "SELECT `area_id`,`name` FROM `area`
                        WHERE ";
            $sql        .= $where;
            if(!is_null($delete_flg)){
                $sql        .= "\nAND `delete_flg` =".$delete_flg;
            }
        }else{
            $sql         = "SELECT `area_id`,`name` FROM `area`
                        WHERE `delete_flg` =".$delete_flg;
        }

        $query       = $this->db->query($sql);

        $result      = $query->result_array();
        return $result;
    }
    public function get_list_pref_char($pref_name){

        $sql         = "SELECT `area_id`
                        FROM `area`
                        WHERE `pref_id` = (
                            SELECT `pref_id`
                            FROM `area`
                            WHERE `romaji` LIKE '".$pref_name."'
                        AND `city_id` = 0
                        AND `region_id` != 0
                            )
                        AND `city_id` = 0
                        AND `region_id` != 0";

        $query       = $this->db->query($sql);
        $result      = $query->result_array();

        return $result;
    }
    public function get_pref_id_by_name($pref_name){
        $sql         = "SELECT `pref_id` FROM `area`
                        WHERE `name` = '".$pref_name."'
                        AND   `city_id` = 0
                        AND   `region_id` != 0
                        AND   `delete_flg` = 0";
        $query       = $this->db->query($sql);
        $result      = $query->row_array();
        return $result["pref_id"];
    }
    public function get_area_id_by_name($pref_id,$city_name){
        $sql         = "SELECT `area_id` FROM `area`
                        WHERE `name` = '".$city_name."'
                        AND   `pref_id` = ".$pref_id."
                        AND   `region_id` != 0
                        AND   `delete_flg` = 0";
        $query       = $this->db->query($sql);
        $result      = $query->row_array();
        return $result["area_id"];
    }
    public function get_pref_area_id_by_romaji($pref_name){
        $sql         = "SELECT `area_id` FROM `area`
                        WHERE `romaji` = '".$pref_name."'
                        AND   `city_id` = 0
                        AND   `region_id` != 0
                        AND   `delete_flg` = 0";
        $query       = $this->db->query($sql);
        $result      = $query->row_array();
        return $result["area_id"];
    }

    public function get_list_city_char($pref_name,$city_name){
        $sql         = "SELECT `area_id`
                        FROM `area`
                        WHERE `pref_id` = (
                            SELECT `pref_id`
                            FROM `area`
                            WHERE `romaji` LIKE '".$pref_name."'
                                AND `pref_id` !=0)
                        AND `city_id` = (
                            SELECT `city_id`
                            FROM `area`
                            WHERE `romaji` LIKE '".$city_name."')";
        $query       = $this->db->query($sql);
        $result      = $query->result_array();
        return $result;
    }

    public function get_related_area_list($param){
        $sql         = "SELECT `area_id` FROM `area`
                        WHERE `".$param['target']."` = (SELECT `".$param['target']."`
                                           FROM   `area`
                                           WHERE  `area_id` = ".$param['id'].")";
        $query       = $this->db->query($sql);
        $result      = $query->result_array();
        return $result;
    }
    public function get_related_region_list($id){
        $sql         = "SELECT `area_id` FROM `area`
                        WHERE `region_id` = (SELECT `region_id`
                                           FROM   `area`
                                           WHERE  `area_id` = ".$id.")
                        AND `pref_id` != 0
                        AND `city_id`  = 0";
        $query       = $this->db->query($sql);
        $result      = $query->result_array();
        return $result;
    }
    public function get_related_pref_list($id){
        $sql         = "SELECT `area_id` FROM `area`
                        WHERE `pref_id` = (SELECT `pref_id`
                                           FROM   `area`
                                           WHERE  `area_id` = ".$id.")
                        AND `pref_id` != 0
                        AND `city_id` != 0";
        $query       = $this->db->query($sql);
        $result      = $query->result_array();
        return $result;
    }
    public function get_pref(){
        return $this->db->query("SELECT area_id,name,pref_id,romaji FROM `area`
                                 WHERE `pref_id` != 0
                                 AND `city_id` = 0
                                 AND `delete_flg` = 0 ")->result_array();
    }

    public function get_city(){
        return $this->db->query("SELECT area_id,name,pref_id,city_id,romaji FROM `area`
                                 WHERE `pref_id` != 0
                                 AND `city_id` != 0
                                 AND `region_id` != 0
                                 AND `delete_flg` = 0 ")->result_array();
    }


    public function get_city_by_pref($pref_id){
        return $this->db->query("SELECT area_id,name,pref_id,city_id FROM `area`
                                 WHERE `pref_id` = ".$pref_id."
                                 AND `city_id` != 0
                                 AND `region_id` != 0
                                 AND `delete_flg` = 0 ")->result_array();
    }

    /*
    param['area_id'] -> area_id
    return: array
    meaning get area detail
    */
    public function get_detail($param){
        $tag_id = $param['area_id'];
        $delete_flg = $param['delete_flg'];
        $query_param = array($tag_id,$delete_flg);
        $sql = "SELECT * FROM `area`
                WHERE `area_id` = ?
                AND `delete_flg` = ?";
        $query = $this->db->query($sql, $query_param);
        $result      = $query->result_array();
        return $result;
    }

    public function get_pref_detail($param){
        $pref_id = $param['pref_id'];
        $delete_flg = $param['delete_flg'];
        $query_param = array($pref_id,$delete_flg);
        $sql = "SELECT * FROM `area`
                WHERE `pref_id` = ?
                AND `delete_flg` = ?";
        $query = $this->db->query($sql, $query_param);
        $result      = $query->result_array();
        return $result;
    }

    public function get_pref_by_id($pref_id){
        $sql = "SELECT * FROM `area`
                WHERE `pref_id` = {$pref_id}
                AND `city_id` = 0
                AND `delete_flg` = 0";
        $query = $this->db->query($sql);
        $result      = $query->result_array();
        return $result;
    }
    /*
    param['id'] -> user_job_nursery_id
    return: array
    meaning get  relation array
    */
    public function get_relation_list($param){
        $client_id   = $param['client_id'];
        $delete_flg  = $param['delete_flg'];
        $query_param = array($client_id,$delete_flg);
        $sql         = "SELECT * FROM `client_area_relation`
                        WHERE `client_id` = ?
                        AND `delete_flg` = ?";
        $query       = $this->db->query($sql, $query_param);
        $result      = $query->result_array();
        return $result;
    }

    public function delete_client_area($client_id, $deleted_flg){
        $sql = "UPDATE client_area_relation
        SET `delete_flg`=".$deleted_flg.
            " WHERE `client_id`=".$client_id;
        return $query = $this->db->query($sql);
    }

    public function regist_client_area($params){
        $inserts = "";
        foreach($params["area_ids"][0] as $key => $area){
            $inserts .= "(".$area.",".$params["account_id"].",".$params["delete_flg"]."),";
        }

        $sql = "INSERT INTO `client_area_relation` (`area_id`,`client_id`,`delete_flg`) VALUES ".rtrim($inserts,",");

        return $this->db->query($sql);
    }

    /**
     * Get full area (state, province, city)
     * @param int $area_id
     * @return false/array
     */
    public function full_area($params){
        $data = false;

        $sql1  = "SELECT `c`.`name` AS cname, `p`.`name` AS pname, `c`.`city_id` AS city_id, `c`.`romaji` AS c_romaji, `p`.`romaji` AS p_romaji ".
            "FROM `area` `c` " .
            "INNER JOIN `area` `p`
            ON `c`.`region_id` = `p`.`area_id`
            WHERE `c`.`area_id` = ?
                AND `c`.`delete_flg` = ? ";

        $query1 = $this->db->query($sql1, $params);
        $result1      = $query1->result_array();

        $area_id = $params['area_id'];
        $sql2 = "SELECT `name` AS prefname, `romaji` AS pref_romaji, `pref_id` AS pref_id FROM `area` WHERE `city_id` = 0 AND `pref_id` in (SELECT `pref_id` FROM `area` WHERE `area_id` = ?) AND `delete_flg` = ?";
        $query2 = $this->db->query($sql2, $params);
        $result2      = $query2->result_array();
        if(isset($result1[0]) && isset($result2[0])){
            $result1[0]['prefname'] = $result2[0]['prefname'];
            $result1[0]['pref_id'] = $result2[0]['pref_id'];
            $result1[0]['pref_romaji'] = $result2[0]['pref_romaji'];
            $data = $result1[0];
        }
        return $data;
    }

    public function get_kana_name($str){

        $sql = "SELECT `name` FROM `area`
                WHERE `romaji` LIKE '".$str."'
                AND `delete_flg` = 0 ";
        $result = $this->db->query($sql)->result_array();
        return $result;
    }
    public function get_pref_name($pref_id){

        if(is_array($pref_id)){
            $pref_id_string_list = implode(",",$pref_id);
        }else{
            $pref_id_string_list = $pref_id;
        }

        $sql = "SELECT `name` FROM `area`
                WHERE `pref_id` IN(".$pref_id_string_list.")
                AND `city_id` = 0
                AND `region_id` != 0
                AND `delete_flg` = 0 ";

        return $this->db->query($sql)->result_array();
    }

    public function get_city_name($area_id){

        if(is_array($area_id)){
            $area_id_string_list = implode(",",$area_id);
        }else{
            $area_id_string_list = $area_id;
        }

        $sql = "SELECT `name` FROM `area`
                WHERE `area_id` IN(".$area_id_string_list.")
                AND `delete_flg` = 0 ";

        return $this->db->query($sql)->result_array();
    }
    /**
     * get one area according to pref and city
     * @return array
     */
    public function get_area_by_pref_and_city($param){
        $query_param = array($param['pref_id'],$param['city_id'],$param['delete_flg']);
        $sql         = "SELECT * FROM `area`
                        WHERE `pref_id` = ?
                        AND `city_id` = ?
                        AND `delete_flg` = ?   ";
        $query       = $this->db->query($sql, $query_param);

        $result      = $query->row_array();
        return $result;
    }

    /**
     * [get province ]
     * @param  [array] $param
     * @return array
     */
    public function get_province($param)
    {
        $sql = <<<SQL
        SELECT `area_id`,`name`
        FROM `area`
        WHERE `pref_id` = 0
        AND `delete_flg` = ?
SQL;

        return $this->db->query($sql, array($param['delete_flg']))->result_array();

    }


    /**
     * TUYENNT
     * get pref_id by romaji
     * @param $romaji
     */
    public function get_pref_id_by_romaji($romaji)
    {
        $sql = "SELECT pref_id FROM `area` WHERE `romaji` LIKE '{$romaji}'  and delete_flg = 0 and pref_id != 0 and city_id = 0";
        $query       = $this->db->query($sql);
        $result      = $query->row();
        return $result;
    }

    /**
     * TUYENNT
     * get pref_name by line_id
     * @param $pref_id
     * @return mixed
     */
    public function get_pref_name_by_line_id($pref_id)
    {
        $sql = "SELECT romaji
                FROM area
                WHERE pref_id = {$pref_id} AND delete_flg = 0 AND city_id = 0 AND pref_id != 0 ";
        $query       = $this->db->query($sql);
        $result      = $query->result_array();
        return $result;
    }

    public function get_related_area($pref_id){
        $sql = "SELECT `area_id`,`name`,`romaji`,`pref_id`
                FROM `area` 
                WHERE `city_id` = 0 
                AND `region_id` = (
                    SELECT `region_id`
                    FROM `area` 
                    WHERE `pref_id` = $pref_id
                    AND `city_id` = 0
                    ORDER BY `area_id` ASC
                    )
                ";
        $query       = $this->db->query($sql);
        $result      = $query->result_array();
        return $result;
    }

}
?>
