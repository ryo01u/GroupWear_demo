<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component'); // �R���|�[�l���g��ǉ�
/**
 * User Model
 *
 */

class ProjectStaff extends AppModel {

	var $useTable = 'r_project_staff';
	var $primaryKey = "id";




	public function clearStaff($project_id ){

		$this->loadComponent('Common');		
		$condition = array('project_id' => $project_id);
	
		//$this->Common->v($condition);
		$this->deleteAll($condition);
		
	}


	//�O���[�v�폜
	public function getProjectStaffInfo( $project_id_list ){

		$this->loadComponent('Common');
	 	$in_text = null;
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
					st.project_id as project_id , st.staff_id as staff_id , s.name as staff_name  
				FROM
				    project as p ,  staff as s , r_project_staff st
				where
					st.project_id = p.id
					and st.staff_id = s.id
					and st.project_id in ($in_text)
   		   		";

		//$this->Common->v($sql );
        $data = $this->query($sql);		
			
		return $data; 
			
	}	

	//プロジェクトリレーション登録
	public function setStaff($request_data , $insertProjectId ){

		$this->loadComponent('Common');
		
		//�ǉ�
		if(! $request_data["Project"]["id"]){

			if ($insertProjectId){
			//$this->Common->v($request_data);
				foreach($request_data["ProjectStaff"]["staff_id"] as $row ){
					 
					$data['ProjectStaff']['id'] = null;			
  					$data['ProjectStaff']['project_id'] = $insertProjectId;
					$data['ProjectStaff']['staff_id'] = $row ;
					
    				$this->save($data);
				}
			
			}

		} else {
			if($request_data["ProjectStaff"]["staff_id"]){
				//一旦けす
				$this->clearStaff($request_data["Project"]["id"]);
				
				$request_data["ProjectStaff"]["staff_id"] = array_unique($request_data["ProjectStaff"]["staff_id"]);
								
				foreach($request_data["ProjectStaff"]["staff_id"] as $row ){
				 
					$data['ProjectStaff']['id'] = null;			
  					$data['ProjectStaff']['project_id'] = $insertProjectId;
					$data['ProjectStaff']['staff_id'] = $row ;
    				$this->save($data);
				}
					
			}


		}

	}


}