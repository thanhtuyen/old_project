<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'Admin_abstract.php';
Class Report extends Admin_abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Service_analyze');
    }

    public function index(){
	$this->smarty->display($this->template_path()."/report/user.tpl");	
    }

    public function client(){
	$this->smarty->display($this->template_path()."/report/client.tpl");
    }

}
