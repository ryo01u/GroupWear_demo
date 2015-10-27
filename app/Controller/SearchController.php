<?php

//App::uses('SiteController', 'Controller');

class SearchController extends AppController {
	public $helpers = array('Html', 'Form');

	public $uses = array('Keyword',  'Department', 'Staff' ,  'Project' , 'Client', 'StaffGroup' ,'ProjectStaff' , 'ProjectClient' ,'Group');

	public $layout = "";

	public function index() {

		//$this->link();

	}

	public function keyword() {

		$view_flag = array();
		$view_flag["staff"] = 0;
		$view_flag["client"] = 0;
		$view_flag["project"] = 0;

		$type_selected = null;
		$akasatana_selected = null;		
		$name_selected = null;
		$created_selected = null;

		$order_condition = "type";

		$param_group_id = null;
		$param_s_v = null;
		$param_c_v = null;		
		$param_p_v = null;

		$keyword = null;
		
		if (isset($this->request->query["keyword"])){
			$keyword = trim($this->request->query["keyword"]);
		}
		$this->set('keyword', $keyword);		

		$param_group_array= "";
		if (isset($this->request->query["g"])){
			$param_group_array = $this->request->query["g"];
			$department_by_groupId = $this->Group->find( 'first', array(  'fields' => array( 'department_id') , 'conditions' => array( 'delete_flag' => 0 , 'view_flag' => 1 , 'id' => $param_group_array , ) ) ) ;
			$this->set('department_by_groupId', $department_by_groupId);
			
		} 
		$this->set('param_group_array', $param_group_array);

		$param_department_array= array();
		if (isset($this->request->query["d"])){
			$param_department_array = $this->request->query["d"];
			
		} 
		$this->set('param_department_array', $param_department_array);
			
		$departmentRec = $this->Department->find('all', array(
			'conditions' => array('delete_flag'=> 0 )
		)) ;

		$this->set('department_array',$departmentRec);



		$staff_search_checked =null;
		$project_search_checked =null;
		$client_search_checked = null;
		
		//viewパラメータがなにもない場合は強制的にチェック
		if (! isset($this->request->query["s_v"]) && ! isset($this->request->query["c_v"]) && ! isset($this->request->query["p_v"]) ){
			$staff_search_checked = "checked";
			$project_search_checked = "checked";
			$client_search_checked = "checked";
		}	
		
				 
		if (isset($this->request->query["s_v"])){
			$param_s_v = $this->request->query["s_v"];
			$staff_search_checked = "checked";
			$view_flag["staff"] = 1;						
		}
		$this->set('staff_search_checked', $staff_search_checked);

	 	if (isset($this->request->query["p_v"])){
			$param_p_v = $this->request->query["p_v"];
			$project_search_checked = "checked";
			$view_flag["project"] = 1;				
		}
		$this->set('project_search_checked', $project_search_checked);
				 
	 	if (isset($this->request->query["c_v"])){
			$param_s_v = $this->request->query["c_v"];
			$client_search_checked = "checked";
			$view_flag["client"] = 1;				
		}
		$this->set('client_search_checked', $client_search_checked);		

		$this->set(array(
		'query_string_url' => http_build_query($this->request->query),
		));


//$paginator->options(array('url' => array('?' => $query)));

		if ( isset($this->params['data']["Search"]["order"])){
			switch ($this->params['data']["Search"]["order"]) {
				case 'type':
					$order_condition = "type";
					$type_selected = "selected";					
					break;
				case 'name':
					$order_condition = "name";	
					$name_selected = "selected";									
					break;
				case 'akasatana':
					$order_condition = "akasatana";
					$akasatana_selected = "selected";										
					break;
				case 'created':
					$order_condition = "created";	
					$created_selected = "selected";									
					break;
			}
		}
	
		$this->set('type_selected',$type_selected);
		$this->set('name_selected',$name_selected);
		$this->set('akasatana_selected',$akasatana_selected);
		$this->set('created_selected',$created_selected);

		$staff_search_checked = "";

		if( ($view_flag["project"] == 1 || $view_flag["staff"] == 1 || $view_flag["client"] == 1 ) ){
	
				$cond = $this->Keyword->getKeywordSearchSql($keyword, $view_flag, $param_department_array ,$param_group_array );
							
				//$cond = $this->Page->getSqlList();
							
				$this->paginate = array(
				'conditions'=>$cond,
				'order'=>$order_condition,
				'limit'=>10,
				'recursive'=>0
				);

				$search_rec =$this->paginate('Keyword');
				
				$search_staff_ids = array();
				$search_project_ids = array();
				$search_client_ids = array();

				foreach ($search_rec as $row) {
		
						switch ($row["Some"]["type"]) {
						    case "s":
					
								$search_staff_ids[] = $row["Some"]["id"];
					        	break;
						    case "p":
								$search_project_ids[] = $row["Some"]["id"];
								
					        	break;
						    case "c":
								$search_client_ids[] = $row["Some"]["id"];
					        	break;				
						}
				}
				
				$this->set('search_array',$search_rec);
		
				//スタッフ情報
				if($search_staff_ids){
					$this->_setStaff($search_staff_ids);
				}
				//案件情報
				if($search_project_ids){
					$this->_setProject($search_project_ids);
				}
				//取引先情報
				if($search_client_ids){
					$this->_setClient($search_client_ids);
				}
				
		}

			
			$this->render('keyword');

	}
	


/*スタッフ情報を生成（マイページのpege_idをキーに
 * 
*/

