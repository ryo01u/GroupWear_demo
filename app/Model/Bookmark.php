<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component'); // コンポーネントを追加


class Bookmark extends AppModel {

	var $useTable = 'bookmark';
	var $primaryKey = "id";

        public $validate = array(
            'name' => array(
                'notEmpty' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'サイト名を入力してください',
                ),
            ),
            'account' => array(
                'notEmpty' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'URLを入力してください',
                ),
                'isUnique' => array(
                    'rule' => array('isUnique'),
                    'message' => '既に登録されています',
                ),
                
            ),

        );


	/**
	 * 保存時にパスワードをハッシュ化する
	 */
	    public function beforeSave($options = array()) {

	        if (isset($this->data[$this->alias]['password'])) {

	            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
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


	public function getStaffInfo($id){

		$opts = array(
			'conditions' => array(
					'id' => $id
			)
		);

		$data = $this->find('all',$opts);

		return $data[0];
	}


	public function getStaffList(){

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


}