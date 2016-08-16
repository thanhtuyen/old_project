<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
require_once ('Client_abstract.php');
class Inquire extends Client_abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Service_inquire');
    }

    /*
     * this page is only showed お問合わせpage for company(they will be client in the future).
     */
    public function businessoffer()
    {
        // render to screen[U_13]

        parent::_assign_job_info();

        if($this->is_login()){
            parent::_assign_common_params();
            $user_login = true;
        }else{
            $user_login = false;
        }

        $_data = [
                'name_required' => 'お名前を入力してください。',
                'email_required' => 'メールアドレスを入力してください。',
                'title_required' => '件名を入力してください。',
                'content_required' => '内容を入力してください。',
                'company_name_required' => '法人名を入力してください。',
                'valid_email' => 'メールアドレスの形式が不正です。',
                'inquire_businessoffer_url' => 'inquire/businessoffer',
                'noscript' => 'お使いのブラウザはJavascriptをサポートしていないため、このフォームをお使いいただけません。',
                'login'   => $user_login
        ];
        /**
         * 1.
         * Load data from the contact form
         * 2. validate form
         * 3. load service
         * 4. Create contact
         * 5. show message
         */
        $client_id = $this->_get_client_id();
        if($client_id === false){
            //send remail false
        }

        if (! $this->Service_inquire->check_flow(__FUNCTION__,$_data,$client_id)) {

        $bc_param = array('businessoffer_current');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

            $this->smarty->assign($_data);
            $this->smarty->display($this->template_path() . "/client/inquire/businessoffer.html");
        }else{
            // 5. redirect to complete
            redirect(base_url().'client/inquiry/complete');
            exit();
        }
    }
    /*
     * this is complete page of inquire and businessoffer
     */
    public function complete()
    {
        // [U_14] render

        parent::_assign_job_info();

        if($this->is_login()){
            parent::_assign_common_params();
            $user_login = true;
        }else{
            $user_login = false;
        }

        $bc_param = array('inquiry_complete_current');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);
        $this->smarty->assign('login' , $user_login);
        $this->smarty->display($this->template_path() . "/client/inquire/complete.html");
    }
}
