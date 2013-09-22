<?php
class Evaluation{
	private $id;
	private $type;
	private $weight;
	private $date;
	private $validated;
	private $classroom;
	private $course_id;
	private $discipline_id;
	
	function __construct($evaluation){
		$this->id				= $evaluation[0];	
		$this->type				= $evaluation[1];
		$this->weight			= $evaluation[2];
		$this->date				= strtotime($evaluation[3]);
		$this->validated		= $evaluation[4];
		$this->classroom		= NULL;
		$this->course_id		= $evaluation[5];
		$this->discipline_id	= $evaluation[6];
	}

	public function validate($con)		{ $this->setValidated($con, 1);	}
	public function unvalidate($con)	{ $this->setValidated($con, 0);	}
	
	private function setValidated($con, $value){
		$this->validated = $value;
		$query = sprintf("UPDATE avaliacao SET activada = %d WHERE num_avaliacao = %d", $value, $this->id);
		$con->execute($query);
	}
		
	public function setType($type)				{ $this->type = $type;		}
	public function setWeight($weight)			{ $this->weight = $weight;	}
	public function setDate($date)				{ $this->date = $date;		}
	
	public function getId()				{ return $this->id;				}
	public function getType()			{ return $this->type;			}
	public function getDate()			{ return $this->date;			}
	public function getWeight()			{ return $this->weight;			}
	public function getValidated()		{ return $this->validated;		}
	public function getClassRoom()		{ return $this->classroom;		}
	public function getCourseId()		{ return $this->course_id;		}
	public function getDisciplineId()	{ return $this->discipline_id;	}
}
?>