<?php

/**
 * ログインmodel
 *
 */
class Login_model extends Enjin_Model {

	protected $_table = 'can_candidates';

	protected $_primaryKeyField = 'id';

	protected $_labelsMap = array (
		'unique_id' => 'unique_id'
	);

	/**
	 * construct
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * ThinhNH
	 * Check candidate for login
	 * @param $unique_id
	 * @param $password
	 * @return a candidate object
	 */
	public function checkCandidate($unique_id, $password, $recCompanyId){
		$candidate = $this->db->select('id, rec_company_id')
				->where('unique_id', $unique_id)
				->where ('password', $password)
				->where ('rec_company_id', $recCompanyId)
				->limit(1)
				->get($this->_table)->row_array();
		return $candidate;
	}

    /**
     * ThinhNH
     * Update last_login_date
     * @param $canCandidateId
     * @return mixed
     */
    public function updateLastLogin($canCandidateId){
        return $this->doUpdate($canCandidateId, array('last_login_date'=>date('Y-m-d H:i:s', time())));
    }

}