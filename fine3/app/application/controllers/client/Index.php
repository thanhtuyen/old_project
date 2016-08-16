<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'Client_abstract.php';

class Index extends Client_abstract
{
    public function __construct() {
        parent::__construct();
        if(!$this->_is_client_login())redirect($this->config->config["base_url"]."client/login");
    }

    /*
    this is just redirect to login function
    */
    public function index() {
        redirect($this->config->config["base_url"]."client/backend");
    //if client login , please go to backend controller index action
    //if client not login  redirect login action
    }
}
