<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * RecRecruiter Model
 *
 * @property FacManager $FacManager
 * @property CanCandidate $CanCandidate
 * @property CanCustomAttribute $CanCustomAttribute
 * @property CanCustomField $CanCustomField
 * @property CanNotice $CanNotice
 * @property EvHistory $EvHistory
 * @property EvPersonnel $EvPersonnel
 * @property InfJobVotePublic $InfJobVotePublic
 * @property InfStaff $InfStaff
 * @property JobOfferStaff $JobOfferStaff
 * @property JobSelectTarget $JobSelectTarget
 * @property JobVote $JobVote
 * @property MailTemplate $MailTemplate
 * @property MlSendHistory $MlSendHistory
 * @property RefererCompany $RefererCompany
 * @property School $School
 * @property ScreeningStage $ScreeningStage
 * @property SelHistory $SelHistory
 * @property SystemMailTemplate $SystemMailTemplate
 * @property Undergraduate $Undergraduate
 */
class RecRecruiter extends AppModel {

        public $virtualFields = array(
                'name' => 'CONCAT(RecRecruiter.last_name, " ", RecRecruiter.first_name)'
        );

        public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'last_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'first_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'focal_point_type' => array(
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
		'mail' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'email' => array(
				'rule' => array('email'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'this mail address is already in use.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'rec_department_id' => array(
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
		'approval_flag' => array(
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
		'fac_manager_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'last_login_date' => array(
			'datetime' => array(
				'rule' => array('datetime'),
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
		'FacManager' => array(
			'className' => 'FacManager',
			'foreignKey' => 'fac_manager_id',
			'conditions' => 'FacManager.status = 0',
			'fields' => '',
			'order' => ''
		),
		'RecDepartment' => array(
			'className' => 'RecDepartment',
			'foreignKey' => 'rec_department_id',
			'conditions' => 'RecDepartment.status=0',
			'fields' => '',
			'order' => '',
			'type'=>'inner'
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
			'foreignKey' => 'rec_recruiter_id',
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
		'CanCustomAttribute' => array(
			'className' => 'CanCustomAttribute',
			'foreignKey' => 'rec_recruiter_id',
			'dependent' => false,
			'conditions' => 'CanCustomAttribute.status = 0',
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
			'foreignKey' => 'rec_recruiter_id',
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
		'CanNotice' => array(
			'className' => 'CanNotice',
			'foreignKey' => 'rec_recruiter_id',
			'dependent' => false,
			'conditions' => 'CanNotice.status = 0',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'EvHistory' => array(
			'className' => 'EvHistory',
			'foreignKey' => 'rec_recruiter_id',
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
		'EvPersonnel' => array(
			'className' => 'EvPersonnel',
			'foreignKey' => 'rec_recruiter_id',
			'dependent' => false,
			'conditions' => 'EvPersonnel.status = 0',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'InfJobVotePublic' => array(
			'className' => 'InfJobVotePublic',
			'foreignKey' => 'rec_recruiter_id',
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
		'InfStaff' => array(
			'className' => 'InfStaff',
			'foreignKey' => 'rec_recruiter_id',
			'dependent' => false,
			'conditions' => 'InfStaff.status = 0',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'JobOfferStaff' => array(
			'className' => 'JobOfferStaff',
			'foreignKey' => 'rec_recruiter_id',
			'dependent' => false,
			'conditions' => 'JobOfferStaff.status = 0',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'JobSelectTarget' => array(
			'className' => 'JobSelectTarget',
			'foreignKey' => 'rec_recruiter_id',
			'dependent' => false,
			'conditions' => 'JobSelectTarget.status = 0',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'JobVote' => array(
			'className' => 'JobVote',
			'foreignKey' => 'rec_recruiter_id',
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
			'foreignKey' => 'rec_recruiter_id',
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
		'MlSendHistory' => array(
			'className' => 'MlSendHistory',
			'foreignKey' => 'rec_recruiter_id',
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
		'RefererCompany' => array(
			'className' => 'RefererCompany',
			'foreignKey' => 'rec_recruiter_id',
			'dependent' => false,
			'conditions' => 'RefererCompany.status != 9',
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
			'foreignKey' => 'rec_recruiter_id',
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
			'foreignKey' => 'rec_recruiter_id',
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
		'SelHistory' => array(
			'className' => 'SelHistory',
			'foreignKey' => 'rec_recruiter_id',
			'dependent' => false,
			'conditions' => 'SelHistory.status = 0',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'SelRecruiterHistory' => array(
			'className' => 'SelRecruiterHistory',
			'foreignKey' => 'rec_recruiter_id',
			'dependent' => false,
			'conditions' => 'SelRecruiterHistory.status = 0',
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
			'foreignKey' => 'rec_recruiter_id',
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
			'foreignKey' => 'rec_recruiter_id',
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
     * @param array
     * @return array
     *
     **/
    public function beforeFind( $queryData )
    {

        //ステータスが有効なもののみを取得するように変更
        $queryData['conditions']['RecRecruiter.status'] = 0;

        return $queryData;

    }

    /**
     * before save
     *
     * @param array
     * @return void
     *
     **/
    public function beforeSave( $options = array() )
    {
        if ( isset( $this->data[$this->alias]['password'] ))
        {
        	$passwordHasher = new BlowfishPasswordHasher();
            //パスワードの暗号化
            $this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
        }

        return;

    }

    /**
     * check status and rec_company_id in session
     * @param null $id
     * @return bool|void
     */
    public  function canDelete($id = null)
    {
        return (bool) $this->find('all',array(
                'conditions' => array('RecCompany.id' => $this->getUserInfo('rec_company_id'), 'RecRecruiter.id' => $id),
                'joins' => array(
                    array(
                        'type' => 'LEFT',
                        'table' => 'rec_companies',
                        'alias' => 'RecCompany',
                        'conditions' => array('RecCompany.id = RecDepartment.rec_company_id', 'RecCompany.status = 0')
                    ),
                )
            )
        );
    }

    /**
     * check RecRecruiter by rec_company_id
     * @param null $id
     * @return bool
     */
    public function checkRecCompanyId($id = NULL)
    {
        $conditions = array(
                        'RecRecruiter.id' => $id ,
                        'RecDepartment.rec_company_id' => $this->getUserInfo('rec_company_id'),
                        'RecDepartment.status' => 0,
                        'RecCompany.status' => 0,
                        'RecRecruiter.status'=>0);

        $joins = array(
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

    public function getRecRecruiterInfo($id = null) {
        return $this->find('first',array(
        		'fields' => array('name'),
                'conditions' => array(
                    'RecRecruiter.id' => $id ,
                    'RecRecruiter.status' => 0),
            )
        );
    }
    
    /**
    * 参照可能かのチェック（id指定）
    * @param int id
    *
    **/ 
    public function isUses ($id){

    	// 運営管理者は可
    	if ($this->getUserInfo('role_type') == ROLE_TYPE_MANAGER){
    		return true;
    	}

		return (bool) $this->find('count', array(
					'conditions'=> array( 
						'RecDepartment.rec_company_id'=> $this->getUserInfo('rec_company_id'),
						'RecRecruiter.id'        => $id,
						'RecRecruiter.status'   => 0
					)
				)
			);

    }
    /**
     * 
     * 名称の取得
     * 
     * @param id
     * @return string
     * 
     * 
     **/
    public function getName( $id )
    {   
        $this->recursive = -1;
        $data = $this->findById( $id );
        
        return $data['RecRecruiter']['name'];
        
    }
    
    /**
     * 
     * イベント詳細の採用担当者プルダウンの作成
     * 
     * @params array 除外する採用担当者ID
     * @return array
     * 
     * 
     **/
    public function getEvhistoryPullDown( $persons = array() )
    {   
    
        $data = array();

        $whereIn = implode( "," , $persons );

        $this->contain('RecDepartment');
        $wRecRecruiter = $this->find('all', array( 'conditions' => array( 
                                                    'RecDepartment.rec_company_id'=> $this->getUserInfo('rec_company_id'),
                                                    'RecRecruiter.id  NOT IN ("'.$whereIn.'")',
                                                    'RecRecruiter.status'=>0
                                                    ) 
                            ));
        $data = array();
        foreach( $wRecRecruiter as $row )
        {
            $id = $row['RecRecruiter']['id'];
            $name = $row['RecRecruiter']['name'];
            
            $data[$id] = $name;
        }
        
        return $data;
        
    }
    
    /**
     *
     *
     *
     *
     **/

    /**
     * before save
     *
     * @param array
     * @return void
     *
     **/
    public function getPasswordHash( $password )
    {
        $passwordHasher = new BlowfishPasswordHasher();

        //パスワードの暗号化
        return $passwordHasher->hash( $password );
    }
    
    
}
