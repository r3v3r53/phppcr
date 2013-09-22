<?php
class Evaluations{
	private $con;
	private $evaluations;
	
	function __construct($con, $array){
		$this->con			= $con;
		$this->evaluations	= array();
		$this->setEvaluations($array);	
	}
	
	private function setEvaluations($array){
		foreach($array as $item){
			$discipline = new Discipline($item['discipline_id']);
			$evaluation = new $$item['type']($item['id']);
			
		}
	}
}
?>
