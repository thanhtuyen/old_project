<?php
App::uses('AppController', 'Controller');


/**
 * SelHistories Controller
 *
 * @property SelHistory $SelHistory
 * @property PaginatorComponent $Paginator
 */
class SelHistoriesController extends AppController {

    protected $_model = 'SelHistory';

    protected $_listMethods = array('api_add');
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
	public function index() 
	{
        $this->setIndexViewData();
        
		$this->loadModel('JobSelectTarget');
		$this->loadModel('SelStat');
		$this->loadModel('ScreeningStage');

        $condtions = $this->SelHistory->JobVote->getListDefaultConditions();
        $jobVotes = $this->SelHistory->JobVote->find('list', $condtions);


        $condtions = $this->ScreeningStage->getListDefaultConditions();
        $screeningStages = $this->ScreeningStage->find('list', $condtions);

        $selectJudgmentType = $this->getSystemConfig("select_judgment_type");
        $change_status_history = $this->getSystemConfig("change_status_history");
        $this->set( 'change_status_history', $change_status_history );

        if ( !empty( $jobVotes ) ){
		    $firstData['jobVotes'] = min(array_keys( $jobVotes ));
		}else{
		     $firstData['jobVotes'] = null;
		}
		
		$firstData['screeningStages'] = min(array_keys( $screeningStages ));
		$firstData['selectJudgmentType'] = min(array_keys( $selectJudgmentType ));
        $this->set('firstData', $firstData);

	    $this->request->query = $this->getIndexDefaultData( $firstData );

	    $cond['conditions'] = $this->SelHistory->getIndexSearch( $this->request->query );
	    $cond['recursive'] = 2;
		$this->SelHistory->recursive = -1;
        
        $cond['contain']= array( 'CanCandidate'=>array('RefererCompany'),'SelRecruiterHistory','ScreeningStage');
        

        $this->set( 'summaryData', $this->getSummary() );

        $this->set( 'screeningStages', $screeningStages );

        $this->set('jobVotesName', $this->SelHistory->JobVote->getName( $this->request->query['job_vote_id'] ));
        
        $this->Paginator->settings = $cond;

		SessionComponent::write('SearchCondition', $this->request->query);
        
		$this->set('selHistories', $this->Paginator->paginate('SelHistory'));




	}


    /**
     * 
     * 選考管理　選考一覧　選考履歴サマリ
     * 
     * @params int
     * 
     **/
    public function summary( $jobvote_id = 0, $screening_stage_id =0, $select_status_id =0 )
    {   
        $this->loadModel('SelStat');
        
        //データの存在チェック（０件の場合は処理する必要がないので）
        if ( !$this->SelStat->isData( $jobvote_id, $screening_stage_id, $select_status_id ) )
        {
            //indexにリダイレクト
            $this->redirect('index');
        }
        
        //候補者の抽出をしやすいようにする。（indexと同じようにする）
        //求人票ID、選考段階ID、選考ステータス（マスタ）
        //候補者IDを取得する
        
        $data = new stdClass();
        
        $data->job_vote_id = $jobvote_id;
        $data->screening_stage_id = $screening_stage_id;
        $data->select_status_id = $select_status_id;

        $subquery = $this->SelHistory->getSummaryIndexConditons( $data );
        
        //利用する値の共通化
        $this->setIndexViewData(true);
        
        $this->loadModel('JobSelectTarget');
        $this->loadModel('selStat');
        $cond['conditions'] = $subquery;
        $cond['recursive'] = 2;
        $this->SelHistory->recursive = -1;
        
        $cond['contain']= array( 'CanCandidate'=>array('RefererCompany'),'SelRecruiterHistory','ScreeningStage');
        
        $this->set('jobVotesName', $this->SelHistory->JobVote->getName( $jobvote_id ));
        
        $this->Paginator->settings = $cond;
        
        $this->set( 'summaryData', $this->getSummary() );

        $this->set('selHistories', $this->Paginator->paginate());
    
        $this->render('index');
    
    }
    
    /**
     * 
     * setIndexViewData
     * Indexページで利用するデータをセットする
     * 
     * 
     **/
    private function setIndexViewData( $isSummary = false)
    {
    
        //利用する値の共通化
        $condtions = $this->SelHistory->JobVote->getListDefaultConditions();
        $jobVotes = $this->SelHistory->JobVote->find('list', $condtions);
        $condtions = $this->SelHistory->ScreeningStage->getListDefaultConditions();
        $screeningStages = $this->SelHistory->ScreeningStage->find('list', $condtions);
        $screeningStages_array = $this->SelHistory->ScreeningStage->find('all', $condtions);

        $stage_array = $this->SelHistory->getStageDataSort( $screeningStages_array );

        //設定値
        $selectJudgmentType = $this->getSystemConfig("select_judgment_type");
        $selectOption = $this->getSystemConfig("select_option");

        $open_propriety = $this->getSystemConfig("open_propriety");
        
        //流入元企業ID
        $this->loadModel("RefererCompany");
        $refererCompanies = $this->RefererCompany->getPullDownList();

        //メールテンプレート
        $this->loadModel( "MailTemplate" );
        $mailtmp = $this->MailTemplate->getPullDownList();

        $open_propriety = $this->getSystemConfig("open_propriety_search");

        $select_judgment_type_history = $this->getSystemConfig("select_judgment_type_history");

        $check_select = $this->getSystemConfig("check_select");

        $change_status_history = $this->getSystemConfig("change_status_history");


        $this->set(compact('selStatuses', 'jobVotes', 'canCandidates', 'screeningStages', 'selectJudgmentType',
                           'selectOption', 'open_propriety','refererCompanies', 'select_judgment_type_history',
                           'check_select', 'mailtmp','stage_array','change_status_history'
                           ));
                           
        if ( $isSummary === false ) return;
        
		$this->loadModel('JobSelectTarget');
		$this->loadModel('selStat');

        $condtions = $this->SelHistory->JobVote->getListDefaultConditions();
        $jobVotes = $this->SelHistory->JobVote->find('list', $condtions);

        $condtions = $this->SelHistory->ScreeningStage->getListDefaultConditions();
        $screeningStages = $this->SelHistory->ScreeningStage->find('list', $condtions);

        $selectJudgmentType = $this->getSystemConfig("select_judgment_type");

		        
        $this->request->query['job_vote_id'] = null;
        $this->request->query['screening_stage_id'] = null;
        $this->request->query['select_status_id'] = null;
        $this->request->query['referer_company_id'] = null;
        $this->request->query['start_date'] = null;
        $this->request->query['end_date'] = null;
        $this->request->query['influx_propriety'] = null;
        $this->request->query['candidate_propriety'] = null;
    }
    

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
        
        
		if (!$this->SelHistory->isUses($id)) {
			throw new NotFoundException(__('Invalid sel history'));
		}

