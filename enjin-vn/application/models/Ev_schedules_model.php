<?php

/**
 * 市町村区model
 * @author koji.fukami
 *
 */
class Ev_schedules_model extends Enjin_Model {

	protected $_table = 'ev_schedules';

	protected $_primaryKeyField = 'id';

	protected $_labelsMap = array (
		'id' => 'id',
		'holding_date' => 'holding_date',
		'end_date' => 'end_date',
		'individual_theme' => 'individual_theme',
		'capacity' => 'capacity',
		'wanted_deadline' => 'wanted_deadline',
		'venue' => 'venue',
		'day_content' => 'day_content',
		'status' => 'status'

	);

	/**
	 * construct
	 */
	public function __construct()
	{
		parent::__construct();
	}


    public function getScheduleByEventId($evenId = null){

        $sql = "Select id, holding_date, end_date,individual_theme,capacity,wanted_deadline,venue,day_content,status
                From ".$this->_table."
                where ev_event_id =".$evenId." AND (holding_date > NOW()) AND ((wanted_deadline IS NOT NULL AND wanted_deadline > NOW())
                OR wanted_deadline IS NULL) AND status =".DATABASE_OBJECT_STATUS_OFF;

        $query = $this->db->query($sql);
        return $query->result_array();
    }
}