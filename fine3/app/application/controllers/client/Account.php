<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'Client_abstract.php';

class Account extends Client_abstract
{
    public function __construct() {
        parent::__construct();
        if(!$this->_is_client_login() && strpos($this->uri->uri_string,"client/login") === false)redirect($this->config->config["base_url"]."client/login");
    }

    /*
     * [C_2]  this is login page , you just show this page
     */
    public function login($params = array()) {
        if($this->_is_client_login())redirect($this->config->config["base_url"]."client/");

        if(empty($params)){
            $params["mail"] = "";
            $params["password"] = "";
            $params["errors"]["account_not_exist"] = false;
        }
        $this->smarty->assign("params",$params);
        $this->smarty->display($this->template_path()."/client/account/login.html");
    }

    /*
     this action for login execute
     */
    public function login_execute() {

        if($this->_is_client_login())redirect($this->config->config["base_url"]."client");

        $params["check_input"] = $this->input->post();
        $params["check_column"] = array("mail","password");
        $params["redirect"] = "/";

        $post = $this->check_input($params);

        $this->load->model("Service_account");
        $result = $this->Service_account->client_login($post);
        if(empty($result)){
            $params["mail"] = $post["mail"];
            $params["password"] = $post["password"];
            $params["errors"]["account_not_exist"] = true;
            $this->login($params);
        }else{
            $this->_set_client_session($result[0]["client_id"]);
            // $this->session->set_userdata(array("client_data"=>array("client_id"=>$result[0]["client_id"])));
            redirect($this->config->config["base_url"]."client");
        }

        //1. get user form info
        //2. check this email and password and status
        //3. login and redirect client/index/index
        //   $this->Service_account->_is_client_login($param);
    }

    /**
     * logout
     */
    public function logout() {
        $this->session->set_userdata(array("client_data"=>array("client_id"=>null)));
        redirect($this->config->config["base_url"]);
    }
}
