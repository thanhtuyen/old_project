<?php
App::uses('AppController', 'Controller');
/**
 * AssignSituations Controller
 *
 * @property AssignSituation $AssignSituation
 * @property PaginatorComponent $Paginator
 */
class AssignSituationsController extends AppController {

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
		$this->AssignSituation->recursive = 0;
		$this->set('assignSituations', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->AssignSituation->exists($id)) {
			throw new NotFoundException(__('Invalid assign situation'));
		}
		$options = array('conditions' => array('AssignSituation.' . $this->AssignSituation->primaryKey => $id));
		$this->set('assignSituation', $this->AssignSituation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AssignSituation->create();
			if ($this->AssignSituation->save($this->request->data)) {
				return $this->flash(__('The assign situation has been saved.'), array('action' => 'index'));
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
		if (!$this->AssignSituation->exists($id)) {
			throw new NotFoundException(__('Invalid assign situation'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->AssignSituation->save($this->request->data)) {
				return $this->flash(__('The assign situation has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('AssignSituation.' . $this->AssignSituation->primaryKey => $id));
			$this->request->data = $this->AssignSituation->find('first', $options);
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
		$this->AssignSituation->id = $id;
		if (!$this->AssignSituation->exists()) {
			throw new NotFoundException(__('Invalid assign situation'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->AssignSituation->delete()) {
			return $this->flash(__('The assign situation has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The assign situation could not be deleted. Please, try again.'), array('action' => 'index'));
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

            $findParam = $this->getCommonListPararms('AssignSituation');
            
            $findParam['fields'] =  array('name');
            $findParam['recursive'] = 0;

            $data = $this->AssignSituation->find('list', $findParam );

            $this->renderJson($data);
            exit;
        }
}
