<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'User_abstract.php';
class Inquire extends User_abstract
{
    public function __construct()
    {   
        parent::__construct();
        $this->load->model('Service_inquire');
    }

    /*
     * this page is only showed お問合わせpage.
     */
    public function index()
    {
        $_data = [
                'name_required' => 'お名前を入力してください。',
                'email_required' => 'メールアドレスを入力してください。',
                'title_required' => '件名を入力してください。',
                'content_required' => '内容を入力してください。',
                'valid_email' => 'メールアドレスの形式が不正です。',
                'inquire_businessoffer_url' => 'inquire/businessoffer',
                'noscript' => 'お使いのブラウザはJavascriptをサポートしていないため、このフォームをお使いいただけません。'
        ];


        // render to screen[U_13]
        $user_id = $this->_get_user_id();
        if (! $this->Service_inquire->check_flow(__FUNCTION__,$_data,$user_id)) {

	    $bc_param = array('inquiry_index_current');
            $this->_bread_crumb['base_url'] = base_url();
            $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

            $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

            $this->smarty->assign($_data);

	    //tdk
            $tdk_array['title'] = 'お問い合わせ｜保育士の求人・転職・募集ならFINE!';
            $tdk_array['description'] = 'お問い合わせのページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
            $this->smarty->assign('tdk_array',$tdk_array);

            $this->smarty->display($this->template_path() . "/user/inquire/index.html");
        }else{
            // 5. redirect to complete
             redirect(base_url().'user/inquire/complete');
            exit();
        }
    }

    /*
     * this page is only showed お問合わせpage for company(they will be client in the future).
     */
    public function businessoffer()
    {
        // render to screen[U_13]

        $_data = [
                'name_required' => 'お名前を入力してください。',
                'email_required' => 'メールアドレスを入力してください。',
                'title_required' => '件名を入力してください。',
                'content_required' => '内容を入力してください。',
                'company_name_required' => '法人名を入力してください。',
                'valid_email' => 'メールアドレスの形式が不正です。',
                'inquire_businessoffer_url' => 'inquire/businessoffer',
                'noscript' => 'お使いのブラウザはJavascriptをサポートしていないため、このフォームをお使いいただけません。'
        ];
        /**
         * 1.
         * Load data from the contact form
         * 2. validate form
         * 3. load service
         * 4. Create contact
         * 5. show message
         */
        // $client_id = false;
        $user_id = $this->_get_user_id();
        if (! $this->Service_inquire->check_flow(__FUNCTION__,$_data,$user_id)) {


        $bc_param = array('businessoffer_current');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

            $this->smarty->assign($_data);

	    //tdk
        $tdk_array['title'] = '採用ご担当者様お問い合わせ｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = '採用ご担当者様お問い合わせのページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);
	
            $this->smarty->display($this->template_path() . "/user/inquire/businessoffer.html"); 
        }else{
            // 5. redirect to complete
             redirect(base_url().'inquiry/complete');
            exit();
        }
    }
    /*
     * this is complete page of inquire and businessoffer
     */
    public function complete()
    {
        // [U_14] render
	
	$bc_param = array('inquiry_complete_current');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

	//tdk
        $tdk_array['title'] = 'お問い合わせ完了｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = 'お問い合わせ完了のページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

        $this->smarty->display($this->template_path() . "/user/inquire/complete.html");
    }
}
