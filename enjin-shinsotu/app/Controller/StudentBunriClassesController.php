<?php
App::uses('AppController', 'Controller');
/**
 * StudentBunriClasses Controller
 *
 * @property StudentBunriClass $StudentBunriClass
 * @property PaginatorComponent $Paginator
 */
class StudentBunriClassesController extends AppController {

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
		$this->StudentBunriClass->recursive = 0;
		$this->set('studentBunriClasses', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->StudentBunriClass->exists($id)) {
			throw new NotFoundException(__('Invalid student bunri class'));
		}
		$options = array('conditions' => array('StudentBunriClass.' . $this->StudentBunriClass->primaryKey => $id));
		$this->set('studentBunriClass', $this->StudentBunriClass->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->StudentBunriClass->create();
			if ($this->StudentBunriClass->save($this->request->data)) {
				return $this->flash(__('The student bunri class has been saved.'), array('action' => 'index'));
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
		if (!$this->StudentBunriClass->exists($id)) {
			throw new NotFoundException(__('Invalid student bunri class'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->StudentBunriClass->save($this->request->data)) {
				return $this->flash(__('The student bunri class has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('StudentBunriClass.' . $this->StudentBunriClass->primaryKey => $id));
			$this->request->data = $this->StudentBunriClass->find('first', $options);
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
		$this->StudentBunriClass->id = $id;
		if (!$this->StudentBunriClass->exists()) {
			throw new NotFoundException(__('Invalid student bunri class'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->StudentBunriClass->delete()) {
			return $this->flash(__('The student bunri class has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The student bunri class could not be deleted. Please, try again.'), array('action' => 'index'));
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

            $findParam = $this->getCommonListPararms('StudentBunriClass');
            
            $findParam['fields'] =  array('name');
            $findParam['recursive'] = 0;
            
            $data = $this->StudentBunriClass->find('list', $findParam );

            $this->renderJson($data);
            exit;
        }
}
