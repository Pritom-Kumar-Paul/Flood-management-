-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2024 at 06:18 AM
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
-- Database: `floodmanagementsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task`
--

CREATE TABLE `tbl_task` (
  `t_id` int(11) NOT NULL,
  `t_type_rescue` text NOT NULL,
  `t_type_medical` text NOT NULL,
  `t_type_food` text NOT NULL,
  `t_number_of_people` int(11) NOT NULL,
  `t_address` text NOT NULL,
  `t_contact_person` text NOT NULL,
  `t_contact_person_phone_number` text NOT NULL,
  `t_details` text NOT NULL,
  `t_task_assigned_person` int(11) NOT NULL,
  `t_task_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_task`
--

INSERT INTO `tbl_task` (`t_id`, `t_type_rescue`, `t_type_medical`, `t_type_food`, `t_number_of_people`, `t_address`, `t_contact_person`, `t_contact_person_phone_number`, `t_details`, `t_task_assigned_person`, `t_task_status`) VALUES
(3, '1', '1', '0', 3, 'Tista, Lalmonirhat', 'Junayed', '01597536842', 'One of the surviver is child.', 0, 1),
(4, '1', '0', '1', 9, 'Gongar chor, Rangpur', 'Jafor', '01486275391', 'Two families are surviving. They do not need to be rescued. They just need some food.', 6, 2),
(5, '1', '0', '1', 4, 'Kalmati, Lalmonirhat', 'Habib', '01824695730', 'Just rescue them!', 5, 2),
(6, '1', '1', '0', 4, '', 'Habib', '01824695730', 'Just rescue them!', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `u_id` int(11) NOT NULL,
  `u_first_name` varchar(25) NOT NULL,
  `u_last_name` varchar(25) NOT NULL,
  `u_email` varchar(100) NOT NULL,
  `u_phone` text NOT NULL,
  `u_occupation` varchar(20) NOT NULL,
  `u_blood_group` varchar(20) NOT NULL,
  `u_know_swimming` text NOT NULL,
  `u_present_area` text NOT NULL,
  `u_password` text NOT NULL,
  `u_image` text NOT NULL,
  `u_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`u_id`, `u_first_name`, `u_last_name`, `u_email`, `u_phone`, `u_occupation`, `u_blood_group`, `u_know_swimming`, `u_present_area`, `u_password`, `u_image`, `u_role`) VALUES
(3, 'Muntasher', 'Morshed', 'abc@gmail.com', '01518958306', 'Job Holder', 'B+', '1', 'Keraniganj, Dhaka', '25f9e794323b453885f5181f1b624d0b', '8693199994721351731253271.jpg', 1),
(4, 'muntasher', 'morshed', 'mms@gmail.com', '01518958306', 'Student', 'B+', '1', 'Keraniganj, Dhaka', '25f9e794323b453885f5181f1b624d0b', '882236204655621731297406.jpg', 2),
(5, 'Shourav', 'Muntasher', 'sm@gmail.com', '01883266092', 'Student', 'B +', '0', 'Mohammadpur, Dhaka', '25f9e794323b453885f5181f1b624d0b', '2331025306633171731385758.jpg', 2),
(6, 'Morshed', 'Shourav', 'ms@gmail.com', '01776886467', 'Student', 'B+', '0', 'Mohammadpur, Dhaka', '25f9e794323b453885f5181f1b624d0b', '3297127658885191731385924.jpg', 2),
(7, 'Murshid', 'Jamil', 'mj@outlook.com', '01122334455', 'Student', 'B+', '0', 'Uttara, Dhaka', '25f9e794323b453885f5181f1b624d0b', '634166161746901731508290.jpg', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_task`
--
ALTER TABLE `tbl_task`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_task`
--
ALTER TABLE `tbl_task`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
