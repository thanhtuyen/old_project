<?php
App::uses('AppController', 'Controller');
/**
 * RecDepartments Controller
 *
 * @property RecDepartment $RecDepartment
 * @property PaginatorComponent $Paginator
 */
class RecDepartmentsController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $components = array('Paginator');
    protected $_model = 'RecDepartment';

    protected $_listMethods = array('api_add','api_delete');


    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $this->loadModel('RecCompany');
        $this->loadModel('RecRecruiter');

        $this->RecCompany->recursive = 1;
        $this->set( "RecCompany" ,$this->RecCompany->findById($this->getUserCompanyId() ));
        

        $options = array(
            'conditions'=>array( 
                'RecDepartment.rec_company_id' => $this->getUserCompanyId() 
            )
         );
         
        $this->RecRecruiter->recursive = 0;
        $this->Paginator->settings = $options;
		$this->set('RecRecruiters', $this->Paginator->paginate('RecRecruiter'));
        
        $this->RecDepartment->recursive = -1;
        $datas = $this->RecDepartment->find('all', $options);

        foreach( $datas as & $row ) {
            if ( !empty( $row['RecDepartment']['parent_id'] )) {
                $row['RecDepartment']['parent_name'] = $this->RecDepartment->getName( 
                                                        $row['RecDepartment']['parent_id'] ); 
            }
        }
        $this->set( "RecDepartments" ,$datas );

        $parent = $this->RecDepartment->find('list', $options);

        $this->set( 'parentRecDepartments',$parent);
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        if (!$this->RecDepartment->exists($id)) {
            throw new NotFoundException(__('Invalid rec department'));
        }
        $options = array('conditions' => array('RecDepartment.' . $this->RecDepartment->primaryKey => $id));
        $this->set('recDepartment', $this->RecDepartment->find('first', $options));
    }

