<?php
App::uses('AppController', 'Controller');
/**
 * UndergraduateInitialData Controller
 *
 * @property UndergraduateInitialData $UndergraduateInitialData
 * @property PaginatorComponent $Paginator
 */
class UndergraduateInitialDataController extends AppController {

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
		$this->UndergraduateInitialData->recursive = 0;
		$this->set('undergraduateInitialData', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UndergraduateInitialData->exists($id)) {
			throw new NotFoundException(__('Invalid undergraduate initial data'));
		}
		$options = array('conditions' => array('UndergraduateInitialData.' . $this->UndergraduateInitialData->primaryKey => $id));
		$this->set('undergraduateInitialData', $this->UndergraduateInitialData->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UndergraduateInitialData->create();
			if ($this->UndergraduateInitialData->save($this->request->data)) {
				return $this->flash(__('The undergraduate initial data has been saved.'), array('action' => 'index'));
			}
		}
		//設定値
		$status = $this->getSystemConfig("status");
		$this->set(compact('status'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UndergraduateInitialData->exists($id)) {
			throw new NotFoundException(__('Invalid undergraduate initial data'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UndergraduateInitialData->save($this->request->data)) {
				return $this->flash(__('The undergraduate initial data has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('UndergraduateInitialData.' . $this->UndergraduateInitialData->primaryKey => $id));
			$this->request->data = $this->UndergraduateInitialData->find('first', $options);
		}
		//設定値
		$status = $this->getSystemConfig("status");
		$this->set(compact('status'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UndergraduateInitialData->id = $id;
		if (!$this->UndergraduateInitialData->exists()) {
			throw new NotFoundException(__('Invalid undergraduate initial data'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UndergraduateInitialData->delete()) {
			return $this->flash(__('The undergraduate initial data has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The undergraduate initial data could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
}
