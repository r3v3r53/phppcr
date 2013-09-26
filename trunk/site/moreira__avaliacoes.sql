-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 26, 2013 at 02:29 PM
-- Server version: 5.5.32-cll
-- PHP Version: 5.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `moreira__avaliacoes`
--
CREATE DATABASE IF NOT EXISTS `moreira__avaliacoes` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `moreira__avaliacoes`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `add_evaluation`$$
CREATE DEFINER=`moreira_aval`@`localhost` PROCEDURE `add_evaluation`(IN user_num INT(11), discipline_id INT(11), date DATE, weight INT(11), classroom VARCHAR(20), type VARCHAR(100), observations VARCHAR(1000))
begin

if (SELECT 1 FROM docente 
	where num_utilizador = user_num 
	AND num_disciplina = discipline_id) = 1 THEN 
begin
INSERT INTO avaliacao (num_disciplina, num_semestre, data_avaliacao, peso, sala, tipo_avaliacao, observacoes, activada) values (discipline_id, 1, date, weight, classroom, type, observations, 0); 
end;
end if;

end$$

DROP PROCEDURE IF EXISTS `get_coordinator_disciplines`$$
CREATE DEFINER=`moreira_aval`@`localhost` PROCEDURE `get_coordinator_disciplines`(IN user_num INT, num_course INT)
begin

SELECT d.num_disciplina as id, d.descricao as description, d.titulo as title
	FROM disciplina d

	RIGHT JOIN curso_ano ca
	ON ca.num_curso = d.num_curso
	AND ca.num_coordenador = user_num
	
	WHERE d.num_curso = num_course;


end$$

DROP PROCEDURE IF EXISTS `get_coordinator_evaluations`$$
CREATE DEFINER=`moreira_aval`@`localhost` PROCEDURE `get_coordinator_evaluations`(IN user_num INT, num_discipline INT)
begin

SELECT 
	av.num_avaliacao as id, av.tipo_avaliacao as type, 
	av.peso as weight, av.data_avaliacao as date, av.activada as validated
	FROM avaliacao as av
	
	RIGHT JOIN (
		SELECT a.num_avaliacao	
		FROM curso_ano as ca
		LEFT JOIN disciplina d
			ON d.num_curso = ca.num_curso
		RIGHT JOIN avaliacao a
			ON a.num_disciplina = d.num_disciplina
		WHERE ca.num_coordenador = user_num
	) AS x 
	ON  x.num_avaliacao = av.num_avaliacao

	WHERE av.num_disciplina = num_discipline;
end$$

DROP PROCEDURE IF EXISTS `get_cursos_user`$$
CREATE DEFINER=`moreira_aval`@`localhost` PROCEDURE `get_cursos_user`(IN user_num INT)
begin

SELECT c.num_curso as id, c.nome_curso as name, a.titulo_ano as year, x.role
	FROM curso_ano as ca

	RIGHT JOIN (
		SELECT a.num_curso, 'student' as role				FROM aluno a
		WHERE a.num_utilizador = user_num
		
		UNION (
			SELECT d.num_curso, 'teacher' as role
			FROM docente dc
				LEFT JOIN disciplina d
				ON d.num_disciplina = dc.num_disciplina
				WHERE dc.num_utilizador = user_num
		)

		UNION (
			SELECT c.num_curso, 'coordinator' as role
			FROM curso_ano as c
			WHERE c.num_coordenador = user_num
		)
			) as x

		ON x.num_curso = ca.num_curso
			
			LEFT JOIN ano_lectivo a
			on a.num_ano = ca.num_ano
			
LEFT JOIN curso c
ON c.num_curso = ca.num_curso;


end$$

DROP PROCEDURE IF EXISTS `get_student_disciplines`$$
CREATE DEFINER=`moreira_aval`@`localhost` PROCEDURE `get_student_disciplines`(IN user_num INT, num_course INT)
begin

SELECT d.num_disciplina as id, d.descricao as description, d.titulo as title
	FROM disciplina d

	RIGHT JOIN matricula_disciplina md
	ON md.num_disciplina = d.num_disciplina
	AND md.num_utilizador = user_num
	
	WHERE d.num_curso = num_course;


