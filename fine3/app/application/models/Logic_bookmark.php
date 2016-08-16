<?php
Class Logic_bookmark extends MY_Model{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * get_detail only returns bookmark_id array
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
        $status      = $param['status'];
        $delete_flg  = $param['delete_flg'];
        $query_param = array($user_id,$job_id,$status,$delete_flg);
        $sql         = "SELECT {$select} FROM `bookmark`
                        WHERE `user_id` = ?
                        AND `job_id` = ?
                        AND `status` = ?
                        AND `delete_flg` = ?  ";
        $query       = $this->db->query($sql, $query_param);
        $result      = $query->result_array();
        return $result;
    }

    /**
     * add bookmark
     * @param  (array)$params
     * @return boolean
     */
    public function add_bookmark($params)
    {
        $sql = "INSERT INTO bookmark(user_id, job_id, created, status) VALUES(?, ?, ?, 1)";
        return $this->db->query($sql, $params);
    }

    /**
     * update bookmark to deleted
     * @param  (array)$params
     * @return boolean
     */
    public function update_bookmark($params)
    {
        $sql = "UPDATE bookmark SET delete_flg = ? WHERE user_id = ? AND job_id = ?";
        $result = $this->db->query($sql, $params);
        return $result;
    }
    /**
     * Count all record bookmarked of current user
     * @param array $params
     * $params['user_id']
     * $params['status']
     * $params['delete_flg']
     * @return number
     */
    public function count($params){
        $sql = "SELECT COUNT(1) AS count FROM bookmark
                JOIN job ON bookmark.job_id = job.job_id
                WHERE bookmark.user_id = ".$params['user_id']."
                AND   bookmark.status  = ".$params['status']."
                AND   bookmark.delete_flg = ".$params['delete_flg']."
                AND   job.delete_flg = ".$params['delete_flg']." ";
        $query = $this->db->query($sql, $params);
        $result      = $query->result();
        return intval( $result[0]->count );
    }

    /**
     * Get bookmark and pagination with current user
     * @param array $params
     * $params['select']
     * $params['delete_flg']    // delete_flg job
     * $params['status']        // status job
     * $params['delete_flg']    // delete_flg bookmark
     * $params['status']        // status job
     * $params['user_id']       // user_id
     * @return false/array object
     */
    public function get_bookmark($params, $offset, $limit){
        $data = false;

        $sql  = "SELECT ".$params['select']." \n".
                "FROM `job` `j` " .
                "INNER JOIN `bookmark` `b` \n
                ON `j`.`job_id` = `b`.`job_id`
                    WHERE
                    `j`.`delete_flg` = ".$params['delete_flg']." AND
                    `b`.`delete_flg` = ".$params['delete_flg']." AND
                    `b`.`status`= ".$params['status']."  AND
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
     * Get Bookmark by ID
     * @param array $query_param
     * @return boolean/array
     */
    public function getByID($query_param){
        $data = false;
        $sql         = "SELECT COUNT(1) FROM `bookmark`
                        WHERE `user_id` = ?
                        AND `bookmark_id` = ? ";
        $query       = $this->db->query($sql, $query_param);
        $result      = $query->result();
        if( $result && ! empty($result)){
            $data = true;
        }
        return $data;
    }
    /**
     * Remove Bookmark by ID & user id
     * @param array $query_param
     * @return boolean/array
     * @since 2015/04/21
     */
    public function remove_bookmark($params){
        $sql = "UPDATE bookmark SET delete_flg = {$params["delete_flg"]} WHERE user_id = {$params["user_id"]} AND job_id IN ({$params["job_id"]})";
        $result = (bool) $this->db->query($sql);
        return $result;
    }
    /**
     * Get detail bookmark delete_flg or not
     * @param array $param
     * @return array
     */
    public function get_detail_bookmark($param){
        $select      = array_to_select_str($param['select']);
        $user_id     = $param['user_id'];
        $job_id      = $param['job_id'];
        $status      = $param['status'];
        $query_param = array($user_id,$job_id,$status);
        $sql         = "SELECT {$select} FROM `bookmark`
        WHERE `user_id` = ?
        AND `job_id` = ?
        AND `status` = ? ";
        $query       = $this->db->query($sql, $query_param);
        $result      = $query->result_array();
        if($result){
            return $result[0];
        }else{
            return false;
        }
    }

    public function get_bookmark_count($params){
        $sql         = "SELECT COUNT(*) FROM `bookmark`
                        WHERE `user_id` = ".$params['user_id']."
                        AND `delete_flg` = 0";
        return $this->db->query($sql)->row_array();
    }

    public function check_bookmark($user_id,$job_id){
        $sql = "SELECT COUNT(*) AS count FROM bookmark
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
}
?>
