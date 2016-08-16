<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

/**
 * InfStaff Model
 *
 * @property RecRecruiter $RecRecruiter
 * @property CanCandidate $CanCandidate
 * @property CanNotice $CanNotice
 * @property MlSendHistory $MlSendHistory
 * @property SelHistory $SelHistory
 */
class InfStaff extends AppModel {
	// ユニークID作成時の最小文字長
	const LENGTH_MIN_UNIQUE_ID = 8;

    public $virtualFields = array(
            'name' => 'CONCAT(InfStaff.last_name, " ", InfStaff.first_name)'
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
		'mail_address' => array(
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
		),
		'unique_id' => array(
                        'isUnique' => array(
                                'rule' => 'isUnique',
                                //'message' => 'Your custom message here',
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
        'tel' => array(
			//'phone' => array(
				//'rule' => array( 'custom', '/^(0\d{1,4}[\s-]?\d{1,4}[\s-]?\d{4})$/'),
				//'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			//),
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
		'RecRecruiter' => array(
			'className' => 'RecRecruiter',
			'foreignKey' => 'rec_recruiter_id',
			'conditions' => 'RecRecruiter.status = 0',
			'fields' => '',
			'order' => ''
		),
		'RefererCompany' => array(
			'className' => 'RefererCompany',
			'foreignKey' => 'referer_company_id',
			'conditions' => 'RefererCompany.status = 0',
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
			'foreignKey' => 'inf_staff_id',
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
		'CanNotice' => array(
			'className' => 'CanNotice',
			'foreignKey' => 'inf_staff_id',
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
		'MlSendHistory' => array(
			'className' => 'MlSendHistory',
			'foreignKey' => 'inf_staff_id',
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
		'SelHistory' => array(
			'className' => 'SelHistory',
			'foreignKey' => 'inf_staff_id',
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
	);

    public function beforeSave( $options = array() )
    {
        if ( isset( $this->data[$this->alias]['password'] ))
        {
        	$passwordHasher = new BlowfishPasswordHasher();
            //パスワードの暗号化
            $this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']); 
        }
        //ステータス未入力時は有効に自動設定
        if(empty($this->data[$this->alias]['status'])){
            $this->data[$this->alias]['status'] = 0;
        }
        // unique idの作成（Insert且つ、送られてこない場合のみ作成）
        if ( empty($this->data[$this->alias]['id']) && empty( $this->data[$this->alias]['unique_id'] ) ) {
        	// UniqueIDの作成
        	while (true) {
        		$result = array();
	        	$uniqueId = $this->createRandomId();
	        	// '.'と'/'の削除 ８文字に満たなければもう一回取得
	        	$uniqueId = str_replace('/', '',$uniqueId);
	        	$uniqueId = str_replace('.', '',$uniqueId);
	        	if (strlen($uniqueId) < self::LENGTH_MIN_UNIQUE_ID){
	        		continue;
	        	}
        		$result = $this->find('first', array(
        				'recursive' => -1,
        				'conditions' => array('unique_id' => $uniqueId )
        			)
    			);
    			// 作成したIDがユニークであればbreak
    			if ( empty($result) ) {
	    			break;
    			}
        	}
                $this->data[$this->alias]['unique_id'] = $uniqueId;
        }
        
        //ログインしているユーザが採用担当者の場合のみ採用担当者Idを最終更新採用担当者IDに設定
        $userInfo = $this->getUserInfo();

        switch($userInfo['role_type']){
            case ROLE_TYPE_RECRUITER:
                $this->data[$this->alias]['rec_recruiter_id'] = $userInfo['id'];
                echo $this->data[$this->alias]['rec_recruiter_id'];
                break;
        }
        return;

    }
    
    /**
     *  データの変更をしようとした際に、変更しようしているデータが自社のデータか確認
     *　一件のみ使用可
     * @param int $id
     * @return booleam
     */
    public function isUses($id = NULL){
        switch($this->getUserInfo('role_type')){
            
            case ROLE_TYPE_REFERER:
                $reslut = $this->checkRefererCompanyId($id);
                return $reslut;
            case ROLE_TYPE_RECRUITER:
                $reslut = $this->checkRecruiterCompanyId($id);
                return $reslut;
            
            default:
                return false; 
        }
    }

    /**
     *  流入元担当者がデータの変更をしようとした際に、変更しようしているデータが自社のデータか確認
     *　
     * @param int $id
     * @return booleam
     */
    private function checkRefererCompanyId($id = null){
        $checkRefererCompanyId = $this->getUserInfo('referer_company_id');
        
        return (boolean) $this->find('first',array(
            'fields' => array('referer_company_id'),
            'conditions' => array(
                'InfStaff.id' => $id ,
                'referer_company_id' => $checkRefererCompanyId),
            )
        );
        
    }
    /**
     * 採用担当者がデータの変更をしようとした際に、変更しようしているデータが自社のデータか確認
     * 
     * @param int $id
     * @return booleam
     */
    private function checkRecruiterCompanyId($id = null){
        $checkRecruiterCompanyId = $this->getUserInfo('rec_company_id');
        
        
        return (boolean) $this->find('first',array(
            'fields' => array('referer_company_id'),
            'conditions' => array(
                'InfStaff.id' => $id ,
                'rec_company_id' => $checkRecruiterCompanyId),
            )
        );

    }
}
