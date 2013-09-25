<?php
require_once("model/Coordinator.php");
require_once("model/Teacher.php");
require_once("model/Student.php");

class User{
	private $con;
	private $user_num;
	private $name;
	#private $address;
	#private $phone_number;
	#private $email;
	private $username;
	private $password;
	#private $foto;
	private $coordinator;
	private $teacher;
	private $student;
	private $teaching;
	
	function __construct($con){
		$this->con			= $con;
		$this->coordinator	= new Coordinator($this->con);
		$this->teacher		= new Teacher($this->con);
		$this->student		= new Student($this->con);
		$this->evaluations	= array();
		$this->login();
	}
	
	private function setUser(){
		if(isset($_SESSION['username'])){
			$query = sprintf("SELECT * FROM utilizador WHERE username = '%s' AND pass = '%s'",
				$_SESSION['username'], $_SESSION['password']);
			$result = $this->con->getRow($query);
			if(count($result) > 0){
				$this->user_num			= $result['num_utilizador'];
				$this->name				= $result['nome'];
				#$this->address			= $result['morada'];
				#$this->phone_number	= $result['telefone'];
				#$this->email			= $result['email'];
				$this->username			= $result['username'];
				#$this->foto			= $result['foto'];
				$this->password			= $result['pass'];
				$this->teaching			= $this->con->isTeacher($this->user_num);
			} else {
				$this->logout();
			}	
		} else {
			$this->logout();
		}
	}
	
	public function newEvaluation($array){
		# array(discipline_id, date, weight, calssroom, type, observations)
		# user_num INT(11), discipline_id, date, weight, classroom, type, observations )
		
		$query = sprintf("call add_evaluation('%d', '%s', '%s', '%s', '%s', '%s', '%s')",
			$this->user_num, $array[0], date("Ymd", $array[1]), 
			$array[2], $array[3], $array[4], $array[5] 
		);
		$this->con->execute($query);
	}
	
	public function login($username = "", $password = ""){
		if($username == "" || $password == ""){
			$this->setUser();
		} else {
			$query = sprintf("SELECT * FROM utilizador WHERE username = '%s' AND pass = '%s'",
				$username, md5($password));
			$result = $this->con->getRow($query);
			if(count($result) > 0){
				$this->user_num			= $result['num_utilizador'];
				$this->name				= $result['nome'];
				$this->address			= $result['morada'];
				$this->phone_number		= $result['telefone'];
				$this->email			= $result['email'];
				$this->username			= $result['username'];
				$this->foto				= $result['foto'];
				$this->password			= $result['pass'];
				$this->teaching			= $this->con->isTeacher($this->user_num);
			}
		}
		$this->setCourses();
	}
	
	public function setCourses(){
		$user_num = $this->getUserNum();
		// obter todos os cursos associados ao user_num
		
		/* course returned array fields: 
		 * 0 => id
		 * 1 => name
		 * 2 => year
		 * 3 => role
		 */ 
		$courses = $this->con->getCourses($user_num);
		foreach($courses as $course){
			$role = $course[3];
			// criar o curso no role respectivo
			$this->$role->addCourse($course);
			// obter as disciplinas associadas ao curso e user_num
			
			/* discipline returned array fields: 
			 * 0 => id
			 * 1 => description
			 * 2 => title
			 */
			$disciplines = $this->con->getDisciplines($course[3], $user_num, $course[0]);
			
			$c = $this->$role->getCourse($course[0]);
			foreach($disciplines as $discipline){
				// criar a disciplina no curso do respectivo role do user_num
				$c->addDiscipline($discipline);
				
				/* evaluation returned array fields: 
				 * 0 => id
				 * 1 => type
				 * 2 => weight
				 * 3 => date
				 * 4 => validated
				 */
				$evaluations = $this->con->getEvaluations($role, $user_num, $discipline[0]);
				$d = $c->getDiscipline($discipline[0]);
				foreach($evaluations as $e){
					$e[5] = $c->getId();
					$e[6] = $d->getId();
					$d->addEvaluation($e);
				}
			}
		}
	}
	
	public function logout(){
		$this->user_num		= NULL;
		$this->name			= NULL;
		$this->address		= NULL;
		$this->phone_number	= NULL;
		$this->email		= NULL;
		$this->username		= NULL;
		$this->foto			= NULL;
		$this->password		= NULL;
		$this->teaching		= array();
		$this->teacher->clear();
		$this->coordinator->clear();
		$this->student->clear();
	}
	
	public function getUserNum()		{ return $this->user_num;		}
	public function getName()			{ return $this->name;			}
	public function getUsername()		{ return $this->username;		}
	public function getCoordinator()	{ return $this->coordinator;	}
	public function getTeacher()		{ return $this->teacher;		}
	public function getStudent()		{ return $this->student;		}
	public function getTeaching()		{ return $this->teaching;		}
	
	public function getCourses()		
	{
		$courses = array(	"coordinator"	=> $this->coordinator,
							"teacher"		=> $this->teacher,
							"student"		=> $this->student );
		return $courses;
	}
	
	public function getCourse($id){
		$courses = array(	"coordinator"	=> $this->coordinator->getCourse($id),
							"teacher"		=> $this->teacher->getCourse($id),
							"student"		=> $this->student->getCourse($id) );
		return $courses;
	}
	
	public function getEvaluationsByDate($date){	
		$coordinator	= $this->coordinator->getEvaluationsByDate($date);
		$teacher		= $this->teacher->getEvaluationsByDate($date);
		$student		= $this->student->getEvaluationsByDate($date);
		return array("coordinator" => $coordinator, "teacher" => $teacher, "student" => $student);
	}

	public function getEvaluationsByDates($start, $end){	
		$coordinator = $this->coordinator->getEvaluationsByDates($start, $end);
		$teacher = $this->teacher->getEvaluationsByDates($start, $end);
		$student = $this->student->getEvaluationsByDates($start, $end);
		
		return array("coordinator" => $coordinator, "teacher" => $teacher, "student" => $student);
	}
	
	function __destruct(){
		$_SESSION['username']	= $this->username;
		$_SESSION['password']	= $this->password;
	}
}
?>