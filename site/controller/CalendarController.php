<?php
require_once("model/Calendar.php");

class CalendarController{
	private $view;
	private $calendar;
	private $con;
	
	function __construct($con, $view){
		$this->con		= $con;
		$this->view		= $view;
		$this->calendar	= new Calendar();
	}
	
	public function move($i){
		$this->calendar->move($i);
	}
	
	public function setView(){
		$this->view->setType($this->getType());
		$this->view->setCalendar($this->getDays());
		$date = $this->calendar->getActualDay();
		$this->view->setDate(array(date("d/m/Y", $date), $date));
	}
	
	public function setDay($day){
		$this->calendar->setDay($day);
		$this->calendar->build();
	}
	
	public function addEvaluations($evaluations){
		$this->calendar->addEvaluations($evaluations);
	}
		
	public function getDays()			{ return $this->calendar->getDays();			}
	public function getStartingDate()	{ return $this->calendar->getStartingDate();	}
	public function getEndingDate()		{ return $this->calendar->getEndingDate();		}
	public function getActualDay()		{ return $this->calendar->getActualDay();		}
	public function getType()			{ return $this->calendar->getType();			}
}
