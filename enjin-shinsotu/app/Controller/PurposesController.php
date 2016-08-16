<?php
App::uses('AppController', 'Controller');
/**
 * Purposes Controller
 *
 * @property Purpose $Purpose
 * @property PaginatorComponent $Paginator
 */
class PurposesController extends AppController {

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
		$this->Purpose->recursive = 0;
		$this->set('purposes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Purpose->exists($id)) {
			throw new NotFoundException(__('Invalid purpose'));
		}
		$options = array('conditions' => array('Purpose.' . $this->Purpose->primaryKey => $id));
		$this->set('purpose', $this->Purpose->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Purpose->create();
			if ($this->Purpose->save($this->request->data)) {
				return $this->flash(__('The purpose has been saved.'), array('action' => 'index'));
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
		if (!$this->Purpose->exists($id)) {
			throw new NotFoundException(__('Invalid purpose'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Purpose->save($this->request->data)) {
				return $this->flash(__('The purpose has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('Purpose.' . $this->Purpose->primaryKey => $id));
			$this->request->data = $this->Purpose->find('first', $options);
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
		$this->Purpose->id = $id;
		if (!$this->Purpose->exists()) {
			throw new NotFoundException(__('Invalid purpose'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Purpose->delete()) {
			return $this->flash(__('The purpose has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The purpose could not be deleted. Please, try again.'), array('action' => 'index'));
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

            $findParam = $this->getCommonListPararms('Purpose');
            
            $findParam['fields'] =  array('name');
            $findParam['recursive'] = 0;

            $data = $this->Purpose->find('list', $findParam );

            $this->renderJson($data);
            exit;
        }
}
