<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'Admin_Abstract.php';
Class Ad extends Admin_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Service_ad");
        $this->load->model("Service_area");
    }

    public function index($type)
    {
        $this->load->model('Service_admin_pagerfanta');
        $condition = $this->get_search_condition();

        $condition = array_merge($condition, array('type' => $type));
        $total = $this->Service_ad->get_total_count($condition);

        $pager_data = $this->Service_admin_pagerfanta->get_data($total);

        $ads = $this->Service_ad->get_list_of_admin($condition, $pager_data);

        //unset($condition['type']); it s needed. @yamamoto
        $this->smarty->assign('ads', $ads);
        $this->smarty->assign('type', $type);
        $this->smarty->assign('start', $pager_data['start']);
        $this->smarty->assign('end', $pager_data['end']);
        $this->smarty->assign('total', $pager_data['total']);
        $this->smarty->assign('pagerfantaHtml', $pager_data['pagerfantaHtml']);
        $this->smarty->assign('condition', $condition);
        $this->smarty->display($this->template_path().'/admin/ad/'. $type .'.html');
    }

    public function add_banner()
    {
        $positions = $this->Service_ad->get_position_group();
        $states = $this->Service_area->get_province();

        $this->smarty->assign('states', $states);
        $this->smarty->assign('positions', $positions);
        $this->smarty->display($this->template_path().'/admin/ad/add_banner.html');
    }

    public function create_banner()
    {
        if (! $this->isPost()) {
            redirect(base_url() . 'manager/ad/banner/add');
        }
        $post = $this->input->post(null, true);

        if( $this->Service_ad->create_banner($post) ) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        redirect(base_url() . 'manager/ad/banner');
    }

    public function edit_banner($ads_id)
    {
        $ads = $this->Service_ad->get_detail_of_admin($ads_id);
        $photo = $this->Service_ad->get_ads_photo($ads_id);

        $positions = $this->Service_ad->get_position_group();
        $states = $this->Service_area->get_province();

        $this->smarty->assign('ad', $ads);
        $this->smarty->assign('photo', $photo);
        $this->smarty->assign('states', $states);
        $this->smarty->assign('positions', $positions);
        $this->smarty->assign('type', $type = 'banner');
        $this->smarty->display($this->template_path().'/admin/ad/edit_banner.html');
    }

    public function update_banner()
    {
        if (! $this->isPost()) {
            redirect(base_url() . 'manager/ad/banner/add');
        }
        $post = $this->input->post(null, true);

        if( $this->Service_ad->update_banner($post) ) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        redirect(base_url() . 'manager/ad/'.$post['type']);
    }

    public function add_partner()
    {
        list($ads_group_id) = $this->config->item('partner', 'ad_config');

        $this->smarty->assign('ads_group_id', $ads_group_id);
        $this->smarty->display($this->template_path().'/admin/ad/add_partner.html');
    }

    public function create_partner()
    {
        if (! $this->isPost()) {
            redirect(base_url() . 'manager/ad/partner/add');
        }
        $post = $this->input->post(null, true);

        if( $this->Service_ad->create_partner($post) ) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        redirect(base_url() . 'manager/ad/partner');
    }

    public function edit_partner($ads_id)
    {
        $ads = $this->Service_ad->get_detail_of_admin($ads_id);
        $photo = $this->Service_ad->get_ads_photo($ads_id);
        $this->smarty->assign('ad', $ads);
        $this->smarty->assign('photo', $photo);
        $this->smarty->display($this->template_path().'/admin/ad/edit_partner.html');
    }

    public function update_partner()
    {
        if (! $this->isPost()) {
            redirect(base_url() . 'manager/ad/partner/add');
        }
        $post = $this->input->post(null, true);

        if( $this->Service_ad->update_partner($post) ) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        redirect(base_url() . 'manager/ad/partner');
    }

    public function add_text()
    {
        list($ads_group_id) = $this->config->item('text', 'ad_config');

        $this->smarty->assign('ads_group_id', $ads_group_id);
        $this->smarty->display($this->template_path().'/admin/ad/add_text.html');
    }

    public function create_text()
    {
        if (! $this->isPost()) {
            redirect(base_url() . 'manager/ad/text/add');
        }
        $post = $this->input->post(null, true);

        if( $this->Service_ad->create_text($post) ) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        redirect(base_url() . 'manager/ad/text');
    }

    public function edit_text($ads_id)
    {
        $ad = $this->Service_ad->get_detail_of_admin($ads_id);

        $ads = $this->Service_ad->get_text_list();

        $states = $this->Service_area->get_province();

        $this->smarty->assign('states', $states);
        $this->smarty->assign('ad', $ad);
        $this->smarty->assign('ads', $ads);
        $this->smarty->display($this->template_path().'/admin/ad/edit_text.html');
    }

    public function update_text()
    {
        if (! $this->isPost()) {
            redirect(base_url() . 'manager/ad/text/add');
        }
        $post = $this->input->post(null, true);

        if( $this->Service_ad->update_text($post) ) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        redirect(base_url() . 'manager/ad/text');
    }

    public function delete_flg($ads_id)
    {
        if ($this->Service_ad->delete_flg($ads_id)) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function edit_job_right_navi($ads_id)
    {
        $ads = $this->Service_ad->get_detail_of_admin($ads_id);
        $photo = $this->Service_ad->get_ads_photo($ads_id);

        $positions = $this->Service_ad->get_position_group();
        $states = $this->Service_area->get_province();
        $this->smarty->assign('ad', $ads);
        $this->smarty->assign('photo', $photo);
        $this->smarty->assign('states', $states);
        $this->smarty->assign('positions', $positions);
        $this->smarty->assign('type', 'job_right_navi');
        $this->smarty->display($this->template_path().'/admin/ad/edit_job_right_navi.html');
    }
    public function edit_job_content_upper($ads_id)
    {
        $ads = $this->Service_ad->get_detail_of_admin($ads_id);
        $photo = $this->Service_ad->get_ads_photo($ads_id);

        $positions = $this->Service_ad->get_position_group();
        $states = $this->Service_area->get_province();
        $this->smarty->assign('ad', $ads);
        $this->smarty->assign('photo', $photo);
        $this->smarty->assign('states', $states);
        $this->smarty->assign('positions', $positions);
        $this->smarty->assign('type', 'job_content_upper');
        $this->smarty->display($this->template_path().'/admin/ad/edit_job_content_upper.html');
    }
    public function edit_job_content_lower($ads_id)
    {
        $ads = $this->Service_ad->get_detail_of_admin($ads_id);
        $photo = $this->Service_ad->get_ads_photo($ads_id);

        $positions = $this->Service_ad->get_position_group();
        $states = $this->Service_area->get_province();
        $this->smarty->assign('ad', $ads);
        $this->smarty->assign('photo', $photo);
        $this->smarty->assign('states', $states);
        $this->smarty->assign('positions', $positions);
        $this->smarty->assign('type', 'job_content_lower');
        $this->smarty->display($this->template_path().'/admin/ad/edit_job_content_lower.html');
    }
    public function update_job_right_navi()
    {
        if (! $this->isPost()) {
            redirect(base_url() . 'manager/ad/job_right_navi/add');
        }
        $post = $this->input->post(null, true);
        if( $this->Service_ad->update_job_contents($post) ) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        redirect(base_url() . 'manager/ad/'.$post['type']);
    }
    public function update_job_content_upper()
    {
        if (! $this->isPost()) {
            redirect(base_url() . 'manager/ad/job_content_upper/add');
        }
        $post = $this->input->post(null, true);
        if( $this->Service_ad->update_job_contents($post) ) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        redirect(base_url() . 'manager/ad/'.$post['type']);
    }
    public function update_job_content_lower()
    {
        if (! $this->isPost()) {
            redirect(base_url() . 'manager/ad/job_content_lower/add');
        }
        $post = $this->input->post(null, true);
        if( $this->Service_ad->update_job_contents($post) ) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        redirect(base_url() . 'manager/ad/'.$post['type']);
    }
    public function add_job_right_navi()
    {
        $positions = $this->Service_ad->get_position_group();
        $states = $this->Service_area->get_province();

        $this->smarty->assign('states', $states);
        $this->smarty->assign('positions', $positions);
        $this->smarty->display($this->template_path().'/admin/ad/add_job_right_navi.html');
    }
    public function add_job_content_upper()
    {
        $positions = $this->Service_ad->get_position_group();
        $states = $this->Service_area->get_province();

        $this->smarty->assign('states', $states);
        $this->smarty->assign('positions', $positions);
        $this->smarty->display($this->template_path().'/admin/ad/add_job_content_upper.html');
    }
    public function add_job_content_lower()
    {
        $positions = $this->Service_ad->get_position_group();
        $states = $this->Service_area->get_province();

        $this->smarty->assign('states', $states);
        $this->smarty->assign('positions', $positions);
        $this->smarty->display($this->template_path().'/admin/ad/add_job_content_lower.html');
    }
    public function create_job_right_navi()
    {
        if (! $this->isPost()) {
            redirect(base_url() . 'manager/ad/job_right_navi/add');
        }
        $post = $this->input->post(null, true);

        if( $this->Service_ad->create_job_contents($post) ) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        redirect(base_url() . 'manager/ad/job_right_navi');
    }
    public function create_job_content_upper()
    {
        if (! $this->isPost()) {
            redirect(base_url() . 'manager/ad/job_content_upper/add');
        }
        $post = $this->input->post(null, true);

        if( $this->Service_ad->create_job_contents($post) ) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        redirect(base_url() . 'manager/ad/job_content_upper');
    }
    public function create_job_content_lower()
    {
        if (! $this->isPost()) {
            redirect(base_url() . 'manager/ad/job_content_lower/add');
        }
        $post = $this->input->post(null, true);

        if( $this->Service_ad->create_job_contents($post) ) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        redirect(base_url() . 'manager/ad/job_content_lowr');
    }
}
