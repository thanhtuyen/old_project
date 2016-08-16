<?php
App::uses('AppController', 'Controller');
/**
 * SchoolClasses Controller
 *
 * @property SchoolClass $SchoolClass
 * @property PaginatorComponent $Paginator
 */
class SchoolClassesController extends AppController {

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
		$this->SchoolClass->recursive = 0;
		$this->set('schoolClasses', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->SchoolClass->exists($id)) {
			throw new NotFoundException(__('Invalid school class'));
		}
		$options = array('conditions' => array('SchoolClass.' . $this->SchoolClass->primaryKey => $id));
		$this->set('schoolClass', $this->SchoolClass->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SchoolClass->create();
			if ($this->SchoolClass->save($this->request->data)) {
				return $this->flash(__('The school class has been saved.'), array('action' => 'index'));
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
		if (!$this->SchoolClass->exists($id)) {
			throw new NotFoundException(__('Invalid school class'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SchoolClass->save($this->request->data)) {
				return $this->flash(__('The school class has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('SchoolClass.' . $this->SchoolClass->primaryKey => $id));
			$this->request->data = $this->SchoolClass->find('first', $options);
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
		$this->SchoolClass->id = $id;
		if (!$this->SchoolClass->exists()) {
			throw new NotFoundException(__('Invalid school class'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->SchoolClass->delete()) {
			return $this->flash(__('The school class has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The school class could not be deleted. Please, try again.'), array('action' => 'index'));
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
		$data = $this->SchoolClass->find('list', array( 
			'fields' => array('name'),
			'recursive' =>0
		));

		$this->renderJson($data);
		exit;
	}
}