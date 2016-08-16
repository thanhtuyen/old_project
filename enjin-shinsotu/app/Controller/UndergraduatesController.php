<?php
App::uses('AppController', 'Controller');
/**
 * Undergraduates Controller
 *
 * @property Undergraduate $Undergraduate
 * @property PaginatorComponent $Paginator
 */
class UndergraduatesController extends AppController {

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
		$this->Undergraduate->recursive = 0;
		$this->set('undergraduates', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Undergraduate->exists($id)) {
			throw new NotFoundException(__('Invalid undergraduate'));
		}
		$options = array('conditions' => array('Undergraduate.' . $this->Undergraduate->primaryKey => $id));
		$this->set('undergraduate', $this->Undergraduate->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Undergraduate->create();
			if ($this->Undergraduate->save($this->request->data)) {
				return $this->flash(__('The undergraduate has been saved.'), array('action' => 'index'));
			}
		}
		$recCompanies = $this->Undergraduate->RecCompany->find('list');
		$recRecruiters = $this->Undergraduate->RecRecruiter->find('list');
		$this->set(compact('recCompanies', 'recRecruiters'));
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
		if (!$this->Undergraduate->exists($id)) {
			throw new NotFoundException(__('Invalid undergraduate'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Undergraduate->save($this->request->data)) {
				return $this->flash(__('The undergraduate has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('Undergraduate.' . $this->Undergraduate->primaryKey => $id));
			$this->request->data = $this->Undergraduate->find('first', $options);
		}
		$recCompanies = $this->Undergraduate->RecCompany->find('list');
		$recRecruiters = $this->Undergraduate->RecRecruiter->find('list');
		$this->set(compact('recCompanies', 'recRecruiters'));
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
		$this->Undergraduate->id = $id;
		if (!$this->Undergraduate->exists()) {
			throw new NotFoundException(__('Invalid undergraduate'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Undergraduate->delete()) {
			return $this->flash(__('The undergraduate has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The undergraduate could not be deleted. Please, try again.'), array('action' => 'index'));
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

            $userCompanyId = $this->getUserCompanyId();
            $findParam = $this->getCommonListPararms('Undergraduate');
            
            $findParam['fields'] =  array('name');
            $findParam['recursive'] = 0;
            $findParam['conditions'] = array("Undergraduate.rec_company_id" => $userCompanyId);
            $data = $this->Undergraduate->find('list', $findParam );

            $this->renderJson($data);
            exit;
	}
}
