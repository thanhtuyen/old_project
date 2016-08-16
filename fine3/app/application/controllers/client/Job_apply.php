<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'Client_abstract.php';

class Job_apply extends Client_abstract
{


    public function __construct() {
        parent::__construct();
        if(!$this->_is_client_login() && strpos($this->uri->uri_string,"client/login") === false)redirect($this->config->config["base_url"]."client/login");

        $this->load->library('form_validation');
    }

    /**
     * this page is showed job  applylist of user to job
     */
    public function index() {
        $status_applied =[0,1,2,3];
        $this->_apply_display($status_applied); 
        $this->smarty->display($this->template_path()."/client/apply/index.html");
    }

    /*
    this page is job apply  detail of an applicant
    */
    public function detail() {
        //[C_19]
        $applicant_job_id = $this->uri->segment(4);
        if (empty($applicant_job_id))
        {
             redirect(base_url().'client/job_apply');
        }

        $client_id = $this->checkPermission($applicant_job_id);


        $this->load->model('Service_apply');

        $params = [
            'client_id' => $client_id,
            'applicant_job_id' => $applicant_job_id,
        ];

        //should check
        $data = $this->Service_apply->get_list($params);


        $this->smarty->assign('error', $this->session->flashdata('error'));
        $this->smarty->assign('success', $this->session->flashdata('success'));

        $this->smarty->assign('item', $data['items'][0]);
        $this->smarty->assign('return', base64_encode('/client/job_apply/detail/'.$applicant_job_id));

        $this->smarty->display($this->template_path()."/client/apply/detail.html");
    }

    protected function checkPermission($applicant_job_id = null)
    {


        $client_id = $this->_get_client_id();
        //when unvisiable client id is selected, redirect
        if(empty($client_id)){
            redirect(base_url().'client/');
        }
        
        if ($applicant_job_id > 0)
        {
            if (!$this->Service_apply->checkPermission($applicant_job_id, $client_id))
            {
                 redirect(base_url().'client/job_apply');
            }
        }


        return $client_id;
    }


    /**
     * this action is for new apply to exclution
     * apply user list page and apply user detail page has button to exclue
     * 応募者一覧とか応募者詳細とかに、「この応募を除外申請する」ボタンがある
     *
     */
    public function exclude() {
        //1. get refeller because , when excluded, redirect origin page.
        //2. update applicant_job table 's status from 0 to 1
        //3. send email to admin to admit it
        //   $this->Service_email->apply_exclude_job();
        //4. redirect origin page

        if(!$this->isPost()){
            $this->session->set_flashdata('error', '課金申請が失敗しました。');
            return  redirect(base_url().'client/job_apply');
        }

        $post  = $this->input->post();
        $user_id = $this->checkPermission();
        $post['client_id'] = $user_id;

        $this->load->model('Service_apply');
        if($post['status'] =="confirm"){
            $result = $this->Service_apply->confirm($post['ids']);
        }else if($post['status'] =="exclude"){
            $result = $this->Service_apply->excludeApplicantJob($post);
        }

        $return = 'client/job_apply';

        if ($result)
        {
            $this->session->set_flashdata('success', '申請が完了しました。');
        }else{
            $this->session->set_flashdata('error', '申請が失敗しました。');
        }


        if (isset($post['return']))
        {
            $return = base64_decode($post['return']);
        }

        return redirect($return);
    }

    /**
     * change status = 0
     */
    public function active() {

        if(!$this->isPost()){
        $this->session->set_flashdata('error', '非課金申請が失敗しました。');
        return  redirect(base_url().'client/job_apply');
        }

        $post  = $this->input->post();

        $user_id = $this->checkPermission();

        $post['client_id'] = $user_id;

        $this->load->model('Service_apply');

        $result = $this->Service_apply->activeApplicantJob($post);

        $return = 'client/job_apply';

        if ($result)
        {
            $this->session->set_flashdata('success', '非課金申請が完了しました。');
        }else{
            $this->session->set_flashdata('error', '非課金申請が失敗しました。');
        }


        if (isset($post['return']))
        {
            $return = base64_decode($post['return']);
        }

        return redirect($return);
    }


