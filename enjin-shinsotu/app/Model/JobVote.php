<?php
App::uses('AppModel', 'Model');
/**
 * JobVote Model
 *
 * @property RecDepartment $RecDepartment
 * @property Jobtype $Jobtype
 * @property RecruitmentArea $RecruitmentArea
 * @property RecRecruiter $RecRecruiter
 * @property EvEvent $EvEvent
 * @property InfJobVotePublic $InfJobVotePublic
 * @property JobSelectTarget $JobSelectTarget
 * @property MailTemplate $MailTemplate
 * @property SelHistory $SelHistory
 * @property SystemMailTemplate $SystemMailTemplate
 */
class JobVote extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'title';

    protected $_roles = array(ROLE_TYPE_RECRUITER);

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
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
        'rec_department_id' => array(
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
        'jobtype_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'wanted_person' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
//		'wanted_deadline' => array(
//			'datetime' => array(
//				'rule' => array('datetime'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
        'start_salary' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
//		'start_date' => array(
//			'datetime' => array(
//				'rule' => array('datetime'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
        'recruitment_area_id' => array(
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
        'wanted_year' => array(
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
        'rikunavi_id' => array(

        ),
        'mynavi_id' => array(

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
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'RecDepartment' => array(
            'className' => 'RecDepartment',
            'foreignKey' => 'rec_department_id',
            'conditions' => 'RecDepartment.status = 0',
            'fields' => '',
            'order' => ''
        ),
        'RecruitmentArea' => array(
            'className' => 'RecruitmentArea',
            'foreignKey' => 'recruitment_area_id',
            'conditions' => 'RecruitmentArea.status = 0',
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
            'foreignKey' => 'job_vote_id',
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
        'InfJobVotePublic' => array(
            'className' => 'InfJobVotePublic',
            'foreignKey' => 'job_vote_id',
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
            'foreignKey' => 'job_vote_id',
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
            'foreignKey' => 'job_vote_id',
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
            'foreignKey' => 'job_vote_id',
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
        'SystemMailTemplate' => array(
            'className' => 'SystemMailTemplate',
            'foreignKey' => 'job_vote_id',
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
        'JobOfferStaff' => array(
            'className' => 'JobOfferStaff',
            'foreignKey' => 'job_vote_id',
            'dependent' => false,
            'conditions' => 'JobOfferStaff.status = 0',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'SelStat'=>array(
            'className' => 'SelStat',
            'foreignKey' => 'job_vote_id',
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
     * getData method
     *
     * ログインしている流入元担当者の流入元企業に対して公開設定されている求人票一覧の取得
     *
     * @param int $userId
     * @param array $findParam
     * @return array
     */
    public function getReferertData($userId,$findParam){
        $sql = 'SELECT JobVote.id,
                JobVote.title,
                RecDepartment.department_name,
                JobType.name,
                JobVote.wanted_person,
                JobVote.wanted_deadline,
                RecruitmentArea.area,
                JobVote.wanted_year,
                JobVote.rikunavi_id,
                JobVote.mynavi_id,
                CASE WHEN count(EvEvent.id) = 0 THEN 1
                WHEN count(EvEvent.id) > 0 THEN 0
                END as event_flag
                FROM job_votes as JobVote INNER JOIN inf_job_vote_publics as InfJobVotePublic ON (JobVote.id = InfJobVotePublic.job_vote_id)
                INNER JOIN referer_companies as RefererCompany ON (InfJobVotePublic.referer_company_id = RefererCompany.id)
                INNER JOIN inf_staffs as InfStaff ON (RefererCompany.id = InfStaff.referer_company_id)
                INNER JOIN recruitment_areas as RecruitmentArea ON (JobVote.recruitment_area_id = RecruitmentArea.id)
                INNER JOIN jobtypes as JobType ON (JobVote.jobtype_id = JobType.id)
                INNER JOIN rec_departments AS RecDepartment ON (JobVote.rec_department_id = RecDepartment.id)
                LEFT JOIN ev_events as EvEvent ON (EvEvent.job_vote_id = JobVote.id)
                WHERE InfStaff.id = :id AND JobVote.status = 0 AND RecDepartment.status = 0 AND InfJobVotePublic.status = 0
                AND RefererCompany.status = 0';

        $sql=$this->addSearchCondition($sql,$findParam);

        $params = array(
            'id'=> $userId
        );

        $data = $this->query($sql,$params);

        foreach ($data as $buf){
            $returnData[] = array_merge($buf['JobVote'],$buf['RecDepartment'],$buf['RecruitmentArea'],$buf[0]);
        }

        return $returnData;

    }
    /**
     *  データの変更をしようとした際に、変更しようしているデータが自社のデータか確認
     *　一件のみ使用可
     * @param int $id
     * @return booleam
     */
    /*public function isUses($id = NULL){
        switch($this->getUserInfo('role_type')){

            case ROLE_TYPE_RECRUITER:
                $reslut = $this->checkRecruiterCompanyId($id);
                return $reslut;

            default:
                return false; 
        }
    }*/

    /**
     *
     * 一覧などで利用するデータの検索条件を取得する
     * （採用担当者ロール用）
     *
     * @return array
     *
     **/
    public function getListDefaultConditions()
    {
        return array( 'conditions'=>array(
            'RecDepartment.rec_company_id' => $this->getUserInfo('rec_company_id'),
            'JobVote.status'=>0,
            'JobVote.wanted_year'=>SessionComponent::read('WantedYear')
        ),
            'recursive' => 0,
        );

    }

    /**
     *
     * 求人票の名称を取得する
     *
     * @param mixed
     *
     * @return string
     *
     **/
    public function getName( $id = 0)
    {
        $data = $this->findById( $id );

        if ( $data ) {
            return $data['JobVote']['title'];
        }else{
            return '有効な求人票が見つかりませんでした。';
        }
    }

    /**
     *
     * 現在登録されている求人票の一番若い年を取得する・
     *
     *
     *
     **/
    public function getMinWantedYear()
    {
        if ( empty( $this->getUserInfo('rec_company_id') ) ) return false;

        $data = $this->find('first', array(
                'conditions'=>array('Jobvote.rec_department_id'=>$this->getUserInfo('rec_department_id')),
                'order'=>'JobVote.wanted_year')
        );

        return (int)$data['JobVote']['wanted_year'];
    }

    
    /**
     * 
     * プルダウン求人票
     * 
     * @return array
     * 
     * 
     **/
    public function getSelectList()
    {
        $array = array( ""=>"" );
        
        $array += $this->find ('list', $this->getListDefaultConditions() );
        
        return $array;
    }
    
    /* *=*-*=*-*=*-*=*-*=*-*=*-*=*-*=*-*=*- 以下privateメソッド -*=*-*=*-*=*-*=*-*=*-*=*-*=*-*=*-*=*-*=*-*=* */


    /**
     *  採用担当者がデータの変更をしようとした際に、変更しようしているデータが自社のデータか確認
     *　
     * @param int $id
     * @return booleam
     */
    private function checkRecruiterCompanyId($id = null){
        $checkRecruiterCompanyId = $this->getUserInfo('rec_company_id');
        $this->recursive = 1;
        return (boolean) $this->find('first',array(
                'fields' => array('RecDepartment.rec_company_id'),
                'conditions' => array(
                    'JobVote.id' => $id,
                    'RecDepartment.rec_company_id' => $checkRecruiterCompanyId),
            )

        );
    }

	/**
	 * The condition to know the object is using or not
	 * @return array
	 */
	protected function getIsUsingConditions(){
		$conditions =  array(
			'RecDepartment.rec_company_id' => $this->getUserInfo('rec_company_id'),
			$this->alias.'.'.$this->_statusField => 0
		);
		return array('conditions' => $conditions);
	}

	protected function getCanUpdateConditions(){
		$conditions = array(
			'RecDepartment.status' => 0,
			'RecDepartment.rec_company_id' => $this->getUserInfo('rec_company_id'),
			'RecCompany.status' => 0
		);
		$joins = array(
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

    /**
     * check JobVote by rec_company_id
     * @param null $id
     * @return bool
     */
    public function checkRecCompanyId($id = NULL)
    {
        $conditions = array(
            'JobVote.id' => $id ,
            'RecDepartment.rec_company_id' => $this->getUserInfo('rec_company_id'),
            'RecDepartment.status' => 0,
            'RecCompany.status' => 0,
            'JobVote.status'=>0);

        $joins = array(
            array(
                'table' => 'rec_companies',
                'alias' => 'RecCompany',
                'conditions' => 'RecCompany.id = RecDepartment.rec_company_id'
            )
        );
        $this->recursive = 1;
        return (boolean) $this->find('first',array(
                'joins' => $joins,
                'conditions' => $conditions)
        );

    }
    
    
    /**
     * 
     * 採用担当者の企業が求人票を操作する権限があるかを確認する
     * 
     * @param int
     * @return bool
     * 
     **/
    public function isRecruiterUse( $id )
    {
        return (bool) $this->find( 'count' , array( 'conditions'=>array(
                                                        'JobVote.id' => $id,
                                                        'RecDepartment.rec_company_id' => $this->getUserInfo('rec_company_id'),
                                                        )
                                                ));
    }
}
