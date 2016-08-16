<?php
App::uses('AppController', 'Controller');
/**
 * FacManagers Controller
 *
 * @property FacManager $FacManager
 * @property PaginatorComponent $Paginator
 */
class FacManagersController extends AppController {

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
		$this->FacManager->recursive = 0;
		$this->set('facManagers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->FacManager->exists($id)) {
			throw new NotFoundException(__('Invalid fac manager'));
		}
		$options = array('conditions' => array('FacManager.' . $this->FacManager->primaryKey => $id));
		$this->set('facManager', $this->FacManager->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->FacManager->create();
                        $this->request->data["FacManager"]['fac_manager_id'] = $this->FacManager->getUserInfo('id');
			if ($this->FacManager->save($this->request->data)) {
				return $this->flash(__('The fac manager has been saved.'), array('action' => 'index'));
			}
		}
		
		//設定値
		$status = $this->getSystemConfig("status");
		$this->set(compact('facManagers','status'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->FacManager->exists($id)) {
			throw new NotFoundException(__('Invalid fac manager'));
		}
		if ($this->request->is(array('post', 'put'))) {
                        $this->request->data["FacManager"]['fac_manager_id'] = $this->FacManager->getUserInfo('id');
			if ($this->FacManager->save($this->request->data)) {
				return $this->flash(__('The fac manager has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('FacManager.' . $this->FacManager->primaryKey => $id));
			$this->request->data = $this->FacManager->find('first', $options);
		}
		//設定値
		$status = $this->getSystemConfig("status");
		$this->set(compact('facManagers','status'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->FacManager->id = $id;
		if (!$this->FacManager->exists()) {
			throw new NotFoundException(__('Invalid fac manager'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->FacManager->delete()) {
			return $this->flash(__('The fac manager has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The fac manager could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
}
