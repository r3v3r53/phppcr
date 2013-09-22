<?php
require_once("Course.php");
require_once("Role.php");

class Coordinator extends Role{
	
	function __construct($con){
		parent::__construct($con, "coordinator");
	}
	
	public function setDisciplines(){
		parent::setDisciplines(parent::$con->getCoordinatorDisciplines($id));
	}
	
	public function validate($id){
		$evaluation = parent::getEvaluation($id);
		if($evaluation){
			$evaluation->validate(parent::getCon());
		}
	}
	
	public function unvalidate($id){
		$evaluation = parent::getEvaluation($id);
		if($evaluation){
			$evaluation->unvalidate(parent::getCon());
		}
	}
}
?>