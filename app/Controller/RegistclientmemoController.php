<?php

class RegistclientmemoController extends AppController {

    public $helpers = array('Html', 'Form', 'Session', 'Js' => array('Jquery'));

	public $components = array('Session','RequestHandler','Common');

	public $uses = array('Staff', 'Client', 'Clientmemo');

	public $layout = "";


	public $paginate = array(
	    'Client'=>array(
	       'field' => array('id' , 'name' , 'delete_flag') ,
	       'limit' => 10 ,
	       'order' => array('id' => 'desc'),
	       'conditions' => array('delete_flag' => '0')
	    )
	);

	function index(){
		$this->redirect("./lists");
	}

	function lists($client_id = 0){

		$this->set( 'client', $this->Client->find( 'list', array( 'fields' => array( 'id', 'name')) ) );

		if($client_id){
			$this->paginate = array(
				'Clientmemo'=>array(
				'field' => array('id' , 'name' , 'delete_flag' ) ,
				'limit' => 10 ,
				'order' => array('id' => 'desc'),
				'conditions' => array('delete_flag' => '0', 'client_id' => $client_id )
				)
			);
		}


		$clientmemo = $this->paginate('Clientmemo');

		$this->set('clientmemo', $clientmemo);

		$this->render('lists');

	}

	function del($id=0){

		$clientmemoRec = $this->Clientmemo->find('first', array(
			'conditions' => array('id'=> $id , 'delete_flag' => 0)
		)) ;

		if($clientmemoRec){
			//グループ削除
			$this->Clientmemo->delClientmemo($id);
			$client_id = $clientmemoRec["Clientmemo"]["client_id"];

		}
		if($client_id){
			$this->redirect("./lists/". $client_id);
		} else {
			$this->redirect("./lists/");
		}

	}


	public function finish($client_id=0) {

			//$this->Common->v("bbb");

		if (isset($client_id)){

			$this->set('client_id', $client_id);
		}


		$this->render('finish');
		
	}

	public function action($id=0){

		$this->set(compact("id"));
		$this->set('set_staff_id', $this->Auth->user('id'));


		$this->set( 'client', $this->Client->find( 'list', array( 'fields' => array( 'id', 'name') ,'conditions' => array( 'delete_flag' => 0)   )   ) );
		

		//フォーム入力があった場合には保存処理。そうでない場合は初期値の準備
		if($this->request->isPost() || $this->request->isPut()) {
			//$this->Common->v("bbb");

			if ($id){
				$this->request->data["Clientmemo"]["id"] =  $id;
			}
			
			
			$this->Clientmemo->set($this->request->data);
			
					 //$this->Common->v( $this->Staff->validates());
		
			if (! $this->Clientmemo->validates()){
					 // $this->Common->v( $this->Department->validationErrors);	
					$this->set( 'errors', $this->Clientmemo->validationErrors );			
			}

//$this->Common->v($this->request->data);	

			if ($this->Clientmemo->save($this->request->data)){
				$this->redirect("finish/". $this->request->data["Clientmemo"]["client_id"]);	
			}			


			
		} else {

				$clientmemoRec = $this->Clientmemo->find('first', array(
					'conditions' => array('id'=> $id )
				)) ;
		
				$this->data = $clientmemoRec;

				$this->set(compact("id"));

				$this->render('action');

		}	
	}


}