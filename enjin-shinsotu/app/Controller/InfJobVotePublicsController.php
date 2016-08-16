<?php
App::uses('AppController', 'Controller');
/**
 * InfJobVotePublics Controller
 *
 * @property InfJobVotePublic $InfJobVotePublic
 * @property PaginatorComponent $Paginator
 */
class InfJobVotePublicsController extends AppController {

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
		$this->InfJobVotePublic->recursive = 0;
		$this->set('infJobVotePublics', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->InfJobVotePublic->exists($id)) {
			throw new NotFoundException(__('Invalid inf job vote public'));
		}
		$options = array('conditions' => array('InfJobVotePublic.' . $this->InfJobVotePublic->primaryKey => $id));
		$this->set('infJobVotePublic', $this->InfJobVotePublic->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->InfJobVotePublic->create();
			if ($this->InfJobVotePublic->save($this->request->data)) {
				return $this->flash(__('The inf job vote public has been saved.'), array('action' => 'index'));
			}
		}
		$jobVotes = $this->InfJobVotePublic->JobVote->find('list');
		$refererCompanies = $this->InfJobVotePublic->RefererCompany->find('list');
		$infContracts = $this->InfJobVotePublic->InfContract->find('list');
		$recRecruiters = $this->InfJobVotePublic->RecRecruiter->find('list');

		//設定値
		$jobVoteStatus = $this->getSystemConfig("job_vote_status");
		$this->set(compact('jobVotes', 'refererCompanies', 'infContracts', 'recRecruiters', 'jobVoteStatus'));
	}

/**
 * api_add method
 *
 * @return void
 */
	public function api_add() {

		$this->autoRender = false;

		if ($this->request->is('post')) {
			$this->InfJobVotePublic->create();

      $check = $this->InfJobVotePublic->checkInfJobVotePublicId($this->request->data['job_vote_id'],$this->request->data['referer_company_id']);

      if($check === false) {
				if (!$this->InfJobVotePublic->save($this->request->data)) {
          return json_encode(array(
              'status' => false,
              'data'   => $this->request->data,
              'msg'    => 'Error!'
          ));
				}
				$lastId = $this->InfJobVotePublic->getLastInsertID();
				$this->loadModel('RefererCompany');
        $refererCompany = $this->RefererCompany->find('first', array(
            'conditions' => array(
                'RefererCompany.id' => $this->request->data['referer_company_id'],
            ),
        ));

        $data = array(
            'id' => $lastId,
            'name' => $refererCompany['RefererCompany']['name'],
            'status' => Configure::read('job_vote_status')[$this->request->data['status']]
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
		if (!$this->InfJobVotePublic->exists($id)) {
			throw new NotFoundException(__('Invalid inf job vote public'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->InfJobVotePublic->save($this->request->data)) {
				return $this->flash(__('The inf job vote public has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('InfJobVotePublic.' . $this->InfJobVotePublic->primaryKey => $id));
			$this->request->data = $this->InfJobVotePublic->find('first', $options);
		}
		$jobVotes = $this->InfJobVotePublic->JobVote->find('list');
		$refererCompanies = $this->InfJobVotePublic->RefererCompany->find('list');
		$infContracts = $this->InfJobVotePublic->InfContract->find('list');
		$recRecruiters = $this->InfJobVotePublic->RecRecruiter->find('list');

		//設定値
		$jobVoteStatus = $this->getSystemConfig("job_vote_status");
		$this->set(compact('jobVotes', 'refererCompanies', 'infContracts', 'recRecruiters', 'jobVoteStatus'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->InfJobVotePublic->id = $id;
		if (!$this->InfJobVotePublic->exists()) {
			throw new NotFoundException(__('Invalid inf job vote public'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->InfJobVotePublic->delete()) {
			return $this->flash(__('The inf job vote public has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The inf job vote public could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
}
