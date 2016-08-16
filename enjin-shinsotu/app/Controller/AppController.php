<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    const FOCAL_TYPE_RECRUITER    = 0;
    const FOCAL_TYPE_INTERVIEWER  = 1;

    const LIST_LIMIT = 40;

    const FILE_UPLOAD_SIZE_LIMIT = 2000000;

    private $isLoadConfig = false;
    public $components = array();
    public $helpers = array( 'Enjin' );

    /**
     * The main model
     * @var
     */
    protected $_model;

    /**
     * The object retrieve from isUsing function
     * This var will be use after called isUsing function of the model
     * @var
     */
    protected $_currentObject;

    /**
     * List methods
     * override it and set the methods you want to make it available
     * @var array
     */
    protected $_listMethods = array('api_get', 'api_list', 'api_update', 'api_add', 'api_delete');
    
    /*
    *  construct
    */
    public function __construct($request = null, $response = null) {
        parent::__construct($request, $response);
        
        
        $this->components = array( 'Session', 'Paginator', 'RequestHandler');
        $this->components['Auth'] = $this->setLoginSession();
        $this->_model = $this->{$this->_model};
    }

    /**
     * ///////////////////////// Private functions ///////////////////////////////
     */
    /*
    *  認証情報を追加
    *
    *  @return Array
    */
    private function setLoginSession() {

        $class_name = get_class($this);
        $class_type = str_replace('Controller', '', $class_name);

        switch ($class_type) {
            case "Manages":

                $form = array(
                    'userModel'=>'fac_managers',
                    'fields' => array('username' => 'mail' , 'password'=> 'password'),
                    'passwordHasher' => 'Blowfish'
                );

                return $this->getAuthSettings($class_type, $form);

                break;

            case "Companies":

                $form = array(
                    'userModel'=>'rec_recruiters',
                    'fields' => array('username' => 'mail' , 'password'=> 'password'),
                    'scope' => array('rec_recruiters.focal_point_type' => self::FOCAL_TYPE_RECRUITER),
                    'passwordHasher' => 'Blowfish'
                );

                return $this->getAuthSettings($class_type, $form);
                break;

            case "Interviewers":

                $form =  array(
                    'userModel'=>'rec_recruiters',
                    'fields' => array('username' => 'mail' , 'password'=> 'password'),
                    'scope' => array('rec_recruiters.focal_point_type' => self::FOCAL_TYPE_INTERVIEWER),
                    'passwordHasher' => 'Blowfish'
                );

                return $this->getAuthSettings($class_type, $form);

                break;

            case "Referers":

                $form =  array(
                    'userModel'=>'inf_staffs',
                    'fields' => array('username' => 'id' , 'password'=> 'password'),
                    'passwordHasher' => 'Blowfish'
                );

                return $this->getAuthSettings($class_type, $form);
                break;

            default:
                break;
        }
    }

    private function getAuthSettings($class_type, $form) {

        return array(
            'authenticate' => array(
                'Form' => $form
            ),
            //ログインページ
            'loginAction' => array(
                'controller'=> $class_type,
                'action'=> 'login'
            ),
            //ログイン後に表示するページ
            'loginRedirect' => array(
                'controller' => $class_type,
                'action' => 'dashbord'
            ),
            //ログアウト後に遷移するページ
            'logoutRedirect' => array(
                'controller' => $class_type,
                'action' => 'login',
                'home'
            ),

            'allow'=>'',
        );
    }

    /**
     *
     * 初期設定の年月を取得する
     *
     **/
    private function getWantedYearDefault()
    {
        $date = new DateTime();

        $next = (int) $date->format("Y") + 1;
        $now =  (int) $date->format("Y");

        $this->loadModel('JobVote');
        $year = $this->JobVote->getMinWantedYear();
        if ($year === false ) {
            $year = $now;
        }

        $sub = $next - $year;
        ;
        $result = array();
        for( $i = 0; $i<=$sub ; $i++ )
        {
            $result[ $now + $i ] = $now + $i;
        }

        return $result;

    }


    /**
     * ///////////////////////// Protected functions ///////////////////////////////
     */
    /**
     * 
     * configの値を取得する
     * 
     * @param string
     * @return mixed
     * 
     **/
    protected function getSystemConfig( $name = null )
    {
        if ( is_null( $name ) ) return false;
        
        return Configure::read( $name );
        
    }

    /*
    *  コントローラーの前に読み込まれる
    */
	function beforeFilter() {
        
        $wanted_year = array();

        // 認証されていなければloginへ
        if (!$this->Auth->loggedIn() && $this->action != 'login'){
            $this->redirect(array('controller' => 'Companies', 'action' => 'login'));
        }
        
         // 求人票年返却
        if ( $this->isInterviewer() || $this->isRecruiter()) {
            $wanted_year = $this->getVoteList();
            $this->set(compact('wanted_year'));
        }

        $userInfo = SessionComponent::read('Auth.User');
        $this->set(compact('userInfo'));

        //Vu:need review, layouts/default.ctp:118
	    if ( !( $wantedyear = $this->getWantedYear() ) ){
	        $array = $this->getWantedYearDefault();
	        $wantedyear = $this->setDefaultWantedYear( $array );
	    }

        $this->set(compact('wantedyear'));
        //end modify
    }

    /*
    *   custom error layout
    *   if no this, CakePHP loads layout:'default' then loads layout:'default' again
    */
    function beforeRender() {
        if($this->name == 'CakeError') {
            $this->layout = 'raw';
        }
    }

    /*
    *  渡された配列をJSONにエンコードしてすべてのヘッダを送信する
    *
    *  @return void
    */
    protected function renderJson($data) {
            if (isset($this->request->query['debug'])) {
                    $this->set('data', json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                    $this->render('/debug/index');
            } else {
                    $this->response->type('application/json');
                    $this->response->body(json_encode($data, JSON_UNESCAPED_UNICODE));
            }
            $this->response->send();
            exit;
    }
    
    /**
     * errorJSon
     * 異常レスポンスを返却する
     **/
    protected function errorJSon()
    {
        $this->response->type('application/json');
        $this->response->statusCode(400);
        
        $this->response->send();
        exit;
        
    }
    
    /**
     * noResJSon
     * 正常なステータスコードのみを返却する
     **/
    protected function noResJSon()
    {
        $this->response->type('application/json');
        $this->response->statusCode(200);
        
        $this->response->send();
        exit;
        
    }
    

    /**
    * エラーチェックしてErrorJsonに投げるだけのメソッド
    * @param boolean $check
    */
    protected function checkErrorJson($check) {

        if ($check)
        {
            $this->ErrorJson();
        }
    }
    
    /*
    *  セッションから、ログインユーザーが運営管理者か返却する
    *
    *  @return booleam
    */
    protected function isManager() {
        return SessionComponent::read('Auth.User.role_type') == ROLE_TYPE_MANAGER;
    }
    /*
    *  セッションから、ログインユーザーが採用担当者か返却する
    *
    *  @return booleam
    */
    protected function isRecruiter() {
        return SessionComponent::read('Auth.User.role_type') == ROLE_TYPE_RECRUITER;
    }
    /*
    *  セッションから、ログインユーザーが面接官か返却する
    *
    *  @return booleam
    */
    protected function isInterviewer() {
        return SessionComponent::read('Auth.User.role_type') == ROLE_TYPE_INTERVIEWER;
    }
    /*
    *  セッションから、ログインユーザーが流入元担当者か返却する
    *
    * 　@return booleam
    */
    protected function isReferer() {
        return SessionComponent::read('Auth.User.role_type') == ROLE_TYPE_REFERER;
    }

    /*
    *  セッションから、ユーザー企業IDを返却する
    *  
    * @return int
    */
    protected function getUserCompanyId() {
        return SessionComponent::read('Auth.User.rec_company_id');
    }

    /*
    * ログインユーザーに適合する求人票の年代を返却する
    */
    protected function getVoteList() {
        
        $result = array();
        
        if ( empty( $this->getUserCompanyId() )) return array();
        
        $date = new DateTime();
        $now =  (int) $date->format("Y");
        $max = 2;
        for($i=0; $i<=$max;$i++ ){
            $result[$now+$i] = $now+$i;
        }

        $user = SessionComponent::read('Auth.User');
        $this->loadModel('JobVote');
        $userVote = $this->JobVote->find('all', array(
               'recursive' => -1,
               'fields' => array('DISTINCT JobVote.wanted_year as wanted_year'),
               'conditions' => array('JobVote.rec_department_id' => $user['rec_department_id']),
           )
        );
        // 配列整理
        foreach ($userVote as $votes) {
            $tmp = array_shift($votes);
            $result[$tmp['wanted_year']] = $tmp['wanted_year'];
        }

        arsort($result, SORT_NUMERIC);
        return $result;
    }

    /**
     *  一覧を作成する際に利用する共通部分
     *
     * @return array
     */
    protected function getCommonListPararms($tableName)
    {

        $result =  array();
        if ( !empty( $this->request->query('nums')) ){
            $result['limit'] =  $this->request->query('nums');
        }
        if ( !empty($this->request->query('start') ) ){
            $result['offset'] =  $this->request->query('start');
        }
        if ( !empty( $this->request->query('sort') ) ){
            $result['order'] = array($tableName.'.'.$this->request->query('sort').' asc' );
            
            if( !empty( $this->request->query('order') ) ){
                $result['order'] = array($tableName.'.'.$this->request->query('sort')." ".$this->request->query('sort') );
            }
        }
                        
        return $result;
       
    }
    
    /**
     * 
     * 表示するviewの名前を取得する
     * 
     * @param void
     * @return string  ex)add_manager edit_recruiter ..etc
     * @thorw exception
     * 
     **/
    protected function getRenderViewName()
    {
        switch ( SessionComponent::read('Auth.User.role_type') ){
            case ROLE_TYPE_MANAGER: //運営管理者
                $roll = "manager";
                break;
                
            case ROLE_TYPE_RECRUITER:   //採用担当者
                $roll = "recruiter";
                break;
            case ROLE_TYPE_INTERVIEWER:
                $roll = "interviewer";
                break;
            case ROLE_TYPE_REFERER:
                $roll = "referer";
                break;
            default:
                throw new NotFoundException(__('not access authorizations'));
        }
        
        return sprintf( "%s_%s",strtolower( $this->action ), $roll );
        
    }
    
    /**
     * 
     * ユーザー情報の取得
     * 
     * @param string
     * @return mixed
     *
     **/
    protected function getLoginUser( $coulmn_name = null )
    {
        if ( !is_null( $coulmn_name ) ){
            $name = sprintf("Auth.User.%s",$coulmn_name);
        }else{
            $name = "Auth.User";
        }
        $result = $this->Session->read( $name );
        
        if ( empty( $result ) ) return false;
        
        return $result;
        
    
    }
    
    
    /**
     * 
     * セッションに現在表示を行っている年度を保存する
     * 
     * @param int
     * 
     * @reutrn void
     * 
     **/
    protected function setWantedYear( $year = null )
    {
        $this->Session->write('WantedYear', $year);
        
    }
    
    /**
     * 
     * セッションに保存されている年度を取得する
     * 
     * @param void
     * @return int
     **/
    protected function getWantedYear()
    {
        return $this->Session->read('WantedYear');
    }
    
    /**
     * 
     * 年度になにも設定されていないときの初期設定
     * 
     * @param array
     * @return void
     * 
     **/
    protected function setDefaultWantedYear( $yearArray= array() )
    {
    
        if ( !(empty($yearArray))){
            $this->setWantedYear( min(array_keys( $yearArray )) );
        }
    }

    /**
    * 年度をDBのdate型に合うように変換する
    * format : Y → Y-00-00
    *  
    * @param   int    $year
    * @return  date  $year   
    * 
    **/
    protected function toYear( $year )
    {
        return date( 'Y-00-00', strtotime( $year ) );
    }

    /**
     * ThinhNH
     * Check the method is available or not
     * @param $method
     */
    protected function checkMethod($method){
        if (!in_array($method, $this->_listMethods)){
            throw new NotFoundException(__('The method is not available'));
        }
    }

    /**
     * ThinhNH
     * prepare request data before update to data
     * @return array
     */
    protected function prepareDataForUpdate(){
        return $this->request->data;
    }

    /**
     * ThinhNH
     * Prepare the request data before insert
     * @return array
     */
    protected function prepareDataForInsert(){
        return $this->request->data;
    }


    /**
     * Check file valid
     * return file object with binary
     * @param $file
     * @return array
     * @throws Exception
     */
    protected function checkValidFileUpload($file){
        $maxSize = self::FILE_UPLOAD_SIZE_LIMIT; // max size of file
        $temp = explode(".", $file["name"]);
        $extension = end($temp);
        $filename = $temp[0];
        if ($file["size"] < $maxSize) {
            if ($_FILES["file"]["error"] > 0) {
                throw new Exception("Upload file error: " . $file["error"]);

            } else {
                $binary = file_get_contents($file["tmp_name"]);
                return array(
                    'name' => $filename,
                    'extension' => $extension,
                    'binary' => $binary
                );
            }
        } else {
            throw new Exception("File size not allow");
        }
    }


    /**
     * ThinhNH
     * Prepare current object before render
     * @return mixed
     */
    protected function beforeRenderGet(){
        $this->_currentObject = $this->_currentObject[$this->_model->alias];
    }

    /**
     * tuyenNT
     * return parameter for get list object
     * @return array
     */
    protected function getParameterForGetList(){
        $this->_model->recursive = -1;
        $conditions = array($this->_model->alias.'.status' => 0);
        $joins = array();
        return array(
            'conditions' => $conditions,
            'joins' => $joins
        );
    }

    /**
     * Check company is available or not
     * @throws Exception
     */
    protected function checkCompany(){
        // check company id
        $this->loadModel('RecCompany');
        $companyId = $this->getUserCompanyId();
        $conditions = array(
            'RecCompany.status'=> 0,
            'RecCompany.id' => $companyId
        );

        $company = $this->RecCompany->find('first',array('conditions' => $conditions));
        if (!$company){
            throw new Exception('The company is null');
        }
    }
    
    protected function getSpaceOption( $name = null)
    {
        $space = array( ""=>"" );
        
        if ( empty( $name ) ) return $name;
        
        $data = $this->getSystemConfig('type');
        
        return  $space + $data ;
    
    }
    
    /**
     * 
     * 内容が完全に空なのかを判定する
     * 
     * @param array
     * @param string
     * 
     * @return mixed
     **/
    protected function isOriginalEmpty( $array , $name ) 
    {
       if ( !isset( $array[ $name ] ) ) return false;
       
       if ( $array[ $name ] === "" ) return false;
       
       return $array[ $name ];
    }
    
    
    /**
     * ///////////////////////// Public functions ///////////////////////////////
     */


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
            //throw new NotFoundException(__('Invalid object'));
        }
        $this->beforeRenderGet();
        $this->renderJson( $this->_currentObject);
    }



    /**
     * Update method
     * Type: Post
     * @return JSON format
     */
    public function api_update(){
        $this->checkMethod('api_update');
        if ($this->request->is(array('post', 'put'))) {
            $id = $this->request->data('id');
            $this->_currentObject = $this->_model->canUpdate($id);
            if (!$this->_currentObject) {
                throw new NotFoundException(__('The object is not available'));
            }
            $data = $this->prepareDataForUpdate();
            $this->_model->set($data);
            if (!$this->_model->validates()){
                throw new NotFoundException($this->_model->getValidateMessage());
            }
            if ($this->_model->save($data)) {
                $this->renderJson(array('code'=>0));
            }else {
                throw new NotFoundException(__('Can not update object'));
            }
        }
        throw new NotFoundException(__('Unknown method'));

    }


    /**
     * New make function
     * @method POST
     * @return JSON FORMAT
     */
    public function api_add(){
        $this->checkMethod('api_add');
        if ($this->request->is(array('post', 'put'))) {
            $data = $this->prepareDataForInsert();
            $this->_model->set($data);
            if (!$this->_model->validates()){
                throw new NotFoundException($this->_model->getValidateMessage());
            }
            if ($this->_model->save($data)) {
                $this->renderJson(array('code'=>0));
            }else {
                throw new NotFoundException(__('Can not insert object'));
            }
        }
        throw new NotFoundException(__('Unknown method'));

    }

    /**
     * ThinhNH
     * Delete object
     * @param null $id
     * @throws Exception
     */
    public function api_delete($id = null) {

        $ids = explode(',', $id);
        $this->checkMethod('api_delete');

        foreach($ids as $id) {

            //check condition before delete
            if(!$this->_model->canDelete($id)) {
                throw new Exception('Please check condition delete');
            }

            $this->_model->{$this->_model->primaryKey} = $id;
            if (!$this->_model->exists()) {
                throw new NotFoundException(__('Object with Id is '.$id.' not found'));
            }
            if(!$this->_model->delete()){
                throw new Exception('Can not delete object with Id is '.$id);
            }
        }
        $this->renderJson(array('code'=>0));

    }


    /**
     * TuyenNT
     * get list object
     * @method GET
     * @param bool $parameter
     * @throws NotFoundException
     * @return JSON FORMAT
     */
    public function api_list()
    {
        $this->checkMethod('api_list');
        $options = $this->getParameterForGetList();
        if (!isset($options['order'])){
            $options['order'] = array(
                $this->_model->alias.'.'.$this->_model->primaryKey .' ASC'
            );
        }
        $object = $this->_model->find('all', $options);
        if (!$object) {
            throw new NotFoundException(__('No object'));
        }

        $this->renderJson($object);
    }
}
