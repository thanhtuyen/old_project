<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'Admin_Abstract.php';
Class Except extends Admin_Abstract
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Service_except');
	$this->load->helper('apply');
    }

    public function job()
    {
        $this->get_list('applicant_job');
    }

    public function agency()
    {
        $this->get_list('applicant_agency');
    }

    public function detail_job($id)
    {
        $rows = $this->Service_except->get_job_detail($id);

        $this->smarty->assign('rows', $rows);
        $this->smarty->display($this->template_path().'/admin/except/job_detail.html');
    }
    public function detail_agency($id)
    {
        $rows = $this->Service_except->get_agency_detail($id);
        $this->smarty->assign('rows', $rows);
        $this->smarty->display($this->template_path().'/admin/except/agency_detail.html');
    }

    public function confirm($name, $status, $id)
    {
        $param = array(
            'table' => $name,
            'id' => $id,
            'status' => $status,
        );
       if( $this->Service_except->confirm($param)) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        echo '<script type="text/javascript">function histBack () {history.go(-2);}window.onload=histBack();</script>';
    }


    public function export_agecy_file()
    {
        $config = 'apply-for-agency';
        $filepath = $this->Service_except->export_file($this->get_format(), $config, 'agency');
        $this->send_file($filepath);
        exit;
    }

    public function export_job_file()
    {
        $config = 'apply-for-job';
        $filepath = $this->Service_except->export_file($this->get_format(), $config, 'job');
        $this->send_file($filepath);
        exit;
    }

    public function get_list($name)
    {
        $this->load->model('Service_admin_pagerfanta');
        $condition = $this->get_search_condition();
        $condition = array_merge($condition, array('name' => $name));
        $total = $this->Service_except->get_total_count($condition);

        $pager_data = $this->Service_admin_pagerfanta->get_data($total);

        $result = $this->Service_except->get_condition_list($condition, $pager_data);

        unset($condition['name']);
        $this->smarty->assign('result', $result);
        $this->smarty->assign('start', $pager_data['start']);
        $this->smarty->assign('end', $pager_data['end']);
        $this->smarty->assign('total', $pager_data['total']);
        $this->smarty->assign('pagerfantaHtml', $pager_data['pagerfantaHtml']);
        $this->smarty->assign('condition', $condition);
        $this->smarty->display($this->template_path().'/admin/except/'.$name.'.html');
    }

}
