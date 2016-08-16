<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'Admin_Abstract.php';
Class Scout extends Admin_Abstract
{
/*
 * This is for "scout mail index", "detail scout mail"
 */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Service_scout');
    }

    public function index(){
        $this->load->model('Service_admin_pagerfanta');
        $condition = $this->get_search_condition();

        $total = $this->Service_scout->get_total_count($condition);

        $pager_data = $this->Service_admin_pagerfanta->get_data($total);
        $result = $this->Service_scout->get_list_of_scout($condition, $pager_data);
//echo '<pre>';var_dump($result);echo '</pre>';exit;
        $this->smarty->assign('start', $pager_data['start']);
        $this->smarty->assign('end', $pager_data['end']);
        $this->smarty->assign('total', $pager_data['total']);
        $this->smarty->assign('pagerfantaHtml', $pager_data['pagerfantaHtml']);
        $this->smarty->assign('result', $result);
        $this->smarty->assign('condition', $condition);
        $this->smarty->display("pc/admin/scout/index.html");
    }

    public function detail($scout_id){
	$data = $this->Service_scout->get_scout_detail($scout_id);

        if(! $data){
           redirect(base_url('admin/scout/index'));
        }
//echo '<pre>';var_dump($data);echo '</pre>';exit;

        $this->smarty->assign('data', $data);
	$this->smarty->display("pc/admin/scout/detail.html");
    }

    public function export_file()
    {
        $filepath = $this->Service_scout->export_file($this->get_format());
        $this->send_file($filepath);
        exit;
    }

    public function export_template_file()
    {
        $filepath = $this->Service_scout->export_template_file($this->get_format());
        $this->send_file($filepath);
        exit;
    }

}
