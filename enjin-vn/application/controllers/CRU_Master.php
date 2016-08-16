<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/Enjin_Controller.php';

/**
 * The Parent Controller for CRU Controller
 * @author ThinhNH
 *
 */
class CRU_Master extends Enjin_Controller {

	protected $_model;

	/**
	 * The can_candidate_id field name in current table
	 * To check with the canCandidateId in Session
	 * @var string
	 */
	protected $_candidateIdFkKey = 'can_candidate_id';

	/**
	 * construct
	 * @param $model
	 */
	public function __construct($model)
	{
		parent::__construct();
		$this->load->model($model, 'model');
		$this->_model = $this->model;

		//get canCandidateId from the session and set to the database
		$this->_model->setCanCandidateId($this->getCanCandidateId());


		//check API
		$this->chekapikey();
	}

	/**
	 * Return the ID of the object
	 * For child controller re-define it  (required)
	 * @throws Exception
	 */
	protected function getParameterId(){
		throw new Exception('Unknown Error!', REST_ER_PAGE_NOTFOUND);
	}

	/**
	 * Check validates
	 * For child controller re-define it
	 * @param bool $postData
	 * @return bool
	 */
	protected function checkValidations($postData = false){
		return true;
	}

	/**
	 * For child controller re-define it (required)
	 * @throws Exception
	 */
	protected function prepareInsertData(){
		throw new Exception('Unknown Error!', REST_ER_PAGE_NOTFOUND);
	}

	/**
	 * For child controller re-define it (required)
	 * @throws Exception
	 */
	protected function prepareUpdateData(){
		throw new Exception('Unknown Error!', REST_ER_PAGE_NOTFOUND);
	}

	protected function checkCanCandidateId(){
		 if (!$this->getCanCandidateId()){
			 throw new Exception("You are not login!", REST_ER_AUTH_ERROR);
		 }
		return true;

	}


	/**
	 * ThinhNH
	 * The conditions for get detail of object
	 * If in child object, you need to add more condition then override this
	 * Remember that we have to return the Option object
	 * option = array (
	 *      'conditions' => (array or string ),
	 *      'joins' => (array table joins),
	 *      'fields' => (string),
	 * )
	 * @return array
	 */
	protected function getDetailOptions(){
		$filters = array(
			"id" => $this->getParameterId(),
			"{$this->_candidateIdFkKey}" =>$this->getCanCandidateId()
		);

		//check is canCandidate object
		if($this->_model->getTableName() == 'can_candidates') {
			unset($filters["{$this->_candidateIdFkKey}"]);
		}
		return array(
			'conditions' => $filters
		);
	}

	/**
	 * ThinhNH
	 * The conditions for get list of object
	 * If in child object, you need to add more condition then override this
	 * Remember that we have to return the Option object
	 * option = array (
	 *      'conditions' => (array or string ),
	 *      'joins' => (array table joins),
	 *      'fields' => (string),
	 * )
	 * @return array
	 */
	protected function getListOptions(){
		$filters = array(
			"{$this->_candidateIdFkKey}" =>$this->getCanCandidateId()
		);

		//check is canCandidate object
		if($this->_model->getTableName() == 'can_candidates') {
			unset($filters["{$this->_candidateIdFkKey}"]);
		}
		return array(
			'conditions' => $filters
		);
	}

	/**
	 * ThinhNH
	 * The conditions for lock object
	 * @return array
	 */
	protected function getOptionsForLock(){
		$id =  $this->getParameterId();
		$filters = array(
			"id" => $id,
			"{$this->_candidateIdFkKey}" =>$this->getCanCandidateId()
		);

		//check is canCandidate object
		if($this->_model->getTableName() == 'can_candidates') {
			unset($filters["{$this->_candidateIdFkKey}"]);
		}
		return array(
			'conditions' => $filters
		);

	}



	/**
	 * Get the object detail and lock it
	 */
	public function lock_get()
	{
		$this->token_check();
		try{

			$this->checkCanCandidateId();
			$id =  $this->getParameterId();
			$options = $this->getOptionsForLock();
			// if Lock flag is ON
			// Get object by normal way
			// and check is that the object locked by their-self or another
			$lockObject = $this->_model->getLockFlag();
			$object = $this->_model->find($options);
			if (!$object){
				// the object is not exist
				throw new Exception ('対象が存在していません。', REST_ER_PAGE_NOTFOUND);
			}
			if ($lockObject['lock_role_flag'] == LOCK_ROLE_FLAG_CAN_NOT_LOCK){
                                
				//if the current object (from the session) locked equal this id then this object locked by their self s
				$currentObject = $this->getCurrentObject();
				if (!$currentObject  || $id != $currentObject['id'] || $currentObject['table']!= $this->_model->getTableName()){
					// The object locked by another
					$code = REST_RESPOND_CANNOT_LOCK;
				}else {
					$code = REST_RESPOND_SUCCESS;
				}

			}else if ($lockObject['lock_role_flag'] == LOCK_ROLE_FLAG_CAN_GET_AND_LOCK) {
                            
				// if the lock flag is off
				// get and lock this object
				$result = $this->_model->getByIdAndLock($id);
				if ($result['transStatus']){
					// set the current locked object id
					$this->setCurrentObject($id, $this->_model->getTableName());
				}else {
					// can not lock
					throw new Exception('ロック処理に失敗しました。', REST_ER_TRANSACTION_ERROR);
				}
				$code = REST_RESPOND_SUCCESS;

			}else {
				// The object locked by another
				$code = REST_RESPOND_CANNOT_LOCK;
			}
			$respond = array(
				'code' => $code,
				'datetime'=> date('Y-m-d H:i:s', time()),
				'data' => $object
			);
			$this->response($respond);
		}catch( Exception $e ){
			$message = $e->getMessage();
			$code    = $e->getCode();
			$this->error_response($message,$code);
		}

	}

