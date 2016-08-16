<?php
App::uses('AppModel', 'Model');
/**
 * SelRecruiterHistory Model
 *
 * @property SelStatus $SelStatus
 * @property SelHistory $SelHistory
 */
class SelRecruiterHistory extends AppModel {

	protected $_roles = array(ROLE_TYPE_RECRUITER);
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'sel_history_id' => array(
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
		'assign_situation_id' => array(
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
		'evaluation_rank' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'evaluation_score' => array(
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
		'RecRecruiter' => array(
			'className' => 'RecRecruiter',
			'foreignKey' => 'rec_recruiter_id',
			'conditions' => 'RecRecruiter.status = 0',
			'fields' => '',
			'order' => ''
		),
		'SelHistory' => array(
			'className' => 'SelHistory',
			'foreignKey' => 'sel_history_id',
			'conditions' => 'SelHistory.status = 0',
			'fields' => '',
			'order' => ''
		),
	);


	/**
	* 保存データの整形
	* @param mixed 
	* @param array
	**/
	public function trimSimpleSaveData($tmp){
		return $data['SelRecruiterHistory'] = array(
			'sel_history_id' 		=> (int)$tmp['sel_history_id'],
			'rec_recruiter_id' 		=> (int)$tmp['rec_recruiter_id'],
			'assign situation_id' 	=> 0,
			'status' 				=> 0
		); 
	}

	/**
	* 更新データの整形
	* @param mixed 
	* @param array
	**/
	public function trimSimpleUpdateData($tmp){
		return $data['SelRecruiterHistory'] = array(
			'id' 						=> (int)$tmp['id'],
			'evaluation_rank' 			=> (int)$tmp['evaluation_rank'],
			'evaluation_score' 			=> (int)$tmp['evaluation_score'],
			'evaluation_comment' 		=> $tmp['evaluation_comment']
		); 
	}
    
    /**
     * 
     * 採用担当者テーブルから名称を取得する。
     * 
     * @param array
     * 
     * 
     **/
    public function getRecruterNameArray( & $recruterdata )
    {
        if ( isset( $recruterdata[0] ) )
        {
            foreach( $recruterdata as & $row ) {
                $row['name'] = $this->getRecruterName($row['rec_recruiter_id']);
            }
        }elseif(isset($recruterdata['rec_recruiter_id'] )){
            $recruterdata['name'] = $this->getRecruterName($recruterdata['rec_recruiter_id']);
        }else{
            return;
        }
        
        return;
    }
    
    
    
    /**
     * 
     * 採用担当者名を取得する
     * 
     * 
     * 
     * 
     * 
     **/
    private function getRecruterName( $id )
    {   
        $this->RecRecruiter->recursive = -1;
        $data = $this->RecRecruiter->findById( $id );
        
        if ( !empty( $data['RecRecruiter']['name'] ) )return $data['RecRecruiter']['name'];
    
        return null;
    }
    
    /**
     * 
     * 該当IDの選考履歴の面接官IDを取得する
     * 
     * @param int
     * @return array
     * 
     **/
    public function getRecruterId( $id )
    {
        $data = $this->find( 'all', array('conditions'=>array( 'sel_history_id'=>$id )));
        
        $result =  array();
        foreach( $data as $row )
        {
            $result[] = $row['RecRecruiter']['id'];
        }
        
        return $result;
    }
    
    /**
     * check SelRecruiterHistory's status and RecRecruiter's status and RecDepartment's status
     * check RecCompany's status and rec_company_id in session
     * @param null $id
     * @return bool|void
     */
    public  function canDelete($id = null)
    {
        $conditions = array(
            'SelRecruiterHistory.id' => $id ,
            'SelRecruiterHistory.status' => 0,
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

	protected function getCanUpdateConditions(){
		$conditions = array(
			'RecRecruiter.status' => 0,
			'RecDepartment.status' => 0,
			'SelRecruiterHistory.status' => 0,
			'RecDepartment.rec_company_id' => $this->getUserInfo('rec_company_id'),
			'RecCompany.status' => 0
		);
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

		return array(
			'conditions'=>$conditions,
			'joins' => $joins
		);
	}
}
