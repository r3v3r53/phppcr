<?php
define('SMARTY_DIR', 'smarty/libs/');
require_once(SMARTY_DIR . 'Smarty.class.php');

class View{
	private $smarty;
	private $logged;
	private $username;
	private $type;
	private $details;
	private $is_teacher;
	private $menu;
	
	function __construct(){		
		$this->smarty = new Smarty();
		$this->smarty->assign('template_dir', 'templates/');
		$this->smarty->assign('compile_dir', 'templates_c/');
		$this->smarty->assign('configs_dir', 'configs/');
		$this->smarty->assign('cache_dir', 'cache/');
		$this->type = "mensal.tpl";
		$this->menu = "";
		$this->form = "";
	}
	
	public function showAll(){
		$this->smarty->assign("form", $this->form);
		$this->smarty->display("index.tpl");
	}
	
	public function showCalendar(){
		$this->smarty->display($this->tipe);
	}
	
	public function showLogin(){
		$this->smarty->display("identificacao.tpl");
	}
	
	public function setLogged($value){
		 $this->logged = $value;
		 if($value == TRUE){
		 	$this->smarty->assign("login_action", "?User&logout");
			$this->smarty->assign("titulo_botao_login", "logout");
		 } else {
		 	$this->smarty->assign("login_action", "#");
			$this->smarty->assign("titulo_botao_login", "login");
		 }
	}
	
	public function setTeacher($value){
		$this->is_teacher = $value;
	}
	
	public function setDetails($details){
		$this->details = "";
		foreach($details as $e){
			$this->details = sprintf(
				'%s 
					{assign "date" "%s"}
					{assign "discipline" "%s"}
					{assign "type" "%s"}
					{assign "weight" "%s"}
					{assign "classroom" "%s"} 
					{assign "id" "%s"}
					{assign "validated" "%s"}
					{include file="%s_details.tpl"}
					<hr>
				', 
				$this->details,
				$e['date'],
				$e['discipline'],
				$e['type'],
				$e['weight'],
				$e['classroom'],
				$e['id'],
				$e['validated'],
				$e['role']
			);
		}
		$this->smarty->assign("details", $this->details);
	}
	
	public function setMenu(){
		if($this->is_teacher == TRUE){
			$this->menu = sprintf(
				'%s
					{include file="teacher_menu.tpl"}
				', 
				$this->menu
			);
		}
		$this->smarty->assign("menu", $this->menu);
	}
	
	public function setUserName($name){
		$this->username = $name;
		$this->smarty->assign("username", $name);
	}	
	
	public function setDate($date){
		$this->smarty->assign("data", $date);
	}
	
	public function setCalendar($calendar){
		$this->smarty->assign("calendario", $calendar);
	}
	
	public function showNewEvaluation($disciplines){
		$this->smarty->assign("disciplinas", $disciplines);
		$this->form = '{include file="new_evaluation.tpl"}';
	}
	
	public function setType($value){
		$this->tipo = $value.".tpl"; 
		$this->smarty->assign("tipo_calendario", $this->tipo);
	}
}