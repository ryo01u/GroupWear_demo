<?php

class RegistprojectmemoController extends AppController {


	public $helpers = array('Html', 'Form', 'Session', 'Js' => array('Jquery'));

	public $components = array('Common','Session','RequestHandler');

	public $uses = array('Projectmemo','Project');

	public $layout = "";

	function index(){
		$this->redirect("./lists");
	}

	function lists(){

		if (isset($this->request->query["pid"])){
			$project_id = $this->request->query["pid"];
			$this->set('project_id', $project_id);
			$this->set( 'project', $this->Project->find( 'list', array( 'fields' => array( 'id', 'name') ,'conditions' => array('id'=> $project_id , 'delete_flag' => 0)) ) );			
		}	

		if($project_id){
			$this->paginate = array(
				'Projectmemo'=>array(
				'field' => array('id' , 'name' , 'delete_flag' ) ,
				'limit' => 10 ,
				'order' => array('id' => 'desc'),
				'conditions' => array('delete_flag' => '0', 'project_id' => $project_id )
				)
			);
		}

		$projectmemo = $this->paginate('Projectmemo');

		$this->set('projectmemo', $projectmemo);

		$this->render('lists');

	}

	function del($id=0){

		if (isset($this->request->query["pid"])){
			$project_id = $this->request->query["pid"];
			$this->set('project_id', $project_id);
		}	

		$projectmemoRec = $this->Projectmemo->find('first', array(
			'conditions' => array('id'=> $id , 'delete_flag' => 0)
		)) ;

		//削除
		if($projectmemoRec){
			$this->Projectmemo->del($id);
		}

		$this->redirect("./lists?pid=$project_id");
	}


	public function finish() {
		
		if (isset($this->request->query["pid"])){
			$project_id = $this->request->query["pid"];
			$this->set('project_id', $project_id);
		}	
		$this->render('finish');
		
	}

	public function action($id=0) {

		$this->set('id', $id);
				
		$this->set('set_staff_id', $this->Auth->user('id'));

		if (isset($this->request->query["pid"])){
			$project_id = $this->request->query["pid"];
			$this->set('project_id', $project_id);
			$this->set( 'project', $this->Project->find( 'first', array( 'fields' => array( 'id', 'name') ,'conditions' => array('id'=> $project_id , 'delete_flag' => 0)) ) );
			//var_dump($this->Project->find( 'first', array( 'fields' => array( 'id', 'name') ,'conditions' => array('id'=> $project_id , 'delete_flag' => 0)) ));			
		}	


		//フォーム入力があった場合には保存処理。そうでない場合は初期値の準備
		if($this->request->isPost() || $this->request->isPut()) {

			if ($id){
				$this->request->data["Projectmemo"]["id"] =  $id;
			}
			$project_id = $this->request->data["Projectmemo"]["project_id"];
			
			$this->Projectmemo->set($this->request->data);
		
			if (! $this->Projectmemo->validates()){
					 // $this->Common->v( $this->Department->validationErrors);	
					$this->set( 'errors', $this->Projectmemo->validationErrors );			
			}

			//var_dump($this->request->data);
			if ($this->Projectmemo->save($this->request->data)){
				
				
				$this->redirect("finish/?pid=$project_id");	
			}			
			
		} else {

				$projectmemoRec = $this->Projectmemo->find('first', array(
					'conditions' => array('id'=> $id )
				)) ;

				$this->data = $projectmemoRec;
				$this->set(compact("id"));
				$this->render('action');

		}	


	}



}