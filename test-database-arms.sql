-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2025 at 03:11 AM
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
-- Database: `test-database-arms`
--

-- --------------------------------------------------------

--
-- Table structure for table `enlistment_records`
--

CREATE TABLE `enlistment_records` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `birthplace` varchar(100) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `ethnic_group` varchar(50) DEFAULT NULL,
  `marital_status` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact_number` varchar(30) DEFAULT NULL,
  `height` int(5) DEFAULT NULL,
  `weight` int(5) DEFAULT NULL,
  `blood_type` varchar(5) DEFAULT NULL,
  `eye_color` varchar(30) DEFAULT NULL,
  `hair_color` varchar(30) DEFAULT NULL,
  `complexion` varchar(30) DEFAULT NULL,
  `body_built` varchar(30) DEFAULT NULL,
  `other_markings` text DEFAULT NULL,
  `shoes_fit` varchar(10) DEFAULT NULL,
  `tshirt_size` varchar(10) DEFAULT NULL,
  `shorts_size` varchar(10) DEFAULT NULL,
  `waistline` varchar(10) DEFAULT NULL,
  `headgear_size` varchar(10) DEFAULT NULL,
  `combatboots_size` varchar(10) DEFAULT NULL,
  `sbdu_size` varchar(10) DEFAULT NULL,
  `rank` varchar(50) DEFAULT NULL,
  `militaryidenumber` varchar(50) DEFAULT NULL,
  `physical_profile` varchar(10) DEFAULT NULL,
  `grade` varchar(50) DEFAULT NULL,
  `rating` varchar(50) DEFAULT NULL,
  `csc_eligibility` varchar(100) DEFAULT NULL,
  `tin` varchar(50) DEFAULT NULL,
  `philhealth` varchar(50) DEFAULT NULL,
  `pagibig` varchar(50) DEFAULT NULL,
  `passport` varchar(50) DEFAULT NULL,
  `date_entered_mil_service` date DEFAULT NULL,
  `date_enlist_cad` date DEFAULT NULL,
  `source_of_commission` varchar(100) DEFAULT NULL,
  `date_appointed` date DEFAULT NULL,
  `date_enlisted` date DEFAULT NULL,
  `date_last_reenlistment` date DEFAULT NULL,
  `date_last_promex` date DEFAULT NULL,
  `date_last_promotion` date DEFAULT NULL,
  `date_optional_retirement` date DEFAULT NULL,
  `date_compulsory_retirement` date DEFAULT NULL,
  `ete` varchar(50) DEFAULT NULL,
  `current_ete` varchar(50) DEFAULT NULL,
  `length_of_service` varchar(50) DEFAULT NULL,
  `authority_effectively` varchar(100) DEFAULT NULL,
  `years_long_pay` int(11) DEFAULT NULL,
  `present_duty_primary` text DEFAULT NULL,
  `position_designation` varchar(100) DEFAULT NULL,
  `losing_unit` varchar(100) DEFAULT NULL,
  `sea_duty_years` int(11) DEFAULT NULL,
  `field_duty_total` int(11) DEFAULT NULL,
  `mil_career_course` varchar(100) DEFAULT NULL,
  `civilian_course` varchar(100) DEFAULT NULL,
  `last_pft_result` varchar(100) DEFAULT NULL,
  `edrd` date DEFAULT NULL,
  `date_actual_report` date DEFAULT NULL,
  `date_carried_mr` date DEFAULT NULL,
  `authority` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `officer_records`
--

CREATE TABLE `officer_records` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `birthplace` varchar(100) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `ethnic_group` varchar(50) DEFAULT NULL,
  `marital_status` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact_number` varchar(30) DEFAULT NULL,
  `height` int(5) DEFAULT NULL,
  `weight` int(5) DEFAULT NULL,
  `blood_type` varchar(5) DEFAULT NULL,
  `eye_color` varchar(30) DEFAULT NULL,
  `hair_color` varchar(30) DEFAULT NULL,
  `complexion` varchar(30) DEFAULT NULL,
  `body_built` varchar(30) DEFAULT NULL,
  `other_markings` text DEFAULT NULL,
  `shoes_fit` varchar(10) DEFAULT NULL,
  `tshirt_size` varchar(10) DEFAULT NULL,
  `shorts_size` varchar(10) DEFAULT NULL,
  `waistline` varchar(10) DEFAULT NULL,
  `headgear_size` varchar(10) DEFAULT NULL,
  `combatboots_size` varchar(10) DEFAULT NULL,
  `sbdu_size` varchar(10) DEFAULT NULL,
  `rank` varchar(50) DEFAULT NULL,
  `militaryidenumber` varchar(50) DEFAULT NULL,
  `physical_profile` varchar(10) DEFAULT NULL,
  `grade` varchar(50) DEFAULT NULL,
  `rating` varchar(50) DEFAULT NULL,
  `csc_eligibility` varchar(100) DEFAULT NULL,
  `tin` varchar(50) DEFAULT NULL,
  `philhealth` varchar(50) DEFAULT NULL,
  `pagibig` varchar(50) DEFAULT NULL,
  `passport` varchar(50) DEFAULT NULL,
  `date_entered_mil_service` date DEFAULT NULL,
  `date_enlist_cad` date DEFAULT NULL,
  `cad_status` varchar(50) DEFAULT NULL,
  `source_of_commission` varchar(100) DEFAULT NULL,
  `date_appointed` date DEFAULT NULL,
  `date_enlisted` date DEFAULT NULL,
  `date_last_reenlistment` date DEFAULT NULL,
  `date_last_promex` date DEFAULT NULL,
  `date_last_promotion` date DEFAULT NULL,
  `date_optional_retirement` date DEFAULT NULL,
  `date_compulsory_retirement` date DEFAULT NULL,
  `ete` varchar(50) DEFAULT NULL,
  `current_ete` varchar(50) DEFAULT NULL,
  `length_of_service` varchar(50) DEFAULT NULL,
  `authority_effectively` varchar(100) DEFAULT NULL,
  `years_long_pay` int(11) DEFAULT NULL,
  `present_duty_primary` text DEFAULT NULL,
  `position_designation` varchar(100) DEFAULT NULL,
  `losing_unit` varchar(100) DEFAULT NULL,
  `sea_duty_years` int(11) DEFAULT NULL,
  `field_duty_total` int(11) DEFAULT NULL,
  `mil_career_course` varchar(100) DEFAULT NULL,
  `civilian_course` varchar(100) DEFAULT NULL,
  `last_pft_result` varchar(100) DEFAULT NULL,
  `edrd` date DEFAULT NULL,
  `date_actual_report` date DEFAULT NULL,
  `date_carried_mr` date DEFAULT NULL,
  `authority` varchar(100) DEFAULT NULL,
  `fos` varchar(100) DEFAULT NULL,
  `fos_order` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `officer_records`
