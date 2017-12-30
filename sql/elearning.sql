-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2017 at 02:33 PM
-- Server version: 5.5.57-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer_essay`
--

CREATE TABLE IF NOT EXISTS `answer_essay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_number` int(11) NOT NULL,
  `score_essay` int(11) NOT NULL,
  `answer` text NOT NULL,
  `id_attempt_quiz` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `answer_essay_atempt_quiz` (`id_attempt_quiz`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `answer_essay`
--

INSERT INTO `answer_essay` (`id`, `question_number`, `score_essay`, `answer`, `id_attempt_quiz`) VALUES
(6, 1, 50, 'ssss', 6),
(7, 2, 29, 'ssss', 6),
(17, 1, 71, 'adfadfasdf', 7),
(26, 1, 0, '', 8),
(27, 2, 0, '', 8),
(28, 1, 0, 'Test Answer 1', 12),
(29, 2, 0, 'Test Answer 1', 12),
(30, 3, 0, 'Test Answer 1', 12),
(43, 1, 0, 'injury 1', 13),
(44, 2, 0, 'injury 2', 13),
(45, 3, 0, 'injury 3', 13),
(46, 4, 0, '', 13);

-- --------------------------------------------------------

--
-- Table structure for table `answer_mc`
--

CREATE TABLE IF NOT EXISTS `answer_mc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_number` int(11) NOT NULL,
  `answer` text NOT NULL,
  `id_attempt_quiz` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `answer_mc_attempt_quiz` (`id_attempt_quiz`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=74 ;

--
-- Dumping data for table `answer_mc`
--

INSERT INTO `answer_mc` (`id`, `question_number`, `answer`, `id_attempt_quiz`) VALUES
(1, 1, 'b', 7),
(6, 1, '', 8),
(7, 2, '', 8),
(8, 1, 'b', 6),
(9, 2, 'c', 6),
(10, 3, '', 6),
(67, 1, 'c', 10),
(68, 2, 'a', 10),
(69, 3, 'a', 10),
(70, 4, 'c', 10),
(71, 1, 'b', 14),
(72, 2, 'a', 14),
(73, 3, 'c', 14);

-- --------------------------------------------------------

--
-- Table structure for table `answer_tf`
--

CREATE TABLE IF NOT EXISTS `answer_tf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_number` int(11) NOT NULL,
  `answer` text NOT NULL,
  `id_attempt_quiz` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `answer_tf_attempt_quiz` (`id_attempt_quiz`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `answer_tf`
--

INSERT INTO `answer_tf` (`id`, `question_number`, `answer`, `id_attempt_quiz`) VALUES
(19, 1, '', 9),
(20, 2, '', 9),
(21, 1, '', 8),
(22, 2, '', 8),
(63, 1, 't', 10),
(64, 2, 'f', 10),
(65, 3, 'f', 10),
(66, 4, 't', 10),
(67, 1, 't', 11),
(68, 2, 'f', 11),
(69, 3, 't', 11),
(70, 4, 'f', 11);

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE IF NOT EXISTS `assignment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `md5_filename` text NOT NULL,
  `assignment_note` text NOT NULL,
  `date_started` date NOT NULL,
  `date_ended` date NOT NULL,
  `class_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `assignment_user` (`user_id`),
  KEY `assignment_class` (`class_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`id`, `user_id`, `file_name`, `md5_filename`, `assignment_note`, `date_started`, `date_ended`, `class_id`) VALUES
(1, 2, 'Testing Assignment HK5.pdf', 'ec9d527d2c536500de4d926cb1aa0cce', '1', '2017-11-09', '2017-11-11', 9),
(10, 2, 'GEN_1_2_asignment.pdf', '4a26611f54b74f33abb14fcc0b42d572', 'Assignment Title: Testing Update Note', '2017-11-12', '2017-11-16', 1),
(11, 2, 'GEN_1_2_tes_hube.docx', '9b8ae8ffe1ca0086353f53f1ddafc751', 'note note note note note note note', '2017-11-11', '2017-11-13', 1),
(12, 2, 'GEN_1_2_Testing Assignment.pdf', '74056e5365e1c9388dfde60d61c3cd78', '3', '2017-11-12', '2017-11-30', 1),
(13, 2, 'GEN_1_2_Test Date Range.pdf', 'e6ca1e8af7eb41f9ee52269711b19e6f', '4', '2017-11-09', '2017-11-10', 1),
(14, 2, 'TB_25_2_TB 25 Assignment.pdf', 'f7e75e1f6764492b83e42afb4dc788b9', '1', '2017-11-09', '2017-11-17', 25),
(15, 2, 'GEN_1_2_Test explode.pdf', '63852c46fa361749bb38c9288836299b', '5', '2017-11-15', '2017-11-18', 1),
(16, 2, 'GEN_1_2_dari Hube.docx', 'a0f8281638172ac3ec227d2e55742894', 'bebasss', '2017-11-21', '2017-11-25', 1),
(17, 2, 'UMUM_19_2_Assignment 1.pdf', '313d13819742871cbf590b4509b2dce3', 'Nothing', '2017-11-30', '2017-12-01', 19),
(18, 2, 'UMUM_19_2_Assignment 2.pdf', '1b736386116a7d848786ae2a98894652', 'Nothing', '2017-11-30', '2017-12-01', 19),
(19, 2, 'UMUM_19_2_Assignment 3.pdf', '093aa77c031feeea3868cc432993a583', 'Nothing', '2017-11-30', '2017-12-01', 19);

