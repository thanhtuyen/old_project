<?php
App::uses('AppController', 'Controller');
/**
 * JobVotes Controller
 *
 * @property JobVote $JobVote
 * @property PaginatorComponent $Paginator
 */
class JobVotesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    protected $_model = 'JobVote';

    protected $_listMethods = array('api_get', 'api_update','api_list');

/**
 * index method
 *
 * @return void
 */
    public function index() {
        $this->loadModel('ScreeningStage');
        $this->loadModel('SelStat');
        $this->loadModel('RecDepartment');
        $this->JobVote->recursive = 2;
        $this->Paginator->settings = array(
            'conditions'=>array(
                'RecDepartment.rec_company_id' => $this->getLoginUser('rec_company_id'),
                'JobVote.wanted_year' => SessionComponent::read('WantedYear'),
                'JobVote.status' =>0 ),
            'fields' => array('JobVote.id', 'JobVote.title', 'JobVote.jobtype_id', 'JobVote.wanted_person', 'JobVote.wanted_deadline'
                ,'JobVote.status', 'JobVote.start_date', 'JobVote.created', 'JobVote.modified', 'RecruitmentArea.area', 'RecDepartment.department_name'
                ),
            'contain' => array('RecruitmentArea', 'SelStat','RecDepartment','EvEvent','JobOfferStaff' => array( 'RecRecruiter' => 'RecDepartment' )),
            'limit' => 10
        );

        $result=$this->paginate("JobVote");
        $this->set('jobVotes', $result);

//        get job type
        $jobType=$this->getSystemConfig("job_type");
        $this->set(compact('jobType'));

        //get list status
        $status=$this->getSystemConfig("status");
        $this->set(compact('status'));

//        load screen stage
        $condtions = $this->ScreeningStage->getListDefaultConditions();
        $screeningStages = $this->ScreeningStage->find('list', $condtions);
        $this->set(compact('screeningStages'));

        //ロールによるviewの出力変更処理
        switch ( SessionComponent::read('Auth.User.role_type') ){
            case ROLE_TYPE_RECRUITER:   //採用担当者
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
        if (!$this->JobVote->exists($id)) {
        //if (!$this->JobVote->isUses($id)) {
            throw new NotFoundException(__('Invalid job vote'));
        }
        
        if( !$this->JobVote->isRecruiterUse( $id ) )
        {
            throw new NotFoundException(__('Invalid job vote'));
        }
        
        $options = array('conditions' => array('JobVote.' . $this->JobVote->primaryKey => $id));
        $jobVote = $this->JobVote->find('first', $options);

        //募集エリア
        $this->loadModel('RecruitmentArea');
        $this->RecruitmentArea->recursive = -1;
        $options = array('conditions' => array('RecruitmentArea.rec_company_id'=>$jobVote['JobVote']['recruitment_area_id']));
        $recruitmentArea = $this->RecruitmentArea->find('first', $options);

        //最終更新担当者
        $this->loadModel('RecRecruiter');
        $this->RecRecruiter->recursive = 0;
        $this->RecRecruiter->unbindModel(array(
                'belongsTo' => array('FacManager'),
            )
        );
        $recRecruiter = array();
        $options = array('conditions' => array('RecRecruiter.id'=>$jobVote['JobVote']['rec_recruiter_id']));
        $recRecruiter = $this->RecRecruiter->find('first', $options);
        if(!empty($recRecruiter)) {
            $company_id = $recRecruiter['RecDepartment']['rec_company_id'];
            $this->loadModel('RecDepartment');

            //求人担当者リスト
            $options = array(
                'join' => array(
                    'type'  => 'LEFT',
                    'table' => 'rec_departments',
                    'alias' => 'RecDepartment',
                    'conditions' => 'RecDepartment.id = RecRecruiter.rec_department_id'
                ),
                'conditions' => array(
                    'RecDepartment.rec_company_id' => $company_id,
                    'NOT' => array('RecRecruiter.id' => $jobVote['JobVote']['rec_recruiter_id'])
                )
            );
            $this->RecRecruiter->unbindModel(array(
                    'belongsTo' => array('FacManager'),
                )
            );
            $recruiterLists = array();
            $recruiters = $this->RecRecruiter->find('all',$options);
            foreach($recruiters as $key => $recruiter) {
                $recruiterLists[$recruiter['RecRecruiter']['id']] = $recruiter['RecRecruiter']['name'];
            }
        }

        //求人担当者
        //debug($jobVote['JobOfferStaff']);
        $staffs = $jobVote['JobOfferStaff'];
        foreach($staffs as $key => $staff) {
            $name = $this->RecRecruiter->getRecRecruiterInfo($staff['rec_recruiter_id']);
            $jobVote['JobOfferStaff'][$key]['name'] = $name['RecRecruiter']['name'];
        }


        //イベントリスト
        $this->loadModel('EvEvent');
        $eventLists = $this->EvEvent->find('list',array(
            'conditions' => array(
                'EvEvent.status' => array(0,1,2),
                'EvEvent.job_vote_id'  =>  array(0),
            )
        ));

        //流入元企業
        $this->loadModel('RefererCompany');
        $this->RefererCompany->recursive = -1;
        $infJobVotePublic = $jobVote['InfJobVotePublic'];
        foreach($infJobVotePublic as $key => $data) {
            $options = array('conditions' => array('RefererCompany.referer_company_id'=>$data['referer_company_id']));
            $info = $this->RefererCompany->findById($data['referer_company_id']);
            $jobVote['InfJobVotePublic'][$key]['RefererCompany'] = $info['RefererCompany'];
        }

        //流入元企業リスト
        $options = array('conditions' => array('RefererCompany.rec_company_id'=>$jobVote['RecDepartment']['rec_company_id']));
        $recCompanies = $this->RefererCompany->find('list',$options);

        //設定値
        $jobStatus = $this->getSystemConfig("job_status");

       // debug($jobVote);
        $this->set(compact('jobVote','jobStatus','recruiterLists','recRecruiter','recruitmentArea','recCompanies','eventLists'));
    }


/**
 * add method
 *
 * @return void
 */
    public function add() {
        if ($this->request->is('post')) {
            $this->request->data['JobVote']['wanted_deadline']=$this->request->data['JobVote']['wanted_deadline'].' '.$this->request->data['wanted_deadline_time'];
            $this->request->data['JobVote']['start_date']=$this->request->data['JobVote']['start_date'].' '.$this->request->data['start_date_time'];
            $this->JobVote->create();
            if ($this->JobVote->save($this->request->data)) {
                $this->Session->setFlash('登録が完了しました。');
                $this->redirect(array('action'=>'add'));
            }
        }
        $this->getEditData();
        //ロールによるviewの出力変更処理
        switch ( SessionComponent::read('Auth.User.role_type') ){
            case ROLE_TYPE_RECRUITER:   //採用担当者
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
        if (!$this->JobVote->exists($id)) {
            //if (!$this->JobVote->isUses($id)) {
            throw new NotFoundException(__('Invalid job vote'));
        }
        
        if( !$this->JobVote->isRecruiterUse( $id ) )
        {
            throw new NotFoundException(__('Invalid job vote'));
        }
        
        if ($this->request->is(array('post', 'put'))) {
            // join date time
            $this->request->data['JobVote']['wanted_deadline']=$this->request->data['JobVote']['wanted_deadline'].' '.$this->request->data['JobVote']['wanted_deadline_time'];
            $this->request->data['JobVote']['start_date']=$this->request->data['JobVote']['start_date'].' '.$this->request->data['JobVote']['start_date_time'];

            if ($this->JobVote->save($this->request->data)) {
                $this->Session->setFlash('変更が完了しました。');
                return $this->redirect(array('action'=>'index'));
            }
        } else {
            $options = array('conditions' => array('JobVote.' . $this->JobVote->primaryKey => $id));
            $this->JobVote->recursive=0;
            $result=$this->JobVote->find('first', $options);
            $this->request->data=$result;
            //split date time
            $wanted_deadline_date=$this->splitDatetime($result['JobVote']['wanted_deadline'],0);
            $wanted_deadline_time=$this->splitDatetime($result['JobVote']['wanted_deadline'],1);
            //set date variable
            $this->request->data['JobVote']['wanted_deadline']=$wanted_deadline_date;
            $this->request->data['JobVote']['wanted_deadline1']=$wanted_deadline_date;
            $this->request->data['JobVote']['wanted_deadline_time']=$wanted_deadline_time;

            $start_date_date=$this->splitDatetime($result['JobVote']['start_date'],0);
            $start_date_time=$this->splitDatetime($result['JobVote']['start_date'],1);

            $this->request->data['JobVote']['start_date']=$start_date_date;
            $this->request->data['JobVote']['start_date1']=$start_date_date;
            $this->request->data['JobVote']['start_date_time']=$start_date_time;
        }
        $this->getEditData();

        //ロールによるviewの出力変更処理
        switch ( SessionComponent::read('Auth.User.role_type') ){
            case ROLE_TYPE_RECRUITER:   //採用担当者
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
        $this->JobVote->id = $id;
        //if (!$this->JobVote->exists($id)) {
        if (!$this->JobVote->isUses($id)) {
            throw new NotFoundException(__('Invalid job vote'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->JobVote->delete()) {
            return $this->flash(__('The job vote has been deleted.'), array('action' => 'index'));
        } else {
            return $this->flash(__('The job vote could not be deleted. Please, try again.'), array('action' => 'index'));
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
                switch($this->JobVote->getUserInfo('role_type')){
                    case ROLE_TYPE_REFERER:
                        $userId = $this->JobVote->getUserInfo('id');
                        $findParam = $this->getCommonListPararms('JobVote');

                        $data = $this->JobVote->getReferertData($userId,$findParam);

                        $this->renderJson($data);
                        exit;
                    default:
                        $userCompanyId = $this->getUserCompanyId();
                        $findParam = $this->getCommonListPararms('JobVote');

                        $findParam['fields'] =  array('title');
                        $findParam['recursive'] = 0;
                        $data = $this->JobVote->find('list', $findParam );

                        $this->renderJson($data);
                        exit;
                }
    }

/**
 * open method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function open($id = null) {
        $this->JobVote->id = $id;
        if (!$this->JobVote->exists()) {
            throw new NotFoundException(__('Invalid job vote'));
        }

    }

/**
 * target method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function target($id = null) {
        $this->JobVote->id = $id;
        if (!$this->JobVote->exists()) {
            throw new NotFoundException(__('Invalid job vote'));
        }

    }

    /**
     *
     * 登録変更のときに利用するデータをセットする
     *
     *
     *
     **/
    private function getEditData()
    {
        $recDepartments = $this->JobVote->RecDepartment->find('list',array('conditions'=>array('RecDepartment.rec_company_id'=>$this->getLoginUser("rec_company_id"), 'RecDepartment.status'=>0)));
        $condition = $this->JobVote->RecruitmentArea->getDefaultConditions();
        $recruitmentAreas = $this->JobVote->RecruitmentArea->find('list',array('conditions' => $condition ));


        //設定値
        $jobType = $this->getSystemConfig("job_type");
        $jobStatus = $this->getSystemConfig("job_status");
        $this->set(compact('recDepartments', 'recruitmentAreas', 'recRecruiters', 'jobStatus', 'jobType'));

    }


    /**
    * 求人票別採用コスト
    *
    **/
    public function getRecruitCost()
    {

        $rec_company_id = $this->getUserCompanyId();
        $year = $this->getWantedYear();

        if( empty( $year ) || empty( $rec_company_id ) ) {
            return false;
        }

        $this->loadModel('SelStat');

        $data['year'] = $year;

        $result = $this->SelStat->getRecruitCost( $rec_company_id, $data );

        $trim_result = $this->trimRecruitCost( $result );

        return $trim_result;

    }

    /**
    * 求人票別採用コスト
    * レスポンスの形式に整える
    *
    * @param   array  $result
    * @return  array  $trim_result
    **/
    private function trimRecruitCost( $result )
    {
        $trim_result = array();
        foreach ($result as $key => $value) {
            $job_vote_id = $value['job_votes']['id'];

            $fixed_unit_price = 0;
            $income_ratio = 0;
            $unlimited_fixed_annual = 0;
            $count1 = 0;
            $count2 = 0;
            $count3 = 0;

            if( isset( $value[0]['unlimited_fixed_annual'] ) ) {
                $unlimited_fixed_annual = $value[0]['unlimited_fixed_annual'];

            }

            if( isset( $value[0]['count1'] ) ) {
                $count1 = $value[0]['count1'];
            } 
            if( isset( $value[0]['count2'] ) ) {
                $count2 = $value[0]['count2'];  
            } 
            if( isset( $value[0]['count3'] ) ) {
                $count3 = $value[0]['count3'];
            } 


            switch ($value['inf_contracts']['contract_type']) {
                case '1':
                    $fixed_unit_price += $value[0]['fixed_unit_price'] * $count1;
                    break;

                case '3':
                        $income_ratio += $value[0]['count3'] * $value[0]['income_ratio'] / 100;
                    if( isset( $value['can_candidates']['inf_contract_id'] )  ) {
                       $income_ratio += $income_ratio * $value[0]['income_ratio_val'] * $count2;
                        
                    } else {
                        if( isset( $value['inf_job_vote_public']['inf_contract_id'] )  ) {
                            switch ($value['inf_job_vote_public']['inf_contract_id']) {
                                case '1':
                                    $fixed_unit_price += $value[0]['fixed_unit_price'] * $count1;
                                    break;

                                case '3':
                                    $income_ratio += $income_ratio * $value[0]['income_ratio_val'] * $count2;
                                    break;
                            }
                        }
                    }
                    break;
                
            }



            $trim_result[$job_vote_id] = array(
                    'name' => $value['job_votes']['title'],
                    'count' => $value[0]['count'],
                    'count1' => $count1,
                    'count2' => $count2,
                    'count3' => $count3,
                    'fixed_unit_price' => $fixed_unit_price,
                    'income_ratio' => $income_ratio,
                    'unlimited_fixed_annual' => $unlimited_fixed_annual,
                    'holding_cost' => $value[0]['holding_cost'],
                    'total' => $fixed_unit_price +
                               $income_ratio + 
                               $unlimited_fixed_annual
                );

        }

        return $trim_result;

    }

    /**
     *
     *
     *
     *
     **/
    public function setterWantedYear()
    {
            $this->setWantedYear('2015');
    }


    public function api_set_wanted_year(){
        if ($this->request->is(array('post'))) {
            $year = $this->request->data('year');

            if (!is_numeric($year) || $year < 0) {
                throw new NotFoundException(__('The parameters is not valid'));
            }
            $this->setWantedYear($year);
            $this->renderJson(array('code'=>0));
        }
        throw new NotFoundException(__('Unknown method'));
    }
    /*
     * function format date follow database
     *
     */
    private function formatDate($datetime)
    {
        $d_format="";
        $split=explode('/',$datetime);

        if(count($split)>2)
        {
            $d_format=$split[2].'-'.$split[0].'-'.$split[1];
        }
        return $d_format;
    }

    /*
    * split date time
    */

    private function splitDatetime($datetime=null,$i=0)
    {
        $str="";
        if($datetime!=null)
        {
            $split=explode(' ',$datetime);
            if($i==0 || $i==1){
                $str=$split[$i];
            }
        }
        return $str;
    }


    /*public function get($id = null) {
        $this->JobVote->recursive = -1;
        //if (!$this->JobVote->exists($id)) {
        if (!$this->JobVote->isUses($id)) {
            throw new NotFoundException(__('Invalid job vote'));
        }
        throw new NotFoundException(__('Unknown method'));
    }*/


    public function api_status(){
        $statusData = array(
            'id' => $this->request->data('id'),
            'status' => $this->request->data('status')
        );
        $this->request->data = $statusData;
        $this->api_update();
    }


    protected function prepareDataForUpdate(){
        $this->checkCompany();
        $status = $this->request->data('status');
        if (!in_array($status, array(0,1,9))){
            throw new Exception("The status is not in range!");
        }
        return $this->request->data;
    }

    /**
     * get parameter to get list
     * @return array|void
     */
    public function getParameterForGetList()
    {

        $conditions = array(
            $this->_model->alias.'.status' => 0,
            'RecDepartment.rec_company_id' => $this->getUserCompanyId(),
            'RecCompany.status' => 0,
        );
        $joins = array(
            array(
                'type' =>'left',
                'table' => 'rec_departments',
                'alias' => 'RecDepartment',
                'conditions' => array(
                    $this->_model->alias.'.rec_department_id = RecDepartment.id'
                )
            ),
            array(
                'type' =>'left',
                'table' => 'rec_companies',
                'alias' => 'RecCompany',
                'conditions' => array(
                    'RecCompany.id = RecDepartment.rec_company_id'
                )
            )
        );
        $options['conditions'] = $conditions;
        $options['joins'] = $joins;
        $options['fields'] = array($this->_model->alias.'.id', $this->_model->alias.'.title');
        $this->_model->recursive = -1;
        return $options;
    }

    /**
     * Get method
     * @param null $id
     */
    public function api_get($id = null) {
        $this->checkMethod('api_get');
        $this->_currentObject = $this->_model->isUsing($id);
        if (!$this->_currentObject) {
            $this->ErrorJson();
            return;
        }
        $this->beforeRenderGet();
        $job_type=$this->getSystemConfig("job_type");
        $this->_currentObject['jobtype_id']=$job_type[$this->_currentObject['jobtype_id']];
        $this->loadModel('RecruitmentArea');
        $this->_currentObject['recruitment_area_id']=$this->RecruitmentArea->getName($this->_currentObject['recruitment_area_id']);
        // format date
        $wanted_deadline = new DateTime($this->_currentObject['wanted_deadline']);
        $this->_currentObject['wanted_deadline']=$wanted_deadline->format('Y/m/d');

        $start_date = new DateTime($this->_currentObject['start_date']);
        $this->_currentObject['start_date']=$start_date->format('Y/m/d h:m');
        $this->renderJson( $this->_currentObject);
    }
}