end$$

DROP PROCEDURE IF EXISTS `get_student_evaluations`$$
CREATE DEFINER=`moreira_aval`@`localhost` PROCEDURE `get_student_evaluations`(IN user_num INT, num_discipline INT)
begin

SELECT 
	av.num_avaliacao as id, av.tipo_avaliacao as type, 
	av.peso as weight, av.data_avaliacao as date, x.validated
	FROM avaliacao as av
	
	LEFT JOIN (
		SELECT a.num_avaliacao, 1 as validated	
		FROM avaliacao_aluno a
		WHERE a.num_utilizador = user_num
		AND a.num_disciplina = num_discipline
	) AS x 
	ON  x.num_avaliacao = av.num_avaliacao

	WHERE av.num_disciplina = num_discipline
	AND av.activada = 1;
end$$

DROP PROCEDURE IF EXISTS `get_teacher_disciplines`$$
CREATE DEFINER=`moreira_aval`@`localhost` PROCEDURE `get_teacher_disciplines`(IN user_num INT, num_course INT)
begin

SELECT d.num_disciplina as id, d.descricao as description, d.titulo as title
	FROM disciplina d

	RIGHT JOIN docente dc
	ON dc.num_disciplina = d.num_disciplina
	AND dc.num_utilizador = user_num
	
	WHERE d.num_curso = num_course;


end$$

DROP PROCEDURE IF EXISTS `get_teacher_evaluations`$$
CREATE DEFINER=`moreira_aval`@`localhost` PROCEDURE `get_teacher_evaluations`(IN user_num INT, num_discipline INT)
begin

SELECT 
	av.num_avaliacao as id, av.tipo_avaliacao as type, 
	av.peso as weight, av.data_avaliacao as date, av.activada as validated
	FROM avaliacao as av
	
	RIGHT JOIN (
		SELECT a.num_avaliacao
		FROM docente d
		LEFT JOIN avaliacao a
			ON a.num_disciplina = d.num_disciplina
			AND a.num_semestre = d.num_semestre
		WHERE d.num_utilizador = user_num
		AND a.num_disciplina = num_discipline
	) AS x 
	ON  x.num_avaliacao = av.num_avaliacao

	WHERE av.num_disciplina = num_discipline;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `aluno`
--

