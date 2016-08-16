<?php
App::uses('AppModel', 'Model');
/**
 * RecruitmentArea Model
 *
 * @property RecCompany $RecCompany
 * @property JobVote $JobVote
 */
class RecruitmentArea extends AppModel {

	public $displayField = 'area';


/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'area' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'rec_company_id' => array(
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
		'RecCompany' => array(
			'className' => 'RecCompany',
			'foreignKey' => 'rec_company_id',
			'conditions' => 'RecCompany.status = 0',
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
		'JobVote' => array(
			'className' => 'JobVote',
			'foreignKey' => 'recruitment_area_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	public function beforeSave($options = array()) {
		$userinfo = $this->getUserInfo();
		$this->data[$this->alias]['rec_company_id'] = $userinfo["rec_company_id"];
    	return true;
	}
	
	/**
	 * 
	 * �Y���f�[�^�����p�\���𔻒肷��
	 * 
	 * @param int
	 * @return bool
	 * 
	 **/
	public function isUses( $id )
	{   
	
	    $this->recursive = -1;
	    return (bool) $this->find( 'count', 
	                                array(  'conditions'=>$this->getDefaultConditionsId( $id )
                                    )
                                );
	}
    
    /**
     * 
     * �悭���p���錟���������擾����
     * 
     * @param  int
     * @return string
     * 
     **/
    public function getDefaultConditionsId( $id )
    {
        return array( 'RecruitmentArea.status'=>0,
	                  'RecruitmentArea.id'=>$id,
	                  'RecruitmentArea.rec_company_id'=>$this->getUserInfo("rec_company_id")
        );
        
    }
    
    /**
     * 
     * �悭���p���錟���������擾����
     * 
     * @return string
     * 
     **/
    public function getDefaultConditions()
    {
        return array( 'RecruitmentArea.status'=>0,
	                  'RecruitmentArea.rec_company_id'=>$this->getUserInfo("rec_company_id")
        );
        
    }

    /**
     * get name Areas
     */

    public function getName($id=0)
    {
        if($id!=0)
        {
            $this->recursive=-1;
            $result=$this->find("first",array("RecruitmentArea.id"=>$id));
            return $result['RecruitmentArea']['area'];
        }
        return '';
    }
}
