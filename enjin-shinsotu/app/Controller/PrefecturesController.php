<?php
App::uses('AppController', 'Controller');
/**
 * Prefectures Controller
 *
 * @property Prefecture $Prefecture
 * @property PaginatorComponent $Paginator
 */
class PrefecturesController extends AppController {

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
		$this->Prefecture->recursive = 0;
		$this->set('prefectures', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Prefecture->exists($id)) {
			throw new NotFoundException(__('Invalid prefecture'));
		}
		$options = array('conditions' => array('Prefecture.' . $this->Prefecture->primaryKey => $id));
		$this->set('prefecture', $this->Prefecture->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Prefecture->create();
			if ($this->Prefecture->save($this->request->data)) {
				return $this->flash(__('The prefecture has been saved.'), array('action' => 'index'));
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
		if (!$this->Prefecture->exists($id)) {
			throw new NotFoundException(__('Invalid prefecture'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Prefecture->save($this->request->data)) {
				return $this->flash(__('The prefecture has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('Prefecture.' . $this->Prefecture->primaryKey => $id));
			$this->request->data = $this->Prefecture->find('first', $options);
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
		$this->Prefecture->id = $id;
		if (!$this->Prefecture->exists()) {
			throw new NotFoundException(__('Invalid prefecture'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Prefecture->delete()) {
			return $this->flash(__('The prefecture has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The prefecture could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}

/**
 * lists method
 * 一覧を取得しJSON送信用用命祖度にデータを渡す
 * @throws 
 * @param 
 * @return void
 */
        public function lists() {

            $findParam = $this->getCommonListPararms('Prefecture');
            
            $findParam['fields'] =  array('name');
            $findParam['recursive'] = 0;

            $data = $this->Prefecture->find('list', $findParam );

            $this->renderJson($data);
            exit;
        }
}