--

INSERT INTO `officer_records` (`id`, `first_name`, `last_name`, `middle_name`, `birthday`, `birthplace`, `gender`, `religion`, `ethnic_group`, `marital_status`, `address`, `email`, `contact_number`, `height`, `weight`, `blood_type`, `eye_color`, `hair_color`, `complexion`, `body_built`, `other_markings`, `shoes_fit`, `tshirt_size`, `shorts_size`, `waistline`, `headgear_size`, `combatboots_size`, `sbdu_size`, `rank`, `militaryidenumber`, `physical_profile`, `grade`, `rating`, `csc_eligibility`, `tin`, `philhealth`, `pagibig`, `passport`, `date_entered_mil_service`, `date_enlist_cad`, `cad_status`, `source_of_commission`, `date_appointed`, `date_enlisted`, `date_last_reenlistment`, `date_last_promex`, `date_last_promotion`, `date_optional_retirement`, `date_compulsory_retirement`, `ete`, `current_ete`, `length_of_service`, `authority_effectively`, `years_long_pay`, `present_duty_primary`, `position_designation`, `losing_unit`, `sea_duty_years`, `field_duty_total`, `mil_career_course`, `civilian_course`, `last_pft_result`, `edrd`, `date_actual_report`, `date_carried_mr`, `authority`, `fos`, `fos_order`, `created_at`) VALUES
(1, NULL, NULL, NULL, '2025-04-17', 'asd', 'Female', NULL, NULL, NULL, 'asd', 'ASDF@fmail.com', 'asd', 343, 3, NULL, NULL, NULL, 'Light Brown', NULL, NULL, NULL, NULL, NULL, 'asd', NULL, NULL, NULL, 'asd', 'asd', NULL, NULL, 'asd', NULL, '12', '12', '12', '12', '2025-04-10', '2025-04-09', 'asd', 'asd', '2025-04-24', '2025-04-10', '2025-04-24', '2025-04-23', '2025-04-08', '2025-04-11', '2025-04-06', 'asd', 'asd', 'asd', 'asd', 4, 'asd', 'asd', 'asd', 3, 3, 'asd', 'asd', 'asd', '2025-04-24', '2025-04-07', '2025-04-14', 'asd', 'asd', 'asd', '2025-04-25 10:46:26'),
(2, 'Nhatalie', 'Paras', 'Estarija', '2003-02-26', 'Gentri', 'Female', 'Catholic', 'NA', 'Single', 'Gentri', 'nhatalieparas@gmail.com', '0999999999', 154, 44, 'O-', 'brown', 'Brown', 'Brown', 'Slim', 'Right Shoulder', '38', 'Small', 'Small', ' 30', '30', '39', '39', '1', '123', NULL, '2', '5', 'CSC Pro', '123123', '123123', '123123', '123123', '2025-04-25', '2025-04-25', '123', '1233', '2025-04-25', '2025-04-25', '2025-04-25', '2025-04-25', '2025-04-25', '2025-04-25', '2025-04-25', 'ASD', 'ASD', 'asd', 'asd', 2, 'asd', 'asd', 'asd', 2, 2, 'testing', 'testing', 'testing', '2025-04-25', '2025-04-25', '2025-04-25', 'asd', 'asd', 'asd', '2025-04-25 10:46:26');

-- --------------------------------------------------------

--
-- Table structure for table `personnel_dependents`
--

CREATE TABLE `personnel_dependents` (
  `id` int(11) NOT NULL,
  `personnel_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `contact_number` varchar(30) DEFAULT NULL,
  `relationship` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personnel_socials`
--

CREATE TABLE `personnel_socials` (
  `id` int(11) NOT NULL,
  `personnel_id` int(11) DEFAULT NULL,
  `platform` varchar(50) DEFAULT NULL,
  `account_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'met01', '$2y$10$MuAGULbASJ3sDnio42Ow7Om.OSvqwxnBjVmI7H6XN/92gG7CFlmUu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `enlistment_records`
--
ALTER TABLE `enlistment_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `officer_records`
--
ALTER TABLE `officer_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personnel_dependents`
--
ALTER TABLE `personnel_dependents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personnel_socials`
--
ALTER TABLE `personnel_socials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `enlistment_records`
--
ALTER TABLE `enlistment_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `officer_records`
--
ALTER TABLE `officer_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personnel_dependents`
--
ALTER TABLE `personnel_dependents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personnel_socials`
--
ALTER TABLE `personnel_socials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
