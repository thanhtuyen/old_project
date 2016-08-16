<?php
App::uses('AppController', 'Controller');
/**
 * JobSelectTargets Controller
 *
 * @property JobSelectTarget $JobSelectTarget
 * @property PaginatorComponent $Paginator
 */
class JobSelectTargetsController extends AppController {

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
		$this->JobSelectTarget->recursive = 0;
		$this->set('jobSelectTargets', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->JobSelectTarget->exists($id)) {
			throw new NotFoundException(__('Invalid job select target'));
		}
		$options = array('conditions' => array('JobSelectTarget.' . $this->JobSelectTarget->primaryKey => $id));
		$this->set('jobSelectTarget', $this->JobSelectTarget->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->JobSelectTarget->create();
			if ($this->JobSelectTarget->save($this->request->data)) {
				return $this->flash(__('The job select target has been saved.'), array('action' => 'index'));
			}
		}
		$jobVotes = $this->JobSelectTarget->JobVote->find('list');
		$screeningStages = $this->JobSelectTarget->ScreeningStage->find('list');
		$recRecruiters = $this->JobSelectTarget->RecRecruiter->find('list');

		//設定値
		$screeningStageType = $this->getSystemConfig("screening_stage_type");
		$selectJudgmentType = $this->getSystemConfig("select_judgment_type");
		$status = $this->getSystemConfig("status");

		$this->set(compact('jobVotes', 'screeningStages', 'recRecruiters', 'screeningStageType', 'selectJudgmentType', 'status'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->JobSelectTarget->exists($id)) {
			throw new NotFoundException(__('Invalid job select target'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->JobSelectTarget->save($this->request->data)) {
				return $this->flash(__('The job select target has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('JobSelectTarget.' . $this->JobSelectTarget->primaryKey => $id));
			$this->request->data = $this->JobSelectTarget->find('first', $options);
		}
		$jobVotes = $this->JobSelectTarget->JobVote->find('list');
		$screeningStages = $this->JobSelectTarget->ScreeningStage->find('list');
		$recRecruiters = $this->JobSelectTarget->RecRecruiter->find('list');

		//設定値
		$screeningStageType = $this->getSystemConfig("screening_stage_type");
		$selectJudgmentType = $this->getSystemConfig("select_judgment_type");
		$status = $this->getSystemConfig("status");
		$this->set(compact('jobVotes', 'screeningStages', 'recRecruiters', 'screeningStageId', 'screeningStageType','selectJudgmentType','status' ));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->JobSelectTarget->id = $id;
		if (!$this->JobSelectTarget->exists()) {
			throw new NotFoundException(__('Invalid job select target'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->JobSelectTarget->delete()) {
			return $this->flash(__('The job select target has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The job select target could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
}
