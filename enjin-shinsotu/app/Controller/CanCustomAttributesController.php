<?php
App::uses('AppController', 'Controller');
/**
 * CanCustomAttributes Controller
 *
 * @property CanCustomAttribute $CanCustomAttribute
 * @property PaginatorComponent $Paginator
 */
class CanCustomAttributesController extends AppController {

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
		$this->CanCustomAttribute->recursive = 0;
		$this->set('canCustomAttributes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CanCustomAttribute->exists($id)) {
			throw new NotFoundException(__('Invalid can custom attribute'));
		}
		$options = array('conditions' => array('CanCustomAttribute.' . $this->CanCustomAttribute->primaryKey => $id));
		$this->set('canCustomAttribute', $this->CanCustomAttribute->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CanCustomAttribute->create();
			if ($this->CanCustomAttribute->save($this->request->data)) {
				return $this->flash(__('The can custom attribute has been saved.'), array('action' => 'index'));
			}
		}
		$canCandidates = $this->CanCustomAttribute->CanCandidate->find('list');
		$canCustomFields = $this->CanCustomAttribute->CanCustomField->find('list');
		$recRecruiters = $this->CanCustomAttribute->RecRecruiter->find('list');

		//設定値
		$selStatus = $this->getSystemConfig("sel_status");
		$this->set(compact('canCandidates', 'canCustomFields', 'recRecruiters', 'selStatus'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CanCustomAttribute->exists($id)) {
			throw new NotFoundException(__('Invalid can custom attribute'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CanCustomAttribute->save($this->request->data)) {
				return $this->flash(__('The can custom attribute has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('CanCustomAttribute.' . $this->CanCustomAttribute->primaryKey => $id));
			$this->request->data = $this->CanCustomAttribute->find('first', $options);
		}
		$canCandidates = $this->CanCustomAttribute->CanCandidate->find('list');
		$canCustomFields = $this->CanCustomAttribute->CanCustomField->find('list');
		$recRecruiters = $this->CanCustomAttribute->RecRecruiter->find('list');

		//設定値
		$selStatus = $this->getSystemConfig("sel_status");
		$this->set(compact('canCandidates', 'canCustomFields', 'recRecruiters', 'selStatus'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CanCustomAttribute->id = $id;
		if (!$this->CanCustomAttribute->exists()) {
			throw new NotFoundException(__('Invalid can custom attribute'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->CanCustomAttribute->delete()) {
			return $this->flash(__('The can custom attribute has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The can custom attribute could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
}
