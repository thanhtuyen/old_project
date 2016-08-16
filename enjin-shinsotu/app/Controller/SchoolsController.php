<?php
App::uses('AppController', 'Controller');
/**
 * Schools Controller
 *
 * @property School $School
 * @property PaginatorComponent $Paginator
 */
class SchoolsController extends AppController {

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

	$companyId=$this->getUserCompanyId();

	$conditions = array('School.rec_company_id'=>$companyId);

	$getQuery = $this->request->query;

	if(isset($getQuery['school_class_id']) && $getQuery['school_class_id'] !=''){
		$conditions['School.school_class_id'] = $getQuery['school_class_id'];
		$this->set('school_class_id',$getQuery['school_class_id']);
	}
	if(isset($getQuery['public_private_class_id']) && $getQuery['public_private_class_id'] !=''){
		$conditions['School.public_private_class_id'] = $getQuery['public_private_class_id'];
		$this->set('public_private_class_id',$getQuery['public_private_class_id']);
	}
	if(!empty($getQuery['name'])){
		$conditions['School.name LIKE'] = '%'.$getQuery['name'].'%';
		$this->set('name',$getQuery['name']);
	}


	$this->School->recursive = 0;
	
	$this->Paginator->settings = array(
		'conditions'=> $conditions,
		'contain' => array('Country','Prefecture')
		);

	$this->set('schools', $this->Paginator->paginate());

                //設定値
	$selStatus = $this->getSystemConfig("sel_status");
	$schoolRank = $this->getSystemConfig("school_rank");
	$publicPrivateClass = $this->getSystemConfig("public_private_class");
	$schoolClass = $this->getSystemConfig("school_class");
	$this->set(compact( 'selStatus','schoolRank','publicPrivateClass' ,'schoolClass'));
}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function view($id = null) {
	if (!$this->School->exists($id)) {
		throw new NotFoundException(__('Invalid school'));
	}
	if (!$this->School->isUses($id)) {
		throw new NotFoundException(__('not access authorizations'));
	}
	$this->School->recursive = 0;
	$options = array('conditions' => array('School.' . $this->School->primaryKey => $id));
	$this->set('school', $this->School->find('first', $options));

                //設定値
	$selStatus = $this->getSystemConfig("sel_status");
	$schoolRank = $this->getSystemConfig("school_rank");
	$publicPrivateClass = $this->getSystemConfig("public_private_class");
	$schoolClass = $this->getSystemConfig("school_class");
	$this->set(compact( 'selStatus','schoolRank','publicPrivateClass' ,'schoolClass'));
}

/**
 * add method
 *
 * @return void
 */
public function add() {
	if ($this->request->is('post')) {
		$this->request->data['School']['rec_company_id'] = $this->getUserCompanyId();
		$this->request->data['School']['status'] = 0;

		$this->School->create();

		if ($this->School->save($this->request->data)) {
			$this->Session->setFlash(__('The school has been saved.'));
			return $this->redirect(array('action'=>'index'));
		}
	}
		//設定値
	$selStatus = $this->getSystemConfig("sel_status");
	$schoolRank = $this->getSystemConfig("school_rank");
	$publicPrivateClass = $this->getSystemConfig("public_private_class");
	$schoolClass = $this->getSystemConfig("school_class");
	$this->set(compact( 'selStatus','schoolRank','publicPrivateClass' ,'schoolClass'));


	$recCompanies = $this->School->RecCompany->find('list');
	$countries = $this->School->Country->find('list');
	$prefectures = $this->School->Prefecture->find('list');
	$recRecruiters = $this->School->RecRecruiter->find('list');
	$this->set(compact('recCompanies', 'schoolClasses', 'publicPrivateClasses', 'countries', 'prefectures', 'recRecruiters'));
}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function edit($id = null) {
	if (!$this->School->exists($id)) {
		throw new NotFoundException(__('Invalid school'));
	}
	if (!$this->School->isUses($id)) {
		throw new NotFoundException(__('not access authorizations'));
	}
	$this->School->recursive = 1;
	if ($this->request->is(array('post', 'put'))) {

		$this->School->id = $id;
		if ($this->School->save($this->request->data)) {

			$this->Session->setFlash(__('The school has been saved.'));
			return $this->redirect(array('action'=>'index'));
		}
	} else {
		$options = array('conditions' => array('School.' . $this->School->primaryKey => $id));
		$this->request->data = $this->School->find('first', $options);
	}
	//設定値
	$selStatus = $this->getSystemConfig("sel_status");
	$schoolRank = $this->getSystemConfig("school_rank");
	$publicPrivateClass = $this->getSystemConfig("public_private_class");
	$schoolClass = $this->getSystemConfig("school_class");
	$this->set(compact( 'selStatus','schoolRank','publicPrivateClass' ,'schoolClass'));

	$recCompanies = $this->School->RecCompany->find('list');
	$countries = $this->School->Country->find('list');
	$prefectures = $this->School->Prefecture->find('list');
	$recRecruiters = $this->School->RecRecruiter->find('list');
	$this->set(compact('recCompanies', 'schoolClasses', 'publicPrivateClasses', 'countries', 'prefectures', 'recRecruiters'));
}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function delete($id = null) {
	$this->School->id = $id;
	if (!$this->School->exists()) {
		throw new NotFoundException(__('Invalid school'));
	}
	$this->request->allowMethod('post', 'delete');
	if ($this->School->delete()) {
		return $this->flash(__('The school has been deleted.'), array('action' => 'index'));
	} else {
		return $this->flash(__('The school could not be deleted. Please, try again.'), array('action' => 'index'));
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
	$findParam = $this->getCommonListPararms('School');

	$findParam['fields'] =  array('name');
	$findParam['recursive'] = 0;
	$findParam['conditions'] = array("School.rec_company_id" => $userCompanyId);
	$data = $this->School->find('list', $findParam );

	$this->renderJson($data);
	exit;
}
}
