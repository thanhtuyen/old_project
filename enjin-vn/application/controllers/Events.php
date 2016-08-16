<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/controllers/R_Master.php';

/**
 * 市町村区API
 * @author ThinhNH
 *
 */
class Events extends R_Master {

    protected $_model;
	/**
	 * construct
	 */
	public function __construct()
	{
		parent::__construct('Events_model');
	}


	protected function getParameterId(){
		$id = $this->input->get("ev_event_id");

		if( !isset($id) or !is_numeric($id)){
			throw new Exception("ev_event_idが数値ではありません。",REST_ER_PARAM_FORMAT);
		}
		return $id;
	}

        /**
	 * Get object detail
	 * @method : GET
	 * @action: get obect detail
	 * @return JSON format
	 */
	public function index_get()
	{
		try{
            $this->chekapikey();
			$id = $this->getParameterId();
            if(!$this->getRecCompanyId()) {
                throw new Exception("You are not login!", REST_ER_AUTH_ERROR);
            }
			$filters = array(
				'ev_events.status' => 1,
				'ev_events.id' => $id,
				'ev_events.rec_company_id' => $this->getRecCompanyId(),
                'rec_companies.status' => 0
			);

			$list = $this->_model->getBy($filters, null, true,false);
            $object = array();
			if (count($list)>0){
				$object = $list[0];
                $object['schedules'] = $list['schedules'];
                $this->response($object);
            }else{
                throw new Exception ('対象が存在していません。', REST_ER_PAGE_NOTFOUND);
            }
		}catch( Exception $e ){
			$message = $e->getMessage();
			$code    = $e->getCode();
			$this->error_response($message,$code);
		}

	}

	/**
	 * 全件取得
	 * @method: GET
	 * @action: list
	 * @return: json response|error json response
	 */
	public function search_get()
	{
		try {
            $this->chekapikey();
            $jobVoteId = $this->input->get('job_vote_id');
            $type = $this->input->get('type');
            $screeningStageId = $this->input->get('screening_stage_id');
            $screeningStageType = $this->input->get('screening_stage_type');
            $filters = array(
                'ev_events.status= 1',
                'ev_events.rec_company_id = ' . $this->getRecCompanyId()
            );
            if (isset($jobVoteId)) {
                if (is_numeric($jobVoteId)) {
                    $filters[] = 'ev_events.job_vote_id = ' . $jobVoteId;
                } else {
                    throw new Exception('job_vote_id not valid', REST_ER_PARAM_FORMAT);
                }
            }

            if (isset($type)) {
                if (is_numeric($type)) {

                    $filters[] = 'ev_events.type = ' . $type;
                } else {
                    throw new Exception('type not valid', REST_ER_PARAM_FORMAT);
                }
            }

            if (isset($screeningStageId)) {
                if (is_numeric($screeningStageId)) {
                    $filters[] = 'ev_events.screening_stage_id = ' . $screeningStageId;
                } else {
                    throw new Exception('screening_stage_id not valid', REST_ER_PARAM_FORMAT);
                }
            }

            if (isset($screeningStageType)) {
                if (is_numeric($screeningStageType)) {
                    $filters[] = 'ev_events.screening_stage_type = ' . $screeningStageType;
                }else {
                    throw new Exception('screening_stage_type not valid', REST_ER_PARAM_FORMAT);
                }
            }


			// change filters to string
			// to add more conditions we can't do with the array
			$filters = implode(" AND ", $filters);
			$filters .= " AND ( ev_events.job_vote_id is NULL
						OR (job_votes.status = 0 AND rec_departments.status = 0 AND rec_companies.status = 0
							 AND rec_departments.rec_company_id = ".$this->getRecCompanyId()."))";

			$joins  = array(
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
			$options = array(
				'conditions' => $filters,
				'joins' => $joins,
				'fields' => $this->_model->getSelectStringFromLabelMap().'
						,job_votes.status as job_vote_status, rec_departments.status as rec_department_status,
						rec_companies.status as rec_company_status '
			);

			$list = $this->_model->find($options, 'list');
			$this->load->model('Ev_schedules_model', 'schedule');

			foreach ($list as $key=> &$object) {
				$conditions = array(
					'ev_event_id='.$object['id'],
					'status=1 ',
					'holding_date > NOW()',
				);
				$conditions = implode(" AND ", $conditions);
				$conditions .= " AND ( wanted_deadline is NULL OR wanted_deadline > NOW() )";
				$listSchedules = $this->schedule->getBy($conditions,null, true,false);
				$object['schedules'] = $listSchedules;
			}
			$this->response($list);
		}catch( Exception $e ){
			$message = $e->getMessage();
			$code    = $e->getCode();
			$this->error_response($message,$code);
		}
	}


	/**
	 * 全件取得
	 * @method: GET
	 * @action: list
	 * @return: json response|error json response
	 */
	public function list_get()
	{
		try{
            $this->chekapikey();
            if(!$this->getRecCompanyId()) {
                throw new Exception("You are not login!", REST_ER_AUTH_ERROR);
            }
			$filters = array(
                'ev_events.status' => 1,
                'ev_events.rec_company_id' => $this->getRecCompanyId(),
                'rec_companies.status' => 0
			);

            $select = $this->_model->getSelectStringFromLabelMap().' , job_votes.status as job_vote_status, rec_departments.status as rec_department_status,
                     rec_companies.status as rec_company_status, rec_departments.rec_company_id as rec_department_rec_company_id ';
            $list = $this->_model->getALL($filters, $select,null, true,false);

			$this->load->model('Ev_schedules_model', 'schedule');
			foreach ($list as $key => &$object) {
                if($object['job_vote_id']) {
                    if ($object['job_vote_status'] !=0 || $object['rec_department_status'] !=0 || $object['rec_company_status']!=0
                                || $object['rec_department_rec_company_id'] != $this->getRecCompanyId()){
                        unset($list[$key]);
                    }
                }

				$listSchedules = $this->schedule->getScheduleByEventId($object['id']);
				$object['schedules'] = $listSchedules;
			}
            if(count($list) > 0){
                $this->response($list);
            }else{
                throw new Exception ('対象が存在していません。', REST_ER_PAGE_NOTFOUND);
            }

		}catch( Exception $e ){
			$message = $e->getMessage();
			$code    = $e->getCode();
			$this->error_response($message,$code);
		}
	}

	protected function prepareInsertData(){

	}

}