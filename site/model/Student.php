<?php
require_once("Course.php");
require_once("Role.php");

class Student extends Role{
	
	function __construct($con){
		parent::__construct($con, "student");
	}
	
	public function setDisciplines(){
		parent::setDisciplines(parent::$con->getStudentDisciplines($id));
	}
	
	public function inscribe($user_num, $evaluation){
		$evaluation = parent::getEvaluation($evaluation);
		if($evaluation){
			$query = sprintf("
				INSERT INTO avaliacao_aluno 
				SET num_avaliacao = %d,
				num_utilizador = %d,
				num_disciplina = %d,
				num_semestre = 1", 
				$evaluation->getId(), 
				$user_num,
				$evaluation->getDisciplineId()
			);
			parent::execute($query);
		}
	}
	
	public function uninscribe($user_num, $evaluation){
		$evaluation = parent::getEvaluation($evaluation);
		if($evaluation){
			$query = sprintf("
				DELETE FROM avaliacao_aluno 
				WHERE num_avaliacao = %d
				AND num_utilizador = %d", 
				$evaluation->getId(), $user_num
			);
			parent::execute($query);
		}
	}
}
?>