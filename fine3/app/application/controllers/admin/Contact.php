<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'Admin_Abstract.php';
Class Contact extends Admin_Abstract
{
/*
 * This is for "contact index", "contact detail"
 */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Service_contact');
    }

    public function index(){
            /*
            1.load pagination service
            $this->load->model('Service_admin_pagerfanta');
            2. get form search condition
            $condition = $this->get_search_condition();
            3.get contact total count
            $total = $this->Service_contact->get_total_count($condition);
            4.get pagination data
            $pager_data = $this->Service_admin_pagerfanta->get_data($total);
            5.get result
            $result = $this->Service_contact->get_list($condition, $pager_data);
             */
            $this->load->model('Service_admin_pagerfanta');
            $condition = $this->get_search_condition();

            $this->config->load('contact_config');
            $condition['type'] = array($this->config->item('guest'),
                                   $this->config->item('logged_user'),
                                   $this->config->item('logged_client'),
                                   $this->config->item('business_offer')
            );

            $total = $this->Service_contact->get_total_count($condition);

            $pager_data = $this->Service_admin_pagerfanta->get_data($total);
            $result = $this->Service_contact->get_list_of_contact($condition, $pager_data);

            unset($condition['type']);
            $this->smarty->assign('start', $pager_data['start']);
            $this->smarty->assign('end', $pager_data['end']);
            $this->smarty->assign('total', $pager_data['total']);
            $this->smarty->assign('pagerfantaHtml', $pager_data['pagerfantaHtml']);
            $this->smarty->assign('result', $result);
            $this->smarty->assign('condition', $condition);
            $this->smarty->display("pc/admin/contact/index.html");
    }

    /**
     * contact detail page
     * @param  [int] $id = contact_id
     */
    public function detail($id){
	$alert = '';
	$param = $_GET;
	if(! empty($param)){
	    foreach($param as $key => $val){
		if($key == 'success'){
		    $alert = '<script>alert("情報を更新しました");</script>';
		}elseif($key == 'fail'){
		    $alert = '<script>alert("情報の更新ができませんでした");</script>';
		}
	    }
	}

        $data = $this->Service_contact->get_detail($id);

	if(! $data){
	    redirect(base_url('admin/contact/index'));
	}

	$this->smarty->assign('alert', $alert);
        $this->smarty->assign('data', $data);
        $this->smarty->display('pc/admin/contact/detail.html');
    }

    public function update($id){
	//$post = array(2) { ["contact_id"]=> string(2) "25" ["status"]=> string(6) "不明" }
	$get = $_GET;
	$result = $this->Service_contact->update_status($get);
	if($result){
	    redirect(base_url('admin/contact/detail') .'/' . $id . '?success');
	}else{
	    redirect(base_url('admin/contact/detail') .'/' . $id . '?fail');
	}
    }
}
