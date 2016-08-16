<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/controllers/R_Master.php';

/**
 * UndergraduatesAPI
 * @author tuyennt
 *
 */
class Undergraduates extends R_Master {

    /**
     * construct
     */
    public function __construct()
    {
        parent::__construct('Undergraduates_model');
    }

    /**
     * @return int
     * @throws Exception
     */
    protected function getParameterId()
    {
        $id = $this->input->get("undergraduate_id");
        if( !isset($id) or !is_numeric($id)){
            throw new Exception("IDが数値ではありません。",REST_ER_PARAM_FORMAT);
        }
        return $id;
    }

    /**
     * Get object detail
     * @method : GET
     * @action: get obect detail
     * @return JSON format
     */
    public function index_get()
    {
        try{
            $this->chekapikey();
            $id = $this->getParameterId();
            $recCompanyId = $this->input->get("rec_company_id");
            $filters = "rec_company_id = " .$recCompanyId;
            $list = $this->_model->getById($id,$filters);
            if (count($list)==0){
                throw new Exception ("対象が存在していません。", REST_ER_PAGE_NOTFOUND);
            }
            $this->response($list);
        }catch( Exception $e ){
            $message = $e->getMessage();
            $code    = $e->getCode();
            $this->error_response($message,$code);
        }

    }
    /**
     * 全件取得
     * @method: GET
     * @action: list
     * @return: json response|error json response
     */
    public function list_get()
    {
        try{
            $this->chekapikey();
            $recCompanyId = $this->input->get("rec_company_id");
            $list = $this->_model->getAll(array("rec_company_id " => $recCompanyId));
            if (count($list)==0){
                throw new Exception ("対象が存在していません。", REST_ER_PAGE_NOTFOUND);
            }
            $this->response($list);
        }catch( Exception $e ){
            $message = $e->getMessage();
            $code    = $e->getCode();
            $this->error_response($message,$code);
        }
    }
}