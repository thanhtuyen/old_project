<?php

/**
 * 職種タイプマスタmodel
 * @author ThinhNH
 *
 */

class Screening_stages_model extends Enjin_Model {

    protected $_table = 'screening_stages';

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

    public  function getScreeningStageId($recCompanyId)
    {

        $query = $this->db->select('screening_stages.*, MIN(screening_stages.order)')
                ->join('rec_companies', 'screening_stages.rec_company_id = rec_companies.id', 'left')
                ->where('screening_stages.rec_company_id =' .$recCompanyId)
                ->where('rec_companies.status = 0')
                ->where('screening_stages.status = 0');
        //print_r($this->db->get_compiled_select($this->_table));die;

        $data = $this->db->get($this->_table)->row_array();
        return $data;
    }

}