<?php
Class Service_account extends MY_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Logic_client");

        $this->load->model("Service_email");
        $this->load->model("Logic_user");
        $this->load->model("Logic_withdrawal");
        $this->load->model("Logic_tag_relation");
    }

    /**
     * withdrawal
     *
     * @param   integer  $user_id
     * @param   array    $data     [reason[],message]
     *
     * @return  boolean
     */
    public function withdraw($user, $data)
    {
        $result = false;

        $this->db->trans_begin();

        $result = $this->Logic_withdrawal->withdrawal($user['user_id'], $data);

        if($result){
            $this->db->trans_commit();
            // send email
            $params = [
                'to' => $user['mail'],
                'user_name' => $user['name']
            ];

            $result = $this->Service_email->withdrawal_2user($params);
        }else{
            $this->db->trans_rollback();
        }

        return $result;
    }


    /**
     * register from user/campain/register
     * refer code from Service_user/register
     * refer params name from https://docs.google.com/spreadsheets/d/1LlD_ewuMVYRDZTQzwaL15lNWTNweidyb4IMsQITQdzg
     *
     * @param unknown $params
     *
     * @return boolean
     */

    public function register($params)
    {
        $result = array();

        $this->config->load("area_config");

        $insert = array();
        $insert["area_id"] = $params["city"];
        $insert["mail"] = $params["email"];
        $insert["password"] = md5($params['password']);
        $insert["name"] = $params["fullname"];
        $insert["name_kana"] = $params["name"];
        $insert["gender"] = $params["gender"];
        $insert["address"] = $params["address_detail"];
        $insert["zip_code"] = $params["zip1"].$params["zip2"];
        $insert["phone"] = $params["phone"];
        $insert["birthdate"] = $params["year"]."-".$params["month"]."-".$params["day"];
        $insert["checked"] = !empty($params["checked"]) ? 1 : 0;
        $insert["created"] = date("Y-m-d H:i:s", time());
        $insert["token"] = $this->createToken();

        $insert["channel"] = 'proto_a';
        $insert["updated"] = date("Y-m-d H:i:s", time());
        $insert["status"] = 0;
        $insert["delete_flg"] = 0;

        $user_id = $this->Logic_user->register($insert);

        if ($user_id > 0){
            $result = [
                'user_id' => $user_id,
                'token' => $insert["token"]
            ];
        }

        return $result;

    }

    /**
     * save all tags relation user
     *
     * @param   integer  $user_id
     * @param   array    $params
     *
     * @return  boolean
     */
    public function saveTags($user_id, $params){

        $tags = array(
            $params['jobtype'],
        );

        foreach ((array)$params['certifications'] as $value){
            $tags[] = $value;
        }

        $result = $this->Logic_tag_relation->saveTagRelationUser($user_id, $tags);

        return $result;
    }

    /**
     * generate new random password
     *
     * @return string
     */
    public function getRandomPassword($length = 6)
    {
        return substr(md5(time()), 0,$length);
    }

    /**
     * check account is exists
     *
     * @param string $email
     *
     * @return boolean
     */
    public function check_user_account($email)
    {
        return $this->Logic_user->isExists($email);
    }


    private function createToken(){
        $token_list = $this->Logic_user->get_token_list();

        do{
            $same_token = false;
            $tmp_token =  bin2hex(openssl_random_pseudo_bytes(32));
            foreach($token_list as $val){
                if($val["token"] === $tmp_token) $same_token = true;
            }
        }while($same_token);

        return $tmp_token;
    }

    public function getActivateUrl($token)
    {
        return $this->config->config["base_url"]."signup/mail_confirm/".$token;
    }

    public function valid_token($param){
        $token = $param['token'];
        if(empty($token)){
            return NULL;
        }else{
            return $this->Logic_user->valid_token($token);
        }
    }

    public function client_login($params){

        $sql_params["mail"] = $params["mail"];
        $sql_params["password"] = md5($params["password"]);

        return $this->Logic_client->get_mailpass($sql_params);
    }

    //for generated URL in admin side
    public function call_job_url($get){
    $store = $this->db
  ->select('*')
  ->where(array('secure_code' =>$data['t'],
                'status'      =>0))
  ->get('send_auth_log')
  ->row_array();
  if($store['url']){

    //if active parameter
    if(is_null($store['first_click'])){
      //click time regist
      $update = array('first_click' =>  date('Y-m-d H:m:s'),
                      'click'       =>  $store['click'] + 1);
    }else{
      //only count regist
      $update = array('click'       =>  $store['click'] + 1);
    }
    $this->db
         ->where(array('secure_code' =>$data['t'],
                       'status'      =>0))
         ->update('send_auth_log',$update);
        return $store['url'];
  }else{
    //not active, redirect to job detail page with no utm param and no login
    switch (ENVIRONMENT) {
    case 'development':
        $url =  "http://test.fine-navi.job-maker.jp/";
        break;
    case 'testing':
        $url =  "http://test.fine-navi.job-maker.jp/";
        break;
    default:
        $url =  "http://fine-navi.jp/";
        break;
    }
    if(!empty($data['j'])){
      $url .= 'kyujin/'.$data['j'];
      return $url;
    }
  }
    }
}
