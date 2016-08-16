<?php
App::uses('AppModel', 'Model');
/**
 * CanDocument Model
 *
 * @property CanCandidate $CanCandidate
 * @property EvHistory $EvHistory
 * @property SelStatus $SelStatus
 * @property SelHistory $SelHistory
 */
class CanDocument extends AppModel {

    protected $_table = 'can_document';
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
		),
		'ev_history_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'sel_history_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'file_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'extension' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'binary_data' => array(
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
		'CanCandidate' => array(
			'className' => 'CanCandidate',
			'foreignKey' => 'can_candidate_id',
			'conditions' => 'CanCandidate.status = 0',
			'fields' => '',
			'order' => ''
		),
		'EvHistory' => array(
			'className' => 'EvHistory',
			'foreignKey' => 'ev_history_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'SelHistory' => array(
			'className' => 'SelHistory',
			'foreignKey' => 'sel_history_id',
			'conditions' => 'SelHistory.status = 0',
			'fields' => '',
			'order' => ''
		)
	);

	public function getData($userCompanyId,$findParam){

        $sql = "select CanDocument.id, CanDocument.file_name
		from can_documents as CanDocument inner JOIN sel_histories as SelHistory on (CanDocument.sel_history_id = SelHistory.id)
		inner join job_votes as JobVote on (SelHistory.job_vote_id = JobVote.id )
		inner join rec_departments as RecDepartment on (JobVote.rec_department_id = RecDepartment.id)
		WHERE RecDepartment.rec_company_id = :id";

        $sql=$this->addSearchCondition($sql,$findParam);

        $params = array(
            'id'=> $userCompanyId
        );
 
        $data = $this->query($sql,$params);
        return $data;
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
                    'CanDocument.id' => $id,
                    'CanCandidate.rec_company_id' => $this->getUserInfo('rec_company_id'),
                    'CanDocument.status' => 0, 'CanCandidate.status' => 0,
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
}
