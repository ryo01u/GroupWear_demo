<?php

//App::uses('SiteController', 'Controller');

class NewsController extends AppController {
	public $helpers = array('Html', 'Form', 'Util');

	public $layout = "";
	
	public $paginate = array(
		'News'=>array(
		'field' => array('id' , 'name' , 'delete_flag') ,
//		'limit' => 5 ,
		'order' => array('id' => 'desc'),
		'conditions' => array('delete_flag' => '0')
		)
	);



	public $uses = array('News');
	
	public function detail($id=null) {

		$news = $this->News->getNewsInfo($id);
		//var_dump($department);

		$this->set('info', $news);

		$this->render('detail');


	}
	
	public function index() {

		$this->redirect("./lists/");

	}
	
	public function lists() {
		
		$datas = $this->paginate('News');

		$this->set('datas',$datas);

		
	}


}