<?php

class Contact extends AppModel {

	var $useTable = 'contact';
	var $primaryKey = "id";


	public function getContactInfo($id){

		$opts = array(
			'conditions' => array(
					'id' => $id
			)
		);

		$data = $this->find('all',$opts);

		return $data[0];
	}

	//�O���[�v�폜
	public function delContact($id){
$this->Common->v("bbb");
		$updData = array(
			'delete_flag' => 1 ,
		);

		$conditions = array(
			'id' => $id,
		);

		$this->updateAll($updData, $conditions);

	}


	public function getContactList(){

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

	public function getClientContactInfo( $contact_id_list ){

		$this->loadComponent('Common');
	 	$in_text = null;
		
		if (is_array($contact_id_list)) {
			foreach ($contact_id_list as $key => $value) {
			 	
				 if ($key == 0){
				 	$in_text .= $value; 
				 }else {
				 	$in_text .= "," . $value; 
				 }
			}
		} else {
			$in_text = $contact_id_list;
		}
		
				
   		$sql = "
				SELECT
					c.id as contact_id , c.client_id as client_id , c.name as contact_name, cl.name as client_name  ,c.memo
				FROM
				    `contact` c , client as cl 
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