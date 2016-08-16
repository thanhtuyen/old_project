<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'Client_abstract.php';

class Agent_apply extends Client_abstract
{

    public function __construct() {
        parent::__construct();
        if(!$this->_is_client_login() && strpos($this->uri->uri_string,"client/login") === false)redirect($this->config->config["base_url"]."client/login");
        $this->load->helper(['form', 'url','apply']);
        $this->load->library('form_validation', 'pagination');
        $this->load->model('Service_agent');

        //$this->session->set_userdata(array("user_data"=>array("client_login"=>1)));
        //$this->session->set_userdata(array("user_data"=>array()));
    }

    /*
    this page is index of applicants to  agency
    */
    public function index() {
        $status_applied =[0,1,2,3];
        $this->_apply_display($status_applied);
        $this->smarty->display($this->template_path()."/client/agent/index.html");
    }
    /**
     * Validate form
     * @param array $get
     * @return boolean
     * @since 2015/04/23
     */
    protected function validateForm($get){
        // Set data
        $this->form_validation->set_data($get);
        //Rules validate
        $this->form_validation->set_rules(
            'start_date',
            'Start Date',
            'callback_validateStartDate['.$get['end_date'].']|exact_length[10]',
            [
                //'required' => '<span class="help-block form-error"><div style="color:red">応募日の始めの日付を入力してください。</div></span>',
                'validateStartDate' => '<span class="help-block form-error"><div style="color:red">応募日の始めの日付を正しく入力してください。</div></span>',
                'exact_length' => '<span class="help-block form-error"><div style="color:red">応募日の始めの日付を正しく入力してください。</div></span>',
            ]
        );
        $this->form_validation->set_rules(
            'end_date',
            'End Date',
            'exact_length[10]',
            [
                //'required' => '<span class="help-block form-error"><div style="color:red">応募日の終わりの日付を入力してください。</div></span>',
                'exact_length' => '<span class="help-block form-error"><div style="color:red">応募日の終わりの日付を正しく入力してください。</div></span>',
            ]
        );
        //validate input data
        return $this->form_validation->run();
    }
    /**
     * Validate submit post method
     * @since 215/04/23
     * @return boolean
     */
    protected function validateSubmitPost(){
        $this->form_validation->set_rules(
            'applied[]',
            'Apply Agency',
            'callback_validateAppliedRecord',
            [
                'validateAppliedRecord' => '<div class="msg-error"><i class="fa fa-times-circle"></i>応募IDが不正です。</div>',
            ]
        );
        //validate input data
        return $this->form_validation->run();
    }
    /**
     * Validate submit post method to update
     * @since 215/04/24
     * @return boolean
     */
    protected function validateSubmitUpdate(){
        $user_id = $this->input->post('user_id');
        $this->form_validation->set_rules(
            'applied',
            'Apply Agency',
            'callback_validateBeforeUpdate['.$user_id.']',
            [
                'validateBeforeUpdate' => '<div class="msg-error"><i class="fa fa-times-circle"></i>このユーザーの情報はご覧いただけません。</div>',
            ]
        );
        //validate input data
        return $this->form_validation->run();
    }
    /**
     * Validate user_id, client_id, applicant_agency_id
     * @param int $user_id
     * @return boolean
     * @since 2015/04/24
     */
    public function validateBeforeUpdate($applicant_agency_id, $user_id){
        $post = $this->input->post();
        $arg = ['valid', 'pending'];
        if(! isset($post['form']) || ! in_array($post['form'], $arg)){
            return false;
        }
        $client_data = $this->session->userdata('client_data');
        $client_id = $client_data['client_id'];
        $result = $this->Service_agent->get($client_id, $applicant_agency_id);

        if( ! $result ){
            return false;
        }elseif($result['client_id'] != $client_id){
            return false;
        }
        return true;
    }
    /**
     * Validate user when submit change status agency
     * @param int $applied
     * @return boolean
     * @since 2015/04/23
     */
    public function validateAppliedRecord($applied){
        $client_data = $this->session->userdata('client_data');
        $client_id = $client_data['client_id'];
        if(intval($applied) > 0){
            $result = $this->Service_agent->get($client_id, $applied);
            if(! $result){
                return false;
            }
        }
        return true;
    }
    /**
     * Check Start date
     * @param string $start_date
     * @param string $end_date
     * @return boolean
     */
    public function validateStartDate($start_date, $end_date){
        if(! empty($start_date) || ! empty($end_date)){
            $date = DateTime::createFromFormat("Y-m-d", $start_date);
            if( ! $date ){
                return false;
            }
            if( strtotime($start_date) > strtotime($end_date) ){
                return false;
            }
        }
        return true;
    }
    /*
    this page is detail of an applicant of agent
    */
    public function detail( $applicant_agency_id = null ) {
        //[CA_3]
        //1. get user info who apply this agent
        //$this->smarty->assign($sample, $sample);
        if(! $applicant_agency_id ){
            $this->session->set_flashdata('error', '<i class="fa fa-times-circle"></i>詳細情報を見るデータを選択してください。');
            return  redirect(base_url().'client/agent_apply/index');
        }

        // Start: Check Client login
        $client_data = $this->session->userdata('client_data');
        $client_id = $client_data['client_id'];
        if (! $client_id){
             redirect(base_url().'client/account/login');
        }
        // End: end check
        //
        // Get detail User applied
        $paramDetail = ['applicant_agency_id' => $applicant_agency_id];
        $detailUserApplied = $this->Service_agent->get_detail_applied($paramDetail);
        if(! $detailUserApplied || empty($detailUserApplied)){
            $this->session->set_flashdata('error', '<i class="fa fa-times-circle"></i>このユーザーの情報はご覧いただけません。');
            return  redirect(base_url().'client/agent_apply/index');
        }
        $data['detailUserApplied'] = $detailUserApplied;

        // === Start: Submit Post method to update status
        $post = $this->input->post();
        if($post && ! empty($post)){
            $validatePost = $this->validateSubmitUpdate();
            //when confirm
                $updateResult = false;
                if(isset($post['form']) && $post['form'] == 'confirm' ){
                    // Update status to confirm (status = 3)
                    $paramUpdate = [
                            'status' => 3,
                            'applicant_agency_id' => [$post['applied']],
                            'comment' => strip_tags($post['comment']),
                            'current_status' => [0,3]
                    ];
                    $updateResult = $this->Service_agent->update_pending($paramUpdate);

                    if ($updateResult){
                        $this->session->set_flashdata('success_detail', '<i class="fa fa-check"></i>申請が完了しました。');
                        return  redirect(base_url().'client/agent_apply/detail/'.$post['applied']);
                    }else{
                        $this->session->set_flashdata('error_detail', '<i class="fa fa-times-circle"></i>申請が失敗しました。');
                    }
                }else if($validatePost){
                // if validate post method success and true
                // ==> update status applicant_agency table
                if(isset($post['form']) && $post['form'] == 'valid' ){

                    // Update status to pending (status = 1)
                    $paramUpdate = [
                            'status' => $this->config->item('done', 'apply_config'),
                            'applicant_agency_id' => [$post['applied']],
                            'comment' => strip_tags($post['comment']),
                            'current_status' => [0,3]
                    ];
                    $updateResult = $this->Service_agent->update_pending($paramUpdate);
                }
                if(isset($post['form']) && $post['form'] == 'pending'){

                    // Update status to valid (status = 0)
                    $paramUpdate = [
                            'status' => $this->config->item('none', 'apply_config'),
                            'applicant_agency_id' => [$post['applied']],
                            'current_status' => [1]
                    ];
                    $updateResult = $this->Service_agent->update_valid($paramUpdate);
                }
                if($updateResult){
                    $this->session->set_flashdata('success_detail', '<i class="fa fa-check"></i>非課金申請についての変更を完了しました。');
                    return  redirect(base_url().'client/agent_apply/detail/'.$post['applied']);
                }else{
                    $this->session->set_flashdata('error_detail', '<i class="fa fa-times-circle"></i>非課金申請についての変更が出来ませんでした。');
                }
            }
        }
        // Show message
        $data['error'] = $this->session->flashdata('error_detail');
        $data['success'] = $this->session->flashdata('success_detail');
        // === End

        $this->smarty->assign($data);
        $this->smarty->display($this->template_path()."/client/agent/detail.html");
    }


