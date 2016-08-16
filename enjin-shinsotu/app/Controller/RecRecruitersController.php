<?php
App::uses('AppController', 'Controller');
/**
 * RecRecruiters Controller
 *
 * @property RecRecruiter $RecRecruiter
 * @property PaginatorComponent $Paginator
 */
class RecRecruitersController extends AppController {

/**
 * Components
 *
 * @var array
 */
public $components = array('Paginator');


    protected  $_model = "RecRecruiter";
    protected  $_listMethods = array('api_delete');
    


    /**
     * 
     * 動作前設定
     * 
     * 
     * 
     **/

   
    public function beforeFilter(){

    }

    /**
    * index method
    *
    * @return void
    */
    public function index(){
        $user = SessionComponent::read('Auth.User');

        $this->RecRecruiter->recursive = -1;

        //ロールによる出力内容の変更
        switch( $user['role_type'] ){
            case ROLE_TYPE_MANAGER: //運営管理者
            $this->set('recRecruiters', $this->Paginator->paginate());
            break;

            case ROLE_TYPE_RECRUITER:   //採用担当者
            $recDepartments = $this->RecRecruiter->RecDepartment->find('list', 
                array('conditions'=>
                    array( 'RecDepartment.rec_company_id'=> $this->getUserCompanyId(),
                        'RecDepartment.status'        => 0
                    )
                )
            );

            $focalPointType = $this->getSystemConfig("focal_point_type");
            //自身が所属している会社の情報のみを取得する
            $recRecruiter = $this->RecRecruiter->findById($user['id']);

            $this->set(compact('focalPointType', 'recRecruiter', 'recDepartments'));
            break;
            
            default:
            throw new NotFoundException(__('not access authorizations'));
        }

        $this->set('user', $user);
    }

