<?php

class RegistclientController extends AppController {

    public $helpers = array('Html', 'Form', 'Session', 'Js' => array('Jquery'));

	public $components = array('Session','RequestHandler','Common');

	public $uses = array('Staff','Group','Department','Position','Client', 'ClientStaff', 'StaffGroup', 'Contact');

	public $layout = "";


	public $paginate = array(
	    'Client'=>array(
	       'field' => array('id' , 'name' , 'delete_flag') ,
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


	function test(){

		$id = 1;
		$project = $this->Project->find( 'first', array(  'conditions' => array('id' => $id  , 'delete_flag' => '0') ,  'fields' => array( 'id', 'name' ))  );


		$projectArray = array();
		$projectArray["id"] = $id;
		$projectArray["name"] = $project["Project"]["name"];

		$r_projectStaff = $this->ProjectStaff->find( 'list', array( 'conditions' => array('project_id' => $id ) ,  'fields' => array( 'id', 'staff_id' ))  );
		$staff = $this->Staff->find( 'list', array( 'conditions' => array('delete_flag' => '0') ,  'fields' => array( 'id', 'name' ))  );

		foreach ($r_projectStaff as $key => $value) {
			$projectArray["staff"][$key]["id"] = $value;
			
			$projectArray["staff"][$key]["name"] = $staff[$value];
		}


		$this->set('project', $project);

		

		//$data =$this->Project->getProjectListById("1");


		$this->render('test');


	}

	function index(){
		$this->redirect("./lists");
	}


	function lists(){

		$client = $this->paginate('Client');

		$this->set( 'department', $this->Department->find( 'list', array(  'fields' => array( 'id', 'name') , 'conditions' => array('delete_flag' => 0) ) ) );
		$this->set( 'group', $this->Group->find( 'list', array( 'fields' => array( 'id', 'name') , 'conditions' => array('delete_flag' => 0)  ) ) );	
		//$this->set( 'contact', $this->Contact->find( 'list', array( 'fields' => array( 'id', 'name') , 'conditions' => array('delete_flag' => 0)  ) ) );
		$this->set('client', $client);

		if($client){
			$client_id_list = Set::extract('/Client/id', $client);	
			$clientStaffInfo = $this->ClientStaff->getClientStaffInfo($client_id_list);		
			$this->set( 'clientStaffInfo', $clientStaffInfo );
		}

	
		$this->render('lists');

	}


	function del($id=0){

		$clientRec = $this->Client->find('first', array(
			'conditions' => array('id'=> $id , 'delete_flag' => 0)
		)) ;

		if($clientRec){
		    //スタッフ削除
		    
		    //$this->Common->v("aa");
            $this->Client->delClient($id);
		}
		$this->redirect("./lists");
	}


	public function finish() {
		
		$this->render('finish');
		
	}

	public function action($id=0) {

		$this->set(compact("id"));

		//$this->set( 'sex', Configure::read("sex") );
		//$this->set( 'job', Configure::read("job") );
		//$this->set( 'akasatana', Configure::read("akasatana") );
		//$this->set( 'client_type', Configure::read("client_type") );
		$this->set('set_staff_id', $this->Auth->user('id'));
		$this->set( 'memo', Configure::read("memo") );
		
		$department = $this->Department->find( 'all', array( 'fields' => array( 'id', 'name') , 'conditions' => array('delete_flag' => 0) ) );
		$this->set( 'department', $department );

		$group = $this->Group->find( 'all', array( 'fields' => array( 'department_id','id', 'name')  ,  'conditions' => array('delete_flag' => 0) ) );

		$this->set( 'group', $group );	
		//$this->set( 'position', $this->Position->find( 'list', array( 'fields' => array( 'position_id', 'name')) ) );
		$staffGroup = $this->StaffGroup->getStaffGroupList();
		$this->set( 'staffGroup', $staffGroup );	
		
		
		
		$staff = $this->Staff->find( 'all', array( 'fields' => array( 'id', 'name')  ,  'conditions' => array('delete_flag' => 0) ) );
		$this->set( 'staff', $staff );

		if ($id){		
			$clientStaff = $this->ClientStaff->find( 'all', array( 'fields' => array( 'id', 'client_id','staff_id') , 'conditions' => array('client_id' => $id) ) );
			$this->set( 'clientStaff', $clientStaff );
				
		}
						
		//フォーム入力があった場合には保存処理。そうでない場合は初期値の準備
		if($this->request->isPost() || $this->request->isPut()) {

			if ($id){
					$this->request->data["Client"]["id"] =  $id;
			}
					
	        $this->Client->set($this->request->data);
       				         
			 if (! $this->Client->validates()){
			      		 // $this->Common->v( $this->Staff->validationErrors);	
				$this->set( 'errors', $this->Client->validationErrors );			
			 }

			$clientSave = $this->Client->save($this->request->data);
			//$this->Common->v( $this->request->data);	
			//$this->Common->v( $projectSave["Project"]["id"]);	
			
			//$this->ClientStaff->setClient($this->request->data , $clientSave["Client"]["id"] );

			if ($clientSave ){
				$this->redirect("finish");	
			}			

					
			} else {

				$clientRec = $this->Client->find('first', array(
					'conditions' => array('id'=> $id )
				)) ;
		
				$this->data = $clientRec;

				$this->set(compact("id"));

				if($clientRec && $clientRec["Client"]["memo"]){			
				
				$this->set( 'memo', $clientRec["Client"]["memo"] );

				}

				$this->render('action');

			}	

			//$this->Staff->create();

			//print date("Y/m/d G:i:s");

	}



}