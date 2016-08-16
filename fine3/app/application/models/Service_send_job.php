<?php
Class Service_send_job extends MY_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Logic_send_job");
    }
     /**
    *change send_job.status by  $CI->db->trans_begin() ... to send email
    */
    public function send_three_mail()
    {
        $CI   = &get_instance();
        $users = $this->Logic_send_job->get_threemail_users();
        foreach ($users as $user_id) {
            $data = $this->Logic_send_job->select_threemail_data(['user_id' => $user_id]);
            $this->Logic_send_job
                ->update_status(['user_id' => $user_id, 'where' => 0, 'status'=>2]);
            $CI->db->trans_begin();
            $this->Logic_send_job
                ->update_status(['user_id' => $user_id, 'where' => 2, 'status'=>1]);
            $send_email = true;
            if(!empty($data)){
                $send_email = $this->send($data);
            }
            if($CI->db->trans_status() === false){
                $CI->db->trans_rollback();
                $this->Logic_send_job
                    ->update_status(['user_id' => $user_id, 'where' => 2, 'status'=>0]);
                throw new Exception('update status fail');
            }elseif($send_email == false){
                $CI->db->trans_rollback();
                $this->Logic_send_job
                    ->update_status(['user_id' => $user_id, 'where' => 2, 'status'=>0]);
                throw new Exception('send email fail');
            }else{
                $CI->db->trans_commit();
            }
        }
    }

    public function send($data) 
    {
        $this->load->model('Service_email');
        $param = $this->make_email_params($data);
        return $this->Service_email->send_three_mail_2user($param);
    }
    /**
    *@param Array $data
    *@return Array 
    */
    public function make_email_params($data)
    {
        $email_body = "----------------------------------------"."\r\n";
        $i = 0;
        foreach ($data as $key => $value) {
            $i+=1;
            if ($i >= 4) {
                continue;
            }
            $base_url =  $this->config->config["base_url"];        
            $url = $base_url.'mail/login?token='.$value['token'].'&job_id='.$value['job_id'];
            $email_body .= "\r\n".($key + 1).$value['title']."\r\n"
            ."\r\n"."\r\n". $url. "\r\n"."\r\n".
            "｜最寄り駅：".$value["station_name"]."\r\n".
            "｜給与：".$value["salary"]."\r\n".
            "｜募集職種：".$value["occupation"]."\r\n"."\r\n".
            "----------------------------------------" ;
            $user_email = $value['email'];
        }
        return array('to' => $user_email, 'email_body'=>$email_body);
    }

    // for generate URL
    public function is_exist_same_secret($md5_after){
	$result = $this->Logic_send_job->is_exist_same_secret($md5_after);
	return $result;
    }

    public function update_old_expired($param,$md5){
	$result = $this->Logic_send_job->update_old_expired($md5);
	$url = base_url().'rd?t='.$md5;
	return $url;
    }

    public function generate_url($param,$md5){
	$url = base_url().'rd?t='.$md5;

/*
        if((!is_null($param['utm_source']))&&(!is_null($param['utm_medium']))&&(!is_null($param['utm_campaign']))){
            $url .= "&utm_source=".$param['utm_source'];
            $url .= "&utm_medium=".$param['utm_medium'];
            $url .= "&utm_campaign=".$param['utm_campaign'];
        }
*/

        //set auth table
        $regist = date('Y-m-d H:m:s');
        $insert = array('user_id'     => $param['user_id'],
                          'send_status'         => 3,
                          'job_id'       => $param['job_id'],
                          'secret' => $md5,
                          'expired' => date('Y-m-d',mktime(0, 0, 0, date("m")+1,date("d"),date("Y"))).' 00:00:00',
                          'created' => date('Y-m-d H:m:s'));

        $this->Logic_send_job->insert_url_generation($insert);
        //create user to authURL
	return $url;
    }

    public function get_token_data($token){
	$data = $this->Logic_send_job->get_token_data($token);
	return $data;
    }

}
