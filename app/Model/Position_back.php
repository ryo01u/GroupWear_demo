<?php

class Position extends AppModel {

	var $useTable = 'position';
	var $primaryKey = "id";


	public function getPositionInfo($id){

		$opts = array(
			'conditions' => array(
					'id' => $id
			)
		);

		$data = $this->find('all',$opts);

		return $data[0];
	}


	public function getPositionList(){

	    $opts = array(
	'conditions' => array(

	        'delete_flag ' => 0
	      )

	     // 'order' => array('info.created ASC'),
	     // 'limit' => $num
	    );

	    $data = $this->find('all',$opts);
	    return $data;
	  }


}