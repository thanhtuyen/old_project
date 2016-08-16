<?php

class Logic_client extends MY_Model
{

    public function __construct()
    {
        parent::__construct();

        if (empty($this->db)) {
            $this->load->database();
        }
    }

    /**
     * TODO: this function does not work
     * this function has a role to get client detail.
     *
     * @param [type] $param
     *            is array .
     *            see service_client->get_detail.
     *            $param['select'] is array to get.;
     *            $param['client_id'] is int;
     *            $param['status'] is int;
     *            $param['delete_flg'] is int;
     * @return $result(array), or false
     */

    public function get_detail($param){
        $select      = array_to_select_str($param['select']);
        $client_id   = $param['client_id'];
        $status      = $param['status'];
        $delete_flg  = $param['delete_flg'];
        $sql = "SELECT ".$select." FROM `client`
                WHERE `client_id` = ".$client_id."
                AND `status`      = ".$status."
                AND `delete_flg`  = ".$delete_flg." ";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function get_client_name($client_id){
        $sql = "SELECT name FROM client
                WHERE client_id = ".$client_id;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    public function get_client_data($params){

        if(!empty($params["select"])){
            $select = "";
            foreach($params["select"] as $column){
                $select .= '`'. $column .'`,';
            }
            $select = rtrim($select,",");
        }else{
            $select = "*";
        }

        $where = "";
        if(!empty($params["where"])){
            foreach($params["where"] as $key => $val){
                $where .= ' `'. $key .'` = "'. $val .'" AND';
            }
            $where = rtrim($where,"AND");
        }

        $sql = 'SELECT '.$select.' FROM `client`
                WHERE '.$where;

        $query = $this->db->query($sql);

        return $query->result_array();
    }

    public function get_mailpass($params){
        return $this->db->query("SELECT client_id FROM `client`
                                 WHERE `mail` = '".$params["mail"]."'
                                 AND `password` = '".$params["password"]."'
                                 AND `status`  = 0
                                 AND `delete_flg`  = 0 ")->result_array();

    }


    /**
     * Get client row
     *
     * @param $param array
     * $param['client_id'];
     *  $param['status'];
     *  $param['delete_flg'];
     *  $param['select']
     * @return false/array
     */
    public function get($param){
        $select      = parseSelect($param['select']);

        $client_id   = $param['client_id'];
        $status      = $param['status'];
        $delete_flg  = $param['delete_flg'];
        $query_param = array($client_id,$status,$delete_flg);
        $sql = "SELECT $select FROM `client`
                    WHERE `client_id` = ?
                    AND `status`      = ?
                    AND `delete_flg`  = ? ";
            $query  = $this->db->query($sql, $query_param);
            $result = $query->result_array();
            if(! $result){
                return false;
            }
            return array_shift($result);
        }


    /**admin
     * [get client detail
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public function get_client_detail($param)
    {
        $client_id   = $param['client_id'];
        $status      = $param['status'];
        $delete_flg  = $param['delete_flg'];
        $query_param = array($client_id,$status,$delete_flg);
        $sql = <<<EOF
        SELECT * FROM `client`
        WHERE `client_id` = ?
        AND `status`  = ?
        AND `delete_flg`  = ?
EOF;
//         AND `status`      = ?
        return $this->db->query($sql, $query_param)->row_array();

    }
    /**admin
     * [save client]
     * @param  [array] $param
     * @return [bool]
     */
    public function save($param)
    {
        $fields = implode(',', array_map(function($k){
                return '`'. $k .'`';
            }, array_keys($param))
        );

        $query_param = array_values($param);
        $bind_str = rtrim(str_repeat('?, ', count($query_param)), ', ');

        $sql = <<<EOF
        INSERT INTO `client` ({$fields})
        VALUES ({$bind_str})
EOF;
        $this->db->query($sql, $query_param);
        return $this->db->insert_id();

    }

    /* update pr information
     * use in client side 登録情報の編集
     */
    public function update_pr($data){

    $sql = "UPDATE client
                SET `display_area_id`=?, `display_name`=?, `display_address`=?,
        `display_zip_code`=?, `establish_date`=?,`process`=?,
        `description`=?, `license_number`=?, `updated`=?
                WHERE `client_id`=?";

        $params = array(
            $data['display_area_id'], $data['display_name'], $data['display_address'],
            $data['display_zip_code'], $data['establish_date'], $data['process'],
        $data['description'], $data['license_number'], $data['updated'],
        $data['client_id']
        );
        $this->db->query($sql, $params);
    }

        /**
     * return client total count
     * @param  [array] $param
     * @return [int]
     */
    public function get_total_count($param)
    {

        if (empty($param['account_type'])) {
            return 0;
        }

        $account_type = $param['account_type'];
        $delete_flg = $param['delete_flg'];
        $query_param = array($delete_flg, $account_type);

        $sql = "SELECT count('*') AS total
            FROM `client`
            WHERE `client`.`delete_flg` = ".$delete_flg."
            AND `client`.`account_type` = ".$account_type." ";

        if (! empty($param['keyword'])) {
            $keyword = "%{$param['keyword']}%";
            $sql .= "AND `client`.`client_id` IN (
                                    (SELECT`client`.`client_id` FROM `client`
                                        JOIN `nursery` ON `nursery`.`client_id` = `client`.`client_id`
                                            WHERE CAST(`client`.`client_id` AS CHAR ) LIKE '".$keyword."'
                                            OR `client`.`name` collate utf8_unicode_ci LIKE '".$keyword."'
                                            OR `client`.`display_name` collate utf8_unicode_ci LIKE '".$keyword."'
                                            OR `client`.`contact_name` collate utf8_unicode_ci LIKE '".$keyword."'
                                            OR `client`.`mail` collate utf8_unicode_ci LIKE '".$keyword."'
                                            OR `client`.`phone` collate utf8_unicode_ci LIKE '".$keyword."'
                                            OR `nursery`.`name` collate utf8_unicode_ci LIKE '".$keyword."')
                                )";

        }



        $query = $this->db->query($sql);

        return $query->row_array()['total'];
    }


