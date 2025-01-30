-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2025 at 07:42 AM
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
-- Database: `db_evoting`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `aid` int(11) NOT NULL,
  `admin_username` varchar(30) NOT NULL,
  `admin_password` varchar(30) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`aid`, `admin_username`, `admin_password`, `time_stamp`) VALUES
(1, 'admin', 'admin123', '2025-01-30 06:34:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_candidates`
--

CREATE TABLE `tbl_candidates` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_candidates`
--

INSERT INTO `tbl_candidates` (`id`, `name`, `photo`, `description`, `status`, `created_at`) VALUES
(1, 'Rahul Gandhi', 'uploads/rahul.jpeg', 'Meet Rahul Gandhi, a 53-year-old Member of Parliament from Indian National Congress, contesting from Wayanad, Kerala. Rahul Gandhi holds a Post Graduate degree. According to the latest disclosures.', 'active', '2025-01-29 21:01:43'),
(4, 'Narendra Modi', 'uploads/modi.jpeg', 'Narendra Damodardas Modi is an Indian politician who has been serving as the prime minister of India since 2014. Modi was the chief minister of Gujarat from 2001 to 2014 and is the member of parliament for Varanasi.', 'active', '2025-01-30 03:52:47'),
(6, 'mamata banerjee', 'uploads/mamta.jpg', 'Mamata Banerjee is an Indian politician who is serving as the eighth and current chief minister of the Indian state of West Bengal since 20 May 2011, the first woman to hold the office.', 'active', '2025-01-30 03:54:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(5) NOT NULL,
  `full_name` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `voter_id` int(10) NOT NULL,
  `voted_for` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `full_name`, `email`, `voter_id`, `voted_for`) VALUES
(17, 'Mohammed', 'althaf@gmail.com', 7894567, 'Rahul Gandhi 1'),
(18, 'ahmad', 'ahmad@gmail.com', 457896, 'mamata banerjee'),
(19, 'amal', 'amal@gmail.com', 789458, 'Rahul Gandhi 1'),
(20, 'ashiq', 'ashiq@gmail.com', 784565, 'Rahul Gandhi 1'),
(21, 'John Doe', 'johndoe@email.com', 123456, 'Narendra Modi'),
(22, 'Rahul Sharma', 'rahul.sharma@email.com', 234567, 'Narendra Modi'),
(23, 'Priya Mehta', 'priya.mehta@email.com', 345678, 'mamata banerjee'),
(24, 'Arjun Singh', 'arjun.singh@email.com', 456789, 'Rahul Gandhi 1'),
(25, 'Ayesha Khan', 'ayesha.khan@email.com', 567890, 'mamata banerjee'),
(26, 'Ramesh Kumar', 'ramesh.kumar@email.com', 678901, 'Rahul Gandhi 1'),
(27, 'Neha Patel', 'neha.patel@email.com', 789012, 'mamata banerjee'),
(28, 'Sameer Yadav', 'sameer.yadav@email.com', 890123, 'Narendra Modi'),
(29, 'Manisha Gupta', 'manisha.gupta@email.com', 901234, 'mamata banerjee'),
(30, 'Vikram Reddy', 'vikram.reddy@email.com', 12345, 'Rahul Gandhi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `tbl_candidates`
--
ALTER TABLE `tbl_candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_candidates`
--
ALTER TABLE `tbl_candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
