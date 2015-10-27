<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component'); // �R���|�[�l���g��ǉ�
/**
 * User Model
 *
 */

class ProjectClient extends AppModel {

	var $useTable = 'r_project_client';
	var $primaryKey = "id";


	public function getProjectClientInfo( $project_id_list , $kbn){

		$this->loadComponent('Common');

		if (is_array($project_id_list)) {
			foreach ($project_id_list as $key => $value) {
			 	
				 if ($key == 0){
				 	$in_text .= $value; 
				 }else {
				 	$in_text .= "," . $value; 
				 }
			}
		}else {
				$in_text = $project_id_list;
		}

   		$sql = "
				SELECT
					 pc.id as client_id  , c.name as client_name   
				FROM
				    project as p ,  r_project_client pc , client c
				where
					pc.project_id = p.id
					and pc.client_id = c.id
					and pc.project_id in ($in_text)
					and pc.kbn = $kbn
				
   		   		";
//$this->Common->v($sql);
        $data = $this->query($sql);		
			
		return $data; 


	}


	//�O���[�v�폜
	public function getProjectClientStaffInfo( $client_id_list ){

		$this->loadComponent('Common');
	 	$in_text = null;
		//$this->Common->v($project_id_list );
		
		if (is_array($client_id_list)) {
			foreach ($client_id_list as $key => $value) {
			 	
				 if ($key == 0){
				 	$in_text .= $value; 
				 }else {
				 	$in_text .= "," . $value; 
				 }
			}
		}else {
				$in_text = $client_id_list;
		}
			
   		$sql = "
				SELECT
					 s.id as staff_id  , s.name as staff_name   
				FROM
				    project as p ,  r_project_client pc , r_project_staff as ps  ,staff s
				where
					pc.project_id = p.id
				    and ps.project_id = p.id
					and pc.project_id = ps.project_id
					and s.id = ps.staff_id
					and pc.client_id in ($in_text)
				
   		   		";
//$this->Common->v($sql);
        $data = $this->query($sql);		
			
		return $data; 
			
	}	


	//プロジェクトリレーション登録（仕入れ先）
	public function setClient($request_data , $insertProjectId){

		$this->loadComponent('Common');
		
		//�ǉ�
		if(! $request_data["Project"]["id"]){

			if ($insertProjectId){
			//$this->Common->v($request_data);
				foreach($request_data["ProjectClient"]["client_id"] as $row ){
					 
					$data['ProjectClient']['id'] = null;
					$data['ProjectClient']['kbn'] = 2;
  					$data['ProjectClient']['project_id'] = $insertProjectId;
					$data['ProjectClient']['client_id'] = $row ;
					
    				$this->save($data);
				}
			
			}

		} else {
			if($request_data["ProjectClient"]["client_id"]){
				//一旦けす
				$this->clearClient($request_data["Project"]["id"], 2);
				
				$request_data["ProjectClient"]["client_id"] = array_unique($request_data["ProjectClient"]["client_id"]);
								
				foreach($request_data["ProjectClient"]["client_id"] as $row ){
				 
					$data['ProjectClient']['id'] = null;
  					$data['ProjectClient']['kbn'] = 2;
  					$data['ProjectClient']['project_id'] = $insertProjectId;
					$data['ProjectClient']['client_id'] = $row ;
    				$this->save($data);
				}
					
			}


		}

	}



	//プロジェクトリレーション登録(得意先）
	public function setClientRegular($request_data , $insertProjectId ){

		$this->loadComponent('Common');
		
		//�ǉ�
		if(! $request_data["Project"]["id"]){

			if ($insertProjectId){
			

				$data['ProjectClient']['id'] = null;
				$data['ProjectClient']['kbn'] = 1;
				$data['ProjectClient']['project_id'] = $insertProjectId;
				$data['ProjectClient']['client_id'] = $request_data["ProjectClient"]["regular_client_id"] ;
    				$this->save($data);
			
			}

		} else {
			if($request_data["ProjectClient"]["client_id"]){
				//一旦けす
				$this->clearClient($request_data["Project"]["id"], 1);
				
				$request_data["ProjectClient"]["client_id"] = array_unique($request_data["ProjectClient"]["client_id"]);

				$data['ProjectClient']['id'] = null;
				$data['ProjectClient']['kbn'] = 1;
				$data['ProjectClient']['project_id'] = $insertProjectId;
				$data['ProjectClient']['client_id'] = $request_data["ProjectClient"]["regular_client_id"] ;

    				$this->save($data);

					
			}


		}

	}





	public function clearClient($project_id , $kbn ){

		$this->loadComponent('Common');		
		$condition = array('project_id' => $project_id , 'kbn' => $kbn);
	
		//$this->Common->v($condition);
		$this->deleteAll($condition);
		
	}




}