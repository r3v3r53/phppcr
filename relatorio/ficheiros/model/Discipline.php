<?php
require_once("model/Evaluation.php");
class Discipline{
	private $id;
	private $description;
	private $title;
	private $evaluations;
	
	function __construct($discipline){
		$this->id			= $discipline[0];
		$this->description	= $discipline[1];
		$this->title		= $discipline[2];
		$this->evaluations	= array();
	}
	
	public function addEvaluation($evaluation){
		$id = $evaluation[0];
		$this->evaluations[$id] = new Evaluation($evaluation);
	}
	
	public function getEvaluationsByDate($date){
		$result = array();
		foreach($this->evaluations as $e){
			if($e->getDate() == $date){
				$ym = date("Ym", $e->getDate());
				$d = date("d", $e->getDate());
				if(!array_key_exists($ym, $result)){
					$result[$ym] = array();
				}
				if(!array_key_exists($d, $result[$ym])){
					$result[$ym][$d] = array();
				}
				array_push($result[$ym][$d], $e);
			}
		}
		return $result;
	}
	
	public function getEvaluationsByDates($start, $end){
		$result = array();
		foreach($this->evaluations as $e){
			if($e->getDate() >= $start && $e->getDate() <= $end){
				$ym = date("Ym", $e->getDate());
				$d = date("d", $e->getDate());
				if(!array_key_exists($ym, $result)){
					$result[$ym] = array();
				}
				if(!array_key_exists($d, $result[$ym])){
					$result[$ym][$d] = array();
				}
				array_push($result[$ym][$d], $e);
			}
		}
		return $result;
	}
	
	public function getEvaluation($id)	{
		$result = NULL;
		if(array_key_exists($id, $this->evaluations)){
			$result = $this->evaluations[$id];
		}
		return $result;
	}
	
	public function getId()				{ return $this->id;					}
	public function getDescription()	{ return $this->description;		}
	public function getTitle()			{ return $this->title;				}
	public function getEvaluations()	{ return $this->evaluations;		}		
}
?>