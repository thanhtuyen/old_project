<?php
App::uses('AppController', 'Controller');
/**
 * MlSendHistories Controller
 *
 * @property MlSendHistory $MlSendHistory
 * @property PaginatorComponent $Paginator
 */
class MlSendHistoriesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->loadModel( 'MailTemplate' );
		$this->loadModel( 'JobVote' );
		$this->loadModel( 'EvEvent' );

		$this->MlSendHistory->recursive = 0;

		//get jobVote List
		$jobVote = $this->JobVote->getSelectList();

		//get evEvent list
		$evEvent = $this->EvEvent->getSelectList();

		$conditions = $this->MlSendHistory->getMailHistList();

		$getQuery = $this->request->query;

		$conditions = $this->setConditionIndex( $getQuery, $conditions );

		$this->set( 'MailTemplates', $this->MailTemplate->getPullDownList() );
		$this->set( 'JobVote', $jobVote );
		$this->set( 'EvEvent', $evEvent );
		$this->set( 'SendResult', $this->getSystemConfig( 'send_result' ) );
		$this->set( 'SendTo', $this->getSystemConfig( 'send_to' ) );

		$this->paginate = $conditions;

		$this->set( 'mlSendHistories', $this->Paginator->paginate( ) );
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MlSendHistory->exists($id)) {
			throw new NotFoundException(__('Invalid ml send history'));
		}
		$options = array('conditions' => array('MlSendHistory.' . $this->MlSendHistory->primaryKey => $id));
		$this->set('mlSendHistory', $this->MlSendHistory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MlSendHistory->create();
			if ($this->MlSendHistory->save($this->request->data)) {
				return $this->flash(__('The ml send history has been saved.'), array('action' => 'index'));
			}
		}
		$canCandidates = $this->MlSendHistory->CanCandidate->find('list');
		$infStaffs = $this->MlSendHistory->InfStaff->find('list');
		$recRecruiters = $this->MlSendHistory->RecRecruiter->find('list');
		$mailTemplates = $this->MlSendHistory->MailTemplate->find('list');
		$systemMailTemplates = $this->MlSendHistory->SystemMailTemplate->find('list');
		$this->set(compact('canCandidates', 'infStaffs', 'recRecruiters', 'mailTemplates', 'systemMailTemplates'));
	}


/**
 * send_simple
 * 送信処理（未送信ステータスで登録：実際の送信はバッチ処理で行う）
 *
 * @return void
 */
	public function send_simple() {
		// request idを取得
		// リクエストエラー処理
		$this->checkErrorJson((empty($this->request->data['can_candidate_ids']) ||
							   empty($this->request->data['mail_template_id'])));
		
		$can_candidate_ids = $this->request->data['can_candidate_ids'];
		$templateId = $this->request->data['mail_template_id'];
		
		$this->loadModel('CanSelJob');
		foreach($can_candidate_ids as $can_candidate_id){
			$canSelJob = $this->CanSelJob->getCanSelJobByCandidateId($can_candidate_id);

			// 送信処理
			$this->checkErrorJson(!$this->sendMail($canSelJob, $templateId));
		}

		$this->noResJSon();
	}


/**
 * send_search
 * 送信処理（未送信ステータスで登録：実際の送信はバッチ処理で行う）
 *
 * @return void
 */
	public function send_search() {
		// request idを取得
		// リクエストエラー処理
		$this->checkErrorJson(empty($this->request->data['mail_template_id']));
		$templateId = $this->request->data['mail_template_id'];

		// 1件ずつ登録
		$this->loadModel('SelHistory');

		$option = SessionComponent::read('SearchCondition');
		$option = $this->MlSendHistory->setSearchCondition($option);
		$this->SelHistory->recursive = -1;
		$this->SelHistory->virtualFields['sel_history_id'] = 'SelHistory.id';
		$histories = $this->SelHistory->find('all', $option);

		// 送信処理
		$this->checkErrorJson(!$this->sendMail($histories, $templateId));

		$this->noResJSon();
	}

/**
 * send_search_by_candidate
 * 候補者一覧（検索結果）メール送信処理
 *
 * @return void
 */
	public function send_search_by_candidate() {
		// リクエストエラー処理
		$this->checkErrorJson(empty($this->request->data['mail_template_id']));
		$templateId = $this->request->data['mail_template_id'];

		$option = SessionComponent::read('SearchCondition');
		$candidate = $this->MlSendHistory->CanCandidate->find('all',$option);

		$this->loadModel('CanSelJob');
		$canSelJob = $this->CanSelJob->getCanSelJobByCandidate($candidate);

		// 送信処理
		$this->checkErrorJson(!$this->sendMail($canSelJob, $templateId));

		$this->noResJSon();
	}


