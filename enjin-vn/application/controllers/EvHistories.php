<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/controllers/CRU_Master.php';

/**
 * 市町村区API
 * @author koji.fukami
 *
 */
class EvHistories extends CRU_Master {

    /**
     * construct
     */
    public function __construct()
    {
        parent::__construct('Ev_histories_model');
    }

    /**
     * Get primary ID
     * @return integer
     */
    protected function getParameterId(){
        $this->chekapikey();
        $method = $this->input->server("REQUEST_METHOD");
        if( $method == "GET" ){
            $id = $this->input->get("ev_history_id");
        }else {
            parse_str(file_get_contents("php://input"),$var_array);
            $id = isset($var_array["ev_history_id"])?$var_array["ev_history_id"]:'';
        }
        if( !isset($id) or !is_numeric($id)){
            throw new Exception("IDが数値ではありません。",REST_ER_PARAM_FORMAT);
        }
        return $id;
    }


    protected  function checkValidations($postData = false)
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('enjin_helper');
        $this->form_validation->set_data($postData);
        $method = $this->input->server("REQUEST_METHOD");
        if ($method=="POST"){
            $this->form_validation->set_rules('ev_schedule_id', '', 'trim|required|integer');
            return $this->form_validation->run();
        }
        return true;

    }

    protected  function prepareInsertData()
    {
        $post = $this->input->post();
        // check candidateId
        $sessionCandidateId = $this->getCanCandidateId();
        // chẹck the history is exist
        $conditions = array(
            'can_candidate_id' => $sessionCandidateId,
            'ev_schedule_id' => $this->input->post('ev_schedule_id'),
            'status' => array(0,1)
        );
        $histories = $this->_model->find(array(
            'conditions' => $conditions
        ));
        if ($histories){
            throw new Exception('Duplicate data', REST_ER_PAGE_NOTFOUND);
        }

        // check capacity of schedule
        $this->load->model('Ev_stats_model', 'stats');
        $this->load->model('Ev_schedules_model', 'schedules');
        $this->load->model('Events_model', 'events');
        $this->load->model('JobVotes_model', 'jobVotes');
        $scheduleId = $this->input->post('ev_schedule_id');
        $schedule = $this->schedules->byId($scheduleId);
        if (!$schedule){
            throw new Exception('This schedule is not available', REST_ER_PAGE_NOTFOUND);
        }
        if ( $schedule['status'] != 1) {
            throw new Exception('Only accept schedule has status = 1', REST_ER_PAGE_NOTFOUND);
        }
        if ( strtotime($schedule['holding_date'])<=time() || (isset($schedule['wanted_deadline']) && strtotime($schedule['wanted_deadline'])<=time())){
            throw new Exception('This date of this schedule is over!', REST_ER_PAGE_NOTFOUND);
        }

        $eventFilters  = " (ev_events.job_vote_id is NULL OR (
                            job_votes.status = 0 AND rec_departments.status = 0
                            AND rec_departments.rec_company_id = ".$this->getRecCompanyId()
                            ." AND rec_companies.status = 0 )) AND ev_events.id = ".$schedule['ev_event_id'];
        $joins = array(
            array(
                'table' => 'rec_departments',
                'join' => 'rec_departments.id = job_votes.rec_department_id',
                'type' => 'left'
            ),array(
                'table' => 'rec_companies',
                'join' => 'rec_companies.id = rec_departments.rec_company_id',
                'type' => 'left'
            ),

        );
        $event = $this->events->find(array(
            'conditions' => $eventFilters,
            'joins' => $joins
        ));
        if (!$event){
            throw new Exception('This event is not available', REST_ER_PAGE_NOTFOUND);
        }
        //print_r($event);die;
        if ($event['status']!=1 ){
            throw new Exception('Only accept event has status = 1', REST_ER_PAGE_NOTFOUND);
        }

        if ($event['job_vote_id']){
            $conditions = array(
                'job_votes.id' => $event['job_vote_id'],
                'rec_departments.status' => 0,
                'rec_companies.status' => 0
            );

            $jobVote = $this->jobVotes->find(array(
                'conditions' => $conditions,
            ));
            if (!$jobVote){
                throw new Exception('The job vote is not available!', REST_ER_PAGE_NOTFOUND);
            }
        }
        $conds = "ev_schedule_id=".$post['ev_schedule_id']." and ev_event_id=".$schedule['ev_event_id']." AND ev_history_status in (0,1)";
        $stats = $this->stats->getBy($conds, '', false, false);
        if (count($stats)>0 ){
            $countTotal = 0;
            foreach ($stats as $stat){
                $countTotal += $stat['count'];
            }
            if ($countTotal >= $schedule['capacity']){
                throw new Exception('This schedule has over capacity!', REST_ER_NOT_ALLOWED);
            }
        }
        if (!$post){
            parse_str(file_get_contents("php://input"),$post);
        }
        $data = array(
            'can_candidate_id' => $this->getCanCandidateId(),
            'ev_schedule_id' => $post['ev_schedule_id'],
            'status'           => isset($post['status'])?$post['status']:0
        );
        return $data;
    }

    /**
     * We use the same object to update and insert
     * @return array|void
     * @throws Exception
     */
    protected function prepareUpdateData(){
        parse_str(file_get_contents("php://input"),$post);

        // check candidateId
        $sessionCandidateId = $this->getCanCandidateId();
        $historyId = $post['ev_history_id'];
        $history = $this->_model->getById($historyId);
        if (!$history){
            throw new Exception('The data is not available', REST_ER_PAGE_NOTFOUND);
        }
        $postCandidateId = $history['can_candidate_id'];
        if ($sessionCandidateId != $postCandidateId){
            throw new Exception ('The candidateId is not allowed!',REST_ER_PARAM_FORMAT);
        }
        $this->load->model('Ev_schedules_model', 'schedules');
        $this->load->model('Events_model', 'events');
        $schedule = $this->schedules->byId($history ['ev_schedule_id']);
        if (!$schedule){
            throw new Exception('This schedule is not available', REST_ER_PAGE_NOTFOUND);
        }
        $event = $this->events->byId($schedule['ev_event_id']);
        if (!$event){
            throw new Exception('This event is not available', REST_ER_PAGE_NOTFOUND);
        }
        if ($event['rec_company_id'] != $this->getRecCompanyIdFromSession()){
            throw new Exception ('The rec_company_id is not allowed!',REST_ER_PARAM_FORMAT);
        }
        $data = array(
            'status' => 2
        );
        return $data;
    }

    public function listByCandidate_get()
    {
        try{
            $this->checkCanCandidateId();
            $conditions = array(
                'ev_histories.can_candidate_id' => $this->getCanCandidateId(),
                'ev_histories.status <>' => 9,
                'can_candidates.status' => 0,
                'can_candidates.rec_company_id' => $this->getRecCompanyIdFromSession(),
            );
            $joins = array(
                array(
                    'table' => 'ev_schedules',
                    'join' => 'ev_schedules.id = ev_histories.ev_schedule_id',
                    'type' => 'left'
                ),array(
                    'table' => 'ev_events',
                    'join' => 'ev_events.id = ev_schedules.ev_event_id',
                    'type' => 'left'
                ),array(
                    'table' => 'job_votes',
                    'join' => 'job_votes.id = ev_events.job_vote_id',
                    'type' => 'left'
                ),array(
                    'table' => 'screening_stages',
                    'join' => 'screening_stages.id = ev_events.screening_stage_id',
                    'type' => 'left'
                ),array(
                    'table' => 'can_candidates',
                    'join' => 'can_candidates.id = ev_histories.can_candidate_id',
                    'type' => 'left'
                )

            );
            $this->load->model('Events_model');
            $fields = $this->Events_model->getSelectStringFromLabelMap();
            $list = $this->_model->find(array(
                'conditions' => $conditions,
                'joins' => $joins,
                'fields' => $fields
            ), 'list');
            if (!$list){
                throw new Exception('No object found',REST_ER_PAGE_NOTFOUND);
            }
            $this->load->model('Ev_schedules_model', 'schedule');
            foreach ($list as $key => &$object) {
                $conditions ='ev_event_id = '.$object['id'].' AND status=1 AND holding_date > NOW()';
                //'>' => date('Y-m-d H:i:s', time()
                $conditions .= " AND (ev_schedules.wanted_deadline is null OR ev_schedules.wanted_deadline > NOW())";

                $listSchedules = $this->schedule->find(array(
                    'conditions'=>$conditions
                ));
                $object['schedules'] = $listSchedules;
            }
            $this->response($list);
        }catch( Exception $e ){
            $message = $e->getMessage();
            $code    = $e->getCode();
            $this->error_response($message,$code);
        }

    }

    protected function getOptionsForLock(){
        $id =  $this->getParameterId();
        $filters = array(
            "ev_histories.id" => $id,
            "ev_histories.{$this->_candidateIdFkKey}" =>$this->getCanCandidateId(),
            'ev_histories.status' => 0,
            'can_candidates.status' => 0,
            'can_candidates.rec_company_id' => $this->getRecCompanyIdFromSession(),
        );
        $joins = array(
            array(
                'table' => 'can_candidates',
                'join' => 'can_candidates.id = ev_histories.can_candidate_id',
                'type' => 'left'
            )

        );
        return array(
            'conditions' => $filters,
            'joins' => $joins,
            'fields' => 'ev_histories.*'
        );

    }

    protected function getDetailOptions(){
        $id =  $this->getParameterId();
        $filters = array(
            "ev_histories.id" => $id,
            "ev_histories.{$this->_candidateIdFkKey}" =>$this->getCanCandidateId(),
            'can_candidates.status' => 0,
            'ev_histories.status <>' => 9,
            'can_candidates.rec_company_id' => $this->getRecCompanyIdFromSession(),
        );
        $joins = array(
            array(
                'table' => 'can_candidates',
                'join' => 'can_candidates.id = ev_histories.can_candidate_id',
                'type' => 'left'
            )

        );
        return array(
            'conditions' => $filters,
            'joins' => $joins,
            'fields' => 'ev_histories.*'
        );
    }
}