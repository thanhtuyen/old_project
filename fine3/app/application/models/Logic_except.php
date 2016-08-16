<?php
Class Logic_except extends MY_Model{

   public function __construct()
    {
        parent::__construct();
    }

    public function get_total_count($condition, $param)
    {
        $delete_flg = $param['delete_flg'];
        $status = $param['status'];
        $query_param = array($status, $delete_flg);
        $table = $condition['name'];
        $sql = <<<SQL
SELECT count('*') AS total
FROM  {$table}
WHERE `status` = ? AND `delete_flg` = ?
SQL;
        if (! empty($condition['keyword'])) {
            $sql .= <<<SQL
             AND `client_comment`  LIKE ?
SQL;
            $keyword = "%{$condition['keyword']}%";
            array_push($query_param, $keyword);
        }
        $query = $this->db->query($sql, $query_param);
        return $query->row_array()['total'];
    }

              /**
     * [get jobs list]
     * @param  [string] $condition
     * @param  [array] $param
     * @return [array]
     */
    public function get_condition_list($condition, $param)
    {
        $delete_flg = $param['delete_flg'];
        $status = $param['status'];
        $query_param = array($status, $delete_flg);
        $table = $condition['name'];

        $sql = '';

        $sql = $this->generate_list_sql($table);

        if (! empty($condition['keyword'])) {
            $sql .= "AND `".$table."`.`client_comment` LIKE ?";
            $keyword = "%".$condition['keyword']."%";
            array_push($query_param, $keyword);
        }
        $sql .= <<<SQL
        LIMIT {$param['offset']}, {$param['limit']}
SQL;
        $query = $this->db->query($sql, $query_param);
        return $query->result_array();
    }


    public function get_job_detail($param)
    {

        $query_param = array($param['delete_flg'], $param['applicant_job_id']);
        $sql = <<<SQL
SELECT `a`.`applicant_job_id`,
`a`.`user_id`,
`user`.`name`,
`a`.`created`,
`a`.`client_comment`,
`a`.`job_id`
FROM `applicant_job` `a`
LEFT JOIN `user` ON `a`.`user_id` = `user`.`user_id`
WHERE `a`.`delete_flg` = ?
AND `a`.`applicant_job_id` = ?
SQL;

        $query = $this->db->query($sql, $query_param);
        return $query->row_array();
    }
    public function get_agency_detail($param)
    {
        $query_param = array($param['delete_flg'], $param['applicant_agency_id']);
            $sql = <<<SQL
SELECT `applicant_agency`.`applicant_agency_id`,
`client`.`name`,
`client`.`client_id`,
`user`.`name` as user_name,
`user`.`user_id` as user_id,
`applicant_agency`.`created`,
`applicant_agency`.`status`,
`applicant_agency`.`client_comment`
FROM `applicant_agency`
LEFT JOIN `client` ON `applicant_agency`.`client_id` = `client`.`client_id`
LEFT JOIN `user` ON `applicant_agency`.`user_id` = `user`.`user_id`
WHERE `applicant_agency`.`delete_flg` = ?
AND `applicant_agency`.`applicant_agency_id` = ?
SQL;
        $query = $this->db->query($sql, $query_param);
        return $query->row_array();
    }

    public function confirm($param)
    {
        $table = $param['table'];
        $sql = $this->generate_confirm_sql($table, $param['status']);

        $query_param = array($param['status'], $param['id']);

        $this->db->query($sql, $query_param);

        return (bool) $this->db->affected_rows();
    }

    private function generate_list_sql($table)
    {
        if ($table == 'applicant_job') {
            $sql = <<<SQL
SELECT `applicant_job`.`applicant_job_id`,
`applicant_job`.`user_id`,
`applicant_job`.`job_id`,`applicant_job`.`client_comment`,
`applicant_job`.`status`,`applicant_job`.`created`,
`user`.`name`,
`job`.`title`
FROM `{$table}` 
LEFT JOIN `user` ON `applicant_job`.`user_id` = `user`.`user_id`
LEFT JOIN `job` ON `applicant_job`.`job_id` = `job`.`job_id`
WHERE `applicant_job`.`status` = ? AND `applicant_job`.`delete_flg` = ?
SQL;
        }

        if($table== 'applicant_agency'){

            $sql = <<<SQL
SELECT `applicant_agency`.`applicant_agency_id`,
`applicant_agency`.`client_comment`,
`client`.`name` AS `client_name`,
`user`.`name` AS `user_name`,
`applicant_agency`.`user_id`,
`client`.`client_id`,
`applicant_agency`.`created`,
`applicant_agency`.`status`
FROM `{$table}`
LEFT JOIN `client` ON `applicant_agency`.`client_id` = `client`.`client_id`
LEFT JOIN `user` ON `applicant_agency`.`user_id` = `user`.`user_id`
WHERE `applicant_agency`.`status` = ? AND `applicant_agency`.`delete_flg` = ?
SQL;
        }

        return $sql;
    }

        private function generate_confirm_sql($name, $status)
        {
            $set_fix_date = '';
            if ($status == 1 || $status == 3) {
                $set_fix_date = ",`fix_date` = '".date("Y-m-d H:i:s")."'";
            }
            if ($name == 'job') {
                $table = 'applicant_job';
                $sql = <<<SQL
                UPDATE `{$table}`
                SET `status` = ? {$set_fix_date}
                WHERE `applicant_job_id` = ?
SQL;
            }

            if($name == 'agency'){
                $table = 'applicant_agency';
                $sql = <<<SQL
                UPDATE `{$table}`
                SET `status` = ? {$set_fix_date}
                WHERE `applicant_agency_id` = ?
SQL;
            }

            return $sql;
        }

        public function get_export_data($table)
        {

            if ($table == 'agency') {
                return  $this->get_agency_export_data();
            } else{
                return $this->get_job_export_data();
            }






        }

        public function get_agency_export_data()
        {
            $relation_client = $this->config->item('type_relation_client', 'tag_config');
            $license = $this->config->item('tag_license','tag_config');
            $employ_type = $this->config->item('type_employ','tag_config');
            $select = '
            `applicant_agency`.`applicant_agency_id`,
            `applicant_agency`.`client_id`,
            `applicant_agency`.`user_id`,
            `applicant_agency`.`status`,
            `applicant_agency`.`created`,
            `client`.`name` as client_name,
            `user`.`name`,
            `user`.`name_kana`,
            `user`.`birthdate`,
            `user`.`mail`,
            `user`.`gender`,
            `user`.`zip_code`,
            `user`.`address`,
            `user`.`phone`,
            `province`.`name` as `province`,
            `area`.`name` as `city`
            ';
            $sql = <<<SQL
            SELECT {$select}
            FROM `applicant_agency`
            JOIN `user` ON `user`.`user_id` = `applicant_agency`.`user_id`
            JOIN `client` ON `client`.`client_id` = `applicant_agency`.`client_id`
            LEFT JOIN `client_area_relation` ON `client_area_relation`.`client_id` = `client`.`client_id`
            LEFT JOIN `area` ON `area`.`area_id` = `user`.`area_id`
            LEFT JOIN `area` AS `province` ON `province`.`area_id` = `area`.`region_id`
SQL;
            $license_sql = <<<SQL
            SELECT `tag`.`name` as `license`, `applicant_agency`.`applicant_agency_id`
            FROM `applicant_agency`
             JOIN `tag_relation` ON `tag_relation`.`account_id` = `applicant_agency`.`client_id` AND `tag_relation`.type = {$relation_client}
             JOIN `tag` ON `tag`.`tag_id` = `tag_relation`.`tag_id` AND `tag`.`tag_group_id` = {$license}
SQL;
            $employ_type_sql = <<<SQL
            SELECT `tag`.`name` as `employ_type`, `applicant_agency`.`applicant_agency_id`
            FROM `applicant_agency`
             JOIN `tag_relation` ON `tag_relation`.`account_id` = `applicant_agency`.`client_id`  AND `tag_relation`.type = {$relation_client}
             JOIN `tag`  ON `tag`.`tag_id` = `tag_relation`.`tag_id` AND `tag`.`tag_group_id` = {$employ_type}
SQL;


            $result = $this->db->query($sql)->result_array();
            $license = $this->db->query($license_sql)->result_array();
            $employ_type = $this->db->query($employ_type_sql)->result_array();

            return array($result, $license, $employ_type);

        }

        public function get_job_export_data()
        {
            $relation_user = $this->config->item('type_relation_user', 'tag_config');
            $employ_type = $this->config->item('type_employ', 'tag_config');
            $license = $this->config->item('tag_license','tag_config');
            $select = '
            `applicant_job`.`applicant_job_id`,
            `client`.`client_id`,
            `client`.`name` as client_name,
            `applicant_job`.`job_id`,
            `nursery`.`name` as nursery_name,
            `job`.`title`,
            `applicant_job`.`user_id`,
            `user`.`name`,
            `user`.`name_kana`,
            `user`.`birthdate`,
            `user`.`mail`,
            `user`.`gender`,
            `user`.`zip_code`,
            `user`.`address`,
            `area`.`name` as `city`,
            `user`.`phone`,
            `province`.`name` as `province`,
            `applicant_job`.`status`,
            `applicant_job`.`created`
            ';
            $sql = <<<SQL
            SELECT {$select}
            FROM `applicant_job`
            JOIN `user` ON `user`.`user_id` = `applicant_job`.`user_id`
            JOIN `job` ON `job`.`job_id` = `applicant_job`.`job_id`
            JOIN `nursery` ON `nursery`.`nursery_id` = `job`.`nursery_id`
            JOIN `client` ON `client`.`client_id` = `nursery`.`client_id`
            LEFT JOIN `client_area_relation` ON `client_area_relation`.`client_id` = `client`.`client_id`
            LEFT JOIN `area` ON `area`.`area_id` = `user`.`area_id`
            LEFT JOIN `area` AS `province` ON `province`.`area_id` = `area`.`region_id`
SQL;

            $employ_type_sql = <<<SQL
            SELECT `tag`.`name` as `employ_type`, `applicant_job`.`applicant_job_id`
            FROM `applicant_job`
             JOIN `tag_relation` ON `tag_relation`.`account_id` = `applicant_job`.`user_id` AND `tag_relation`.type = {$relation_job}
             JOIN `tag`  ON `tag`.`tag_id` = `tag_relation`.`tag_id` AND `tag`.`tag_group_id` = {$employ_type}
SQL;
            $license_sql = <<<SQL
            SELECT `tag`.`name` as `license`, `applicant_job`.`applicant_job_id`
            FROM `applicant_job`
             JOIN `tag_relation` ON `tag_relation`.`account_id` = `applicant_job`.`user_id` AND `tag_relation`.type = {$relation_job}
             JOIN `tag`  ON `tag`.`tag_id` = `tag_relation`.`tag_id` AND `tag`.`tag_group_id` = {$license}
SQL;

            $result = $this->db->query($sql)->result_array();
            $employ_type = $this->db->query($employ_type_sql)->result_array();
            $license = $this->db->query($license_sql)->result_array();

            return array($result, $license, $employ_type);
        }








}
