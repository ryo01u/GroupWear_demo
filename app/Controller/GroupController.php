<?php

class GroupController extends AppController {
	public $helpers = array('Html', 'Form');

	public $layout = ""; // レイアウトファイルは使用しない


	//モデル呼び出し
	public $uses = array('Staff' , 'Group' , 'Department' , 'Position' , 'StaffGroup');


/*
	public function index() {
		
		$this -> redirect("./detail/");
		
	}
	
	public function detail($id = null) {


		//グループ
		$group = $this -> Group -> find('first' , array('fields' => array() , 'conditions' => array( 'Group.id' => $id)));
		$this -> set('group' , $group);

		//スタッフグループ
		$staffgroup = $this -> StaffGroup -> getGroupList($id);
		$this -> set('staffgroup' , $staffgroup);


		//役職 -- config
		$this->set( 'position', Configure::read('position') );

		//職種 -- job -- config
		$this->set( 'job', Configure::read('job') );

	}
*/


	public function index() {
		
		$this -> redirect("./detail/");
		
	}


	public function detail($id = null) {

		//スタッフ
		$group = $this -> Group -> find('first' , array('fields' => array() , 'conditions' => array( 'Group.id' => $id)));
		$this -> set('group' , $group);


		//スタッフグループ
		$staffgroup = $this -> StaffGroup -> getStaffGroupByList($id);
		$this -> set('staffgroup' , $staffgroup);

	}

/*ここから
	public function index() {

		$this->redirect("./detail/" . urlencode($str));

	}
	
	public function detail($param) {
		
		$str = urldecode($param);
		
		//グループ
		$data_group = $this -> Group -> find('first' , 
			array(
				'conditions' => array('Group.id' => $str)
			)
		);
		$this -> set('data_group' , $data_group);
		
			//スタッフ
			$data_staff = $this -> Staff -> find('all' , 
				array(
					'conditions' => array('Staff.group_id' => $data_group['Group']['id'])
				)
			);
			$this -> set('data_staff' , $data_staff);
			
			//部署
			$data_department = $this -> Department -> find('first' , 
				array(
					'conditions' => array('Department.id' => $data_group['Group']['department_id'])
				)
			);
			$this -> set('data_department' , $data_department);
		
	}
ここまで
*/

}