<?php

class MypageController extends AppController {
	
	public $helpers = array('Html', 'Form' , 'Util');

	public $layout = ""; //

	public $uses = array('StaffMypage' , 'Department' , 'Group' , 'Staff' ,  'Project' , 'Client' , 'StaffGroup');
 

	
	public function test() {


		

		$file = new File(WWW_ROOT.'img\bookmart\noimage.jpg');
		print ( WWW_ROOT . "img" . '\bookmart\noimage.jpg');
		print (file_exists( WWW_ROOT . "img" . '\bookmark\noimage.jpg'));

		

		/*
		//ブックマーク
		$this->StaffMypage->insertMypage($this->Auth->user('id') , "ブックマーク１"  , MYPAGE_BOOKMARK, 0 , "http:yahoo.co.jp"   );
		$this->StaffMypage->insertMypage($this->Auth->user('id') , "ブックマーク２"  , MYPAGE_BOOKMARK, 0 , "http:yahoo.co.jp"   );
		//部署ページ
		$this->StaffMypage->insertMypage($this->Auth->user('id') , null  , MYPAGE_DEPARTMENT, 1 , null   );
		$this->StaffMypage->insertMypage($this->Auth->user('id') , null  , MYPAGE_DEPARTMENT, 3 , null );
		//グループ情報
		$this->StaffMypage->insertMypage($this->Auth->user('id') , null  , MYPAGE_GROUP, 1 , null   );
		$this->StaffMypage->insertMypage($this->Auth->user('id') , null  , MYPAGE_GROUP, 3 , null );
		//スタッフ情報
		$this->StaffMypage->insertMypage($this->Auth->user('id') , null  , MYPAGE_STAFF, 183 , null   );
		$this->StaffMypage->insertMypage($this->Auth->user('id') , null  , MYPAGE_STAFF, 184 , null );
		//案件情報
		$this->StaffMypage->insertMypage($this->Auth->user('id') , null  , MYPAGE_PROJECT, 1 , null   );
		$this->StaffMypage->insertMypage($this->Auth->user('id') , null  , MYPAGE_PROJECT, 2 , null );		
		//取引先情報
		$this->StaffMypage->insertMypage($this->Auth->user('id') , null  , MYPAGE_CLIENT, 1 , null   );
		$this->StaffMypage->insertMypage($this->Auth->user('id') , null  , MYPAGE_CLIENT, 2 , null );
		*/				
	}
	

	public function bookmark() {

		//フォーム入力があった場合には保存処理。そうでない場合は初期値の準備
		if($this->request->isPost() || $this->request->isPut()) {
	        $this->StaffMypage->set($this->request->data);
			$name = $this->request->data["StaffMypage"]["name"];
			$url = $this->request->data["StaffMypage"]["url"];
			$staffMypageSave = $this->StaffMypage->insertMypage($this->Auth->user('id') , $name  , MYPAGE_BOOKMARK, 0 , $url   );
			$this->redirect("index");	
		}

	}


