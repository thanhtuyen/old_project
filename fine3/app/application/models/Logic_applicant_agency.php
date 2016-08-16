<?php
Class Logic_applicant_agency extends MY_Model{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Count all record agency applied of current user
     * @param array $params
     * $params['user_id']
     * $params['status']
     * $params['delete_flg']
     * @return number
     * @since 2015/04/21
     */
    public function count_agency_applied($params){
        //$sql = "SELECT COUNT(1) AS count FROM `applicant_agency`
        //        WHERE `user_id` = ?
        //        AND `status` = ?
        //        AND `delete_flg` = ?  ";
        $sql = "SELECT COUNT(*) AS count FROM `applicant_agency` AS a ";
        $sql .= "INNER JOIN `client` AS c ";
        $sql .= "ON `c`.`client_id` = `a`.`client_id` ";
        $sql .= "WHERE `a`.`user_id` = ? ";
        $sql .= "AND `c`.`status` = ?  ";
        $sql .= "AND `a`.`delete_flg` = ?  ";

        $query = $this->db->query($sql, $params);
        $result      = $query->result();
        return intval( $result[0]->count );
    }
    /**
     * Count all record user applied agency of current client
     * @param array $params
     * $params['client_id']
     * @return number
     * @since 2015/04/23
     */
    public function count_user_applied($params){
        $client_id          = $params['client_id'];
        $start_date         = $params['start_date'];
        $end_date           = $params['end_date'];
        $keyword            = $params['keyword'];
        $tag_license        = $params['tag_license'];
        $type_relation_user = $params['type_relation_user'];
        $status             = $params['status'];
        $delete_flg         = $params['delete_flg'];
        $status_applied     = implode(',', $params['status_applied']);
        // Conditions
        $conditions = [
            "`a`.`client_id` = $client_id",
            "`a`.`status` IN ($status_applied)",
            "`tr`.`type` = $type_relation_user",
            "`t`.`tag_group_id` = $tag_license",
            "`u`.`status` = $status",
            "`u`.`delete_flg` = $delete_flg",
            "`t`.`delete_flg` = $delete_flg"
        ];
        if($start_date && $end_date){
            $conditions[] = "(`a`.`created` BETWEEN '$start_date' AND '$end_date')";
        }
        if($keyword){
            $conditions[] = "(`u`.`name` LIKE '%$keyword%' OR `u`.`name_kana` LIKE '%$keyword%' OR `t`.`name` LIKE '%$keyword%')";
        }

        $sql = "SELECT a.applicant_agency_id FROM `applicant_agency` AS `a` ";
        $sql .= "INNER JOIN `user` AS `u` ";
        $sql .= "ON `a`.`user_id` = `u`.`user_id` ";
        $sql .= "INNER JOIN `tag_relation` AS `tr` ";
        $sql .= "ON `u`.`user_id` = `tr`.`account_id` ";
        $sql .= "INNER JOIN `tag` AS `t`";
        $sql .= "ON `t`.`tag_id` = `tr`.`tag_id` ";
        $sql .= "WHERE ";
        $sql .= implode(' AND ', $conditions);
        $sql .= " GROUP BY `a`.`applicant_agency_id`";
        $query = $this->db->query($sql);
        $result      = $query->result();
        return intval( count($result) );
    }
    /**
     * All all record user applied agency of current client
     * @param array $params
     * $params['client_id']
     * @return number
     * @since 2015/04/23
     */
    public function search_user_applied_agency($params){
        $client_id          = $params['client_id'];
        $start_date         = $params['start_date'];
        $end_date           = $params['end_date'];
        $keyword            = $params['keyword'];
        $tag_license        = $params['tag_license'];
        $type_relation_user = $params['type_relation_user'];
        $status             = $params['status'];
        $delete_flg         = $params['delete_flg'];
        $offset             = $params['offset'];
        $limit              = $params['limit'];
        $status_applied     = implode(',', $params['status_applied']);
        // Conditions
        $conditions = [
            "`a`.`client_id` = $client_id",
            "`a`.`status` IN ($status_applied)",
            "`u`.`status` = $status",
            "`u`.`delete_flg` = $delete_flg",
            "`truwj`.`delete_flg` = $delete_flg",
            "`trul`.`delete_flg` = $delete_flg",
            "`tuwj`.`delete_flg` = $delete_flg",
            "`tul`.`delete_flg` = $delete_flg"
        ];
        if($start_date && $end_date){
            $conditions[] = "(`a`.`created` BETWEEN '$start_date' AND '$end_date')";
        }
        if($keyword){
            $conditions[] = "(`u`.`name` LIKE '%$keyword%' OR `u`.`name_kana` LIKE '%$keyword%' OR `tuwj`.`name` LIKE '%$keyword%' OR `tul`.`name` LIKE '%$keyword%')";
        }

        $sql = "SELECT a.applicant_agency_id, a.created AS apply_created,
                                    a.status AS apply_status,
                                    u.*,
                                    GROUP_CONCAT(distinct(truwj.tag_id) separator ',') AS wish_job_id,
                                    GROUP_CONCAT(distinct(tuwj.name) separator ',')AS wish_job_name,
                                    GROUP_CONCAT(distinct(trul.tag_id) separator ',') AS user_license_id,
                                    GROUP_CONCAT(distinct(tul.name) separator ',') AS user_license
                                    FROM `applicant_agency` AS `a`
                    INNER JOIN `user` AS `u`
                    ON `a`.`user_id` = `u`.`user_id`
                    LEFT JOIN `tag_relation` AS `truwj`
                    ON `u`.`user_id` = `truwj`.`account_id` AND `truwj`.`type` = '0'
                    LEFT JOIN `tag` AS `tuwj`
                    ON `tuwj`.`tag_id` = `truwj`.`tag_id` AND `tuwj`.`tag_group_id` = '3'
                    LEFT JOIN `tag_relation` AS `trul`
                    ON `u`.`user_id` = `trul`.`account_id` AND `trul`.`type` = '0'
                    LEFT JOIN `tag` AS `tul`
                    ON `tul`.`tag_id` = `trul`.`tag_id` AND `tul`.`tag_group_id` = '4'
                    WHERE ".implode(' AND ', $conditions). "
                    GROUP BY `a`.`applicant_agency_id`
                    ORDER BY `a`.`created` DESC
                    LIMIT $offset,$limit ";
        $query = $this->db->query($sql);
        $result      = $query->result_array();
        return $result;
    }



    /**
     * Check get detail applied in applicant_agency table
     * @param int $client_id
     * @param int $applicant_agency_id
     * @return boolean
     * @since 2015/04/23
     */
    public function get($client_id, $applicant_agency_id){
        $sql = "SELECT * FROM `applicant_agency` ";
        $sql .= "WHERE applicant_agency_id = $applicant_agency_id ";
        $sql .= "AND client_id = $client_id ";
        $query = $this->db->query($sql);
        $result      = $query->result_array();
        if($result && ! empty($result)){
            return $result[0];
        }
        return false;
    }
    /**
     * Get detail applicant | client | user
     * @param array[] $applicant_agency_id
     * @since 2015/04/23
     */
    public function get_detail($param){
        $sql = "SELECT `c`.`name` as `client_name`, `u`.`name` as `user_name`, `a`.`user_id`, `a`.`client_comment`, `a`.`status`, `a`.`applicant_agency_id` ";
        $sql .= "FROM `applicant_agency` AS `a` ";
        $sql .= "INNER JOIN `user` AS `u` ";
        $sql .= "ON `a`.`user_id` = `u`.`user_id` ";
        $sql .= "INNER JOIN `client` AS `c` ";
        $sql .= "ON `a`.`client_id` = `c`.`client_id` ";
        $sql .= "WHERE `a`.`applicant_agency_id` = ?";
        $query = $this->db->query($sql,$param);
        $result      = $query->result_array();
        return $result;
    }

    public function get_detail_array($param){
        $sql = "SELECT `c`.`name` as `client_name`, `u`.`name` as `user_name`, `a`.`user_id`, `a`.`client_comment`, `a`.`status`, `a`.`applicant_agency_id` ";
        $sql .= "FROM `applicant_agency` AS `a` ";
        $sql .= "INNER JOIN `user` AS `u` ";
        $sql .= "ON `a`.`user_id` = `u`.`user_id` ";
        $sql .= "INNER JOIN `client` AS `c` ";
        $sql .= "ON `a`.`client_id` = `c`.`client_id` ";
        $sql .= "WHERE `a`.`applicant_agency_id` IN( ".$param." )";
        $query = $this->db->query($sql,$param);
        $result      = $query->result_array();
        return $result;
    }
    /**
     * Get all agency applied and pagination with current user
     * @param array $params
     * $params['select']
     * $params['delete_flg']    // delete_flg job
     * $params['status']        // status job
     * $params['delete_flg']    // delete_flg agency apply
     * $params['status']        // status job
     * $params['user_id']       // user_id
     * @return false/array
     * @since 2015/04/22
     */
    public function get_all_applied_agency($params, $offset, $limit){
        $data = false;

//         $sql  = "SELECT ".$params['select']." \n".
//             "FROM `client` `c` " .
//             "INNER JOIN `applicant_agency` `b` \n
//             ON `c`.`client_id` = `b`.`client_id`
//             WHERE
//             `c`.`delete_flg` = ".$params['delete_flg']." AND
//             `c`.`status`     = ".$params['status']." AND
//             `b`.`delete_flg` = ".$params['delete_flg']." AND
//             `b`.`status`= ".$params['status']."  AND
//             `b`.`user_id` = ".$params['user_id']." \n" .
//                 "ORDER BY `b`.`created` DESC " .
//                 "LIMIT $offset,$limit";
        $sql  = "SELECT ".$params['select']." \n".
            "FROM `client` `c` " .
            "INNER JOIN `applicant_agency` `b` \n
            ON `c`.`client_id` = `b`.`client_id`
            WHERE
            `c`.`delete_flg` = ".$params['delete_flg']." AND
            `c`.`status`     = ".$params['status']." AND
            `b`.`delete_flg` = ".$params['delete_flg']." AND
            `b`.`user_id` = ".$params['user_id']." \n" .
            "ORDER BY `b`.`created` DESC " .
            "LIMIT $offset,$limit";

        $query = $this->db->query($sql);
        $result      = $query->result_array();

        if($result && ! empty($result)){
            $data = $result;
        }

        return $data;
    }
    /**
     * add applicant_agency
     * @param  (array)$params
     */
    public function insert_applicant_agency($insert_params)
    {


        $insert_params= $this->get_apply_status_param($insert_params);


        $sql = "INSERT INTO applicant_agency(user_id, client_id, created, unit_price, status) VALUES(?, ?, ?, ?, ?)";
        return $this->db->query($sql, $insert_params);
    }

    public function get_apply_status_param($insert_params){
        $status = 0;
        $user_id = $insert_params[0];
        $client_id = $insert_params[1];

        $result = $this->check_user_apply_same_client($user_id, $client_id);

        if($result){
            $status = 2;
        }else{
            $this->load->model('Logic_applicant_job');
            $result = $this->Logic_applicant_job->check_user_apply_same_client($user_id, $client_id);
            if($result){
                $status = 2;
            }
        }



        array_push($insert_params, $status);
        return $insert_params;
    }

    public function check_user_apply_same_client($user_id, $client_id, $day = 60){
        $sql = "SELECT status
                FROM `applicant_agency`
                WHERE user_id = {$user_id}
                AND client_id = {$client_id}
                AND DATEDIFF( CURRENT_DATE(), `created`) <= {$day}";
        $query = $this->db->query($sql);
        $result      = $query->num_rows();

        if($result){
            return true;
        }
        return false;
    }
    /**
     * Update status in applicant_agency table
     * @param array $params
     * @return boolean
     * @since 2015/04/23
     */
    public function update_status($params){
        $set_fix_date = '';
        if ($params['status'] == 1 || $params['status'] == 3) {
            $set_fix_date = ",`fix_date` = '".date("Y-m-d H:i:s")."'";
        }
        $sql = "UPDATE `applicant_agency` SET `status` = ?".$set_fix_date." WHERE `applicant_agency_id` = ? ";
        if(isset($params['comment'])){
            $sql = "UPDATE `applicant_agency` SET `status` = ? ".$set_fix_date.", `client_comment` = ? WHERE `applicant_agency_id` = ? ";
        }
        return $this->db->query($sql, $params);
    }

    public function get_applicant_agency_count($params){
        $sql         = "SELECT COUNT(*) FROM `applicant_agency`
                        WHERE `user_id` = ".$params['user_id']."
                        AND `delete_flg` = 0";
        return $this->db->query($sql)->row_array();
    }
    public function check_apply($user_id,$client_id){
         $sql         = "SELECT COUNT(*) AS count FROM `applicant_agency`
                        WHERE `user_id` = ".$user_id."
                        AND `client_id` = ".$client_id."
                        AND `delete_flg` = 0";
        return $this->db->query($sql)->row_array();
    }


    public function get_condition_list($condition, $param)
    {
        $delete_flg = $param['delete_flg'];
        $query_param = array($delete_flg);
        $sql = <<<SQL
SELECT a.applicant_agency_id AS applicant_id,
a.user_id AS user_id,
u.name AS user_name,
a.created AS created,
a.fix_date AS fix_date,

a.status AS status,
c.client_id AS client_id,
c.name AS client_name

FROM applicant_agency AS a
LEFT JOIN user AS u ON u.user_id = a.user_id
LEFT JOIN client AS c ON c.client_id = a.client_id
WHERE a.delete_flg = ?
SQL;
        if (! empty($condition['keyword'])) {
            $sql .= <<<EOF
             AND (`client_comment` LIKE ? OR u.`name` LIKE ? OR u.`mail` LIKE ? OR `client`.`name` LIKE ?)
EOF;
            $keyword = "%".$condition['keyword']."%";
            array_push($query_param, $keyword, $keyword, $keyword, $keyword);
        }

        if (! empty($condition['status'])){
            if($condition['status'] == 'not_sure') {
                $condition['status'] = 0;
            }
            $sql .= <<<SQL
             AND a.`status` = ?
SQL;
            $status = "{$condition['status']}";
            array_push($query_param, $status);
        }

        if (! empty($condition['apply_start_time'])){
            $sql .= <<<SQL
             AND a.`created` >= ?
SQL;
            $start_time = "{$condition['apply_start_time']}";
            array_push($query_param, $start_time.' 00:00:00');
        }

	if (! empty($condition['apply_end_time'])){
            $sql .= <<<SQL
             AND a.`created` <= ?
SQL;
            $end_time = "{$condition['apply_end_time']}";
            array_push($query_param, $end_time.' 23:59:59');
        }

        // Ordery by created of applicant_job DESC
        $sql .= ' ORDER BY `a`.`created` DESC ';


        $sql .= <<<EOF
        LIMIT {$param['offset']}, {$param['limit']}
EOF;
        $query = $this->db->query($sql, $query_param);

        return $query->result_array();
    }
}
?>
