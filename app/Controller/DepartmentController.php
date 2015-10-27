<?php

class DepartmentController extends AppController {
	public $helpers = array('Html', 'Form', 'Util');

	public $layout = ""; // ���C�A�E�g�t�@�C���͎g�p���Ȃ�
	
	public $uses = array('Staff' , 'Group' , 'Department' , 'Position' , 'StaffGroup');


	//���f���Ăяo��
/*
	public $uses = array('Department');

	public function detail($id=null) {

		$department = $this->Department->getDepartmentInfo($id);
		//var_dump($department);

		$this->set('info', $department);

		$this->render('detail');
	}
*/

	public function index() {

		$this->redirect("./detail/" . urlencode($str));

	}
	
	public function detail($param) {
		
		$str = urldecode($param);
		


		//����
		$data_department = $this -> Department -> find('first' , 
			array(
				'conditions' => array('Department.id' => $str)
			)
		);
		$this -> set('data_department' , $data_department);
		
			//�O���[�v
			$data_group = $this -> Group -> find('all' , 
				array(
					'conditions' => array('Group.department_id' => $data_department['Department']['id'])
				)
			);
			$this -> set('data_group' , $data_group);

/*
			//�X�^�b�t
			$data_staff = $this -> Staff -> find('first' , 
				array(
					'conditions' => array('Staff.department_id' => $data_department['Department']['id'])
				)
			);
			$this -> set('data_staff' , $data_staff);
*/
	}


}

