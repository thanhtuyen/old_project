<?php
require_once 'ReadTrait.php';
require_once 'CreateTrait.php';
require_once 'UpdateTrait.php';

class Logic_station extends MY_Model
{

    // use CreateTrait;

    // use ReadTrait;

    // use UpdateTrait;


    public $table = 'station';

    const DELETE_FLG_FALSE = 0;

    const DELETE_FLG = 1;
    
    const DISPLAY_FLG_TRUE = 1;

    const STATUS_PUBLIC = 0;

    const STATUS_PRIVATE = 1;

    const EARTH_RADIUS = 6371;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * ThinhNH
     * Get station information by station_id
     * @param $param
     * @return mixed
     */
    public function get_detail($param){
        $select      = array_to_select_str($param['select']);
        $station_id      = $param['station_id'];
        $delete_flg  = $param['delete_flg'];
        $query_param = array($station_id,$delete_flg);
        $sql         = "SELECT {$select} FROM `{$this->table}`
                        WHERE `station_id` = ?
                        AND `delete_flg` = ?  ";
        $query       = $this->db->query($sql, $query_param);
        $result      = $query->result_array();
        return $result;
    }


    /**
     * ThinhNH
     * Get list stations near point with distance < $radius
     * @param $lon
     * @param $lat
     * @param $radius
     * @return mixed list of stations
     */
    public function get_station_list_near_point($lon, $lat, $radius){

        $query = sprintf("SELECT station.station_id, line.line_name_h, station.line_id, station.station_cd, station.station_name, station.city_id, station.lon, station.lat,
                    ( '%s' * acos( cos( radians('%s') ) * cos( radians( station.lat ) ) * cos( radians( station.lon ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( station.lat ) ) ) ) AS distance
                    FROM station
                    LEFT JOIN line ON line.line_id = station.line_id
                    WHERE station.delete_flg = 0 HAVING distance < '%s' ORDER BY distance",
            self::EARTH_RADIUS,
            $lat,
            $lon,
            $lat,
            $radius);
        $query           = $this->db->query($query);
        $result          = $query->result_array();
        return $result;
    }

    /**
     * Get the station is nearest the point
     * @param $lon
     * @param $lat
     * @return mixed a station
     */
    public function get_station_near_point($lon, $lat){

        $query = sprintf("SELECT station_id, line_id, station_cd, station_name, city_id, lon, lat,
                    ( '%s' * acos( cos( radians('%s') ) * cos( radians( lat ) ) * cos( radians( lon ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( lat ) ) ) ) AS distance
                    FROM station WHERE delete_flg = 0 ORDER BY distance LIMIT 1",
            self::EARTH_RADIUS,
            $lat,
            $lon,
            $lat);
        $query           = $this->db->query($query);
        $result          = $query->result_array();
        return $result;
    }

    /**
     * get all station_id by line_id
     * @param $line_id
     * @return mixed
     */
    public function get_list_station_by_line_id($line_id)
    {
        $delete_flg = self::DELETE_FLG_FALSE;
        $sql = "SELECT station_id, line_id, station_cd, station_name, city_id, lon, lat
                FROM `station`
                WHERE line_id = {$line_id} and delete_flg = {$delete_flg} AND e_status = {$delete_flg} ";


        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    /**
     * ThinhNH
     * Get list station with count total jobs of nursery (the nursery have main station is this station )
     * @param $line_id
     * @param bool $pref_id $pref_id default false. To get station by line and in prefecture
     * @return mixed
     */
    public function get_list_station_count_jobs_by_line_id($line_id, $pref_id = false)
    {
        $job_status     =  $this->config->item('public','job_config');
        $nursery_status =  $this->config->item('public','nursery_config');
        $now_date         = date('Y-m-d H:i:s');
        $delete_flg = self::DELETE_FLG_FALSE;
        $display_flg = self::DISPLAY_FLG_TRUE;
        $in_pref_sql = "";
        if ($pref_id){
            $in_pref_sql = " AND (s.pref_cd = $pref_id)";
        }
        $sql = "SELECT s.station_id, s.line_id, s.station_cd, s.station_name, s.city_id, s.lon, s.lat,
                    count( DISTINCT CASE WHEN j.expired > '".$now_date."'
                        AND nsr.delete_flg = {$delete_flg}
                        AND nsr.display_flg = {$display_flg}
                        AND nsr.main_flg = 1
                        AND j.status = {$job_status}
                        AND n.status = {$nursery_status}
                        AND j.delete_flg = {$delete_flg}
                        THEN job_id END) as total_job
                FROM `station` as s
                    LEFT JOIN  nursery_station_relation as nsr ON nsr.station_id = s.station_id
                    LEFT JOIN job as j ON j.nursery_id = nsr.nursery_id
                    LEFT JOIN nursery as n ON n.nursery_id = nsr.nursery_id
                WHERE
                    s.line_id = {$line_id}
                    AND s.delete_flg = {$delete_flg}
                    AND s.e_status = {$delete_flg}
                    {$in_pref_sql}
                GROUP BY s.station_id ORDER BY s.station_id ASC";

        $query = $this->db->query($sql);
        
        $result = $query->result_array();
        return $result;
    }


    /**
     * get line_id by station_id
     * @param $station_id
     * @return mixed
     */
    public function get_line_id_by_station_id($station_id) {
        $delete_flg = self::DELETE_FLG_FALSE;
        $sql = "SELECT  line_id
                FROM `station`
                WHERE station_id = {$station_id} AND delete_flg = {$delete_flg} AND e_status = {$delete_flg} ";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;

    }

    /**
     * get all line_id and station_id
     * @return mixed
     */
    public function get_all_line_and_all_station()
    {
        $delete_flg = self::DELETE_FLG_FALSE;
        $sql = "SELECT DISTINCT `line`.line_id, `line`.line_cd, `line`.line_name
                FROM  `station`
                LEFT join `line` on line.line_id = station.line_id
                WHERE  station.delete_flg = {$delete_flg} AND line.delete_flg = {$delete_flg}
                AND station.e_status = {$delete_flg} AND line.e_status = {$delete_flg}";

        $query = $this->db->query($sql);
        $result = $query->result_array();
        $line_array = array();
        $station_array = array('stations' =>'');

        foreach($result as $row) {

            $stations = $this->get_list_station_by_line_id($row['line_id']);
            $station_array['stations'] = $stations;
            $line_array[]= array_merge($row,$station_array);
        }
        return $line_array;
    }

    /**
     * get list line and station by pref_cd
     * @param $pref_cd
     * @return array
     */
    public function get_station_and_line_by_pref_cd($pref_cd)
    {
        $delete_flg = self::DELETE_FLG_FALSE;
        $sql = "SELECT DISTINCT l.line_id, l.line_name, l.line_cd
                FROM  `station` as s
                LEFT join `line` as l on l.line_id = s.line_id
                WHERE s.delete_flg = $delete_flg AND l.delete_flg = $delete_flg AND s.pref_cd = $pref_cd";

        $query = $this->db->query($sql);
        $result = $query->result_array();
        $pref_array = array();
        $station_array = array('stations' => '');
        foreach ($result as $row) {
            $stations = $this->get_list_station_by_line_id($row['line_id']);
            $station_array['stations'] = $stations;
            $pref_array[] = array_merge($row, $station_array);
        }
        return $pref_array;
    }

    /**
     * ThinhNH
     * Get list station by station id array
     * @param $id_array
     */
    //todo-thinh get_station_list_by_id_array($id_array)
    public function get_station_list_by_id_array($id_array){
        $station_id_str = implode(",", $id_array);
        $delete_flg = self::DELETE_FLG_FALSE;
        $sql = "SELECT *
                FROM  `station`
                WHERE delete_flg = $delete_flg AND station_id in ($station_id_str) ";

        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
?>
