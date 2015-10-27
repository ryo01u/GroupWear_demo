<?php

class Department extends AppModel {

	var $useTable = 'department';
	var $primaryKey = "id";

        public $validate = array(
            'name' => array(
                'notEmpty' => array(
                    'rule' => array('notEmpty'),
                    'message' => '部署名を入力してください',
                ),
                
            ),

        );



	//社員削除
	public function delDepartment($id){

		$updData = array(
			'delete_flag' => 1 ,
		);

		$conditions = array(
			'id' => $id,
		);

		$this->updateAll($updData, $conditions);

	}

	public function getDepartmentInfo($id){

		$opts = array(
			'conditions' => array(
					'id' => $id
			)
		);

		$data = $this->find('all',$opts);

		return $data[0];
	}


	public function getDepartmentList(){

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


}