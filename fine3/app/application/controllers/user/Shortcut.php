<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// require_once 'User_abstract.php';

// class Shortcut extends User_abstract
class Shortcut extends MY_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Service_account');
        $this->load->model('Service_user');
    }

    /*
    this page is from 3 job mail batch
    mail batch has some URL , when user click that URL ,this action will wrok
    */
    public function login() {
       // 1. get email
       // 2. $this->Service_account->is_valid_email($param)
       //    please look valid status of user
       // 3. $this->Service_account->shortcut_login($param)
       //    if user is valid, user login , invalid ,redirect to top page
       // 4. redirect to job datail that email send. 
      $param = $this->input->get();
      $reslut = $this->Service_account->valid_token($param);
      if(!empty($reslut)){
            $session["user_id"] = $reslut['user_id'];
            $session["login"] = true;
            $this->session->set_userdata(array("user_data"=>$session));
            $this->Service_user->finish_registration_email($reslut['user_id']);
            redirect($this->config->config["base_url"].'detail_'.$param['job_id']);
      }else{
	    //tdk
        $tdk_array['title'] = 'FINE!ログイン｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = 'FINE!ログインのページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

            $this->smarty->display($this->template_path()."/user/account/login.html");
      }
    }


}
