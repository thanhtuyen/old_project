<?php
App::uses('AppModel', 'Model');
App::uses('CanCandidate', 'Model');
App::uses('MlReplaceTemplate', 'Model');
App::uses('CanSelJob', 'Model');
App::uses('SelHistory', 'Model');
/**
 * MlSendHistory Model
 *
 * @property CanCandidate $CanCandidate
 * @property InfStaff $InfStaff
 * @property RecRecruiter $RecRecruiter
 * @property MailTemplate $MailTemplate
 * @property SystemMailTemplate $SystemMailTemplate
 */
class MlSendHistory extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'send_mail_address' => array(
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
		'can_candidate_id' => array(
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
		'mail_template_id' => array(
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
		'system_mail_template_id' => array(
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
		'send_recruiter_id' => array(
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
		'send_result' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'send_date' => array(
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
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'CanCandidate' => array(
			'className' => 'CanCandidate',
			'foreignKey' => 'can_candidate_id',
			'conditions' => 'CanCandidate.status = 0',
			'fields' => '',
			'order' => ''
		),
		'InfStaff' => array(
			'className' => 'InfStaff',
			'foreignKey' => 'inf_staff_id',
			'conditions' => 'InfStaff.status = 0',
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
		'MailTemplate' => array(
			'className' => 'MailTemplate',
			'foreignKey' => 'mail_template_id',
			'conditions' => 'MailTemplate.status = 0',
			'fields' => '',
			'order' => ''
		),
		'SystemMailTemplate' => array(
			'className' => 'SystemMailTemplate',
			'foreignKey' => 'system_mail_template_id',
			'conditions' => 'SystemMailTemplate.status = 0',
			'fields' => '',
			'order' => ''
		)
	);

    public $hasOne = array(
        'MlSendBodyHistory' => array(
            'className'    => 'MlSendBodyHistory',
            'foreignKey'   => 'ml_send_history_id',
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
    * 登録用送信履歴データ生成
    * @param int 
    * @param int
    * @param int
    * @param boolean
    * @return mixed
    */
    public function createMailHistory($template_id, $candidate_id, $history_id, $isSystemMail = false) {
		
        $this->CanCandidate = new CanCandidate;
		$candidate = $this->CanCandidate->findById($candidate_id);

		$sender = $this->getUserInfo();
		// 企業IDのエラーチェック
		if ($candidate['CanCandidate']['rec_company_id'] != $sender['rec_company_id']){
			return false;
		}

		$recruiter = $this->getVoteRecruiterId($candidate_id, $history_id);
		if (!$recruiter) {
			return false;
		}

		$mail = $this->setMailTemplate($template_id, $isSystemMail);
		$history = array(
			'can_candidate_id'			 => $candidate['CanCandidate']['id'],
			'send_mail_address'			 => $candidate['CanCandidate']['mail_address'],
			'rec_recruiter_id'			 => $recruiter,
			'send_recruiter_id'			 => $sender['id'],
			'send_result'				 => 0,
		);
		if (!empty($candidate['CanCandidate']['inf_staff_id'])) {
			$inf_staff = array('inf_staff_id' => $candidate['CanCandidate']['inf_staff_id']);
			$history = array_merge($history, $inf_staff);
		}

		return array_merge($history, $mail);
    }

    /**
    * 保存処理
    */
    public function send($history, $body) {

			$mlSendHistory['MlSendHistory'] = $history;
			$mlSendHistory['MlSendBodyHistory'] = $body;
			$this->create();
			$res = $this->saveAssociated($mlSendHistory);

	}


    /**
    * Session内に保存されている条件文を整形
	* @return mixed
    */
	public function setSearchCondition($options){

		$options['start_date >='] = $this->toDateTime($options['start_date']);
		$options['end_date <=']   = $this->toDateTime($options['end_date']);

		unset($options['start_date']);
		unset($options['end_date']);
		if (!is_integer($options['candidate_propriety'])) 	unset($options['candidate_propriety']);
		if (!is_integer($options['influx_propriety'])) 		unset($options['influx_propriety']);
		if (!is_integer($options['referer_company_id']))	unset($options['referer_company_id']);
		foreach ($options as $key => $value ) {
			if ($key == 'referer_company_id'){
				$conditions['InfStaff.'.$key] = $value;
				continue;
			}
			$conditions['SelHistory.'.$key] = $value;

		}
		$joins[] = array(
            'type'       => 'LEFT',
            'table'      => 'inf_staffs',
            'alias'      => 'InfStaff',
            'conditions' => '`InfStaff`.`id` = `SelHistory`.`inf_staff_id` '
        );
		return compact('conditions', 'joins');
	}

	/**
	* メール送信履歴リストを取得する条件を返却
	* 
	* @return array
	**/
	public function getMailHistList()
	{
		return array(
					'recursive' => 2,
					'conditions' => array( 
						'MailTemplate.rec_company_id' => $this->getUserInfo('rec_company_id'),
						'MailTemplate.status' => 0
					 ),
					'contain' => array( 
									'CanCandidate' => array( 
														'CanEducation' => array( 'School' ) ), 
									'InfStaff' => array( 'RefererCompany' ), 
									'RecRecruiter' => array( 
														'RecDepartment' => array( 'RecCompany' ) ),
									'MailTemplate'
						)


				);
	}

/**
 * mail send
 *
 * @param string $id
 * @return void
 */
	public function sendSystemMail($sel_history_id, $templateId) {

		$this->SelHistory = new SelHistory;

		$options['conditions'] = array( 'SelHistory.id' => $sel_history_id );
		$options['recursive'] = -1;
		$options['contain'] = array(
				'CanCandidate',
				'JobVote' => array(
						'JobOfferStaff' => 'RecRecruiter'
					),
		);
		$history = $this->SelHistory->find('first', $options);

		$sendData = $this->trimToSendMail($history, $templateId);
		$this->MlReplaceTemplate = new MlReplaceTemplate;

		foreach ($sendData as $value){
			$message = $this->MlReplaceTemplate->replaceTemplate($value, $sel_history_id);

			// 企業IDのエラーチェック/ 選考履歴の最新チェック
			if (empty($message)){
				return false;
			}

			// 保存
			$this->send($value, $message);
		}
		return true;
	}



    /* =*-*=*-*=*-*=*-*=*-*=*-* 以下 private =*-*=*-*=*-*=*-*=*-*=*-*=*-*=*-* */

	/**
	* メール送信履歴登録用に整形
	* @param mixed
	* @return mixed
	**/
	private function trimToSendMail($data, $templateId){

		$sender = $this->getUserInfo();

		foreach ($data['JobVote']['JobOfferStaff'] as $value) {
			$tmp = array(
				'can_candidate_id'			 => $data['SelHistory']['can_candidate_id'],
				'send_mail_address'			 => $value['RecRecruiter']['mail'],
				'rec_recruiter_id'			 => $value['RecRecruiter']['id'],
				'send_recruiter_id'			 => $sender['id'],
				'mail_template_id'			 => 0,
				'system_mail_template_id'	 => $templateId,
				'send_result'				 => 0,
			);
			if (!is_null($data['CanCandidate']['inf_staff_id'])) {
				$staff = array( 'inf_staff_id' => $data['CanCandidate']['inf_staff_id'] );
				$tmp = array_merge($tmp, $staff);

			}
			$sendData[] = $tmp;

		}
		return $sendData;
	}

    /*
    * 求人担当者のIDを返す
    */
	private function getVoteRecruiterId($candidate_id, $history_id){


		$this->CanSelJob = new CanSelJob;

        $option['recursive'] =-1;
        $option['fields'] = array('JobOfferStaffs.rec_recruiter_id');
        $option['order'] = array('JobOfferStaffs.rec_recruiter_id');
		$option['conditions'] = array(
			'CanSelJob.can_candidate_id' => $candidate_id, 
			'CanSelJob.sel_history_id' => $history_id
			);
        $option['joins'][] = array(
            'type'       => 'LEFT',
            'table'      => 'job_offer_staffs',
            'alias'      => 'JobOfferStaffs',
            'conditions' => '`JobOfferStaffs`.`job_vote_id` = `CanSelJob`.`job_vote_id` '
        );

		$result = $this->CanSelJob->find('first', $option);

		return (!empty($result))? $result['JobOfferStaffs']['rec_recruiter_id'] : false;

	}

	/**
	* 送信履歴の条件文
	* メールテンプレートIDをセットして返す
	*/
	private function setMailTemplate($template_id, $isSystemMail){

		if ($isSystemMail) {
			return array(
				'mail_template_id' 			=> 0,
				'system_mail_template_id' 	=> $template_id,
				);
		}else{
			return array(
				'mail_template_id' 			=> $template_id,
				'system_mail_template_id' 	=> 0,
				);
		}

	}

}
