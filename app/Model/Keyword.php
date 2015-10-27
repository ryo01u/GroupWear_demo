<?php

class Keyword extends AppModel {

	//var $useTable = 'group';
	var $primaryKey = "id";

	var $useTable = false;

	public function paginate($conditions, $fields, $order, $limit, $page , $recursive = null) {
	
	$offset = $page * $limit - $limit;
	
	if($conditions){
		$sql = $conditions;
		$sql .= " order by " . $order;
		$sql .= " limit " . $limit;
		$sql .= " offset " . $offset;
		
		//$this->Common->v($sql);
		
		return $this->query($sql);		
	}

	}
	
	public function paginateCount($conditions = null, $recursive = 0) {
	
	$sql = $conditions;
	
	$this->recursive = $recursive;
	
	$results = $this->query($sql);
	
	return count($results) ; 
	}

	public function getKeywordSearchSql($keyword ,  $view_flag , $department_ids , $group_ids=null ){

		$this->loadComponent('Common');


		$sql = " select * from   ( (select null as id  , null as name , null as type ,null as modified , null as akasatana)";
		$keyword_condition = "";
		
		$department_condition　="";
		$department_in_condition = "";

		$group_in_condition = "";

		if($group_ids){

			$group_in_text = "";
			if (is_array($group_ids)) {
				foreach ($group_ids as $key => $value) {
				 	
					 if ($key == 0){
					 	$group_in_text .= $value; 
					 }else {
					 	$group_in_text .= "," . $value; 
					 }
				}
			} else {
				$group_in_text = $group_ids;
			}
			$group_in_condition =" and sg.group_id in ($group_in_text)";
			
		}
			
		if(! $group_ids && $department_ids){
			
			$department_in_text = "";
			if (is_array($department_ids)) {
				foreach ($department_ids as $key => $value) {
				 	
					 if ($key == 0){
					 	$department_in_text .= $value; 
					 }else {
					 	$department_in_text .= "," . $value; 
					 }
				}
			} else {
				$department_in_text = $department_ids;
			}
			$department_in_condition =" and d.id in ($department_in_text)";
		}
																		
		if($view_flag["staff"]){

			if($keyword){
				$keyword_condition = "and s.name LIKE '%" . $keyword . "%'";
			} else {
				$keyword_condition = "";
			}

	   		$sql .= " union 
					(SELECT
						s.id as id , s.name as name , 's' as type , s.modified  ,s.akasatana
					FROM
					    staff s ,r_staff_group sg , `group` g , department d
					where
						s.delete_flag = 0
						and s.view_flag = 1
						and s.id = sg.staff_id
						and sg.group_id = g.id
						and sg.staff_id = s.id
					
						and g.department_id = d.id						
					$keyword_condition
					$department_in_condition
					$group_in_condition 						
					group by name , type) 	
					";
		}					
					
		if($view_flag["project"]){

			if($keyword){
				$keyword_condition = "and (p.name LIKE '%" . $keyword . "%'";
				$keyword_condition .= "or s.name LIKE '%" . $keyword . "%' ";
				$keyword_condition .= "or d.name LIKE '%" . $keyword . "%' ";
				$keyword_condition .= "or g.name LIKE '%" . $keyword . "%' ";
				$keyword_condition .= "or c.name LIKE '%" . $keyword . "%' )";
			}else {
				$keyword_condition = "";
			}


	   		$sql .= " union 
					(SELECT
						p.id as id ,p.name as name , 'p' as type, s.modified as modified  ,s.akasatana
					FROM
					     project as p ,  staff as s , r_project_staff ps 
					     ,r_staff_group sg , `group` g , department d
					     ,r_project_client pc ,  client c
					where
						p.delete_flag = 0
						and p.view_flag = 1
						and ps.project_id = p.id
						and ps.staff_id = s.id
						and sg.group_id = g.id
						and sg.staff_id = s.id
						and pc.project_id = p.id
						and pc.client_id = c.id
						and g.department_id = d.id														
						$keyword_condition
						$department_in_condition 						
						$group_in_condition
					group by name , type) 	
   		   		
	   				";
		}								

		if($view_flag["client"]){


			if($keyword){
				$keyword_condition = "and (c.name LIKE '%" . $keyword . "%'";
				$keyword_condition .= "or s.name LIKE '%" . $keyword . "%' )";				
			}else {
				$group_condition = "";
			}

			$sql .= "union 
					(SELECT
						c.id as id ,c.name as name , 'c' as type, c.modified  ,c.akasatana
					FROM
					     client c ,  staff as s , r_project_client pc, r_project_staff ps
					    ,r_staff_group sg , `group` g , department d 
					where
						c.delete_flag = 0
						and c.view_flag = 1
						and pc.client_id = c.id	
						and ps.project_id = pc.project_id
						and s.id = ps.staff_id
						and ps.staff_id = s.id
						and sg.staff_id = s.id
						and sg.group_id = g.id
						and d.id = g.department_id
														
						$keyword_condition
						$department_in_condition
						$group_in_condition 												
					group by name , type) 		
					";
		}	

		$sql .= " ) Some where id is not null ";
		
		//$this->Common->v($sql );
		$data = $this->query($sql);		
		//return $data; 
		return $sql; 	
	}




}