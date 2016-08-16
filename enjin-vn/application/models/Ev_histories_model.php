<?php
if(!class_exists("Can_model")){
    require APPPATH . '/models/Can_model.php';
}
/**
 * Event History model
 * @author ThinhNH
 *
 */
class Ev_histories_model extends Can_model {

	protected $_table = 'ev_histories';

	protected $_primaryKeyField = 'id';


	/**
	 * construct
	 */
	public function __construct()
	{
		parent::__construct();
	}


}