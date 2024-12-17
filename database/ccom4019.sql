-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2024 at 04:22 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ccom4019`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` char(8) NOT NULL,
  `course_name` varchar(45) NOT NULL,
  `course_credits` tinyint(1) UNSIGNED NOT NULL,
  `course_desc` text DEFAULT NULL,
  `dept_id` char(4) NOT NULL,
  `updated_by` varchar(20) DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_credits`, `course_desc`, `dept_id`, `updated_by`, `last_updated`) VALUES
('BIOL4055', 'Ciencia Ambiental', 3, 'Course description for BIOL4055', 'BIOL', 'admin', '2024-12-07 01:18:50'),
('ESPA3007', 'Comunicación Oral', 3, 'Course description for ESPA3007', 'ESPA', 'admin', '2024-12-07 01:18:50'),
('ESPA3136', 'Literatura Sacra y Religión', 3, 'Course description for ESPA3136', 'ESPA', 'admin', '2024-12-07 01:18:50'),
('ESPA3211', 'Introducción a la Literatura Española I', 3, 'Course description for ESPA3211', 'ESPA', 'admin', '2024-12-07 01:18:50'),
('ESPA3212', 'Introducción a la Literatura Española II', 3, 'Course description for ESPA3212', 'ESPA', 'admin', '2024-12-07 01:18:50'),
('ESPA3305', 'Cine y Literatura', 3, 'Course description for ESPA3305', 'ESPA', 'admin', '2024-12-07 01:18:50'),
('ESPA4267', 'Literatura Puertorriqueña Compendio', 3, 'Course description for ESPA4267', 'ESPA', 'admin', '2024-12-07 01:18:50'),
('SICI3028', 'Programación Aplicada', 3, 'Este curso provee los conocimientos teóricos y destrezas prácticas para hacer uso eficiente de tres tipos principales de aplicaciones usadas frecuentemente en los negocios: Procesadores de texto, hojas de cálculo y preparación de presentaciones y otros tipos de programas.', 'CCOM', 'juano.lopez', '2024-12-07 01:18:50');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `dept_id` char(4) NOT NULL,
  `dept_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dept_id`, `dept_name`) VALUES
('ADEM', 'Business Administration'),
('ADMI', 'System Administrators'),
('BIOL', 'Biology'),
('CCOM', 'Computer Science'),
('ESPA', 'Spanish');

-- --------------------------------------------------------

--
-- Table structure for table `prerequisites`
--

CREATE TABLE `prerequisites` (
  `course_id` char(8) NOT NULL,
  `prerequisite` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `prerequisites`
--

INSERT INTO `prerequisites` (`course_id`, `prerequisite`) VALUES
('CCOM4508', 'CCOM3002'),
('CCOM4508', 'CCOM4503'),
('ESPA3007', 'ESPA3004'),
('ESPA3007', 'ESPA3102'),
('ESPA3007', 'ESPA3112'),
('ESPA3136', 'ESPA0001'),
('ESPA3211', 'ESPA3004'),
('ESPA3211', 'ESPA3102'),
('ESPA3211', 'ESPA3112'),
('ESPA3212', 'ESPA3004'),
('ESPA3212', 'ESPA3102'),
('ESPA3212', 'ESPA3112'),
('ESPA3305', 'ESPA3004'),
('ESPA3305', 'ESPA3102'),
('ESPA3305', 'ESPA3112'),
('ESPA4267', 'ESPA3004'),
('ESPA4267', 'ESPA3102'),
('ESPA4267', 'ESPA3112');

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `term_id` char(3) NOT NULL,
  `term_desc` varchar(30) NOT NULL,
  `term_is_active` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`term_id`, `term_desc`, `term_is_active`) VALUES
('C31', '2023-2024 First Semester', b'0'),
('C32', '2023-2024 Second Semester', b'0'),
('C33', '2023-2024 Summer', b'0'),
('C41', '2024-2025 First Semester', b'0'),
('C42', '2024-2025 Second Semester', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `term_offering`
--

CREATE TABLE `term_offering` (
  `term_id` char(3) NOT NULL,
  `course_id` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `term_offering`
--

INSERT INTO `term_offering` (`term_id`, `course_id`) VALUES
('C41', 'ESPA3305'),
('C41', 'SICI3028'),
('C42', 'BIOL4055'),
('C42', 'ESPA3007'),
('C42', 'ESPA3211'),
('C42', 'ESPA3212'),
('C42', 'SICI3028');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(40) NOT NULL,
  `role` varchar(15) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp(),
  `dept_id` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `name`, `role`, `last_login`, `dept_id`) VALUES
('admin', '$2y$10$54R7uDe8zuFYn36yUad8Q.4kCHm95WFiz0myT64x9kKVfgupLP3.m', 'Administrator', 'admin', '2024-12-17 03:19:53', 'ADMI'),
('eliana.valenzuela', '$2y$10$Mb0tAkL1x.a20P4WnbWfbOTKTYi94/HypudO6wMLrYw25tzrVRsG2', 'Eliana Valenzuela Andrade', 'coordinator', '2024-12-07 01:18:50', 'CCOM'),
('gualberto.rosado', '$2y$10$FmpmEG1BNoh5eiW/zG4tzebpn25q.RQAPv4ooHG5lbM/2dOXv3/VS', 'Gualberto Rosado Rodríguez', 'chair', '2024-12-07 01:18:50', 'BIOL'),
('jose.arbelo', '$2y$10$pkp7/qgyS6CFZv6Rx8qsf.687xKt4FWzFmz4oPMLA36LLuR95YKsm', 'José G. Arbelo García', 'coordinator', '2024-12-07 01:18:50', 'BIOL'),
('juano.lopez', '$2y$10$74wSDxRowJScVOZAlNTPSerAeB8zdk/SndwU4kpdnZF5bL/wPEONy', 'Juan O. López Gerena', 'chair', '2024-12-17 03:16:49', 'CCOM'),
('rebeca.franqui', '$2y$10$x70IEBf.rco4lwboS7rMMuvhk8m.10FeUu2F2v3RSNSCTWs9IiTsy', 'Rebeca Franqui Rosario', 'chair', '2024-12-07 01:18:50', 'ESPA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `prerequisites`
--
ALTER TABLE `prerequisites`
  ADD PRIMARY KEY (`course_id`,`prerequisite`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`term_id`);

--
-- Indexes for table `term_offering`
--
ALTER TABLE `term_offering`
  ADD PRIMARY KEY (`term_id`,`course_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
