<?php
App::uses('AppModel', 'Model');
/**
 * EvEvent Model
 *
 * @property RecCompany $RecCompany
 * @property JobVote $JobVote
 * @property ScreeningStage $ScreeningStage
 * @property EvPersonnel $EvPersonnel
 * @property EvSchedule $EvSchedule
 * @property MailTemplate $MailTemplate
 * @property SystemMailTemplate $SystemMailTemplate
 */
class EvEvent extends AppModel {

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
		'job_vote_id' => array(
		),
		'type' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'screening_stage_id' => array(
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
		'screening_stage_type' => array(
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
		'target_select_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			//'notEmpty' => array(
			//	'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			//),
		),
		'rikunavi_id' => array(
		),
		'mynavi_id' => array(
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
		'JobVote' => array(
			'className' => 'JobVote',
			'foreignKey' => 'job_vote_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ScreeningStage' => array(
			'className' => 'ScreeningStage',
			'foreignKey' => 'screening_stage_id',
			'conditions' => 'ScreeningStage.status = 0',
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
		'EvPersonnel' => array(
			'className' => 'EvPersonnel',
			'foreignKey' => 'ev_event_id',
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
		'EvSchedule' => array(
			'className' => 'EvSchedule',
			'foreignKey' => 'ev_event_id',
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
			'foreignKey' => 'ev_event_id',
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
		'SystemMailTemplate' => array(
			'className' => 'SystemMailTemplate',
			'foreignKey' => 'ev_event_id',
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
		'EvStat' => array(
			'className' => 'EvStat',
			'foreignKey' => 'ev_event_id',
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
 * getData method
 * 
 * ログインしている流入元担当者の流入元企業に対して公開設定されている求人票一覧に関連しているイベント
 * または求人票に関連付けされていないイベントの一覧を取得する
 *
 * @paran int $userId
 * @paran array $findParam
 */
        
        public function getData($userId,$findParam){
            //求人票に関連づいているイベントの取得
            $sql = 'SELECT EvEvent.id,EvEvent.name,JobVote.title,EvSchedule.holding_date,EvSchedule.capacity,EvSchedule.venue,ScreeningStage.name as screeningstage
                        FROM ev_events as EvEvent INNER JOIN ev_schedules as EvSchedule ON (EvEvent.id = EvSchedule.ev_event_id)
                        LEFT JOIN job_votes as JobVote ON (EvEvent.job_vote_id = JobVote.id)
                        INNER JOIN inf_job_vote_publics as InfJobVotePublic ON (JobVote.id = InfJobVotePublic.job_vote_id)
                        INNER JOIN referer_companies as RefererCompany ON (InfJobVotePublic.referer_company_id = RefererCompany.id)
                        INNER JOIN inf_staffs as InfStaff ON (RefererCompany.id = InfStaff.referer_company_id)
                        INNER JOIN screening_stages as ScreeningStage on (EvEvent.screening_stage_id = ScreeningStage.id)
                        WHERE InfStaff.id = :id AND EvEvent.status = 0 AND EvSchedule.status = 0 AND JobVote.status = 0
                        AND InfJobVotePublic.status = 0 AND RefererCompany.status = 0 AND InfStaff.status = 0
                        AND ScreeningStage.order = (SELECT MIN(ScreeningStage.order) FROM screening_stages as ScreeningStage)';
            
            $sql=$this->addSearchCondition($sql,$findParam);

            $params = array(
                'id'=> $userId
            );

            $data = $this->query($sql,$params);

            foreach ($data as $buf){
                $returnData[] = array_merge($buf['EvEvent'],$buf['JobVote'],$buf['EvSchedule'],$buf['ScreeningStage']);
            }

            //どの求人票に対しても関連づいていないイベントの取得
            $sql = "SELECT EvEvent.id,EvEvent.name,JobVote.title,EvSchedule.holding_date,EvSchedule.capacity,EvSchedule.venue,ScreeningStage.name as screeningstage
                        FROM ev_events as EvEvent INNER JOIN ev_schedules as EvSchedule ON (EvEvent.id = EvSchedule.ev_event_id)
                        LEFT JOIN job_votes as JobVote ON (EvEvent.job_vote_id = JobVote.id)
                        INNER JOIN screening_stages as ScreeningStage on (EvEvent.screening_stage_id = ScreeningStage.id)
                        WHERE EvEvent.job_vote_id IS NULL AND EvEvent.status = 0 AND EvSchedule.status = 0 
                        AND ScreeningStage.order = (SELECT MIN(ScreeningStage.order) FROM screening_stages as ScreeningStage)";

            $sql=$this->addSearchCondition($sql,$findParam);
            
            $data = $this->query($sql);

            foreach ($data as $buf){
                $returnData[] = array_merge($buf['EvEvent'],$buf['JobVote'],$buf['EvSchedule'],$buf['ScreeningStage']);
            }
            
            return $returnData;

        }

/**
 * getEvent method 
 * ログインしている採用担当者と同じユーザキー企業IDの
 * 開催決定しているイベントとイベントのスケジュールを取得
 * 
 * @paran int $recCompanyID
 * @paran array $targetDate
 * 
 * @return array
 * 
 */
        public function getEvent($recCompanyID = null,$targetDates){
            $events = $this->find('all',array(
                'fields' => array(
                    'EvEvent.id','EvEvent.name','EvSchedule.id','EvSchedule.capacity','EvSchedule.holding_date','EvSchedule.end_date',
                    'GROUP_CONCAT(EvStat.ev_history_status) as history_status','GROUP_CONCAT(EvStat.count) as counts'
                ),
                'joins' => array(
                    0 => array(
                        'type' => 'INNER',
                        'table' => 'ev_schedules',
                        'alias' => 'EvSchedule',
                        'conditions' => 'EvEvent.id = EvSchedule.ev_event_id'
                    ),
                    1 => array(
                        'type' => 'LEFT',
                        'table' => 'ev_stats',
                        'alias' => 'EvStat',
                        'conditions' => 'EvSchedule.id = EvStat.ev_schedule_id'
                    )
                ),
                'conditions' => array(
                    'EvEvent.status' => 1,
                    'EvSchedule.status' => 1,
                    'EvEvent.rec_company_id' => $recCompanyID,
                    'EvSchedule.holding_date BETWEEN ? AND ?' => array(
                        date('Y-m-d H:i:s', mktime(0,0,0,$targetDates['month'],1,$targetDates['year'])),
                        date('Y-m-t H:i:s', mktime(23,59,59,$targetDates['month'],1,$targetDates['year']))
                    )
                ),
                'group' => array('EvSchedule.id'),
            ));
            
            $eventarray = array();
            foreach ($events as $event):
                for($i = 1;$i <= (int)date('t',mktime(0, 0, 0, $targetDates['month'], $i, $targetDates['year']));$i++){
                    if(strtotime(date('Ymd',mktime(0, 0, 0, $targetDates['month'], $i, $targetDates['year']))) == strtotime(date('Ymd',strtotime($event['EvSchedule']['holding_date'])))){
                        $buf_history_status = explode(',', $event[0]['history_status']);
                        $buf_counts = explode(',', $event[0]['counts']);
                        $evStats = array();
                        $evStats['counts'] = 0;
                        foreach ($buf_history_status as $key => $data):
                            $evStats['counts'] += (int)$buf_counts[$key];
                            $evStats[$data] = $buf_counts[$key];
                        endforeach;
                        $event['EvStat'] = $evStats;
                        $eventarray[$i][] = $event;
                        break;
                    }
                }
            endforeach;
            return $eventarray;
        }
        
/** 
 * getPendingEvent method
 * イベントは開催決定しているがイベント開催日程が作成されていないイベント一覧の取得
 * 
 * @paran int $recCompanyID
 * @return array 
 */        
        public function getPendingEvent($recCompanyID = null){
            $db = $this->getDataSource();

            $conditions['fields'] = array('EvSchedule.ev_event_id');
            $conditions['table'] = $db->fullTableName($this);
            $conditions['alias'] = 'EvEvent';
            $conditions['joins'] = array( 
                0 => array(
                    'type' => 'INNER',
                    'table' => 'ev_schedules',
                    'alias' => 'EvSchedule',
                    'conditions' => 'EvEvent.id = EvSchedule.ev_event_id'
                )
            );

            $SubQuery = $db->buildStatement(
                $conditions,$this
            );

            $SubQuery = 'EvEvent.id NOT IN ('.$SubQuery.')';
            $subQueryExpression = $db->expression($SubQuery);

            unset( $conditions );

            $conditions[] = $subQueryExpression;
            $conditions['EvEvent.rec_company_id'] = $recCompanyID;
            
            return $conditions;
      }
        
        /**
         *  データの変更をしようとした際に、変更しようしているデータが自社のデータか確認
         *　一件のみ使用可
         * @param int $id
         * @return booleam
         */
        public function isUses($id = NULL){
            switch($this->getUserInfo('role_type')){

                case ROLE_TYPE_RECRUITER:
                    $reslut = $this->checkRecruiterCompanyId($id);
                    return $reslut;

                default:
                    return false; 
            }
        }
    
    public function getListDefaultConditions( $isAll = false)
    {
        if ( $isAll ){
            return array( 'conditions'=>array(
                                'EvEvent.rec_company_id' => $this->getUserInfo('rec_company_id'),
                            )
                    );
        }else{
            return array( 'conditions'=>array(
                                'EvEvent.rec_company_id' => $this->getUserInfo('rec_company_id'),
                                'EvEvent.status'=>0
                            )
                    );
        }
    
    }
    
    
    
    
        /**
         *  採用担当者がデータの変更をしようとした際に、変更しようしているデータが自社のデータか確認
         *　
         * @param int $id
         * @return booleam
         */
        private function checkRecruiterCompanyId($id = null){
            $checkRecruiterCompanyId = $this->getUserInfo('rec_company_id');
            return (boolean) $this->find('first',array(
                'fields' => array('EvEvent.rec_company_id'),
                'conditions' => array(
                    'EvEvent.id' => $id ,
                    'EvEvent.rec_company_id' => $checkRecruiterCompanyId),
                )

            );
        }
    /**
     * check Event by rec_company_id
     * @param null $id
     * @return bool
     */
    public function checkRecCompanyId($id = NULL)
    {

        return (boolean) $this->find('first',array(
                'conditions' => array(
                    'EvEvent.id' => $id ,
                    'EvEvent.rec_company_id' => $this->getUserInfo('rec_company_id'),
                    'RecCompany.status' => 0),
            )
        );
    }
    
    /**
     * 
     * 任意選択のぷるだうんを取得する
     * 
     * @return array
     * 
     * 
     * 
     **/
    public function getSelectList()
    {
        $array = array( ""=>"" );
        
        $data = $this->find ('list', $this->getListDefaultConditions() );
        
        $data = array_merge( $array , $data );
        
        return $data;
    }
    /**
    * イベント名 開催期間のリストを返却
    * @return mixed
    **/
    public function getCsvSelectList() {

    	$options = $this->createCsvEventOptions();
    	$this->virtualFields['list_title'] = 'CONCAT(EvEvent.name," ",EvSchedule.holding_date,"～",EvSchedule.end_date)';
    	return $this->find('list', $options);
    }
    
    /**
     * 
     * イベントスケジュールが設定されていないイベントを取得する
     * 
     * @param void 
     * 
     * @return array
     * 
     * 
     * 
     **/
    public function getEventNotEvSchedule()
    {
        
        //企業が所有するイベントを取得する
        $list = $this->find('list', array( 'conditions'=>array(
                                                'EvEvent.rec_company_id' => $this->getUserInfo('rec_company_id'),
                                                 ),));
                                                 
        //該当イベントがイベントスケジュールに存在するかを確認する
        $event_ids = array_keys( $list );
        
        $this->EvSchedule->recursive = -1;
        $wEvSchedule = $this->EvSchedule->find ( "all", array( 'conditions'=>array(
                                                'EvSchedule.ev_event_id' => $event_ids,
                                                'EvSchedule.status != 9',
                                                )));
        
        //企業が存在しないデータの情報を取得する
        foreach( $wEvSchedule as $row ){
            $id = $row['EvSchedule']['ev_event_id'];
            
            if ( isset( $list[$id] ) ) unset( $list[$id] );
            
        }
        
        $event_ids = array_keys( $list );
        
        if ( !empty( $event_ids ) ) {
            $this->recursive = 1;
            return $this->find( 'all', array( 'conditions'=>array(
                                                    'EvEvent.rec_company_id' => $this->getUserInfo('rec_company_id'),
                                                    'EvEvent.id' => $event_ids,
                                                     ),));
        }else{
            return array();
        }
    }

    /**
    * イベント情報取得
    * 
    * @param  int   $id
    * @param  array $data 
    * @return array $result
    **/
    public function getDetail( $id, $data )
    {
    	$conditions = array(
    			"conditions" => array( 
    				'EvEvent.id' => $id,
    				'EvEvent.rec_company_id' => $data['rec_company_id'], 
    				'EvEvent.status' => 1,
    				'OR' => array( 'JobVote.wanted_year' => $data['year'], 'EvEvent.job_vote_id IS NULL' )
    			),

    			"recusive" => 0,
    			"contain" => array( 'JobVote' ),
    			"fields" => array( 
    				'EvEvent.name',
    				'EvSchedule.holding_date',
    				'EvSchedule.end_date',
    				'EvSchedule.venue' 
    			 ) 
    		);

    	$conditions['joins'][] = array(
    			'type' => 'LEFT',
    			'table' => 'ev_schedules',
    			'alias' => 'EvSchedule',
    			'conditions' => 'EvEvent.id = EvSchedule.ev_event_id'
    		);

    	return $this->find( 'first', $conditions );

    }


    /**
    *  検索用の条件作成
    *  @return mixed
    **/
    private function createCsvEventOptions(){

    	$wantedyear = SessionComponent::read('WantedYear');
    	$companyId = $this->getUserInfo('rec_company_id');

    	$cancel = $this->getEventCancel();

        $targetStart = date('Y-m-d', mktime(0,0,0,4,1,$wantedyear));
        $targetEnd = date('Y-m-d', mktime(0,0,0,4,1,$wantedyear+1));

    	$options['recursive'] = -1;
    	$options['conditions'] = array(
    			'EvEvent.rec_company_id' => $companyId,
    			'EvSchedule.holding_date >' => $targetStart,
    			'EvSchedule.holding_date <' => $targetEnd,
    			'NOT'=> array(
    				'EvSchedule.status' => $cancel
    				),
    		);

        $options['joins'] = array( 
                0 => array(
                    'type' => 'INNER',
                    'table' => 'ev_schedules',
                    'alias' => 'EvSchedule',
                    'conditions' => 'EvEvent.id = EvSchedule.ev_event_id'
                )
            );

        $options['fields'] = array('EvEvent.id', 'list_title');

        return $options;

    }

    /**
    * イベントステータスのキャンセル状態のキーを返す
    * @return int
    */
    private function getEventCancel() {
    	$evStatus = Configure::read('ev_status');
    	return array_search('キャンセル', $evStatus);
    }

}
