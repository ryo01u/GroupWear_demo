<?php

class Projectgroup extends AppModel {

	var $useTable = 'projectgroup';
	var $primaryKey = "id";


	//�O���[�v�폜
	public function delProjectgroup($id){

		$updData = array(
			'delete_flag' => 1 ,
		);

		$conditions = array(
			'id' => $id,
		);

		$this->updateAll($updData, $conditions);

	}


	public function getGroupList(){

	    $opts = array(
			'conditions' => array(
	        'delete_flag ' => 0
	      )

	    );

	    $data = $this->find('all',$opts);
	    return $data;
	}


}