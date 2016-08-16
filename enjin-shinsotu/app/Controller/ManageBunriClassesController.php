<?php
App::uses('AppController', 'Controller');
/**
 * ManageBunriClasses Controller
 *
 * @property ManageBunriClass $ManageBunriClass
 * @property PaginatorComponent $Paginator
 */
class ManageBunriClassesController extends AppController {

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
		$this->ManageBunriClass->recursive = 0;
		$this->set('manageBunriClasses', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ManageBunriClass->exists($id)) {
			throw new NotFoundException(__('Invalid manage bunri class'));
		}
		$options = array('conditions' => array('ManageBunriClass.' . $this->ManageBunriClass->primaryKey => $id));
		$this->set('manageBunriClass', $this->ManageBunriClass->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ManageBunriClass->create();
			if ($this->ManageBunriClass->save($this->request->data)) {
				return $this->flash(__('The manage bunri class has been saved.'), array('action' => 'index'));
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
		if (!$this->ManageBunriClass->exists($id)) {
			throw new NotFoundException(__('Invalid manage bunri class'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ManageBunriClass->save($this->request->data)) {
				return $this->flash(__('The manage bunri class has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('ManageBunriClass.' . $this->ManageBunriClass->primaryKey => $id));
			$this->request->data = $this->ManageBunriClass->find('first', $options);
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
		$this->ManageBunriClass->id = $id;
		if (!$this->ManageBunriClass->exists()) {
			throw new NotFoundException(__('Invalid manage bunri class'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ManageBunriClass->delete()) {
			return $this->flash(__('The manage bunri class has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The manage bunri class could not be deleted. Please, try again.'), array('action' => 'index'));
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

            $findParam = $this->getCommonListPararms('ManageBunriClass');
            
            $findParam['fields'] =  array('name');
            $findParam['recursive'] = 0;
             $data = $this->ManageBunriClass->find('list', $findParam );

            $this->renderJson($data);
            exit;
        }
}
