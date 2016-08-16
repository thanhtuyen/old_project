<?php
App::uses('AppController', 'Controller');
App::uses('RecDepartment', 'Model');
/**
 * Companies Controller
 *
 * @property Company $Company
 */
class CompaniesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->redirect(array('controller' => 'Companies', 'action' => 'login'));
	}


/**
 * login method
 *
 * @return void
 */
	public function login() {
	    $this->layout = 'login';
        if ($this->request->is('post')) {
            if ( $this->Auth->login() ) {
            	// 企業IDをセッションに追加// add companyID to session
				$this->_setCompanyId();
            	SessionComponent::write('Auth.User.role_type', ROLE_TYPE_RECRUITER);
                $this->_updateLastLoginDate();
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->setFlash(__('メールアドレス、パスワードが不正です。'));
            }
        }
	}


/**
 * dashbord method
 *
 * @return void
 */
	public function dashbord() {
        $this->loadModel('JobVote');
        $this->loadModel('RecDepartment');
        $this->loadModel('RecRecruiter');
        $this->loadModel('EvEvent');
        $this->loadModel('EvHistory');
        $this->loadModel('EvSchedule');
        $this->loadModel('ScreeningStage');

        $rec_company_id = $this->getUserCompanyId();
        $year = $this->getWantedYear();
        $language = $this->getSystemConfig('add_foreign_language');
        $select_status_id = $this->getSystemConfig('select_judgment_type');
        $screening_stage_type = $this->getSystemConfig("screening_stage_type");


        $conditions = array( 
                'conditions' => array( 'ScreeningStage.rec_company_id' => $rec_company_id,
                                       'ScreeningStage.status' => 0
                                     ),
                'recursive' => -1,
                'fields' => array( 'name' )
             );
        $screening_stage = $this->ScreeningStage->find('list', $conditions );

        //イベントリスト
        $conditions = array(
                "conditions" => array( 
                    'EvEvent.rec_company_id' => $rec_company_id, 
                    'EvEvent.status' => 1,
                   'OR' => array( 'JobVote.wanted_year' => $year, 'EvEvent.job_vote_id IS NULL' )
                ),

                "recusive" => 0,
                "contain" => array( 'JobVote' ),
                'fields'=>array('id','name')
            );

        $conditions['joins'][] = array(
                'type' => 'inner',
                'table' => 'ev_schedules',
                'alias' => 'EvSchedule',
                'conditions' => 'EvEvent.id = EvSchedule.ev_event_id'
            );
        $evEvents = $this->EvEvent->find( 'list', $conditions );
        $this->set(compact('evEvents'));

        $jobVotes = $this->JobVote->find('list',array( 
                                'recursive'=>0,
                                'fields'=>array('id','title'),
                                'contain' => array( 'RecDepartment' ), 
                                'conditions' => array( 
                                    'RecDepartment.rec_company_id' => $rec_company_id, 
                                    'JobVote.status' => 0 
                                    ) 
                                ) 
                            );

        $this->set( 'screening_stages', $screening_stage );
        $this->set( "screening_stage_type", $screening_stage_type );
        $this->set( 'language', $language );
        $this->set( 'select_status_id', $select_status_id );
        
        $job_vote_id = '';
        if( !empty( $this->request->query['job_vote_id'] ) ) {
            $job_vote_id = $this->request->query['job_vote_id'];
        }
            $this->set( 'job_vote_id', $job_vote_id );

        $ev_event_id = '';
        if( !empty( $this->request->query['ev_event_id'] ) ) {
            $ev_event_id = $this->request->query['ev_event_id'];
        }
            $this->set( 'ev_event_id', $ev_event_id );

        $ev_score = '0';
        if( !empty( $this->request->query['after_score'] ) ) {
            $ev_score = $this->request->query['ev_event_id'];
        }
            $this->set( 'ev_score', $ev_score );

        /**
        * BLOCK 1
        * array(3) { ["screening_stage"]=> array(0) { } ["target"]=> array(0) { } ["result"]=> array(0) { } }
        **/

        $this->set( 'summaryData', $this->getSummary() );

        $jobVotes = $this->JobVote->find('list',array( 
                                'recursive'=>0,
                                'fields'=>array('id','title'),
                                'contain' => array( 'RecDepartment' ), 
                                'conditions' => array( 
                                    'RecDepartment.rec_company_id' => $rec_company_id, 
                                    'JobVote.status' => 0 
                                    ) 
                                ) 
                            );
        //$dataBlock1 = $this->requestAction('/sel_histories/getSelHistSummary');
        $this->set(compact('jobVotes'));
        //$this->set(compact('dataBlock1'));

        /**
        * BLOCK 2
        * array(2) { ["job_votes"]=> array(0) { } ["events"]=> array(0) { } }
        **/
        $attr_stats = $this->requestAction( '/Companies/getAttributeStats?attr=0' );
        $this->set(compact('attr_stats'));

        /**
        * BLOCK 3
        **/

        //$dataBlock1 = $this->requestAction('/sel_histories/getSelHistSummary');

        //$dataBlock3 = $this->requestAction('/can_candidates/getAttributeStats?attr=education');
        //$this->set(compact('dataBlock3'));

        /**
        * BLOCK 4
        * array(0) { }
        **/
        $assign_situation = $this->getSystemConfig('assign_situation');
        $select_option = $this->getSystemConfig('select_option');

        $recDepartment = $this->RecDepartment->find('list',array( 
                                'recursive'=>-1,
                                'fields'=>array('id','department_name'),
                                'conditions' => array( 
                                    'RecDepartment.rec_company_id' => $rec_company_id, 
                                    'RecDepartment.status' => 0 
                                    ) 
                                ));

                  $conditions = array( 
                                'recursive'=>0,
                                'fields'=>array('name'),
                                'contain' => array( 'RecDepartment' ), 
                                'conditions' => array( 
                                    'RecDepartment.rec_company_id' => $rec_company_id, 
                                    'RecRecruiter.status' => 0,
                                    'RecDepartment.status' => 0 
                                    ) 
                                );
        $this->RecRecruiter->virtualFields['name']='concat( RecRecruiter.last_name, RecRecruiter.first_name )';
        $recRecruiter = $this->RecRecruiter->find('list', $conditions );

        $histCand = $this->requestAction('/sel_histories/getHistCandidate');

        $this->set( 'assign_situation', $assign_situation );
        $this->set( 'select_option', $select_option );


        $this->set(compact('recDepartment'));
        $this->set(compact('recRecruiter'));
        $this->set(compact('histCand'));


        /**
        * BLOCK 5
        * array(0) { }
        **/
      $conditions = array( 
            'recursive'=>-1,
            'fields'=>array( 'id', 'name'),
            'conditions' => array( 
                'EvEvent.rec_company_id' => $rec_company_id, 
                'EvEvent.status' => 1
                ) 
            );
        $evEvents = $this->EvEvent->find( 'list', $conditions );
        $ev_first = $this->EvEvent->find( 'first', $conditions );


        $evHistory = $this->getSystemConfig( 'after_score' );



        $evScore = $this->requestAction( '/sel_histories/getHistCandidateByEvScore?ev_event='.$ev_first['EvEvent']['id'].'&after_score=0&sel_check=0' );
        $this->set( 'ev_first', $ev_first );
        $this->set(compact('evEvents'));
        $this->set(compact('evHistory'));
        $this->set(compact('evScore'));

        /**
        * BLOCK 6
        * array(0) { }
        **/
        $LastSelRate = $this->requestAction('/sel_histories/getLastSelRate');
        $this->set(compact('LastSelRate'));


        /**
        * BLOCK 7
        * array(0) { }
        **/
        $EvHistList = $this->requestAction('/ev_histories/getEvHistList');
        $this->set(compact('EvHistList'));
        /**
        * BLOCK 8
        * array(0) { }
        **/
        $evSchedule = $this->requestAction('/ev_schedules/lists/'.$ev_first['EvEvent']['id'] );
        $ScheduleCandidate = $this->requestAction('/ev_schedules/getScheduleCandidate/'. min( array_keys( $evSchedule ) ) );
        $eventDetail = $this->requestAction('/evEvents/getDetail/'.$ev_first['EvEvent']['id'] );
        $ev_history_status = $this->getSystemConfig('ev_history_status');
        $this->set(compact('evSchedule'));
        $this->set(compact('ScheduleCandidate'));
        $this->set( 'eventDetail', $eventDetail );
        $this->set( 'ev_history_status', $ev_history_status );

        /**
        * BLOCK 9
        * array(0) { }
        **/
        $CapCrackSchedule = $this->requestAction('/EvSchedules/getCapCrackSchedule');
        $this->set(compact('CapCrackSchedule'));


        /**
        * BLOCK 10
        * array(0) { }
        **/
        $RefNumberOfApp = $this->requestAction('/RefererCompanies/getRefNumberOfApp');
        $this->set(compact('RefNumberOfApp'));

        /**
        * BLOCK 11
        * array(0) { }
        **/
        $RecruitCost = $this->requestAction('/JobVotes/getRecruitCost');
        $this->set(compact('RecruitCost'));
        /**
        * BLOCK 12
        * array(0) { }
        **/
        $AllocateList = $this->requestAction('/RefererCompanies/getAllocateList/'. min( array_keys( $jobVotes ) ) );
        $this->set(compact('AllocateList'));

        /**
        * カレンダー
        * array(0) { }
        **/
        $conditions = array(
                "conditions" => array(  'EvEvent.rec_company_id' => $rec_company_id,
                                        'EvEvent.status' => array( 0, 1 ),
                                        'EvSchedule.status' => array( 0, 1 ) ),
                "recursive" => -1,
                "contain" => array( 'EvSchedule' ),
            );

        $conditions['joins'][0] = array( 
                            'type' => 'INNER',
                            'table' => 'ev_schedules',
                            'alias' => 'EvSchedule',
                            'conditions' => 'EvSchedule.ev_event_id = EvEvent.id' 
                           );

        $evCalender = $this->EvEvent->find( 'all', $conditions );
        $this->set( 'evCalender', $evCalender );


	}

