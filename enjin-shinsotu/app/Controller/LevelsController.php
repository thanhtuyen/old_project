<?php
App::uses('AppController', 'Controller');
/**
 * Levels Controller
 *
 * @property Level $Level
 * @property PaginatorComponent $Paginator
 */
class LevelsController extends AppController {

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
		$this->Level->recursive = 0;
		$this->set('levels', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Level->exists($id)) {
			throw new NotFoundException(__('Invalid level'));
		}
		$options = array('conditions' => array('Level.' . $this->Level->primaryKey => $id));
		$this->set('level', $this->Level->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Level->create();
			if ($this->Level->save($this->request->data)) {
				return $this->flash(__('The level has been saved.'), array('action' => 'index'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Level->exists($id)) {
			throw new NotFoundException(__('Invalid level'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Level->save($this->request->data)) {
				return $this->flash(__('The level has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('Level.' . $this->Level->primaryKey => $id));
			$this->request->data = $this->Level->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Level->id = $id;
		if (!$this->Level->exists()) {
			throw new NotFoundException(__('Invalid level'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Level->delete()) {
			return $this->flash(__('The level has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The level could not be deleted. Please, try again.'), array('action' => 'index'));
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

            $findParam = $this->getCommonListPararms('Level');
            
            $findParam['fields'] =  array('name');
            $findParam['recursive'] = 0;

            $data = $this->Level->find('list', $findParam );

            $this->renderJson($data);
            exit;
	}
}