	public function index() {
		//$this->paginate('StaffMypage'  , array('user_id' => 1));
/*
		$staff = $this->Staff->find('all', array(
			'conditions' => array( 'delete_flag' => 0)
		)) ;

		$this->set('staff', $staff);

		$this->render('index');
*/	
		
			
	  $this->paginate = array(
		    'StaffMypage'=>array(
		       'field' => array('id' , 'staff_id' , 'mypage_type', 'name') ,
		       'limit' => 24,
		       'conditions' => array('staff_id' => $this->Auth->user('id')),
			        'order' => array('modified' => 'desc')
		    )
		);

		$staffMypage = $this->paginate("StaffMypage");
		
		$mypage_department_ids = array();
		$mypage_group_ids = array();
		$mypage_staff_ids = array();
		$mypage_project_ids = array();
		$mypage_client_ids = array();

		$bookmark_array = array();
	
		//mypage_type　⇒　 1:部署, 2:グループ, 3:スタッフ, 4:案件 , 5:取引先 ,  999:ブックマーク
		foreach ($staffMypage as $row) {

				switch ($row["StaffMypage"]["mypage_type"]) {
	    			case MYPAGE_BOOKMARK:
						$bookmark_array[$row["StaffMypage"]["id"]]["name"] = $row["StaffMypage"]["name"];
						$bookmark_array[$row["StaffMypage"]["id"]]["url"] = $row["StaffMypage"]["url"];
	        			break;
			    	case MYPAGE_DEPARTMENT:
				        $mypage_department_ids[] = $row["StaffMypage"]["page_id"];
			        	break;
				    case MYPAGE_GROUP:
						$mypage_group_ids[] = $row["StaffMypage"]["page_id"];
						break;
				    case MYPAGE_STAFF:
						$mypage_staff_ids[] = $row["StaffMypage"]["page_id"];
			        	break;
				    case MYPAGE_PROJECT:
						$mypage_project_ids[] = $row["StaffMypage"]["page_id"];
			        	break;
				    case MYPAGE_CLIENT:
						$mypage_client_ids[] = $row["StaffMypage"]["page_id"];
			        	break;				
				}
		}
				
		$this->set('mypage_array',$staffMypage);
		
		//ブックマーク		
		if($bookmark_array){
			$this->set('bookmark_array',$bookmark_array);
		} 

		if($mypage_department_ids){
			$this->_setDepartment($mypage_department_ids);	
		}
		//グループ情報
		if($mypage_group_ids){
			$this->_setGroup($mypage_group_ids);
		}
		//スタッフ情報
		if($mypage_staff_ids){
			$this->_setStaff($mypage_staff_ids);
		}
		//案件情報
		if($mypage_project_ids){
			$this->_setProject($mypage_project_ids);
		}
		//取引先情報
		if($mypage_client_ids){
			$this->_setClient($mypage_client_ids);
		}
		
	}
	

/*部署情報を生成（マイページのpege_idをキーに
 * 編集
*/

	public function _setDepartment($mypage_department_ids) {
		
		$department_rec = $this->Department->find( 'all', array(  'fields' => array( 'id', 'name', 'memo') , 'conditions' => array( 'delete_flag' => 0 , 'view_flag' => 1 , 'id' => $mypage_department_ids , ) ) ) ;
		$department_array = array();

		foreach ($department_rec as  $row) {


			$department_array[$row["Department"]["id"]]["id"] = $row["Department"]["id"];
			$department_array[$row["Department"]["id"]]["name"] = $row["Department"]["name"];
			$department_array[$row["Department"]["id"]]["memo"] = $row["Department"]["memo"];			
			$group_rec =$this->Group->find( 'list', array(  'fields' => array( 'id', 'name') , 'conditions' => array( 'delete_flag' => 0 , 'view_flag' => 1 , 'department_id' => $row["Department"]["id"] , ) ));

			foreach ($group_rec as $key2 => $value2) {
				$department_array[$row["Department"]["id"]]["groups"][$key2]["id"] = $key2;
				$department_array[$row["Department"]["id"]]["groups"][$key2]["name"] = $value2; 
			}				
		}	

		$this->set('department_array',$department_array);

			//foreach ($department_array[2]["groups"] as $rows) {
			//	print $rows["name"];
			//}
	
	}

/*グループ情報を生成（マイページのpege_idをキーに
 * 
*/

