<?php

class RegistprojectgroupController extends AppController {

	public $helpers = array('Html', 'Form', 'Session', 'Js' => array('Jquery'));

	public $components = array('Common','Session','RequestHandler');

	public $uses = array('Projectgroup');

	public $layout = "";

	function index(){
		$this->redirect("./lists");
	}

	function lists(){

		$this->set('projectgroup', $this->Projectgroup->find( 'list', array( 'fields' => array( 'id', 'name')) ) );

		$this->paginate = array(
			'Projectgroup'=>array(
			'field' => array('id' , 'name' , 'delete_flag' ) ,
			'limit' => 10 ,
			'order' => array('id' => 'desc'),
			'conditions' => array('delete_flag' => '0' )
			)
		);

		$projectgroup = $this->paginate('Projectgroup');

		$this->set('projectgroup', $projectgroup);

		$this->render('lists');

	}

	function del($id=0){

		$ProjectgroupRec = $this->Projectgroup->find('first', array(
			'conditions' => array('id'=> $id , 'delete_flag' => 0)
		)) ;

		if($ProjectgroupRec){
			//グループ削除
			$this->Projectgroup->delProjectgroup($id);
		}

		$this->redirect("./lists");
	}


	public function finish() {
		
		$this->render('finish');
		
	}

	public function action($id=0) {

		$this->set(compact("id"));
		$this->set('set_staff_id', $this->Auth->user('id'));

		$this->set( 'projectgroup', $this->Projectgroup->find( 'list', array( 'fields' => array( 'id', 'name') ,'conditions' => array( 'delete_flag' => 0)   )   ) );		
		
		//フォーム入力があった場合には保存処理。そうでない場合は初期値の準備
		if($this->request->isPost() || $this->request->isPut()) {
			//$this->Common->v("bbb");

			if ($id){
				$this->request->data["Projectgroup"]["id"] =  $id;
			}
			
			$this->Projectgroup->set($this->request->data);
					 //$this->Common->v( $this->Staff->validates());
			if (! $this->Projectgroup->validates()){
					 // $this->Common->v( $this->Department->validationErrors);	
					$this->set( 'errors', $this->Projectgroup->validationErrors );			
			}
			//var_dump($this->request->data);

			if ($this->Projectgroup->save($this->request->data)){
				$this->redirect("finish");	
			}			
			
		} else {
				$projectgroupRec = $this->Projectgroup->find('first', array(
					'conditions' => array('id'=> $id , 'delete_flag' => 0)
				)) ;
		
				$this->data = $projectgroupRec;

				$this->set(compact("id"));

				$this->render('action');

		}	


	}



}