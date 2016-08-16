<?php
App::uses('AppController', 'Controller');
/**
 * MlSendBodyHistories Controller
 *
 * @property MlSendBodyHistory $MlSendBodyHistory
 * @property PaginatorComponent $Paginator
 */
class MlSendBodyHistoriesController extends AppController {

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
		$this->MlSendBodyHistory->recursive = 0;
		$this->set('mlSendBodyHistories', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MlSendBodyHistory->exists($id)) {
			throw new NotFoundException(__('Invalid ml send body history'));
		}
		$options = array('conditions' => array('MlSendBodyHistory.' . $this->MlSendBodyHistory->primaryKey => $id));
		$this->set('mlSendBodyHistory', $this->MlSendBodyHistory->find('first', $options));
	}

}
