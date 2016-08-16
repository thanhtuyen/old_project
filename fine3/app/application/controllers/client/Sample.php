<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campaign extends User_abstract
{
    public function __construct() {
        echo "hello hello";
        //parent::__construct();
        exit;
    }

    /*
    now you dont need make this page .
    */
    public function index() {
    }


    /*
    this page is proto_a. just be showed.
    */
    public function proto_a() {
        //$this->smarty->display('');
    }

    /*
    this page is proto_b. just be showed.
    */
    public function proto_b() {
        //$this->smarty->display('');
    }

    /*
    this page is proto_a. just be showed.
    */
    public function proto_c() {
        //1. please insert to analyzetable  user access data like HV_LP
        //$this->Service_analyze->insert_accessdata(); 

        //$this->smarty->display('');
    }
    /*
    this page is confirm screen.
    */
    public function confirm() {
        //get user data from proto screen
        //$this->smarty->display('');
    }


    /*
    this page is proto_a. just be showed.
    */
    public function register() {
        //1. get access info like HV_LP (completely same)
        //2. get info of user's form
        //3. $this->Service_account->register_account($param)
        //4. send email for register
        //5. rediect complete page
    }

    /*
    this page is complete page.
    */
    public function complete() {
        //$this->smarty->display('');
    } 

}
