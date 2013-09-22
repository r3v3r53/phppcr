<?php
require_once("View.php");

class UserView extends View{
	private $username;
	private $file;
	
	
	function __construct($tpl = NULL){
		parent::__construct();
		$this->username = NULL;
		$this->file = 'identificacao.tpl';
	}
	
	public function set($field, $value){
		parent::set($field, $value);
	}
	
	public function setTpl($file){
		$this->file = $file;
	}
	
	public function show(){
		parent::show($this->file);
	}

}
?>