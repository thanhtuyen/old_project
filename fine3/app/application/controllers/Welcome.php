<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

    /**
     * @var Service_contact
     */
    public $service_welcome;

    public function __construct(){
        parent::__construct();
    }

    /**
     * [index welcome controller that explain this project coding rule]
     * @return [type] [description]
     */
	public function index()
	{
		//Phuong first commit
        $this->config->load('welcome_config', TRUE);//generally this config is loded in abstructor.
        $greetings = $this->config->item('welcome','welcome_config');
        echo($greetings);
	    $this->load->model('service_welcome');
		$welcome_message = $this->service_welcome->get_welcome_message();
        $this->smarty->assign('welcome_message',$welcome_message);
		$this->smarty->display('welcome.html');

	//my first commit: Pham Van Thanh

	}
	public function example(){
		echo 'Example';
	}



}
