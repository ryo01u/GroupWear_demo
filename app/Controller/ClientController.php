<?php

class ClientController extends AppController {
	public $helpers = array('Html', 'Form');

	public $layout = ""; // レイアウトファイルは使用しない


	//モデル呼び出し
	public $uses = array('Client' , 'Clientmemo' , 'Contact' , 'ClientStaff' , 'Project');

/*
	public function detail($id=null) {

		$this->set('id',$id);

		$client = $this->Client->find('first', array(
			'conditions' => array('id'=> $id , 'delete_flag' => 0)
		)) ;
		$this->set('client',$client);

		$this->render('detail');

	}
*/

	public function index() {
				
			$this -> redirect("./detail/");
		
	}
	
	public function detail($id = null) {
		
		//クライアント(取引) -- 基本情報
		$client = $this->Client->find('first' , array('fields' => array() , 'conditions' => array( 'Client.id' => $id, 'delete_flag' => 0, 'view_flag' => 1)));
		$this -> set('client' , $client);
		
		
		//コンタクト履歴
		$contact = $this->Contact->find('all' , array('fields' => array() , 'conditions' => array( 'Contact.client_id' => $client['Client']['id'], 'delete_flag' => 0)));
		$this -> set('contact' , $contact);
		
		//メモ(クライアントメモ)
		$clientmemo = $this->Clientmemo ->find('all' , array('fields' => array() , 'conditions' => array( 'Clientmemo.client_id' => $client['Client']['id'], 'delete_flag' => 0)));
		$this -> set('clientmemo' , $clientmemo);
		
		
		//案件情報
		$project = $this->Project->find('all' , array('fields' => array() , 'conditions' => array( 'Project.client_id' => $client['Client']['id'], 'delete_flag' => 0, 'view_flag' => 1)));
		$this -> set('project' , $project);
		
		//担当者情報
		$clientstaff = $this->ClientStaff->getClientStaffList($id);
		$this ->set('clientstaff' , $clientstaff);
	
	}
	
	

}