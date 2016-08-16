<?php
App::uses('AssignSituation', 'Model');

/**
 * AssignSituation Test Case
 *
 */
class AssignSituationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.assign_situation',
		'app.sel_recruiter_history'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->AssignSituation = ClassRegistry::init('AssignSituation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AssignSituation);

		parent::tearDown();
	}

}
