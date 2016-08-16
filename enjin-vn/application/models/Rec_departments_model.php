<?php

/**
 * 職種タイプマスタmodel
 * @author ThinhNH
 *
 */
class Rec_departments_model extends Enjin_Model {

    protected $_table = 'rec_departments';

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


    public function getDepartmentId($recDepartmentId, $recCompanyId) {
        $this->db->select('id')
            ->where('id ', $recDepartmentId)
            ->where('rec_company_id', $recCompanyId)
            ->where('status = 0')
        ;
        $data = $this->db->get($this->_table)->row_array();
        return $data;
    }

}