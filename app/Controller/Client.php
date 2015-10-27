<?php

//App::uses('SiteController', 'Controller');

class ClientController extends AppController {
	public $helpers = array('Html', 'Form', 'Util');

	public $uses = array('Department' , 'Group' , 'Staff' ,  'Project' , 'Client' , 'StaffGroup');

	public $layout = "";
	
	public $paginate = array(
		'News'=>array(
		'field' => array('id' , 'name' , 'delete_flag') ,
//		'limit' => 5 ,
		'order' => array('id' => 'desc'),
		'conditions' => array('delete_flag' => '0')
		)
	);



	public $uses = array('Client');
	
	public function detail($id=null) {

		$client = $this->Client->getClientsInfo($id);
		//var_dump($department);

		$this->set('info', $client);

		$this->render('detail');


	}
	
	public function index() {

		$this->redirect("./lists/");

	}
	
	public function lists() {
		
		$datas = $this->paginate('Client');

		$this->set('datas',$datas);

		
	}


}