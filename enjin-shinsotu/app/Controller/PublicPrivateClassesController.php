<?php
App::uses('AppController', 'Controller');
/**
 * PublicPrivateClasses Controller
 *
 * @property PublicPrivateClass $PublicPrivateClass
 * @property PaginatorComponent $Paginator
 */
class PublicPrivateClassesController extends AppController {

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
		$this->PublicPrivateClass->recursive = 0;
		$this->set('publicPrivateClasses', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PublicPrivateClass->exists($id)) {
			throw new NotFoundException(__('Invalid public private class'));
		}
		$options = array('conditions' => array('PublicPrivateClass.' . $this->PublicPrivateClass->primaryKey => $id));
		$this->set('publicPrivateClass', $this->PublicPrivateClass->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PublicPrivateClass->create();
			if ($this->PublicPrivateClass->save($this->request->data)) {
				return $this->flash(__('The public private class has been saved.'), array('action' => 'index'));
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
		if (!$this->PublicPrivateClass->exists($id)) {
			throw new NotFoundException(__('Invalid public private class'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PublicPrivateClass->save($this->request->data)) {
				return $this->flash(__('The public private class has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('PublicPrivateClass.' . $this->PublicPrivateClass->primaryKey => $id));
			$this->request->data = $this->PublicPrivateClass->find('first', $options);
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
		$this->PublicPrivateClass->id = $id;
		if (!$this->PublicPrivateClass->exists()) {
			throw new NotFoundException(__('Invalid public private class'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->PublicPrivateClass->delete()) {
			return $this->flash(__('The public private class has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The public private class could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}

/**
 * lists method
 *
 * @throws 
 * @param 
 * @return void
 */
	public function lists() {

            $findParam = $this->getCommonListPararms('PublicPrivateClass');
            
            $findParam['fields'] =  array('name');
            $findParam['recursive'] = 0;

            $data = $this->PublicPrivateClass->find('list', $findParam );

            $this->renderJson($data);
            exit;
	}
}