    /**admin
     * [get client list]
     * @param  [array] $param
     * @return [array]
     */
    public function get_list($param)
    {

        $delete_flg = $param['delete_flg'];
        $account_type = $param['account_type'];
        $query_param = array($delete_flg, $account_type);

        $select = '`client`.`client_id`, `client`.`name`, `client`.`display_name`, `client`.`status`';

        $sql = "SELECT ".$select."
            FROM `client`
            WHERE `client`.`delete_flg` = ".$delete_flg."
            AND `client`.`account_type` = ".$account_type." ";

        if (! empty($param['keyword'])) {
            $keyword = "%{$param['keyword']}%";
            $sql .= "AND `client`.`client_id` IN (
                                    (SELECT`client`.`client_id` FROM `client`
                                        JOIN `nursery` ON `nursery`.`client_id` = `client`.`client_id`
                                        WHERE CAST(`client`.`client_id` AS CHAR ) LIKE '".$keyword."'
                                            OR `client`.`name` collate utf8_unicode_ci LIKE '".$keyword."'
                                            OR `client`.`display_name` collate utf8_unicode_ci LIKE '".$keyword."'
                                            OR `client`.`contact_name` collate utf8_unicode_ci LIKE '".$keyword."'
                                            OR `client`.`mail` collate utf8_unicode_ci LIKE '".$keyword."'
                                            OR `client`.`phone` collate utf8_unicode_ci LIKE '".$keyword."'
                                            OR `nursery`.`name` collate utf8_unicode_ci LIKE '".$keyword."')
                                )";
        }
        $sql .= "GROUP BY `client`.`client_id`
        ORDER BY `client`.`client_id` DESC
        LIMIT {$param['offset']}, {$param['limit']}";

        $query = $this->db->query($sql, $query_param);

