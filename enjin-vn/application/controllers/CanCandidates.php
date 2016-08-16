<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 市町村区API
 * @author koji.fukami
 *
 */
require APPPATH . '/controllers/CRU_Master.php';

class CanCandidates extends CRU_Master {

    protected $_model;
    /**
     * construct
     */
    public function __construct()
    {
        parent::__construct('Cancandidates_model');
    }

    /**
     * @return string|void
     * @throws Exception
     */
    protected function getParameterId() {
        //check API
        $this->chekapikey();
        $id =  $this->getCanCandidateId();
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

        $this->form_validation->set_rules('referer_company_id', '', 'trim|integer');
        $this->form_validation->set_message('integer', '%s is integer');

        $this->form_validation->set_rules('last_name', '', 'trim|required');
        $this->form_validation->set_message('required', '%s is required');

        $this->form_validation->set_rules('first_name', '', 'trim|required');
        $this->form_validation->set_message('required', '%s is required');

        $this->form_validation->set_rules('password', '', 'trim|required');
        $this->form_validation->set_message('required', '%s is required');

        $this->form_validation->set_rules('mail_address', '', 'trim|required|valid_email');
        $this->form_validation->set_message('required|valid_email', '%s is required');

        $this->form_validation->set_rules('mail_address', '', 'trim|required|valid_email');
        $this->form_validation->set_message('required|valid_email', '%s is required');

        $method = $this->input->server("REQUEST_METHOD");
        if( $method == "POST" ){
            $this->form_validation->set_rules('unique_id', '', 'trim|required|is_unique[can_candidates.unique_id]');
            $this->form_validation->set_message('required|is_unique', '%s is required|is_unique');
        }else{
            $condition = "id = ".$postData['id']." AND unique_id = ".$postData['unique_id'];
            $canCandidates = $this->_model->find(array('conditions' => $condition));
            if(empty($canCandidates)){
                $this->form_validation->set_rules('unique_id', '', 'trim|required|is_unique[can_candidates.unique_id]');
                $this->form_validation->set_message('required|is_unique', '%s is required|is_unique');
            }
        }

        $this->form_validation->set_rules('tel', '', 'trim|numeric_hyphen');
        $this->form_validation->set_message('numeric_hyphen', '%s should numeric and hyphen');
        $this->form_validation->set_rules('extension_number', '', 'trim|numeric_hyphen');
        $this->form_validation->set_message('numeric_hyphen', '%s should numeric and hyphen');
        $this->form_validation->set_rules('direct_extension', '', 'trim|numeric_hyphen');
        $this->form_validation->set_message('numeric_hyphen', '%s should numeric and hyphen');
        $this->form_validation->set_rules('cell_number', '', 'trim|numeric_hyphen');
        $this->form_validation->set_message('numeric_hyphen', '%s should numeric and hyphen');

        $this->form_validation->set_rules('cell_mail', '', 'trim|valid_email');
        $this->form_validation->set_message('valid_email', '%s is valid_email');

        $this->form_validation->set_rules('post_code', '', 'trim|numeric_hyphen');
        $this->form_validation->set_message('numeric_hyphen', '%s should numeric and hyphen');

        $this->form_validation->set_rules('home_post_code', '', 'trim|numeric_hyphen');
        $this->form_validation->set_message('numeric_hyphen', '%s should numeric and hyphen');

        $this->form_validation->set_rules('birthday', '', 'trim|valid_date_check');
        $this->form_validation->set_message('valid_date_check', '%s should be in "YYYMMDD" Format');

        $this->form_validation->set_rules('join_possible_date', '', 'trim|required|valid_date_check');
        $this->form_validation->set_message('valid_date_check', '%s should be in "YYYMMDD" Format');

        return $this->form_validation->run();
    }

