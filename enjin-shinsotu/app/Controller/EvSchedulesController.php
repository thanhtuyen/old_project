<?php
App::uses('AppController', 'Controller');
/**
 * EvSchedules Controller
 *
 * @property EvSchedule $EvSchedule
 * @property PaginatorComponent $Paginator
 */
class EvSchedulesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->EvSchedule->recursive = 0;
		$this->set('evSchedules', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->EvSchedule->exists($id)) {
			throw new NotFoundException(__('Invalid ev schedule'));
		}
		$options = array('conditions' => array('EvSchedule.' . $this->EvSchedule->primaryKey => $id));
		$this->set('evSchedule', $this->EvSchedule->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->EvSchedule->create();
			if ($this->EvSchedule->save($this->request->data)) {
				return $this->flash(__('The ev schedule has been saved.'), array('action' => 'index'));
			}
		}
		$evEvents = $this->EvSchedule->EvEvent->find('list');

		//設定値
		$evStatus = $this->getSystemConfig("ev_status");
		$this->set(compact('evEvents', 'evStatus'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->EvSchedule->exists($id)) {
			throw new NotFoundException(__('Invalid ev schedule'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->EvSchedule->save($this->request->data)) {
				return $this->flash(__('The ev schedule has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('EvSchedule.' . $this->EvSchedule->primaryKey => $id));
			$this->request->data = $this->EvSchedule->find('first', $options);
		}
		$evEvents = $this->EvSchedule->EvEvent->find('list');

		//設定値
		$evStatus = $this->getSystemConfig("ev_status");
		$this->set(compact('evEvents', 'evStatus'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->EvSchedule->id = $id;
		if (!$this->EvSchedule->exists()) {
			throw new NotFoundException(__('Invalid ev schedule'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->EvSchedule->delete()) {
			return $this->flash(__('The ev schedule has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The ev schedule could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}

/**
* 定員割れイベント開催日程リスト&アラート
* 
**/
	public function getCapCrackSchedule()
	{

		$rec_company_id = $this->getUserCompanyId();
		$year = $this->getWantedYear();

        if( empty( $year ) || empty( $rec_company_id ) ) {
            return false;
        } 

		$data['year'] = $year;

		$result = $this->EvSchedule->getCapCrackSchedule( $rec_company_id, $data );

		$trim_result = $this->trimCapCrackSchedule( $result );

		return $trim_result;

	}

/**
* イベントスケジュールと出席簿
* 
**/
	public function getScheduleCandidate( $id = null)
	{

		$rec_company_id = $this->getUserCompanyId();
		$year = $this->getWantedYear();
		
		if( isset( $id ) ) {
			$data['ev_schedule_id'] = $id;
			
		}
        if( empty( $year ) || empty( $data['ev_schedule_id'] ) || empty( $rec_company_id ) ) {
            return false;
        } 

		$data['year'] = $year;

		$result = $this->EvSchedule->getScheduleCandidate( $rec_company_id, $data );
		$trim_result = $this->trimScheduleCandidate( $result );

		return $trim_result;


	}

	/**
* イベントスケジュールと出席簿API
* 
**/
	public function getScheduleCandidateAPI( $id = null)
	{

		$trim_result = $this->getScheduleCandidate( $id );

        $ev_history_status = $this->getSystemConfig('ev_history_status');
        
        $this->set( 'ScheduleCandidate', $trim_result );
        $this->set( 'ev_history_status', $ev_history_status );


		$this->render( '/elements/eventList8', false );
		$this->response->type('json');
		$this->response->body(json_encode(array(
			'html' => $this->response->body()
		)));
		return $this->response;


	}

	/**
	* イベントに紐付くイベント開催日程リスト取得
	* 
	* @param  int  id
	* @return html
	* 
	**/
	    /**
    * イベント情報取得API
    * 
    * @param   int      id
    * @return  response    
    * 
    **/
    public function listsAPI( $id = null )
    {
        if( empty( $id ) ) {
            return false;
        }

        $data['rec_company_id'] = $this->getUserCompanyId();
        $data['year'] = $this->getWantedYear();

        if( empty( $data['rec_company_id'] ) || empty( $data['year'] ) ) {
            return false;
        }

        $result = $this->EvSchedule->getLists( $id, $data );

        return $this->renderJson( $result );

    }

    /**
    * イベント情報取得
    * 
    * @param   int      id
    * @return  response    
    * 
    **/
    public function lists( $id = null )
    {
        if( empty( $id ) ) {
            return false;
        }

        $data['rec_company_id'] = $this->getUserCompanyId();
        $data['year'] = $this->getWantedYear();

        if( empty( $data['rec_company_id'] ) || empty( $data['year'] ) ) {
            return false;
        }

        $result = $this->EvSchedule->getLists( $id, $data );

        return $result;


    }



/**
* 定員割れイベント開催日程リスト&アラート
* 
* @param  array  $result
* @return array  $trim_result
**/
	// private function trimCapCrackSchedule( $result )
	// {

	// 	$trim_result = array();

	// 	foreach ($result as $key => $value) {
	// 		$sch_id = $value['ev_schedules']['id'];
	// 		$count[$sch_id] = 0;
	// 		switch ( $value['ev_events']['screening_stage_type'] ) {
	// 			case '0':
	// 				if( $value['screening_stages']['order'] >= $value['st']['order'] ) {
	// 					if( $value['ev_events']['target_select_id'] == $value['sel_stat_children']['select_status_id'] 
	// 							|| empty( $value['ev_events']['target_select_id'] ) )
	// 					$count[ $sch_id ] += $value[0]['count'];
	// 				}

	// 				break;

	// 			case '1':
	// 				if( $value['screening_stages']['order'] <= $value['st']['order'] ) {
	// 					if( $value['ev_events']['target_select_id'] == $value['sel_stat_children']['select_status_id'] 
	// 							|| empty( $value['ev_events']['target_select_id'] ) )
	// 					$count[ $sch_id ] += $value[0]['count'];
	// 				}
	// 				break;

	// 			case '2':
	// 				if( $value['screening_stages']['order'] == $value['st']['order'] ) {
	// 					if( $value['ev_events']['target_select_id'] == $value['sel_stat_children']['select_status_id'] 
	// 							|| empty( $value['ev_events']['target_select_id'] ) )
	// 					$count[ $sch_id ] += $value[0]['count'];
	// 				}
	// 				break;
				
	// 			default:
	// 				# code...
	// 				break;
	// 		}

	// 	}

	// 	foreach ($result as $key => $value) {
	// 		$ev_event_id = $value['ev_events']['id'];
	// 		$ev_schedule_id = $value['ev_schedules']['id'];

	// 		$trim_result[$ev_event_id]['name'] = $value['ev_events']['name'];
	// 		$trim_result[$ev_event_id][$ev_schedule_id] = array(
	// 				'holding_date' => $value['ev_schedules']['holding_date'],
	// 				'wanted_deadline' => $value['ev_schedules']['wanted_deadline'],
	// 				'capacity' => $value['ev_schedules']['capacity'],
	// 				'screening_stage_id' => $value['ev_events']['screening_stage_id'],
	// 				'screening_stage_name' => $value['screening_stages']['name'],
	// 				'screening_stage_type' => $value['ev_events']['screening_stage_type'],
	// 				'target_select_id' => $value['ev_events']['target_select_id'],
	// 				'count' => $count[ $ev_schedule_id ]
	// 			);

	// 	}

	// 	return $trim_result;

	// }

private function trimCapCrackSchedule( $result )
	{

		$trim_result = array();

		foreach ($result as $key => $value) {
			$ev_event_id = $value['ev_events']['id'];
			$ev_schedule_id = $value['ev_schedules']['id'];

			$trim_result[$ev_event_id]['name'] = $value['ev_events']['name'];
			$trim_result[$ev_event_id][$ev_schedule_id] = array(
					'holding_date' => $value['ev_schedules']['holding_date'],
					'wanted_deadline' => $value['ev_schedules']['wanted_deadline'],
					'capacity' => $value['ev_schedules']['capacity'],
					'screening_stage_id' => $value['ev_events']['screening_stage_id'],
					'screening_stage_name' => $value['screening_stages']['name'],
					'screening_stage_type' => $value['ev_events']['screening_stage_type'],
					'target_select_id' => $value['ev_events']['target_select_id'],
					'count' => $value[0]['count']
				);

		}

		return $trim_result;

	}



/**
* イベントスケジュールと出席簿
* 
* @param   array  $result
* @return  array  $trim_result
* 
* 
* 
**/
	private function trimScheduleCandidate( $result )
	{
		$trim_result = array();

		foreach ( $result as $key => $value ) {
			$ev_event_id = $value['ev_events']['id'];
			$can_candidate_id = $value['can_candidates']['id'];
			$school_id = $value['can_educations']['school_id'];




			if( empty( $trim_result[$can_candidate_id] ) ) {
				$trim_result[$can_candidate_id] = array(
						'name' => $value['can_candidates']['last_name']. ' '. $value['can_candidates']['first_name'],
						'tel' => $value['can_candidates']['tel'],
						'mail_address' => $value['can_candidates']['mail_address'],
						'status' => $value['ev_histories']['status']
					);
			}

			$trim_result[$can_candidate_id]['school'][$school_id]['name'] = $value[0]['school_name'];


			return $trim_result;

		}

	}

}
