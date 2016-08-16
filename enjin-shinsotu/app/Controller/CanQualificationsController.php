<?php
App::uses('AppController', 'Controller');
/**
 * CanQualifications Controller
 *
 * @property CanQualification $CanQualification
 * @property PaginatorComponent $Paginator
 */
class CanQualificationsController extends AppController {

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
		$this->CanQualification->recursive = 0;
		$this->set('canQualifications', $this->Paginator->paginate());
		//設定値
		$selStatus = $this->getSystemConfig("sel_status");
                $qualifications = $this->getSystemConfig("qualifications");
		$this->set(compact('canCandidates', 'qualifications', 'selStatus'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CanQualification->exists($id)) {
			throw new NotFoundException(__('Invalid can qualification'));
		}
		$options = array('conditions' => array('CanQualification.' . $this->CanQualification->primaryKey => $id));
		$this->set('canQualification', $this->CanQualification->find('first', $options));
		//設定値
		$selStatus = $this->getSystemConfig("sel_status");
                $qualifications = $this->getSystemConfig("qualifications");
		$this->set(compact('canCandidates', 'qualifications', 'selStatus'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CanQualification->create();
			if ($this->CanQualification->save($this->request->data)) {
				return $this->flash(__('The can qualification has been saved.'), array('action' => 'index'));
			}
		}
		$canCandidates = $this->CanQualification->CanCandidate->find('list');

		//設定値
		$selStatus = $this->getSystemConfig("sel_status");
                $qualifications = $this->getSystemConfig("qualifications");
		$this->set(compact('canCandidates', 'qualifications', 'selStatus'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CanQualification->exists($id)) {
			throw new NotFoundException(__('Invalid can qualification'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CanQualification->save($this->request->data)) {
				return $this->flash(__('The can qualification has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('CanQualification.' . $this->CanQualification->primaryKey => $id));
			$this->request->data = $this->CanQualification->find('first', $options);
		}
		$qualifications = $this->CanQualification->Qualification->find('list');

		//設定値
		$selStatus = $this->getSystemConfig("sel_status");
                $qualifications = $this->getSystemConfig("qualifications");
		$this->set(compact('canCandidates', 'qualifications', 'selStatus'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CanQualification->id = $id;
		if (!$this->CanQualification->exists()) {
			throw new NotFoundException(__('Invalid can qualification'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->CanQualification->delete()) {
			return $this->flash(__('The can qualification has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The can qualification could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
}
