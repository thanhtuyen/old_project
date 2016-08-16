<?php
App::uses('AppController', 'Controller');
/**
 * ForeignLanguages Controller
 *
 * @property ForeignLanguage $ForeignLanguage
 * @property PaginatorComponent $Paginator
 */
class ForeignLanguagesController extends AppController {

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
		$this->ForeignLanguage->recursive = 0;
		$this->set('foreignLanguages', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ForeignLanguage->exists($id)) {
			throw new NotFoundException(__('Invalid foreign language'));
		}
		$options = array('conditions' => array('ForeignLanguage.' . $this->ForeignLanguage->primaryKey => $id));
		$this->set('foreignLanguage', $this->ForeignLanguage->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ForeignLanguage->create();
			if ($this->ForeignLanguage->save($this->request->data)) {
				return $this->flash(__('The foreign language has been saved.'), array('action' => 'index'));
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
		if (!$this->ForeignLanguage->exists($id)) {
			throw new NotFoundException(__('Invalid foreign language'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ForeignLanguage->save($this->request->data)) {
				return $this->flash(__('The foreign language has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('ForeignLanguage.' . $this->ForeignLanguage->primaryKey => $id));
			$this->request->data = $this->ForeignLanguage->find('first', $options);
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
		$this->ForeignLanguage->id = $id;
		if (!$this->ForeignLanguage->exists()) {
			throw new NotFoundException(__('Invalid foreign language'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ForeignLanguage->delete()) {
			return $this->flash(__('The foreign language has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The foreign language could not be deleted. Please, try again.'), array('action' => 'index'));
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

            $findParam = $this->getCommonListPararms('ForeignLanguage');
            
            $findParam['fields'] =  array('name');
            $findParam['recursive'] = 0;

            $data = $this->ForeignLanguage->find('list', $findParam );

            $this->renderJson($data);
            exit;
        }
}
