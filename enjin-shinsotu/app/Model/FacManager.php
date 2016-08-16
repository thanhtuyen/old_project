<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * FacManager Model
 *
 * @property FacManager $FacManager
 * @property FacManager $FacManager
 * @property RecCompany $RecCompany
 * @property RecDepartment $RecDepartment
 * @property RecRecruiter $RecRecruiter
 */
class FacManager extends AppModel {

    public $virtualFields = array(
        'name' => 'CONCAT(FacManager.first_name, " ", FacManager.last_name)'
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
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'RecCompany' => array(
			'className' => 'RecCompany',
			'foreignKey' => 'fac_manager_id',
			'dependent' => false,
			'conditions' => 'RecCompany.status = 0',
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
			'foreignKey' => 'fac_manager_id',
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
		'RecRecruiter' => array(
			'className' => 'RecRecruiter',
			'foreignKey' => 'fac_manager_id',
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

    public function beforeSave( $options = array() )
    {
        if ( isset( $this->data[$this->alias]['password'] ))
        {
        	$passwordHasher = new BlowfishPasswordHasher();
            //パスワードの暗号化
            $this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']); 
        }
        
        //一時対応（自動的に該当IDが入るように修正が必要
        if ( !isset( $this->data[$this->alias]['fac_manager_id'] )) {
            $this->data[$this->alias]['fac_manager_id'] = 0;
        }
        
        return;

    }

}
