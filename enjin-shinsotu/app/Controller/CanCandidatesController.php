<?php
App::uses('AppController', 'Controller');
/**
 * CanCandidates Controller
 *
 * @property CanCandidate $CanCandidate
 * @property PaginatorComponent $Paginator
 */
class CanCandidatesController extends AppController {

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

        $companyId = $this->getUserCompanyId();
        $paginate = $this->searchQueries();

        SessionComponent::write('SearchCondition', $paginate);

        //load options for form
        $sel_judge_types = $this->getSystemConfig('select_judgment_type');
        
        $this->loadModel('ScreeningStage');
        $scrStages = $this->ScreeningStage->find('list',
        array('recursive' => -1,
            'conditions' =>
            array('ScreeningStage.rec_company_id' => $companyId, 'status' => 0)
            ));
        
        $this->loadModel('EvEvent');
        $evEvents=$this->EvEvent->find('list',
            array('recursive' => -1,
                'conditions' => array('EvEvent.rec_company_id' => $companyId, 'status' => 0)
            ));

        $this->loadModel('RefererCompany');
        $refCom = $this->CanCandidate->RefererCompany->find('list',
            array('recursive' => -1,
                'conditions' => array('RefererCompany.rec_company_id' => $companyId, 'RefererCompany.status' => 0)
            ));

        $this->loadModel('MailTemplate');
        $mailTmpl=$this->MailTemplate->getPullDownList();
        //end load options

        $this->paginate = $paginate;

