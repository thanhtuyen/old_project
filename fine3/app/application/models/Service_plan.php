<?php
Class Service_plan extends MY_Model{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_available_list($client_id){
      if(empty($client_id)){
        return false;
      }
        $this->load->model('Logic_plan');
        $param['select'] = "`plan_group`.`plan_group_id`,
                            `plan_group`.`name`,
                            `plan_group`.`period`,
                            `plan_group`.`price`,
                            `plan_group`.`unit_price`,
                            `plan_group`.`unlimited_flg`";
        $param['client_id']    = $client_id;
        $this->load->model('Service_client');
        $client_info           = $this->Service_client->get_detail($client_id);

        $param['status_array'] = $this->_judge_status($client_info['account_type']);
        $param['delete_flg']   = $this->config->item('not_deleted','common_config');
        $result = $this->Logic_plan->get_open_list($param);
       if(!empty($result[0])){
          return $result;
       }else{
          return false;
       }
    }
    private function _judge_status($account_type){
      $this->load->config('client_config');
      switch ($account_type) {
        case   $this->config->item('nursery','client_config'):
               return array(1,2,3,6);
          break;
        case   $this->config->item('headhunter','client_config'):
               return array(4,5,7);
          break;
        default:
               return array(1,2,3,6);
          break;
      }
    }
    /**
     * this function is return only displayable data.
     * not return password, mail, and other secret.
     * @param  $client_plan_relation_id(int)
     * @return array or false;
     */
    public function get_detail($param){
       if(empty($param['client_plan_group_relation_id'])){
        return false;
      }
      $client_plan_group_relation_id = $param['client_plan_group_relation_id'];
      $client_id = $param['client_id'];
        $this->load->model('Logic_plan');
        $param['select'] = "`client_plan_group_relation`.`auto_extend_flg`,
                            `plan_group`.`name`,
                                         `plan_group`.`price`,
                                         `plan_group`.`extend_period`,
                                         `client_plan_group_relation`.`client_plan_group_relation_id`,
                                         `client_plan_group_relation`.`plan_group_id`,
                                         `client_plan_group_relation`.`discount`,
                                         `client_plan_group_relation`.`expire_month`,
                                         `client_plan_group_relation`.`created`,
                                         `client_plan_group_relation`.`delete_flg`";
        $result = $this->Logic_plan->get_detail($param);
       if(empty($result[0])){
        return false;
      }
        $pgr =$result[0]['plan_group_id'];
        $plan = $this->Logic_plan->get_plan($pgr);
        if(!empty($plan)){
          $result[0]['plan'] = $plan;
          return $result[0];
        }
    }
        /**
     * this function is return only displayable data.
     * not return password, mail, and other secret.
     * @param  $client_plan_relation_id(int)
     * @return array or false;
     */
    public function get_group_detail($param){
       if(empty($param['plan_group_id'])){
        return false;
      }
      $plan_group_id = $param['plan_group_id'];
      $client_id = $param['client_id'];
        $this->load->model('Logic_plan');
        $param['select'] = "`plan_group`.`plan_group_id`,
                            `plan_group`.`name`,
                            `plan_group`.`period`,
                            `plan_group`.`price`,
                            `plan_group`.`unit_price`,
                            `plan_group`.`period`,
                            `plan_group`.`extend_period`,
                            `plan_group`.`unlimited_flg`,
                            `plan_group`.`auto_extend_flg`";
        $param['delete_flg'] = $this->config->item('not_deleted','common_config');
        $result = $this->Logic_plan->get_group_detail($param);
       if(!empty($result[0])){
          return $result[0];
       }else{
          return false;
       }
    }
    /**
     * list gets till group_plan information
     * @param  [type] $client_id [description]
     * @return [type]            [description]
     */
    public function get_list($client_id = null){
      if(empty($client_id)){
        return false;
      }
        $this->load->model('Logic_plan');
        $param['select'] = "`client_plan_group_relation`.`client_plan_group_relation_id`,
                            `plan_group`.`name`,
                           `plan_group`.`price`,
                           `client_plan_group_relation`.`client_id`,
                           `client_plan_group_relation`.`plan_group_id`,
                           `client_plan_group_relation`.`discount`,
                           `client_plan_group_relation`.`expire_month`,
                           `client_plan_group_relation`.`delete_flg`,
                           `client_plan_group_relation`.`created`";
        $param['client_id']   = $client_id;
        $result = $this->Logic_plan->get_list($param);

       if(!empty($result)){
          return $result;
       }else{
          return false;
       }
    }
    /**
     * list gets till group_plan information
     * @param  [type] $client_id [description]
     * @return [type]            [description]
     */
    public function get_plan_list($plan_group_id = null){
      if(empty($plan_group_id)){
        return false;
      }
        $this->load->model('Logic_plan');
                $param['select'] = "`plan`.`plan_id`,
                                    `plan`.`plan_name`,
                                    `plan`.`description`";
        $param['plan_group_id']   = $plan_group_id;
        $result = $this->Logic_plan->get_plan_list($param);
       if(!empty($result)){
          return $result;
       }else{
          return false;
       }
    }
    public function apply($param){
      $param['discount']   = 0;
      $now = new Datetime();
      $param['apply_date'] = $now->format('Y-m-d');
      if($param['plan_group']['unlimited_flg'] == 0){
        $param['expire_month'] = $now->modify('+'.$param['plan_group']['period'].' month')->format('Y-m-d H:i:s');
      }else{
        $unlimit_date = new Datetime('9999-12-31');
        $param['expire_month'] = $unlimit_date->format('Y-m-d');
      }
      $result = $this->Logic_plan->apply($param);
      return $result;
    }

    /**
     * admin side create client plan
     * @param  [array]
     * @return [bool]
     */
    public function create_plan($post)
    {
        $month = '+' . $post['month'] . ' months';
        $expire_month = date('Y-m-d', strtotime($month, strtotime(current_time())));
        $param = array(
          'client_id' => $post['client_id'],
          'plan_group_id' => $post['plan_group_id'],
          'discount' => '0',
          'auto_extend_flg' => $post['auto_extend_flg'],
          'expire_month' => $expire_month,
          'created' => current_time(),
        );
        return $this->Logic_plan->create_client_plan($param);
    }


    public function stop($param){
      $delete_param['delete_flg'] = $this->config->item('deleted','common_config');
      $delete_param['client_plan_group_relation_id']    = $param['client_plan_group_relation_id'];
      $result = $this->Logic_plan->stop($delete_param);
      return $result;
    }

    // calcurate for plan
    // return true or false
    public function calculate_scout($param){
        $client_id = $param['client_id'];
        //check current contracting plan
        $count = $this->get_scout_limit($client_id);
        if($count === false){
          $result['result'] = false;
          return $result;
        }
        //check already send
        $plans = $this->get_scout_plan($client_id);
        if($plans === false){
          $result['result'] = false;
          return $result;
        }
        $this->load->model('Service_scout');
        $sent_count = $this->Service_scout->get_sent_count($plans);
          $result['count']      = $count;// now available count
          $result['sent_count'] = $sent_count;  //already send item count
          $result['send_count'] = $param['send_count']; //will send item count
        if($count > ($sent_count + $param['send_count']) ){
          $result['diff'] = ($count - ($sent_count + $param['send_count']));//available count after your send
          $result['result'] = true; //is enable to send or not.
        }else{
          $result['result'] = false;
        }
          return $result;
    }

    /**
     * calculate scout limit then
     * @param  [type] $client_id [description]
     * @return int or false
     */
    private function get_scout_limit($client_id = null){
      if(empty($client_id)){
        return false;
      }
        $this->load->model('Logic_plan');
        $result = $this->Logic_plan->get_scout_limit($client_id);
       if(!empty($result[0]['send_limit'])){
          return $result[0]['send_limit'];
       }else{
          return false;
       }
    }

    /**
     * calculate scout limit then
     * @param  [type] $client_id [description]
     * @return int or false
     */
    private function get_scout_plan($client_id = null){
      if(empty($client_id)){
        return false;
      }
        $this->load->model('Logic_plan');
        $data = $this->Logic_plan->get_scout_plan($client_id);
       if(!empty($data)){
        foreach ($data as $row){
          $result[] = $row['cpgr_id'];
        }
        return $result;
       }else{
          return false;
       }
    }
    public function using_cpgr($client_id = null){
        //his plan relation data
        //evaluate
        $plans = $this->get_scout_plan($client_id);
        if($plans === false){
          return false;
        }
        $this->load->model('Service_scout');
        //
        $data = $this->_check_capacity($plans);
        if(empty($data)){
          return false;
        }
        $decided_cpgr_id = $this->_judge_cpgr($data);
        if(empty($decided_cpgr_id)){
          return false;
        }
        return $decided_cpgr_id;

        // $this->load->model('Logic_plan');
        // //cpgr data
        // $data = $this->Logic_plan->cpgr_list($client_id);
        // // $scouted = $this->Service_scout->
        // return $result;
    }
    /**
     * [export_file description of plan
     * @param  string
     * @return array
     */
    public function export_file($format)
    {
        $headers = $this->config->item('plan','export_column_config');
        $export_results = $this->Logic_plan->get_export_data();
        foreach ($export_results as &$result) {
          $result['limit_type'] = limit_type_text($result['limit_type']);
        }
        unset($result);
        $this->load->model('Service_export_file');

        return $this->Service_export_file->export($headers, $export_results, $format);
    }


    public function export_group_file($format)
    {
        $headers = $this->config->item('plan_group','export_column_config');

        list($groups, $plans)= $this->Logic_plan->get_export_group_data();
        $group = array_unique($groups, SORT_REGULAR);

        $export_results = $this->_generate_export_param($group, $plans);
        foreach ($export_results as &$result) {
          $result['status'] = admin_status_text($result['status']);
          $result['delete_flg'] = delete_text($result['delete_flg']);
          $result['auto_extend_flg'] = auto_extend_text($result['auto_extend_flg']);
        }
        unset($result);

        $this->load->model('Service_export_file');

        return $this->Service_export_file->export($headers, $export_results, $format);
    }

    private function _judge_cpgr($data){
      $id = false;
      if(array_key_exists('option', $data)){
        foreach($data['option'] as $row){
          if($row['capacity'] > $row['sent_count']){
            $id = $row['cpgr_id'];
            break;
          }
        }
      }
      if(array_key_exists('basic', $data)){
        foreach($data['basic'] as $row){
          if($row['capacity'] > $row['sent_count']){
            $id = $row['cpgr_id'];
            break;
          }
        }
      }
      return $id;
    }
    private function _check_capacity($plans){
              $i = 0;$j = 0;
        $result = array();
        foreach($plans as $cpgr_id){
          //get plan type
          $status = $this->Logic_plan->cpgr_monthly_info($cpgr_id);
          if(is_numeric($status)){

            //get plan_group_id related sent
              //get plan_group_id related sent
            $capacity = $this->Logic_plan->single_scout_limit($cpgr_id);
            if(!is_null($capacity)){
              $result['basic'][$j]['capacity']= $capacity;
              $result['basic'][$i]['cpgr_id'] = $cpgr_id;
              $result['basic'][$i]['status'] = $status;
              $result['basic'][$i]['sent_count'] = $this->Service_scout->get_each_sent_count($cpgr_id);
              $i ++;
            }
          }else if($status === false){
            //try to get plan option
            $status = $this->Logic_plan->cpgr_shot_info($cpgr_id);
            if(is_numeric($status)){
              //get plan_group_id related sent
              $capacity = $this->Logic_plan->single_scout_limit($cpgr_id);
              if(!is_null($capacity)){
                $result['option'][$j]['capacity']= $capacity;
                $result['option'][$j]['cpgr_id'] = $cpgr_id;
                $result['option'][$j]['status'] = $status;
                $result['option'][$j]['sent_count'] = $this->Service_scout->get_each_sent_count($cpgr_id);
                $j ++;
              }

            }
          }
        }
        return $result;
    }


   public function calcurate_apply_price($user_id = null,$job_id = null){
      if((empty($job_id))||(empty($user_id))){
        return 0;
      }
      //get job employee category
        $job_type =$this->Service_job->get_type($job_id);
        if(empty($job_type)){
          return 0;
        }
      //get client_id
        $this->load->model('Service_job');
        $client_id = $this->Service_job->get_client_id($job_id);
        if(empty($client_id)){
          return 0;
        }
        //convert job_type into limit_type
        $limit_type = $this->_convert_limit_job_type($job_type);
        if(empty($limit_type)){
          return 0;
        }
        //get his contract plan list,
        $this->load->model('Logic_plan');
        $price = $this->Logic_plan->cpgr_job($client_id,$limit_type);
        //check plan if the list has
        if(empty($price[0]['unit_price'])){
          return 0;
        }
        return $price[0]['unit_price'];
    }

   public function calcurate_apply_agent_price($user_id = null,$client_id = null){
      if((empty($client_id))||(empty($user_id))){
        return 0;
      }

      //get user data
        $this->load->model('Service_user');
        $user_type = $this->Service_user->get_wish($user_id);
        //convert job_type into limit_type
        $limit_type = $this->_convert_limit_agency_type($user_type);
        if(empty($limit_type)){
          return 0;
        }
        //get his contract plan list,
        $this->load->model('Logic_plan');
        $price = $this->Logic_plan->cpgr_job($client_id,$limit_type);
        //check plan if the list has
        if(empty($price[0]['unit_price'])){
          return 0;
        }
        return $price[0]['unit_price'];
    }
    private function _convert_limit_job_type($type = null){
      if(empty($type)){
        return false;
      }
      $this->load->config('job_config');
      switch ($type) {
        case $this->config->item('fulltime','job_config'):
          $limit_type = 5;
          break;
        case $this->config->item('parttime','job_config'):
          $limit_type = 6;
          break;
        case $this->config->item('temp','job_config'):
          $limit_type = 5;
          break;
        case $this->config->item('dispatch','job_config'):
          $limit_type = 6;
          break;
        case $this->config->item('future_dispatch','job_config'):
          $limit_type = 6;
          break;
        default:
          $limit_type = false;
          break;
      }
      return $limit_type;
    }
    private function _convert_limit_agency_type($type = null){
      if(empty($type)){
        return false;
      }
      $this->load->config('job_config');
      switch ($type) {
        case $this->config->item('fulltime','job_config'):
          $limit_type = 7;
          break;
        case $this->config->item('parttime','job_config'):
          $limit_type = 8;
          break;
        case $this->config->item('temp','job_config'):
          $limit_type = 7;
          break;
        case $this->config->item('dispatch','job_config'):
          $limit_type = 8;
          break;
        case $this->config->item('future_dispatch','job_config'):
          $limit_type = 8;
          break;
        default:
          $limit_type = false;
          break;
      }
      return $limit_type;
    }


    private function _generate_export_param($groups, $plans)
    {
        foreach ($groups as &$group) {
            foreach ($plans as $plan) {
                if ($group['plan_group_id'] == $plan['plan_group_id']) {
                    $group['plans'][] = $plan['plan_name'];
                }
            }
        }
        unset($group);

        return array_map(function ($group) {
            $plan = implode(' , ', $group['plans']);
            $group['plans'] = $plan;
            return $group;
        }, $groups);
    }


    public function get_related_plan_group($client_id)
    {
        $param = array(
            'client_id' => $client_id,
            'delete_flg' =>  $this->config->item('not_deleted','common_config'),
        );

        return $this->Logic_plan->get_related_plan_group($param);
    }


    public function get_client_group_relation($client_plan_group_relation_id){

        $this->load->model("Logic_plan");
        $result = $this->Logic_plan->get_cpgr_data($client_plan_group_relation_id);
        return $result;
    }


    public function get_all_plan_group()
    {
        return $this->Logic_plan->get_all_plan_group();
    }

    /**
     * check require to extend plan function for batch
     * @return [type] [description]
     */
    public function check_extend(){
        $result = $this->Logic_plan->check_extend();
        return $result;
    }
    public function check_expire(){
        $result = $this->Logic_plan->check_expire();
        return $result;
    }
    public function extend($cpgr_id){
      if(empty($cpgr_id)){
        return false;
      }
      $data = $this->Logic_plan->get_cpgr_info($cpgr_id);
      if(empty($data)){
        return false;
      }
      $plan_period = $this->Logic_plan->group_period($data[0]['plan_group_id']);
      $param['plan_group_id'] = $data[0]['plan_group_id'];
      $param['client_id'] = $data[0]['client_id'];
      $param['discount']   = $data[0]['discount'];
      $param['plan_group']['auto_extend_flg']   = $data[0]['auto_extend_flg'];
      $now = new Datetime();
      $param['apply_date'] = $now->format('Y-m-d');
      $param['expire_month'] = $now->modify('+'.$plan_period[0]['period'].' month')->format('Y-m-d H:i:s');
      $result = $this->Logic_plan->apply($param);
      if(!empty($result)){
        return $result;
      }else{
        return false;
      }
    }
    public function expire($cpgr_id,$auto_extend = 0){
      if(empty($cpgr_id)){
        return false;
      }
      foreach($cpgr_id as $id){
        $ids[] = $id['client_plan_group_relation_id'];
      }

      $result = $this->Logic_plan->expire($ids,$auto_extend);
      return $result;
    }
    public function get_all_plan_group_by_client($param)
    {
        extract($param);
        $param = array(
            'client_id' => $client_id,
            'limit_type' => $limit_type,
            'delete_flg' =>  $this->config->item('not_deleted','common_config'),
        );

        return $this->Logic_plan->get_all_plan_group_by_client($param);
    }

}
?>
