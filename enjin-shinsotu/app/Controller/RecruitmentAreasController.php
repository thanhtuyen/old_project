<?php
App::uses('AppController', 'Controller');
/**
 * RecruitmentAreas Controller
 *
 * @property RecruitmentArea $RecruitmentArea
 * @property PaginatorComponent $Paginator
 */
class RecruitmentAreasController extends AppController {

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
        $this->RecruitmentArea->recursive = 0;

        $this->Paginator->settings = array( 'conditions'=>array(
                                                'RecruitmentArea.rec_company_id' => $this->getUserCompanyId(),
                                                'RecruitmentArea.status'=>0 ) 
                                        );
                                                                
        $this->set('recruitmentAreas', $this->Paginator->paginate());
        
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

        if (!$this->RecruitmentArea->isUses($id)) {
            throw new NotFoundException(__('Invalid recruitment area'));
        }
        $this->RecruitmentArea->recursive = 0;
        $options = array('conditions' => array('RecruitmentArea.' . $this->RecruitmentArea->primaryKey => $id));
        $this->set('recruitmentArea', $this->RecruitmentArea->find('first', $options));

        //ロールによるviewの出力変更処理
        switch ( SessionComponent::read('Auth.User.role_type') ){
            case ROLE_TYPE_RECRUITER:   //採用担当者
                break;
            default:    //上記のロール以外はアクセスする権利がないので強制終了
                throw new NotFoundException(__('not access authorizations'));
        }

    }

/**
 * add method
 *
 * @return void
 */
    public function add() {
        if ($this->request->is('post')) {
            $this->RecruitmentArea->create();
            if ($this->RecruitmentArea->save($this->request->data)) {
                return $this->flash(__('The recruitment area has been saved.'), array('action' => 'index'));
            }
        }

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
    public function edit() {
        if ($this->request->is(array('post')))
        {
            if(isset($this->request->data['status'])){
                $company_id = $this->getUserCompanyId();
                if($this->request->data['status']=="addnew")
                {
                    if(isset($this->request->data['area'])){
                    $data = array('area' => $this->request->data['area'], 'rec_company_id' => $company_id, 'status' =>0);
                    $this->RecruitmentArea->create();
                    $this->RecruitmentArea->save($data);
                    return $this->redirect(array('action' => 'index'));
                    }
                }else if($this->request->data['status']=="delete")
                {
                    $result=$this->RecruitmentArea->find("first",array('rec_company_id' => $company_id,"id"=>$this->request->data['id']));
                    if(count($result)>0){
                        $this->RecruitmentArea->id=$this->request->data['id'];
                        $this->RecruitmentArea->delete();
                        return $this->redirect(array('action' => 'index'));
                    }
                }
            }else{
                $this->RecruitmentArea->saveMany($this->request->data);
            }
        }

        // load list RecruitmentArea
        $this->set("RecruitmentArea",$this->RecruitmentArea->find('all',array(
                'conditions'=>array('RecruitmentArea.rec_company_id' => $this->getUserCompanyId(),
                'RecruitmentArea.status'=>0)
                )
        ));

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
        $this->RecruitmentArea->id = $id;
        if (!$this->RecruitmentArea->exists()) {
            throw new NotFoundException(__('Invalid recruitment area'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->RecruitmentArea->delete()) {
            return $this->flash(__('The recruitment area has been deleted.'), array('action' => 'index'));
        } else {
            return $this->flash(__('The recruitment area could not be deleted. Please, try again.'), array('action' => 'index'));
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
            $findParam = $this->getCommonListPararms('RecruitmentArea');
            
            $findParam['fields'] =  array('area');
            $findParam['recursive'] = 0;
            $findParam['conditions'] = array("RecruitmentArea.rec_company_id" => $userCompanyId);
             $data = $this->RecruitmentArea->find('list', $findParam );

            $this->renderJson($data);
            exit;
    }
}
