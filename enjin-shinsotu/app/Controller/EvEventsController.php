<?php
App::uses('AppController', 'Controller');
/**
 * EvEvents Controller
 *
 * @property EvEvent $EvEvent
 * @property PaginatorComponent $Paginator
 */
class EvEventsController extends AppController {


    protected $_model = 'EvEvent';

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

        //設定値
        $type = $this->getSystemConfig("type");
        $selectJudgmentType= $this->getSystemConfig("select_judgment_type");
        $screeningStageType = $this->getSystemConfig("screening_stage_type");
        $evStatus = $this->getSystemConfig("ev_status");
        $this->set(compact('type','selectJudgmentType','screeningStageType','evStatus'));


      switch($this->EvEvent->getUserInfo('role_type') ){
            case ROLE_TYPE_RECRUITER://採用担当者ロール
                $targetDates = $this->getDatePararms();
                
                $prevDates = $targetDates['prev'];
                $nextDates = $targetDates['next'];

                //指定年月の開催が決定しているイベントの取得
                //$eventarray = $this->EvEvent->getEvent($this->EvEvent->getUserInfo('rec_company_id'),$targetDates);
                
                //指定年月の開催が決定しているイベントデータの取得
                $this->loadModel('EvSchedule');
                $rows = $this->EvSchedule->getCalender($targetDates['year'],$targetDates['month']);
                
                //取得したデータに対して不足しているデータをプラスする
                $this->loadModel( 'EvStat' );
                foreach( $rows as & $row )
                {
                    $row['EvStat'] = $this->EvStat->getEventSearchData( $row['EvSchedule']['id']);
                }
                
                //日付のデータが扱いやすいように加工する
                $rows = $this->EvSchedule->setCalender( $rows );
                $this->set("event",  $rows );
                
                //該当月の最終日を算出
                $ymd = sprintf( "%04d-%02d-%02d", $targetDates['year'],$targetDates['month'], 1 );
                $date = date_create( $ymd );
                $this->set("last_day", date_format( $date, "t" ) );
                
                //開催日未定（イベント開催日程のデータが存在しないデータ）を取得する
                $nonEvSchedule=  $this->EvEvent->getEventNotEvSchedule();
                $this->set( 'nonEvSchedules', $nonEvSchedule );
                
                //表記用の設定値の設定
                $calenderHeader = array('日','曜日','イベント名','開始時刻','終了時刻','定員数','申し込み数','申込済','候補者キャンセル','主催者キャンセル','参加済','無断欠席');
                $pendingHeader = array('日','曜日','イベント名','イベント種別','ステータス');

                $this->set(compact('targetDates','prevDates','nextDates','eventarray','calenderHeader','pendingHeader','pendingEvents','weekday'));
                $this->render( $this->getRenderViewName() );
                break;

            default :
                throw new NotFoundException(__('Invalid ev event'));
            break;
        }
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function view($id = null) {
  if (!$this->EvEvent->exists($id)) {
     throw new NotFoundException(__('Invalid ev event'));
 }
 $options = array('conditions' => array('EvEvent.' . $this->EvEvent->primaryKey => $id));
 $this->set('evEvent', $this->EvEvent->find('first', $options));
		//設定値
 $type = $this->getSystemConfig("type");
 $selectJudgmentType= $this->getSystemConfig("select_judgment_type");
 $screeningStageType = $this->getSystemConfig("screening_stage_type");
 $evStatus = $this->getSystemConfig("ev_status");
 $this->set(compact('type', 'selectJudgmentType', 'screeningStageType', 'evStatus'));
}

/**
 * add method
 *
 * @return void
 */
public function add() {

    if ($this->request->is('post')) {
        $this->EvEvent->create();
        $this->request->data['EvEvent']['rec_company_id'] = $this->getUserCompanyId();

        if ($this->EvEvent->save($this->request->data)) {
            $this->Session->setFlash('The ev event has been saved.');
            return $this->redirect(array('action'=>'search'));
        }
    }

    //求人票取得
    $this->set( 'jobVotes', $this->EvEvent->JobVote->getSelectList());

    //選考段階の取得
    $this->loadModel( 'ScreeningStage');
    $this->set( 'ScreeningStages', $this->ScreeningStage->getSelectList() );

    $recCompanies = $this->EvEvent->RecCompany->find('list');
    $screeningStages = $this->EvEvent->ScreeningStage->find('list');

        //設定値
    $type = $this->getSystemConfig("type");
    $selectJudgmentType= array("-1"=>"") + $this->getSystemConfig("select_judgment_type");
    $screeningStageType = $this->getSystemConfig("screening_stage_type");
    $evStatus = $this->getSystemConfig("ev_status");

    $this->set(compact( 'recCompanies', 'jobVotes', 'screeningStages',
                        'type', 'selectJudgmentType', 'screeningStageType', 'evStatus'));

}

/**
 * api_add method
 *
 * @return void
 */
public function api_add() {

    $this->autoRender = false;

    if ($this->request->is('post')) {
        $fields = array('job_vote_id');
        if (!$this->EvEvent->save($this->request->data,false,$fields)) {
            return json_encode(array(
                'status' => false,
                'data'   => $this->request->data,
                'msg'    => 'Error!'
            ));
        }
        $this->EvEvent->recursive = -1;
        $event = $this->EvEvent->findById($this->request->data['id']);
        $data = array(
            'id'=> $event['EvEvent']['id'],
            'name'=>$event['EvEvent']['name'],
        );

        return json_encode(array(
            'status' => true,
            'data' => $data,
            'msg' => 'Success!'
        ));

    }
}

public function api_delete($id = null) {
    $this->autoRender = false;
    if ($this->request->is('get')) {

        if(empty($this->request->query['id'])) {
            return json_encode(array(
                'status' => false,
                'data' => null,
                'msg' => 'Error!'
            ));
        }
        $fields = array('job_vote_id');

        if ($this->EvEvent->save($this->request->query,false,$fields)) {
          return json_encode(array(
              'status' => true,
              'msg' => 'Success'
          ));
        } else {
            return json_encode(array(
                'status' => false,
                'data' => null,
                'msg' => 'Error'
            ));
        }
    }

}


    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->EvEvent->exists($id)) {
        throw new NotFoundException(__('Invalid ev event'));
        }
        if ($this->request->is(array('post', 'put'))) {
        if ($this->EvEvent->save($this->request->data)) {
        return $this->flash(__('The ev event has been saved.'), array('action' => 'index'));
        }
        } else {
        $options = array('conditions' => array('EvEvent.' . $this->EvEvent->primaryKey => $id));
        $this->request->data = $this->EvEvent->find('first', $options);
        }
        $recCompanies = $this->EvEvent->RecCompany->find('list');
        $jobVotes = $this->EvEvent->JobVote->find('list');
        $screeningStages = $this->EvEvent->ScreeningStage->find('list');

        //設定値
        $type = $this->getSystemConfig("type");
        $screeningStageType = $this->getSystemConfig("screening_stage_type");
        $selectJudgmentType= $this->getSystemConfig("select_judgment_type");
        $evStatus = $this->getSystemConfig("ev_status");
        $this->set(compact( 'recCompanies', 'jobVotes', 'screeningStages','type', 'selectJudgmentType', 'screeningStageType', 'evStatus' ));

        //求人票取得
        $this->set( 'jobVotes', $this->EvEvent->JobVote->getSelectList());

        //選考段階の取得
        $this->loadModel( 'ScreeningStage');
        $this->set( 'ScreeningStages', $this->ScreeningStage->getSelectList() );

        $recCompanies = $this->EvEvent->RecCompany->find('list');
        $screeningStages = $this->EvEvent->ScreeningStage->find('list');

            //設定値
        $type = $this->getSystemConfig("type");
        $selectJudgmentType= array("-1"=>"") + $this->getSystemConfig("select_judgment_type");
        $screeningStageType = $this->getSystemConfig("screening_stage_type");
        $evStatus = $this->getSystemConfig("ev_status");

        $this->set(compact( 'recCompanies', 'jobVotes', 'screeningStages',
                            'type', 'selectJudgmentType', 'screeningStageType', 'evStatus'));

    }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function delete($id = null) {
  $this->EvEvent->id = $id;
  if (!$this->EvEvent->exists()) {
     throw new NotFoundException(__('Invalid ev event'));
 }
 $this->request->allowMethod('post', 'delete');
 if ($this->EvEvent->delete()) {
     return $this->flash(__('The ev event has been deleted.'), array('action' => 'index'));
 } else {
     return $this->flash(__('The ev event could not be deleted. Please, try again.'), array('action' => 'index'));
 }
}

    /**
     *
     * イベント一覧
     *
     * イベント一覧を作成する。面倒なのが、カウント処理
     *
     *
     *
     **/
    public function search()
    {

        //固定値の取得
        //イベント種別の取得
        $this->set( 'event_types', $this->getSpaceOption("type") );

        //求人票の取得
        $this->loadModel( 'JobVote' );
        $this->set( 'jobVotes', $this->JobVote->getSelectList() );

        //選考段階の取得
        $this->loadModel( 'ScreeningStage' );
        $this->set( 'ScreeningStages', $this->ScreeningStage->getSelectList( true ) );

        //数量が少ないので、ページングしない
        $this->loadModel('EvSchedule');
        $rows = $this->EvSchedule->getSearchResult( $this->request->query );

        $this->loadModel('EvStat');
        $this->loadModel('EvPersonnel');

        //取得したデータに対して不足しているデータをプラスする
        foreach( $rows as & $row )
        {
            $row['EvStat'] = $this->EvStat->getEventSearchData( $row['EvSchedule']['id']);
            $row['EvPersonnel'] =  $this->EvPersonnel->getEventSearchData( $row['EvEvent']['id']);
        }

        //データ作成完了
        $this->set('evEvents', $rows);

        //初期表示の値をセット
        $this->searchDataClear();

        //初期値のセット
        $this->set("data", $this->request->query );
    }

