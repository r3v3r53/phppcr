<?php
class Day{
	private $time;
	private static $day_names;
	private static $month_names;
	
	function __construct($time){
		$this->time = $time;
		self::$day_names	= array(
			array("full" => "Domingo",				"min" => "DOM"),
			array("full" => "Segunda-feira",		"min" => "SEG"),
			array("full" => "Ter&ccedil;a-feira",	"min" => "TER"),
			array("full" => "Quarta-feira", 		"min" => "QUA"), 
			array("full" => "Quinta-feira", 		"min" => "QUI"),
			array("full" => "Sexta-feira", 			"min" => "SEX"),
			array("full" => "S&aacute;bado", 		"min" => "SAB")   
		);
		self::$month_names	= array(
			NULL,
			array("full" => "Janeiro",				"min" => "JAN"),
			array("full" => "Feveiro",				"min" => "FEV"),
			array("full" => "Mar&ccedil;o",			"min" => "MAR"),
			array("full" => "Abril",				"min" => "ABR"),
			array("full" => "Maio",					"min" => "MAI"),
			array("full" => "Junho",				"min" => "JUN"),
			array("full" => "Julho",				"min" => "JUL"),
			array("full" => "Agosto",				"min" => "AGO"),
			array("full" => "Setembro",				"min" => "SET"),
			array("full" => "Outubro",				"min" => "OUT"),
			array("full" => "Novembro",				"min" => "NOV"),
			array("full" => "Dezembro",				"min" => "DEZ")
		);
	}

	public function moveDay($i){
		return new Day(
			mktime(
				date("H", $this->time),
				date("i", $this->time),
				date("s", $this->time),
				date("m", $this->time),
				date("d", $this->time) + $i,
				date("Y", $this->time)
			)
		);
		
	}
	
	public function moveMonth($i){
		return new Day( 
			mktime(
				date("H", $this->time),
				date("i", $this->time),
				date("s", $this->time),
				date("m", $this->time) + $i,
				date("d", $this->time),
				date("Y", $this->time)
			)
		);
	}
	
	public function getDate()		{ return $this->time;				}
	public function getDay()		{ return date("d", $this->time);	}
	public function getMonth()		{ return date("m", $this->time);	}
	public function getYear()		{ return date("Y", $this->time);	}
	public function getWeek()		{ return date("W", $this->time);	}
	public function getOffset()		{ return date("w", $this->time);	}
	
	public function __toString(){
		return sprintf("%s, %d de %s de %d", 
			$this->getDayName(),
			$this->getDay(),
			$this->getMonthName(),
			$this->getYear()	
		);
	}
	
	public function getDayName(){
		return self::$day_names[date("w", $this->time)]["full"];	
	}
	
	public function getDayNameMin(){
		return self::$day_names[date("w", $this->time)]["min"];	
	}
	
	public function getMonthName(){
		return self::$month_names[date("n", $this->time)]["full"];	
	}
	
	public function getMonthNameMin(){
		return self::$month_names[date("n", $this->time)]["min"];	
	}
}
?>