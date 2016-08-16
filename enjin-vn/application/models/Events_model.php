<?php

/**
 * イベントmodel
 * @author koji.fukami
 *
 */
class Events_model extends Enjin_model {

	protected $_table = 'ev_events';

	protected $_primaryKeyField = 'id';

	protected $_labelsMap = array (
		'ev_events.id' => 'id',
		'ev_events.name' => 'name',
		'job_vote_id' => 'job_vote_id',
        'job_votes.title' => 'job_vote_title',
		'ev_events.type' => 'type',
		'screening_stages.name' => 'screening_stage_name',
		'target_select_id' => 'target_select_id',
		'contents' => 'contents',
		'ev_events.status' => 'status'
	);

	protected $_joinTables = array (

		array(
			'table' => 'screening_stages',
			'join' => 'screening_stages.id = ev_events.screening_stage_id',
			'type' => 'left'
		),
		array(
			'table' => 'job_votes',
			'join' => 'job_votes.id = ev_events.job_vote_id',
			'type' => 'left'
		)
	);

	/**
	 * construct
	 */
	public function __construct()
	{
		parent::__construct();
	}

	public function getBy($filters, $customSelect = '', $useJoinTable = true, $checkStatus = false){

        $joins = array( array(
            'table' => 'rec_companies',
            'join' => 'rec_companies.id = ev_events.rec_company_id',
            'type' => 'left'
            )
        );
        $this->_joinTables = array_merge($this->_joinTables, $joins);
        $object = parent::getBy($filters, $customSelect, $useJoinTable, $checkStatus);

        if (isset($object[0]['job_vote_id'])){
            $joins = array(
                array(
                    'table' => 'rec_departments',
                    'join' => 'rec_departments.id = job_votes.rec_department_id ',
                    'type' => 'left',
                )
            );
            $filters['job_votes.status'] = 0;
            $filters['rec_departments.rec_company_id'] = $filters['ev_events.rec_company_id'];
            $filters['rec_departments.status'] = 0;

            $this->_joinTables = array_merge($this->_joinTables, $joins);
            $object = parent::getBy($filters, $customSelect, $useJoinTable, $checkStatus);
        }


		$this->load->model('Ev_schedules_model', 'schedule');
        if($object) {
            $listSchedules = $this->schedule->getScheduleByEventId($object[0]['id']);
            if ($object){
                $object['schedules'] = $listSchedules;
                return $object;
            }
        }
		return array();
	}

	public function getAll($filters = array(), $select= true, $order='',  $useJoinTables = true, $checkStatus = false){

        $join = array( array(
            'table' => 'rec_companies',
            'join' => 'rec_companies.id = ev_events.rec_company_id',
            'type' => 'left'
            ),array(
                'table' => 'rec_departments',
                'join' => 'rec_departments.id = job_votes.rec_department_id',
                'type' => 'left'
            )
        );
        $this->_joinTables = array_merge($this->_joinTables, $join);
        $listObject = parent::getAll($filters, $select, $order,  $useJoinTables, $checkStatus);

		return $listObject;
	}

	public function getAllByCandidateId($candidateId){

		$listObject = $this->db->from('ev_histories h')
				->join('ev_schedules s', 's.id = h.ev_schedule_id')
				->join ('ev_events e', 'e.id = s.ev_event_id')
				->select('e.*')
				->where ('s.status', DATABASE_OBJECT_STATUS_ON)
				->where ('e.status', DATABASE_OBJECT_STATUS_ON)
				->where ('h.status', DATABASE_OBJECT_STATUS_ON)
				->where ('h.can_candidate_id',$candidateId)
				->get()
				->result_array();
		$this->load->model('Ev_schedules_model', 'schedule');
		foreach ($listObject as &$object) {
			$listSchedules = $this->schedule->getBy(array('ev_event_id'=>$object['id']));
			$object['schedules'] = $listSchedules;
		}

		return $listObject;
	}
}