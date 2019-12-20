-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2019 at 07:52 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quizphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `p_mob_no` varchar(10) NOT NULL,
  `p_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`p_mob_no`, `p_name`) VALUES
('8451092929', 'Michael');

-- --------------------------------------------------------

--
-- Table structure for table `questions_and_answers`
--

CREATE TABLE `questions_and_answers` (
  `question_id` int(11) NOT NULL,
  `question` varchar(1000) NOT NULL,
  `op1` varchar(1000) NOT NULL,
  `op2` varchar(1000) NOT NULL,
  `op3` varchar(1000) NOT NULL,
  `op4` varchar(1000) NOT NULL,
  `answer` int(11) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions_and_answers`
--

INSERT INTO `questions_and_answers` (`question_id`, `question`, `op1`, `op2`, `op3`, `op4`, `answer`, `score`) VALUES
(1, '1 + 1 = ?', '2', '<pre><code>#include<iostream>\r\nusing namespace std;\r\nmain() {\r\n   char s[] = \"hello\", t[] = \"hello\";\r\n   if(s==t)\r\n      cout<<\"eqaul strings\";\r\n}</code></pre>', '4', '0', 1, 1),
(2, '2 + 2 = ?', '3', '5', '<xmp><html>\r\n    <head>\r\n        <title>Example</title>\r\n    </head>\r\n    <body>\r\n        <p>This is an example of a simple HTML page with one paragraph.</p>\r\n    </body>\r\n</html></xmp>', '4', 4, 2),
(3, '3 + 3 = ?', '6', '5', '7', '3', 1, 3),
(4, '4 + 4 = ?', '1', '2', '3', '8', 4, 1),
(5, 'What is the output of the following program?</br><pre><code>#include<iostream>\r\nusing namespace std;\r\nmain() {\r\n   char s[] = \"hello\", t[] = \"hello\";\r\n   if(s==t)\r\n      cout<<\"eqaul strings\";\r\n}</code></pre>', 'Equal strings', 'Unequal strings', 'No output', 'Compilation error', 3, 3),
(6, 'What map is used to give shine to an object?', '\r\nSpecular Level', 'Specular Color', '\r\nAmbient Level', 'Ambient Color', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `scoreboard`
--

CREATE TABLE `scoreboard` (
  `p_mob_no` varchar(10) NOT NULL,
  `p_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scoreboard`
--

INSERT INTO `scoreboard` (`p_mob_no`, `p_score`) VALUES
('8451092929', 6);

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `p_mob_no` varchar(10) NOT NULL,
  `question_id` int(11) NOT NULL,
  `p_answer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`p_mob_no`, `question_id`, `p_answer`) VALUES
('8451092929', 1, 1),
('8451092929', 2, 4),
('8451092929', 3, 1),
('8451092929', 4, 3),
('8451092929', 5, 2),
('8451092929', 6, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`p_mob_no`);

--
-- Indexes for table `questions_and_answers`
--
ALTER TABLE `questions_and_answers`
  ADD PRIMARY KEY (`question_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions_and_answers`
--
ALTER TABLE `questions_and_answers`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
