<?php
App::uses('AppModel', 'Model');
/**
 * InfContract Model
 *
 * @property RefererCompany $RefererCompany
 * @property CanCandidate $CanCandidate
 * @property InfJobVotePublic $InfJobVotePublic
 */
class InfContract extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
		'title' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'start_contract_date' => array(
			'datetime' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'end_contract_date' => array(
			'datetime' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'contract_type' => array(
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
		'income_ratio' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'fixed_unit_price' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'unlimited_fixed_annual' => array(
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
			'foreignKey' => 'inf_contract_id',
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
		'InfJobVotePublic' => array(
			'className' => 'InfJobVotePublic',
			'foreignKey' => 'inf_contract_id',
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
    
    /**
     * 
     * 
     * 
     * 
     * 
     * 
     **/
    public function beforeValidate( $options = Array() )
    {   
        
        $data = & $this->data[$this->name];
        
        switch ( $data['contract_type'] )
        {
            case 1:     //固定
                    unset( $this->validate['income_ratio'] );
                    unset( $this->validate['unlimited_fixed_annual'] );
                    $data['income_ratio'] = $data['unlimited_fixed_annual'] = null;
                    break;
            case 2:     //無制限固定
                    unset( $this->validate['fixed_unit_price'] );
                    unset( $this->validate['income_ratio'] );
                    $data['income_ratio'] = $data['fixed_unit_price'] = null;
                    break;
            
            case 3:     //年収割合
                    unset( $this->validate['fixed_unit_price'] );
                    unset( $this->validate['unlimited_fixed_annual'] );
                    $data['fixed_unit_price'] = $data['unlimited_fixed_annual'] = null;
                    break;
            
        }
    }
    
    
    /**
     * 
     * ログインしている採用担当者が該当するデータを利用できるかを判定
     * 
     * @param int
     * @return bool
     * 
     ***/
    public function isUseRecruiter( $id )
    {
        
        $this->belongsTo['RefererCompany']['type'] = "INNER";
        return (bool) $this->find( 'all', array( 'conditions'=>array( 
                                            'InfContract.id'=> $id,
                                            'RefererCompany.rec_company_id' => $this->getUserInfo('rec_company_id'),
                                            )
                                    ));
        
    }
    
    /**
     *
     *
     *
     *
     *
     *
     *
     **/
    public function getRefererCompanyId()
    {   
        $this->recursive = -1;
    
        $data = $this->find( 'all', array( 'group'=>'referer_company_id','fields'=>'referer_company_id') );

        $result = array();
        
        foreach( $data as $row ){
            $result[] = $row['InfContract']['referer_company_id'];
        }
        
        return $result;
        
    }
}
