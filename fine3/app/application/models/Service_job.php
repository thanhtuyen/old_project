<?php
Class Service_job extends MY_Model{
    public function __construct()
    {
        parent::__construct();
        //helper
        $this->load->helper('list');
        $this->load->helper('logic');
        //logic
        $this->load->model('Service_image');
        $this->load->model('Service_tag');
        $this->load->model('Service_nursery');
        $this->load->model('Service_client');
        $this->load->model('Service_apply');
        $this->load->model('Service_bookmark');
        $this->load->model('Service_area');
        $this->load->model('Logic_job');
    }
    /**
     * for U_3 page,
     * @return see https://docs.google.com/spreadsheets/d/1muK_2Fik7oFqkwzMq9CpQB804JoC0uYCVpubFsrmaBM/edit?pli=1#gid=891506186
     *
     * @param  $job_param = array('job_id'     =>  $job_id,
     *                            'user_id'    =>  $user_id);
     *                      or simply false ( if it could not show,)
     *
     */
    public function get_detail_info($job_param){
        //get job detail
        $job_detail['job']      = $this->get_detail($job_param['job_id']);
        if($job_detail['job'] == false){
            //redirect false
            return false;
        }
        $job_detail['job']['job_description_limit'] = $this->config->item('job_description_limit', 'job_config');
        //redirect if job_detail doesnt find

        //get images
        $image_param    = array('account_id' => $job_param['job_id'],
                                'type'       => $this->config->item('job','image_config'),
                                'delete_flg' => $this->config->item('not_deleted','common_config'));
        $job_detail['images'] = $this->Service_image->get_list($image_param);


        //get job_tag
        $tag_param      = array('id'         =>  $job_param['job_id'],
                                'type'       =>  $this->config->item('type_relation_job','tag_config'),
                                'delete_flg' =>  $this->config->item('not_deleted','common_config'),
                            );
        //get tags
        $tags = $this->Service_tag->get_list($tag_param);


        $job_detail['tags'] = $this->Service_tag->sort_tag($tags);


        //get nursery_info
        if(empty($job_detail['job']['nursery_id'])){
            //redirect false
            return false;
        }
        $nursery_id      = $job_detail['job']['nursery_id'];
        if(empty($nursery_id)){
            return false;
        }

        $nursery_detail  = $this->Service_nursery->get_detail($nursery_id);
        if(empty($nursery_detail)){
            return false;
        }

        //get client _info
        $client_id       = $nursery_detail['client_id'];
        if(empty($client_id)){
            return false;
        }
        $client_detail   = $this->Service_client->get_detail($client_id);
        if(empty($client_detail)){
            return false;
        }

        //and get user_id for process.3.
        if(!empty($job_param['user_id'])){
            //3. this param is user_id and job_id
            //get already applied info
            $apply_status     = $this->Service_apply->is_done($job_param);
            //4.you also get book mark info mation  and swtich button.
            $bookmark_status  = $this->Service_bookmark->is_done($job_param);
        }else{
            //do not apply because he is not logged in
            $apply_status     = $this->config->item('none','apply_config');
            $bookmark_status  = $this->config->item('none','bookmark_config');
        }
        $user_info = array('apply_status'     =>  $apply_status,
                           'bookmark_status'  =>  $bookmark_status);
        //array result
        $result = array('job_detail'      =>  $job_detail,
                        'nursery_detail'  =>  $nursery_detail,
                        'client_detail'   =>  $client_detail,
                        'user_info'       =>  $user_info);

        return $result;

    }
    /** this function is get 3 jobs from related area. */
    public function get_related_area_list($area_id, $selected_job_id, $limit = 3){
        if(empty($area_id)){
            return false;
        }

        $related_area_jobs = $this->Logic_job->get_related_area_job($area_id, $selected_job_id,$limit);
        foreach ($related_area_jobs as $key => $value) {
        $related_area_jobs[$key]['nursery_detail']  = $this->Service_nursery->get_detail($value['nursery_id']);

            //get job_tag
            $tag_param = array('id'         =>  $value['job_id'],
                                'type'       =>  $this->config->item('type_relation_job','tag_config'),
                                'delete_flg' =>  $this->config->item('not_deleted','common_config'),
                        );
            //get tags
            $related_area_jobs[$key]['tags'] = $this->Service_tag->get_list($tag_param);
            $image_param  = array('account_id' => $value['job_id'],
                                  'type'       => $this->config->item('job','image_config'),
                                  'delete_flg' => $this->config->item('not_deleted','common_config'));
            $related_area_jobs[$key]['images'] = $this->Service_image->get_list($image_param);
        }
        return $related_area_jobs;
    }
    /*
     *   @param : (int)$job_id
     *   @return : array() or false
     *   meaning: get just one job detail infomation , please look get_detail_info() in this class
     *            get_detail_info use get_detail   and make about infomation which related on job detail
     *            anyway this method is just get one job simple infomation
    */
    public function get_detail($job_id){

      if(empty($job_id)){
        return false;
      }
       $param['job_id']     = $job_id;
       $param['select']     = array('job_id',
                                    'nursery_id',
                                    'own_job_id',
                                    'title',
                                    'description',
                                    'bonus',
                                    'worktime',
                                    'holiday',
                                    'expired',
                                    'salary',
                                    'employees',
                                    'requirement',
                                    'pr',
                                    'status',
                                    'ordered',
                                    'created',
                                    'updated',
                                    'delete_flg');
       $param['status']     = false;
       $param['delete_flg'] = $this->config->item('not_deleted','common_config');
       $record = $this->Logic_job->any_detail($param);
       if(!empty($record[0])){
          return $record[0];
       }else{
          return false;
       }
    }

    /**
     * [update_info description]
     * @return [type] [description]
     */
    public function update_info(){

        return $result;
    }

    private function _secret(){

        return $result;
    }

    /**
    *@param Object $user
    *@param Array $_already_sent_list
    *@return Array $recommend_list
    */
    public function get_3job_mail_recommend_list($user, $_already_sent_list)
    {

        $this->load->model('Logic_user');

        if(empty($user)){
            return array();
        }
        $_already_sent_list = array_map(function($x){return (int) $x;}, $_already_sent_list);


        list($user['pref_id'], $user['city_id']) = $this->Logic_user->get_pref_id_and_city_id($user['user_id']);

        echo "    pref_id: {$user['pref_id']}, city_id: {$user['city_id']}", "\n";

        $user['type_employ_tag_id'] = $this->Logic_user->get_type_employ_tag_id($user['user_id']);

        echo "    type_employ_tag_id: {$user['type_employ_tag_id']}", "\n";

        if (empty($user['pref_id'])) {
            return array();
        }

        if (empty($user['type_employ_tag_id'])) {
            $type_one = array();
            $type_one_two = array_merge($type_one, $_already_sent_list);

            $type_two = $this->get_3job_mail_type_two($user, $type_one_two);

            $type_three = array();

            $type_already_send= array_merge($type_one, $type_two, $type_three, $_already_sent_list);
            $type_four =$this->get_3job_mail_type_four($user, $type_already_send);

        } else {
            $type_one = $this->get_3job_mail_type_one($user, $_already_sent_list);
            $type_one_two = array_merge($type_one, $_already_sent_list);

            $type_two = $this->get_3job_mail_type_two($user, $type_one_two);

            $type_three = $this->get_3job_mail_type_three($user, $type_one_two);

            $type_already_send= array_merge($type_one, $type_two, $type_three, $_already_sent_list);
            $type_four =$this->get_3job_mail_type_four($user, $type_already_send);
        }

        echo "    same pref, same city, same type_employ: ", implode(',', $type_one), "\n";
        echo "    same pref, same city: ", implode(',', $type_two), "\n";
        echo "    same pref, same type_employ: ", implode(',', $type_three), "\n";
        echo "    same pref: ", implode(',', $type_four), "\n";

        $recommend_list = array();

        $recommend_job_one = array_shift($type_one);
        if (empty($recommend_job_one)) {
             $recommend_job_one = array_shift($type_two);
             if (empty($recommend_job_one)) {
                $recommend_job_one = array_shift($type_three);
                if (empty($recommend_job_one)) {
                    $recommend_job_one = array_shift($type_four);
                }
             }
        }

        $recommend_job_two = array_shift($type_two);
        if (empty($recommend_job_two)) {
             $recommend_job_two = array_shift($type_three);
             if (empty($recommend_job_two)) {
                $recommend_job_two = array_shift($type_four);
                if (empty($recommend_job_two)) {
                    $recommend_job_two = array_shift($type_one);
                }
             }
        }

        $recommend_job_three = array_shift($type_three);
        if (empty($recommend_job_three)) {
             $recommend_job_three = array_shift($type_two);
             if (empty($recommend_job_three)) {
                $recommend_job_three = array_shift($type_four);
                if (empty($recommend_job_three)) {
                    $recommend_job_three = array_shift($type_one);
                }
             }
        }

        $recommend_list[] =  $recommend_job_one;
        $recommend_list[] =  $recommend_job_two;
        $recommend_list[] = $recommend_job_three;
        $recommend_list = array_filter($recommend_list);

        echo "    job_ids: ", implode(',', $recommend_list), "\n";

        return $recommend_list;

    }

    /**
    *@param Object $user
    *@param Array $_already_sent_list
    *@return Array type one job list
    */
    public function get_3job_mail_type_one($user, $_already_sent_list)
    {
        if(empty($user)){
            return array();
        }
        $param['user'] = $user;
        $param['already_list'] = $_already_sent_list;
        $result = $this->Logic_job->get_3job_mail_type_one($param);
        if(empty($result)){
            return array();
        }
        return $result;
    }
     /**
    *@param Object $user
    *@param Array $_already_sent_list
    *@return Array type two job list
    */
    public function get_3job_mail_type_two($user, $_already_sent_list)
    {
         if(empty($user)){
            return array();
        }
        $param['user'] = $user;
        $param['already_list'] = $_already_sent_list;
        $result = $this->Logic_job->get_3job_mail_type_two($param);
        if(empty($result)){
            return array();
        }
        return $result;
    }
    /**
    *@param Object $user
    *@param Array $_already_sent_list
    *@return Array type three job list
    */
    public function get_3job_mail_type_three($user, $_already_sent_list)
    {
         if(empty($user)){
            return array();
        }
        $param['user'] = $user;
        $param['already_list'] = $_already_sent_list;
        $result = $this->Logic_job->get_3job_mail_type_three($param);
        if(empty($result)){
            return array();
        }
        return $result;
    }
    /**
    *@param Object $user
    *@param Array $_already_sent_list
    *@return Array type four job list
    */
    public function get_3job_mail_type_four($user, $_already_sent_list)
    {
        if(empty($user)){
            return array();
        }
        $param['user'] = $user;
        $param['already_list'] = $_already_sent_list;
        $result = $this->Logic_job->get_3job_mail_type_four($param);
        if(empty($result)){
            return array();
        }
        return $result;
    }

    public function count_alljob(){
        $num = $this->Logic_job->count_alljob();
    return $num;
    }


    /**
     * get pref related job list.
     * for U_2
     * @param  [type] $pref_id
     * @return [type] $job_list
     */
    public function get_search_list($search_param){


        $search_param['select']     = '`j`.`job_id`';
        $user_id                    = $search_param['user_id'];
        $param                      = $this->_get_search_condition($search_param);
        //--time check
        //--time check end
        $record                     = $this->Logic_job->get_search_list($param);
        $job_param['user_id']       = $user_id;
        $job_param['record']        = $record;
        //--time check
        //--time check end


        $job_list                   = $this->_get_detail_job_list($job_param);

        //--time check
        //--time check end

       if(!empty($job_list)){
          return $job_list;
       }else{
          return false;
       }
    }

    /**
     * count jobs under some condition
     * @param  [type] $param [description]
     * @return (int)count
     */
    public function search_count($search_param){
      if(empty($search_param)){
        return 0;
      }
      $search_param['select'] = 'count(distinct j.job_id) AS `count_job`';

      $param  = $this->_get_search_condition($search_param);
      if(empty($param)){
        return 0;
      }
        //todo-thinh updating search count function
      $record = $this->Logic_job->get_search_list($param);

      if($record[0]['count_job']){
         return $record[0]['count_job'];
      }else{
         return 0;
      }
    }

    public function count_pref_job($param){

    $result = $this->Logic_job->count_pref_job($param);
    return $result;
    }


    /**
     * for get_search_list, get detail info from job_list
     * @param   $param (user_id,record[job_id])
     * @return job_list(array)
     */
    private function _get_detail_job_list($param){
      $job_list     = array();
      foreach ($param['record'] as $row){
        $job_id     = $row['job_id'];
        $job_param  = array('job_id'     =>  $job_id,
                            'user_id'    =>  $param['user_id']);

        $job_list[] = $this->get_detail_info($job_param);
      }
      return $job_list;
    }
    /**
     * get search condition ca
     * @param  [type] $search_param [description]
     * @return [type]               [description]
     */
    public function _get_search_condition($search_param){
    //pref pref_id
    //city city_id
    //region region_id
    //area area_id
        // area_ id
        //todo-thinh get_search_condition
        // this for area search
        $area_id                  = $this->Service_area->search_list($search_param);
        // if station id is exist then add it into the params
        if (array_key_exists('station_id',$search_param)){
            $param['station_id']         = $search_param['station_id'];
        }

      // $area_id                    = $this->Service_area->get_id_list($search_param);
      if($area_id){
        $param['area_id']         = $area_id;
      }
    //job j_tag_id
    //employee j_tag_id
      if(array_key_exists('job_tag_id',$search_param)){
         $param['job_tag_id']     = $search_param['job_tag_id'];
      }
    //nursery n_tag_id
    //tag n_tag_id
      if(array_key_exists('nursery_tag_id',$search_param)){
         $param['nursery_tag_id'] = $search_param['nursery_tag_id'];
      }
    //client_status
      if(array_key_exists('client_status',$search_param)){
     $param['client_status'] = $search_param['client_status'];
      }
      //set other parameters
       $param['select']            = $search_param['select'];
       $param['delete_flg']        = (isset($search_param['delete_flg']))? $search_param['delete_flg'] : 0;
       $param['job_status']        = (isset($search_param['job_status']))? $search_param['job_status']: 1;
       $param['nursery_status']    = (isset($search_param['nursery_status']))? $search_param['nursery_status'] : 0;
       $param['keyword']    	   = (isset($search_param['keyword']))? $search_param['keyword'] : '';
      if(array_key_exists('limit_from',$search_param)){
         $param['limit_from']        = $search_param['limit_from'];
      }
      if(array_key_exists('limit_to',$search_param)){
         $param['limit_to']          = $search_param['limit_to'];
      }
      if(array_key_exists('client_id',$search_param)){
         $param['client_id']          = $search_param['client_id'];
      }
       return $param;
    }


    /**
     * @param int $job_id : target apply job id
     */
    public function apply_job($user_id,$job_id){


        $this->load->model('Service_plan');
        $price = $this->Service_plan->calcurate_apply_price($user_id,$job_id);

        $insert_params = array($user_id,$job_id,date("Y-m-d H:i:s",time()),$price);

        $this->load->model('Logic_applicant_job');

        $has_apply_job = $this->Logic_applicant_job->check_apply($user_id, $job_id);
        if($has_apply_job){
            return false;
        } else {
            $result = $this->Logic_applicant_job->add_applicant_job($insert_params);
        }

        //update job status
        $this->load->model('Service_apply');
        $re = $this->Service_apply->check_limit($job_id);
        if($result !== false){
            $user_params["select"] = array("mail","name",'area_id','address','birthdate');
            $user_params["where"]["user_id"] = $user_id;
            $user_params["where"]["status"] = 1;
            $user_params["where"]["delete_flg"] = 0;

            $this->load->model("Service_user");
            $user = $this->Service_user->get_user_data($user_params);

            $job_params['job_id'] = $job_id;
            $job_params['delete_flg'] = 0;

            $job_data = $this->Logic_job->get_detail_with_nursery($job_params);

            $mail_result = false;

            if(!empty($user[0])){
                $mail_params["mail"] = $user[0]["mail"];
                $mail_params["user_name"] = $user[0]["name"];
                $mail_params["job_title"] = $job_data[0]["title"];
                $mail_params["nursery_name"] = $job_data[0]["nursery_name"];
                $mail_params["client_name"] = $job_data[0]["client_name"];
                $mail_params["job_url"] = $this->config->config["base_url"]."detail_".$job_id;
                $mail_params["user_login_url"] = $this->config->config["base_url"]."login";

                $this->load->model("Service_email");
                $mail_result = $this->Service_email->applicant_job_2user($mail_params);

                if($mail_result){

                    $user_tags = $this->Service_user->get_user_related_tag($user_id);

                    $mail_c_params["mail"] = $job_data[0]["client_mail"];
                    $mail_c_params["client_contact_name"] = $job_data[0]["client_name"];

                    $area = isset($user[0]["area"])?$user[0]["area"]:'';
                    $address = isset($user[0]["address"])?$user[0]["address"]:'';

                    $mail_c_params["address"] = $area.$address;
                    $age = (int)((date('Ymd')-str_replace('-','',$user[0]['birthdate']))/10000);

                    $mail_c_params["age"] = $age;

                    $license = empty($user_tags['license'])?'なし':join(',',$user_tags['license']);

                    $mail_c_params["license"] = $license;

            $this->config->load('admin', TRUE);
                    $admin_mail = $this->config->item('email', 'admin');
                    $mail_c_params["bcc"] = $admin_mail;

                    $mail_result = $this->Service_email->applicant_job_2client($mail_c_params);

                    if($mail_result){

                        /*$mail_a_params["mail"] = 'info-hoiku@fine.me';

                        $mail_a_params["job_id"] = $job_id;
                        $mail_a_params["job_title"] = $job_data[0]["title"];
                        $mail_a_params["nursery_name"] = $job_data[0]["nursery_name"];
                        $mail_a_params["client_name"] = $job_data[0]["client_name"];
                        $mail_a_params["job_url"] = $this->config->config["base_url"]."detail_".$job_id;

                        $mail_a_params["user_id"] = $user_id;
                        $mail_a_params["user_name"] = $user[0]["name"];
                        $mail_a_params["address"] = $area.$address;
                        $mail_a_params["age"] = $age;
                        $mail_a_params["license"] = $license;

                        $mail_a_params['applicant_job_url'] = $this->config->config["base_url"].'manager/entry/job/detail/'.$result['applicant_job_id'];

                        $mail_result = $this->Service_email->applicant_job_2admin($mail_a_params);*/
                    }
                }
            }

            if(!$mail_result){
                $user_data = $this->session->userdata("user_data");
                mail("neo.yuya.shobu@gmail.com","【FINE3.0 BUGREPORT】求人応募完了メール送信失敗","job_id: ".$job_id."user_data: ".serialize($user_data));
                mail("yuta.sasaki.toki@gmail.com","【FINE3.0 BUGREPORT】求人応募完了メール送信失敗","job_id: ".$job_id."user_data: ".serialize($user_data));
            }
        }

        return $result;
    }

    /**
     * @param int $job_id : target bookmark job id
     */
    public function bookmark_job($user_id,$job_id){

        $insert_params = array($user_id,$job_id,date("Y-m-d H:i:s",time()));

        $this->load->model('Logic_bookmark');
        return $this->Logic_bookmark->add_bookmark($insert_params);
    }

    /**
     * add bookmark
     * @param  (int)$user_id
     * @param  (int)$job_id
     * @return boolean
     */
    public function add_bookmark($user_id, $job_id)
    {
        $delete_flg = $this->config->item('deleted', 'common_config');
        $not_deleted_flg = $this->config->item('not_deleted', 'common_config');

        $is_add_bookmark = $this->Service_bookmark->is_done(array('user_id' => $user_id, 'job_id' => $job_id));
        if($is_add_bookmark) {
            $result = $this->Logic_bookmark->update_bookmark(array($delete_flg, $user_id, $job_id));
            if($result) {
                return array('status' => 1, 'operation' => 'update');
            } else {
                return array('status' => 0, 'operation' => 'update');
            }
        } else {
            $result = $this->Logic_bookmark->add_bookmark(array($user_id, $job_id, date('Y-m-d H:i:s')));
            if($result){
                return array('status' => 1, 'operation' => 'add');
            } else {
                return array('status' => 0, 'operation' => 'add');
            }
        }
    }

    /**
     * add applicant_job
     * @param  (int)$user_id
     * @param  (int)$job_id
     * @return boolean
     * @deprecated check_and_add_applicant_job below
     */
    public function add_applicant_job($user_id, $job_id)
    {
        $this->load->model("Logic_applicant_job");
        $this->load->model('Service_plan');
        $price = $this->Service_plan->calcurate_apply_price($user_id,$job_id);

        $insert_params = array($user_id,$job_id,date("Y-m-d H:i:s",time()),$price);
        $result = $this->Logic_applicant_job->add_applicant_job($insert_params);
        if($result) {
          // count job apply limit and if the limit has come, disable its job
            $this->load->model('Service_apply');
            $this->Service_apply->check_limit($job_id);
            return array('status' => 1);
        } else {
            return array('status' => 0);
        }
    }

    /**
     * 1. Check job had already apply
     * 2. Add applicant_job
     * @param  (int)$user_id
     * @param  (int)$job_id
     * @return boolean
     */
    public function check_and_add_applicant_job($user_id, $job_id)
    {
        $this->load->model('Service_apply');
        $result = true;
        // if is array
        if( is_array($job_id) ){

            foreach( (array) $job_id as $item ){
                $params = [
                    'user_id' => $user_id,
                    'job_id' => $item
                ];
                $result = $this->Service_apply->already_apply($params);
                // If job exist => stop loop
                if($result){
                    break;
                }
            }

        }else{
        // not array
            $params = [
                'user_id' => $user_id,
                'job_id' => $job_id
            ];
            $result = $this->Service_apply->already_apply($params);
        }
        // job not exist
        if(! $result){
            return $this->_add_job($user_id, $job_id);
        }
        return array('status' => 2);
    }

    protected function _add_job($user_id, $job_id){
        $this->load->model("Logic_applicant_job");
        $results = [];

        $this->db->trans_begin();

        if( is_array($job_id) ){
            foreach( (array) $job_id as $item ){
                $paramApply = array(
                    $user_id,
                    $item,
                    date('Y-m-d H:i:s')
                );
                $results[] = $this->Logic_applicant_job->add_applicant_job($paramApply);
            }
        }else{
            $paramApply = array(
                $user_id,
                $job_id,
                date('Y-m-d H:i:s')
            );
            $results[] = $this->Logic_applicant_job->add_applicant_job($paramApply);
                $this->load->model('Service_apply');
                $this->Service_apply->check_limit($item);
        }

        if( in_array(false, $results) ){
            $this->db->trans_rollback();
            return array(
                'status' => 0,
                'job_id' => $job_id
            );
        }else{
            $this->db->trans_commit();
            return array(
                'status' => 1,
                'job_id' => $job_id
            );
        }
    }

    /**
     * add bookmark
     * Check exist bookmark job of user_id before
     * @param  (int)$user_id
     * @param  (int)$job_id
     * @return boolean
     */
    public function check_add_bookmark($user_id, $job_id)
    {
        $delete_flg = $this->config->item('deleted', 'common_config');
        $not_deleted_flg = $this->config->item('not_deleted', 'common_config');

        $add_bookmark = $this->Service_bookmark->get_detail_bookmark(array('user_id' => $user_id, 'job_id' => $job_id));
        if($add_bookmark) {
            // status delete_flg => will change delete_flg = new (0)
            if($add_bookmark['delete_flg'] == 1){
                $result = $this->Logic_bookmark->update_bookmark(array($not_deleted_flg, $user_id, $job_id));
                if($result){
                    return array('status' => 1, 'operation' => 'add');
                } else {
                    return array('status' => 0, 'operation' => 'add');
                }
            }else{
                $result = $this->Logic_bookmark->update_bookmark(array($delete_flg, $user_id, $job_id));
                if($result) {
                    return array('status' => 1, 'operation' => 'update');
                } else {
                    return array('status' => 0, 'operation' => 'update');
                }
            }
        } else {
            $result = $this->Logic_bookmark->add_bookmark(array($user_id, $job_id, date('Y-m-d H:i:s')));
            if($result){
                return array('status' => 1, 'operation' => 'add');
            } else {
                return array('status' => 0, 'operation' => 'add');
            }
        }
    }

    public function get_now_job_info(){

        $count       = $this->Logic_job->get_public_job_count();
        $last_update = $this->Logic_job->get_job_last_updated();

        $job_info["count"]       = $count["COUNT(*)"];
        $job_info["last_update"] = date('Y/m/d', strtotime($last_update["updated"]));
        $today = date('Y/m/d');

        //do not exceed today
        if($job_info["last_update"] > $today){
          $job_info["last_update"] = $today;
        }
        return $job_info;
    }

    public function get_entry_job_count(){

        $user_data = $this->session->userdata("user_data");

        $params["user_id"] = $user_data["user_id"];

        $this->load->model("Logic_bookmark");
        $bookmark = $this->Logic_bookmark->get_bookmark_count($params);
        $this->load->model("Logic_applicant_agency");
        $applicant_agency = $this->Logic_applicant_agency->get_applicant_agency_count($params);
        $this->load->model("Logic_applicant_job");
        $applicant_job = $this->Logic_applicant_job->get_applicant_job_count($params);

        $result["bookmark"] = $bookmark["COUNT(*)"];
        $result["applicant_agency"] = $applicant_agency["COUNT(*)"];
        $result["applicant_job"] = $applicant_job["COUNT(*)"];

        return $result;
    }


    /**
     * get job total count
     * @param  [string] $condition
     * @return [int]
     */
    public function get_total_count($condition)
    {
      $param = array(
          'delete_flg' => $this->config->item('not_deleted','common_config'),
      );
        return $this->Logic_job->get_total_count($condition, $param);
    }

     /* get admin jobs list
     * @param  [array] $condition
     * @param  [array] $parameters
     * @return [array]
     */
    public function get_list($condition, $parameters)
    {

        if ($parameters['total'] == 0) {
            return array();
        }
        $param = array(
            'offset' => $parameters['offset'],
            'limit' => $parameters['limit'],
            'delete_flg' => $this->config->item('not_deleted','common_config'),
            'group_type' => $this->config->item('type_relation_job', 'tag_config'),
            'reccoment' => $this->config->item('tag_job_reccoment', 'tag_config'),
        );

        return $this->Logic_job->get_list($condition, $param);
    }


    public function get_detail_of_admin($id)
    {
        if(empty($id)){
            return array();
        }
        $param = array(
            'job_id' => $id,
            'delete_flg' => $this->config->item('not_deleted','common_config'),
            'group_type' => $this->config->item('type_relation_job', 'tag_config'),
            'reccoment' => $this->config->item('tag_job_reccoment', 'tag_config'),
            'employ' => $this->config->item('type_employ', 'tag_config'),
            'tag_job' => $this->config->item('tag_job', 'tag_config'),
        );
        $result = $this->Logic_job->get_detail_of_admin($param);

        $result['employ'] = implode(' ', $result['employ']);
        $result['tag_job'] = implode(' ', $result['tag_job']);

        return $result;

    }
    public function delete_flg($id)
    {
        if(empty($id)){
            return FALSE;
        }else{
            return $this->Logic_job->delete_flg($id);
        }
    }

    /**
     * [export file ]
     * @param  [string] $format e.g csv
     * @return [string]       filepath
     */
    public function export_file($format)
    {
        $headers = $this->config->item('job','export_column_config');
        $result = $this->Logic_job->get_export_data();

        $export_results = $this->generateExportData($result);
        $this->load->model('Service_export_file');
        return $this->Service_export_file->export($headers, $export_results, $format);
    }

    public function generateExportData($result)
    {
      $this->load->helper('job');
      list($jobs, $job_type, $employ_type, $insurance, $benefit, $reccoment, $image) = $result;

      $job_types = array();
      $employ_types = array();
      $insurances = array();
      $benefits = array();
      $reccoments = array();
      $images = array();

      foreach ($image as $key => $value) {
          $images[$key][$value['job_id']] = $value['name'];
          $job_id[] = $value['job_id'];
      }

      if (!empty($job_id)) {
          $image = array_map(function($id) use($images){
              return array('job_id' => $id, 'name' => array_unique(array_column($images, (int) $id)));
          }, array_unique($job_id));
      }

      unset($images);
      foreach ($image as $value) {
          $images[$value['job_id']] = $value['name'];
      }

      foreach ($job_type as $key => $value) {
          $job_types[$key][$value['job_id']] = $value['job_type'];
          $job_id[] = $value['job_id'];
      }

      if (!empty($job_id)) {
          $job_type = array_map(function($id) use($job_types){
              return array('job_id' => $id, 'job_type' => array_unique(array_column($job_types, (int) $id)));
          }, array_unique($job_id));
      }

      unset($job_types);
      foreach ($job_type as $value) {
          $job_types[$value['job_id']] = implode(' ', $value['job_type']);
      }

      foreach ($employ_type as $key => $value) {
          $employ_types[$key][$value['job_id']] = $value['employ_type'];
          $job_id[] = $value['job_id'];
      }

      if (!empty($job_id)) {
          $employ_type = array_map(function($id) use($employ_types){
              return array('job_id' => $id, 'employ_type' => array_unique(array_column($employ_types, (int) $id)));
          }, array_unique($job_id));
      }

      unset($employ_types);
      foreach ($employ_type as $value) {
          $employ_types[$value['job_id']] = implode(' ', $value['employ_type']);
      }

      foreach ($insurance as $key => $value) {
          $insurances[$key][$value['job_id']] = $value['insurance'];
          $job_id[] = $value['job_id'];
      }

      if (!empty($job_id)) {
          $insurance = array_map(function($id) use($insurances){
              return array('job_id' => $id, 'insurance' => array_unique(array_column($insurances, (int) $id)));
          }, array_unique($job_id));
      }

      unset($insurances);
      foreach ($insurance as $value) {
          $insurances[$value['job_id']] = implode(' ', $value['insurance']);
      }
      foreach ($benefit as $key => $value) {
          $benefits[$key][$value['job_id']] = $value['benefit'];
          $job_id[] = $value['job_id'];
      }

      if (!empty($job_id)) {
          $benefit = array_map(function($id) use($benefits){
              return array('job_id' => $id, 'benefit' => array_unique(array_column($benefits, (int) $id)));
          }, array_unique($job_id));
      }

      unset($benefits);
      foreach ($benefit as $value) {
          $benefits[$value['job_id']] = implode(' ', $value['benefit']);
      }

      foreach ($reccoment as $key => $value) {
          $reccoments[$key][$value['job_id']] = $value['reccoment'];
          $job_id[] = $value['job_id'];
      }

      if (!empty($job_id)) {
          $reccoment = array_map(function($id) use($reccoments){
              return array('job_id' => $id, 'reccoment' => array_unique(array_column($reccoments, (int) $id)));
          }, array_unique($job_id));
      }

      unset($reccoments);
      foreach ($reccoment as $value) {
          $reccoments[$value['job_id']] = implode(' ', $value['reccoment']);
      }

      foreach ($jobs as &$result) {
          $key = $result['job_id'];
          $result['job_types'] = isset($job_types[$key]) ? $job_types[$key] : null;
          $result['employ_types'] = isset($employ_types[$key]) ? $employ_types[$key] : null;
          $result['insurance'] = isset($insurances[$key]) ? $insurances[$key] : null;
          $result['benefit'] = isset($benefits[$key]) ? $benefits[$key] : null;
          $result['reccoment'] = isset($reccoments[$key]) ? $reccoments[$key] : null;
          $result['status'] = status_text($result['status']);
          if( isset($images[$key])) {
            $result['image1'] = isset($images[$key]['0']) ? $images[$key]['0'] : null;
            $result['image2'] = isset($images[$key]['1']) ? $images[$key]['1'] : null;
            $result['image3'] = isset($images[$key]['2']) ? $images[$key]['2'] : null;
          } else {
            $result['image1'] = null;
            $result['image2'] = null;
            $result['image3'] = null;
          }
      }
      unset($result);


      return array_slice($jobs, 0, 1000);

    }


    public function get_search_word($param){
        $this->load->model("Logic_area");
        //area
        $area_str = array();
        if(array_key_exists("pref_id",$param)){
          $result = $this->Logic_area->get_pref_name(implode(",",$param["pref_id"]));
            foreach($result as $area_arr){
                    $area_str[] = $area_arr["name"];
            }
        }

        if(array_key_exists("city_id",$param)){
            $this->load->model("Logic_area");
            $result = $this->Logic_area->get_city_name(implode(",",$param["city_id"]));
            foreach($result as $area_arr){
                    $area_str[] = $area_arr["name"];
            }
        }
        if(array_key_exists("area_id",$param)){
            $this->load->model("Logic_area");
            $result = $this->Logic_area->get_area_name(implode(",",$param["area_id"]));
            foreach($result as $area_arr){
                    $area_str[] = $area_arr["name"];
            }
        }
        //tag
        $name = array();
        if(!array_key_exists('j_tag_id',$param)){
            $param['j_tag_id'] = array();
        }
        if(!array_key_exists('n_tag_id',$param)){
            $param['n_tag_id'] = array();
        }
        $tag   = array();
        $tag   = array_merge($param['j_tag_id'],$param['n_tag_id']);
        foreach($tag as $data){
            $tag_data = $this->Service_tag->get_single_detail($data);
            $name[] = $tag_data['name'];
        }

        $result_word = array_merge($area_str,$name);
        return implode(",",$result_word);
    }

    /**
     * Updated by ThinhNH
     * Add station to search params (in case station search page)
     * @param $input
     * @return array
     */
    public function parse_search_request($input){

        $result = array();
        // todo-thinh add station id to param parse_search_request
        $array['station']     = (array_key_exists('station',$input))?      explode(',',$input['station']): array();
        $array['area']     = (array_key_exists('area',$input))?      explode(',',$input['area']):      array();
        $array['pref']     = (array_key_exists('pref',$input))?      explode(',',$input['pref']):      array();
        $array['city']     = (array_key_exists('city',$input))?      explode(',',$input['city']):      array();
        $array['region']   = (array_key_exists('region',$input))?    explode(',',$input['region']):    array();
        $array['job']      = (array_key_exists('job',$input))?       explode(',',$input['job']):       array();
        $array['nursery']  = (array_key_exists('nursery',$input))?   explode(',',$input['nursery']):   array();
        $array['employee'] = (array_key_exists('employee',$input))?  explode(',',$input['employee']):  array();
        $array['tag']      = (array_key_exists('tag',$input))?       explode(',',$input['tag']):       array();
        $array['page']     = (array_key_exists('page',$input))?       $input['page']:       0;
        $result['keyword'] = (array_key_exists('keyword',$input))?   $input['keyword']:   	       '';

        if(array_key_exists(0,$array['station'])){
            foreach($array['station'] as $data){
                if((!empty($data))&&(is_numeric($data))){
                    $result['station_id'][] = $data;
                }
            }
        }
        if(array_key_exists(0,$array['area'])){
            foreach($array['area'] as $data){
                if((!empty($data))&&(is_numeric($data))){
                    $result['area_id'][] = $data;
                }
            }
        }
        if(array_key_exists(0,$array['pref'])){
            foreach($array['pref'] as $data){
                if((!empty($data))&&(is_numeric($data))){
                    $result['pref_id'][] = $data;
                }
            }
        }
        if(array_key_exists(0,$array['city'])){
            foreach($array['city'] as $data){
                if((!empty($data))&&(is_numeric($data))){
                    $result['city_id'][] = $data;
                }
            }
        }
        if(array_key_exists(0,$array['region'])){
            foreach($array['region'] as $data){
                if((!empty($data))&&(is_numeric($data))){
                    $result['region_id'][] = $data;
                }
            }
        }

        if(array_key_exists(0,$array['job'])){
            foreach($array['job'] as $data){
                if((!empty($data))&&(is_numeric($data))){
                    $result['j_tag_id'][] = $data;
                }
            }
        }
        if(array_key_exists(0,$array['nursery'])){
            foreach($array['nursery'] as $data){
                if((!empty($data))&&(is_numeric($data))){
                    $result['n_tag_id'][] = $data;
                }
            }
        }
        if(array_key_exists(0,$array['employee'])){
            foreach($array['employee'] as $data){
                if((!empty($data))&&(is_numeric($data))){
                    $result['j_tag_id'][] = $data;
                }
            }
        }
        //this is tag for nursery
        if(array_key_exists(0,$array['tag'])){

            $tag_tmp = array();
            foreach($array['tag'] as $data){
                if((!empty($data))&&(is_numeric($data))){
                    $tag_tmp[] = $this->Service_tag->get_single_detail($data);
                }
            }

            foreach($tag_tmp as $data ){
                if($data['tag_group_id'] == $this->config->item('tag_job','tag_config')){
                    $result['j_tag_id'][] = $data['tag_id'];
                }
                if($data['tag_group_id'] == $this->config->item('type_employ','tag_config')){
                    $result['j_tag_id'][] = $data['tag_id'];
                }
                if($data['tag_group_id'] == $this->config->item('type_nursery','tag_config')){
                    $result['n_tag_id'][] = $data['tag_id'];
                }
                if($data['tag_group_id'] == $this->config->item('tag_nursery','tag_config')){
                    $result['n_tag_id'][] = $data['tag_id'];
                }
            }
        }
        //page
        if($array['page'] !== 0){
                if(is_numeric($array['page'])){
                    $result['page'] = $array['page'];
                }
        }

        return $result;
    }

    public function job_list_page($param){
        // pagenation button
        $pagenation['first']           = false;
        $pagenation['before_2']        = false;
        $pagenation['before_1']        = false;
        $pagenation['to_1']            = false;
        $pagenation['to_2']            = false;
        $pagenation['last']            = false;

        $pagenation['now']             = ceil($param['now'] /10);    //now uses floor KIRISUTE!
        $pagenation['limit']           = ceil($param['limit']/10); //limit uses ceil KIRIAGE!
        $pagenation['diff']            = $pagenation['limit'] - $pagenation['now'];
        //set limit 100 take care this is effect whole search result
        // if($pagenation['limit'] > 100){
        //     $pagenation['limit'] = 100;
        // }
        //make pagenation
        if($pagenation['now'] > 1){
            $pagenation['first'] = 0;
        }
        if($pagenation['now'] > 2){
            $pagenation['before_2'] = $pagenation['now'] - 2;
        }
        if($pagenation['now'] > 1){
            $pagenation['before_1'] = $pagenation['now'] - 1;
        }
        if($pagenation['diff'] > 1){
            $pagenation['to_1'] = ($pagenation['now'] + 1);
        }
        if($pagenation['diff'] > 2){
            $pagenation['to_2'] = ($pagenation['now'] + 2);
        }
        if($pagenation['limit'] >= $pagenation['now']){
            $pagenation['last'] = $pagenation['limit'];
        }
        $pagenation['param'] = get_to_str($param['get']);
        return $pagenation;
    }
    public function process_request($search_request,$word){
        if(empty($search_request)){
            return false;
        }
            if(array_key_exists($word,$search_request)){
                $result = $search_request[$word];
                if(!empty($result)){
                    return $result;
                }
            }
        return false;
    }
    public function generate_get_param($param,$page){
        //unite param
      if(!empty($param['sk'])){
        foreach($param['sk'] as $key => $val){
          $tag[$key] = $val;
        }
      }
      if(!empty($param['co'])){
        foreach($param['co'] as $key => $val){
          $tag[$key] = $val;
        }
      }
      if(!empty($param['ss'])){
        foreach($param['ss'] as $key => $val){
          $tag[$key] = $val;
        }
      }
      if(!empty($param['kd'])){
        foreach($param['kd'] as $key => $val){
          $tag[$key] = $val;
        }
      }
      if(!empty($param['li'])){
        foreach($param['li'] as $key => $val){
          $tag[$key] = $val;
        }
      }
      if(!empty($param['in'])){
        foreach($param['in'] as $key => $val){
          $tag[$key] = $val;
        }
      }
        $result = array();
        $double = false;
        //area_id is parsed here
        if(!empty($param['pref'])){
          $result['pref'] = $param['pref'];
        }
        if(!empty($param['city'])){
          $result['city'] = $param['city'];
        }
        if(!empty($param['area_id'])){
          $result['area_id'] = implode(',',$param['area_id']);
          if(count($param['area_id']) > 1){
            $double = true;
          }
        }
        // other tag is parsed here
        if(!empty($tag['job'])){
          $result['job'] = implode(',',$tag['job']);
          if(count($tag['job']) > 1){
            $double = true;
          }
        }
        if(!empty($tag['nursery'])){
          $result['nursery'] = implode(',',$tag['nursery']);
          if(count($tag['nursery']) > 1){
            $double = true;
          }
        }
        if(!empty($tag['tag'])){
          $result['tag'] = implode(',',$tag['tag']);
          if(count($tag['tag']) > 1){
            $double = true;
          }
        }
        if(!empty($tag['employee'])){
          $result['employee'] = implode(',',$tag['employee']);
          if(count($tag['employee']) > 1){
            $double = true;
          }
        }
        $result['double'] = $double;

        //generate get param
        $result_str = "";
        if(!empty($param['pref'])){
          $result_str .="&pref=".$param['pref'];
        }
        if(!empty($param['city'])){
          $result_str .="&city=".$param['city'];
        }
        if(!empty($param['area_id'])){
          $result_str .="&area_id=". implode(',',$param['area_id']);
        }
        // other tag is parsed here
        if(!empty($tag['job'])){
          $result_str .="&job=". implode(',',$tag['job']);
        }
        if(!empty($tag['nursery'])){
          $result_str .="&nursery=". implode(',',$tag['nursery']);
        }
        if(!empty($tag['tag'])){
          $result_str .="&tag=". implode(',',$tag['tag']);
        }
        if(!empty($tag['employee'])){
          $result_str .="&employee=". implode(',',$tag['employee']);
        }
        if(!empty($result_str)){
          $result['get_param'] ="?".ltrim($result_str,'&');
        }else{
          $result['get_param'] = "";
        }
        return $result;
    }
    // public function generate_get_param_str($param){
    //   $result = "";
    //     if(!empty($param['pref'])){
    //       $result .="&pref=". implode(',',$param['pref']);
    //     }
    //     if(!empty($param['city'])){
    //       $result .="&city=". implode(',',$param['city']);
    //     }
    //     if(!empty($param['area_id'])){
    //       $result .="&area_id=". implode(',',$param['area_id']);
    //     }
    //     // other tag is parsed here
    //     if(!empty($tag['job'])){
    //       $result .="&job=". implode(',',$tag['job']);
    //     }
    //     if(!empty($tag['nursery'])){
    //       $result .="&nursery=". implode(',',$param['area_id']);
    //     }
    //     if(!empty($tag['tag'])){
    //       $result .="&tag=". implode(',',$tag['tag']);
    //     }
    //     if(!empty($tag['employee'])){
    //       $result .="&employee=". implode(',',$tag['employee']);
    //     }
    //     $result ="?".ltrim('&',$result);
    //     return $result;
    // }
    public function generate_search_param($segment = null){
        $result= array();
      if(empty($segment)){
        return false;
      }
      $segment_array = $this->_parse_segment($segment);
      //get some segment
      if(!empty($segment_array['p'])){
        //refresh
        $search_segment[0] = null;
        $search_segment[1] = null;
        //prepare pref
        $search_segment['p'] = $segment_array['p'];
        unset($segment_array['p']);
        if(!empty($segment_array['ct'])){
          //preparecity
          $search_segment['ct'] = $segment_array['ct'];
          unset($segment_array['ct']);
        }
        //process segment
        $result = $this->Service_job->generate_area_param($search_segment);
      }
      //tag parse
      if(!empty($segment_array['sk'])){
        $word = 'list_sk_';
        $result['sk'] = $this->generate_tag_param($segment_array['sk'],$word);
        unset($segment_array['sk']);
      }
      if(!empty($segment_array['co'])){
        $word = 'list_co_';
        $result['co'] = $this->generate_tag_param($segment_array['co'],$word);
        unset($segment_array['co']);
      }
            if(!empty($segment_array['ss'])){
        $word = 'list_ss_';
        $result['ss'] = $this->generate_tag_param($segment_array['ss'],$word);
        unset($segment_array['ss']);
      }
            if(!empty($segment_array['kd'])){
        $word = 'list_kd_';
        $result['kd'] = $this->generate_tag_param($segment_array['kd'],$word);
        unset($segment_array['kd']);
      }
            if(!empty($segment_array['li'])){
        $word = 'list_li_';
        $result['li'] = $this->generate_tag_param($segment_array['li'],$word);
        unset($segment_array['li']);
      }
      if(!empty($segment_array['in'])){
        $word = 'list_in_';
        $result['in'] = $this->generate_tag_param($segment_array['in'],$word);
        unset($segment_array['in']);
      }
      return $result;
    }
    private function _parse_segment($segment){
      $parsed_array = array();
      foreach($segment as $str){
        //pref
        if(stristr($str,'p_')){
          $parsed_array['p'] = str_replace('p_','',$str);
        }
        //city
        if(stristr($str,'list_ct_')){
          $parsed_array['ct'] = str_replace('list_ct_','',$str);
        }
        //職種
        if(stristr($str,'list_sk_')){
          $parsed_array['sk'][] = str_replace('list_sk_','',$str);
        }
        //雇用形態
        if(stristr($str,'list_co_')){
          $parsed_array['co'][] = str_replace('list_co_','',$str);
        }
        //施設形態
        if(stristr($str,'list_ss_')){
          $parsed_array['ss'][] = str_replace('list_ss_','',$str);
        }
        //こだわり
        if(stristr($str,'list_kd_')){
          $parsed_array['kd'][] = str_replace('list_kd_','',$str);
        }
        //資格
        if(stristr($str,'list_li_')){
          $parsed_array['li'][] = str_replace('list_li_','',$str);
        }
        //保険
        if(stristr($str,'list_in_')){
          $parsed_array['in'][] = str_replace('list_in_','',$str);
        }
      }
      return $parsed_array;
    }

    /**
     * generate get parameter for pref,city
     * @param  [type] $segment [description]
     * @return [type]          [description]
     */
    public function generate_area_param($segment){
        $result = false;
        $pref_name = $segment['p'];
        $area_ids = false;
        if(!empty($segment['ct'])){
            $city_name = $segment['ct'];
            $area_ids = $this->Logic_area->get_list_city_char($pref_name,$city_name);
            if(count($area_ids) === 1)$result['city'] = $area_ids[0]["area_id"];
        }else{
            $area_ids = $this->Logic_area->get_list_pref_char($pref_name);
        }
        $result['pref'] = $this->Logic_area->get_pref_area_id_by_romaji($pref_name);
        $pref = $this->Logic_area->get_pref_id_by_romaji($pref_name);
        $result['pref_id'] = $pref->pref_id;
        foreach($area_ids as $id)$result['area_id'][] = $id['area_id'];
        return $result;
    }
    // public function generate_area_param($segment){
    //     $result = false;
    //     $pref_name = str_replace('p_','',$segment[0]);
    //     $area_ids = false;
    //     if(strpos($segment[1],'list_c_') !== false){
    //         $city_name = str_replace('list_c_','',$segment[1]);
    //         $area_ids = $this->Logic_area->get_list_city_char($pref_name,$city_name);
    //         if(count($area_ids) === 1)$result['city'] = $area_ids[0]["area_id"];
    //     }else{
    //         $area_ids = $this->Logic_area->get_list_pref_char($pref_name);
    //     }
    //     $result['pref'] = $this->Logic_area->get_pref_area_id_by_romaji($pref_name);

    //     $str = '';
    //     foreach($area_ids as $id)$str .= $id['area_id'].',';
    //     $result['area'] = rtrim($str,',');

    //     return $result;
    // }

    private function prefix_search($name,$prefix){
        if(!empty($name)){
          $tag = $this->Logic_tag->get_list_char($name,$prefix);
          if(!empty($tag[0])){
            return $tag[0];
          }else{
            return false;
          }
        }
    }

    public function generate_tag_param($segment,$prefix){
      $this->load->model("Logic_tag");
      $result = false;
      $tag = array();
      foreach($segment as $str){
        $tag[] = $this->prefix_search($str,$prefix);
      }
      $tag = array_filter($tag);
      $tag = array_merge($tag);
        $result['job'] = '';
        $result['nursery'] = '';
        $result['tag'] = '';
        $result['employee'] = '';
        if(!empty($segment)){
          foreach ($tag as $t){
            //職種
            if($t['description'] == 'type_job'){
              $result['job'][]= $t['tag_id'];
            }
            //施設形態
            if($t['description'] == 'type_nursery'){
              $result['nursery'][] = $t['tag_id'];
            }
            //こだわり求人
            if($t['description'] == 'tag_job'){
              $result['tag'][] = $t['tag_id'];
            }
            //こだわり園
            if($t['description'] == 'tag_nursery'){
              $result['tag'][] = $t['tag_id'];
            }
            // 雇用形態
            if($t['description'] == 'type_employ'){
              $result['employee'][] = $t['tag_id'];
            }
          }
          //drop operation
            if(empty($result['job'])){
              unset($result['job']);
            }
            //施設形態
            if(empty($result['nursery'])){
              unset($result['nursery']);
            }
            //こだわり
            if(empty($result['tag'])){
              unset($result['tag']);
            }
            //雇用形態
            if(empty($result['employee'])){
              unset($result['employee']);
            }
        return $result;

        }
    }

    /*
    *---------------------------------------------------------------
    * add by lip
    *---------------------------------------------------------------
    */

    /*
    $param : $params
    return : array()
    meaning: get job list
    */
    public function get_job_list($params)
    {
        $page_size = $params['page_size'];
        $page = $params['page'];
        $start = ($page == 1) ? 0 : ($page * $page_size) - $page_size;
        $params['page_size'] = $page_size;
        $params['start'] = $start;

        $job_count = $this->Logic_job->get_job_count($params);
        $job_list = $this->Logic_job->get_job_list($params);

        foreach ($job_list as $key => $value) {
            //get job_tag
            $tag_param = array('id'         =>  $value['job_id'],
                                'type'       =>  $this->config->item('type_relation_job', 'tag_config'),
                                'delete_flg' =>  $this->config->item('not_deleted','common_config'),
                        );
            //get tags
            $job_list[$key]['tags'] = $this->Service_tag->get_list($tag_param);
        }

        return array(
            'job_count' => $job_count,
            'job_list' => $job_list,
            'start' => $start
        );
    }

    public function get_necessary_info($client_id)
    {
        //園名
        $nursery = $this->Logic_nursery->get_exist_nursery($client_id);
        //募集職種
        $type_job = $this->Logic_tag->get_tag_by_group_id($this->config->item('type_job', 'tag_config'));
        //雇用形態
        $type_employ = $this->Logic_tag->get_tag_by_group_id($this->config->item('type_employ', 'tag_config'));
        //登録タグ
        $tag_job = $this->Logic_tag->get_tag_by_group_id($this->config->item('tag_job', 'tag_config'));
        //社会保険
        $insurance = $this->Logic_tag->get_tag_by_group_id($this->config->item('tag_insurance', 'tag_config'));

        $year_list = $this->generate_year(10);
        return array(
            'nursery' => $nursery,
            'type_job' => $type_job,
            'type_employ' => $type_employ,
            'tag_job' => $tag_job,
            'insurance' => $insurance,
            'year_list' => $year_list
        );
    }

    public function create_or_update_job($data, $files, $type = false)
    {
        $this->load->model("Logic_tag_relation");
        $now = date('Y-m-d H:i:s');
        $tag_relation_type = $this->config->item('type_relation_job', 'tag_config');
        $image_type = $this->config->item('job', 'image_config');
        $deleted_flg = $this->config->item('deleted', 'common_config');

        $param = array(
            'nursery_id' => $data['nursery_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'salary' => $data['salary'],
            'worktime' => $data['worktime'],
            'status' => $data['status'],
            'own_job_id' => $data['own_job_id'] ? $data['own_job_id'] : '',
            'pr' => $data['pr'] ? $data['pr'] : '',
            'bonus' => $data['bonus'] ? $data['bonus'] : '',
            'employees' => $data['employees'] ? $data['employees'] : 0,
            'holiday' => $data['holiday'] ? $data['holiday'] : '',
            'requirement' => $data['requirement'] ? $data['requirement'] : '',
            'expired' => isset($data['expired']) ? $data['expired'] : $data['year'] . '-' . $data['month'] . '-' . $data['day'],
            'ordered' => isset($data['ordered']) ? $data['ordered'] : 0,
            'created' => $now,
            'updated' => $now,
        );

        $this->db->trans_start();

        if(!empty($data['edit_job_id'])){
            $current_job_id = $param['job_id'] = $data['edit_job_id'];
            $this->Logic_job->update_job($param);
            $this->Logic_tag_relation->delete_tag_relation($current_job_id, $tag_relation_type);
        } else {
            $current_job_id = $this->Logic_job->insert_job($param);
            $param['job_id'] = $current_job_id;
        }

        //insert 募集職種
        if ($type !== 'copy' || ($type === 'copy' && isset($data['type_job']))) {
          $tag_type_job = array(
            'tag_ids' => array($data['type_job']),
            'account_id' => $current_job_id,
            'type' => $tag_relation_type
          );
          $this->Logic_tag_relation->regist_tag_relation($tag_type_job);
        }


        //insert 雇用形態
        if ($type !== 'copy' || ($type === 'copy' && isset($data['type_employ']))) {
          $tag_type_employ = array(
              'tag_ids' => array($data['type_employ']),
              'account_id' => $current_job_id,
              'type' => $tag_relation_type
          );
          $this->Logic_tag_relation->regist_tag_relation($tag_type_employ);
        }
        //insert 登録タグ
        if(!empty($data['tag_job'])){
            $tag_relation_job = array(
                'tag_ids' => $data['tag_job'],
                'account_id' => $current_job_id,
                'type' => $tag_relation_type
            );
            $this->Logic_tag_relation->regist_tag_relation($tag_relation_job);
        }

        //insert 社会保険
        if(!empty($data['insurance'])){
            $tag_relation_insurance = array(
                'tag_ids' => $data['insurance'],
                'account_id' => $current_job_id,
                'type' => $tag_relation_type
            );
            $this->Logic_tag_relation->regist_tag_relation($tag_relation_insurance);
        }

        //delete image when edit
        if(!empty($data['delete_image_ids'])){
            foreach(explode('_', $data['delete_image_ids']) as $image_id){
                $this->Logic_image->update_image_to_delete($image_id, $deleted_flg);
            }
        }

        //upload images to s3
        if($files){
            $this->load->model('Service_image');
            $this->load->model('Logic_image');
            $photo_fiels = array('job_photo_1', 'job_photo_2', 'job_photo_3');
            foreach ($photo_fiels as $key => $value) {
                if(!empty($files[$value]['name'])){
                    $rename = $value . '_' . time();
                    $result = $this->Service_image->uploadToS3($files[$value], $current_job_id, 2, $rename);
                    if($result) {
                        if ($value == 'job_photo_1') {
                          $ordered = 1;
                        }
                        if ($value == 'job_photo_2') {
                          $ordered = 2;
                        }
                        if ($value == 'job_photo_3') {
                          $ordered = 3;
                        }
                        $image_param = array(
                            'account_id' => $current_job_id,
                            'name' => $rename,
                            'type' => $image_type,
                            'ordered' => $ordered,
                            'created' => $now
                        );
                        $this->Logic_image->insert_image($image_param);
                    }
                }
            }
        }
        $this->db->trans_complete();

        $image_type = $this->config->item('job','image_config');
        $image_param = array('account_id' => $current_job_id,
                             'type'       => $image_type,
                             'delete_flg' => $this->config->item('not_deleted','common_config'));
        $job_images = $this->Logic_image->get_list($image_param);
        $param['ordered'] = count($job_images);
        $this->Logic_job->update_job($param);
        return $current_job_id;
    }

    /**
    *   delete job
    */
    /*public function delete($job_id)
    {
        $this->db->trans_start();

        //delete job
        $this->Logic_job->soft_delete($job_id);

        //delete job image
        $this->Logic_image->delete_image($job_id, $this->config->item('job', 'image_config'));

        //delete tag_relation
        $this->load->model('Logic_tag_relation');
        $this->Logic_tag_relation->delete_tag_relation($job_id, $this->config->item('type_relation_job', 'tag_config'));

        $this->db->trans_complete();
    }*/

    /**
    *   copy job
    */
    public function copy($job_id,$client_id)
    {
        $this->load->helper('image');

        $image_type = $this->config->item('job', 'image_config');

        $job_info = array();
        $copy_job_info = $this->get_edit_information($client_id, $job_id);

        $job_info = $copy_job_info['job_info'];
        $job_info['title'] = $job_info['title']." - コピー";
        $job_info['status'] = $this->config->item('draft', 'job_config');

        foreach ($copy_job_info['necessary_info']['type_job'] as $key => $type_job) {
            if (isset($type_job['should_checked'])) {
                $job_info['type_job'] = $type_job['tag_id'];
            }
        }
        foreach ($copy_job_info['necessary_info']['type_employ'] as $key => $type_employ) {
            if (isset($type_employ['should_checked'])) {
                $job_info['type_employ'] = $type_employ['tag_id'];
            }
        }
        $job_info['tag_job'] = array();
        foreach ($copy_job_info['necessary_info']['tag_job'] as $key => $tag_job) {
            if (isset($tag_job['should_checked'])) {
                $job_info['tag_job'][] = $tag_job['tag_id'];
            }
        }
        $job_info['insurance'] = array();
        foreach ($copy_job_info['necessary_info']['insurance'] as $key => $insurance) {
            if (isset($tag_job['should_checked'])) {
                $job_info['insurance'][] = $tag_job['tag_id'];
            }
        }
        unset($job_info['job_id']);

        $this->db->trans_start();
        $current_job_id = $this->create_or_update_job($job_info,null, 'copy');

        foreach ($copy_job_info['images'] as $key => $image) {
            $url = getImageUrlFromS3($job_id,$image_type,$image['name']);
            $fp = $this->Service_image->s3UrlToFileHandle($url);
            if ($image['ordered'] == 1) {
              $value = 'job_photo_1';
            }
            if ($image['ordered'] == 2) {
              $value = 'job_photo_2';
            }
            if ($image['ordered'] == 3) {
              $value = 'job_photo_3';
            }


            $rename = $value . '_' . time();
            $result = $this->Service_image->uploadImageDataToS3($fp,$current_job_id,2,$rename);
            if($result) {
                $image_param = array(
                    'account_id' => $current_job_id,
                    'name' => $rename,
                    'type' => $image_type,
                    'ordered' => $image['ordered'],
                    'created' => date('Y-m-d H:i:s')
                );
                $this->Logic_image->insert_image($image_param);
            }
        }

        $this->db->trans_complete();
    }

    public function generate_year($count, $blank_required = false, $start = false)
    {
        if($blank_required){
            $list[0] = '--';
        }

        if($start){
            $now = (int)date('Y') + $start;
        }else{
            $now = (int)date('Y');
        }
        $limit = $now + $count;

        if($count >= 0){
            for ($now; $now < $limit; $now++) {
                $list[$now] = $now;
            }
        }else{
            for ($now; $now > $limit; $now--) {
                $list[$now] = $now;
            }
        }

        return $list;
    }

    public function get_edit_information($client_id, $job_id)
    {
        $delete_flg = $this->config->item('not_deleted', 'common_config');
        $tag_relation_type = $this->config->item('type_relation_job', 'tag_config');
        $job_image_type = $this->config->item('job', 'image_config');

        //job detail information
        $job_info = $this->Logic_job->get_job_by_job_id($job_id);
        $expired = explode("-", date('Y-m-d', strtotime($job_info['expired'])));
        $job_info['year'] = $expired[0];
        $job_info['month'] = $expired[1];
        $job_info['day'] = $expired[2];
        // job images
        $this->load->model('Logic_image');
        $image_param = array(
            'account_id' => $job_id,
            'type' => $job_image_type,
            'delete_flg' => $delete_flg
        );

        $images = $this->Logic_image->get_list($image_param);

        //job tag relation, which tag should be checked
        $necessary_info = $this->Service_job->get_necessary_info($client_id);

        $this->load->model('Logic_tag_relation');
        $job_tag_relation = $this->Logic_tag_relation->get_tag_relation($job_id, $tag_relation_type);

        //which 募集職種 should be checked
        foreach ($necessary_info['type_job'] as $key => $value) {
            foreach ($job_tag_relation as $value_1) {
                if($value['tag_id'] == $value_1['tag_id']) {
                    $necessary_info['type_job'][$key]['should_checked'] = true;
                }
            }
        }

        //which 雇用形態 should be checked
        foreach ($necessary_info['type_employ'] as $key => $value) {
            foreach ($job_tag_relation as $value_1) {
                if($value['tag_id'] == $value_1['tag_id']) {
                    $necessary_info['type_employ'][$key]['should_checked'] = true;
                }
            }
        }

        //which 登録タグ should be checked
        foreach ($necessary_info['tag_job'] as $key => $value) {
            foreach ($job_tag_relation as $value_1) {
                if($value['tag_id'] == $value_1['tag_id']) {
                    $necessary_info['tag_job'][$key]['should_checked'] = true;
                }
            }
        }

        //which 社会保険 should be checked
        foreach ($necessary_info['insurance'] as $key => $value) {
            foreach ($job_tag_relation as $value_1) {
                if($value['tag_id'] == $value_1['tag_id']) {
                    $necessary_info['insurance'][$key]['should_checked'] = true;
                }
            }
        }

        return array(
            'necessary_info' => $necessary_info,
            'job_info' => $job_info,
            'images' => $images
        );
    }


    public function get_csv_data($job_ids, $format)
    {
        $headers = $this->config->item('client_job', 'export_column_config');
        $this->load->helper('job');
        $job_ids_array = explode('_', $job_ids);
        $jobs = $this->Logic_job->get_export_job($job_ids_array);
        foreach ($jobs as $key => $value) {
            //get job_tag
            $tag_param = array('id'         =>  $value['job_id'],
                                'type'       =>  $this->config->item('type_relation_job', 'tag_config'),
                                'delete_flg' =>  $this->config->item('not_deleted','common_config'),
                        );
            //get tags
            $job_tags = $this->Service_tag->get_list($tag_param);

            $jobs[$key]['tag_text'] = get_job_tag_text($job_tags, 'type_employ');
            $jobs[$key]['status_text'] = status_text($value['status']);
        }

        $this->load->model('Service_export_file');
        return $this->Service_export_file->export($headers, $jobs, $format);
    }

    public function get_limit($job_id){
        $record = $this->Logic_job->get_limit($job_id);
        if(!empty($record[0]['employees'])){
          return $record[0]['employees'];
        }else{
          return 0;
        }
    }
    public function close($job_id){
      if(empty($job_id)){
        return false;
      }
        $result = $this->Logic_job->close($job_id);
        if($result){
          //send mail to client that it closed
        }
        return $result;
    }
    /**
     * return job type tag_id int
     * @param  [type] $job_id [description]
     * @return [int] or false
     */
    public function get_type($job_id){
      if(empty($job_id)){
        return false;
      }
      $result = $this->Logic_job->get_type($job_id);
        if(!empty($result[0]['tag_id'])){
          return $result[0]['tag_id'];
        }else{
          return false;
        }
    }
    public function get_client_id($job_id = null){
        if(empty($job_id)){
          return false;
        }
        $result = $this->Logic_job->get_client_id($job_id);
        if($result[0]['client_id']){
          return $result[0]['client_id'];
        }else{
          return false;
        }
    }
    public function pickup_expired(){
        $result = $this->Logic_job->pickup_expired();
        return $result;
    }
    public function apply_via_session($user_id,$select_job){
        $service = $select_job['type'].'_job';
        $apply_result = $this->$service($user_id,$select_job['job_id']);
        return $apply_result;
    }
    public function expire($jobs){
        $result = $this->Logic_job->expire($jobs);
        return $result;
    }
    public function close_nursery($nursery_id){
        $result = $this->Logic_job->close_nursery($nursery_id);
        return $result;
    }

    public function get_related_area($pref_id){
      $relation_area = $this->Logic_area->get_related_area($pref_id);
      foreach ($relation_area as $key => $area) {
        $relation_area[$key]['name'] = str_replace('県', '', $area['name']);
      }

      return $relation_area;
    }

    public function get_each_city_job_count_by_pref($param){
        $pref_job_cache = array();
        $pref_id = $param['pref_id'];
        $this->load->driver('cache');
        $job_count_list = false;
        if($this->cache->is_supported('memcached')) {
          $job_count_list = $this->cache->memcached->get($pref_id);
          if (!$job_count_list) {
            $job_count_list = $this->Logic_job->get_each_city_job_count_by_pref($param);
            $this->cache->memcached->save($pref_id, $job_count_list, 60*60*4);
          }
        }else{
            $job_count_list = $this->Logic_job->get_each_city_job_count_by_pref($param);
        }
        return $job_count_list;
    }
    public function nursery_related_list($nursery_id,$param){

        if ($param['limit_to'] == 0) {
            return array();
        }

        $job_list = $this->Logic_job->nursery_related_list($nursery_id,$param);
        foreach($job_list as $job){
          $job_param = array('job_id' => $job['job_id'],
                                          'user_id' => $param['user_id']);
          $job_detail[] = $this->Service_job->get_detail_info($job_param);
        }
        return $job_detail;
    }
    public function nursery_related_count($nursery_id){
      $record = $this->Logic_job->nursery_related_count($nursery_id);
      if($record['count_job']){
         return $record['count_job'];
      }else{
         return 0;
      }
    }

    public function client_related_list($client_id,$param){
        if ($param['limit_to'] == 0) {
            return array();
        }

        $job_list = $this->Logic_job->client_related_list($client_id,$param);
        foreach($job_list as $job){
          $job_param = array('job_id' => $job['job_id'],
                                          'user_id' => $param['user_id']);
          $job_detail[] = $this->Service_job->get_detail_info($job_param);
        }
        return $job_detail;
    }
    public function client_related_count($client_id){
      $record = $this->Logic_job->client_related_count($client_id);
      if($record['count_job']){
         return $record['count_job'];
      }else{
         return 0;
      }
    }
}

?>
