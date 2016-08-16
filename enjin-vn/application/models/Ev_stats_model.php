<?php

/**
 * Ev stats model
 * @author ThinhNH
 *
 */
class Ev_stats_model extends Enjin_Model {

	protected $_table = 'ev_stats';

	protected $_primaryKeyField = 'id';

	protected $_statusFlagField = 'ev_history_status';
	/**
	 * construct
	 */
	public function __construct()
	{
		parent::__construct();
	}


}