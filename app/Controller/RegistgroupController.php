<?php

class RegistgroupController extends AppController {

	public $helpers = array('Html', 'Form', 'Session', 'Js' => array('Jquery'));

	public $components = array('Common','Session','RequestHandler');

	public $uses = array('Group','Department');

	public $layout = "";

		public $paginate = array(
			'Group'=>array(
			'field' => array('id' , 'name' , 'delete_flag') ,
			'limit' => 10 ,
			'order' => array('id' => 'desc'),
			'conditions' => array('delete_flag' => '0')
			)
		);

	function index(){
		$this->redirect("./lists");
	}

	function lists($department_id = 0){

		$this->set( 'department', $this->Department->find( 'list', array( 'fields' => array( 'id', 'name')) ) );

		if($department_id){
			$this->paginate = array(
				'Group'=>array(
				'field' => array('id' , 'name' , 'delete_flag' ) ,
				'limit' => 10 ,
				'order' => array('id' => 'desc'),
				'conditions' => array('delete_flag' => '0', 'department_id' => $department_id )
				)
			);
		}


		$group = $this->paginate('Group');

		$this->set('group', $group);

		$this->render('lists');

	}

	function del($id=0){

		$GroupRec = $this->Group->find('first', array(
			'conditions' => array('id'=> $id , 'delete_flag' => 0)
		)) ;

		if($GroupRec){
			//グループ削除
			$this->Group->delGroup($id);
		}

		$this->redirect("./lists");
	}


	public function finish() {
		
		$this->render('finish');
		
	}

	public function action($id=0) {

		$this->set(compact("id"));
		$this->set('set_staff_id', $this->Auth->user('id'));

		$this->set( 'department', $this->Department->find( 'list', array( 'fields' => array( 'id', 'name') ,'conditions' => array( 'delete_flag' => 0)   )   ) );
		

		//フォーム入力があった場合には保存処理。そうでない場合は初期値の準備
		if($this->request->isPost() || $this->request->isPut()) {
			//$this->Common->v("bbb");

			if ($id){
				$this->request->data["Group"]["id"] =  $id;
			}
			
			
			$this->Group->set($this->request->data);
			
					 //$this->Common->v( $this->Staff->validates());
		
			if (! $this->Group->validates()){
					 // $this->Common->v( $this->Department->validationErrors);	
					$this->set( 'errors', $this->Group->validationErrors );			
			}

			//var_dump($this->request->data);

			if ($this->Group->save($this->request->data)){
				$this->redirect("finish");	
			}			

			
		} else {

				$groupRec = $this->Group->find('first', array(
					'conditions' => array('id'=> $id )
				)) ;
		
				$this->data = $groupRec;

				$this->set(compact("id"));

				$this->render('action');

		}	


	}



}