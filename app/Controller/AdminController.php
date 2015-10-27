<?php

class AdminController extends AppController {
	public $helpers = array('Html', 'Form');

	public $layout = ""; 


	//���f���Ăяo��
	public $uses = array('Group');


	public function index() {
		$system_admin_flag =$this->getAdminFlag($this->myStaffGroup);
		$this->set('system_admin_flag', $system_admin_flag);	
		$this->render('index');

	}

	public function getAdminFlag($myStaffGroup){
	
		foreach ($myStaffGroup as $rec) {
			if($rec["d"]["system_admin_kbn"]){
				break ;
			}
		}
		return True;
	}


}