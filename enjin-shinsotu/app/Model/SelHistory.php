<?php
App::uses('AppModel', 'Model');
App::uses('EnjinHelper', 'View/Helper');
App::uses('RecDepartment', 'Model');
/**
 * SelHistory Model
 *
 * @property SelStatus $SelStatus
 * @property JobVote $JobVote
 * @property CanCandidate $CanCandidate
 * @property ScreeningStage $ScreeningStage
 * @property RecRecruiter $RecRecruiter
 * @property InfStaff $InfStaff
 * @property CanDocument $CanDocument
 * @property SelRecruiterHistory $SelRecruiterHistory
 */
class SelHistory extends AppModel {

	public $statusErrorCode = 9021;

    protected $_table = 'sel_histories';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'sel_status_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
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
			
			'userUnique'=>array(
			    'rule'=>array( 'selhistoryUnique'),
			    'message' => '既にこの候補者はこの求人票に申込済です。',
			    'on'=>'create'
            )
		),
		'can_candidate_id' => array(
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
		'select_status_id' => array(
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
		'select_option_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'validateSelectStatus'=> array(
			    'rule'=>array('validateSelectStatus'),
				'message' => '内定辞退の場合には、必ず選択してください。',
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
		'annual_income' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'start_date' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'end_date' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'influx_propriety' => array(
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
		'candidate_propriety' => array(
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
		'last_modified_type' => array(
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
		'inf_staff_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'JobVote' => array(
			'className' => 'JobVote',
			'foreignKey' => 'job_vote_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CanCandidate' => array(
			'className' => 'CanCandidate',
			'foreignKey' => 'can_candidate_id',
			'conditions' => 'CanCandidate.status = 0',
			'fields' => '',
			'order' => '',
			
		),
		'ScreeningStage' => array(
			'className' => 'ScreeningStage',
			'foreignKey' => 'screening_stage_id',
			'conditions' => 'ScreeningStage.status = 0',
			'fields' => '',
			'order' => ''
		),
		'RecRecruiter' => array(
			'className' => 'RecRecruiter',
			'foreignKey' => 'rec_recruiter_id',
			'conditions' => 'RecRecruiter.status = 0',
			'fields' => '',
			'order' => ''
		),
		'InfStaff' => array(
			'className' => 'InfStaff',
			'foreignKey' => 'inf_staff_id',
			'conditions' => 'InfStaff.status = 0',
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
		'CanDocument' => array(
			'className' => 'CanDocument',
			'foreignKey' => 'sel_history_id',
			'dependent' => false,
			'conditions' => 'CanDocument.status = 0',
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
			'foreignKey' => 'sel_history_id',
			'dependent' => false,
			'conditions' => 'SelRecruiterHistory.status = 0',
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
* 候補者IDから現在と過去の選考履歴取得
* 
* @param   array  $list
* @return  array  $list
* 
* 
**/
	public function getSelHistoryByCandidate( $list )
	{
		$count = count( $list );

		$sql = "
			SELECT sel_histories.job_vote_id, 
		   		   job_votes.title, 
		   		   sel_histories.can_candidate_id, 
			   	   can_candidates.last_name, 
			   	   can_candidates.first_name, 
			       screening_stages.name, 
			   	   screening_stages.order, 
			   	   sel_histories.select_status_id, 
			   	   sel_histories.start_date, 
			   	   sel_histories.end_date, 
			   	   COUNT( sel_recruiter_histories.id ) count
			FROM sel_histories 
			INNER JOIN job_votes ON sel_histories.job_vote_id = job_votes.id 
			INNER JOIN can_candidates ON sel_histories.can_candidate_id = can_candidates.id 
			INNER JOIN screening_stages ON sel_histories.screening_stage_id = screening_stages.id 
			INNER JOIN sel_recruiter_histories ON sel_histories.id = sel_recruiter_histories.sel_history_id 
			WHERE job_votes.status = 0 
			AND can_candidates.status = 0 
			AND sel_histories.can_candidate_id IN( ";
			
			for ( $i = 0; $i < $count; $i++ ) {
				$sql .= "?";
				if( $i < $count - 1 )  $sql .= ",";	
			}

		$sql .=	 ") 
			GROUP BY sel_histories.can_candidate_id, sel_histories.job_vote_id, sel_histories.screening_stage_id, sel_histories.id 
			ORDER BY  sel_histories.can_candidate_id, sel_histories.job_vote_id, screening_stages.order 
		";

		$list = $this->query( $sql, $list );

		return $list;

	}


/**
* 選考履歴と採用担当者選考履歴と候補者情報のリスト取得
* 
* @param  int   $rec_company_id 
* @return array $data
* 
**/
	public function getSelHistCandidate( $rec_company_id, $data )
	{

			$param = array( $rec_company_id, $data['year'] );

		$sql = "
				SELECT can_candidates.id, can_candidates.last_name, can_candidates.first_name, 
				       screening_stages.order, sel_histories.screening_stage_id, 
				       screening_stages.name, sel_histories.comment, 
				       sel_histories.select_status_id, sel_histories.select_option_id, 
				       job_votes.id, job_votes.title, sel_histories.start_date,
				       rec_recruiters.id, rec_recruiters.recruiter_name, sel_recruiter_histories.assign_situation_id 
				FROM sel_histories 
				INNER JOIN can_sel_job ON sel_histories.id = can_sel_job.sel_history_id 
				INNER JOIN sel_recruiter_histories ON can_sel_job.sel_history_id = sel_recruiter_histories.sel_history_id 
				INNER JOIN ( select rec_recruiters.id, concat( rec_recruiters.last_name, rec_recruiters.first_name ) recruiter_name 
							FROM rec_recruiters WHERE rec_recruiters.status = 0 ) AS rec_recruiters 
					ON sel_recruiter_histories.rec_recruiter_id = rec_recruiters.id 
				INNER JOIN can_candidates ON sel_histories.can_candidate_id = can_candidates.id 
				INNER JOIN screening_stages ON sel_histories.screening_stage_id = screening_stages.id 
				INNER JOIN job_votes ON sel_histories.job_vote_id = job_votes.id 
				INNER JOIN rec_departments ON job_votes.rec_department_id = rec_departments.id 
				WHERE rec_departments.rec_company_id = ?
				AND sel_histories.status = 0 
				AND can_candidates.status = 0 
				AND job_votes.status = 0 
				AND job_votes.wanted_year = ? 
				ORDER BY sel_histories.can_candidate_id, screening_stages.order DESC;
		";

		$result = $this->query( $sql, $param );


		return $result;

	}


    
    /**
     * selhistoryUnique
     *
     * 既に同一の候補者＆求人票＆選考段階履歴が存在するかを確認する
     * 存在する場合には、false
     * 存在しない場合には、true
     * 
     * 
     * @param unknown
     * 
     * @return bool
     */
    public function selhistoryUnique($check)
    {
        $data = (object) $this->data[$this->alias];
        
        if ( empty( $data->can_candidate_id ) || empty( $data->screening_stage_id ) )
        {
            return true;
        }
        
        $conditions = array( 'SelHistory.can_candidate_id'=>$data->can_candidate_id,
                             'SelHistory.screening_stage_id'=>$data->screening_stage_id,
                             'SelHistory.job_vote_id'=>$data->job_vote_id,
                             'JobVote.wanted_year'=>$this->wantedYear,
                             'SelHistory.status'=>0,
                        );
        return empty( $this->find( 'list', array('conditions'=>$conditions,'recursive' => 0)) );
        
    }
    
    
    /**
     * 
     * validateSelectStatus
     * 内定辞退の場合には、辞退の内容を必ず選択する
     * 
     * @param unknown
     * 
     * @return bool
     * 
     **/
    public function validateSelectStatus( $check )
    {
        $data = (object) $this->data[$this->alias];
        
        switch ($data->select_status_id)
        {
            case 7:
                
                return !(empty($data->select_option_id));
            default:
                return true;
        }
    }
    
    /**
     * getIndexSearch
     * 選考履歴検索のための検索要素作成
     * 
     * @param arary
     * @return array
     * 
     **/
    public function getIndexSearch( $data = array())
    {
        $condition['conditions'] = array();
        
        $cond = & $condition['conditions'];
        
        $cond['SelHistory2.job_vote_id'] = $data["job_vote_id"];
        $cond['JobVote2.wanted_year'] = SessionComponent::read('WantedYear');;
        $cond['SelHistory2.screening_stage_id'] = $data["screening_stage_id"];
        $cond['SelHistory2.select_status_id'] = $data["select_status_id"];
        
        if ( !empty( $data["start_date"] ) ) {
            $cond['SelHistory2.start_date >='] = $this->getDate2FormatDate( explode('/',$data["start_date"]),0 );
        }
        
        if ( !empty( $data["end_date"] ) ) {
            $cond['SelHistory2.end_date <'] = $this->getDate2FormatDate( explode('/',$data["end_date"]),1 );
        }
        
        if ( !empty( $data['can_candidate_id'] ) ) {
            $cond['SelHistory2.can_candidate_id'] = $data["can_candidate_id"];
        }
        
        if ( is_numeric( $data["referer_company_id"] )){
            $cond['CanCandidate2.referer_company_id'] = $data['referer_company_id'];
        }
        
        if ( is_numeric( $data["influx_propriety"] ) ){
            $cond['SelHistory2.influx_propriety'] = $data['influx_propriety'];
            
        }
        
        if ( is_numeric( $data["candidate_propriety"] ) ){
            $cond['SelHistory2.candidate_propriety'] = $data['candidate_propriety'];
        }
        
        $cond['CanCandidate2.rec_company_id'] = $this->getUserInfo('rec_company_id');

        $db = $this->getDataSource();
        
        $condition['fields'] = array( 'max(SelHistory2.id)' );
        $condition['table'] = $db->fullTableName($this);
        $condition['alias'] =  'SelHistory2' ;
        $condition['joins'] =  array( 0=>array( 'type'=>'INNER',
                                               'table'=>'can_candidates',
                                               'alias'=>'CanCandidate2',
                                               'conditions'=>'SelHistory2.can_candidate_id = CanCandidate2.id'
                                               ),
                                     1=>array( 'type'=>'INNER',
                                               'table'=>'job_votes',
                                               'alias'=>'JobVote2',
                                               'conditions'=>'SelHistory2.job_vote_id = JobVote2.id'
                                               ),
                               );
        
        $condition['group'] = array( 'SelHistory2.id, SelHistory2.can_candidate_id' );
        
        $subQuery = $db->buildStatement( $condition, $this );
        
        $subQuery = 'SelHistory.id IN (' . $subQuery . ') ';
        
        $subQueryExpression = $db->expression($subQuery);

        unset( $conditions );

        $conditions[] = $subQueryExpression;
        
        $this->virtualFields['max_id'] = 0;
        
        return $subQuery;
        
    }
    
    /**
     * 
     * 並び順（テーブルの順序）をキーにIDをセットして、戻す処理
     * 
     * @param array
     * @return array
     * 
     **/
    public function getStageDataSort( $stage_data )
    {
        
        $result = array();
        
        foreach( $stage_data as $row )
        {
            $data = $row['ScreeningStage'];
        
            $result[$data['order']] = $data['id'];
        }
        
        return $result;
    }
    
    /**
     * 
     * getSummaryIndexConditons
     * 選考履歴サマリの一覧表のSQLを作成する処理
     * 
     * @param object
     * @return array
     * 
     **/
    public function getSummaryIndexConditons( $data )
    {
        $condition['conditions'] = array();
        
        $cond = & $condition['conditions'];
        
        $cond['SelStat.job_vote_id'] = $data->job_vote_id;
        
        $cond['JobVote.wanted_year'] = SessionComponent::read('WantedYear');
        $cond['SelStat.screening_stage_id'] = $data->screening_stage_id;
        $cond['SelStat.select_status_id'] = $data->select_status_id;
        
        $cond['CanCandidate.rec_company_id'] = $this->getUserInfo('rec_company_id');

        $db = $this->getDataSource();
        
        $condition['fields'] = array( 'SelHistory.can_candidate_id' );
        $condition['table'] = $db->fullTableName($this);
        $condition['alias'] =  'SelHistory' ;
        $condition['joins'] =  array( 
                                      0 =>array( 'type'=>'INNER',
                                                 'table'=>'sel_stat_children',
                                                 'alias'=>'SelStatChildren',
                                                 'conditions'=>array(
                                                                 0 => 'SelStatChildren.job_vote_id = SelHistory.job_vote_id',
                                                                 1 => 'SelStatChildren.screening_stage_id =SelHistory.screening_stage_id',
                                                                 2 => 'SelStatChildren.select_status_id =SelHistory.select_status_id',
                                                 )
                                                 ),
                                      1=>array( 'type'=>'INNER',
                                                'table'=>'sel_stats',
                                                'alias'=>'SelStat',
                                                'conditions'=>array( 
                                                                 0=>'SelStat.job_vote_id = SelStatChildren.job_vote_id',
                                                                 1=>'SelStat.screening_stage_id = SelStatChildren.screening_stage_id',
                                                                 2=>'SelStat.select_status_id = SelStatChildren.select_status_id',
                                                )
                                                ),
                                      2 =>array( 'type'=>'INNER',
                                                 'table'=>'job_votes',
                                                 'alias'=>'JobVote',
                                                 'conditions'=>array(
                                                                 0 => 'JobVote.id = SelStatChildren.job_vote_id',
                                                 )
                                                 ),
                                      3 =>array( 'type'=>'INNER',
                                                 'table'=>'can_candidates',
                                                 'alias'=>'CanCandidate',
                                                 'conditions'=>array(
                                                                 0 => 'CanCandidate.id =SelStatChildren.can_candidate_id',
                                                 )
                                                 ),
                                                 
                                    );
        
        
        $subQuery = $db->buildStatement( $condition, $this );
        
        $subQuery = 'SelHistory.can_candidate_id IN (' . $subQuery . ') ';
        
        $subQueryExpression = $db->expression($subQuery);

        unset( $conditions );

        $conditions[] = $subQueryExpression;
        
        $this->virtualFields['max_id'] = 0;
        
        return $subQuery;
        
    }
    
    /**
    * 次回選考履歴のデータ追加
    * @param mixed history
    * @param mixed stages
    * @return mixed 
    */
    public function addNewSelHistory($history, $stages){
		$data = $this->trimSaveData($history, $stages);
    	$this->create();
 		return $this->save($data);
    }

    public function isLock($history){
    	return !empty($history['lock_id']);
    }
    /**
     * 
     * setLockFlag
     * ロックをONにする処理
     * 
     * @param int
     * @return bool
     * 
     **/
    public function setLockId( $id )
    {        
        $data['id'] = $id;
        $data['lock_id'] = $this->getUserInfo('id');
        
        return $this->save($data);
    }
    /**
     * 
     * setLockIdAll
     * 渡されたデータすべてに対してロックをONにする処理
     * 
     * @param array
     * @return mixed
     * 
     **/
    public function setLockIdAll( $ids )
    {
    	$userId = $this->getUserInfo('id');
    	foreach($ids as $id){
    		$data[]['SelHistory'] = array(
    				'id' => $id,
    				'lock_id' => $userId,
    			);
    	}
        $this->saveAll($data);
    }

    /**
     * 
     * unsetLockIdAll
     * 渡されたデータすべてに対してロックをOFFにする処理
     * 
     * @param array
     * @return mixed
     * 
     **/
    public function unsetLockIdAll( $ids )
    {
    	$userId = $this->getUserInfo('id');
    	foreach($ids as $id){
    		$data[]['SelHistory'] = array(
    				'id' => $id,
    				'lock_id' => 0,
    			);
    	}
        $this->saveAll($data);
    }
    /**
     * 
     * setLockFlag
     * ロックをONにする処理
     * 
     * @param int
     * @return bool
     * 
     **/
    public function unsetLockId( $id )
    {        
        $data['id'] = $id;
        $data['lock_id'] = 0;
        
        return $this->save($data);
    }

    /**
    * 選考段階の一番新しいものを抽出
    */
    public function getLatestHistory($history){

    	$this->recursive = -1;
		$options['contain'] = array('ScreeningStage');
		$options['conditions'] = array(
			'SelHistory.job_vote_id'		 => $history['job_vote_id'],
			'SelHistory.can_candidate_id'	 => $history['can_candidate_id'],
			'SelHistory.status'			 => 0,
			);
		$options['order'] = array('ScreeningStage.order DESC');
		return $this->find('first', $options);
    }

    /**
    * 渡された選考履歴が最新のものかチェックする
    */
	public function isLatest($history){
		$latest = $this->getLatestHistory($history);
		return ($latest['SelHistory']['id'] == $history['id']);
	}
	/**
	* ステータスの更新処理
	* @param mixed $history
	* @param integer $status_id
	*/
	public function statusUpdate($history, $status_id){
		$data['SelHistory'] = array(
			'id'				 => $history['id'],
			'select_status_id'	 => $status_id,
		);
		return $this->save($data);
	}

	/**
	*
	*
	*
	*/
    public function isLastStage($history){
    	$options = $this->ScreeningStage->getListDefaultConditions();
    	$options['recursive'] = -1;
    	$stages = $this->ScreeningStage->find('all', $options);
    	$stage_array = $this->getStageDataSort( $stages );
    	$isLast = $this->ScreeningStage->isStageLast($stage_array ,$history['SelHistory']['screening_stage_id'] );
    	return array($isLast, $stage_array);
    }

    /**
    * 選考履歴の削除処理
    *
    */
    public function deleteHistory($id) {
    	$pendingStatus = 10; // ペンディング

    	$this->recursive = -1;
    	$delData = $this->findById($id);

    	// ロックフラグチェック
    	if ($this->isLock($delData['SelHistory'])){
    		return false;
    	}

		$datasource = $this->getDataSource();

    	try{
    		$datasource->begin();
	   
	   		// 削除
	    	if (!empty($id)) {
	    		$this->create();
	    		$this->delete($id);
	    	}

	    	$latestHistory = $this->getLatestHistory($delData['SelHistory']);

	    	// ロックフラグチェック
	    	if ($this->isLock($latestHistory['SelHistory'])){
    		return false;
	    	}

	    	// 最新のデータをペンディングに更新
	    	$upRecord = $this->statusUpdate($latestHistory['SelHistory'], $pendingStatus);

			$resRecord['SelHistory'] = array_merge($latestHistory['SelHistory'], $upRecord['SelHistory']);

			$datasource->commit();

		} catch (Exception $e){
			$datasource->rollback();
    		return false;
		}

		return $resRecord;
    }


    /**
     * 選考履歴ステータスの一括更新
     *　@param mixed $selhistories
     *　@param int $select_status_id
     * @return mixed
    **/
    public function updateStatusBulk($selHistories, $select_status_id){
    	$role_type = $this->getUserInfo('role_type');
		$pass_status = 5; // 合格ステータス

        // 選考段階マスタ取得（ステータス遷移チェック用）
        $stage_array = $this->getScreeningStageOrder();
        
        // エラーチェック
        $judgedKey = array_search("評価済" , Configure::read('assign_situation'));
        $enjinHelper = new EnjinHelper(new View());
        foreach ($selHistories as $history) {
            $hist = $history['SelHistory'];
            // 最新チェック
            $isLatest = $this->isLatest($hist);
            // ロックのチェック
            $isLock = $this->isLock($hist);
            if ($isLock || !$isLatest) {
                $errorRecord[] = $this->addErrorCode($hist, $this->statusErrorCode);
                continue;
            }

            // 遷移先のステータスが正常に遷移できるかチェック
            $availableStatus = $enjinHelper->getAvailableStatus($stage_array, $hist['screening_stage_id'], $hist['select_status_id']);
            if (!in_array($select_status_id , $availableStatus)){
                $errorRecord[] = $this->addErrorCode($hist, $this->statusErrorCode);
                continue;
            }

            if ( $role_type == ROLE_TYPE_INTERVIEWER && $select_status_id == $pass_status) {
                // 面接官がステータスを合格にできるのは、採用担当者選考履歴にあるレコードがすべて評価済の場合のみ
                $tmpError = $this->checkSelRecHistory($hist, $judgedKey);
                if (!empty($tmpError)){
                	$errorRecord[] = $this->addErrorCode($tmpError, $this->statusErrorCode);
                	continue;
                }
            }
            $ids[] = $hist['id'];
            $histories[] = $history;
        }
        if (empty($ids)){
            return compact('errorRecord');
        }
        // ステータスの変更
        // ロックフラグを立てる（一括）
        $this->setLockIdAll($ids);

        // データの整形・更新
        foreach ($histories as $history){

            $res = array();
            $this->statusUpdate($history['SelHistory'] ,$select_status_id);

            // 変更先が合格ステータスかチェック
            if ($select_status_id == $pass_status) {
                $isLast = $this->ScreeningStage->isStageLast($stage_array ,$history['SelHistory']['screening_stage_id'] );
                // 最終選考チェック
                if (!$isLast){
                    // 新しいレコードの作成
                    $res = $this->addNewSelHistory($history, $stage_array);
                }
            }
            if (empty($res)){
                $resRecord[] = $history;
            }else{
                $resRecord[] = $res;
            }
        }
        // ロックフラグの解除（一括）
        $this->unsetLockIdAll($ids);

        return compact('resRecord','errorRecord'); 

    }



    /**
    *  部署をグループ化して取得して、リストで返す
    *  @return mixed
    */
    public function getParentDepartments() {
        $this->RecDepartment = new RecDepartment;

        $option = array();
        $option['recursive'] = -1; 
        $option['fields'] = array('id', 'department_name', 'parent_id'); 
        $option['conditions'] = array( 'rec_company_id' => $this->getUserInfo('rec_company_id') );
        $dptList = $this->RecDepartment->find('list', $option);

        return $dptList;
    }


    /**
    *  部署をグループ化して取得して、リストで返す
    *  @return mixed
    */
    public function getRecRecruitersHistories($sel_history_id) {

        $option = array();
        $option['recursive'] = -1;
        $option['contain'] = array('RecRecruiter');
        $option['conditions'] = array( 
        	'sel_history_id' 				=> $sel_history_id,
        	'SelRecruiterHistory.status'	=> 0,
        );
        return $this->SelRecruiterHistory->find('all', $option);
    }
    
    /**
     * 
     * 選考履歴詳細画面において、編集可能かを判断する
     * 
     * @param int
     * @return bool  true:;edit OK false:edit ng
     * 
     **/
    public function isEdit( $id )
    {
        $this->recursive = -1;
        $finddata = $this->findByIdAndStatus( $id , 0 );
        
        $data = $finddata['SelHistory'];
        
        switch( $data['select_status_id'] ){
            case 5:
            case 6:
            case 7:
            case 8:
            case 9:
                return false;
            default:
                
                //ロックの取得状況確認
                if ( empty($data['lock_id'] ) ) return true;
                if ( $data['lock_id'] == $this->getUserInfo('id')) return true;
                
                return false;
        }
    }
    
    /**
     * 
     * 利用可能なデータなのかを判断する
     * 
     * @param int
     * @return bool
     * 
     * 
     **/
    public function isUses( $id )
    {
        $this->recursive = 0;
        $this->contain('ScreeningStage');
        
        $condtions = array( 'ScreeningStage.rec_company_id'=> $this->getUserInfo('rec_company_id'),
                            'SelHistory.id'=>$id,
                            'SelHistory.status'=>0,
                            'RecCompany.status'=>0
                            );
                            
        $joins[] = array( 'type'=>'INNER',
                          'table'=>'rec_companies',
                          'alias'=>'RecCompany',
                          'conditions'=>'RecCompany.id = ScreeningStage.rec_company_id');
        return ( bool ) $this->find( 'count', array( 'conditions'=> $condtions, 'joins'=>$joins ));
        
    }

    	/**
	* 選考履歴から取得した候補者のIDを使用して過去の選考履歴を取得
	* @param  $data    array
	* @param  $data   array
	* @return $result array
	**/    
    public function getPastSelHist( $data )
    {

    	foreach ($data as $key => $value) {
	    	$ids[] = $value['can_candidates']['id'];

    	}

    	$findParam = array(
    			'conditions' => array( 'SelHistory.can_candidate_id' => $ids, 
    								   'SelHistory.status' => 0, 
    								   'CanCandidate.rec_company_id' => $this->getUserInfo('rec_company_id') ),
    			'contain' => array( 'CanCandidate' ),
    			'fields' => array( 'SelHistory.job_vote_id',
    							   'SelHistory.can_candidate_id', 
    							   'SelHistory.comment', 
    							   'SelHistory.select_status_id', 
    							   'SelHistory.select_option_id', 
    							   'SelHistory.screening_stage_id' ),
    			'recursive' => 0 
    		);

    	$result = $this->find( 'all', $findParam );
    	return $result;

    }
    
    /**
     * 
     * 新しい選考履歴データを作成する
     * 
     * @param array
     * @param int
     * @return array
     * 
     * 
     **/
    public function getInitData( $old_data, $nextSSid)
    {
        
        return array(
                'sel_status_id'         => 0,
                'job_vote_id'           => $old_data['SelHistory']['job_vote_id'],
                'can_candidate_id'      => $old_data['SelHistory']['can_candidate_id'],
                'select_status_id'      => 0,
                'select_option_id'      => 0,
                'status'                => 0,
                'influx_propriety'      => 0,
                'candidate_proprity'    => 0,
                'last_modified_type'    => $this->getUserInfo('role_type'),
                'rec_recruiter_id'      => $this->getUserInfo('id'),
                'screening_stage_id'    => $nextSSid,
        );
        
    }
    
    
    /* =*-*=*-*=*-*=*-*=*-*=*-* 以下 private =*-*=*-*=*-*=*-*=*-*=*-*=*-*=*-* */

    /*
    * 選考段階マスタの順序を取得
    */
    private function getScreeningStageOrder(){
        $condtions = $this->ScreeningStage->getListDefaultConditions();
        $screeningStages = $this->ScreeningStage->find('list', $condtions);
        $screeningStages_array = $this->ScreeningStage->find('all', $condtions);
        return $this->getStageDataSort( $screeningStages_array );
    }


    /*
    * 
    *
    */
    private function checkSelRecHistory($hist, $judgedKey) {

    	$errorRecord = array();

        $options['recursive']  = -1;
        $options['conditions'] = array('sel_history_id' => $hist['id']);
        $recHists = $this->SelRecruiterHistory->find('all', $options);
        foreach ($recHists as $recHist) {
            if ( empty($recHists) || $recHist['SelRecruiterHistory']['assign_situation_id'] != $judgedKey){
                $errorRecord = $hist;
                break;
            }
        }
        return $errorRecord;
    }

    /*
    * 更新対象のデータをもとに、新しく保存されるデータを作る
    *
    */
    private function trimSaveData($history, $stages){

    	$data['SelHistory'] = array(
    		'sel_status_id' 		=> 0,
    		'job_vote_id' 			=> $history['SelHistory']['job_vote_id'],
    		'can_candidate_id' 		=> $history['SelHistory']['can_candidate_id'],
    		'select_status_id' 		=> 0,
    		'select_option_id' 		=> 0,
    		'status' 				=> 0,
    		'influx_propriety' 		=> 1,
    		'candidate_proprity'	=> 1,
    		'last_modified_type'	=> $this->getUserInfo('role_type'),
    		'rec_recruiter_id'		=> $this->getUserInfo('id'),
		);
		if (!empty($history['SelHistory']['inf_staff_id'])) {
			$infstaff = array(
				'inf_staff_id' => $history['SelHistory']['inf_staff_id']
			);
			$data['SelHistory'] = array_merge($data['SelHistory'], $infstaff);
		}
    	return $this->setNextStage($data, $history, $stages);
    }

    /**
    * 次回選考段階IDを格納
    * @param mixed data
    * @param mixed history
    * @param mixed stages
    * @return mixed 
    */
	private function setNextStage($data, $history, $stages){
    	// 現状の選考段階の次の段階のidを取得
    	$breakFlg = 0;
		foreach ($stages as $stage){
			if ($breakFlg == 1){
				$data['SelHistory']['screening_stage_id'] = $stage;
				return $data;
			}
			if ($history['SelHistory']['screening_stage_id'] == $stage){
				$breakFlg = 1;
			}
		}
		return $data;
	}


    /**
    * 対象の選考履歴が最終面談かチェックする
    * @param mixed history
    * @return boolean
    *
    */
    private function isLast($history, $stages){

    	$lastStage = $this->getLastStage($stages);

    	// 選考履歴と一致していればTrue
    	// 一致していない場合false
    	if ($lastStage['ScreeningStage']['order'] == $history['screening_stage_id']){
    		return true;
    	} else {
    		return false;
    	}
    }




    /**
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     **/
    
    
    /**
     * 
     * 日付のフォーマットをあわせる処理
     * 
     * @param array
     * @param int  加算日付
     * 
     * @return string
     * 
     **/
    private function getDate2FormatDate( $dateArray , $addDate = 0)
    {
        $date = sprintf( "%04d-%02d-%02d", $dateArray[0], $dateArray[1], $dateArray[2] );
        
        $date = date_create( $date );
        
        $date_string_name = sprintf( "%d days", $addDate );
        return date_add($date , date_interval_create_from_date_string($date_string_name) )->Format("Y-m-d");
        
    }

    /**
     * check duplicate between  job_vote_id and can_candidate_id
     * @param $jobVoteId
     * @param $canCandidateId
     * @return bool
     */
    public function checkUnique($jobVoteId, $canCandidateId) {

        $this->recursive = -1;
        return (bool)$this->find('count',array(
                'conditions' => array(
                    'SelHistory.job_vote_id' => $jobVoteId ,
                    'SelHistory.can_candidate_id' => $canCandidateId,
                    'SelHistory.status' => 0,
                ),
            )
        );
    }
}
