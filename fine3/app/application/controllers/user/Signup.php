<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'User_abstract.php';

class Signup extends User_abstract
{
    public function __construct() {
        parent::__construct();
    }

    //render U_7
    public function index(){
        if(parent::is_login())redirect($this->config->config["base_url"]."mypage");
        $this->load->model("Service_area");
        $data["area"]  = $this->Service_area->get_pref_city_list();

        $this->config->load("signup");
        $age_limit = $this->config->item("signup_age_limit");
        $year = date('Y') - $age_limit["lower"];
        $count = $age_limit["upper"] - $age_limit["lower"];
        while($count >= 0){
            $data["year"][] = $year;
            --$year;
            --$count;
        }

        $this->load->model('Service_signup');
        $data["employee"] = $this->Service_signup->getTagsByGroups(array(3));
        $data["license"] = $this->Service_signup->getTagsByGroups(array(4));

        foreach($data as $assign_key => $assign_val)$this->smarty->assign($assign_key,$assign_val);

        //パンくず
        $bc_param = array('sign_up_current');
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb', $this->_bread_crumb);

    //tdk
        $tdk_array['title'] = '会員登録｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = '会員登録のページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

        $this->smarty->display($this->template_path()."/user/signup/index.html");
    }

    public function register($extend_params = array()){

        $this->config->load('input_config');

        $params["check_input"] = $this->input->post(null);
        if(!empty($extend_params)){
            $params["check_input"] = array_merge($params["check_input"],$extend_params);
        }

        $params["check_column"] = $this->config->item("input_signup_register");

        $params["redirect"] = "/";
        //area_id check
        if(empty($params['check_input']['area_id'])){
            $this->load->model('Service_area');
            $params['check_input']['area_id'] = $this->Service_area->get_area_id($params['check_input']['address_pref'],$params['check_input']['address_city']);
        }
        $post = $this->check_input($params);
        $this->load->model("Service_user");
        $result = $this->Service_user->register($post);

        if($result === false){
            redirect($base_url.'user/error/');
        }else{
            if(!empty($post['added_job_id'])&&!empty($post['added_job_type'])){
                $set_session["select_job"]["add_flg"] = true;
                $set_session["select_job"]["job_id"] = $post['added_job_id'];
                $set_session["select_job"]["type"] = $post['added_job_type'];
                $this->_set_session('common',$set_session);
            }

            $this->load->model('Service_account');
            $activation_url = $this->Service_account->getActivateUrl($result['token']);
            $this->config->load('admin', TRUE);
            $admin_mail = $this->config->item('email', 'admin');

            $params['bcc']              = $admin_mail;
            $params['mail']             = $post['mail'];
            $params['activation_url']   = $activation_url;
            $params['user_name']        = $post['name'];
            $params['password']         = $post['password'];

            $result = $this->Service_email->activation_account_2user($params);

            if($result){
                header("location: /signup/complete_signup");
            }else{
                redirect(base_url().'user/error/');
            }


        }
    }

    public function lp_register(){
        $this->load->model('Service_account');
        $data['password'] = $this->Service_account->getRandomPassword();
        $data["channel"] = 'proto_a';
        $this->register($data);
    }

    public function mail_confirm($token)
    {
        if(empty($token)) redirect(base_url()."/");

        $this->load->model("Service_user");
        $user_id = $this->Service_user->check_unfinished_registration_user($token);
        if($user_id === false){
            redirect("/");
            exit;
        }

        $result = $this->Service_user->finish_user_registration(array("user_id"=>$user_id));


        $select_job = $this->_get_session('common','select_job');

        if(!empty($select_job['add_flg'])&&$select_job['add_flg']){
            $this->load->model("Service_job");

            $apply_result = $this->Service_job->apply_via_session($user_id,$select_job);
            if($apply_result){
                $this->_remove_session('common',array('select_job'=>''));

                $type_symbol = $select_job['type'] === 'apply' ? 'a' : 'b';

                redirect($this->config->config["base_url"]."complete_apply/s/".$type_symbol."/".$select_job['job_id']);
            }
        }

        $this->_remove_session('common',array('select_job'=>''));
        //--
        redirect($this->config->config["base_url"]."signup/complete");

    }



    //[U_9]
    public function complete() {

        //パンくず
        $bc_param = array('sign_up', 'sign_up_complete_current');
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

    //tdk
        $tdk_array['title'] = '会員登録完了｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = '会員登録完了のページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

        $this->smarty->display($this->template_path()."/user/signup/complete.html");
    }

    public function complete_signup() {
        //パンくず
        $bc_param = array('sign_up', 'sign_up_complete_current');
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

    //tdk
        $tdk_array['title'] = '仮登録完了｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = '仮登録完了のページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

        $this->smarty->display($this->template_path()."/user/signup/complete_signup.html");
    }

//This page is for after apply and signup at once
    public function complete_jobsignup() {
        //[U_19]
        $bc_param = array('sign_up', 'sign_up_complete_current');
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

    //tdk
        $tdk_array['title'] = '応募完了｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = '応募完了のページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

        $this->smarty->display($this->template_path()."/user/signup/complete_jobsignup.html");
    }

    public function bookmark(){
        $this->smarty->assign('bookmark_flg',true);
        $this->apply();
    }

    // guest apply and sign up at same time
    public function apply() {
    //U_11
        $job_id = $this->check_input(array("check_column"=>$this->input->post(null,true),"check_column"=>array("job_id")));

        if(empty($job_id)){
            $session = $this->_get_session("common","select_job");
            if(empty($session))show_404();
        }

        $this->load->model("Service_job");
        $select_job = $this->Service_job->get_detail_info(array("job_id"=>$session['job_id']));

        if($select_job === false)show_404();

        $this->load->model("Service_area");
        $data["area"]  = $this->Service_area->get_pref_city_list();

        $this->config->load("signup");
        $age_limit = $this->config->item("signup_age_limit");
        $year = date('Y') - $age_limit["lower"];
        $count = $age_limit["upper"] - $age_limit["lower"];
        while($count >= 0){
            $data["year"][] = $year;
            --$year;
            --$count;
        }

        $this->load->model('Service_signup');
        $data["employee"] = $this->Service_signup->getTagsByGroups(array(3));
        $data["license"] = $this->Service_signup->getTagsByGroups(array(4));

        foreach($data as $assign_key => $assign_val)$this->smarty->assign($assign_key,$assign_val);

        //パンくず
        $bc_param = array('sign_up_apply', 'job_sign_up_current');
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);
        $this->smarty->assign('breadcrumb', $this->_bread_crumb);

        $this->smarty->assign("select_job",$select_job);
        $select_job_id = $select_job['job_detail']['job']['job_id'];
        $select_area_id = $select_job['nursery_detail']['area_id'];
        if((!empty($select_job_id))&&(!empty($select_area_id))){
            $related_list = $this->Service_job->get_related_area_list($select_area_id, $select_job_id,4);
        }else{
            $related_list = false;
        }
        $this->smarty->assign("related_list",$related_list);
        $this->load->helper("image_helper");

    //tdk
        $tdk_array['title'] = $select_job["job_detail"]["job"]["title"].'への応募｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = $select_job["job_detail"]["job"]["title"].'へのouboのページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

        $this->smarty->display($this->template_path()."/user/signup/apply.html");
    }


}
