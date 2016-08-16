<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'Client_abstract.php';

class Password extends Client_abstract{
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }

    /*
     this page for client who forget password , this page is just showed
     */
    public function index() {
        //[C_3]
        $this->smarty->display($this->template_path()."/client/password/index.html");
    }

    /*
     this action execute password reset
     */
    public function password_reset_check() {

        $post = $this->input->post();

        if(empty($post["client_id"])||empty($post["client_name"])||empty($post["mail"])){
            echo"a";exit;
            redirect($this->config->config["base_url"]);
            exit;
        }

        $params["token_type"]  = 2;
        $params["account_id"]  = $post["client_id"];
        $params["target_type"] = 2;

        $this->load->model("Service_token");
        $regist_token = $this->Service_token->regist_token($params);

        if($regist_token === false){
            echo"b";exit;
            redirect($this->config->config["base_url"]."server_error");
            exit;
        }
        $mail_params["to"] = $post["mail"];
        $mail_params["url"] = $this->config->config["base_url"]."client/password/reset/".$regist_token;
        $mail_params["client_contact_name"] = $post["client_name"];

        $this->load->model("Service_email");
        $mail_result = $this->Service_email->reset_pass_2client($mail_params);

        if($mail_result){
            redirect($this->config->config["base_url"]."client/password/forgot");
        }else{
            redirect($this->config->config["base_url"]."server_error");
        }
        exit;
    }

    public function forgot() {
        $this->smarty->display($this->template_path()."/client/password/forgot.html");
    }

    public function reset($token){

        if($token === ""){
            redirect($this->config->config["base_url"]);
            exit;
        }

        $params["select"] = array("account_id");
        $params["where"]["token"] = $token;
        $params["where"]["token_type"] = 2;
        $params["where"]["target_type"] = 2;
        $params["where"]["status"] = 0;

        $this->load->model("Service_token");
        $token_data = $this->Service_token->get_token_list($params);

        if(empty($token_data)){
            redirect($this->config->config["base_url"]);
            exit;
        }elseif(count($token_data) > 1){
            // TODO this patern is problem
            redirect($this->config->config["base_url"]."server_error");
            exit;
        }

        $this->smarty->assign('client_id' , $token_data[0]["account_id"]);
        $this->smarty->assign('token' , $token);

        $this->smarty->display($this->template_path()."/client/password/reset.html");
    }

    public function reset_execute(){
        $post = $this->input->post();
        if(empty($post["client_id"])||empty($post["token"])||empty($post["password"])){
            redirect($this->config->config["base_url"]);
            exit;
        }

        $this->load->model("Service_client");
        $result = $this->Service_client->change_password($post["client_id"],$post["password"]);

        if($result){
            $this->load->model("Service_token");
            $token_invalid_result = $this->Service_token->defeasance_token($post["token"]);
            if($token_invalid_result){
                redirect($this->config->config["base_url"]."client/password/reset_complete");
            }else{
                redirect($this->config->config["base_url"]."server_error");
            }
        }else{
            redirect($this->config->config["base_url"]."server_error");
        }
        exit;
    }

    /*
     password reset and redirect to password_complete
     */
    public function create_new_password() {
        //1. get client id
        //2. create new password
        //$this->Service_account->create_new_password();
        //3. update to new password
        //$this->Service_account->update_password
        //4. send email to notice to new passowrd
        //5. redirect complete page
    }

    /*
     After input email for new pasword, this page will be shown
     */
    public function reset_complete() {
        //1. just show complete page
        //[C_4]
        $this->smarty->display($this->template_path()."/client/password/password_complete.html");
    }

    /*
    this page is just showed
    */
    /**
     * Change password
     * @since 2015/05/05
     */
    public function change_password() {
        //[UL_7]
        $client_id = $this->_get_client_id();
        $client = $this->Service_client->get_detail($client_id);
        if(empty($client_id) || empty($client)){
            redirect(base_url().'client/login/');
        }

        $bc_param = array('mypage', 'profile','change_password_current');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);
        /**
         * Post data
         */
        $post = $this->input->post();
        $result = false;
        if(isset($post) && $post && ! empty($post)){
            if( $this->rule_validate_change_password( $post ) ){
                $this->load->model('Service_client');
                $result = $this->Service_client->change_password($client_id, $post['pass']);
                if($result){
                    redirect(base_url().'client/password/change_password_execute/');
                }
            }

        }

        $this->smarty->display($this->template_path()."/client/password/change_password.html");
    }
    /**
     * Function rule validate change password
     * @param array $post
     * @since 2015/05/05
     */
    protected function rule_validate_change_password( $post ){
        $this->form_validation->set_rules('oldpass', 'Old password', 'required|min_length[8]|callback_matches_password|callback_old_password',
            [
                'required' => '<div class="message"><div class="error | success | warning">現在のパスワードを入力してください。</div></div>',
                'min_length' => '<div class="message"><div class="error | success | warning">現在のパスワードを入力してください。</div></div>',
                'matches_password' => '<div class="message"><div class="error | success | warning">現在のパスワードを入力してください。</div></div>',
                'old_password' => '<div class="message"><div class="error | success | warning">現在のパスワードを入力してください。</div></div>',
            ]);
        $this->form_validation->set_rules('newpass', 'New password', 'required|min_length[8]|callback_matches_password',
            [
                'required' => '<div class="message"><div class="error | success | warning">新しいパスワードを入力してください。</div></div>',
                'min_length' => '<div class="message"><div class="error | success | warning">新しいパスワードを入力してください。</div></div>',
                'matches_password' => '<div class="message"><div class="error | success | warning">新しいパスワードを入力してください。</div></div>',
            ]);
        $this->form_validation->set_rules('pass', 'Password', 'required|min_length[8]|callback_confirm_password['.$post['newpass'].']|callback_matches_password',
            [
                'required' => '<div class="message"><div class="error | success | warning">新しいパスワード（確認用）を入力してください。</div></div>',
                'min_length' => '<div class="message"><div class="error | success | warning">新しいパスワード（確認用）を入力してください。</div></div>',
                'confirm_password' => '<div class="message"><div class="error | success | warning">新しいパスワード（確認用）を入力してください。</div></div>',
                'matches_password' => '<div class="message"><div class="error | success | warning">新しいパスワード（確認用）を入力してください。</div></div>',
            ]);

        return $this->form_validation->run();
    }
    /**
     * Check old password
     * @param string $pass
     * @return boolean
     * @since 2015/05/05
     */
    public function old_password($pass){
        $client_id = $this->_get_client_id();
        $this->load->model('Service_client');
        $client_param["select"] = "";
        $client_param["where"]  = array('client_id'=>$client_id);
        $client_data = $this->Service_client->get_client_data($client_param);
        if(md5($pass) != $client_data[0]['password']){
            return false;
        }
        return true;
    }
    /**
     * Check type password
     * @param string $pass
     * @return boolean
     * @since 2015/05/05
     */
    public function matches_password($pass){
        $pattern = '/^[A-Za-z0-9]+$/i';
        if(! preg_match($pattern, $pass) ){
            return false;
        }
        return true;
    }
    /**
     * Check confirm password
     * @param string $pass
     * @param string $newpass
     * @return boolean
     * @since 2015/05/05
     */
    public function confirm_password($pass, $newpass){
        if($pass != $pass){
            return false;
        }
        return true;
    }
    /*
    this page execute changing password
    */
    public function change_password_execute() {
        $client_id = $this->_get_client_id();
        if(empty($client_id)){
            redirect(base_url().'client/login/');
        }

        //$this->Service_account->change_pass_2user ($param);
        //$this->Service_mail->send_change_password_mail();
        //{UL_11}
        $bc_param = array('client', 'password','change_password', 'change_password_execute_current');

        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

        $this->smarty->display($this->template_path()."/client/password/change_password_execute.html");
    }


}