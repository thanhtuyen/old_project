<?php
App::uses('AppController', 'Controller');
/**
 * JobOfferStaffs Controller
 *
 * @property JobOfferStaff $JobOfferStaff
 * @property PaginatorComponent $Paginator
 */
class JobOfferStaffsController extends AppController {

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
		$this->JobOfferStaff->recursive = 0;
		$this->set('jobOfferStaffs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->JobOfferStaff->exists($id)) {
			throw new NotFoundException(__('Invalid job offer staff'));
		}
		$options = array('conditions' => array('JobOfferStaff.' . $this->JobOfferStaff->primaryKey => $id));
		$this->set('jobOfferStaff', $this->JobOfferStaff->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->JobOfferStaff->create();
			if ($this->JobOfferStaff->save($this->request->data)) {
				return $this->flash(__('The job offer staff has been saved.'), array('action' => 'index'));
			}
		}
		$jobVotes = $this->JobOfferStaff->JobVote->find('list');
		$recRecruiters = $this->JobOfferStaff->RecRecruiter->find('list');

		//設定値
		$status = $this->getSystemConfig("status");
		$this->set(compact('jobVotes', 'recRecruiters', 'status'));
	}

	public function api_add() {

		$this->autoRender = false;

		if ($this->request->is('post')) {
			$this->JobOfferStaff->create();
      $check = $this->JobOfferStaff->checkJobOfferStaffId($this->request->data['job_vote_id'],$this->request->data['rec_recruiter_id'],0);
      if($check === false) {
  			if (!$this->JobOfferStaff->save($this->request->data)) {
          return json_encode(array(
              'status' => false,
              'data'   => null,
              'msg'    => 'Error!'
          ));
  			}
  			$lastId = $this->JobOfferStaff->getLastInsertID();

        $jobOfferStaff = $this->JobOfferStaff->find('first', array(
            'conditions' => array(
                'JobOfferStaff.rec_recruiter_id' => $this->request->data['rec_recruiter_id'],
            ),
        ));

        $data = array(
            'id' => $lastId,
            'name' => $jobOfferStaff['RecRecruiter']['name']
        );

        return json_encode(array(
            'status' => true,
            'data' => $data,
            'msg' => 'Success!'
        ));
  		}else{
        $error = array('error'=>'exits');
        return json_encode(array(
            'status' => false,
            'data' => $error,
            'msg' => 'Error'
        ));
      }
    }

	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->JobOfferStaff->exists($id)) {
			throw new NotFoundException(__('Invalid job offer staff'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->JobOfferStaff->save($this->request->data)) {
				return $this->flash(__('The job offer staff has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('JobOfferStaff.' . $this->JobOfferStaff->primaryKey => $id));
			$this->request->data = $this->JobOfferStaff->find('first', $options);
		}
		$jobVotes = $this->JobOfferStaff->JobVote->find('list');
		$recRecruiters = $this->JobOfferStaff->RecRecruiter->find('list');

		//設定値
		$status = $this->getSystemConfig("status");
		$this->set(compact('jobVotes', 'recRecruiters', 'status'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->JobOfferStaff->id = $id;
		if (!$this->JobOfferStaff->exists()) {
			throw new NotFoundException(__('Invalid job offer staff'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->JobOfferStaff->delete()) {
			return $this->flash(__('The job offer staff has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The job offer staff could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}

	public function api_delete($id = null) {
		$this->autoRender = false;
		if ($this->request->is('get')) {
			if(empty($this->request->query['id'])) {
        return json_encode(array(
            'status' => false,
            'data' => null,
            'msg' => '1:Error!'
        ));
			}
			$id = $this->request->query['id'];
			$this->JobOfferStaff->id = $id;
			if (!$this->JobOfferStaff->exists()) {
        return json_encode(array(
            'status' => false,
            'data' => null,
            'msg' => '2:Error'
        ));
			}
			//$this->request->allowMethod('get', 'delete');
			if ($this->JobOfferStaff->delete()) {
	      return json_encode(array(
	          'status' => true,
	          'msg' => 'Deleted'
	      ));
			} else {
        return json_encode(array(
            'status' => false,
            'data' => null,
            'msg' => '3:Error'
        ));
      }
		}

	}

}
