<?php

class ClientController extends AppController {
	public $helpers = array('Html', 'Form');

	public $layout = ""; // ���C�A�E�g�t�@�C���͎g�p���Ȃ�


	//���f���Ăяo��
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
		
		//�N���C�A���g(���) -- ��{���
		$client = $this->Client->find('first' , array('fields' => array() , 'conditions' => array( 'Client.id' => $id, 'delete_flag' => 0, 'view_flag' => 1)));
		$this -> set('client' , $client);
		
		
		//�R���^�N�g����
		$contact = $this->Contact->find('all' , array('fields' => array() , 'conditions' => array( 'Contact.client_id' => $client['Client']['id'], 'delete_flag' => 0)));
		$this -> set('contact' , $contact);
		
		//����(�N���C�A���g����)
		$clientmemo = $this->Clientmemo ->find('all' , array('fields' => array() , 'conditions' => array( 'Clientmemo.client_id' => $client['Client']['id'], 'delete_flag' => 0)));
		$this -> set('clientmemo' , $clientmemo);
		
		
		//�Č����
		$project = $this->Project->find('all' , array('fields' => array() , 'conditions' => array( 'Project.client_id' => $client['Client']['id'], 'delete_flag' => 0, 'view_flag' => 1)));
		$this -> set('project' , $project);
		
		//�S���ҏ��
		$clientstaff = $this->ClientStaff->getClientStaffList($id);
		$this ->set('clientstaff' , $clientstaff);
	
	}
	
	

}