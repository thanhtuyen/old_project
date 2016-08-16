<?php
App::uses('AppModel', 'Model');
/**
 * EvPersonnel Model
 *
 * @property EvEvent $EvEvent
 * @property RecRecruiter $RecRecruiter
 */
class EvPersonnel extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'ev_event_id' => array(
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
		'rec_recruiter_id' => array(
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
		'EvEvent' => array(
			'className' => 'EvEvent',
			'foreignKey' => 'ev_event_id',
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
     * check duplicate between ev_event_id and rec_recruiter_id
     * @param $eventId
     * @param $recruiterId
     * @return bool
     */
    public function checkUnique($eventId, $recruiterId) {

        return (bool)$this->find('count',array(
                'conditions' => array(
                    'EvPersonnel.ev_event_id' => $eventId ,
                    'EvPersonnel.rec_recruiter_id' => $recruiterId,
                    'EvPersonnel.status' => 0,
                    'OR' => array(
                        array('EvEvent.status' => 0),
                        array('EvEvent.status' => 1),
                        array('EvEvent.status' => 2),
                        array('EvEvent.status' => 9)
                    )
                ),
            )
        );
    }

    /**
     * check EvPersonnel's status and RecRecruiter's status and RecDepartment's status
     * check RecCompany's status and rec_company_id in session
     * @param null $id
     * @return bool|void
     */
    public  function canDelete($id = null)
    {
        $conditions = array(
            'EvPersonnel.id' => $id ,
            'EvPersonnel.status' => 0,
            'RecDepartment.rec_company_id' => $this->getUserInfo('rec_company_id'),
            'RecDepartment.status' => 0,
            'RecCompany.status' => 0,
            'RecRecruiter.status'=> 0);

        $joins = array(
            array(
                'table' => 'rec_departments',
                'alias' => 'RecDepartment',
                'conditions' => 'RecDepartment.id = RecRecruiter.rec_department_id'
            ),
            array(
                'table' => 'rec_companies',
                'alias' => 'RecCompany',
                'conditions' => 'RecCompany.id = RecDepartment.rec_company_id'
            )
        );

        return (boolean) $this->find('first',array(
                'joins' => $joins,
                'conditions' => $conditions)
        );
    }

    /**
     * 
     * イベント一覧用の申し込み詳細数の取得
     * 
     * @param int
     * 
     * @return array
     * 
     **/
    public function getEventSearchData( $event_id )
    {   
    
        $this->recursive = -1;
        return $this->find('count',array( "conditions"=>array(
                                        'ev_event_id'=>$event_id,
                                        'status'=>0 )));
        
    }


}
