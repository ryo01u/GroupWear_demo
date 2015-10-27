<?php

class PostsController extends AppController {
	public $helpers = array('Html', 'Form');
//	public $layout = 'seta';
//	public $layout = "";

    public function index() {
        $this->set('posts', $this->Post->find('all'));
    }
}