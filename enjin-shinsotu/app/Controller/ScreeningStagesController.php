<?php
App::uses('AppController', 'Controller');
/**
 * ScreeningStages Controller
 *
 * @property ScreeningStage $ScreeningStage
 * @property PaginatorComponent $Paginator
 */
class ScreeningStagesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
    protected $_model = 'ScreeningStage';

    protected $_listMethods = array('api_list');

	public function beforeFilter()
    {

    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ScreeningStage->recursive = 0;
		
		$companyId=$this->getUserCompanyId();
		$this->set('companyId', $companyId);
    		
        $conditions['conditions'] = array('rec_company_id' => $companyId, 'ScreeningStage.status' => 0);
        $conditions['recursive'] = -1;

		$this->set('screeningStages', $this->ScreeningStage->find('all', $conditions));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ScreeningStage->exists($id)) {
			throw new NotFoundException(__('Invalid screening stage'));
		}
		$options = array('conditions' => array('ScreeningStage.' . $this->ScreeningStage->primaryKey => $id));
		$this->set('screeningStage', $this->ScreeningStage->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ScreeningStage->create();
			if ($this->ScreeningStage->save($this->request->data)) {
				return $this->flash(__('The screening stage has been saved.'), array('action' => 'index'));
			}
		}
                //設定値
		$status = $this->getSystemConfig("sel_status");
                $this->set(compact('status'));

		$recCompanies = $this->ScreeningStage->RecCompany->find('list');
		$recRecruiters = $this->ScreeningStage->RecRecruiter->find('list');
		$this->set(compact('recCompanies', 'recRecruiters'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		/*
		if (!$this->ScreeningStage->exists($id)) {
			throw new NotFoundException(__('Invalid screening stage'));
		}
		*/
		if ($this->request->is(array('post', 'put'))) {
			//zero status set
			foreach ($this->request->data as $key => $value) {
				if(!isset($value['ScreeningStage']['status']))
					$this->request->data[$key]['ScreeningStage']['status']=1;
				else
					$this->request->data[$key]['ScreeningStage']['status']=0;
				# code...
			}
			if ($this->ScreeningStage->saveMany($this->request->data)) {
				$this->Session->setFlash(__('The screening stage has been saved.'));
				$this->redirect(array('controller' => 'ScreeningStages', 'action' => 'index'));
			}
		} else {
			$companyId=$this->getUserCompanyId();
        	$options['conditions'] = array('ScreeningStage.rec_company_id' => $companyId);
        	$options['recursive'] = -1;
        	$screeningStages = $this->ScreeningStage->find('all', $options);
        	$this->request->data = $screeningStages;
        	// echo "<pre>".print_r($screeningStages)."</pre>";die;
			$this->set(compact('screeningStages'));
			/*
			$options = array('conditions' => array('ScreeningStage.' . $this->ScreeningStage->primaryKey => $id));
			$this->request->data = $this->ScreeningStage->find('first', $options);
			*/
		}
        //設定値
		$status = array(1, 0);
        $this->set(compact('status'));
                
		$recCompanies = $this->ScreeningStage->RecCompany->find('list');
		$recRecruiters = $this->ScreeningStage->RecRecruiter->find('list');
		$this->set(compact('recCompanies', 'recRecruiters'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ScreeningStage->id = $id;
		if (!$this->ScreeningStage->exists()) {
			throw new NotFoundException(__('Invalid screening stage'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ScreeningStage->delete()) {
			return $this->flash(__('The screening stage has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The screening stage could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}

	public function lists() {

            $userCompanyId = $this->getUserCompanyId();
            $findParam = $this->getCommonListPararms('ScreeningStage');
            
            $findParam['fields'] =  array('name');
            $findParam['recursive'] = 0;
            $findParam['conditions'] = array("ScreeningStage.rec_company_id" => $userCompanyId);
            $data = $this->ScreeningStage->find('list', $findParam );

            $this->renderJson($data);
            exit;
	
	}

    public function getParameterForGetList()
    {
        $conditions = array('ScreeningStage.status' => 0,
                            'ScreeningStage.rec_company_id' => $this->getUserCompanyId(),
                            'RecCompany.status' => 0,);
        $this->_model->recursive = 0;

        return array('conditions' => $conditions,
                    'fields' => array($this->_model->alias.'.id', $this->_model->alias.'.name'));
    }
}
