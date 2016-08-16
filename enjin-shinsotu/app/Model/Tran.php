<?php
App::uses('AppModel', 'Model');
/**
 *
 */
class Tran extends AppModel {
    
    public $useTable = false;
    
    /**
     * 
     * トランザクション開始
     * 
     * 
     * 
     * 
     **/
    public function begin()
    {
        $this->getDataSource()->begin();
    }
    
    /**
     * 
     * トランザクションコミット正常終了
     * 
     * 
     * 
     * 
     **/
    public function commit()
    {
        $this->getDataSource()->commit();
    }
    
    /**
     * 
     * トランザクションロールバック
     * 
     * 
     * 
     * 
     **/
    public function rollback()
    {
        $this->getDataSource()->rollback();
    }
    
}
