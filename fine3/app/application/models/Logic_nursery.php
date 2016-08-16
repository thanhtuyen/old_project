<?php
require_once 'ReadTrait.php';

Class Logic_nursery extends MY_Model{
    use ReadTrait;
    const STATUS_PUBLIC = 0;

    const DELETE_FLG_FALSE = 0;

    /**
     * @var string table Name
     */
    public $table = 'nursery';

    public function __construct()
    {
        parent::__construct();
    }
    public function get_detail($param){

        $select      = array_to_select_str($param['select']);
        $nursery_id = $param['nursery_id'];
        $status     = $param['status'];
        $delete_flg = $param['delete_flg'];
        
        $sql = "SELECT ".$select." FROM `nursery`
                WHERE `nursery_id`  = ".$nursery_id."
                AND `status`        = ".$status."
                AND `delete_flg`    = ".$delete_flg;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    /**
     * get nursery count by conditions
     * @param  [array] $param
     * @return [int]
     */
    public function get_nursery_count($param)
    {
        $sql = "SELECT COUNT(*) AS num FROM `nursery`
                WHERE client_id = {$param['client_id']}
                AND delete_flg = {$param['delete_flg']}
                ";
        if($param['key_words']){
            $sql .= " AND name LIKE '%{$param['key_words']}%'";
        }
        if($param['start_time']){
            $sql .= " AND '{$param['start_time']}' < created";
        }
        if($param['end_time']){
            $sql .= " AND '{$param['end_time']}' > created";
        }
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result['num'];
    }

    /**
     * get nursery list by conditions
     * @param  [array] $param
     * @return [array]
     */
    public function get_nursery_list($param)
    {
        $sql = "SELECT * FROM `nursery`
                WHERE client_id = {$param['client_id']}
                AND delete_flg = {$param['delete_flg']}";
        if($param['key_words']){
            $sql .= " AND name LIKE '%{$param['key_words']}%'";
        }
        if($param['start_time']){
            $sql .= " AND '{$param['start_time']}' < created";
        }
        if($param['end_time']){
            $sql .= " AND '{$param['end_time']}' > created";
        }
        $sql .= " ORDER BY nursery_id DESC
                LIMIT {$param['start']}, {$param['page_size']}";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    /**
     * get all nursery's area_id list
     * @param  [array] $testdata(nursery_id)
     * @return [array]
     */
    public function get_all_nursery_address($testdata = null)
    {
        $sql = "SELECT nursery_id, area_id, address FROM `nursery` WHERE (lon = 0 OR lat = 0)";

        if(!empty($testdata)){
            $sql .= " AND (nursery_id = " . $testdata[0];
            $sql .= " OR nursery_id = " . $testdata[1] . ")";
        }
        //$sql .= " LIMIT 20";

        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    /**
     * get all nursery's lon lat list
     * @param  [array] $testdata(nursery_id)
     * @return [array]
     */
    public function get_all_nursery_lonlat($testdata = null)
    {
        $sql = "SELECT n.nursery_id, n.lon, n.lat FROM `nursery` as n 
                WHERE NOT EXISTS(SELECT nsr.nursery_id FROM `nursery_station_relation` as nsr WHERE nsr.nursery_id = n.nursery_id)";

        if(!empty($testdata)){
            $sql .= " AND (n.nursery_id = " . $testdata[0];
            $sql .= " OR n.nursery_id = " . $testdata[1];
            $sql .= ")";
        }
        //$sql .= " LIMIT 20";

        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    /**
     * insert nursery
     * @param [int] the new nursery's id
     */
    public function insert_nursery($data)
    {
        $sql = "INSERT INTO nursery(`client_id`, `name`, `name_furigana`, `own_nursery_id`,
            `area_id`, `address`, `station_name`, `direction`, `capacity`,
            `url`, `pr`,`description`, `status`, `lon`, `lat`, `walk_time`, `bus_time`, `created`, `updated`)
            VALUEs({$data['client_id']}, '{$data['name']}', '{$data['name_furigana']}', '{$data['own_nursery_id']}',
            {$data['area_id']}, '{$data['address']}', '{$data['station_name']}',
            '{$data['direction']}', {$data['capacity']}, '{$data['url']}',
            '{$data['pr']}','{$data['description']}',  {$data['status']}, '{$data['lon']}', '{$data['lat']}', 
            '{$data['walk_time']}','{$data['bus_time']}','{$data['created']}', '{$data['updated']}'
            )";

        $this->db->query($sql);
        return $this->db->insert_id();
    }

    /**
     * update nursery's geo(lon, lat)
     * @param [int]nursery_id, [array]lon, lat
     */
    public function update_geo_nursery($id, $data)
    {
        if(!empty($data))
        {
            $sql = "UPDATE nursery SET lon = {$data['lon']}, lat = {$data['lat']} WHERE nursery_id = {$id}";
            $this->db->query($sql);
        }
    }

    /**
     * get nursery by nursery_id
     * @return [array] nursery
     */
    public function get_nursery($nursery_id)
    {
        $sql = "SELECT * FROM nursery WHERE nursery_id = $nursery_id";
        return $this->db->query($sql)->row_array();
    }

    /**
     * update nursery
     */
    public function update_nursery($data)
    {
        $sql = "UPDATE nursery
                SET name=?, name_furigana=?, own_nursery_id=?, area_id=?,
                address=?, station_name=?, lon=?, lat=?, walk_time=?, bus_time=?, direction=?, capacity=?, url=?,
                pr=?,description=?, status=?, updated=?
                WHERE nursery_id=?";

        $params = array(
            $data['name'],  $data['name_furigana'], $data['own_nursery_id'], $data['area_id'], $data['address'],
            $data['station_name'], $data['lon'], $data['lat'], $data['walk_time'], $data['bus_time'], $data['direction'], $data['capacity'], $data['url'],
            $data['pr'],$data['description'], $data['status'], $data['updated'], $data['nursery_id']
        );
                
        $this->db->query($sql, $params);
    }

    /**
     * soft delete nursery, update delete_flg to deleted
     */
    public function delete($nursery_id)
    {
        $params = array(
            $this->config->item('deleted', 'common_config'),
            $nursery_id
        );
        $sql = "UPDATE nursery SET delete_flg=? WHERE nursery_id=?";
        $this->db->query($sql, $params);
    }

    /**
     * get nursery title, used for create job
     */
    public function get_exist_nursery($client_id, $delete_flg = 0)
    {
        $status = $this->config->item('public','nursery_config');
        $sql = "SELECT nursery_id,name FROM nursery
                WHERE client_id = $client_id 
                AND status = $status
                AND delete_flg = $delete_flg";
        return $this->db->query($sql)->result_array();
    }

    public function get_one_nursery($param)
    {
        $sql = "SELECT * FROM `nursery`
                WHERE client_id = {$param['client_id']}
                AND nursery_id = {$param['nursery_id']}
                AND delete_flg = {$param['delete_flg']}";
        return $this->db->query($sql)->row_array();
    }

    public function get_export_nursery($nursery_array)
    {
        $sql = "SELECT * FROM `nursery` WHERE nursery_id IN(";
        foreach ($nursery_array as $key => $value) {
            if($value){
                if($key == count($nursery_array) - 1){
                    $sql .= "$value";
                } else {
                    $sql .= "$value,";
                }
            }
        }

        $sql .= ')';
        $sql .= " ORDER BY nursery_id DESC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function get_furigana_list($character){
        $sql = "SELECT
                     nursery.nursery_id,nursery.name
                    FROM
                     nursery 
                    INNER JOIN client ON nursery.client_id = client.client_id AND client.account_type = 1
                    WHERE
                     name_furigana collate utf8_unicode_ci LIKE '".$character."%'
                     AND
                     nursery.status = 0
                     AND
                     client.status = 0
                     AND
                     nursery.delete_flg = 0
                     AND
                     client.delete_flg = 0
                    HAVING (
                        SELECT count(1)
                        FROM job
                        WHERE delete_flg = 0
                    ) > 0";
        $result =  $this->db->query($sql)->result_array();
        return $result;
    }

    /*    public function get_export_data()
        {
            $nursery = $this->config->item('nursery', 'client_config');
            $sql = <<<SQL
    SELECT  n.nursery_id AS nursery_id,
    n.own_nursery_id AS own_nursery_id,
    n.name AS name,
    n.address AS address,
    n.direction AS direction,
    n.url AS url,
    n.capacity AS capacity,
    n.station_name as station_name,
    n.pr AS pr ,
    n.status AS status,
    n.created AS created,
    n.updated AS updated,
    n.client_id AS client_id,
    c.name AS client_name,
    job.delete_flg AS delete_flg
    FROM nursery AS n
    LEFT JOIN  client AS c ON c.client_id = n.client_id
    LEFT JOIN area ON n.area_id = area.area_id
    LEFT JOIN job ON n.nursery_id = job.nursery_id
    WHERE account_type = $nursery
    SQL;
            $query = $this->db->query($sql);
            return $query->result_array();
        }*/

    //$param['nursery_id']==nursery.nursery_id, $param['furigana']==nursery.name_furigana, 
    //$param['updated']==date('Y-m-d H:i:s')
    public function update_furigana($param){
        if(isset($param['nursery_id']) && isset($param['furigana'])){
            $nursery_id = $param['nursery_id'];
            $furigana   = $param['furigana'];
            $updated    = $param['updated'];

            $sql = "UPDATE `nursery` SET `name_furigana` = '".$furigana."', `updated` = '".$updated."'  
                WHERE `nursery_id` = ".$nursery_id;
            $this->db->query($sql);
        }
    }


    /**
     * Get List nursery for furigana
     * @return array
     */
    public function get_list_nursery_for_furigana( $params ){
        $condition = " = '' ";
        if($params['name_furigana']){
            $condition = " != '' ";
        }
        
        $sql = "SELECT `n`.*, `c`.`name` AS `client_name` FROM `nursery` AS `n` ";
        $sql .= "INNER JOIN `client` AS `c` ";
        $sql .= "ON `c`.`client_id` = `n`.`client_id` ";
        $sql .= "WHERE TRIM(IFNULL(`n`.`name_furigana`, '')) $condition ";
        $sql .= "AND `c`.`status` = {$params['client_status']} ";
        $sql .= "AND `c`.`delete_flg` = {$params['client_delete_flg']} ";
        $sql .= "AND `n`.`status` = {$params['nursery_status']} ";
        $sql .= "AND `n`.`delete_flg` = {$params['nursery_delete_flg']} ";
        
        $sql .= "ORDER BY `n`.`updated` DESC ";
        $sql .= "LIMIT {$params['start']}, {$params['page_size']}";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }


    /**
     * Get nursery list nearest the point
     * @param $lon
     * @param $lat
     * @return mixed nurseries list
     */
    public function get_nursery_near_point($lon, $lat, $radius){

        $query = sprintf("SELECT *,
                    ( '%s' * acos( cos( radians('%s') ) * cos( radians( lat ) ) * cos( radians( lon ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( lat ) ) ) ) AS distance
                    FROM nursery WHERE delete_flg = 0 HAVING distance < '%s' ORDER BY distance asc",
            6371,
            $lat,
            $lon,
            $lat,
            $radius);
        $query           = $this->db->query($query);
        $result          = $query->result_array();
        return $result;
    }
    public function get_branch_mapdata($client_id){
        $sql = "SELECT
                     nursery_id,name,lat,lon
                    FROM
                     nursery 
                    WHERE
                    client_id = ".$client_id."
                    AND
                     status = 0
                     AND
                     delete_flg = 0";
        $result =  $this->db->query($sql)->result_array();
        return $result;
    }
    public function count_consonant($character){
        $sql = "SELECT COUNT(1) as count
                    FROM nursery
                    WHERE (nursery.delete_flg = 0
                    AND nursery.status = 0)
                    AND(
                    ";
        $i = false;
        foreach($character as $chr){
            if($i === false){
                $i  = true;
            }else{
                $sql .= " OR ";
            }
            $sql .= "nursery.name_furigana collate utf8_unicode_ci LIKE '".$chr['kana']."%' 
            ";
        }
        $sql .= ")";
        $result =  $this->db->query($sql)->row_array();
        return $result;
    }

    /**
     * Get Count nursery for furigana
     * @return array
     */
    public function get_nursery_count_for_furigana( $params )
    {
        $condition = " = '' ";
        if($params['name_furigana']){
            $condition = " != '' ";
        }
        
        $sql = "SELECT COUNT(*) AS `num` FROM `nursery` AS `n` ";
        $sql .= "INNER JOIN `client` AS `c` ";
        $sql .= "ON `c`.`client_id` = `n`.`client_id` ";
        $sql .= "WHERE TRIM(IFNULL(`n`.`name_furigana`, '')) $condition ";
        $sql .= "AND `c`.`status` = {$params['client_status']} ";
        $sql .= "AND `c`.`delete_flg` = {$params['client_delete_flg']} ";
        $sql .= "AND `n`.`status` = {$params['nursery_status']} ";
        $sql .= "AND `n`.`delete_flg` = {$params['nursery_delete_flg']} ";
        $sql .= "ORDER BY `n`.`updated` DESC";
        
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result['num'];
    }
}
?>
