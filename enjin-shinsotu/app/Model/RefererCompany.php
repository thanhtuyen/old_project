<?php
App::uses('AppModel', 'Model');
/**
 * RefererCompany Model
 * 流入元企業
 * @property RecCompany $RecCompany
 * @property Prefecture $Prefecture
 * @property City $City
 * @property RecRecruiter $RecRecruiter
 * @property CanCandidate $CanCandidate
 * @property InfContract $InfContract
 * @property InfJobVotePublic $InfJobVotePublic
 */
class RefererCompany extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

    const TYPE_RIKUNAVI = 7;
    const TYPE_MYNAVI = 8;

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
		'influx_original_type' => array(
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
		'prefecture_id' => array(
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
		'city_id' => array(
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
		'Prefecture' => array(
			'className' => 'Prefecture',
			'foreignKey' => 'prefecture_id',
			'conditions' => 'Prefecture.status = 0',
			'fields' => '',
			'order' => ''
		),
		'City' => array(
			'className' => 'City',
			'foreignKey' => 'city_id',
			'conditions' => 'City.status = 0',
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
		'CanCandidate' => array(
			'className' => 'CanCandidate',
			'foreignKey' => 'referer_company_id',
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
		'InfContract' => array(
			'className' => 'InfContract',
			'foreignKey' => 'referer_company_id',
			'dependent' => false,
			'conditions' => 'InfContract.status != 9',
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
			'foreignKey' => 'referer_company_id',
			'dependent' => false,
			'conditions' => 'InfJobVotePublic.status = 0',
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
			'foreignKey' => 'referer_company_id',
			'dependent' => false,
			'conditions' => 'InfStaff.status = 0',
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
     * 流入元企業マスタ・初期データ投入
     * 
     * @param  int
     * @param  int
     * @return array
     * 
     **/
    public function getInitData( $pref_id, $city_id)
    {
        return array ( 0 => array(
                            'name'=>'自社',
                            'influx_original_type'=>3,
                            'prefecture_id'=>$pref_id,
                            'city_id'=>$city_id,
                            'rec_recruiter_id'=>0,
                            'mycompany' => 1,
                            'status'=>0
                       ),
                       1 => array(
                            'name'=>'リクナビ',
                            'influx_original_type'=>7,
                            'prefecture_id'=>13,
                            'city_id'=>629,
                            'rec_recruiter_id'=>0,
                            'status'=>0
                       ),

                       2 => array(
                            'name'=>'マイナビ',
                            'influx_original_type'=>8,
                            'prefecture_id'=>13,
                            'city_id'=>628,
                            'rec_recruiter_id'=>0,
                            'status'=>0
                       ),

        );
    }
    
    public function getListDefaultConditions()
    {
        return array( 'conditions'=>array(
                            'RefererCompany.rec_company_id' => $this->getUserInfo('rec_company_id'),
                            'RefererCompany.status'=>0
                        )
                );        
        
    }
    

    public function getPullDownList( $isBlank = true)
    {
        $result = array();
        
        if ( $isBlank ) $result[""] = "";
        
        $condtions = $this->getListDefaultConditions();
        
        return  $result += $this->find('list', $condtions);
    }


    /**
    * 求人票別 流入元企業割当リスト
    * 
    * @param  int   $rec_company_id
    * @param  array $data
    * @return array $result
    **/
	public function getAllocateCompany( $rec_company_id, $data )
	{
		$param = array( $rec_company_id, $data['year'], $data['job_vote_id'] );

		$sql = "
			SELECT job_votes.id, job_votes.title, referer_companies.id, 
			       referer_companies.name, inf_job_vote_publics.id, 
			       sel_stat_children.screening_stage_id, sel_stat_children.select_status_id, 
			       screening_stages.name,  COUNT( sel_stat_children.can_candidate_id ) count ,
			       CASE WHEN inf_job_vote_publics.id IS NULL THEN 0 ELSE 1 END allocation 
			FROM referer_companies 
			LEFT JOIN inf_job_vote_publics ON referer_companies.id = inf_job_vote_publics.referer_company_id 
			LEFT JOIN job_votes ON inf_job_vote_publics.job_vote_id = job_votes.id 
			LEFT JOIN sel_stat_children ON job_votes.id = sel_stat_children.job_vote_id 
			INNER JOIN can_candidates ON sel_stat_children.can_candidate_id = can_candidates.id 
				AND can_candidates.referer_company_id = referer_companies.id
			LEFT JOIN screening_stages ON sel_stat_children.screening_stage_id = screening_stages.id 
			WHERE referer_companies.rec_company_id = ? 
			AND referer_companies.status = 0 
			AND  job_votes.status = 0  
			AND  job_votes.wanted_year = ?  
			AND  job_votes.id = ? 
			AND  inf_job_vote_publics.status = 0 
			GROUP BY job_votes.id, referer_companies.id, sel_stat_children.screening_stage_id, sel_stat_children.select_status_id 
			ORDER BY job_votes.id, referer_companies.id, screening_stages.order, sel_stat_children.select_status_id
		";

		$result = $this->query( $sql, $param );
// print_r($result); exit;
		return $result;

	}    

	/**
	* 媒体別申込数情報取得
	* 
	* @param  int   $rec_company_id 
	* @param  array $data 
	* @return array $result
	**/
	public function getRefNumberOfApp( $rec_company_id, $data )
	{
		$param = array( $rec_company_id, $data['year'] );

		$sql = "
			SELECT referer_companies.id, referer_companies.name, 
			  SUM( sel_stats.count ) total, 
			  SUM( 
			        CASE WHEN 
			                ( sel_stats.last_sel_flag = 1 && sel_stats.select_status_id = 4 )  
			              THEN sel_stats.count 
			              ELSE 0 
			        END 
			      ) prosp_count 
			FROM referer_companies 
			INNER JOIN inf_job_vote_publics ON referer_companies.id = inf_job_vote_publics.referer_company_id 
			LEFT JOIN sel_stats ON inf_job_vote_publics.job_vote_id = sel_stats.job_vote_id 
			INNER JOIN job_votes ON sel_stats.job_vote_id = job_votes.id 
			WHERE referer_companies.rec_company_id = ? 
			AND referer_companies.status = 0 
			AND inf_job_vote_publics.status = 0 
			AND job_votes.status = 0 
			AND job_votes.wanted_year = ? 
			GROUP BY referer_companies.id 
			ORDER BY referer_companies.id 
		";

		$result = $this->query( $sql, $param );

		return $result;

	}

	public function getCsvSelecList () {
        $userCompanyId = $this->getUserInfo('rec_company_id');

        return $this->find('list', array(
                'recursive' => -1,
                'conditions' => array(
                    'rec_company_id' => $userCompanyId,
                    'OR'             => array(
                        array('influx_original_type'  => self::TYPE_RIKUNAVI ),
                        array('influx_original_type'  => self::TYPE_MYNAVI )
                        )
                ),
                'fields' => array('RefererCompany.influx_original_type','RefererCompany.name')
            )
        );
	}

    
    
    /**
     * 
     * 採用担当者が該当する流入元企業を利用することができるかを確認する
     * 
     * @param int
     * @return bool
     * 
     **/
    public function isUses( $id )
    {
        if ( empty( $id ) ) return false;
        
        $count = $this->find( 'count' , array( 'conditions'=>array(
                                'RefererCompany.rec_company_id'=>$this->getUserInfo('rec_company_id'),
                                'RefererCompany.status'=>0,
                                'RefererCompany.id'=>$id
                                )));
        return (bool) $count;
        
    }
}
