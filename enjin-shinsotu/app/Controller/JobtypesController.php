<?php
App::uses('AppController', 'Controller');
/**
 * Jobtypes Controller
 *
 * @property Jobtype $Jobtype
 * @property PaginatorComponent $Paginator
 */
class JobtypesController extends AppController {

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
		$this->Jobtype->recursive = 0;
		$this->set('jobtypes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Jobtype->exists($id)) {
			throw new NotFoundException(__('Invalid jobtype'));
		}
		$options = array('conditions' => array('Jobtype.' . $this->Jobtype->primaryKey => $id));
		$this->set('jobtype', $this->Jobtype->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Jobtype->create();
			if ($this->Jobtype->save($this->request->data)) {
				return $this->flash(__('The jobtype has been saved.'), array('action' => 'index'));
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
		if (!$this->Jobtype->exists($id)) {
			throw new NotFoundException(__('Invalid jobtype'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Jobtype->save($this->request->data)) {
				return $this->flash(__('The jobtype has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('Jobtype.' . $this->Jobtype->primaryKey => $id));
			$this->request->data = $this->Jobtype->find('first', $options);
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
		$this->Jobtype->id = $id;
		if (!$this->Jobtype->exists()) {
			throw new NotFoundException(__('Invalid jobtype'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Jobtype->delete()) {
			return $this->flash(__('The jobtype has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The jobtype could not be deleted. Please, try again.'), array('action' => 'index'));
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

            $findParam = $this->getCommonListPararms('Jobtype');
            
            $findParam['fields'] =  array('name');
            $findParam['recursive'] = 0;
            
            $data = $this->Jobtype->find('list', $findParam );

            $this->renderJson($data);
            exit;
        }
}