    /*
    this page is agent apply  detail of an applicant
    */
    public function detail_apply() {
        //[C_19]
        //1. get apply
        //$this->smarty->assign($sample, $sample);i
        $this->smarty->display($this->template_path()."/client/apply/detail.html");
    }

    /*
    this action is for new apply to exclution
    apply user list page and apply user detail page has button to exclue
    応募者一覧とか応募者詳細とかに、「この応募を除外申請する」ボタンがある
    */
    public function exclude() {
        //1. get refeller because , when excluded, redirect origin page.
        //2. update applicant_agent table 's status from 0 to 1
        //3. send email to admin to admit it
        //   $this->Service_email->apply_exclude_agent();
        //4. redirect origin page
    }
    /*
    this is Exclusion apply page  (除外申請リスト)
    */
    public function exclusing_list() {
        $status_applied =[1,2,3];
        $this->_apply_display($status_applied);
        $this->smarty->display($this->template_path()."/client/agent/exclusing_list.html");

    }
    private function _apply_display($status_applied){

        //[CA_4]
        // 1. get job from applicant_agent table  status==1
        // 
        
        //[CA_1]
        //1 .get applicant info from applicant_agency table of this client apply.
        // Start: Check Client login

        //login check
        $client_id = $this->_get_client_id();
        if($client_id === false){
            redirect(base_url().'client/');
        }

        // End: end check
        //
        $data['start_date_df']  = date("Y-m-d", strtotime( ' - 6 months') );
        $data['end_date_df']    = date("Y-m-d");

        $data['start_date']     = "";
        $data['end_date']       = "";
        $data['keyword']        = '';
        //
        // === Start: Submit get method to search form
        $get = $this->input->get();
        if(! empty($get) && ( isset($get['start_date']) || isset($get['end_date']) || isset($get['keyword']) ) ){
            // Check validate
            $result = $this->validateForm($get);
            // if validate success && result is false
            if($result){
                $data['start_date'] = $get['start_date'];
                $data['end_date'] = $get['end_date'];
                $data['keyword'] = $get['keyword'];
                $data['start_date_df']  = $get['start_date'];
                $data['end_date_df']    = $get['end_date'];
            }
        }
        // === End
        //
        // === Start: Submit Post method to update status
        $post = $this->input->post();
        if($post && ! empty($post)){
            $validatePost = $this->validateSubmitPost();
            $updateResult = false;
                if(isset($post['form']) && $post['form'] == 'confirm' ){
                    // Update status to confirm (status = 3)
                    if(empty($post['comment'])){
                        $post['comment'] = "";
                    }
                    $paramUpdate = [
                            'status' => 3,
                            'applicant_agency_id' => [$post['applied']],
                            'comment' => strip_tags($post['comment']),
                            'current_status' => [0,3]
                    ];
                    $updateResult = $this->Service_agent->confirm($paramUpdate);
                }else if($validatePost){
                if( isset($post['applied'][0]) && intval($post['applied'][0]) == 0 ){
                    unset($post['applied'][0]);
                }
                // if validate post method success and true
                // ==> update status applicant_agency table
                $paramUpdate = [
                    'status' => $this->config->item('done', 'apply_config'),
                    'applicant_agency_id' => $post['applied']
                ];
                $updateResult = $this->Service_agent->update_status($paramUpdate);
                if($updateResult){
                    $this->session->set_flashdata('success_index', '<i class="fa fa-check"></i>非課金申請が完了しました。');
                }else{
                    $this->session->set_flashdata('error_index', '<i class="fa fa-times-circle"></i>非課金申請が失敗しました。');
                }
            }
        }
        // Show message
        $data['error'] = $this->session->flashdata('error_index');
        $data['success'] = $this->session->flashdata('success_index');
        // === End
        // Get all user applied agency
        // 1. start-end date
        // 2. client_id
        // 3. keyword: name user | tag name (tag_license)
        $params = [
            'client_id'             => $client_id,
            'start_date'            => $data['start_date'],
            'end_date'              => $data['end_date'],
            'keyword'               => $data['keyword'],
            'tag_license'           => $this->config->item('tag_license', 'tag_config'),
            'type_relation_user'    => $this->config->item('type_relation_user', 'tag_config'),
            'delete_flg'            => $this->config->item('not_deleted', 'common_config'),
            'status'                => $this->config->item('active', 'user_config'),
            'status_applied'        => $status_applied
        ];
        $total_row = $this->Service_agent->count_user_applied($params);
        
        // Get result and pagination
        $limit = '';
        if( isset($get['limit']) && isset($get['limit']) <= 50 ){
            $limit = intval($get['limit']);
        }
        $limit = $limit ? $limit : $this->config->item('search_result_rows_default','job_config');
        
        $data['limit'] = $limit;
        $page = (int) (isset($_GET['page']) ? $_GET['page'] : 1);
        $data['page'] = $page > 1 ? $page : 1;
        $params['limit'] = $limit;
        $params['offset'] = ($page - 1) *  $limit;
        $data['total'] = $total_row;
        // Search user applied agency
        $searchData = $this->Service_agent->search_user_applied_agency($params);
        $data['Records'] = $searchData;
        // Define count page
        $data['from_item'] = 0;
        $data['to_item']   = 0;
        if($data['total'] > 0){
            $data['from_item'] =  ($data['limit'] * ($data['page'] - 1)) +1 ;
            $data['to_item'] =    ($data['from_item'] + $data['limit']) -1;
        }

        if($data['to_item'] > $data['total']){
            $data['to_item'] = $data['total'];
        }

        // Pagination
        $page_config = $this->_get_pagination($data['total'], $limit);
        $this->smarty->assign('pagination',$page_config);
        $this->smarty->assign($data);

    }



}
?>
