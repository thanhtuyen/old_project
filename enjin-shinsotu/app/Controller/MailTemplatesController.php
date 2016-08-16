<?php
App::uses('AppController', 'Controller');
/**
 * MailTemplates Controller
 *
 * @property MailTemplate $MailTemplate
 * @property PaginatorComponent $Paginator
 */
class MailTemplatesController extends AppController {

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
	    $this->setInitListData();
	    $this->layout = 'default';

	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MailTemplate->exists($id)) {
			throw new NotFoundException(__('Invalid mail template'));
		}
		$options = array('conditions' => array(
			'MailTemplate.' . $this->MailTemplate->primaryKey => $id,
			'MailTemplate.rec_company_id' => $this->getUserCompanyId()));
		$MailTemplate = $this->MailTemplate->find('first', $options);

		if(!$MailTemplate){
			throw new NotFoundException(__('Invalid mail template'));
		}

		$this->loadModel('MlAttachment');
		$MlAttachment = $this->MlAttachment->findAllByMailTemplateIdAndStatus($id, 0);

		$this->set('mailTemplateData', compact('MailTemplate','MlAttachment'));
                
		//設定値
		$selStatus = $this->getSystemConfig("sel_status");
		$purpose = $this->getSystemConfig("purpose");
		$this->set(compact('selStatus','purpose'));

		//get Target
		$this->loadModel('EvEvent');
		$this->loadModel('JobVote');
		$this->loadModel('ScreeningStage');

	    $selectEvEventData = $this->EvEvent->find( 'list' , array($this->EvEvent->getListDefaultConditions(true)) );
	    $selectJobVoteData = $this->JobVote->find( 'list' , array($this->JobVote->getListDefaultConditions()) );
	    $selectScreeningStageData = $this->ScreeningStage->find('list', array($this->ScreeningStage->getListDefaultConditions()));

		switch($MailTemplate['MailTemplate']['purpose_id']){
			case '0'://EvEvent
				$target = @$selectEvEventData[$MailTemplate['MailTemplate']['ev_event_id']];
				break;
			case '1'://JobVote
			case '3':
				$target = @$selectJobVoteData[$MailTemplate['MailTemplate']['job_vote_id']];
				break;
			case '2'://ScreeningStage
			case '4':
				$target = @$selectScreeningStageData[$MailTemplate['MailTemplate']['screening_stage_id']];
				break;
			default:
				$target = '';
		}

		$this->set(compact('target'));


	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {

			$this->request->data['MailTemplate']['rec_company_id'] = $this->getUserCompanyId();

			if(isset($this->request->data['MailTemplate']['purpose_id'])){
				$selectName = $this->request->data['MailTemplate']['selectName'];
				switch ($this->request->data['MailTemplate']['purpose_id']) {
					case '0'://event
						$this->request->data['MailTemplate']['ev_event_id'] = $selectName;
						break;
					case '1'://jobvote
					case '3':
						$this->request->data['MailTemplate']['job_vote_id'] = $selectName;
						break;
					case '2'://screeningStage
					case '4':
						$this->request->data['MailTemplate']['screening_stage_id'] = $selectName;
						break;
				}
			}

			$this->MailTemplate->create();
			if ($this->MailTemplate->save($this->request->data)) {

				$this->Session->setFlash(__('The mail template has been saved.'));
				return $this->redirect(array('action'=>'index'));
			}
		}
		//設定値
		$selStatus = $this->getSystemConfig("sel_status");
		$purpose = $this->getSystemConfig("purpose");
		$replaceWord = $this->getSystemConfig("replace_word");
		$this->set(compact('selStatus','purpose','replaceWord'));
                
		$evEvents = $this->MailTemplate->EvEvent->find('list');
		$jobVotes = $this->MailTemplate->JobVote->find('list');
		$screeningStages = $this->MailTemplate->ScreeningStage->find('list');
		$recCompanies = $this->MailTemplate->RecCompany->find('list');
		$recRecruiters = $this->MailTemplate->RecRecruiter->find('list');

		$this->set(compact('evEvents', 'jobVotes', 'screeningStages', 'recCompanies', 'recRecruiters'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->MailTemplate->exists($id)) {
			throw new NotFoundException(__('Invalid mail template'));
		}
		$options = array('conditions' => array(
			'MailTemplate.' . $this->MailTemplate->primaryKey => $id,
			'MailTemplate.rec_company_id' => $this->getUserCompanyId()));
		$MailTemplate = $this->MailTemplate->find('first', $options);

		if(!$MailTemplate){
			throw new NotFoundException(__('Invalid mail template'));
		}

		if ($this->request->is(array('post', 'put'))) {

			if(isset($this->request->data['MailTemplate']['purpose_id'])){
				$selectName = $this->request->data['MailTemplate']['selectName'];
				switch ($this->request->data['MailTemplate']['purpose_id']) {
					case '0'://event
						$this->request->data['MailTemplate']['ev_event_id'] = $selectName;
						break;
					case '1'://jobvote
					case '3':
						$this->request->data['MailTemplate']['job_vote_id'] = $selectName;
						break;
					case '2'://screeningStage
					case '4':
						$this->request->data['MailTemplate']['screening_stage_id'] = $selectName;
						break;
				}
			}

			if ($this->MailTemplate->save($this->request->data)) {

				$this->Session->setFlash(__('The mail template has been saved.'));
				return $this->redirect(array('action'=>'index'));
			}
		} else {

			$this->request->data = $MailTemplate;

			if(isset($this->request->data['MailTemplate']['purpose_id'])){

				$this->request->data['MailTemplate']['selectName'] = '';

				switch ($this->request->data['MailTemplate']['purpose_id']) {
					case '0'://event
						$this->request->data['MailTemplate']['selectName'] = $this->request->data['MailTemplate']['ev_event_id'];
						break;
					case '1'://jobvote
					case '3':
						$this->request->data['MailTemplate']['selectName'] = $this->request->data['MailTemplate']['job_vote_id'];
						break;
					case '2'://screeningStage
					case '4':
						$this->request->data['MailTemplate']['selectName'] = $this->request->data['MailTemplate']['screening_stage_id'];
						break;
				}
			}
		}
		//設定値
		$selStatus = $this->getSystemConfig("sel_status");
		$purpose = $this->getSystemConfig("purpose");
		$replaceWord = $this->getSystemConfig("replace_word");
		$this->set(compact('selStatus','purpose','replaceWord'));
                
		$evEvents = $this->MailTemplate->EvEvent->find('list');
		$jobVotes = $this->MailTemplate->JobVote->find('list');
		$screeningStages = $this->MailTemplate->ScreeningStage->find('list');
		$recCompanies = $this->MailTemplate->RecCompany->find('list');
		$recRecruiters = $this->MailTemplate->RecRecruiter->find('list');

		$this->set(compact('evEvents', 'jobVotes', 'screeningStages', 'recCompanies', 'recRecruiters'));

	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function copy($id = null) {

		if (!$this->MailTemplate->exists($id)) {
			throw new NotFoundException(__('Invalid mail template'));
		}

		$options = array('conditions' => array(
			'MailTemplate.' . $this->MailTemplate->primaryKey => $id,
			'MailTemplate.rec_company_id' => $this->getUserCompanyId()));
		$MailTemplate = $this->MailTemplate->find('first', $options);

		if(!$MailTemplate){
			throw new NotFoundException(__('Invalid mail template'));
		}

		if ($this->request->is(array('post', 'put'))) {
			
			$this->request->data['MailTemplate']['rec_company_id'] = $this->getUserCompanyId();
			
			if(isset($this->request->data['MailTemplate']['purpose_id'])){
				$selectName = $this->request->data['MailTemplate']['selectName'];
				switch ($this->request->data['MailTemplate']['purpose_id']) {
					case '0'://event
						$this->request->data['MailTemplate']['ev_event_id'] = $selectName;
						break;
					case '1'://jobvote
					case '3':
						$this->request->data['MailTemplate']['job_vote_id'] = $selectName;
						break;
					case '2'://screeningStage
					case '4':
						$this->request->data['MailTemplate']['screening_stage_id'] = $selectName;
						break;
				}
			}

			$this->MailTemplate->create();

			if ($this->MailTemplate->save($this->request->data)) {

				$this->Session->setFlash(__('The mail template has been saved.'));
				return $this->redirect(array('action'=>'index'));
			}

		} else {
			$this->request->data = $MailTemplate;
			if(isset($this->request->data['MailTemplate']['purpose_id'])){

				$this->request->data['MailTemplate']['selectName'] = '';

				switch ($this->request->data['MailTemplate']['purpose_id']) {
					case '0'://event
						$this->request->data['MailTemplate']['selectName'] = $this->request->data['MailTemplate']['ev_event_id'];
						break;
					case '1'://jobvote
					case '3':
						$this->request->data['MailTemplate']['selectName'] = $this->request->data['MailTemplate']['job_vote_id'];
						break;
					case '2'://screeningStage
					case '4':
						$this->request->data['MailTemplate']['selectName'] = $this->request->data['MailTemplate']['screening_stage_id'];
						break;
				}
			}
		}
		//設定値
		$selStatus = $this->getSystemConfig("sel_status");
		$purpose = $this->getSystemConfig("purpose");
		$replaceWord = $this->getSystemConfig("replace_word");
		$this->set(compact('selStatus','purpose','replaceWord'));
                
		$evEvents = $this->MailTemplate->EvEvent->find('list');
		$jobVotes = $this->MailTemplate->JobVote->find('list');
		$screeningStages = $this->MailTemplate->ScreeningStage->find('list');
		$recCompanies = $this->MailTemplate->RecCompany->find('list');
		$recRecruiters = $this->MailTemplate->RecRecruiter->find('list');

		$this->set(compact('evEvents', 'jobVotes', 'screeningStages', 'recCompanies', 'recRecruiters'));
		$this->set('form_copy',true);

		$this->render('add');

	}


/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->MailTemplate->id = $id;
		if (!$this->MailTemplate->exists()) {
			throw new NotFoundException(__('Invalid mail template'));
		}
		$options = array('conditions' => array(
			'MailTemplate.' . $this->MailTemplate->primaryKey => $id,
			'MailTemplate.rec_company_id' => $this->getUserCompanyId()));
		$MailTemplate = $this->MailTemplate->find('first', $options);

		if(!$MailTemplate){
			throw new NotFoundException(__('Invalid mail template'));
		}
		
		$this->request->allowMethod('post', 'delete');
		if ($this->MailTemplate->delete()) {

			$this->Session->setFlash(__('The mail template has been deleted.'));
			return $this->redirect(array('action'=>'index'));

		} else {
			$this->Session->setFlash(__('The mail template could not be deleted. Please, try again.'));
			return $this->redirect(array('action'=>'index'));

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
            $findParam = $this->getCommonListPararms('MailTemplate');
            
            $findParam['fields'] =  array('template','subject','body');
            $findParam['recursive'] = 0;
            $findParam['conditions'] = array("MailTemplate.rec_company_id" => $userCompanyId);
            $data = $this->MailTemplate->find('list', $findParam );

            $this->renderJson($data);
            exit;
	}


	/**
	* 添付資料アップロード
	*/
	public function upload(){

		if (!empty($this->data)) {
			$fileName = explode('.', $this->data['MailTemplate']['binary']['name']);
			$saveData = array(
				'MlAttachment' => array(
				'mail_template_id'  => $this->data['MailTemplate']['mailTemplatesId'],
				'file_name' 		=> $fileName[0],
				'extension' 		=> $fileName[1],
				'binary_data'       => file_get_contents($this->data['MailTemplate']['binary']['tmp_name']),
				'status'			=> 0,
				)
			);
			$this->loadModel('MlAttachment');
			if ($this->MlAttachment->save($saveData)) {
				return $this->flash(__('files are uploaded.'), array('action' => 'index'));
			}
		}
	}

	/**
	* 添付資料削除
	* @param 
	*/
	public function fileDelete($id = null){

		$this->loadModel('MlAttachment');
		$this->MlAttachment->id = $id;
		$this->request->allowMethod('post', 'delete');
		if ($this->MlAttachment->delete()) {
			return $this->flash(__('The attachment file has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The attachment file could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
	
	
	/**
	 * 
	 * メールテンプレート一覧表示用のデータをセットする
	 * 
	 * @param void
	 * @return void
	 * 
	 **/
	private function setInitListData()
	{
		$this->loadModel('EvEvent');
		$this->loadModel('JobVote');
		$this->loadModel('ScreeningStage');
		$this->loadModel('RefererCompany');

		//load target
	    $selectEvEventData = $this->EvEvent->find( 'list' , array($this->EvEvent->getListDefaultConditions(true)) );
	    $selectJobVoteData = $this->JobVote->find( 'list' , array($this->JobVote->getListDefaultConditions()) );
	    $selectScreeningStageData = $this->ScreeningStage->find('list', array($this->ScreeningStage->getListDefaultConditions()));
	    $selectRefererCompanyData = $this->RefererCompany->find('list', array($this->RefererCompany->getListDefaultConditions()));

	    $this->set(compact('selectEvEventData','selectJobVoteData','selectScreeningStageData','selectRefererCompanyData'));
	    

	    if ( empty( $this->request->query ) )
	    {
	        //default
	        $this->request->query['purpose'] = null;
	        $this->request->query['selectName'] = null;
	        $this->request->query['from'] = null;
	        $this->request->query['to'] = null;
	    }
	    
        $selectName = array(0=>'選択してください' );
        $selectNameData = array();
	    //default data set
	    switch ( $this->request->query['purpose'] ) {
	        case '0':
	                //EvEvents
	                $this->loadModel('EvEvent');
	                $conditions = $this->EvEvent->getListDefaultConditions(true);
	                $selectNameData = $this->EvEvent->find( 'list' , array($conditions) );
	                break;
	        case '1': //JobVotes
	        case '3':
	                $this->loadModel('JobVote');
	                $conditions = $this->JobVote->getListDefaultConditions();
	                $selectNameData = $this->JobVote->find( 'list' , array($conditions) );
	                break;
	        case '2': //ScreeningStages
	        case '4':
	                $this->loadModel('ScreeningStage');
	                $conditions = $this->ScreeningStage->getListDefaultConditions();
	                $selectNameData = $this->ScreeningStage->find( 'list' , array($conditions) );
	                break;
	    }
        
        array_merge( $selectName,$selectNameData );
        
        $conditions = $this->getSearchListConditions();

        $conditions['MailTemplate.status'] = 0;
        
		$this->MailTemplate->recursive = 0;
		
        $this->Paginator->settings = array( 'conditions'=>$conditions );
		
		$this->set('mailTemplates', $this->Paginator->paginate());

		//設定値
		$purpose = $this->getSystemConfig("purpose");
		$this->set(compact('purpose','selectName'));

		$getQuery = $this->request->query;
		$this->set( array(
				'rq_purpose' => @$getQuery['purpose'],
				'from' => @$getQuery['from'],
				'to' => @$getQuery['to'],
				'rq_selectName' => @$getQuery['selectName']
			)
		);

	}
	
	/**
	 * 
	 * メールテンプレート一覧、一覧表検索条件設定
	 * 
	 * 
	 * @param void
	 * @return array
	 * 
	 **/
    private function getSearchListConditions()
    {   
        
        $param  = $this->request->query;
        $conditions['MailTemplate.rec_company_id'] = $this->getUserCompanyId();

        if ( isset( $param['purpose'] ) && $param['purpose'] !='') {
            $conditions['MailTemplate.purpose_id'] = $param['purpose'];
            if ( empty( $param['selectName'] ) ){
                /*switch ($param['purpose'] ) {
                    case 0:
                           $conditions['MailTemplate.ev_event_id > '] = 0;
                           break;
                    case 1:
                           $conditions['MailTemplate.job_vote_id > '] = 0;
                           break;
                    case 2:
                           $conditions['MailTemplate.screening_stage_id > '] = 0;
                           break;
                }*/
           }else{
                switch ($param['purpose'] ) {
                    case '0':
                           $conditions['MailTemplate.ev_event_id = '] = $param['selectName'];
                           break;
                    case '1':
                    case '3':
                           $conditions['MailTemplate.job_vote_id = '] = $param['selectName'];
                           break;
                    case '2':
                    case '4':
                           $conditions['MailTemplate.screening_stage_id = '] = $param['selectName'];
                           break;
                }
           }
        }
        
        if ( !empty( $param['from'] ) )
        {
           $conditions['MailTemplate.created >= '] = sprintf( "%s 00:00:00",$param['from'] );
        }
        
        if ( !empty( $param['to'] ) )
        {
           $conditions['MailTemplate.created <= '] = sprintf( "%s 00:00:00",$param['to'] );
        }
        
        return $conditions;
    }
	
}
