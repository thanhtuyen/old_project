<?php
require_once 'ReadTrait.php';

Class Logic_job extends MY_Model{

    use ReadTrait;

    const STATUS_PUBLIC = 1;

    const DELETE_FLG_FALSE = 0;
    const DISPLAY_FLG_TRUE = 1;

    /**
     * @var string table Name
     */
    public $table = 'job';


    public function __construct()
    {
        parent::__construct();
    }


    /*
    for U_2
    return: $job_id array
    meaning get one job detail
    */
    // public function get_pref_list($param){
    //     $pref_id     = $param['pref_id'];
    //     $status      = $param['status'];
    //     $delete_flg  = $param['delete_flg'];
    //     $limit_from  = $param['limit_from'];
    //     $limit_to    = $param['limit_to'];
    //     $query_param = array($pref_id,$status,$delete_flg,$limit_from,$limit_to);
    //     $sql         = "SELECT `job`.`job_id` FROM `job`
    //                     INNER JOIN `nursery`
    //                     ON `nursery`.`nursery_id`=  `job`.`nursery_id`
    //                     INNER JOIN `area`
    //                     ON `area`.`area_id`      =  `nursery`.`area_id`
    //                     WHERE `area`.`pref_id`   = ?
    //                     AND `job`.`status`       = ?
    //                     AND `job`.`delete_flg`   = ?
    //                     LIMIT ?, ? ";
    //     $query       = $this->db->query($sql, $query_param);
    //     $result      = $query->result_array();
    //     return $result;
    // }
    /*
    param['job_id']
    return: $array
    meaning get one job detail
    */
    public function get_detail($param){
        $select      = array_to_select_str($param['select']);
        $job_id      = $param['job_id'];
        $status      = $param['status'];
        $delete_flg  = $param['delete_flg'];
        $query_param = array($job_id,$status,$delete_flg);
        $sql         = "SELECT {$select} FROM `job`
                        WHERE `job_id` = ?
                        AND `status` = ?
                        AND `delete_flg` = ?  ";
        $query       = $this->db->query($sql, $query_param);
        $result      = $query->result_array();
        return $result;
    }
    /** ignore status */
    public function any_detail($param){
        $select      = array_to_select_str($param['select']);
        $job_id      = $param['job_id'];
        $this->load->config('job_config');
        $delete_flg  = $param['delete_flg'];
        $query_param = array($job_id,$delete_flg);
        $sql         = "SELECT {$select} FROM `job`
                        WHERE `job_id` = ".$job_id."
                        AND `delete_flg` = ".$delete_flg."  ";
        $query       = $this->db->query($sql);
        $result      = $query->result_array();
        return $result;
    }

    /** ignore status */
    public function get_limit($job_id){
        $sql         = "SELECT `employees` FROM `job`
                        WHERE `job_id` = ".$job_id;
        $query       = $this->db->query($sql);
        $result      = $query->result_array();
        return $result;
    }

    public function get_detail_with_nursery($param){
        $job_id      = $param['job_id'];
        $delete_flg  = $param['delete_flg'];
        $query_param = array($job_id,$delete_flg);
        $sql         = "SELECT job.*,nursery.name as nursery_name,client.display_name as client_name,client.mail as client_mail FROM `job`
                        JOIN nursery ON job.nursery_id=nursery.nursery_id
                        JOIN client ON client.client_id=nursery.client_id
                        WHERE job.job_id = ?
                        AND job.delete_flg = ?  ";
        $query       = $this->db->query($sql, $query_param);
        $result      = $query->result_array();
        return $result;
    }


    public function count_alljob(){
    $sql = "SELECT COUNT(`job_id`) AS num FROM `job`";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result['num'];
    }
    /*
    param['user']
    param['already_list']
    return: $array
    meaning get type one job list
    */
    public function get_3job_mail_type_one($param)
    {

        $user = $param['user'];
        $already_list = $param['already_list'];
        $already_list[] = -1;
        $already_list_str = join(',',  $already_list);

        $type_relation_job = $this->config->item('type_relation_job','tag_config');

        if ($user['city_id'] == '0') {
          $pref_city_same_sql = <<<SQL
            area.pref_id = '{$user['pref_id']}'
SQL;
        } else {
          $pref_city_same_sql = <<<SQL
            area.pref_id = '{$user['pref_id']}' AND area.city_id = '{$user['city_id']}'
SQL;
        }

        $sql = <<<SQL
SELECT job.job_id FROM job
LEFT JOIN nursery ON job.nursery_id = nursery.nursery_id
LEFT JOIN area ON nursery.area_id = area.area_id
LEFT JOIN tag_relation ON job.job_id = tag_relation.account_id AND tag_relation.tag_id = '{$user['type_employ_tag_id']}' AND tag_relation.type = '{$type_relation_job}'
WHERE
job.status = 1 AND job.delete_flg = 0 AND job.job_id NOT IN ({$already_list_str})
AND
tag_relation.tag_id IS NOT NULL
AND
{$pref_city_same_sql}
GROUP BY
job.job_id
SQL;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $result = array_column($result, 'job_id');
        $result = array_map(function($x){return (int) $x;}, $result);
        return $result;
    }
        /*
    param['user']
    param['already_list']
    return: $array
    meaning get type two job list
    */
    public function get_3job_mail_type_two($param)
    {
        $user = $param['user'];
        $already_list = $param['already_list'];
        $already_list[] = -1;
        $already_list_str = join(',',  $already_list);

        if ($user['city_id'] == '0') {
          $pref_city_same_sql = <<<SQL
            area.pref_id = '{$user['pref_id']}'
SQL;
        } else {
          $pref_city_same_sql = <<<SQL
            area.pref_id = '{$user['pref_id']}' AND area.city_id = '{$user['city_id']}'
SQL;
        }

        $sql = <<<SQL
SELECT job.job_id FROM job
LEFT JOIN nursery ON job.nursery_id = nursery.nursery_id
LEFT JOIN area ON nursery.area_id = area.area_id
WHERE
job.status = 1 AND job.delete_flg = 0 AND job.job_id NOT IN ({$already_list_str})
AND
{$pref_city_same_sql}
GROUP BY
job.job_id
SQL;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $result = array_column($result, 'job_id');
        $result = array_map(function($x){return (int) $x;}, $result);
        return $result;
    }
        /*
    param['user']
    param['already_list']
    return: $array
    meaning get type three job list
    */
    public function get_3job_mail_type_three($param)
    {
        $user = $param['user'];
        $already_list = $param['already_list'];
        $already_list[] = -1;
        $already_list_str = join(',',  $already_list);

        $type_relation_job = $this->config->item('type_relation_job','tag_config');

        $pref_same_sql = <<<SQL
            area.pref_id = '{$user['pref_id']}'
SQL;

        $sql = <<<SQL
SELECT job.job_id FROM job
LEFT JOIN nursery ON job.nursery_id = nursery.nursery_id
LEFT JOIN area ON nursery.area_id = area.area_id
LEFT JOIN tag_relation ON job.job_id = tag_relation.account_id AND tag_relation.tag_id = '{$user['type_employ_tag_id']}' AND tag_relation.type = '{$type_relation_job}'
WHERE
job.status = 1 AND job.delete_flg = 0 AND job.job_id NOT IN ({$already_list_str})
AND
tag_relation.tag_id IS NOT NULL
AND
{$pref_same_sql}
GROUP BY
job.job_id
SQL;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $result = array_column($result, 'job_id');
        $result = array_map(function($x){return (int) $x;}, $result);
        return $result;
}

        /*
    param['user']
    param['already_list']
    return: $array
    meaning get type four job list
    */
    public function get_3job_mail_type_four($param)
    {
        $user = $param['user'];
        $already_list = $param['already_list'];
        $already_list[] = -1;
        $already_list_str = join(',',  $already_list);

        $pref_same_sql = <<<SQL
            area.pref_id = '{$user['pref_id']}'
SQL;

        $sql = <<<SQL
SELECT job.job_id FROM job
LEFT JOIN nursery ON job.nursery_id = nursery.nursery_id
LEFT JOIN area ON nursery.area_id = area.area_id
WHERE
job.status = 1 AND job.delete_flg = 0 AND job.job_id NOT IN ({$already_list_str})
AND
{$pref_same_sql}
GROUP BY
job.job_id
SQL;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $result = array_column($result, 'job_id');
        $result = array_map(function($x){return (int) $x;}, $result);
        return $result;
    }


    /**
     * common search function
     * @param
     * $param['select']     = 'count(1) AS `count_job`';
     * $param['delete_flg'] = $delete_flg;
     * $param['status']     = $status;
     * $param['area_ids']   = id_array
     * @return [type]        [description]
     */
    public function get_search_list($param){
        $area_ids = "";
        if(array_key_exists('area_id',$param)){
            $area_ids_param   = array('name'    =>  'area_id',
                                      'value'   =>  $param['area_id']);
            $area_ids         = parse_array_val($area_ids_param);
        }
        //todo-thinh add station id to search params
        $station_ids = false;
        if(array_key_exists('station_id',$param)){
            $station_ids_param   = array('name'    =>  'station_id',
                'value'   =>  $param['station_id']);
            $station_ids         = parse_array_val($station_ids_param);
        }
        $nursery_tag_ids = "";
        if(array_key_exists('nursery_tag_id',$param)){
            $nursery_tag_ids_param   = array('name'    =>  'tag_relation_id',
                                             'value'   =>  $param['nursery_tag_id']);
            $nursery_tag_ids  = parse_array_val($nursery_tag_ids_param);
            $nursery_tag_count = count($param['nursery_tag_id']);
        }
        $job_tag_ids = "";
        if(array_key_exists('job_tag_id',$param)){
            $job_tag_ids_param   = array('name'    =>  'tag_relation_id',
                                         'value'   =>  $param['job_tag_id']);
            $job_tag_ids      = parse_array_val($job_tag_ids_param);
            $job_tag_count = count($param['job_tag_id']);
        }

        $select           = $param['select'];
        $job_status       = $param['job_status'];
        $nursery_status   = $param['nursery_status'];
        $client_status    = (array_key_exists('client_status',$param)) ? $param['client_status'] : 0;
        $delete_flg       = $param['delete_flg'];
        $now_date         = date('Y-m-d H:i:s');
        $limit_from = (array_key_exists('limit_from',$param)) ? $param['limit_from'] : 0;
        $limit_to   = (array_key_exists('limit_to',$param)) ? $param['limit_to'] : 0;
        $client_id   = (array_key_exists('client_id',$param)) ? $param['client_id'] : 0;
        $tag_type_nursery = $this->config->item('type_relation_nursery','tag_config');
        $tag_type_job     = $this->config->item('type_relation_job','tag_config');

        $keyword  	  = $param['keyword'];

        //todo-thinh update search sql
        $join_station_table = "";
        $station_where = "";
        $distinct = "";
        if ($station_ids){
            $distinct = " distinct ";
            $join_station_table = " LEFT JOIN `nursery_station_relation` `nsr` ON (nsr.nursery_id=n.nursery_id AND nsr.main_flg=1 ) ";
            $station_where = " AND nsr.station_id in ($station_ids)";
        }

        $sql  = "SELECT $distinct ".$select."\n".
                "FROM
                     `job` `j`
                 INNER JOIN `nursery` `n`
                  ON `j`.`nursery_id` = `n`.`nursery_id`
                  ".$join_station_table."
          INNER JOIN `client` `c`
          ON `n`.`client_id` = `c`.`client_id`".
                "\nWHERE
                    `j`.`delete_flg` = ".$delete_flg." AND
                    `j`.`status`     = ".$job_status." AND
                    `j`.`expired`    > '".$now_date."' AND
                    `n`.`delete_flg` = ".$delete_flg." AND
                    `n`.`status`     = ".$nursery_status." AND
            `c`.`delete_flg` = ".$delete_flg." AND
            `c`.`status`     = ".$client_status."\n";

        // ---- エリア　チェックされていたら次の行をWHERE句に追加
        if(!empty($area_ids)){
            $sql .=  "  AND
                    `n`.`area_id` IN (".$area_ids.")\n";
        }
        $sql .= $station_where;
        // ---- クライアントIDが指定されていたら次の行をWHERE句に追加
        if(!empty($client_id)){
            $sql .=  "  AND
                        `n`.`client_id` = ".$client_id."\n";
        }
        // ---- 施設形態　チェックされていたら次の行をWHERE句に追加
        if(!empty($nursery_tag_ids)){
            $sql .= "AND EXISTS (SELECT 1
                                FROM
                                    `tag_relation` `tr`
                                WHERE
                                    `tr`.`delete_flg` = ".$delete_flg." AND
                                    `tr`.`type`= ".$tag_type_nursery." AND
                                    `tr`.`account_id` = `n`.`nursery_id` AND
                                    `tr`.`tag_id` IN (".$nursery_tag_ids.")\n)\n";
        }


        // ---- 職種・勤務形態・こだわり条件　チェックされていたら次の行をWHERE句に追加
        if(!empty($job_tag_ids)){
        $sql .= "AND EXISTS (SELECT 1
                             FROM
                                 `tag_relation` `tr`
                             WHERE
                                 `tr`.`delete_flg` = ".$delete_flg."
                             AND `tr`.`type`= ".$tag_type_job."
                             AND `tr`.`account_id` = `j`.`job_id`
                             AND `tr`.`tag_id` IN (".$job_tag_ids.")\n)\n";
        }

    // ---- キーワード　入っていたら次の行をWHERE句に追加
    if(!empty($keyword)){
        $sql .= "AND `j`.`title` LIKE '%".$keyword."%'
         OR `j`.`description` LIKE '%".$keyword."%'
         OR `j`.`pr` LIKE '%".$keyword."%'
         OR `n`.`name` LIKE '%".$keyword."%'
         OR `n`.`name_furigana` LIKE '%".$keyword."%'
         OR `c`.`display_name` LIKE '%".$keyword."%' \n";
        }

        //order

            $sql .= "ORDER BY c.account_type ,
                         SUBSTR(j.updated, 1, 10) DESC,
                         CONCAT(SUBSTR(j.job_id, -1, 1),
                         SUBSTR(j.updated, -1, 1),
                         SUBSTR(c.client_id, -1, 1))";
        if(($limit_from >= 0)&&($limit_to >= 0)&&($limit_to > $limit_from)){
            $limit = $limit_to - $limit_from;
            $sql .= "LIMIT ".$limit." OFFSET ".$limit_from;
        }
        $query       = $this->db->query($sql);

        $result      = $query->result_array();
        return $result;
    }
    /**
     * [count description]
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public function count($param){
        $where       = array_to_where($param['where']);
        $job_id      = $param['job_id'];
        $status      = $param['status'];
        $delete_flg  = $param['delete_flg'];
        $query_param = array($where,$job_id,$status,$delete_flg);
        $sql  = "SELECT COUNT(1) FROM `tag_relation`
                 WHERE ?";
        $query       = $this->db->query($sql, $query_param);
        $result      = $query->result();
        return $result;
    }

    /**
    *    area_id
    *    return: $array
    *    get 3 jobs which has the same area as the selected job
    */
    public function get_related_area_job($area_id, $selected_job_id,$limit = 3)
    {
        $sql = "SELECT job.*,nursery.address
                FROM job
                INNER JOIN nursery ON job.nursery_id=nursery.nursery_id
                INNER JOIN `client` ON `client`.`client_id`=`nursery`.`client_id`
                WHERE nursery.area_id={$area_id}
                AND job.job_id != {$selected_job_id}
                AND `client`.`delete_flg` = 0
                AND `client`.`status` = 0
                AND `nursery`.`delete_flg` = 0
                AND `nursery`.`status` = 0
                AND `job`.`status` = 1
                AND `job`.`delete_flg` = 0
                ORDER BY job.job_id DESC
                LIMIT ".$limit;

        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function get_job_detail($params){
        $sql = "SELECT job.*,nursery.address
                FROM job
                INNER JOIN nursery ON job.nursery_id=nursery.nursery_id
                INNER JOIN `client` ON `client`.`client_id`=`nursery`.`client_id`
                WHERE nursery.area_id={$area_id}
                AND job.job_id != {$selected_job_id}
                AND `client`.`delete_flg` = 0
                AND `client`.`status` = 0
                AND `nursery`.`delete_flg` = 0
                AND `nursery`.`status` = 0
                AND `job`.`status` = 1
                AND `job`.`delete_flg` = 0
                ORDER BY job.job_id DESC
                LIMIT 3";
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    /**
     * get images of job
     *
     * @param   integer  $job_id
     *
     * @return  array
     */
    public function getImages($job_id)
    {
        $sql = "select name from image where type = 2 and account_id = '$job_id' and delete_flg='0'";

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function get_public_job_count(){
        /*
        $sql = "SELECT COUNT(*)
                FROM job
                WHERE status=1 AND delete_flg=0";

        return $this->db->query($sql)->row_array();
        */
        $userdata = $this->session->userdata('user_data');

        $search_param = array();
        $search_param['user_id']        =  empty($user_data['user_id']) ? null : $user_data['user_id'];
        $search_param['job_status']     =  $this->config->item('public','job_config');
        $search_param['nursery_status'] =  $this->config->item('public','nursery_config');
        $search_param['delete_flg']     =  $this->config->item('not_deleted','common_config');
        //count job

        $job_all_count  = $this->Service_job->search_count($search_param);

        return array('COUNT(*)' => $job_all_count);
    }

    public function get_job_last_updated(){
        $sql = "SELECT updated
                FROM job
                WHERE status=1 AND delete_flg=0
                ORDER BY updated DESC
                LIMIT 1";

        return $this->db->query($sql)->row_array();
    }

      /**
     * return total count
     * @param  [array] $condition
     * @return [int]
     */
    public function get_total_count($condition, $param)
    {
        $delete_flg = $param['delete_flg'];
        $query_param = array();
        $join = '';
        if (! empty($condition['plan_group'])) {
            $join = <<<SQL
JOIN `client_plan_group_relation` ON `client_plan_group_relation`.`client_id` = `client`.`client_id` AND `client_plan_group_relation`.`plan_group_id` = ? AND `client_plan_group_relation`.`delete_flg` = ?
SQL;
            $plan_group = "{$condition['plan_group']}";
             $query_param = array($plan_group, $delete_flg);
        }
        array_push($query_param, $delete_flg);

        $sql = <<<SQL
SELECT distinct `job`.`job_id`, count('*') AS total
FROM `job`
JOIN nursery ON job.nursery_id = nursery.nursery_id
JOIN client ON nursery.client_id = client.client_id
{$join}
WHERE job.delete_flg = ?
SQL;

        if (! empty($condition['keyword'])) {
            $sql .= <<<SQL
             AND (`title` collate utf8_unicode_ci LIKE ?
                OR `client`.`name` collate utf8_unicode_ci LIKE ?
                OR `client`.`display_name` collate utf8_unicode_ci LIKE ?
                OR `nursery`.`name` collate utf8_unicode_ci LIKE ?
                OR CAST(`job`.`job_id` AS CHAR ) LIKE ?
                OR CAST(`client`.`client_id` AS CHAR ) LIKE ?
                OR CAST(`nursery`.`nursery_id` AS CHAR ) LIKE ?)
SQL;
            $keyword = "%{$condition['keyword']}%";
            array_push($query_param, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword);
        }

        if (! empty($condition['status'])) {
            $sql .= <<<SQL
             AND `job`.`status` = ?
SQL;
            $status = "{$condition['status']}";
            array_push($query_param, $status);
        }

        if (! empty($condition['account_type'])) {
            $sql .= <<<SQL
             AND `client`.`account_type` = ?
SQL;
            $account_type = "{$condition['account_type']}";
            array_push($query_param, $account_type);
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
    public function get_list($condition, $param)
    {
        $delete_flg = $param['delete_flg'];
        // $group_type = $param['group_type'];
        // $reccoment = $param['reccoment'];
        // $query_param = array($group_type, $reccoment, $delete_flg);
        $query_param = array();
        $join = '';
        if (! empty($condition['plan_group'])) {
            $join = <<<SQL
JOIN `client_plan_group_relation` ON `client_plan_group_relation`.`client_id` = `client`.`client_id` AND `client_plan_group_relation`.`plan_group_id` = ? AND `client_plan_group_relation`.`delete_flg` = ?
SQL;
            $plan_group = "{$condition['plan_group']}";
             $query_param = array($plan_group, $delete_flg);
        }
        array_push($query_param, $delete_flg);

        $select = 'distinct `job`.`job_id`, `job`.`title`, `client`.`client_id`, `nursery`.`nursery_id`, `nursery`.`name`, `job`.`status`,`client`.`name` AS client_name';
        $sql = <<<SQL
SELECT {$select}
FROM `job`
JOIN `nursery` ON `job`.`nursery_id` = `nursery`.`nursery_id`
JOIN `client` ON `nursery`.`client_id` = `client`.`client_id`
{$join}
WHERE `job`.`delete_flg` = ?
SQL;
// -- LEFT JOIN `tag_relation` ON `tag_relation`.`account_id` = `job`.`job_id` AND `tag_relation`.`type` = ?
// -- LEFT JOIN `tag` ON `tag_relation`.`tag_id` = `tag`.`tag_id` AND `tag`.`tag_group_id` = ?

        if (! empty($condition['keyword'])) {
            $sql .= <<<SQL
             AND (`title`  collate utf8_unicode_ci LIKE ?
                OR `client`.`name` collate utf8_unicode_ci LIKE ?
                OR `client`.`display_name` collate utf8_unicode_ci LIKE ?
                OR `nursery`.`name` collate utf8_unicode_ci LIKE ?
                OR CAST(`job`.`job_id` AS CHAR ) LIKE ?
                OR CAST(`client`.`client_id` AS CHAR ) LIKE ?
                OR CAST(`nursery`.`nursery_id` AS CHAR ) LIKE ?)
SQL;
            $keyword = "%{$condition['keyword']}%";
            array_push($query_param, $keyword, $keyword, $keyword, $keyword, $keyword,$keyword, $keyword);
        }


        if (! empty($condition['status'])) {
            $sql .= <<<SQL
             AND `job`.`status` = ?
SQL;
            $status = "{$condition['status']}";
            array_push($query_param, $status);
        }

        if (! empty($condition['account_type'])) {
            $sql .= <<<SQL
             AND `client`.`account_type` = ?
SQL;
            $account_type = "{$condition['account_type']}";
            array_push($query_param, $account_type);
        }


        $sql .= <<<EOF
        ORDER BY job.created DESC
        LIMIT {$param['offset']}, {$param['limit']}

EOF;
        $result = $this->db->query($sql, $query_param)->result_array();
        return $result;
    }

    public function get_export_data()
    {
        $relation_job = $this->config->item('type_relation_job', 'tag_config');
        /*募集職種*/
        $job_type = $this->config->item('type_job', 'tag_config');
        /*雇用形態*/
        $employ_type = $this->config->item('type_employ','tag_config');
        /*社会保険*/
        $insurance = $this->config->item('tag_insurance', 'tag_config');
        /*登録タグ*/
        $benefit = $this->config->item('tag_job', 'tag_config');
        /*掲載タイプ*/
        $reccoment = $this->config->item('tag_job_reccoment', 'tag_config');

        $image_type = $this->config->item('job', 'image_config');


        $sql = <<<EOF
        SELECT
        job.*,
        client.client_id,
        client.name AS client_name
        FROM job
        LEFT JOIN nursery ON job.nursery_id = nursery.nursery_id
        LEFT JOIN client ON client.client_id = nursery.client_id
        limit 5000
EOF;
        $image_sql = <<<EOF
        SELECT
        `image`.`name`, `image`.`ordered`, `job`.`job_id`
        FROM `job`
         JOIN `image` ON `image`.`account_id` = `job`.`job_id` AND `image`.`type` = {$image_type}
        limit 5000
EOF;

        $job_type_sql = <<<EOF
        SELECT `tag`.`name` as `job_type`, `job`.`job_id`
        FROM job
         JOIN `tag_relation` ON `tag_relation`.`account_id` = `job`.`job_id` AND `tag_relation`.type = {$relation_job}
         JOIN `tag` ON `tag`.`tag_id` = `tag_relation`.`tag_id` AND `tag`.`tag_group_id` = {$job_type}
        LIMIT 5000
EOF;
        $employ_type_sql = <<<EOF
        SELECT `tag`.`name` as `employ_type`, `job`.`job_id`
        FROM job
         JOIN `tag_relation` ON `tag_relation`.`account_id` = `job`.`job_id` AND `tag_relation`.type = {$relation_job}
         JOIN `tag` ON `tag`.`tag_id` = `tag_relation`.`tag_id` AND `tag`.`tag_group_id` = {$employ_type}
        LIMIT 5000
EOF;

        $insurance_sql = <<<EOF
        SELECT `tag`.`name` as `insurance`, `job`.`job_id`
        FROM job
         JOIN `tag_relation` ON `tag_relation`.`account_id` = `job`.`job_id` AND `tag_relation`.type = {$relation_job}
         JOIN `tag` ON `tag`.`tag_id` = `tag_relation`.`tag_id` AND `tag`.`tag_group_id` = {$insurance}
        LIMIT 5000
EOF;
        $benefit_sql = <<<EOF
        SELECT `tag`.`name` as `benefit`, `job`.`job_id`
        FROM job
         JOIN `tag_relation` ON `tag_relation`.`account_id` = `job`.`job_id` AND `tag_relation`.type = {$relation_job}
         JOIN `tag` ON `tag`.`tag_id` = `tag_relation`.`tag_id` AND `tag`.`tag_group_id` = {$benefit}
        LIMIT 5000
EOF;

        $reccoment_sql = <<<EOF
        SELECT `tag`.`name` as `reccoment`, `job`.`job_id`
        FROM job
         JOIN `tag_relation` ON `tag_relation`.`account_id` = `job`.`job_id` AND `tag_relation`.type = {$relation_job}
         JOIN `tag` ON `tag`.`tag_id` = `tag_relation`.`tag_id` AND `tag`.`tag_group_id` = {$reccoment}
        LIMIT 5000
EOF;





        $jobs = $this->db->query($sql)->result_array();
        $job_type = $this->db->query($job_type_sql)->result_array();
        $employ_type = $this->db->query($employ_type_sql)->result_array();
        $insurance = $this->db->query($insurance_sql)->result_array();
        $benefit = $this->db->query($benefit_sql)->result_array();
        $reccoment = $this->db->query($reccoment_sql)->result_array();
        $image = $this->db->query($image_sql)->result_array();

        return array($jobs, $job_type, $employ_type, $insurance, $benefit, $reccoment, $image);

    }

    public function get_detail_of_admin($param)
    {


        //$query_param = array($param['delete_flg'], $param['job_id']);
    $query_param = array($param['job_id']);

        $sql = <<<SQL
SELECT `job`.*,n.client_id
FROM `job`
LEFT JOIN `nursery` n ON `job`.`nursery_id` = n.`nursery_id`
WHERE `job`.`job_id` = ?
SQL;
//WHERE `job`.`delete_flg` = ?

        $reccoment = $this->is_reccoment_flg($param);
        $employ = $this->get_employ_type($param);
        $tag_job = $this->get_tag_job($param);

        $jobs = $this->db->query($sql, $query_param)->row_array();

        return array_merge($jobs, $reccoment,$employ, $tag_job);

    }

    protected function is_reccoment_flg($param)
    {
        //$delete_flg = $param['delete_flg'];
        // 1
        $group_type = $param['group_type'];
        // 8
        $reccoment = $param['reccoment'];
        $job_id = $param['job_id'];

        //$query_param = array($group_type, $reccoment, $delete_flg, $job_id);
    $query_param = array($group_type, $reccoment, $job_id);

        $select = '`tag`.`tag_id` AS `reccoment`';
        $sql = <<<SQL
        SELECT {$select}
        FROM `job`
        LEFT JOIN `tag_relation` ON `tag_relation`.`account_id` = `job`.`job_id` AND `tag_relation`.`type` = ?
        LEFT JOIN `tag` ON `tag_relation`.`tag_id` = `tag`.`tag_id` AND `tag`.`tag_group_id` = ?
        WHERE `job`.`job_id` = ?
SQL;
//WHERE `job`.`delete_flg` = ?

        return $this->db->query($sql, $query_param)->row_array();
    }

    protected function get_employ_type($param)
    {

        //$delete_flg = $param['delete_flg'];
        // 1
        $group_type = $param['group_type'];
        // 3
        $employ = $param['employ'];
        $job_id = $param['job_id'];

        //$query_param = array($group_type, $employ, $delete_flg, $job_id);
    $query_param = array($group_type, $employ, $job_id);

        $select = '`tag`.`name` AS `employ`';
        $sql = <<<SQL
        SELECT {$select}
        FROM `job`
        LEFT JOIN `tag_relation` ON `tag_relation`.`account_id` = `job`.`job_id` AND `tag_relation`.`type` = ?
        LEFT JOIN `tag` ON `tag_relation`.`tag_id` = `tag`.`tag_id` AND `tag`.`tag_group_id` = ?
        WHERE `job`.`job_id` = ?
SQL;
//WHERE `job`.`delete_flg` = ?

        $result = $this->db->query($sql, $query_param)->result_array();
        return array('employ' => array_column($result, 'employ'));
    }

    /**
     * get 登録タグ tag_group_id =5
    **/
    protected function get_tag_job($param)
    {

        //$delete_flg = $param['delete_flg'];
        // 1
        $group_type = $param['group_type'];
        // 5
        $tag_job = $param['tag_job'];
        $job_id = $param['job_id'];

        //$query_param = array($group_type, $tag_job, $delete_flg, $job_id);
    $query_param = array($group_type, $tag_job, $job_id);

        $select = '`tag`.`name` AS `tag_job`';
        $sql = <<<SQL
        SELECT {$select}
        FROM `job`
        LEFT JOIN `tag_relation` ON `tag_relation`.`account_id` = `job`.`job_id` AND `tag_relation`.`type` = ?
        LEFT JOIN `tag` ON `tag_relation`.`tag_id` = `tag`.`tag_id` AND `tag`.`tag_group_id` = ?
        WHERE `job`.`job_id` = ?
SQL;
//WHERE `job`.`delete_flg` = ?

        $result = $this->db->query($sql, $query_param)->result_array();
        return array('tag_job' => array_column($result, 'tag_job'));
    }

    public function delete_flg($id)
    {
        $now_date         = date('Y-m-d H:i:s');
        $query_param = array($now_date,$id);
        $sql = <<<SQL
UPDATE job SET delete_flg = 1,
 updated = ?
 WHERE job_id = ? AND delete_flg = 0
SQL;
        $this->db->query($sql, $query_param);
        return  $this->db->affected_rows();
    }


    public function get_job_list_relate_client($client_id,$order){

        $limit = empty($order) ? "" : " LIMIT ".$order["start"].",".$order["limit"];

        $sql = "SELECT job.* FROM nursery
                JOIN job ON nursery.nursery_id = job.nursery_id
                WHERE nursery.client_id = '".$client_id."'
                  AND nursery.status = 0
                  AND nursery.delete_flg = 0
                  AND job.status = 1
                  AND job.delete_flg = 0"
                .$limit;

        return $this->db->query($sql)->result_array();
    }


    /**
     * get job count by conditions
     * @param  [array] $param
     * @return [int]
     */
    public function get_job_count($param)
    {
        $sql = "SELECT COUNT(*) AS num FROM `job`
                JOIN `nursery` ON `job`.nursery_id = `nursery`.nursery_id
                ";

        $sql .= $this->append_search_sql($param);
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result['num'];
    }

    /**
     * get job list by conditions
     * @param  [array] $param
     * @return [array]
     */
    public function get_job_list($param)
    {

        $sql = "SELECT `job`.*,`nursery`.name AS nursery_name
                FROM `job`
                JOIN `nursery` ON `job`.nursery_id = `nursery`.nursery_id
                ";

        $sql .= $this->append_search_sql($param);

        $sql .= " ORDER BY `job`.job_id DESC LIMIT {$param['start']}, {$param['page_size']}";
        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    private function append_search_sql($param)
    {
        $sql = '';

        if($param['employ_tag']) {
            $sql .= " JOIN `tag_relation` AS `tre` ON `tre`.account_id = `job`.job_id
                    JOIN `tag` AS `te` ON `te`.tag_id = `tre`.`tag_id`";
        }

        if($param['job_tag']) {
            $sql .= " JOIN `tag_relation` AS `trj` ON `trj`.account_id = `job`.job_id
                    JOIN `tag` AS `tj` ON `tj`.tag_id = `trj`.`tag_id`";
        }

        $sql .= " WHERE `job`.delete_flg = {$param['delete_flg']}
                AND `nursery`.client_id = {$param['client_id']}";

        if($param['key_words']){

            $sql .= " AND (
                `job`.title  collate utf8_unicode_ci LIKE '%{$param['key_words']}%'
                OR `nursery`.name  collate utf8_unicode_ci LIKE '%{$param['key_words']}%'
                OR `job`.own_job_id  collate utf8_unicode_ci LIKE '%{$param['key_words']}%'
                OR CAST(`nursery`.`nursery_id` AS CHAR ) LIKE '{$param['key_words']}'
                OR CAST(`job`.`job_id` AS CHAR ) LIKE '{$param['key_words']}'
                )";

        }
        if($param['start_time']){
            $sql .= " AND '{$param['start_time']}' < `job`.created";
        }
        if($param['end_time']){
            $sql .= " AND '{$param['end_time']}' > `job`.created";
        }
        if($param['status']){
            $job_config = $this->load->config('job_config');
            if($param['status'] == 'draft' || $param['status'] == 'public'){
                $job_status = $this->config->item($param['status'], 'job_config');
                $sql .= " AND `job`.`status` = $job_status";
            }
            if($param['status'] == 'closed') {
                $closed_status = $this->config->item('closed', 'job_config');
                $force_closed_status = $this->config->item('force_closed', 'job_config');
                $sql .= " AND (`job`.`status` = $closed_status OR `job`.`status` = $force_closed_status)";
            }
        }
        if($param['employ_tag']) {
            $tag_relation_type = $this->config->item('type_relation_job', 'tag_config');
            $tag_group_id = $this->config->item('type_employ', 'tag_config');
            $sql .= " AND `tre`.type = $tag_relation_type
                    AND `tre`.tag_id = {$param['employ_tag']}
                    AND `te`.tag_group_id = $tag_group_id";
        }
        if($param['job_tag']) {
            $tag_relation_type = $this->config->item('type_relation_job', 'tag_config');
            $tag_group_id = $this->config->item('type_job', 'tag_config');
            $sql .= " AND `trj`.type = $tag_relation_type
                    AND `trj`.tag_id = {$param['job_tag']}
                    AND `tj`.tag_group_id = $tag_group_id";
        }
        return $sql;
    }
    /*
    insert job
    */
    public function insert_job($data)
    {
        $sql = "INSERT INTO job(nursery_id,own_job_id,title,description,bonus,worktime,
                holiday,expired,salary,employees,requirement,pr,status,ordered,created,updated)
                VALUES({$data["nursery_id"]}, '{$data['own_job_id']}', '{$data['title']}',
                '{$data['description']}', '{$data['bonus']}', '{$data['worktime']}',
                '{$data['holiday']}','{$data['expired']}', '{$data['salary']}',
                {$data['employees']},'{$data['requirement']}','{$data['pr']}',
                {$data['status']},'{$data['ordered']}', '{$data['created']}',
                '{$data['created']}')";

        $this->db->query($sql);
        return $this->db->insert_id();
    }

    /**
     * soft delete job, update delete_flg to deleted
     */
    public function soft_delete($job_id)
    {
        $now_date         = date('Y-m-d H:i:s');
        $params = array(
            $this->config->item('deleted', 'common_config'),
            $now_date,
            $job_id
        );
        $sql = "UPDATE job SET delete_flg=?,
                     updated = '".$now_date."'
         WHERE job_id=?";
        $this->db->query($sql, $params);
    }

    public function get_job_by_job_id($job_id)
    {
        $sql = "SELECT * FROM job WHERE job_id = $job_id";
        return $this->db->query($sql)->row_array();
    }

    /**
     * update job
     */
    public function update_job($data)
    {
        $sql = "UPDATE job
                SET nursery_id=?, own_job_id=?, title=?, description=?,
                bonus=?, worktime=?, holiday=?, expired=?, salary=?,
                employees=?, requirement=?, pr=?, status=?, updated=?, ordered=?
                WHERE job_id=?";

        $params = array(
            $data['nursery_id'], $data['own_job_id'], $data['title'], $data['description'],
            $data['bonus'], $data['worktime'], $data['holiday'], $data['expired'],
            $data['salary'],$data['employees'], $data['requirement'], $data['pr'],
            $data['status'], $data['updated'], $data['ordered'], $data['job_id']
        );
        $this->db->query($sql, $params);
    }

    public function get_one_job($param)
    {
        $sql = "SELECT `job`.*,`nursery`.name AS nursery_name FROM `job`
                JOIN `nursery` ON `job`.nursery_id = `nursery`.nursery_id
                WHERE `job`.delete_flg = {$param['delete_flg']}
                AND `nursery`.client_id = {$param['client_id']}
                AND `job`.job_id = {$param['job_id']}";
        return $this->db->query($sql)->row_array();

    }

    public function get_export_job($job_array)
    {
        $sql = "SELECT `job`.*,`nursery`.name AS nursery_name FROM `job`
                JOIN `nursery` ON `job`.nursery_id = `nursery`.nursery_id
                WHERE `job`.job_id IN(";

        foreach ($job_array as $key => $value) {
            if($value){
                if($key == count($job_array) - 1){
                    $sql .= "$value";
                } else {
                    $sql .= "$value,";
                }
            }
        }

        $sql .= ')';
        $sql .= " ORDER BY `job`.job_id DESC";
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function close($job_id){
        $now_date         = date('Y-m-d H:i:s');
        $sql = "UPDATE `job` SET `status` = 2,
                     `updated` = '".$now_date."'
                         WHERE `job_id` = ".$job_id;
        $result = $this->db->query($sql);
        return $result;
    }


    public function get_type($job_id){
        $sql = "SELECT
                        t.tag_id
                    FROM
                     tag_relation tr
                    INNER JOIN tag t ON tr.tag_id = t.tag_id
                    WHERE
                     tr.account_id = ".$job_id."
                    AND
                     tr.type = 1
                    AND
                     t.tag_group_id = 3
                    AND
                     tr.delete_flg = 0";
        $result = $this->db->query($sql)->result_array();
        return $result;
    }
    public function get_client_id($job_id){
        $sql = "SELECT
                        c.client_id
                    FROM
                        job j
                    INNER JOIN nursery n ON j.nursery_id = n.nursery_id
                    INNER JOIN client c ON n.client_id = c.client_id
                    WHERE
                     j.job_id = ".$job_id;
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function pickup_expired(){
        $now_date         = date('Y-m-d H:i:s' ,strtotime("-1 day"));
        $sql = "SELECT job_id FROM job
                WHERE expired <= '".$now_date."'
                AND status = 1
                AND delete_flg = 0";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function expire($jobs){
        $now_date         = date('Y-m-d H:i:s');
        $job_str = implode(',',$jobs);
        $sql = "UPDATE job
                    SET
                     `status` = 2 ,
                     `updated` = '".$now_date."'
                    WHERE job_id IN (".$job_str.")
                    AND status = 1
                    AND delete_flg = 0";
        $query = $this->db->query($sql);
        return $this->db->affected_rows();
    }
    public function count_agent_job($agent_id){
        $now_date         = date('Y-m-d H:i:s');
        $sql = "SELECT count(1) as count FROM job
                WHERE expired <= '".$now_date."'
                AND status = 1
                AND delete_flg = 0";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function close_nursery($nursery_id){
        $now_date         = date('Y-m-d H:i:s');
        $sql = "UPDATE job SET `status` = 9,
                     `updated` = '".$now_date."'
                    WHERE nursery_id = ".$nursery_id."
                    AND status IN (1,2) ";
        $query = $this->db->query($sql);
        return $this->db->affected_rows();
        return $result;
    }

    /**
     * TUYENNT
     * get job count by line_id
     * @param  [array] $param
     * @return [int]
     */
    public function get_count_jobs_by_line_id($line_id,$pref_id = false)
    {
        $now_date         = date('Y-m-d H:i:s');
        $job_status     =  $this->config->item('public','job_config');
        $nursery_status =  $this->config->item('public','nursery_config');
        $delete_flg = self::DELETE_FLG_FALSE;
        $display_flg = self::DISPLAY_FLG_TRUE;
        $in_pref_sql = "";
        if ($pref_id){
            $in_pref_sql = " AND (s.pref_cd = $pref_id)";
        }
        $sql = "SELECT l.line_id, l.line_name_h,
                COUNT( DISTINCT CASE WHEN j.expired > '".$now_date."' THEN job_id END) as total_job
                FROM  `station` as s
                LEFT join `line` as l on l.line_id = s.line_id
                LEFT JOIN  nursery_station_relation as nsr ON nsr.station_id = s.station_id
                LEFT JOIN job as j ON j.nursery_id = nsr.nursery_id
                LEFT JOIN nursery as n ON n.nursery_id = j.nursery_id
                WHERE l.line_id = {$line_id} AND j.expired > '".$now_date."'
                AND s.delete_flg = {$delete_flg}
                AND nsr.delete_flg = {$delete_flg}
                AND nsr.display_flg = {$display_flg}
                AND (j.delete_flg = {$delete_flg} OR j.delete_flg is null)
                AND (j.status = {$job_status} OR j.status is null)
                AND (n.status = {$nursery_status} OR n.status is null)
                AND (nsr.main_flg = 1 OR nsr.main_flg is null ) {$in_pref_sql}
               ";

        $query = $this->db->query($sql);
        $result = $query->result_array();

        return $result;
    }

    public function get_each_city_job_count_by_pref($param)
    {
        $pref_id = $param['pref_id'];
        $job_status = $param['job_status'];
        $nursery_status = $param['nursery_status'];
        $client_status = (array_key_exists('client_status', $param)) ? $param['client_status'] : 0;
        $delete_flg = $param['delete_flg'];
        $now_date = date('Y-m-d H:i:s');

        $sql = "SELECT  r.area_id,r.area_name,COUNT(r.area_id) AS `count_job`
                FROM
                (SELECT `ar`.name AS area_name,`ar`.area_id AS area_id,`j`.job_id  FROM `job` `j`
                 INNER JOIN `nursery` `n`
                  ON `j`.`nursery_id` = `n`.`nursery_id`
                  INNER JOIN `area` `ar`
                  ON `ar`.`area_id` = `n`.`area_id`

                INNER JOIN `client` `c`
                ON `n`.`client_id` = `c`.`client_id`
                WHERE
                    `j`.`delete_flg` = " . $delete_flg . " AND
                    `j`.`status`     = " . $job_status . " AND
                    `j`.`expired`    > '" . $now_date . "' AND
                    `n`.`delete_flg` = " . $delete_flg . " AND
                    `n`.`status`     = " . $nursery_status . " AND
                    `c`.`delete_flg` = " . $delete_flg . " AND
                    `c`.`status`     = " . $client_status . " AND
                    `ar`.`pref_id`   = " . $pref_id . ") r
                GROUP BY area_id
                ";


        $query = $this->db->query($sql);
        $result = $query->result_array();

        return $result;
    }


    public function get_id_list($param)
    {

        $sql = <<<SQL
        SELECT *
        FROM `job`
        WHERE `status` = ? AND `delete_flg` = ?
SQL;

        return $this->db->query($sql, array($param['status'], $param['delete_flg']))->result_array();

    }

    public function get_nursery_job_list()
    {
        $type_relation_job = $this->config->item('type_relation_job','tag_config');
        $job_type = $this->config->item('type_job','tag_config');
        $employ_type = $this->config->item('type_employ','tag_config');

        $delete_flg = $this->config->item('not_deleted','common_config');
        $job_status = $this->config->item('public','job_config');
        $nursery_status = $this->config->item('public','nursery_config');
        $client_status = $this->config->item('enabled','client_config');
        $job_status = $this->config->item('public','job_config');
        $account_type = 1;

        $sql = <<<SQL
        SELECT `job`.*,`t1`.name AS job_type,`t2`.name AS type_employ
        FROM `job`
        LEFT JOIN `nursery` ON `job`.`nursery_id` = `nursery`.`nursery_id`
        LEFT JOIN `client` ON `nursery`.`client_id` = `client`.`client_id`
        LEFT JOIN `tag_relation` AS `tr1` ON `tr1`.`account_id` = `job`.`job_id` AND `tr1`.`type` = ?
        LEFT JOIN `tag` AS `t1` ON `t1`.`tag_id` = `tr1`.`tag_id`
        LEFT JOIN `tag_relation` AS `tr2` ON `tr2`.`account_id` = `job`.`job_id` AND `tr2`.`type` = ?
        LEFT JOIN `tag` AS `t2` ON `t2`.`tag_id` = `tr2`.`tag_id`
        WHERE `job`.`status` = ? AND `nursery`.`status` = ? AND `client`.`status` = ? AND
              `job`.`delete_flg` = ? AND `nursery`.`delete_flg` = ?
              AND `client`.`delete_flg` = ? AND `client`.`account_type` = ?
              AND `t1`.tag_group_id = ?
              AND `t2`.tag_group_id = ?
SQL;
        $params = array($type_relation_job,
                        $type_relation_job,
                        $job_status,
                        $nursery_status,
                        $client_status,
                        $delete_flg,
                        $delete_flg,
                        $delete_flg,
                        $account_type,
                        $job_type,
                        $employ_type
                        );
        return $this->db->query($sql, $params)->result_array();

    }

    public function count_pref_job($param){
        $pref_id 	            = $param["pref_id"];
        $job_status         = $param['job_status'];
        $nursery_status = $param['nursery_status'];
        $client_status     = $param['client_status'];
        $delete_flg	= $param['delete_flg'];
        $date		= $param['date'];

/*
    $sql = "SELECT COUNT(`job`.`job_id`) AS count
        FROM `job`
        LEFT JOIN `nursery` ON `nursery`.`nursery_id` = `job`.`nursery_id`
        LEFT JOIN `client` ON `client`.`client_id` = `nursery`.`client_id`
        WHERE
        `nursery`.`area_id` LIKE '".$pref_id."%' AND
        `job`.`status` = ".$job_status." AND
        `job`.`expired` >= '".$date."' AND
        `nursery`.`status` = ".$nursery_status." AND
        `client`.`status` = ".$client_status." AND
        `job`.`delete_flg` = ".$delete_flg." AND
        `client`.`delete_flg` = ".$delete_flg." AND
        `nursery`.`delete_flg` = ".$delete_flg;
*/

        $sql = "SELECT COUNT(`job`.`job_id`) AS count
                FROM `job`
                LEFT JOIN `nursery` ON `nursery`.`nursery_id` = `job`.`nursery_id`
                LEFT JOIN `client` ON `client`.`client_id` = `nursery`.`client_id`
                LEFT JOIN `area` ON `area`.`area_id` = `nursery`.`area_id`
                WHERE
                `area`.`pref_id` = $pref_id AND
                `job`.`status` = ".$job_status." AND
                `job`.`expired` >= '".$date."' AND
                `nursery`.`status` = ".$nursery_status." AND
                `client`.`status` = ".$client_status." AND
                `job`.`delete_flg` = ".$delete_flg." AND
                `client`.`delete_flg` = ".$delete_flg." AND
                `nursery`.`delete_flg` = ".$delete_flg;

        $result = $this->db->query($sql)->row_array();
        $data = $result['count'];
        return $data;
    }

    public function nursery_related_list($nursery_id,$param){
        $sql = "SELECT job_id
        FROM job
        WHERE nursery_id = ".$nursery_id."
        AND delete_flg = 0
        AND status = 1
        ORDER BY updated
        LIMIT ".$param['range']."
        OFFSET ".$param['limit_from'];
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function nursery_related_count($nursery_id){
        $sql = "SELECT count(1) AS count_job
        FROM job
        WHERE nursery_id = ".$nursery_id."
        AND delete_flg = 0
        AND status = 1";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result;
    }

    public function client_related_list($client_id,$param){
        $sql = "SELECT job_id
        FROM job
        INNER JOIN nursery ON job.nursery_id = nursery.nursery_id
        WHERE nursery.client_id = ".$client_id."
        AND job.delete_flg = 0
        AND job.status = 1
        AND nursery.delete_flg = 0
        AND nursery.status = 0
        ORDER BY job.updated
        LIMIT ".$param['range']."
        OFFSET ".$param['limit_from'];
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function client_related_count($client_id){
        $sql = "SELECT count(1) AS count_job
        FROM job
        INNER JOIN nursery ON job.nursery_id = nursery.nursery_id
        WHERE nursery.client_id = ".$client_id."
        AND job.delete_flg = 0
        AND job.status = 1
        AND nursery.delete_flg = 0
        AND nursery.status = 0";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result;
    }
}
