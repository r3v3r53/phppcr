<?php
abstract class Role{
	private $con;
	private $title;
	private $courses;
	
	function __construct($con, $title){
		$this->con = $con;
		$this->title = $title;
		$this->courses = array();
	}
	
	public function clear(){
		$this->courses = array();
	}
	
	public function addCourse($course){
		$this->courses[$course[0]] = new Course($course);
	}
	
	public function getCon(){
		return $this->con;
	}
	
	public function getEvaluation($id){
		$evaluation = NULL;
		foreach($this->courses as $course){
			$evaluation = $course->getEvaluation($id);
			if($evaluation != NULL){
				return $evaluation;
			}
		}
		return $evaluation;
	}
	
	public function execute($query){
		$this->con->execute($query);
	}
	
	public function getCourse($id)	{ return $this->courses[$id];	}
	public function getCourses()	{ return $this->courses;		}
	
	public function getEvaluationsByDate($date){
		$result = array();
		foreach($this->courses as $course){
			$evaluations = $course->getEvaluationsByDate($date);
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
								"course"		=> $e['course'],
								"discipline"	=> $e['discipline'],
								"evaluation"	=> $e['evaluation']
							)
							
						);
					}
				}
			}
		}
		return $result;
	}
	
	public function getEvaluationsByDates($start, $end){
		$result = array();
		foreach($this->courses as $course){
			$evaluations = $course->getEvaluationsByDates($start, $end);
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
								"course"		=> $e['course'],
								"discipline"	=> $e['discipline'],
								"evaluation"	=> $e['evaluation']
							)
							
						);
					}
				}
			}
		}
		return $result;
	}

}
?>