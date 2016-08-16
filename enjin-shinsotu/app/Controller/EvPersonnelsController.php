<?php
App::uses('AppController', 'Controller');
/**
 * EvPersonnels Controller
 *
 * @property EvPersonnel $EvPersonnel
 * @property PaginatorComponent $Paginator
 */
class EvPersonnelsController extends AppController {

	protected $_model = 'EvPersonnel';

	protected $_listMethods = array('api_add', 'api_delete', 'api_list');

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
		$this->EvPersonnel->recursive = 0;
		$this->set('evPersonnels', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->EvPersonnel->exists($id)) {
			throw new NotFoundException(__('Invalid ev personnel'));
		}
		$options = array('conditions' => array('EvPersonnel.' . $this->EvPersonnel->primaryKey => $id));
		$this->set('evPersonnel', $this->EvPersonnel->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->EvPersonnel->create();
			if ($this->EvPersonnel->save($this->request->data)) {
				return $this->flash(__('The ev personnel has been saved.'), array('action' => 'index'));
			}
		}
		//設定値
		$status = $this->getSystemConfig("status");
		$evEvents = $this->EvPersonnel->EvEvent->find('list');
		$recRecruiters = $this->EvPersonnel->RecRecruiter->find('list');
		$this->set(compact('evEvents', 'recRecruiters','status'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->EvPersonnel->exists($id)) {
			throw new NotFoundException(__('Invalid ev personnel'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->EvPersonnel->save($this->request->data)) {
				return $this->flash(__('The ev personnel has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('EvPersonnel.' . $this->EvPersonnel->primaryKey => $id));
			$this->request->data = $this->EvPersonnel->find('first', $options);
		}
		//設定値
		$status = $this->getSystemConfig("status");
		$evEvents = $this->EvPersonnel->EvEvent->find('list');
		$recRecruiters = $this->EvPersonnel->RecRecruiter->find('list');
		$this->set(compact('evEvents', 'recRecruiters','status'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->EvPersonnel->id = $id;
		if (!$this->EvPersonnel->exists()) {
			throw new NotFoundException(__('Invalid ev personnel'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->EvPersonnel->delete()) {
			return $this->flash(__('The ev personnel has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The ev personnel could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}

	/**
	 * For api_add method
	 * @return array
	 * @throws Exception
	 */
    public function prepareDataForInsert() {

        $post = $this->request->data;
		$eventId = $this->request->data('ev_event_id');
		$recruiterId =  $this->request->data('rec_recruiter_id');
		$this->loadModel('EvEvent');

        //check ev_event exist
		if(!$this->EvEvent->checkRecCompanyId($eventId)){
            throw new Exception('Ev Event Id not valid');
		}

        //check rec_recruiter exist
		$this->loadModel('RecRecruiter');
        if(!$this->RecRecruiter->checkRecCompanyId($recruiterId)){
            throw new Exception('Rec Recruiter Id not valid');
        }

        //check duplicate event_id and recruiter_id
        if($this->EvPersonnel->checkUnique($eventId, $recruiterId)) {
			throw new Exception('Duplicate data');
		}
		return $post;
    }

    public function api_add(){
        $this->checkMethod('api_add');
        if ($this->request->is(array('post', 'put'))) {
            $data = $this->prepareDataForInsert();
            $this->_model->set($data);
            if (!$this->_model->validates()){
                throw new NotFoundException($this->_model->getValidateMessage());
            }
            if ($this->_model->save($data)) {
                $id=$this->_model->getLastInsertId();
                $this->renderJson(array('code'=>0,'id'=>$id));
            }else {
                throw new NotFoundException(__('Can not insert object'));
            }
        }
        throw new NotFoundException(__('Unknown method'));

    }
}
