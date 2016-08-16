<?php
App::uses('AppController', 'Controller');
/**
 * RefererCompanies Controller
 *
 * @property RefererCompany $RefererCompany
 * @property PaginatorComponent $Paginator
 */
class RefererCompaniesController extends AppController {


	protected $_model = 'RefererCompany';

	protected $_listMethods = array('api_list');
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
        $this->loadModel('Prefecture');
        $this->loadModel('JobVote');
        $this->loadModel('RecDepartments');
        $this->loadModel('InfJobVotePublic');
        // get list prefectures
        $prefectures = array(""=>"") + $this->Prefecture->find("list");
        $this->set('prefectures', $prefectures);

        // get list job_vote codition
        $option['conditions'] = array('JobVote.status' => '0', 'RecDepartment.rec_company_id' => $this->getUserCompanyId() );
        $option['joins'] = array(
            array(
                'table' => 'rec_departments',
                'alias' => 'RecDepartment',
                'type' => "left",
                'conditions' => array(
                    'JobVote.rec_department_id = RecDepartment.id'
                )
            )
        );
        $jobVote = array(""=>"") +  $this->JobVote->find("list", $option);
        $this->set('jobVote', $jobVote);

        // get ogriginal_type
        $originalType = array(""=>"") + $this->getSystemConfig("influx_original_type");
        $this->set('originalType', $originalType);

        //set list status yes/no
        $status = $this->getSystemConfig("inf_contracts_status");
        $this->set('status', $status);

        //get parameter
        $getQuery = $this->request->query;
        
        $conditions['RefererCompany.rec_company_id'] = $this->getUserCompanyId();
        
        //企業名
        if(isset($getQuery['name']) && $getQuery['name'] != ''){
            $conditions['RefererCompany.name LIKE'] = '%'.$getQuery['name'].'%';
        }

        //都道府県
        if( !empty($getQuery['prefectures']) ){
            $conditions['RefererCompany.prefecture_id'] = $getQuery['prefectures'];
        }
        
        //求人票
        if( !empty($getQuery['jobvote'])){
            $conditions['InfJobVotePublic.job_vote_id'] = $getQuery['jobvote'];
        }
        
        //流入元タイプ
        if ( $originaltype = $this->isOriginalEmpty( $getQuery, 'originaltype' ) )
        {
            $conditions['RefererCompany.influx_original_type'] = $originaltype;
        }
        
        //ステータス
        //求人票
        
        if( !empty($getQuery['status'])){
            switch( $getQuery['status'] )
            {
                case 1: //有
                        $joins[] = array( 
                                'table'=>'inf_contracts', 
                                'alias'=>'InfContract',
                                'type'=>'INNER',
                                'conditions'=>'RefererCompany.id = InfContract.referer_company_id'
                        );
                        break;
                case 2: //なし
                        echo 'なし';
                        $this->loadModel( 'InfContract' );
                        $conditions['not']= array( 'RefererCompany.id '=> $this->InfContract->getRefererCompanyId());
            }
        }
        
        $joins[] = array( 
                'table'=>'inf_job_vote_publics', 
                'alias'=>'InfJobVotePublic',
                'type'=>'LEFT',
                'conditions'=>'RefererCompany.id = InfJobVotePublic.referer_company_id'
        );
        
        $this->RefererCompany->recursive = 2;
        $this->RefererCompany->contain('City','Prefecture','InfJobVotePublic','InfContract');
        $this->Paginator->settings = array(
            'conditions' => $conditions,
            'joins'=>$joins,
            'group'=>'RefererCompany.id'
        );

        $result = $this->paginate("RefererCompany");
        
        $this->set('refererCompanies', $result);
        
        if ( empty( $getQuery ) )
        {
            $getQuery['name'] = $getQuery['prefectures'] = $getQuery['jobvote'] = $getQuery['originaltype'] = $getQuery['status'] = null;
        }
        
