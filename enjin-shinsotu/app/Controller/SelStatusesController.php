<?php
App::uses('AppController', 'Controller');
/**
 * SelStatuses Controller
 *
 * @property SelStatus $SelStatus
 * @property PaginatorComponent $Paginator
 */
class SelStatusesController extends AppController {

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
		$this->SelStatus->recursive = 0;
		$this->loadModel('MailTemplate');
		$companyId = $this->getUserCompanyId();
		$templateList = $this->MailTemplate->find('list',array(
				'fields' => array('MailTemplate.id','MailTemplate.template'),
				'condition' => array(
					'rec_company_id' => $companyId,
					'status' => 0
				)
			)
		);
		$this->set( 'templateList', $templateList);
		$this->set( 'selStatuses', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->SelStatus->exists($id)) {
			throw new NotFoundException(__('Invalid sel status'));
		}
		$options = array('conditions' => array('SelStatus.' . $this->SelStatus->primaryKey => $id));
		$this->set('selStatus', $this->SelStatus->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SelStatus->create();
			if ($this->SelStatus->save($this->request->data)) {
				return $this->flash(__('The sel status has been saved.'), array('action' => 'index'));
			}
		}
		$jobVotes = $this->SelStatus->JobVote->find('list');
		$canCandidates = $this->SelStatus->CanCandidate->find('list');
		$screeningStages = $this->SelStatus->ScreeningStage->find('list');
		$recRecruiters = $this->SelStatus->RecRecruiter->find('list');
		$infStaffs = $this->SelStatus->InfStaff->find('list');

		//設定値
		$selectJudgmentType = $this->getSystemConfig("select_judgment_type");
		$selectOption = $this->getSystemConfig("select_option");
		$selStatus = $this->getSystemConfig("sel_status");
		$lastModifiedType = $this->getSystemConfig("last_modified_type");
		$this->set(compact('jobVotes', 'canCandidates', 'screeningStages', 'recRecruiters', 'infStaffs', 'selectJudgmentType', 'selectOption',
							'selStatus', 'lastModifiedType'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->SelStatus->exists($id)) {
			throw new NotFoundException(__('Invalid sel status'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SelStatus->save($this->request->data)) {
				return $this->flash(__('The sel status has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('SelStatus.' . $this->SelStatus->primaryKey => $id));
			$this->request->data = $this->SelStatus->find('first', $options);
		}
		$jobVotes = $this->SelStatus->JobVote->find('list');
		$canCandidates = $this->SelStatus->CanCandidate->find('list');
		$screeningStages = $this->SelStatus->ScreeningStage->find('list');
		$recRecruiters = $this->SelStatus->RecRecruiter->find('list');
		$infStaffs = $this->SelStatus->InfStaff->find('list');

		//設定値
		$selectJudgmentType = $this->getSystemConfig("select_judgment_type");
		$selectOption = $this->getSystemConfig("select_option");
		$selStatus = $this->getSystemConfig("sel_status");
		$lastModifiedType = $this->getSystemConfig("last_modified_type");
		$this->set(compact('jobVotes', 'canCandidates', 'screeningStages', 'recRecruiters', 'selectJudgmentType', 'selectOption', 
							'infStaffs', 'selStatus', 'lastModifiedType'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->SelStatus->id = $id;
		if (!$this->SelStatus->exists()) {
			throw new NotFoundException(__('Invalid sel status'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->SelStatus->delete()) {
			return $this->flash(__('The sel status has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The sel status could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
}
