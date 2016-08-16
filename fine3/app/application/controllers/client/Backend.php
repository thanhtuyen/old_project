<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once ('Client_abstract.php');

class Backend extends Client_abstract
{

    public function __construct() {
        parent::__construct();
        if(!$this->_is_client_login() && strpos($this->uri->uri_string,"client/login") === false)redirect($this->config->config["base_url"]."client/login");
        $this->load->helper(['form', 'url','apply']);
    }

    /*
    this is logined page
    */
    public function index() {

        //1. check login or not
        //2. get client info
        //3. show it
    //[C_1]
    
        //login check
        $client_id = $this->_get_client_id();
        if($client_id === false){
            redirect(base_url().'client/');
        }
        $this->load->helper('display');
        $this->load->model('Service_client');
        $data = $this->Service_client->chk_applied($client_id);
        $this->smarty->assign('data',$data);
        $this->smarty->display("pc/client/backend/index.html");
    }


    // /**
    //  * TODO:: Wait for view
    //  * @author Thanh
    //  * @since 15/04/14
    //  */
    // public function contact() {
    //        /**
    //         * 1. Load data from the contact form
    //         * 2. validate form
    //         * 3. load service
    //         * 4. Create contact
    //         * 5. show message
    //         *
    //         */

    //     $this->load->library('form_validation');
    //     $this->form_validation->set_rules('content', 'required');
    //     if ($this->form_validation->run() == FALSE)
    //     {
    //       //TODO:: replace with new view
    //        $this->load->view("/thanh_test/contact.html", ['message' =>'']);
    //     }
    //     else
    //     {

    //         $content = $this->input->post('content');

    //         dump($content, 'true'); exit;

    //         $this->load->model('service_contact');
    //         $data['content'] = $content;

    //         $result = $this->service_contact->client_contact($data);

    //         if($result){
    //             //TODO:: replace with new view - success
    //             $this->load->view("/thanh_test/contact.html", ['message' => 'Success']);
    //         }else{
    //             //TODO:: replace with new view - fails
    //             $this->load->view("/thanh_test/contact.html", ['message' => 'Success']);
    //         }
    //     }

    // }
}