        $this->set( 'param', $getQuery );
        
    }
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($infStaff_id = null) {

		//ロールによるviewの出力変更処理
      	switch ( SessionComponent::read('Auth.User.role_type') ){
	        case ROLE_TYPE_MANAGER: //運営管理者
	        	break;
	        case ROLE_TYPE_RECRUITER:   //採用担当者
	        	//$this->render( $this->getRenderViewName() );
	        	break;
	        default:    //上記のロール以外はアクセスする権利がないので強制終了
	        	throw new NotFoundException(__('not access authorizations'));
      	}

        // Load Model InfStaff
		$this->loadModel('InfStaff');
		if (!$this->InfStaff->exists($infStaff_id)) {
			throw new NotFoundException(__('Invalid InfStaff'));
		}
		$options = array('conditions' => array('InfStaff.' . $this->InfStaff->primaryKey => $infStaff_id));
		$infStaff = $this->InfStaff->find('first', $options);
		$this->set('infStaff', $infStaff);

		// Referer Status
		$inf_status = $this->getSystemConfig("inf_status");
		$this->set(compact('inf_status'));
	}

/**
 * add method
 * 
 * @return void
 */
	public function add() {
		$companyID = $this->getUserCompanyId();
		$userID = $this->getLoginUser('id');

		if ($this->request->is('post')) {
			$this->RefererCompany->create();
			//process data
			if($this->request->data['RefererCompany']['influx_original_type'] == 3)
				$this->request->data['RefererCompany']['mycompany'] = 1;
			$this->request->data['RefererCompany']['rec_company_id'] = $companyID;
			$this->request->data['RefererCompany']['rec_recruiter_id'] = $userID;

			if ($this->RefererCompany->save($this->request->data)) {
				$id = $this->RefererCompany->getInsertID();

				$this->Session->setFlash(__('The referer company has been saved.'));
				return $this->redirect(array('action' => 'edit', $id));
			}
		}
		$recCompanies = $this->RefererCompany->RecCompany->find('list');
		$prefectures = $this->RefererCompany->Prefecture->find('list');
		$cities = $this->RefererCompany->City->find('list');
		$recRecruiters = $this->RefererCompany->RecRecruiter->find('list');


		//設定値
		$influxOriginalType = $this->getSystemConfig("influx_original_type");
		$refererStatus = $this->getSystemConfig("referer_status");
		$this->set(compact('recCompanies', 'prefectures', 'cities', 'recRecruiters', 'influxOriginalType', 'refererStatus' ));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null)
	{
//*
		if (!$this->RefererCompany->exists($id)) {
			throw new NotFoundException(__('Invalid referer company'));
		}
        if (!$this->RefererCompany->isUses($id)) 
        {
            throw new NotFoundException(__('Invalid referer company'));
        }
		if ($this->request->is('post'))
		{
			//process data
			$this->request->data['RefererCompany']['mycompany'] = ($this->request->data['RefererCompany']['influx_original_type'] == 3) ? 1 : 0;

			if ($this->RefererCompany->save($this->request->data))
			{
				$this->Session->setFlash(__('The referer company has been saved.'));
				return $this->redirect(array('action' => 'edit', $id));
			}
		}
		$this->request->data = $this->RefererCompany->findById($id);
		$prefectures = $this->RefererCompany->Prefecture->find('list');
		$cities = $this->RefererCompany->City->find('list');

		//設定値
		$influxOriginalType = $this->getSystemConfig("influx_original_type");
		$this->set(compact('id', 'influxOriginalType', 'prefectures', 'cities'));
		$this->set('id', $this->request->data['RefererCompany']['id']);
		$this->set('name', $this->request->data['RefererCompany']['name']);
/*/
//OLD CODE InfStaff Edit by Mr. Trong
		//ロールによるviewの出力変更処理
      	switch ( SessionComponent::read('Auth.User.role_type') ){
            case ROLE_TYPE_REFERER: //流入元担当者
                $this->request->data['InfStaff']['referer_company_id'] = $this->InfStaff->getUserInfo('referer_company_id');
                break;
        }

		// Load Model InfStaff
		$this->loadModel('InfStaff');
		if (!$this->InfStaff->exists($id)) {
			throw new NotFoundException(__('Invalid InfStaff'));
		}
		if ($this->request->is('post')) {
			$this->InfStaff->create();
			if ($this->InfStaff->save($this->request->data)) {
				$this->Session->setFlash(__('The referer company has been saved.'));
				return $this->redirect(array('action' => 'view', $id ));
			} else {
				return $this->flash(__(' Save have error.'), array('action' => 'index'));
			}
		} 
		$options = array('conditions' => array('InfStaff.' . $this->InfStaff->primaryKey => $id));
		$infStaff = $this->InfStaff->find('first', $options);
		$this->request->data = $infStaff;
		$this->set(compact('infStaff'));

		// Referer Status
		$inf_status = $this->getSystemConfig("inf_status");
		$this->set(compact('inf_status'));
//*/
	}


    /**
     * 
     * 流入元企業詳細
     * 
     * @param int
     * 
     * 
     ***/
    public function detail( $id = null )
    {
        if (!$this->RefererCompany->isUses($id)) 
        {
            throw new NotFoundException(__('Invalid referer company'));
        }

        if ( !isset($this->request->query['screeningstage_id'] )) {
            $this->request->query['screeningstage_id'] = "";
        }
        
        if ( !isset($this->request->query['jobvote_id'] )) {
            $this->request->query['jobvote_id'] = "";
        }

        $this->loadModel( 'JobVote' );
        $this->loadModel( 'RecRecruiter' );
        $this->loadModel( 'InfJobVotePublic' );
        $this->loadModel( 'ScreeningStage' );
        $this->loadModel( 'InfContract' );
        $this->loadModel( 'CanSelJob' );
        $this->loadModel( 'MailTemplate' );
        
        //流入元企業情報の取得
        $this->RefererCompany->recursive = 2;
        $this->RefererCompany->contain('InfStaff', 'InfContract','Prefecture','City');
        $data = $this->RefererCompany->findById($id);
        
        $data['RefererCompany']['rec_recruiter_name'] =  $this->RecRecruiter->getName( $data['RefererCompany']['rec_recruiter_id'] );
        $this->set( 'data' , $data );
        
        $jobVote = $this->ScreeningStage->getSelectList();
        
        //中間テーブルから候補者・求人票・選考段階・流入元契約の取得（ページャ)
        //アソシエーションの範囲を設定して対応する
        $conditions['CanSelJob.rec_company_id'] = $this->getUserCompanyId();
        $conditions['CanCandidate.status'] = 0;
        $conditions['CanCandidate.referer_company_id'] = $id;
        $conditions['CanSelJob.job_vote_id'] = array_keys( $jobVote );
        
        $param  = $this->request->query;
        
        $this->set('param', $param );
        
        if ( !empty( $param['screeningstage_id']  ) ) {
            $conditions['CanSelJob.screening_stage_id'] = $param['screeningstage_id'];
        }
        
        if ( !empty( $param['jobvote_id']  ) ) {
            $conditions['CanSelJob.job_vote_id'] = $param['jobvote_id'];
        }
        SessionComponent::write('SearchCondition', array('conditions' => $conditions));

        $cond = array( 'conditions'=>$conditions,
                      'fields'=>array('CanCandidate.id','CanCandidate.first_name, CanCandidate.last_name',
                                      'JobVote.id','JobVote.title',
                                      'ScreeningStage.id','ScreeningStage.name',
                      )
               );
        $this->paginate = $cond;

        $this->set('CanSelJobs', $this->Paginator->paginate('CanSelJob') );
        
        //求人票の取得（公開求人票）
        $pub = array(""=>"");
        $pub += $this->InfJobVotePublic->getRefComanyId( $data['RefererCompany']['id'] );
        $this->set('wInfJobVotePublic', $pub);
        
        //選考段階の取得
        $this->set( 'wScreeningStage', $this->ScreeningStage->getSelectList( true ) );
        
        //流入元契約を持つデータの取得
        $inf = $this->InfContract->find('all', array( 'conditions'=>array(
                                                'InfContract.referer_company_id'=>$id,
                                                'InfContract.status'=>0,
                                                'RefererCompany.rec_company_id'=>$this->getUserCompanyId(),
                                                )));
        $this->set( 'inf', $inf);

        $mailTmpl = $this->MailTemplate->getPullDownList();
		$this->set( 'mailTmpl', $mailTmpl);
        
    }

