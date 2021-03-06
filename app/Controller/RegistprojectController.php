<?php

class RegistprojectController extends AppController {

    public $helpers = array('Html', 'Form', 'Session', 'Js' => array('Jquery'));

	public $components = array('Session','RequestHandler','Common');

	public $uses = array('Staff','Group','Department','Position','Project', 'ProjectStaff','StaffGroup', 'Client', 'Contact', 'Clientmemo' ,'Projectgroup','ProjectClient');

	public $layout = "";


	public $paginate = array(
	    'Project'=>array(
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
		$project = $this->Project->find( 'first', array(  'conditions' => array('id' => $id  , 'delete_flag' => '0', 'view_flag' => 1) ,  'fields' => array( 'id', 'name' ))  );


		$projectArray = array();
		$projectArray["id"] = $id;
		$projectArray["name"] = $project["Project"]["name"];

		$r_projectStaff = $this->ProjectStaff->find( 'list', array( 'conditions' => array('project_id' => $id ) ,  'fields' => array( 'id', 'staff_id' ))  );
		$staff = $this->Staff->find( 'list', array( 'conditions' => array('delete_flag' => '0', 'view_flag' => 1) ,  'fields' => array( 'id', 'name' ))  );

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

		$project = $this->paginate('Project');

		$this->set( 'department', $this->Department->find( 'list', array(  'fields' => array( 'id', 'name') , 'conditions' => array('delete_flag' => 0, 'view_flag' => 1) ) ) );
		$this->set( 'group', $this->Group->find( 'list', array( 'fields' => array( 'id', 'name') , 'conditions' => array('delete_flag' => 0, 'view_flag' => 1)  ) ) );	

		$this->set('project', $project);

		if($project){
			$project_id_list = Set::extract('/Project/id', $project);	
			$projectStaffInfo = $this->ProjectStaff->getProjectStaffInfo($project_id_list);		
			$this->set( 'projectStaffInfo', $projectStaffInfo );
		}

	
		$this->render('lists');

	}


	function del($id=0){

		$projectRec = $this->Project->find('first', array(
			'conditions' => array('id'=> $id , 'delete_flag' => 0)
		)) ;

		if($projectRec){
		    //スタッフ削除
            $this->Project->delStaff($id);
		}
		$this->redirect("./lists");
	}


	public function finish() {
		
		$this->render('finish');
		
	}


	public function action($id=0) {

		$this->set(compact("id"));

		$this->set( 'projectgroup', $this->Projectgroup->find( 'list', array( 'fields' => array( 'id', 'name') ,'conditions' => array( 'delete_flag' => 0)   )   ) );

		//$this->set( 'client', $this->Client->find( 'list', array( 'fields' => array( 'id', 'name') ,'conditions' => array( 'delete_flag' => 0)   )   ) );
		//$this->set( 'client', $client );

		//$this->set( 'sex', Configure::read("sex") );
		//$this->set( 'job', Configure::read("job") );
		$this->set( 'akasatana', Configure::read("akasatana") );
		$this->set( 'project_type', Configure::read("project_type") );
		$this->set( 'states', Configure::read("states") );
		$this->set( 'markets', Configure::read("markets") );
		$this->set( 'plane_memo', Configure::read("plane_memo") );


		//$client = $this->Client->find( 'list', array( 'fields' => array( 'id', 'name')  ,  'conditions' => array('delete_flag' => 0) ) );
		//$this->set( 'client', $client );
		
		$department = $this->Department->find( 'all', array( 'fields' => array( 'id', 'name') , 'conditions' => array('delete_flag' => 0, 'view_flag' => 1) ) );
		$this->set( 'department', $department );

		$group = $this->Group->find( 'all', array( 'fields' => array( 'department_id','id', 'name')  ,  'conditions' => array('delete_flag' => 0, 'view_flag' => 1) ) );
		$this->set( 'group', $group );

		//$staffGroup = $this->StaffGroup->find( 'all', array( 'fields' => array( 'id', 'staff_id','group_id')  ) );
		$staffGroup = $this->StaffGroup->getStaffGroupList();
		
		$this->set( 'staffGroup', $staffGroup );	
		
	
		//$this->set( 'position', $this->Position->find( 'list', array( 'fields' => array( 'position_id', 'name')) ) );

		$staff = $this->Staff->find( 'all', array( 'fields' => array( 'id', 'name')  ,  'conditions' => array('delete_flag' => 0, 'view_flag' => 1) ) );
		$this->set( 'staff', $staff );
		

		$client = $this->Client->find( 'all', array( 'fields' => array( 'id', 'name')  ,  'conditions' => array('delete_flag' => 0, 'view_flag' => 1) ) );
		$this->set( 'client', $client );


		if ($id){
			
			$projectRec = $this->Project->find('first', array(
				'conditions' => array('id'=> $id )
			)) ;
			$this->set( 'projectRec', $projectRec );						
			//var_dump($projectRec);		
			$projectStaff = $this->ProjectStaff->find( 'all', array( 'fields' => array( 'id', 'project_id','staff_id') , 'conditions' => array('project_id' => $id) ) );
			$this->set( 'projectStaff', $projectStaff );
			
			$staff_array = $this->Staff->find( 'list', array( 'conditions' => array('delete_flag' => '0') ,  'fields' => array( 'id', 'name' ))  );			
		
			$this->set( 'staff_array', $staff_array );
			//仕入れ先
			$projectClient = $this->ProjectClient->find( 'all', array( 'fields' => array( 'id', 'project_id','client_id') , 'conditions' => array('project_id' => $id, 'kbn' => 2) ) );

			$this->set( 'projectClient', $projectClient );
			//得意先
			$projectClientRegular = $this->ProjectClient->find( 'all', array( 'fields' => array( 'id', 'project_id','client_id') , 'conditions' => array('project_id' => $id, 'kbn' => 1) ) );

			$this->set( 'projectClientRegular', $projectClientRegular );
			$client_array = $this->Client->find( 'list', array( 'conditions' => array('delete_flag' => '0') ,  'fields' => array( 'id', 'name' ))  );			
			$this->set( 'client_array', $client_array );

		}
						
		//フォーム入力があった場合には保存処理。そうでない場合は初期値の準備
		if($this->request->isPost() || $this->request->isPut()) {

			if ($id){
					$this->request->data["Project"]["id"] =  $id;
			}
					
	        $this->Project->set($this->request->data);
       				         
			 if (! $this->Project->validates()){
			      		 // $this->Common->v( $this->Staff->validationErrors);	
				$this->set( 'errors', $this->Project->validationErrors );			
			 }

			$projectSave = $this->Project->save($this->request->data);
			//$this->Common->v( $this->request->data);	
			//$this->Common->v( $projectSave["Project"]["id"]);
				
			
				
			//プロジェクトスタッフリレーション登録
			if($projectSave["Project"]["id"] && isset($this->request->data["ProjectStaff"])){
			//$this->Common->v($projectSave);	
				$this->ProjectStaff->setStaff($this->request->data , $projectSave["Project"]["id"] );	
			}

			//プロジェクト仕入れ先リレーション登録
			if($projectSave["Project"]["id"] && isset($this->request->data["ProjectClient"])){
				$this->ProjectClient->setClient($this->request->data , $projectSave["Project"]["id"] );	
			}

			//プロジェクト得意先リレーション登録
			if($projectSave["Project"]["id"] && isset($this->request->data["ProjectClient"])){
				$this->ProjectClient->setClientRegular($this->request->data , $projectSave["Project"]["id"] );	
			}

			
			
			if ($projectSave){
				$this->redirect("finish");	
			}			
	
			
		} else {
				if(isset($projectRec)){
					$this->data = $projectRec;

					if($projectRec && $projectRec["Project"]["states"] && $projectRec["Project"]["memo"] && $projectRec["Project"]["markets"] ){			
					
						$this->set( 'states', $projectRec["Project"]["states"] );
						$this->set( 'memo', $projectRec["Project"]["memo"] );
						$this->set( 'markets', $projectRec["Project"]["markets"] );

					}

				}

				$this->set(compact("id"));

				$this->render('action');

			}	

			//$this->Staff->create();

			//print date("Y/m/d G:i:s");

	}




}