/**
 * add method
 *
 * @return void
 */
    public function add() {

        $role_type = $this->getLoginUser('role_type');
        if ($this->request->is('post')) {

            // ロールチェック
            $saveData = $this->RecDepartment->checkByRole($this->request->data, $role_type);

             //check parent id
            if(!empty($saveData['RecDepartment']['parent_id'])){
                $check = $this->RecDepartment->find('first',array('conditions'=> array(
                    'RecDepartment.rec_company_id'=> $this->getUserCompanyId(),
                    'RecDepartment.id'=> $saveData['RecDepartment']['parent_id']
                    )));
                if(!$check){
                    $this->Session->setFlash(__('The deparment parent is invalid.'));
                    return $this->redirect($this->referer());
                }
            }

            $this->RecDepartment->create();
            if ($this->RecDepartment->save($saveData)) {

                $this->Session->setFlash(__('The rec department has been saved.'));
                
            }
        }

        return $this->redirect($this->referer());

        /*list( $recCompanies, $parentRecDepartments, $facManagers ) = $this->RecDepartment->getSelectList($role_type);

        $this->set(compact('parentRecDepartments', 'recCompanies', 'facManagers'));
        
        //ロールによるviewの出力変更処理
        switch ($role_type){
            case ROLE_TYPE_MANAGER: //運営管理者
                $this->render('add_manager');
                return;
            case ROLE_TYPE_RECRUITER:   //採用担当者
                $this->render('add_recruiter');
                return;
            default:
                throw new NotFoundException(__('not access authorizations'));
        }*/
        
        
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function edit($id = null) {
        $role_type = $this->getLoginUser('role_type');
        if (!$this->RecDepartment->exists($id)) {
            throw new NotFoundException(__('Invalid rec department'));
        }
        if ($this->request->is(array('post', 'put'))) {
            // ロールチェック
            $saveData = $this->RecDepartment->checkByRole($this->request->data, $role_type);
            if ($this->RecDepartment->save($this->request->data)) {
                return $this->flash(__('The rec department has been saved.'), array('action' => 'index'));
            }
        } else {
            $options = array('conditions' => array('RecDepartment.' . $this->RecDepartment->primaryKey => $id));
            $this->request->data = $this->RecDepartment->find('first', $options);
        }

        list( $recCompanies, $parentRecDepartments, $facManagers ) = $this->RecDepartment->getSelectList($role_type);

        $this->set(compact('parentRecDepartments', 'recCompanies', 'facManagers'));

        //ロールによるviewの出力変更処理
        switch ( $role_type ){
            case ROLE_TYPE_MANAGER: //運営管理者
                $this->render('edit_manager');
                return;
            case ROLE_TYPE_RECRUITER:   //採用担当者
                $this->render('edit_recruiter');
                return;
            default:
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
        $this->RecDepartment->id = $id;
        if (!$this->RecDepartment->exists()) {
            throw new NotFoundException(__('Invalid rec department'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->RecDepartment->delete()) {
            $this->Session->setFlash(__('The rec department has been deleted.'));
        } else {
            $this->Session->setFlash(__('The rec department could not be deleted. Please, try again.'));
        }
        return $this->redirect($this->referer());
    }

    /**
     *
     * lists method
     * アクターが採用担当者
     *
     * @throws 
     * @param 
     * @return void
     */
        public function lists() 
        {
            $this->getUserDepartmentList( $this->getUserCompanyId() );
        }

    /**
     *
     * lists method
     * アクターが採用担当者
     *
     * @throws 
     * @param 
     * @return void
     */
        public function listsByParant( $id = null ) 
        {
            $this->getUserDepartmentListByParant( $id, $this->getUserCompanyId() );
        }


        
    /**
     * getDepartmentList
     * アクターが運用担当者
     * 
     * 
     * 
     * 
     **/
    public function getDepartmentList( $company_id )
    {
        if ( empty( $company_id ) ) {
            $company_id = $this->params['url']['data']['RecDepartment']['rec_company_id'];
        }
        
        $this->getUserDepartmentList( $company_id );
    }

    /**
     * get data for insert object recDepartment
     * @return array
     * @throws Exception
     */
    public function prepareDataForInsert()
    {
        $post = $this->request->data;

        $recCompanyId = $this->getUserCompanyId();

        $parent_id = isset($post['parent_id'])?$post['parent_id']:"";

        $this->loadModel('RecCompany');

        $recCompany = $this->RecCompany->findById($recCompanyId);

        //check rec_company exist
        if(empty($recCompany)) {
            throw new Exception('Rec company Id not valid');
        }

        $post['rec_company_id'] = $recCompanyId;
        //check parent_id exits and then check status
        if($parent_id) {
            $conditions = array(
                'RecDepartment.rec_company_id' => $this->getUserCompanyId(),
                'RecDepartment.status' => 0,
                'RecDepartment.id' => $parent_id
            );
            $recDepartment = $this->RecDepartment->find('first',array(
                'conditions' => $conditions
            ));
            if(empty($recDepartment)) {
                throw new Exception('Parent Id not valid');
            }
        }

        return $post;
    }

    
    /**
     * 
     * 一覧を取得する
     * 
     * 
     * 
     * 
     **/
    private function getUserDepartmentList( $company_id = null)
    {
        if (  empty( $company_id ) ) {
            $this->renderJson(array());
            return;
        }
        
        $findParam = $this->getCommonListPararms('RecDepartment');
        $findParam['fields'] =  array('department_name');
        $findParam['recursive'] = 0;
        $findParam['conditions'] = array("RecDepartment.rec_company_id" => $company_id);
        $data = $this->RecDepartment->find('list', $findParam );
        $this->renderJson($data);
    }

    /**
     * 
     * 親IDに紐付く一覧を取得する
     * 
     * 
     * 
     * 
     **/
    private function getUserDepartmentListByParant( $id, $company_id = null)
    {
        if (  empty( $company_id ) ) {
            $this->renderJson(array());
            return;
        }
        
        $findParam = $this->getCommonListPararms('RecDepartment');
        $findParam['fields'] =  array('department_name');
        $findParam['recursive'] = 0;
        $findParam['conditions'] = array("RecDepartment.rec_company_id" => $company_id, 
                                        'RecDepartment.parent_id' => $id );
        $data = $this->RecDepartment->find('list', $findParam );
        $this->renderJson($data);
    }

    

}
