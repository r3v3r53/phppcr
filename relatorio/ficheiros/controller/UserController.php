<?php
require_once("model/User.php");

require_once("view/View.php");

class UserController{
	
	private $user;
	private $view;
	private $con;
	
	function __construct($con, $view){
		$this->con			= $con;
		$this->view			= $view;
		$this->user			= new User($this->con);
		$this->login();
	}
	
	public function login(){
		if(isset($_POST['form_utilizador'])){
			$username = $_POST['form_utilizador'];
			$password = $_POST['form_password'];
			$this->user->login($username, $password);
		} else {
			$this->user->login();
		}
	}
	
	public function setCourses(){ $this->user->setCourses();}

	public function validate($evaluation){
		if(isset($_GET['validate'])){
			$coordinator = $this->user->getCoordinator();
			$coordinator->validate($evaluation);
		}
	}
	
	public function unvalidate($evaluation){
		if(isset($_GET['unvalidate'])){
			$coordinator = $this->user->getCoordinator();
			$coordinator->unvalidate($evaluation);
		}
	}
	
	public function inscribe($evaluation){
		if(isset($_GET['inscribe'])){
			$student = $this->user->getStudent();
			$id = $this->user->getUserNum();
			$student->inscribe($id, $evaluation);
		}
	}
	
	public function uninscribe($evaluation){
		if(isset($_GET['uninscribe'])){
			$student = $this->user->getStudent();
			$id = $this->user->getUserNum();
			$student->uninscribe($id, $evaluation);
		}
	}
	
	public function cancelEvaluation($evaluation){
		if(isset($_GET['cancelEvaluation'])){
			$teacher = $this->user->getTeacher();
			$teacher->cancelEvaluation($evaluation);
		}
	}
	
	public function newEvaluation(){
		if(isset($_POST['evaluation'])){
			$array[0] = $_POST['disciplina'];
			$array[1] = $_POST['data'];
			$array[2] = $_POST['peso'];
			$array[3] = $_POST['sala'];
			$array[4] = $_POST['tipo'];
			$array[5] = $_POST['observacoes'];
			$this->user->newEvaluation($array);
		} else {
			$disciplines = $this->user->getTeaching();
			$this->view->showNewEvaluation($disciplines);
		}
	}
	
	public function setView(){
		$this->view->setLogged($this->user->getUserNum() != NULL);
		$this->view->setUserName($this->user->getName());
		$this->view->setTeacher(count($this->user->getTeaching()) > 0);
	}
	
	public function logout()		{ $this->user->logout();				}
	
	public function getEvaluationsByDate($date){
		return $this->user->getEvaluationsByDate($date);	
	}
	
	public function getEvaluationsByDates($start, $end){
		return $this->user->getEvaluationsByDates($start, $end);
	}
}
?>