    protected function prepareInsertData()
    {
        $post = $this->input->post();
        $password = $post['password'];
        $password = crypt($password, $this->config->item('password_salt'));


        if(!isset($post['job_vote_id']) && !isset($post['ev_schedule_id'])) {
            throw new Exception("job_vote_id or ev_schedule_id  (※Either one is required.)。",REST_ER_INPUT_REQUIRED);
        }

        //check job_vote_id exist
        if(isset($post['job_vote_id'])) {
            $jobVoteId = $post['job_vote_id'];
            $this->load->model('Jobvotes_model','jobvotes');
            $jobVoteId = $post['job_vote_id'];
            $jobVotes = $this->jobvotes->byId($jobVoteId, true);
            if(empty($jobVotes)) {
                throw new Exception("job_vote_id not available。",REST_ER_PAGE_NOTFOUND);
            }

        }

        if(isset($post['ev_schedule_id'])) {
            //check ev_schedule_id exist
            $schedulesId = $post['ev_schedule_id'];
            $this->load->model('Ev_schedules_model','schedules');
            $schedules = $this->schedules->byId($schedulesId);
            if(empty($schedules)) {
                throw new Exception("ev_schedule_idが数値ではありません。",REST_ER_PAGE_NOTFOUND);
            }

        }

        //check referer_company_id exist
        if(!empty($post['referer_company_id'])) {
            $this->load->model('Referer_companies_model','refererCompany');
            $refererCompanyId = $post['referer_company_id'];
            $refererCompanies = $this->refererCompany->byId($refererCompanyId, true);
            if(empty($refererCompanies)) {
                throw new Exception("referer_company_id not available。",REST_ER_PAGE_NOTFOUND);
            }
        }


        //check country_id exist
        if(!empty($post['country_id'])) {
            $this->load->model('Countries_model','countries');
            $countryId = $post['country_id'];
            $countries = $this->countries->byId($countryId, true);
            if(empty($countries)) {
                throw new Exception("country_id not available。",REST_ER_PAGE_NOTFOUND);
            }
        }

        //check prefecture_id exist
        if(!empty($post['prefecture_id'])) {
            $this->load->model('Prefectures_model','prefectures');
            $prefectureId = $post['prefecture_id'];
            $prefectures = $this->prefectures->byId($prefectureId, true);
            if(empty($prefectures)) {
                throw new Exception("prefecture_id not available。",REST_ER_PAGE_NOTFOUND);
            }
        }

        //check home_country_id
        if(!empty($post['home_country_id'])) {
            $this->load->model('Countries_model','countries');
            $homeCountryId = $post['home_country_id'];
            $countries = $this->countries->byId($homeCountryId, true);
            if(empty($countries)) {
                throw new Exception("home_country_id not available。",REST_ER_PAGE_NOTFOUND);
            }
        }

        //check home_prefecture_id exist
        if(!empty($post['home_prefecture_id'])) {
            $this->load->model('Prefectures_model','prefectures');
            $homePrefectureId = $post['home_prefecture_id'];
            $prefectures = $this->prefectures->byId($homePrefectureId, true);
            if(empty($prefectures)) {
                throw new Exception("home_prefecture_id not available。",REST_ER_PAGE_NOTFOUND);
            }
        }


        $data = array(
            'last_name' => $post['last_name'],
            'last_name_kana'=>isset($post['last_name_kana'])?$post['last_name_kana']:"",
            'last_name_en' =>isset($post['last_name_en'])?$post['last_name_en']:"",
            'mid_name' =>isset($post['mid_name'])?$post['mid_name']:"",
            'mid_name_en' =>isset($post['mid_name_en'])?$post['mid_name_en']:"",
            'first_name' =>$post['first_name'],
            'first_name_kana' =>isset($post['first_name_kana'])?$post['first_name_kana']:"",
            'first_name_en' =>isset($post['first_name_en'])?$post['first_name_en']:"",
            'face_photo' =>isset($post['face_photo'])?$post['face_photo']:"",
            'mail_address' =>$post['mail_address'],
            'password' =>$password,
            'unique_id' =>isset($post['unique_id'])?$post['unique_id']:"",
            'rec_company_id' =>$this->getRecCompanyIdFromSession(),
            'tel' =>isset($post['tel'])?$post['tel']:"",
            'extension_number' =>isset($post['extension_number'])?$post['extension_number']:"",
            'direct_extension' =>isset($post['direct_extension'])?$post['direct_extension']:"",
            'cell_number' =>isset($post['cell_number'])?$post['cell_number']:"",
            'cell_mail' =>isset($post['cell_mail'])?$post['cell_mail']:"",
            'country_id' =>isset($post['country_id'])?$post['country_id']:"",
            'post_code' =>isset($post['post_code'])?$post['post_code']:"",
            'prefecture_id' =>isset($post['prefecture_id'])?$post['prefecture_id']:"",
            'residence' =>isset($post['residence'])?$post['residence']:"",
            'home_country_id' =>isset($post['home_country_id'])?$post['home_country_id']:"",
            'home_post_code' =>isset($post['home_post_code'])?$post['home_post_code']:"",
            'home_prefecture_id' =>isset($post['home_prefecture_id'])?$post['home_prefecture_id']:"",
            'home_residence' =>isset($post['home_residence'])?$post['home_residence']:"",
            'home_tel' =>isset($post['home_tel'])?$post['home_tel']:"",
            'birthday' =>isset($post['birthday'])?$post['birthday']:"",
            'sex' =>isset($post['sex'])?$post['sex']:"",
            'membership' =>isset($post['membership'])?$post['membership']:"",
            'join_possible_date' =>$post['join_possible_date'],
            'remark' =>isset($post['remark'])?$post['remark']:"",
            'bar_code_id' =>isset($post['bar_code_id'])?$post['bar_code_id']:"",
            'referer_company_id' =>isset($post['referer_company_id'])?$post['referer_company_id']:"",

        );
        $method = $this->input->server("REQUEST_METHOD");
        if( $method == "POST" ){
            $data['last_modified_type'] = 1;
            $data['updatable_flag'] = 1;
            $data['student_regist_date'] = date('Y-m-d H:i:s', time());
            $data['student_modified_date'] = date('Y-m-d H:i:s', time());
            $data['last_login_date'] = date('Y-m-d H:i:s', time());

        }

        return $data;
    }

