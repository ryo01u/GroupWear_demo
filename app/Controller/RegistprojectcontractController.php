<?php

class RegistprojectcontractController extends AppController {


	public $helpers = array('Html', 'Form', 'Session', 'Js' => array('Jquery'));

	public $components = array('Common','Session','RequestHandler');

	public $uses = array('Projectcontract','Project');

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

		$this->set( 'contract_status', Configure::read("contract_status") );

		if($project_id){
			$this->paginate = array(
				'Projectcontract'=>array(
				'field' => array('id' , 'name' , 'delete_flag' ) ,
				'limit' => 10 ,
				'order' => array('id' => 'desc'),
				'conditions' => array('delete_flag' => '0', 'project_id' => $project_id )
				)
			);
		}

		$projectcontract = $this->paginate('Projectcontract');

		$this->set('projectcontract', $projectcontract);

		$this->render('lists');

	}

	function del($id=0){

		if (isset($this->request->query["pid"])){
			$project_id = $this->request->query["pid"];
			$this->set('project_id', $project_id);
		}	

		$projectcontractRec = $this->Projectcontract->find('first', array(
			'conditions' => array('id'=> $id , 'delete_flag' => 0)
		)) ;

		//削除
		if($projectcontractRec){
			$this->Projectcontract->del($id);
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

		$this->set( 'contract_status', Configure::read("contract_status") );

		if (isset($this->request->query["pid"])){
			$project_id = $this->request->query["pid"];
			$this->set('project_id', $project_id);
			$this->set( 'project', $this->Project->find( 'first', array( 'fields' => array( 'id', 'name') ,'conditions' => array('id'=> $project_id , 'delete_flag' => 0)) ) );
			//var_dump($this->Project->find( 'first', array( 'fields' => array( 'id', 'name') ,'conditions' => array('id'=> $project_id , 'delete_flag' => 0)) ));			
		}	

		//フォーム入力があった場合には保存処理。そうでない場合は初期値の準備
		if($this->request->isPost() || $this->request->isPut()) {

			if ($id){
				$this->request->data["Projectcontract"]["id"] =  $id;
			}
			$project_id = $this->request->data["Projectcontract"]["project_id"];
			
			$this->Projectcontract->set($this->request->data);
		
			if (! $this->Projectcontract->validates()){
					 // $this->Common->v( $this->Department->validationErrors);	
					$this->set( 'errors', $this->Projectcontract->validationErrors );			
			}

			if ($this->Projectcontract->save($this->request->data)){
				$this->redirect("finish/?pid=$project_id");	
			}			
			
		} else {
				$projectcontractRec = $this->Projectcontract->find('first', array(
					'conditions' => array('id'=> $id )
				)) ;

				$this->data = $projectcontractRec;
				$this->set(compact("id"));
				$this->render('action');

		}	


	}



}