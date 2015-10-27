<?php

class RegistnewsController extends AppController {

	public $helpers = array('Html', 'Form', 'Session', 'Js' => array('Jquery'));

	public $components = array('Common','Session','RequestHandler');

	public $uses = array('News');

	public $layout = "";

	public $paginate = array(
		'News'=>array(
		'field' => array('id' , 'name' , 'delete_flag') ,
		'limit' => 5 ,
		'order' => array('id' => 'desc'),
		'conditions' => array('delete_flag' => '0')
		)
	);

	//授業部のグループ表示を切り替える
	//public function ajax_group() {
	
	//	$aaa= $this->Group->find('list',array( 'conditions' => array('department_id' => 1),'fields' => array('group_id', 'name')));
	
	//	$this->log($aaa, LOG_FOR_YOU);
	//	$this->set('group_select',$this->Group->find('list',array( 'conditions' => array('department_id' => $this->params["url"]["data"]["Staff"]["department_id"]),'fields' => array('group_id', 'name'))));

	//}

	function index(){
		$this->redirect("./lists");
	}

	function lists(){

		$news = $this->paginate('News');
		
		$this->set('news', $news);

		$this->render('lists');

	}

	function del($id=0){

		$NewsRec = $this->News->find('first', array(
			'conditions' => array('id'=> $id , 'delete_flag' => 0)
		)) ;

		if($NewsRec){
			//スタッフ削除
			$this->News->delNews($id);
		}

		$this->redirect("./lists");
	}


	public function finish() {
		
		$this->render('finish');
		
	}

/*
	public function edit($id=null){
		
		$this->News->id = $id;
		$this->request->data = $this->News->read(null,$id);
 		
 		if($this->request->is('post') || $this->request->is('put')){
		$this->News->save($this->request->data);
		$this->redirect('index');
		}else{
		$this->request->data=$this->News->read(null,$id);
		}
		}

	}
*/
	public function action($id=0) {


		//$this->set( 'busyo_type', Configure::read("busyo_type") );	
		$this->set( 'news_type', Configure::read("news_type") );
		$this->set(compact("id"));
		$this->set('set_staff_id', $this->Auth->user('id'));


		//フォーム入力があった場合には保存処理。そうでない場合は初期値の準備
		if($this->request->isPost() || $this->request->isPut()) {
			//$this->Common->v("bbb");



			if ($id){
					$this->request->data["News"]["id"] =  $id;
			}
			
			
			$this->News->set($this->request->data);
			
					 //$this->Common->v( $this->Staff->validates());
		
			//if (! $this->News->validates()){
					 // $this->Common->v( $this->Department->validationErrors);	
			//		$this->set( 'errors', $this->News->validationErrors );			
			//}

			//var_dump($this->request->data);

			if ($this->News->save($this->request->data)){
				$this->redirect("finish");	
			}			

			
		} else {

				$newsRec = $this->News->find('first', array(
					'conditions' => array('id'=> $id )
				)) ;
		
				$this->data = $newsRec;

				$this->set(compact("id"));

				$this->render('action');

		}	


	}



}