        $result = $query->result_array();
        return $result;
    }

    public function get_client_list_simplicity($param){
        $select     = array_to_select_str($param['select']);
        $where      = array_to_where($param['where']);

        $sql = "SELECT ".$select." FROM `client`
                JOIN `image` ON `client`.`client_id` = `image`.`account_id`
                WHERE ".$where;

        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    /**
     * get client list
     * @param [int] $accuont_type
     * @return false/array
     */
    public function get_client_list($accuont_type, $limit_type)
    {
        $query_param = array(
            $limit_type,
            $accuont_type
        );
        $sql = "SELECT * FROM `client`
                JOIN `client_plan_group_relation`
                ON
                    client.`client_id` = `client_plan_group_relation`.`client_id`
                AND
                    `client_plan_group_relation`.`delete_flg` = 0
                JOIN `plan_group_relation` ON `client_plan_group_relation`.`plan_group_id` = `plan_group_relation`.`plan_group_id`
                JOIN `plan` ON `plan_group_relation`.`plan_id` = `plan`.`plan_id`
                WHERE `plan`.`limit_type` = ? AND `client`.`account_type` = ? ";
        $query  = $this->db->query($sql, $query_param);
        $result = $query->result_array();
        return $result;
    }

    public function get_mail_for_info($account){
    $this->config->load('client_config', TRUE);
    if($account === 'info_agency'){
        $account_type = 2; //$this->config->item('client_agency');
    }elseif($account === 'info_employer'){
        $account_type = 1; //$this->config->item('client_employee');
    }else{
        return false;
    }
    $sql = 'SELECT `mail` FROM `client` WHERE `delete_flg` = 0 AND `status` = 0 AND `account_type` = ' . $account_type;
    $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function update($param)
    {
        $client_id = $param['client_id'];
        unset($param['client_id']);
        $fields = implode(',', array_map(function($k){
                return '`'. $k .'` = ?';
            }, array_keys($param))
        );

        $query_param = array_merge(array_values($param), array($client_id));

        $sql = <<<EOF
UPDATE `client`
SET {$fields}
WHERE `client_id` = ?
EOF;

        $this->db->query($sql, $query_param);
        return (bool) $this->db->affected_rows();
    }

    public function insert_area_relation($param)
    {
        $client_id = $param['client_id'];
        $states = $param['area'];

        $query_param = call_user_func_array('array_merge', array_map(
            function($state) use($client_id){
                return array($client_id,$state);
            }, $states)
        );

        $bind_str = rtrim(str_repeat('(?, ?),', count($query_param) / 2), ', ');

        $sql = <<<EOF
INSERT INTO `client_area_relation` (`client_id`, `area_id`)
VALUES {$bind_str}
EOF;

        $this->db->query($sql, $query_param);
        return (bool) $this->db->insert_id();

    }

    public function delete_area_relation($param)
    {
        $client_id = $param['client_id'];
        $delete_flg = $param['delete_flg'];

        $query_param = array($delete_flg, $client_id);

        $sql = <<<EOF
UPDATE `client_area_relation`
SET `delete_flg` = ?
WHERE `client_id` = ?
EOF;

        $this->db->query($sql, $query_param);
        return (bool) $this->db->affected_rows();
    }

    public function insert_tag_relation($param)
    {
        $account_id = $param['client_id'];
        $occupations = $param['occupation'];
        $type = $param['type'];
        $created = $param['created'];

        $query_param = call_user_func_array('array_merge', array_map(
            function($occupation) use($account_id, $type, $created){
                return array($occupation, $account_id, $type, $created);
            }, $occupations)
        );

        $bind_str = rtrim(str_repeat('(?, ?, ?, ?),', count($query_param) / 4), ', ');

        $sql = <<<EOF
INSERT INTO `tag_relation` (`tag_id`, `account_id`, `type`, `created`)
VALUES {$bind_str}
EOF;


        $this->db->query($sql, $query_param);
        return (bool) $this->db->insert_id();
    }

    public function delete_tag_relation($param)
    {
        $account_id = $param['client_id'];
        $delete_flg = $param['delete_flg'];
        $type = $param['type'];

        $query_param = array($delete_flg, $account_id, $type);

        $sql = <<<EOF
UPDATE `tag_relation`
SET `delete_flg` = ?
WHERE `account_id` = ?
AND `type` = ?
EOF;

        $this->db->query($sql, $query_param);
        return (bool) $this->db->affected_rows();
    }


    public function get_relation_area($client_id){
        $sql = "SELECT area.name FROM `client_area_relation`
                JOIN `area` ON `client_area_relation`.`area_id` = `area`.`area_id`
                WHERE `client_area_relation`.`client_id` = ".$client_id." AND `client_area_relation`.`delete_flg` = 0 AND `area`.`delete_flg` = 0";
        return $this->db->query($sql)->result_array();
    }
   public function search_applied($client_id){
        //$sql = "SELECT COUNT(1) AS count FROM `applicant_agency`
        //        WHERE `user_id` = ?
        //        AND `status` = ?
        //        AND `delete_flg` = ?  ";
        $sql = "(SELECT a.applicant_agency_id AS 'id',u.*,a.created AS 'apply_date','agency' AS 'type', a.status as applicant_status
FROM `applicant_agency`
AS `a`
INNER JOIN `user` AS `u` ON `a`.`user_id` = `u`.`user_id`
WHERE
 `a`.`client_id` = ".$client_id."
AND
 `a`.`status` IN (0,1,2,3)
AND
 `u`.`status` = 1
AND
 `u`.`delete_flg` = 0
GROUP BY `a`.`applicant_agency_id`
ORDER BY `aj`.`created` DESC)

UNION

(SELECT aj.applicant_job_id  AS 'id',u.*,aj.created AS 'apply_date','job' AS 'type', aj.status as applicant_status
FROM `applicant_job`
AS `aj`
INNER JOIN `user` AS `u` ON `aj`.`user_id` = `u`.`user_id`

INNER JOIN `job` AS `j` ON `aj`.`job_id` = `j`.`job_id`
INNER JOIN `nursery` AS `n` ON `j`.`nursery_id` = `n`.`nursery_id`
WHERE
 `n`.`client_id` = ".$client_id."
AND
 `aj`.`status` IN (0,1,2,3)
AND
 `u`.`status` = 1
AND
 `u`.`delete_flg` = 0
GROUP BY `aj`.`applicant_job_id`
ORDER BY `aj`.`created` DESC)
ORDER BY `apply_date` DESC
LIMIT 10
";
        $query = $this->db->query($sql);
        $result      = $query->result_array();
        if(empty($result)){
            return false;
        }
        return $result;
    }

    public function change_password($client_id, $password){
        $params['password'] = $password;
        $params['client_id'] = $client_id;

        $sql = "UPDATE `client` SET `password`= ? WHERE `client_id` = ? ";
        $result = $this->db->query($sql, $params);
        return $result;
    }

    public function get_client_type($client_id){
        $sql = "SELECT `account_type`
                    FROM `client`
                    WHERE `client_id` = ".$client_id;
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function get_export_data()
    {
        $sql = <<<EOF
            SELECT `client`.*, `province`.`name` as `province`, `area`.`name` as `city`
            FROM `client`
            LEFT JOIN `client_area_relation` ON `client_area_relation`.`client_id` = `client`.`client_id`
            LEFT JOIN `area` ON `area`.`area_id` = `client`.`area_id`
            LEFT JOIN `area` AS `province` ON `province`.`area_id` = `area`.`region_id`
EOF;
        return $this->db->query($sql)->result_array();
    }


    public function get_nursery_export_data()
    {

        $nursery = $this->config->item('nursery', 'client_config');
        $nursery_type = $this->config->item('type_nursery', 'tag_config');
        $tag_insurance = $this->config->item('tag_insurance', 'tag_config');
        $tag_job = $this->config->item('tag_job', 'tag_config');
        $image_type = $this->config->item('nursery', 'image_config');

        $sql = <<<SQL
        SELECT `nursery`.*,
        `client`.`name` as `client_name`,
        `job`.`delete_flg`,
        `province`.`name` as `province`,
        `area`.`name` as `city`
        FROM nursery
        LEFT JOIN `client` ON `client`.`client_id` = `nursery`.`client_id`
        LEFT JOIN `job` ON `nursery`.`nursery_id` = `job`.`nursery_id`
        LEFT JOIN `area` ON `nursery`.`area_id` = `area`.`area_id`
        LEFT JOIN `area` AS `province` ON `province`.`area_id` = `area`.`region_id`
        WHERE account_type = {$nursery}
        LIMIT 1000
SQL;
        $image_sql = <<<EOF
        SELECT
        `image`.`name`,  `nursery`.`nursery_id`
        FROM `nursery`
         JOIN `image` ON `image`.`account_id` = `nursery`.`nursery_id` AND `image`.`type` = {$image_type}
        limit 1000
EOF;
        $nursery_type_sql = <<<EOF
        SELECT `tag`.`name` as `nursery_type`, `nursery`.`nursery_id`
        FROM `nursery`
         JOIN `tag_relation` ON `tag_relation`.`account_id` = `nursery`.`nursery_id`
         JOIN `tag` ON `tag`.`tag_id` = `tag_relation`.`tag_id` AND `tag`.`tag_group_id` = {$nursery_type}
        LIMIT 1000
EOF;

        $insurance_sql = <<<SQL
        SELECT `tag`.`name` as `insurance`, `nursery`.`nursery_id`
        FROM `nursery`
         JOIN `tag_relation` ON `tag_relation`.`account_id` = `nursery`.`nursery_id`
         JOIN `tag` ON `tag`.`tag_id` = `tag_relation`.`tag_id` AND `tag`.`tag_group_id` = {$tag_insurance}
        LIMIT 1000
SQL;

        $benefit_sql = <<<EOF
        SELECT `tag`.`name` as `benefit`, `nursery`.`nursery_id`
        FROM `nursery`
         JOIN `tag_relation` ON `tag_relation`.`account_id` = `nursery`.`nursery_id`
         JOIN `tag` ON `tag`.`tag_id` = `tag_relation`.`tag_id` AND `tag`.`tag_group_id` = {$tag_job}
        LIMIT 1000
EOF;

        $nurserys = $this->db->query($sql)->result_array();
        $nursery_type = $this->db->query($nursery_type_sql)->result_array();
        $insurance = $this->db->query($insurance_sql)->result_array();
        $benefit = $this->db->query($benefit_sql)->result_array();
        $image = $this->db->query($image_sql)->result_array();

        return array($nurserys, $nursery_type, $insurance, $benefit, $image);
    }



    public function get_client_by_job_id($params){
        extract($params);
        $sql = "SELECT client.name, client.client_id, client.display_name
                FROM `job`
                LEFT JOIN `nursery` ON job.nursery_id = nursery.nursery_id
                LEFT JOIN client  ON client.client_id = nursery.client_id
                WHERE `job`.job_id = {$job_id}
                LIMIT 1";

        $result = $this->db->query($sql)->row_array();
        return $result;
    }

    public function count_active_client($param){
	$select           = $param['select'];
        $job_status       = $param['job_status'];
        $nursery_status   = $param['nursery_status'];
        $client_status    = (array_key_exists('client_status',$param)) ? $param['client_status'] : 0;
        $delete_flg       = $param['delete_flg'];
	$now_date         = date('Y-m-d H:i:s');

	$sql  = "SELECT ".$select."\n".
                "FROM
                     `client` `c`
                 INNER JOIN `nursery` `n`
                  ON `n`.`client_id` = `c`.`client_id`
                  INNER JOIN `job` `j`
                  ON `j`.`nursery_id` = `n`.`nursery_id`".
                "\nWHERE
                    `j`.`delete_flg` = ".$delete_flg." AND
                    `j`.`status`     = ".$job_status." AND
                    `j`.`expired`    > '".$now_date."' AND
                    `n`.`delete_flg` = ".$delete_flg." AND
                    `n`.`status`     = ".$nursery_status." AND
                    `c`.`delete_flg` = ".$delete_flg." AND
                    `c`.`status`     = ".$client_status."\n";

	$query  = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }


}
?>
