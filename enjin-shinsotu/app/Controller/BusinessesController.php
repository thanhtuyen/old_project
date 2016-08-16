<?php
App::uses('AppController', 'Controller');
/**
 * Businesses Controller
 *
 * @property Business $Business
 * @property PaginatorComponent $Paginator
 */
class BusinessesController extends AppController {

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
		$this->Business->recursive = 0;
		$this->set('businesses', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Business->exists($id)) {
			throw new NotFoundException(__('Invalid business'));
		}
		$options = array('conditions' => array('Business.' . $this->Business->primaryKey => $id));
		$this->set('business', $this->Business->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Business->create();
			if ($this->Business->save($this->request->data)) {
				return $this->flash(__('The business has been saved.'), array('action' => 'index'));
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
		if (!$this->Business->exists($id)) {
			throw new NotFoundException(__('Invalid business'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Business->save($this->request->data)) {
				return $this->flash(__('The business has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('Business.' . $this->Business->primaryKey => $id));
			$this->request->data = $this->Business->find('first', $options);
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
		$this->Business->id = $id;
		if (!$this->Business->exists()) {
			throw new NotFoundException(__('Invalid business'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Business->delete()) {
			return $this->flash(__('The business has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The business could not be deleted. Please, try again.'), array('action' => 'index'));
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

            $findParam = $this->getCommonListPararms('Business');
            
            $findParam['fields'] =  array('name');
            $findParam['recursive'] = 0;

            $data = $this->Business->find('list', $findParam );

            $this->renderJson($data);
            exit;
        }
}
