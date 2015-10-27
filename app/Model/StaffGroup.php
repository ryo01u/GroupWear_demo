<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component'); // �R���|�[�l���g��ǉ�
/**
 * User Model
 *
 */

class StaffGroup extends AppModel {

	var $useTable = 'r_staff_group';
	var $primaryKey = "id";


	
	
	public function clearGroup($staff_id ){

		$this->loadComponent('Common');		
		$condition = array('staff_id' => $staff_id);
	
		//$this->Common->v($condition);
		$this->deleteAll($condition);
		
	}



	public function getStaffGroupList($staff_id = null){

		$this->loadComponent('Common');
		
		if($staff_id){
			$where = " and sg.staff_id = ". $staff_id; 
		} else {
			$where = "";
		}

   		$sql = "
			SELECT
				sg.staff_id as staff_id , sg.group_id as group_id,
				s.name as staff_name , d.name as department_name, d.system_admin_kbn
				,g.name as group_name
			FROM
			    `group` g , staff as s , r_staff_group sg , department d 
			where
				sg.staff_id = s.id
				and 
				sg.group_id = g.id
				and 
				g.department_id = d.id
				and s.delete_flag = 0
				$where							
   		";

	        $data = $this->query($sql);		
			
		return $data; 
			
	}	



	//�O���[�v�폜
	public function getStaffGroupInfo( $staff_id_list ){

		$this->loadComponent('Common');
	 	$in_text = null;
		
		if (is_array($staff_id_list)) {
			foreach ($staff_id_list as $key => $value) {
			 	
				 if ($key == 0){
				 	$in_text .= $value; 
				 }else {
				 	$in_text .= "," . $value; 
				 }
			}
		} else {
			$in_text = $staff_id_list;
		}
		
				
   		$sql = "
				SELECT
					sg.staff_id as staff_id , sg.group_id as group_id, g.department_id as department_id , g.name as group_name, d.name as department_name  
				FROM
				    `group` g , department as d , r_staff_group sg
				where
					sg.group_id = g.id
					and d.id = g.department_id
					and sg.staff_id in ($in_text)
   		   		";

		//$this->Common->v($sql );
        $data = $this->query($sql);		
		//var_dump($data);	
		return $data; 
			
	}	


	//�O���[�v�폜
	public function setGroup($request_data , $insertStaffId ){

		$this->loadComponent('Common');
		
		//�ǉ�
		if(! $request_data["Staff"]["id"]){

			if ($insertStaffId){
			//
				foreach($request_data["StaffGroup"]["group_id"] as $row ){
					 
					$data['StaffGroup']['id'] = null;			
  					$data['StaffGroup']['staff_id'] = $insertStaffId;
					$data['StaffGroup']['group_id'] = $row ;
					
    				$this->save($data);
				}
			
			}

		} else {


			if(isset($request_data["StaffGroup"]["group_id"])){
				//一旦けす
				$this->clearGroup($request_data["Staff"]["id"]);

				foreach($request_data["StaffGroup"]["group_id"] as $row ){
				 
					$data['StaffGroup']['id'] = null;			
  					$data['StaffGroup']['staff_id'] = $insertStaffId;
					$data['StaffGroup']['group_id'] = $row ;
    				$this->save($data);
				}
					
			}


		}

	}

//ここから

	public function getStaffGroupByList($group_id = null){

		$this->loadComponent('Common');
		
		if($group_id){
			$where = " and sg.group_id = ". $group_id; 
		} else {
			$where = "";
		}

   		$sql = "
			SELECT
				sg.group_id as group_id , sg.staff_id as staff_id,
				g.name as group_name , d.name as department_name,
				s.name as staff_name , s.extension_number as extension_number , s.memo as memo 
			FROM
			    `group` g , staff as s , r_staff_group as sg , department as d 
			where
				sg.group_id = g.id
				and 
				sg.staff_id = s.id
				and 
				g.department_id = d.id
				and s.delete_flag = 0
				$where							
   		";

	        $data = $this->query($sql);		
			
		return $data; 
			
	}	

//ここまで



}