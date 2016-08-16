<?php
App::uses('AppController', 'Controller');
/**
 * SystemMailTemplates Controller
 *
 * @property SystemMailTemplate $SystemMailTemplate
 * @property PaginatorComponent $Paginator
 */
class SystemMailTemplatesController extends AppController {

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
		$this->SystemMailTemplate->recursive = 0;
		$this->set('systemMailTemplates', $this->Paginator->paginate());
                
		//設定値
		$selStatus = $this->getSystemConfig("sel_status");
		$purpose = $this->getSystemConfig("purpose");
		$this->set(compact('selStatus','purpose'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->SystemMailTemplate->exists($id)) {
			throw new NotFoundException(__('Invalid system mail template'));
		}
		$options = array('conditions' => array('SystemMailTemplate.' . $this->SystemMailTemplate->primaryKey => $id));
		$this->set('systemMailTemplate', $this->SystemMailTemplate->find('first', $options));
                
		//設定値
		$selStatus = $this->getSystemConfig("sel_status");
		$purpose = $this->getSystemConfig("purpose");
		$this->set(compact('selStatus','purpose'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SystemMailTemplate->create();
			if ($this->SystemMailTemplate->save($this->request->data)) {
				return $this->flash(__('The system mail template has been saved.'), array('action' => 'index'));
			}
		}
		//設定値
		$selStatus = $this->getSystemConfig("sel_status");
		$purpose = $this->getSystemConfig("purpose");
		$this->set(compact('selStatus','purpose'));

                $evEvents = $this->SystemMailTemplate->EvEvent->find('list');
		$jobVotes = $this->SystemMailTemplate->JobVote->find('list');
		$screeningStages = $this->SystemMailTemplate->ScreeningStage->find('list');
		$recCompanies = $this->SystemMailTemplate->RecCompany->find('list');
		$recRecruiters = $this->SystemMailTemplate->RecRecruiter->find('list');
		$this->set(compact('evEvents', 'jobVotes', 'screeningStages', 'recCompanies', 'recRecruiters'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->SystemMailTemplate->exists($id)) {
			throw new NotFoundException(__('Invalid system mail template'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SystemMailTemplate->save($this->request->data)) {
				return $this->flash(__('The system mail template has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('SystemMailTemplate.' . $this->SystemMailTemplate->primaryKey => $id));
			$this->request->data = $this->SystemMailTemplate->find('first', $options);
		}
		//設定値
		$selStatus = $this->getSystemConfig("sel_status");
		$purpose = $this->getSystemConfig("purpose");
		$this->set(compact('selStatus','purpose'));

                $evEvents = $this->SystemMailTemplate->EvEvent->find('list');
		$jobVotes = $this->SystemMailTemplate->JobVote->find('list');
		$screeningStages = $this->SystemMailTemplate->ScreeningStage->find('list');
		$recCompanies = $this->SystemMailTemplate->RecCompany->find('list');
		$recRecruiters = $this->SystemMailTemplate->RecRecruiter->find('list');
		$this->set(compact('evEvents', 'jobVotes', 'screeningStages', 'recCompanies', 'recRecruiters'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->SystemMailTemplate->id = $id;
		if (!$this->SystemMailTemplate->exists()) {
			throw new NotFoundException(__('Invalid system mail template'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->SystemMailTemplate->delete()) {
			return $this->flash(__('The system mail template has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The system mail template could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
}
