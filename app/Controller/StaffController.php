<?php

class StaffController extends AppController {
	public $helpers = array('Html', 'Form', 'Util');

	public $layout = ""; // レイアウトファイルは使用しない

	//モデル呼び出し
	public $uses = array('Staff' , 'Group' , 'Department' , 'Position' , 'StaffGroup');
	
	
	
	
	public function index() {
		
		$this -> redirect("./detail/");
		
	}
	
	public function detail($id = null) {

/*	
		//スタッフ
		$this -> set('staff' , $this -> Staff -> find('all' , array('fields' => array('id' , 'name' , 'sex' , 'job' , 'mail_address' , 'extension_number' , 'job_item' , 'profile'), 'conditions' => array( 'Staff.id' => $id)))
		);
*/

		//スタッフ
		$staff = $this -> Staff -> find('first' , array('fields' => array() , 'conditions' => array( 'Staff.id' => $id)));
		$this -> set('staff' , $staff);


		//スタッフグループ
		$staffgroup = $this->StaffGroup->getStaffGroupList($id);

		$this ->set('staffgroup' , $staffgroup);
		
		//役職 -- config
		$this->set( 'position', Configure::read('position') );

		//職種 -- job -- config
		$this->set( 'job', Configure::read('job') );

	}


}