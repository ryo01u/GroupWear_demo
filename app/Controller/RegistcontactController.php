<?php

class RegistcontactController extends AppController {

    public $helpers = array('Html', 'Form', 'Session', 'Js' => array('Jquery'));

	public $components = array('Session','RequestHandler','Common');

	public $uses = array('Staff', 'Client', 'Contact');

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

		$this->set( 'contact', $this->Contact->find( 'list', array( 'fields' => array( 'id', 'name') , 'conditions' => array( 'delete_flag' => 0 , 'client_id' => $client_id  )  )  ) );
		$this->set( 'client', $this->Client->find( 'list', array( 'fields' => array( 'id', 'name')) ) );

		if($client_id){
			$this->paginate = array(
				'Contact'=>array(
				'field' => array('id' , 'name' , 'delete_flag' ) ,
				'limit' => 10 ,
				'order' => array('id' => 'desc'),
				'conditions' => array('delete_flag' => '0', 'client_id' => $client_id )
				)
			);
		}


		$contact = $this->paginate('Contact');

		$this->set('contact', $contact);

		$this->render('lists');

	}

	function del($id=0){




		$ContactRec = $this->Contact->find('first', array(
			'conditions' => array('id'=> $id , 'delete_flag' => 0)
		)) ;


		if($ContactRec){
			//グループ削除
			$this->Contact->delContact($id);
		}

		$this->redirect("./lists");
	}


	public function finish() {
		
		$this->render('finish');
		
	}

	public function action($id=0){

		$this->set(compact("id"));
		$this->set('set_staff_id', $this->Auth->user('id'));


		$this->set( 'client', $this->Client->find( 'list', array( 'fields' => array( 'id', 'name') ,'conditions' => array( 'delete_flag' => 0)   )   ) );
		

		//フォーム入力があった場合には保存処理。そうでない場合は初期値の準備
		if($this->request->isPost() || $this->request->isPut()) {
			//

			if ($id){
				$this->request->data["Contact"]["id"] =  $id;
			}
			
			
			$this->Contact->set($this->request->data);
			
					 //$this->Common->v( $this->Staff->validates());
		
			if (! $this->Contact->validates()){
					 // $this->Common->v( $this->Department->validationErrors);	
					$this->set( 'errors', $this->Contact->validationErrors );			
			}

			//var_dump($this->request->data);

			if ($this->Contact->save($this->request->data)){
				$this->redirect("finish");	
			}			

			
		} else {

				$contactRec = $this->Contact->find('first', array(
					'conditions' => array('id'=> $id )
				)) ;
		
				$this->data = $contactRec;

				$this->set(compact("id"));

				$this->render('action');

		}	
	}


}