        $this->set('canCandidates', $this->Paginator->paginate());
        $this->set( compact('scrStages', 'refCom', 'sel_judge_types', 'evEvents', 'mailTmpl') );

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
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function view($id = null) {
    //if (!$this->CanCandidate->exists()) {
    if (!$this->CanCandidate->isUses($id)) {
        throw new NotFoundException(__('Invalid can candidate'));
    }
    $options = array('conditions' => array('CanCandidate.' . $this->CanCandidate->primaryKey => $id));
    $this->CanCandidate->recursive = 1;
    $canCandidate = $this->CanCandidate->find('first', $options);
    $this->set('canCandidate', $canCandidate);

    //カスタム属性フィールド情報
    $uComId = $this->getUserCompanyId();
    $this->loadModel('canCustomFields');
        //$options = $this->canCustomFields->getListDefaultConditions();
    $options['conditions'] = array(
        'canCustomFields.rec_company_id' => $uComId,
        'canCustomFields.status' => 0,
        );
    $options['fields'] = array('id', 'field_name');
    $this->set('canCustomFields', $this->canCustomFields->find('list', $options));

    //採用担当者名表示用
    $this->loadModel('RecRecruiter');
    $options = array();
        //$options = $this->RecRecruiter->getListDefaultConditions();
    $options['fields'] = array('id', 'name');
    $this->set('RecRecruiter', $this->RecRecruiter->find('list', $options));

    //求人担当者名表示用
    $this->loadModel('InfStaff');
    $options = array();
        //$options = $this->InfStaff->getListDefaultConditions();
    $options['fields'] = array('id', 'name');
    $this->set('InfStaff', $this->InfStaff->find('list', $options));

    //登録用求人票データ
    $this->loadModel('JobVote');
    $options = $this->JobVote->getListDefaultConditions();
    $options['fields'] = array('id', 'title');
    //unset($options['conditions']['JobVote.wanted_year']);
    $this->set('JobVote', $this->JobVote->find('list', $options));

    //履歴表示用求人票データ
    unset($options['conditions']['JobVote.wanted_year']);
    $this->set('ViewJobVote', $this->JobVote->find('list', $options));

    //選考段階マスタ
    $this->loadModel('ScreeningStage');
    $options = $this->ScreeningStage->getScreeningStage();
    $options['fields'] = array('id', 'name');
    $this->set('ScreeningStage', $this->ScreeningStage->find('list', $options));

    //学校マスタ
    $this->loadModel('School');
    $this->set('schools', $this->School->find('list', array(
        'conditions' => array(
            'rec_company_id' => $uComId,
        ),
    )));
    //学部マスタ
    $this->loadModel('Undergraduate');
    $this->set('undergraduates', $this->Undergraduate->find('list', array(
        'conditions' => array(
            'rec_company_id' => $uComId,
        ),
    )));

    //イベント履歴
    $this->loadModel('EvSchedule');
    $EvSchedule = array();
    if(!empty($canCandidate['EvHistory'])){
        foreach($canCandidate['EvHistory'] as $key => $event){
            $this->EvSchedule->recursive = 0;
            $schedule = $this->EvSchedule->find('first', array(
                'fields' => array(
                    'EvSchedule.*',
                    'EvEvent.*',
                ),
                'conditions' => array(
                    'EvSchedule.id' => $event['ev_schedule_id'],
                )
            ));
            $EvSchedule[$key]['EvHistory'] = $event;
            $EvSchedule[$key]['EvSchedule'] = $schedule['EvSchedule'];
            $EvSchedule[$key]['EvEvent'] = $schedule['EvEvent'];
        }
    }
    $this->set('EvSchedule', $EvSchedule);

    //イベントマスタ
    $this->loadModel('EvEvent');
    $targetDates = array(
        'year'  => date('Y'),
        'month' => date('m'),
    );
    $EvEventData = $this->EvEvent->getEvent($uComId, $targetDates);
    $EvEvent = array();
    if(!empty($EvEventData)){
        foreach($EvEventData as $row => $ev){
            $EvEvent[] = array(
                $ev[0]['EvSchedule']['id'] => $ev[0]['EvSchedule'][0]['individual_theme'],
            );
        }
    }
    $this->set('EvEvent', $EvEvent);

    //イベントファイル
    $EvHistoryDocument = array();
    if(!empty($canCandidate['CanDocument'])){
        foreach($canCandidate['CanDocument'] as $doc){
            if(!empty($doc['ev_history_id'])){
                $event_id = $doc['ev_history_id'];
                $EvHistoryDocument[$event_id]['file'] = $doc['file_name'] . '.' . $doc['extension'];
                $EvHistoryDocument[$event_id]['id'] = $doc['id'];
            }
        }
    }
    $this->set('EvHistoryDocument', $EvHistoryDocument);

    $this->set('Country', $this->CanCandidate->Country->find('list'));
    $this->set('Prefecture', $this->CanCandidate->Prefecture->find('list'));

    //設定値
    $lockRoleFlag = $this->getSystemConfig("lock_role_flag");

    $this->set(compact('lockRoleFlag'));
}

/**
 * add method
 *
 * @return void
 */
public function add() {
    if ($this->request->is('post')) {
        $this->CanCandidate->create();
        $now = $this->CanCandidate->getDataSource()->expression('NOW()');
        //更新者ID
        $user_id = $this->CanCandidate->getUserInfo('id');

        //入社可能年月の変換
        $join_possible_data = '0000-00-00';
        if(!empty($this->request->data['CanCandidate']['join_possible_date_y']) && !empty($this->request->data['CanCandidate']['join_possible_date_m'])){
            $join_possible_data = $this->request->data['CanCandidate']['join_possible_date_y'] . '-' . $this->request->data['CanCandidate']['join_possible_date_m'] . '-' . '01';
        }
        $this->request->data['CanCandidate']['join_possible_date'] = $join_possible_data;
        //更新者ID
        $this->request->data['rec_recruiter_id'] = ($this->request->data['CanCandidate']['last_modified_type'] === '0')? $user_id : null;
        $this->request->data['inf_staff_id'] = ($this->request->data['CanCandidate']['last_modified_type'] === '1')? $user_id : null;

        $this->request->data['CanCandidate']['created'] = $now;
        $this->request->data['CanCandidate']['modified'] = $now;

        if ($this->CanCandidate->save($this->request->data)) {
            return $this->flash(__('候補者を登録しました。'), array('action' => 'index'));
        }else{
            $this->Session->setFlash('入力内容に不備があります。');
        }
    }
    $countries = $this->CanCandidate->Country->find('list');
    $prefectures = $this->CanCandidate->Prefecture->find('list');
    $infContracts = $this->CanCandidate->InfContract->find('list');
    $infStaffs = $this->CanCandidate->InfStaff->find('list');
    $recRecruiters = $this->CanCandidate->RecRecruiter->find('list');
    switch($this->CanCandidate->getUserInfo('role_type')){
        case ROLE_TYPE_REFERER:
        $refererCompanies = $this->CanCandidate->RefererCompany->find('list',array(
            'conditions' => array('RefererCompany.id' => $this->CanCandidate->getUserInfo('referer_company_id') )
            ));
        break;
        default:
        $refererCompanies = $this->CanCandidate->RefererCompany->find('list',array('conditions'=>array('RefererCompany.rec_company_id'=>$this->getUserCompanyId())));
        break;
    }

    //入社可能年月
    $max_y = (date('Y')+1);
    for($y=SessionComponent::read('WantedYear'); $y<=$max_y; $y++){
        $years[$y] = $y . '年';
    }
    for($m=1; $m<=12; $m++){
        $month[$m] = $m . '月';
    }
    $this->set('years', $years);
    $this->set('month', $month);

    //設定値
    $sex = $this->getSystemConfig("sex");
    $lastModifiedType = $this->getSystemConfig("last_modified_type");
    $this->set(compact('recCompanies', 'countries', 'prefectures', 'refererCompanies', 'infContracts', 'infStaffs', 'recRecruiters', 
        'sex', 'status', 'lastModifiedType' ));

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
 * @param string $id
 * @return void
 */
public function edit($id = null) {

    //現在利用できる状態なのかを確認する
    if (!$this->CanCandidate->isUses($id)) {
        throw new NotFoundException(__('Invalid can candidate'));
    }

    //データが編集不可能な場合の処理
    if(!$this->CanCandidate->isEdit($id)){
        $this->redirect(array('controller' => 'CanCandidates', 'action' => 'view',$id));
        return;
    }

    $this->CanCandidate->setLockFlag( $id );
    $options = array('conditions' => array('CanCandidate.' . $this->CanCandidate->primaryKey => $id));
    $CanCandidate = $this->CanCandidate->find('first', $options);

    if ($this->request->is(array('post', 'put'))) {
        $now = $this->CanCandidate->getDataSource()->expression('NOW()');

        //入社可能年月の変換
        $join_possible_data = '0000-00-00';
        if(!empty($this->request->data['CanCandidate']['join_possible_date_y']) && !empty($this->request->data['CanCandidate']['join_possible_date_m'])){
            $join_possible_data = $this->request->data['CanCandidate']['join_possible_date_y'] . '-' . $this->request->data['CanCandidate']['join_possible_date_m'] . '-' . '01';
        }
        $this->request->data['CanCandidate']['join_possible_date'] = $join_possible_data;
        $this->request->data['CanCandidate']['modified'] = $now;

        //データの保存を行う
        if ($this->CanCandidate->save($this->request->data)) {
            return $this->flash(__('基本データを更新しました。'), array('action' => 'index'));
        }
        $this->Session->setFlash('入力内容に不備があります。');
    }else{
        $this->request->data = $CanCandidate;
    }

    $countries = $this->CanCandidate->Country->find('list');
    $prefectures = $this->CanCandidate->Prefecture->find('list');
    $options = array();
    $options['conditions'] = array(
            'RefererCompany.rec_company_id' => $this->getLoginUser('rec_company_id'),
        ); 

    $refererCompanies = $this->CanCandidate->RefererCompany->find('list', $options);

    //入社可能年月
    $max_y = (date('Y')+1);
    for($y=SessionComponent::read('WantedYear'); $y<=$max_y; $y++){
        $years[$y] = $y . '年';
    }
    for($m=1; $m<=12; $m++){
        $month[$m] = $m . '月';
    }
    $this->set('years', $years);
    $this->set('month', $month);

    //設定値
    $sex = $this->getSystemConfig("sex");
    $lastModifiedType = $this->getSystemConfig("last_modified_type");
    $this->set(compact('countries', 'prefectures', 'refererCompanies', 'sex', 'lastModifiedType','CanCandidate'));

    //ロールによるviewの出力変更処理
    switch ( SessionComponent::read('Auth.User.role_type') ){
        case ROLE_TYPE_RECRUITER:   //採用担当者
            $this->render( $this->getRenderViewName() );
            break;
        case ROLE_TYPE_REFERER:   //流入元担当者
            $this->render( $this->getRenderViewName() );
            break;
        default:    //上記のロール以外はアクセスする権利がないので強制終了
            throw new NotFoundException(__('not access authorizations'));
    }


}

/**
 * associated method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function associated($id = null) {

    //現在利用できる状態なのかを確認する
    if (!$this->CanCandidate->isUses($id)) {
        throw new NotFoundException(__('Invalid can candidate'));
    }

    //データが編集不可能な場合の処理
    if(!$this->CanCandidate->isEdit($id)){
        $this->redirect(array('controller' => 'CanCandidates', 'action' => 'view',$id));
        return;
    }

    $this->CanCandidate->setLockFlag( $id );
    $this->CanCandidate->recursive = 1;
    $options = array('conditions' => array('CanCandidate.' . $this->CanCandidate->primaryKey => $id));
    $CanCandidate = $this->CanCandidate->find('first', $options);

    if ($this->request->is(array('post', 'put'))) {
        try{
            $this->CanCandidate->getDataSource()->begin();
            $now = $this->CanCandidate->getDataSource()->expression('NOW()');
            $can_candidate_id = $this->request->data['CanCandidate']['id'];

            //提出書類作成,削除
            $this->loadModel('CanDocument');
            if(!empty($this->request->data['CanDocument']) && is_array($this->request->data['CanDocument'])){
                $update = array();
                foreach($this->request->data['CanDocument'] as $key => $doc){
                    switch(true){

                        //Insert
                        case (substr($key, 0, 3) == 'new'):
                            $insert = array();
                            foreach($doc['file'] as $no => $data){
                                if($data['error'] === 0){
                                    $info = new SplFileInfo($data['name']);
                                    $ext  = $info->getExtension();
                                    $name = $info->getBasename('.' . $ext);
                                    $insert['CanDocument'] = array(
                                        'id' => null,
                                        'can_candidate_id' => $can_candidate_id,
                                        'ev_history_id' => 0,
                                        'sel_history_id' => 0,
                                        'file_name' => $name,
                                        'extension' => $ext,
                                        'binary_data' => file_get_contents($data['tmp_name']),
                                        'status' => 0,
                                        'created' => $now,
                                        'modified' => $now,
                                    );
                                    if(!$this->CanDocument->save($insert)){
                                        throw new Exception(1);
                                    }
                                }
                            }
                            break;

                        //Delete
                        case (isset($doc['delete']) && $doc['delete'] == '1'):
                            $update['CanDocument'] = array(
                                'id' => $doc['id'],
                                'status' => 1,
                                'modified' => $now,
                            );
                            if(!$this->CanDocument->save($update)){
                                throw new Exception(1);
                            }
                          break;

                        default :
                            break;
                    }
                }
            }

            //語学更新,作成,削除
            $this->loadModel('CanLanguage');
            if(!empty($this->request->data['CanLanguage']) && is_array($this->request->data['CanLanguage'])){
                $update = array();
                foreach($this->request->data['CanLanguage'] as $key => $lang){
                    switch(true){

                        //Insert
                        case (substr($key, 0, 3) == 'new'):
                            $insert = array();
                            foreach($lang['foreign_language_id'] as $no => $data){
                                $insert['CanLanguage'] = array(
                                    'id' => null,
                                    'can_candidate_id' => $can_candidate_id,
                                    'foreign_language_id' => $lang['foreign_language_id'][$no],
                                    'foreign_language' => ($lang['foreign_language_id'][$no] == '99')? $lang['foreign_language'][$no] : '',
                                    'level_id' => $lang['level_id'][$no],
                                    'oversea_life' => $lang['oversea_life'][$no],
                                    'status' => 0,
                                    'created' => $now,
                                    'modified' => $now,
                                );
                                if(!$this->CanLanguage->save($insert)){
                                    throw new Exception(1);
                                }
                            }
                            break;

                        //Delete
                        case (isset($lang['delete']) && $lang['delete'] == '1'):
                            $update['CanLanguage'] = array(
                                'id' => $lang['id'],
                                'status' => 1,
                                'modified' => $now,
                            );
                            if(!$this->CanLanguage->save($update)){
                                throw new Exception(1);
                            }
                          break;

                        //Update
                        case (substr($key, 0, 4) == 'edit'):
                            $update['CanLanguage'] = array(
                                'id' => $lang['id'],
                                'foreign_language_id' => $lang['foreign_language_id'],
                                'foreign_language' => ($lang['foreign_language_id'] == '99')? $lang['foreign_language'] : '',
                                'level_id' => $lang['level_id'],
                                'oversea_life' => $lang['oversea_life'],
                                'modified' => $now,
                            );
                            if(!$this->CanLanguage->save($update)){
                                throw new Exception(1);
                            }
                            break;

                        default :
                            break;
                    }
                }
            }

            //特記事項更新,作成,削除
            $this->loadModel('CanNotice');
            if(!empty($this->request->data['CanNotice']) && is_array($this->request->data['CanNotice'])){
                $update = array();
                foreach($this->request->data['CanNotice'] as $key => $note){
                    switch(true){

                        //Insert
                        case (substr($key, 0, 3) == 'new'):
                            $insert = array();
                            foreach($note['notice'] as $no => $data){
                                $insert['CanNotice'] = array(
                                    'id' => null,
                                    'can_candidate_id' => $can_candidate_id,
                                    'notice' => $note['notice'][$no],
                                    'register_type' => $note['register_type'][$no],
                                    'rec_recruiter_id' => ($note['register_type'][$no] === '0')? $note['rec_recruiter_id'][$no] : null,
                                    'inf_staff_id' => ($note['register_type'][$no] === '1')? $note['inf_staff_id'][$no] : null,
                                    'status' => 0,
                                    'created' => $now,
                                    'modified' => $now,
                                );
                                if(!$this->CanNotice->save($insert)){
                                    throw new Exception(1);
                                }
                            }
                            break;

                        //Delete
                        case (isset($note['delete']) && $note['delete'] == '1'):
                            $update['CanNotice'] = array(
                                'id' => $note['id'],
                                'status' => 1,
                                'modified' => $now,
                            );
                            if(!$this->CanNotice->save($update)){
                                throw new Exception(1);
                            }
                           break;

                        //Update
                        case (substr($key, 0, 4) == 'edit'):
                            $update['CanNotice'] = array(
                                'id' => $note['id'],
                                'notice' => $note['notice'],
                                'register_type' => $note['register_type'],
                                'rec_recruiter_id' => ($note['register_type'] === '0')? $note['rec_recruiter_id'] : null,
                                'inf_staff_id' => ($note['register_type'] === '1')? $note['inf_staff_id'] : null,
                                'modified' => $now,
                            );
                            if(!$this->CanNotice->save($update)){
                                throw new Exception(1);
                            }
                        break;

                        default :
                            break;
                    }
                }
            }

            //候補者カスタム属性更新,作成,削除
            $this->loadModel('CanCustomAttribute');
            if(!empty($this->request->data['CanCustomAttribute']) && is_array($this->request->data['CanCustomAttribute'])){
                $update = array();
                foreach($this->request->data['CanCustomAttribute'] as $key => $custom){
                    switch(true){
                        //Insert
                        case (substr($key, 0, 3) == 'new'):
                            $insert = array();
                            foreach($custom['can_custom_field_id'] as $no => $data){
                                $insert['CanCustomAttribute'] = array(
                                    'id' => null,
                                    'can_candidate_id' => $can_candidate_id,
                                    'can_custom_field_id' => $custom['can_custom_field_id'][$no],
                                    'value' => $custom['value'][$no],
                                    'status' => 0,
                                    'created' => $now,
                                    'modified' => $now,
                                );
                                if(!$this->CanCustomAttribute->save($insert)){
                                    throw new Exception(1);
                                }
                            }
                            break;

                        //Delete
                        case (isset($custom['delete']) && $custom['delete'] == '1'):
                            $update['CanCustomAttribute'] = array(
                                'id' => $custom['id'],
                                'status' => 1,
                                'modified' => $now,
                            );
                            if(!$this->CanCustomAttribute->save($update)){
                                throw new Exception(1);
                            }
                            break;

                        //Update
                        case (substr($key, 0, 4) == 'edit'):
                            $update['CanCustomAttribute'] = array(
                                'id' => $custom['id'],
                                'can_custom_field_id' => $custom['can_custom_field_id'],
                                'value' => $custom['value'],
                                'modified' => $now,
                            );
                            if(!$this->CanCustomAttribute->save($update)){
                                throw new Exception(1);
                            }
                            break;

                        default :
                            break;
                    }
                }
            }

            //資格更新,作成,削除
            $this->loadModel('CanQualification');
            if(!empty($this->request->data['CanQualification']) && is_array($this->request->data['CanQualification'])){
                $update = array();
                foreach($this->request->data['CanQualification'] as $key => $qual){
                    switch(true){
                        //Insert
                        case (substr($key, 0, 3) == 'new'):
                            $insert = array();
                            foreach($qual['qualification_id'] as $no => $data){
                                $acquisition_date = '0000-00-00';
                                if(!empty($qual['acquisition_date_y'][$no]) && !empty($qual['acquisition_date_m'][$no])){
                                    $acquisition_date = $qual['acquisition_date_y'][$no] . '-' . $qual['acquisition_date_m'][$no] . '-' . '01';
                                }
                                 $insert['CanQualification'] = array(
                                    'id' => null,
                                    'can_candidate_id' => $can_candidate_id,
                                    'qualification_id' => $qual['qualification_id'][$no],
                                    'qualification' => ($qual['qualification_id'][$no] == '99')? $qual['qualification'][$no] : '',
                                    'score' => $qual['score'][$no],
                                    'acquisition_date' => $acquisition_date,
                                    'status' => 0,
                                    'created' => $now,
                                    'modified' => $now,
                                );
                                if(!$this->CanQualification->save($insert)){
                                    throw new Exception(1);
                                }
                            }
                            break;

                        //Delete
                        case (isset($qual['delete']) && $qual['delete'] == '1'):
                            $update['CanQualification'] = array(
                                'id' => $qual['id'],
                                'status' => 1,
                                'modified' => $now,
                            );
                            if(!$this->CanQualification->save($update)){
                                throw new Exception(1);
                            }
                        break;

                        //Update
                        case (substr($key, 0, 4) == 'edit'):
                            $acquisition_date = '0000-00-00';
                            if(!empty($qual['acquisition_date_y']) && !empty($qual['acquisition_date_m'])){
                                $acquisition_date = $qual['acquisition_date_y'] . '-' . $qual['acquisition_date_m'] . '-' . '01';
                            }
                            $update['CanQualification'] = array(
                                'id' => $qual['id'],
                                'qualification_id' => $qual['qualification_id'],
                                'qualification' => ($qual['qualification_id'] == '99')? $qual['qualification'] : '',
                                'score' => $qual['score'],
                                'acquisition_date' => $acquisition_date,
                                'modified' => $now,
                            );
                            if(!$this->CanQualification->save($update)){
                                throw new Exception(1);
                            }
                            break;

                        default :
                            break;
                    }
                }
            }

            //学歴更新,作成,削除
            $this->loadModel('CanEducation');
            if(!empty($this->request->data['CanEducation']) && is_array($this->request->data['CanEducation'])){
                $update = array();
                foreach($this->request->data['CanEducation'] as $key => $edu){
                    switch(true){
                        //Insert
                        case (substr($key, 0, 3) == 'new'):
                            $insert = array();
                            foreach($edu['school_id'] as $no => $data){
                                $insert['CanEducation'] = array(
                                    'id' => null,
                                    'can_candidate_id' => $can_candidate_id,
                                    'school_id' => $edu['school_id'][$no],
                                    'school' => $edu['school'][$no],
                                    'undergraduate_id' => $edu['undergraduate_id'][$no],
                                    'undergraduate' => $edu['undergraduate'][$no],
                                    'department' => $edu['department'][$no],
                                    'student_bunri_class_id' => $edu['student_bunri_class_id'][$no],
                                    'manage_bunri_class_id' => $edu['manage_bunri_class_id'][$no],
                                    'seminar' => $edu['seminar'][$no],
                                    'major_theme' => $edu['major_theme'][$no],
                                    'circle' => $edu['circle'][$no],
                                    'admission_date' => !empty($edu['admission_date'][$no])? $edu['admission_date'][$no]: NULL,
                                    'graduation_date' => !empty($edu['graduation_date'][$no])? $edu['graduation_date'][$no]: NULL,
                                    'status' => 0,
                                    'created' => $now,
                                    'modified' => $now,
                                );
                                if(!$this->CanEducation->save($insert)){
                                    throw new Exception(1);
                                }
                            }
                            break;

                        //Delete
                        case (isset($edu['delete']) && $edu['delete'] == '1'):
                            $update['CanEducation'] = array(
                                'id' => $edu['id'],
                                'status' => 1,
                                'modified' => $now,
                            );
                            if(!$this->CanEducation->save($update)){
                                throw new Exception(1);
                            }
                            break;

                        //Update
                        case (substr($key, 0, 4) == 'edit'):
                            $update['CanEducation'] = array(
                                'id' => $edu['id'],
                                'school_id' => $edu['school_id'],
                                'school' => $edu['school'],
                                'undergraduate_id' => $edu['undergraduate_id'],
                                'undergraduate' => $edu['undergraduate'],
                                'department' => $edu['department'],
                                'student_bunri_class_id' => $edu['student_bunri_class_id'],
                                'manage_bunri_class_id' => $edu['manage_bunri_class_id'],
                                'seminar' => $edu['seminar'],
                                'major_theme' => $edu['major_theme'],
                                'circle' => $edu['circle'],
                                'admission_date' => !empty($edu['admission_date'])? $edu['admission_date']: NULL,
                                'graduation_date' => !empty($edu['graduation_date'])? $edu['graduation_date']: NULL,
                                'modified' => $now,
                            );
                            if(!$this->CanEducation->save($update)){
                                throw new Exception(1);
                            }
                        break;

                        default :
                            break;
                    }
                }
            }

            $this->CanCandidate->getDataSource()->commit();

            return $this->flash(__('付随データを更新しました。'), array('action' => 'index'));

        }catch(Exception $e){
            $this->CanCandidate->getDataSource()->rollback();
            switch($e->getMessage()){
                case 1:
                $msg = '入力内容に不備があります。';
                break;
                default :
                $msg = 'システムエラーが発生しました。';
                break;

            }
            $this->Session->setFlash($msg);
        }
    }else{
        $this->request->data = $CanCandidate;
    }

    $uComId = $this->getUserCompanyId();

    //学校マスタ
    $this->loadModel('School');
    $this->set('schools', $this->School->find('list', array(
        'conditions' => array(
            'rec_company_id' => $uComId,
        ),
    )));
    //学部マスタ
    $this->loadModel('Undergraduate');
    $this->set('undergraduates', $this->Undergraduate->find('list', array(
        'conditions' => array(
            'rec_company_id' => $uComId,
        ),
    )));

    //採用担当者名表示用
    $options = array();
    //$options = $this->RecRecruiter->getListDefaultConditions();
    $options['recursive'] = 1;
    $options['fields'] = array('id', 'name');
    $options['conditions'] = array('RecDepartment.rec_company_id' => $this->getLoginUser('rec_company_id'));
    $this->set('recRecruiters', $this->CanCandidate->RecRecruiter->find('list', $options));

    //求人担当者名表示用
    $options = array();
    //$options = $this->InfStaff->getListDefaultConditions();
    $options['fields'] = array('id', 'name');
    $this->set('infStaffs', $this->CanCandidate->InfStaff->find('list', $options));

    //カスタム属性フィールド情報
    $this->loadModel('canCustomFields');
    //$options = $this->canCustomFields->getListDefaultConditions();
    $options['conditions'] = array(
        'canCustomFields.rec_company_id' => $uComId,
        'canCustomFields.status' => 0,
     );
    $options['fields'] = array('id', 'field_name');
    $this->set('canCustomFields', $this->canCustomFields->find('list', $options));

    //資格取得年月
    $max_y = SessionComponent::read('WantedYear');
    for($y=($max_y - 15); $y<=$max_y; $y++){
        $years[$y] = $y . '年';
    }
    for($m=1; $m<=12; $m++){
        $month[$m] = $m . '月';
    }
    $this->set('qualification_years', $years);
    $this->set('month', $month);

    //設定値
    $this->set('custom_type', $this->getSystemConfig("custom_type"));
    $this->set('foreign_language', $this->getSystemConfig("add_foreign_language"));
    $this->set('lang_level', $this->getSystemConfig("add_level"));
    $this->set('register_type', $this->getSystemConfig("register_type"));
    $this->set('qualifications', $this->getSystemConfig("qualifications"));
    $this->set('bunri_class', $this->getSystemConfig("bunri_class"));

    $this->set('CanCandidate', $CanCandidate);

    //ロールによるviewの出力変更処理
    switch ( SessionComponent::read('Auth.User.role_type') ){
        case ROLE_TYPE_RECRUITER:   //採用担当者
            $this->render( $this->getRenderViewName() );
            break;
        case ROLE_TYPE_REFERER:   //流入元担当者
            $this->render( $this->getRenderViewName() );
            break;
        default:    //上記のロール以外はアクセスする権利がないので強制終了
            throw new NotFoundException(__('not access authorizations'));
    }
}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function delete($id = null) {
    $this->CanCandidate->id = $id;
        //if (!$this->CanCandidate->exists()) {
    if (!$this->CanCandidate->isUses($id)) {
        throw new NotFoundException(__('Invalid can candidate'));
    }
    $this->request->allowMethod('post', 'delete');
    if ($this->CanCandidate->delete()) {
        $this->Session->setFlash(__('The can candidate has been deleted.'));
        return $this->redirect(array('action' => 'index'));
    } else {
        return $this->flash(__('The can candidate could not be deleted. Please, try again.'), array('action' => 'index'));
    }
}

/*
* CSVデータの取得・登録
*/
public function csv_add(){

    if ($this->request->is('post')) {

        $this->loadModel('CsvImport');

        $csvObj = & $this->CsvImport;

        $csvObj->setCsvFile($this->data['CanCandidates']['CsvFile']);
        $csvObj->setjoinPossibleDate($this->data['CanCandidates']['joinPossibleDate']);

        if ($csvObj->isFileError()) {
            return $this->flash($csvObj->getErrorMessege(), array('action' => 'csv_add'));
        }

        // エンコード
        $csvData = $csvObj->fileEncode($this->data['CanCandidates']['CsvFile']['tmp_name']);
        // リクナビマイナビチェック
        $navigator = $csvObj->checkNavigator($this->data['CanCandidates']['navigators']);
        // 登録に使用するマスタデータの取得
        $dataLists = $csvObj->getDataLists();
        // DB登録用にフォーマット整形
        $record = $csvObj->candidateConverter($csvData, $dataLists, $navigator);
        if ($record === false) {
            return $this->flash($csvObj->getErrorMessege(), array('action' => 'csv_add'));
        }
        // 存在しているデータの抽出
        $existCandidateIds = $csvObj->getExistCandidates();
        // 存在データのロック
        $this->CanCandidate->setCSVLockFlg($existCandidateIds, $csvObj->naviKey);
        // ロックされているIDを取得
        $unLockId = $this->CanCandidate->getUnlockNaviID();
        // 存在しているデータとマッチするレコードにDB上のIDの追加
        $saveCandidates = $csvObj->releaseLockRecord($record, $unLockId);

        $successCount = 0;
        // 保存
        foreach ($saveCandidates as $data) {
            $data = $csvObj->isExsistCandidate($data);
            $this->CanCandidate->create();
            $res = $this->CanCandidate->saveAssociated($data);

            if (empty($res)){
                $candidateName = $data['CanCandidate']['last_name']."　".$data['CanCandidate']['first_name']; 
                $csvObj->setErrors($data['line'], $candidateName, $data['csv_record'], "データが不足しているか、データ形式が異なっています。");
            } else {
                $successCount++;
            }
        }
        // 存在データのロックの解除
        $this->CanCandidate->create();
        $this->CanCandidate->unsetCSVLockFlg($existCandidateIds, $csvObj->naviKey);
        
        $errors = $csvObj->getErrors();
        arsort($errors);
    }

    $this->loadModel('RefererCompany');
    $navigators = $this->RefererCompany->getCsvSelecList();


    $this->set(compact('navigators', 'successCount', 'errors'));
}


/***
 * duplicate method
 *
 * @return void
 */
public function duplicate(){

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
    $findParam = $this->getCommonListPararms('CanCandidate');

    $findParam['fields'] =  array('last_name',"first_name");
    $findParam['recursive'] = 0;
    $findParam['conditions'] = array("CanCandidate.re   c_company_id" => $userCompanyId);
    $data = $this->CanCandidate->find('list', $findParam );

    $this->renderJson($data);
    exit;
}

/**
* action unlock CanCandidate scr-33
*
*
*/
public function unlock(){

   if($this->request->is('post')){
        if( !empty($canIds = $this->request->data('can_id'))){
            foreach($canIds as $canId){
                $this->CanCandidate->id = $canId;
                $this->CanCandidate->save(array('CanCandidate.lock_id'=>'0'));
            }
            $this->Session->setFlash(__('Candidates selected has been unlocked.'));
            return $this->redirect(array('action'=>'unlock'));
        }
    }

    $companyId = $this->getUserCompanyId();

    $this->loadModel('RecRecruiter');
    $this->loadModel('RefererCompany');

    $lockRoleFlag = $this->getSystemConfig("lock_role_flag");

    $canCandidates = $this->CanCandidate->find('all',array(
        'conditions' => array(
            'CanCandidate.lock_id' => $this->getLoginUser('id'),
            ),
        'contain' => array(
            'CanEducation' => array(
                'School',
                'Undergraduate'
                )
            ),
        ));

    $canCandidates2 = $this->CanCandidate->find('all',array(
        'conditions' => array(
            'NOT' => array('CanCandidate.lock_id'=>array(0,$this->getLoginUser('id')))
            ),
        'contain' => array(
            'CanEducation' => array(
                'School',
                'Undergraduate'
                )
            ),
        ));


    if(is_array($canCandidates)){

        foreach($canCandidates as &$row){
            if( !empty( $row['CanCandidate']['lock_id'] )){
                switch( $row['CanCandidate']['lock_role_flag'] ){
                        case 1://recruiter
                        $result= $this->RecRecruiter->find('first',array(
                            'recursive' => -1,
                            'fields' => array('RecRecruiter.first_name','RecRecruiter.last_name'),
                            'conditions' => array(
                                'RecRecruiter.id' => $row['CanCandidate']['lock_id']
                                )
                            ));
                        $lock_flag_name = $lockRoleFlag[1];
                        $lock_name = !empty($result['RecRecruiter']['first_name'])?$result['RecRecruiter']['first_name']:'';
                        break;
                        case 2://referer
                        $result= $this->RefererCompany->find('first',array(
                            'recursive' => -1,
                            'fields' => array('RefererCompany.name'),
                            'conditions' => array(
                                'RefererCompany.id' => $row['CanCandidate']['lock_id']
                                )
                            ));
                        $lock_flag_name = $lockRoleFlag[2];
                        $lock_name = !empty($result['RefererCompany']['name'])?$result['RefererCompany']['name']:'';
                        break;
                        case 3://candidate
                        $result= $this->CanCandidate->find('first',array(
                            'recursive' => -1,
                            'fields' => array('CanCandidate.name'),
                            'conditions' => array(
                                'CanCandidate.id' => $row['CanCandidate']['lock_id']
                                )
                            ));
                        $lock_flag_name = $lockRoleFlag[3];
                        $lock_name = !empty($result['CanCandidate']['name'])?$result['CanCandidate']['name']:'';
                        break;
                        default:
                        $lock_flag_name = '';
                        $lock_name = '';
                        break;
                    }
                    $row['CanCandidate']['lock_flag_name'] = $lock_flag_name;
                    $row['CanCandidate']['lock_name'] = $lock_name;
                }

            }
        }


        if(is_array($canCandidates2)){

            foreach($canCandidates2 as &$row){
                if( !empty( $row['CanCandidate']['lock_id'] )){
                    switch( $row['CanCandidate']['lock_role_flag'] ){
                        case 1://recruiter
                        $result= $this->RecRecruiter->find('first',array(
                            'recursive' => -1,
                            'fields' => array('RecRecruiter.first_name','RecRecruiter.last_name'),
                            'conditions' => array(
                                'RecRecruiter.id' => $row['CanCandidate']['lock_id']
                                )
                            ));
                        $lock_flag_name = $lockRoleFlag[1];
                        $lock_name = !empty($result['RecRecruiter']['first_name'])?$result['RecRecruiter']['first_name']:'';
                        break;
                        case 2://referer
                        $result= $this->RefererCompany->find('first',array(
                            'recursive' => -1,
                            'fields' => array('RefererCompany.name'),
                            'conditions' => array(
                                'RefererCompany.id' => $row['CanCandidate']['lock_id']
                                )
                            ));
                        $lock_flag_name = $lockRoleFlag[2];
                        $lock_name = !empty($result['RefererCompany']['name'])?$result['RefererCompany']['name']:'';
                        break;
                        case 3://candidate
                        $result= $this->CanCandidate->find('first',array(
                            'recursive' => -1,
                            'fields' => array('CanCandidate.name'),
                            'conditions' => array(
                                'CanCandidate.id' => $row['CanCandidate']['lock_id']
                                )
                            ));
                        $lock_flag_name = $lockRoleFlag[3];
                        $lock_name = !empty($result['CanCandidate']['name'])?$result['CanCandidate']['name']:'';
                        break;
                        default:
                        $lock_flag_name = '';
                        $lock_name = '';
                        break;
                    }
                    $row['CanCandidate']['lock_flag_name'] = $lock_flag_name;
                    $row['CanCandidate']['lock_name'] = $lock_name;
                }

            }
        }

    $this->set(compact('canCandidates', 'canCandidates2'));

}

    /*
    *  選考状況
    * @return string unique_id
    */
    public function _getSelStatus($candidate_id) {
        $this->loadModel('SelStatus');
        return $this->SelStatus->find('list',array(
            'conditions' => array('lock_id' => 1),
            )
        );
    }

/**
* 候補者属性別×選考履歴&イベント統計情報
* 
**/
public function getAttributeStats( $attr = null )
{
    $rec_company_id = $this->getUserCompanyId();
    $year = $this->getWantedYear();

    if( empty( $attr ) ){
        $attr = 0;
    }

    if( empty( $year ) || empty( $rec_company_id ) ) {
        return $this->ErrorJson();
    } 

    $this->loadModel('SelStatChild');
    $this->loadModel('EvStatChild');


    $data['year'] = $year;
    $data['attr'] = $attr;

    $result = $this->getTrimAttrStat( $rec_company_id, $data );

        $this->loadModel('JobVote');
        $this->loadModel('EvEvent');
        $this->loadModel('ScreeningStage');

        $rec_company_id = $this->getUserCompanyId();
        switch ($attr) {
            case '0':
                $language = $this->getSystemConfig('add_foreign_language');
                break;

            case '1':
                $language = $this->getSystemConfig('school_rank');
                break;

            case '2':
                $language = $this->getSystemConfig('qualifications');
                break;

            case '3':
                $language = $this->getCustomData();
                break;
            
            default:
                // $language = $this->getSystemConfig('add_foreign_language');/
                break;
        }
        $selectJudgmentType = $this->getSystemConfig("select_judgment_type");
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

        $this->set( "select_judgment_type", $selectJudgmentType );
        $this->set( 'screening_stages', $screening_stage );
        $this->set( "screening_stage_type", $screening_stage_type );
        $this->set( 'language', $language );
        $this->set( 'select_status_id', $select_status_id );
        
        
        
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
        $this->set(compact('jobVotes'));


        $this->set( 'attr_stats', $result );

        $evEvents = $this->EvEvent->find('list',array( 
                                'recursive'=>-1,
                                'fields'=>array('id','name'),
                                'conditions' => array( 
                                    'EvEvent.rec_company_id' => $rec_company_id, 
                                    'EvEvent.status' => array( 0, 1 ) 
                                    ) 
                                ) 
                            );
        $this->set(compact('evEvents'));
    $this->render('/Elements/attr', false );
$this->response->type('json');
$this->response->body(json_encode(array(
    'html' => $this->response->body()
)));
return $this->response;



}

/**
* 候補者属性別×選考履歴&イベント統計情報
* 候補者属性別に分岐
* 
* @param  int    $rec_company_id 
* @param  array  $data
* @param  array  $result
* 
**/
private function getTrimAttrStat( $rec_company_id, $data )
{
    switch ( $data['attr'] ) {
        case '0':
        $sel_result = $this->SelStatChild->getSelLanguageStats( $rec_company_id, $data );
        $ev_result = $this->EvStatChild->getEvLanguageStats( $rec_company_id, $data );
        $result = $this->trimLanguageStats( $sel_result, $ev_result );
        break;

        case '1':
        $sel_result = $this->SelStatChild->getSelEducationStats( $rec_company_id, $data );
        $ev_result = $this->EvStatChild->getEvEducationStats( $rec_company_id, $data );
        $result = $this->trimEducationStats( $sel_result, $ev_result );
        break;

        case '2':
        $sel_result = $this->SelStatChild->getSelQualificationStats( $rec_company_id, $data );
        $ev_result = $this->EvStatChild->getEvQualificationStats( $rec_company_id, $data );
        $result = $this->trimQualificationStats( $sel_result, $ev_result );
        break;

        case '3':
        $sel_result = $this->SelStatChild->getSelCustomStats( $rec_company_id, $data );
        $ev_result = $this->EvStatChild->getEvCustomStats( $rec_company_id, $data );
        $result = $this->trimCustomStats( $sel_result, $ev_result );            
        break;

        default:
        $this->ErrorJson();
        break;
    }

    return $result;




}


/**
* 学歴の情報をレスポンスの形式に配列を整える
* 
* @param   array  $sel_result
* @param   array  $ev_result
* @return  array  $result
* 
* 
**/
private function trimEducationStats( $sel_result, $ev_result )
{

    $sel = $this->trimEducationSelStats( $sel_result );
    $ev = $this->trimEducationEvStats( $ev_result );

    $result = array( 'job_votes' => $sel, 'events' => $ev );
 
    return $result;
}

/**
* 学歴別選考履歴集計の情報をレスポンスの形式に配列を整える
* 
* @param  array  $seL_result
* @return array  $sel
* 
**/
private function trimEducationSelStats( $sel_result )
{
    $sel = array();
    foreach ($sel_result as $key => $value) {
        $job_vote_id = $value['sel_stat_children']['job_vote_id'];
        $screening_stage_id = $value['sel_stat_children']['screening_stage_id'];
        $select_status_id = $value['sel_stat_children']['select_status_id'];
        $rank = $value['schools']['school_rank'];

        $sel[$job_vote_id][$rank][$screening_stage_id] = array( 
            $select_status_id => $value[0]['count']
            );

    }


    return $sel;

}

/**
* 学歴別イベント集計の情報をレスポンスの形式に配列を整える
* 
* @param  array  $ev_result
* @return array  $ev
* 
**/
private function trimEducationEvStats( $ev_result )
{
    $ev = array();

    foreach ($ev_result as $key => $value) {
        $job_vote_id = $value[0]['job_vote_id'];
        $rank = $value['schools']['school_rank'];
        $count = $value[0]['can_count'];
        $ev_event_id = $value[0]['ev_event_id'];


        $ev[$ev_event_id][$job_vote_id][$rank] = $count;

    }

    return $ev;

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

    $sel = $this->trimLanguageSelStats( $sel_result );
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
private function trimLanguageSelStats( $sel_result )
{
    $sel = array();
    foreach ( $sel_result as $key => $value ) {
        $job_vote_id = $value['sel_stat_children']['job_vote_id'];
        $can_language = $value['can_languages']['foreign_language_id'];
        $screening_stage_id = $value['sel_stat_children']['screening_stage_id'];
        $select_status_id = $value['sel_stat_children']['select_status_id'];


     $sel[$job_vote_id][$can_language][$screening_stage_id] = array( 
        $select_status_id => $value[0]['count']
        );
 }

 return $sel;

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

/**
* 資格の情報をレスポンスの形式に配列を整える
* 
* @param   array  $sel_result
* @param   array  $ev_result
* @return  array  $result
* 
* 
**/
private function trimQualificationStats( $sel_result, $ev_result )
{
    $sel = $this->trimQualificationSelStats( $sel_result );
    $ev = $this->trimQualificationEvStats( $ev_result );

    $result = array( 'job_votes' => $sel, 'events' => $ev );

    return $result;

}

/**
* 学歴別選考履歴集計の情報をレスポンスの形式に配列を整える
* 
* @param  array  $seL_result
* @return array  $sel
* 
**/
private function trimQualificationSelStats( $sel_result )
{
    $sel = array();
    foreach ($sel_result as $key => $value) {
        $job_vote_id = $value['sel_stat_children']['job_vote_id'];
        $screening_stage_id = $value['sel_stat_children']['screening_stage_id'];
        $select_status_id = $value['sel_stat_children']['select_status_id'];
        $rank = $value['can_qualifications']['ev_event_id'];

        $sel[$job_vote_id][$rank][$screening_stage_id] = array( 
            $select_status_id => $value[0]['count']
            );

    }

    return $sel;




}

/**
* 学歴別イベント集計の情報をレスポンスの形式に配列を整える
* 
* @param  array  $ev_result
* @return array  $ev
* 
**/
private function trimQualificationEvStats( $ev_result )
{       

       $ev = array();

        foreach ($ev_result as $key => $value) {
        $job_vote_id = $value[0]['job_vote_id'];
        $rank = $value['can_qualifications']['qualification_id'];
        $count = $value[0]['can_count'];
        $ev_event_id = $value[0]['ev_event_id'];


        $ev[$ev_event_id][$job_vote_id][$rank] = $count;

    }

    return $ev;



} 
/**
* カスタムの情報をレスポンスの形式に配列を整える
* 
* @param   array  $sel_result
* @param   array  $ev_result
* @return  array  $result
* 
* 
**/
private function trimCustomStats( $sel_result, $ev_result )
{
    $sel = $this->trimCustomSelStats( $sel_result );
    $ev = $this->trimCustomEvStats( $ev_result );

    $result = array( 'job_votes' => $sel, 'events' => $ev );

    return $result;



}        

/**
* 学歴別選考履歴集計の情報をレスポンスの形式に配列を整える
* 
* @param  array  $seL_result
* @return array  $sel
* 
**/
private function trimCustomSelStats( $sel_result )
{
    $sel = array();
    foreach ($sel_result as $key => $value) {
        $job_vote_id = $value['sel_stat_children']['job_vote_id'];
        $screening_stage_id = $value['sel_stat_children']['screening_stage_id'];
        $select_status_id = $value['sel_stat_children']['select_status_id'];
        $rank = $value['can_custom_attributes']['can_custom_field_id'];

        $sel[$job_vote_id][$rank][$screening_stage_id] = array( 
            $select_status_id => $value[0]['count']
            );

    }

    return $sel;



}

/**
* 学歴別イベント集計の情報をレスポンスの形式に配列を整える
* 
* @param  array  $ev_result
* @return array  $ev
* 
**/
private function trimCustomEvStats( $ev_result )
{

    $ev = array();
       
    foreach ($ev_result as $key => $value) {
        $job_vote_id = $value[0]['job_vote_id'];
        $rank = $value['can_custom_attributes']['can_custom_field_id'];
        $count = $value[0]['can_count'];
        $ev_event_id = $value[0]['ev_event_id'];


        $ev[$ev_event_id][$job_vote_id][$rank] = $count;

    }

    return $ev;



} 


/**
* カスタム項目のリスト取得
* 
* @return array 
* 
* 
**/
private function getCustomData() 
{
    $this->loadModel('CanCustomField');

    $findParam = array(  
            'conditions' => array( 'CanCustomField.rec_company_id' => $this->getUserCompanyId(),
                                   'CanCustomField.status' => 0 ),
            'recusive' => -1,
            'fields' => array( 'CanCustomField.field_name' )
        );

    return $this->CanCustomField->find( 'list', $findParam );


}


    /**
    * ロックのかかった候補者IDを取得
    * @param mixed
    * @return array
    */
    public function getLockedCandidates($naviKey, $existCandidateIds) {

        $existIds = array_keys($existCandidateIds);
        // ロックがかかっているデータの取得
        return $this->CanCandidate->find('list',array(
            'recursive'  => -1,
            'fields'     => array('id', $naviKey),
            'conditions' => array(
                'id'  => $existIds,
                'NOT' => array('lock_role_flag'  => 0),
                )
            )
        );
    }

/**
* 選考履歴作成
* 
**/
public function SetSelHistory($can_candidate_id, $job_vote_id)
{
    $this->autoRender = false;

    //現在利用できる状態なのかを確認する
    if (!$this->CanCandidate->isUses($can_candidate_id)) {
        return json_encode(array(
            'status' => false,
            'data' => null,
            'msg' => 'Error!'
            ));
    }

    //データが編集不可能な場合の処理
    if(!$this->CanCandidate->isEdit($can_candidate_id)){
        return json_encode(array(
            'status' => false,
            'data' => null,
            'msg' => 'Error!'
            ));
    }

    //更新者ID
    $user_id = $this->CanCandidate->getUserInfo('id');

    //求人票情報
    $this->loadModel('JobVote');
    $options = $this->JobVote->getListDefaultConditions();
    $options['conditions']['JobVote.id'] = $job_vote_id;
    $options['fields'] = array('id', 'title');
    unset($options['conditions']['JobVote.wanted_year']);
    $JobVote = $this->JobVote->find('first', $options);
    if(empty($JobVote)){
        return json_encode(array(
            'status' => false,
            'data' => null,
            'msg' => 'Error!'
        ));
    }

    //選考段階
    $this->loadModel('ScreeningStage');
    $options = $this->ScreeningStage->getScreeningStage();
    $options['fields'] = array('id', 'name');
    $ScreeningStage = $this->ScreeningStage->find('all', $options);
    if(empty($ScreeningStage)){
        return json_encode(array(
            'status' => false,
            'data' => null,
            'msg' => 'Error!'
        ));
    }

   //選考履歴の登録
    $stages = array();
    foreach($ScreeningStage as $data){
        $stages[] = $data['ScreeningStage']['id'];
    }
    $history['SelHistory'] = array(
        'job_vote_id' => $job_vote_id,
        'can_candidate_id' => $can_candidate_id,
        'screening_stage_id' => $stages[0],
        'select_status_id' => 0,
        'status' => 0,
        'influx_propriety' => 1,
        'candidate_proprity' => 1,
        'last_modified_type' => 2,
        'rec_recruiter_id' => $user_id,
        'inf_staff_id' => 0,
        'lock_id' => 0,
    );
    $this->loadModel('SelHistory');
    $this->SelHistory->addNewSelHistory($history, $stages);

    $sel_stats = Configure::read('sel_status');

    $data = array(
        'job_vote_id' => $job_vote_id,
        'job_vote_name' => $JobVote['JobVote']['title'],
        'sel_screening_stage_name' => $ScreeningStage[0]['ScreeningStage']['name'],
        'select_status_name' => $sel_stats[0],
    );
    return json_encode(array(
        'status' => true,
        'data' => $data,
        'msg' => 'Success!'
    ));
}

/**
* イベント参加履歴作成
* 
**/
public function SetEvHistory($can_candidate_id, $ev_schedule_id)
{
    $this->autoRender = false;

    //現在利用できる状態なのかを確認する
    if (!$this->CanCandidate->isUses($can_candidate_id)) {
        return json_encode(array(
            'status' => false,
            'data' => null,
            'msg' => 'Error!'
            ));
    }

    //データが編集不可能な場合の処理
    if(!$this->CanCandidate->isEdit($can_candidate_id)){
        return json_encode(array(
            'status' => false,
            'data' => null,
            'msg' => 'Error!'
            ));
    }

    //更新者ID
    $user_id = $this->CanCandidate->getUserInfo('id');

    //イベント履歴
    $this->loadModel('EvHistory');
    $this->EvHistory->create();
    $insert['EvHistory'] = array(
        'can_candidate_id' => $can_candidate_id,
        'ev_schedule_id' => $ev_schedule_id,
        'rec_recruiter_id' => $user_id,
        'status' => 0,
    );
    if(!$this->EvHistory->save($insert)){
        return json_encode(array(
            'status' => false,
            'data' => null,
            'msg' => 'Error!'
        ));
    }

    //イベントスケジュール
    $this->loadModel('EvSchedule');
    $EvSchedule = $this->EvSchedule->find('first', array(
        'conditions' => array(
            'EvSchedule.id' => $ev_schedule_id,
            ),
        ));
    App::uses('EnjinHelper', 'View/Helper');
    $this->enjin = new EnjinHelper(new View());
    $holding_date = $this->enjin->getDateTime($EvSchedule['EvSchedule']['holding_date']);
    $data = array(
        'ev_event_id' => $EvSchedule['EvSchedule']['ev_event_id'],
        'individual_theme' => $EvSchedule['EvSchedule']['individual_theme'],
        'holding_date' => $holding_date,
        'ev_history_id' => $this->EvHistory->getLastInsertID(),
        );

    return json_encode(array(
        'status' => true,
        'data' => $data,
        'msg' => 'Success!'
        ));
}

/**
* イベント参加履歴 参加ステータス変更
* 
**/
public function UpdateEvHistory($ev_history_id, $status_id)
{
    $this->autoRender = false;

    $this->loadModel('EvHistory');
    $update['EvHistory'] = array(
        'id' => $ev_history_id,
        'status' => $status_id,
        );
    if(!$this->EvHistory->save($update)){
        return json_encode(array(
            'status' => false,
            'msg' => 'Error!'
            ));
    }
    return json_encode(array(
        'status' => true,
        'msg' => 'Success!'
    ));
}

/**
* カスタム属性追加
* 
**/
public function AddCustomField()
{
    $this->autoRender = false;

    $post = $this->request->data;
    $rec_company_id = $this->getUserCompanyId();
    $rec_recruiter_id = $this->CanCandidate->getUserInfo('id');
    $now = $this->CanCandidate->getDataSource()->expression('NOW()');

    $insert['canCustomFields'] = array(
        'created' => $now,
        'modified' => $now,
        'field_name' => $post['field_name'],
        'rec_company_id' => $rec_company_id,
        'rec_recruiter_id' => $rec_recruiter_id,
        'type' => $post['type'],
        'status' => 0,
    );

    if(empty($insert['canCustomFields']['field_name']) || (empty($insert['canCustomFields']['field_name']) && $insert['canCustomFields']['field_name'] !== 0)){
        return json_encode(array(
            'status' => false,
            'data' => null,
            'msg' => 'Error1!'
        ));
    }

    $this->loadModel('canCustomFields');
    if(!$this->canCustomFields->save($insert)){
        return json_encode(array(
            'status' => false,
            'data' => null,
            'msg' => 'Error2!'
        ));
    }

    $data = array(
        'id' => $this->canCustomFields->getLastInsertID(),
        'field_name' => $insert['canCustomFields']['field_name'],
        'type' => $insert['canCustomFields']['type'],
    );

    return json_encode(array(
        'status' => true,
        'data' => $data,
        'msg' => 'Success!'
    ));
}

/**
* カスタム属性チェック
* 
**/
public function CheckCustomFieldType($can_custom_field_id=null)
{
    $this->autoRender = false;

    $this->loadModel('canCustomFields');
    $options['conditions'] = array(
        'canCustomFields.id' => $can_custom_field_id,
     );
    $options['fields'] = array('type');
    $canCustomFields = $this->canCustomFields->find('first', $options);

    if(empty($canCustomFields)){
        return json_encode(array(
            'status' => false,
            'data' => null,
            'msg' => 'Error!'
        ));
    }
    return json_encode(array(
        'status' => true,
        'data' => $canCustomFields['canCustomFields']['type'],
        'msg' => 'Success!'
    ));
}

/**
* generate search options
*
*/
private function searchQueries($data = null){
    $conditions = $this->CanCandidate->getListDefaultConditions();
    $conditions['group'] = array('CanCandidate.id' );
    $conditions['limit'] = 1000;
    
    $paginate = array(
        'contain' => array(
            'CanEducation' => array(
                'School',
                'Undergraduate'
                ),
            'SelHistory' => array(
                'ScreeningStage'
                )
            ),
        );

    //screenStage.id init value
    $scrStage_id=0;
    //selHistory.select_status_id init value
    $selHis_ssid='';
    //refererCompany.id init value
    $refCom_id='';
    //evEvent.id init value
    $evEvent_id=0;
    //CanCandidate init values
    $lname='';
    $fname='';
    $email='';
    //selHistory.start_date init value
    $selHis_sdate='';
    //selHistory.end_date init value
    $selHis_edate='';

    if ($this->request->query)
        {//process request data
            $data = $this->request->query['data'];
            $selHisLoaded=0;

            if(!empty($data['ScreeningStage'])){
                $scrStage_id = $data['ScreeningStage'];
                $conditions['conditions']['ScreeningStage.id'] = $scrStage_id;
                $paginate['joins'][] = array(
                    'type' => 'INNER',
                    'table' => 'sel_histories',
                    'alias' => 'SelHistory',
                    'conditions' => 'CanCandidate.id = SelHistory.can_candidate_id'
                    );
                $selHisLoaded=1;

                $paginate['joins'][] = array(
                    'type' => 'INNER',
                    'table' => 'screening_stages',
                    'alias' => 'ScreeningStage',
                    'conditions' => 'SelHistory.screening_stage_id = ScreeningStage.id'
                    );
            }

            if(!empty($data['select_status_id'])){
                $selHis_ssid = $data['select_status_id'];
                $conditions['conditions']['SelHistory.select_status_id'] = $selHis_ssid;
                
                if(!$selHisLoaded)
                    $paginate['joins'][] = array(
                        'type' => 'INNER',
                        'table' => 'sel_histories',
                        'alias' => 'SelHistory',
                        'conditions' => 'CanCandidate.id = SelHistory.can_candidate_id'
                        );
                $selHisLoaded=1;
            }

            if(!empty($data['RefererCompany'])){
                $refCom_id = $data['RefererCompany'];
                $conditions['conditions']['CanCandidate.referer_company_id'] = $refCom_id;

            }

            if(!empty($data['EvEvent'])){
                $evEvent_id = $data['EvEvent'];
                $conditions['conditions']['EvSchedule.ev_event_id'] = $evEvent_id;

                $paginate['joins'][] = array(
                    'type' => 'INNER',
                    'table' => 'ev_histories',
                    'alias' => 'EvHistory',
                    'conditions' => 'CanCandidate.id = EvHistory.can_candidate_id'
                    );

                $paginate['joins'][] = array(
                    'type' => 'INNER',
                    'table' => 'ev_schedules',
                    'alias' => 'EvSchedule',
                    'conditions' => 'EvHistory.ev_schedule_id = EvSchedule.ev_event_id'
                    );
            }

            if(!empty($data['last_name'])){
                $lname = $data['last_name'];
                $conditions['conditions']['CanCandidate.last_name LIKE'] = '%'.$lname.'%';
            }

            if(!empty($data['first_name'])){
                $fname = $data['first_name'];
                $conditions['conditions']['CanCandidate.first_name LIKE'] = '%'.$fname.'%';
            }

            if(!empty($data['mail_address'])){
                $email = $data['mail_address'];
                $conditions['conditions']['CanCandidate.mail_address'] = $email;
            }

            if(!empty($data['start_date'])){
                $selHis_sdate = $data['start_date'];
                $conditions['conditions']['SelHistory.start_date >='] = $data['start_date'];
                
                if(!$selHisLoaded)
                    $paginate['joins'][] = array(
                        'type' => 'INNER',
                        'table' => 'sel_histories',
                        'alias' => 'SelHistory',
                        'conditions' => 'CanCandidate.id = SelHistory.can_candidate_id'
                        );
                $selHisLoaded=1;
            }

            if(!empty($data['end_date'])){
                $selHis_edate = $data['end_date'];
                $conditions['conditions']['SelHistory.end_date <='] = $data['end_date'];

                if(!$selHisLoaded)
                    $paginate['joins'][] = array(
                        'type' => 'INNER',
                        'table' => 'sel_histories',
                        'alias' => 'SelHistory',
                        'conditions' => 'CanCandidate.id = SelHistory.can_candidate_id'
                        );
            }
        }

        $this->set( compact('scrStage_id', 'selHis_ssid', 'refCom_id', 'evEvent_id', 'lname', 'fname', 'email', 'selHis_sdate', 'selHis_edate') );
        return array_merge($paginate, $conditions);
    }
}
