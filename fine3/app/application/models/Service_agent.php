<?php
require_once 'AdminUploadPhotoTrait.php';
Class Service_agent extends MY_Model{

    use AdminUploadPhotoTrait;

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Logic_client');
        $this->load->model('Logic_agent');
        $this->load->model('Logic_career_adviser');
        $this->load->model('Logic_plan');
        $this->load->model('Service_plan');
        $this->load->model("Logic_area");
        $this->load->model("Logic_applicant_agency");
        $this->load->model('Service_tag');
        $this->load->model('Logic_image');
        $this->load->model("Service_area");
    }

    /**
     * admin side get_agent_detail
     * @param  [int] $agent_id
     * @return [array] [agent, career_adviser, plan] list
     */
    public function get_agent_detail($agent_id)
    {
        $agent = $this->agent_info($agent_id);
        $career_adviser = $this->career_adviser_list($agent_id);
        $plan = $this->Service_plan->get_related_plan_group($agent_id);
        $photo = $this->get_photo($agent_id);

        return array($agent, $career_adviser, $plan, $photo);
    }

    public function agent_info($agent_id)
    {
        $param = array(
            'client_id' => $agent_id,
            'status' => 0,
            'delete_flg' =>  $this->config->item('not_deleted','common_config'),
            // 'status' =>  $this->config->item('enabled','client_config'),
        );
        $agent = $this->Logic_client->get_client_detail($param);
        $agent['job_name']  = $this->_get_job_name($agent_id);
        $agent['area_name'] = $this->_get_area_name($agent_id);

        $image_param  = array('account_id' => $agent_id,
                              'type'       => $this->config->item('client','image_config'),
                              'delete_flg' => $this->config->item('not_deleted','common_config'));
        $agent['images'] = $this->Service_image->get_list($image_param);
        return $agent;
    }

    public function get_photo($agent_id)
    {
        $type = $this->config->item('client','image_config');
        $param = array(
            'account_id' => $agent_id,
             'type'       => $type,
             'status'     => $this->config->item('vaild','image_config'),
             'delete_flg' => $this->config->item('not_deleted','common_config')
        );
        $results = $this->Logic_image->get_list($param);

        $photo = array();

        $photo = array_map(function($image) use ($agent_id, $type){
            return  array( 'ordered' => $image['ordered'], 'url' => $this->getS3Url($agent_id, $type, $image['name']));
        }, $results);

        $photo = array_column($photo, 'url', 'ordered');

        if (!isset($photo['1'])) {
            $photo['1'] = '';
        }
        if (!isset($photo['2'])) {
            $photo['2'] = '';
        }
        if (!isset($photo['3'])) {
            $photo['3'] = '';
        }
        return $photo;



    }

    public function get_agent_detail_all($agent_id,$start=0){

        list($data["agent"], $data["career_adviser"], $data["plan"]) = $this->get_agent_detail($agent_id);
        if(empty($data["agent"]["client_id"])){return false;}

        if(!empty($data["career_adviser"])){
            $this->load->model("Logic_agent");
            foreach($data["career_adviser"] as $key => $career_adviser){
                $data["career_adviser"][$key]["expert_area"] = $this->Logic_agent->get_relation_area($career_adviser["career_adviser_id"]);
            }
        }

        // $data["job"] = $this->get_agent_job($agent_id,array("start"=>$start,"limit"=>10));
        $data["job_total"] = $this->count_agent_job($agent_id);

        $this->load->model("Logic_client");
        $data["agent"]["area"] = $this->Logic_client->get_relation_area($agent_id);

        $tag_relation_params["type"] = 3;
        $tag_relation_params["account_id"] = $agent_id;

        $this->load->model("Logic_tag_relation");
        $data["agent"]["tag"] = $this->Logic_tag_relation->get_tag_list($tag_relation_params);
        return $data;
    }
    public function count_agent_job($agent_id = null){
        if(empty($agent_id)){
            return 0;
        }
        $result = $this->Logic_job->count_agent_job($agent_id);
        if(empty($result[0]['count'])){
            return 0;
        }else{
        return $result[0]['count'];
        }
    }
    public function get_agent_job($agent_id,$order = array()){
        $this->load->model("Logic_job");
        $job_list = $this->Logic_job->get_job_list_relate_client($agent_id,$order);

        $user_data = $this->session->userdata("user_data");

        $this->load->model("Logic_tag_relation");
        $this->load->model("Logic_applicant_job");
        $this->load->model("Logic_bookmark");
$time_start = microtime(true);

        foreach($job_list as $key=>$val){
            $job_list[$key]["tag"]["job"] = $this->Logic_tag_relation->get_tag_relation($val["job_id"],0,array(2));
            $job_list[$key]["tag"]["employee"] = $this->Logic_tag_relation->get_tag_relation($val["job_id"],0,array(3));
            $job_list[$key]["tag"]["common_tag"] = $this->Logic_tag_relation->get_tag_relation($val["job_id"],0,array(4,5,7,8));
        }
        if(!empty($user_data["user_id"])){
            foreach($job_list as $key2=>$val2){
                $job_list[$key]["user_status"]["apply"] = $this->Logic_applicant_job->check_apply($user_data["user_id"],$val["job_id"]);
                $job_list[$key]["user_status"]["bookmark"] = $this->Logic_bookmark->check_bookmark($user_data["user_id"],$val["job_id"]);
            }
        }

$time_end = microtime(true);$time = $time_end - $time_start;echo "<br>[processing time]".$time."秒掛かりました。<br>";

        return $job_list;
    }

    public function career_adviser_index($agent_id)
    {

        $career_advisers = $this->career_adviser_list($agent_id);

        if ($career_advisers) {
            $agent =array(
                'name' => $career_advisers['0']['agent_name'],
                'id' => $career_advisers['0']['client_id'],
            );
        } else {
            $agent =array(
                'name' => '',
                'id' => $agent_id,
            );
        }

        return array($career_advisers, $agent);
    }

    /**
     * [career_adviser_list by agent id]
     * @param  [int] $agent_id [description]
     * @return [array]
     */
    public function career_adviser_list($agent_id)
    {
        $type = $this->config->item('career_adviser','image_config');

        $param = array(
            'client_id' => $agent_id,
            'status'    => $this->config->item('public','career_adviser_config'),
            'delete_flg' =>  $this->config->item('not_deleted','common_config'),
            'type' => $type,
            'limit' => 6,
        );

       $results = array();

        $results = $this->Logic_agent->get_list($param);

         $career_advisers = array_map(function ($ca) use($type) {
            $photo = $this->getS3Url($ca['career_adviser_id'], $type, $ca['file_name']);
            return array_merge($ca, array('photo' => $photo));
        }, $results);

         return $career_advisers;


    }

    public function career_adviser_update($param)
    {
        $type_origin = $this->config->item('career_adviser', 'image_config');
        $career_adviser_id = $param['career_adviser_id'];

        $career_adviser_param = $param;

        $image_delete_param = array(
            'delete_flg' =>  $this->config->item('deleted','common_config'),
            'account_id' => $param['career_adviser_id'],
            'type' => $type_origin,
        );

        $CI   = &get_instance();
        $CI->db->trans_begin();

        $this->Logic_career_adviser->update($career_adviser_param);

        if(!empty($_FILES['photo']['tmp_name'])) {

            $name = $this->upload_photo($_FILES['photo'], $career_adviser_id, $type_origin, 'career_adviser_1_');

            $image_create_param = array(
                'account_id' => $param['career_adviser_id'],
                'name' => $name,
                'type' => $type_origin,
                'created' => date( "Y/m/d H:i:s",time())
            );

            $this->Logic_image->delete_flg($image_delete_param);
            $this->Logic_image->save($image_create_param);
        }

        if ($CI->db->trans_status() === FALSE) {
            $CI->db->trans_rollback();
            return ;
        } else {
            $CI->db->trans_commit();
            return true;
        }
    }


    public function career_adviser_delete_flg($career_adviser_id)
    {
        $param = array(
            'career_adviser_id' => $career_adviser_id,
            'delete_flg' => $this->config->item('deleted', 'common_config'),
            'updated' => current_time(),
        );

        return $this->Logic_career_adviser->delete_flg($param);

    }


    /*
        $param : $nursery_id
        return : array()
        meaning: get one agent detail info
    */
    public function get_detail($nursery_id){

        $nursery_info = $this->Service_nursery->get_detail($nursery_id);
        $client_id = $nursery_info['nursery_id'];
        $param['select']    = array('client_id',
                                    'area_id',
                                    'display_area_id',
                                    'account_type',
                                    'mail',
                                    'name',
                                    'display_name',
                                    'department',
                                    'contact_name',
                                    'phone',
                                    'address',
                                    'display_address',
                                    'zip_code',
                                    'display_zip_code',
                                    'description',
                                    'license_number',
                                    'establish_date',
                                    'process',
                                    'url',
                                    'fax',
                                    'status',
                                    'delete_flg');
        $param["client_id"]  = $client_id;
        $param["status"]     = $this->config->item('enabled','client_config');
        $param["delete_flg"] = $this->config->item('not_deleted','common_config');
        $detail_info = $this->Logic_client->get_detail($param);
        if(!empty($detail_info[0])){
            $client_info = $detail_info[0];
            $client_info['job_name']  = $this->_get_job_name($client_id);
            $this->load->model("Service_area");
            $client_info['area_name'] = $this->_get_area_name($client_id);
            $image_param = array('account_id' => $client_id,
                                 'type'       => $this->config->item('client','image_config'),
                                 'status'     => $this->config->item('vaild','image_config'),
                                 'delete_flg' => $this->config->item('not_deleted','common_config')
                                );
            $client_info['images'] = $this->Service_image->get_list($image_param);
            return $client_info;
        }else{
            return false;
        }
    }

    public function get_careeradviser_detail($client_id){
        $param["client_id"]  = $client_id;
        $param["status"]     = $this->config->item('public','career_adviser_config');
        $param["delete_flg"] = $this->config->item('not_deleted','common_config');
        $param['limit'] = 6;

        $get_careeradviser_list = $this->Logic_agent->get_list($param);
    }

    public function get_pr_detail($client_id){

    }

    public function update($param)
    {
        $client_id = $param['client_id'];

        $status = isset($param['status'])
        ? $this->config->item('enabled','client_config')
        : $this->config->item('disabled','client_config');

        $agent_param = array(
            'client_id' => $client_id,
            'name' => $param['name'],
            'department' => $param['department'],
            'contact_name' => $param['contact_name'],
            'mail' => $param['mail'],
            'phone' => $param['phone'],
            'zip_code' => $param['zip_code'],
            'address' => $param['address'],
            'url' => isset($param['url']) ? $param['url'] : '',
            'status' => $status,
            'updated' => current_time(),
        );
        return $this->Logic_client->update($agent_param);
    }

    public function update_pr($param)
    {
        $type_origin = $this->config->item('client', 'image_config');
        $primary = $this->config->item('primary', 'image_config');
        $secondary = $this->config->item('secondary', 'image_config');
        $thirdly = $this->config->item('thirdly', 'image_config');

        $client_id = $param['client_id'];

        $agent_param = array(
            'client_id' => $client_id,
            'name' => $param['name'],
            'zip_code' => $param['zip_code'],
            'address' => $param['address'],
            'license_number' => $param['license_number'],
            'establish_date' => isset($param['establish_date']) ? $param['establish_date'] : '1000-01-01 00:00:00',
            'description' => $param['description'],
            'process' => $param['process'],
            'updated' => current_time(),
        );

        $delete_flg = array( 'delete_flg' => $this->config->item('deleted','common_config'));

        $area_param = array(
            'client_id' => $client_id,
            'area' => $param['state'],
        );

        $occupation_param = array(
            'client_id' => $client_id,
            'type'       =>  $this->config->item('type_relation_client','tag_config'),
            'occupation' => $param['occupation'],
            'created' => current_time(),
        );

        $photo = array();

        if( !empty($_FILES['photo1']['tmp_name'] )) {
            $file = $_FILES['photo1'];
            $primary_image_name = 'client_agency_'. $primary .'_';
            $photo[$primary] = $this->upload_photo($file, $client_id, $type_origin, $primary_image_name);
        }

        if( !empty($_FILES['photo2']['tmp_name'] )) {
            $file = $_FILES['photo2'];
            $secondary_image_name = 'client_agency_'. $secondary .'_';
            $photo[$secondary] = $this->upload_photo($file, $client_id, $type_origin, $secondary_image_name);
        }

        if( !empty($_FILES['photo3']['tmp_name'] )) {
            $file = $_FILES['photo3'];
            $thirdly_image_name = 'client_agency_'. $thirdly .'_';
            $photo[$thirdly] = $this->upload_photo($file, $client_id, $type_origin, $thirdly_image_name);
        }

        $is_update_photo = !empty($photo[$primary]) || !empty($photo[$secondary]) || !empty($photo[$thirdly]);

        if ( $is_update_photo ) {
            $photo_param = array(
                'account_id' => $client_id,
                'name' => array_values($photo),
                'type' => $type_origin,
                'ordered' => array_keys($photo),
                'created' => current_time(),
            );
        } else {
            $photo_param = array();
        }


        $CI   = &get_instance();
        $CI->db->trans_begin();

        $this->Logic_client->update($agent_param);
        $this->Logic_client->delete_area_relation(array_merge($area_param, $delete_flg));
        $this->Logic_client->insert_area_relation($area_param);

        $this->Logic_client->delete_tag_relation(array_merge($occupation_param, $delete_flg));
        $this->Logic_client->insert_tag_relation($occupation_param);


        if ($is_update_photo) {
            $this->Logic_image->delete_batch(array_merge($photo_param, $delete_flg));
            $this->Logic_image->save_batch($photo_param);
        }

        if ($CI->db->trans_status() === FALSE) {
            $CI->db->trans_rollback();
            return ;
        } else {
            $CI->db->trans_commit();
            return true;
        }
    }




    /*
    $param : $client_id
    return : sting
    */

    public function _get_job_name($client_id){
        $job_name = $this->get_job_array($client_id);
        return implode(' ', $job_name);
    }

    public function get_job_array($client_id)
    {
        $job_name = array();
        $tag_param   = array(
            'id'         =>  $client_id,
            'type'       =>  $this->config->item('type_relation_client','tag_config'),
            'delete_flg' =>  $this->config->item('not_deleted','common_config'),
        );
        $tag = $this->Service_tag->get_list($tag_param);
        $job_name = array();
        if(!empty($tag)){
            foreach ($tag as $key => $value) {
                $job_name[$value['tag_detail']['tag_id']] = $value['tag_detail']['name'];
            }
        }
        return $job_name;
    }

    /*
    $param : $client_id
    return : sting
    */
    public function _get_area_name($client_id){
        $area_name = $this->get_area_array($client_id);
        return implode(' ', $area_name);
    }

    public function get_area_array($client_id)
    {
        $area_param = array(
            'client_id'  => $client_id,
            'delete_flg' => $this->config->item('not_deleted','common_config')
        );
        $this->load->model("Service_area");
        $area = $this->Service_area->get_list($area_param);
        $area_name = array();
        foreach ($area as $key => $value) {
            $area_name[$value['area_detail']['area_id']] = $value['area_detail']['name'];
        }
        return $area_name;
    }



    /**
     * Count all record agency applied of current user
     * @param array $params
     * $params['user_id']
     * $params['status']
     * $params['delete_flg']
     * @return number
     * @since 2015/04/21
     */
    public function count_agency_applied($params){
        $this->load->model("Logic_applicant_agency");
        $result =  $this->Logic_applicant_agency->count_agency_applied($params);
        return $result ;
    }
    /**
     * Count all record user applied agency of current client
     * @param array $params
     * $params['client_id']
     * @return number
     * @since 2015/04/23
     */
    public function count_user_applied($params){
        $this->load->model("Logic_applicant_agency");
        return $this->Logic_applicant_agency->count_user_applied($params);
    }
    /**
     * All record user applied agency of current client
     * @param array $params
     * $params['client_id']
     * @return number
     * @since 2015/04/23
     */
    public function search_user_applied_agency($params){
        $this->load->model("Logic_applicant_agency");
        $records = $this->Logic_applicant_agency->search_user_applied_agency($params);
        if($records && ! empty($records)){
            foreach( (array) $records as $key => $item ){
                if( isset($item['user_id']) && ! empty($item['user_id']) ){
                    // Get tag of User (relationship)
                    $paramTag = [
                        'id'            => $item['user_id'],
                        'type'          => $this->config->item('type_relation_user', 'tag_config'),
                        'delete_flg'    => $this->config->item('not_deleted', 'common_config')
                    ];
                    $results = $this->Service_tag->get_detail_only_tag($paramTag);
                    if($results && ! empty($results)){
                        $records[$key]['tag'] = $results;
                    }
                    // Convert birthdate to age
                    $records[$key]['age'] = '';
                    if(isset($item['birthdate']) && ! empty($item['birthdate'])){
                        $records[$key]['age'] = $this->convert_birthday_to_age($item['birthdate']);
                    }
                }
            }
        }
        return $records;
    }
    /**
     * Convert birthdate to age
     * @param string/date $bithdate
     * @return number
     * @since 2015/04/23
     */
    protected function convert_birthday_to_age($bithdate){
        $date = new DateTime($bithdate);
        $now = new DateTime();
        $interval = $now->diff($date);
        return $interval->y;
    }
    /**
     * Check get detail applied in applicant_agency table
     * @param int $client_id
     * @param int $applicant_agency_id
     * @return boolean
     * @since 2015/04/23
     */
    public function get($client_id, $applicant_agency_id){
        $result = false;
        $result = $this->Logic_applicant_agency->get($client_id, $applicant_agency_id);
        return $result;
    }
    /**
     * Get all agency applied of current user
     * @since 2015/04/22
     * @param array $params
     * @return false/array
     */
    public function get_all_applied_agency($params, $offset = 0, $limit = 10){
        $records = $this->Logic_applicant_agency->get_all_applied_agency($params, $offset, $limit);

        if($records && ! empty($records)){
            foreach( (array) $records as $key => $item ){
                // Get name area of client
                $this->load->model('Service_area');
                $area = $this->Service_area->full_area($item['area_id']);
                if($area){
                    $records[$key]['area_name'] = $area;
                }
                // Get all area in relationship area-client
                $paramsAreaRelation = array(
                    'client_id' => $item['client_id'],
                    'delete_flg' => $this->config->item('not_deleted', 'common_config')
                );
                $area_relationship = $this->Service_area->get_list($paramsAreaRelation);
                if($area_relationship && ! empty($area_relationship)){
                    $records[$key]['area_relationship'] = $area_relationship;
                }
                //get tag relationship - tag & client
                $paramsTagRelation = array(
                    'id' => $item['client_id'], // client_id
                    'type' => $this->config->item('type_relation_client', 'tag_config'), // type_relation_client
                    'delete_flg' => $this->config->item('not_deleted', 'common_config')
                );
                $tag_relationship = $this->Service_tag->get_list_relation($paramsTagRelation);
                if($tag_relationship && ! empty($tag_relationship)){
                    $records[$key]['tag_relationship'] = $tag_relationship;
                }
            }

        }
        return $records;
    }
    /*
    applicantlist page, get client list According to the user's tag
    $param : $user_id
    return : array
    */
    public function get_client_list($user_id)
    {
        $user_params = array(
            'user_id' => $user_id,
            'delete_flg' => $this->config->item('not_deleted', 'common_config')
        );
        //get user info
        $this->load->model('Logic_user');
        $user = $this->Logic_user->get_admin_user_detail($user_params);

        //check inf user have tag with tag_id = 19
        //せいしゃいん
        $this->load->model('Logic_tag');
        $have_this_tag = $this->Logic_tag->is_user_have_tag($user['user_id'], 19);

        //get data from config
        $accuont_type = $this->config->item('headhunter', 'client_config');
        //value is 7
        $full_limit_type = $this->config->item('applicant_agency_full', 'plan_config');
        //value is 8
        $part_limit_type = $this->config->item('applicant_agency_part', 'plan_config');

        $full_limit_type_client_list = $this->Logic_client->get_client_list($accuont_type, $full_limit_type);
        $part_limit_type_client_list = $this->Logic_client->get_client_list($accuont_type, $part_limit_type);

        $always_display_client = array();
        foreach ($full_limit_type_client_list as $key => $fc) {
            foreach ($part_limit_type_client_list as $key1 => $pc) {
                if($fc['client_id'] == $pc['client_id']){
                    $always_display_client[] = $fc;
                    unset($full_limit_type_client_list[$key]);
                    unset($part_limit_type_client_list[$key1]);
                }
            }
        }
        $client_list = $have_this_tag ? $full_limit_type_client_list : $part_limit_type_client_list;

        $this->load->model('Service_apply');
        foreach ($always_display_client as $value) {
            $judge = $this->Service_apply->check_apply($user['user_id'],$value['client_id']);
            if(!$judge){
                $client_list[] = $value;
            }
        }

        $this->load->model("Service_area");
        foreach ($client_list as $key => $value) {
            $client_list[$key]['job_name']  = $this->_get_job_name($value['client_id']);
            $client_list[$key]['area_name'] = $this->_get_area_name($value['client_id']);
            //get images
            $image_param  = array('account_id' => $value['client_id'],
                                  'type'       => $this->config->item('client','image_config'),
                                  'delete_flg' => $this->config->item('not_deleted','common_config'));
            $client_list[$key]['images'] = $this->Service_image->get_list($image_param);
        }

        return $client_list;
    }
    /**
     * Get detail applied when click view detail in row
     * use applicant_agency_id[1]
     * @param array $param
     * @since 2015/04/24
     */
    public function get_detail_applied($params){
        $data = false;
        $paramDetail = ['applicant_agency_id' => [$params['applicant_agency_id']]];
        $result = $this->Logic_applicant_agency->get_detail($paramDetail);
        if($result){
            $item = $result[0];
            $data['applied'] = $item;
            $data['applied']['applied_status'] = $this->display_status($item['status']);
            $data['applied']['paid'] = $this->display_paid($item['status']);
            $data['applied']['button'] = $this->display_button($item['status']);

            if( isset($item['user_id']) && ! empty($item['user_id']) ){
                // Load Service User (Service_user)
                $this->load->model('Service_user');
                $userRecord = $this->Service_user->getDetail(
                        $item['user_id'],
                        $this->config->item('active', 'user_config'),
                        $this->config->item('not_deleted', 'common_config')
                );
                if( $userRecord && ! empty($userRecord)){
                    $data['user'] = $userRecord;
                    $data['user']['user_gender'] = $this->display_gender( $userRecord['gender'] );
                    $data['user']['display_birthdate'] = date('Y年m月d日', strtotime($userRecord['birthdate']));

                    // Get full area user
                    $this->load->model('Service_area');
                    $area = $this->Service_area->full_area($userRecord['area_id']);
                    if($area){
                        $data['area'] = $area;
                    }

                    // Get tag of User (relationship)
                    $paramTag = [
                        'id'            => $item['user_id'],
                        'type'          => $this->config->item('type_relation_user', 'tag_config'),
                        'delete_flg'    => $this->config->item('not_deleted', 'common_config')
                    ];
                    $results = $this->Service_tag->get_detail_only_tag($paramTag);
                    if($results && ! empty($results)){
                        $data['tag'] = $results;
                    }
                    // Convert birthdate to age
                    $records['age'] = '';
                    if(isset($userRecord['birthdate']) && ! empty($userRecord['birthdate'])){
                        $data['age'] = $this->convert_birthday_to_age($userRecord['birthdate']);
                    }
                }
            }
        }
        return $data;
    }
    protected function display_button($status){
        $btnArg = [
            '0' => '非課金申請する',
            '3' => '再申請する',
            'unknow' => 'Unknow'
        ];
        if(! array_key_exists($status, $btnArg)){
            $status = 'unknow';
        }
        return $btnArg[$status];
    }
    /**
     * Display status paid
     * @param int $status
     * @return string
     * @since 2015/04/24
     */
    protected function display_paid($status){
        $paidArg = ['0' => 'なし', 'unknow' => 'あり'];
        if(! array_key_exists($status, $paidArg)){
            $status = 'unknow';
        }
        return $paidArg[$status];
    }
    /**
     * Display status applied
     * @param int $status
     * @return string
     * @since 2015/04/24
     */
    protected function display_status($status){
        $statusArg = ['0' => '未確定', '1' => '申請中', '2' => '非確定', '3' => '確定', 'unknow' => '承認済' ];
        if(! array_key_exists($status, $statusArg)){
            $status = 'unknow';
        }
        return $statusArg[$status];
    }
    /**
     * Display gender
     * @param int $gender
     * @return string
     * @since 2015/04/24
     */
    protected function display_gender($gender){
        $genderArg = [1 => '女性', 2 => '男性'];
        return $genderArg[$gender];
    }
    /**
     * Update status to pending
     * Check status current of applied row before update
     * @param array $params
     * 'status' => $this->config->item('done', 'apply_config'), // status will update
     *  'applicant_agency_id' => [$post['applied']],
     *   'current_status' => [0,3] // status of applicant_agency_id current
     *   @since 2015/04/24
     */
    public function update_pending($params){
        $result = true;
        $paramDetail = ['applicant_agency_id' => $params['applicant_agency_id']];
        $records = $this->Logic_applicant_agency->get_detail($paramDetail);
        if( ! $records || empty($records)){
            return false;
        }
            if( ! is_array($params['current_status']) ){
                $result =  false;
            }
            $update_status = $params['status'];
        foreach($records as $record){
            $paramsUpdate = [
                    "status" => $update_status,
                    "comment" => "",
                    "applicant_agency_id" => $record['applicant_agency_id'],
            ];
            $result = $this->Logic_applicant_agency->update_status($paramsUpdate);
            if($result){
                // Send an email when status change = 1
                $this->load->model('Service_email');

                if(isset($params['comment']) && ! empty($params['comment'])){
                    $record['client_comment'] = $params['comment'];
                }

                $params = [
                    'client_name'       => $record['client_name'],
                    'user_name'         => $record['user_name'],
                    'client_comment'    => $record['client_comment'],
                ];
                $this->Service_email->except_apply_2admin($params);
            }else{
                $result =  false;
            }

        }
        return $result;
    }

    public function confirm($params){
        $result = true;
        $paramDetail =$params['applicant_agency_id'];

        $imp = implode(",",$paramDetail[0]);

        $records = $this->Logic_applicant_agency->get_detail_array($imp);

        if( ! $records || empty($records)){
            return false;
        }
            if( ! is_array($params['current_status']) ){
                $result =  false;
            }
            $update_status = $params['status'];
        foreach($records as $record){
            $paramsUpdate = [
                    "status" => $update_status,
                    "comment" => "",
                    "applicant_agency_id" => $record['applicant_agency_id'],
            ];
            $result = $this->Logic_applicant_agency->update_status($paramsUpdate);
            if($result){
                // Send an email when status change = 1
                $this->load->model('Service_email');

                if(isset($params['comment']) && ! empty($params['comment'])){
                    $record['client_comment'] = $params['comment'];
                }

                $params = [
                    'client_name'       => $record['client_name'],
                    'user_name'         => $record['user_name'],
                    'client_comment'    => $record['client_comment'],
                ];
                $this->Service_email->except_apply_2admin($params);
            }else{
                $result =  false;
            }

        }
        return $result;
    }
    /**
     * Update status to valid when status is pending
     * Check status current of applied row before update
     * @param array $params
     * 'status' => $this->config->item('none', 'apply_config'), // status will update
     *   'applicant_agency_id' => [$post['applied']],
     *   'current_status' => [1] // status of applicant_agency_id current
     *@since 2015/04/24
     */
    public function update_valid($params){
        $paramDetail = ['applicant_agency_id' => $params['applicant_agency_id']];
        $record = $this->Logic_applicant_agency->get_detail($paramDetail);
        if( ! $record || empty($record)){
            return false;
        }
        $record = $record[0];
        if( ! in_array($record['status'], $params['current_status']) ){
            return false;
        }
        $paramsUpdate = [
            "status" => $params['status'],
            "applicant_agency_id" => $record['applicant_agency_id'],
        ];
        $result = $this->Logic_applicant_agency->update_status($paramsUpdate);
        return $result;
    }
    /**
     * Update status in applicant_agency table
     * @param array $params
     * @return boolean
     * @since 2015/04/23
     */
    public function update_status($params){
        $result = false;

        if (empty($this->db)) {
            $this->load->database();
        }

        $this->db->trans_begin();

        // Get all applicant_agency_id to get status = 0
        $paramDetail = ['applicant_agency_id' => $params['applicant_agency_id']];
        $all = $this->Logic_applicant_agency->get_detail($paramDetail);
        $arg_email = [];
        if($all && !empty($all)){
            // Status update status and send email if applicant_agency status != 1
            foreach( (array) $all as $item ){
                if( intval($item['status']) != $this->config->item('done', 'apply_config') ){
                    $params["applicant_agency_id"] = $item['applicant_agency_id'];
                    // update status function
                    $result = $this->Logic_applicant_agency->update_status($params);
                    $arg_email[] = $item;
                    if(! $result){
                        break;
                    }
                }
            }
        }

        if(! $result){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();

            $this->load->model('Service_email');
            foreach( (array) $arg_email as $item ){
                $params = [
                    'client_name'       => $item['client_name'],
                    'user_name'         => $item['user_name'],
                    'client_comment'    => $item['client_comment'],
                ];
                $this->Service_email->except_apply_2admin($params);
            }

        }
        return $result;
    }
    /*
    apply agency
    $param : $user_id
    $param : $client_ids
    return : array
    */
    public function add_applicant_agency($user_id, $client_ids)
    {
        $now = date('Y-m-d H:i:s');
        $this->load->model('Logic_applicant_agency');
    $result = false;
    $this->load->model('Service_plan');
        foreach ($client_ids as $value) {
            $price = $this->Service_plan->calcurate_apply_agent_price($user_id,$value);
            $insert_params = array($user_id, $value, $now, $price);
            $result = $this->Logic_applicant_agency->insert_applicant_agency($insert_params);
        if(! $result){
        return false;
        }
        }
        return $result;
    }



    public function get_agent_list($params){
        $agent_list = $this->Logic_client->get_client_list_simplicity($params);
        foreach($agent_list as $key=>$agent_data){
            $agent_list[$key]["relation_area"] = $this->Logic_client->get_relation_area($agent_data["client_id"]);
        }
        return $agent_list;
    }

    //
    //for client
    //

    public function create($data)
    {
        $this->load->model('Logic_agent');
        $this->load->model('Service_image');
        $this->load->model('Logic_image');
        $this->config->load('s3', true);
        $s3Config = $this->config->item('s3');
        if (! isset($s3Config['bucket'])) {
            die('bucket param is not found in config/s3.php');
        }

        extract($s3Config);
        extract($data);
        /**
         * 1.
         * prepare Career adviser
         * 2. create a new Career adviser
         */
        $this->db->trans_begin();
        $ca = $this->prepareCreateCAData($data['client_id'], $data['name'], $data['message'],$data['status']);

        $career_adviser_id = $this->Logic_agent->create($ca);
        $result = false;
        if ($career_adviser_id > 0) {

            $name = $this->upload_photo($_FILES['photo'], $career_adviser_id, Logic_image::TYPE_CAREER_ADVISER, 'career_adviser_1_');

            $image_create_param = array(
                'account_id' => $career_adviser_id,
                'name' => $name,
                'type' => Logic_image::TYPE_CAREER_ADVISER,
                'ordered' => 1,
                'created' => date( "Y/m/d H:i:s",time())
            );

            $this->Logic_image->save($image_create_param);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    /**
     * Prepare data before inserting image table
     */
    public function prepareCreateImage($career_adviser_id, $name, $type = 4, $ordered = 1)
    {
        $data['account_id'] = $career_adviser_id;
        $data['name'] = ltrim($name, '/');
        $data['type'] = $type;
        $data['created'] = date('Y-m-d H:i:s');
        $data['delete_flg'] = $this->config->item('not_deleted','common_config');
        $data['ordered'] = $ordered;
        return $data;
    }

    /**
     * Prepare data before inserting into career adviser table
     *
     */
    public function prepareCreateCAData($client_id, $name, $message,$status)
    {
        $data['client_id'] = $client_id;
        $data['name'] = $name;
        $data['message'] = $message;
        $data['created'] = date('Y-m-d H:i:s');
        $data['updated'] = date('Y-m-d H:i:s');
        $data['delete_flg'] = $this->config->item('not_deleted','common_config');
        $data['status'] = $status;
        return $data;
    }

    /**
     * Get Career advisers by client id
     * @param  array(client_id,limit,offset)
     * @return $data []
     */
    public function get_list($param)
    {
        $this->load->model('Logic_agent');
        $param['delete_flg'] = $this->config->item('not_deleted','common_config');
        $param['type'] = $this->config->item('career_adviser','image_config');
        $data = $this->Logic_agent->get_own_list($param);
        if(is_array($data)){
            return $data;
        }else{
            return false;
        }

    }
    /**
     * Get Career advisers by client id
     * @return $record count
     */
    public function get_count($client_id)
    {


        $param['client_id'] = $client_id;
        $param['delete_flg'] = $this->config->item('not_deleted','common_config');
        $this->load->model('Logic_agent');
        $record = $this->Logic_agent->get_count($param);

      if($record[0]['count_agent']){
         return $record[0]['count_agent'];
      }else{
         return 0;
      }

    }
    /**
     * get image url
     * @param $career_adviser_id int
     * @return url
     *
     */
    public function getImageUrl($career_adviser_id)
    {
        $image = $this->getImage($career_adviser_id, ['ordered']);
        if($image == false){
            return null;
        }
        return $this->getImageS3Url($career_adviser_id);
    }

    public function getImageS3Url($career_adviser_id,  $ordered = 1){
        $this->load->helper('image');
        $this->load->model('Logic_image');

        $result = getImageFromS3($career_adviser_id,  Logic_image::TYPE_CAREER_ADVISER, $ordered);
        if(isset($result['path'])){
            return $result['path'];
        }
        return null;
    }


    /**
     * get image
     * @param $career_adviser_id int
     * @param $fields columns to select
     * @return array/null
     *
     */
    public function getImage($career_adviser_id, $fields = ['image_id', 'ordered'])
    {
        $this->load->model('Logic_image');
        $this->load->helper('image');
        $where['account_id'] = $career_adviser_id;
        $where['type'] = Logic_image::TYPE_CAREER_ADVISER;
        $where['delete_flg'] = $this->config->item('not_deleted','common_config');
        $image = $this->Logic_image->read($where, $fields);
        if($image == false){
            return null;
        }
        $image = array_shift($image);
        return $image;
    }

    /**
     * Support for view
     */
    public function parseCaInfo($ca)
    {
        $ca['edit_url'] = '/client/profile/edit_career_adviser_info/' . $ca['career_adviser_id'];
        $ca['detail_url'] = '/client/profile/career_adviser_detail/' . $ca['career_adviser_id'];

        // query image from image table
        $ca['image_url'] = $this->getImageUrl($ca['career_adviser_id']);
        return $ca;
    }

    /**
     * update delete_flg = 1
     */
    public function delete($client_id, $career_adviser_id){
        $this->load->model('Logic_agent');
        return $this->Logic_agent->delete($client_id, $career_adviser_id);

    }

    /**
     * get a career adviser for edit page by client id
     * @return array ['name', 'message', image_id, image_url]
     *
     */
    /*public function read($client_id, $career_adviser_id){

        $this->load->model('Logic_agent');
        $where['delete_flg'] =  $this->config->item('not_deleted','common_config');
        $where['career_adviser_id'] = $career_adviser_id;
        $where['client_id'] = $client_id;

        $param['delete_flg']              = $this->config->item('not_deleted','common_config');
        $param['career_adviser_id'] = $career_adviser_id;
        $result = $this->Logic_agent->get_detail($param);
        if(empty($result[0]) || $result[0]['client_id'] !== $client_id)return false;
        $image = $this->getImage($career_adviser_id, ['image_id']);
        $image['image_url'] = $this->getImageS3Url($career_adviser_id);
        $data =  array_merge($result[0], $image);
        return $data;
    }*/

    public function update_postdata($data)
    {
        $this->load->model('Logic_agent');

        extract($data);
        /**
         * 1.
         * prepare Career adviser
         * 2. create a new Career adviser
        */

        $ca = $this->prepareUpdateCAData($name, $message);
        $where['career_adviser_id']  = (string)$career_adviser_id;
        $where['client_id']  = (string)$client_id;
        $param['info'] = $ca;


        $param['career_adviser_id'] = $career_adviser_id;
        $result = $this->Logic_agent->update_agent_info($param);
        $this->db->trans_start();
        if ($result > 0 && ! empty($image) ) {
            $result = $this->deleteImage($career_adviser_id);

            if(! $result){
                $this->db->trans_rollback();
            }
            $result = $this->createImage($image, $career_adviser_id);
        }

        if($result){
            // $this->db->trans_commit();
        }else{
            // $this->db->trans_rollback();
        }

        return $result;
    }

    /**
     * update delete_flg = 1 in image table
     */
    public function deleteImage($career_adviser_id, $ordered = 1){
        $this->load->model('Logic_image');
        $data['delete_flg'] = Logic_image::DELETE_FLG;
        $where['account_id'] = $career_adviser_id;
        $where['type'] = Logic_image::TYPE_CAREER_ADVISER;
        $where['ordered'] = $ordered;

        $result = $this->Logic_image->update($data, $where);
        return $result;
    }



    /**
     * Create image and upload image to S3
     */
    public function createImage($image, $career_adviser_id,  $ordered = 1){
        $this->load->model('Logic_image');
        $this->load->model('Service_image');
        $this->config->load('s3', true);
        $s3Config = $this->config->item('s3');
        if (! isset($s3Config['bucket'])) {
            die('bucket param is not found in config/s3.php');
        }
        extract($s3Config);

        try {
            $result = $this->Service_image->uploadToS3($image, $career_adviser_id, Logic_image::TYPE_CAREER_ADVISER, $ordered);
            if (isset($result['ObjectURL'])) {
                list ($baseUrl, $name) = explode($bucket, $result['ObjectURL']);
                $image = $this->prepareCreateImage($career_adviser_id, $name, Logic_image::TYPE_CAREER_ADVISER);
                $result = $this->Logic_image->create($image);
            }
        } catch (Exception $e) {
            $result = false;
        }
        return  $result;
    }


    /**
     * Prepare data before inserting into career adviser table
     *
     */
    public function prepareUpdateCAData($name, $message)
    {
        $data['name'] = $name;
        $data['message'] = $message;
        $data['updated'] = date('Y-m-d H:i:s');
        return $data;
    }

    public function get_career_adviser_info($career_adviser_id){

        $this->load->config("career_adviser_config");
        $params["select"] = array("career_adviser_id","client_id","name","message","status");
        $params['career_adviser_id'] = $career_adviser_id;
        $params['delete_flg'] = $this->config->item("valid","career_adviser_config");

        $this->load->model("Logic_career_adviser");
        $career_adviser_info = $this->Logic_career_adviser->get_detail($params);

        if(empty($career_adviser_info)){
            return $career_adviser_info;
        }else{
            return $career_adviser_info[0];
        }
    }
}
?>
