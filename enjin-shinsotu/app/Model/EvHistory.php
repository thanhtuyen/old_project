<?php
App::uses('AppModel', 'Model');
/**
 * EvHistory Model
 *
 * @property CanCandidate $CanCandidate
 * @property EvSchedule $EvSchedule
 * @property RecRecruiter $RecRecruiter
 * @property CanDocument $CanDocument
 */
class EvHistory extends AppModel {

	protected $_roles = array(ROLE_TYPE_RECRUITER);
    protected $_table = 'ev_histories';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'can_candidate_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'ev_schedule_id' => array(
			'numeric' => array(
				'rule' => 'numeric',
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'rec_recruiter_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'status' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'CanCandidate' => array(
			'className' => 'CanCandidate',
			'foreignKey' => 'can_candidate_id',
			'conditions' => 'CanCandidate.status = 0',
			'fields' => '',
			'order' => ''
		),
		'EvSchedule' => array(
			'className' => 'EvSchedule',
			'foreignKey' => 'ev_schedule_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'RecRecruiter' => array(
			'className' => 'RecRecruiter',
			'foreignKey' => 'rec_recruiter_id',
			'conditions' => 'RecRecruiter.status = 0',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'CanDocument' => array(
			'className' => 'CanDocument',
			'foreignKey' => 'ev_history_id',
			'dependent' => false,
			'conditions' => 'CanDocument.status = 0',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	public function getData($userCompanyId,$findParam){

        $sql = "select EvEvent.name ,last_name,first_name from ev_histories AS EvHistory 
        inner join ev_schedules AS EvSchedule on (EvHistory.ev_schedule_id = EvSchedule.id ) 
        inner join ev_events AS EvEvent on (EvSchedule.ev_event_id = EvEvent.id) 
        inner join can_candidates as CanCandidate ON 
        (EvHistory.can_candidate_id = CanCandidate.id ) where EvEvent.rec_company_id = :id";

        $sql=$this->addSearchCondition($sql,$findParam);

        $params = array(
            'id'=> $userCompanyId
        );
 
        $data = $this->query($sql,$params);
        return $data;
    }

	protected function getCanUpdateConditions(){
		// every rows can update
		return array('conditions'=>array(
			'CanCandidate.rec_company_id' => $this->getUserInfo('rec_company_id'),
			'EvHistory.status' => array(0,1,2,3,4,5)
		));
	}

    /**
     * check status and rec_company_id in session
     * @param null $id
     * @return bool|void
     */
    public  function canDelete($id = null)
    {
        return (bool) $this->find('first',array(
                'conditions' => array(
                    'EvHistory.id' => $id,
                    'CanCandidate.rec_company_id' => $this->getUserInfo('rec_company_id'),
                ),
                'joins' => array(
                    array(
                        'type' => 'LEFT',
                        'table' => 'rec_companies',
                        'alias' => 'RecCompany',
                        'conditions' => array('RecCompany.id = CanCandidate.rec_company_id', 'RecCompany.status = 0')
                    ),
                )
            )
        );
    }
    
    /**
     * 
     * 該当する選考履歴が編集可能かを確認する
     * 
     * @param int
     * @return bool
     * 
     **/
    public function isEdit( $id )
    {   
        //編集可能なステータスを設定
        $select_status_array = array( 0,1,2,3,4,10);

        return (bool) $this->find('count', array(
                                            'conditions'=>array( 
                                                'EvHistory.id'=>$id,
                                                'EvHistory.select_status_id'=>$select_status_array,
                                                'CanCandidate.rec_company_id'=>$this->getUserInfo('rec_company_id'),
                                            )
                                 ));
        
    }

}
