<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'User_abstract.php';

class Password extends User_abstract
{
    public function __construct() {
        parent::__construct();
    }

    /*
    this page is for person who forgot password
    user can send email and update his password
    */
    public function index() {
        //render to screen[U_16]
        $bc_param = array('login', 'password_reset_current');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

    //tdk
        $tdk_array['title'] = 'パスワードを忘れた方｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = 'パスワードを忘れた方のページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

        $this->smarty->display($this->template_path()."/user/password/index.html");
    }

    public function forgot_execute(){

        $post = $this->input->post(null,true);
        if(empty($post["user_id"])||empty($post["user_name"])||empty($post["mail"])){
            redirect($this->config->config["base_url"]);
            exit;
        }

        $params["token_type"]  = 2;
        $params["account_id"]  = $post["user_id"];
        $params["target_type"] = 1;

        $this->load->model("Service_token");
        $regist_token = $this->Service_token->regist_token($params);

        if($regist_token === false){
            redirect($this->config->config["base_url"]."server_error");
            exit;
        }

        $mail_params["to"] = $post["mail"];
        $mail_params["url"] = $this->config->config["base_url"]."password/reset/".$regist_token;
        $mail_params["user_name"] = $post["user_name"];
        $mail_params["user_login_url"] = $this->config->config["base_url"]."login";

        $this->load->model("Service_email");
        $mail_result = $this->Service_email->reset_pass_2user($mail_params);

        if($mail_result){
            redirect($this->config->config["base_url"]."password/forgot");
        }else{
            redirect($this->config->config["base_url"]."server_error");
        }
        exit;
    }


    /*
    send email to change password
    email has URL that can change his password
    */
    public function forgot() {
        //U_17
        $bc_param = array('login', 'password_reset', 'password_reset_comp_current');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

    //tdk
        $tdk_array['title'] = 'ログインパスワードの再設定｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = 'ログインパスワードの再設定のページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

        $this->smarty->display($this->template_path()."/user/password/forgot.html");
    }

    public function reset($token){

        if($token === ""){
            redirect($this->config->config["base_url"]);
            exit;
        }

        $params["select"] = array("account_id");
        $params["where"]["token"] = $token;
        $params["where"]["token_type"] = 2;
        $params["where"]["target_type"] = 1;
        $params["where"]["status"] = 0;

        $this->load->model("Service_token");
        $token_data = $this->Service_token->get_token_list($params);

        if(empty($token_data)){
            redirect($this->config->config["base_url"]);
            exit;
        }elseif(count($token_data) > 1){
            // TODO this patern is problem
            redirect($this->config->config["base_url"]."server_error");
            exit;
        }

        $bc_param = array('login');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);


        $this->smarty->assign('user_id' , $token_data[0]["account_id"]);
        $this->smarty->assign('token' , $token);
        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

    //tdk
        $tdk_array['title'] = 'パスワード再設定｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = 'パスワード再設定のページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

        $this->smarty->display($this->template_path()."/user/password/reset.html");
    }

    public function reset_execute(){
        $post = $this->input->post(null,true);
        if(empty($post["user_id"])||empty($post["token"])||empty($post["password"])){
            redirect($this->config->config["base_url"]);
            exit;
        }

        $this->load->model("Service_user");
        $result = $this->Service_user->change_password($post["user_id"],$post["password"]);

        if($result){
            $this->load->model("Service_token");
            $token_invalid_result = $this->Service_token->defeasance_token($post["token"]);
            if($token_invalid_result){
                redirect($this->config->config["base_url"]."password/reset_complete");
            }else{
                redirect($this->config->config["base_url"]."server_error");
            }
        }else{
            redirect($this->config->config["base_url"]."server_error");
        }
        exit;
    }

    public function reset_complete() {
        //U_17
        $bc_param = array('login', 'password_reset', 'password_reset_comp_current');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

    //tdk
        $tdk_array['title'] = 'ログインパスワードの再設定完了｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = 'ログインパスワードの再設定完了のページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

        $this->smarty->display($this->template_path()."/user/password/reset_complete.html");
    }


}