/**
 * lists method
 * 一覧を取得しJSONにまとめて送る
 *
 * @param void
 * @return void
 */
public function lists() {
    switch($this->EvEvent->getUserInfo('role_type') ){
        case ROLE_TYPE_RECRUITER:
        $userId = $this->EvEvent->getUserInfo('id');
        $findParam = $this->getCommonListPararms('EvEvent');

        $data = $this->EvEvent->getData($userId,$findParam);

        $this->renderJson($data);
        exit;
        default :
        $userCompanyId = $this->getUserCompanyId();
        $findParam = $this->getCommonListPararms('EvEvent');

        $findParam['fields'] =  array('name');
        $findParam['recursive'] = 0;
        $findParam['conditions'] = array("EvEvent.rec_company_id" => $userCompanyId);
        $data = $this->EvEvent->find('list', $findParam );

        $this->renderJson($data);
        exit;
    }
}
    /**
     * パラメータか表示する年月を取得
     *
     * @return array
     */
    public function getDatePararms()
    {
        $targetDates =  array();
        if ( !empty( $this->request->query('year')) ){
            $targetDates['year'] =  (int)$this->request->query('year');
        }else{
            $targetDates['year'] = (int)date('Y');
        }
        if ( !empty($this->request->query('month') ) ){
            $targetDates['month'] = (int)$this->request->query('month');
        }else{
            $targetDates['month'] = (int)date('m');
        }
        switch($targetDates['month']){
            case 1:
            $targetDates['prev'] = array(
                'year' => $targetDates['year'] -1,
                'month' => 12
                );
            $targetDates['next'] = array(
                'year' => $targetDates['year'],
                'month' => $targetDates['month'] + 1
                );
            break;
            case 12:
            $targetDates['prev'] = array(
                'year' => $targetDates['year'],
                'month' => $targetDates['month'] - 1
                );
            $targetDates['next'] = array(
                'year' => $targetDates['year'] + 1,
                'month' => 1
                );
            break;
            default:
            $targetDates['prev'] = array(
                'year' => $targetDates['year'],
                'month' => $targetDates['month'] - 1
                );
            $targetDates['next'] = array(
                'year' => $targetDates['year'],
                'month' => $targetDates['month'] + 1
                );
            break;
        }
        return $targetDates;
    }

    public function getParameterForGetList()
    {
        $conditions = array('EvEvent.status' => 1,
            'EvEvent.rec_company_id' => $this->getUserCompanyId(),
            'RecCompany.status' => 0,
            );
        $this->_model->recursive = 0;

        return array(
            'conditions' => $conditions,
            'fields' => array($this->_model->alias.'.id', $this->_model->alias.'.name'),
        );
    }

    /**
     *
     * 検索の内容をクリアする
     *
     * @param void
     * @return void
     *
     **/
    private function searchDataClear()
    {
        $clearArray = array( "chk_non_sch"=>1,"jobVotes"=>"","year_month_day_from"=>"",
                             "year_month_day_to"=>"","evnt_type"=>"","ScreeningStages"=>"",
                             "mynavi_id"=>"","rikunavi_id"=>"" );

        foreach( $clearArray as $key => $val ){
            if ( !isset( $this->request->query[$key]  ))
            {
                $this->request->query[$key]  = $val;
            }
        }

    }

    public function api_list() {
        $this->autoRender = false;
        if ($this->request->is('get')) {
            $this->EvEvent->recursive = -1;
            $eventLists = $this->EvEvent->find('all',array(
                'fields' => array(
                    'id',
                    'name',
                ),
                'conditions' => array(
                    'EvEvent.status' => array(0,1,2),
                    'EvEvent.job_vote_id'  =>  array(0),
                )
            ));
            if(!empty($eventLists)) {
                $lists = array();
                foreach($eventLists as $key => $list) {
                    $lists[$key]['id'] = $key;
                    $lists[$key]['name'] = $list;
                }
                $this->renderJson($eventLists);
            }else{
                throw new NotFoundException(__('The object is not available'));
            }
        }
    }


    /**
    * イベント情報取得API
    * 
    * @param   int      id
    * @return  response    
    * 
    **/
    public function getDetailAPI( $id = null )
    {
        if( empty( $id ) ) {
            return false;
        }

        $data['rec_company_id'] = $this->getUserCompanyId();
        $data['year'] = $this->getWantedYear();

        if( empty( $data['rec_company_id'] ) || empty( $data['year'] ) ) {
            return false;
        }

        $result = $this->EvEvent->getDetail( $id, $data );

        $this->set( 'eventDetail', $result );

        $this->render('/elements/eventDetail', false );
        $this->response->type('json');
        $this->response->body(json_encode(array(
            'html' => $this->response->body()
        )));
        return $this->response;

    }

    /**
    * イベント情報取得
    * 
    * @param   int      id
    * @return  response    
    * 
    **/
    public function getDetail( $id = null )
    {
        if( empty( $id ) ) {
            return false;
        }

        $data['rec_company_id'] = $this->getUserCompanyId();
        $data['year'] = $this->getWantedYear();

        if( empty( $data['rec_company_id'] ) || empty( $data['year'] ) ) {
            return false;
        }

        $result = $this->EvEvent->getDetail( $id, $data );

        return $result;


    }
}
