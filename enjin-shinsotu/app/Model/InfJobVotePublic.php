<?php
App::uses('AppModel', 'Model');
/**
 * InfJobVotePublic Model
 *
 * @property JobVote $JobVote
 * @property RefererCompany $RefererCompany
 * @property InfContract $InfContract
 * @property RecRecruiter $RecRecruiter
 */
class InfJobVotePublic extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'job_vote_id' => array(
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
		'referer_company_id' => array(
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
		'inf_contract_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'start_date' => array(
			'datetime' => array(
				'rule' => array('datetime'),
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
		'JobVote' => array(
			'className' => 'JobVote',
			'foreignKey' => 'job_vote_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'RefererCompany' => array(
			'className' => 'RefererCompany',
			'foreignKey' => 'referer_company_id',
			'conditions' => 'RefererCompany.status = 0',
			'fields' => '',
			'order' => ''
		),
		'InfContract' => array(
			'className' => 'InfContract',
			'foreignKey' => 'inf_contract_id',
			'conditions' => 'InfContract.status != 9',
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
	 * check JobOfferStaff by rec_recruiter_id
	 * @param null $vote_id
	 * @param null $rec_id
	 * @param null $status
	 * @return bool
	 */
	public function checkInfJobVotePublicId($job_vote_id =NULL ,$ref_company_id = NULL)
	{
	    $conditions = array(
	    		'InfJobVotePublic.job_vote_id' => $job_vote_id,
	        'InfJobVotePublic.referer_company_id' => $ref_company_id,
	    );

	    $this->recursive = 1;
	    return (boolean) $this->find('first',array(
	            'conditions' => $conditions)
	    );
	}
    
    /**
     * 
     * 公開先求人票に存在する、求人票の名前を取得する。
     * 
     * @param int
     * @return string
     * 
     **/
    public function getRefComanyId( $id )
    {   
        
        $this->recursive = 1;
        $this->contain = array('JobVote');
        $data = $this->find( 'all',array('conditions'=>array(
                                 'InfJobVotePublic.referer_company_id' => $id,
                                 'InfJobVotePublic.status'=>0,
                                 ),
                                 'contain'=>array('JobVote')
                                 ));
        $result = array();
        
        foreach( $data as $row )
        {
            $result[ $row['InfJobVotePublic']['id']] = $row['JobVote']['title'];
        }
        
        return $result;
        
    }

}
