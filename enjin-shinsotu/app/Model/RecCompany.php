<?php
App::uses('AppModel', 'Model');
/**
 * RecCompany Model
 *
 * @property Prefecture $Prefecture
 * @property City $City
 * @property FacManager $FacManager
 * @property CanCandidate $CanCandidate
 * @property CanCustomField $CanCustomField
 * @property EvEvent $EvEvent
 * @property MailTemplate $MailTemplate
 * @property RecDepartment $RecDepartment
 * @property RecruitmentArea $RecruitmentArea
 * @property RefererCompany $RefererCompany
 * @property School $School
 * @property ScreeningStage $ScreeningStage
 * @property SystemMailTemplate $SystemMailTemplate
 * @property Undergraduate $Undergraduate
 */
class RecCompany extends AppModel {

	public $displayField = 'company_name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'company_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'prefecture_id' => array(
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
		'city_id' => array(
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
		'deadline' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'establish_date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'represent_mail' => array(
			'email' => array(
				'rule' => array('email'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'employee' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'figure' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'business_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'average_salary' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'average_age' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'market_id' => array(
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
		'fac_manager_id' => array(
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
		'Prefecture' => array(
			'className' => 'Prefecture',
			'foreignKey' => 'prefecture_id',
			'conditions' => 'Prefecture.status = 0',
			'fields' => '',
			'order' => ''
		),
		'City' => array(
			'className' => 'City',
			'foreignKey' => 'city_id',
			'conditions' => 'City.status = 0',
			'fields' => '',
			'order' => ''
		),
		'FacManager' => array(
			'className' => 'FacManager',
			'foreignKey' => 'fac_manager_id',
			'conditions' => 'FacManager.status = 0',
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
		'CanCandidate' => array(
			'className' => 'CanCandidate',
			'foreignKey' => 'rec_company_id',
			'dependent' => false,
			'conditions' => 'CanCandidate.status = 0',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'CanCustomField' => array(
			'className' => 'CanCustomField',
			'foreignKey' => 'rec_company_id',
			'dependent' => false,
			'conditions' => 'CanCustomField.status = 0',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'EvEvent' => array(
			'className' => 'EvEvent',
			'foreignKey' => 'rec_company_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'MailTemplate' => array(
			'className' => 'MailTemplate',
			'foreignKey' => 'rec_company_id',
			'dependent' => false,
			'conditions' => 'MailTemplate.status = 0',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'RecDepartment' => array(
			'className' => 'RecDepartment',
			'foreignKey' => 'rec_company_id',
			'dependent' => false,
			'conditions' => 'RecDepartment.status = 0',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'RecruitmentArea' => array(
			'className' => 'RecruitmentArea',
			'foreignKey' => 'rec_company_id',
			'dependent' => false,
			'conditions' => 'RecruitmentArea.status = 0',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'RefererCompany' => array(
			'className' => 'RefererCompany',
			'foreignKey' => 'rec_company_id',
			'dependent' => false,
			'conditions' => 'RefererCompany.status = 0',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'School' => array(
			'className' => 'School',
			'foreignKey' => 'rec_company_id',
			'dependent' => false,
			'conditions' => 'School.status = 0',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ScreeningStage' => array(
			'className' => 'ScreeningStage',
			'foreignKey' => 'rec_company_id',
			'dependent' => false,
			'conditions' => 'ScreeningStage.status = 0',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'SystemMailTemplate' => array(
			'className' => 'SystemMailTemplate',
			'foreignKey' => 'rec_company_id',
			'dependent' => false,
			'conditions' => 'SystemMailTemplate.status = 0',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Undergraduate' => array(
			'className' => 'Undergraduate',
			'foreignKey' => 'rec_company_id',
			'dependent' => false,
			'conditions' => 'Undergraduate.status = 0',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

    /**
     *
     * before beforeFind
     *
     *
     **/
    public function beforeFind( $queryData )
    {

        //ステータスが有効なもののみを取得するように変更
        $queryData['conditions']['RecCompany.status'] = 0;

        return $queryData;

    }



    /**
     *
     * 初回保存時に作成される各マスターの初期値を設定する。
     *
     * @param  array
     * @return array
     *
     **/
    public function setInitData( $inputData )
    {

        $hashText = $inputData['RecCompany']['represent_mail'].microtime();

        $inputData['RecCompany']['fac_manager_id'] = 0;
        $inputData['RecCompany']['api_key'] = Security::hash( $hashText, 'md5', true);

        return $inputData;

    }


    /**
    * 参照可能かのチェック（id指定）
    * @param int id
    *
    **/ 
    public function isUses($id) {

    	if ($this->getUserInfo('role_type') == ROLE_TYPE_MANAGER){
    		return true;
    	}
    	return ($id == $this->getUserInfo('rec_company_id'));

    }



    /**
     *
     *
     *
     *
     *
     *
     **/
    public function getSelfCompanyData( $id )
    {

        $this->recursive = 2;
       $this->contain(array( 'Prefecture','City'));

        $data = $this->find('first' , $id );

        if ( empty( $data ) ) return array();

        $result['RecCompany'] = $data['RecCompany'];
        $result['RecCompany']['Prefecture_name'] = $data['Prefecture']['name'];
        $result['RecCompany']['City_name'] = $data['City']['name'];

        return $result;

    }
}
