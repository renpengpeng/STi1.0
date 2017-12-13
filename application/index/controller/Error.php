<?php
namespace app\index\Controller;

use think\Controller;

class Error extends Controller {
	public function index(){
		$this->error();
	}
	public function _empty(){
		$this->error();
	}
}

