<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'user/User_abstract.php';

class Error extends User_abstract
{
    function __construct() {
        parent::__construct();
    }
    /**
     * show error 404
     */
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

    public function error_503(){
        $this->output->set_status_header('503');
        $tdk['title']       = 'エラーが発生しました';
            $tdk['description'] = '予期しないエラーが発生しました。';
            $tdk['keyword']     = '';
            $tdk['author']      = '';
        $this->smarty->assign('tdk', $tdk);
        $this->load->model('Service_tag');
            $tags = $this->Service_tag->get_tag_job_list();
            $this->smarty->assign('tags' , $tags);

            $this->output->set_status_header('503');
        $this->smarty->display($this->template_path() . '/errors/error_system.html');
        exit;
    }

    public function maintenance(){
        $tdk['title']       = 'メンテナンス中';
            $tdk['description'] = 'ご指定のページはただいまメンテナンス中です。';
            $tdk['keyword']     = '';
            $tdk['author']      = '';
        $this->smarty->assign('tdk', $tdk);
        $this->smarty->display($this->template_path() . '/errors/error_maintenance.html');
            exit;
    }
}
