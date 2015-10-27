<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component'); // �R���|�[�l���g��ǉ�
/**
 * User Model
 *
 */

class ClientStaff extends AppModel {

	var $useTable = 'r_client_staff';
	var $primaryKey = "id";




	public function clearStaff($client_id ){

		$this->loadComponent('Common');		
		$condition = array('client_id' => $client_id);
	
		//$this->Common->v($condition);
		$this->deleteAll($condition);
		
	}




//ここから

	public function getClientStaffList($client_id = null){

		$this->loadComponent('Common');
		
		if($client_id){
			$where = " and cs.client_id = ". $client_id; 
		} else {
			$where = "";
		}

   		$sql = "
				SELECT
					cs.client_id as client_id , cs.staff_id as staff_id , s.name as staff_name  
				FROM
				    client as c ,  staff as s , r_client_staff cs
				where
					cs.client_id = c.id
					and cs.staff_id = s.id
   		";

	        $data = $this->query($sql);		
			
		return $data; 
			
	}

//ここまで





	//�O���[�v�폜
	public function getClientStaffInfo( $client_id_list ){

		$this->loadComponent('Common');
	 	$in_text = null;
		foreach ($client_id_list as $key => $value) {
		 	
			 if ($key == 0){
			 	$in_text .= $value; 
			 }else {
			 	$in_text .= "," . $value; 
			 }
		}
   		$sql = "
				SELECT
					cs.client_id as client_id , cs.staff_id as staff_id , s.name as staff_name  
				FROM
				    client as c ,  staff as s , r_client_staff cs
				where
					cs.client_id = c.id
					and cs.staff_id = s.id
					and cs.client_id in ($in_text)
   		   		";

		//$this->Common->v($sql );
        $data = $this->query($sql);		
			
		return $data; 
			
	}	

	//プロジェクトリレーション登録
	public function setClient($request_data , $insertClientId ){

		$this->loadComponent('Common');
		
		//�ǉ�
		if(! $request_data["Client"]["id"]){

			if ($insertClientId){
			
				foreach($request_data["ClientStaff"]["staff_id"] as $row ){
					 
					$data['ClientStaff']['id'] = null;			
  					$data['ClientStaff']['client_id'] = $insertClientId;
					$data['ClientStaff']['staff_id'] = $row ;
					
    				$this->save($data);
				}
			
			}

		} else {
			
			
			
			if($request_data["ClientStaff"]["staff_id"]){
				//一旦けす
				$this->clearStaff($request_data["Client"]["id"]);
			
	
				$request_data["ClientStaff"]["staff_id"] = array_unique($request_data["ClientStaff"]["staff_id"]);
			
			//$this->Common->v($request_data["ClientStaff"]["staff_id"]);
								
				foreach($request_data["ClientStaff"]["staff_id"] as $row ){
				 
					$data['ClientStaff']['id'] = null;			
  					$data['ClientStaff']['client_id'] = $insertClientId;
					$data['ClientStaff']['staff_id'] = $row ;
    				$this->save($data);
				}
					
			}


		}

	}


}