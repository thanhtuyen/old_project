<?php
App::uses('AppController', 'Controller');
/**
 * MlAttachments Controller
 *
 * @property MlAttachment $MlAttachment
 * @property PaginatorComponent $Paginator
 */
class MlAttachmentsController extends AppController {

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
		$this->MlAttachment->recursive = 0;
		$this->set('mlAttachments', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MlAttachment->exists($id)) {
			throw new NotFoundException(__('Invalid ml attachment'));
		}
		$options = array('conditions' => array('MlAttachment.' . $this->MlAttachment->primaryKey => $id));
		$this->set('mlAttachment', $this->MlAttachment->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MlAttachment->create();
			if ($this->MlAttachment->save($this->request->data)) {
				return $this->flash(__('The ml attachment has been saved.'), array('action' => 'index'));
			}
		}
		//設定値
		$status = $this->getSystemConfig("status");
		$mailTemplates = $this->MlAttachment->MailTemplate->find('list');
		$this->set(compact('mailTemplates','status'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->MlAttachment->exists($id)) {
			throw new NotFoundException(__('Invalid ml attachment'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MlAttachment->save($this->request->data)) {
				return $this->flash(__('The ml attachment has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('MlAttachment.' . $this->MlAttachment->primaryKey => $id));
			$this->request->data = $this->MlAttachment->find('first', $options);
		}
		//設定値
		$status = $this->getSystemConfig("status");
		$mailTemplates = $this->MlAttachment->MailTemplate->find('list');
		$this->set(compact('mailTemplates','status'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->MlAttachment->id = $id;
		if (!$this->MlAttachment->exists()) {
			throw new NotFoundException(__('Invalid ml attachment'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->MlAttachment->delete()) {
			return $this->flash(__('The ml attachment has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The ml attachment could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}

}