/**
 * editref method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function editref($id = null) {

	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->RefererCompany->id = $id;
		if (!$this->RefererCompany->exists()) {
			throw new NotFoundException(__('Invalid referer company'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->RefererCompany->delete()) {
			return $this->flash(__('The referer company has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The referer company could not be deleted. Please, try again.'), array('action' => 'index'));
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
            $findParam = $this->getCommonListPararms('RefererCompany');
            
            $findParam['fields'] =  array('name');
            $findParam['recursive'] = 0;
            $findParam['conditions'] = array("RefererCompany.rec_company_id" => $userCompanyId);
             $data = $this->RefererCompany->find('list', $findParam );

            $this->renderJson($data);
            exit;
        }

/**
* 求人票別 流入元企業割当リスト
* 
**/
	public function getAllocateList( $id = null )
	{
		$rec_company_id = $this->getUserCompanyId();
		$year = $this->getWantedYear();

        if( empty( $year ) || empty( $rec_company_id ) ) {
            return false;
        } 

        if( empty( $id ) ) {
        	return false;
        } 

        $data['job_vote_id'] = $id;

		$data['year'] = $year;

		$result = $this->RefererCompany->getAllocateCompany( $rec_company_id, $data );

		$trim_result = $this->trimAllcateList( $result, $id );

		return $trim_result;

	}

