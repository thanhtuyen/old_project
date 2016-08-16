<?php
require_once 'CreateTrait.php';

Class Logic_analyze extends MY_Model{

    use CreateTrait;

    public $table = 'analyze';

    public function __construct()
    {
        parent::__construct();
    }

    //save visitor's info
    public function save_to_analyze($value){
	$query_param = array($value['ip'], $value['page'], $value['career_type'], $value['utm_source'], $value['utm_medium'], $value['utm_campaign'],$value['created']);
	$sql = "INSERT INTO `analyze` (`ip`,`page`,`career_type`,`utm_source`,`utm_medium`,`utm_campaign`,`created`) VALUES (?,?,?,?,?,?,?)";
	$query = $this->db->query($sql, $query_param);
    }

    public function count_send_mail($date){
	$sql = "SELECT COUNT(DISTINCT(`user_id`)) AS count FROM `send_job` WHERE `send` LIKE '".$date."%' AND `send_status` = 1";
	$query = $this->db->query($sql);
	$result = $query->result();
        return $result;
    }

    public function count_click($date){
	$sql = "SELECT COUNT(`send_job_id`) AS count FROM `send_job` WHERE `click_count` > 0 AND `first_access` LIKE '".$date."%' AND `send_status` = 1";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function count_send_job($date){
	$sql = "SELECT COUNT(`send_job_id`) AS count FROM `send_job` WHERE `send` LIKE '".$date."%' AND `send_status` = 1";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    /* get sales data from apply_XX table
     */
    public function get_sales($date,$table){
	$query_param = array($date."%");
	if($table == "applicant_job"){
	    $sql = <<<EOF
		SELECT COUNT(`a`.`applicant_job_id`) AS total_application, SUM(`a`.`unit_price`) AS total_sales
		FROM `applicant_job` `a`
		WHERE `a`.`created` LIKE ?
EOF;
	}elseif($table == "applicant_agency"){
            $sql = <<<EOF
                SELECT COUNT(`a`.`applicant_agency_id`) AS total_application, SUM(`a`.`unit_price`) AS total_sales
                FROM `applicant_agency` `a`
                WHERE `a`.`created` LIKE ?
EOF;
	}else{
	    return false;
	}
	$result = $this->db->query($sql,$query_param)->row_array();
        return $result;
    }

    public function get_analyze_job($date){
	$query_param = array($date."%");
	$sql = <<<EOF
		SELECT `open_jobs_number`,`closed_jobs_number`,`active_clients_number`,`passive_clients_number`
		FROM `analyze_job`
		WHERE `created` LIKE ?
EOF;
	$result = $this->db->query($sql,$query_param)->row_array();
        return $result;
    }

    /* count the users who registered during one day
     * $param = '2015-03-03'
     */
    public function count_register_per_day($param){
	$where = $param . "%";
	$sql = "SELECT COUNT(`user_id`) AS count FROM `user` WHERE `created` LIKE '" . $where . "' AND `status` = 1";
	$query = $this->db->query($sql);
	$result = $query->result();
        return $result;
    }

    /* count the users who registered during one day, by the service
     * $param = '2015-03-03'
     */
    public function count_register_per_day_service($param = null){
	if($param != null){
//var_dump($param);exit;
            $sql = "SELECT COUNT(`channel`) AS count,`channel` FROM `user` WHERE `created` LIKE '" . $param . "%' AND `status` = 1  GROUP BY `channel`";
	}else{
	    $sql = "SELECT COUNT(`channel`) AS count,`channel` FROM `user` WHERE `status` = 1  GROUP BY `channel`";
	}

	$query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    /* count the users who registered during one day per 1 hour
     * $param = '2015-03-03'
     */
    public function count_register_per_day_hour($param){
	$hour = 0;
	$register = array();
	while ($hour <= 23){
            $where = $param . " " . $hour . ":%";
            $sql = "SELECT COUNT(`user_id`) AS count FROM `user` WHERE `created` LIKE '" . $where . "' AND `status` = 1";
	    $query = $this->db->query($sql);
            $result = $query->result();
            $register[$hour] = $result;
	    $hour ++;
	}
	return $register;
    }

    /* count all users who registered
     */
    public function count_all_register(){
	$sql = "SELECT COUNT(`user_id`) AS count FROM `user` WHERE `status` = 1";
	$query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function count_applicant_job_per_day_employ($param){
	$tag_relation_type = 1;
	$tag_group_id = 3;

	$sql = "SELECT o.tag_id, (SELECT tag.name FROM tag WHERE tag.tag_id = o.tag_id) name, COUNT(1) AS count
		FROM applicant_job a 
			LEFT JOIN (SELECT tr.account_id, MIN(t.tag_id) tag_id
					FROM tag_relation tr INNER JOIN tag t ON tr.tag_id = t.tag_id
					WHERE tr.type = ".$tag_relation_type." AND t.tag_group_id = ".$tag_group_id."
					GROUP BY tr.account_id) o 
			ON a.job_id = o.account_id
		WHERE a.created BETWEEN '".$param." 00:00:00' AND '".$param." 23:59:59'
		GROUP BY o.tag_id
		ORDER BY o.tag_id";

	$query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function count_applicant_agent_per_day_employ($param){
        $tag_relation_type = 0;
        $tag_group_id = 3;

        $sql = "SELECT COUNT(`a`.`applicant_agency_id`) AS count, `t`.`name` FROM (`applicant_agency` `a` INNER JOIN `tag_relation` `r` ON `a`.`user_id` = `r`.`account_id`) INNER JOIN `tag` `t` ON `r`.`tag_id` = `t`.`tag_id` WHERE `a`.`created` LIKE '".$param."%' AND `r`.`type` = ".$tag_relation_type." AND `t`.`tag_group_id` = ".$tag_group_id." GROUP BY `t`.`tag_id`;";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function count_applicant_per_day($param,$table){
	$where = $param . "%";
        $sql = "SELECT COUNT(`".$table."_id`) AS count FROM `".$table."` WHERE `created` LIKE '" . $where . "'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    /* count all visitors
     */
    public function count_all_visitor(){
        $sql = "SELECT COUNT(DISTINCT `ip`) AS count FROM `analyze`";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    /* count the visitors during one day
     * $param = '2015-03-03'
     */
    public function count_visitor_per_day($param){
	$where = $param . "%";
	$sql = "SELECT COUNT(DISTINCT `ip`) AS count FROM `analyze` WHERE `created` LIKE '" . $where . "'";
	$query = $this->db->query($sql);
	$result = $query->result();
        return $result;
    }

    /* count the visitors during one day, by the service
     * $param = '2015-03-03'
     */
    public function count_visitor_per_day_service($param){
        $where = $param . "%";
	$visitor = array();
	$page = array('proto_a', 'proto_b1', 'proto_c');
	foreach($page as $val){
            $sql = "SELECT COUNT(DISTINCT `ip`) AS count FROM `analyze` WHERE `created` LIKE '" . $where . "' AND `page` LIKE '" . $val . "%'";
	    $query = $this->db->query($sql);
            $result = $query->result();
            $visitor[$val] =  $result;
	}
	return $visitor;
    }

    /* count the visitors during one day per 1 hour
     * $param = '2015-03-03'
     */
    public function count_visitor_per_day_hour($param){
	$hour = 0;
	$visitor = array();
	while ($hour <= 23){
            $where = $param . " " . $hour . ":%";
            $sql = "SELECT COUNT(DISTINCT `ip`) AS count FROM `analyze` WHERE `created` LIKE '" . $where . "'";
	    $query = $this->db->query($sql);
            $result = $query->result();
            $visitor[$hour] = $result;
	    $hour ++;
	}
	return $visitor;
    }

}
?>
