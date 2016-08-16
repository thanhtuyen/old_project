<?php
App::uses('AppController', 'Controller');
/**
 * CanEducations Controller
 *
 * @property CanEducation $CanEducation
 * @property PaginatorComponent $Paginator
 */
class CanEducationsController extends AppController {

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
		$this->CanEducation->recursive = 0;
		$this->set('canEducations', $this->Paginator->paginate());

                //設定値
		$bunriClass = $this->getSystemConfig("bunri_class");
                $this->set(compact("bunriClass"));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CanEducation->exists($id)) {
			throw new NotFoundException(__('Invalid can education'));
		}
		$options = array('conditions' => array('CanEducation.' . $this->CanEducation->primaryKey => $id));
		$this->set('canEducation', $this->CanEducation->find('first', $options));

                //設定値
		$bunriClass = $this->getSystemConfig("bunri_class");
                $this->set(compact("bunriClass"));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CanEducation->create();
			if ($this->CanEducation->save($this->request->data)) {
				return $this->flash(__('The can education has been saved.'), array('action' => 'index'));
			}
		}
		//設定値
		$bunriClass = $this->getSystemConfig("bunri_class");
                $this->set(compact("bunriClass"));
                
		$canCandidates = $this->CanEducation->CanCandidate->find('list');
		$undergraduateInitialData = $this->CanEducation->UndergraduateInitialData->find('list');
		$schools = $this->CanEducation->School->find('list');
		$undergraduates = $this->CanEducation->Undergraduate->find('list');
		$this->set(compact('canCandidates', 'undergraduateInitialData', 'schools', 'undergraduates'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CanEducation->exists($id)) {
			throw new NotFoundException(__('Invalid can education'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CanEducation->save($this->request->data)) {
				return $this->flash(__('The can education has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('CanEducation.' . $this->CanEducation->primaryKey => $id));
			$this->request->data = $this->CanEducation->find('first', $options);
		}
		//設定値
		$bunriClass = $this->getSystemConfig("bunri_class");
                $this->set(compact("bunriClass"));
                
		$canCandidates = $this->CanEducation->CanCandidate->find('list');
		$undergraduateInitialData = $this->CanEducation->UndergraduateInitialData->find('list');
		$schools = $this->CanEducation->School->find('list');
		$undergraduates = $this->CanEducation->Undergraduate->find('list');
		$this->set(compact('canCandidates', 'undergraduateInitialData', 'schools', 'undergraduates'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CanEducation->id = $id;
		if (!$this->CanEducation->exists()) {
			throw new NotFoundException(__('Invalid can education'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->CanEducation->delete()) {
			return $this->flash(__('The can education has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The can education could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
}
