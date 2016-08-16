<?php
App::uses('AppController', 'Controller');
/**
 * Qualifications Controller
 *
 * @property Qualification $Qualification
 * @property PaginatorComponent $Paginator
 */
class QualificationsController extends AppController {

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
		$this->Qualification->recursive = 0;
		$this->set('qualifications', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Qualification->exists($id)) {
			throw new NotFoundException(__('Invalid qualification'));
		}
		$options = array('conditions' => array('Qualification.' . $this->Qualification->primaryKey => $id));
		$this->set('qualification', $this->Qualification->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Qualification->create();
			if ($this->Qualification->save($this->request->data)) {
				return $this->flash(__('The qualification has been saved.'), array('action' => 'index'));
			}
		}
		//設定値
		$selStatus = $this->getSystemConfig("sel_status");
		$this->set(compact( 'selStatus' ));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Qualification->exists($id)) {
			throw new NotFoundException(__('Invalid qualification'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Qualification->save($this->request->data)) {
				return $this->flash(__('The qualification has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('Qualification.' . $this->Qualification->primaryKey => $id));
			$this->request->data = $this->Qualification->find('first', $options);
		}
		//設定値
		$selStatus = $this->getSystemConfig("sel_status");
		$this->set(compact( 'selStatus' ));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Qualification->id = $id;
		if (!$this->Qualification->exists()) {
			throw new NotFoundException(__('Invalid qualification'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Qualification->delete()) {
			return $this->flash(__('The qualification has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The qualification could not be deleted. Please, try again.'), array('action' => 'index'));
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

            $findParam = $this->getCommonListPararms('Qualification');
            
            $findParam['fields'] =  array('name');
            $findParam['recursive'] = 0;

            $data = $this->Qualification->find('list', $findParam );

            $this->renderJson($data);
            exit;
        }
}
