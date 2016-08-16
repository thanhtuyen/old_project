<?php
App::uses('AppController', 'Controller');
/**
 * CanCustomFields Controller
 *
 * @property CanCustomField $CanCustomField
 * @property PaginatorComponent $Paginator
 */
class CanCustomFieldsController extends AppController {

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
		$this->CanCustomField->recursive = 0;
		$this->set('canCustomFields', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CanCustomField->exists($id)) {
			throw new NotFoundException(__('Invalid can custom field'));
		}
		$options = array('conditions' => array('CanCustomField.' . $this->CanCustomField->primaryKey => $id));
		$this->set('canCustomField', $this->CanCustomField->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CanCustomField->create();
			if ($this->CanCustomField->save($this->request->data)) {
				return $this->flash(__('The can custom field has been saved.'), array('action' => 'index'));
			}
		}
		$recCompanies = $this->CanCustomField->RecCompany->find('list');
		$recRecruiters = $this->CanCustomField->RecRecruiter->find('list');

		//設定値
		$customType = $this->getSystemConfig("custom_type");
		$selStatus = $this->getSystemConfig("sel_status");
		$this->set(compact('recCompanies', 'recRecruiters', 'selStatus', 'customType'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CanCustomField->exists($id)) {
			throw new NotFoundException(__('Invalid can custom field'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CanCustomField->save($this->request->data)) {
				return $this->flash(__('The can custom field has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('CanCustomField.' . $this->CanCustomField->primaryKey => $id));
			$this->request->data = $this->CanCustomField->find('first', $options);
		}
		$recCompanies = $this->CanCustomField->RecCompany->find('list');
		$recRecruiters = $this->CanCustomField->RecRecruiter->find('list');

		//設定値
		$customType = $this->getSystemConfig("custom_type");
		$selStatus = $this->getSystemConfig("sel_status");
		$this->set(compact('recCompanies', 'recRecruiters', 'selStatus', 'customType'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CanCustomField->id = $id;
		if (!$this->CanCustomField->exists()) {
			throw new NotFoundException(__('Invalid can custom field'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->CanCustomField->delete()) {
			return $this->flash(__('The can custom field has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The can custom field could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
}
