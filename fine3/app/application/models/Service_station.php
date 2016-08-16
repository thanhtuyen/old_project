<?php
Class Service_station extends MY_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Logic_station');
    }


    /**
     * ThinhNH
     * get station lonlat by station ID
     * @param $station_id
     * @return mixed
     */
    public function get_lonlat($station_id){
        $param = array(
            'station_id' => $station_id,
            'delete_flg' =>0,
            'select' => 'station_id,lon,lat'
        );
        $station = $this->Logic_station->get_detail($param);
        return $station;
    }

    public function get_detail($station_id){
        $param = array(
            'station_id' => $station_id,
            'delete_flg' =>0,
            'select' => 'station_id, line_id, station_cd, station_name, city_id, lon, lat'
        );
        $station = $this->Logic_station->get_detail($param);
        return $station;
    }

    /**
     * ThinhNH
     * Get station list near point
     * @param $lon
     * @param $lat
     * @param $radius
     */
    public function get_station_list_near_point($lon, $lat, $radius ){
        return $this->Logic_station->get_station_list_near_point($lon,$lat,$radius);
    }


    /**
     * ThinhNH
     * Get list stations by line id array
     * with full line information
     * @param $line_id_array
     * @param bool $pref_id $pref_id default false. To get station by line and in prefecture
     * @return mixed
     */
    public function get_list_line_by_many_line_id($line_id_array, $pref_id = false){
        if (count($line_id_array)==0) return false;
        $list_lines = $this->Logic_line->get_list_line_by_many_line_id($line_id_array);
        if (count($list_lines )>0){
            foreach($list_lines as &$line){
                $list_stations = $this->Logic_station->get_list_station_count_jobs_by_line_id($line['line_id'], $pref_id);
                $line['stations'] = $list_stations;
            }
        }
        return $list_lines;
    }

    public function get_station_list_by_id_array($id_array){
        if (count($id_array)==0) return false;
        return $this->Logic_station->get_station_list_by_id_array($id_array);
    }
}

