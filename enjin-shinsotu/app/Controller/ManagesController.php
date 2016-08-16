<?php
App::uses('AppController', 'Controller');
/**
 * Manages Controller
 *
 * @property Manage $Manage
 * @property PaginatorComponent $Paginator
 */
class ManagesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->redirect(array('controller' => 'Manages', 'action' => 'login'));

	}


/**
 * login method
 *
 * @return void
 */
	public function login() {
        if ($this->request->is('post')) {
            if ( $this->Auth->login() ) {
            	SessionComponent::write('Auth.User.role_type', ROLE_TYPE_MANAGER);
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
		$this->redirect(array('controller' => 'Manages', 'action' => 'login'));
	}

	/*
	*  最終ログイン日時の更新
	*/
	private function _updateLastLoginDate(){
        $this->loadModel('FacManager');
        $this->FacManager->id = SessionComponent::read('Auth.User.id');
        $now = date('Y-m-d H:i:s');
    	SessionComponent::write('Auth.User.last_login_date', $now);        
		$this->FacManager->saveField('last_login_date', $now);
	}


}
