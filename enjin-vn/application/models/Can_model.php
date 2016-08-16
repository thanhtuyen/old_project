<?php

/**
 * The Can model
 * Handle the functions for lock table
 * @author ThinhNH
 *
 */
class Can_model extends Enjin_Model {

	private $_canTable = 'can_candidates';

	private $_canCandidateId = 0;

	/**
	 * construct
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * ThinhNH
	 * Updated with reason is the new database changed the structure
	 * @param $flagId is the user id who editing this row
	 * @param $lockFlagRole the lock flag role
	 * @return mixed
	 * @internal param $flag
	 */
	private function updateFlag($flagId, $lockFlagRole) {
		$update = array (
			'lock_id' => $flagId,
			'lock_role_flag' => $lockFlagRole
		);
		return $this->db->where ('id', $this->_canCandidateId)->update($this->_canTable, $update);
	}

	/**
	 * ThinhNH
	 * Updated with reason is the new database changed the structure
	 * @return mixed
	 * @internal param $flag
	 */
	public function getLockFlag(){
		$candidate = $this->db->select('lock_id, lock_role_flag')
				->where('id', $this->_canCandidateId)
				->get($this->_canTable)
				->row_array();
		if ($candidate) return $candidate;
		return false;
	}

	/**
	 * Set curent canCandidateId
	 * @param $id
	 */
	public function setCanCandidateId($id) {
		$this->_canCandidateId = $id;
	}

	/**
	 * Get object information for edit
	 * In case the lock flag is off
	 * @param $id object id
	 * @param string $customSelect
	 * @param bool $useJoinTable
	 * @return mix
	 */
	public function getByIdAndLock($id, $customSelect = '', $useJoinTable = false){
		$this->db->trans_start();
		// get object information
		$object = $this->getById($id, $customSelect, $useJoinTable);
		//set lock flag on
		$this->updateFlag($this->_canCandidateId, LOCK_ROLE_FLAG_CAN_NOT_LOCK);
		$this->db->trans_complete();
		$result = array(
			'transStatus' => $this->db->trans_status(),
			'data' => $object
		);
		return $result;

	}

	/**
	 * Update object
	 * Update the lock flag
	 * @param $id
	 * @param $updateData
	 * @return bool status of transaction
	 */
	public function doUpdateAndUnLock($id, $updateData){
		$this->db->trans_start();
		//update data
		$this->doUpdate($id, $updateData);
		//set flag is off
		$this->updateFlag(null,LOCK_ROLE_FLAG_CAN_GET_AND_LOCK);
		$this->db->trans_complete();
		return $this->db->trans_status();

	}
}