		//編集可能なのかを確認する。該当IDがedit可能な場合にはeditに遷移させる
		if ( $this->SelHistory->isEdit( $id ) ) $this->redirect( array ( 'controller'=>'Selhistories','action'=>'edit',$id));


		//表示用・編集用データのセットをする
		$this->setViewEditData( $id );
        $this->set( 'select_judgment_type', $this->getSystemConfig("select_judgment_type") );
        $this->set( 'last_modified_type', $this->getSystemConfig("last_modified_type") );
        $this->set( 'evaluation_rank', $this->getSystemConfig('evaluation_rank') );
		$this->set( 'job_type', $this->getSystemConfig( 'job_type' ) );
        $this->set( 'business', $this->getSystemConfig( 'business' ) );  
        $this->set( 'market', $this->getSystemConfig( 'market' ) );
        $this->set( 'scr_order', 0 );

        //ロールによるviewの出力変更処理
        switch ( SessionComponent::read('Auth.User.role_type') ){
            case ROLE_TYPE_RECRUITER:   //採用担当者
                $this->render( $this->getRenderViewName() );
                break;
            case ROLE_TYPE_REFERER:   //採用担当者
                $this->render( $this->getRenderViewName() );
                break;
            default:    //上記のロール以外はアクセスする権利がないので強制終了
                throw new NotFoundException(__('not access authorizations'));
        }
	}

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id    選考履歴ID
     * @return void
     */
    public function edit($id = null) {
        
        //作成変更（このメソッドでは、候補者の選考履歴を編集する機能に特化する）
        //面接官の追加については、別のメソッドで行い、このメソッドへリダイレクトする。
        
        //ロールによる動作変更
        switch ( SessionComponent::read('Auth.User.role_type') ){
            case ROLE_TYPE_RECRUITER:   //採用担当者
                break;
            default:
                return $this->redirect( array( 'action'=>'view', $id ) );
        }
        
        //編集が可能なのかを判断する
        if ( !$this->SelHistory->isEdit( $id ) ) return $this->redirect( array( 'action'=>'view', $id ) );
        
        $this->loadModel( 'ScreeningStage' );

        //選考段階の取得
        $condtions = $this->ScreeningStage->getListDefaultConditions();
        $screeningStages = $this->ScreeningStage->find('list', $condtions);
        $firstData['screeningStages'] = min(array_keys($screeningStages));
        $this->set('firstData', $firstData);
        
        //保存データが飛んできたときの処理
        if ($this->request->is(array('post', 'put'))) {
            
            $data = $this->request->data;
            $data['SelHistory']['start_date'] = sprintf( "%s %s",$data['SelHistory']['start_date'],$data['SelHistory']['start_time'] );
            $data['SelHistory']['end_date'] = sprintf( "%s %s",$data['SelHistory']['end_date'],$data['SelHistory']['end_time'] );

            $data['SelHistory']['influx_propriety'] = isset($data['SelHistory']['influx_propriety'] ) ? 1:0;
            $data['SelHistory']['candidate_propriety'] = isset($data['SelHistory']['candidate_propriety'] ) ? 1:0;

            unset( $data['SelHistory']['start_time'] );
            unset( $data['SelHistory']['end_time'] );
            
            $this->request->data = $data;
            
            //合格ステータスの時には、選考履歴を作成する。ただし、最終選考以外に限る
            if( $data['SelHistory']['select_status_id'] == 5 )
            {   
                if (! $this->ScreeningStage->isLast( $data['SelHistory']['screening_stage_id'] ) )
                {
                    //次の選考段階IDの取得
                    $nextId = $this->ScreeningStage->getNextStageId( $data['SelHistory']['screening_stage_id'] );
                    $newData = $this->SelHistory->getInitData( $data, $nextId );
                    
                    $this->request->data = array($data, $newData );
                }
            }
            
            if ( $this->SelHistory->saveAll( $this->request->data )) {
                $this->Session->setFlash('選考履歴の更新が完了しました。');
                return $this->redirect( array( 'action'=>'view', $id ) );
            }
        }
        
        //入力データと取得したデータをマージする。
        $options = array('conditions' => array('SelHistory.' . $this->SelHistory->primaryKey => $id));
        $data = $this->SelHistory->find('first', $options);
        $this->request->data = array_replace_recursive( $data , $this->request->data );
        
        //利用可能な選考ステータスの作成に必要な情報をセットする
        $this->setSelectJudgmentType();
        
        //表示用・編集用データのセットをする
        $this->setViewEditData( $id );

        $this->set( 'evaluation_rank', $this->getSystemConfig('evaluation_rank') );
        $this->set( 'job_type', $this->getSystemConfig( 'job_type' ) );
        $this->set( 'business', $this->getSystemConfig( 'business' ) );  
        $this->set( 'market', $this->getSystemConfig( 'market' ) );
        $this->set( 'scr_order', 0 );
        $this->set( 'rec_company_id', $this->getUserCompanyId() );

        //ロールによるviewの出力変更処理
        switch ( SessionComponent::read('Auth.User.role_type') ){
            case ROLE_TYPE_RECRUITER:   //採用担当者
                $this->render( $this->getRenderViewName() );
                break;
            default:    //上記のロール以外はアクセスする権利がないので強制終了
                throw new NotFoundException(__('not access authorizations'));
        }
    }
    
    /**
     * 
     * 面接官の追加処理
     * 
     * @param id
     * 
     **/
    public function addInterviewer( $id )
    {
        //ロールによる動作変更
        switch ( SessionComponent::read('Auth.User.role_type') ){
            case ROLE_TYPE_RECRUITER:   //採用担当者
                break;
            default:
                return $this->redirect( array( 'action'=>'view', $id ) );
        }
        
        //編集が可能なのかを判断する
        if ( !$this->SelHistory->isEdit( $id ) ) return $this->redirect( array( 'action'=>'view', $id ) );
        
        //面接官の保存をする。
        $this->loadModel('SelRecruiterHistory');

        if ($this->request->is(array('post', 'put'))) {
            unset(  $this->request->data["rec_department"] );
            unset(  $this->request->data["rec_department_child1"] );
            unset(  $this->request->data["rec_department_child2"] );
        
            $this->SelRecruiterHistory->create();
            
            if ( $this->SelRecruiterHistory->save( $this->request->data ) ){
                $this->Session->setFlash('採用担当者の追加が完了しました。');
            }
        }
        
        return $this->redirect( array( 'action'=>'view', $id ) );
        
    }
    
    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
	public function delete($id = null) {
        if (!$this->SelHistory->exists($id)) {
            throw new NotFoundException(__('Invalid sel history'));
        }

        //飛んできたIDの選考履歴の一つ前の選考履歴の選考ステータスをペンディングに変更
        if ( $this->SelHistory->deleteHistory( $id ) ) {
            $this->flash(__('The sel history has been deleted.'), array( 'action' => 'view', $id ) );
            return $this->redirect( array( 'action'=>'index') );
        }
        // echo 'delete'; exit;
        


		$this->SelHistory->id = $id;
		if (!$this->SelHistory->exists()) {
			throw new NotFoundException(__('Invalid sel history'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->SelHistory->delete()) {
			return $this->flash(__('The sel history has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The sel history could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}

/**
* 選考状況確認(選考履歴サマリ)
* 
**/
	public function getSelHistSummary() 
	{	

        $rec_company_id = $this->getUserCompanyId();

        $year = $this->getWantedYear();

        if( empty( $year ) || empty( $rec_company_id ) ) {
            $this->ErrorJson();
        } 

	
		$this->loadModel('ScreeningStage');        
		$this->loadModel('JobSelectTarget');
		$this->loadModel('selStat');

        $data['year'] = $year;

        $screening_stage = $this->ScreeningStage->getScreeningStage( $rec_company_id );
		$target_number = $this->JobSelectTarget->getTargetNumber( $rec_company_id, $data );
		$real_numner = $this->selStat->getRealNumber( $rec_company_id );

		$result = $this->trimSelHistSummary( $target_number, $real_numner );

        return $result;

		$this->renderJson( $result );



	}

    /**
* 選考状況確認(選考履歴サマリ)
* 
**/
    public function getSummary() 
    {   

        $rec_company_id = $this->getUserCompanyId();
        $year = $this->getWantedYear();

        $this->loadModel( 'ScreeningStage' );

        $condtions = $this->ScreeningStage->getScreeningStage();
        $screening_stages = $this->ScreeningStage->find('all', $condtions);


        if( empty( $year ) || empty( $rec_company_id ) ) return $this->trimStage( $screening_stages ); 

        $this->loadModel('JobSelectTarget');
        $this->loadModel('SelStat');

        $data['year'] = $year;


        $target_number = $this->JobSelectTarget->getTargetNumber( $rec_company_id, $data );
        $real_numner = $this->SelStat->getRealNumber( $rec_company_id );

        $result = $this->trimSelHistSummary( $screening_stages, $target_number, $real_numner );

        $selectJudgmentType = $this->getSystemConfig("select_judgment_type");
        $this->set( "select_judgment_type", $selectJudgmentType );

        $screening_stage_type = $this->getSystemConfig("screening_stage_type");
        $this->set( "screening_stage_type", $screening_stage_type );

        return $result;



    }



/**
* 選考履歴サマリの実数をクリックした際に取得する選考履歴情報
* 
**/
	public function getSelHistory() 
	{
		
		$rec_company_id = $this->getUserCompanyId();
        $year = $this->getWantedYear();
        $data = $this->request->query;

        if( empty( $year ) || 
         empty( $data['job_vote_id'] ) || 
         empty( $data['screening_stage_id'] ) || 
         empty( $data['select_status_id'] ) || 
         empty( $rec_company_id ) ) {
            $this->ErrorJson();
        } 


        $data['year'] = $year;

        SessionComponent::write('SearchCondition', $data);

        $list = $this->getCandidateList( $data );

        $list = $this->trimCandidateList( $list );

        $this->renderJson( $list );

	}


/**
* 選考履歴と採用担当者選考履歴と候補者情報のリスト取得
* 
* 
**/
	public function getHistCandidate()
	{

		$rec_company_id = $this->getUserCompanyId();
        $year = $this->getWantedYear();

        if( !empty( $this->request->query( 'rec_recruiter_id' ) ) ){
            $data['rec_recruiter_id'] = $this->request->query( 'rec_recruiter_id' );
        }

        if( empty( $year ) || empty( $rec_company_id ) ) {
            return false;
        } 

		$data['year'] = $year;

		$result = $this->SelHistory->getSelHistCandidate( $rec_company_id, $data );

        $past = $this->SelHistory->getPastSelHist( $result );

		$trim_result = $this->trimSelHistCandidate( $result, $past );

		return $trim_result;

	}

/**
* イベント評価後スコア別 候補者×選考履歴リストアップ
* 
**/
	public function getHistCandidateByEvScore()
	{
		$rec_company_id = $this->getUserCompanyId();
		$year = $this->getWantedYear();

		$data['ev_event'] = $this->request->query['ev_event'];
        $data['after_score'] = $this->request->query['after_score'];
        $data['sel_check'] = $this->request->query['sel_check'];


        if( empty( $year ) || !isset( $data['ev_event'] ) ||
            !isset( $data['after_score'] )|| !isset( $data['sel_check'] ) || 
            empty( $rec_company_id ) ) {
            return false;
        } 

        if( !preg_match('/^[0,1,2,9]$/', $data['after_score']) ) {
            return false;   
        }

        $this->loadModel('CanCandidate');

		$data['year'] = $year;


		$result = $this->CanCandidate->getHistByEvScore( $rec_company_id, $data );

		$trim_result = $this->trimHistCandidateByEvScore( $result );



        return $trim_result;

	}

    /**
* イベント評価後スコア別 候補者×選考履歴リストアップ
* 
**/
    public function getHistCandidateByEvScoreAPI()
    {
        $rec_company_id = $this->getUserCompanyId();
        $year = $this->getWantedYear();

        $data['ev_event'] = $this->request->query['ev_event'];
        $data['after_score'] = $this->request->query['after_score'];
        $data['sel_check'] = $this->request->query['sel_check'];


        if( empty( $year ) || !isset( $data['ev_event'] ) ||
            !isset( $data['after_score'] )|| !isset( $data['sel_check'] ) || 
            empty( $rec_company_id ) ) {
            return false;
        } 

        if( !preg_match('/^[0,1,2,9]$/', $data['after_score']) ) {
            return false;   
        }

        $this->loadModel('CanCandidate');

        $data['year'] = $year;


        $result = $this->CanCandidate->getHistByEvScore( $rec_company_id, $data );

        $trim_result = $this->trimHistCandidateByEvScore( $result );



        if( isset( $data['ev_event'] ) ){
            $this->set('ev_event',$data['ev_event']);
        }

        if( isset( $data['after_score'] ) ){
            $this->set('after_score',$data['after_score'] );
        }

        if( isset( $data['sel_check'] ) ){
            $this->set( 'sel_check', $data['sel_check'] );
        }



      $this->loadModel('ScreeningStage');
      $this->loadModel('EvEvent');


       $conditions = array( 
                'conditions' => array( 'ScreeningStage.rec_company_id' => $rec_company_id,
                                       'ScreeningStage.status' => 0
                                     ),
                'recursive' => -1,
                'fields' => array( 'name' )
             );
        $screening_stage = $this->ScreeningStage->find('list', $conditions );

      $conditions = array( 
            'recursive'=>-1,
            'fields'=>array('name'),
            'conditions' => array( 
                'EvEvent.rec_company_id' => $rec_company_id, 
                'EvEvent.status' => 1
                ) 
            );

        $evEvents = $this->EvEvent->find( 'list', $conditions );
        $ev_first = $this->EvEvent->find( 'first', $conditions );

        $evHistory = $this->getSystemConfig( 'after_score' );
        $select_status_id = $this->getSystemConfig('select_judgment_type');

        $this->set(compact('evEvents'));
        $this->set(compact('evHistory'));
        $this->set( 'screening_stages', $screening_stage );
        $this->set( 'ev_first', $ev_first );
        $this->set( 'select_status_id', $select_status_id );
        $this->set( 'evScore', $trim_result );




        $this->render('/Elements/HistCandidateByEvScore', false );
        $this->response->type('json');
        $this->response->body(json_encode(array(
            'html' => $this->response->body()
        )));
        return $this->response;

    }

    


/**
* 採用担当者別 最終選考率リスト
* 
* @param  int $year
* 
**/
	public function getLastSelRate()
	{
		$rec_company_id = $this->getUserCompanyId();
		$year = $this->getWantedYear();

        if( empty( $year ) || empty( $rec_company_id ) ) {
            return false;
        } 

        $this->loadModel('SelStat');

		$data['year'] = $year;

		$result = $this->SelStat->getLastSelRate( $rec_company_id, $data );

		$trim_result = $this->trimLastSelRate( $result );

        return $trim_result;

	}


    /*
    * ステータスの変更処理をするApi
    *
    */
    public function status_update() {

    	// ロールのチェック
		$this->checkErrorJson((!$this->isRecruiter() && !$this->isInterviewer()));
    	// リクエストのエラーチェック
		$this->checkErrorJson((empty($this->request->data['sel_history_id']) || empty($this->request->data['select_status_id'])));

        $sel_history_id = $this->request->data['sel_history_id'];
        $select_status_id = $this->request->data['select_status_id'];
        $pass_status = 5; // 合格ステータス

		// 該当データを取得
    	$options['recursive'] = -1;
    	$options['conditions'] = array('id' => $sel_history_id);
    	$selHistories = $this->SelHistory->find('all', $options);

        // 一括更新
        $res = $this->SelHistory->updateStatusBulk($selHistories, $select_status_id);

        // 返却
        $this->renderJson($res);
    }

    /*
    * ステータスの変更処理を一括でするApi（検索条件から）
    *
    */
    public function status_update_search() {

        // エラーチェック
        // ロールのチェック
        $this->checkErrorJson((!$this->isRecruiter() && !$this->isInterviewer()));
        // リクエストデータの存在チェック
        $this->checkErrorJson(empty($this->request->data['select_status_id']));
        $select_status_id = $this->request->data['select_status_id'];

        // 面接官は不合格及び内定辞退のステータスには変更できない
        if ($this->isInterviewer() && ( $select_status_id == 6 || $select_status_id == 7)){
            $this->checkErrorJson(true);
        }

        // 検索項目の抽出
        $this->loadModel('MlSendHistory');
        $option = SessionComponent::read('SearchCondition');
        $option = $this->MlSendHistory->setSearchCondition($option);
        $this->SelHistory->recursive = -1;
        $this->SelHistory->virtualFields['sel_history_id'] = 'SelHistory.id';
        $selHistories = $this->SelHistory->find('all', $option);

        if (empty($selHistories)){
            $this->checkErrorJson(true);
        }
        // 一括更新
        $res = $this->SelHistory->updateStatusBulk($selHistories, $select_status_id);

        // 返却
        $this->renderJson($res);
    }

    /*
    * ステータスの変更処理を一括でするApi(サマリから)
    *
    */
    public function status_update_summary() {

        // ロールのチェック
        $this->checkErrorJson((!$this->isRecruiter() && !$this->isInterviewer()));
        // リクエストデータの存在チェック
        $this->checkErrorJson(empty($this->request->data['select_status_id']));
        $select_status_id = $this->request->data['select_status_id'];

        // 面接官は不合格及び内定辞退のステータスには変更できない
        if ($this->isInterviewer() && ( $select_status_id == 6 || $select_status_id == 7)){
            $this->checkErrorJson(true);
        }

        // 検索項目の抽出
        $sumQuery = SessionComponent::read('SearchCondition');
        // 候補者IDの抽出
        $this->loadModel('SelStatChild');
        $candidates = $this->SelStatChild->getCandidateIdBySummary( $sumQuery );
        foreach( $candidates as $key => $value ){
            $candidateList[] = $value['sel_stat_children']['can_candidate_id'];
        }
        $this->loadModel('CanSelJob');
        $options['contain'] = array('SelHistory');
        $options['conditions'] = array('CanSelJob.can_candidate_id' => $candidateList);
        $options['recursive'] = -1;
        $selHistories = $this->CanSelJob->find('all', $options);


        if (empty($selHistories)){
            $this->checkErrorJson(true);
        }
        // 一括更新
        $res = $this->SelHistory->updateStatusBulk($selHistories, $select_status_id);

        // 返却
        $this->renderJson($res);
    }

    /**
    * 選考履歴を削除するAPI
    *
    */
    public function delete_history() {

    	// ロールのチェック
    	$this->checkErrorJson(!$this->isRecruiter());

    	// リクエストパラメータの存在チェック
		$this->checkErrorJson(empty($this->request->data['id']));
		// 削除
    	$res = $this->SelHistory->deleteHistory($this->request->data['id']);
		$this->checkErrorJson(!is_array($res));

    	$this->renderJson($res);
    	exit;
    }


    /**
    * 候補者公開ステータス変更API(id指定)
    *
    */
    public function update_propriety_candidate(){

        // リクエストパラメータのチェック
        $this->checkErrorJson((empty($this->request->data['sel_history_id']) ||
                               !isset($this->request->data['candidate_propriety'])));
        // ロールチェック
        $this->checkErrorJson(!$this->isRecruiter());
        
        $templateId = 1; // システムテンプレートID固定
        $selHistoryIds = $this->request->data['sel_history_id'];
        $propriety = $this->request->data['candidate_propriety'];
        // 更新処理
        $this->updateProprietyByIds($selHistoryIds, $propriety, $templateId, 'candidate_propriety');

        $this->noResJSon();

    }

    /**
    * 候補者公開ステータス変更API(サマリー指定)
    *
    */
    public function update_propriety_candidate_summary(){

        // リクエストパラメータのチェック
        $this->checkErrorJson(!isset($this->request->data['candidate_propriety']));
        // ロールチェック
        $this->checkErrorJson(!$this->isRecruiter());
        
        $templateId = 1; // システムテンプレートID固定
        $propriety = $this->request->data['candidate_propriety'];

        // 更新処理
        $this->updateProprietyBySummary($propriety, $templateId, 'candidate_propriety');

        $this->noResJSon();

    }

    /**
    * 候補者公開ステータス変更API(SQL指定)
    *
    */
    public function update_propriety_candidate_all(){

        // リクエストパラメータのチェック
        $this->checkErrorJson(!isset($this->request->data['candidate_propriety']));
        // ロールチェック
        $this->checkErrorJson(!$this->isRecruiter());

        $templateId = 1; // システムテンプレートID固定
        $propriety = $this->request->data['candidate_propriety'];

        // 更新処理
        $this->updateProprietyBySearch($propriety, $templateId, 'candidate_propriety');

        $this->noResJSon();

    }


    /**
    * 流入元公開ステータス変更API(id指定)
    *
    */
    public function update_propriety_influx(){

        // リクエストパラメータのチェック
        $this->checkErrorJson((empty($this->request->data['sel_history_id']) ||
                               !isset($this->request->data['influx_propriety'])));
        // ロールチェック
        $this->checkErrorJson(!$this->isRecruiter());

        $templateId = 2; // システムテンプレートID固定
        $selHistoryIds = $this->request->data['sel_history_id'];
        $propriety = $this->request->data['influx_propriety'];

        // 更新処理
        $this->updateProprietyByIds($selHistoryIds, $propriety, $templateId, 'influx_propriety');

        $this->noResJSon();

    }

    /**
    * 候補者公開ステータス変更API(サマリー指定)
    *
    */
    public function update_propriety_influx_summary(){

        // リクエストパラメータのチェック
        $this->checkErrorJson(!isset($this->request->data['influx_propriety']));
        // ロールチェック
        $this->checkErrorJson(!$this->isRecruiter());
        
        $templateId = 2; // システムテンプレートID固定
        $propriety = $this->request->data['influx_propriety'];

        // 更新処理
        $this->updateProprietyBySummary($propriety, $templateId, 'influx_propriety');

        $this->noResJSon();

    }

    /**
    * 流入元公開ステータス変更API(SQL指定)
    *
    */
    public function update_propriety_influx_all(){

        // リクエストパラメータのチェック
        $this->checkErrorJson(!isset($this->request->data['influx_propriety']));
        // ロールチェック
        $this->checkErrorJson(!$this->isRecruiter());

        $templateId = 2; // システムテンプレートID固定
        $propriety = $this->request->data['influx_propriety'];

        // 更新処理
        $this->updateProprietyBySearch($propriety, $templateId, 'influx_propriety');

        $this->noResJSon();
    }

    /* =*-*=*-*=*-*=*-*=*-*=*-* 以下 private =*-*=*-*=*-*=*-*=*-*=*-*=*-*=*-* */

    /**
    * IDでの更新処理
    * @param mixed  selHistoryIds
    * @param int    propriety
    * @param int    templateId
    * @param string name
    *
    **/
    private function updateProprietyByIds($selHistoryIds, $propriety, $templateId, $name){

        if (!is_array($selHistoryIds)){
            $selHistoryIds = array($selHistoryIds);
        }
        $this->loadModel('MlSendHistory');

        foreach ($selHistoryIds as $selHistoryId) {
            // 更新およびメール送信処理
            $this->update_propriety($selHistoryId, $templateId, $propriety, $name);
        }
    } 
    
    /**
    * IDでの更新処理
    * @param int    propriety
    * @param int    templateId
    * @param string name
    *
    **/
    private function updateProprietyBySearch($propriety, $templateId, $name){

        $this->loadModel('MlSendHistory');

        $option = SessionComponent::read('SearchCondition');
        $option = $this->MlSendHistory->setSearchCondition($option);
        $this->SelHistory->recursive = -1;
        $this->SelHistory->virtualFields['sel_history_id'] = 'SelHistory.id';
        $selHistories = $this->SelHistory->find('all', $option);

        foreach ($selHistories as $selHistory) {
            // 更新およびメール送信処理
            $this->update_propriety($selHistory['SelHistory']['id'], $templateId, $propriety, $name);
        }
    } 

    /**
    * IDでの更新処理
    * @param int    propriety
    * @param int    templateId
    * @param string name
    *
    **/
    private function updateProprietyBySummary($propriety, $templateId, $name){

        $sumQuery = SessionComponent::read('SearchCondition');

        // 候補者IDの抽出
        $this->loadModel('SelStatChild');
        $candidates = $this->SelStatChild->getCandidateIdBySummary( $sumQuery );
        foreach( $candidates as $key => $value ){
            $candidateList[] = $value['sel_stat_children']['can_candidate_id'];
        }

        $this->loadModel('CanSelJob');
        $options['fields'] = array('sel_history_id', 'can_candidate_id');
        $options['conditions'] = array('can_candidate_id' => $candidateList);
        $options['recursive'] = -1;
        $selHistories = $this->CanSelJob->find('all', $options);

        $this->loadModel('MlSendHistory');

        foreach ($selHistories as $selHistory) {
            // 更新およびメール送信処理
            $this->update_propriety($selHistory['CanSelJob']['sel_history_id'], $templateId, $propriety, $name);
        }
    } 

/**
* 公開ステータスの更新及びメール送信の実処理
* @param integer selHistoryId
* @param integer templateId
* @param integer propriety
* @param string proprietyName
*/
    private function update_propriety($selHistoryId, $templateId, $propriety, $proprietyName) {

        // ステータスの更新
        $options = $this->setCandidateOptions($selHistoryId);
        $selHistory = $this->SelHistory->find('first', $options);

        // 企業IDチェック
        $this->checkErrorJson($selHistory['CanCandidate']['rec_company_id'] != $this->getLoginUser('rec_company_id'));

        $selHistory['SelHistory'][$proprietyName] = $propriety;

        $this->SelHistory->save($selHistory);


        // アラートメール送信
        $this->MlSendHistory->sendSystemMail($selHistoryId, $templateId);

    }


/**
* 候補者公開ステータス更新時の選考データの抽出条件設定
* @param integer id
* @return mixed
*/
    private function setCandidateOptions($id){

		$options['conditions'] = array('SelHistory.id' => $id);
		$options['fields'] = array(
			'SelHistory.id',
			'CanCandidate.id',
			'CanCandidate.rec_company_id',
		);
		$options['contain'] = array('CanCandidate'); 

    	return $options;
    }


/**
* 選考履歴サマリの実数をクリックした際に取得する選考履歴情報
* 
* @param  array  $year
* @return array  $list
* 
**/
	private function getCandidateList( $year ) 
	{
		$this->loadModel('CanSelJob');
		$this->loadModel('SelStatChild');

		$list = $this->SelStatChild->getCandidateIdBySummary( $year );

		foreach( $list as $key => $value ){
			$array[] = $value['sel_stat_children']['can_candidate_id'];
		}

		$list = $this->SelHistory->getSelHistoryByCandidate( $array );
		return $list;

	}




/**
* 取得したリストをレスポンスの形式に整える
* 選考履歴と採用担当者選考履歴と候補者用
* 
* @param   array  $result
* @param   array  $past
* @return  array  $trim_result
* 
**/
	private function trimSelHistCandidate( $result, $past )
	{
        // print_r($result);
		$trim_result = array(); 
        foreach( $result as $key => $value ) {
            $job_vote_id = $value['job_votes']['id'];
            $can_candidate_id = $value['can_candidates']['id'];
            $recruiter_id = $value['rec_recruiters']['id'];
            $order = $value['screening_stages']['order'];
            $name = $value['can_candidates']['last_name']. 
                    $value['can_candidates']['first_name'];

            $trim_result[$job_vote_id]['name'] = $value['job_votes']['title'];

            if( empty( $trim_result[$job_vote_id][$can_candidate_id] ) ) {
                $trim_result[$job_vote_id][$can_candidate_id] = array( 
                     'name' => $name,
                     'screening_stage_id' => $value['sel_histories']['screening_stage_id'],
                     'screening_stage_name' => $value['screening_stages']['name'],
                     'comment' => $value['sel_histories']['comment'], 
                     'select_status' => $value['sel_histories']['select_status_id'], 
                     'select_option' => $value['sel_histories']['select_option_id'],
                     'start_date' => $value['sel_histories']['start_date'] 
                    );
            }

            if( empty( $trim_result[$job_vote_id][$can_candidate_id]['recruiter'][$recruiter_id] ) ) {
                $trim_result[$job_vote_id][$can_candidate_id]['recruiter'][$recruiter_id]['name'] = $value['rec_recruiters']['recruiter_name'];
                $trim_result[$job_vote_id][$can_candidate_id]['recruiter'][$recruiter_id]['assign_situation_id'] = 
                                                                        $value['sel_recruiter_histories']['assign_situation_id'];
            }

        }
        foreach ($past as $key => $value) {
            $jobvote_id = $value['SelHistory']['job_vote_id'];
            $id = $value['SelHistory']['can_candidate_id'];
            $screening_stage_id = $value['SelHistory']['screening_stage_id'];

            $trim_result['past'][$jobvote_id][$id][$screening_stage_id] = array( 
                        'comment' => $value['SelHistory']['comment'],
                        'select_status_id' => $value['SelHistory']['select_status_id'],
                        'select_option_id' => $value['SelHistory']['select_option_id'],
                 );
            
        }


		return $trim_result;

	}

/**
* 目標数、実数をjsonに変換出来る形に整える
* 
* @param  string  $target_number
* @param  string  $real_number
* @return string  $result 
* 
**/
	private function trimSelHistSummary( $screening_stages, $target_number, $real_number ) 
	{

		$stage_result = $this->trimStage( $screening_stages );
		$target_result = $this->trimTargetNumber( $target_number );
		$real_result = $this->trimRealNumber( $screening_stages, $real_number );

		$result = array( 'screening_stage' => $stage_result, 'target' => $target_result, 'result' => $real_result );


		return $result;
	}

/**
* 選考履歴サマリの実数内訳をリスト化ものをjsonに変換できる形に整える
* 
* @param   array  $list
* @return  array  $result
* 
**/
	private function trimCandidateList( $list )
	{
		$result = array();

		foreach ( $list as $key => $value ) {

			$job_vote_id = $value['sel_histories']['job_vote_id']; 
			$can_candidate_id = $value['sel_histories']['can_candidate_id']; 
			$select_status_id = $value['sel_histories']['select_status_id']; 
			$order = $value['screening_stages']['order'];

			if( empty( $result[$can_candidate_id] ) ) {

				$result[$can_candidate_id]['name'] = $value['can_candidates']['last_name'].
													' '. $value['can_candidates']['first_name'];
			}
			
			$result[$can_candidate_id][$job_vote_id][$order]  =	array(  'name' => $value['job_votes']['title'], 
															'screening_stage_name' => $value['screening_stages']['name'], 
															'start_date' => $value['sel_histories']['start_date'], 
															'end_date' => $value['sel_histories']['end_date'], 
															'count' => $value['0']['count'] 
													 	);
						
		}

		return $result;
	}

/**
* 選考段階をレスポンスの形に整える
* 
* @param  array  $stage
* @return array  $stage_result
**/
	private function trimStage( $stage )
	{
		$stage_result = array();

		foreach ($stage as $key => $value) {
		 	$id = $value['ScreeningStage']['id'];
			
			$stage_result[$id]['name'] = $value['ScreeningStage']['name'];
			$stage_result[$id]['order'] = $value['ScreeningStage']['order'];

		}

		return $stage_result;

	}


/**
* 目標数をjsonに変換出来る形に整える
* 
* @param  string $target_number
* @return string $target_result
* 
* 
**/
	private function trimTargetNumber( $target_number )
	{
		$target_result = array();

		foreach( $target_number as $key => $value  ) {
			$job_vote_id = $value['job_select_targets']['job_vote_id'];
			$job_select_targets = $value['job_select_targets'];
			$screening_stages = $value['screening_stages'];
			$screening_stage_id = $job_select_targets['screening_stage_id'];
			$attain_deadline_date = $job_select_targets["attain_deadline_date"];

			if(  empty( $target_result[$job_vote_id][$screening_stage_id] ) ) {
				$target_result[$job_vote_id][ $screening_stage_id ] = array( "name" => $screening_stages['name'], 
											    "target_select_id" => $job_select_targets["target_select_id"], 
											    "select_judgment_type" => $job_select_targets["select_judgment_type"], 
											    "date" => array() 
										);

			} 

			$target_result[$job_vote_id][ $screening_stage_id ]['date'][$attain_deadline_date] = $job_select_targets['target_number'];

		}


		return $target_result;		

	}

/**
* 実数をjsonに変換出来る形に整える
* 
* @param  array $screening_stage
* @param  array $real_number
* @return array $real_result
* 
* 
**/
	private function trimRealNumber( $screening_stage, $real_number ) 
	{
		$real_result = array();



		foreach( $real_number as $key => $value ) {
			$job_vote_id = $value['sel_stats']['job_vote_id'];
			$screening_stage_id = $value['sel_stats']['screening_stage_id'];
			$select_status_id = $value['sel_stats']['select_status_id'];

			$real_result[$job_vote_id][ $screening_stage_id ][$select_status_id] = $value['sel_stats']['count'];

		}

		return $real_result;

	}

/**
* イベント評価後スコア別　候補者×選考履歴リストアップ用
* レスポンスの形式に整える
* 
* @param   array  $result 
* @return  array  $trim_result
**/	
	private function trimHistCandidateByEvScore( $result )
	{
		$trim_result = array();

		foreach ($result as $key => $value) {
			$can_candidate_id = $value['can_candidates']['id'];
			$job_vote_id = $value['job_votes']['id'];

			$trim_result[$can_candidate_id]['name'] = $value['can_candidates']['last_name']. 
														' '. $value['can_candidates']['first_name'];

			$trim_result[$can_candidate_id][$job_vote_id] = 
											array( 
												'name' => $value['job_votes']['title'],
												'screening_stage_id' => $value['can_sel_job']['screening_stage_id'], 
												'select_status' => $value['can_sel_job']['select_status_id'],
												'after_score' => $value['ev_histories']['after_score'] 
											);
		
		}

		return $trim_result;

	}

	/**
	* 採用担当者別　最終選考通過率
	* レスポンスの形式に整える
	* 
	* @param  array  $result
	* @return array  $trim_result
	* 
	**/
	private function trimLastSelRate( $result )
	{

		$trim_result = array();
		foreach ($result as $key => $value) {
			$rec_recruiter_id = $value['rec_recruiters']['id'];

			$trim_result[$rec_recruiter_id] = array(
					'name' => $value['rec_recruiters']['last_name']. ' '. $value['rec_recruiters']['first_name'],
					'all_count' => $value[0]['all_count'],
					'pass_count' => $value[0]['pass_count'],
					'fail_count' => $value[0]['fail_count'],
					'cancel_count' => $value[0]['cancel_count']
				);

		}

		return $trim_result;


	}
    
    
    /**
     * 
     * indexページで表示する選考段階履歴の取得
     * 
     * 
     * 
     * 
     * 
     **/
    private function getSelHistoriesSummary( $year )
    {

		$this->loadModel('JobSelectTarget');
		$this->loadModel('selStat');

		$rec_company_id = $this->getUserCompanyId();
		
		$target_number = $this->JobSelectTarget->getTargetNumber( $rec_company_id, $this->toYear( $year ) );
		$real_numner = $this->selStat->getRealNumber( $rec_company_id );
		return $this->trimSelHistSummary( $target_number, $real_numner );
	}
    
    /**
     * 
     * getIndexDefaultData
     * 検索の初期データを取得する
     * 
     * @param  array
     * @return array
     **/
    private function getIndexDefaultData( $defaultData = array() )
    {
        $fields = array( "job_vote_id"=>null,
                        "screening_stage_id"=>null,
                         "select_status_id"=>null,  
                         "referer_company_id"=>null,
                         "start_date"=> null,
                         "end_date"=> null,
                         "candidate_propriety"=>null,
                         "influx_propriety"=>null
                         
                    );
        
        $result = array();
        foreach( $fields as $key=>$val)
        {
            if ( isset( $this->request->query[$key] ) )
            {
                $result[$key] = $this->request->query[$key];
                
            }else{
                switch( $key ){
                    case "start_date":
                        $date = date_create();
                        $result[$key] = $this->getIndexDateData( $date );
                        break;
                    case "end_date":
                        $date = date_create();
                        $date = date_add($date , date_interval_create_from_date_string('10 days'));
                        $result[$key] = $this->getIndexDateData( $date );
                        break;
                    
                    case "job_vote_id":
                        $result[$key]=$defaultData['jobVotes'];
                        break;
                    case "screening_stage_id":
                        $result[$key]=$defaultData['screeningStages'];
                        break;
                    
                    case "select_status_id":
                        $result[$key]=$defaultData['selectJudgmentType'];
                        break;
                    default:
                        $result[$key]=$val;
                }
            }
        }
        
        return $result;
    
    }
    
    private function getIndexDateData( $date )
    {
        list($year,$month,$day ) = explode(" ",$date->format("Y m d"));
        
        return $year.'/'.$month.'/'.$day; //array( 'year'=>$year, 'month'=>$month, 'day'=>$day);
        
    }
    
    /**
     * 
     * 表示用・編集用データのセットをする
     * 
     * @param int
     * @return void
     * 
     * 
     **/
    private function setViewEditData( $id )
    {
        
		//表示用・編集用データのセットをする
		$this->SelHistory->recursive = 1;
		$options = array('conditions' => array('SelHistory.' . $this->SelHistory->primaryKey => $id),
		            );
        $selHistory= $this->SelHistory->find('first', $options);
		
		//エリア名称取得
	    $selHistory['JobVote']['recruitment_area_name'] = null;
		if ( !empty( $selHistory['JobVote']['recruitment_area_id'] ) )
		{
		    $area_id =$selHistory['JobVote']['recruitment_area_id'];
		    
		    $this->loadModel('RecruitmentArea' );
		    $area = $this->RecruitmentArea->find('first' ,$selHistory['JobVote']['recruitment_area_id'] );
		    if (isset( $area['RecruitmentArea']['area'] ) ) {
    		    $selHistory['JobVote']['recruitment_area_name'] = $area['RecruitmentArea']['area'];
	        }	            
		}
		
		//選考担当者の名前を取得する。
		$this->loadModel('SelRecruiterHistory');
		$this->SelRecruiterHistory->getRecruterNameArray($selHistory['SelRecruiterHistory']);
        
        //既に面接官のIDを取得する
        $data = $this->SelRecruiterHistory->getRecruterId( $id );
        
        $this->loadModel('RecDepartment');
        $conditions = array( 'conditions' => array( 'RecDepartment.rec_company_id' => $this->getUserCompanyId(),
                                                    'RecDepartment.status' => 0 ) );
        $this->set( 'RecDepartment', $this->RecDepartment->find( 'list', $conditions ) );
		
		//取得した求人票と候補者名がもっている選考履歴を取得する
		//タブのデータ
		$conditions = array( "SelHistory.job_vote_id"=> $selHistory['SelHistory']['job_vote_id'],
		                     "SelHistory.can_candidate_id"=>$selHistory['SelHistory']['can_candidate_id'],
		                     "SelHistory.status" =>0);
		
		$this->SelHistory->recursive = -1;
		$selHistory['tabData'] = $this->SelHistory->find( 'all', 
		                                                  array("conditions"=> $conditions,
		                                                        "contain"   => array("ScreeningStage") ) 
		                                                );
		$this->set('selHistory', $selHistory);
		
		//ユーザー企業情報を取得する。
		$this->loadModel( 'RecCompany' );
		$this->set('RecCompany', $this->RecCompany->getSelfCompanyData( $this->getUserCompanyId() ));

        //自分の企業に属する採用担当者&面接官種痘
        $this->loadModel('RecRecruiter');
        $params['conditions'] = array( 'RecDepartment.rec_company_id' => $this->getUserCompanyId(), 'RecRecruiter.status' => 0 ,'RecRecruiter.id NOT'=>$data );
        $params['recursive'] = 0;
        $params['contain'] = array( 'RecDepartment' );
        
        //すでに面接官になっている人を除外する
        $this->set( 'recRecruiter', $this->RecRecruiter->find( 'list', $params ) );
    }

    /**
     * For api_add method
     * @return array
     * @throws Exception
     */
    public function prepareDataForInsert() {

        $post = $this->request->data;

        $jobVoteId = $post['job_vote_id'];
        $canCandidateId = $post['can_candidate_id'];

        //check candidate_id:status and rec_company_id
        $this->loadModel('CanCandidate');
        if(!$this->CanCandidate->checkRecCompanyId($canCandidateId)){
            throw new Exception('Can Candidate Id not valid');
        }

        //check jobvote_id: status and rec_company_id
        $this->loadModel('JobVote');
        if(!$this->JobVote->checkRecCompanyId($jobVoteId)){
            throw new Exception('JobVote Id not valid');
        }

        //check duplicate job_vote_id and can_candidate_id
        if($this->SelHistory->checkUnique($jobVoteId, $canCandidateId)) {
            throw new Exception('Duplicate data');
        }
        //get screening_stage_id
        $this->loadModel('ScreeningStage');
        $screeningStage = $this->ScreeningStage->getScreeningStageIdByOrder();
        //set initial data
        $post['screening_stage_id'] = $screeningStage['ScreeningStage']['id'];
        $post['select_status_id'] = 0;
        $post['influx_propriety'] = 2;
        $post['candidate_propriety'] = 2;
        $post['last_modified_type'] = 0;


        return $post;

    }

    /**
    * 面接官追加時に必要なデータをセット
    * 
    * @param  array   $data
    * @return array   $setData
    **/
    private function setInsertData( $id, $data )
    {
        $setData['SelRecruiterHistory'] = array(
                'status' => 0,
                'sel_history_id' => $id,
                'rec_recruiter_id' => $data['rec_recruiter'],
                'assign situation_id' => 0
            );

        return $setData;
    }
    
    
    /**
     * 
     * 選考ステータスの取得に必要なデータをセットする
     * 
     * @param void
     * @return void
     * 
     **/
    private function setSelectJudgmentType()
    {
        //現在の選考段階をセットする
        $screening_stage_id = $this->request->data['SelHistory']['screening_stage_id'];
        
        //現在の選考段階が最初？
        $this->set( 'isFirst', $this->ScreeningStage->isFirst( $screening_stage_id ) );

        //現在の選考段階が最後？
        $this->set( 'isLast', $this->ScreeningStage->isLast( $screening_stage_id ) );
        
        //現在のロールが面接官かを判定し、データにセットする
        $this->set('isInterviewer', $this->isInterviewer() );
    
    }
    
   
}
