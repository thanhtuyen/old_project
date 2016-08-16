<?php
App::uses('AppController', 'Controller');
/**
 * CanNotices Controller
 *
 * @property CanNotice $CanNotice
 * @property PaginatorComponent $Paginator
 */
class CanNoticesController extends AppController {

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
		$this->CanNotice->recursive = 0;
		$this->set('canNotices', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CanNotice->exists($id)) {
			throw new NotFoundException(__('Invalid can notice'));
		}
		$options = array('conditions' => array('CanNotice.' . $this->CanNotice->primaryKey => $id));
		$this->set('canNotice', $this->CanNotice->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CanNotice->create();
			if ($this->CanNotice->save($this->request->data)) {
				return $this->flash(__('The can notice has been saved.'), array('action' => 'index'));
			}
		}
		$canCandidates = $this->CanNotice->CanCandidate->find('list');
		$recRecruiters = $this->CanNotice->RecRecruiter->find('list');
		$infStaffs = $this->CanNotice->InfStaff->find('list');

		//設定値
		$registerType = $this->getSystemConfig("register_type");
		$selStatus = $this->getSystemConfig("sel_status");
		$this->set(compact('canCandidates', 'recRecruiters', 'infStaffs', 'selStatus', 'registerType'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CanNotice->exists($id)) {
			throw new NotFoundException(__('Invalid can notice'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CanNotice->save($this->request->data)) {
				return $this->flash(__('The can notice has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('CanNotice.' . $this->CanNotice->primaryKey => $id));
			$this->request->data = $this->CanNotice->find('first', $options);
		}
		$canCandidates = $this->CanNotice->CanCandidate->find('list');
		$recRecruiters = $this->CanNotice->RecRecruiter->find('list');
		$infStaffs = $this->CanNotice->InfStaff->find('list');

		//設定値
		$registerType = $this->getSystemConfig("register_type");
		$selStatus = $this->getSystemConfig("sel_status");
		$this->set(compact('canCandidates', 'recRecruiters', 'infStaffs', 'selStatus', 'registerType'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CanNotice->id = $id;
		if (!$this->CanNotice->exists()) {
			throw new NotFoundException(__('Invalid can notice'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->CanNotice->delete()) {
			return $this->flash(__('The can notice has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The can notice could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
}