/**
* 求人票別 流入元企業割当リスト
* 
**/
	public function getAllocateListAPI( $id = null )
	{
		$rec_company_id = $this->getUserCompanyId();
		$year = $this->getWantedYear();

        if( empty( $year ) || empty( $rec_company_id ) ) {
            return false;
        } 

        if( empty( $id ) ) {
        	return false;
        } 

        $data['job_vote_id'] = $id;

		$data['year'] = $year;

		$result = $this->RefererCompany->getAllocateCompany( $rec_company_id, $data );

		$trim_result = $this->trimAllcateList( $result, $id );

		$this->set( 'AllocateList', $trim_result );


		$this->loadModel('ScreeningStage');

        $screening_stage_type = $this->getSystemConfig("screening_stage_type");
        $select_status_id = $this->getSystemConfig('select_judgment_type');


        $conditions = array( 
                'conditions' => array( 'ScreeningStage.rec_company_id' => $rec_company_id,
                                       'ScreeningStage.status' => 0
                                     ),
                'recursive' => -1,
                'fields' => array( 'name' )
             );
        $screening_stage = $this->ScreeningStage->find('list', $conditions );

        $this->set( 'screening_stages', $screening_stage );
        $this->set( 'select_status_id', $select_status_id );

		$this->render('/elements/allocateListTable');
		$this->response->type('json');
		$this->response->body(json_encode(array(
			'html' => $this->response->body()
		)));
		return $this->response;

	}

/**
*  媒体数申込数
* 
**/
	public function getRefNumberOfApp()
	{
		$rec_company_id = $this->getUserCompanyId();
		$year = $this->getWantedYear();

		if( empty( $year ) || empty( $rec_company_id ) ) {
            return false;
        } 

		$data['year'] = $year;

		$result = $this->RefererCompany->getRefNumberOfApp( $rec_company_id, $data );

		$trim_result = $this->trimRefNumberOfApp( $result );

		return $trim_result;

	}

