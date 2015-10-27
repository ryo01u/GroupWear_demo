<?php

class StaffController extends AppController {
	public $helpers = array('Html', 'Form', 'Util');

	public $layout = ""; // ���C�A�E�g�t�@�C���͎g�p���Ȃ�

	//���f���Ăяo��
	public $uses = array('Staff' , 'Group' , 'Department' , 'Position' , 'StaffGroup');
	
	
	
	
	public function index() {
		
		$this -> redirect("./detail/");
		
	}
	
	public function detail($id = null) {

/*	
		//�X�^�b�t
		$this -> set('staff' , $this -> Staff -> find('all' , array('fields' => array('id' , 'name' , 'sex' , 'job' , 'mail_address' , 'extension_number' , 'job_item' , 'profile'), 'conditions' => array( 'Staff.id' => $id)))
		);
*/

		//�X�^�b�t
		$staff = $this -> Staff -> find('first' , array('fields' => array() , 'conditions' => array( 'Staff.id' => $id)));
		$this -> set('staff' , $staff);


		//�X�^�b�t�O���[�v
		$staffgroup = $this->StaffGroup->getStaffGroupList($id);

		$this ->set('staffgroup' , $staffgroup);
		
		//��E -- config
		$this->set( 'position', Configure::read('position') );

		//�E�� -- job -- config
		$this->set( 'job', Configure::read('job') );

	}


}