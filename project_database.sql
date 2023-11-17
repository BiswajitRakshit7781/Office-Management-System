-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2023 at 05:40 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `emp_id` varchar(30) NOT NULL,
  `curr_date` date NOT NULL,
  `attendance_month` varchar(12) NOT NULL,
  `attendance_year` int(11) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`emp_id`, `curr_date`, `attendance_month`, `attendance_year`, `status`) VALUES
('EMP0001', '2023-11-01', 'Nov', 2023, 'P'),
('EMP0002', '2023-11-01', 'Nov', 2023, 'P'),
('EMP0003', '2023-11-01', 'Nov', 2023, 'P'),
('EMP0004', '2023-11-01', 'Nov', 2023, 'P'),
('EMP0005', '2023-11-01', 'Nov', 2023, 'P'),
('EMP0001', '2023-11-01', 'Nov', 2023, 'P'),
('EMP0002', '2023-11-01', 'Nov', 2023, 'P'),
('EMP0003', '2023-11-01', 'Nov', 2023, 'P'),
('EMP0004', '2023-11-01', 'Nov', 2023, 'P'),
('EMP0005', '2023-11-01', 'Nov', 2023, 'P'),
('EMP0001', '2023-11-02', 'Nov', 2023, 'P'),
('EMP0002', '2023-11-02', 'Nov', 2023, 'P'),
('EMP0003', '2023-11-02', 'Nov', 2023, 'P'),
('EMP0004', '2023-11-02', 'Nov', 2023, 'P'),
('EMP0005', '2023-11-02', 'Nov', 2023, 'P'),
('EMP0001', '2023-11-02', 'Nov', 2023, 'P'),
('EMP0002', '2023-11-02', 'Nov', 2023, 'P'),
('EMP0003', '2023-11-02', 'Nov', 2023, 'P'),
('EMP0004', '2023-11-02', 'Nov', 2023, 'P'),
('EMP0005', '2023-11-02', 'Nov', 2023, 'P'),
('EMP0001', '2023-11-03', 'Nov', 2023, 'P'),
('EMP0002', '2023-11-03', 'Nov', 2023, 'P'),
('EMP0003', '2023-11-03', 'Nov', 2023, 'P'),
('EMP0006', '2023-11-03', 'Nov', 2023, 'P'),
('EMP0004', '2023-11-03', 'Nov', 2023, 'A'),
('EMP0005', '2023-11-03', 'Nov', 2023, 'A'),
('EMP0006', '2023-11-01', 'Nov', 2023, 'L'),
('EMP0006', '2023-11-02', 'Nov', 2023, 'L'),
('EMP0001', '2023-11-04', 'Nov', 2023, 'H'),
('EMP0002', '2023-11-04', 'Nov', 2023, 'H'),
('EMP0003', '2023-11-04', 'Nov', 2023, 'H'),
('EMP0004', '2023-11-04', 'Nov', 2023, 'H'),
('EMP0005', '2023-11-04', 'Nov', 2023, 'H'),
('EMP0006', '2023-11-04', 'Nov', 2023, 'H'),
('EMP0001', '2023-11-09', 'Nov', 2023, 'P'),
('EMP0002', '2023-11-09', 'Nov', 2023, 'P'),
('EMP0003', '2023-11-09', 'Nov', 2023, 'P'),
('EMP0004', '2023-11-09', 'Nov', 2023, 'P'),
('EMP0005', '2023-11-09', 'Nov', 2023, 'P'),
('EMP0006', '2023-11-09', 'Nov', 2023, 'P');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` varchar(20) NOT NULL,
  `emp_name` varchar(30) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `address` varchar(300) NOT NULL,
  `phone_no` varchar(10) NOT NULL,
  `post` text NOT NULL,
  `password` varchar(15) NOT NULL,
  `date_of_join` date NOT NULL,
  `basic` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_name`, `email_id`, `address`, `phone_no`, `post`, `password`, `date_of_join`, `basic`) VALUES
('EMP0001', 'Raju Pal', 'rajupal@gmail.com', 'Nadia,West Bengal ', '9874563210', 'HR', 'RAJU0001', '2016-07-13', 60000),
('EMP0002', 'Saikat Das', 'saikatdas@gmail.com', 'Bally,West Bengal ', '7485963210', 'Employee', 'SAIK0002', '2017-01-05', 20000),
('EMP0003', 'Arpita Sen', 'arpitasen@gmail.com', 'Rishra,West Bengal ', '9678410235', 'Manager', 'ARPI0003', '2018-05-08', 40000),
('EMP0004', 'MD. Musfikur', 'mdmusfi@gmail.com', 'Murshidabad, West Bengal', '6291364578', 'Employee', 'MDMU0004', '2021-11-02', 18000),
('EMP0005', 'Soham Das', 'sohamdas@gmail.com', 'Uttarpara,West Bengal ', '8796541230', 'employee', 'SOHA0005', '2020-01-04', 20000),
('EMP0006', 'Raja Mallick', 'rajamallick@gmail.com', 'Bankura,West Bengal', '6291354789', 'manager', 'RAJA0006', '2021-06-04', 40000);

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `notice_id` double NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `notice` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`notice_id`, `time`, `notice`) VALUES
(20, '2023-11-17 04:29:19', 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` varchar(20) NOT NULL,
  `project_name` varchar(20) NOT NULL,
  `description` varchar(150) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `progression` int(20) DEFAULT NULL,
  `starting_date` date NOT NULL,
  `ending_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_name`, `description`, `status`, `progression`, `starting_date`, `ending_date`) VALUES
('PROJ001', 'Online Food Service', 'An online food service website where customer can order and pay online. Also having customer support.', 'Complete', 100, '2022-10-12', '2023-01-27'),
('PROJ002', 'Online Car Booking', 'A car booking website with payment gateway and customer support', NULL, NULL, '2023-03-01', '2023-05-02'),
('PROJ003', 'Home Rent Portal', 'Book and manage house rent', NULL, NULL, '2023-07-12', '2023-09-27'),
('PROJ004', 'Attendance register ', 'Smart attendance using QR code', 'In Progress', 100, '2023-09-07', '2023-12-14');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `project_id` varchar(20) NOT NULL,
  `emp_id` varchar(20) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`project_id`, `emp_id`, `role`) VALUES
('PROJ002', 'EMP0002', 'Junior Developer'),
('PROJ003', 'EMP0002', 'Adviser');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`),
  ADD UNIQUE KEY `email_id` (`email_id`),
  ADD UNIQUE KEY `phone_no` (`phone_no`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`notice_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD KEY `project_id` (`project_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `notice_id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`);

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`),
  ADD CONSTRAINT `task_ibfk_2` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
