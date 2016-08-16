<?php
App::uses('AppController', 'Controller');
/**
 * Markets Controller
 *
 * @property Market $Market
 * @property PaginatorComponent $Paginator
 */
class MarketsController extends AppController {

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
		$this->Market->recursive = 0;
		$this->set('markets', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Market->exists($id)) {
			throw new NotFoundException(__('Invalid market'));
		}
		$options = array('conditions' => array('Market.' . $this->Market->primaryKey => $id));
		$this->set('market', $this->Market->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Market->create();
			if ($this->Market->save($this->request->data)) {
				return $this->flash(__('The market has been saved.'), array('action' => 'index'));
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
		if (!$this->Market->exists($id)) {
			throw new NotFoundException(__('Invalid market'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Market->save($this->request->data)) {
				return $this->flash(__('The market has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('Market.' . $this->Market->primaryKey => $id));
			$this->request->data = $this->Market->find('first', $options);
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
		$this->Market->id = $id;
		if (!$this->Market->exists()) {
			throw new NotFoundException(__('Invalid market'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Market->delete()) {
			return $this->flash(__('The market has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The market could not be deleted. Please, try again.'), array('action' => 'index'));
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

            $findParam = $this->getCommonListPararms('Market');
            
            $findParam['fields'] =  array('name');
            $findParam['recursive'] = 0;
            
            $data = $this->Market->find('list', $findParam );

            $this->renderJson($data);
            exit;
        }
}