/**
 * send_search_by_referer
 * 候補者一覧（検索結果）メール送信処理
 *
 * @return void
 */
	public function send_search_by_referer() {
		// リクエストエラー処理
		$this->checkErrorJson(empty($this->request->data['mail_template_id']));
		$templateId = $this->request->data['mail_template_id'];

		$this->loadModel('CanSelJob');
		$option = SessionComponent::read('SearchCondition');
		$canSelJob = $this->CanSelJob->find('all', $option);

		// 送信処理
		$this->checkErrorJson(!$this->sendMail($canSelJob, $templateId));

		$this->noResJSon();
	}


/**
 * send_summary
 * 送信処理（未送信ステータスで登録：実際の送信はバッチ処理で行う）
 *
 * @return void
 */
	public function send_summary() {

        // リクエストパラメータのチェック
		$this->checkErrorJson(empty($this->request->data['mail_template_id']));
		$templateId = $this->request->data['mail_template_id'];
        // ロールチェック
        $this->checkErrorJson(!$this->isRecruiter());

        $sumQuery = SessionComponent::read('SearchCondition');
        // 候補者IDの抽出
        $this->loadModel('SelStatChild');
        $candidates = $this->SelStatChild->getCandidateIdBySummary( $sumQuery );
        foreach( $candidates as $key => $value ){
            $candidateList[] = $value['sel_stat_children']['can_candidate_id'];
        }

        $this->loadModel('CanSelJob');
        $options['fields'] = array('sel_history_id', 'can_candidate_id');
        $options['conditions'] = array('can_candidate_id' => $candidateList);
        $options['recursive'] = -1;
        $selHistories = $this->CanSelJob->find('all', $options);

		$this->checkErrorJson(!$this->sendMail($selHistories, $templateId));
        $this->noResJSon();
	}

	/*
	*
	*
	*
	*/
	public function sendMail($canSelJob, $templateId) {
		$this->loadModel('MlReplaceTemplate');

		foreach ($canSelJob as $key => $value) {
			$value = $this->trimSendMail($value);

			if (empty($value['can_candidate_id']) || empty($value['sel_history_id'])) {
				return false;
			}

			// 送信履歴データ生成
			$history = $this->MlSendHistory->createMailHistory($templateId, 
															   $value['can_candidate_id'],
															   $value['sel_history_id']);
			// 企業IDのエラーチェック
			if (!is_array($history)){
				return false;
			}
			// テンプレートの置換
			$message = $this->MlReplaceTemplate->replaceTemplate($history, $value['sel_history_id']);

			// 選考履歴の最新チェック
			if (empty($message)){
				return false;
			}
			// 保存
			$this->MlSendHistory->send($history, $message);
		}
		return true;
	}


