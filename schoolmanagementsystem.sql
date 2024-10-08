-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2024 at 09:21 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schoolmanagementsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `class` int(10) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `student_id` int(11) NOT NULL,
  `status` text NOT NULL,
  `section` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `class`, `date`, `student_id`, `status`, `section`) VALUES
(1, 1, '2024-09-23', 3, 'present', 4),
(2, 1, '2024-09-23', 7, 'absent', 4),
(3, 1, '2024-09-22', 3, 'present', 4),
(4, 1, '2024-09-22', 7, 'present', 4),
(5, 1, '2024-09-21', 3, 'present', 4),
(6, 1, '2024-09-21', 7, 'leave', 4),
(7, 1, '2024-09-20', 3, 'present', 4),
(8, 1, '2024-09-20', 7, 'late', 4),
(9, 1, '2024-08-31', 3, 'present', 4),
(10, 1, '2024-08-31', 7, 'present', 4),
(11, 1, '2024-09-24', 3, 'present', 4),
(12, 1, '2024-09-24', 7, 'late', 4),
(13, 104, '2024-09-24', 6, 'late', 3),
(14, 104, '2024-09-24', 12, 'absent', 4),
(15, 2, '2024-10-05', 3, 'present', 4),
(16, 2, '2024-10-05', 13, 'late', 4),
(17, 2, '2024-10-05', 27, 'present', 4),
(18, 2, '2024-10-04', 3, 'present', 4),
(19, 2, '2024-10-04', 13, 'late', 4),
(20, 2, '2024-10-04', 27, 'present', 4),
(21, 2, '2024-10-03', 3, 'absent', 4),
(22, 2, '2024-10-03', 13, 'late', 4),
(23, 2, '2024-10-03', 27, 'present', 4),
(27, 2, '2024-10-02', 3, 'present', 4),
(28, 2, '2024-10-02', 13, 'late', 4),
(29, 2, '2024-10-02', 27, 'present', 4),
(30, 2, '2024-10-06', 3, 'leave', 4),
(31, 2, '2024-10-06', 13, 'present', 4),
(32, 2, '2024-10-06', 27, 'present', 4);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `section` varchar(11) NOT NULL,
  `added_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `title`, `section`, `added_date`) VALUES
(1, 'Class-1', '1', '2024-07-13'),
(2, 'Class-2', '1,2', '2024-07-13');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `category` text NOT NULL,
  `duration` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `category`, `duration`, `date`, `image`) VALUES
(3, 'HTML', 'WEB DEVLOPMENT', '2hr', '2024-07-15 00:00:00', 'Indus University Logo.png'),
(4, 'CSS', 'WEB DEVLOPMENT', '10hr', '2024-07-15 00:00:00', 'Indus University Logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `file_name`, `file_path`, `upload_date`) VALUES
(12, 'b17.jpg', '../dist/uploads/b17.jpg', '2024-10-06 17:50:32'),
(13, 'b18.jpg', '../dist/uploads/b18.jpg', '2024-10-06 17:50:54');

-- --------------------------------------------------------

--
-- Table structure for table `metadata`
--

CREATE TABLE `metadata` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `meta_key` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `metadata`
--

INSERT INTO `metadata` (`id`, `item_id`, `meta_key`, `meta_value`) VALUES
(1, 2, 'section', '3'),
(2, 2, 'section', '4'),
(3, 7, 'day_name', 'monday'),
(4, 7, 'teacher_id', '2'),
(5, 7, 'subject_id', '19'),
(6, 7, 'lectur_id', '5'),
(23, 16, 'from', '08:30'),
(24, 16, 'to', '09:15'),
(25, 17, 'from', '09:15'),
(26, 17, 'to', '10:00'),
(27, 5, 'from', '07:00'),
(28, 5, 'to', '07:45'),
(29, 6, 'from', '07:45'),
(30, 6, 'to', '08:30'),
(31, 18, 'class_id', '1'),
(32, 18, 'section_id', '3'),
(33, 18, 'teacher_id', '2'),
(34, 18, 'lectur_id', '5'),
(35, 18, 'day_name', 'tuesday'),
(36, 18, 'subject_id', '19'),
(37, 7, 'class_id', '1'),
(38, 7, 'section_id', '3'),
(63, 26, 'amount', '500'),
(64, 26, 'status', 'success'),
(65, 26, 'student_id', '20'),
(66, 26, 'month', 'September'),
(67, 27, 'amount', '500'),
(68, 27, 'status', 'success'),
(69, 27, 'student_id', '20'),
(70, 27, 'month', 'October'),
(71, 28, 'class', '1'),
(72, 28, 'subject', '19'),
(73, 28, 'file_attachment', 'login.php'),
(74, 29, 'class', '2'),
(75, 29, 'subject', '19'),
(76, 29, 'file_attachment', 'index.php'),
(135, 48, 'from', '09:15'),
(136, 48, 'to', '10:15'),
(203, 59, 'from', '10:15'),
(204, 59, 'to', '11:15'),
(225, 71, 'amount', '500'),
(226, 71, 'status', 'success'),
(227, 71, 'student_id', '3'),
(228, 71, 'month', 'August'),
(289, 87, 'amount', '500'),
(290, 87, 'status', 'success'),
(291, 87, 'student_id', '3'),
(292, 87, 'month', 'January'),
(293, 88, 'amount', '500'),
(294, 88, 'status', 'success'),
(295, 88, 'student_id', '3'),
(296, 88, 'month', 'September'),
(297, 89, 'amount', '500'),
(298, 89, 'status', 'success'),
(299, 89, 'student_id', '3'),
(300, 89, 'month', 'Fabruary'),
(325, 20, 'class_id', '2'),
(326, 20, 'section_id', '3'),
(327, 20, 'teacher_id', '2'),
(328, 20, 'lectur_id', '6'),
(329, 20, 'day_name', 'monday'),
(330, 20, 'subject_id', '19'),
(331, 90, 'class_id', '2'),
(332, 90, 'section_id', '4'),
(333, 90, 'teacher_id', '1'),
(334, 90, 'lectur_id', '16'),
(335, 90, 'day_name', 'monday'),
(336, 90, 'subject_id', '19'),
(337, 94, 'class_id', '1'),
(338, 94, 'section_id', '3'),
(339, 94, 'teacher_id', '1'),
(340, 94, 'lectur_id', '6'),
(341, 94, 'day_name', 'tuesday'),
(342, 94, 'subject_id', '19'),
(343, 95, 'class_id', '1'),
(344, 95, 'section_id', '4'),
(345, 95, 'teacher_id', '1'),
(346, 95, 'lectur_id', '16'),
(347, 95, 'day_name', 'tuesday'),
(348, 95, 'subject_id', '19'),
(349, 96, 'class_id', '2'),
(350, 96, 'section_id', '4'),
(351, 96, 'teacher_id', '1'),
(352, 96, 'lectur_id', '48'),
(353, 96, 'day_name', 'monday'),
(354, 96, 'subject_id', '19'),
(355, 97, 'class_id', '1'),
(356, 97, 'section_id', '4'),
(357, 97, 'teacher_id', '2'),
(358, 97, 'lectur_id', '48'),
(359, 97, 'day_name', 'tuesday'),
(360, 97, 'subject_id', '19'),
(361, 98, 'class_id', '2'),
(362, 98, 'section_id', '4'),
(363, 98, 'teacher_id', '2'),
(364, 98, 'lectur_id', '59'),
(365, 98, 'day_name', 'monday'),
(366, 98, 'subject_id', '19'),
(367, 1, 'section', '3'),
(368, 1, 'section', '4'),
(369, 99, 'class_id', '1'),
(370, 99, 'section_id', '3'),
(371, 99, 'teacher_id', '1'),
(372, 99, 'lectur_id', '59'),
(373, 99, 'day_name', 'tuesday'),
(374, 99, 'subject_id', '19'),
(375, 102, 'section', '3'),
(376, 104, 'section', '3'),
(377, 106, 'class_id', '104'),
(378, 106, 'section_id', '3'),
(379, 106, 'teacher_id', '8'),
(380, 106, 'lectur_id', '5'),
(381, 106, 'day_name', 'wednesday'),
(382, 106, 'subject_id', '19'),
(398, 112, 'class', '2'),
(399, 112, 'subject', '19'),
(400, 112, 'file_attachment', 'Mitan_CV.pdf'),
(401, 113, 'class', '1'),
(402, 113, 'subject', '19'),
(403, 113, 'file_attachment', 'JavaScript E-Book Interview Questions.pdf'),
(407, 115, 'amount', '500'),
(408, 115, 'status', 'success'),
(409, 115, 'student_id', '27'),
(410, 115, 'month', 'January'),
(411, 116, 'section', '3'),
(412, 116, 'section', '4'),
(413, 116, 'section', '105'),
(414, 118, 'class_id', '116'),
(415, 118, 'section_id', '3'),
(416, 118, 'teacher_id', '1'),
(417, 118, 'lectur_id', '6'),
(418, 118, 'day_name', 'thursday'),
(419, 118, 'subject_id', '19'),
(420, 119, 'section', '3'),
(421, 119, 'section', '4'),
(422, 119, 'section', '105'),
(423, 119, 'section', '117'),
(424, 122, 'from', '12:00'),
(425, 122, 'to', '13:00'),
(426, 123, 'class_id', '1'),
(427, 123, 'section_id', '3'),
(428, 123, 'teacher_id', '33'),
(429, 123, 'lectur_id', '6'),
(430, 123, 'day_name', 'monday'),
(431, 123, 'subject_id', '120');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `author` int(11) NOT NULL DEFAULT 1,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `type` varchar(100) NOT NULL,
  `publish_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `status` varchar(50) NOT NULL,
  `parent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `author`, `title`, `description`, `type`, `publish_date`, `modified_date`, `status`, `parent`) VALUES
(1, 1, 'Class -1', 'Class -1 Description', 'class', '2021-06-20 08:02:16', '2021-06-20 08:02:16', 'publish', 0),
(2, 1, 'Class -2', 'Class -2 Description', 'class', '2021-06-20 08:02:16', '2021-06-20 08:02:16', 'publish', 0),
(3, 1, 'Section A', 'Section A Description', 'section', '2021-06-20 08:03:48', '2021-06-20 08:03:48', 'publish', 0),
(4, 1, 'Section B', 'Section B Description', 'section', '2021-06-20 08:03:48', '2021-06-20 08:03:48', 'publish', 0),
(5, 1, 'First Period', 'First Period Description', 'period', '2021-07-23 14:23:34', '2021-07-23 14:23:34', 'publish', 0),
(6, 1, 'Second Period', 'Second Period Description', 'period', '2021-07-23 14:23:34', '2021-07-23 14:23:34', 'publish', 0),
(7, 1, 'Monday - First Period', 'Monday - First Period Descrioption', 'timetable', '2021-07-23 14:36:38', '2021-07-23 14:36:38', 'publish', 0),
(16, 1, 'Third Period', '', 'period', '2021-07-23 22:52:35', '2021-07-24 14:22:35', 'publish', 0),
(18, 1, '', '', 'timetable', '2021-07-24 22:47:42', '2021-07-25 14:17:42', 'publish', 0),
(19, 1, 'Mathematics', '', 'subject', '2021-07-25 14:29:09', '2021-07-25 14:29:09', 'publish', 0),
(20, 1, '', '', 'timetable', '2021-07-24 23:01:44', '2021-07-25 14:31:44', 'publish', 0),
(26, 20, 'September - Fee', '', 'payment', '2023-09-21 20:11:58', '0000-00-00 00:00:00', 'success', 0),
(27, 20, 'October - Fee', '', 'payment', '2023-09-23 18:53:49', '0000-00-00 00:00:00', 'success', 0),
(28, 1, 'PDF for algebra', 'PDF for algebra', 'study-material', '2023-09-26 20:55:40', '0000-00-00 00:00:00', 'publish', 0),
(29, 1, 'PDF for english', 'PDF for english', 'study-material', '2023-09-26 20:57:21', '0000-00-00 00:00:00', 'publish', 0),
(48, 1, 'Fourth', 'description', 'period', '2024-09-20 04:18:27', '2024-09-20 04:18:27', 'publish', 0),
(59, 1, 'Fifth Period', '', 'period', '2024-09-20 00:42:16', '0000-00-00 00:00:00', 'publish', 0),
(71, 3, 'August - Fee', '', 'payment', '2024-09-20 06:36:02', '0000-00-00 00:00:00', 'success', 0),
(87, 3, 'January - Fee', '', 'payment', '2024-09-20 06:52:40', '0000-00-00 00:00:00', 'success', 0),
(88, 3, 'September - Fee', '', 'payment', '2024-09-20 07:58:19', '0000-00-00 00:00:00', 'success', 0),
(89, 3, 'Fabruary - Fee', '', 'payment', '2024-09-20 08:54:45', '0000-00-00 00:00:00', 'success', 0),
(90, 1, '', '', 'timetable', '2024-09-20 07:48:01', '0000-00-00 00:00:00', 'publish', 0),
(93, 1, 'timetable', 'description', 'timetable', '2024-09-20 12:21:27', '0000-00-00 00:00:00', 'publish', 0),
(94, 1, 'timetable', 'description', 'timetable', '2024-09-20 12:26:49', '0000-00-00 00:00:00', 'publish', 0),
(95, 1, 'timetable', 'description', 'timetable', '2024-09-20 14:41:29', '0000-00-00 00:00:00', 'publish', 0),
(96, 1, 'timetable', 'description', 'timetable', '2024-09-20 15:00:49', '0000-00-00 00:00:00', 'publish', 0),
(97, 1, 'timetable', 'description', 'timetable', '2024-09-20 15:01:52', '0000-00-00 00:00:00', 'publish', 0),
(98, 1, 'timetable', 'description', 'timetable', '2024-09-20 15:03:59', '0000-00-00 00:00:00', 'publish', 0),
(99, 1, 'timetable', 'description', 'timetable', '2024-09-20 15:24:15', '0000-00-00 00:00:00', 'publish', 0),
(102, 1, 'Class -3', 'description', 'class', '2024-09-21 03:24:27', '0000-00-00 00:00:00', 'publish', 0),
(104, 1, 'Class - 4', 'description', 'class', '2024-09-21 03:29:32', '0000-00-00 00:00:00', 'publish', 0),
(105, 1, 'Section C', 'description', 'section', '2024-09-21 03:33:00', '0000-00-00 00:00:00', 'publish', 0),
(106, 1, 'timetable', 'description', 'timetable', '2024-09-21 03:58:51', '0000-00-00 00:00:00', 'publish', 0),
(112, 1, 'Maths', 'Maths', 'study-material', '2024-09-22 07:38:13', '0000-00-00 00:00:00', 'publish', 0),
(113, 1, 'Mathematics', 'Mathematics', 'study-material', '2024-09-22 07:39:30', '0000-00-00 00:00:00', 'publish', 0),
(115, 27, 'January - Fee', '', 'payment', '2024-09-23 09:43:48', '0000-00-00 00:00:00', 'success', 0),
(116, 1, 'Class - 5', 'description', 'class', '2024-09-24 16:21:04', '0000-00-00 00:00:00', 'publish', 0),
(117, 1, 'Section D', 'description', 'section', '2024-09-24 18:08:33', '0000-00-00 00:00:00', 'publish', 0),
(118, 1, 'timetable', 'description', 'timetable', '2024-09-29 15:46:45', '0000-00-00 00:00:00', 'publish', 0),
(119, 1, 'Class - 6', 'description', 'class', '2024-10-05 10:17:16', '0000-00-00 00:00:00', 'publish', 0),
(120, 1, 'English', 'description', 'subject', '2024-10-05 11:03:40', '0000-00-00 00:00:00', 'publish', 0),
(121, 1, 'Gujarati', 'description', 'subject', '2024-10-05 11:04:09', '0000-00-00 00:00:00', 'publish', 0),
(122, 1, 'Sixth Period', '', 'period', '2024-10-04 19:35:57', '0000-00-00 00:00:00', 'publish', 0),
(123, 1, 'timetable', 'description', 'timetable', '2024-10-06 18:15:04', '0000-00-00 00:00:00', 'publish', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `title`) VALUES
(1, 'Section A'),
(2, 'Section B'),
(3, 'Section C'),
(4, 'Section D'),
(5, 'Section E'),
(6, 'Section C');

-- --------------------------------------------------------

--
-- Table structure for table `usermeta`
--

CREATE TABLE `usermeta` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `meta_key` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usermeta`
--

