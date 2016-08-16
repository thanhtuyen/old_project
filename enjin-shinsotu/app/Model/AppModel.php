<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

	public $actsAs = array('Containable');
    //削除キーの定義
    public $deleted_name = 'status';
    
    public $property =array();

    /**
     * ThinhNH
     * The roles to have permission with this table
     * @var array
     */
    protected $_roles = array();

    /**
     * ThinhNH
     * The status field of the table
     * @var string
     */
    protected $_statusField = 'status';

    //$this->wantedYear = SessionComponent::read('WantedYear');
    
    /*
    *  セッションに含まれるユーザー情報を返却する
    */
    public function getUserInfo($name = null){
        if (is_null($name)) {
            return SessionComponent::read('Auth.User');
        }
        $property = 'Auth.User.'.$name;
        if (SessionComponent::check($property)) {
            return SessionComponent::read($property);
        }

        return false;
    }
    /**
    * 日付整形の変更
    *
    *　@param mixed before
    *　@return date
    **/
    public function toDateTime($before){
        if (is_array($before)) {
            $before = implode('/', $before);
        }

        return date("Y/m/d H:i:s", strtotime($before));
    }
	//論理削除処理
    public function delete($id = null, $cascade = true) {
        if ($this->_isDeletedField()){
            if(empty($id)){
            	$id = $this->id;
            }
            $conditions = array();
            $conditions['conditions']['AND'][$this->alias.'.'.$this->primaryKey] = $id;
            $conditions['fields'] = array($this->primaryKey, $this->deleted_name);
            $conditions['recursive'] = -1;
            $data = $this->find('first', $conditions);

            if(!empty($data)){
                $data[$this->alias][$this->deleted_name] = 1;
                return $this->save($data);
            } else {
                return false;
            }
        }else{
            return parent::delete($id, $cascade);
        }
    }
    //「削除キー」の有無確認
    function _isDeletedField(){
    	return isset($this->_schema[$this->deleted_name]);
    }

    //検索条件の追加処理
    public function addSearchCondition($sql,$findParam) {
        
        if (array_key_exists("limit", $findParam)) {
            $sql = $sql." limit ".$findParam['limit'];
            if (array_key_exists("offset", $findParam)) {
                $sql = $sql." offset ".$findParam['offset'];
            }
        }

        if (array_key_exists("order", $findParam)) {
            $sql = $sql." order by ".$findParam['order'];
        }

        $sql.= ";";

        return $sql;
    }

    /*
    * create random Unique ID
    */
    function createRandomId() {
        $userInfo = $this->getUserInfo();
        $salt = sprintf( "%02d", $userInfo['rec_company_id']);
        $rand = $this->randString();
        return crypt($rand, $salt);
    }

    /*
    *  create random string
    *  @return String
    */
    function randString($rength = 8) {
        $list = array_merge(range('0', '9'), range('a', 'z'), range('A', 'Z'));
        if ($rength  < 1) {
            return false;
        }
        $str = '';
        for ($i = 1; $i <= $rength; $i++) {
            $str .= $list[array_rand($list)];
        }
        return $str;
    }
    
    /**
    *  addErrorCode
    *  @param mixed
    *  @param int
    **/
    function addErrorCode($data, $code) {
        return array_merge($data, array('error_code' => $code));
    }

    /**
     * ThinhNH
     * Return the condition to check the object is using or not
     * By default it only check the status field
     * If the child model set statusField to empty
     * then it return an empty array
     * If the child model has more condition let override this function
     * and return the array condition with the same format
     * @return array an object of find function
     */
    protected function getIsUsingConditions(){
        if (!empty($this->_statusField)){
            $conditions = array(
                $this->alias.'.'.$this->_statusField => 0
            );
            return array(
                'conditions' => $conditions
            );
        }
        return array();
    }

    /**
     * ThinhNH
     * Return the conditions to check the object can update or not
     * By default it's using the same with the IsUsing conditions
     * If the child model set statusField to empty
     * then it return an empty array
     * If the child model need more conditions then override this function
     * and return the array conditions with the same format
     * @return array an object of find function
     */
    protected function getCanUpdateConditions(){
        return $this->getIsUsingConditions();
    }

    /**
     * ThinhNH
     * Check the object is available or not
     * You can add more conditions in
     * override getIsUsingConditions function in your model
     * @param null $id
     * @return false or object
     */
    public function isUsing($id = NULL){

        $role = $this->getUserInfo('role_type');
        if (in_array($role, $this->_roles)){
            $options = $this->getIsUsingConditions();
            $mainCondition = array($this->alias.'.'.$this->primaryKey => $id);
            $options ['conditions']= array_merge($options ['conditions'], $mainCondition);
            return $this->find('first',$options);
        }
        return false;

    }

    /**
     * ThinhNH
     * Check the object is available or not for update
     * You can add more conditions in
     * override getCanUpdateConditions function in your model
     * @param null $id
     * @return false or object
     */
    public function canUpdate($id = NULL){

        $role = $this->getUserInfo('role_type');
        if (in_array($role, $this->_roles)){
            $options = $this->getCanUpdateConditions();
            $conditions = $options['conditions'];
            $mainCondition = array($this->alias.'.'.$this->primaryKey => $id);
            $conditions = array_merge($conditions, $mainCondition);
            $options['conditions'] = $conditions;
            return $this->find('first',$options);
        }
        return false;

    }

    /**
     * Gen validates errors message from errors array
     * @param $errors
     * @return string
     */
    public function getValidateMessage(){
        $errors = $this->validationErrors;
        $message = '';
        foreach ($errors as $k => $value) {
            $message .= $k.':'.join(',',$value);
        }
        return $message;
    }

    /**
     * TuyenNT
     * Return condition to check object can delete or not
     * If child model check condition delete is FALSE
     * then it can't delete object
     * If child model not check condition delete
     * then it return TRUE
     * @return bool
     */
    public function canDelete( $id = NULL){
        return TRUE;
    }
}
