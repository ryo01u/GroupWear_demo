<?php

class Group extends AppModel {

	var $useTable = 'group';
	var $primaryKey = "id";
	
	
	/****
	** $hasMany $belongsTo 追記
	**/
	
//	public $belongsTo = 'StaffGroup';

/*
    public $hasMany = array(
        'Group' => array(
            'className'     => 'StaffGroup',
            'foreignKey'    => 'group_id'
//            'conditions'    => array()
//            'order'         => 'Comment.created DESC',
//            'limit'         => '5',
//            'dependent'     => true
        )
    );
*/

	
/*
public $belongsTo = array(
        'StaffGroup' => array(
            'className'     => 'StaffGroup',
            'foreignKey'    => 'group_id'
//            'conditions'    => array()
//            'order'         => 'Comment.created DESC',
//            'limit'         => '5',
//            'dependent'     => true
        )
    );
*/

	public function getGroupInfo($id){

		$opts = array(
			'conditions' => array(
					'id' => $id
			)
		);

		$data = $this->find('all',$opts);

		return $data[0];
	}

	//�O���[�v�폜
	public function delGroup($id){

		$updData = array(
			'delete_flag' => 1 ,
		);

		$conditions = array(
			'id' => $id,
		);

		$this->updateAll($updData, $conditions);

	}


	public function getGroupList(){

	    $opts = array(
	'conditions' => array(
	        'delete_flag ' => 0,
	        'view_flag ' => 1
	      )

	     // 'order' => array('info.created ASC'),
	     // 'limit' => $num
	    );

	    $data = $this->find('all',$opts);
	    return $data;
	  }

	public function getDepartmentGroupInfo( $group_id_list ){

		$this->loadComponent('Common');
	 	$in_text = null;
		
		if (is_array($group_id_list)) {
			foreach ($group_id_list as $key => $value) {
			 	
				 if ($key == 0){
				 	$in_text .= $value; 
				 }else {
				 	$in_text .= "," . $value; 
				 }
			}
		} else {
			$in_text = $group_id_list;
		}
		
				
   		$sql = "
				SELECT
					g.id as group_id , g.department_id as department_id , g.name as group_name, d.name as department_name  ,g.memo
				FROM
				    `group` g , department as d 
				where
					d.id = g.department_id
					and g.id in ($in_text)
   		   		";

		//$this->Common->v($sql );
		$data = $this->query($sql);		
		//var_dump($data);	
		return $data; 
			
	}




}