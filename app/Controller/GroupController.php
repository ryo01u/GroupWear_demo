<?php

class GroupController extends AppController {
	public $helpers = array('Html', 'Form');

	public $layout = ""; // ���C�A�E�g�t�@�C���͎g�p���Ȃ�


	//���f���Ăяo��
	public $uses = array('Staff' , 'Group' , 'Department' , 'Position' , 'StaffGroup');


/*
	public function index() {
		
		$this -> redirect("./detail/");
		
	}
	
	public function detail($id = null) {


		//�O���[�v
		$group = $this -> Group -> find('first' , array('fields' => array() , 'conditions' => array( 'Group.id' => $id)));
		$this -> set('group' , $group);

		//�X�^�b�t�O���[�v
		$staffgroup = $this -> StaffGroup -> getGroupList($id);
		$this -> set('staffgroup' , $staffgroup);


		//��E -- config
		$this->set( 'position', Configure::read('position') );

		//�E�� -- job -- config
		$this->set( 'job', Configure::read('job') );

	}
*/


	public function index() {
		
		$this -> redirect("./detail/");
		
	}


	public function detail($id = null) {

		//�X�^�b�t
		$group = $this -> Group -> find('first' , array('fields' => array() , 'conditions' => array( 'Group.id' => $id)));
		$this -> set('group' , $group);


		//�X�^�b�t�O���[�v
		$staffgroup = $this -> StaffGroup -> getStaffGroupByList($id);
		$this -> set('staffgroup' , $staffgroup);

	}

/*��������
	public function index() {

		$this->redirect("./detail/" . urlencode($str));

	}
	
	public function detail($param) {
		
		$str = urldecode($param);
		
		//�O���[�v
		$data_group = $this -> Group -> find('first' , 
			array(
				'conditions' => array('Group.id' => $str)
			)
		);
		$this -> set('data_group' , $data_group);
		
			//�X�^�b�t
			$data_staff = $this -> Staff -> find('all' , 
				array(
					'conditions' => array('Staff.group_id' => $data_group['Group']['id'])
				)
			);
			$this -> set('data_staff' , $data_staff);
			
			//����
			$data_department = $this -> Department -> find('first' , 
				array(
					'conditions' => array('Department.id' => $data_group['Group']['department_id'])
				)
			);
			$this -> set('data_department' , $data_department);
		
	}
�����܂�
*/

}