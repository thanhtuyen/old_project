<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/controllers/CRU_Master.php';

/**
 * LanguageAPI
 * @author tuyennt
 *
 */
class Languages extends CRU_Master {
    protected $_model;

	/**
	 * construct
	 */
	public function __construct()
	{
		parent::__construct('Languages_model');
	}

    /**
     * Get Education ID
     * @return string
     */
    protected function getParameterId(){
        //check API
        $this->chekapikey();

        $method = $this->input->server("REQUEST_METHOD");
        if( $method == "GET" ){
            $id = $this->input->get("can_language_id");
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
            "can_languages.id" => $this->getParameterId(),
            'can_languages.status' => DATABASE_OBJECT_STATUS_ON,
            'can_candidates.rec_company_id' => $this->getRecCompanyIdFromSession(),
            'can_languages.can_candidate_id' => $this->getCanCandidateId(),
        );
        $join = array(
            array('table'=>'can_candidates',
                'join'=>'can_candidates.id = can_languages.can_candidate_id',
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
            'can_languages.status' => DATABASE_OBJECT_STATUS_ON,
            'can_candidates.rec_company_id' => $this->getRecCompanyIdFromSession(),
            'can_languages.can_candidate_id' => $this->getCanCandidateId(),
        );

        $join = array(
            array('table'=>'can_candidates',
                'join'=>'can_candidates.id = can_languages.can_candidate_id',
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


    /**
     * Check valid the data
     * @param bool $postData
     * @return mixed
     */
    protected function checkValidations($postData = false)
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        
        $this->form_validation->set_data($postData);

        $this->form_validation->set_rules('foreign_language_id', '', 'required|integer');
        $this->form_validation->set_rules('level_id', '', 'required|integer');
        $this->form_validation->set_rules('oversea_life', '', 'integer');
        
        $this->form_validation->set_message('required', '%s は必須です。');
        $this->form_validation->set_message('integer', '%s は整数です。');

        return $this->form_validation->run();

    }

    protected function prepareInsertData()
    {
        $post = $this->input->post();
        $data = array(
            'can_candidate_id' => $this->getCanCandidateId(),
            'foreign_language_id' => $post['foreign_language_id'],
            'level_id' => $post['level_id'],
            'oversea_life' => isset($post['oversea_life'])?$post['oversea_life']:"",
            'status' => 0,
        );

        //check foreign language
        if ($post['foreign_language_id']== 0){
            throw new Exception ('Please choose a foreign language');
        }

        //check condition save foreign_language
        if($post['foreign_language_id']== 99){
            $data['foreign_language'] = $post['foreign_language'];
        }else {
            $this->load->model('Language_model', 'language');
            //check foreign language exist
            $language = $this->language->getBy(array('id'=> $post['foreign_language_id']));

            if($language) {
                $data['foreign_language'] = $language[0]['name'];
            } else {
                throw new Exception ('foreign_language_id not valid', REST_ER_PAGE_NOTFOUND);
            }
        }



        return $data;
    }

    /**
     * We use the same object to update and insert
     * @return array|void
     * @throws Exception
     */
    protected function prepareUpdateData(){
      return $this->prepareInsertData();
    }
}