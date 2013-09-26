<?php
define( "HOST",		"localhost"		);
define( "USERNAME",	"moreira_aval"			);
define( "PASSWORD",	"2000Santarem"			);
define( "DATABASE",	"moreira__avaliacoes"	);

require_once("controller/CalendarController.php");
require_once("controller/UserController.php");
require_once("model/BD.php");
require_once("model/Details.php");
require_once("view/View.php");

class MainController {
	private $user;
	private $con;
	private $calendar;
	private $details;
	
	function __construct(){
		session_start();
		
		$this->con			= new BD(HOST, USERNAME, PASSWORD, DATABASE);

		$this->view			= new View();
		$this->user			= new UserController($this->con, $this->view);
		$this->calendar		= new CalendarController($this->con, $this->view);
	
		$this->actions();
		
		$this->user->setCourses();
		
		$start = $this->calendar->getStartingDate();
		$end = $this->calendar->getEndingDate();
		$evaluations = $this->user->getEvaluationsByDates($start, $end);

		$this->calendar->addEvaluations($evaluations);
		
		$actual_day = $this->calendar->getActualDay();
		$evaluations = $this->user->getEvaluationsByDate($actual_day);
		
		$this->details	= new Details($evaluations);
		
		$this->setView();
		#$this->teste();

		
	}
	
	private function actions(){
		if(count($_GET) > 0){
			$i = 0;
			foreach($_GET as $key => $value){
				# primeiro GET, se definido e o construtor a chamar	
				if($i == 0){
					if(class_exists($key."Controller")){
						$controller = $key."Controller"; 
						$object = strtolower($key);
					}
				}
				
				# segundo GET, se definido, e o metodo a chamar
				if($i == 1){
					if(method_exists($controller, $key)){
						$this->$object->$key($value);
					}
				}
				$i++;
			}
		}
	}
	
	private function setView(){
		$this->user->setView();
		$this->calendar->setView();
		$this->view->setDetails($this->details->getDetails());
		$this->view->setMenu();
		$this->view->showAll();
	}	
}
?>