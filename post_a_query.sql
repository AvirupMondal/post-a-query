-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2021 at 07:08 AM
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
  `answer_year` varchar(10) NOT NULL,
  `answer_semester` varchar(10) NOT NULL,
  `answer_stream` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`answer_id`, `question_id`, `answer`, `student_id`, `answer_student_name`, `answer_year`, `answer_semester`, `answer_stream`) VALUES
(1, 1, 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humor, or randomized words that don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of the text.\r\n', 0, 'avi', '2', '3', 'ece'),
(2, 1, 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humor, or randomized words that don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of the text.\r\n', 0, 'avirup', '3', '5', 'ece'),
(8, 1, 'this is answer test 1', 0, 'xyzw', '3', '1', 'asddf'),
(17, 1, 'this is answer test 9', 2, 'vinod', '3', '1', 'asddf'),
(18, 8, 'this is answer test 2', 2, 'vinod', '3', '1', 'asddf'),
(19, 10, 'Yes you can post questions here and we will answer', 2, 'vinod', '4', '1', 'ECE');

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
  `semester` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `queries`
--

INSERT INTO `queries` (`Query_Id`, `Student_Id`, `student_name`, `Question`, `year`, `stream`, `semester`) VALUES
(1, 2, 'vinod', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of the text.\r\n', '1', 'ECE', '1'),
(2, 3, 'asd', 'I am question number 2', '3', 'CSE', '1'),
(3, 2, 'xyzw', 'this is test question 1', '4', 'EE', '1'),
(8, 2, 'vinod', 'hello bikram?', '2', 'ECE', '1'),
(9, 2, 'vinod', 'hello avirup?', '4', 'ECE', '1'),
(10, 2, 'vinod', 'Can we post question here?', '4', 'ECE', '1');

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
  `Id` int(11) NOT NULL,
  `Subject` text NOT NULL,
  `Year` int(11) NOT NULL,
  `Stream` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`Id`, `Subject`, `Year`, `Stream`) VALUES
(1, 'DBMS', 4, 2),
(2, 'VLSI', 3, 1),
(3, 'Signal and System', 2, 3),
(4, 'RF & Microwave', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `college_name` varchar(200) NOT NULL,
  `college_id` varchar(20) NOT NULL,
  `stream` varchar(100) NOT NULL,
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
(1, 'Avie', '', '', '', 0, 0, 'abc@gmail.com', 'abcd', 0, 2, '837188171_Screenshot (4).png'),
(2, 'vinod', 'rastar college', 'kichu nnei', 'ECE', 4, 1, 'def@gmail.com', 'defg', 1, 0, '905128321_logo.png'),
(6, 'Mukti', '', '', '', 0, 0, 'mondalmukti2016@gmail.com', 'Mukti', 0, 1, '');

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
(16, 4, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `queries`
--
ALTER TABLE `queries`
  ADD PRIMARY KEY (`Query_Id`);

--
-- Indexes for table `stream`
--
ALTER TABLE `stream`
  ADD PRIMARY KEY (`Stream_Id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`Id`);

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
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `queries`
--
ALTER TABLE `queries`
  MODIFY `Query_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stream`
--
ALTER TABLE `stream`
  MODIFY `Stream_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `year`
--
ALTER TABLE `year`
  MODIFY `Year_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
