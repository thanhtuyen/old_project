<?php
App::uses('AppController', 'Controller');
/**
 * Pdfs Controller
 *
 * @property Business $Business
 * @property PaginatorComponent $Paginator
 */
class PdfsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	 public $components = array('RequestHandler');  


	 public function pdfs_event($id = null){
	 	if (is_null($id)){
			throw new NotFoundException(__('Invalid event schdule id'));
	 	}

	 	$this->loadModel('EvSchedule');
	 	$companyId = $this->getUserCompanyId();

	 	$data = array(
	 		'ev_schedule_id' => $id,
	 		'year' 			 => 2015,
	 		);
	 	$evSchedule = $this->EvSchedule->getScheduleCandidateAttendance($companyId, $data);
		$this->set(compact('evSchedule'));
	
		// Content-Type
		$this->RequestHandler->respondAs('application/pdf');

		// // レイアウトを使用しない  
		$this->layout = '';  
	 }
}
