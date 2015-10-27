<?php

class Projectmemo extends AppModel {

	var $useTable = 'projectmemo';
	var $primaryKey = "id";


	public function getprojectmemoInfo($id){

		$opts = array(
			'conditions' => array(
					'id' => $id
			)
		);

		$data = $this->find('all',$opts);

		return $data[0];
	}

	//�O���[�v�폜
	public function delProjectmemo($id){

		$updData = array(
			'delete_flag' => 1 ,
		);

		$conditions = array(
			'id' => $id,
		);

		$this->updateAll($updData, $conditions);

	}


	public function getProjectmemoList(){

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

	public function getProjectprojectmemoInfo( $projectmemo_id_list ){

		$this->loadComponent('Common');
	 	$in_text = null;
		
		if (is_array($projectmemo_id_list)) {
			foreach ($projectmemo_id_list as $key => $value) {
			 	
				 if ($key == 0){
				 	$in_text .= $value; 
				 }else {
				 	$in_text .= "," . $value; 
				 }
			}
		} else {
			$in_text = $projectmemo_id_list;
		}
		
				
   		$sql = "
				SELECT
					pm.id as projectmemo_id , p.project_id as project_id , pm.name as projectmemo_name, pr.name as project_name  ,p.memo
				FROM
				    `projectmemo` pm , project as pr 
				where
					pr.id = p.project_id
					and p.id in ($in_text)
   		   		";

		//$this->Common->v($sql );
		$data = $this->query($sql);		
		//var_dump($data);	
		return $data; 
			
	}




}