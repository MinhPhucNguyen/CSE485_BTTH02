-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2023 at 06:01 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `btth02`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `code_course` varchar(50) NOT NULL,
  `id_std` int(11) NOT NULL,
  `id_class` varchar(50) NOT NULL,
  `time_attendance` datetime DEFAULT NULL,
  `state` tinyint(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`code_course`, `id_std`, `id_class`, `time_attendance`, `state`) VALUES
('CSE_404', 1, 'ABS_663', '2023-05-24 00:11:58', 1),
('CSE_485', 1, 'ABC_456', '2023-05-17 00:13:31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id_class` varchar(50) NOT NULL,
  `class_name` varchar(20) NOT NULL,
  `id_teacher` int(11) NOT NULL,
  `code_course` varchar(50) NOT NULL,
  `time_class` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id_class`, `class_name`, `id_teacher`, `code_course`, `time_class`) VALUES
('ABC_456', '62HT', 3, 'CSE_485', '2023-05-17 00:13:31'),
('ABS_662', '62TH7', 5, 'CSE_456', '2023-05-13 23:03:21'),
('ABS_663', '63PM2', 2, 'CSE_404', '2023-05-24 00:11:58'),
('ALM_456', '62TH4', 2, 'CSE_404', '2023-05-02 00:27:14'),
('MRX_514', '62TH3', 1, 'CSE_485', '2023-05-19 23:03:21');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `code_course` varchar(50) NOT NULL,
  `course_name` varchar(50) DEFAULT NULL,
  `course_desc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`code_course`, `course_name`, `course_desc`) VALUES
('CSE_404', 'HTML', 'HyperText Markup Language, or HTML, is the standard markup language for describing the structure of documents displayed on the web.'),
('CSE_456', 'Python', 'Python is a computer programming language often used to build websites and software, automate tasks, and conduct data analysis.'),
('CSE_485', 'PHP', 'PHP is a general-purpose scripting language geared toward web development. '),
('CSE_487', 'Java', 'Java is a widely used object-oriented programming language and software platform. ');

-- --------------------------------------------------------

--
-- Table structure for table `registered`
--

CREATE TABLE `registered` (
  `id` int(11) NOT NULL,
  `id_std` int(11) NOT NULL,
  `id_class` varchar(50) NOT NULL,
  `code_course` varchar(50) NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id_std` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `id_class` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id_std`, `name`, `birth`, `phone`, `email`, `id_class`) VALUES
(1, 'Fleur Hampton', '2002-09-16', '095749278', 'augue.scelerisque@outlook.com', 'MRX_514'),
(2, 'Carl Graham', '2023-09-16', '091224805', 'gravida.sagittis.duis@outlook.com', 'IHE_151'),
(3, 'Yoshio Smith', '2022-12-23', '091560461', 'lacus.quisque.imperdiet@yahoo.ca', 'RUO_804'),
(4, 'Chava Sawyer', '2022-11-28', '096255794', 'nunc.sed@hotmail.edu', 'KBH_411'),
(5, 'Zephania Alston', '2023-03-19', '091594175', 'sit.amet.luctus@outlook.com', 'ZGO_917'),
(6, 'Kay Campos', '2022-12-04', '094310873', 'et@google.ca', 'RSG_968'),
(7, 'Jamal Velasquez', '2022-10-04', '095146047', 'proin.sed@hotmail.edu', 'IBD_552'),
(8, 'Pearl Powers', '2023-11-18', '090268232', 'tempor.erat.neque@outlook.org', 'FDI_686'),
(9, 'Adam Kim', '2023-09-17', '094838891', 'semper.erat@icloud.com', 'HBT_690'),
(10, 'Martena Peters', '2022-08-05', '099218631', 'ridiculus.mus@outlook.com', 'DZI_768'),
(11, 'Craig Perkins', '2023-02-08', '098466068', 'duis.volutpat.nunc@icloud.couk', 'PVX_260'),
(12, 'Phoebe Raymond', '2023-06-08', '098358326', 'montes.nascetur@icloud.couk', 'APS_663'),
(13, 'Carl Adams', '2023-07-13', '091323134', 'proin.nisl.sem@aol.org', 'BEN_998'),
(14, 'Hilel Murphy', '2024-01-09', '091431683', 'fringilla.purus@outlook.com', 'YGK_237'),
(15, 'Yoko Terry', '2024-04-12', '097652515', 'tempor.lorem@hotmail.com', 'UHL_404'),
(16, 'Bert Dean', '2022-07-25', '090708718', 'mus.aenean@aol.couk', 'QDD_475'),
(17, 'Kareem Hart', '2022-09-22', '096623751', 'ligula.tortor@protonmail.ca', 'OSQ_126'),
(18, 'Holly Velasquez', '2022-07-24', '092456108', 'lacus.aliquam@outlook.net', 'SYU_386'),
(19, 'Drake Zamora', '2022-07-06', '096176458', 'eleifend.nec.malesuada@hotmail.edu', 'FUD_975'),
(20, 'Stone Kirby', '2022-07-15', '097239892', 'odio@google.net', 'MVF_165');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id_teacher` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role_as` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id_class`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`code_course`);

--
-- Indexes for table `registered`
--
ALTER TABLE `registered`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id_std`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id_teacher`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registered`
--
ALTER TABLE `registered`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
