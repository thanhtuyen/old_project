<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'Admin_Abstract.php';
Class Job extends Admin_Abstract
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Service_job');
    }

  public function index()
    {
        $this->load->model('Service_client');
        $this->load->model('Service_admin_pagerfanta');
        $condition = $this->get_search_condition();

        $total = $this->Service_job->get_total_count($condition);

        $pager_data = $this->Service_admin_pagerfanta->get_data($total);

        $jobs = $this->Service_job->get_list($condition, $pager_data);

        $plan_group = $this->Service_client->plan_group();

        $this->smarty->assign('jobs', $jobs);
        $this->smarty->assign('start', $pager_data['start']);
        $this->smarty->assign('end', $pager_data['end']);
        $this->smarty->assign('total', $pager_data['total']);
        $this->smarty->assign('plan_group', $plan_group);
        $this->smarty->assign('pagerfantaHtml', $pager_data['pagerfantaHtml']);
        $this->smarty->assign('condition', array_merge($condition,array('limit' => $pager_data['per_page'])));
        $this->smarty->display($this->template_path().'/admin/jobs/index.html');
    }

    /**
     * job detail page
     * @param  [int] $id = userid
     */
    public function detail($id)
    {
        $job = $this->Service_job->get_detail_of_admin($id);
        $this->smarty->assign('job', $job);
        $this->smarty->display($this->template_path().'/admin/jobs/detail.html');
    }

    /**
     * job delete_flg
     */
    public function delete_flg($id)
    {
        if ($this->Service_job->delete_flg($id)) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        redirect(base_url('manager/jobs'));
    }

    public function export_file()
    {
        $filepath = $this->Service_job->export_file($this->get_format());
        $this->send_file($filepath);
        exit;
    }

}