    /**
     * We use the same object to update and insert
     * @return array|void
     * @throws Exception
     */
    protected function prepareUpdateData(){
        return $this->prepareInsertData();
    }

    /**
     * Insert new object
     * @method: POST
     * @action: index
     * @return: json response|error json response
     */
    public function post_post()
    {
        $this->token_check();
        try{

            $postData = $this->input->post();
            if ($this->checkValidations($postData)){
                $insertData = $this->prepareInsertData();
                $this->db->trans_start();
                //insert
                $id = $this->_model->doInsert($insertData);
                if (!$id){
                    throw new Exception ('新たな情報がインサートできない。', REST_ER_PAGE_NOTFOUND);
                }

                //create selHistories object
                if(isset($postData['job_vote_id']) ) {
                    $screeningStageId = $this->checkSelHistory($postData);

                    $recCompanyId = $this->getRecCompanyIdFromSession();

                    //check candidate_id:status and rec_company_id
                    $this->load->model('Cancandidates_model', 'canCandidates');
                    $canCandidates = $this->canCandidates->checkRecCompanyId($id, $recCompanyId);
                    if( empty($canCandidates)) {
                        throw new Exception("This canCandidates is not available。",REST_ER_PAGE_NOTFOUND);
                    }

                    //check duplicate job_vote_id and can_candidate_id
                    $this->load->model('Sel_histories_model',"selHistory");

                    if($this->selHistory->checkUnique($postData['job_vote_id'], $id)) {
                        throw new Exception('Duplicate data', REST_ER_PAGE_NOTFOUND);
                    }
                    $dataSelHistories = array(
                        'can_candidate_id' => $id,
                        'screening_stage_id' => $screeningStageId,
                        'job_vote_id' => $postData['job_vote_id'],
                    );

                    $this->load->model('Sel_histories_model', 'histories');
                    $this->histories->doInsert($dataSelHistories);
                }


                //create evHistories object
                if(isset($postData['ev_schedule_id'])) {
                    $this->load->model('Ev_histories_model', 'evlHistories');
                    $this->checkEvHistory($postData, $id);
                    $dataEvlHistories = array(
                        'can_candidate_id' => $id,
                        'ev_schedule_id' => $postData['ev_schedule_id']
                    );

                    $this->evlHistories->doInsert($dataEvlHistories);
                }


                //if has error when insert data, rollback all
                if ($this->db->trans_status() === FALSE)
                {
                    $this->db->trans_rollback();
                }
                else
                {
                    $this->db->trans_complete();
                }

                $responseCanCandidate = array();
                if(isset($postData['job_vote_id'])) {
                    $responseCanCandidate['job_vote_id'] = $postData['job_vote_id'];
                }
                if(isset($postData['ev_schedule_id'])) {
                    $responseCanCandidate['ev_schedule_id'] = $postData['ev_schedule_id'];
                }
                $select= "referer_company_id,last_name, last_name_kana, last_name_en,mid_name, mid_name_en,first_name, first_name_kana, first_name_en
								,face_photo,unique_id,mail_address,password,tel,extension_number,direct_extension,cell_number,cell_mail,country_id,
								post_code,prefecture_id,residence,home_country_id,home_post_code,home_prefecture_id,home_residence, home_tel,
								birthday,sex,membership,inf_contract_id,join_possible_date,remark,bar_code_id";
                $responseCanCandidate = array_merge($responseCanCandidate, $this->_model->getById($id, null, $select));
                $this->response($responseCanCandidate);

            }else {
                throw new Exception(validation_errors(), REST_ER_PARAM_REQUIRED);
            }

        }catch( Exception $e ){
            $message = $e->getMessage();
            $code    = $e->getCode();
            $this->error_response($message,$code);
        }

    }