	public function _setStaff($search_staff_ids) {
		
		$staff_rec = $this->Staff->find( 'all', array(  'fields' => array( 'id', 'name','sex' , 'extension_number','memo') , 'conditions' => array( 'delete_flag' => 0, 'view_flag' => 1 , 'id' => $search_staff_ids , ) ) ) ;
				
		$staff_array = array();
				
		foreach ($staff_rec as $row) {
			$staff_array[$row["Staff"]["id"]]["id"] = $row["Staff"]["id"];
			$staff_array[$row["Staff"]["id"]]["name"] = $row["Staff"]["name"];
			$staff_array[$row["Staff"]["id"]]["extension_number"] = $row["Staff"]["extension_number"];
			$staff_array[$row["Staff"]["id"]]["memo"] = $row["Staff"]["memo"];
			$StaffGroup_rec = $this->StaffGroup->getStaffGroupInfo($row["Staff"]["id"]) ;
			
			foreach ($StaffGroup_rec as $rec) {
				$staff_array[$row["Staff"]["id"]]["groups"][$rec["sg"]["group_id"]]["group_id"] = $rec["sg"]["group_id"];
				$staff_array[$row["Staff"]["id"]]["groups"][$rec["sg"]["group_id"]]["group_name"] = $rec["g"]["group_name"];
				$staff_array[$row["Staff"]["id"]]["departments"][$rec["g"]["department_id"]]["department_id"] = $rec["g"]["department_id"];
				$staff_array[$row["Staff"]["id"]]["departments"][$rec["g"]["department_id"]]["department_name"] = $rec["d"]["department_name"];				
			}
		}
		
		$this->set('staff_array',$staff_array);
	}

/*案件情報を生成（マイページのpege_idをキーに
 * 
*/

	public function _setProject($search_project_ids) {
			
		$project_rec = $this->Project->find( 'all', array(  'fields' => array( 'id', 'name') , 'conditions' => array( 'delete_flag' => 0 , 'id' => $search_project_ids , ) ) ) ;
		$project_array = array();
				
		foreach ($project_rec as $row) {

			$project_array[$row["Project"]["id"]]["id"] = $row["Project"]["id"];
			$project_array[$row["Project"]["id"]]["name"] = $row["Project"]["name"];
			$ProjectStaff_rec = $this->ProjectStaff->getProjectStaffInfo($row["Project"]["id"]) ;
			if($ProjectStaff_rec){
			
				$project_staff_ids = array();
				foreach ($ProjectStaff_rec as $rec) {
					$project_array[$row["Project"]["id"]]["staffs"][$rec["st"]["staff_id"]]["id"] = $rec["st"]["staff_id"];
					$project_array[$row["Project"]["id"]]["staffs"][$rec["st"]["staff_id"]]["name"] = $rec["s"]["staff_name"];
					$project_staff_ids[] = $rec["st"]["staff_id"]; 			;
				}
			}
			
			
			$StaffGroup_rec = $this->StaffGroup->getStaffGroupInfo($project_staff_ids);
			if($StaffGroup_rec){
				foreach ($StaffGroup_rec as $rec) {
					$project_array[$row["Project"]["id"]]["groups"][$rec["sg"]["group_id"]]["id"] =  $rec["sg"]["group_id"];
					$project_array[$row["Project"]["id"]]["groups"][$rec["sg"]["group_id"]]["name"] = $rec["g"]["group_name"];
					$project_array[$row["Project"]["id"]]["departments"][$rec["g"]["department_id"]]["id"] = $rec["g"]["department_id"];
					$project_array[$row["Project"]["id"]]["departments"][$rec["g"]["department_id"]]["name"] = $rec["d"]["department_name"];
				}
			}
			
		}
		$this->set('project_array',$project_array);
	}

	
/*取引先情報を生成（マイページのpege_idをキーに
 * 
*/


	public function _setClient($search_client_ids) {
		$client_rec = $this->Client->find( 'all', array(  'fields' => array( 'id', 'name', 'phone') , 'conditions' => array( 'delete_flag' => 0, 'view_flag' => 1 , 'id' => $search_client_ids , ) ) ) ;
		$client_array = array();		
		foreach ($client_rec as $row) {
			$client_array[$row["Client"]["id"]]["id"] = $row["Client"]["id"];
			$client_array[$row["Client"]["id"]]["name"] = $row["Client"]["name"];
			$client_array[$row["Client"]["id"]]["phone"] = $row["Client"]["phone"];
			$ClientStaff_rec = $this->ProjectClient->getProjectClientStaffInfo($row["Client"]["id"]) ;
			$client_staff_ids = array();
			if($ClientStaff_rec){
				foreach ($ClientStaff_rec as $rec) {
					$client_array[$row["Client"]["id"]]["staffs"][$rec["s"]["staff_id"]]["id"] =  $rec["s"]["staff_id"];						
					$client_array[$row["Client"]["id"]]["staffs"][$rec["s"]["staff_id"]]["name"] =  $rec["s"]["staff_name"];
					$client_staff_ids[] = $rec["s"]["staff_id"]; 			;					
				}
			}

			$StaffGroup_rec = $this->StaffGroup->getStaffGroupInfo($client_staff_ids);
			
			if($StaffGroup_rec){
				
				foreach ($StaffGroup_rec as $rec) {
					$client_array[$row["Client"]["id"]]["groups"][$rec["sg"]["group_id"]]["id"] =  $rec["sg"]["group_id"];
					$client_array[$row["Client"]["id"]]["groups"][$rec["sg"]["group_id"]]["name"] = $rec["g"]["group_name"];
					$client_array[$row["Client"]["id"]]["departments"][$rec["g"]["department_id"]]["id"] = $rec["g"]["department_id"];
					$client_array[$row["Client"]["id"]]["departments"][$rec["g"]["department_id"]]["name"] = $rec["d"]["department_name"];
				}
			}


						
		}
		
		$this->set('client_array',$client_array);
	}





}