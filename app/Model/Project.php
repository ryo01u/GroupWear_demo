<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component'); // コンポーネントを追加


class Project extends AppModel {

	var $useTable = 'project';
	var $primaryKey = "id";


	/**
	 * 保存時にパスワードをハッシュ化する
	 */
	    public function beforeSave($options = array()) {

	        if (isset($this->data[$this->alias]['password'])) {

//	            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
//	            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['setPass']);

	        }
	        return true;
	    }


	//社員削除
	public function delStaff($id){

		$updData = array(
		'delete_flag' => 1 ,
		);

		$conditions = array(
			'id' => $id,
		);

		$this->updateAll($updData, $conditions);

	}


	//社員削除
	public function getProjectListById($id){

		$sql = "SELECT
				 p.id ,p.name, rp.staff_id
			FROM
				project p , r_project_staff rp

			WHERE
				p.id = rp.project_id
				and 
				p.id = :id;
			";

	        $params = array(
	            'id'=> $id
	        );
		print $sql;
		$data = $this->query($sql,$params);
        return $data;
		//return $data;


	}







}