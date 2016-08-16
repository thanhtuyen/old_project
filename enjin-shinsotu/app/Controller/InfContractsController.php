<?php
App::uses('AppController', 'Controller');
/**
 * InfContracts Controller
 *
 * @property InfContract $InfContract
 * @property PaginatorComponent $Paginator
 */
class InfContractsController extends AppController {

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
		$this->InfContract->recursive = 0;
		$this->set('infContracts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->InfContract->exists($id)) {
			throw new NotFoundException(__('Invalid inf contract'));
		}
		
		if ( !$this->InfContract->isUseRecruiter( $id ) )
		{
			throw new NotFoundException(__('Invalid inf contract'));
		}
		
		$options = array('conditions' => array('InfContract.' . $this->InfContract->primaryKey => $id));
		$this->set('infContract', $this->InfContract->find('first', $options));

        $contractType=$this->getSystemConfig("contract_type");
        $this->set(compact("contractType"));

        $infStatus=$this->getSystemConfig("inf_status");
        $this->set(compact("infStatus"));
	}

    /**
     * add method
     *
     * @return void
     */
    public function add( $id = null) {
        
        //流入元企業のIDを利用できるかを判断する
        if ( !$this->InfContract->isUseRecruiter( $id ) ){
            throw new NotFoundException(__('Invalid inf contract'));
        }
        
        if ($this->request->is('post')) {
            $this->InfContract->create();
            
            $this->setMoneyData();
            
            if ($this->InfContract->save($this->request->data)) {
                $this->Session->setFlash('流入元契約の追加が完了しました。');
                return $this->redirect(array('controller'=>'RefererCompanies','action' => 'detail',$id));
            }
        }
        
        //流入元企業名称の取得
        $this->InfContract->RefererCompany->recursive = -1;
        $this->set("wRefererCompany", $this->InfContract->RefererCompany->findById( $id ) );
        
        //設定値
        $contractType = $this->getSystemConfig("contract_type");
        $infStatus = $this->getSystemConfig("inf_status");
        $this->set(compact('refererCompanies', 'contractType', 'infStatus'));
        
        //採用担当者以外処理が出来ない
        switch ( SessionComponent::read('Auth.User.role_type') ){
            case ROLE_TYPE_RECRUITER:   //採用担当者
                break;
            default:
                throw new NotFoundException(__('not access authorizations'));
        }
        
        $this->set( 'id', $id );
        
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->InfContract->exists($id)) {
			throw new NotFoundException(__('Invalid inf contract'));
		}
		
		if ( !$this->InfContract->isUseRecruiter( $id ) )
		{
			throw new NotFoundException(__('Invalid inf contract'));
		}
		
		
		
		if ($this->request->is(array('post', 'put'))) {
            $this->setMoneyData();

			if ($this->InfContract->save($this->request->data)) {
                $this->redirect(array('action'=>'view/'.$this->request->data['InfContract']['id']));
			}
		} else {
			$options = array('conditions' => array('InfContract.' . $this->InfContract->primaryKey => $id));
			$this->request->data = $this->InfContract->find('first', $options);

            $start_contract_date = new DateTime($this->request->data['InfContract']['start_contract_date']);
            $this->request->data['InfContract']['start_contract_date']=$start_contract_date->format('Y/m/d');

            $end_contract_date = new DateTime($this->request->data['InfContract']['end_contract_date']);
            $this->request->data['InfContract']['end_contract_date']=$end_contract_date->format('Y/m/d');
            
            switch( $this->request->data['InfContract']['contract_type'] )
            {
                case 1:
                        $this->request->data['InfContract']['money'] = $this->request->data['InfContract']['fixed_unit_price'];
                        break;
                case 2:
                        $this->request->data['InfContract']['money'] = $this->request->data['InfContract']['unlimited_fixed_annual'];
                        break;
                case 3:
                        $this->request->data['InfContract']['money'] = $this->request->data['InfContract']['income_ratio'];
                        break;
                default:
                        $this->request->data['InfContract']['money'] = 0;
            }
            
        }
        
        //流入元企業の取得
        $refererCompanies = $this->InfContract->RefererCompany->find('list', 
                                                                array( 'conditions'=>array(
                                                                    'RefererCompany.rec_company_id'=> $this->getUserCompanyId(),
                                                                    'RefererCompany.influx_original_type !='=>3
                                                                     ) ) );
        
		//設定値
		$contractType = $this->getSystemConfig("contract_type");
		$infStatus = $this->getSystemConfig("inf_status");
		$this->set(compact('refererCompanies', 'contractType', 'infStatus'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->InfContract->id = $id;
		if (!$this->InfContract->exists()) {
			throw new NotFoundException(__('Invalid inf contract'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->InfContract->delete()) {
			return $this->flash(__('The inf contract has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The inf contract could not be deleted. Please, try again.'), array('action' => 'index'));
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
            $findParam = $this->getCommonListPararms('InfContract');
            
            $findParam['fields'] =  array('InfContract.id','InfContract.title','RefererCompany.name');
            $findParam['recursive'] = 0;
            $findParam['conditions'] = array("RefererCompany.rec_company_id" => $userCompanyId);
            $findParam['contain'] = array( 'RefererCompany' );
            $data = $this->InfContract->find('list', $findParam );

            $this->renderJson($data);
            exit;
        }

    /**
     * 
     * 金額・割合の設定
     * 
     * @param void
     * @retirn void
     * 
     * 
     **/
    public function setMoneyData()
    {
        switch ( $this->request->data['InfContract']['contract_type'] )
        {
            case 1:
                    $this->request->data['InfContract']['fixed_unit_price'] = $this->request->data['InfContract']['money'];
                    break;
            case 2:
                    $this->request->data['InfContract']['unlimited_fixed_annual'] = $this->request->data['InfContract']['money'];
                    break;
            case 3:
                    $this->request->data['InfContract']['income_ratio'] = $this->request->data['InfContract']['money'];
                    break;
        }
        
        unset( $this->request->data['InfContract']['money'] );
    }
    
}
