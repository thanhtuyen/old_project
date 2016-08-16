<?php
Class Logic_ads extends MY_Model{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_list($param){
        $now         = new DateTime('NOW');
        $select      = array_to_select_str($param['select']);
        if(is_array($param['ads_group_id'])){
            $ads_group_id= array_to_comma_list($param['ads_group_id']);
            $where = "WHERE `ads_group_id` IN (".$ads_group_id.")";
        }else{
            $ads_group_id= $param['ads_group_id'];
            $where = "WHERE `ads_group_id` = ".$ads_group_id;
        }
        $ads_group_id= $param['ads_group_id'];
        $status      = $param['status'];
        $delete_flg  = $param['delete_flg'];
        $sql         = "SELECT ".$select." FROM `ads`
                        ".$where."
                        AND `status` = ".$status."
                        AND `delete_flg` = ".$delete_flg."\n".
                        "AND `start_date` <= "."'".$now->format("Y-m-d H:i:s")."'"."\n".
                        "AND `end_date` >= "."'".$now->format("Y-m-d H:i:s")."'"."\n".
                        "ORDER BY `ordered` ASC";
        $query       = $this->db->query($sql);
        $result      = $query->result_array();
        return $result;
    }
    public function get_group_list($param){

        $select      = array_to_select_str($param['select']);
        $area_id     = array_to_where_in($param['area_id']);
        $status      = $param['status'];
        $sql         = "SELECT ".$select." FROM `ads_group`
                        WHERE ".$area_id."\n
                        AND `status` = ".$status."\n
                        ORDER BY `ordered` ASC";
        $query       = $this->db->query($sql);
        $result      = $query->result_array();
        return $result;
    }
    /**
     * get ads group for top page
     * @param  $param [select, status, type]
     * @return $result
     */
    public function get_adsgroup_bytype($param){
        $select      = array_to_select_str($param['select']);
        $status      = $param['status'];
        $type        = $param['type'];
        $sql         = "SELECT ".$select." FROM `ads_group`
                        WHERE `status` = ".$status."\n
                        AND `type` = ".$type."\n
                        ORDER BY `ordered` ASC";
        $query       = $this->db->query($sql);
        $result      = $query->result_array();
        return $result;
    }

    public function get_group_id_by_type($param)
    {
        $query_param = array($param['type'], $param['status'] );
        $sql = <<<SQL
        SELECT `ads_group_id` FROM `ads_group`
        WHERE `type` IN ?
        AND `status` = ?
SQL;
        $result = $this->db->query($sql, $query_param)->result_array();

        return array_column($result, 'ads_group_id');


    }

    public function get_total_count($param)
    {
        //$status = $param['status'];
        $delete_flg = $param['delete_flg'];
        $ads_group_id = $param['group_id'];
        $current_time = current_time();

        $query_param = array($ads_group_id, $delete_flg, $current_time, $current_time);//$status
                $sql = <<<SQL
SELECT count(*) AS total FROM `ads`
WHERE `ads_group_id` IN ?
AND `delete_flg` = ?
AND `start_date` <= ?
AND `end_date` >= ?
SQL;
//AND `status` = ?
        if (! is_null($param['keyword'])) {
            $sql .= <<<EOF
             AND `title` LIKE ?
EOF;
            $keyword = "%{$param['keyword']}%";
            array_push($query_param, $keyword);
        }

        $sql .= <<<EOF
        ORDER BY `ordered` ASC
EOF;

        $query = $this->db->query($sql, $query_param);

        return $query->row_array()['total'];

    }

    public function get_list_of_admin($param)
    {
        //$status = $param['status'];
        $delete_flg = $param['delete_flg'];
        $ads_group_id = $param['group_id'];
        $current_time = current_time();
        $type = $param['type'];
        $query_param = array($delete_flg, $type, $ads_group_id, $delete_flg,); //$statusをいれると非公開のものももってこれなくなってしまう
         // $current_time, $current_time);

        $sql = <<<SQL
SELECT `ads`.*, `image`.`name` as photo, `image`. `type`
FROM `ads`
LEFT JOIN `image` ON `image`.`account_id` = `ads`.`ads_id` AND `image`.`delete_flg` = ? AND `image`.`type` = ?
WHERE `ads`.`ads_group_id` IN ?
AND `ads`.`delete_flg` = ?
SQL;
// AND `start_date` <= ?
// AND `end_date` >= ?
//AND `ads`.`status` = ?
        if (isset($param['keyword']) && ! is_null($param['keyword'])) {
            $sql .= <<<EOF
             AND `title` LIKE ?
EOF;
            $keyword = "%{$param['keyword']}%";
            array_push($query_param, $keyword);
        }

        $sql .= <<<EOF
                ORDER BY `ads_id` ASC
EOF;
        if (isset($param['offset'], $param['limit'])) {
            $sql .= <<<EOF
            LIMIT {$param['offset']}, {$param['limit']}
EOF;
        }


        return $this->db->query($sql,  $query_param)->result_array();


    }

    public function get_detail_of_admin($param)
    {
        // $status = $param['status'];
        $delete_flg = $param['delete_flg'];
        $ads_id = $param['ads_id'];

        $select = '`ads`.*, `ads_group`.`area_id`, `ads_group`.`status` as group_status';

        $query_param = array($ads_id, $delete_flg);
        $sql = <<<SQL
SELECT {$select} FROM `ads`
JOIN `ads_group` ON `ads_group`.`ads_group_id` = `ads`.`ads_group_id`
WHERE `ads`.`ads_id` = ?
AND `ads`.`delete_flg` = ?
SQL;
        return $this->db->query($sql,  $query_param)->row_array();
    }

    public function get_position_group($param)
    {
        $ads_group_id = $param['ads_group_id'];

        $query_param = array($ads_group_id);
        $sql = <<<SQL
SELECT `ads_group_id`, `name` FROM `ads_group`
WHERE `ads_group`.`type` IN ?
SQL;
        return $this->db->query($sql,  $query_param)->result_array();
    }

    public function update($param)
    {
        $ads_id = $param['ads_id'];
        unset($param['ads_id']);
        $fields = implode(',', array_map(function($k){
                return '`'. $k .'` = ?';
            }, array_keys($param))
        );
        $query_param = array_merge(array_values($param), array($ads_id));

        $sql = <<<EOF
UPDATE `ads`
SET {$fields}
WHERE `ads_id` = ?
EOF;

        $this->db->query($sql, $query_param);

        return (bool) $this->db->affected_rows();
    }

    public function update_group($param)
    {
        $ads_group_id = $param['ads_group_id'];
        unset($param['ads_group_id']);
        $fields = implode(',', array_map(function($k){
                return '`'. $k .'` = ?';
            }, array_keys($param))
        );
        $query_param = array_merge(array_values($param), array($ads_group_id));

        $sql = <<<EOF
UPDATE `ads_group`
SET {$fields}
WHERE `ads_group_id` = ?
EOF;

        $this->db->query($sql, $query_param);

        return (bool) $this->db->affected_rows();
    }

    public function update_text($param)
    {
        $where = array();
        foreach ($param as $value) {
            $where['ordered'][] = <<<EOF
            WHEN `ads_id` = '{$value['ads_id']}' THEN '{$value['ordered']}'
EOF;
            $where['title'][] = <<<EOF
            WHEN `ads_id` = '{$value['ads_id']}' THEN '{$value['title']}'
EOF;
            $where['url'][] = <<<EOF
            WHEN `ads_id` = '{$value['ads_id']}' THEN '{$value['url']}'
EOF;
            $where['start_date'][] = <<<EOF
            WHEN `ads_id` = '{$value['ads_id']}' THEN '{$value['start_date']}'
EOF;
            $where['end_date'][] = <<<EOF
            WHEN `ads_id` = '{$value['ads_id']}' THEN '{$value['end_date']}'
EOF;
        }

        $sql = 'UPDATE `ads` SET';

        foreach ($where as $key => $w) {
            $sql .= '`'. $key .'` = CASE ';
            $sql .= implode(' ', $w);
            $sql .= ' ELSE `'. $key .'` END, ';
        }

        $sql = rtrim($sql, ', ');
        $sql .= ' WHERE `ads_id` IN ?';

        $ads_id = array_column($param, 'ads_id');

        $this->db->query($sql, array($ads_id));
        return (bool) $this->db->affected_rows();
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
INSERT INTO `ads` ({$fields})
VALUES ({$bind_str})
EOF;

        $this->db->query($sql, $query_param);
        return $this->db->insert_id();
    }

        public function save_batch($params)
        {

            $fields = implode(',', array_map(function($k){
                    return '`'. $k .'`';
                }, array_keys($params['0']))
            );

            $query_param = call_user_func_array('array_merge', array_map(
                function($param){
                    return array_values($param);
                }, $params)
            );
            $bind_str = rtrim(str_repeat('(?, ?, ?, ?, ?, ?, ?, ?, ?, ?),', count($query_param) / 10), ', ');

        $sql = <<<EOF
INSERT INTO `ads` ({$fields})
VALUES {$bind_str}
EOF;

            $this->db->query($sql, $query_param);
            return (bool) $this->db->insert_id();
        }

        public function delete_flg($param)
        {
            $ads_id = $param['ads_id'];
            unset($param['ads_id']);
            $fields = implode(',', array_map(function($k){
                    return '`'. $k .'` = ?';
                }, array_keys($param))
            );
            $query_param = array_merge(array_values($param), array($ads_id));

            $sql = <<<EOF
UPDATE `ads`
SET {$fields}
WHERE `ads_id` = ?
EOF;

            $this->db->query($sql, $query_param);

            return (bool) $this->db->affected_rows();
        }













}
?>
