<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component'); // コンポーネントを追加

class StaffMypage extends AppModel {

	var $useTable = 'staff_mypage';
	var $primaryKey = "id";

	//
	public function insertMypage($set_staff_id , $name , $mypage_type , $page_id , $url  ){

		$this->loadComponent('Common');		

		$this->create();  //連像insertはこれが必要
		
		$insData = array(
			'name' => $name ,		
			'staff_id' => $set_staff_id ,
			'mypage_type' => $mypage_type ,
			'page_id' => $page_id ,
			'url' => "$url" ,
			'created' => date('Y-m-d H:i:s'),
			'modified' => date('Y-m-d H:i:s') ,
		);

		//$this->Common->v($insData);

		$this->save($insData);

	}


}