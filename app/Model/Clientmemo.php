<?php

class Clientmemo extends AppModel {

	var $useTable = 'clientmemo';
	var $primaryKey = "id";


	public function getclientmemoInfo($id){

		$opts = array(
			'conditions' => array(
					'id' => $id
			)
		);

		$data = $this->find('all',$opts);

		return $data[0];
	}

	//�O���[�v�폜
	public function delClientmemo($id){

		$updData = array(
			'delete_flag' => 1 ,
		);

		$conditions = array(
			'id' => $id,
		);

		$this->updateAll($updData, $conditions);

	}


	public function getClientmemoList(){

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

	public function getClientclientmemoInfo( $clientmemo_id_list ){

		$this->loadComponent('Common');
	 	$in_text = null;
		
		if (is_array($clientmemo_id_list)) {
			foreach ($clientmemo_id_list as $key => $value) {
			 	
				 if ($key == 0){
				 	$in_text .= $value; 
				 }else {
				 	$in_text .= "," . $value; 
				 }
			}
		} else {
			$in_text = $clientmemo_id_list;
		}
		
				
   		$sql = "
				SELECT
					cm.id as clientmemo_id , c.client_id as client_id , cm.name as clientmemo_name, cl.name as client_name  ,c.body
				FROM
				    `clientmemo` cm , client as cl 
				where
					cl.id = c.client_id
					and c.id in ($in_text)
   		   		";

		//$this->Common->v($sql );
		$data = $this->query($sql);		
		//var_dump($data);	
		return $data; 
			
	}




}