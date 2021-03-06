<?php


class ProjectController extends AppController {


	public $helpers = array('Html', 'Form');

	public $layout = ""; // レイアウトファイルは使用しない


	//モデル呼び出し
	public $uses = array('Project','Projectgroup','ProjectStaff','Projectmemo','Projectcontract','Staff','ProjectClient');

	public function test() {

		var_dump($this->request->query);

		$this->render('test');
		
	}


	public function detail($id=null) {

		$this->set('id',$id);

		//案件
		$project = $this->Project->find('first', array(
			'conditions' => array('id'=> $id , 'delete_flag' => 0)
		)) ;
		$this->set('project',$project);
		//スタッフ情報
		$staff = $this->Staff->find('list', array( 'fields' => array('id', 'name'),  'conditions' => array( 'delete_flag' => 0, 'view_flag' => 1))) ;
		$this->set('staff',$staff);
		$projectStaff = array();
		$ProjectStaff_rec = $this->ProjectStaff->getProjectStaffInfo($id) ;
		$project_staff_ids = array();
		$projectGroup = array();
		if($ProjectStaff_rec){
			foreach ($ProjectStaff_rec as $rec) {
				$projectStaff[$rec["st"]["staff_id"]]["id"]  =$rec["st"]["staff_id"]; 
				$projectStaff[$rec["st"]["staff_id"]]["name"]  =$rec["s"]["staff_name"];
				$project_staff_ids[] = $rec["st"]["staff_id"];
			}
		}
		$this->set('projectStaff',$projectStaff);		
		$projectGroup = array();
		$StaffGroup_rec = $this->StaffGroup->getStaffGroupInfo($project_staff_ids);

		if($StaffGroup_rec){
			foreach ($StaffGroup_rec as $rec) {
				$projectGroup[$rec["sg"]["group_id"]]["group_id"]  =$rec["sg"]["group_id"]; 
				$projectGroup[$rec["sg"]["group_id"]]["group_name"]  =$rec["g"]["group_name"];
				$projectGroup[$rec["sg"]["group_id"]]["department_id"]  =$rec["g"]["department_id"]; 
				$projectGroup[$rec["sg"]["group_id"]]["department_name"]  =$rec["d"]["department_name"];
			}
		}
		//仕入れ先
		$projectClient = array(); 
		$ProjectClient_rec = $this->ProjectClient->getProjectClientInfo($id, "2");
		if($ProjectClient_rec){
			foreach ($ProjectClient_rec as $rec) {
				$projectClient[$rec["pc"]["client_id"]]["client_id"]  =$rec["pc"]["client_id"]; 
				$projectClient[$rec["pc"]["client_id"]]["client_name"]  = $rec["c"]["client_name"];
			}
		}
		$this->set('projectClient',$projectClient);

		//得意先
		$projectClientRegular = array(); 
		$ProjectClient_regular_rec = $this->ProjectClient->getProjectClientInfo($id, "1");
		if($ProjectClient_regular_rec){
			foreach ($ProjectClient_regular_rec as $rec) {
				$projectClientRegular[$rec["pc"]["client_id"]]["client_id"]  =$rec["pc"]["client_id"]; 
				$projectClientRegular[$rec["pc"]["client_id"]]["client_name"]  = $rec["c"]["client_name"];
			}
		}
		$this->set('projectClientRegular',$projectClientRegular);



		$this->set('projectGroup',$projectGroup);
		//メモ
		$projectMemo = $this->Projectmemo->find('all', array(
			'conditions' => array('project_id' , 'delete_flag' => 0)
		)) ;
		
		$this->set('projectMemo',$projectMemo);

		//契約
		$projectcontract = $this->Projectcontract->find('all', array(
			'conditions' => array('project_id' , 'delete_flag' => 0)
		)) ;

		$this->set('projectcontract',$projectcontract);

		$this->set( 'contract_status', Configure::read("contract_status") );

//$this->Common->v($Projectcontract);


		$this->render('detail');


	}



}