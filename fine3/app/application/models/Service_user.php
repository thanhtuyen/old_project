<?php
Class Service_user extends MY_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Logic_user");
    }
    public function get_user_related_tag($user_id){
        $this->load->model('Service_tag');
        $tag_param['id']            = $user_id;
        $tag_param['type']          = $this->config->item('type_relation_user','tag_config');
        $tag_param['delete_flg']    = $this->config->item('not_deleted','common_config');
        $tags = $this->Service_tag->get_list($tag_param);

        $job_tag_category = $this->config->item('type_employ','tag_config');
        $license_tag_category = $this->config->item('tag_license','tag_config');
        $result = array();
        if(!empty($tags)){
            foreach($tags as $tag){
                if(($tag["tag_detail"]["tag_group_id"] == $job_tag_category)){
                    $result["employee"][$tag["tag_detail"]["tag_id"]] = $tag["tag_detail"]["name"];
                }elseif($tag["tag_detail"]["tag_group_id"] == $license_tag_category){
                    $result["license"][$tag["tag_detail"]["tag_id"]] = $tag["tag_detail"]["name"];
                }
            }
        }
        return $result;
    }
    /**
     * get jobs which were applied by user
     *
     * @param   integer  $user_id
     *
     * @return  array
     */
    public function get_applyed_job($user_id, $perpage, $curpage)
    {
        /*
○。 ゜　　 ｏ
　　／￣￣＼　
 。  /  __  __  ﾍ ゜
　｜彡(人)ミ｜　　
゜ ｜　　　　｜ｏ
 ／　　　　　＼     GET JOBS WERE APPLIED BY ME
  (_ﾉ　　　　 ヽ_)
　|　　　　　|　
　|　　　　　|゜
ｏ ヽ　 ・　 ノ　
　　＼　　／ ○
 ゜　 ｜Ｙ｜。　
　○。 ｿ人ﾂ　ｏ　
。　　　　○　　
　 ゜　 ゜
         */

        $result = $this->Logic_user->getAppliedJob($user_id, $perpage, $curpage);

        return $result;
    }

    public function get_user_data($params){
        $record = $this->Logic_user->get_detail($params);
        if(!empty($record[0]["area_id"])){
            $this->load->model("Service_area");
            $record[0]["area"] = $this->Service_area->get_area_name($record[0]["area_id"]);
        }

        return $record;
    }

    /**
     * get user detail
     *
     * @param integer $user_id
     *
     * @return array|boolean
     */
    public function getDetail($user_id, $status, $delete_flg)
    {
        $data = $this->Logic_user->getDetail($user_id, $status, $delete_flg);

        return $data;
    }

    /**
     * get admin side users list
    *@return Array
    *meaning select all recommed users
    */
    public function get_3job_mail_target()
    {
        $users = $this->Logic_user->get_3job_mail_target();
        if(empty($users)){
            $users = array();
        }
        return $users;
    }



    /* get admin users list
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
            'license' => $this->config->item('tag_license','tag_config'),
            'relation_type' => $this->config->item('type_relation_user','tag_config'),
        );

        $users = $this->Logic_user->get_list($condition, $param);
        $user_id = array_column($users, 'user_id');
        $license_result = $this->Logic_user->get_user_license($param, $user_id);

        // $licenses = array();
        // foreach ($license_result as $key => $license) {
        //     if (is_null($license['license'])) {
        //         unset($license_result[$key]);
        //     }
        // }

        // foreach ($license_result as $key => $value) {
        //     $licenses[$key][$value['user_id']] = $value['license'];
        //     $user_id[] = $value['user_id'];
        // }

        // if (!empty($user_id)) {
        //     $license_result = array_map(function($id) use($licenses){
        //         return array('user_id' => $id, 'license' => array_column($licenses, (int) $id));
        //     }, array_unique($user_id));
        // }


        // foreach ($license_result as $value) {
        //     $licenses[$value['user_id']] = implode(' ', $value['license']);
        // }

        // foreach ($users as &$user) {
        //     $user['license'] = isset($licenses[$user['user_id']]) ? $licenses[$user['user_id']] : null;
        // }


        // unset($user);
        // unset($user);


        return $users;
    }
    /**
     * get user total count
     * @param  [string] $condition
     * @return [int]
     */
    public function get_total_count($condition)
    {
        return $this->Logic_user->get_total_count($condition);
    }
    /**
     * [get admin side user detail
     * @param  [string] $id = user_id
     * @return [array]
     */
    public function get_admin_user_detail($id)
    {
        $param = array(
            'user_id' => $id,
            'delete_flg' => $this->config->item('not_deleted','common_config')
        );
        $this->load->model("Service_tag");
        $tag_config = $this->config->item('tag_config');
        $tag_param   = array(
            'id'         =>  $id,
            'type'       =>  $tag_config['type_relation_user'],
            'delete_flg' =>  $this->config->item('not_deleted','common_config'),
        );
        $tag = $this->Service_tag->get_list($tag_param);

        $user_detail = $this->Logic_user->get_admin_user_detail($param);
        $tag_license = array();
        $user_detail['type_employ'] = '';

        foreach ($tag as $key => $value) {
            if ($value['tag_detail']['tag_group_id'] == $tag_config['tag_license']) { //資格
                $tag_license[] = $value['tag_detail']['name'];
            }
            if ($value['tag_detail']['tag_group_id'] == $tag_config['type_employ']) { //雇用形態
                $user_detail['type_employ'] = $value['tag_detail']['name'];
            }
        }
        $user_detail['tag_license'] = join('、',$tag_license);

        return $user_detail;
    }

    public function delete_flg($id)
    {
        $param = array(
            'user_id' => $id,
            'delete_flg' => $this->config->item('deleted','common_config')
        );
        return $this->Logic_user->delete_flg($param);
    }
    /**
     * [export file ]
     * @param  [string] $format e.g csv
     * @return [string]       filepath
     */
    public function export_file($format)
    {
        $this->load->helper('user');
        $headers = $this->config->item('user','export_column_config');
        $export_results = $this->Logic_user->get_export_data();
        $fn = function($result) {
            $result['address'] = $result['province'] . $result['city'] . $result['address'];
            $result['gender'] = gender_text($result['gender']);
            $result['status'] = status_text($result['status']);
            $result['delete_flg'] = delete_text($result['delete_flg']);
            $result['checked'] = checked_text($result['checked']);
            $result['birthdate'] = date('Y') - date('Y', strtotime($result['birthdate']));
            return $result;
        };
        $export_results = array_map($fn, $export_results);

        $this->load->model('Service_export_file');
        return $this->Service_export_file->export($headers, $export_results, $format);
    }

    /**
     *
     * @param unknown $params
     * @return string|boolean
     */
    public function register($params){

        $this->config->load("area_config");

        $prefecture = $this->config->item("area_prefecture");

        $insert["area_id"] = $params["area_id"];
        $insert["mail"] = $params["mail"];
        $insert["password"] = md5($params["password"]);
        $insert["name"] = $params["name"];
        $insert["name_kana"] = $params["kana"];
        $insert["gender"] = $params["gender"];
        $insert["address"] = $params["address_detail"];
        $insert["phone"] = $params["tel"];
        $insert["birthdate"] = $params["birth_year"]."-".$params["birth_month"]."-".$params["birth_day"];
        $insert["checked"] = !empty($params["job_change_support_check"]) ? 1 : 0;
        $insert["channel"] = !empty($params["channel"]) ? $params["channel"] : '';
        $insert["created"] = date("Y-m-d H:i:s", time());
        $insert["updated"] = date("Y-m-d H:i:s", time());
        $insert["status"] = 0;
        $insert["token"] = $this->_create_token();

        if (isset($params["zip2"])){
            $insert["zip_code"] = $params["zip1"].$params["zip2"];
        }else{
            $insert["zip_code"] = $params["zip1"];
        }

        $result = $this->Logic_user->register($insert);

        if($result === false){
            return false;
        }else{


            $insert_tag_relation["tag_ids"]    = $params["license"];
            $insert_tag_relation["tag_ids"][]    = $params["employee"];
            $insert_tag_relation["account_id"] = $result;
            $insert_tag_relation["type"]       = 0;
            $this->load->model("Logic_tag_relation");
            $regist_tag_relation_result = $this->Logic_tag_relation->regist_tag_relation($insert_tag_relation);

            if($regist_tag_relation_result){
                return array("insert_user_id"=>$result,"token"=>$insert["token"]);
            }else{
                false;
            }
        }

    }

    public function update($params){

        $this->config->load("area_config");

        $prefecture = $this->config->item("area_prefecture");

        $update["area_id"] = $params["area_id"];
        $update["mail"] = $params["mail"];
        $update["name"] = $params["name"];
        $update["name_kana"] = $params["kana"];
        $update["gender"] = $params["gender"];
        $update["address"] = $params["address_detail"];
        $update["zip_code"] = $params["zip1"].$params["zip2"];
        $update["phone"] = $params["tel"];
        $update["birthdate"] = $params["birth_year"]."-".$params["birth_month"]."-".$params["birth_day"];
        $update["updated"] = date("Y-m-d H:i:s", time());

        $user_data = $this->session->userdata("user_data");

        $where["user_id"] = $user_data["user_id"];
        $where["status"] = 1;
        $where["delete_flg"] = 0;

        $update_params["value"] = $update;
        $update_params["where"] = $where;

        $result = $this->Logic_user->update_user($update_params);

        if($result === false){
            header("location: /server_error");
        }else{
            $this->load->model("Logic_tag_relation");
            $delete_tag_result = $this->Logic_tag_relation->delete_tag_relation($user_data["user_id"],0);
            if($delete_tag_result){

                $tag_ids[] = $params["employee"];

                foreach($params["license"] as $license_val){
                    $tag_ids[] = $license_val;
                }

                $tag_params["tag_ids"] = $tag_ids;
                $tag_params["account_id"] = $user_data["user_id"];
                $tag_params["type"] = 0;

                $result = $this->Logic_tag_relation->regist_tag_relation($tag_params);

            }else{
                header("location: /server_error");
            }
        }
        return $result;
    }


    /**
     * check user unfinished registration by token
     * @param String $token
     * @return boolean | int: user_id
     */
    public function check_unfinished_registration_user($token){
        $result = $this->Logic_user->get_unfinished_registration_user(array("token"=>$token));

        if(empty($result)){
            return false;
        }else{
            return $result[0]["user_id"];
        }
    }

    /**
     * update user record the state of finish register
     */
    public function finish_user_registration($user_id){
        return $this->Logic_user->finish_user_registration($user_id);

    }
    public function finish_registration_email($user_id){
        $params['user_id'] = $user_id;
        return $this->Logic_user->finish_registration_email($params);
    }

    /**
     * activate new acount
     *
     * @param string $token
     *
     * @return array New account info
     */
    public function activate($token)
    {
        return $this->Logic_user->activate($token);
    }

    /**
     * check account is exists
     *
     * @param array $params  [email, password]
     *
     * @return boolean
     */
    public function check_user_account($params){

        $result = $this->Logic_user->check_exist_user_data($params);

        if(empty($result)){
            return false;
        }else{
            return $result[0]["user_id"];
        }
    }

    public function get_user_name($user_id){
        $params["select"] = array("name");
        $params["where"]["user_id"] = $user_id;
        $params["where"]["status"] = 1;
        $params["where"]["delete_flg"] = 0;
        $result = $this->Logic_user->get_detail($params);
        if(empty($result[0]["name"])){
            //delete by liurh
            //return FALSE;
            //delete by liurh
            if(empty($result[0])){
                return FALSE;
            }
            return $result[0]["user_id"];
            //because maybe someone have not name in db
        }else{
            return $result[0]["name"];
        }
    }

    private function _create_token(){
        $token_list = $this->Logic_user->get_token_list();
        do{
            $same_token = false;
            $tmp_token =  bin2hex(openssl_random_pseudo_bytes(32));
            /*if($type = 0){
                $tmp_token =  bin2hex(openssl_random_pseudo_bytes($length));
            }else{
                $tmp_token =  md5(rand($length));
            }*/
            foreach($token_list as $val){
                if($val["token"] === $tmp_token) $same_token = true;
            }
        }while($same_token);


        return $tmp_token;
    }
    /**
     * Change password user and send email
     * @param int $user_id
     * @param string $password
     * @return boolean
     * @since 2015/05/05
     */
    public function change_password($user_id, $password){
        $md5_pass = md5($password);

        $this->db->trans_start();

        $result = $this->Logic_user->change_password($user_id, $md5_pass);

        if($result){
            $this->db->trans_complete();
            //
            //send email
            // Get info user before send email
            $user_param["select"] = "";
            $user_param["where"]  = array('user_id'=>$user_id);
            $user_data = $this->get_user_data($user_param);

            $params = [
                'to' => $user_data[0]['mail'],
                'name' => 'user',
                'user_name' => $user_data[0]['name'],
                'password' => $password,
                'user_login_url' => $this->config->item('base_url').'login',
            ];

            $this->load->model("Service_email");
            $this->Service_email->change_pass_2user($params);
        }else{
            $this->db->trans_rollback();
        }

        return $result;
    }

    //param = user email
    public function get_userid_from_mail($param){
        $result = $this->Logic_user-> get_userid_from_mail($param);
        if(isset($result['user_id'])){
            return $result['user_id'];
        }else{
            return false;
        }
    }



    public function get_wish($user_id = null){
        if(empty($user_id)){
            return false;
        }
        $result = $this->Logic_user->get_wish($user_id);
        if(empty($result[0]['tag_id'])){
            return false;
        }else{
            return $result[0]['tag_id'];
        }
    }
}
?>
