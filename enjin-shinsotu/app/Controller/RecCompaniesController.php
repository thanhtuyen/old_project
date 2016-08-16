<?php
App::uses('AppController', 'Controller');
/**
 * RecCompanies Controller
 *
 * @property RecCompany $RecCompany
 * @property PaginatorComponent $Paginator
 */
class RecCompaniesController extends AppController {

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
		$this->RecCompany->recursive = 0;
		$this->set('recCompanies', $this->Paginator->paginate());

		//設定値
		$addBusiness = $this->getSystemConfig("business");
		$addMarket = $this->getSystemConfig("market");
		$this->set(compact('addBusiness','addMarket'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->RecCompany->exists($id)) {
			throw new NotFoundException(__('Invalid rec company'));
		}
		if (!$this->RecCompany->isUses($id)) {
			throw new NotFoundException(__('not access authorizations'));
		}
		$options = array('conditions' => array('RecCompany.' . $this->RecCompany->primaryKey => $id));
		$this->set('recCompany', $this->RecCompany->find('first', $options));

		//設定値
		$addBusiness = $this->getSystemConfig("business");
		$addMarket = $this->getSystemConfig("market");
		$this->set(compact('addBusiness','addMarket'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
	
	
		if ($this->request->is('post')) {
            
            //保存処理
			$this->RecCompany->create();
			
			//学校情報初期情報
			$inputData = $this->request->data;

			//transform JS datetime
			$inputData['RecCompany']['deadline'] = date("Y-m-d H:i:s", strtotime($inputData['RecCompany']['deadline'] ." ". $inputData['RecCompany']['dl_time']));
			$inputData['RecCompany']['establish_date'] = date("Y-m-d", strtotime($inputData['RecCompany']['establish_date']));

			$this->loadModel( 'SchoolInitialData' );
			$this->loadModel( 'UndergraduateInitialData' );
			$this->loadModel( 'Tran' );
                        
            $this->Tran->begin();
                        $inputData['RecCompany']['fac_manager_id'] = $this->RecCompany->getUserInfo('id');
			$inputData['School'] = $this->SchoolInitialData->getInitData();
			$inputData['Undergraduate'] = $this->UndergraduateInitialData->getInitData();
			$inputData['ScreeningStage'] = $this->RecCompany->ScreeningStage->getInitData();
			$inputData['MailTemplate'] = $this->RecCompany->MailTemplate->getInitData();
			$inputData['RecDepartment'] = $this->RecCompany->RecDepartment->getInitData();
                        $inputData['RecDepartment'][0]['fac_manager_id'] = $this->RecCompany->getUserInfo('id');
			$inputData['RefererCompany'] = $this->RecCompany->RefererCompany->getInitData(
                                                $this->request->data['RecCompany']['prefecture_id'],
                                                $this->request->data['RecCompany']['city_id']
                                            );
						
			if (  $data = $this->RecCompany->saveAll( $inputData )) {
			    $id = $this->RecCompany->getLastInsertID();
                
                $this->Tran->commit();

				$this->Session->setFlash(__('The rec company has been saved.'));
				return $this->redirect(array('controller' => 'RecCompanies', 'action' => 'edit', $id));
				
			}
			
			$this->Tran->rollback();
		}

		$prefectures = $this->RecCompany->Prefecture->find('list');
		$cities = $this->RecCompany->City->find('list');
		$facManagers = $this->RecCompany->FacManager->find('list');

		//設定値
		$addMarket = $this->getSystemConfig("market");
		$addBusiness = $this->getSystemConfig("business");
		$status = $this->getSystemConfig("status");
		$this->set(compact('prefectures', 'cities', 'facManagers', 'addMarket', 'addBusiness', 'status'));


	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->RecCompany->exists($id)) {
			throw new NotFoundException(__('Invalid rec company'));
		}
		if (!$this->RecCompany->isUses($id)) {
			throw new NotFoundException(__('not access authorizations'));
		}
		if ($this->request->is(array('post', 'put'))) {

			$inputData = $this->request->data;
			//transform JS datetime
			// $inputData['RecCompany']['deadline'] = date("Y-m-d H:i:s", strtotime($inputData['RecCompany']['deadline'] ." ". $inputData['RecCompany']['dl_time']));
			// $inputData['RecCompany']['establish_date'] = date("Y-m-d", strtotime($inputData['RecCompany']['establish_date']));

			if ($this->RecCompany->save($inputData)) {
				$this->Session->setFlash(__('The rec company has been saved.'));
				return $this->redirect(array('controller' => 'RecCompanies', 'action' => 'edit', $id));
			}
		} else {
			$options = array('conditions' => array('RecCompany.' . $this->RecCompany->primaryKey => $id));
			$this->request->data = $this->RecCompany->find('first', $options);
			//transform to JS datetime
			// $this->request->data['RecCompany']['dl_time'] = date("H:i", strtotime($this->request->data['RecCompany']['deadline']));
			// $this->request->data['RecCompany']['deadline'] = date("m/d/Y", strtotime($this->request->data['RecCompany']['deadline']));
			$this->request->data['RecCompany']['establish_date'] = date("m/d/Y", strtotime($this->request->data['RecCompany']['establish_date']));
		}
		$prefectures = $this->RecCompany->Prefecture->find('list');
		$cities = $this->RecCompany->City->find('list');
		$facManagers = $this->RecCompany->FacManager->find('list');

		//設定値
		$addMarket = $this->getSystemConfig("market");
		$addBusiness = $this->getSystemConfig("business");
		$status = $this->getSystemConfig("status");
		$this->set(compact('prefectures', 'cities', 'facManagers', 'addMarket', 'addBusiness', 'status'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->RecCompany->id = $id;
		if (!$this->RecCompany->exists()) {
			throw new NotFoundException(__('Invalid rec company'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->RecCompany->delete()) {
			return $this->flash(__('The rec company has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The rec company could not be deleted. Please, try again.'), array('action' => 'index'));
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

            $findParam = $this->getCommonListPararms('RecCompany');
            
            $findParam['fields'] =  array('company_name');
            $findParam['recursive'] = 0;

            $data = $this->RecCompany->find('list', $findParam );

            $this->renderJson($data);
            exit;
	}
}
