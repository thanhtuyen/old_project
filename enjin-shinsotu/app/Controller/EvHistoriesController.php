<?php
App::uses('AppController', 'Controller');
/**
 * EvHistories Controller
 *
 * @property EvHistory $EvHistory
 * @property PaginatorComponent $Paginator
 */
class EvHistoriesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	protected $_model = 'EvHistory';

	protected $_listMethods = array('api_update', 'api_add', 'api_delete');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->EvHistory->recursive = 0;
		$this->set('evHistories', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view( $id = null, $schedule_id = null ) {

        //ロールによるアクセス制限（一時的）
        switch ( SessionComponent::read('Auth.User.role_type') ){
            case ROLE_TYPE_RECRUITER:   //採用担当者
                break;
            default:    //上記のロール以外はアクセスする権利がないので強制終了
                throw new NotFoundException(__('not access authorizations'));
        }
        
        //表示データの取得
        $this->loadModel('EvEvent');
        $this->EvEvent->contain( 'EvSchedule','ScreeningStage' );
        $wEvents = $this->EvEvent->find( 'first', array(
                                                    'conditions'=>array(
                                                        'EvEvent.id'=> $id,
                                                        'EvEvent.rec_company_id' => $this->getUserCompanyId(),
                                                        'EvEvent.status != 9',
                                                     )
                                                    ) );
                                                    
        if ( empty( $wEvents ) ) throw new NotFoundException('該当データのIDは見つかりませんでした。削除された可能性があります。');
        
        $this->set( "wEvents", $wEvents );
        
        //スケジュールIDが存在するかを確認して、処理変更
        if( empty( $schedule_id ) )
        {
            //該当データがあり、スケジュールがnullの場合には、IDが一番小さい詳細データを表示する
            if ( isset( $wEvents['EvSchedule'][0]['id'] ) ) $schedule_id = $wEvents['EvSchedule'][0]['id'];
        }else{
            //パラメータにスケジュールIDが存在している場合には、該当IDがデータとして取得できているかを確認する
            $check = false;
            $wSchedule_id = null;
            foreach( $wEvents['EvSchedule'] as $row )
            {
                if ( empty( $wSchedule_id ) ) $wSchedule_id = $row['id'];
                if ( $row['id'] === $schedule_id ) $check = true;
            }
            
            if ( $check === false ) $schedule_id = $wSchedule_id;
        }
        
        //イベント選考履歴に存在するユーザーをセットする
        $wEvHistory = array();
        if ( !empty( $schedule_id ) ) 
        {
            $this->loadModel( 'EvHistory' );
            $this->EvHistory->contain( 'CanCandidate','CanDocument' );
            $wEvHistory = $this->EvHistory->find( 'all', array( 'conditions'=>array( 
                                                                    'EvHistory.ev_schedule_id'=>$schedule_id,
                                                                    'CanCandidate.status'=>0
                                                               ) ) );
        }
        
        $this->set( "wEvHistory", $wEvHistory );
        
        //大学名の取得
        $this->loadModel( 'CanEducation' );
        $ids = array();
        foreach( $wEvHistory as & $row )
        {
            $ids[] = $row['CanCandidate']['id'];
        }
        $this->CanEducation->contain( 'School');
        $wCanCandidate = $this->CanEducation->find('all', array( 'conditions'=>array( 'CanEducation.can_candidate_id'=>$ids )) );
        
        $sCanCandidate = array();
        
        foreach( $wCanCandidate as $row )
        {
            $can_id = $row['CanEducation']['id'];
            
            if ( !isset( $sCanCandidate[$can_id] ) )
            {
                if ( $row['School']['name'] )
                {
                    $wEducation = $row['School']['name'];
                }else{
                    $wEducation = $row['CanEducation']['school'];
                }
                
                $sCanCandidate[$can_id] = $wEducation;
            }
            
        }
        
        $this->set( 'wCanCandidate', $sCanCandidate );

        
        //採用担当者の一覧データ作成（メソッド分割）
        $this->loadModel( 'EvPersonnel' );
        
        $wEvPersonnel = $this->EvPersonnel->find( 'all', array( 
                                                    'conditions'=>array( 
                                                        'EvPersonnel.ev_event_id'=> $id,
                                                        'EvPersonnel.status'=>0
                                                    ),
                                                ) );
        
        $this->set( 'wEvPersonnel', $wEvPersonnel );
        
        //採用担当者のプルダウンデータ取得
        $wEvPersonnelList = array();
        
        foreach( $wEvPersonnel as $row )
        {
            $wEvPersonnelList[] = $row['EvPersonnel']['rec_recruiter_id'];
        }
        
        $this->loadModel( 'RecRecruiter' );
        $wRecRecruiter = array(""=>"") + $this->RecRecruiter->getEvhistoryPullDown($wEvPersonnelList);

        $this->set( "wRecRecruiter", $wRecRecruiter );
        
        $this->set( "event_id", $id );
        $this->set( "schedule_id", $schedule_id );

        $this->loadModel('MailTemplate');
        $this->set( "mailTmpl", $this->MailTemplate->getPullDownList());
        
	}

/**
 * add method
 *
 * @return void
 */
	public function add( $id = null ) {
		if ($this->request->is('post')) {
			$this->EvHistory->create();
			if ($this->EvHistory->save($this->request->data)) {
				return $this->flash(__('The ev history has been saved.'), array('action' => 'view/'.$id."/".$this->EvHistory->id));
			}
		}
        //ロールによるアクセス制限（一時的）
        switch ( SessionComponent::read('Auth.User.role_type') ){
            case ROLE_TYPE_RECRUITER:   //採用担当者
                break;
            default:    //上記のロール以外はアクセスする権利がないので強制終了
                throw new NotFoundException(__('not access authorizations'));
        }

        if ($this->request->is(array('post', 'put'))) {

            //保存用のデータを作成する（日時フィールドが別々になっているので結合する処理）
            $this->makeSaveData();

            //データの保存を行う
            $this->loadModel( 'EvSchedule');
            if ($this->EvSchedule->save($this->request->data)) {
                return $this->flash(__('データを更新しました。'), array('action' => 'view/'.$id.'/'.$this->EvSchedule->id ));
            }
        }

        //表示データの取得
        $this->loadModel('EvEvent');
        $this->EvEvent->contain( 'EvSchedule','ScreeningStage' );
        $wEvents = $this->EvEvent->find( 'first', array(
                                                    'conditions'=>array(
                                                        'EvEvent.id'=> $id,
                                                        'EvEvent.rec_company_id' => $this->getUserCompanyId(),
                                                        'EvEvent.status != 9',
                                                     )
                                                    ) );
                                                    
        if ( empty( $wEvents ) ) throw new NotFoundException('該当データのIDは見つかりませんでした。削除された可能性があります。');
        
        $this->set( "wEvents", $wEvents );
        
        
        //スケジュールIDが存在するかを確認して、処理変更
        if( empty( $schedule_id ) )
        {
            //該当データがあり、スケジュールがnullの場合には、IDが一番小さい詳細データを表示する
            if ( isset( $wEvents['EvSchedule'][0]['id'] ) ) $schedule_id = $wEvents['EvSchedule'][0]['id'];
        }else{
            //パラメータにスケジュールIDが存在している場合には、該当IDがデータとして取得できているかを確認する
            $check = false;
            $wSchedule_id = null;
            foreach( $wEvents['EvSchedule'] as $row )
            {
                if ( empty( $wSchedule_id ) ) $wSchedule_id = $row['id'];
                if ( $row['id'] === $schedule_id ) $check = true;
            }
            
            if ( $check === false ) $schedule_id = $wSchedule_id;
        }
        
        //イベント選考履歴に存在するユーザーをセットする
        $wEvHistory = array();
        
        $this->set( "wEvHistory", $wEvHistory );
        
        //大学名の取得
        $sCanCandidate = array();
        
        $this->set( 'wCanCandidate', $sCanCandidate );

        
        //採用担当者の一覧データ作成（メソッド分割）
        $this->loadModel( 'EvPersonnel' );
        
        $wEvPersonnel = $this->EvPersonnel->find( 'all', array( 
                                                    'conditions'=>array( 
                                                        'EvPersonnel.ev_event_id'=> $id,
                                                        'EvPersonnel.status'=>0
                                                    ),
                                                ) );
        
        $this->set( 'wEvPersonnel', $wEvPersonnel );
        
        //採用担当者のプルダウンデータ取得
        $wEvPersonnelList = array();
        
        foreach( $wEvPersonnel as $row )
        {
            $wEvPersonnelList[] = $row['EvPersonnel']['rec_recruiter_id'];
        }
        
        $this->loadModel( 'RecRecruiter' );
        $wRecRecruiter = array(""=>"") + $this->RecRecruiter->getEvhistoryPullDown($wEvPersonnelList);

        $this->set( "wRecRecruiter", $wRecRecruiter );
        
        $this->set( "event_id", $id );
        
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 * Edit page URL from page 6.
 */
	public function edit( $id = null, $schedule_id = null ) {

        //ロールによるアクセス制限（一時的）
        switch ( SessionComponent::read('Auth.User.role_type') ){
            case ROLE_TYPE_RECRUITER:   //採用担当者
                break;
            default:    //上記のロール以外はアクセスする権利がないので強制終了
                throw new NotFoundException(__('not access authorizations'));
        }
        
        if ($this->request->is(array('post', 'put'))) {

            //保存用のデータを作成する（日時フィールドが別々になっているので結合する処理）
            $this->makeSaveData();

            //データの保存を行う
            $this->loadModel( 'EvSchedule');
            if ($this->EvSchedule->save($this->request->data)) {
                return $this->flash(__('基本データを更新しました。'), array('action' => 'view/'.$id.'/'.$schedule_id ));
            }
        }
        
        //表示データの取得
        $this->loadModel('EvEvent');
        $this->EvEvent->contain( 'EvSchedule','ScreeningStage' );
        $wEvents = $this->EvEvent->find( 'first', array(
                                                    'conditions'=>array(
                                                        'EvEvent.id'=> $id,
                                                        'EvEvent.rec_company_id' => $this->getUserCompanyId(),
                                                        'EvEvent.status != 9',
                                                     )
                                                    ) );
                                                    
        if ( empty( $wEvents ) ) throw new NotFoundException('該当データは見つかりませんでした。');
        
        if ($this->request->is(array('post', 'put'))) {
            
            foreach( $wEvents['EvSchedule'] as & $row )
            {
                if ( $row['id'] == $this->request->data['EvSchedule']['id'] )
                {
                    $row = $this->request->data['EvSchedule'];
                }
            }
            unset( $row );
        }
        
        
        $this->set( "wEvents", $wEvents );
        
        //スケジュールIDが存在するかを確認して、処理変更
        if( empty( $schedule_id ) )
        {
            //該当データがあり、スケジュールがnullの場合には、IDが一番小さい詳細データを表示する
            if ( isset( $wEvents['EvSchedule'][0]['id'] ) ) $schedule_id = $wEvents['EvSchedule'][0]['id'];
        }else{
            //パラメータにスケジュールIDが存在している場合には、該当IDがデータとして取得できているかを確認する
            $check = false;
            $wSchedule_id = null;
            foreach( $wEvents['EvSchedule'] as $row )
            {
                if ( empty( $wSchedule_id ) ) $wSchedule_id = $row['id'];
                if ( $row['id'] === $schedule_id ) $check = true;
            }
            
            if ( $check === false ) $schedule_id = $wSchedule_id;
        }
        
        //イベント選考履歴に存在するユーザーをセットする
        $wEvHistory = array();
        if ( !empty( $schedule_id ) ) 
        {
            $this->loadModel( 'EvHistory' );
            $this->EvHistory->contain( 'CanCandidate','CanDocument' );
            $wEvHistory = $this->EvHistory->find( 'all', array( 'conditions'=>array( 
                                                                    'EvHistory.ev_schedule_id'=>$schedule_id,
                                                                    'CanCandidate.status'=>0
                                                               ) ) );
        }
        
        $this->set( "wEvHistory", $wEvHistory );
        
        //大学名の取得
        $ids = $wCanCandidate = array();
        $this->loadModel( 'CanEducation' );
        foreach( $wEvHistory as & $row )
        {
            $ids[] = $row['CanCandidate']['id'];
        }
        
        if ( !empty( $ids ) ) {
            
            $this->CanEducation->contain( 'School');
            $wCanCandidate = $this->CanEducation->find('all', array( 'conditions'=>array( 'CanEducation.can_candidate_id'=>$ids )) );
        }
        
        $sCanCandidate = array();
        
        foreach( $wCanCandidate as $row )
        {
            $can_id = $row['CanEducation']['id'];
            
            if ( !isset( $sCanCandidate[$can_id] ) )
            {
                if ( $row['School']['name'] )
                {
                    $wEducation = $row['School']['name'];
                }else{
                    $wEducation = $row['CanEducation']['school'];
                }
                
                $sCanCandidate[$can_id] = $wEducation;
            }
            
        }
        
        $this->set( 'wCanCandidate', $sCanCandidate );

        
        //採用担当者の一覧データ作成（メソッド分割）
        $this->loadModel( 'EvPersonnel' );
        
        $wEvPersonnel = $this->EvPersonnel->find( 'all', array( 
                                                    'conditions'=>array( 
                                                        'EvPersonnel.ev_event_id'=> $id,
                                                        'EvPersonnel.status'=>0
                                                    ),
                                                ) );
        
        $this->set( 'wEvPersonnel', $wEvPersonnel );
        
        //採用担当者のプルダウンデータ取得
        $wEvPersonnelList = array();
        
        foreach( $wEvPersonnel as $row )
        {
            $wEvPersonnelList[] = $row['EvPersonnel']['rec_recruiter_id'];
        }
        
        $this->loadModel( 'RecRecruiter' );
        $wRecRecruiter = array(""=>"") + $this->RecRecruiter->getEvhistoryPullDown($wEvPersonnelList);

        $this->set( "wRecRecruiter", $wRecRecruiter );
        
        $this->set( "event_id", $id );
        $this->set( "schedule_id", $schedule_id );

        $this->loadModel('MailTemplate');
        $this->set( "mailTmpl", $this->MailTemplate->getPullDownList());
        
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 * Edit page URL from page 6.
 */
	public function edit_date($ev_schedules_id = null) {

		switch ( SessionComponent::read('Auth.User.role_type') ){
            case ROLE_TYPE_RECRUITER:   //採用担当者
                break;
            default:    //上記のロール以外はアクセスする権利がないので強制終了
                throw new NotFoundException(__('not access authorizations'));
        }


		//EvSchedule Model
		$this->loadModel('EvSchedule');
		$evScheduleBySchedules = $this->EvSchedule->find('all', array('conditions'=>array('EvSchedule.id'=>$ev_schedules_id), 'order' => 'EvSchedule.holding_date ASC'));
		if (count($evScheduleBySchedules) == 0 ) {
			return $this->flash(__("This Event EvSchedule $ev_schedules_id is not exists." ), array('action' => 'index'));
		}

		$event_id = $evScheduleBySchedules[0]['EvSchedule']['ev_event_id'];
		$evScheduleByEvents = $this->EvSchedule->find('all', array('conditions'=>array('EvSchedule.ev_event_id'=>$event_id), 'order' => 'EvSchedule.holding_date ASC'));
		
		// Set Active for Tab
		$i=0;
		foreach ($evScheduleByEvents as $evScheduleByEvent) {
			if($evScheduleByEvent['EvSchedule']['id'] == $ev_schedules_id) {
				$evScheduleByEvents[$i]['EvSchedule']['active'] = 'active';
			}
			$i++;
		}
		$this->set(compact('evScheduleByEvents'));


		
		// CanCandidate Model
		$this->loadModel('CanCandidate');
		$canCandidates = $this->Paginator->paginate('CanCandidate');
		$this->set('canCandidates', $canCandidates);
		
		// EvEnvents
		$this->loadModel('EvEvents');
		$event_condition = array('conditions'=>array('id'=>$event_id));
		$evEvents = $this->EvEvents->find( 'first', $event_condition );
		$this->set('evEvents', $evEvents );
	
		
		//EvPersonel
		$this->loadModel('EvPersonnel');
		$evPersonelByEvents = $this->EvPersonnel->find('first', array('conditions'=>array('ev_event_id'=>$event_id)));
		
		//RecRecruiter
		$this->loadModel('RecRecruiter');
		$recRecruiters = $this->RecRecruiter->find('all');
		$recRecruiterByEvents = $this->RecRecruiter->find('all', 
							array('conditions'=>array('RecRecruiter.id'=>$evPersonelByEvents['EvPersonnel']['rec_recruiter_id'])));
		$this->set('recRecruiterByEvents', $recRecruiterByEvents);
		$this->set(compact('recRecruiters'));

		
		// EvHistories
		$this->loadModel('EvHistories');
		$evHistories =  $this->EvHistories->find('all');

		//type
		$type = $this->getSystemConfig("type");
		$this->set('type',$type);

		//screening_stage_type
		$screening_stage_type = $this->getSystemConfig("screening_stage_type");
		$this->set('screening_stage_type',$screening_stage_type);

		//select_judgment_type
		$select_judgment_type = $this->getSystemConfig("select_judgment_type");
		$this->set('select_judgment_type',$select_judgment_type);

		//設定値
		$afterScore = $this->getSystemConfig("after_score");
		$this->set('afterScore',$afterScore);

		$evHistoryStatus = $this->getSystemConfig("ev_history_status");
		$this->set(compact('canCandidates', 'evSchedules', 'evHistoryStatus', 'afterScore','evPersonelByEvents'));
	}


/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->EvHistory->id = $id;
		if (!$this->EvHistory->exists()) {
			throw new NotFoundException(__('Invalid ev history'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->EvHistory->delete()) {
			return $this->flash(__('The ev history has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The ev history could not be deleted. Please, try again.'), array('action' => 'index'));
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
            $findParam = $this->getCommonListPararms('EvHistory');
            
            $data = $this->EvHistory->getData($userCompanyId,$findParam);

            $this->renderJson($data);
            exit;
        }


/**
* イベント参加履歴リスト
* 
* @param  int  $year
* 
* 
**/
    public function getEvHistList()
    {

		$rec_company_id = $this->getUserCompanyId();
		$year = $this->getWantedYear();

        if( empty( $year ) || empty( $rec_company_id ) ) {
            return false;
        } 

        $this->loadModel('EvStat');

		$data['year'] = $year;

		$result = $this->EvStat->getEvHistList( $rec_company_id, $data );

		$trim_result = $this->trimEvHistList( $result );

		return $trim_result;

    }

/**
*　イベント参加履歴リスト
*　レスポンスの形式に整える
*　
*　@param   array   $result
*　@return  array   $trim_result
**/
	private function trimEvHistList( $result )
	{

		$trim_result = array();

		foreach ($result as $key => $value) {
			$job_vote_id = $value['job_votes']['id'];
			$ev_event_id = $value['ev_events']['id'];
			$holding_date = $value['ev_schedules']['holding_date'];

			$trim_result[$job_vote_id]['name'] = $value['job_votes']['title']; 
			$trim_result[$job_vote_id][$ev_event_id]['name'] = $value['ev_events']['name'];
			$trim_result[$job_vote_id][$ev_event_id][$holding_date] = array(
						'venue' => $value['ev_schedules']['venue'],
						'reserve_count' => $value[0]['reserve_count'],
						'regist_count' => $value[0]['regist_count'],
						'cancel_count' => $value[0]['cancel_count'],
						'oarticipate_count' => $value[0]['oarticipate_count'],
						'absence_count' => $value[0]['absence_count'],
					);

		}

		return $trim_result;


	}

	/**
	 * Update status method
	 * Type: Post
	 * @return JSON format
	 */
	public function api_status(){

		if ($this->request->is(array('post', 'put'))) {
			$id = $this->request->data('id');
			$status = $this->request->data('status');
			if (!is_numeric($id) || !is_numeric($status)){
				throw new NotFoundException(__('The parameters is not valid'));
			}
			if ($status<0 || $status >5){
				throw new NotFoundException(__('The status is not valid'));
			}

            //get object EvHistory
			$conditions = array($this->_model->alias.'.'.$this->_model->primaryKey => $id);
			$object = $this->_model->find('first',array('conditions' => $conditions));
            if(!$object) {
                throw new NotFoundException(__('The object is not available'));
            }
            $canCandidateId = $object['EvHistory']['can_candidate_id'];

            //Check condition for update
            $conditions = array($this->_model->alias.'.'.$this->_model->primaryKey => $id,
                                'CanCandidate.id' => $canCandidateId ,
                                'CanCandidate.rec_company_id' => $this->getUserCompanyId(),
                                'CanCandidate.status'=>0,
                                'RecCompany.status' => 0);
            $joins = array(
                array(
                    'table' => 'rec_companies',
                    'alias' => 'RecCompany',
                    'conditions' => 'RecCompany.id = CanCandidate.rec_company_id'
                )
            );
            $this->_model->recursive = 1;
            $object = $this->_model->find('first',array('conditions' => $conditions, 'joins' => $joins));
			if (!$object) {
				throw new NotFoundException(__('The object is not available'));
			}
			$data = array('status'=> $status, 'id'=>$id);
			$this->_model->set($data);
			if (!$this->_model->validates()){
				throw new NotFoundException($this->_model->validationErrors);
			}
			if ($this->_model->save($data)) {
				$this->renderJson(array('code'=>0));
			}else {
				throw new NotFoundException(__('Can not update object'));
			}
		}
		throw new NotFoundException(__('Unknown method'));

	}

	protected function prepareDataForUpdate(){
		$rec_recruiter_id = $this->getLoginUser('id');
		$this->request->data['rec_recruiter_id'] = $rec_recruiter_id;
		return $this->request->data;
	}

	protected function prepareDataForInsert(){

		$can_candidate_id = $this->request->data('can_candidate_id');
		$ev_schedule_id = $this->request->data('ev_schedule_id');
		if (empty($can_candidate_id) || empty($ev_schedule_id )){
			throw new Exception(__('can_candidate_id and ev_schedule_id are required!'));
		}
		$this->_model->set($this->request->data);
		if (!$this->_model->validates()){
			throw new NotFoundException($this->_model->validationErrors);
		}
		// check duplicate
		$conditions = array(
			'EvHistory.can_candidate_id' => $can_candidate_id,
			'EvHistory.ev_schedule_id' => $ev_schedule_id,
			'EvHistory.status' => array(0,1,2,3,4,5),
		);
		$evHistory = $this->_model->find('first', array(
			'conditions' => $conditions
		));
		if ($evHistory){
			throw new Exception(__('Duplicate data!'));
		}

		// check status of can_candidate
		$conditions = array(
			'CanCandidate.id' => $can_candidate_id,
			'CanCandidate.status' => 0,
			'CanCandidate.rec_company_id' => $this->getUserCompanyId(),
			'RecCompany.status' => 0,
		);

		$this->loadModel('CanCandidate');
		$canCandidate = $this->CanCandidate->find('first', array(
			'conditions' => $conditions
		));
		if (!$canCandidate) {
			throw new Exception(__('The can_candidate is not available!'));
		}

		// check schedule
		$this->loadModel('EvSchedule');
		$conditions = array(
			'EvSchedule.id' => $ev_schedule_id,
			'EvEvent.rec_company_id' => $this->getUserCompanyId(),
			//'EvSchedule.status' => 0,
		);
		$evSchedule = $this->EvSchedule->find('first', array(
			'conditions' => $conditions
		));
		if (!$evSchedule){
			throw new Exception(__('Ev_schedule is not available!'));
		}
		$this->request->data['status'] = 0;
		return $this->request->data;

	}

	public function api_delete($id = null) {

		$ids = explode(',', $id);
		foreach($ids as $id) {

			//check condition before delete
			if(!$this->_model->canDelete($id)) {
				throw new Exception('Please check condition delete');
			}

			$this->_model->{$this->_model->primaryKey} = $id;
			if (!$this->_model->exists()) {
				throw new NotFoundException(__('Object with Id is '.$id.' not found'));
			}
			$data = array(
				'id' => $id,
				'status' => 9
			);
			$this->_model->set($data);
			if(!$this->_model->save()){
				throw new Exception('Can not delete object with Id is '.$id);
			}
		}
		$this->renderJson(array('code'=>0));

	}


    /*
    * CSVデータの取得・登録
    */
    public function csv_add(){

        if ($this->request->is('post')) {

            $this->loadModel('CsvImport');
            $csvObj = & $this->CsvImport;
			$scheduleId = $this->data['EvHistories']['eventSchedule'];
			
            $csvObj->setCsvFile($this->data['EvHistories']['CsvFile']);
            $csvObj->setjoinPossibleDate($this->data['EvHistories']['joinPossibleDate']);

            if ($csvObj->isFileError()) {
                return $this->flash($csvObj->getErrorMessege(), array('action' => 'csv_add'));
            }
            // エンコード
            $csvData = $csvObj->fileEncode($this->data['EvHistories']['CsvFile']['tmp_name']);
            // リクナビマイナビチェック(イベント用)
    	    $navigator = $csvObj->checkNavigator($this->data['EvHistories']['navigators']);
            // 登録に使用するマスタデータの取得
            $dataLists = $csvObj->getDataLists();
            // DB登録用にフォーマット整形
            $record = $csvObj->candidateConverter($csvData, $dataLists, $navigator, true);
            if ($record === false) {
                return $this->flash($csvObj->getErrorMessege(), array('action' => 'csv_add'));
            }
            // 存在しているデータの抽出
            $existCandidateIds = $csvObj->getExistCandidates();
            // 存在データのロック
            $this->loadModel('CanCandidate');
            $this->CanCandidate->setCSVLockFlg($existCandidateIds, $csvObj->naviKey);
            // ロックされているIDを取得
            $unLockId = $this->CanCandidate->getUnlockNaviID();
            // 存在しているデータとマッチするレコードにDB上のIDの追加
            $saveCandidates = $csvObj->releaseLockRecord($record, $unLockId);
            $successCount = 0;
            // 保存
            foreach ($saveCandidates as $data) {
            	$status = $data['ev_status'];
     			$successCount += $csvObj->eventCsvSave($data, $scheduleId, $status ) ;
            }
	        // 存在データのロックの解除
            $this->CanCandidate->create();
            $this->CanCandidate->unsetCSVLockFlg($existCandidateIds, $csvObj->naviKey);
            
            $errors = $csvObj->getErrors();
            arsort($errors);
        }
        // リスト取得
        $this->loadModel('RefererCompany');
        $navigators = $this->RefererCompany->getCsvSelecList();

		$this->loadModel('EvEvent');
		$eventSchedules = $this->EvEvent->getCsvSelectList();
        $this->set(compact('navigators', 'eventSchedules','successCount', 'errors'));
    }

/**
 * schedule_register method
 *
 * @throws NotFoundException
 * @param 
 * @return void
 * 
 */
	function schedule_view($event_id='', $schedules_id='') {
		switch ( SessionComponent::read('Auth.User.role_type') ){
            case ROLE_TYPE_RECRUITER:   //採用担当者
                break;
            default:    //上記のロール以外はアクセスする権利がないので強制終了
                throw new NotFoundException(__('not access authorizations'));
        }

		if (!empty($this->request->params['pass'][1])) {
			$schedules_id = $this->request->params['pass'][1];
			$this->request->data['EvSchedule']['id'] = $this->request->params['pass'][1];
		}

        //EvSchedule
		$this->loadModel('EvSchedule');
        $this->EvSchedule->recursive=0;
		if ($this->request->is(array('post', 'put'))) {
			$this->EvSchedule->create();
			if (isset($this->request->data['EvSchedule']['holding_date'])) {
    			$this->request->data['EvSchedule']['holding_date'] = date('Y-m-d', strtotime($this->request->data['EvSchedule']['holding_date']));
				$this->request->data['EvSchedule']['holding_date'] .= " ".date('H:i', strtotime($this->request->data['EvSchedule']['holding_date_time']));
			}
			if (isset($this->request->data['EvSchedule']['end_date'])) {
    			$this->request->data['EvSchedule']['end_date'] = date('Y-m-d', strtotime($this->request->data['EvSchedule']['end_date']));
				$this->request->data['EvSchedule']['end_date'] .= " ".date('H:i', strtotime($this->request->data['EvSchedule']['end_date_time']));
			}

			if (isset($this->request->data['EvSchedule']['wanted_deadline'])) {
    			$this->request->data['EvSchedule']['wanted_deadline'] = date('Y-m-d', strtotime($this->request->data['EvSchedule']['wanted_deadline']));
				$this->request->data['EvSchedule']['wanted_deadline'] .= " ".date('H:i', strtotime($this->request->data['EvSchedule']['wanted_deadline_time']));
			}
			
			if ($this->EvSchedule->save($this->request->data)) {
				$this->redirect(array('controller' => 'EvHistories', 'action' => 'schedule_view',$event_id, $this->request->data['EvSchedule']['id']));
			}
		} 
	
		$evScheduleByEvents = $this->EvSchedule->find('all', array('conditions'=>array('EvSchedule.ev_event_id'=>$event_id)));

		// Set Active for Tab
		$i=0;
		if (empty($schedules_id) and is_array($evScheduleByEvents)) {
			$evScheduleByEvents[0]['EvSchedule']['active'] = 'active';
		}
		foreach ($evScheduleByEvents as $evScheduleByEvent) {
			if($evScheduleByEvent['EvSchedule']['id'] == $schedules_id) {
				$evScheduleByEvents[$i]['EvSchedule']['active'] = 'active';
				$active = $schedules_id;
			}
			$i++;
		}
		$this->set(compact('evScheduleByEvents'));
		$this->set('id', $event_id);
	}

	/**
 * schedule_register method
 *
 * @throws NotFoundException
 * @param 
 * @return void
 * 
 */
	function schedule_regist($event_id='') {
		switch ( SessionComponent::read('Auth.User.role_type') ){
            case ROLE_TYPE_RECRUITER:   //採用担当者
                break;
            default:    //上記のロール以外はアクセスする権利がないので強制終了
                throw new NotFoundException(__('not access authorizations'));
        }

        $schedule['EvSchedule'] = $this->request->data['EvHistory'];

        //EvSchedule
		$this->loadModel('EvSchedule');
        $this->EvSchedule->recursive=0;
		if ($this->request->is(array('post', 'put'))) {
			$this->EvSchedule->create();
            $schedule['EvSchedule']['ev_event_id'] = $event_id;
			if (isset($schedule['EvSchedule']['holding_date1'])) {
    			$schedule['EvSchedule']['holding_date'] = date('Y-m-d', strtotime($schedule['EvSchedule']['holding_date1']));
				$schedule['EvSchedule']['holding_date'] .= " ".date('H:i', strtotime($schedule['EvSchedule']['holding_date2']));
			}
			if (isset($schedule['EvSchedule']['end_date1'])) {
    			$schedule['EvSchedule']['end_date'] = date('Y-m-d', strtotime($schedule['EvSchedule']['end_date1']));
				$schedule['EvSchedule']['end_date'] .= " ".date('H:i', strtotime($schedule['EvSchedule']['end_date2']));
			}

			if (isset($schedule['EvSchedule']['wanted_deadline1'])) {
    			$schedule['EvSchedule']['wanted_deadline'] = date('Y-m-d', strtotime($schedule['EvSchedule']['wanted_deadline1']));
				$schedule['EvSchedule']['wanted_deadline'] .= " ".date('H:i', strtotime($schedule['EvSchedule']['wanted_deadline2']));
			}
			

			if ($this->EvSchedule->save($schedule['EvSchedule'])) {
				$this->redirect(array('controller' => 'EvHistories', 'action' => 'view',$event_id));
			}
		} 

		$evScheduleByEvents = $this->EvSchedule->find('all', array('conditions'=>array('EvSchedule.ev_event_id'=>$event_id)));
		$this->set(compact('evScheduleByEvents'));
        $this->set('id', $event_id);
	}
	
	/**
	 * 
	 * 保存用のデータを加工する。
	 * 
	 * 
	 * 
	 **/
	private function makeSaveData()
	{
	    $result['EvSchedule'] = $this->request->data['EvHistory'];

	    $result["EvSchedule"]["holding_date"] = sprintf("%s %s", $result["EvSchedule"]["holding_date"], $result["EvSchedule"]["holding_time"] );
	    unset( $result["EvSchedule"]["holding_time"] );

	    $result["EvSchedule"]["end_date"] = sprintf("%s %s", $result["EvSchedule"]["end_date"], $result["EvSchedule"]["end_time"] );
	    unset( $result["EvSchedule"]["end_time"] );
	    
	    $this->request->data = $result;
	
	}
	
}
