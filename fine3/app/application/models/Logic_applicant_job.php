<?php
Class Logic_applicant_job extends MY_Model
{


    public function __construct()
    {
        parent::__construct();
    }

    private function getStatusText($number)
    {
        // $status = [
        //     '課金対象',
        //     '非課金申請の申請中',
        //     '非課金申請の承認済',
        //     '非承認',
        // ];
        $status = [
            '未確定',
            '申請中',
            '非確定',
            '確定',
        ];
        return $status[$number];
    }

    private function getGenderText($number)
    {
        $status = [
            '1' => '女性',
            '2' => '男性',
        ];

        return $status[$number];
    }

    public function confirm($applicant_job_id){
        $sql = "UPDATE `applicant_job`
        SET `status` = 3, `fix_date` = '".date("Y-m-d H:i:s")."'
        WHERE `applicant_job_id` IN (".implode(",",$applicant_job_id).")";
        $result = $this->db->query($sql);
        return $result;
    }



    /**
     * set status = 1 for applicants
     *
     * @param   array  $post  Array [$ids , client_comment]
     *
     * @return  array  Data of applicant
     */
    public function exclude($post)
    {
        $result = false;

        $idstring = "'".implode("', '", $post['ids'])."'";

        //CHECK PERMISSION
        $sql = "SELECT a.client_comment, u.name as user_name, c.name as client_name

        FROM applicant_job as a

        INNER JOIN job as j ON j.job_id = a.job_id
        INNER JOIN user as u ON u.user_id = a.user_id
        INNER JOIN nursery as n ON n.nursery_id = j.nursery_id
        INNER JOIN client as c ON c.client_id = n.client_id

        WHERE a.applicant_job_id IN ($idstring)
        AND c.client_id = '".$post['client_id']."'
        ";

        $items = $this->db->query($sql)->result_array();


        if (!empty($items))
        {
            if (isset($post['client_comment']))
            {
                $sql = "UPDATE applicant_job
                    SET status = '1', `fix_date` = '".date("Y-m-d H:i:s")."', client_comment = '".$post['client_comment']."'
                                WHERE applicant_job_id IN ($idstring)";
            }else{
                $sql = "UPDATE applicant_job set status = 1, `fix_date` = '".date("Y-m-d H:i:s")."'
                         WHERE applicant_job_id IN ($idstring)";
            }

            $result = $this->db->query($sql);

            if ($result)
            {
                //BECAUSE UPDATE client_comment for every items
                $sql = "SELECT a.client_comment, u.name as user_name, c.name as client_name

                FROM applicant_job as a

                INNER JOIN job as j ON j.job_id = a.job_id
                INNER JOIN user as u ON u.user_id = a.user_id
                INNER JOIN nursery as n ON n.nursery_id = j.nursery_id
                INNER JOIN client as c ON c.client_id = n.client_id

                WHERE a.applicant_job_id IN ($idstring)
                AND a.status = '1'
                AND a.status = '1'
                AND c.client_id = '".$post['client_id']."'
                ";

                $items = $this->db->query($sql)->result_array();
            }
        }


        return $items;
    }

        public function update($param)
        {
            $applicant_job_id = $param['applicant_job_id'];
            unset($param['applicant_job_id']);
            $fields = implode(',', array_map(function($k){
                    return '`'. $k .'` = ?';
                }, array_keys($param))
            );
            $query_param = array_merge(array_values($param), array($applicant_job_id));

        $sql = <<<EOF
UPDATE `applicant_job`
SET {$fields}
WHERE `applicant_job_id` = ?
EOF;


            $this->db->query($sql, $query_param);

            return (bool) $this->db->affected_rows();
        }

    /**
     * set status = 0 for applicants
     *
     * @param   array  $post  Array [$ids , client_comment]
     *
     * @return  array  Data of applicant
     */
    public function active($post)
    {
        $result = false;

        $idstring = "'".implode("', '", $post['ids'])."'";

        //CHECK PERMISSION
        $sql = "SELECT a.client_comment, u.name as user_name, c.name as client_name

        FROM applicant_job as a

        INNER JOIN job as j ON j.job_id = a.job_id
        INNER JOIN user as u ON u.user_id = a.user_id
        INNER JOIN nursery as n ON n.nursery_id = j.nursery_id
        INNER JOIN client as c ON c.client_id = n.client_id

        WHERE a.applicant_job_id IN ($idstring)

        AND c.client_id = '".$post['client_id']."'
        ";

        $items = $this->db->query($sql)->result_array();


        if (!empty($items))
        {
            if (isset($post['client_comment']))
            {
                $sql = "UPDATE applicant_job
                    SET status = '0', client_comment = '".$post['client_comment']."'
                                WHERE applicant_job_id IN ($idstring)";
            }else{
                $sql = "UPDATE applicant_job set status = '0' WHERE applicant_job_id IN ($idstring)";
            }

            $result = $this->db->query($sql);

            if ($result)
            {
                //BECAUSE UPDATE client_comment for every items
                $sql = "SELECT a.client_comment, u.name as user_name, c.name as client_name

                FROM applicant_job as a

                INNER JOIN job as j ON j.job_id = a.job_id
                INNER JOIN user as u ON u.user_id = a.user_id
                INNER JOIN nursery as n ON n.nursery_id = j.nursery_id
                INNER JOIN client as c ON c.client_id = n.client_id

                WHERE a.applicant_job_id IN ($idstring)
                AND a.status = '0'
                AND c.client_id = '".$post['client_id']."'
                ";

                $items = $this->db->query($sql)->result_array();
            }
        }


        return $items;
    }

    /**
     * get list of applicants
     * to get exclude list : $params['status' => [3]]
     * to get item detail  : $params['applicant_job_id' => 1]
     *
     * @param   array  $params
     *
     * @return  array
     */
    public function getList($params)
    {
        //search condition
        if(empty($params['wish_job'])){
            $params['wish_job'] = "";
        }
        if(empty($params['applicant_status'])){
            $params['applicant_status'] = "";
        }

        $client_id = $params['client_id'];
        $curpage = isset($params['curpage']) ? $params['curpage'] : 1;
        $perpage = isset($params['perpage']) ? $params['perpage'] : 1;


        $sql = "SELECT a.applicant_job_id, 
            a.created, 
            a.status, 
            a.client_comment,
            a.admin_comment,
            a.unit_price,
            j.title as job_title, j.job_id,

            n.nursery_id,
            n.name as nursery_name, 
            n.address as nursery_address,
            area.name as nursery_city,
            province.name as nursery_province,

            u.user_id, u.area_id as user_area_id, 
            u.mail as user_email, 
            u.name as user_name, 
            u.name_kana as user_name_kana,
            u.gender as user_gender, 
            u.phone as user_phone,
            u.birthdate as user_birthdate, 
            DATE_FORMAT(u.birthdate, '%Y年%m月%d日') as user_birthdate_text,
            TIMESTAMPDIFF(YEAR,u.birthdate,CURDATE()) AS user_age,
            u.address as user_address,
            recomment.name as recomment,
            t.name as type_job,
            tu.name as wish_job

        FROM applicant_job as a

        INNER JOIN user as u ON u.user_id = a.user_id
        INNER JOIN job as j ON j.job_id = a.job_id
        INNER JOIN nursery as n ON n.nursery_id = j.nursery_id
        INNER JOIN client as c ON c.client_id = n.client_id

        LEFT JOIN area as area ON area.area_id = n.area_id
        LEFT JOIN area as province ON province.area_id = area.region_id

        LEFT JOIN tag_relation as tr ON tr.account_id = j.job_id AND tr.type = '1'
        LEFT JOIN tag as t ON t.tag_id = tr.tag_id AND t.tag_group_id = '2'

        LEFT JOIN tag_relation as tru ON tru.account_id = u.user_id AND tru.type = '0'
        LEFT JOIN tag as tu ON tu.tag_id = tru.tag_id AND tu.tag_group_id = '3'

        LEFT JOIN  tag as recomment ON recomment.tag_id = tr.tag_id AND recomment.tag_group_id = '8'
        ";

        // WHERE conditions
        $where = [
            "a.delete_flg='0'",
            "j.delete_flg='0'",
            "c.client_id = '$client_id'"
        ];

        if (isset($params['applicant_status']) && is_array($params['applicant_status']))
        {
            $status = "'".implode("', '", $params['applicant_status'])."'";
            $where[] = "a.status IN ($status)";
        }

        $whereor = array();

        // SEARCH KEY: user.name, job.title, tag.name
        if (isset($params['keyword']) && $params['keyword'])
        {
            $keyword = $params['keyword'];

            $whereor[] = "u.name collate utf8_unicode_ci LIKE '%$keyword%'";
            $whereor[] = "j.title collate utf8_unicode_ci LIKE '%$keyword%'";
            $whereor[] = "t.name collate utf8_unicode_ci LIKE '%$keyword%'";
            $whereor[] = "u.mail LIKE '%$keyword%'";
            $whereor[] = "n.name collate utf8_unicode_ci LIKE '%$keyword%'";

            $where[] = ' ( ' . implode(' OR ', $whereor) . ' ) ';
        }

        // SEARCH DATE
        if (isset($params['start_date']) && $params['start_date'])
        {
            $where[] = "DATE_FORMAT(a.created, '%Y-%m-%d') >= '".$params['start_date']."'";
        }

        if (isset($params['end_date']) && $params['end_date'])
        {
            $where[] = "DATE_FORMAT(a.created, '%Y-%m-%d') <= '".$params['end_date']."'";
        }
        if($params['wish_job'] !==""){
            $where[] = "tu.tag_id = ".$params['wish_job'];
        }

        // GET DETAIL
        if (isset($params['applicant_job_id']) && (int)$params['applicant_job_id'])
        {
            $where[] = "a.applicant_job_id = '".$params['applicant_job_id']."'";
        }
        $sql .= " WHERE " . implode(' AND ', $where);

        if(!empty($params['export_app_job_ids'])) {
            $app_job_ids_array = explode('_', $params['export_app_job_ids']);
            unset($app_job_ids_array[0]);
            $app_job_ids = "'".implode("', '", $app_job_ids_array)."'";
            $sql .= " AND a.applicant_job_id IN ($app_job_ids)";
        }

        $sql .= " GROUP BY a.applicant_job_id ";
        $sql .= " ORDER BY a.created DESC";

        $string = $sql;


        $query =$this->db->query($string);
        $total = $query->num_rows();



        $limit_start = ($curpage - 1) * $perpage;
        $limit_end = $perpage;
        if(empty($params['export_app_job_ids'])) {
            $sql .= " LIMIT $limit_start, $limit_end ";
        }
        $items = $this->db->query($sql)->result_array();

        $items = $this->prepareData($items);


        $result = [
            'items'   => $items,
            'total'   => $total,
            'perpage' => $perpage,
            'item_start'  => $limit_start + 1,
            'item_end'  => $limit_start + count($items),
        ];

        return $result;
    }

    /**
     *
     */
    protected function prepareData($items)
    {
        $this->load->model('Logic_tag_relation');
        $this->load->model('Logic_job');
        $this->load->model('Logic_user');

        foreach ((array)$items as $k=>$item){
            //get group 3: tag_employ
            $params = [
                'type' => 1,
                'account_id' => $item['job_id'],
                'tag_group_id' => 3,
            ];

            $data = $this->Logic_tag_relation->getTags($params);

            if (isset($data[0]) && !empty($data[0])){
                $items[$k]['tag_employ'] = $data[0]['name'];
            }else{
                $items[$k]['tag_employ'] = '';
            }


            // get group 5: tags of job
            $params = [
                'type' => 1,
                'account_id' => $item['job_id'],
                'tag_group_id' => 5,
            ];

            $items[$k]['tags'] = $this->Logic_tag_relation->getTags($params);

            // get images
            $images = $this->Logic_job->getImages($item['job_id']);
            $items[$k]['image'] = '';

            if (isset($images[0]))
            {
                $items[$k]['image'] = $images[0]['name'];
            }

            $items[$k]['applicant_status'] = $this->getStatusText($item['status']);

            //    user_area_text user_license

            $items[$k]['user_gender_text'] = $this->getGenderText($item['user_gender']);
            $items[$k]['user_address_full'] = $this->Logic_user->getAddressFull($item['user_id']);

            // tag group = 4
            $items[$k]['user_license'] = $this->Logic_user->getlicense($item['user_id']);

            if ($item['status'] == 0){
                $items[$k]['pay_status'] = 'なし';
            }else{
                $items[$k]['pay_status'] = 'あり';
            }
        }

        return $items;
    }

    /**
     * get_detail only returns applicant_job_id array
     * @param
     *   $select      = $param['select'];
     *   $user_id     = $param['user_id'];
     *   $job_id      = $param['job_id'];
     *   $status      = $param['status'];
     *   $delete_flg  = $param['delete_flg'];
     * @return array
     */
    public function get_detail($param){
        $select      = array_to_select_str($param['select']);
        $user_id     = $param['user_id'];
        $job_id      = $param['job_id'];
        $delete_flg  = $param['delete_flg'];
        $query_param = array($user_id,$job_id,$delete_flg);
        $sql         = "SELECT {$select} FROM `applicant_job`
                        WHERE `user_id` = ?
                        AND `job_id` = ?
                        AND `delete_flg` = ?  ";
        $query       = $this->db->query($sql, $query_param);
        $result      = $query->result_array();
        return $result;
    }

    /**
     * for check permission
     *
     * @param   integer  $applicant_job_id
     * @param   integer  $client_id
     *
     * @return  bool
     */
    public function checkPermission($applicant_job_id, $client_id)
    {
        $sql = "select applicant_job_id
                from applicant_job as a
                inner join job as j ON j.job_id = a.job_id
                inner join nursery as n ON n.nursery_id = j.nursery_id
                inner join client as c ON c.client_id = n.client_id

                where c.client_id = '$client_id'
                  and a.applicant_job_id = '$applicant_job_id'
            ";

        $result = $this->db->query($sql)->result_array();

        return isset($result[0]);
    }

    public function check_apply($user_id,$job_id){
        $sql = "SELECT COUNT(*) AS count FROM applicant_job
                WHERE user_id = {$user_id}
                AND   job_id = {$job_id}
                AND   delete_flg = 0";
        $result = $this->db->query($sql)->row_array();

        if($result["count"] === "0"){
            return false;
        }else{
            return true;
        }
    }

    /**
     * add applicant_job
     * @param  (array)$params
     * @return boolean
     */
    public function add_applicant_job($params)
    {
        $job_id = $params[1];
        $this->load->model('Service_job');
        $client_id = (int)$this->Service_job->get_client_id($job_id);

        $params[1] = $client_id;

        $params= $this->get_apply_status_param($params);
        $params[1] = $job_id;



        $sql = "INSERT INTO applicant_job(user_id, job_id, created, unit_price,status) VALUES(?, ?, ?, ?, ?)";
        return $this->db->query($sql, $params);
    }
    /**
     * Get row already exist in database
     * @param array $param
     * @return array
     */
    public function get_row($param){
        $select      = array_to_select_str($param['select']);
        $user_id     = $param['user_id'];
        $job_id      = $param['job_id'];
        $status      = $param['status'];
        $delete_flg  = $param['delete_flg'];
        $query_param = array($user_id,$job_id,$status,$delete_flg);
        $sql         = "SELECT {$select} FROM `applicant_job`
                        WHERE `user_id` = ?
                        AND `job_id` = ?
                        AND `status` IN ?
                        AND `delete_flg` = ?  ";
        $query       = $this->db->query($sql, $query_param);
        $result      = $query->result_array();
        return $result;
    }

    public function get_applicant_job_count($params){
        $sql         = "SELECT COUNT(*) FROM `applicant_job`
                        WHERE `user_id` = ".$params['user_id']."
                        AND `delete_flg` = 0";
        return $this->db->query($sql)->row_array();
    }



      /**
     * return total count
     * @param  [array] $condition
     * @return [int]
     */
    public function get_total_count($condition)
    {
        $query_param = array(0);
        $sql = <<<SQL
SELECT count('*') AS total
FROM applicant_job
SQL;

        if (! empty($condition['keyword'])) {
            $sql .= <<<SQL
 LEFT JOIN user ON user.user_id = applicant_job.user_id
LEFT JOIN job ON applicant_job.job_id = job.job_id
JOIN nursery ON nursery.nursery_id = job.nursery_id
JOIN client ON client.client_id = nursery.client_id
SQL;
        }

        $sql .= <<<SQL
 WHERE applicant_job.`delete_flg` = ?
SQL;
        if (! empty($condition['keyword'])) {
            $sql .= <<<SQL
             AND (`client_comment` LIKE ? OR `user`.`name` LIKE ? OR `user`.`mail` LIKE ? OR `client`.`name` LIKE ?)
SQL;
            $keyword = "%{$condition['keyword']}%";
            array_push($query_param, $keyword, $keyword, $keyword, $keyword);
        }

        if (! empty($condition['status'])){
            if($condition['status'] == 'not_sure') {
                $condition['status'] = 0;
            }
            $sql .= <<<SQL
             AND `applicant_job`.`status` = ?
SQL;
            $status = "{$condition['status']}";
            array_push($query_param, $status);
        }

        if (! empty($condition['apply_start_time'])){
            $sql .= <<<SQL
             AND `applicant_job`.`created` >= ?
SQL;
            $start_time = "{$condition['apply_start_time']}";
            array_push($query_param, $start_time);
        }

        if (! empty($condition['apply_end_time'])){
            $sql .= <<<SQL
             AND `applicant_job`.`created` <= ?
SQL;
            $end_time = "{$condition['apply_end_time']}";
            array_push($query_param, $end_time);
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
	$limit_type = '(5,6)';

        $query_param = array($delete_flg);
        $sql = <<<SQL
SELECT a.applicant_job_id AS applicant_id,
a.user_id AS user_id,
u.name AS user_name,
a.job_id AS job_id,
a.client_comment AS client_comment,
a.admin_comment AS admin_comment,
a.created AS created,
a.fix_date AS fix_date,
a.unit_price AS unit_price,
a.status AS status,
client.client_id AS client_id,
client.name AS client_name

FROM applicant_job AS a
LEFT JOIN user AS u ON u.user_id = a.user_id
LEFT JOIN job AS j ON a.job_id = j.job_id
LEFT JOIN nursery ON nursery.nursery_id = j.nursery_id
LEFT JOIN client ON client.client_id = nursery.client_id
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

    public function get_export_data()
    {

        $sql = <<<EOF
SELECT *
FROM applicant_job
EOF;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

     public function get_admin_detail($id)
    {
        $query_param = array($id);
        $sql = <<<SQL
SELECT
a.applicant_job_id AS applicant_id,
a.client_comment,
a.admin_comment,
a.user_id,
a.job_id,
a.unit_price,
j.title AS job_title,
a.created AS created,
a.fix_date AS fix_date,
a.status AS status,
c.name AS client_name,
c.display_name AS client_display_name,
c.client_id AS client_id,
u.name AS user_name,
u.area_id AS user_area_id,
u.address AS user_address
FROM applicant_job AS a
LEFT JOIN user AS u ON u.user_id = a.user_id
LEFT JOIN job AS j ON a.job_id = j.job_id
LEFT JOIN nursery AS n ON n.nursery_id = j.nursery_id
LEFT JOIN client AS c ON c.client_id = n.client_id
WHERE a.delete_flg = 0
AND
a.applicant_job_id = ?
SQL;
        $query = $this->db->query($sql, $query_param);
        return $query->row_array();
    }

    public function delete_flg($id)
    {
        $query_param = array($id);
        $sql = <<<SQL
UPDATE applicant_job SET delete_flg = 1 WHERE applicant_job_id = ? AND delete_flg = 0
SQL;
        $this->db->query($sql, $query_param);
        return  $this->db->affected_rows();
    }

    public function get_count($job_id){
        $sql = "SELECT COUNT(*) AS count FROM `applicant_job`
                        WHERE `job_id` = ".$job_id."
                        AND `delete_flg` = 0
                        AND `status` IN(0,3)";
        $result = $this->db->query($sql);
        return $result->result_array();
    }


    public function check_user_apply_same_client($user_id, $client_id, $day = 60){
        $sql = "SELECT applicant_job.status
                FROM `applicant_job`
                LEFT JOIN job ON job.job_id = applicant_job.job_id
                LEFT JOIN nursery ON nursery.nursery_id = job.nursery_id
                LEFT JOIN client ON client.client_id = nursery.client_id
                WHERE applicant_job.user_id = {$user_id}
                AND client.client_id = {$client_id}
                AND DATEDIFF( CURRENT_DATE(), applicant_job.`created`) <= {$day}";

        $query = $this->db->query($sql);
        $result      = $query->num_rows();

        if($result){
            return true;
        }
        return false;
    }

    public function get_apply_status_param($insert_params){
        $status = 0;
        $user_id = $insert_params[0];
        $client_id = $insert_params[1];

        $result = $this->check_user_apply_same_client($user_id, $client_id);

        if($result){
            $status = 2;
        }else{
            $this->load->model('Logic_applicant_agency');
            $result = $this->Logic_applicant_agency->check_user_apply_same_client($user_id, $client_id);
            if($result){
                $status = 2;
            }
        }



        array_push($insert_params, $status);
        return $insert_params;
    }
}
?>
