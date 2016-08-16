<?php
require_once 'ReadTrait.php';

Class Logic_user extends MY_Model{
    use ReadTrait;

    const DELETE_FLG_FALSE = 0;

    const STATUS_ACTIVE = 1;

    /**
     * @var string table Name
     */
    public $table = 'user';

    public function __construct()
    {
        parent::__construct();
    }

    //param = user email "ssss@dddd.com"
    public function  get_userid_from_mail($param){
	$sql = "SELECT `user_id` FROM `user` WHERE `status` = 1 AND `delete_flg` = 0 AND `mail` = '".$param."'";
	$result = $this->db->query($sql)->row_array();
	return $result;
    }

    /**
     * get license of user tag_group_id = 4
     *
     * @param   integer  $user_id
     *
     * @return  array
     */
    public function getlicense($user_id)
    {
        $result = [];

        $sql = "SELECT t.name
                FROM tag_relation as tr

                INNER JOIN tag as t ON t.tag_id = tr.tag_id
                INNER JOIN user as u ON u.user_id = tr.account_id

                WHERE tr.account_id = '$user_id'
                  AND tr.type = '0'
                  AND tr.delete_flg = '0'
                  AND t.tag_group_id = '4'
                  AND t.delete_flg = '0'
            ";

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    /**
     * insert to user table when new user signup
     * @param array $params: ex) array( "table column name1" => "insert value1",
     *                                  "table column name2" => "insert value2",...
     *                                  );
     * return boolean : query result
     */
    public function get_detail($params){

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

        $sql = 'SELECT '.$select.' FROM `user`
                WHERE '.$where;

        $query = $this->db->query($sql);

        return $query->result_array();
    }
    /**
    *@return array db result
    */
    public function get_threemail_target()
    {

        $status = $this->config->item('active', 'user_config');

        $sql = <<<SQL
SELECT user_id FROM user WHERE (status = {$status} AND delete_flg = 0 AND token != '' AND mail != '')
SQL;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }


    public function insert($params){


        $keys = "";
        $values = "";
        foreach($params as $key => $value){
            $keys .= "`".$key."`,";
            $values .= '"'.$value.'",';
        }
        $result = $this->db->query("INSERT INTO `user`(".rtrim($keys,",").") VALUES (".rtrim($values,",").")");
        /*
        if ($result){
            $result = $this->db->insert_id();
        }

        return (int)$result;
        */
        if($result){
            return $this->db->query("SELECT LAST_INSERT_ID()")->row_array();
        }else{
            return false;
        }

    }

    /**
     * register from campaign
     * upgrade from self::regist_user($params)
     *
     * @param   array  $params
     *
     * @return  integer  new user_id
     */
    public function register($params){

        $keys = implode(', ', array_keys($params) );


        $sql = "INSERT INTO user (".$keys.") VALUES ? ;";

        $result = $this->db->query($sql, array($params));

        if ($result){
            $result = $this->db->insert_id();
        }

        return (int)$result;
    }

    // public function get_detail($params){
    //     if(!empty($params["select"])){
    //         $select = array_to_select_str($params["select"]);
    //     }else{
    //         $select = "*";
    //     }
    //     if(!empty($params["where"])){
    //         $where = array_to_where($params["where"]);
    //     }else{
    //         $where = "";
    //     }

    //     return $this->db->query('SELECT '.$select.' FROM `user` WHERE '.$where)->result_array();
    // }

    /**
     * get detail of user by user_id
     * upgrade from self::get_detail($params) - why run query INSERT INTO user
     *
     * @param   integer  $user_id
     *
     * @return  array  User detail
     */
    public function getDetail($user_id, $status, $delete_flg)
    {
        $sql = "SELECT * FROM user
                WHERE user_id = ?
                    and status = ?
                    and delete_flg = ?
            ";

        $data = $this->db->query($sql, array($user_id, $status, $delete_flg))->result_array();

        if (isset($data[0])){
            return $data[0];
        }

        return false;

    }

    /**
     * get address by format : province city address
     *
     * @param   integer  $user_id
     *
     * @return  string   address string
     */
    public function getAddressFull($user_id)
    {
        $sql = "SELECT province.name as province, area.name as city, u.address
                FROM user as u

                LEFT JOIN area as area ON area.area_id = u.area_id
                LEFT JOIN area as province ON province.area_id = area.region_id

                WHERE u.delete_flg = '0'
                  AND status = '1'
                  AND area.delete_flg = '0'
                  AND province.delete_flg = '0'
                  AND u.user_id = '$user_id'
            ";

        $result = $this->db->query($sql)->result_array();
        if (isset($result[0])){
            return $result[0]['province'] . $result[0]['city'] . $result[0]['address'];
        }else{
            return '';
        }
    }

    /**
     * update user table
     * @param $params["value"]: for update array         ex) array( "table column name1" => "update value1",
     *                                                              "table column name2" => "insert value2",...);
     *               ["where"]: update record condition  ex) array( "table column name1" => "condition1",
     *                                                              "table column name2" => "condition2",...);
     * return boolean
     */
    public function update_user($params){

        $value = "";
        foreach($params["value"] as $key1=>$val1){
            $value .=  "`".$key1."`='".$val1."',";
        }
        $where = "";
        foreach($params["where"] as $key2=>$val2){
            $where .=  " `".$key2."`=".$val2." AND";
        }

        $sql = "UPDATE `user` SET ".rtrim($value,",")." WHERE " .rtrim($where,"AND");
        $result = $this->db->query($sql);

        return $result;
    }

    /**
     * [get users list]
     * @param  [string] $condition
     * @param  [array] $param
     * @return [array]
     */
    public function get_list($condition, $param)
    {

        if(empty($condition['apply_start_time'] )){
            $condition['apply_start_time'] = '2014-01-01';
        }

        if(empty($condition['apply_end_time'] )){
            $condition['apply_end_time'] = date("Y-m-d");
        }
        $delete_flg = $param['delete_flg'];
        $license = $param['license'];
        $relation_type = $param['relation_type'];
        $query_param = array($delete_flg);

        $select = '`user`.`user_id`, `user`.`name`, `user`.`birthdate`, `user`.`created`, `user`.`status`,GROUP_CONCAT(distinct `tag`.`name` separator ",") as `license`';
        $sql = "SELECT ".$select."
            FROM `user`
            LEFT JOIN `tag_relation` ON `tag_relation`.`account_id` = `user`.`user_id` AND `tag_relation`.`type` = ".$relation_type."
            LEFT JOIN `tag`  ON `tag`.`tag_id` = `tag_relation`.`tag_id` AND `tag`.`tag_group_id` = ".$license."
            WHERE `user`.`delete_flg` = ".$delete_flg." ";


        if (! empty($condition['keyword'])) {
            $keyword = "%{$condition['keyword']}%";
            $sql .=  "AND user_id IN (
            SELECT user_id FROM user
            WHERE
            CAST(`user`.`user_id` AS CHAR ) LIKE '".$keyword."'
             OR `user`.`name` collate utf8_unicode_ci LIKE '".$keyword."'
             OR `user`.`mail` collate utf8_unicode_ci LIKE '".$keyword."'
             )
            AND `user`.`created` BETWEEN '".$condition['apply_start_time']." 00:00:00' AND '".$condition['apply_end_time']." 23:59:59' ";
            // $license_sql .= "AND user_id IN (
            // SELECT user_id FROM user
            // WHERE
            // CAST(`user`.`user_id` AS CHAR ) LIKE '".$keyword."'
            //  OR `user`.`name` collate utf8_unicode_ci LIKE '".$keyword."'
            //  OR `user`.`mail` collate utf8_unicode_ci LIKE '".$keyword."'
            //  )
            // AND `user`.`created` BETWEEN '".$condition['apply_start_time']." 00:00:00' AND '".$condition['apply_end_time']." 23:59:59' ";
        }else{
            $sql .= " AND `user`.`created` BETWEEN '".$condition['apply_start_time']." 00:00:00' AND '".$condition['apply_end_time']." 23:59:59' ";
        }

        $sql .= "GROUP BY user.user_id
                    ORDER BY `user`.`created` DESC
                    LIMIT {$param['offset']}, {$param['limit']}";
        // $license_sql .= "LIMIT {$param['offset']}, {$param['limit']}";

        $users = $this->db->query($sql, $query_param)->result_array();
        // $license = $this->db->query($license_sql, $query_param)->result_array();

        return $users;
    }

    public function get_user_license($param, $user_id)
    {
        $delete_flg = $param['delete_flg'];
        $license = $param['license'];
        $relation_type = $param['relation_type'];
        $query_param = array($relation_type, $license, $user_id, $delete_flg);

        $license_sql = <<<EOF
        SELECT `tag`.`name` as `license`, `user`.`user_id`
        FROM `user`
         JOIN `tag_relation` ON `tag_relation`.`account_id` = `user`.`user_id` AND `tag_relation`.`type` = ?
         JOIN `tag`  ON `tag`.`tag_id` = `tag_relation`.`tag_id` AND `tag`.`tag_group_id` = ?
        where `user`.`user_id` IN ? AND`user`.`delete_flg` = ?
EOF;
        return $this->db->query($license_sql, $query_param)->result_array();
    }

    /**
     * get correct status user by $params
     * @param unknown $params['mail']
     *                       ['password']
     */
    public function check_exist_user_data($params){

        return $this->db->query("SELECT user_id FROM `user`
                                 WHERE `mail` = '".$params['mail'] ."'
                                 AND `password` = '".md5($params['password']) ."'
                                 AND `status` = 1
                                 AND `delete_flg` = 0")->result_array();
    }

    /**
     * check an account is exists
     * upgrade from models/Login_user::check_exist_user_data($params)
     *
     * @param string $email
     *
     * return boolean
     */
    public function isExists($email){

        $result = false;

        $email = trim($email);

        $sql = " SELECT user_id FROM `user`
                 WHERE `mail` = ?
                 AND `delete_flg`= 0
        ";

        $query = $this->db->query($sql, array($email));

        if ($query->num_rows() > 0)
        {
            $result = true;
        }

        return $result;
    }

    /**
     * return total count
     * @param  [array] $condition
     * @return [int]
     */
    public function get_total_count($condition)
    {
        if(empty($condition['apply_start_time'] )){
            $condition['apply_start_time'] = '2014-01-01';
        }

        if(empty($condition['apply_end_time'] )){
            $condition['apply_end_time'] = date("Y-m-d");
        }
        $delete_flg = $this->config->item('not_deleted','common_config');
        $query_param = array($delete_flg);

        $sql = "SELECT count('*') AS total
            FROM `user`
            WHERE `delete_flg` = ".$delete_flg;
        if (! empty($condition['keyword'])) {
            $keyword = "%{$condition['keyword']}%";
            $sql .= " AND `user`.`user_id` IN
                (SELECT `user`.`user_id`
                 FROM `user`
                 WHERE
                CAST(`user`.`user_id` AS CHAR ) LIKE '".$keyword."'
                OR `name`  collate utf8_unicode_ci LIKE '".$keyword."'
                OR `mail` collate utf8_unicode_ci LIKE '".$keyword."'
                )
                AND `created` BETWEEN '".$condition['apply_start_time']." 00:00:00' AND  '".$condition['apply_end_time']." 23:59:59'";
        }else{
                $sql .= " AND `created` BETWEEN '".$condition['apply_start_time']." 00:00:00' AND '".$condition['apply_end_time']." 23:59:59' ";

        }

        $query = $this->db->query($sql);
        return $query->row_array()['total'];

    }

    /**
     *return user detail
     * @param  [array] $param
     * @return [array]        array(id=>'test')
     */
    public function get_admin_user_detail($param)
    {
        $user_id = $param['user_id'];
        $delete_flg = $param['delete_flg'];

        $sql = <<<EOF
            SELECT *
            FROM `user`
            WHERE `delete_flg` = ?
            AND `user_id` = ?
EOF;

        $query = $this->db->query($sql, array($delete_flg, $user_id));

        return $query->row_array();

    }

    /**
     * delete user
     * @param  [array] $param
     * @return [bool]
     */
    public function delete_flg($param)
    {
        $user_id = $param['user_id'];
        $delete_flg = $param['delete_flg'];

        $sql = <<<EOF
            UPDATE `user`
            SET `delete_flg` = ?
            WHERE `user_id` = ?
EOF;

        $this->db->query($sql, array($delete_flg, $user_id));
        return (bool) $this->db->affected_rows();

    }

    public function get_export_data()
    {

        $sql = <<<SQL
            SELECT `user`.*, `province`.`name` AS `province`, `area`.`name` AS `city`, `user`.`address`
            FROM `user`
            LEFT JOIN `area` ON `area`.`area_id` = `user`.`area_id`
            LEFT JOIN `area` AS `province` ON `province`.`area_id` = `area`.`region_id`
SQL;

        $query = $this->db->query($sql);

        return $query->result_array();

    }





    /**
     * get token list
     */
    public function get_token_list(){
        return $this->db->query("SELECT token FROM `user`
                                 WHERE `token` != 'NULL' ")->result_array();
    }


    /**
     * get unfinished registration user by $params
     * @param unknown $params['token']
     */
    public function get_unfinished_registration_user($params){
        return $this->db->query("SELECT user_id FROM `user`
                                 WHERE `token` = '".$params['token'] ."'
                                 AND `status` = 0
                                 AND `delete_flg` = 0")->result_array();
    }

    public function finish_user_registration($params){
        return $this->db->query("UPDATE `user` SET
                                 `status` = 1,
                                 `token` = ''
                                 WHERE `user_id` = ".$params["user_id"]);

    }

    public function finish_registration_email($params){
        return $this->db->query("UPDATE `user` SET
                                 `status` = 1
                                 WHERE `user_id` = ".$params["user_id"]);

    }

    /**
     * activate new account
     * upgrade from self::finish_user_registration($params)
     *
     * @param   string  $token  This is TOKEN
     *
     * @return  boolean|array  New user data
     */
    public function activate($token)
    {
        $sql = "select * from user where token = ? and status = ? and delete_flg = ? ";

        $users = $this->db->query($sql, array($token, 0, 0))->result_array();

        if (empty($users))
        {
            return false;
        }

        $user_id = $users[0]['user_id'];
        $password = substr(md5(time()), 0,6);

        $users[0]['password'] = $password;

        $password = md5($password);

        $sql = "UPDATE user
                SET status = ?, token = '', password = ?
                WHERE user_id = ?
            ";

        $result = $this->db->query($sql, array(1, $password, $user_id));

        if (!$result)
        {
            return false;
        }

        return $users[0];
    }

    public function valid_token($token)
    {
        $delete_flg = 0;
        $sql = <<<SQL
SELECT user_id
FROM `user`
WHERE `delete_flg` = ? AND `token` = ?
SQL;
        $query = $this->db->query($sql, array($delete_flg, $token));
        return $query->row_array();
    }

    /**
     * get applied job by me
     *
     * @param   integer  $user_id
     *
     * @return  array
     */
    public function getAppliedJob($user_id, $perpage, $curpage)
    {
        $sql = "SELECT DISTINCT
        a.applicant_job_id,
        j.*,
        n.name as nursery_name, n.address as nursery_address,
        area.name as nursery_city,province.name as nursery_province,

        recomment.name as recomment,
        t.name as type_job

        FROM applicant_job as a

        LEFT JOIN job as j ON j.job_id = a.job_id
        LEFT JOIN user as u ON u.user_id = a.user_id
        LEFT JOIN nursery as n ON n.nursery_id = j.nursery_id

        LEFT JOIN area as area ON area.area_id = n.area_id
        LEFT JOIN area as province ON province.area_id = area.region_id


        LEFT JOIN tag_relation as tr ON tr.account_id = j.job_id AND tr.type = '1'
        LEFT JOIN tag as t ON t.tag_id = tr.tag_id AND t.tag_group_id = '2'
        LEFT JOIN  tag as recomment ON recomment.tag_id = tr.tag_id AND recomment.tag_group_id = '8'


        WHERE a.user_id = '$user_id'
        AND a.delete_flg = '0'
        AND j.delete_flg = '0'

        GROUP BY a.applicant_job_id
        ORDER BY a.created desc
        ";

        $string = $sql;




        $query =$this->db->query($string);
        $total = $query->num_rows();


            $limit_start = ($curpage - 1) * $perpage;
            $limit_end = $perpage;

            $sql .= " LIMIT $limit_start, $limit_end ";

            $items = $this->db->query($sql)->result_array();



            // LEFT JOIN  tag as tagemploy ON tagemploy.tag_id = tr.tag_id AND tagemploy.tag_group_id = '3'
            $this->load->model('Logic_tag_relation');
            $this->load->model('Logic_job');
            $this->load->model('Service_bookmark');

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
                            if (isset($images[0])){
                                $items[$k]['image'] = $images[0]['name'];
            }

            //get bookmark
            $items[$k]['bookmarked'] = (int)$this->Service_bookmark->is_done(array('user_id' => $user_id, 'job_id' => $item['job_id']));

            }


            $result = [
                'items'   => $items,
                'total'   => $total,
                'perpage' => $perpage,
                'item_start'  => $limit_start + 1,
                'item_end'  => $limit_start + count($items),
            ];

            return $result;
    }

    public function get_mail_for_info(){
    $sql = 'SELECT `mail` from `user` WHERE `delete_flg` = 0 AND `status` = 1';
    $query = $this->db->query($sql)->result_array();
        return $query;
    }
    /**
     * Change password user
     * @param int $user_id
     * @param string $password
     * @return boolean
     * @since 2015/05/05
     */
    public function get_wish($user_id){
                $sql         = "SELECT t.tag_id, t.name
                                    FROM
                                     tag_relation tr
                                    INNER JOIN user u ON tr.account_id = u.user_id
                                    INNER JOIN tag t ON tr.tag_id = t.tag_id
                                    WHERE
                                     u.user_id = ".$user_id."
                                    AND
                                     tr.type = 0
                                    AND
                                    t.tag_group_id = 3";
        $query       = $this->db->query($sql);
        $result      = $query->result_array();
        return $result;
    }
    public function change_password($user_id, $password){
        $params = [
            'password' => $password,
            'user_id' => (string)$user_id
        ];
        $sql = "UPDATE `user` SET `password`= ? WHERE `user_id` = ? ";
        $result = $this->db->query($sql, $params);
        return $result;
    }
}

