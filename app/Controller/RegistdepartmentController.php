<?php

class RegistdepartmentController extends AppController {

	public $helpers = array('Html', 'Form', 'Session', 'Js' => array('Jquery'));

	public $components = array('Common','Session','RequestHandler');

	public $uses = array('Department');

	public $layout = "";

	public $paginate = array(
		'Department'=>array(
		'field' => array('id' , 'name' , 'delete_flag') ,
		'limit' => 10 ,
		'order' => array('id' => 'desc'),
		'conditions' => array('delete_flag' => '0')
		)
	);

	//授業部のグループ表示を切り替える
	public function ajax_group() {
	
		$aaa= $this->Group->find('list',array( 'conditions' => array('department_id' => 1),'fields' => array('group_id', 'name')));
	
		$this->log($aaa, LOG_FOR_YOU);
		$this->set('group_select',$this->Group->find('list',array( 'conditions' => array('department_id' => $this->params["url"]["data"]["Staff"]["department_id"]),'fields' => array('group_id', 'name'))));

	}

	function index(){
		$this->redirect("./lists");
	}

	function lists(){

//var_dump($this->Auth->user());

		$department = $this->paginate('Department');
		
		$this->set('department', $department);

		$this->render('lists');

	}

	function del($id=0){

		$DepartmentRec = $this->Department->find('first', array(
			'conditions' => array('id'=> $id , 'delete_flag' => 0)
		)) ;

		if($DepartmentRec){
			//スタッフ削除
			$this->Department->delDepartment($id);
		}

		$this->redirect("./lists");
	}


	public function finish() {
		
		$this->render('finish');
		
	}

	public function action($id=0) {


		$this->set(compact("id"));

		$this->set('set_staff_id', $this->Auth->user('id'));

		//フォーム入力があった場合には保存処理。そうでない場合は初期値の準備
		if($this->request->isPost() || $this->request->isPut()) {

			if ($id){
				$this->request->data["Department"]["id"] =  $id;
				//$this->Common->v($id);

			}
			
			
			$this->Department->set($this->request->data);
			
					 //$this->Common->v( $this->Staff->validates());
		
			if (! $this->Department->validates()){
					 // $this->Common->v( $this->Department->validationErrors);	
					$this->set( 'errors', $this->Department->validationErrors );			
			}

			//var_dump($this->request->data);

			//if ($this->Department->save($this->request->data)){
			//	$this->redirect("finish");	
			//}			
			$saveResult =$this->Department->save($this->request->data);
			$image = $this->request->data["Department"]["image"];
			$uploadfolder = "department";
			if($image['tmp_name']){
				move_uploaded_file($image['tmp_name'],  WWW_ROOT  . "img" . "/" . $uploadfolder . "/" . $saveResult["Department"]["id"] . ".jpg" );
			}		
			if ($saveResult){
				$this->redirect("finish");
			}

			
		} else {

				$departmentRec = $this->Department->find('first', array(
					'conditions' => array('id'=> $id )
				)) ;
		
				$this->data = $departmentRec;

				$this->set(compact("id"));

				$this->render('action');

		}	


	}



}