    /**
     * check condition to make new data selHistories
     * @param $postData
     * @throws Exception
     */
    private function checkSelHistory($post)
    {
        $jobVoteId = $post['job_vote_id'];

        $recCompanyId = $this->getRecCompanyIdFromSession();
        $this->load->model('Jobvotes_model', 'jobvotes');
        $jobvotes = $this->jobvotes->getRecCompanyIdByVoteJobId($jobVoteId, $recCompanyId);
        if( empty($jobvotes)) {
            throw new Exception("This jobvotes is not available。",REST_ER_PAGE_NOTFOUND);
        }

        $this->load->model('Screening_stages_model',"stages");
        $screeningStage = $this->stages->getScreeningStageId($recCompanyId);

        if(empty($screeningStage)) {
            throw new Exception("This ScreeningStages is not available。",REST_ER_PAGE_NOTFOUND);
        }

        return $screeningStage['id'];
    }

    /**
     * check condition to make new data evHistories
     * @param $post
     * @param $candidateId
     * @throws Exception
     */
    private function checkEvHistory($post,$candidateId){
        // chẹck the history is exist
        $conditions = array(
            'can_candidate_id' => $candidateId,
            'ev_schedule_id' => $post['ev_schedule_id'],
            'status' => array(0,1)
        );
        $histories = $this->evlHistories->find(array(
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
        if (strtotime($schedule['holding_date'])<=time() || ($schedule['wanted_deadline']!= '' && strtotime($schedule['wanted_deadline'])<=time())){
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
            'joins' => $joins ));

        if (!$event){
            throw new Exception('This event is not available', REST_ER_PAGE_NOTFOUND);
        }

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
            if ($schedule['capacity'] != '' && $countTotal >= $schedule['capacity']){
                throw new Exception('This schedule has over capacity!', REST_ER_NOT_ALLOWED);
            }
        }
        if (!$post){
            parse_str(file_get_contents("php://input"),$post);
        }
    }

}