    /*
    this is Exclusion apply page  (除外申請)
    */
    public function exclusing_list() {
        //[CA_1]
        // 1. get job from applicant_job table  status==1
        $status_applied =[1,2,3];
        $this->_apply_display($status_applied);
        $this->smarty->display($this->template_path()."/client/apply/exclusing_list.html");
    }

    private function _apply_display($status_applied){

        //[C_7]
        $client_id = $this->_get_client_id();
        //when unapplied plan is selected, redirect to plan root.
        if((empty($client_id))&&(empty($client_plan_group_relation_id))){
            redirect(base_url().'client/plan/');
        }
        // End: end check
        //
        $disp_data['start_date_df']  = date("Y-m-d", strtotime( ' - 6 months') );
        $disp_data['end_date_df']    = date("Y-m-d");

        $disp_data['start_date']     = "";
        $disp_data['end_date']       = "";
        $disp_data['keyword']        = '';
        //
        // === Start: Submit get method to search form
        $get = $this->input->get();
        if(! empty($get) && ( isset($get['start_date']) || isset($get['end_date']) || isset($get['keyword']) ) ){
            // Check validate
            $result = $this->validateForm($get);
            // if validate success && result is false
            if($result){
                $disp_data['start_date'] = $get['start_date'];
                $disp_data['end_date'] = $get['end_date'];
                $disp_data['keyword'] = $get['keyword'];
                $disp_data['start_date_df']  = $get['start_date'];
                $disp_data['end_date_df']    = $get['end_date'];
            }
        }

        $perpage = $this->input->get('limit');
        
        $perpage = $perpage ? $perpage : $this->config->item('search_result_rows_default','job_config');

        $curpage = $this->input->get('page');
        $curpage = $curpage ? $curpage : 1;
        $this->load->model('Service_apply');
        if(!empty($get['show_status'])){
            switch ($get['show_status']) {
                case "未確定":
                    # code...
                    $status_applied = array(0);
                    break;
                case "申請中":
                    # code...
                    $status_applied = array(1);
                    break;
                case "非確定":
                    # code...
                    $status_applied = array(2);
                    break;
                case "確定":
                    # code...
                    $status_applied = array(3);
                    break;
                default:
                    # code...
                    break;
            }
        $this->smarty->assign('status_applied',$get['show_status']);
        }else{
        $this->smarty->assign('status_applied',"");

        }
        if(!empty($get['show_wish'])){
            $wish_status = $get['show_wish'];
        }else{
            $wish_status = "";
        }
        $this->smarty->assign('wish_status',$wish_status);
        $params = [
            'client_id' => $client_id,
            'perpage' => $perpage,
            'curpage' => $curpage,
            'keyword' => $this->input->get('keyword'),
            'start_date' => $this->input->get('start_date') ? $this->input->get('start_date') : date('Y-m-d', strtotime( ' - 6 months')),
            'end_date' => $this->input->get('end_date') ? $this->input->get('end_date') : date('Y-m-d'),
            'limit' => $perpage,
            'wish_job' => $wish_status,
            'applicant_status' => $status_applied,
        ];
        $this->smarty->assign($disp_data);
        $data = $this->Service_apply->get_list($params);

        if(empty($data)){
            $this->smarty->assign('data', false);
            $this->smarty->assign('pagination', false);
            $this->smarty->assign('params', false);
        }else{
            $pagination = $this->_get_pagination($data['total'], $data['perpage']);
            $data['error'] = $this->session->flashdata('error');
            if(empty($data['error'])){
                $data['error'] = false;
            }
            $data['success'] = $this->session->flashdata('success');
            if(empty($data['sucecss'])){
                $data['success'] = false;
            }
            // $this->Service_tag->
            $this->smarty->assign('data', $data);
            $this->smarty->assign('pagination', $pagination);
            $this->smarty->assign('params', $params);
        }
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


    public function export_csv()
    {
        $app_job_ids = $this->input->get('job_ids');
        if($app_job_ids){

            $this->load->model('Service_apply');
            $client_id = $this->_get_client_id();

            $params = array(
                'client_id' => $client_id,
                'export_app_job_ids' => $app_job_ids
            );

            $filepath = $this->Service_apply->get_csv_data($params, $this->get_format());
            $this->send_file($filepath);
            exit;
        }
    }
}
?>
