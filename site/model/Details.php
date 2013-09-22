<?php
class Details{
	private $details;
	
	function __construct($evaluations){
		$this->details = array();
		$this->buildDetails($evaluations);	
	}
	
	private function buildDetails($evaluations){
		$this->details = array();
		foreach($evaluations as $role => $months){
			foreach($months as $days){
				foreach($days as $evs){
					foreach($evs as $id => $e){
						$evaluation = $e['evaluation']; 
						array_push(
							$this->details, 
							array( 
								"role"			=> $role, 
								"course"		=> $e['course'],
								"discipline"	=> $e['discipline'],
								"date"			=> date("d/m/Y", $evaluation->getDate()),
								"type"			=> $evaluation->getType(),
								"weight"		=> $evaluation->getWeight(),
								"classroom"		=> $evaluation->getClassRoom(),
								"id"			=> $evaluation->getID(),
								"validated"		=> $evaluation->getValidated()
							) 
						);
					}
				}
			}
		}
	}
	
	public function getDetails(){ return $this->details; }
}
?>