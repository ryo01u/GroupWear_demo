<?php

class TopController extends AppController {
	public $helpers = array('Html', 'Form');

	public $layout = ""; // ・ｽ・ｽ・ｽC・ｽA・ｽE・ｽg・ｽt・ｽ@・ｽC・ｽ・ｽ・ｽﾍ使・ｽp・ｽ・ｽ・ｽﾈゑｿｽ

	public function index() {


		//$this->link();
		$this->render('index');

	}

	public function link() {

		$this->render('link');

	}


}