/**
* 求人票別　流入元企業割当リスト
* レスポンスの形式に整える
* 
* @param  array  $result 
* @return array  $trim_result
**/
	private function trimAllcateList( $result, $id )
	{

		$refCp = $this->getRefCompany( $id );
		$trim_result = array();
		$i = 0;
		foreach ($result as $key => $value) {
			$i++;

			$job_vote_id = $value['job_votes']['id'];
			$referer_company_id = $value['referer_companies']['id'];
			$screening_stage_id = $value['sel_stat_children']['screening_stage_id'];
			$select_status = $value['sel_stat_children']['select_status_id'];

			$trim_result[$job_vote_id]['name'] = $value['job_votes']['title'];

			if( empty( $trim_result[$job_vote_id][$referer_company_id] ) ) {

			$trim_result[$job_vote_id][$referer_company_id] = array( 'name' => $value['referer_companies']['name'], 
																	 'allocation' => $value[0]['allocation'], );
			}

			$trim_result[$job_vote_id][$referer_company_id][$screening_stage_id][$select_status] = $value[0]['count'];

		}

		foreach ($trim_result as $key => $value) {
			foreach ($refCp as $ky => $val) {
				if( empty( $trim_result[$key][$ky] ) ){
					$trim_result[$key][$ky]['name'] = $val['name'];
					$trim_result[$key][$ky]['check'] = $val['check'];
					$trim_result[$key][$ky]['allocation'] = 2;


				}

				
			}

		}

		return $trim_result;


	}

	/**
	* ユーザー企業から流入元企業取得
	* 
	* 
	* 
	* 
	***/
	private function getRefCompany( $id )
	{
		$conditions = $this->RefererCompany->getListDefaultConditions();

		$res = $this->RefererCompany->find( 'list', $conditions );


		$conditions = $this->RefererCompany->getListDefaultConditions();
		$conditions['conditions']['InfJobVotePublic.job_vote_id'] = $id;
		$conditions['recursive'] = -1;
		$conditions['joins'][] = array(
							'type' => 'LEFT',   
						    'table' => 'inf_job_vote_publics',
						    'alias' => 'InfJobVotePublic',    
						    'conditions' => '`InfJobVotePublic`.`referer_company_id`=`RefererCompany`.`id`',
					);

		$result = $this->RefererCompany->find( 'all', $conditions );

		foreach ($result as $key => $value) {
			$ref_id = $value['RefererCompany']['id'];
			$data[$ref_id] = array( 'name' => $res[$ref_id],
									'check' => 1
							 ); 

		}

		foreach ($res as $key => $value) {
			if( empty( $data[$key] ) )
			$data[$key] = array( 'name' => $value, 'check' => 0 );
		}

		return $data;

	}

/**
* 媒体別申込数
* レスポンスの形式に整える
* 
* @param  array  $result 
* @return array  $trim_result
**/
	public function trimRefNumberOfApp( $result )
	{
		$trim_result = array();

		foreach ($result as $key => $value) {
			$referer_company_id = $value['referer_companies']['id'];

			if( $value[0]['total'] != 0 ) {
				$rate = floor( $value[0]['prosp_count'] * 100 / $value[0]['total'] );
				$rate = $rate;
			} else {
				$rate = "0";
			}
			
			$trim_result[$referer_company_id] = array( 
					'name' => $value['referer_companies']['name'],
					'total' => $value[0]['total'],
					'prosp_count' => $value[0]['prosp_count'], 
					'rate' => $rate
			 );
		}

		return $trim_result;



	}


    /**
     *
     *
     **/
    private function getJobVoteName( $refererCompanies )
    {
        foreach($refererCompanies as $referer) {

             foreach( $referer["InfJobVotePublic"] as $key => $value  ) {

//                 $name[ $value["job_vote_id"] ] = $jobVote[ $value["job_vote_id"] ];
            }
        }
    //
        return ;
    }

	public function getParameterForGetList()
	{
		$conditions = array('RefererCompany.status' => 0,
			'RefererCompany.rec_company_id' => $this->getUserCompanyId(),
			'RefererCompany.mycompany' => 0,
			'RecCompany.status' => 0,

		);
		$this->_model->recursive = 0;

		return array(
			'conditions' => $conditions,
			'fields' => array($this->_model->alias.'.id', $this->_model->alias.'.name'),
		);
	}
}
