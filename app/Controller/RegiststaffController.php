<?php

class RegiststaffController extends AppController {

    public $helpers = array('Html', 'Form', 'Session', 'Js' => array('Jquery'));

	public $components = array('Session','RequestHandler','Common');

	public $uses = array('Staff','Group','Department','Position', 'StaffGroup');

	public $layout = "";


	public $paginate = array(
	    'Staff'=>array(
	       'field' => array('id' , 'staff_id', 'name' , 'delete_flag') ,
	       'limit' => 10 ,
	       'order' => array('id' => 'desc'),
	       'conditions' => array('delete_flag' => '0')
	    )
	);


	//授業部のグループ表示を切り替える
	public function ajax_group() {

		//$aaa= $this->Group->find('list',array( 'conditions' => array('department_id' => 1),'fields' => array('group_id', 'name')));

		//$this->log($aaa, LOG_FOR_YOU);
		$this->set('group_select',$this->Group->find('list',array( 'conditions' => array('department_id' => $this->params["url"]["data"]["Staff"]["department_id"]),'fields' => array('id', 'name'))));

	}


	function index(){
		$this->redirect("./lists");
	}


	function lists(){

		$staff = $this->paginate('Staff');

		$this->set( 'sex', Configure::read("sex") );
		$this->set( 'job', Configure::read("job") );
		$this->set( 'department', $this->Department->find( 'list', array(  'fields' => array( 'id', 'name') , 'conditions' => array('delete_flag' => 0) ) ) );
		$this->set( 'group', $this->Group->find( 'all', array( 'fields' => array( 'id', 'department_id', 'name' ) , 'conditions' => array('delete_flag' => 0)  ) ) );

		//$this->set( 'position', $this->Position->find( 'list', array( 'fields' => array( 'id', 'name'  ) , 'conditions' => array('delete_flag' => 0)  ) ) );;
		$this->set( 'position', Configure::read("position") );

		$staff_id_list = Set::extract('/Staff/id', $staff);

		$staffGroupInfo = $this->StaffGroup->getStaffGroupInfo($staff_id_list);

		$this->set( 'staffGroupInfo', $staffGroupInfo );
		//$staffGroup = $this->StaffGroup->find( 'all', array( 'fields' => array( 'id', 'staff_id','group_id') , 'conditions' => array('staff_id' => $staff_id_list) ) );
		//var_dump($staffGroupInfo);

		//$this->set( 'staffGroup', $staffGroup );

		$this->set('staff', $staff);

		$this->render('lists');

	}


	function del($id=0){

		$StaffRec = $this->Staff->find('first', array(
			'conditions' => array('id'=> $id , 'delete_flag' => 0)
		)) ;

		if($StaffRec){
		    //スタッフ削除
            $this->Staff->delStaff($id);
		}
		$this->redirect("./lists");
	}


	public function finish() {

		$this->render('finish');

	}


	public function action($id=0) {

		$this->set(compact("id"));

		$this->set('set_staff_id', $this->Auth->user('id'));


		$this->set( 'sex', Configure::read("sex") );
		$this->set( 'job', Configure::read("job") );
		$this->set( 'job_item', Configure::read("job_item") );
		$this->set( 'department_id', Configure::read("department_id") );
		$this->set( 'group_id', Configure::read("group_id") );
		$this->set( 'profile', Configure::read("profile") );
		$this->set( 'position', Configure::read("position") );



		//$this->set( 'position', $this->Position->find( 'list', array( 'fields' => array( 'position_id', 'name')) ) );

		$department = $this->Department->find( 'all', array( 'fields' => array( 'id', 'name') , 'conditions' => array('delete_flag' => 0) ) );
		$this->set( 'department', $department );
		//$this->set( 'department', $this->Department->find( 'list', array( 'fields' => array( 'department_id', 'name')) ) );

		$group = $this->Group->find( 'all', array( 'fields' => array( 'department_id','id', 'name')  ,  'conditions' => array('delete_flag' => 0) ) );
		$this->set( 'group', $group );
		//$this->set( 'group', $this->Group->find( 'list', array( 'fields' => array( 'group_id', 'name')) ) );

		//if ($id){
			$staffGroup = $this->StaffGroup->find( 'all', array( 'fields' => array( 'id', 'staff_id','group_id') , 'conditions' => array('staff_id' => $id) ) );

			$this->set( 'staffGroup', $staffGroup );
		//}


		//フォーム入力があった場合には保存処理。そうでない場合は初期値の準備
		if($this->request->isPost() || $this->request->isPut()) {
			//$this->Common->v("bbb");
			if ($id){
					$this->request->data["Staff"]["id"] =  $id;
			}

        	$this->Staff->set($this->request->data);
			//$this->Common->v( $this->Staff->validates());
       		if (! $this->Staff->validates()){
			      		 // $this->Common->v( $this->Staff->validationErrors);
				$this->set( 'errors', $this->Staff->validationErrors );
			 }

			//var_dump($this->request->data);

			//if ($this->Staff->save($this->request->data)){
			//	$this->redirect("finish");
			//}
			$staffSave = $this->Staff->save($this->request->data);

			$this->StaffGroup->setGroup($this->request->data , $staffSave["Staff"]["id"] );

			$image = $this->request->data["Staff"]["image"];
			$uploadfolder = "staff";
			if($image['tmp_name']){
				move_uploaded_file($image['tmp_name'],  WWW_ROOT  . "img" . "/" . $uploadfolder . "/" . $staffSave["Staff"]["id"] . ".jpg" );

			}

			if ($staffSave){
				$this->redirect("finish");
			}

		} else {

				$staffRec = $this->Staff->find('first', array(
					'conditions' => array('id'=> $id )
				)) ;

				$this->data = $staffRec;

				$this->set(compact("id"));
		if($staffRec && $staffRec["Staff"]["profile"]){

				$this->set( 'profile', $staffRec["Staff"]["profile"] );

				}

				$this->render('action');

		}


			//$this->Staff->create();

			//print date("Y/m/d G:i:s");










	}



}