INSERT INTO `usermeta` (`id`, `user_id`, `meta_key`, `meta_value`) VALUES
(679, 3, 'class', '2'),
(680, 4, 'class', '102'),
(681, 6, 'class', '104'),
(682, 7, 'class', '1'),
(683, 13, 'class', '2'),
(686, 13, 'section', '4'),
(687, 3, 'section', '4'),
(688, 4, 'section', '3'),
(689, 6, 'section', '3'),
(690, 7, 'section', '4');

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `id` int(11) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`id`, `user_type`, `email`, `password`, `name`) VALUES
(1, 'teacher', 'teacher1@gmail.com', '41c8949aa55b8cb5dbec662f34b62df3', 'Teacher1'),
(2, 'teacher', 'teacher2@gmail.com', 'ccffb0bb993eeb79059b31e1611ec353', 'Teacher2'),
(3, 'student', 'student1@gmail.com', '5e223a298a380579d1108529d299484e', 'Mitan'),
(4, 'student', 'student2@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'student 2'),
(5, 'teacher', 'teacher3@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Teacher 3'),
(6, 'student', 'Student3@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'student 3'),
(7, 'student', 'student4@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Student 4'),
(8, 'teacher', 'teacher4@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Pranay'),
(9, 'admin', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', 'Admin1'),
(13, 'student', 'student5@gmail.com', 'c47001b922becc7bf544b489d02f50f8', 'Student 5'),
(33, 'teacher', 'mitantank00@gmail.com', 'a7a7290edd7afe559d7ab31e210638cf', 'Mitan Tank');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metadata`
--
ALTER TABLE `metadata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usermeta`
--
ALTER TABLE `usermeta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `metadata`
--
ALTER TABLE `metadata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=432;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `usermeta`
--
ALTER TABLE `usermeta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=693;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
