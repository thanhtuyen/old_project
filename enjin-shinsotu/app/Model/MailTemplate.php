<?php
App::uses('AppModel', 'Model');
App::uses('RecRecruiter', 'Model');
App::uses('CanCandidate', 'Model');
App::uses('InfStaff', 'Model');

/**
 * MailTemplate Model
 *
 * @property EvEvent $EvEvent
 * @property JobVote $JobVote
 * @property ScreeningStage $ScreeningStage
 * @property RecCompany $RecCompany
 * @property RecRecruiter $RecRecruiter
 * @property MlAttachment $MlAttachment
 * @property MlSendHistory $MlSendHistory
 */
class MailTemplate extends AppModel {

	public $displayField = 'template';


/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'template' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'subject' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'ev_event_id' => array(
		),
		'screening_stage_id' => array(
		),
		'purpose_id' => array(
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
		'EvEvent' => array(
			'className' => 'EvEvent',
			'foreignKey' => 'ev_event_id',
			'conditions' => '',
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
		),
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
		'MlAttachment' => array(
			'className' => 'MlAttachment',
			'foreignKey' => 'mail_template_id',
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
		'MlSendHistory' => array(
			'className' => 'MlSendHistory',
			'foreignKey' => 'mail_template_id',
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
     * メールテンプレートマスタ・初期データ投入
     * 
     * @param  void
     * @return array
     * 
     **/
    public function getInitData()
    {
        return array ( 0=>array(
                        'template'=>"１次選考のご連絡(サンプル)",
                        'subject'=>"弊社採用試験にお申込み頂きありがとうございました。",
                        'body'=>"#候補者名# 様

この度は弊社採用試験にお申込み頂きありがとうございました。
厳正なる書類選考の結果、<候補者>様におかれましては
１次選考試験にお越しいただきたく、ご連絡させて頂きました。

１次選考の詳しいご案内は別途添付資料をご覧ください。

では、当日のお越しをお待ちしております。

#求人担当者企業名#",
                        'ev_event_id'=>0,
                        'job_vote_id'=>0,
                        'screening_stage_id'=>1,
                        'purpose_id'=>2,
                        'rec_recruiter_id'=>0,
                        'status'=>0
        ));
    }

    /**
     * 
     * 
     * 
     * 
     * 
     * 
     **/
    public function getPullDownList()
    {
        return $this->find('list', array("conditions"=>array("rec_company_id"=>$this->getUserInfo('rec_company_id') )));
    }
}
