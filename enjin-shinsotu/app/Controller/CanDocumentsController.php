<?php
App::uses('AppController', 'Controller');
/**
 * CanDocuments Controller
 *
 * @property CanDocument $CanDocument
 * @property PaginatorComponent $Paginator
 */
class CanDocumentsController extends AppController {

    protected $_model = 'CanDocument';

    protected $_listMethods = array('api_add', 'api_delete', 'api_list');

    const status = 0;
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
		$this->CanDocument->recursive = 0;
		$this->set('canDocuments', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CanDocument->exists($id)) {
			throw new NotFoundException(__('Invalid can document'));
		}
		$options = array('conditions' => array('CanDocument.' . $this->CanDocument->primaryKey => $id));
		$this->set('canDocument', $this->CanDocument->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CanDocument->create();
			if ($this->CanDocument->save($this->request->data)) {
				return $this->flash(__('The can document has been saved.'), array('action' => 'index'));
			}
		}
		$canCandidates = $this->CanDocument->CanCandidate->find('list');
		$evHistories = $this->CanDocument->EvHistory->find('list');
		$selHistories = $this->CanDocument->SelHistory->find('list');

		//設定値
		$docStatus = $this->getSystemConfig("doc_status");
		$this->set(compact('canCandidates', 'evHistories', 'selHistories', 'docStatus'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CanDocument->exists($id)) {
			throw new NotFoundException(__('Invalid can document'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CanDocument->save($this->request->data)) {
				return $this->flash(__('The can document has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('CanDocument.' . $this->CanDocument->primaryKey => $id));
			$this->request->data = $this->CanDocument->find('first', $options);
		}
		$canCandidates = $this->CanDocument->CanCandidate->find('list');
		$evHistories = $this->CanDocument->EvHistory->find('list');
		$selHistories = $this->CanDocument->SelHistory->find('list');
		$this->set(compact('canCandidates', 'evHistories', 'selHistories'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CanDocument->id = $id;
		if (!$this->CanDocument->exists()) {
			throw new NotFoundException(__('Invalid can document'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->CanDocument->delete()) {
			return $this->flash(__('The can document has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The can document could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
/**
 * lists method
 *
 * @throws 
 * @param 
 * @return void
 */
	public function lists() {


		$userCompanyId = $this->getUserCompanyId();
		$findParam = $this->getCommonListPararms('CanDocument');

		$data = $this->CanDocument->getData($userCompanyId,$findParam);

		$this->renderJson($data);
		exit;
	}


	/**
	 * ThinhNH
	 * Use the same api_add function
	 */
	public function api_file_add(){
		$this->api_add();
	}

    /**
     *
     * get data from form CanDocument
     * @return array
     * @throws Exception
     */
    public function prepareDataForInsert()
    {
        $post = $this->request->data;
        $candidateId = $post['CanDocuments']['can_candidate_id'];
        $selHistoryId =  $post['CanDocuments']['sel_history_id'];
        $evHistoryId =  $post['CanDocuments']['ev_history_id'];
        $post['can_candidate_id']=$post['CanDocuments']['can_candidate_id'];
        $post['sel_history_id'] =  $post['CanDocuments']['sel_history_id'];
        $post['ev_history_id'] =  $post['CanDocuments']['ev_history_id'];
        //check can_candidate_id
        $this->loadModel('CanCandidate');
		$conditions = array(
			'CanCandidate.id' => $candidateId,
			'CanCandidate.status' => 0,
			'CanCandidate.rec_company_id' => $this->getUserCompanyId(),
			'RecCompany.status' => 0,
		);
        $canCandidate = $this->CanCandidate->find('first', array(
			'conditions' => $conditions
		));
        if(empty($canCandidate)) {
            throw new Exception('can_candidate_id not valid');
        }

		if (empty($selHistoryId) && empty($evHistoryId)) {
			throw new Exception('sel_history_id and ev_history_id, one of them is required');
		}

        //check sel_history_id
		if (!empty($selHistoryId)) {
			$this->loadModel('SelHistory');
			$selHistory = $this->SelHistory->findByIdAndStatus($selHistoryId, self::status);
			if (empty($selHistory)) {
				throw new Exception('sel_history_id is not available');
			}
		}else {
			unset($post['CanDocuments']['sel_history_id']);
		}


		//check ev_history_id
		if (!empty($evHistoryId)) {
			$this->loadModel('EvHistory');
			$evHistory = $this->EvHistory->findById($evHistoryId);
			if (empty($evHistory) || $evHistory[$this->EvHistory->alias]['status']==9) {
				throw new Exception('ev_history_id is not available');
			}
		}else {
			unset($post['CanDocuments']['ev_history_id']);
		}

		if (!$_FILES['file']){
			throw new Exception('File is required');
		}

		$file = $_FILES['file'];
		$file = $this->checkValidFileUpload($file);
		$post['file_name'] = $file['name'];
		$post['extension'] = $file['extension'];
		$post['binary_data'] = $file['binary'];
        return $post;

    }



    /**
     * get parameter to get list CanDocument
     * @param $canCandidateId
     * @param $selHistoryId
     * @param $ev_historyId
     * @return array|void
     */
    public function getParameterForGetList()
    {
        $parameter = $this->request->query;
        $canCandidateId = isset($parameter['can_candidate_id'])? $parameter['can_candidate_id']:"";
        $selHistoryId = isset($parameter['sel_history_id'])?$parameter['sel_history_id']:"";
        $evHistoryId = isset($parameter['ev_history_id'])?$parameter['ev_history_id']:"";

        if(empty($canCandidateId) or !is_numeric($canCandidateId)){
            throw new Exception('Parameter not valid');
        }elseif(empty($selHistoryId) and empty($evHistoryId)) {
            throw new Exception('Parameter not valid');
        } elseif($selHistoryId and !is_numeric($selHistoryId)) {
            throw new Exception('Parameter not valid');
        } elseif($evHistoryId and !is_numeric($evHistoryId)) {
            throw new Exception('Parameter not valid');
        }

        $conditions = array('CanDocument.can_candidate_id' => $canCandidateId,
                            'CanDocument.status' => 0,'CanCandidate.status' => 0,
                            'CanCandidate.rec_company_id' => $this->getUserCompanyId(),
                            'RecCompany.status' => 0 );

        if(!empty($selHistoryId)){
            $conditions['CanDocument.sel_history_id'] = $selHistoryId;
            $conditions['SelHistory.status'] = 0;
        }

        if(!empty($evHistoryId)) {
            $conditions['CanDocument.ev_history_id'] = $evHistoryId;
            $conditions['EvHistory.status !='] = 9;
        }

        $this->_model->recursive = 1;
        $joins = array(
            array(
                'table' => 'rec_companies',
                'alias' => 'RecCompany',
                'conditions' => 'RecCompany.id = CanCandidate.rec_company_id'
            )
        );

        return array('conditions' => $conditions, 'joins' => $joins,'fields' => array($this->_model->alias.'.id',
                 $this->_model->alias.'.ev_history_id',$this->_model->alias.'.sel_history_id',$this->_model->alias.'.file_name',$this->_model->alias.'.extension'));
    }

    /**
    * ファイルダウンロード
    * 
    * @param  int  $can_candidate_id 
    * @param  int  $type
    * @param  int  $history_id
    * 
    **/
    public function download($can_candidate_id, $id) {
        // viewを使用しない
        $this->autoRender = false;

        $this->CanDocument->recursive = 1;
        $joins = array(
            array(
                'table' => 'rec_companies',
                'alias' => 'RecCompany',
                'conditions' => 'RecCompany.id = CanCandidate.rec_company_id'
            )
        );
        $conditions = array(
            'CanDocument.id' => $id,
            'CanDocument.can_candidate_id' => $can_candidate_id,
            'CanCandidate.rec_company_id' => $this->getUserCompanyId(),
            'RecCompany.status' => 0 
        );
        $file = $this->CanDocument->find('first', array(
            'fields' => array(
                'CanDocument.binary_data',
                'CanDocument.file_name',
                'CanDocument.extension',
            ),
            'joins' => $joins,
            'conditions' => $conditions,
        ));
        if(empty($file)){
            throw new Exception('ファイルが存在しません。');
        }

        $buf_file = sys_get_temp_dir() . '/' . uniqid(rand(),1);
        $ret = file_put_contents($buf_file, $file['CanDocument']['binary_data']);
        $this->response->file($buf_file);

        $this->response->download($file['CanDocument']['file_name'] . '.' . $file['CanDocument']['extension']);
    }

    public function add_file($can_candate_id=0,$ev_history_id=0,$sel_history_id=0)
    {
        $this->layout="raw";
        if ($this->request->is(array('post', 'put'))) {
            $this->api_add();
        }else{
            $this->set('can_candidate_id',$can_candate_id);
            $this->request->data['CanDocuments']['can_candidate_id']=$can_candate_id;
            $this->request->data['CanDocuments']['ev_history_id']=$ev_history_id;
            $this->request->data['CanDocuments']['sel_history_id']=$sel_history_id;
        }
    }

    public function api_file_upload(){
        $this->autoRender = false;
        if ($this->request->is(array('post', 'put'))) {
            $data = $this->prepareDataForInsert();
            $this->_model->set($data);
            if (!$this->_model->validates()){
                throw new NotFoundException($this->_model->getValidateMessage());
            }
            if ($this->_model->save($data)) {
                $count = $this->_model->find('count', array(
                    'conditions' => array(
                        'CanDocument.can_candidate_id' => $data['can_candidate_id'],
                        'CanDocument.ev_history_id' => $data['ev_history_id'],
                        'CanDocument.sel_history_id' => $data['sel_history_id'],
                    ),
                ));

                $this->renderJson($count);

            }else {
                throw new NotFoundException(__('Can not insert object'));
            }
        }
    }

    public function api_add(){
        if ($this->request->is(array('post', 'put'))) {
            $data = $this->prepareDataForInsert();
            $this->_model->set($data);
            if (!$this->_model->validates()){
                throw new NotFoundException($this->_model->getValidateMessage());
            }
            if ($this->_model->save($data)) {
                $this->set('code',$this->request->data['_id']);
                $this->request->data['CanDocuments']['can_candidate_id']=$data['can_candidate_id'];
                $this->request->data['CanDocuments']['ev_history_id']=$data['ev_history_id'];
                $this->request->data['CanDocuments']['sel_history_id']=$data['sel_history_id'];
                $this->set('can_candidate_id',$data['can_candidate_id']);

            }else {
                throw new NotFoundException(__('Can not insert object'));
            }
        }
    }
}
