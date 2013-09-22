<?php
class CalendarioView{
	private $smarty;
	private $tipo;
	private $vistas;
	private $vistas_selected;
	private $calendario;
	
	function __construct(){
		define('SMARTY_DIR', 'smarty/libs/');
		require_once(SMARTY_DIR . 'Smarty.class.php'); 
		$this->smarty			= new Smarty();
		$this->show_avaliacao	= FALSE;
		$this->show_uc			= FALSE;
        $this->tipo				= "mensal";
        $this->smarty->assign('template_dir', 'templates/');
		$this->smarty->assign('compile_dir', 'templates_c/');
		$this->smarty->assign('configs_dir', 'configs/');
		$this->smarty->assign('cache_dir', 'cache/');
		
	}
	
	/*
	 * visualizar de acordo com o que está configurado
	 */
	public function show(){
		$this->smarty->assign("calendario", "ahah<pre>".print_r($dias)."</pre>");
		$this->smarty->assign("vistas", $this->vistas );
		$this->smarty->assign("vistas_selected", $this->vistas_selected);
	}
	
	public function setCalendario($dias){
		$this->calendario = $dias;
	}
	
	public function setTipo($tipo){ $this->tipo = $tipo; }
}
?>