<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'Admin_Abstract.php';
Class Client extends Admin_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Service_client');
    }

    /**
     * display client list agent or nursery
     * @param  [string] $role [agent or company]
     * @return [type]       [description]
     */
    public function index($role)
    {
        $get = $this->input->get();
        if(!empty($get['limit'])){
            $this->smarty->assign('show', $get['limit']);
        }else{
            $this->smarty->assign('show', 10);
        }
        $this->load->model('Service_admin_pagerfanta');
        $condition = $this->get_search_condition();
        $condition = array_merge($condition, array('account_type' => $role));
        $total = $this->Service_client->get_total_count($condition);
        $pager_data = $this->Service_admin_pagerfanta->get_data($total);
        $clients = $this->Service_client->get_list($condition, $pager_data);
        unset($condition['account_type']);
        $this->smarty->assign('clients', $clients);
        $this->smarty->assign('start', $pager_data['start']);
        $this->smarty->assign('end', $pager_data['end']);
        $this->smarty->assign('total', $pager_data['total']);
        $this->smarty->assign('pagerfantaHtml', $pager_data['pagerfantaHtml']);
        $this->smarty->assign('condition', $condition);
        $this->smarty->display($this->template_path().'/admin/client/'. $role .'.html');
    }

    public function add()
    {
        $pref = $this->Service_area->get_pref_list();
        $this->load->model('Service_plan');
        $plan_group = $this->Service_plan->get_all_plan_group();
        $this->smarty->assign('pref', $pref);
        $this->smarty->assign('plan_group', $plan_group);
        $this->smarty->display($this->template_path().'/admin/client/add.html');
    }

    public function create()
    {
        if (! $this->isPost()) {
            return $this->add();
        }
        $posts = $this->input->post(null, true);

        list(
            $flag,
            $password,
            $mail,
            $client_name,
            $contact_name
            ) = $this->Service_client->save($posts);

        if ($flag) {
            $this->load->model('Service_email');
            $this->Service_email->account_info_2client(
                array(
                    'client_name' => $client_name,
                    'client_contact_name' => $contact_name,
                    'mail' => $mail,
                    'password' => $password,
                    'to' => $mail,
                )
            );
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }

        $this->smarty->assign('password', $password);
        $this->smarty->assign('mail', $mail);
        $this->smarty->display($this->template_path().'/admin/client/completed.html');
    }

    public function add_plan($client_id)
    {

        $groups = $this->Service_client->plan_group();
        $this->smarty->assign('groups', $groups);
        $this->smarty->assign('client_id', $client_id);
        $this->smarty->display($this->template_path().'/admin/client/add-plan.html');
    }

    public function create_plan()
    {
        $this->load->model('Service_plan');
        if (! $this->isPost()) {
            redirect($_SERVER['HTTP_REFERER']);
        }

        $posts = $this->input->post(null, true);

        if ($this->Service_plan->create_plan($posts)){
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        echo '<script type="text/javascript">function histBack () {history.go(-2);}window.onload=histBack();</script>';
    }

    public function plan_detail()
    {
        $plan_group_id =$this->input->post('plan_group_id', true);

        if ($plan_group_id == '0') {
            $detail = array(
                'plans' => '0',
                'month' => '0',
                'price' => '0',
                'auto_extend_flg' => '0',
            );
            header('Content-Type: application/json');
            echo json_encode($detail, JSON_UNESCAPED_UNICODE);
        }

        list($plan_group, $plan_detail) = $this->Service_client->get_plans_detail_by_group_id($plan_group_id);

        $plan_name = array_column($plan_detail, 'plan_name');
        $description = array_column($plan_detail, 'description');

        $plans = array_map(function ($a, $b) {
            return $a . '<br>' . $b;
        } , $plan_name, $description);

        $detail = array(
            'plans' => $plans,
            'month' => $plan_group['period'],
            'price' => (int) $plan_group['price'] + (int) $plan_group['unit_price'],
            'auto_extend_flg' => $plan_group['auto_extend_flg'],
        );
        header('Content-Type: application/json');
        echo json_encode($detail, JSON_UNESCAPED_UNICODE);


    }

    public function delete_flg()
    {
        // $this->Service_client->delete_flg();
    }

    public function export_file()
    {
        $filepath = $this->Service_client->export_file($this->get_format());
        $this->send_file($filepath);
        exit;
    }

    public function export_nursery_file()
    {
        $filepath = $this->Service_client->export_nursery_file($this->get_format());
        $this->send_file($filepath);
        exit;
    }

}
