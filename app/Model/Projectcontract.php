<?php

class Projectcontract extends AppModel {

	var $useTable = 'projectcontract';
	var $primaryKey = "id";


	public function getProjectcontractInfo($id){

		$opts = array(
			'conditions' => array(
					'id' => $id
			)
		);

		$data = $this->find('all',$opts);

		return $data[0];
	}

	//�O���[�v�폜
	public function del($id){

		$updData = array(
			'delete_flag' => 1 ,
		);

		$conditions = array(
			'id' => $id,
		);

		$this->updateAll($updData, $conditions);
	}


	public function getProjectcontractList(){

	    $opts = array(
			'conditions' => array(
	        'delete_flag ' => 0
	      )
	    );

	    $data = $this->find('all',$opts);
	    return $data;
	}



}