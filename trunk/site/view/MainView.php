<?php
class MainView extends View{
	
	function __construct(){
		parent::__construct('index.tpl');
	}
	
	/*
	 * visualizar de acordo com o que está configurado
	 */
	public function show(){
		parent::show('index.tpl');
	}
}
?>