-- --------------------------------------------------------

--
-- Table structure for table `assignment_submitted`
--

CREATE TABLE IF NOT EXISTS `assignment_submitted` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assignment_id` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `md5_filename` text NOT NULL,
  `date_uploaded` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `assignment_submitted_user` (`user_id`),
  KEY `assignment_submitted_assignment_id` (`assignment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `assignment_submitted`
--

INSERT INTO `assignment_submitted` (`id`, `assignment_id`, `file_name`, `md5_filename`, `date_uploaded`, `user_id`, `score`) VALUES
(6, 10, 'GEN_1_4_asda as.doc', '756da3ecd8fb99482a36d8513967380b', '2017-11-08', 4, 50),
(7, 10, 'GEN_1_3_tes dari hube.docx', 'f8d6eed26c21b25d5691c1621f1de442', '2017-11-15', 3, 0),
(8, 11, 'GEN_1_3_Assignment 1.pdf', '301bad11564dab41f1bdaccd6cfcaa60', '2017-11-17', 3, 0),
(10, 13, 'GEN_1_3_Assignment 4.pdf', '178dddb78649437edae0a437bba04077', '2017-11-20', 3, 0),
(11, 14, 'TB_25_3_Anjasd.pdf', '7aa26b697a99fc5e02972503c5cb208d', '2017-11-15', 3, 0),
(12, 12, 'GEN_1_3_Testing.pdf', '9d135c2a136eb588b066f7c50b32d565', '2017-11-21', 3, 0),
(13, 17, 'UMUM_19_3_nothing.pdf', '648645d7a4437b0a8817d4ac707d593a', '2017-11-30', 3, 0),
(14, 18, 'UMUM_19_3_nothing 1.pdf', '220681b04709c9464d2a24dd8df5a1cf', '2017-11-30', 3, 0),
(15, 19, 'UMUM_19_3_nothing 3.pdf', '58f1bb48c60f29b4ee2cdcdace4f9e8b', '2017-11-30', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `attempt_quiz`
--

CREATE TABLE IF NOT EXISTS `attempt_quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_quiz` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `attempt` int(11) NOT NULL,
  `is_scored` int(11) NOT NULL,
  `is_submit` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `attempt_quiz_quiz` (`id_quiz`),
  KEY `attempt_quiz_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `attempt_quiz`
--

INSERT INTO `attempt_quiz` (`id`, `id_quiz`, `id_user`, `attempt`, `is_scored`, `is_submit`, `duration`) VALUES
(1, 15, 3, 1, 0, 0, 60),
(3, 15, 4, 1, 0, 0, 30),
(4, 16, 3, 1, 0, 0, 23),
(5, 18, 3, 1, 0, 0, 16),
(6, 20, 3, 1, 0, 0, 20),
(7, 22, 3, 1, 0, 0, 15),
(8, 28, 3, 1, 0, 0, 60),
(9, 29, 3, 1, 0, 0, 60),
(10, 30, 3, 1, 0, 0, 49),
(11, 32, 3, 1, 0, 0, 60),
(12, 33, 3, 1, 0, 0, 13),
(13, 34, 3, 1, 0, 0, 5),
(14, 35, 3, 1, 0, 0, 15);

-- --------------------------------------------------------

--
-- Table structure for table `badges`
--

CREATE TABLE IF NOT EXISTS `badges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `type_badges` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `badges_user` (`user_id`),
  KEY `badges_class` (`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_enroll` int(11) NOT NULL,
  `class_name` varchar(50) NOT NULL,
  `enroll_key` varchar(6) NOT NULL,
  `id_user` int(11) NOT NULL,
  `monarch` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `class_enroll` (`id_enroll`),
  KEY `class_users` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `id_enroll`, `class_name`, `enroll_key`, `id_user`, `monarch`) VALUES
(1, 1, 'GEN_1', '135423', 2, '01'),
(2, 6, 'HK_2', '554433', 1, '01'),
(6, 1, 'GEN_6', '124354', 1, '01'),
(9, 6, 'HK_9', '321243', 2, '01'),
(11, 1, 'GEN_11', '765432', 2, '01'),
(15, 1, 'GEN_15', '654587', 2, '01'),
(16, 1, 'GEN_16', '894376', 2, '01'),
(17, 6, 'HK_17', '127645', 2, '01'),
(18, 7, 'TB_18', '542134', 2, '01'),
(19, 9, 'UMUM_19', '654576', 2, '01'),
(20, 1, 'GEN_20', '874565', 2, '01'),
(25, 7, 'TB_25', '124354', 2, '01'),
(26, 1, 'GEN_26', '875676', 2, '01'),
(27, 1, 'GEN_27', '644381', 2, '01'),
(28, 7, 'TB_28', '765116', 2, '01');

-- --------------------------------------------------------

--
-- Table structure for table `comment_assignment`
--

CREATE TABLE IF NOT EXISTS `comment_assignment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `comment_assignment_user` (`user_id`),
  KEY `comment_assignment_class` (`class_id`),
  KEY `comment_assignment_assignment` (`assignment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comment_quiz`
--

CREATE TABLE IF NOT EXISTS `comment_quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `comment_quiz_user` (`user_id`),
  KEY `comment_quiz_class` (`class_id`),
  KEY `comment_quiz_quiz` (`quiz_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comment_tb`
--

CREATE TABLE IF NOT EXISTS `comment_tb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_posts` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `coment_users` (`id_user`),
  KEY `coment_posts` (`id_posts`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `comment_tb`
--

INSERT INTO `comment_tb` (`id`, `description`, `id_user`, `id_posts`, `date_created`) VALUES
(4, 'Ok komen 5', 2, 5, '2017-10-24 04:35:28'),
(5, 'Ok komen 4', 2, 4, '2017-10-24 04:38:41'),
(7, 'Ok hk5', 2, 7, '2017-10-25 03:53:48'),
(8, 'testing count coment', 2, 12, '2017-10-27 04:27:27'),
(9, 'Testing comment count gen 1', 2, 14, '2017-10-27 04:32:55'),
(10, 'Testing comment gen 1 again count this fuck up', 2, 14, '2017-10-27 04:34:35'),
(11, 'test coment', 2, 14, '2017-10-27 04:41:57'),
(13, 'Comment Comment asfddfd', 2, 14, '2017-10-28 07:08:47'),
(16, 'comment', 2, 14, '2017-10-29 05:14:58'),
(17, 'test student comment', 3, 17, '2017-10-30 08:45:07'),
(18, 'student coment', 3, 17, '2017-10-30 08:45:53'),
(19, 'testing comment', 2, 17, '2017-10-30 08:52:41'),
(21, 'adf', 3, 17, '2017-10-30 09:40:10'),
(23, 'asdf', 3, 17, '2017-10-30 09:41:06'),
(27, 'testing coment', 3, 17, '2017-10-30 02:10:48'),
(28, 'tes dari hube', 2, 17, '2017-11-02 01:21:50'),
(29, 'tes', 2, 17, '2017-11-02 01:24:20'),
(31, 'yeah', 2, 1, '2017-11-05 22:53:53'),
(32, 'comment id 11', 2, 23, '2017-11-15 11:26:07'),
(33, 'comment id 15', 2, 22, '2017-11-15 11:26:28'),
(34, 'comment id 1', 2, 21, '2017-11-15 11:26:45'),
(35, 'Test student comment id 1', 3, 21, '2017-11-19 20:48:58'),
(36, 'Test comment', 3, 26, '2017-12-05 15:14:54');

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE IF NOT EXISTS `enroll` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `username` varchar(200) NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `enroll`
--

INSERT INTO `enroll` (`id`, `code`, `password`, `username`, `date_created`) VALUES
(1, 'GEN', '12345', 'anjas', '0000-00-00 00:00:00'),
(6, 'HK', '12345', 'hubert', '2017-07-20 08:33:36'),
(7, 'TB', '12345', 'hubert', '2017-07-20 08:33:46'),
(8, 'TH', '12345', 'hubert', '2017-07-20 08:33:56'),
(9, 'UMUM', '12345', 'hubert', '2017-07-20 08:34:05');

-- --------------------------------------------------------

--
-- Table structure for table `enrolled_user`
--

CREATE TABLE IF NOT EXISTS `enrolled_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_enroll` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `id_class` int(11) NOT NULL,
  `monarch` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `enrolled_user_users` (`id_user`),
  KEY `enrolled_user_enroll` (`id_enroll`),
  KEY `enrolled_user_class` (`id_class`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `enrolled_user`
--

INSERT INTO `enrolled_user` (`id`, `id_user`, `id_enroll`, `date_created`, `id_class`, `monarch`) VALUES
(1, 2, 1, '2017-07-21 08:38:56', 1, '01'),
(2, 1, 1, '2017-07-21 08:38:56', 6, '01'),
(3, 1, 6, '2017-07-21 08:38:56', 2, '01'),
(5, 2, 6, '2017-10-24 02:18:40', 9, '01'),
(10, 4, 6, '2017-10-26 10:47:22', 2, '01'),
(11, 3, 1, '2017-10-30 08:28:06', 1, '01'),
(13, 3, 6, '2017-10-30 08:28:43', 9, '01'),
(14, 4, 6, '2017-10-30 09:36:49', 9, '01'),
(15, 4, 1, '2017-11-06 14:43:57', 1, '01'),
(17, 2, 1, '2017-11-08 10:09:16', 11, '01'),
(18, 2, 1, '2017-11-08 10:18:41', 15, '01'),
(19, 2, 1, '2017-11-09 08:25:04', 16, '01'),
(20, 2, 6, '2017-11-09 08:27:10', 17, '01'),
(21, 2, 7, '2017-11-09 08:50:34', 18, '01'),
(22, 2, 9, '2017-11-09 09:00:20', 19, '01'),
(23, 2, 1, '2017-11-09 12:00:54', 20, '01'),
(28, 2, 7, '2017-11-09 17:07:39', 25, '01'),
(29, 3, 7, '2017-11-11 23:52:57', 25, '01'),
(30, 2, 1, '2017-11-16 09:33:16', 26, '01'),
(31, 3, 9, '2017-11-30 09:04:55', 19, '01'),
(32, 2, 1, '2017-12-07 14:07:07', 27, '01'),
(33, 2, 7, '2017-12-07 14:24:01', 28, '01');

-- --------------------------------------------------------

--
-- Table structure for table `general_material`
--

CREATE TABLE IF NOT EXISTS `general_material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `link` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `general_material_class` (`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `learning_source`
--

CREATE TABLE IF NOT EXISTS `learning_source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `link` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `learning_source_class` (`class_id`),
  KEY `learning_source_user` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `learning_source`
--

INSERT INTO `learning_source` (`id`, `class_id`, `user_id`, `title`, `link`) VALUES
(2, 1, 2, 'Testing Upload', 'https://drive.google.com/file/d/0BxlR4U5ZJYkTWnMzTWRuYlRQUlU/view?usp=sharing'),
(3, 1, 2, 'Testing upload 1', 'https://drive.google.com/file/d/0B8RF0YDPWVK6ZENNQVctejk0QWs/view?usp=sharing');

-- --------------------------------------------------------

--
-- Table structure for table `mc_quiz`
--

CREATE TABLE IF NOT EXISTS `mc_quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_qa_mc_quiz` int(11) NOT NULL,
  `answer_a` text NOT NULL,
  `answer_b` text NOT NULL,
  `answer_c` text NOT NULL,
  `answer_d` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mc_quiz_qa_mc_quiz` (`id_qa_mc_quiz`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `mc_quiz`
--

INSERT INTO `mc_quiz` (`id`, `id_qa_mc_quiz`, `answer_a`, `answer_b`, `answer_c`, `answer_d`) VALUES
(4, 7, 'q1 A', 'q1 B', 'q1 C', 'q1D'),
(6, 9, 'asd', 'asd', 'adad', 'asda'),
(7, 10, 'asda', 'sadad', 'asda', 'asda'),
(10, 13, 'adas', 'ads', 'adasw', 'asdsa'),
(11, 14, 'qa1', 'qb1', 'qc1', 'qd1'),
(12, 15, 'qa1', 'qa2', 'qa3', 'qa4'),
(13, 16, 'qa1', 'qb1', 'qc1', 'qd1'),
(14, 17, 'ada', 'sda', 'sdad', 'dasdad'),
(23, 26, 'adada', 'aadad', 'adadadada', 'adad'),
(24, 27, 'afsfsfs', 'sffsfsf', 'sfdsfsf', 'sfdfdf'),
(25, 28, 'sadad', 'asdad', 'adad', 'adad'),
(26, 29, 'cxvxvxv', 'wqeqe', 'gfhfh', 'adwda'),
(27, 30, 'fsfsfsdfes', 'ghfhfh', 'zxcxzcc', 'uiuiu'),
(28, 31, 'bvnb bngng', 'cvcd fvcbc', 'xbbfbdd', 'xvxergf'),
(31, 34, 'asdsfsscsc', 'sfaerfsf', 'sdffasfs', 'sdfaereeffas'),
(32, 35, 'sadad', 'asdad', 'sdasfsasf', 'sadfdssdff'),
(39, 42, 'asdada dawewere', 'akljdkajdka awnkad', 'kjkfjwiurw tiwtuiw', 'khakdjhy kjafuahkfa'),
(40, 43, 'jhdkajdja jakdla', 'jkad wnda kawmdka', 'jkadwji andam damwdakm amdn', 'jhsysief isyen vmigjo sufis'),
(41, 44, 'q1 A', 'q1 B', 'q1 C', 'q1 D'),
(42, 45, 'q2 A', 'q2 B', 'q2 C', 'q2 D'),
(43, 46, 'q3 A', 'q3 B', 'q3 C', 'q3 D'),
(48, 51, 'tes 1 a', 'tes 1 b', 'tes 1 c', 'tes 1 d'),
(49, 52, 'tes 2 a', 'tes 2 b', 'tes 2 c', 'tes 2 d'),
(50, 53, 'tes 3 a', 'tes 3 b', 'tes 3 c', 'tes 3 d'),
(51, 54, 'tes 4 a', 'tes 4 b', 'tes 4 c', 'tes 4 d'),
(52, 55, 'fd', 'd', 'df', 'fdf'),
(53, 56, 'fsd', 'fdf', 'df', 'f'),
(54, 57, 'dsfds', 'dfd', 'dfds', 'df');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_class` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `description` text NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_class` (`id_class`),
  KEY `post_users` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `id_class`, `id_user`, `description`, `date_created`) VALUES
(1, 1, 1, 'Testing Post', '2017-10-20 00:00:00'),
(2, 1, 2, '<h1>Hello world!</h1>', '2017-10-22 11:10:22'),
(4, 1, 2, '<h1>Hello world!</h1>', '2017-10-22 11:27:02'),
(5, 1, 2, '<h1>Hello world!</h1>', '2017-10-23 08:18:52'),
(7, 9, 2, '<h1>Hello world!</h1>', '2017-10-25 03:52:39'),
(8, 1, 2, '<p>Testing Body</p>\n', '2017-10-27 04:09:12'),
(9, 1, 2, '<p>Gen1 Testing Post</p>\n', '2017-10-27 04:10:42'),
(10, 9, 2, '<p>HK5 Testing Post 1</p>\n', '2017-10-27 04:12:07'),
(11, 9, 2, '<p>Testing Post HK5</p>\n', '2017-10-27 04:13:14'),
(12, 9, 2, '<p>Testing HK5 post 2 statistic</p>\n', '2017-10-27 04:19:30'),
(13, 1, 2, '<p>Testing post gen1 post 1</p>\n', '2017-10-27 04:20:26'),
(14, 1, 2, '<p>Create first row class gen1</p>\n', '2017-10-27 04:21:19'),
(17, 1, 2, '<p>testing count</p>\n', '2017-10-29 05:15:53'),
(19, 1, 2, '<p>Tolong kerjakan tugas halam 12</p>\n', '2017-11-08 10:10:34'),
(20, 1, 2, '<p>Testing get class id</p>\n', '2017-11-15 10:58:13'),
(21, 1, 2, '<p>Testing without choose class</p>\n', '2017-11-15 11:02:59'),
(22, 15, 2, '<p>Test id 15</p>\n', '2017-11-15 11:22:33'),
(23, 11, 2, '<p>test id 11</p>\n', '2017-11-15 11:22:50'),
(25, 1, 2, '<p>adasda</p>\n', '2017-11-15 16:57:49'),
(26, 1, 2, '<p>dwdwsds</p>\n', '2017-12-05 15:01:31'),
(27, 27, 2, '<p>sdscdvfdv</p>', '2017-12-07 14:07:59');

-- --------------------------------------------------------

--
-- Table structure for table `qa_essay_quiz`
--

CREATE TABLE IF NOT EXISTS `qa_essay_quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_quiz` int(11) NOT NULL,
  `question_number` int(11) NOT NULL,
  `question_essay` text NOT NULL,
  `answer_essay` text NOT NULL,
  `max_essay_score` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `qa_essay_quiz` (`id_quiz`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `qa_essay_quiz`
--

INSERT INTO `qa_essay_quiz` (`id`, `id_quiz`, `question_number`, `question_essay`, `answer_essay`, `max_essay_score`) VALUES
(2, 10, 1, 'Essay 1', 'Answer Essay 1', 100),
(4, 13, 1, 'qeqwde', 'qeqe', 100),
(11, 21, 1, 'sdgdsgdgd', 'dgdgdgd', 100),
(12, 22, 1, 'essay', 'answer', 100),
(13, 20, 1, 'zczs dfsvx', 'zsvsv zvsv', 70),
(14, 20, 2, 'zvsvs sfeegt', 'vzdvzeg', 30),
(17, 27, 1, 'asdd sadadud', 'bha dwhgey4', 70),
(18, 27, 2, 'hbhasbdba wabhjdek', 'hbhajbd eghfw', 30),
(19, 25, 1, 'asdsfersfdsc', 'asfsfsfs', 45),
(20, 25, 2, 'asdfefsdc', 'asfadwda', 55),
(27, 28, 1, 'question essay 1 tf', 'answer 1 tf', 30),
(28, 28, 2, 'question essay 2 tf', 'answer essay 2 tf', 70),
(29, 8, 1, 'Question Essay 1', 'Answer Essay 1', 100),
(33, 33, 1, 'asfdsgdf', 'sthtgh', 50),
(34, 33, 2, 'wsdwd', 'wdwds', 30),
(35, 33, 3, 'fdesfds', 'swdscddddddddddddd', 20),
(36, 34, 1, 'fgfh', 'ffgf', 30),
(37, 34, 2, 'gftfg', 'fdfr', 20),
(38, 34, 3, 'drfrdeg', 'rgreg', 25),
(39, 34, 4, 'rgre', 'rfref', 25);

-- --------------------------------------------------------

--
-- Table structure for table `qa_mc_quiz`
--

CREATE TABLE IF NOT EXISTS `qa_mc_quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_quiz` int(11) NOT NULL,
  `question_number` int(11) NOT NULL,
  `question_mc` text NOT NULL,
  `answer_mc` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `qa_mc_quiz_quiz` (`id_quiz`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `qa_mc_quiz`
--

INSERT INTO `qa_mc_quiz` (`id`, `id_quiz`, `question_number`, `question_mc`, `answer_mc`) VALUES
(7, 10, 1, 'Question1', 'c'),
(9, 12, 1, 'ada', 'b'),
(10, 13, 1, 'testing', 'b'),
(13, 15, 1, 'asdf', 'a'),
(14, 16, 1, 'Testing on time', 'a'),
(15, 17, 1, 'Testing quiz before time', 'b'),
(16, 18, 1, 'hk5 on time testing 2', 'a'),
(17, 19, 1, 'asdf', 'a'),
(26, 21, 1, 'adada', 'a'),
(27, 21, 2, 'fafsfs', 'b'),
(28, 22, 1, 'asdad', 'b'),
(29, 20, 1, 'asdaad', 'b'),
(30, 20, 2, 'sadafef', 'c'),
(31, 20, 3, 'ada dfdgd', 'd'),
(34, 27, 1, 'addwwd', 'b'),
(35, 25, 1, 'anjsa;da', 'b'),
(42, 28, 1, 'asdad adwwes', 'b'),
(43, 28, 2, 'question 2', 'c'),
(44, 8, 1, 'Question Nomer 1', 'd'),
(45, 8, 2, 'Question Number 2', 'c'),
(46, 8, 3, 'Question Number 3', 'b'),
(51, 30, 1, 'test 1', 'a'),
(52, 30, 2, 'tes 2', 'b'),
(53, 30, 3, 'test 3', 'c'),
(54, 30, 4, 'test 4', 'd'),
(55, 35, 1, 'dfgfg', 'c'),
(56, 35, 2, 'dfdsf', 'c'),
(57, 35, 3, 'dfdsf', 'c');

-- --------------------------------------------------------

--
-- Table structure for table `qa_tf_quiz`
--

CREATE TABLE IF NOT EXISTS `qa_tf_quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_quiz` int(11) NOT NULL,
  `question_number` int(11) NOT NULL,
  `question_tf` text NOT NULL,
  `answer_tf` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `qa_tf_quiz_quiz` (`id_quiz`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `qa_tf_quiz`
--

INSERT INTO `qa_tf_quiz` (`id`, `id_quiz`, `question_number`, `question_tf`, `answer_tf`) VALUES
(9, 28, 1, 'True False 1 update', 'f'),
(10, 28, 2, 'True False 2 update', 'f'),
(11, 29, 1, 'True true true', 't'),
(12, 29, 2, 'False false false', 'f'),
(13, 8, 1, 'true false true', 't'),
(14, 8, 2, 'false true false', 'f'),
(15, 30, 1, 'true true true 1', 't'),
(16, 30, 2, 'true true false 2', 'f'),
(17, 30, 3, 'true true false false 3', 't'),
(18, 30, 4, 'true false true false', 'f'),
(19, 31, 1, 'fhghjk,nj', 't'),
(20, 31, 2, 'hjtgyuhgb', 'f'),
(21, 31, 3, 'jhjhkjk', 'f'),
(22, 31, 4, 'ghkjn,m', 't'),
(23, 32, 1, 'cdfgfhng', 't'),
(24, 32, 2, 'fgrfghf', 'f'),
(25, 32, 3, 'dtgrhgth', 'f'),
(26, 32, 4, 'hgrgrfgv', 't');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE IF NOT EXISTS `quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_class` int(11) NOT NULL,
  `quiz_name` text NOT NULL,
  `duration` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_started` date NOT NULL,
  `date_ended` date NOT NULL,
  `monarch` varchar(5) NOT NULL,
  `total_question_tf` int(11) NOT NULL,
  `total_question_mc` int(11) NOT NULL,
  `total_question_essay` int(11) NOT NULL,
  `attempt` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `quiz_user` (`id_user`),
  KEY `quiz_class` (`id_class`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `id_user`, `id_class`, `quiz_name`, `duration`, `date_created`, `date_started`, `date_ended`, `monarch`, `total_question_tf`, `total_question_mc`, `total_question_essay`, `attempt`) VALUES
(8, 2, 1, 'Testing Quiz', 59, '2017-10-20 01:45:58', '2017-10-09', '2017-10-12', '01', 2, 3, 1, 4),
(10, 2, 1, 'testing Quiz 10', 600000, '2017-10-23 11:26:07', '2017-10-09', '2017-10-12', '01', 0, 1, 1, 3),
(12, 2, 1, 'Testing', 600000, '2017-10-23 02:14:52', '2017-10-09', '2017-10-12', '01', 0, 1, 0, 3),
(13, 2, 1, 'Test', 600000, '2017-10-23 02:31:16', '2017-10-09', '2017-10-12', '01', 0, 1, 1, 3),
(15, 2, 9, 'testing hk 5 new', 600000, '2017-10-30 08:38:13', '2017-11-05', '2017-11-08', '01', 0, 1, 0, 3),
(16, 2, 9, 'Quiz on time', 600000, '2017-10-30 10:28:06', '2017-10-30', '2017-11-08', '01', 0, 1, 0, 3),
(17, 2, 9, 'Quiz before time', 600000, '2017-10-30 10:30:59', '2017-10-25', '2017-10-29', '01', 0, 1, 0, 3),
(18, 2, 9, 'hk 5 on time 2', 600000, '2017-10-30 10:33:06', '2017-10-25', '2017-10-30', '01', 0, 1, 0, 3),
(19, 2, 9, 'hk5 last day', 600000, '2017-10-30 10:35:12', '2017-10-31', '2017-11-05', '01', 0, 1, 0, 3),
(20, 2, 1, 'tes dari hube sudah diganti', 57, '2017-11-03 09:20:02', '2017-11-07', '2017-11-30', '01', 0, 3, 2, 2),
(21, 2, 1, 'Testing Create', 65, '2017-11-08 14:27:22', '2017-11-08', '2017-11-16', '01', 0, 2, 1, 3),
(22, 2, 1, 'Test attempt inpt', 60, '2017-11-09 09:33:26', '2017-11-09', '2017-11-11', '01', 0, 1, 1, 5),
(25, 2, 1, 'Test score essay', 60, '2017-11-12 23:41:16', '2017-11-12', '2017-11-15', '01', 0, 1, 2, 3),
(27, 2, 1, 'Test score essay again', 60, '2017-11-12 23:54:13', '2017-11-12', '2017-11-17', '01', 0, 1, 2, 3),
(28, 2, 1, 'Test true false quiz', 36, '2017-11-13 15:02:44', '2017-11-13', '2017-11-24', '01', 2, 2, 2, 4),
(29, 2, 1, 'Test get class id', 60, '2017-11-15 21:51:09', '2017-11-15', '2017-11-30', '01', 2, 0, 0, 3),
(30, 2, 1, 'Test Answer Quiz', 60, '2017-11-22 21:52:34', '2017-11-22', '2017-11-30', '01', 4, 4, 0, 5),
(31, 2, 19, '', 30, '2017-12-05 14:32:22', '2017-11-07', '2017-11-17', '01', 4, 0, 0, 2),
(32, 2, 1, 'Quiz 1', 60, '2017-12-05 14:34:32', '2017-12-05', '2017-12-31', '01', 4, 0, 0, 3),
(33, 2, 1, '1', 20, '2017-12-05 14:49:49', '2017-12-05', '2017-12-31', '01', 0, 0, 3, 3),
(34, 2, 1, '123', 60, '2017-12-07 14:39:51', '2017-12-07', '2017-12-31', '01', 0, 0, 4, 3),
(35, 2, 1, 'ABC', 15, '2017-12-07 14:42:21', '2017-12-07', '2017-12-31', '01', 0, 3, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rating_user` (`user_id`),
  KEY `rating_class` (`class_id`),
  KEY `rating_created` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `score_quiz`
--

CREATE TABLE IF NOT EXISTS `score_quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_attempt_quiz` int(11) NOT NULL,
  `score_mc` int(11) NOT NULL,
  `score_essay` int(11) NOT NULL,
  `score_tf` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `score_quiz_attempt_quiz` (`id_attempt_quiz`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `score_quiz`
--

INSERT INTO `score_quiz` (`id`, `id_attempt_quiz`, `score_mc`, `score_essay`, `score_tf`) VALUES
(1, 1, 0, 0, 0),
(3, 3, 100, 0, 0),
(4, 6, 67, 79, 0),
(5, 7, 100, 71, 0),
(6, 8, 0, 0, 0),
(7, 9, 0, 0, 0),
(8, 10, 0, 0, 50),
(9, 11, 0, 0, 50),
(10, 12, 0, 15, 0),
(11, 13, 0, 0, 0),
(12, 14, 33, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `statistic`
--

CREATE TABLE IF NOT EXISTS `statistic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `total_post` int(11) NOT NULL,
  `total_comment` int(11) NOT NULL,
  `total_upload` int(11) NOT NULL,
  `total_download` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `statistic_user` (`user_id`),
  KEY `statistic_class` (`class_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `statistic`
--

INSERT INTO `statistic` (`id`, `user_id`, `class_id`, `total_post`, `total_comment`, `total_upload`, `total_download`) VALUES
(1, 2, 9, 2, 0, 0, 1),
(2, 2, 1, 9, 8, 2, 22),
(4, 3, 1, 0, 7, 0, 8),
(6, 3, 25, 0, 0, 0, 1),
(7, 2, 15, 1, 1, 0, 0),
(8, 2, 11, 1, 1, 0, 0),
(9, 2, 25, 0, 0, 1, 0),
(10, 2, 19, 0, 0, 0, 3),
(11, 3, 19, 0, 0, 2, 1),
(12, 2, 27, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `name` varchar(150) NOT NULL,
  `password` text NOT NULL,
  `level` varchar(2) NOT NULL,
  `tahun_aka` varchar(20) NOT NULL,
  `monarch` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `password`, `level`, `tahun_aka`, `monarch`) VALUES
(1, 'hubert', 'Hubertus Putu ', 'c79c6f489015e0bc97f892e357db7156', '1', '', '01'),
(2, 'anjas', 'Oka Anjas', '899445f7e032b2f3e89ba4a03c666764', '1', '', '01'),
(3, 'student', 'Testing Student', 'cd73502828457d15655bbd7a63fb0bc8', '2', '', '01'),
(4, 'student1', 'Student 1', 'cd73502828457d15655bbd7a63fb0bc8', '2', '', '01');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer_essay`
--
ALTER TABLE `answer_essay`
  ADD CONSTRAINT `answer_essay_atempt_quiz` FOREIGN KEY (`id_attempt_quiz`) REFERENCES `attempt_quiz` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `answer_mc`
--
ALTER TABLE `answer_mc`
  ADD CONSTRAINT `answer_mc_attempt_quiz` FOREIGN KEY (`id_attempt_quiz`) REFERENCES `attempt_quiz` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `answer_tf`
--
ALTER TABLE `answer_tf`
  ADD CONSTRAINT `answer_tf_attempt_quiz` FOREIGN KEY (`id_attempt_quiz`) REFERENCES `attempt_quiz` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `assignment_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assignment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `assignment_submitted`
--
ALTER TABLE `assignment_submitted`
  ADD CONSTRAINT `assignment_submitted_assignment_id` FOREIGN KEY (`assignment_id`) REFERENCES `assignment` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assignment_submitted_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attempt_quiz`
--
ALTER TABLE `attempt_quiz`
  ADD CONSTRAINT `attempt_quiz_quiz` FOREIGN KEY (`id_quiz`) REFERENCES `quiz` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attempt_quiz_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `badges`
--
ALTER TABLE `badges`
  ADD CONSTRAINT `badges_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `badges_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_enroll` FOREIGN KEY (`id_enroll`) REFERENCES `enroll` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `class_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comment_assignment`
--
ALTER TABLE `comment_assignment`
  ADD CONSTRAINT `comment_assignment_assignment` FOREIGN KEY (`assignment_id`) REFERENCES `assignment` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_assignment_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_assignment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comment_quiz`
--
ALTER TABLE `comment_quiz`
  ADD CONSTRAINT `comment_quiz_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_quiz_quiz` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_quiz_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comment_tb`
--
ALTER TABLE `comment_tb`
  ADD CONSTRAINT `coment_posts` FOREIGN KEY (`id_posts`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coment_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `enrolled_user`
--
ALTER TABLE `enrolled_user`
  ADD CONSTRAINT `enrolled_user_class` FOREIGN KEY (`id_class`) REFERENCES `class` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrolled_user_enroll` FOREIGN KEY (`id_enroll`) REFERENCES `enroll` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrolled_user_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `general_material`
--
ALTER TABLE `general_material`
  ADD CONSTRAINT `general_material_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `learning_source`
--
ALTER TABLE `learning_source`
  ADD CONSTRAINT `learning_source_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `learning_source_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mc_quiz`
--
ALTER TABLE `mc_quiz`
  ADD CONSTRAINT `mc_quiz_qa_mc_quiz` FOREIGN KEY (`id_qa_mc_quiz`) REFERENCES `qa_mc_quiz` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `post_class` FOREIGN KEY (`id_class`) REFERENCES `class` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `qa_essay_quiz`
--
ALTER TABLE `qa_essay_quiz`
  ADD CONSTRAINT `qa_essay_quiz` FOREIGN KEY (`id_quiz`) REFERENCES `quiz` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `qa_mc_quiz`
--
ALTER TABLE `qa_mc_quiz`
  ADD CONSTRAINT `qa_mc_quiz_quiz` FOREIGN KEY (`id_quiz`) REFERENCES `quiz` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `qa_tf_quiz`
--
ALTER TABLE `qa_tf_quiz`
  ADD CONSTRAINT `qa_tf_quiz_quiz` FOREIGN KEY (`id_quiz`) REFERENCES `quiz` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `quiz_class` FOREIGN KEY (`id_class`) REFERENCES `class` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rating_created` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rating_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `score_quiz`
--
ALTER TABLE `score_quiz`
  ADD CONSTRAINT `score_quiz_attempt_quiz` FOREIGN KEY (`id_attempt_quiz`) REFERENCES `attempt_quiz` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `statistic`
--
ALTER TABLE `statistic`
  ADD CONSTRAINT `statistic_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `statistic_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
