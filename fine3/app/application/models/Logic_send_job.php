<?php
Class Logic_send_job extends MY_Model{
 
   public function __construct()
    {
        parent::__construct();
    }

    public function save($param)
    {
        $user_id = $param['user_id'];
        $job_id = $param['job_id'];
        $created =  date('Y-m-d H:i:s');
        $query_param = array($user_id, $job_id, $created);
        $sql =<<<SQL
INSERT INTO send_job (user_id, job_id,  `created`) VALUES (?,?,?)
SQL;
        $this->db->query($sql, $query_param);
        return  $this->db->affected_rows(); 
    }

    public function get_threemail_users()
    {
        $sql = <<<SQL
SELECT user_id FROM send_job where send_status =0 GROUP BY user_id  limit 300
SQL;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $result = array_column($result, 'user_id');
        return $result;
    }

    public function update_status($param){
        $user_id = $param['user_id'];
        $where = $param['where'];
        $status = $param['status'];
        $send =  date('Y-m-d H:i:s');
        $query_param = array($status, $send, $user_id, $where);
        $sql = <<<SQL
UPDATE send_job SET send_status = ?, send = ? WHERE user_id = ? AND send_status = ? LIMIT 3
SQL;
        $this->db->query($sql, $query_param);
        return  $this->db->affected_rows(); 
    }

    public function select_threemail_data($param)
    {
        $user_id = $param['user_id'];
        $query_param = array($user_id);
        $type_job = $this->config->item('type_job','tag_config');
        $type_relation_job = $this->config->item('type_relation_job','tag_config');
        $sql = <<<SQL
SELECT user.mail AS email, user.user_id AS user_id,
 job.job_id AS job_id, job.title AS title,
 user.token AS token,
job.salary AS salary, tag.name AS occupation,
nursery.station_name AS station_name
FROM send_job
LEFT JOIN user ON user.user_id = send_job.user_id
LEFT JOIN job ON send_job.job_id = job.job_id
LEFT JOIN tag_relation ON job.job_id = tag_relation.account_id
LEFT JOIN tag ON tag_relation.tag_id =  tag.tag_id
LEFT JOIN tag_group ON tag_group.tag_group_id =  tag.tag_group_id
LEFT JOIN nursery ON job.nursery_id = nursery.nursery_id
LEFT JOIN area ON nursery.area_id = area.area_id
WHERE
send_job.user_id = ?
AND
send_job.send_status = 0
GROUP BY
send_job.send_job_id
ORDER BY
send_job.send_job_id ASC
SQL;
        $query = $this->db->query($sql, $query_param);
        $result = $query->result_array();
        return $result;
    }
    public function get_already_list($param){
        $user_id = $param['user_id'];
        $query_param = array($user_id);
        $sql = <<<SQL
SELECT job_id FROM send_job WHERE user_id=?
SQL;
        $query = $this->db->query($sql, $query_param);
        $result = $query->result_array();
        $result = array_column($result, 'job_id');
        return $result;
    }

    public function is_exist_same_secret($md5_after){
	$date = date("Y-m-d H:i:s");
	$sql = "SELECT COUNT(`send_job_id`) `count` FROM `send_job` WHERE `expired` >= '".$date."' AND `secret` = '".$md5_after."'";
	$result = $this->db->query($sql)->row_array();
	return $result;
    }

    public function update_old_expired($md5){
	$date = date('Y-m-d',mktime(0, 0, 0, date("m")+1,date("d"),date("Y"))).' 00:00:00';
	$sql = "UPDATE `send_job` SET `expired` = '".$date."' WHERE `secret` = '".$md5."'";
	$result = $this->db->query($sql);
	return $result;
    }

    /*
 *	$insert = array('user_id'     => $param['user_id'],
 *                         'send_status'         => 3,
 *                         'job_id'       => $param['job_id'],
 *                         'secret' => $md5,
 *                         'expired' => date('Y-m-d',mktime(0, 0, 0, date("m")1,date("d"),date("Y"))).' 00:00:00',
 *                         'created' => $date('Y-m-d H:m:s');    
*/
    public function insert_url_generation($insert){
        $query_param = array($insert['secret'],$insert['user_id'],$insert['job_id'],$insert['created'],$insert['expired'],$insert['send_status']);
        $sql = "INSERT INTO `send_job` (`secret`,`user_id`,`job_id`,`created`,`expired`,`send_status`) VALUES(?,?,?,?,?,?)";
        $result = $this->db->query($sql,$query_param);
        return $result;
    }

    public function get_token_data($token){
	$date = date("Y-m-d H:i:s");
	$sql = "SELECT * FROM `send_job` WHERE `secret` = '".$token."' AND `expired` >= '".$date."'";
	$query = $this->db->query($sql);
	$result = $query->result_array();
        return $result;
    }
}
