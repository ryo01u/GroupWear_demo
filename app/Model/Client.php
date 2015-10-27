<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component'); // コンポーネントを追加


class Client extends AppModel {

	var $useTable = 'client';
	var $primaryKey = "id";

        public $validate = array(
            'name' => array(
                'notEmpty' => array(
                    'rule' => array('notEmpty'),
                    'message' => '名前を入力してください',
                ),
                'isUnique' => array(
                    'rule' => array('isUnique'),
                    'message' => '既に登録されています',
                ),
            ),

            'staff_id' => array(
                'notEmpty' => array(
                    'rule' => array('notEmpty'),
                    'message' => '社員IDを入力してください',
                ),
            ),


        );


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
	public function delClient($id){

		$updData = array(
		'delete_flag' => 1 ,
		);

		$conditions = array(
			'id' => $id,
		);

		$this->updateAll($updData, $conditions);

	}


	//社員削除
	public function getClientListById($id){

		$sql = "SELECT
				 c.id ,c.name, cp.staff_id
			FROM
				client c , r_client_staff rp

			WHERE
				c.id = rp.client_id
				and 
				c.id = :id;
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