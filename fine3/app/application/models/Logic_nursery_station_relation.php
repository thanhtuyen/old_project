<?php
require_once 'ReadTrait.php';

Class Logic_nursery_station_relation extends MY_Model{

    use ReadTrait;

    const STATUS_PUBLIC = 0;

    const DELETE_FLG_FALSE = 0;

    /**
     * @var string table Name
     */
    public $table = 'nursery_station_relation';


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * delete nursery_station_relation
     * @param $nursery_id
     * @param $station_id
     * @return mixed
     */
    public function delete_nearest_relation($nursery_id, $station_id)
    {
        $sql = "UPDATE `nursery_station_relation` SET `delete_flg` = 1
                WHERE nursery_id = $nursery_id AND station_id = $station_id";
        return $this->db->query($sql);
    }

    /**
     * ThinhNH
     * Delete all nearest stations of nursery
     * @param $nursery_id
     * @return mixed
     */
    public function delete_all_nearest_station_by_nursery_id($nursery_id){
        $sql = "UPDATE `nursery_station_relation` SET `delete_flg` = 1
                WHERE nursery_id = $nursery_id ";
        return $this->db->query($sql);
    }

    /**
     * ThinhNH
     * Update nearest record
     * Don't change columns nursery_id and station_id
     * @param $nearest_id
     * @param $data
     * @return mixed
     */
    public function update_nearest_flag_relation($nearest_id, $data)
    {
        $main_flg = $data['main_flg'];
        $display_flg = $data['display_flg'];
        $delete_flg = $data['delete_flg'];

        $sql = "UPDATE `nursery_station_relation` SET `delete_flg` = {$delete_flg}, `main_flg` = {$main_flg}, `display_flg` = {$display_flg}
                WHERE nearest_id = $nearest_id ";
        return $this->db->query($sql);
    }

    /**
     * Updated by ThinhNH
     * Change station_ids to array of station object
     * Reason: can't set value to main_flg and display_flg
     *
     * TuyenNT
     * insert data table nursery_station_relation
     * @param $params
     * @return mixed
     */
    public function regist_nursery_station_relation($params)
    {
        $inserts = "";
        foreach($params["stations"] as $station){
            $main_flg = isset($station['main_flg'])?$station['main_flg']:self::DELETE_FLG_FALSE;
            $display_flg = isset($station['display_flg'])?$station['display_flg']:self::DELETE_FLG_FALSE;
            $delete_flg = isset($station['delete_flg'])?$station['delete_flg']:self::DELETE_FLG_FALSE;
            $inserts .= "(".$params["nursery_id"].",".$station['station_id'].", ".$main_flg.",".$display_flg.",".$delete_flg."),";
        }

        $sql = "INSERT INTO `nursery_station_relation` (nursery_id, station_id, main_flg, display_flg, delete_flg) VALUES ".rtrim($inserts,",");
        return $this->db->query($sql);
    }

    /* Author: ThinhNH
    * Get nursery id by line id
    * @param $line_id
    * @return mixed array of nursery id
    */
    public function get_nursery_id_list_by_line_id($line_id)
    {
        $sql = "SELECT n.* FROM `{$this->table}` nr
                left join station ts on ts.station_id = nr.station_id
                left join nursery n on n.nursery_id = nr.nursery_id
                WHERE ts.line_id = {$line_id}
                AND ts.delete_flg = 0 AND nr.delete_flg = 0";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    /**
     * ThinhNH
     * Get nursery and station relation
     * @param $nursery_id
     * @param $station_id
     * @return mixed
     */
    public function get_relation($nursery_id, $station_id){
        $sql = "SELECT * FROM `nursery_station_relation` nr
                WHERE nr.station_id = {$station_id}
                AND nr.nursery_id = {$nursery_id}";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result;
    }

    /**
     * Author: ThinhNH
     * Get nursery id list by station id
     * @param $station_id
     * @return mixed array of nursery id
     */
    public function get_nursery_id_list_by_station_id($station_id)
    {
        $sql = "SELECT n.* FROM `nursery_station_relation` nr
                left join nursery n on n.nursery_id = nr.nursery_id
                WHERE nr.station_id = {$station_id}
                AND nr.delete_flg = 0";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    /**
     * get station_id and line_id by nursery_id
     * author Tuyennt
     * @param $nursery_id
     * @return mixed
     */

    public function get_station_and_line_by_nursery_id($nursery_id)
    {
        $delete_flg = self::DELETE_FLG_FALSE;
        $sql = "SELECT s.station_id, nr.nursery_id, s.line_id
                FROM nursery_station_relation as nr, station as s
                WHERE nr.station_id = s.station_id  AND nr.nursery_id = {$nursery_id} AND nr.delete_flg = {$delete_flg } AND station.e_status = {$delete_flg}";
        $result = $this->db->query($sql)->result_array();
        return  $result;
    }

    /**
     * Updated by ThinhNH
     * Added $order_by_main_flg (default = false)
     * Order by main flag to make a task get main station in a list to more faster
     * If the first item is not a main station so there are not any main station in the list
     * @param $nursery_id
     * @param bool $order_by_main_flg
     * @return mixed
     */
    public function get_list_station_by_nursery_id($nursery_id, $order_by_main_flg = false, $params = false)
    {
        $delete_flg = self::DELETE_FLG_FALSE;
        $sql = "SELECT  s.station_id, s.station_name,ns.display_flg, ns.main_flg, l.line_name_h
                FROM nursery_station_relation as ns
                LEFT JOIN station as s on ns.station_id = s.station_id
                LEFT JOIN line as l on s.line_id = l.line_id
                WHERE ns.nursery_id = {$nursery_id} AND ns.delete_flg = {$delete_flg} AND s.delete_flg = {$delete_flg}";
        if (isset($params['display_flg'])){
            $sql .= " AND ns.display_flg = {$params['display_flg']} ";
        }
        if ($order_by_main_flg) {
            $sql .= " ORDER BY main_flg desc";
        }

        $result = $this->db->query($sql)->result_array();
        return  $result;
    }

    /**
     * ThinhNH get main station near nursery 
     * @param $nursery_id
     * @return mixed
     */
    public function get_main_station_by_nursery_id($nursery_id){
        $delete_flg = self::DELETE_FLG_FALSE;
        $sql = "SELECT  s.station_id, s.station_name,ns.display_flg, ns.main_flg, l.line_name_h
                FROM nursery_station_relation as ns
                LEFT JOIN station as s on ns.station_id = s.station_id
                LEFT JOIN line as l on s.line_id = l.line_id
                WHERE ns.nursery_id = {$nursery_id} AND ns.delete_flg = {$delete_flg} AND s.delete_flg = {$delete_flg}
                AND ns.display_flg = 1 AND ns.main_flg = 1 ";
        return $this->db->query($sql)->row_array();

    }

}
?>