	public function _setGroup($mypage_group_ids) {
		
		//$group_rec = $this->Group->find( 'all', array(  'fields' => array( 'id', 'name','department_id','') , 'conditions' => array( 'delete_flag' => 0 , 'id' => $mypage_group_ids , ) ) ) ;
		$group_rec = $this->Group->getDepartmentGroupInfo($mypage_group_ids);		

		$group_array = array();
		foreach ($group_rec as $row) {
	
			$group_array[$row["g"]["group_id"]]["id"] = $row["g"]["group_id"];
			$group_array[$row["g"]["group_id"]]["name"] = $row["g"]["group_name"];
			$group_array[$row["g"]["group_id"]]["department_id"] = $row["g"]["department_id"];
			$group_array[$row["g"]["group_id"]]["department_name"] = $row["d"]["department_name"];
			$group_array[$row["g"]["group_id"]]["memo"] = $row["g"]["memo"];			
		}

		$this->set('group_array',$group_array);
	}



/*スタッフ情報を生成（マイページのpege_idをキーに
 * 
*/

	public function _setStaff($mypage_staff_ids) {
		$staff_rec = $this->Staff->find( 'all', array(  'fields' => array( 'id', 'name','sex' , 'extension_number','memo') , 'conditions' => array( 'delete_flag' => 0 , 'view_flag' => 1, 'id' => $mypage_staff_ids , ) ) ) ;
				
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
				$staff_array[$row["Staff"]["id"]]["groups"][$rec["sg"]["group_id"]]["department_id"] = $rec["g"]["department_id"];
				$staff_array[$row["Staff"]["id"]]["groups"][$rec["sg"]["group_id"]]["department_name"] = $rec["d"]["department_name"];				
			}
		}
		$this->set('staff_array',$staff_array);
	}

/*案件情報を生成（マイページのpege_idをキーに
 * 
*/

	public function _setProject($mypage_project_ids) {
		$project_rec = $this->Project->find( 'all', array(  'fields' => array( 'id', 'name','memo') , 'conditions' => array( 'delete_flag' => 0, 'view_flag' => 1 , 'id' => $mypage_project_ids , ) ) ) ;
		$project_array = array();		
		foreach ($project_rec as $row) {
			$project_array[$row["Project"]["id"]]["id"] = $row["Project"]["id"];

			$project_array[$row["Project"]["id"]]["name"] = $row["Project"]["name"];
			$project_array[$row["Project"]["id"]]["memo"] = $row["Project"]["memo"];

		}
		//var_dump($project_array[1]);
		$this->set('project_array',$project_array);
	}

	
/*取引先情報を生成（マイページのpege_idをキーに
 * 
*/


	public function _setClient($mypage_client_ids) {
		$client_rec = $this->Client->find( 'all', array(  'fields' => array( 'id', 'name', 'phone', 'memo') , 'conditions' => array( 'delete_flag' => 0, 'view_flag' => 1 , 'id' => $mypage_client_ids , ) ) ) ;
		$client_array = array();		
		foreach ($client_rec as $row) {
			$client_array[$row["Client"]["id"]]["id"] = $row["Client"]["id"];
			$client_array[$row["Client"]["id"]]["name"] = $row["Client"]["name"];
			$client_array[$row["Client"]["id"]]["phone"] = $row["Client"]["phone"];
			$client_array[$row["Client"]["id"]]["memo"] = $row["Client"]["memo"];
		}
		$this->set('client_array',$client_array);
	}



 	public function mypageadd(  $mypage_kbn=null, $id=null , $user_id=null) {

			if(! $user_id){
				$user_id = $this->Auth->user('id');
			}

			$mypageRec = $this->StaffMypage->find('first', array(
					'conditions' => array('mypage_type'=> $mypage_kbn  , 'page_id'=> $id , 'staff_id'=> $this->Auth->user('id') )
			)) ;
			//$mypageRecがなければ登録
			if(! $mypageRec){
				$this->StaffMypage->insertMypage($user_id , null  , $mypage_kbn, $id , null   );				
			}

	}


 	public function delete( $mypage_id) {

		$mypageRec = $this->StaffMypage->find('first', array(
			'conditions' => array('id'=> $mypage_id )
		)) ;

		if($mypageRec){
		    //スタッフ削除
            $this->StaffMypage->delete($mypage_id);
		}

		$this->redirect("/mypage/");

	}
 	

 	public function deletefinish() {

	}
 	




}