<?php
App::uses('AppController', 'Controller');
/**
 * SchoolInitialData Controller
 *
 * @property SchoolInitialData $SchoolInitialData
 * @property PaginatorComponent $Paginator
 */
class SchoolInitialDataController extends AppController {

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
		$this->SchoolInitialData->recursive = 0;
		$this->set('schoolInitialData', $this->Paginator->paginate());

                //設定値
		$status = $this->getSystemConfig("status");
		$publicPrivateClass = $this->getSystemConfig("public_private_class");
		$schoolClass = $this->getSystemConfig("school_class");
		$schoolRank = $this->getSystemConfig("school_rank");
		$this->set(compact('status','publicPrivateClass','schoolClass','schoolRank'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->SchoolInitialData->exists($id)) {
			throw new NotFoundException(__('Invalid school initial data'));
		}
               $options = array('conditions' => array('SchoolInitialData.' . $this->SchoolInitialData->primaryKey => $id));
		$this->set('schoolInitialData', $this->SchoolInitialData->find('first', $options));
		
                //設定値
		$status = $this->getSystemConfig("status");
		$publicPrivateClass = $this->getSystemConfig("public_private_class");
		$schoolClass = $this->getSystemConfig("school_class");
		$schoolRank = $this->getSystemConfig("school_rank");
		$this->set(compact('status','publicPrivateClass','schoolClass','schoolRank'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SchoolInitialData->create();
			if ($this->SchoolInitialData->save($this->request->data)) {
				return $this->flash(__('The school initial data has been saved.'), array('action' => 'index'));
			}
		}
		//設定値
		$status = $this->getSystemConfig("status");
		$publicPrivateClass = $this->getSystemConfig("public_private_class");
		$schoolClass = $this->getSystemConfig("school_class");
		$schoolRank = $this->getSystemConfig("school_rank");
		$this->set(compact('status','publicPrivateClass','schoolClass','schoolRank'));

		$countries = $this->SchoolInitialData->Country->find('list');
		$prefectures = $this->SchoolInitialData->Prefecture->find('list');

		$this->set(compact('countries', 'prefectures'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->SchoolInitialData->exists($id)) {
			throw new NotFoundException(__('Invalid school initial data'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SchoolInitialData->save($this->request->data)) {
				return $this->flash(__('The school initial data has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('SchoolInitialData.' . $this->SchoolInitialData->primaryKey => $id));
			$this->request->data = $this->SchoolInitialData->find('first', $options);
		}
		//設定値
		$status = $this->getSystemConfig("status");
		$publicPrivateClass = $this->getSystemConfig("public_private_class");
		$schoolClass = $this->getSystemConfig("school_class");
		$schoolRank = $this->getSystemConfig("school_rank");
		$this->set(compact('status','publicPrivateClass','schoolClass','schoolRank'));

		$countries = $this->SchoolInitialData->Country->find('list');
		$prefectures = $this->SchoolInitialData->Prefecture->find('list');

		$this->set(compact('countries', 'prefectures'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->SchoolInitialData->id = $id;
		if (!$this->SchoolInitialData->exists()) {
			throw new NotFoundException(__('Invalid school initial data'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->SchoolInitialData->delete()) {
			return $this->flash(__('The school initial data has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The school initial data could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
}
