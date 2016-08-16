<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/controllers/CRU_Master.php';

/**
 * 市町村区API
 * @author koji.fukami
 *
 */
class Qualifications extends CRU_Master {

    /**
     * construct
     */
    public function __construct()
    {
        parent::__construct('Qualifications_model');
    }

    /**
     * Get Education ID
     * @return integer
     */
    protected function getParameterId(){
        $this->chekapikey();
        $method = $this->input->server("REQUEST_METHOD");
        if( $method == "GET" ){
            $id = $this->input->get("can_qualification_id");
        }else {
            parse_str(file_get_contents("php://input"),$var_array);
            $id = isset($var_array["id"])?$var_array["id"]:'';
        }
        if( !isset($id) or !is_numeric($id)){
            throw new Exception("IDが数値ではありません。",REST_ER_PARAM_FORMAT);
        }
        return $id;
    }

    protected  function checkValidations($postData = false)
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('enjin_helper');
        $this->form_validation->set_data($postData);
        $method = $this->input->server("REQUEST_METHOD");
        if( $method == "PUT" ){
            $this->form_validation->set_rules('id', '', 'required|integer');
        }
        $this->form_validation->set_rules('qualification_id', '', 'trim|required|integer');
        $this->form_validation->set_rules('acquisition_date', '', 'trim|required|integer|valid_date_check');
        
        $this->form_validation->set_message('required', '%s は必須です。');
        $this->form_validation->set_message('integer', '%s は整数です。');
        $this->form_validation->set_message('valid_date_check', '%s 取得年月は "YYYYMMDD" の形式です。');

        return $this->form_validation->run();

    }

    protected  function prepareInsertData()
    {
        $post = $this->input->post();
        $data = array(
            'can_candidate_id' => $this->getCanCandidateId(),
            'qualification_id' => $post['qualification_id'],
            'score'            => isset($post['score'])?$post['score']:"",
            'acquisition_date' => $post['acquisition_date'],
            'status'           => 0
        );
        //check qualification_id
        if ($post['qualification_id']== 0){
            throw new Exception ('Please choose a qualification');
        }

        //check condition save qualification
        if($post['qualification_id']== 99){
            $data['qualification'] = $post['qualification'];
        }

        $this->load->model('Qualification_model', 'qualification');
        //check qualifications exist
        $qualification = $this->qualification->getBy(array('id'=> $post['qualification_id']));

        if($qualification) {
            $data['qualification'] = $qualification[0]['name'];
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

    protected function getOptionsForLock(){
        $id =  $this->getParameterId();
        $filters = array(
            "can_qualifications.id" => $id,
            "can_qualifications.{$this->_candidateIdFkKey}" =>$this->getCanCandidateId(),
            'can_candidates.status' => 0,
            'can_qualifications.status' =>0,
            'can_candidates.rec_company_id' => $this->getRecCompanyIdFromSession(),
        );
        $joins = array(
            array(
                'table' => 'can_candidates',
                'join' => 'can_candidates.id = can_qualifications.can_candidate_id',
                'type' => 'left'
            )

        );
        return array(
            'conditions' => $filters,
            'joins' => $joins,
            'fields' => 'can_qualifications.*'
        );

    }

    protected function getDetailOptions(){
        $id =  $this->getParameterId();
        $filters = array(
            "can_qualifications.id" => $id,
            "can_qualifications.{$this->_candidateIdFkKey}" =>$this->getCanCandidateId(),
            'can_qualifications.status' =>0,
            'can_candidates.status' => 0,
            'can_candidates.rec_company_id' => $this->getRecCompanyIdFromSession(),
        );
        $joins = array(
            array(
                'table' => 'can_candidates',
                'join' => 'can_candidates.id = can_qualifications.can_candidate_id',
                'type' => 'left'
            )

        );
        return array(
            'conditions' => $filters,
            'joins' => $joins,
            'fields' => 'can_qualifications.*'
        );
    }

    protected function getListOptions(){
        $filters = array(
            "can_qualifications.{$this->_candidateIdFkKey}" =>$this->getCanCandidateId(),
            'can_candidates.status' => 0,
            'can_qualifications.status' =>0,
            'can_candidates.rec_company_id' => $this->getRecCompanyIdFromSession(),
        );
        $joins = array(
            array(
                'table' => 'can_candidates',
                'join' => 'can_candidates.id = can_qualifications.can_candidate_id',
                'type' => 'left'
            )

        );
        return array(
            'conditions' => $filters,
            'joins' => $joins,
            'fields' => 'can_qualifications.*'
        );
    }
}