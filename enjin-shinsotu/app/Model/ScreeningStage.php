<?php
App::uses('AppModel', 'Model');
/**
 * ScreeningStage Model
 * 選考段階マスタ
 *
 * @property RecCompany $RecCompany
 * @property RecRecruiter $RecRecruiter
 * @property EvEvent $EvEvent
 * @property JobSelectTarget $JobSelectTarget
 * @property MailTemplate $MailTemplate
 * @property SelHistory $SelHistory
 * @property SystemMailTemplate $SystemMailTemplate
 */
class ScreeningStage extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'order' => array(
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
		'last_select_flag' => array(
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
		'rec_recruiter_id' => array(
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
		'RecRecruiter' => array(
			'className' => 'RecRecruiter',
			'foreignKey' => 'rec_recruiter_id',
			'conditions' => 'RecRecruiter.status = 0',
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
		'EvEvent' => array(
			'className' => 'EvEvent',
			'foreignKey' => 'screening_stage_id',
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
		'JobSelectTarget' => array(
			'className' => 'JobSelectTarget',
			'foreignKey' => 'screening_stage_id',
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
		'MailTemplate' => array(
			'className' => 'MailTemplate',
			'foreignKey' => 'screening_stage_id',
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
		'SelHistory' => array(
			'className' => 'SelHistory',
			'foreignKey' => 'screening_stage_id',
			'dependent' => false,
			'conditions' => 'SelHistory.status  = 0',
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
			'foreignKey' => 'screening_stage_id',
			'dependent' => false,
			'conditions' => 'SystemMailTemplate.status = 0',
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
     * 選考段階マスタ・初期データ投入
     * 
     * @param  void
     * @return array
     * 
     **/
    public function getInitData()
    {
        return array( 
            0=>array(
                'name' => "エントリー受付/書類選考中",
                'order' => 0,
                'last_select_flag' => 0,
                'select_overview' => "エントリー受付/書類選考中",
                'status' => 0,
            ),
            1=>array(
                'name' => "１次選考",
                'order' => 1,
                'last_select_flag' => 0,
                'select_overview' => "1次選考",
                'status' => 0,
            ),
            2=>array(
                'name' => "２次選考",
                'order' => 2,
                'last_select_flag' => 0,
                'select_overview' => "2次選考",
                'status' => 0,
            ),
            3=>array(
                'name' => "３次選考",
                'order' => 3,
                'last_select_flag' => 0,
                'select_overview' => "3次選考",
                'status' => 0,
            ),
            4=>array(
                'name' => "４次選考",
                'order' => 4,
                'last_select_flag' => 0,
                'select_overview' => "4次選考",
                'status' => 0,
            ),        
            5=>array(
                'name' => "５次選考",
                'order' => 5,
                'last_select_flag' => 0,
                'select_overview' => "5次選考",
                'status' => 0,
            ),
            6=>array(
                'name' => "６次選考",
                'order' => 6,
                'last_select_flag' => 0,
                'select_overview' => "6次選考",
                'status' => 0,
            ),
            7=>array(
                'name' => "７次選考",
                'order' => 7,
                'last_select_flag' => 0,
                'select_overview' => "7次選考",
                'status' => 0,
            ),
            8=>array(
                'name' => "８次選考",
                'order' => 8,
                'last_select_flag' => 0,
                'select_overview' => "8次選考",
                'status' => 0,
            ),
            9=>array(
                'name' => "９次選考",
                'order' => 9,
                'last_select_flag' => 0,
                'select_overview' => "9次選考",
                'status' => 0,
            ),        
            10=>array(
                'name' => "最終選考",
                'order' => 10,
                'last_select_flag' => 1,
                'select_overview' => "最終選考",
                'status' => 0,
            ), 
        );
        
    }

    /**
     * 
     * 一覧などで利用するデータの検索条件を取得する
     * （採用担当者ロール用）
     * 
     * @param bool true:最小の１件のみ取得 false:N件取得
     * @return array
     * 
     **/
    public function getListDefaultConditions( $isFirst =false)
    {   

        $result= array( 'conditions'=>array(
                            'ScreeningStage.rec_company_id' => $this->getUserInfo('rec_company_id'),
                            'ScreeningStage.status'=>0
                        ),
                      'order'=>array('order'=>'asc'),
                );

        if ( $isFirst ) {
            $result['limit']= "1";
        }
        
        return $result;
    }
     /**
     * 
     * isLastFirst
     * 選考段階マスタの順序が一番最後の状態なのかを取得する
     * 
     * @param array
     * @param int
     * 
     * @return bool
     * 
     **/
    public function isStageLast( $stage_data , $stage_id )
    {
    	$stage_id = (int)$stage_id;
        //一番小さいキー（並び順が順序になっている。)を取得
        $last = max( array_keys( $stage_data ) );
        
        return ( $last === $stage_id );
    }

    /**
    * ユーザー企業を指定して登録してある選考段階を取得
    * 
    * @return array $result 
    **/
    public function getScreeningStage( )
    {
    	$conditions = $this->getListDefaultConditions();
    		
        $conditions['fields'] = array('id','name','order');
        $conditions['recursive'] = -1;

        return $conditions;

    }

    /**
     * get min screening_stage_id by min order
     * @return mixed
     * "MIN('ScreeningStage.`order`')"
     */
    public function getScreeningStageIdByOrder()
    {
         return $this->find('first', array(
                'fields' => array("MIN('ScreeningStage.`order`')", 'ScreeningStage.id'),
                'conditions' => array('ScreeningStage.rec_company_id' => $this->getUserInfo('rec_company_id'),
                                      'ScreeningStage.status' => 0,'RecCompany.status' => 0
                )
              )
         );

    }
    
    
    /**
     * 
     * 選考段階リストの取得
     * 
     * 
     * 
     * 
     * 
     **/
    public function getSelectList( $isSpace = false)
    {
        
        $data =  $this->find('list', $this->getListDefaultConditions());
        
        if ( ! $isSpace ) return $data;
        
        $space = array( ""=>"" );
        $result = $space + $data;
        
        return $result;
    }
    
    /**
     * 
     * 選考段階が一番小さな値かを確認する処理
     * 
     * @param int
     * @return bool
     * 
     **/
    public function isFirst( $id )
    {   
        $data =  $this->find('list', $this->getListDefaultConditions());
        
        $count = 0;
        foreach( $data as $key=> $val ){
            if ( $key == $id  && $count == 0 ) return true;
            $count++;
        }
        return false;
    }

    /**
     * 
     * 選考段階が一番大きな値かを確認する処理
     * 
     * @param int
     * @return bool
     * 
     **/
    public function isLast( $id )
    {   
        $data =  $this->find('list', $this->getListDefaultConditions());
        
        $count = count( $data ) - 1;
        foreach( $data as $key=> $val ){
            if ( $key == $id  && $count == 0 ) return true;
            
            $count--;
        }
        return false;
    }
    
    /**
     * 
     * 次の選考段階IDを取得する
     * 
     * @param int
     * @return int
     * 
     **/
    public function getNextStageId( $id )
    {   
        $this->recursive = -1;
    
        $options = $this->getListDefaultConditions();
        $options['conditions']['ScreeningStage.id > '] = $id;
        
    
        $data = $this->find('first',$options );
        return $data['ScreeningStage']['id'];
        
        
    }
    

}
