<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/controllers/CRU_Master.php';

/**
 * 市町村区API
 * @author ThinhNH
 *
 */
class Education extends CRU_Master {

	protected $_model;
	/**
	 * construct
	 */
	public function __construct()
	{
		parent::__construct('Education_model');

	}

	/**
	 * Get Education ID
	 * @return integer
	 */
	protected function getParameterId(){
		$method = $this->input->server("REQUEST_METHOD");
		if( $method == "GET" ){
			$id = $this->input->get("can_education_id");
		}else {
			parse_str(file_get_contents("php://input"),$var_array);
			$id = isset($var_array["id"])?$var_array["id"]:'';
		}
		if( !isset($id) or !is_numeric($id)){
			throw new Exception("IDが数値ではありません。",REST_ER_PARAM_FORMAT);
		}
		return $id;
	}

	/**
	 * check condition get data
	 * @return array
	 * @throws Exception
	 */
	protected function getDetailOptions(){
		$filters = array(
			"can_educations.id" => $this->getParameterId(),
			'can_educations.status' => DATABASE_OBJECT_STATUS_ON,
			'can_candidates.rec_company_id' => $this->getRecCompanyIdFromSession(),
			'can_educations.can_candidate_id' => $this->getCanCandidateId(),
		);
		$join = array(
					array('table'=>'can_candidates',
						  'join'=>'can_candidates.id = can_educations.can_candidate_id',
						  'type'=>'left')
				);

		return array(
			'conditions' => $filters,
			'joins' => $join
		);
	}

	/**
	 * check condition get list data
	 * @return array
	 */
	protected function getListOptions(){
		$filters = array(
			'can_educations.status' => DATABASE_OBJECT_STATUS_ON,
			'can_candidates.rec_company_id' => $this->getRecCompanyIdFromSession(),
			'can_educations.can_candidate_id' => $this->getCanCandidateId()
		);

		$join = array(
			array('table'=>'can_candidates',
				'join'=>'can_candidates.id = can_educations.can_candidate_id',
				'type'=>'left')
		);
		return array(
			'conditions' => $filters,
			'joins' => $join
		);
	}


	/**
	 * check condition get object to lock
	 * @return array
	 * @throws Exception
	 */
	protected function getOptionsForLock(){
		return $this->getDetailOptions();

	}


	protected function prepareInsertData(){
		$post = $this->input->post();
		$insertData = array(
			'can_candidate_id' 		=>	$this->getCanCandidateId(),
			'school_id'				=>	$post['school_id'],
			'department'			=>	isset($post['department'])?$post['department']:'',
			'student_bunri_class_id'=>	isset($post['student_bunri_class_id'])?$post['student_bunri_class_id']:NULL,
			'manage_bunri_class_id'=>	isset($post['manage_bunri_class_id'])?$post['manage_bunri_class_id']:NULL,
			'seminar'				=>	isset($post['seminar'])?$post['seminar']:'',
			'major_theme'			=>	isset($post['major_theme'])?$post['major_theme']:'',
			'circle'				=>	isset($post['circle'])?$post['circle']:'',
			'admission_date'		=>	isset($post['admission_date'])?$post['admission_date']:'',
			'graduation_date'	    =>	isset($post['graduation_date'])?$post['graduation_date']:''
		);

		$recCompanyId = $this->getRecCompanyIdFromSession();
		//school
        if ($post['school_id']==0){
            if (empty($post['school'])){
                throw new Exception ('Please input name school');
            }
            $insertData['school'] = $post['school'];

        } else {
            $this->load->model('School_model', 'school');
            //check school exist
            $school = $this->school->getBy(array('id'=> $post['school_id'], 'rec_company_id' => $recCompanyId));
            if($school) {
                $insertData['school'] = $school[0]['name'];
            } else {
                throw new Exception ('school_id not valid', REST_ER_PAGE_NOTFOUND);
            }
        }

		// undergraduate
        if (isset($post['undergraduate_id']) && $post['undergraduate_id'] != ""){
            if ($post['undergraduate_id']==0){
                if (empty($post['undergraduate'])){
                    throw new Exception ('Please input name undergraduate');
                }
                $insertData['undergraduate'] = $post['undergraduate'];

            } else {
                $this->load->model('Undergraduates_model', 'undergraduates');
                //check undergraduate exist
                $undergraduate = $this->undergraduates->getBy(array('id'=> $post['undergraduate_id'], 'rec_company_id' => $recCompanyId));
                if($undergraduate) {
                    $insertData['undergraduate'] = $undergraduate[0]['name'];
                } else {
                    throw new Exception ('undergraduate_id not valid', REST_ER_PAGE_NOTFOUND);
                }
            }
            $insertData['undergraduate_id'] = $post['undergraduate_id'];
        }

		return $insertData;
	}

	/**
	 * We use the same object to update and insert
	 * @return array|void
	 * @throws Exception
	 */
	protected function prepareUpdateData(){
		return $this->prepareInsertData();
	}

	/**
	 * Check valid the data
	 * @param bool $postData
	 * @return mixed
	 */
	protected function checkValidations($postData = false){
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
                $this->load->helper('enjin_helper');
		$this->form_validation->set_data($postData);
		$method = $this->input->server("REQUEST_METHOD");
                if( $method == "PUT" ){
                    $this->form_validation->set_rules('id', '', 'required|integer');
                }
                
		$this->form_validation->set_rules('school_id', '', 'trim|required|integer');
		$this->form_validation->set_rules('undergranduate_id', '', 'trim|integer');
		$this->form_validation->set_rules('student_bunri_class_id', '', 'trim|integer');
                $this->form_validation->set_rules('admission_date', '', 'trim|valid_date_check');
                $this->form_validation->set_rules('graduation_date', '', 'trim|valid_date_check');
                
                $this->form_validation->set_message('required', '%s は必須です。');
                $this->form_validation->set_message('integer', '%s は整数です。');
                $this->form_validation->set_message('valid_date_check', '%s 取得年月は "YYYYMMDD" の形式です。');
                
		return $this->form_validation->run();

	}

}