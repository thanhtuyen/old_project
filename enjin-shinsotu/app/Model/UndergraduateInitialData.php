<?php
App::uses('AppModel', 'Model');
/**
 * UndergraduateInitialData Model
 *
 */
class UndergraduateInitialData extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'undergraduate_initial_datas';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

   /**
     * 
     * ユーザー企業作成時に利用するデータを作成、返却する
     * 
     * @param void
     * @return array
     * 
     **/
    public function getInitData()
    {
        $this->recursive = -1;
    
        $data = $this->find('all',array('fields' => array('name', 'status')));
        
        $result = array();
        
        foreach( $data as $key=>$row )
        {
            $result[$key] = $row['UndergraduateInitialData'];
        }
        
        return $result;
    }

}
