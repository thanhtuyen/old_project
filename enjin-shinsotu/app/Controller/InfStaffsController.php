<?php
App::uses('AppController', 'Controller');
/**
 * InfStaffs Controller
 *
 * @property InfStaff $InfStaff
 * @property PaginatorComponent $Paginator
 */
class InfStaffsController extends AppController {

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
            switch($this->InfStaff->getUserInfo('role_type')){
                case ROLE_TYPE_REFERER:
                    $refererCompanyId = $this->InfStaff->getUserInfo('referer_company_id');

                    $this->InfStaff->recursive = 0;

                    $this->Paginator->settings = array(
                        'conditions' => array("RefererCompany.id" => $refererCompanyId , 'InfStaff.status' => '0','RefererCompany.status' => '0')
                    );

                    $this->set('infStaffs', $this->Paginator->paginate());
                    break;
                default :
                    $this->InfStaff->recursive = 0;
                    $this->set('infStaffs', $this->Paginator->paginate());
                    break;
            }

            //設定値の設定
            $status = $this->getSystemConfig("status");
            $this->set(compact('status'));
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null) {
                switch ( SessionComponent::read('Auth.User.role_type') ){
                    case ROLE_TYPE_MANAGER: //運営管理者
                            break;
                    case ROLE_TYPE_RECRUITER:   //採用担当者
                            //$this->render( $this->getRenderViewName() );
                            break;
                    default:    //上記のロール以外はアクセスする権利がないので強制終了
                            throw new NotFoundException(__('not access authorizations'));
                }

                if (!$this->InfStaff->exists($id)) {
            throw new NotFoundException(__('Invalid InfStaff'));
        }
        $options = array('conditions' => array('InfStaff.' . $this->InfStaff->primaryKey => $id));
        $infStaff = $this->InfStaff->find('first', $options);
        $this->set('infStaff', $infStaff);

        // Referer Status
        $inf_status = $this->getSystemConfig("inf_status");
        $this->set(compact('inf_status'));
    }

/**
 * add method
 *
 * @param int   //該当する流入元企業のID
 * @return void
 */
    public function add( $id = null) {
        
        //該当流入元企業IDが利用できるかを確認する
        $this->loadModel( 'RefererCompany' );
        switch ( SessionComponent::read('Auth.User.role_type') ){
            case ROLE_TYPE_RECRUITER:   //採用担当者
                if ( !$this->RefererCompany->isUses( $id ) ) throw new NotFoundException(__('not access authorizations'));
                break;
            default:    //上記のロール以外はアクセスする権利がないので強制終了
                throw new NotFoundException(__('not access authorizations'));
        }
        
        
        if ($this->request->is('post')) {
            $this->InfStaff->create();
            //流入元企業IDの設定
            switch ( SessionComponent::read('Auth.User.role_type') ){
                case ROLE_TYPE_REFERER: //流入元担当者
                    $this->request->data['InfStaff']['referer_company_id'] = $this->InfStaff->getUserInfo('referer_company_id');
                case ROLE_TYPE_RECRUITER:   //採用担当者
                    $this->request->data['InfStaff']['referer_company_id'] = $id;
                    $this->request->data['InfStaff']['rec_recruiter_id'] = $this->InfStaff->getUserInfo('id');
                    
                    break;
            }
            if ($this->InfStaff->save($this->request->data)) {
                $this->Session->setFlash('流入元担当者の追加が完了しました。');
                return $this->redirect(array('controller'=>'RefererCompanies','action' => 'detail',$id));
            }
        }
                
        // Referer Status
        $inf_status = $this->getSystemConfig("inf_status");
        $this->set(compact('inf_status'));
        
        $this->set( 'id',$id );
        
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id        //該当するユーザーのID
 * @return void
 */
    public function edit($id = null) {
        //if (!$this->InfStaff->exists($id)) {
        if (!$this->InfStaff->isUses($id)) {
            throw new NotFoundException(__('Invalid inf staff'));
        }
        $options = array('conditions' => array('InfStaff.' . $this->InfStaff->primaryKey => $id));
        $infStaff = $this->InfStaff->find('first', $options);
        if ($this->request->is(array('post', 'put'))) {
                        //流入元企業IDの設定
                        switch ( SessionComponent::read('Auth.User.role_type') ){
                            case ROLE_TYPE_RECRUITER: //採用担当者
                                $this->request->data['InfStaff']['rec_recruiter_id'] = $this->InfStaff->getUserInfo('id');
                                break;
                        }
            if ($this->InfStaff->save($this->request->data)) {
                return $this->flash(__('The inf staff has been saved.'), array('action' => 'detail',$id));
            }
        } else {
            $this->request->data = $infStaff;
        }

                //設定値
        $status = $this->getSystemConfig("status");
                
        $recRecruiters = $this->InfStaff->RecRecruiter->find('list');
        $refererCompanies = $this->InfStaff->RefererCompany->find('list');
        $this->set(compact('status','recRecruiters', 'refererCompanies','infStaff'));
                
        //ロールによるviewの出力変更処理
        switch ( SessionComponent::read('Auth.User.role_type') ){
            case ROLE_TYPE_REFERER: //流入元担当者
                        $this->render('edit_referer');
                        return;
                    case ROLE_TYPE_RECRUITER:
                        $this->render( $this->getRenderViewName() );
                        return;
                    default:
                        return;
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
        $this->InfStaff->id = $id;
        //if (!$this->InfStaff->exists()) {
        if (!$this->InfStaff->isUses($id)) {
            throw new NotFoundException(__('Invalid inf staff'));
        }
                
        $this->request->allowMethod('post', 'delete');
        if ($this->InfStaff->delete()) {
                        return $this->flash(__('The inf staff has been deleted.'), array('action' => 'index'));
        } else {
            return $this->flash(__('The inf staff could not be deleted. Please, try again.'), array('action' => 'index'));
        }
    }
/**
 * lists method
 * ログインしている流入元担当者の所属している流入元企業の流入元担当者一覧の取得
 * @throws 
 * @param 
 * @return void
 */
    public function lists() {
        switch (SessionComponent::read('Auth.User.role_type') ){
            case ROLE_TYPE_MANAGER:
            case ROLE_TYPE_RECRUITER:
            case ROLE_TYPE_INTERVIEWER:
                break;
            case ROLE_TYPE_REFERER:
                $userId = SessionComponent::read('Auth.User.id');

                $bufRefererCompanyId = $this->InfStaff->find('list',array(
                    'recursive' => -1,
                    'fields' => array('referer_company_id'),
                    'conditions' => array('InfStaff.id' => $userId),
                ));

                $refererCompanyId = $bufRefererCompanyId[$userId];

                $findParam = $this->getCommonListPararms('InfStaff');

                $findParam['fields'] =  array( 'id','last_name','first_name', 'mail_address','unique_id');
                $findParam['recursive'] = 0;
                $findParam['conditions'] = array("RefererCompany.id" => $refererCompanyId , 'InfStaff.status' => '0','RefererCompany.status' => '0');
                $data = $this->InfStaff->find('all', $findParam );

                $this->renderJson($data);
                exit;
                break;
        }
    }
}