DROP TABLE IF EXISTS `aluno`;
CREATE TABLE IF NOT EXISTS `aluno` (
  `num_ano` int(11) NOT NULL,
  `num_utilizador` int(11) NOT NULL,
  `data_matricula` date NOT NULL,
  `num_curso` int(11) NOT NULL,
  PRIMARY KEY (`num_utilizador`,`num_ano`),
  KEY `num_utilizador_a_idx` (`num_utilizador`),
  KEY `num_curso_ano_a_idx` (`num_ano`,`num_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aluno`
--

INSERT INTO `aluno` (`num_ano`, `num_utilizador`, `data_matricula`, `num_curso`) VALUES
(1, 1, '2012-08-01', 1),
(1, 2, '2012-08-01', 1),
(1, 3, '2012-08-01', 1),
(1, 4, '2012-08-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ano_lectivo`
--

DROP TABLE IF EXISTS `ano_lectivo`;
CREATE TABLE IF NOT EXISTS `ano_lectivo` (
  `num_ano` int(11) NOT NULL,
  `titulo_ano` varchar(9) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  PRIMARY KEY (`num_ano`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ano_lectivo`
--

INSERT INTO `ano_lectivo` (`num_ano`, `titulo_ano`, `data_inicio`, `data_fim`) VALUES
(1, '2012/2013', '2012-09-01', '2013-07-15');

-- --------------------------------------------------------

--
-- Table structure for table `avaliacao`
--

DROP TABLE IF EXISTS `avaliacao`;
CREATE TABLE IF NOT EXISTS `avaliacao` (
  `num_avaliacao` int(11) NOT NULL AUTO_INCREMENT,
  `num_disciplina` int(11) NOT NULL,
  `num_semestre` int(11) NOT NULL,
  `data_avaliacao` date DEFAULT NULL,
  `peso` int(11) NOT NULL,
  `sala` varchar(20) DEFAULT NULL,
  `tipo_avaliacao` varchar(100) NOT NULL,
  `observacoes` varchar(1000) DEFAULT NULL,
  `activada` varchar(1) NOT NULL,
  PRIMARY KEY (`num_avaliacao`),
  KEY `num_disciplina_semestre_idx` (`num_disciplina`,`num_semestre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `avaliacao`
--

INSERT INTO `avaliacao` (`num_avaliacao`, `num_disciplina`, `num_semestre`, `data_avaliacao`, `peso`, `sala`, `tipo_avaliacao`, `observacoes`, `activada`) VALUES
(4, 3, 1, '2013-07-22', 15, NULL, 'teste', NULL, '0'),
(5, 1, 1, '2013-08-15', 50, 'S10', 'frequencia', 'obs', '1'),
(6, 2, 1, '2013-09-16', 90, 'L10', 'exame', 'aia ia a', '1'),
(7, 1, 1, '2013-09-16', 50, 'S10', 'teste', 'com consulta', '0'),
(10, 2, 1, '2013-09-20', 45, '345', 'asgasvasdf', '235tqw', '0');

-- --------------------------------------------------------

--
-- Table structure for table `avaliacao_aluno`
--

DROP TABLE IF EXISTS `avaliacao_aluno`;
CREATE TABLE IF NOT EXISTS `avaliacao_aluno` (
  `num_utilizador` int(11) NOT NULL,
  `num_disciplina` int(11) NOT NULL,
  `num_avaliacao` int(11) NOT NULL,
  `nota` int(11) DEFAULT NULL,
  `observacoes` varchar(1000) DEFAULT NULL,
  `num_semestre` int(11) NOT NULL,
  PRIMARY KEY (`num_utilizador`,`num_disciplina`,`num_avaliacao`),
  KEY `num_avaliacao_a_idx` (`num_avaliacao`),
  KEY `num_matricula_disciplina_idx` (`num_utilizador`,`num_disciplina`,`num_semestre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `avaliacao_aluno`
--

INSERT INTO `avaliacao_aluno` (`num_utilizador`, `num_disciplina`, `num_avaliacao`, `nota`, `observacoes`, `num_semestre`) VALUES
(1, 1, 5, NULL, NULL, 1),
(1, 1, 7, NULL, NULL, 1),
(2, 1, 7, NULL, NULL, 1),
(2, 2, 6, NULL, NULL, 1),
(4, 3, 4, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `avaliacoes_datas_alt`
--

DROP TABLE IF EXISTS `avaliacoes_datas_alt`;
CREATE TABLE IF NOT EXISTS `avaliacoes_datas_alt` (
  `num_avaliacao` int(11) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`num_avaliacao`,`data`),
  KEY `avaliacao_idx` (`num_avaliacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `num_curso` int(11) NOT NULL AUTO_INCREMENT,
  `nome_curso` varchar(100) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`num_curso`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `curso`
--

INSERT INTO `curso` (`num_curso`, `nome_curso`, `descricao`) VALUES
(1, 'Engenharia Informatica', 'eng inf');

-- --------------------------------------------------------

--
-- Table structure for table `curso_ano`
--

DROP TABLE IF EXISTS `curso_ano`;
CREATE TABLE IF NOT EXISTS `curso_ano` (
  `num_curso` int(11) NOT NULL,
  `num_ano` int(11) NOT NULL,
  `num_coordenador` int(11) DEFAULT NULL,
  PRIMARY KEY (`num_curso`,`num_ano`),
  KEY `num_ano_c_idx` (`num_ano`),
  KEY `num_curso_c_idx` (`num_curso`),
  KEY `num_coordenador_idx` (`num_coordenador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `curso_ano`
--

INSERT INTO `curso_ano` (`num_curso`, `num_ano`, `num_coordenador`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `disciplina`
--

DROP TABLE IF EXISTS `disciplina`;
CREATE TABLE IF NOT EXISTS `disciplina` (
  `num_disciplina` int(11) NOT NULL AUTO_INCREMENT,
  `num_curso` int(11) NOT NULL,
  `descricao` varchar(1000) DEFAULT NULL,
  `titulo` varchar(100) NOT NULL,
  PRIMARY KEY (`num_disciplina`),
  KEY `num_curso_idx` (`num_curso`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `disciplina`
--

INSERT INTO `disciplina` (`num_disciplina`, `num_curso`, `descricao`, `titulo`) VALUES
(1, 1, 'PCR', 'PCR'),
(2, 1, 'HA', 'HA'),
(3, 1, 'EDA', 'EDA');

-- --------------------------------------------------------

--
-- Table structure for table `disciplina_semestre`
--

DROP TABLE IF EXISTS `disciplina_semestre`;
CREATE TABLE IF NOT EXISTS `disciplina_semestre` (
  `num_disciplina` int(11) NOT NULL,
  `num_semestre` int(11) NOT NULL,
  PRIMARY KEY (`num_disciplina`,`num_semestre`),
  KEY `num_semestre_d_idx` (`num_semestre`),
  KEY `num_disciplina_idx` (`num_disciplina`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `disciplina_semestre`
--

INSERT INTO `disciplina_semestre` (`num_disciplina`, `num_semestre`) VALUES
(1, 1),
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `docente`
--

DROP TABLE IF EXISTS `docente`;
CREATE TABLE IF NOT EXISTS `docente` (
  `num_disciplina` int(11) NOT NULL,
  `num_semestre` int(11) NOT NULL,
  `num_utilizador` int(11) NOT NULL,
  PRIMARY KEY (`num_disciplina`,`num_semestre`,`num_utilizador`),
  KEY `num_disciplina_dc_idx` (`num_disciplina`),
  KEY `num_semestre_idx` (`num_semestre`),
  KEY `num_utilizador_dc_idx` (`num_utilizador`),
  KEY `num_disciplina_semestre_dc_idx` (`num_disciplina`,`num_semestre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `docente`
--

INSERT INTO `docente` (`num_disciplina`, `num_semestre`, `num_utilizador`) VALUES
(1, 1, 3),
(2, 1, 3),
(3, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `matricula_disciplina`
--

DROP TABLE IF EXISTS `matricula_disciplina`;
CREATE TABLE IF NOT EXISTS `matricula_disciplina` (
  `num_utilizador` int(11) NOT NULL,
  `num_disciplina` int(11) NOT NULL,
  `num_semestre` int(11) NOT NULL,
  `num_ano` int(11) NOT NULL,
  `nota_final` int(11) DEFAULT NULL,
  `activada` tinyint(4) NOT NULL,
  `data_nota` date DEFAULT NULL,
  PRIMARY KEY (`num_utilizador`,`num_disciplina`,`num_semestre`),
  KEY `num_aluno_idx` (`num_utilizador`,`num_ano`),
  KEY `num_semestre_m_idx` (`num_disciplina`,`num_semestre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `matricula_disciplina`
--

INSERT INTO `matricula_disciplina` (`num_utilizador`, `num_disciplina`, `num_semestre`, `num_ano`, `nota_final`, `activada`, `data_nota`) VALUES
(1, 1, 1, 1, NULL, 1, NULL),
(2, 1, 1, 1, NULL, 1, NULL),
(2, 2, 1, 1, NULL, 1, NULL),
(3, 2, 1, 1, NULL, 1, NULL),
(4, 1, 1, 1, NULL, 1, NULL),
(4, 2, 1, 1, NULL, 1, NULL),
(4, 3, 1, 1, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `semestre`
--

DROP TABLE IF EXISTS `semestre`;
CREATE TABLE IF NOT EXISTS `semestre` (
  `num_semestre` int(11) NOT NULL AUTO_INCREMENT,
  `num_ano` int(11) NOT NULL,
  `titulo_semestre` varchar(50) NOT NULL,
  PRIMARY KEY (`num_semestre`),
  KEY `num_ano_idx` (`num_ano`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `semestre`
--

INSERT INTO `semestre` (`num_semestre`, `num_ano`, `titulo_semestre`) VALUES
(1, 1, 'primeiro');

-- --------------------------------------------------------

--
-- Table structure for table `utilizador`
--

DROP TABLE IF EXISTS `utilizador`;
CREATE TABLE IF NOT EXISTS `utilizador` (
  `num_utilizador` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `morada` varchar(100) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `foto` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`num_utilizador`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilizador`
--

INSERT INTO `utilizador` (`num_utilizador`, `nome`, `morada`, `telefone`, `email`, `username`, `pass`, `foto`) VALUES
(1, 'Pedro Moreira', 'Beja', '96', 'mail@pedromoreira.org', 'pmoreira', 'fcea920f7412b5da7be0cf42b8c93759 ', NULL),
(2, 'Lucinda Raposo', 'Beja', '966', 'lucinda@pedromoreira.org', 'lraposo', 'fcea920f7412b5da7be0cf42b8c93759 ', NULL),
(3, 'Guilherme Moreira', 'Beja', '9666', 'guilherme@pedromoreira.org', 'gmoreira', 'fcea920f7412b5da7be0cf42b8c93759 ', NULL),
(4, 'teste', 'teste', '96666', 'teste@pedromoreira.org', 'tmoreira', 'fcea920f7412b5da7be0cf42b8c93759 ', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `num_curso_ano_a` FOREIGN KEY (`num_ano`, `num_curso`) REFERENCES `curso_ano` (`num_ano`, `num_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `num_utilizador_a` FOREIGN KEY (`num_utilizador`) REFERENCES `utilizador` (`num_utilizador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD CONSTRAINT `num_disciplina_semestre` FOREIGN KEY (`num_disciplina`, `num_semestre`) REFERENCES `disciplina_semestre` (`num_disciplina`, `num_semestre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `avaliacao_aluno`
--
ALTER TABLE `avaliacao_aluno`
  ADD CONSTRAINT `num_avaliacao_a` FOREIGN KEY (`num_avaliacao`) REFERENCES `avaliacao` (`num_avaliacao`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `num_matricula_disciplina` FOREIGN KEY (`num_utilizador`, `num_disciplina`, `num_semestre`) REFERENCES `matricula_disciplina` (`num_utilizador`, `num_disciplina`, `num_semestre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `avaliacoes_datas_alt`
--
ALTER TABLE `avaliacoes_datas_alt`
  ADD CONSTRAINT `avaliacao` FOREIGN KEY (`num_avaliacao`) REFERENCES `avaliacao` (`num_avaliacao`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `curso_ano`
--
ALTER TABLE `curso_ano`
  ADD CONSTRAINT `num_ano_c` FOREIGN KEY (`num_ano`) REFERENCES `ano_lectivo` (`num_ano`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `num_coordenador` FOREIGN KEY (`num_coordenador`) REFERENCES `utilizador` (`num_utilizador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `num_curso_c` FOREIGN KEY (`num_curso`) REFERENCES `curso` (`num_curso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `num_curso` FOREIGN KEY (`num_curso`) REFERENCES `curso` (`num_curso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `disciplina_semestre`
--
ALTER TABLE `disciplina_semestre`
  ADD CONSTRAINT `num_disciplina` FOREIGN KEY (`num_disciplina`) REFERENCES `disciplina` (`num_disciplina`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `num_semestre_d` FOREIGN KEY (`num_semestre`) REFERENCES `semestre` (`num_semestre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `docente`
--
ALTER TABLE `docente`
  ADD CONSTRAINT `num_disciplina_semestre_dc` FOREIGN KEY (`num_disciplina`, `num_semestre`) REFERENCES `disciplina_semestre` (`num_disciplina`, `num_semestre`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `num_utilizador_dc` FOREIGN KEY (`num_utilizador`) REFERENCES `utilizador` (`num_utilizador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `matricula_disciplina`
--
ALTER TABLE `matricula_disciplina`
  ADD CONSTRAINT `num_aluno` FOREIGN KEY (`num_utilizador`, `num_ano`) REFERENCES `aluno` (`num_utilizador`, `num_ano`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `num_semestre_m` FOREIGN KEY (`num_disciplina`, `num_semestre`) REFERENCES `disciplina_semestre` (`num_disciplina`, `num_semestre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `semestre`
--
ALTER TABLE `semestre`
  ADD CONSTRAINT `num_ano` FOREIGN KEY (`num_ano`) REFERENCES `ano_lectivo` (`num_ano`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
