-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2021 at 04:12 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `post_a_query`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `answer_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` varchar(5000) NOT NULL,
  `student_id` int(11) NOT NULL,
  `answer_student_name` varchar(50) NOT NULL,
  `answer_year` int(10) NOT NULL,
  `answer_semester` int(10) NOT NULL,
  `answer_stream` int(30) NOT NULL,
  `Posted_On` date DEFAULT NULL,
  `likes` int(11) NOT NULL,
  `dislikes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`answer_id`, `question_id`, `answer`, `student_id`, `answer_student_name`, `answer_year`, `answer_semester`, `answer_stream`, `Posted_On`, `likes`, `dislikes`) VALUES
(1, 1, 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humor, or randomized words that don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of the text.\r\n', 0, 'avi', 1, 1, 1, NULL, 0, 0),
(2, 1, 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humor, or randomized words that don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of the text.\r\n', 0, 'avirup', 1, 1, 1, NULL, 0, 0),
(8, 1, 'this is answer test 1', 0, 'xyzw', 1, 1, 1, NULL, 0, 0),
(17, 1, 'this is answer test 9', 2, 'vinod', 1, 1, 1, NULL, 0, 0),
(18, 8, 'this is answer test 2', 2, 'vinod', 1, 1, 1, NULL, 0, 0),
(19, 10, 'Yes you can post questions here and we will answer', 2, 'vinod', 1, 1, 1, NULL, 0, 0),
(20, 2, 'this is answer test 1', 2, 'Avirup Mondal', 1, 1, 1, NULL, 0, 0),
(21, 14, 'this is answer test 1', 8, 'Avie', 1, 1, 1, NULL, 8, 5),
(22, 12, 'I am teacher answer 5', 8, 'Avie', 1, 1, 1, '2021-06-24', 0, 0),
(32, 14, 'I am teacher answer 5', 7, 'Teacher 1', 17, 4, 7, '2021-06-26', 0, 0),
(33, 11, 'this is answer test 1', 8, 'Avie', 1, 1, 1, '2021-06-26', 0, 0),
(34, 11, 'this is answer test 9', 8, 'Avie', 1, 1, 1, '2021-06-26', 0, 0),
(35, 14, 'I am teacher answer 5', 0, 'Teacher 1', 17, 4, 7, '2021-06-26', 0, 0),
(36, 14, 'I am teacher answer 5', 7, 'Teacher 1', 17, 4, 7, '2021-06-26', 0, 0),
(37, 14, 'this is answer test 9', 7, 'Teacher 1', 17, 4, 7, '2021-06-26', 15, 1),
(38, 14, 'this is answer test 9', 7, 'Teacher 1', 17, 4, 7, '2021-06-26', 10, 2),
(39, 14, 'this is answer test 9', 7, 'Teacher 1', 17, 4, 7, '2021-06-26', 0, 0),
(40, 16, 'this is answer test 1', 8, 'Avie', 1, 1, 1, '2021-06-27', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `college_list`
--

CREATE TABLE `college_list` (
  `id` int(11) NOT NULL,
  `College_Name` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `college_list`
--

INSERT INTO `college_list` (`id`, `College_Name`) VALUES
(1, 'Guru Nanak Institute of Technology(GNIT)'),
(2, 'Narula Institute of Technology(NIT)');

-- --------------------------------------------------------

--
-- Table structure for table `like_dislike`
--

CREATE TABLE `like_dislike` (
  `id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `dislikes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `like_dislike`
--

INSERT INTO `like_dislike` (`id`, `answer_id`, `likes`, `dislikes`) VALUES
(1, 20, 12, 4),
(2, 21, 3, 2),
(3, 22, 5, 1),
(4, 38, 5, 1),
(5, 37, 15, 2);

-- --------------------------------------------------------

--
-- Table structure for table `queries`
--

CREATE TABLE `queries` (
  `Query_Id` int(11) NOT NULL,
  `Student_Id` int(11) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `Question` varchar(5000) NOT NULL,
  `year` varchar(20) NOT NULL,
  `stream` varchar(20) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `Posted_On` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `queries`
--

INSERT INTO `queries` (`Query_Id`, `Student_Id`, `student_name`, `Question`, `year`, `stream`, `semester`, `subject`, `Posted_On`) VALUES
(13, 8, 'Avie', 'I am Avie . Can I post Question?', '1', '1', '1', '', NULL),
(14, 8, 'Avie', 'I am Avie . Can I post Question 2 ?', '1', '1', '1', '', NULL),
(15, 10, 'abcde', 'i am abcde', '5', '2', '9', '4', '2021-06-20'),
(16, 8, 'Avie', 'this is sub rf question 1', '1', '1', '1', '4', '2021-06-27');

-- --------------------------------------------------------

--
-- Table structure for table `question_paper`
--

CREATE TABLE `question_paper` (
  `Paper_Id` int(11) NOT NULL,
  `Paper_Stream` int(11) NOT NULL,
  `Paper_Year` int(11) NOT NULL,
  `Paper_Semester` int(11) NOT NULL,
  `Paper_Subject` int(11) NOT NULL,
  `File_Name` varchar(500) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Posted_On` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question_paper`
--

INSERT INTO `question_paper` (`Paper_Id`, `Paper_Stream`, `Paper_Year`, `Paper_Semester`, `Paper_Subject`, `File_Name`, `User_Id`, `Posted_On`) VALUES
(1, 1, 1, 1, 4, 'rf.txt', 7, '2021-06-27'),
(4, 1, 1, 1, 4, '55 Business Cards Examples for Designers_6_4_20.docx', 7, '2021-06-27');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `Semester_Id` int(11) NOT NULL,
  `Semester` int(11) NOT NULL,
  `Year_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`Semester_Id`, `Semester`, `Year_Id`) VALUES
