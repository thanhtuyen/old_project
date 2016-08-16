<?php
App::uses('AppModel', 'Model');
/**
 * EvSchedule Model
 *
 * @property EvEvent $EvEvent
 * @property EvHistory $EvHistory
 */
class EvSchedule extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'ev_event_id' => array(
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
		'holding_date' => array(
			'datetime' => array(
				'rule' => array('datetime'),
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
		'end_date' => array(
			'datetime' => array(
				'rule' => array('datetime'),
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
		'individual_theme' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'capacity' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'wanted_deadline' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'holding_cost' => array(
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
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'EvEvent' => array(
			'className' => 'EvEvent',
			'foreignKey' => 'ev_event_id',
			'conditions' => '',
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
		'EvHistory' => array(
			'className' => 'EvHistory',
			'foreignKey' => 'ev_schedule_id',
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
* 定員割れイベント開催日程リスト&アラート情報取得
* 
* @param  int   $rec_company_id
* @param  array $data 
* @return array $result
* 
**/
	// public function getCapCrackSchedule( $rec_company_id, $data )
	// {

	// 	$year = $data['year'].'-%';
	// 	$param = array( $rec_company_id, $year );

	// 	$sql = "
	// 		SELECT ev_events.id, ev_events.name, ev_schedules.id,  
	// 		       ev_events.screening_stage_id,ev_events.screening_stage_type, 
	// 		       ev_events.target_select_id, ev_schedules.holding_date, 
	// 		       ev_schedules.capacity, ev_schedules.wanted_deadline, screening_stages.order,
	// 		       screening_stages.name, sel_stat_children.screening_stage_id , st.order,
	// 		       COUNT( ev_stat_children.can_candidate_id ) count, 
	// 		       sel_stat_children.select_status_id
	// 		FROM ev_schedules  
	// 		INNER JOIN ev_stat_children ON ev_schedules.id = ev_stat_children.ev_schedule_id 
	// 		INNER JOIN ev_events ON ev_schedules.ev_event_id = ev_events.id 
	// 		INNER JOIN screening_stages ON ev_events.screening_stage_id = screening_stages.id
	// 		LEFT JOIN sel_stat_children ON ev_stat_children.can_candidate_id = sel_stat_children.can_candidate_id 
	// 		INNER JOIN screening_stages AS st ON sel_stat_children.screening_stage_id = st.id
	// 		WHERE ev_events.rec_company_id = ? 
	// 		AND screening_stages.status = 0 
	// 		AND ev_events.status IN ( 1 )  
	// 		AND ev_schedules.holding_date LIKE ?
	// 		GROUP BY ev_schedules.ev_event_id, ev_schedules.id, sel_stat_children.screening_stage_id 
	// 		ORDER BY ev_schedules.ev_event_id, ev_schedules.id , sel_stat_children.screening_stage_id
	// 	";


	// 	$result = $this->query( $sql, $param );

	// 	return $result;

	// }


/**
* 
* 定員割れイベント開催日程リスト&アラート情報取得
* 
* @param  int   $rec_company_id
* @param  array $data 
* @return array $result
* 
**/
	public function getCapCrackSchedule( $rec_company_id, $data )
	{

		$year = $data['year'].'-%';
		$param = array( $rec_company_id, $year );

		$sql = "
			SELECT ev_events.id, ev_events.name, ev_schedules.id,  
			       ev_events.screening_stage_id,ev_events.screening_stage_type, 
			       ev_events.target_select_id, ev_schedules.holding_date, 
			       ev_schedules.capacity, ev_schedules.wanted_deadline, 
			       screening_stages.name, 
			       SUM( ev_stats.count ) count 
			FROM ev_schedules  
			INNER JOIN ev_stats ON ev_schedules.id = ev_stats.ev_schedule_id 
			INNER JOIN ev_events ON ev_schedules.ev_event_id = ev_events.id 
			INNER JOIN screening_stages ON ev_events.screening_stage_id = screening_stages.id
			WHERE ev_events.rec_company_id = ? 
			AND screening_stages.status = 0 
			AND ev_events.status IN ( 1 )  
			AND ev_schedules.holding_date LIKE ?
			GROUP BY ev_schedules.ev_event_id, ev_schedules.id 
			ORDER BY ev_schedules.ev_event_id, ev_schedules.id 
		";

		$result = $this->query( $sql, $param );

		return $result;

	}

	


/**
* イベントスケジュールと出席簿
* 
* @param  int   $rec_company_id 
* @param  array $data
* @return array $result
**/
	public function getScheduleCandidate( $rec_company_id, $data )
	{

		$param = array( $rec_company_id, $data['ev_schedule_id'], $data['year'] );

		$sql = "
			SELECT ev_events.name, ev_events.id, 
			       ev_schedules.holding_date, ev_schedules.end_date, 
			       ev_schedules.venue, ev_histories.status,
			       can_candidates.id, can_candidates.last_name, can_candidates.first_name, can_candidates.tel,
			       can_candidates.mail_address,  can_educations.school_id, 
			       coalesce( schools.name, can_educations.school ) school_name
			FROM ev_histories 
			INNER JOIN can_candidates ON ev_histories.can_candidate_id = can_candidates.id 
			INNER JOIN can_educations ON can_candidates.id = can_educations.can_candidate_id 
			LEFT JOIN schools ON can_educations.school_id = schools.id  
			INNER JOIN ev_schedules ON ev_histories.ev_schedule_id = ev_schedules.id 
			INNER JOIN ev_events ON ev_schedules.ev_event_id = ev_events.id 
			LEFT JOIN job_votes ON ev_events.job_vote_id = job_votes.id 
			WHERE ev_events.rec_company_id = ? 
			AND ev_schedules.id = ? 
			AND can_candidates.status = 0  
			AND ev_events.status = 1 
			AND ( job_votes.wanted_year = ? OR job_votes.wanted_year IS NULL ) 
			GROUP BY ev_schedules.ev_event_id, ev_schedules.id, ev_histories.can_candidate_id
			ORDER BY ev_schedules.ev_event_id, ev_schedules.id 
		";



		$result = $this->query( $sql, $param );


		return $result;

	}

/**
* イベントスケジュールと出席簿(PDF出力用)
* 
* @param  int   $rec_company_id 
* @param  array $data
* @return array $result
**/
	public function getScheduleCandidateAttendance( $rec_company_id, $data )
	{

		$param = array( $rec_company_id, $data['ev_schedule_id'], $data['year'] );

		$sql = "
			SELECT ev_events.name, ev_events.id, 
			       ev_schedules.holding_date, ev_schedules.end_date, 
			       can_candidates.id, can_candidates.last_name, can_candidates.first_name, can_candidates.tel,
			       can_candidates.cell_number,  can_candidates.cell_mail, 
			       can_candidates.mail_address,  can_educations.school_id,  can_educations.undergraduate_id, 
			       coalesce( schools.name, can_educations.school ) school_name,
			       coalesce( undergraduates.name, can_educations.undergraduate ) undergraduate
			FROM ev_histories 
			INNER JOIN can_candidates ON ev_histories.can_candidate_id = can_candidates.id 
			INNER JOIN can_educations ON can_candidates.id = can_educations.can_candidate_id 
			LEFT JOIN schools ON can_educations.school_id = schools.id  
			LEFT JOIN undergraduates ON can_educations.undergraduate_id = undergraduates.id  
			INNER JOIN ev_schedules ON ev_histories.ev_schedule_id = ev_schedules.id 
			INNER JOIN ev_events ON ev_schedules.ev_event_id = ev_events.id 
			LEFT JOIN job_votes ON ev_events.job_vote_id = job_votes.id 
			WHERE ev_events.rec_company_id = ? 
			AND ev_schedules.id = ? 
			AND can_candidates.status = 0 
			AND ev_events.status = 0 
			AND ( job_votes.wanted_year = ? OR job_votes.wanted_year IS NULL ) 
			GROUP BY ev_schedules.ev_event_id, ev_schedules.id, ev_histories.can_candidate_id
			ORDER BY ev_schedules.ev_event_id, ev_schedules.id 
		";


		$result = $this->query( $sql, $param );


		return $result;

	}
    
    /**
     * 
     * イベント一覧取得用SQLの作成
     * 
     * @param array
     * @return array
     * 
     **/
    public function getSearchResult( $data )
    {   
        
        $prepare = array();
        
        $query = $this->getSearchQuery( $data , $prepare );
        
        return $this->query( $query, $prepare );
        
    }

        /**
    * イベント情報取得
    * 
    * @param  int   $id
    * @param  array $data 
    * @return array $result
    **/
    public function getLists( $id, $data )
    {
    	$conditions = array(
    			"conditions" => array( 
    				'EvEvent.id' => $id,
    				'EvEvent.rec_company_id' => $data['rec_company_id'], 
    				'EvEvent.status' => 1,
    				'OR' => array( 'JobVote.wanted_year' => $data['year'], 'EvEvent.job_vote_id IS NULL' )
    			),

    			"recusive" => 1,
    			"contain" => array( 'EvEvent'=>array('JobVote') ),
    			'fields' => array( 'EvSchedule.holding_date' ) 
    		);

    	$conditions['joins'][] = array(
    			'type' => 'LEFT',
    			'table' => 'job_votes',
    			'alias' => 'JobVote',
    			'conditions' => 'EvEvent.job_vote_id = JobVote.id'
    		);

    	return $this->find( 'list', $conditions );

    }
    
    /**
     * 
     * イベント一覧用のSQL文作成
     * 
     * @param array
     * @param array pointer
     * 
     * @return string
     * 
     **/
    private function getSearchQuery( $data , & $prepare )
    {
        
        $sql = "SELECT 
                    EvEvent.id,
                    EvEvent.name,
                    EvEvent.type,
                    JobVote.id,
                    JobVote.title,
                    ScreeningStage.name,
                    EvSchedule.holding_date,
                    EvSchedule.end_date,
                    EvSchedule.id,
                    EvSchedule.capacity
                FROM ev_events as EvEvent";

        $joins[] = "INNER JOIN screening_stages as ScreeningStage ON ScreeningStage.id = EvEvent.screening_stage_id";
        
        //入力データによるJOINの変更
        if ( empty( $data['chk_non_sch'] ) ) {
            $joins[] = "INNER  JOIN ev_schedules as EvSchedule ON  EvSchedule.ev_event_id = EvEvent.id AND EvSchedule.status != 9";
        }else{
            $joins[] = "LEFT  JOIN ev_schedules as EvSchedule ON  EvSchedule.ev_event_id = EvEvent.id AND EvSchedule.status != 9";
        }
        
        if ( empty( $data['jobVotes'] ) )
        {
            $joins[] = "LEFT  JOIN job_votes as JobVote ON JobVote.id = EvEvent.job_vote_id AND JobVote.wanted_year = ? AND JobVote.status != 9";
        }else{
            $joins[] = "INNER  JOIN job_votes as JobVote ON JobVote.id = EvEvent.job_vote_id AND JobVote.wanted_year = ? AND JobVote.status != 9";
        }
        $prepare[] = SessionComponent::read('WantedYear');
        
        $where[] = "EvEvent.rec_company_id = ?";
        $prepare[] = $this->getUserInfo('rec_company_id');

        $where[] = "EvEvent.status != 9";

        
        //入力データによる分岐
        if ( !empty( $data['year_month_day_from'] )) {
            $where[] = "EvSchedule.holding_date >= ?";
            $prepare[] = $data['year_month_day_from'];
        }
        
        if ( !empty( $data['year_month_day_to'] )) {
            $where[] = "EvSchedule.end_date <= ? ";
            $prepare[] = $data['year_month_day_to'];
        }

        if ( isset( $data['evnt_type'] )) {
            
            if ( is_numeric( $data['evnt_type'] )) {
                $where[] = "EvEvent.type = ?";
                $prepare[] = $data['evnt_type'];
            }
        }
        
        if ( isset( $data['jobVotes'] ) ){
            if ( is_numeric( $data['jobVotes'] )) {
                $where[] = "EvEvent.job_vote_id = ?";
                $prepare[] = $data['jobVotes'];
            }
        }
        
        if ( isset( $data['ScreeningStages'] )) {
            if ( is_numeric( $data['ScreeningStages'] )) {
                $where[] = "EvEvent.screening_stage_id = ?";
                $prepare[] = $data['ScreeningStages'];
            }
        }
        
        if ( !empty( $data['mynavi_id'] )) {
            $where[] = "EvEvent.mynavi_id = ? ";
            $prepare[] = $data['mynavi_id'];
        }

        if ( !empty( $data['rikunavi_id'] )) {
            $where[] = "EvEvent.rikunavi_id = ? ";
            $prepare[] = $data['rikunavi_id'];
        }

        return sprintf( "%s %s WHERE %s order by EvEvent.id" , $sql , implode( " ",$joins ) ,implode( " AND " , $where ) );
        
    }
    
    
    /**
     * 
     * イベントカレンダーカレンダーデータの取得
     * 
     * @param int
     * @param int
     * 
     * @return array
     * 
     **/
    public function getCalender( $year , $month )
    {
        $ymd = sprintf( "%04d-%02d-%02d",$year , $month , 1 );
        $prepare = array();
        
        $query = $this->getCalenderQuery($ymd, $prepare);

        return $this->query( $query, $prepare );

    }

    /**
     * 
     * イベント一覧用のSQL文作成
     * 
     * @param date y-m-d format
     * 
     * @return string
     * 
     **/
    private function getCalenderQuery( $ymd, & $prepare )
    {
        
        // 日付からデータを設定する
        $date = date_create( $ymd );
        $from = date_format( $date, "Y-m-d" );
        date_add($date, date_interval_create_from_date_string('1 month'));
        $to = date_format( $date,"Y-m-d" );
        
        $sql = "SELECT 
                    EvSchedule.holding_date,
                    EvSchedule.end_date,
                    EvSchedule.id,
                    EvSchedule.capacity,
                    EvEvent.id,
                    EvEvent.name
                FROM ev_events as EvEvent";

        $joins[] = "INNER  JOIN ev_schedules as EvSchedule ON  EvSchedule.ev_event_id = EvEvent.id";
        $where[] = "EvEvent.rec_company_id = ?";
        $prepare[] = $this->getUserInfo('rec_company_id');
        
        $where[] = "EvSchedule.status != 9";
        $where[] = "EvEvent.status != 9";
        
        $where[] = "EvSchedule.holding_date > ?";
        $prepare[] = $from;
        
        $where[] = "EvSchedule.holding_date < ?";
        $prepare[] = $to;
        
        return sprintf( "%s %s WHERE %s order by EvSchedule.holding_date asc" , $sql , implode( " ",$joins ) ,implode( " AND " , $where ) );
        
    }
    
    
    /**
     * 
     * カレンダーのデータをviewに表示しやすいように加工する
     * 
     * @param array
     * @return array
     * 
     **/
    public function setCalender( $rows )
    {
        $result = array();
        
        foreach( $rows as $row )
        {
            if( !empty( $row["EvSchedule"]["holding_date"] ) ){
                $dateTime = $row["EvSchedule"]["holding_date"];
                
                list( $ymd , $time ) = explode( " ", $dateTime );
                list( $y, $m, $d ) =  explode( "-", $ymd );
                $d = (int) $d;
                $result[$d][$dateTime] = $row;
            }
        }
        
        return $result;
        
    }

}
