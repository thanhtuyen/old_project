<?php
App::uses('AppModel', 'Model');
/**
 * RecDepartment Model
 *
 * @property RecDepartment $ParentRecDepartment
 * @property RecCompany $RecCompany
 * @property FacManager $FacManager
 * @property JobVote $JobVote
 * @property RecDepartment $ChildRecDepartment
 */
class RecDepartment extends AppModel {

	public $displayField = 'department_name';


/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'department_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'parent_id' => array(
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
		'hr_flag' => array(
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
		),
		'FacManager' => array(
			'className' => 'FacManager',
			'foreignKey' => 'fac_manager_id',
			'conditions' => 'FacManager.status = 0',
			'fields' => '',
			'order' => ''
		),
		'RecDepartmentParent' => array(
			'className' => 'RecDepartment',
			'foreignKey' => 'parent_id'
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
			'foreignKey' => 'rec_department_id',
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
		'RecRecruiter' => array(
			'className' => 'RecRecruiter',
			'foreignKey' => 'rec_department_id',
			'dependent' => false,
			'conditions' => 'RecRecruiter.status = 0',
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
        $queryData['conditions']['RecDepartment.status'] = 0;
        
        return $queryData;        
        
    }
    
    /**
     * 
     * ユーザー企業作成時の初期データ投入
     * 
     * 
     * @return array
     * 
     **/
    public function getInitData()
    {
    
        return array(0=>array(
            'department_name'=> "人事部",
            'parent_id'=>0,
            'hr_flag'=>1,
            'fac_manager_id' =>0,
            'status'=>0,
        ));
        
    }


    /**
     *  データの変更をしようとした際に、変更しようしているデータが自社のデータか確認
     *　一件のみ使用可
     * @param int $id
     * @return booleam
     */
    public function isUses($id = NULL){

        switch($this->getUserInfo('role_type')){

            case ROLE_TYPE_MANAGER:
                return $this->exists($id);
            case ROLE_TYPE_RECRUITER:
                return $this->existsRecruiter( $id );
            default:
                return false; 
        }
    }
    /*
    * ロールによってデータのチェック
    */
    public function checkByRole($data, $role_type){
    	if ($role_type == ROLE_TYPE_MANAGER) {
    		return $data;
    	}
    	$data['RecDepartment']['rec_company_id'] = $this->getUserInfo('rec_company_id');
    	$data['RecDepartment']['fac_manager_id'] = 0;

    	return $data;
    }

    public function getSelectList($role_type){

    	$recCompanies = array();
    	$parentRecDepartments = array();
    	$facManagers = array();

    	if ($role_type == ROLE_TYPE_MANAGER){
	        $recCompanies = $this->RecCompany->find('list');
	        $parentRecDepartments = $this->find('list');
	        $facManagers = $this->FacManager->find('list');
    	}else{
	        $parentRecDepartments = $this->find('list', array(
    				'conditions' => array(
    					'rec_company_id' => $this->getUserInfo('rec_company_id')
					)
	        	)
	        );
    	}

    	return array($recCompanies, $parentRecDepartments, $facManagers);
    }
    
    /**
     *
     *
     *
     *
     *
     **/
    public function getName( $id )
    {   
        $this->recursive = -1;
        $result = $this->findById( $id );
        
        if ( empty( $result['RecDepartment']['department_name'] ) ) return null;
        
        return $result['RecDepartment']['department_name'];
        
    }
    
    /* -*-*-*-*-*-*-*-*-*- 以下private -*-*-*-*-*-*-*-*-*- */
    
    
    /**
     * 
     * 採用担当者が該当データを利用できる状態にあるかを確認する。
     * 
     * @param int
     * @return bool
     * 
     **/
    private function existsRecruiter( $id )
    {
        return (bool) $this->findAllByIdAndRecCompanyId1( $id , $this->getUserInfo('rec_company_id') );
    }

    /**
     * check status and rec_company_id in session
     * @param null $id
     * @return bool|void
     */
    public  function canDelete($id = null)
    {
        return (bool) $this->findByIdAndRecCompanyId( $id ,$this->getUserInfo('rec_company_id'));
    }
}