(1, 2, 1),
(2, 3, 2),
(3, 2, 5),
(4, 0, 17);

-- --------------------------------------------------------

--
-- Table structure for table `stream`
--

CREATE TABLE `stream` (
  `Stream_Id` int(11) NOT NULL,
  `Stream` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stream`
--

INSERT INTO `stream` (`Stream_Id`, `Stream`) VALUES
(1, 'ECE'),
(2, 'CSE'),
(3, 'EE'),
(4, 'ME'),
(5, 'FT'),
(6, 'IT');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `Subject_Id` int(11) NOT NULL,
  `Subject` varchar(200) NOT NULL,
  `Semester_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`Subject_Id`, `Subject`, `Semester_Id`) VALUES
(1, 'DBMS', 2),
(2, 'VLSI', 3),
(3, 'Signal and System', 3),
(4, 'RF & Microwave', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `college_name` int(11) NOT NULL,
  `college_id` varchar(20) NOT NULL,
  `stream` int(200) NOT NULL,
  `year` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `student` int(11) NOT NULL,
  `teacher` int(11) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `college_name`, `college_id`, `stream`, `year`, `semester`, `email`, `password`, `student`, `teacher`, `image`) VALUES
(7, 'Avijit Mondal', 2, '', 1, 17, 4, 'titomondal2018@gmail.com', 'Teacher', 0, 1, '154300119_Picture1.png'),
(8, 'Avie', 1, 'NIT2017', 1, 1, 1, 'personalavi2020@gmail.com', 'Aviemondal', 1, 0, '928244086_avirup.jpg'),
(10, 'abcde', 1, '23ed', 2, 5, 9, 'abcd@gmail.com', 'abcd', 1, 0, ''),
(11, 'Avijit', 1, '', 1, 17, 4, 'mondalavirup2015@gmail.com', 'Avijit', 0, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE `year` (
  `Year_Id` int(11) NOT NULL,
  `Year` int(11) NOT NULL,
  `Stream_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`Year_Id`, `Year`, `Stream_Id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 1, 2),
(6, 2, 2),
(7, 3, 2),
(8, 4, 2),
(9, 1, 3),
(10, 2, 3),
(11, 3, 3),
(12, 4, 3),
(13, 1, 4),
(14, 2, 4),
(15, 3, 4),
(16, 4, 4),
(17, 0, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `college_list`
--
ALTER TABLE `college_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like_dislike`
--
ALTER TABLE `like_dislike`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `queries`
--
ALTER TABLE `queries`
  ADD PRIMARY KEY (`Query_Id`);

--
-- Indexes for table `question_paper`
--
ALTER TABLE `question_paper`
  ADD PRIMARY KEY (`Paper_Id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`Semester_Id`);

--
-- Indexes for table `stream`
--
ALTER TABLE `stream`
  ADD PRIMARY KEY (`Stream_Id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`Subject_Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `year`
--
ALTER TABLE `year`
  ADD PRIMARY KEY (`Year_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `college_list`
--
ALTER TABLE `college_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `like_dislike`
--
ALTER TABLE `like_dislike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `queries`
--
ALTER TABLE `queries`
  MODIFY `Query_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `question_paper`
--
ALTER TABLE `question_paper`
  MODIFY `Paper_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `Semester_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stream`
--
ALTER TABLE `stream`
  MODIFY `Stream_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `Subject_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `year`
--
ALTER TABLE `year`
  MODIFY `Year_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
