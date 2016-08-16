<?php
Class Service_apply extends MY_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Logic_applicant_job');
        $this->load->model('Logic_applicant_agency');
    }
     /* get admin jobs list
     * @param  [array] $condition
     * @param  [array] $parameters
     * @return [array]
     */
    public function get_condition_list($condition, $parameters)
    {
        if ($parameters['total'] == 0) {
            return array();
        }

        $param = array(
            'offset' => $parameters['offset'],
            'limit' => $parameters['limit'],
            'delete_flg' => $this->config->item('not_deleted','common_config')
        );

	$this->load->model('Service_tag');
	if(isset($condition['table_type']) && $condition['table_type']=='agent'){
	    //紹介会社応募
	    $data = $this->Logic_applicant_agency->get_condition_list($condition, $param);
	    //雇用形態どおりのプランをもってくる処理をここに　※下記参照
	}else{
	    //求人応募
            $data = $this->Logic_applicant_job->get_condition_list($condition, $param);
	    $limit_types = array('正社員' => 5, '正社員以外' => 6);
	    $this->config->load('tag_config', TRUE);

	    foreach($data as $key => $val)
		$employ_param = array('account_id' => $val['job_id'],
		    	 	      'type' => $this->config->item('type_relation_job','tag_config'),
				      'tag_group_id' => $this->config->item('type_employ','tag_config'));
		$employ_type = $this->Service_tag->getTags($employ_param);
		$val['employ_type'] = ($employ_type[0]['name'] == '正社員')? '正社員' : '正社員以外';
		$limit_type = $limit_types[$val['employ_type']];
	}

         $this->load->model('Logic_plan');
        $param['select'] = "`plan_group`.`name`,`plan`.`limit_type`";
        foreach ($data as $key => $value) {
            $param['client_id']  = $value['client_id'];
	    $param['limit_type'] = $limit_type;
            $plan_group = $this->Logic_plan->get_list($param);
            $data[$key]['plan_group_name'] = implode(',', array_column($plan_group, 'name'));
        } 
        return $data;
    }


    /**
     * get applied job by current user
     *
     * @param   array  $params  Array $keyword, $startdate, $enddate, $user_id, $perpage, $curpage
     *
     * @return  array
     */
    public function get_list($params)
    {
        $result = $this->Logic_applicant_job->getList($params);
        return $result;
    }

    public function checkPermission($id, $client_id)
    {
        return $this->Logic_applicant_job->checkPermission($id, $client_id);
    }
    public function confirm($applicant_job_id = null){
        if(empty($applicant_job_id)){
            return false;
        }
        $result = $this->Logic_applicant_job->confirm($applicant_job_id);
        if(!empty($result)){
          return true;
        }else{
          return false;
        }
    }
    /**
     * set status = 1 for applicants
     *
     * @param   array  $post  Array [$ids, client_comment]
     *
     * @return  boolean
     */
    public function excludeApplicantJob($post)
    {
        $result = true;

        $items = $this->Logic_applicant_job->exclude($post);

        if ($items){
            $this->load->model('Service_email');
            //ayak826@gmail.com
            // jazttijaztti@yaho.co.jp

            $emailAdmin = $this->config->item('email','admin');
            $emailAdmin = $emailAdmin ? $emailAdmin : 'ayak826@gmail.com';

            foreach ((array)$items as $item)
            {
                $params = [
                    'to' => $emailAdmin,
                    'client_name'    => $item['client_name'],
                    'user_name'      => $item['user_name'],
                    'client_comment' => $item['client_comment'],
                    'admin_login_url' => $this->config->item('admin_login_url','admin'),
                ];
                $result = $this->Service_email->except_apply_2admin($params);
            }

        }


        return $result;
    }
    public function update($post)
    {
        $param = array(
            'admin_comment'=> $post['admin_comment'],
            'applicant_job_id'=> $post['applicant_job_id']
        );
        return $this->Logic_applicant_job->update($param);
    }

    /**
     * set status = 0 for applicants
     *
     * @param   array  $post  Array [$ids, client_comment]
     *
     * @return  boolean
     */
    public function activeApplicantJob($post)
    {
        $result = false;

        $items = $this->Logic_applicant_job->active($post);

        if ($items){
            $result = true;

        }


        return $result;
    }

    /**
     * is_done is the function that user already applied status
     * @return boolean  false or true
     */
    public function is_done($param){

        $select      = array('applicant_job_id');
        $user_id     = $param['user_id'];
        $job_id      = $param['job_id'];
        $delete_flg  = $this->config->item('not_deleted','common_config');
        $apply_param = array('select'       =>  $select,
                             'user_id'      =>  $user_id,
                             'job_id'       =>  $job_id,
                             'delete_flg'   =>  $delete_flg);
        $record = $this->Logic_applicant_job->get_detail($apply_param);
        if(!empty($record[0])){
          return true;
        }else{
          return false;
        }
    }
    /**
     * Already apply job status 0 or 1, delete_flg = 0
     * @param array $param
     * @return boolean
     */
    public function already_apply($param){
        $this->load->model('Logic_applicant_job');

        $select      = array('applicant_job_id');
        $user_id     = $param['user_id'];
        $job_id      = $param['job_id'];
        $status      = [$this->config->item('done','apply_config'), $this->config->item('none','apply_config')];
        $delete_flg  = $this->config->item('not_deleted','common_config');
        $apply_param = array(
            'select'       =>  $select,
            'user_id'      =>  $user_id,
            'job_id'       =>  $job_id,
            'status'       =>  $status,
            'delete_flg'   =>  $delete_flg);
        $record = $this->Logic_applicant_job->get_row($apply_param);
        if(! empty($record[0])){
            return true;
        }else{
            return false;
        }
    }


    /**
     * get entry total count
     * @param  [string] $condition
     * @return [int]
     */
    public function get_total_count($condition)
    {
        return $this->Logic_applicant_job->get_total_count($condition);
    }

    public function get_applicant_job_detail($id)
    {
        if(empty($id)){
            return array();
        }else{
            $data = $this->Logic_applicant_job->get_admin_detail($id);
	    $this->load->model('Service_area');
	    $data['user_area'] = $this->Service_area->get_area_name($data['user_area_id']);

	    $limit_types = array('正社員' => 5, '正社員以外' => 6);
            $this->config->load('tag_config', TRUE);

            $employ_param = array('account_id' => $data['job_id'],
                                  'type' => $this->config->item('type_relation_job','tag_config'),
                                  'tag_group_id' => $this->config->item('type_employ','tag_config'));
            $employ_type = $this->Service_tag->getTags($employ_param);
            $data['employ_type'] = ($employ_type[0]['name'] == '正社員')? '正社員' : '正社員以外';
            $limit_type = $limit_types[$data['employ_type']];

            $this->load->model('Logic_plan');
            $param['select'] = "`plan_group`.`name`,`plan`.`limit_type`";
            $param['client_id']  = $data['client_id'];
            $param['limit_type'] = $limit_type;
            $plan_group = $this->Logic_plan->get_list($param);
            $data['plan_group_name'] = implode(',', array_column($plan_group, 'name'));

	    return $data;
        }
    }

    public function delete_flg($id){
        if(empty($id)){
            return FALSE;
        }else{
            return $this->Logic_applicant_job->delete_flg($id);
        }

    }

    public function check_limit($job_id = false){
        if(empty($job_id)){
            return false;
        }
        $this->load->model('Service_job');
        $job_limit = 0;
        $job_limit = $this->Service_job->get_limit($job_id);
        if($job_limit > 0){
            //check recent job limit data
            $count = $this->Logic_applicant_job->get_count($job_id);
            if(!empty($count[0]['count'])){
                $applied_count = $count[0]['count'];
            }else{
                $applied_count = 0;
            }
            if(($applied_count > 0)&&($applied_count >= $job_limit)){
                //close job
                $this->Service_job->close($job_id);
                return true;
            }
        }else{
            return false;
        }
    }

    /**
     * Count record user applied job
     * @param array $params | $params['user_id']
     * @since 2015/05/05
     */
    public function count_user_applied_job($params){
        $this->load->model('Logic_applicant_job');
        $result = $this->Logic_applicant_job->get_applicant_job_count($params);
        if($result && ! empty($result)){
            return array_shift($result);
        }else{
            return 0;
        }
    }
    public function check_apply($user_id,$client_id){
        if((empty($user_id))&&(empty($client_id))){
            return false;
        }
        $judge = $this->Logic_applicant_agency->check_apply($user_id,$client_id);
        if ($judge['count'] > 0){
            return true;
        }
	return false;
    }

    public function get_csv_data($params, $format)
    {
        $headers = $this->config->item('client_job_apply', 'export_column_config');

        $result = $this->get_list($params);

        $applicant_jobs = $result['items'];
        foreach ($applicant_jobs as $key => $value) {
            $applicant_jobs[$key]['created'] = date('Y-m-d', strtotime($value['created']));
            $applicant_jobs[$key]['nursery_name_and_type_job'] = $value['nursery_name'].'・'.$value['type_job'];

            foreach($value['user_license'] as $ul){
                $applicant_jobs[$key]['user_license_name'] .= '・' . $ul['name'];
            }
        }

        $this->load->model('Service_export_file');
        return $this->Service_export_file->export($headers, $applicant_jobs, $format);
    }
}
?>
