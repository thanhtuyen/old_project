<?php
require_once 'ReadTrait.php';
require_once 'CreateTrait.php';
require_once 'UpdateTrait.php';

class Logic_line extends MY_Model
{

    // use CreateTrait;

    // use ReadTrait;

    // use UpdateTrait;


    public $table = 'line';

    const DELETE_FLG_FALSE = 0;

    const DELETE_FLG = 1;

    const STATUS_PUBLIC = 0;

    const STATUS_PRIVATE = 1;


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
        $id      = $param['line_id'];
        $delete_flg  = $param['delete_flg'];
        $query_param = array($id,$delete_flg);
        $sql         = "SELECT {$select} FROM `{$this->table}`
                        WHERE `line_id` = ?
                        AND `delete_flg` = ?  ";
        $query       = $this->db->query($sql, $query_param);
        $result      = $query->result_array();
        return $result;
    }


    //TUYENNT
    /**
     * get list line by company_cd
     *
     * @param $company_cd
     * @return mixed
     */
    public function get_line_by_company_cd($company_cd)
    {
     $sql = "SELECT line_id, line_name_h
            FROM line
            WHERE company_cd = {$company_cd}";
        $query = $this->db->query($sql);
        $result = $query->result_array($query);
        return $result;

    }

    /**
     * get list company by pref_cd
     *
     * @param $pref_cd
     * @return array
     */
    //todo get_all_company_and_all_line_by_pref_cd
    public function get_all_company_and_all_line_by_pref_cd($pref_cd)
    {
        $sql = "SELECT DISTINCT l.line_id, l.line_name_h,l.company_cd,co.company_name
                FROM `station` as s
                LEFT JOIN line as l on l.line_id = s.line_id
                left join railway_company as co on co.company_cd = l.company_cd
                WHERE s.pref_cd = {$pref_cd}
                and l.delete_flg = 0 and s.delete_flg = 0 ORDER BY co.company_cd";

        $query = $this->db->query($sql);
        $result = $query->result_array($query);

        $companies = array();
        foreach($result as $row)
        {
            if (!isset($companies[$row['company_cd']] )){
                $company = array(
                    'company_cd'=> $row['company_cd'],
                    'company_name'=> $row['company_name'],
                    'lines'=> array()
                );
                $companies[$row['company_cd']] = $company;

            }
            $line = array(
                'line_id' => $row['line_id'],
                'line_name_h' => $row['line_name_h']
            );
            $companies[$row['company_cd']]['lines'][] = $line;
        }

        return  $companies;
    }

    /**
     * ThinhNH
     * Get list lines by line id array
     * with full line information
     * @param $line_id_array
     * @return mixed
     */
    public function get_list_line_by_many_line_id($line_id_array){
        $delete_flg = self::DELETE_FLG_FALSE;
        $line_id_str = implode(",", $line_id_array);
        $sql = "SELECT line.*
                FROM `line`
                WHERE line_id in ({$line_id_str}) and delete_flg = {$delete_flg} ";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    /**
     * TUYENNT
     * @param $station_id_array
     * @return mixed
     */
    //todo get_list_line_by_many_station
    public function get_list_line_by_many_station($station_id_array)
    {
        $station_id_str  = implode(",", $station_id_array);
        $delete_flg = self::DELETE_FLG_FALSE;
        $sql = "SELECT DISTINCT s.line_id
                FROM  station as s
                LEFT JOIN `line` as l on l.line_id = s.line_id
                WHERE s.station_id in ({$station_id_str}) and s.delete_flg = {$delete_flg} and l.delete_flg = {$delete_flg} ";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        foreach($result as $row) {
            $line_array[] = $row['line_id'];
        }
        $line_id_str = implode(",", $line_array);

        return $line_id_str;
    }

    /**
     * get pref_id by line_id
     * @param $line_id
     * @return mixed
     */
    public function get_pref_id_by_line_id($line_id)
    {
        $delete_flg = self::DELETE_FLG_FALSE;
        $sql = "SELECT default_pref_id
                FROM line
                WHERE line_id={$line_id} AND delete_flg = {$delete_flg}";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
}
?>
