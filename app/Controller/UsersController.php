<?php

class UsersController extends AppController {

	 //�g�p���f���̎w��i�ȗ��j

	public $uses = array('Staff');

	public $layout = ""; // ���C�A�E�g�t�@�C���͎g�p���Ȃ�

	var $components = array('Auth');

	    public function beforeFilter() {
	        parent::beforeFilter();
	       // $this->Auth->allow('addfinish');

		$this->Auth->authenticate = array(

			'Form' => array(
			'passwordHasher' => array(
			'className' => 'None'
			) ,

			'userModel' => 'Staff', //HogeUser���f�����w��

			'fields' => array('username' => 'account', 'password' => 'password'),
			'scope' => array( 'Staff.delete_flag' => 0)
			)
		);

	}


	/**
	 * ���O�C��
	 */
	public function index() {
		$this->login();
	}

	/**
	 * ���O�C��
	 */
	public function login() {


		if ($this->request->is('post')) {

			if ($this->Auth->login()) {
				
			//	$this->redirect($this->Auth->redirect(array('controller' => 'top', 'action' => 'index')));
				$this->redirect($this->Auth->redirect(array('controller' => 'mypage', 'action' => 'index')));

			} else {
			//print "aa";
				$this->set('login_error', True);
			}

		}
	}


	public function useradd() {

/*
		if ($this->request->is('post')) {
	            $this->Staff->create();

	            if ($this->Staff->save($this->request->data)) {
	                $this->Session->setFlash(__('The user has been saved'));
	                $this->redirect(array('action' => 'addfinish'));

	            } else {
	                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
	            }
	        }
*/
	}

	public function addfinish() {


	}



      public function logout(){
            $this->Auth->logout();
            $this->Session->destroy(); //セッションを完全削除
            $this->Session->setFlash(__('ログアウトしました'));
			
			
			
            $this->redirect(array('action' => 'login'));
      }


}