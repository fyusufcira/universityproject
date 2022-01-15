-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2022 at 01:56 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(15) NOT NULL,
  `tel_number` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `user_name`, `first_name`, `last_name`, `age`, `email`, `password`, `tel_number`) VALUES
(1, 'admin1', 'gökberk', 'gündoğan', 21, 'gokberkgundogan@gmai', '123123', '05394083434');

-- --------------------------------------------------------

--
-- Table structure for table `consents`
--

CREATE TABLE `consents` (
  `consent_id` int(11) NOT NULL,
  `consent_course_id` int(11) NOT NULL,
  `consent_student_id` int(11) NOT NULL,
  `is_consented` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_description` varchar(100) NOT NULL,
  `course_quota` int(11) NOT NULL,
  `course_giver_id` int(11) DEFAULT NULL,
  `final_date` date NOT NULL,
  `is_consent_needed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_description`, `course_quota`, `course_giver_id`, `final_date`, `is_consent_needed`) VALUES
(7, 'MIS233', 'Coding html,css,js,php,jquery', 5, 2, '2022-01-14', 1),
(8, 'MIS112', 'Economics, starting level, learn how monopolies exist...', 5, 1, '2022-02-01', 1),
(28, 'MIS144', 'Mathematics, limit turev', 3, 7, '0000-00-00', 0),
(29, 'MIS251', 'Cyber Security', 5, 6, '0000-00-00', 0),
(31, 'TK221', 'Turkish', 5, 9, '0000-00-00', 0),
(32, 'CMPE101', 'Object Oriented Programming', 3, 8, '0000-00-00', 1),
(33, 'TK231', 'Advanced Turkish', 5, 1, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `course_consents`
--

CREATE TABLE `course_consents` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `is_consented` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_consents`
--

INSERT INTO `course_consents` (`id`, `course_id`, `student_id`, `is_consented`) VALUES
(56, 32, 21, 1),
(57, 7, 21, 1),
(59, 7, 22, 0),
(60, 7, 23, 0),
(61, 32, 23, 1),
(62, 8, 23, 0);

-- --------------------------------------------------------

--
-- Table structure for table `course_students`
--

CREATE TABLE `course_students` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `is_graded` int(11) NOT NULL,
  `grade` varchar(30) NOT NULL DEFAULT 'Not Submitted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_students`
--

INSERT INTO `course_students` (`id`, `course_id`, `student_id`, `is_graded`, `grade`) VALUES
(45, 28, 1, 1, 'Passed'),
(46, 29, 1, 1, 'Passed'),
(47, 31, 1, 1, 'Passed'),
(49, 29, 4, 1, 'Failed'),
(50, 31, 4, 1, 'Passed'),
(51, 33, 4, 1, 'Passed'),
(52, 28, 20, 0, 'Not Submitted'),
(53, 29, 20, 1, 'Failed'),
(55, 31, 21, 0, 'Not Submitted'),
(56, 29, 21, 1, 'Passed'),
(57, 33, 21, 1, 'Failed'),
(58, 29, 22, 0, 'Not Submitted'),
(59, 31, 22, 0, 'Not Submitted'),
(60, 31, 23, 1, 'Failed'),
(61, 33, 23, 1, 'Failed'),
(62, 7, 1, 0, 'Not Submitted'),
(63, 8, 1, 0, 'Not Submitted'),
(64, 33, 1, 0, 'Not Submitted'),
(65, 32, 4, 0, 'Not Submitted'),
(66, 7, 20, 0, 'Not Submitted'),
(67, 8, 20, 0, 'Not Submitted'),
(68, 32, 20, 0, 'Not Submitted'),
(69, 33, 20, 0, 'Not Submitted'),
(70, 28, 4, 0, 'Not Submitted');

-- --------------------------------------------------------

--
-- Table structure for table `professors`
--

CREATE TABLE `professors` (
  `professor_id` int(11) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(15) NOT NULL,
  `tel_number` varchar(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `professors`
--

INSERT INTO `professors` (`professor_id`, `user_name`, `first_name`, `last_name`, `age`, `email`, `password`, `tel_number`, `is_active`) VALUES
(1, 'prof1', 'barış', 'cankır', 21, 'cankir@gmail.com', '123123', '05324545113', 1),
(2, 'prof2', 'yusuf', 'çıra', 21, 'ysfcra@gmail.com', '123123', '12312312311', 1),
(6, 'alperenhoca', 'alperen', 'dönmez', 24, 'alperen@gmail.com', '123123', '05353533533', 1),
(7, 'gokce123', 'Gökçe', 'Kayıkçı', 21, 'gokce@boun.edu.tr', '123123', '5353332222', 1),
(8, 'gokceoglufurkan', 'Furkan', 'Gökçeoğlu', 21, 'furkan.gokceoglu@boun.edu.tr', '123123', '5353222411', 1),
(9, 'prof3', 'Ahmet', 'Mutlu', 35, 'ahmet@gmail.com', '123123', '5300110011', 1),
(13, 'yusuf123123', 'yusuf', 'selim', 24, 'yusuf@hotmail.com', '123123', '5300001122', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE `rules` (
  `id` int(11) NOT NULL,
  `min_password` int(11) NOT NULL,
  `max_password` int(11) NOT NULL,
  `max_course_system` int(11) NOT NULL,
  `max_course_student` int(11) NOT NULL,
  `max_course_professor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rules`
--

INSERT INTO `rules` (`id`, `min_password`, `max_password`, `max_course_system`, `max_course_student`, `max_course_professor`) VALUES
(1, 5, 20, 10, 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tel_number` varchar(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `user_name`, `first_name`, `last_name`, `age`, `email`, `password`, `tel_number`, `is_active`) VALUES
(1, 'student1', 'yusuf', 'çıra', 21, 'fyusufcira@gmail.com', '123123', '05300474877', 1),
(4, 'student2', 'mehmet berkay', 'özbay', 24, 'berkay@gmail.com', '123123', '5332122222', 1),
(19, 'ravzadogan123', 'Ravza', 'Doğan', 21, 'ravza@boun.edu.tr', '123132', '05312222244', 0),
(20, 'student3', 'Güray', 'Çıra', 53, 'ciraguray0@gmail.com', '123123', '5326314649', 1),
(21, 'student4', 'ayse', 'bodur', 53, 'ayse@gmail.com', '123123', '5300000000', 1),
(22, 'student5', 'mehmet', 'berkay', 21, 'mehmet@gmail.com', '123123', '5353331111', 1),
(23, 'student6', 'Kerem', 'Alkan', 20, 'kerem@gmail.com', '123123', '53002221111', 1),
(25, 'yunus123', 'yunus', 'özbay', 24, 'yunus@gmail.com', '123123', '5300112423', 0),
(26, 'studen7', 'eda', 'korkmaz', 21, 'eda@gmail.com', '123123', '533535353', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `consents`
--
ALTER TABLE `consents`
  ADD PRIMARY KEY (`consent_id`),
  ADD KEY `consent_course_id` (`consent_course_id`),
  ADD KEY `consent_student_id` (`consent_student_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `course_giver_id` (`course_giver_id`);

--
-- Indexes for table `course_consents`
--
ALTER TABLE `course_consents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `course_students`
--
ALTER TABLE `course_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `professors`
--
ALTER TABLE `professors`
  ADD PRIMARY KEY (`professor_id`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `consents`
--
ALTER TABLE `consents`
  MODIFY `consent_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `course_consents`
--
ALTER TABLE `course_consents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `course_students`
--
ALTER TABLE `course_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `professors`
--
ALTER TABLE `professors`
  MODIFY `professor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `rules`
--
ALTER TABLE `rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `consents`
--
ALTER TABLE `consents`
  ADD CONSTRAINT `consents_ibfk_1` FOREIGN KEY (`consent_student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `consents_ibfk_2` FOREIGN KEY (`consent_course_id`) REFERENCES `courses` (`course_id`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`course_giver_id`) REFERENCES `professors` (`professor_id`);

--
-- Constraints for table `course_consents`
--
ALTER TABLE `course_consents`
  ADD CONSTRAINT `course_consents_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `course_consents_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

--
-- Constraints for table `course_students`
--
ALTER TABLE `course_students`
  ADD CONSTRAINT `course_students_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `course_students_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
