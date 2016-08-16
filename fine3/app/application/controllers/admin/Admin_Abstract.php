<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Abstract extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if(strpos($_SERVER['REQUEST_URI'],"admin/session/create") === false && strpos($_SERVER['HTTP_HOST'],"local") === false && strpos($_SERVER['REQUEST_URI'],"manager/session") === false && !$this->_is_admin_login()){
            redirect($this->config->config["base_url"].'manager/session');
        }

        /*
         if ($_SERVER['HTTP_HOST'] != 'local.fine.me') {
         $this->require_account_signed_in();
         }
         */

        //service
        $this->load->model('Service_job');
        $this->load->model('Service_nursery');
        $this->load->model('Service_client');
        $this->load->model('Service_tag');
        $this->load->model('Service_area');
        $this->load->model('Service_image');

        $this->load->helper('admin');
        $this->load->helper('image');

    }

    protected  function _get_admin_session(){
        if(empty($this->session)){
            $this->load->library('session');
        }
        $admin_session = $this->session->userdata("admin_data");

        if(empty($admin_session)){
            return false;
        }
        return $admin_session;
    }

    /**
     * checking admin login or not
     */
    protected function _is_admin_login(){
        $admin_session = $this->_get_admin_session();
        if(empty($admin_session["login"])){
            return false;
        }else{
            return true;
        }
    }

    protected function current_account_id()
    {
        return $this->session->userdata('account_id');
    }

    protected function is_account_signed_in()
    {
        return !empty($this->current_account_id());
    }

    protected function require_account_signed_in()
    {
        if (!$this->is_account_signed_in()) {
            redirect(base_url('manager/session'));
        }
    }

    /**
     *
     *
     * @return  array    (e.g. array('keyword' => 'test'))
     */
    protected function get_search_condition()
    {
        $condition = $this->input->get('q', TRUE);
        if (empty($condition)) {
            $condition = array();
        }

        return $condition;
    }



}
