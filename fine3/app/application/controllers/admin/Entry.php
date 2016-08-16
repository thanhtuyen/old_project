<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'Admin_Abstract.php';
Class Entry extends Admin_Abstract
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Service_apply');
	$this->load->helper('apply');
    }

  //applicant job index
  public function index()
    {
        $this->load->model('Service_admin_pagerfanta');
        $condition = $this->get_search_condition();

        $total = $this->Service_apply->get_total_count($condition);

        $pager_data = $this->Service_admin_pagerfanta->get_data($total);

        $jobs = $this->Service_apply->get_condition_list($condition, $pager_data);

        $this->load->model('Service_user');
        $this->load->model('Service_client');
        $this->load->model('Service_plan');
        $this->load->model('Service_tag');
        $this->smarty->assign('jobs', $jobs);
        $this->smarty->assign('start', $pager_data['start']);
        $this->smarty->assign('end', $pager_data['end']);
        $this->smarty->assign('total', $pager_data['total']);
        $this->smarty->assign('pagerfantaHtml', $pager_data['pagerfantaHtml']);
        $this->smarty->assign('condition', $condition);
        $this->smarty->display($this->template_path().'/admin/entries/index.html');
    }

  //applicant agent index
    public function agent_index(){
	//開発中なので
	$this->smarty->display('pc/admin/entries/agent_index_maintenance.html');

/*
	$this->load->model('Service_admin_pagerfanta');
        $condition = $this->get_search_condition();

        $total = $this->Service_apply->get_total_count($condition);

        $pager_data = $this->Service_admin_pagerfanta->get_data($total);

	//紹介会社応募の場合、table_typeをセット
	$condition['table_type'] = 'agent';
        $agents = $this->Service_apply->get_condition_list($condition, $pager_data);

        $this->load->model('Service_user');
        $this->load->model('Service_client');
        $this->load->model('Service_plan');
        $this->load->model('Service_tag');


        $this->smarty->assign('agents', $agents);
        $this->smarty->assign('start', $pager_data['start']);
        $this->smarty->assign('end', $pager_data['end']);
        $this->smarty->assign('total', $pager_data['total']);
        $this->smarty->assign('pagerfantaHtml', $pager_data['pagerfantaHtml']);
        $this->smarty->assign('condition', $condition);
        $this->smarty->display($this->template_path().'/admin/entries/agent_index.html');
*/
    }


    /**
     * entry detail page
     * @param  [int] $id = applicant_job_id
     */
    public function job_detail($id)
    {
        $job = $this->Service_apply->get_applicant_job_detail($id);

        if(is_null($job) || empty($job) || !isset($job['user_id'])){
            show_404();
        }

        $this->load->model('Service_user');
        $this->load->model('Service_client');
        $this->load->model('Service_plan');
        $this->load->model('Service_tag');

        $this->smarty->assign('row', $job);
        $this->smarty->display($this->template_path().'/admin/entries/detail.html');
    }

    public function job_update()
    {
        if (! $this->isPost()) {
             return redirect(base_url('manager/entries/job'));
        }

        $posts = $this->input->post(null, true);

        if( $this->Service_apply->update($posts) ) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        return redirect($_SERVER['HTTP_REFERER']);
    }


    /**
     * entry delete_flg
     */
    public function job_delete_flg($id)
    {
        if ($this->Service_apply->delete_flg($id)) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        redirect(base_url('manager/entries/job'));
    }

    public function job_export_file()
    {
        // $filepath = $this->Service_apply->export_file($this->get_format());
        // $this->send_file($filepath);
        // exit;
        header('Content-Type: application/json');
        echo json_encode('not need export', JSON_PRETTY_PRINT);
    }

}
