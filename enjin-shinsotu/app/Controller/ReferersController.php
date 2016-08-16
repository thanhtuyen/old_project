<?php
App::uses('AppController', 'Controller');
/**
 * Manages Controller
 *
 * @property Manage $Manage
 */
class ReferersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->redirect(array('controller' => 'Referers', 'action' => 'login'));
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
            	SessionComponent::write('Auth.User.role_type', ROLE_TYPE_REFERER);
                $this->_updateLastLoginDate();
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->setFlash(__('ID、パスワードが不正です。'));
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
		$this->redirect(array('controller' => 'Referers', 'action' => 'login'));
	}

    /*
    *  企業IDをsessionに設定する
    */
    private function _setCompanyId() {

    	$refererCompanyId = SessionComponent::read('Auth.User.referer_company_id');
    	$this->loadModel('RefererCompany');
    	$userCompany = $this->RefererCompany->find('first',	array(
            'recursive' => -1,
            'conditions' => array('RefererCompany.id' => $refererCompanyId)
            )
		);	
        SessionComponent::write('Auth.User.rec_company_id', $userCompany['RefererCompany']['rec_company_id']);
    }
    /*
    *  最終ログイン日時の更新
    */
    private function _updateLastLoginDate(){
        $this->loadModel('InfStaff');
        $this->InfStaff->id = SessionComponent::read('Auth.User.id');
        $now = date('Y-m-d H:i:s');
        SessionComponent::write('Auth.User.last_login_date', $now);        
        $this->InfStaff->saveField('last_login_date', $now);
    }
}
