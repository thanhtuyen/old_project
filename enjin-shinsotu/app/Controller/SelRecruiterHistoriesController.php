<?php
App::uses('AppController', 'Controller');
/**
 * SelRecruiterHistories Controller
 *
 * @property SelRecruiterHistory $SelRecruiterHistory
 * @property PaginatorComponent $Paginator
 */
class SelRecruiterHistoriesController extends AppController {


	protected $_model = 'SelRecruiterHistory';

	protected $_listMethods = array('api_update', 'api_add', 'api_delete');

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
		$this->SelRecruiterHistory->recursive = 0;
		$this->set('selRecruiterHistories', $this->Paginator->paginate());

		//設定値
		$assingSituations = $this->getSystemConfig("assign_situation");
                $this->set(compact('assingSituations'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->SelRecruiterHistory->exists($id)) {
			throw new NotFoundException(__('Invalid sel recruiter history'));
		}
		$options = array('conditions' => array('SelRecruiterHistory.' . $this->SelRecruiterHistory->primaryKey => $id));
		$this->set('selRecruiterHistory', $this->SelRecruiterHistory->find('first', $options));

		//設定値
		$assingSituations = $this->getSystemConfig("assign_situation");
                $this->set(compact('assingSituations'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SelRecruiterHistory->create();
			if ($this->SelRecruiterHistory->save($this->request->data)) {
				return $this->flash(__('The sel recruiter history has been saved.'), array('action' => 'index'));
			}
		}

		$selHistories = $this->SelRecruiterHistory->SelHistory->find('list');
		$recRecruiters = $this->SelRecruiterHistory->RecRecruiter->find('list');

		//設定値
		$assingSituations = $this->getSystemConfig("assign_situation");
		$selStatus = $this->getSystemConfig("sel_status");
		$evaluationRank = $this->getSystemConfig("evaluation_rank");

		$this->set(compact('recRecruiters', 'selHistories', 'assingSituations', 'evaluationRank', 'selStatus' ));
	}

/**
 * add method
 *
 * @return void
 */
	public function add_simple() {
		if (!$this->isRecruiter()) {
			throw new NotFoundException(__('not access authorizations'));
		}

		if (!$this->request->is('post')) {
			throw new NotFoundException(__('Invalid sel recruiter history'));
		}

		// エラーチェック
		// 保存
		$data = $this->SelRecruiterHistory->trimSimpleSaveData($this->request->data['SelRecruiterHistories']);
		$this->SelRecruiterHistory->save($data);

		$templateId = 3;
		$this->loadModel('MlSendHistory');
		$this->MlSendHistory->sendSystemMail($data['sel_history_id'], $templateId) ;

        $this->redirect('../sel_histories/edit/'.$this->request->data['SelRecruiterHistories']['sel_history_id']);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->SelRecruiterHistory->exists($id)) {
			throw new NotFoundException(__('Invalid sel recruiter history'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SelRecruiterHistory->save($this->request->data)) {
				return $this->flash(__('The sel recruiter history has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('SelRecruiterHistory.' . $this->SelRecruiterHistory->primaryKey => $id));
			$this->request->data = $this->SelRecruiterHistory->find('first', $options);
		}
		$selHistories = $this->SelRecruiterHistory->SelHistory->find('list');
		$recRecruiters = $this->SelRecruiterHistory->RecRecruiter->find('list');

		//設定値
		$assingSituations = $this->getSystemConfig("assign_situation");
		$selStatus = $this->getSystemConfig("sel_status");
		$evaluationRank = $this->getSystemConfig("evaluation_rank");
		$this->set(compact('recRecruiters', 'selHistories', 'assingSituations', 'evaluationRank', 'selStatus' ));
	}
/**
 * edit_simple
 *
 * @throws NotFoundException
 * @return void
 */
	public function edit_simple() {
		if (empty($this->request->data['SelRecruiterHistories']['id'])){
			throw new NotFoundException(__('Invalid sel recruiter history'));
		}
		if ($this->request->data['SelRecruiterHistories']['rec_recruiter_id'] != $this->getLoginUser('id')){
			throw new NotFoundException(__('not access authorizations'));
		}

		$data = $this->SelRecruiterHistory->trimSimpleUpdateData($this->request->data['SelRecruiterHistories']);
		$this->SelRecruiterHistory->save($data);
		// アラートメール送信
		$templateId = 3;
		$this->loadModel('MlSendHistory');
		$this->MlSendHistory->sendSystemMail($this->request->data['SelRecruiterHistories']['sel_history_id'], $templateId);
        $this->redirect('../sel_histories/edit/'.$this->request->data['SelRecruiterHistories']['sel_history_id']);
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->SelRecruiterHistory->id = $id;
		if (!$this->SelRecruiterHistory->exists()) {
			throw new NotFoundException(__('Invalid sel recruiter history'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->SelRecruiterHistory->delete()) {
			return $this->flash(__('The sel recruiter history has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The sel recruiter history could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete_simple($id = null, $sel_history_id = null ) {
		if (!$this->isRecruiter()) {
			throw new NotFoundException(__('not access authorizations'));
		}
		$this->SelRecruiterHistory->id = $id;
		if (!$this->SelRecruiterHistory->exists()) {
			throw new NotFoundException(__('Invalid sel recruiter history'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->SelRecruiterHistory->delete()) {
			// アラートメール送信
			$templateId = 3;
			$this->loadModel('MlSendHistory');
			$this->MlSendHistory->sendSystemMail($sel_history_id, $templateId);
			$this->redirect('../sel_histories/edit/'.$sel_history_id);
		} else {
			return $this->flash(__('The sel recruiter history could not be deleted. Please, try again.'));
		}
	}

/**
 * mail send
 *
 * @param string $id
 * @return void
 */
	private function sendSystemMail($sel_history_id) {

		$this->loadModel('SelHistory');


		$options['conditions'] = array( 'SelHistory.id' => $sel_history_id );
		$options['recursive'] = -1;
		$options['contain'] = array(
				'CanCandidate',
				'JobVote' => array(
						'JobOfferStaff' => 'RecRecruiter'
					),
		);
		$history = $this->SelHistory->find('first', $options);

		$sendData = $this->SelRecruiterHistory->trimToSendMail($history);
		$this->loadModel('MlReplaceTemplate');
		$this->loadModel('MlSendHistory');

		foreach ($sendData as $value){
			$message = $this->MlReplaceTemplate->replaceTemplate($value, $sel_history_id);

			// 企業IDのエラーチェック/ 選考履歴の最新チェック
			if (empty($message)){
				return false;
			}

			// 保存
			$this->MlSendHistory->send($value, $message);
		}
	}

	/**
	 * Overwrite api_add
	 * @return array
	 * @throws Exception
	 */
	public function api_add(){

		$post = $this->request->data;
		$this->_model->set($post);
		if (!$this->_model->validates()){
			throw new NotFoundException($this->_model->getValidateMessage());
		}

		// check duplicate
		$conditions = array(
			$this->_model->alias.'.sel_history_id' => $post['sel_history_id'],
			$this->_model->alias.'.rec_recruiter_id' => $post['rec_recruiter_id'],
			$this->_model->alias.'.status' => 0
		);
		$object = $this->_model->find('first',array('conditions'=> $conditions));
		if ($object) {
			throw new Exception('The object is exist!');
		}
		$this->loadModel('RecRecruiter');
		// check status of rec_recruiter
		$conditions = array(
			'RecRecruiter.status'=>0,
			'RecDepartment.status'=>0,
			'RecDepartment.rec_company_id'=>$this->getUserCompanyId(),
			'RecRecruiter.id' => $post['rec_recruiter_id']
		);
		$recRecruiter = $this->RecRecruiter->find('first',array('conditions' => $conditions));
		if (!$recRecruiter){
			throw new Exception('The Recruiter or RecDepartment is null');
		}

		// check company id
		$this->checkCompany();
		// check history
		$this->loadModel('SelHistory');
		$conditions = array(
			'SelHistory.status'=> 0,
			'SelHistory.id' => $post['sel_history_id'],
			'CanCandidate.status' => 0,
			'CanCandidate.rec_company_id' => $this->getUserCompanyId()
		);
		$history = $this->SelHistory->find('first',array('conditions' => $conditions));
		if (!$history){
			throw new Exception('The sel history is null');
		}
		$post['assign_situation_id'] = 0;
		$post['evaluation_rank'] = 0;
		$post['evaluation_score'] = 0;
		$post['evaluation_comment'] = '';
		$result = $this->_model->save($post);

		if ($result){
			$result = $result[$this->_model->alias];
			$result['rec_recruiter'] = array(
				'last_name' => $recRecruiter['RecRecruiter']['last_name'],
				'first_name' => $recRecruiter['RecRecruiter']['first_name']
			);
			$this->renderJson($result);
		}
		throw new NotFoundException(__('Can not insert object'));
	}

	/**
	 * ThinhNH
	 * Prepare data before update
	 * Check validate follow the bellow condition
	 * the API can update 3 params(evaluation_rank, evaluation_score, evaluation_comment)
	 * only when assign_situation_id(in table) = 1 and assign_situation_id(POST param) = 2.
	 * in another case, we can only update assign_situation_id
	 */
	protected function prepareDataForUpdate(){

		// the object get by isUsing function
		$object = $this->_currentObject[$this->_model->alias];
		$post = $this->request->data;
		if (!$this->_model->validates()){
			throw new NotFoundException($this->_model->getValidateMessage());
		}
		if ($object['assign_situation_id'] == 1 && $post['assign_situation_id'] == 2){
			// in this case we can update all
			$updateData = $post;
		}else {
			if (!in_array($post['assign_situation_id'], array(0,1,2,9))){
				throw new Exception('assign_situation_id not in range (0,1,2,9)');
			}
			// only update assign situation
			$updateData = array(
				'id' => $post['id'],
				'assign_situation_id' => $post['assign_situation_id']
			);
		}
		return $updateData;
	}



}
