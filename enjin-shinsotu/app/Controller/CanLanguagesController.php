<?php
App::uses('AppController', 'Controller');
/**
 * CanLanguages Controller
 *
 * @property CanLanguage $CanLanguage
 * @property PaginatorComponent $Paginator
 */
class CanLanguagesController extends AppController {

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
		$this->CanLanguage->recursive = 0;
		$this->set('canLanguages', $this->Paginator->paginate());
		//設定値
		$addForeignLanguage = $this->getSystemConfig("add_foreign_language");
		$addLevel = $this->getSystemConfig("add_level");
		$selStatus = $this->getSystemConfig("sel_status");
		$this->set(compact('addForeignLanguage', 'addLevel', 'selStatus'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CanLanguage->exists($id)) {
			throw new NotFoundException(__('Invalid can language'));
		}
		$options = array('conditions' => array('CanLanguage.' . $this->CanLanguage->primaryKey => $id));
		$this->set('canLanguage', $this->CanLanguage->find('first', $options));
		//設定値
		$addForeignLanguage = $this->getSystemConfig("add_foreign_language");
		$addLevel = $this->getSystemConfig("add_level");
		$selStatus = $this->getSystemConfig("sel_status");
		$this->set(compact('addForeignLanguage', 'addLevel', 'selStatus'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CanLanguage->create();
			if ($this->CanLanguage->save($this->request->data)) {
				return $this->flash(__('The can language has been saved.'), array('action' => 'index'));
			}
		}
		$canCandidates = $this->CanLanguage->CanCandidate->find('list');

		//設定値
		$addForeignLanguage = $this->getSystemConfig("add_foreign_language");
		$addLevel = $this->getSystemConfig("add_level");
		$selStatus = $this->getSystemConfig("sel_status");
		$this->set(compact('canCandidates', 'addForeignLanguage', 'addLevel', 'selStatus'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CanLanguage->exists($id)) {
			throw new NotFoundException(__('Invalid can language'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CanLanguage->save($this->request->data)) {
				return $this->flash(__('The can language has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('CanLanguage.' . $this->CanLanguage->primaryKey => $id));
			$this->request->data = $this->CanLanguage->find('first', $options);
		}
		$canCandidates = $this->CanLanguage->CanCandidate->find('list');

		//設定値
		$addForeignLanguage = $this->getSystemConfig("add_foreign_language");
		$addLevel = $this->getSystemConfig("add_level");
		$selStatus = $this->getSystemConfig("sel_status");
		$this->set(compact('canCandidates', 'addForeignLanguage', 'addLevel', 'selStatus'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CanLanguage->id = $id;
		if (!$this->CanLanguage->exists()) {
			throw new NotFoundException(__('Invalid can language'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->CanLanguage->delete()) {
			return $this->flash(__('The can language has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The can language could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
}
