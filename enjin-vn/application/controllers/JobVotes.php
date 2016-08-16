<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/controllers/R_Master.php';

/**
 * 求人票API
 *
 */
class JobVotes extends R_Master {

	/**
	 * construct
	 */
	public function __construct()
	{
		parent::__construct('Jobvotes_model');
	}


	protected function getParameterId(){
		$get = $this->input->get();
		if( !isset($get["job_vote_id"]) or !is_numeric($get["job_vote_id"]) ){
			throw new Exception("job_vote_idが数値ではありません。",REST_ER_PARAM_FORMAT);
		}
		return $get["job_vote_id"];
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
			$filters = array(
				'job_votes.status = 0',
				'job_votes.id ='.$id,
				'rec_departments.rec_company_id ='.$this->getRecCompanyId(),
				'rec_departments.status=0',
				'rec_companies.status=0',
			);

			$year = $this->input->get('year');
			if (!empty($year) && is_numeric($year) && strlen($year)<=4 ) {
				$filters[] = 'job_votes.wanted_year='.$year;
			}
			// change filters to string to add more query codeigniter can't handle it
			$filters = implode(" AND ", $filters);
			$filters .= " AND (job_votes.wanted_deadline is NULL OR job_votes.wanted_deadline > Now()) ";
			$filters .= " AND (job_votes.start_date is NULL OR job_votes.start_date < Now()) ";

			$list = $this->_model->getBy($filters, null, true);
			if (count($list)>0){
				$object = $list[0];
				$this->response($object);
				}else{
					throw new Exception ('対象が存在していません。', REST_ER_PAGE_NOTFOUND);
				}
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
			$filters = array(
				'job_votes.status = 0',
				'rec_departments.rec_company_id ='.$this->getRecCompanyId(),
				'rec_departments.status=0',
				'rec_companies.status=0',
			);

			$year = $this->input->get('year');
			if (!empty($year) && is_numeric($year) && strlen($year)<=4 ) {
				$filters[] = 'job_votes.wanted_year='.$year;
			}
			// change filters to string to add more query codeigniter can't handle it
			$filters = implode(" AND ", $filters);
			$filters .= " AND (job_votes.wanted_deadline is NULL OR job_votes.wanted_deadline > Now()) ";
			$filters .= " AND (job_votes.start_date is NULL OR job_votes.start_date < Now()) ";
			$list = $this->_model->getBy($filters, null, true);
			$this->response($list);
		}catch( Exception $e ){
			$message = $e->getMessage();
			$code    = $e->getCode();
			$this->error_response($message,$code);
		}
	}

    public function search_get(){
        try{
            $get = $this->input->get();

            $this->chekapikey();
            if(!$this->getRecCompanyId()) {
                throw new Exception("You are not login!", REST_ER_AUTH_ERROR);
            }
            $filters = array(
                'rec_company_id' => $this->getRecCompanyId(),
            );

            if(!empty($get['wanted_year'])) {
                if(!preg_match('/^[0-9]{4}$/', $get['wanted_year'])){
                    throw new Exception ('param wanted_year not valid。', REST_ER_PARAM_FORMAT);
                }
                $filters['wanted_year'] = $get['wanted_year'];
            }

            if(!empty($get['jobtype_id'])) {
                if(!is_numeric($get['jobtype_id'])) {
                    throw new Exception ('param jobtype_id not valid。', REST_ER_PARAM_FORMAT);
                }
                $filters['jobtype_id'] = $get['jobtype_id'];

            }

            if(!empty($get['recruitment_area_id'])){
                if(!is_numeric($get['recruitment_area_id'])) {
                    throw new Exception ('param recruitment_area_id not valid。', REST_ER_PARAM_FORMAT);
                }
                $filters['recruitment_area_id'] = $get['recruitment_area_id'];
            }
            $listObject = $this->_model->getSearchJobVotes($filters);
            if(count($listObject)>0) {
                $this->response($listObject);
            }else {
                throw new Exception ('対象が存在していません。', REST_ER_PAGE_NOTFOUND);
            }

        }catch (Exception $e) {
            $message = $e->getMessage();
            $code = $e->getCode();
            $this->error_response($message, $code);
        }
    }


}