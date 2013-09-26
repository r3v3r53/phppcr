<?php
class BD{
	private $host;
	private $db;
	private $username;
	private $password;
	private $con;
	
	/*
	 * construtor, define as variaveis e chama o metodo para a conexao
	 */
	function __construct($host, $username, $password, $db){
		$this->host				= $host;
		$this->db				= $db;
		$this->username			= $username;	
		$this->password			= $password;
		$this->connect();
		
	}
	
	public function getHost()			{ return $this->host;			}
	public function getDB()				{ return $this->db;				}
	public function getUsername()		{ return $this->username;		}
	public function getCon()			{ return $this->con;			}
	
	/*
	 * Ligacao a base de dados
	 */
	public function connect(){
		$this->con = new mysqli($this->host, $this->username, $this->password, $this->db); 
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
		} 
	}
	
	public function isTeacher($user_num){
		$query = sprintf("
			select d.num_disciplina, d.titulo 
			from docente as t
			left join disciplina as d
			on d.num_disciplina = t.num_disciplina 
			where num_utilizador = %d", $user_num);
		$result = $this->query($query);
		
		return $result;
	}

	public function getEvaluations($role, $user_num, $discipline){
		$value = array();
		switch($role){
			case "coordinator":
				$query = sprintf("call get_coordinator_evaluations( %d, %d );", $user_num, $discipline);
				$value = $this->multiQuery($query);
				break;
			case "teacher":
				$query = sprintf("call get_teacher_evaluations( %d, %d );", $user_num, $discipline);
				$value = $this->multiQuery($query);
				break;
			case "student":
				$query = sprintf("call get_student_evaluations( %d, %d );", $user_num, $discipline);
				$value = $this->multiQuery($query);
				break;
			default:
				break;
		}
		return $value;
	}
	
	public function getCourses($user_num){
		$query = sprintf("call get_cursos_user( %d )", $user_num);
		return $this->multiQuery($query);
	}
	
	public function getDisciplines($role, $user_num, $course_id){
		$value = array();
		switch($role){
			case "coordinator":
				$query = sprintf("call get_coordinator_disciplines( %d, %d )", $user_num, $course_id);
				$value = $this->multiQuery($query);
				break;
			case "teacher":
				$query = sprintf("call get_teacher_disciplines( %d, %d )", $user_num, $course_id);
				$value = $this->multiQuery($query);
				break;
			case "student":
				$query = sprintf("call get_student_disciplines( %d, %d )", $user_num, $course_id);
				$value = $this->multiQuery($query);
				break;
			default:
				break;
		}
		return $value;
	}
	
	public function multiQuery($query){
		$results = array();
		if ($this->con->multi_query($query)) {
		    do {
		        if ($result = $this->con->use_result()) {
		            while ($row = $result->fetch_row()) {
		                array_push($results, $row);
		            }
		            $result->close();
		        }
		    } while ($this->con->next_result());
		}
		return $results;
	}
	
	/* 
	 * efectuar uma consulta que se supoe retornar resultados
	 */
	public function query($query){
		$results = array();	
		$temp = $this->con->query($query) or die($this->con->error.__LINE__);
		
		if($temp->num_rows > 0) {
			while($row = $temp->fetch_assoc()) {
				array_push($results, $row);	
			}
		}
		return $results;
	}
	
	public function getRow($query){
		$result = array();	
		$temp = $this->con->query($query) or die($this->con->error.__LINE__);
		
		if($temp->num_rows > 0) {
			$row = $temp->fetch_assoc();
			foreach($row as $key => $value){
				$result[$key] =  $value;	
			}
		}
		return $result;
	}
	
	/*
	 * executar comandos mysql que nao retornem resultados (insert, delete, update, etc...)
	 */
	public function execute($query){
		$this->con->query($query);
	}
	
	/*
	 * desligar a conexao a bd
	 */
	function __destruct(){
		mysqli_close($this->con);
	}
}
?>