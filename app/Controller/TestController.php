<?php

class TestController extends AppController {
	public $helpers = array('Html', 'Form');
	public $components = array('RequestHandler');


	public $layout = ""; // レイアウトファイルは使用しない

	//モデル呼び出し
	public $uses = array('Department');


	public function index() {


		//$this->Common->v("sdfas");





	}



	public function index2() {

		//$this->Common->v("sdfas");
		//$result = ['status' => 'complete', 'msg' => 'Request completed.'];
		$result = $this->Department->getDepartmentInfo("1");

		$this->set(compact('result'));

	}



}