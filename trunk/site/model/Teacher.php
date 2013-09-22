<?php
require_once("Course.php");
require_once("Role.php");

class Teacher extends Role{
	
	function __construct($con){
		parent::__construct($con, "teacher");
	}
	
	public function setDisciplines(){
		parent::setDisciplines(parent::$con->getTeacherDisciplines($id));
	}
	
	public function cancelEvaluation($evaluation){
		$evaluation = parent::getEvaluation($evaluation);
		if($evaluation){
			$query = sprintf("
				DELETE FROM avaliacao 
				WHERE num_avaliacao = %d
				", 
				$evaluation->getId()
			);
			parent::execute($query);
		}
	}
}
?>