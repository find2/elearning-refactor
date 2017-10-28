-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28 Okt 2017 pada 13.12
-- Versi Server: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `answer_essay`
--

CREATE TABLE `answer_essay` (
  `id` int(11) NOT NULL,
  `question_number` int(11) NOT NULL,
  `answer` text NOT NULL,
  `id_attempt_quiz` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `answer_essay`
--

INSERT INTO `answer_essay` (`id`, `question_number`, `answer`, `id_attempt_quiz`) VALUES
(1, 1, 'Testing quiz answer 1', 1),
(3, 1, 'Testing Answer Student quiz 5', 5),
(4, 1, 'Anjas Anjas', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `assignment`
--

CREATE TABLE `assignment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `attempt_quiz`
--

CREATE TABLE `attempt_quiz` (
  `id` int(11) NOT NULL,
  `id_quiz` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `attempt` int(11) NOT NULL,
  `is_Scored` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `attempt_quiz`
--

INSERT INTO `attempt_quiz` (`id`, `id_quiz`, `id_user`, `attempt`, `is_Scored`) VALUES
(1, 8, 3, 2, 0),
(3, 13, 3, 2, 0),
(4, 12, 3, 1, 0),
(5, 10, 3, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `badges`
--

CREATE TABLE `badges` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `type_badges` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `id_enroll` int(11) NOT NULL,
  `class_name` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL,
  `monarch` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `class`
--

INSERT INTO `class` (`id`, `id_enroll`, `class_name`, `id_user`, `monarch`) VALUES
(1, 1, 'GEN1', 2, '01'),
(2, 6, 'HK1', 1, '01'),
(6, 1, 'GEN2', 1, '01'),
(8, 1, 'GEN10', 2, '01'),
(9, 6, 'HK5', 2, '01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `comment_assignment`
--

CREATE TABLE `comment_assignment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `comment_quiz`
--

CREATE TABLE `comment_quiz` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `comment_tb`
--

CREATE TABLE `comment_tb` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_posts` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `comment_tb`
--

INSERT INTO `comment_tb` (`id`, `description`, `id_user`, `id_posts`, `date_created`) VALUES
(1, 'Testing komen', 3, 5, '2017-10-24 04:09:44'),
(2, 'Tes komen post d 4', 3, 4, '2017-10-24 04:11:53'),
(3, 'Test again 4', 3, 4, '2017-10-24 04:15:55'),
(4, 'Ok komen 5', 2, 5, '2017-10-24 04:35:28'),
(5, 'Ok komen 4', 2, 4, '2017-10-24 04:38:41'),
(7, 'Ok hk5', 2, 7, '2017-10-25 03:53:48'),
(8, 'testing count coment', 2, 12, '2017-10-27 04:27:27'),
(9, 'Testing comment count gen 1', 2, 14, '2017-10-27 04:32:55'),
(10, 'Testing comment gen 1 again count this fuck up', 2, 14, '2017-10-27 04:34:35'),
(11, 'test coment', 2, 14, '2017-10-27 04:41:57'),
(12, 'test comment hello', 2, 6, '2017-10-27 04:43:38'),
(13, 'Comment Comment asfddfd', 2, 14, '2017-10-28 07:08:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `enroll`
--

CREATE TABLE `enroll` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `username` varchar(200) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `enroll`
--

INSERT INTO `enroll` (`id`, `code`, `password`, `username`, `date_created`) VALUES
(1, 'GEN', '12345', 'anjas', '0000-00-00 00:00:00'),
(6, 'HK', '12345', 'hubert', '2017-07-20 08:33:36'),
(7, 'TB', '12345', 'hubert', '2017-07-20 08:33:46'),
(8, 'TH', '12345', 'hubert', '2017-07-20 08:33:56'),
(9, 'UMUM', '12345', 'hubert', '2017-07-20 08:34:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `enrolled_user`
--

CREATE TABLE `enrolled_user` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_enroll` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `id_class` int(11) NOT NULL,
  `monarch` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `enrolled_user`
--

INSERT INTO `enrolled_user` (`id`, `id_user`, `id_enroll`, `date_created`, `id_class`, `monarch`) VALUES
(1, 2, 1, '2017-07-21 08:38:56', 1, '01'),
(2, 1, 1, '2017-07-21 08:38:56', 6, '01'),
(3, 1, 6, '2017-07-21 08:38:56', 2, '01'),
(4, 2, 1, '2017-10-24 10:00:32', 8, '01'),
(5, 2, 6, '2017-10-24 02:18:40', 9, '01'),
(8, 3, 1, '2017-10-24 02:49:27', 1, '01'),
(10, 4, 6, '2017-10-26 10:47:22', 2, '01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mc_quiz`
--

CREATE TABLE `mc_quiz` (
  `id` int(11) NOT NULL,
  `id_qa_mc_quiz` int(11) NOT NULL,
  `answer_a` text NOT NULL,
  `answer_b` text NOT NULL,
  `answer_c` text NOT NULL,
  `answer_d` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `mc_quiz`
--

INSERT INTO `mc_quiz` (`id`, `id_qa_mc_quiz`, `answer_a`, `answer_b`, `answer_c`, `answer_d`) VALUES
(1, 4, 'q1 A', 'q1 B', 'q1 C', 'q1 D'),
(2, 5, 'q2 A', 'q2 B', 'q2 C', 'q2 D'),
(3, 6, 'q3 A', 'q3 B', 'q3 C', 'q3 D'),
(4, 7, 'q1 A', 'q1 B', 'q1 C', 'q1D'),
(6, 9, 'asd', 'asd', 'adad', 'asda'),
(7, 10, 'asda', 'sadad', 'asda', 'asda');

-- --------------------------------------------------------

--
-- Struktur dari tabel `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `id_class` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `description` text NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `posts`
--

INSERT INTO `posts` (`id`, `id_class`, `id_user`, `description`, `date_created`) VALUES
(1, 1, 1, 'Testing Post', '2017-10-20 00:00:00'),
(2, 1, 2, '<h1>Hello world!</h1>', '2017-10-22 11:10:22'),
(4, 1, 2, '<h1>Hello world!</h1>', '2017-10-22 11:27:02'),
(5, 1, 2, '<h1>Hello world!</h1>', '2017-10-23 08:18:52'),
(6, 8, 2, '<h1>Hello world!</h1>', '2017-10-24 11:46:42'),
(7, 9, 2, '<h1>Hello world!</h1>', '2017-10-25 03:52:39'),
(8, 1, 2, '<p>Testing Body</p>\n', '2017-10-27 04:09:12'),
(9, 1, 2, '<p>Gen1 Testing Post</p>\n', '2017-10-27 04:10:42'),
(10, 9, 2, '<p>HK5 Testing Post 1</p>\n', '2017-10-27 04:12:07'),
(11, 9, 2, '<p>Testing Post HK5</p>\n', '2017-10-27 04:13:14'),
(12, 9, 2, '<p>Testing HK5 post 2 statistic</p>\n', '2017-10-27 04:19:30'),
(13, 1, 2, '<p>Testing post gen1 post 1</p>\n', '2017-10-27 04:20:26'),
(14, 1, 2, '<p>Create first row class gen1</p>\n', '2017-10-27 04:21:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `qa_essay_quiz`
--

CREATE TABLE `qa_essay_quiz` (
  `id` int(11) NOT NULL,
  `id_quiz` int(11) NOT NULL,
  `question_number` int(11) NOT NULL,
  `question_essay` text NOT NULL,
  `answer_essay` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `qa_essay_quiz`
--

INSERT INTO `qa_essay_quiz` (`id`, `id_quiz`, `question_number`, `question_essay`, `answer_essay`) VALUES
(1, 8, 1, 'Question Essay 1', 'Answer Essay 1'),
(2, 10, 1, 'Essay 1', 'Answer Essay 1'),
(4, 13, 1, 'qeqwde', 'qeqe');

-- --------------------------------------------------------

--
-- Struktur dari tabel `qa_mc_quiz`
--

CREATE TABLE `qa_mc_quiz` (
  `id` int(11) NOT NULL,
  `id_quiz` int(11) NOT NULL,
  `question_number` int(11) NOT NULL,
  `question_mc` text NOT NULL,
  `answer_mc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `qa_mc_quiz`
--

INSERT INTO `qa_mc_quiz` (`id`, `id_quiz`, `question_number`, `question_mc`, `answer_mc`) VALUES
(1, 5, 1, 'Question 1', 'd'),
(2, 5, 2, 'Question no 2', 'b'),
(4, 8, 1, 'Question Nomer 1', 'd'),
(5, 8, 2, 'Question Number 2', 'c'),
(6, 8, 3, 'Question Number 3', 'b'),
(7, 10, 1, 'Question1', 'c'),
(9, 12, 1, 'ada', 'b'),
(10, 13, 1, 'testing', 'b');

-- --------------------------------------------------------

--
-- Struktur dari tabel `quiz`
--

CREATE TABLE `quiz` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_class` int(11) NOT NULL,
  `quiz_name` text NOT NULL,
  `duration` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_started` datetime NOT NULL,
  `date_ended` datetime NOT NULL,
  `monarch` varchar(5) NOT NULL,
  `total_question_mc` int(11) NOT NULL,
  `total_question_essay` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `quiz`
--

INSERT INTO `quiz` (`id`, `id_user`, `id_class`, `quiz_name`, `duration`, `date_created`, `date_started`, `date_ended`, `monarch`, `total_question_mc`, `total_question_essay`) VALUES
(5, 2, 1, 'Totalalda', 600000, '2017-10-20 12:23:54', '2017-10-09 00:00:00', '2017-10-12 00:00:00', '01', 2, 0),
(8, 2, 1, 'Testing Quiz', 600000, '2017-10-20 01:45:58', '2017-10-09 00:00:00', '2017-10-12 00:00:00', '01', 3, 1),
(10, 2, 1, 'testing Quiz 10', 600000, '2017-10-23 11:26:07', '2017-10-09 00:00:00', '2017-10-12 00:00:00', '01', 1, 1),
(12, 2, 1, 'Testing', 600000, '2017-10-23 02:14:52', '2017-10-09 00:00:00', '2017-10-12 00:00:00', '01', 1, 0),
(13, 2, 1, 'Test', 600000, '2017-10-23 02:31:16', '2017-10-09 00:00:00', '2017-10-12 00:00:00', '01', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `score_quiz`
--

CREATE TABLE `score_quiz` (
  `id` int(11) NOT NULL,
  `id_attempt_quiz` int(11) NOT NULL,
  `score_mc` int(11) NOT NULL,
  `score_essay` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `score_quiz`
--

INSERT INTO `score_quiz` (`id`, `id_attempt_quiz`, `score_mc`, `score_essay`) VALUES
(1, 1, 67, 0),
(2, 4, 100, 0),
(4, 5, 67, 0),
(5, 3, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `statistic`
--

CREATE TABLE `statistic` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `total_post` int(11) NOT NULL,
  `total_comment` int(11) NOT NULL,
  `total_upload` int(11) NOT NULL,
  `total_download` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `statistic`
--

INSERT INTO `statistic` (`id`, `user_id`, `class_id`, `total_post`, `total_comment`, `total_upload`, `total_download`) VALUES
(1, 2, 9, 2, 0, 0, 0),
(2, 2, 1, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(150) NOT NULL,
  `password` text NOT NULL,
  `level` varchar(2) NOT NULL,
  `tahun_aka` varchar(20) NOT NULL,
  `monarch` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `password`, `level`, `tahun_aka`, `monarch`) VALUES
(1, 'hubert', 'Hubertus Putu ', 'c79c6f489015e0bc97f892e357db7156', '1', '', '01'),
(2, 'anjas', 'Oka Anjas', '899445f7e032b2f3e89ba4a03c666764', '1', '', '01'),
(3, 'student', 'Testing Student', 'cd73502828457d15655bbd7a63fb0bc8', '2', '', '01'),
(4, 'student1', 'Student 1', 'cd73502828457d15655bbd7a63fb0bc8', '2', '', '01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer_essay`
--
ALTER TABLE `answer_essay`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answer_essay_atempt_quiz` (`id_attempt_quiz`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignment_user` (`user_id`),
  ADD KEY `assignment_class` (`class_id`);

--
-- Indexes for table `attempt_quiz`
--
ALTER TABLE `attempt_quiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attempt_quiz_quiz` (`id_quiz`),
  ADD KEY `attempt_quiz_user` (`id_user`);

--
-- Indexes for table `badges`
--
ALTER TABLE `badges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `badges_user` (`user_id`),
  ADD KEY `badges_class` (`class_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_enroll` (`id_enroll`),
  ADD KEY `class_users` (`id_user`);

--
-- Indexes for table `comment_assignment`
--
ALTER TABLE `comment_assignment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_assignment_user` (`user_id`),
  ADD KEY `comment_assignment_class` (`class_id`),
  ADD KEY `comment_assignment_assignment` (`assignment_id`);

--
-- Indexes for table `comment_quiz`
--
ALTER TABLE `comment_quiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_quiz_user` (`user_id`),
  ADD KEY `comment_quiz_class` (`class_id`),
  ADD KEY `comment_quiz_quiz` (`quiz_id`);

--
-- Indexes for table `comment_tb`
--
ALTER TABLE `comment_tb`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coment_users` (`id_user`),
  ADD KEY `coment_posts` (`id_posts`);

--
-- Indexes for table `enroll`
--
ALTER TABLE `enroll`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `enrolled_user`
--
ALTER TABLE `enrolled_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enrolled_user_users` (`id_user`),
  ADD KEY `enrolled_user_enroll` (`id_enroll`),
  ADD KEY `enrolled_user_class` (`id_class`);

--
-- Indexes for table `mc_quiz`
--
ALTER TABLE `mc_quiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mc_quiz_qa_mc_quiz` (`id_qa_mc_quiz`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_class` (`id_class`),
  ADD KEY `post_users` (`id_user`);

--
-- Indexes for table `qa_essay_quiz`
--
ALTER TABLE `qa_essay_quiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qa_essay_quiz` (`id_quiz`);

--
-- Indexes for table `qa_mc_quiz`
--
ALTER TABLE `qa_mc_quiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qa_mc_quiz_quiz` (`id_quiz`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_user` (`id_user`),
  ADD KEY `quiz_class` (`id_class`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rating_user` (`user_id`),
  ADD KEY `rating_class` (`class_id`),
  ADD KEY `rating_created` (`created_by`);

--
-- Indexes for table `score_quiz`
--
ALTER TABLE `score_quiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `score_quiz_attempt_quiz` (`id_attempt_quiz`);

--
-- Indexes for table `statistic`
--
ALTER TABLE `statistic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `statistic_user` (`user_id`),
  ADD KEY `statistic_class` (`class_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer_essay`
--
ALTER TABLE `answer_essay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attempt_quiz`
--
ALTER TABLE `attempt_quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `badges`
--
ALTER TABLE `badges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comment_assignment`
--
ALTER TABLE `comment_assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment_quiz`
--
ALTER TABLE `comment_quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment_tb`
--
ALTER TABLE `comment_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `enroll`
--
ALTER TABLE `enroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `enrolled_user`
--
ALTER TABLE `enrolled_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mc_quiz`
--
ALTER TABLE `mc_quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `qa_essay_quiz`
--
ALTER TABLE `qa_essay_quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `qa_mc_quiz`
--
ALTER TABLE `qa_mc_quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `score_quiz`
--
ALTER TABLE `score_quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `statistic`
--
ALTER TABLE `statistic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `answer_essay`
--
ALTER TABLE `answer_essay`
  ADD CONSTRAINT `answer_essay_atempt_quiz` FOREIGN KEY (`id_attempt_quiz`) REFERENCES `attempt_quiz` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `assignment_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assignment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `attempt_quiz`
--
ALTER TABLE `attempt_quiz`
  ADD CONSTRAINT `attempt_quiz_quiz` FOREIGN KEY (`id_quiz`) REFERENCES `quiz` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attempt_quiz_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `badges`
--
ALTER TABLE `badges`
  ADD CONSTRAINT `badges_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `badges_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_enroll` FOREIGN KEY (`id_enroll`) REFERENCES `enroll` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `class_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `comment_assignment`
--
ALTER TABLE `comment_assignment`
  ADD CONSTRAINT `comment_assignment_assignment` FOREIGN KEY (`assignment_id`) REFERENCES `assignment` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_assignment_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_assignment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `comment_quiz`
--
ALTER TABLE `comment_quiz`
  ADD CONSTRAINT `comment_quiz_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_quiz_quiz` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_quiz_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `comment_tb`
--
ALTER TABLE `comment_tb`
  ADD CONSTRAINT `coment_posts` FOREIGN KEY (`id_posts`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coment_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `enrolled_user`
--
ALTER TABLE `enrolled_user`
  ADD CONSTRAINT `enrolled_user_class` FOREIGN KEY (`id_class`) REFERENCES `class` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrolled_user_enroll` FOREIGN KEY (`id_enroll`) REFERENCES `enroll` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrolled_user_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mc_quiz`
--
ALTER TABLE `mc_quiz`
  ADD CONSTRAINT `mc_quiz_qa_mc_quiz` FOREIGN KEY (`id_qa_mc_quiz`) REFERENCES `qa_mc_quiz` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `post_class` FOREIGN KEY (`id_class`) REFERENCES `class` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `qa_essay_quiz`
--
ALTER TABLE `qa_essay_quiz`
  ADD CONSTRAINT `qa_essay_quiz` FOREIGN KEY (`id_quiz`) REFERENCES `quiz` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `qa_mc_quiz`
--
ALTER TABLE `qa_mc_quiz`
  ADD CONSTRAINT `qa_mc_quiz_quiz` FOREIGN KEY (`id_quiz`) REFERENCES `quiz` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `quiz_class` FOREIGN KEY (`id_class`) REFERENCES `class` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rating_created` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rating_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `score_quiz`
--
ALTER TABLE `score_quiz`
  ADD CONSTRAINT `score_quiz_attempt_quiz` FOREIGN KEY (`id_attempt_quiz`) REFERENCES `attempt_quiz` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `statistic`
--
ALTER TABLE `statistic`
  ADD CONSTRAINT `statistic_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `statistic_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
