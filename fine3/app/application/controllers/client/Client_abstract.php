<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client_abstract extends MY_Controller{

    protected $_account_type;

    public function __construct() {
        parent::__construct();
        //type
        $this->_account_type = $this->_get_client_type();
        $this->smarty->assign('account_type',$this->_account_type);
        if($this->check_pc() === 0){
            redirect($this->config->config["base_url"]."errors/sp");
            exit;
        }

        if(strpos($_SERVER['REQUEST_URI'],"client/login") === false && $this->_is_client_login()){
            //client name for header
            $session = $this->session->userdata("client_data");
            if(!empty($session['data']['client_name'])){
                $client_name = $session['data']['client_name'];
                $this->smarty->assign('client_name',$client_name);
            }else{
                $this->smarty->assign('client_name','採用ご担当者様');
            } 
        }else{
            $this->smarty->assign('client_name','採用ご担当者様');
        }

    }
    /** get client_id.
    @return client_id or false(is not logged in yet) */
    public  function _get_client_id(){
        $user_session = $this->session->userdata("client_data");
        $client_id = empty($user_session["client_id"]) ? false : $user_session["client_id"];
        return $client_id;
    }

    protected function _is_client_login(){
        $session = $this->session->userdata("client_data");
        if(!empty($session["client_id"]) && is_numeric($session["client_id"])){
            return true;
        }else{
            return false;
        }
    }
    /**
     * set client sesssion as client_id
     * return bool
     *
     */
    protected function _set_client_session($client_id){
        $client_data['client_id'] = $client_id;
        $client_data['data']['client_name'] = $this->Service_client->get_client_name($client_id);
        $client_data['login'] = true;
        $ret = $this->session->set_userdata('client_data', $client_data);
        return $ret;
    }
    protected function _get_client_type(){
        $user_session = $this->session->userdata("client_data");
        $client_id = empty($user_session["client_id"]) ? false : $user_session["client_id"];
        if(empty($client_id)){
            return false;
        }
        $this->load->model('Service_client');
        $type = $this->Service_client->get_client_type($client_id);
        return $type;
    }
}
?>