	/**
	 * Get the object detail
	 *
	 */
	public function index_get()
	{
		try{
            $this->checkCanCandidateId();
			$options = $this->getDetailOptions();
			$object = $this->_model->find($options);
			if (!$object ){
				throw new Exception ('対象が存在していません。', REST_ER_PAGE_NOTFOUND);
			}
			$this->response($object);
		}catch( Exception $e ){
			$message = $e->getMessage();
			$code    = $e->getCode();
			$this->error_response($message,$code);
		}

	}

	/**
	 * Get list objects of current candidate ID
	 */
	public function list_get()
	{
		try{
			$this->checkCanCandidateId();
			$conditions = $this->getListOptions();
            $list = $this->_model->find($conditions, 'list');
            if (count($list) == 0 ){
                throw new Exception ('対象が存在していません。', REST_ER_PAGE_NOTFOUND);
            }
			$this->response($list);
		}catch( Exception $e ){
			$message = $e->getMessage();
			$code    = $e->getCode();
			$this->error_response($message,$code);
		}

	}

	/**
	 * Insert new object
	 * @method: POST
	 * @action: index
	 * @return: json response|error json response
	 */
	public function post_post()
	{
		$this->token_check();
		try{

			$this->checkCanCandidateId();
			$postData = $this->input->post();
			if ($this->checkValidations($postData)){
				$insertData = $this->prepareInsertData();
				//insert
				$id = $this->_model->doInsert($insertData);
				if (!$id){
					throw new Exception ('新たな情報がインサートできない。', REST_ER_PAGE_NOTFOUND);
				}
                                
				$datetime = new Datetime;
				$this->response(array('code'=>REST_RESPOND_SUCCESS, 'datetime'=>$datetime->format(DateTime::ISO8601)));

			}else {
				throw new Exception(validation_errors(), REST_ER_PARAM_REQUIRED);
			}

		}catch( Exception $e ){
			$message = $e->getMessage();
			$code    = $e->getCode();
			$this->error_response($message,$code);
		}

	}

	/**
	 * Update the object
	 * @method: PUT
	 * @action: index
	 * @return: json response|error json response
	 */
	public function put_put()
	{
		$this->token_check();
		try{
            $this->checkCanCandidateId();
			parse_str(file_get_contents("php://input"),$var_array);
			$_POST = $var_array; //set the put data to post data
			$id = $this->getParameterId();
			$currentLocked = $this->getCurrentObject();
			if (!$currentLocked  || $id != $currentLocked['id'] || $currentLocked['table']!= $this->_model->getTableName() ) {
				throw new Exception ("Don't have any id locked", REST_ER_PARAM_FORMAT);
			}
			if (empty($id) || !is_numeric($id)){
				throw new Exception ('IDが存在していません。', REST_ER_PAGE_NOTFOUND);
			}
			if ($this->checkValidations($var_array)){

				$filters = array(
					"id" => $id,
					"{$this->_candidateIdFkKey}" =>$this->getCanCandidateId()
				);

                //check is canCandidate object
                if($this->_model->getTableName() == 'can_candidates') {
                    unset($filters["{$this->_candidateIdFkKey}"]);
                }
                $objects = $this->_model->getBy($filters);
				if (count($objects)==0){
					throw new Exception ('対象が存在していません。', REST_ER_PAGE_NOTFOUND);
				}
				$updateData = $this->prepareUpdateData();
				//insert
				$id = $this->_model->doUpdateAndUnLock($id, $updateData);
				if (!$id){
					throw new Exception ('更新処理に失敗しました。', REST_ER_TRANSACTION_ERROR);
				}
				// セッションからロックしたデータIDを削除
				$this->deleteCurrentObjectId();

				//check is canCandidate object
				if($this->_model->getTableName() == 'can_candidates') {
					$select= "id, last_name, last_name_kana, last_name_en,mid_name, mid_name_en,first_name, first_name_kana, first_name_en
								,face_photo,mail_address,password,tel,extension_number,direct_extension,cell_number,cell_mail,country_id,
								post_code,prefecture_id,residence,home_country_id,home_post_code,home_prefecture_id,home_residence, home_tel,
								birthday,sex,membership,join_possible_date,remark,bar_code_id";
					$respond = $this->_model->getById($id, null, $select);
					$this->response($respond);
				} else {
					$datetime = new Datetime;
					$this->response(array('code'=>REST_RESPOND_SUCCESS, 'datetime'=>$datetime->format(DateTime::ISO8601)));
				}


			}else {
				throw new Exception(validation_errors(), REST_ER_PARAM_REQUIRED);
			}

		}catch( Exception $e ){
			$message = $e->getMessage();
			$code    = $e->getCode();
			$this->error_response($message,$code);
		}

	}


}