<?php

class News extends AppModel {

	var $useTable = 'news';
	var $primaryKey = "id";

//        public $validate = array(
//            'name' => array(
//                'notEmpty' => array(
//                    'rule' => array('notEmpty'),
//                    'message' => '部署名を入力してください',
//                ),
//                'isUnique' => array(
//                    'rule' => array('isUnique'),
//                   'message' => 'その部署名は既に登録されています',
//                ),
                
//            ),

//      );



	//削除
	public function delNews($id){

		$updData = array(
			'delete_flag' => 1 ,
		);

		$conditions = array(
			'id' => $id,
		);

		$this->updateAll($updData, $conditions);

	}

	public function getNewsInfo($id){

		$opts = array(
			'conditions' => array(
					'id' => $id
			)
		);

		$data = $this->find('all',$opts);

		return $data[0];
	}


	public function getNewsList(){

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