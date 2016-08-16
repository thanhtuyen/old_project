<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'User_abstract.php';

class Statics extends User_abstract
{
    public function __construct() {
        parent::__construct();
	$this->load->helper('tdk');
    }

    public function about(){
	$bc_param = array('about_current');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

	//tdk
        $tdk_array['title'] = 'FINE！（ファイン）とは？｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = 'FINE！（ファイン）とは？のページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

	$this->smarty->display($this->template_path()."/user/statics/about.html");
    }

    public function guide(){

        $bc_param = array('guide_current');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

	//tdk
        $tdk_array['title'] = 'サイトの使い方｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = 'サイトの使い方のページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

        $this->smarty->display($this->template_path()."/user/statics/guide.html");
    }

    public function rule(){
        $bc_param = array('rule_current');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

	//tdk
        $tdk_array['title'] = '利用規約｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = '利用規約のページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

        $this->smarty->display($this->template_path()."/user/statics/rule.html");
    }

    public function rule_company(){
        $bc_param = array('rule_company_current');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

	//tdk
        $tdk_array['title'] = '利用規約（企業様向け）｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = '利用規約（企業様向け）のページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

        $this->smarty->display($this->template_path()."/user/statics/rule_company.html");
    }
}
