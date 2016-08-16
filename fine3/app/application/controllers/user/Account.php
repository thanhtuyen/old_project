<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'User_abstract.php';

class Account extends User_abstract
{
    public function __construct() {
        parent::__construct();
    }

    /**
     * this is login page
     * render U_15
     */
    public function login(){
        if(parent::is_login())redirect($this->config->config["base_url"]."mypage");

        $bc_param = array('login_current');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign("login_page",true);
        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

        if($this->input->get('aj') === '1'){
            $this->smarty->assign('add_job_flg' , 1);
        }

    //tdk
    $tdk_array['title'] = 'ログイン｜保育士の求人・転職・募集ならFINE!';
    $tdk_array['description'] = 'ログインのページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
    $this->smarty->assign('tdk_array',$tdk_array);

        $this->smarty->display($this->template_path()."/user/account/login.html");
    }

    /**
     * this action is execute login function
     */
    public function login_exe(){
        $params["check_input"] = $this->input->post(null,true);
        $params["check_column"] = array("mail","password","user_id");
        $params["redirect"] = "/";
        $post = $this->check_input($params);

        $set_session['user_id'] = $post['user_id'];
        $set_session['login']   = true;
        $this->_set_session('user_data',$set_session);

        $common_session = $this->_get_session('common');

        if(!empty($post['add_job_flg'])&&$post['add_job_flg']==1&&!empty($common_session['select_job'])){
            $this->load->model('Service_job');
            $apply_result = $this->Service_job->apply_via_session($post['user_id'],$common_session['select_job']);
            if($apply_result){
                $this->_remove_session('common',array('select_job'=>''));
                $type_symbol = $common_session['select_job']['type'] === 'apply' ? 'a' : 'b';
                redirect($this->config->config['base_url'].'complete_apply/j/'.$type_symbol.'/'.$common_session['select_job']['job_id']);
            }
        }

        $this->_remove_session('common',array('select_job'=>''));
        if(empty($common_session['backurl'])){
            redirect($this->config->config['base_url'].'mypage');
        }else{
            $backurl = $session['common']['backurl'];
            $this->_remove_session('common',array('backurl'=>''));
            redirect($backurl);
        }
    }

    public function logout(){
        $this->session->set_userdata(array('user_data'=>array("login"=>false)));
        redirect($this->config->config["base_url"]);
    }

    //for generated URL in admin side
    public function rd(){
    $token = $this->input->get('t');
    $utm_param = '?utm_source=finedb&utm_medium=email&utm_campaign=realmatch';
    $base = base_url();
    if(isset($token)){
        $this->load->model('Service_send_job');
        $data = $this->Service_send_job->get_token_data($token);

        if(isset($data[0]['job_id'])){
        //ログイン処理
        $user_id = $data[0]['user_id'];
        //this require
        $this->_set_user_session($user_id);
        //求人票詳細を表示
        $job_url = 'detail_'.$data[0]['job_id'].$utm_param;
        redirect($base.$job_url);
        }
    }
    redirect($this->config->config["base_url"]);
    }

    public function test_session_display(){
        $session = $this->_get_session();

        echo"<pre>";var_dump( $session );
    }
}
