<?php
require_once("Day.php");

define("MONTHS", 6);
define("DEFAULT_TYPE", "monthly");

class Calendar{
	private $type;
	private $starting_date;
	private $days;
	private $ending_date;
	private $actual_day;
	
	function __construct($type = "", $starting_date = ""){
		$this->days = array();
		$this->setType($type);
		$this->setStartingDate($starting_date);
		$this->setEndingDate();
		$this->setDay();
		$this->build();
	}
	
	public function getDays()			{ return $this->days;			}
	public function getStartingDate()	{ return $this->starting_date;	}
	public function getEndingDate()		{ return $this->ending_date;	}
	public function getActualDay()		{ return $this->actual_day;		}	
	public function getType()			{ return $this->type;			}
	
	public function setDay($day = ""){
		if($day == ""){
			if(isset($_SESSION['actual_day'])){
				$this->actual_day = $_SESSION['actual_day'];
			} else {
				$this->actual_day = strtotime(date("Ymd"));
			}
		} else {
			$this->actual_day = strtotime($day);
		}
	}
		
	public function setType($type){
		if($type == ""){
			if(isset($_SESSION['type'])){
				$type = $_SESSION['type'];
			} else {
				$type = DEFAULT_TYPE;
			}
		}
		$this->type = $type;
		$this->setStartingDate();
		$this->setEndingDate();
	}
	
	public function move($i){
		$date = $this->starting_date;
		if($this->type == "monthly"){
			$date = mktime(0,0,0, date("m", $date) + $i, 1, date("Y", $date));	
		} else {
			$date = mktime(0,0,0, date("m", $date), date("d", $date) + $i, date("Y", $date));	
		}
		$this->setStartingDate($date);
		$this->setEndingDate();
		$this->build();
	}
	
	private function setStartingDate($day = ""){
		if($day == ""){
			if(isset($_SESSION['starting_date'])){
				$day = $_SESSION['starting_date'];
			} else {
				$day = strtotime(date("Ymd"));
			}
		}
		if($this->getType() == "monthly"){
			$this->starting_date = mktime(0, 0, 0, date("m", $day), 1, date("Y", $day));
		} else {
			$offset = date("w", $day);
			$this->starting_date = mktime(0, 0, 0, date("m", $day), date("d", $day) - $offset, date("Y", $day));
		}
		$_SESSION['starting_date'] = $this->starting_date;
	}
		
	private function setEndingDate(){
		$start = $this->starting_date;
		if($this->type == "monthly"){	
			$this->ending_date = mktime(0, 0, 0, date("m", $start) + MONTHS, date("t", $start), date("Y", $start));
		} else {
			$this->ending_date = mktime(0,0,0, date("m", $start), date("d", $start) + 6, date("Y", $start));
		}
	}
	
	public function build(){
		$this->days	= array();
		#if($this->type == "monthly"){
			$this->vista_actual = 1;
			$this->buildMensal();
		#} else {
		#	$this->vista_actual = 0;
		#	$this->buildSemanal();
		#}
	}
	
	public function addEvaluations($evaluations){
		foreach($evaluations as $role => $years){
			foreach($years as $year => $days){
				if(array_key_exists($year, $this->days)){
					
					foreach($days as $day => $evals){
						foreach($evals as $e){
							$evaluation = $e['evaluation'];
							if(!array_key_exists($day, $this->days[$year]['avaliacoes'])){
								$this->days[$year]['avaliacoes'][$day] = array();
								if($evaluation->getValidated() == 0){
									$this->days[$year]['class'][$day] = "dia-mes cor-erro";	
								} else {
									$this->days[$year]['class'][$day] = "dia-mes cor-ok";							
								}
							} else {
								$this->days[$year]['class'][$day] = "dia-mes cor-erro";
							}
							array_push($this->days[$year]['avaliacoes'][$day], $e);
						}
					}
				}
			}
		}	
	}

	private function buildMensal(){
		$this->vista_selected = 0;
		$month = date("m", $this->starting_date);
		$year = date("Y", $this->starting_date);
		$day = new Day(mktime(0, 0, 0, $month, 1, $year));
		
		for($i = 0; $i < MONTHS; $i++){
			$id = $day->getYear().$day->getMonth();
			$this->days[$id]['mes']['num'] = $month;
			$this->days[$id]['mes']['titulo'] = $day->getMonthName();
			$this->days[$id]['ano'] = $day->getYear();
			for($j = 0; $j < $day->getOffset(); $j++){
				$this->days[$id]['dias'][$j] = "&nbsp;";
				$this->days[$id]['nomes'][$j] = "";
			}
			
			do{
				$class = "dia_mes";
				$id = $day->getYear().$day->getMonth();
				$d = $day->getDay();
				$this->days[$id]['dias'][$j] =  $day->getDay();
				$this->days[$id]['data'][$j] = $day->getYear().$day->getMonth().$day->getDay();
				$this->days[$id]['class'][$d] = $day->getDate() == $this->actual_day ? "dia_seleccionado" : $class;
				$this->days[$id]['nomes'][$j++] =  sprintf("%s", $day);
				$this->days[$id]['avaliacoes']		= array();
				$day = $day->moveDay(1);	
			} while($day->getMonth() == $month);
			
			for(;$j < 42; $j++){
				$this->days[$id]['dias'][$j] = "&nbsp;";
				$this->days[$id]['nomes'][$j] = "";
			}
			
			$month = $day->getMonth();
		}
	}	

	function __destruct(){
		$_SESSION['starting_date']	= $this->starting_date;
		$_SESSION['ending_date']	= $this->ending_date;
		$_SESSION['actual_day']		= $this->actual_day;
		$_SESSION['type']			= $this->type;
	}
}
?>