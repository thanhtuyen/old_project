<?php

/**
 * 職種タイプマスタmodel
 * @author ThinhNH
 *
 */
if(!class_exists("Can_model")){
    require APPPATH . '/models/Can_model.php';
}
class Sel_histories_model extends Can_model {

    protected $_table = 'sel_histories';

    protected $_primaryKeyField = 'id';

    protected $_labelsMap = array (

    );

    /**
     * construct
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * check duplicate between  job_vote_id and can_candidate_id
     * @param $jobVoteId
     * @param $canCandidateId
     * @return bool
     */
    public function checkUnique($jobVoteId, $canCandidateId) {

        $query = $this->db->select('sel_histories.id')
            ->where('sel_histories.job_vote_id =' .$jobVoteId)
            ->where('sel_histories.can_candidate_id =' .$canCandidateId)
            ->where('sel_histories.status = 0');

        $data = $this->db->get($this->_table)->row_array();
        return $data;

    }
}