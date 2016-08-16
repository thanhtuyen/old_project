<?php
App::uses('AppController', 'Controller');
/**
 * Interviewer Controller
 *
 * @property Interviewer $Interviewer
 */
class InterviewersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->redirect(array('controller' => 'Interviewers', 'action' => 'login'));
	}


/**
 * login method
 *
 * @return void
 */
	public function login() {
        if ($this->request->is('post')) {
            if ( $this->Auth->login() ) {
            	// 企業IDをセッションに追加
				$this->_setCompanyId();
            	SessionComponent::write('Auth.User.role_type', ROLE_TYPE_INTERVIEWER);
                $this->_updateLastLoginDate();
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->setFlash(__('メールアドレス、パスワードが不正です。'));
            }
        }
   	}


/**
 * dashbord method
 *
 * @return void
 */
	public function dashbord() {
	}

/**
 * logout method
 *
 * @return void
 */
	public function logout() {
		$this->Auth->logout();
		$this->redirect(array('controller' => 'Interviewers', 'action' => 'login'));
	}

    /*
    *  企業IDをsessionに設定する
    */
    private function _setCompanyId() {

    	$departmentId = SessionComponent::read('Auth.User.rec_department_id');
    	$this->loadModel('RecDepartment');
        $userDepartment = $this->RecDepartment->find('first', array(
            'recursive' => -1,
            'conditions' => array('RecDepartment.id' => $departmentId)
            )
        );
        SessionComponent::write('Auth.User.rec_company_id', $userDepartment['RecDepartment']['rec_company_id']);
    }
    /*
    *  最終ログイン日時の更新
    */
    private function _updateLastLoginDate(){
        $this->loadModel('RecRecruiter');
        $this->RecRecruiter->id = SessionComponent::read('Auth.User.id');
        $now = date('Y-m-d H:i:s');
        SessionComponent::write('Auth.User.last_login_date', $now);        
        $this->RecRecruiter->saveField('last_login_date', $now);
    }
}

