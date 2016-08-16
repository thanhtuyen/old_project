<?php
Class Service_client extends MY_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Logic_client');
        $this->load->model('Logic_plan');
    }

    public function chk_alive($client_id){
        if(empty($client_id)){
            return false;
        }
        $result = $this->Logic_client->chk_alive($client_id);
        if(empty($result)){
            return false;
        }else{
            return true;
        }
    }
    /**
     * this function is return only displayable data.
     * not return password, mail, and other secret.
     * @param  $client_id(int)
     * @return array or false;
     */
    public function get_detail($client_id){


        $param['select']     = array('client_id',
                                    'area_id',
                                    'display_area_id',
                                    'account_type',
                                    'name',
                                    'display_name',
                                    'department',
                                    'contact_name',
                                    'phone',
                                    'mail',
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
                                    'created',
                                    'updated',
                                    'status',
                                    'delete_flg');
        $param['client_id']  = $client_id;
        $param['status']     = $this->config->item('enabled','client_config');
        $param['delete_flg'] = $this->config->item('not_deleted','common_config');
        $detail_info = $this->Logic_client->get_detail($param);

        if(!empty($detail_info[0])){

            $client_info = $detail_info[0];

            $this->load->model("Service_area");
            $client_info["area_name"] = $this->Service_area->get_area_name($client_info["area_id"]);
            $client_info["display_area_name"] = $this->Service_area->get_area_name($client_info["display_area_id"]);

            //get nursery_tag
            $tag_param      = array('id'         =>  $client_id,
                                                    'type'       =>  $this->config->item('type_relation_client','tag_config'),
                                                    'delete_flg' =>  $this->config->item('not_deleted','common_config'),
                                );
            //get tags
            $this->load->model("Service_tag");
            $tags = $this->Service_tag->get_list($tag_param);
            $client_info['tags'] = $this->Service_tag->sort_tag($tags);

            return $client_info;
       }else{
            return false;
       }
    }
    public function get_client_name($client_id){
        if(empty($client_id)){
            return false;
        }
        $result = $this->Logic_client->get_client_name($client_id);
        if(!empty($result[0]["name"])){
            return $result[0]["name"];
        }else{
            return false;
        }
    }
    public function get_client_data($params){
        $this->load->model("Logic_client");
        $record = $this->Logic_client->get_client_data($params);

        /*if(!empty($record[0]["area_id"])){
            $this->load->model("Service_area");
            $record[0]["area"] = $this->Service_area->get_area_name($record[0]["area_id"]);
        }*/

        return $record;
    }

    /**
     * admin create client
     * @param  [array] $posts form
     * @return [array] return [status.code, password, email]
     * generate_password(),current_time() these functions from admin_helper
     */
    public function save($posts)
    {
        $password = generate_password();
        $mail = $posts['mail'];
        $contact_name = $posts['contact_name'];
        $client_name = $posts['name'];
        $role = $posts['account_type'];

        $param = array(
            'area_id' => $posts['area_id'],
            'account_type' => $posts['account_type'],
            'mail' => $mail,
            'password' => md5($password),
            'name' => $client_name,
            'department' => $posts['department'],
            'contact_name' => $contact_name,
            'phone' => $posts['phone'],
            'address' => $posts['address'],
            'zip_code' => $posts['zip_code'],
            'fax' => $posts['fax'],
            'establish_date' => current_time(),
            'created' => current_time(),
            'display_area_id' => $posts['area_id'],
            'display_name' => $posts['name'],
            'display_address' => $posts['address'],
            'display_zip_code' => $posts['zip_code'],
            'url' => '',
            'process' => '',
            'description' => '',
            'license_number' => '',
            'status' => '0',
        );

        $this->db->trans_begin();

        $client_id = $this->Logic_client->save($param);
        if(!empty($posts['plan_group'])){
            $this->load->model('Service_plan');
            foreach ($posts['plan_group'] as $key => $value) {
                $relation_param['plan_group_id'] = $value;
                $relation_param['client_id'] = $client_id;
                $plan_detail = $this->Service_plan->get_group_detail($relation_param);
                $relation_param['plan_group'] = $plan_detail;
                $result = $this->Service_plan->apply($relation_param);
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return array(0, $password, $mail, $client_name, $contact_name);
        }else {
            $this->db->trans_commit();
            return array(1, $password, $mail, $client_name, $contact_name);
        }

    }

    public function update_pr($posts,$files){

        $this->load->model("Logic_tag_relation");
        $this->load->model('Logic_area');
        $delete_flg = $this->config->item('not_deleted', 'common_config');
        $deleted_flg = $this->config->item('deleted', 'common_config');
        $tag_relation_type = $this->config->item('type_relation_client', 'tag_config');
        $image_type = $this->config->item('client', 'image_config');
        $now = date('Y-m-d H:i:s');
        /*$area_params = array(
            'pref_id' => $posts['pref_id'],
            'city_id' => $posts['city_id'],
            'delete_flg' => $delete_flg
        );*/
        //$area = $this->Logic_area->get_area_by_pref_and_city($area_params);

        if(isset($posts['establish_date_year']) && isset($posts['establish_date_month']) && isset($posts['establish_date_date'])){
                $establish_date = $posts['establish_date_year'].'-'.$posts['establish_date_month'].'-'.$posts['establish_date_date'].' 00:00:00';
        }else{
            $establish_date = '1000-01-01 00:00:00';
        }


        $param = array(
                'display_area_id' => is_numeric($posts['area_id'])?$posts['area_id']:0,
                'display_name' => isset($posts['display_name'])? $posts['display_name']:"",
                'display_address' => isset($posts['display_address'])? $posts['display_address']:"",
                'display_zip_code' => isset($posts['display_zip_1'])&&isset($posts['display_zip_2']) ? $posts['display_zip_1'].$posts['display_zip_2']:"",
                'establish_date' =>$establish_date,
                'process' => isset($posts['process'])? $posts['process']: "",
                'description' => isset($posts['description'])? $posts['description']:"",
                'license_number' => isset($posts['license_number'])? $posts['license_number']:"",
                'updated' => $now,
                'client_id' => isset($posts['client_id'])? $posts['client_id']:"",
        );


        $this->db->trans_start();

        if(!empty($posts['client_id'])){
            $client_id = $posts['client_id'];
            $this->Logic_client->update_pr($param);
            $this->Logic_tag_relation->delete_tag_relation($client_id, $tag_relation_type);
            $this->Logic_area->delete_client_area($client_id, $deleted_flg);
        } else {
            return false;
        }

        //insert 得意エリア
        if(isset($posts['area'])){
            $area_relation = array(
                    'area_ids' => array($posts['area']),
                    'account_id' => $client_id,
                    'delete_flg' => $delete_flg
                );
                $this->Logic_area->regist_client_area($area_relation);
        }

            //insert 得意職種
        if(isset($posts['type_job'])){
        foreach($posts['type_job'] as $tag){
                $tag_relation = array(
                    'tag_ids' => array($tag),
                    'account_id' => $client_id,
                    'type' => $tag_relation_type
                );
                $this->Logic_tag_relation->regist_tag_relation($tag_relation);
        }
        }

        //delete image when edit
        if(!empty($data['delete_image_ids'])){
            foreach(explode('_', $data['delete_image_ids']) as $image_id){
                $this->Logic_image->update_image_to_delete($image_id, $deleted_flg);
            }
        }

        if(!empty($posts["delete_image_flg"])&&$posts["delete_image_flg"] === "1"){
            $delete_image_param["account_id"] = $posts["client_id"];
            $delete_image_param["type"]       = $this->config->item('client','image_config');
            $this->load->model('Service_image');
            $this->Service_image->delete_image($delete_image_param);
        }
        //upload image to s3
        if(isset($files)){
            $this->load->model('Service_image');
            $this->load->model('Logic_image');
            $photo_fiels = array('client_photo');
            if(!empty($files["client_photo"]['name'])){
                $name = time(); // TODO url path
                $result = $this->Service_image->uploadToS3($files["client_photo"], $client_id, 3, $name);

                if($result) {
                    $image_param = array(
                        'account_id' => $client_id,
                        'name' => $name,
                        'type' => $image_type,
                        'ordered' => 1,
                        'created' => $now
                    );
                    $this->Logic_image->insert_image($image_param);
                }
            }
        }

        //copy image to s3 and DB
        if(isset($source_id)){

            // source nursery images
            $this->load->model('Logic_image');
            $source_image_param = array(
                'account_id' => $source_id,
                'type' => $this->config->item('client', 'image_config'),
                'delete_flg' => $delete_flg
            );

            $images = $this->Logic_image->get_list($source_image_param);

            foreach($images as $key => $img){
                $copy_result = $this->Service_image->copyImageDataToS3andDB($source_id, $client_id, $img, $now, $key + 1);
            }
        }
        $this->db->trans_complete();
        //update image and client ordered
        $image_type = $this->config->item('client','image_config');
        $image_param = array('account_id' => $client_id,
                             'type'       => $image_type,
                             'delete_flg' => $this->config->item('not_deleted','common_config'));
        $client_images = $this->Logic_image->get_list($image_param);
        $param['ordered'] = count($client_images);
        $this->Logic_client->update_pr($param);

        return true;
    }


    /**
     * get client total count
     * @param  [string] $condition
     * @return [int]
     */
    public function get_total_count($condition = array())
    {
        $param = array(
            'delete_flg' => $this->config->item('not_deleted','common_config'),
            'keyword' => isset($condition['keyword']) ? $condition['keyword'] : null,
            'account_type' => isset($condition['account_type'])? conversion_account_type($condition['account_type']) : null,
        );

        return $this->Logic_client->all_count($param);
    }

    /**
     * get admin side client list
     * @param  [array] $condition
     * @param  [array] $parameters
     * @return [array]
     */
    public function get_list($condition, $param)
    {
        if ($param['total'] == 0) {
            return array();
        }

        $param = array(
            'offset' => $param['offset'],
            'limit' => $param['limit'],
            'delete_flg' => $this->config->item('not_deleted','common_config'),
            'keyword' => isset($condition['keyword']) ? $condition['keyword'] : null,
            'account_type' => conversion_account_type($condition['account_type']),
        );

        return $this->Logic_client->get_list($param);
    }

    /**
     * for agent list page. all clients will shown order by phonetic as ascent.
     * @return [type] [description]
     */
    public function get_all_list($type){
        $param = array(
            'delete_flg' => $this->config->item('not_deleted','common_config'),
            'account_type' => $type,
            'status' => 0
        );
        return $this->Logic_client->get_all_list($param);
    }

    public function get_plan_total_count($condition = array())
    {
        $param = array(
            'keyword' => isset($condition['keyword']) ? $condition['keyword'] : null,
        );

        return $this->Logic_plan->get_total_count($param);
    }


    /**admin
     * パッケージプラン一覧に戻る
     * @return [array]
     */
    public function plan_category()
    {
        $param = array(
            'delete_flg' => $this->config->item('not_deleted','common_config'),
        );

        $groups = $this->Logic_plan->get_group($param);

        $groups = array_unique($groups, SORT_REGULAR);
        $plans = $this->Logic_plan->get_relation_list($param);


        return $this->_generate_categories_param($groups, $plans);

    }

    public function plan_list($condition, $parameters, $pagerfanta = true)
    {
        $param = array();
        if($pagerfanta){
            if ($parameters['total'] == 0) {
                return array();
            }

            $param = array(
                'offset' => $parameters['offset'],
                'limit' => $parameters['limit'],
            );
        }
        return $this->Logic_plan->get_all_list($condition, $param, $pagerfanta);
    }

    public function plan_detail($id)
    {
        return $this->Logic_plan->detail($id);
    }

    public function plan_save($post)
    {
        $param = array(
            'plan_name' => $post['plan_name'],
            'description' => $post['description'],
            // 'price' => $post['price'],
            'limit_num' => $post['limit_num'],
            'limit_type' => $post['limit_type'],
        );
        return $this->Logic_plan->save($param);
    }

    public function plan_update($post)
    {
        $param = array(
            'plan_name'=> $post['plan_name'],
            'description'=> $post['description'],
            'limit_num'=> $post['limit_num'],
            'limit_type'=> $post['limit_type'],
            'plan_id'=> $post['plan_id'],
        );
        return $this->Logic_plan->update($param);
    }

    public function plan_delete_flg($plan_id)
    {
       if ($this->Logic_plan->is_selected($plan_id)) {
            throw new Exception("このプランはご利用中の企業様がいるため削除できません", 1);
       } else {
            return $this->Logic_plan->delete_flg($plan_id);
       }
    }

    public function plan_group_delete_flg($plan_group_id)
    {
        $param = array(
            'delete_flg' => $this->config->item('deleted','common_config'),
            'plan_group_id' => $plan_group_id,
        );
        return $this->Logic_plan->group_delete_flg($param);
    }

    public function plan_group()
    {
        $param = array(
            'delete_flg' => $this->config->item('not_deleted','common_config'),
        );

        $groups = $this->Logic_plan->get_group($param);

        return array_unique($groups, SORT_REGULAR);

    }

    public function plan_group_detail($group_id)
    {
        $param = array(
            'delete_flg' => $this->config->item('not_deleted','common_config'),
            'group_id' => $group_id,
        );
        $group = $this->Logic_plan->group_detail($param);
        $group_select_plans = $this->Logic_plan->get_plans_by_group_id($param);
        return array_merge($group, $group_select_plans);
    }

    public function get_plans_detail_by_group_id($group_id)
    {
        $param = array(
            'delete_flg' => $this->config->item('not_deleted','common_config'),
            'group_id' => $group_id,
        );
        $group = $this->Logic_plan->group_detail($param);
        $plans_detail = $this->Logic_plan->get_plans_detail_by_group_id($param);
        return array($group, $plans_detail);
    }

    public function client_create_plan($param)
    {
        d($param);
        $this->Logic_plan->client_create_plan();
    }

    public function save_plan_group($post)
    {
        $status = isset($post['status'])
        ? $this->config->item('status_public','plan_config')
        : $this->config->item('status_closed','plan_config');

        $group_param = array(
            'name' => $post['name'],
            'period' => $post['period'],
            'extend_period' => $post['extend_period'],
            'price'=> $post['price'],
            'auto_extend_flg' => $post['auto_extend_flg'],
            'status' => $status,
        );

        $CI   = &get_instance();
        $CI->db->trans_begin();

        $plan_group_id = $this->Logic_plan->save_group($group_param);

        $plan_relation_param = array(
            'plan_group_id' => $plan_group_id,
            'plan_id' => $post['plan_id'],
        );

        $this->Logic_plan->save_relation($plan_relation_param);

        if ($CI->db->trans_status() === FALSE) {
            $CI->db->trans_rollback();
            return ;
        } else {
            $CI->db->trans_commit();
            return true;
        }

    }

    public function plan_update_group($post)
    {
        $plan_group_id = $post['plan_group_id'];

        $status = isset($post['status'])
        ? $this->config->item('status_public','plan_config')
        : $this->config->item('status_closed','plan_config');

        $group_param = array(
            'plan_group_id' => $plan_group_id,
            'name' => $post['name'],
            'price'=> $post['price'],
            'period' => $post['period'],
            'extend_period' => $post['extend_period'],
            'auto_extend_flg' => $post['auto_extend_flg'],
            'status' => $status,
        );

//var_dump($post);exit;
        $plan_relation_param = array(
            'plan_group_id' => $plan_group_id,
            'plan_id' => (isset($post['plan_id']))? $post['plan_id']:"",
        );
        $CI   = &get_instance();
        $CI->db->trans_begin();

        $this->Logic_plan->update_group($group_param);

        $this->Logic_plan->delete_relation_by_group_id($plan_group_id);

    if(isset($post['plan_id'])){
            $this->Logic_plan->save_relation($plan_relation_param);
    }

        if ($CI->db->trans_status() === FALSE) {
            $CI->db->trans_rollback();
            return ;
        } else {
            $CI->db->trans_commit();
            return true;
        }

    }

    public function delete_plan_relation($group_id, $plan_id)
    {
        return $this->Logic_plan->delete_relation($group_id, $plan_id);
    }

    private function _generate_categories_param($groups, $plans)
    {
        foreach ($groups as &$group) {
            foreach ($plans as $plan) {
                if ($group['plan_group_id'] == $plan['plan_group_id']) {
                    $group['plans'][] = $plan;
                }

            }
        }
        unset($group);
        return $groups;
    }

    //for client backend index
    public function chk_applied($client_id){
        $this->load->model("Logic_client");
        $applied = $this->Logic_client->search_applied($client_id);
        $param['type'] = $this->config->item('type_relation_user','tag_config');
        $param['delete_flg'] = $this->config->item('not_deleted','common_config');
        $i = 0;
        if(empty($applied)){
            return false;
        }
        foreach($applied as $row){
            $param['id'] = $row['user_id'];
            $userdata[$i]['user_data'] = $row;
            $userdata[$i]['tag'] = $this->Service_tag->get_list($param);
            $i ++;
        }
        $result['count'] = count($applied);
        $result['data']  = $userdata;
        return $result;
    }

    /*
        return : array()
        meaning: get client many infos when edit, include
        都道府県 市区町村 エリア 職種
    */
    public function get_necessary_client_info()
    {
        $this->load->model('Logic_area');
        //都道府県
        $prefs = $this->Logic_area->get_pref();
        //市区町村
        $citys = $this->Logic_area->get_city();

        $delete_flg = $this->config->item('not_deleted', 'common_config');

    //エリア
    $params  = array('pref_id'   =>  "`pref_id` = 0",
                         'delete_flg'  =>  (isset($delete_flg))? $delete_flg:0);
    $areas = $this->Logic_area->get_area_list($params);

        $this->load->model('Logic_tag');
        //職種
        $type_job = $this->Logic_tag->get_tag_by_group_id($this->config->item('type_job', 'tag_config'));

        return array(
            'prefs' => $prefs,
            'citys' => $citys,
            'areas' => $areas,
            'type_job' => $type_job,
        );
    }

    public function change_password($client_id, $password){
        $md5_pass = md5($password);

        $this->db->trans_start();

        $this->load->model("Logic_client");
        $result = $this->Logic_client->change_password($client_id, $md5_pass);

        if($result){
            $this->db->trans_complete();

            $client_param["select"] = "";
            $client_param["where"]  = array('client_id'=>$client_id);
            $client_data = $this->get_client_data($client_param);

            $params['to'] = $client_data[0]['mail'];
            $params['client_contact_name'] = $client_data[0]['name'];

            $this->load->model("Service_email");
            $this->Service_email->change_pass_2client($params);
        }else{
            $this->db->trans_rollback();
        }

        return $result;
    }
    public function get_client_type($client_id){
        $this->load->model("Logic_client");
        $type = $this->Logic_client->get_client_type($client_id);
        if(!empty($type[0]['account_type'])){
            return $type[0]['account_type'];
        }else{
            return false;
        }
    }


    /**
     * [export file ]
     * @param  [string] $format e.g csv
     * @return [string]       filepath
     */
    public function export_file($format)
    {
        $headers = $this->config->item('client','export_column_config');
        $export_results = $this->Logic_client->get_export_data();

        foreach ($export_results as &$result) {
            $result['address'] = $result['province'] . $result['city'] . $result['address'];
            $result['account_type'] = $result['account_type'] == 1 ? '園法人' : '紹介会社';
        }
        unset($result);
        $this->load->model('Service_export_file');
        return $this->Service_export_file->export($headers, $export_results, $format);
    }

    public function export_nursery_file($format)
    {
        $headers = $this->config->item('nursery','export_column_config');
        $this->load->helper('nursery');
        list($export_results, $nursery_type, $insurance, $benefit, $image) = $this->Logic_client->get_nursery_export_data();

        $nursery_types = array();
        $insurances = array();
        $benefits = array();
        $images = array();

        foreach ($image as $key => $value) {
            $images[$key][$value['nursery_id']] = $value['name'];
            $nursery_id[] = $value['nursery_id'];
        }

        if (!empty($nursery_id)) {
            $image = array_map(function($id) use($images){
                return array('nursery_id' => $id, 'name' => array_unique(array_column($images, (int) $id)));
            }, array_unique($nursery_id));
        }

        unset($images);
        foreach ($image as $value) {
            $images[$value['nursery_id']] = $value['name'];
        }


        foreach ($nursery_type as $key => $value) {
            $nursery_types[$key][$value['nursery_id']] = $value['nursery_type'];
            $nursery_id[] = $value['nursery_id'];
        }

        if (!empty($nursery_id)) {
            $nursery_type = array_map(function($id) use($nursery_types){
                return array('nursery_id' => $id, 'nursery_type' => array_unique(array_column($nursery_types, (int) $id)));
            }, array_unique($nursery_id));
        }

        unset($nursery_types);
        foreach ($nursery_type as $value) {
            $nursery_types[$value['nursery_id']] = implode(' ', $value['nursery_type']);
        }

        foreach ($insurance as $key => $value) {
            $insurances[$key][$value['nursery_id']] = $value['insurance'];
            $nursery_id[] = $value['nursery_id'];
        }

        if (!empty($nursery_id)) {
            $insurance = array_map(function($id) use($insurances){
                return array('nursery_id' => $id, 'insurance' => array_unique(array_column($insurances, (int) $id)));
            }, array_unique($nursery_id));
        }

        unset($insurances);
        foreach ($insurance as $value) {
            $insurances[$value['nursery_id']] = implode(' ', $value['insurance']);
        }

        foreach ($benefit as $key => $value) {
            $benefits[$key][$value['nursery_id']] = $value['benefit'];
            $nursery_id[] = $value['nursery_id'];
        }

        if (!empty($nursery_id)) {
            $benefit = array_map(function($id) use($benefits){
                return array('nursery_id' => $id, 'benefit' => array_unique(array_column($benefits, (int) $id)));
            }, array_unique($nursery_id));
        }

        unset($benefits);
        foreach ($benefit as $value) {
            $benefits[$value['nursery_id']] = implode(' ', $value['benefit']);
        }

        foreach ($export_results as &$result) {
            $key = $result['nursery_id'];
            $result['address'] = $result['province'] . $result['city'] . $result['address'];
            $result['nursery_type'] = isset($nursery_types[$key]) ? $nursery_types[$key] : null;
            $result['insurance'] = isset($insurances[$key]) ? $insurances[$key] : null;
            $result['benefit'] = isset($benefits[$key]) ? $benefits[$key] : null;
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

        $this->load->model('Service_export_file');
        return $this->Service_export_file->export($headers, $export_results, $format);
    }


    public function get_client_by_job_id($job_id){
       $this->load->model("Logic_client");
       $param = [
           'job_id' => $job_id,
       ];
       $result = $this->Logic_client->get_client_by_job_id($param);
       return $result;
    }

    public function count_active_client($search_param){
	$this->load->model('Service_job');
	if(empty($search_param)){
            return 0;
        }
        $search_param['select'] = 'count(DISTINCT(`c`.`client_id`)) AS `count_client`';
        $param  = $this->Service_job->_get_search_condition($search_param);
        if(empty($param)){
            return 0;
        }

        $record = $this->Logic_client->count_active_client($param);

        if($record[0]['count_client']){
            return $record[0]['count_client'];
        }else{
            return 0;
        }
    }

    public function delete($client_id){
        if(empty($client_id)){
            return false;
        }
        $this->load->model('Logic_client');
        $result = $this->Logic_client->delete($client_id);
        if(!empty($result)){
            return true;
        }else{
            return false;
        }
    }

}
