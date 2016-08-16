<?php
Class Logic_plan extends MY_Model{
    public function __construct()
    {
        parent::__construct();
    }

    public function stop($param)
    {
        $delete_flg = $param['delete_flg'];
        $client_plan_group_relation_id = $param['client_plan_group_relation_id'];

        $sql ="UPDATE `client_plan_group_relation`
               SET `delete_flg` = '".$delete_flg."'
               WHERE `client_plan_group_relation_id` = '".$client_plan_group_relation_id."'";
        $result = $this->db->query($sql);
        return $result;
    }
    public function apply($param){
        $sql = "INSERT INTO `client_plan_group_relation`(
            `client_plan_group_relation_id`,
            `client_id`,
            `plan_group_id`,
            `discount`,
            `auto_extend_flg`,
            `expire_month`,
            `created`,
            `delete_flg`
            )
             VALUES (
            NULL,
            '".$param['client_id']."',
            '".$param['plan_group_id']."',
            '".$param['discount']."',
            '".$param['plan_group']['auto_extend_flg']."',
            '".$param['expire_month']."',
            '".$param['apply_date']."',
            '0'
            )";
        $query           = $this->db->query($sql);
        return $query;
    }

    public function create_client_plan($param)
    {
        $fields = implode(',', array_map(function($k){
                return '`'. $k .'`';
            }, array_keys($param))
        );
        $query_param = array_values($param);
        $bind_str = rtrim(str_repeat('?, ', count($query_param)), ', ');

        $sql = <<<EOF
INSERT INTO `client_plan_group_relation` ({$fields})
VALUES ({$bind_str})
EOF;

        $this->db->query($sql, $query_param);
        return (bool) $this->db->insert_id();

    }
    /**
     * get list with plan_group, client_plan_group_relation.
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public function get_plan_list($param){
        $select          = $param['select'];
        $plan_group_id   = $param['plan_group_id'];
        $sql             = "SELECT ".$select." FROM `plan_group_relation`
                            INNER JOIN `plan` ON `plan_group_relation`.`plan_id`=`plan`.`plan_id`
                            WHERE `plan_group_relation`.`plan_group_id`   = ".$plan_group_id;
        $query           = $this->db->query($sql);
        $result          = $query->result_array();
        return $result;
    }
    /**
     * get list with plan_group, client_plan_group_relation.
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public function get_list($param){
        $select      = $param['select'];
        $client_id   = $param['client_id'];
        $sql         = "SELECT ".$select." FROM `client_plan_group_relation`
                        INNER JOIN `plan_group` ON `client_plan_group_relation`.`plan_group_id`=`plan_group`.`plan_group_id`
			INNER JOIN `plan_group_relation` `pr` ON `pr`.`plan_group_id` = `plan_group`.`plan_group_id`
			LEFT JOIN `plan` ON `plan`.`plan_id` = `pr`.`plan_id`
                        WHERE `client_id` = ".$client_id;
	if(isset($param['limit_type'])){
	    $sql_2nd = $sql;
	    $sql .= " AND `plan`.`limit_type` = ".$param['limit_type'];
	}
        $sql .= " GROUP BY `client_plan_group_relation`.`client_plan_group_relation_id`";
        $query       = $this->db->query($sql);
        $result      = $query->result_array();
	//重複したプラン用の処理
	if($result == null){
	    $query       = $this->db->query($sql_2nd);
            $result      = $query->result_array();
	}
        return $result;
    }
    public function get_detail($param){
        $select      = $param['select'];
        $client_id = $param['client_id'];
        $client_plan_group_relation_id = $param['client_plan_group_relation_id'];
        
        $sql         = "SELECT ".$select." FROM `client_plan_group_relation`
                        INNER JOIN `plan_group` ON `client_plan_group_relation`.`plan_group_id`=`plan_group`.`plan_group_id`
                        WHERE `client_plan_group_relation_id` = ".$client_plan_group_relation_id."
                        AND `client_id` = ".$client_id;
        $query       = $this->db->query($sql);
        $result      = $query->result_array();
        return $result;
    }
        public function get_group_detail($param){
        $select      = $param['select'];
        $plan_group_id = $param['plan_group_id'];
        $delete_flg  = $param['delete_flg'];
        $sql         = "SELECT ".$select." FROM `plan_group`
                        WHERE `plan_group_id` = ".$plan_group_id."
                        AND `plan_group`.`delete_flg` = ".$delete_flg;
        $query       = $this->db->query($sql);
        $result      = $query->result_array();
        return $result;
    }
    public function get_open_list($param){
        $select       = $param['select'];
        $client_id    = $param['client_id'];
        $status_param['name']  = 'status';
        $status_param['value'] = $param['status_array'];
        $status_array = array_to_where_in($status_param);
        $delete_flg   = $param['delete_flg'];
        $sql          = "SELECT ".$select." FROM `plan_group`
                        WHERE `plan_group`.`delete_flg` = ".$delete_flg."
                        AND ".$status_array."";
        $query       = $this->db->query($sql);
        $result      = $query->result_array();
        return $result;
    }

    /**admin
     * [get list by client id]
     * @param  [array] $param
     * @return [array]
     */
    public function get_list_by_client_id($param)
    {
        $delete_flg = $param['delete_flg'];
        $client_id = $param['client_id'];


        $query_param = array($delete_flg, $delete_flg, $client_id);
        // $select = '`plan`.`plan_name`, `plan`.`plan_id`, `client_plan_group_relation`.`expire_month` as `end_date`, `client_plan_group_relation`.`created` as `start_date`';
        $select = '`relation`.`client_plan_group_relation_id`,`group`.`name`,`group`.`price`,`relation`.`expire_month`,`relation`.`created`';
        $sql = <<<EOF
        SELECT {$select} FROM `client_plan_group_relation`
        JOIN `plan_group_relation` ON `client_plan_group_relation`.`plan_group_id` = `plan_group_relation`.`plan_group_id`
        JOIN `plan_group` ON `plan_group`.`plan_group_id` = `plan_group_relation`.`plan_group_id`
        JOIN `plan` ON `plan`.`plan_id` = `plan_group_relation`.`plan_id`
        WHERE `client_plan_group_relation`.`delete_flg` = ?
        AND `plan_group`.`delete_flg` = ?
        AND `client_plan_group_relation`.`client_id` = ?
EOF;
        return $this->db->query($sql, $query_param)->result_array();
    }

    public function get_related_plan_group($param){
    $delete_flg = $param['delete_flg'];
        $client_id = $param['client_id'];

    $query_param = array($delete_flg, $delete_flg);
    $select = '`relation`.`client_plan_group_relation_id`,`group`.`name`,`group`.`price`,`relation`.`expire_month`,`relation`.`created`';
    $sql = <<<EOF
    SELECT {$select} FROM `client_plan_group_relation` `relation`
    LEFT JOIN `plan_group` `group` ON `group`.`plan_group_id` = `relation`.`plan_group_id`
    WHERE `relation`.`delete_flg` = ?
        AND `group`.`delete_flg` = ?
        AND `relation`.`client_id` = {$client_id}
EOF;
    return $this->db->query($sql, $query_param)->result_array();
    }



    public function get_relation_list($param)
    {
        $delete_flg = $param['delete_flg'];
        $query_param = array($delete_flg);
        $select = '`plan`.`plan_name`, `plan`.`plan_id`, `plan_group`.`plan_group_id`';
        $sql = <<<EOF
            SELECT {$select}
            FROM `plan`
            JOIN `plan_group_relation` ON `plan`.`plan_id` = `plan_group_relation`.`plan_id`
            JOIN `plan_group` ON `plan_group`.`plan_group_id` = `plan_group_relation`.`plan_group_id`
            WHERE `plan_group`.`delete_flg` = ?
EOF;

        return $this->db->query($sql, $query_param)->result_array();
    }

    public function get_total_count($param)
    {

        $sql = <<<SQL
SELECT count(*) AS total FROM `plan`
SQL;

        $query_param = array();
        if (! empty($param['keyword'])) {
            $sql .= <<<EOF
             WHERE `plan_name` LIKE ?
EOF;

            $keyword = "%{$param['keyword']}%";
            $query_param = array($keyword);
        }
        $query = $this->db->query($sql, $query_param);

        return $query->row_array()['total'];
    }

    public function get_all_list($condition, $param, $pagerfanta = true)
    {

        $select = '`plan`.`plan_name`, `plan`.`plan_id`, `plan`.`limit_num`';
        $sql = <<<EOF
            SELECT {$select}
            FROM `plan`
EOF;
        $query_param = array();
        if ($pagerfanta) {
            if (! empty($condition['keyword'])) {
                $sql .= <<<EOF
                 WHERE `plan_name` LIKE ?
EOF;
                $keyword = "%{$condition['keyword']}%";
                $query_param = array($keyword);
            }

            $sql .= <<<EOF
            LIMIT {$param['offset']}, {$param['limit']}
EOF;
    }

        return $this->db->query($sql, $query_param)->result_array();
    }

    public function get_group($param)
    {
        $delete_flg = $param['delete_flg'];
        $select = '`plan_group`.`name`, `plan_group`.`plan_group_id`, `plan_group`.`price`, `plan_group`.`unit_price`, `plan_group`.`period`, `plan_group`.`auto_extend_flg`';
        $sql = <<<EOF
            SELECT {$select}
            FROM `plan_group`
            JOIN `plan_group_relation` ON `plan_group`.`plan_group_id` = `plan_group_relation`.`plan_group_id`
            WHERE `plan_group`.`delete_flg` = ?
EOF;
        return $this->db->query($sql, array($delete_flg))->result_array();
    }

    public function detail($id)
    {
        $select = '*';
        $sql = <<<EOF
            SELECT {$select}
            FROM `plan`
            WHERE `plan`.`plan_id` = ?
EOF;

        return $this->db->query($sql, array($id))->row_array();
    }

    public function save($param)
    {
        $fields = implode(',', array_map(function($k){
                return '`'. $k .'`';
            }, array_keys($param))
        );

        $query_param = array_values($param);
        $bind_str = rtrim(str_repeat('?, ', count($query_param)), ', ');

        $sql = <<<EOF
INSERT INTO `plan` ({$fields})
VALUES ({$bind_str})
EOF;

        $this->db->query($sql, $query_param);
        return (bool) $this->db->insert_id();
    }

    public function update($param)
    {
        $plan_id = $param['plan_id'];
        unset($param['plan_id']);
        $fields = implode(',', array_map(function($k){
                return '`'. $k .'` = ?';
            }, array_keys($param))
        );

        $query_param = array_merge(array_values($param), array($plan_id));

        $sql = <<<EOF
UPDATE `plan`
SET {$fields}
WHERE `plan_id` = ?
EOF;
        $this->db->query($sql, $query_param);

        return (bool) $this->db->affected_rows();
    }

    public function update_group($param)
    {
        $plan_group_id = $param['plan_group_id'];
        unset($param['plan_group_id']);
        $fields = implode(',', array_map(function($k){
                return '`'. $k .'` = ?';
            }, array_keys($param))
        );

        $query_param = array_merge(array_values($param), array($plan_group_id));

        $sql = <<<EOF
UPDATE `plan_group`
SET {$fields}
WHERE `plan_group_id` = ?
EOF;
        $this->db->query($sql, $query_param);

        return (bool) $this->db->affected_rows();
    }

    public function group_detail($param)
    {
        $delete_flg = $param['delete_flg'];
        $plan_group_id = $param['group_id'];
        $query_param = array($delete_flg, $plan_group_id);
        $select = '*';
        $sql = <<<EOF
            SELECT {$select}
            FROM `plan_group`
            WHERE `plan_group`.`delete_flg` = ?
            AND `plan_group_id` = ?
EOF;

        return $this->db->query($sql, $query_param)->row_array();
    }

        public function get_plans_by_group_id($param)
        {
            $delete_flg = $param['delete_flg'];
            $plan_group_id = $param['group_id'];

            $query_param = array($delete_flg, $plan_group_id);

            $select = '`plan`.`plan_id`, `plan`.`plan_name`, `plan`.`description`';
            $sql = <<<EOF
SELECT {$select}
FROM `plan`
JOIN `plan_group_relation` ON `plan`.`plan_id` = `plan_group_relation`.`plan_id`
JOIN `plan_group` ON `plan_group`.`plan_group_id` = `plan_group_relation`.`plan_group_id`
WHERE `plan_group`.`delete_flg` = ?
AND `plan_group`.`plan_group_id` = ?
EOF;
            $results = $this->db->query($sql, $query_param)->result_array();
            $plan_id = array_column($results, 'plan_id');
            return array('plan_id' => array_unique($plan_id, SORT_REGULAR));
        }

        public function get_plans_detail_by_group_id($param)
        {
            $delete_flg = $param['delete_flg'];
            $plan_group_id = $param['group_id'];

            $query_param = array($delete_flg, $plan_group_id);

            $select = '`plan`.`plan_id`, `plan`.`plan_name`, `plan`.`description`';
            $sql = <<<EOF
SELECT {$select}
FROM `plan`
JOIN `plan_group_relation` ON `plan`.`plan_id` = `plan_group_relation`.`plan_id`
JOIN `plan_group` ON `plan_group`.`plan_group_id` = `plan_group_relation`.`plan_group_id`
WHERE `plan_group`.`delete_flg` = ?
AND `plan_group`.`plan_group_id` = ?
EOF;
            $results = $this->db->query($sql, $query_param)->result_array();
            return $results;
            // $plan_id = array_column($results, 'plan_id');
            // return array('plan_id' => array_unique($plan_id, SORT_REGULAR));
        }

    public function save_group($param)
    {
        $fields = implode(',', array_map(function($k){
                return '`'. $k .'`';
            }, array_keys($param))
        );

        $query_param = array_values($param);
        $bind_str = rtrim(str_repeat('?, ', count($query_param)), ', ');

        $sql = <<<EOF
INSERT INTO `plan_group` ({$fields})
VALUES ({$bind_str})
EOF;

        $this->db->query($sql, $query_param);
        return $this->db->insert_id();
    }

    public function save_relation($param)
    {
        $plan_group_id = $param['plan_group_id'];
        $plan_ids = $param['plan_id'];

        $query_param = call_user_func_array('array_merge', array_map(
            function($plan_id) use($plan_group_id){
                return array($plan_group_id, (int) $plan_id);
            }, $plan_ids)
        );

        $bind_str = rtrim(str_repeat('(?, ?),', count($query_param) / 2), ', ');

        $sql = <<<EOF
INSERT INTO `plan_group_relation` (`plan_group_id`, `plan_id`)
VALUES {$bind_str}
EOF;

        $this->db->query($sql, $query_param);
        return (bool) $this->db->insert_id();
    }

    public function delete_flg($param)
    {
        $sql = "DELETE FROM `plan` WHERE `plan_id` = ".$param['plan_id'];
        $this->db->query($sql);

        return (bool) $this->db->affected_rows();
    }

    public function is_selected($plan_id)
    {
        $sql = <<<EOF
            SELECT `plan_group_relation_id`
            FROM `plan_group_relation`
            WHERE `plan_group_relation`.`plan_id` = ?
EOF;
         $results = $this->db->query($sql, array($plan_id))->result_array();
         return (bool) $results;
    }

    public function group_delete_flg($param)
    {
        $delete_flg = $param['delete_flg'];
        $plan_group_id = $param['plan_group_id'];
        $query_param = array($delete_flg, $plan_group_id);

        $sql = <<<EOF
UPDATE `plan_group`
SET `delete_flg` = ?
WHERE `plan_group_id` = ?
EOF;
        $this->db->query($sql, $query_param);

        return (bool) $this->db->affected_rows();
    }


    public function delete_relation($group_id, $plan_id)
    {
        $sql = <<<SQL
DELETE FROM `plan_group_relation`
WHERE `plan_group_id` = ?
AND `plan_id` = ?
SQL;

    $this->db->query($sql, array($group_id, $plan_id));

    return (bool) $this->db->affected_rows();

    }

    public function delete_relation_by_group_id($group_id)
    {
        $sql = <<<SQL
DELETE FROM `plan_group_relation`
WHERE `plan_group_id` = ?
SQL;

    $this->db->query($sql, array($group_id));

    return (bool) $this->db->affected_rows();

    }
    /**
     * get list with plan_group, client_plan_group_relation.
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public function get_scout_limit($client_id){
        if(empty($client_id)){
            return 0;
        }
        $date_row    = new DateTime('NOW');
        $date        = $date_row->format('Y-m-d');
        $sql        = "SELECT
                            SUM(p.`limit_num`) AS `send_limit`
                            FROM
                            `plan_group_relation` pgr
                            JOIN plan p ON pgr.plan_id = p.plan_id
                            WHERE
                            p.limit_type = 1
                            AND
                            `plan_group_id` IN  (SELECT
                                                   cpr.`plan_group_id`
                                                 FROM
                                                   `client_plan_group_relation` cpr
                                                 WHERE
                                                   cpr.`client_id` = ".$client_id."
                                                 AND
                                                   cpr.`expire_month` >= '".$date."'
                                                 AND
                                                   cpr.`created` <= '".$date."'
                                                 AND
                                                   cpr.`delete_flg` = 0
                                                )";
        $query       = $this->db->query($sql);
        $result      = $query->result_array();
        return $result;
    }
    /**
     * get list with plan_group, client_plan_group_relation.
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public function single_scout_limit($cpgr_id){
        if(empty($cpgr_id)){
            return 0;
        }
        $sql = "SELECT
                  SUM(p.`limit_num`) AS `send_limit`
                FROM
                  `plan` p
                WHERE
                  p.`limit_type` = 1
                AND
                  p.`plan_id` IN (SELECT
                                    pgr.`plan_id`
                                  FROM
                                    `plan_group_relation` pgr
                                  WHERE
                                    `plan_group_id` IN  (SELECT
                                                           cpr.`plan_group_id`
                                                         FROM
                                                           `client_plan_group_relation` cpr
                                                         WHERE
                                                           cpr.`client_plan_group_relation_id` = ".$cpgr_id."
                                                         AND
                                                           cpr.`delete_flg` = 0
                                                        )
                                 )";
        $query       = $this->db->query($sql);
        $result      = $query->result_array();
        return $result[0]['send_limit'];
    }

    /**
     * get list with plan_group, client_plan_group_relation.
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public function get_scout_plan($client_id){
        if(empty($client_id)){
            return false;
        }
        $date_row    = new DateTime('NOW');
        $date        = $date_row->format('Y-m-d');
        $sql         = "SELECT
                           cpr.`client_plan_group_relation_id` AS cpgr_id
                         FROM
                           `client_plan_group_relation` cpr
                         WHERE
                           cpr.`client_id` = ".$client_id."
                         AND
                           cpr.`expire_month` >= '".$date."'
                             AND
                               cpr.`created` <= '".$date."'
                         AND
                           cpr.`delete_flg` = 0
                         ORDER BY cpr.`expire_month` ASC";
        $query       = $this->db->query($sql);
        $result      = $query->result_array();
        return $result;
    }
    public function cpgr_list($client_id){
        if(empty($client_id)){
            return false;
        }
        $sql         = "SELECT
                           cpr.`client_plan_group_relation_id` AS cpgr_id, cpr.`plan_group_id`
                         FROM
                           `client_plan_group_relation` cpr
                         WHERE
                           cpr.`client_id` = ".$client_id."
                         AND
                           cpr.`expire_month` >= '".$date."'
                         AND
                           cpr.`delete_flg` = 0";
        $query       = $this->db->query($sql);
        $result      = $query->result_array();
        return $result;
    }
    public function cpgr_monthly_info($cpgr_id){
        if(empty($cpgr_id)){
            return false;
        }
        $sql         = "SELECT
                           `plan_group`.`status` AS status
                         FROM
                           `client_plan_group_relation` cpr
                         INNER JOIN `plan_group` ON `plan_group`.`plan_group_id` = cpr.`plan_group_id`
                         WHERE
                           cpr.`client_plan_group_relation_id` = ".$cpgr_id."
                         AND
                           cpr.`delete_flg` = 0
                         AND `plan_group`.`status` IN (1,2,3,4,5,8,9,10,11,12)";
        $query       = $this->db->query($sql);
        $result      = $query->result_array();
        if(empty($result)){
            return false;
        }
        return $result[0]['status'];
    }
    public function cpgr_shot_info($cpgr_id){
        if(empty($cpgr_id)){
            return false;
        }
        $sql         = "SELECT
                           `plan_group`.`status` AS status
                         FROM
                           `client_plan_group_relation` cpr
                         INNER JOIN `plan_group` ON `plan_group`.`plan_group_id` = cpr.`plan_group_id`
                         WHERE
                           cpr.`client_plan_group_relation_id` = ".$cpgr_id."
                         AND
                           cpr.`delete_flg` = 0
                         AND `plan_group`.`status` IN (6,7,13,14)";
        $query       = $this->db->query($sql);
        $result      = $query->result_array();
        if(empty($result)){
            return false;
        }
        return $result[0]['status'];
    }

    public function get_plan($plan_group_id){
        $sql = "SELECT `plan`.`plan_id`,`plan`.`plan_name`,`plan`.`description`
                    FROM `plan_group_relation`
                    INNER JOIN `plan`
                    ON `plan_group_relation`.`plan_id`=`plan`.`plan_id`
                    WHERE `plan_group_relation`.`plan_group_id` = ".$plan_group_id;
        $query       = $this->db->query($sql);
        $result      = $query->result_array();
        return $result;
    }
    public function cpgr_job($client_id,$limit_type){
        if((empty($client_id))||(empty($limit_type))){
            return false;
        }
        $date_row    = new DateTime('NOW');
        $date        = $date_row->format('Y-m-d');
        $sql         = "SELECT
                               cpr.`client_plan_group_relation_id` AS cpgr_id, cpr.`plan_group_id`, p.`plan_name`, p.`limit_type`,pg.`unit_price`
                             FROM
                               `client_plan_group_relation` cpr
                            INNER JOIN plan_group_relation pgr ON cpr.plan_group_id = pgr.plan_group_id
                            INNER JOIN plan_group pg ON cpr.plan_group_id = pg.plan_group_id
                            INNER JOIN plan p ON pgr.plan_id = p.plan_id
                             WHERE
                               cpr.`client_id` = ".$client_id."
                             AND
                               cpr.`expire_month` >= '".$date."'
                             AND
                               cpr.`created` <= '".$date."'
                             AND
                               cpr.`delete_flg` = 0
                             AND
                               p.limit_type = ".$limit_type."
                            ORDER BY cpr.created DESC
                            LIMIT 1";
        $query       = $this->db->query($sql);
        $result      = $query->result_array();
        return $result;
    }
        public function get_export_data()
        {
            $sql = <<<EOF
                SELECT *
                FROM `plan`
EOF;
            return $this->db->query($sql)->result_array();
        }


        public function get_export_group_data()
        {
            $sql = <<<EOF
            SELECT `plan_group`.*
            FROM `plan_group`
            JOIN `plan_group_relation` ON `plan_group`.`plan_group_id` = `plan_group_relation`.`plan_group_id`
EOF;
            $result = $this->db->query($sql)->result_array();

            $sql2 = <<<EOF
            SELECT `plan`.`plan_name`, `plan_group`.`plan_group_id`
            FROM `plan`
            JOIN `plan_group_relation` ON `plan`.`plan_id` = `plan_group_relation`.`plan_id`
            JOIN `plan_group` ON `plan_group`.`plan_group_id` = `plan_group_relation`.`plan_group_id`
EOF;
            $plans = $this->db->query($sql2)->result_array();

            return array($result, $plans);

        }


    public function get_cpgr_data($cpgr_id){
        //pg.extend_period,
        $sql    = "SELECT cpr.client_plan_group_relation_id,cpr.client_id,cpr.created,cpr.expire_month,cpr.auto_extend_flg AS cpr_auto_extend_flg,pg.name,pg.price,cpr.discount,pg.period,pg.extend_period,pg.auto_extend_flg AS pg_auto_extend_flg,pg.status,pg.plan_group_id
                    FROM client_plan_group_relation cpr
                   INNER JOIN plan_group pg ON pg.plan_group_id = cpr.plan_group_id
                   WHERE cpr.client_plan_group_relation_id = ".$cpgr_id."
                   AND   cpr.delete_flg = 0
                   AND   pg.delete_flg =0 ";
        $result      = $this->db->query($sql)->row_array();

        return $result;
    }

    public function get_all_plan_group()
    {
        $sql = "SELECT * FROM plan_group WHERE delete_flg = 0";
        return $this->db->query($sql)->result_array();
    }

    /**
     * check extend logic for batch
     * @return [type] [description]
     */
    public function check_extend(){
        $now_date         = date('Y-m-d');
        $sql = "SELECT client_plan_group_relation_id FROM client_plan_group_relation
        WHERE expire_month BETWEEN '".$now_date." 00:00:00' AND '".$now_date." 23:59:59'
        AND delete_flg = 0
        AND auto_extend_flg = 1";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    /**
     * check expire date plan
     * @return [type] [description]
     */
    public function check_expire(){
        $now_date         = date('Y-m-d');
        $sql = "SELECT client_plan_group_relation_id FROM client_plan_group_relation
        WHERE expire_month <= '".$now_date." 00:00:00'
        AND delete_flg = 0";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function get_cpgr_info($cpgr_id){
         $sql = "SELECT
                        client_id,
                        plan_group_id,
                        discount,
                        auto_extend_flg
                     FROM client_plan_group_relation
                    WHERE client_plan_group_relation_id = ".$cpgr_id;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function expire($cpgr_id,$extend_flg = 0){
        $sql = "UPDATE client_plan_group_relation SET delete_flg =1
                    WHERE client_plan_group_relation_id IN (".implode(',',$cpgr_id).")
                    AND auto_extend_flg = ".$extend_flg;
        $result = $this->db->query($sql);
        return $result;
    }
    public function group_period($pg_id){
         $sql = "SELECT
                        period
                     FROM plan_group
                    WHERE plan_group_id = ".$pg_id;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function get_all_plan_group_by_client($param){

        extract($param);
        $plan_limit_type = '';

        $plan_limit_type = " AND plan.limit_type = {$limit_type}";


        $sql = "SELECT  p.name, p.plan_group_id, p.unit_price
                FROM `client_plan_group_relation` pg
                LEFT JOIN plan_group p ON p.plan_group_id = pg.`plan_group_id`
                LEFT JOIN plan_group_relation pgr ON pgr.plan_group_id = pg.`plan_group_id`
                LEFT JOIN plan ON pgr.plan_id = plan.`plan_id`
                WHERE pg.`plan_group_id` IN (1,2,3,4,5, 8,9,10,11,12)
                AND pg.`expire_month` >= CURRENT_DATE()
                AND pg.`client_id` = {$client_id}
                AND pg.`delete_flg` = {$delete_flg}
                {$plan_limit_type}";

        $results = $this->db->query($sql)->result_array();
        return $results;
    }

}
?>
