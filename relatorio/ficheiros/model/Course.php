<?php
require_once("model/Discipline.php");
class Course{
	private $id;
	private $name;
	private $description;
	private $year;
	private $disciplines;
	
	function __construct($course){
		$this->id			= $course[0];
		$this->name 		= $course[1];
		#$this->description	= $course['description'];
		$this->year			= $course[2];
		$this->disciplines	= array();
	}
	
	public function addDiscipline($discipline){
		$this->disciplines[$discipline[0]] = new Discipline($discipline);
	}
	
	public function getEvaluations($discipline = ""){
		$evaluations = array();
		if($discipline != ""){
			$evaluations = $this->disciplines[$discipline]->getEvaluations();
		} else {
			$evaluations = array();
			foreach($this->disciplines as $discipline){
				$d = $discipline->getId();
				if(!array_key_exists($d, $evaluations)){
					$evaluations[$d] = array(
						"discipline" => $discipline->getTitle(), 
						"evaluations" => array()
					);
				}
				array_push($evaluations[$d]["evaluations"], $discipline->getEvaluations());
			}
		}
		return $evaluations;
	}
	
	public function getEvaluationsByDate($date) {
		$result = array();
		foreach($this->disciplines as $d){
			$evaluations = $d->getEvaluationsByDate($date);
			foreach($evaluations as $ym => $days){
				if(!array_key_exists($ym, $result)){
					$result[$ym] = array();
				}
				foreach($days as $day => $evs){
					if(!array_key_exists($day, $result[$ym])){
						$result[$ym][$day] = array();
					}
					foreach($evs as $e){
						array_push(
							$result[$ym][$day], 
							array(
								"course"		=> $this->getName(),
								"discipline"	=> $d->getTitle(),
								"evaluation"	=> $e
							)
						);
					}
				}
			}
		}
		return $result;
	}
	
	public function getEvaluationsByDates($start, $end) {
		$result = array();
		foreach($this->disciplines as $d){
			
			$evaluations = $d->getEvaluationsByDates($start, $end);
			foreach($evaluations as $ym => $days){
				if(!array_key_exists($ym, $result)){
					$result[$ym] = array();
				}
				foreach($days as $day => $evs){
					if(!array_key_exists($day, $result[$ym])){
						$result[$ym][$day] = array();
					}
					foreach($evs as $e){
						array_push(
							$result[$ym][$day], 
							array(
								"course"		=> $this->getName(),
								"discipline"	=> $d->getTitle(),
								"evaluation"	=> $e
							)
						);
					}
				}
			}
		}
		return $result;
	}
	
	public function getEvaluation($id){
		$evaluation = NULL;
		foreach($this->disciplines as $discipline){
			$evaluation = $discipline->getEvaluation($id);
			if($evaluation != NULL){
				return $evaluation;
			}
		}
		return $evaluation;
	}
	
	public function getId()						{ return $this->id;					}
	public function getName()					{ return $this->name;				}
	public function getDescription()			{ return $this->description;		}
	public function getYear()					{ return $this->year;				}
	public function getDiscipline($id)			{ return $this->disciplines[$id];	}
	public function getDisciplines()			{ return $this->disciplines;		}
}
?>