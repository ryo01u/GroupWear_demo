<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {


	var $ext = '.html';
	//使用コンポーネントの登録

	public $uses = array('StaffGroup' , 'News','StaffMypage');

	public $components = array(
		'Common',
		'Session',
		'Auth' => array(

		//ログアウ後の移動先
		'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
		//ログインページのパス
		'loginAction' => array('controller' => 'users', 'action' => 'login'),
		//未ログイン時のメッセージ
		//'authError' => 'あなたのお名前とパスワードを入力して下さい。',


		)

	);



	public function beforeFilter() {
		parent::beforeFilter();
				
		$data_news = $this -> News -> find('first' , 
			array(
				'order' => array('modified' => 'desc'),
            	'limit' => 1,
			)
		);

		$this -> set('data_news' , $data_news);
		

		$this->set('user_name', $this->Auth->user('name'));
		if($this->Auth->user('id')){
			$this->myStaffGroup = $this->StaffGroup->getStaffGroupList($this->Auth->user('id'));	
		}


		$this->set('user_id', $this->Auth->user('id'));

	}



 	



}