    /**
    * view method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function view($id = null){
        if(!$this->RecRecruiter->exists($id)){
            throw new NotFoundException(__('Invalid rec recruiter'));
        }
        if (!$this->RecRecruiter->isUses($id)) {
            throw new NotFoundException(__('not access authorizations'));
        }

        $options=array('conditions' =>
            array( 'RecDepartment.rec_company_id' => $this->getUserCompanyId()
            )
        );
        $this->RecRecruiter->recursive = -1;

        $recDepartments = $this->RecRecruiter->RecDepartment->find('list', $options);

        $this->set('focalPointType', $this->getSystemConfig("focal_point_type"));
        $this->set('recDepartments', $recDepartments);
        $this->set('recRecruiter', $this->RecRecruiter->findById($id));
    }

    /**
    * add method
    *
    * @return void
    */
    public function add(){
        if($this->request->is('post')){
            $this->RecRecruiter->create();
            switch( SessionComponent::read('Auth.User.role_type') ){
                case ROLE_TYPE_MANAGER: //運営管理者
                if(  $user_id = $this->getLoginUser( 'id' ) ){
                    $this->request->data['RecRecruiter']['password1'] = $this->request->data['RecRecruiter']['password'];
                    $this->request->data['RecRecruiter']['fac_manager_id'] = $user_id;
                }
            }
            //process data
            $this->RecRecruiter->recursive = -1;
            $this->request->data['RecRecruiter']['approval_flag'] = 1 - $this->request->data['RecRecruiter']['approval_flag'];
            
            $exists = $this->RecRecruiter->find('count',
                array('conditions' => array('mail' => $this->request->data['RecRecruiter']['mail'])));
            
            //var_dump( $this->request->data);exit;
            
            if($exists)
            $this->Session->setFlash(__('The email address is already in use.'));
            else{
                $p1=$this->Auth->password($this->request->data['RecRecruiter']['password']);
                $p2=$this->Auth->password($this->request->data['RecRecruiter']['password1']);

                if($p1 != $p2){
                    $this->Session->setFlash(__('The Password field does not match the password confirmation field.'));
                }else{
                    //var_dump( $this->request->data);exit;
                    if(($tmp = $this->RecRecruiter->save($this->request->data))){
                        $this->Session->setFlash(__('The rec recruiter has been added.'));
                        $this->redirect(array('controller' => 'rec_recruiters', 'action' => 'view', $tmp['RecRecruiter']['id']));
                    }
                }
            }
            //flip back status when form fail
            $this->request->data['RecRecruiter']['approval_flag'] = 1 - $this->request->data['RecRecruiter']['approval_flag'];
        }

        //ロールによるviewの出力変更処理
        switch( SessionComponent::read('Auth.User.role_type') ){
            case ROLE_TYPE_MANAGER: //運営管理者
                //企業名
                $this->loadModel( 'RecCompany' );
                $wRecCompany = $this->RecCompany->find('list');
                
                $this->loadModel( 'RecDepartment' );
                $this->set('listRecDepartment', $this->RecDepartment->find('list', array( 'conditions'=>array( 'RecDepartment.rec_company_id'=> key($wRecCompany) ) )));
                $this->set('wRecCompany', $wRecCompany);
                
                //共通
                $this->set('focalPointType', $this->getSystemConfig("focal_point_type") );

                //最初の企業の部署を取得
                $this->render( $this->getRenderViewName() );
                break;
            case ROLE_TYPE_RECRUITER:   //採用担当者
                $this->setEditData();
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
    public function edit($id = null){

        if(!$this->RecRecruiter->exists($id)){
            throw new NotFoundException(__('Invalid rec recruiter'));
        }
        if (!$this->RecRecruiter->isUses($id)) {
            throw new NotFoundException(__('not access authorizations'));
        }

        //for status translation
        $status = array(1, 0);

        if($this->request->is(array('post'))){
            if(empty($this->request->data['RecRecruiter']['approval_flag']))
            $this->request->data['RecRecruiter']['approval_flag'] = 0;

            $this->request->data['RecRecruiter']['approval_flag'] = $status[$this->request->data['RecRecruiter']['approval_flag']];
        
            if($this->RecRecruiter->save($this->request->data)){
                $this->Session->setFlash(__('The rec recruiter has been saved.'));
                $this->redirect(array('controller' => 'rec_recruiters', 'action' => 'index'));
            }
            else{
                throw new NotFoundException(__('Save failed.'));
            }
        } else{
            $this->RecRecruiter->recursive = -1;
            $recRecruiter = $this->RecRecruiter->findById($id);
            $this->request->data = $recRecruiter;
            $this->set(compact( 'recRecruiter', 'status' ));
        }

        $this->setEditData();

        //ロールによるviewの出力変更処理
        switch( SessionComponent::read('Auth.User.role_type') ){
            case ROLE_TYPE_MANAGER: //運営管理者
            case ROLE_TYPE_RECRUITER:   //採用担当者
            $this->render( $this->getRenderViewName() );
            break;
            default:    //上記のロール以外はアクセスする権利がないので強制終了
            throw new NotFoundException(__('not access authorizations'));
        }
    }

    /**
    * password method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function password($id = null){

        if(!$this->RecRecruiter->exists($id)){
            throw new NotFoundException(__('Invalid rec recruiter'));
        }
        
        if(!$this->RecRecruiter->isUses($id)) {
            throw new NotFoundException(__('not access authorizations'));
        }

        $this->RecRecruiter->recursive = -1;
        $recRecruiter = $this->RecRecruiter->findById($id);
        $this->set(compact( 'recRecruiter' ));
        
        if($this->request->is(array('post','put'))){
            $passwordHasher = new BlowfishPasswordHasher();
            if ( $passwordHasher->check($this->request->data['RecRecruiter']['password'], $recRecruiter['RecRecruiter']['password']) ){
                if ( $this->request->data['RecRecruiter']['password1'] === $this->request->data['RecRecruiter']['password2']){
                    $this->request->data['RecRecruiter']['password'] = $this->request->data['RecRecruiter']['password1'];
                    if($this->RecRecruiter->save($this->request->data, true)){
                        $this->Session->setFlash('パスワードの変更が完了しました。');
                        $this->redirect(array('controller' => 'rec_recruiters', 'action' => 'index'));
                    }
                }
            }

            $this->Session->setFlash('パスワードの変更に失敗しました。');
        }
        
        //clean up
        unset($this->request->data['RecRecruiter']['password']);
        unset($this->request->data['RecRecruiter']['password1']);
        unset($this->request->data['RecRecruiter']['password2']);


        //ロールによるviewの出力変更処理
        switch( SessionComponent::read('Auth.User.role_type') ){
            case ROLE_TYPE_MANAGER: //運営管理者
            case ROLE_TYPE_RECRUITER:   //採用担当者
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
    public function delete($id = null){
        $this->RecRecruiter->id = $id;
        if(!$this->RecRecruiter->exists()){
            throw new NotFoundException(__('Invalid rec recruiter'));
        }
        $this->request->allowMethod('post', 'delete');
        if($this->RecRecruiter->delete()){
            $this->Session->setFlash(__('The rec recruiter has been deleted.'));
        } else{
            $this->Session->setFlash(__('The rec recruiter could not be deleted. Please, try again.'));
        }
        $this->redirect($this->referer());
    }

    public function lists(){
        $this->RecRecruiter->recursive = -1;
        $data = $this->RecRecruiter->find('list');
        $this->renderJson($data);
    }


        /**
    * 部署に紐付く採用担当者取得
    * @param  int  $id
    * 
    **/
    public function listBydepartment( $id )
    {
        $this->getUserList( $id, $this->getUserCompanyId() );

    }

    /* -*-*-*-*-*-*-*-*-*- 以下private -*-*-*-*-*-*-*-*-*- */

    /**
    * setEditData
    * 
    * 追加・変更時に利用するデータをロールごとに切り替えて取得とセットを行う
    * 
    * @param void
    * @return void
    * 
    **/
    private function setEditData(){

        //共通
        $focalPointType = $this->getSystemConfig("focal_point_type");

        //取得内容の変更が必要
        switch( SessionComponent::read('Auth.User.role_type') ){
            case ROLE_TYPE_MANAGER: //運営管理者
            $recCompanies = $this->RecRecruiter->RecDepartment->RecCompany->find('list');
            $recDepartments = $this->RecRecruiter->RecDepartment->find('list');
            $this->set(compact('focalPointType','status','facManagers', 'recDepartments','recCompanies'));
            break;
            default:
            $recDepartments = $this->RecRecruiter->RecDepartment->find('list', 
                array('conditions'=>
                    array( 'RecDepartment.rec_company_id'=> $this->getUserCompanyId(),
                        'RecDepartment.status'        => 0 
                    )
                )
            );
            $this->set(compact('focalPointType','status','facManagers', 'recDepartments'));
        }
    }


    /**
    * 採用担当者取得
    * 
    * @param  int    $department_id 
    * @param  int    $company_id
    **/
    private function getUserList( $department_id, $company_id = null )
    {
        if( empty( $company_id ) ) {
            $this->renderJson( array() );
            return;
        }

        $child_id = $this->getChildId( $department_id );
        $child_id[] = $department_id;

        $findParam = $this->getCommonListPararms('RecRecruiter');
        $findParam['fields'] =  array( "name" );
        $findParam['recursive'] = 0;
        $findParam['conditions'] = array("RecDepartment.rec_company_id" => $company_id, 
                                         'RecRecruiter.rec_department_id' => $child_id, 
                                         'RecRecruiter.status' => 0 );

        $this->RecRecruiter->virtualFields['name']='concat( RecRecruiter.last_name, RecRecruiter.first_name )';
        $data = $this->RecRecruiter->find('list', $findParam );
        $this->renderJson($data);


    }

    /**
    * 部署IDから子IDを取得する
    * 
    * @param   int   $department_id
    * @return  array $res
    **/
    private function getChildId( $department_id )
    {
        
            $conditions['conditions'] = array( 
                'RecDepartment.rec_company_id' => $this->getUserCompanyId() 
                                        );
            $conditions['recursive'] = -1;
            $conditions['fields'] = array(  'parent_id' );
            $this->loadModel('RecDepartment');
            $data = $this->RecDepartment->find( 'list', $conditions );

            $result = array();
            $res = array();
            foreach( $data as $id => $parent_id ) {
                
                foreach ($data as $ky => $val) {
                    if( empty( $val ) ) continue;


                    if( $val == $id ) {
                        $result[$id][$ky] = $ky;
                        $array[] = $ky;
                    }
                            
                }
                

            }

            foreach ($result as $key => $value) {
                foreach ($array as $ky => $val) {

                    if( $val == $key ) {
                        $res = array_merge( $result[$key], $result[$department_id]);
                        
                    }

                }
            }


            return $res;


    }

}
