<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'Admin_Abstract.php';
Class Mail extends Admin_Abstract
{
/*
 * This controller is for "create info mail", "detail info mail", "info mail index"
 */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Service_contact');
    }

    public function index(){
	$this->load->model('Service_admin_pagerfanta');
        $condition = $this->get_search_condition();

	$this->config->load('contact_config');
	$condition['type'] = array($this->config->item('info_user'),
                   $this->config->item('info_employer'),
                   $this->config->item('info_agency')
                );

        $total = $this->Service_contact->get_total_count($condition);
        $pager_data = $this->Service_admin_pagerfanta->get_data($total);
        $result = $this->Service_contact->get_list_of_info($condition, $pager_data);

        unset($condition['type']);
        $this->smarty->assign('start', $pager_data['start']);
        $this->smarty->assign('end', $pager_data['end']);
        $this->smarty->assign('total', $pager_data['total']);
        $this->smarty->assign('pagerfantaHtml', $pager_data['pagerfantaHtml']);
        $this->smarty->assign('result', $result);
        $this->smarty->assign('condition', $condition);
        $this->smarty->display("pc/admin/mail/index.html");
    }

    /*
     * display create page
     */
    public function create(){

        $this->smarty->display("pc/admin/mail/create.html");
    }

    public function register_info(){
	$post = $this->input->post();

//var_dump($post);exit;
	if(isset($post)){
	    if(isset($post['title']) && isset($post['content']) && isset($post['type'])){
		$mail['subject'] = $post['title'];
		$mail['message'] = $post['content'];
//die('aaa');exit;
		$to = $this->Service_contact->set_info_to($post['type']);
		if(! isset($to)){
		    $can_send = false;
		}
//var_dump($to);exit;
		$can_send = $this->Service_contact->create_info_mail($post,$to);

		if($can_send){
//		    $to = array('joyhwc5@gmail.com','ayak826@gmail.com', 'joyhwc5@gmail.com');

		    $config = $this->config->item('email');
		    $this->load->library('email', $config);
		    $this->config->load('admin', true);
        	    $admin_config  = $this->config->item('admin');

		    foreach($to as $key => $val){
		        $this->email->subject($post['title']);
		        $this->email->message($post['content']);
		        $this->email->from($admin_config['email'], 'FINE');
		        $this->email->to($val);
		        $email[] = $this->email->send();
		    }
		    $result = true;
		}
	    }
	}else{
	    $result = false;
	}

//	return $this->create_comp($result);
//    }

    /*
     * Show result and redirect to original page
     */
//    private function create_comp($result){
	if($result){
	    $message = "infoメールを送信完了しました。";
	}else{
	    $message = "infoメールを送信できませんでした。";
	}
//var_dump($result);exit;
	$this->smarty->assign('message', $message);
        $this->smarty->display("pc/admin/mail/completed.html");
    }

    /* info-mail index
     * $id = contact_id
     */
    public function detail($id){
        $data = $this->Service_contact->get_detail($id);

	if(! $data){
	   redirect(base_url('admin/mail/index'));
	}

        $this->smarty->assign('data', $data);
	$this->smarty->display("pc/admin/mail/detail.html");
    }
}
