<?php

/**
 * 市町村区model
 * @author ThinhNH
 *
 */
require APPPATH . '/models/Can_model.php';

class Education_model extends Can_Model {

	protected $_table = 'can_educations';

	protected $_statusFlagField = '';

	protected $_primaryKeyField = 'id';

	protected $_labelsMap = array (
		'can_educations.id' => 'id',
		'can_educations.school_id' => 'school_id',
		'can_educations.school' => 'school',
		'can_educations.undergraduate_id' => 'undergraduate_id',
		'can_educations.undergraduate' => 'undergraduate',
		'can_educations.department' => 'department',
		'can_educations.student_bunri_class_id' => 'student_bunri_class_id',
		'can_educations.seminar' => 'seminar',
		'can_educations.major_theme' => 'major_theme',
		'can_educations.circle' => 'circle',
		'can_educations.admission_date' => 'admission_date',
		'can_educations.graduation_date' => 'graduation_date'
	);

	/**
	 * construct
	 */
	public function __construct()
	{
		parent::__construct();
	}

}