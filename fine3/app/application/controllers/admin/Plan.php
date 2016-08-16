<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'Admin_Abstract.php';
Class Plan extends Admin_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Service_client');
    }

    public function index()
    {
        $this->load->model('Service_admin_pagerfanta');
        $condition = $this->get_search_condition();
        $total = $this->Service_client->get_plan_total_count($condition);

        $pager_data = $this->Service_admin_pagerfanta->get_data($total);

        $plans= $this->Service_client->plan_list($condition, $pager_data);

        $this->smarty->assign('plans', $plans);
        $this->smarty->assign('start', $pager_data['start']);
        $this->smarty->assign('end', $pager_data['end']);
        $this->smarty->assign('total', $pager_data['total']);
        $this->smarty->assign('condition', $condition);
        $this->smarty->assign('pagerfantaHtml', $pager_data['pagerfantaHtml']);
        $this->smarty->display($this->template_path().'/admin/plan/index.html');
    }

    public function category()
    {
        $condition = $this->get_search_condition();
        $categories = $this->Service_client->plan_category();

        $this->smarty->assign('categories', $categories);
        $this->smarty->assign('condition', $condition);
        $this->smarty->display($this->template_path().'/admin/plan/category.html');

    }

    public function detail($client_plan_group_relation_id)
    {
        $this->load->model("Service_plan");
        $plan_detail = $this->Service_plan->get_client_group_relation($client_plan_group_relation_id);

        if(empty($plan_detail)){
            show_404();
            exit;
        }

        $plan_detail["plan"] = $this->Service_plan->get_plan_list($plan_detail["plan_group_id"]);

        $this->smarty->assign('plan_detail', $plan_detail);
        $this->smarty->display($this->template_path().'/admin/plan/group_detail.html');

    }

    public function add()
    {
        $limit_types = $this->config->item('limit_type', 'plan_config');

        $this->smarty->assign('limit_types', $limit_types);
        $this->smarty->display($this->template_path().'/admin/plan/add.html');
    }

    public function create()
    {
        if (! $this->isPost()) {
             return redirect(base_url('manager/plan/add'));
        }

        $posts = $this->input->post(null, true);

        if( $this->Service_client->plan_save($posts) ) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        return redirect(base_url('manager/plan'));
    }

    public function edit($id)
    {
        $plan= $this->Service_client->plan_detail($id);
        $limit_types = $this->config->item('limit_type', 'plan_config');
        $this->smarty->assign('limit_types', $limit_types);
        $this->smarty->assign('plan', $plan);
        $this->smarty->display($this->template_path().'/admin/plan/edit.html');

    }

    public function update()
    {

        if (! $this->isPost()) {
            return redirect($_SERVER['HTTP_REFERER']);
        }
        $posts = $this->input->post(null, true);

        if ($this->Service_client->plan_update($posts)) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        return redirect(base_url('manager/plan'));

    }

    public function delete_flg($plan_id)
    {
        try {
            $flag = $this->Service_client->plan_delete_flg($plan_id);
        } catch (Exception $e) {
            $this->session->set_flashdata('alert', $e->getMessage());
            return redirect(base_url('manager/plan'));
        }

        if( $flag ) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        return redirect(base_url('manager/plan'));
    }

    public function group_delete_flg($group_id)
    {

        if( $this->Service_client->plan_group_delete_flg($group_id) ) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        return redirect(base_url('manager/plan/category'));
    }

    public function add_group()
    {
        $plans = $this->Service_client->plan_list(array(),array(), false);
        $this->smarty->assign('plans', $plans);
        $this->smarty->display($this->template_path().'/admin/plan/group_add.html');
    }

    public function create_group()
    {
        if (! $this->isPost()) {
             return redirect(base_url('manager/plan_group/add'));
        }

        $posts = $this->input->post(null, true);

        if( $this->Service_client->save_plan_group($posts) ) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        return redirect(base_url('manager/plan/category'));
    }

    public function edit_group($group_id)
    {
    //既存データ
    $selected_plan = array();
    $this->load->model('Service_plan');
    $selected = $this->Service_plan->get_plan_list($group_id);
    foreach($selected as $key => $val){
        $selected_plan[] = $val['plan_id'];
    }

        $plans = $this->Service_client->plan_list(array(),array(), false);

        $group = $this->Service_client->plan_group_detail($group_id);

        $this->smarty->assign('selected_plan', $selected_plan);
        $this->smarty->assign('plans', $plans);
        $this->smarty->assign('group', $group);
        $this->smarty->display($this->template_path().'/admin/plan/group_edit.html');
    }

    public function update_group()
    {
        if (! $this->isPost()) {
            return redirect($_SERVER['HTTP_REFERER']);
        }
        $posts = $this->input->post(null, true);

        if ($this->Service_client->plan_update_group($posts)) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        return redirect(base_url('manager/plan/category'));
    }

    public function delete_relation($group_id, $plan_id)
    {
        if($this->Service_client->delete_plan_relation($group_id, $plan_id)) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }

        return redirect(base_url('manager/plan/category'));
    }

    public function export_file()
    {
        $this->load->model('Service_plan');
        $filepath = $this->Service_plan->export_file($this->get_format());
        $this->send_file($filepath);
        exit;
    }

    public function export_group_file()
    {
        $this->load->model('Service_plan');
        $filepath = $this->Service_plan->export_group_file($this->get_format());
        $this->send_file($filepath);

    }







}
