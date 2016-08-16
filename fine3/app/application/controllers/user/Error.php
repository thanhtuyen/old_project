<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'User_abstract.php';

class Error extends User_abstract
{
    public function __construct() {
        parent::__construct();
    }

    public function error_404(){
        $this->output->set_status_header('404');
        $tdk['title']       = 'ページが見つかりません';
        $tdk['description'] = 'ご指定のページが見つかりません。';
        $tdk['keyword']     = '';
        $tdk['author']      = '';
        $this->smarty->assign('tdk', $tdk);
        //tag group
        $this->load->model('Service_tag');
        $tags = $this->Service_tag->get_tag_job_list();
        $this->smarty->assign('tags' , $tags);
        $this->output->set_status_header('404');
        $this->smarty->display($this->template_path() . '/errors/error_404.html');
        exit;
    }

    /*
    this page is nomal error
    */
    public function index() {
        //1. make  drill rink
        //render to screen , please ask aya

    $bc_param = array('error_current');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

    $this->smarty->display($this->template_path()."/user/error/index.html");
    }
    /*
    this page not found 404.
    */
    public function notfound() {

        //tag group
        $this->load->model('Service_tag');
        $tags = $this->Service_tag->get_tag_job_list();
        $this->smarty->assign('tags' , $tags);
        //1. make  drill rink
        //render to screen , please ask aya

    $bc_param = array('notfound_current');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

    $this->smarty->display($this->template_path()."/user/error/404notfound.html");
    }

    /*
    this page is for mentenance. when we have to mentenance , we switch this action
    */
    public function mentenance() {

        //tag group
        $this->load->model('Service_tag');
        $tags = $this->Service_tag->get_tag_job_list();
        $this->smarty->assign('tags' , $tags);
        // render template.

    $bc_param = array('mentenance_current');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

    $this->smarty->display($this->template_path()."/user/error/mentenance.html");
    }

    public function sp(){
        $this->smarty->display($this->template_path()."/user/error/sp.html");
    }
}