/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->MlSendHistory->exists($id)) {
			throw new NotFoundException(__('Invalid ml send history'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MlSendHistory->save($this->request->data)) {
				return $this->flash(__('The ml send history has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('MlSendHistory.' . $this->MlSendHistory->primaryKey => $id));
			$this->request->data = $this->MlSendHistory->find('first', $options);
		}
		$canCandidates = $this->MlSendHistory->CanCandidate->find('list');
		$infStaffs = $this->MlSendHistory->InfStaff->find('list');
		$recRecruiters = $this->MlSendHistory->RecRecruiter->find('list');
		$mailTemplates = $this->MlSendHistory->MailTemplate->find('list');
		$systemMailTemplates = $this->MlSendHistory->SystemMailTemplate->find('list');
		$this->set(compact('canCandidates', 'infStaffs', 'recRecruiters', 'mailTemplates', 'systemMailTemplates'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->MlSendHistory->id = $id;
		if (!$this->MlSendHistory->exists()) {
			throw new NotFoundException(__('Invalid ml send history'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->MlSendHistory->delete()) {
			return $this->flash(__('The ml send history has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The ml send history could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}


    /* =*-*=*-*=*-*=*-*=*-*=*-* 以下 private =*-*=*-*=*-*=*-*=*-*=*-*=*-*=*-* */


    private function trimSendMail($value){

		if(isset($value['SelHistory']) || isset($value['CanSelJob'])) {
			$value = array_shift($value);
		}
		return $value;

    }


    /**
    * Session内に保存されている条件文を整形
	* @return mixed
    */
	private function setSearchCondition(){

		$options = SessionComponent::read('SearchCondition');

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
	* 送信先の番号によって検索条件と値をセット
	* @param  int    $id
	* @param  array  $conditions
	* @return array  $conditions
	**/
	private function setSearchSendTo( $id, $conditions )
	{
		switch ( $id ) {
			case '1': //流入元担当者
			    $conditions['contain'] = array(
									'InfStaff' => array( 'RefererCompany' ),
									'MailTemplate',
                                    'CanCandidate',
                                    'RecRecruiter'
						);
			    $conditions['conditions'][] = ['InfStaff.id IS NOT NULL'];

				$this->set('send_to_id',$id );
				break;

			case '2': //候補者
			    $conditions['contain'] = array( 
									'CanCandidate' => array( 
														'CanEducation' => array( 'School' ) ), 
									'MailTemplate',
                                    'InfStaff',
                                    'RecRecruiter'
						);
			    $conditions['conditions'][] = ['CanCandidate.id IS NOT NULL'];

				$this->set('send_to_id',$id );
				break;

			case '3': //採用担当者
			    $conditions['contain'] = array(  
									'RecRecruiter' => array( 
														'RecDepartment' => array( 'RecCompany' ) ),
									'MailTemplate',
                                    'CanCandidate',
                                    'InfStaff'
						);
			    $conditions['conditions'][] = ['RecRecruiter.id IS NOT NULL'];

				$this->set('send_to_id',$id );
				break;
			
			default:
				break;
		}

		return $conditions;

	} 

	/**
	* index画面で使用する検索条件セット
	* @param   array $getQuery
	* @param   array $conditions
	* @return  array $conditions
	* 
	**/
	private function setConditionIndex( $getQuery, $conditions )
	{
		if( !empty( $getQuery['send_to_id'] ) ){
			$conditions = $this->setSearchSendTo( $getQuery['send_to_id'], $conditions );
			$this->set('send_to_id',$getQuery['send_to_id']);
		}
		if(isset($getQuery['last_name']) && $getQuery['last_name'] !=''){
			$conditions['conditions']['OR'] = array(
												'CanCandidate.last_name LIKE' => '%'.$getQuery['last_name'].'%',
												'InfStaff.last_name LIKE' => '%'.$getQuery['last_name'].'%',
												'RecRecruiter.last_name LIKE' => '%'.$getQuery['last_name'].'%',
											);

			$this->set('last_name',$getQuery['last_name']);
		}
		if(isset($getQuery['first_name']) && $getQuery['first_name'] !=''){

			$conditions['conditions']['OR'] = array(
												'CanCandidate.first_name LIKE' => '%'.$getQuery['first_name'].'%',
												'InfStaff.first_name LIKE' => '%'.$getQuery['first_name'].'%',
												'RecRecruiter.first_name LIKE' => '%'.$getQuery['first_name'].'%',
											);
			$this->set('first_name',$getQuery['first_name']);
		}		
		if(!empty($getQuery['send_mail_address']) && $getQuery['send_mail_address'] !='' ){
			$conditions['conditions']['MlSendHistory.send_mail_address LIKE'] = '%'.$getQuery['send_mail_address'].'%';
			$this->set('send_mail_address',$getQuery['send_mail_address']);
		}
		if(!empty($getQuery['date_from']) && $getQuery['date_from'] !='' ){
			$conditions['conditions']['MlSendHistory.send_date >='] = date("Y-m-d", strtotime($getQuery['date_from']));
			$this->set('date_from',$getQuery['date_from']);
		}
		if(!empty($getQuery['date_to']) && $getQuery['date_to'] !='' ){
			$conditions['conditions']['MlSendHistory.send_date <='] = date("Y-m-d", strtotime($getQuery['date_to']));
			$this->set('date_to',$getQuery['date_to']);
		}
		if(isset($getQuery['send_result']) && $getQuery['send_result'] !='' ){
			$conditions['conditions']['MlSendHistory.send_result'] = $getQuery['send_result'];
			$this->set('send_result',$getQuery['send_result']);
		}
		if(!empty($getQuery['mail_templates']) && $getQuery['mail_templates'] !='' ){
			$conditions['conditions']['MailTemplate.id'] = $getQuery['mail_templates'];
			$this->set('mail_templates',$getQuery['mail_templates']);
		}
		if(!empty($getQuery['job_vote']) && $getQuery['job_vote'] !='' ){
			$conditions['conditions']['MailTemplate.job_vote_id'] = $getQuery['job_vote'];
			$this->set('job_vote',$getQuery['job_vote']);
		}
		if(!empty($getQuery['ev_event']) && $getQuery['ev_event'] !='' ){
			$conditions['conditions']['MailTemplate.ev_event_id'] = $getQuery['ev_event'];
			$this->set('ev_event',$getQuery['ev_event']);
		}

		return $conditions;

	}



}
