<?php

/**
 * 市町村区model
 * @author koji.fukami
 *
 */
if(!class_exists("Can_model")){
    require APPPATH . '/models/Can_model.php';
}
class Cancandidates_model extends Can_Model {

    protected $_table = 'can_candidates';

    protected $_primaryKeyField = 'id';

    protected $_labelsMap = array (
        'id'        => 'id',
        'last_name' => 'last_name',
        'last_name_kana' => 'last_name_kana',
        'last_name_en'   => 'last_name_en',
        'mid_name'        => 'mid_name',
        'mid_name_en'    => 'mid_name_en',
        'first_name'     => 'first_name',
        'first_name_kana'=> 'first_name_kana',
        'first_name_en'  => 'first_name_en',
        'face_photo'     => 'face_photo',
        'mail_address'   => 'mail_address',
        'tel'            => 'tel',
        'extension_number' => 'extension_number',
        'direct_extension' => 'direct_extension',
        'cell_number'      => 'cell_number',
        'cell_mail'        => 'cell_mail',
        'country_id'       => 'country_id',
        'post_code'        => 'post_code',
        'prefecture_id'    => 'prefecture_id',
        'residence'        => 'residence',
        'home_country_id'  => 'home_country_id',
        'home_post_code'   => 'home_post_code',
        'home_prefecture_id' => 'home_prefecture_id',
        'home_residence'   => 'home_residence',
        'home_tel'         => 'home_tel',
        'birthday'         => 'birthday',
        'sex'              => 'sex',
        'membership'       => 'membership',
        'join_possible_date' => 'join_possible_date',
        'remark'           => 'remark',
        'updatable_flag'   => 'updatable_flg',
        'lock_role_flag'   => 'lock_role_flag',
        'lock_id'          => 'lock_id'

    );

    /**
     * construct
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * check CanCandidate by rec_company_id
     * @param null $id
     * @param null $recCompanyId
     * @return mixed
     */
    public function checkRecCompanyId($id = NULL, $recCompanyId = NULL)
    {
        $query = $this->db->select('can_candidates.id')
                ->join('rec_companies', 'can_candidates.rec_company_id = rec_companies.id', 'left')
                ->where('can_candidates.rec_company_id =' .$recCompanyId)
                ->where('can_candidates.id =' .$id)
                ->where('rec_companies.status = 0')
                ->where('can_candidates.status = 0');

        $data = $this->db->get($this->_table)->row_array();
        return $data;

    }
}