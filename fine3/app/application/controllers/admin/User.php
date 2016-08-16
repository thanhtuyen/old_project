<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'Admin_Abstract.php';
Class User extends Admin_abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Service_user');
	$this->load->helper('user');
    }

    /**
     * user list page
     */
    public function index()
    {
        $get = $this->input->get();
        if(!empty($get['limit'])){
            $this->smarty->assign('show', $get['limit']);
        }else{
            $this->smarty->assign('show', 10);
        }
        $this->load->model('Service_admin_pagerfanta');
        $condition = $this->get_search_condition();
        $total = $this->Service_user->get_total_count($condition);

        $pager_data = $this->Service_admin_pagerfanta->get_data($total);
        // do not use
        // $pager_data['start'] = "";
        // $pager_data['total'] = "";
        // $pager_data['end'] = "";
        // $pager_data['pagerfantaHtml'] = "";
        $users = $this->Service_user->get_list($condition, $pager_data);
        $this->smarty->assign('users', $users);
        $this->smarty->assign('start', $pager_data['start']);
        $this->smarty->assign('end', $pager_data['end']);
        $this->smarty->assign('total', $pager_data['total']);
        $this->smarty->assign('condition', $condition);
        $this->smarty->assign('pagerfantaHtml', $pager_data['pagerfantaHtml']);
        $this->smarty->display($this->template_path().'/admin/user/index.html');
    }

    /**
     * user detail page
     * @param  [int] $id = userid
     */
    public function detail($id)
    {
        $user = $this->Service_user->get_admin_user_detail($id);

        $this->smarty->assign('user', $user);

        $this->smarty->display($this->template_path().'/admin/user/detail.html');
    }

    /**
     * user delete_flg
     */
    public function delete_flg($id)
    {
        if ($this->Service_user->delete_flg($id)) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        redirect(base_url('manager/user'));
    }

    public function export_file()
    {
        $filepath = $this->Service_user->export_file($this->get_format());
        $this->send_file($filepath);
        exit;
    }
    public function dammy_user_login($id)
    {
        $user = $this->Service_user->get_admin_user_detail($id);
        if ($user['status'] == '0') {
            redirect($this->config->config["base_url"]."admin/user/detail".$id);
        }
        $user_data['user_id'] = $user['user_id'];
        $user_data['login'] = true;
        $this->session->set_userdata('user_data', $user_data);
        redirect($this->config->config["base_url"]."mypage");

    }

}
