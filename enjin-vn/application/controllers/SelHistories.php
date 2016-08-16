<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 市町村区API
 * @author koji.fukami
 *
 */
require APPPATH . '/controllers/CRU_Master.php';

class SelHistories extends CRU_Master {

    /**
     * construct
     */
    public function __construct()
    {
        parent::__construct('Sel_histories_model');
    }

    protected function getParameterId(){
        $id = $this->input->get('sel_history_id');
        if( !is_numeric($id) ){
            throw new Exception("sel_history_idが数値ではありません。",REST_ER_PARAM_FORMAT);
        }
        return $id;
    }

    /**
     * Check valid the data
     * @param bool $postData
     * @return mixed
     */
    protected  function checkValidations($postData = false)
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('enjin_helper');
        $this->form_validation->set_data($postData);

        $this->form_validation->set_rules('job_vote_id', '', 'trim|required');
        $this->form_validation->set_message('required', '%s is required');

        $this->form_validation->set_rules('start_date', '', 'trim|valid_date_check');
        $this->form_validation->set_message('valid_date_check', '%s should be in "YYYYMMDD" Format');
        $this->form_validation->set_rules('end_date', '', 'trim|valid_date_check');
        $this->form_validation->set_message('valid_date_check', '%s should be in "YYYYMMDD" Format');

        $this->form_validation->set_rules('influx_propriety', '', 'trim|integer');
        $this->form_validation->set_message('integer', '%s is integer');
        $this->form_validation->set_rules('candidate_propriety', '', 'trim|integer');
        $this->form_validation->set_message('integer', '%s is integer');
        $this->form_validation->set_rules('last_modified_type', '', 'trim|integer');
        $this->form_validation->set_message('integer', '%s is integer');

        return $this->form_validation->run();
    }

    protected function prepareInsertData()
    {
        $post = $this->input->post();
        if(isset($post['job_vote_id'])) {
            $jobVoteId = $post['job_vote_id'];
        }else{
            throw new Exception("job_vote_id is required。",REST_ER_PARAM_FORMAT);
        }

        // get candidateId
        $canCandidateId = $this->getCanCandidateId();

        $recCompanyId = $this->getRecCompanyIdFromSession();

        //check jobvote_id: status and rec_company_id
        $this->load->model('Jobvotes_model', 'jobvotes');
        $jobvotes = $this->jobvotes->getRecCompanyIdByVoteJobId($jobVoteId, $recCompanyId);
        if( empty($jobvotes)) {
            throw new Exception("This jobvotes is not available。",REST_ER_PAGE_NOTFOUND);
        }

        //check candidate_id:status and rec_company_id
        $this->load->model('Cancandidates_model', 'canCandidates');
        $canCandidates = $this->canCandidates->checkRecCompanyId($canCandidateId, $recCompanyId);
        if( empty($canCandidates)) {
            throw new Exception("This canCandidates is not available。",REST_ER_PAGE_NOTFOUND);
        }

        //check screening_stage_id:status and rec_company_id
        $this->load->model('Screening_stages_model',"stages");
        $screeningStage = $this->stages->getScreeningStageId($recCompanyId);

        if(empty($screeningStage)) {
            throw new Exception("This ScreeningStages is not available。",REST_ER_PAGE_NOTFOUND);
        }

        //check duplicate job_vote_id and can_candidate_id
        $this->load->model('Sel_histories_model',"selHistory");
        if($this->selHistory->checkUnique($jobVoteId, $canCandidateId)) {
            throw new Exception('Duplicate data', REST_ER_PAGE_NOTFOUND);
        }
        $data = array(
            'can_candidate_id' => $canCandidateId,
            'screening_stage_id' => isset($screeningStage['id'])?$screeningStage['id']:'',
            'job_vote_id' => isset($post['job_vote_id'])?$post['job_vote_id']:'',
            'select_status_id' => 0,
            'select_option_id' => isset($post['select_option_id'])?$post['select_option_id']:'',
            'comment' => isset($post['comment'])?$post['comment']:'',
            'start_date' => isset($post['start_date'])?$post['start_date']:'',
            'end_date' => isset($post['end_date'])?$post['end_date']:'',
            'influx_propriety' => 2,
            'candidate_propriety' => 2,
            'last_modified_type' => 0,
            'rec_recruiter_id' => isset($post['rec_recruiter_id'])?$post['rec_recruiter_id']:'',

        );

        return $data;
    }

}