/**
 * logout method
 *
 * @return void
 */
	public function logout() {
		$this->Auth->logout();
		$this->redirect(array('controller' => 'Companies', 'action' => 'login'));
	}

    /**
    * 候補者属性別×選考履歴&イベント統計情報
    * 
    **/
    public function getAttributeStats( )
    {
        $rec_company_id = $this->getUserCompanyId();
        $year = $this->getWantedYear();


        if( empty( $year ) || empty( $rec_company_id ) ) {
            return false;
        } 

        $this->loadModel('SelStatChild');
        $this->loadModel('EvStatChild');


        $data['year'] = $year;

        $sel_result = $this->SelStatChild->getSelLanguageStats( $rec_company_id, $data );
        $ev_result = $this->EvStatChild->getEvLanguageStats( $rec_company_id, $data );
        $result = $this->trimLanguageStats( $sel_result, $ev_result );


        return $result;


    }


    /*
    *  企業IDをsessionに設定する
    */
    private function _setCompanyId() {

    	$departmentId = SessionComponent::read('Auth.User.rec_department_id');
    	$this->loadModel('RecDepartment');
    	$userDepartment = $this->RecDepartment->find('first', array(
    		'recursive' => -1,
    		'conditions' => array('RecDepartment.id' => $departmentId)
            )
		);
        SessionComponent::write('Auth.User.rec_company_id', $userDepartment['RecDepartment']['rec_company_id']);
    }


    /*
    *  最終ログイン日時の更新
    */
    private function _updateLastLoginDate(){
        $this->loadModel('RecRecruiter');
        $this->RecRecruiter->id = SessionComponent::read('Auth.User.id');
        $now = date('Y-m-d H:i:s');
        SessionComponent::write('Auth.User.last_login_date', $now);        
        $this->RecRecruiter->saveField('last_login_date', $now);
    }

    /**
* 選考状況確認(選考履歴サマリ)
* 
**/
    private function getSummary() 
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
    * 語学の情報をレスポンスの形式に配列を整える
    * 
    * @param   array  $sel_result
    * @param   array  $ev_result
    * @return  array  $result
    * 
    * 
    **/
    private function trimLanguageStats( $sel_result, $ev_result )
    {   
        $language = $this->getSystemConfig('add_foreign_language');

        $sel = $this->trimLanguageSelStats( $sel_result, $language );
        $ev = $this->trimLanguageEvStats( $ev_result );

        $result = array( 'job_votes' => $sel, 'events' => $ev );

        return $result;


    }

    /**
    * 学歴別選考履歴集計の情報をレスポンスの形式に配列を整える
    * 
    * @param  array  $seL_result
    * @param  array  $language
    * @return array  $sel
    * 
    **/
    private function trimLanguageSelStats( $sel_results, $language )
    {
        $sel = array();
        foreach ( $sel_results as $key => $value ) {

            $job_vote_id = $value['sel_stat_children']['job_vote_id'];
            $can_language = $value['can_languages']['foreign_language_id'];
            $screening_stage_id = $value['sel_stat_children']['screening_stage_id'];
            $select_status_id = $value['sel_stat_children']['select_status_id'];

            $sel_result[$job_vote_id]['name'] = $value['job_votes']['title'];

            if( $can_language == 99 ) {
             $sel_result[$job_vote_id][$can_language]['name'] = 'その他';

         } else {

             $sel_result[$job_vote_id][$can_language]['name'] = $language[ $value['can_languages']['foreign_language_id'] ];           

         }

         $sel_result[$job_vote_id][$can_language][$screening_stage_id] = array( 
            'name' => $value['screening_stages']['name'], 
            $select_status_id => $value[0]['count']
            );
     }

     return $sel_result;

    }

    /**
    * 学歴別イベント集計の情報をレスポンスの形式に配列を整える
    * 
    * @param  array  $ev_result
    * @return array  $ev
    * 
    **/
    private function trimLanguageEvStats( $ev_result )
    {

   $ev = array();

    foreach ($ev_result as $key => $value) {
        $job_vote_id = $value[0]['job_vote_id'];
        $rank = $value['can_languages']['foreign_language_id'];
        $count = $value[0]['can_count'];
        $ev_event_id = $value[0]['ev_event_id'];


        $ev[$ev_event_id][$job_vote_id][$rank] = $count;

    }

    return $ev;


    }





}
