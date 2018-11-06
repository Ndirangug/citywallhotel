-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2018 at 08:42 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `citywall_reservations_mis`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkin`
--

CREATE TABLE `checkin` (
  `checkin_ID` int(11) NOT NULL,
  `date_of_checkin` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `customer_ID` int(11) NOT NULL,
  `room_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `checkouts`
--

CREATE TABLE `checkouts` (
  `checkout_ID` int(11) NOT NULL,
  `date_of_checkout` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `customer_ID` int(11) NOT NULL,
  `room_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_ID` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_ID`, `first_name`, `last_name`, `email`, `phone`) VALUES
(6, 'George', 'Ndirangu', 'ndirangu.mepawa@gmail.com', '25474649576'),
(7, 'George', 'Wachira', 'ndirangu.mepawa@outlook.com', '0746649576'),
(8, 'Kamundu', 'Kitu', 'kitu@he.com', '25474667452'),
(9, 'Kaka', 'Man', 'dssdffsf@gmail.com', '54564');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_ID` int(11) NOT NULL,
  `amount` double NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mode` varchar(255) NOT NULL,
  `ref` varchar(255) NOT NULL,
  `customer_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_ID` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expected_checkin_date` datetime NOT NULL,
  `expected_checkout_date` datetime NOT NULL,
  `room_ID` int(11) NOT NULL,
  `customer_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_ID`, `date`, `expected_checkin_date`, `expected_checkout_date`, `room_ID`, `customer_ID`) VALUES
(1, '2018-09-26 18:45:43', '0000-00-00 00:00:00', '2018-09-27 00:00:00', 45, 6),
(2, '2018-09-26 20:02:59', '0000-00-00 00:00:00', '2018-09-25 00:00:00', 71, 7),
(3, '2018-09-26 20:02:59', '0000-00-00 00:00:00', '2018-09-29 00:00:00', 74, 7),
(4, '2018-09-26 20:02:59', '0000-00-00 00:00:00', '2018-09-16 00:00:00', 83, 9);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_ID` int(11) NOT NULL,
  `room_no` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `occupancy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_ID`, `room_no`, `type`, `occupancy`) VALUES
(45, '1', 'single', 'booked'),
(46, '2', 'double', 'booked'),
(47, '3', 'double', 'booked'),
(48, '4', 'single', 'booked'),
(49, '5', 'twin', 'occupied'),
(50, '6', 'double', 'booked'),
(51, '7', 'twin', 'empty'),
(52, '8', 'single', 'empty'),
(53, '9', 'single', 'booked'),
(54, '10', 'double', 'occupied'),
(55, '11', 'double', 'empty'),
(56, '12', 'single', 'occupied'),
(57, '13', 'twin', 'booked'),
(58, '14', 'double', 'occupied'),
(59, '15', 'twin', 'occupied'),
(60, '16', 'single', 'booked'),
(61, '17', 'single', 'occupied'),
(62, '18', 'double', 'empty'),
(63, '19', 'double', 'occupied'),
(64, '20', 'single', 'occupied'),
(65, '21', 'twin', 'empty'),
(66, '22', 'double', 'occupied'),
(67, '23', 'twin', 'occupied'),
(68, '24', 'single', 'occupied'),
(69, '25', 'single', 'empty'),
(70, '26', 'double', 'occupied'),
(71, '27', 'double', 'booked'),
(72, '28', 'single', 'occupied'),
(73, '29', 'twin', 'booked'),
(74, '30', 'double', 'booked'),
(75, '31', 'twin', 'empty'),
(76, '32', 'single', 'booked'),
(77, '33', 'single', 'booked'),
(78, '34', 'double', 'occupied'),
(79, '35', 'double', 'empty'),
(80, '36', 'single', 'booked'),
(81, '37', 'twin', 'empty'),
(82, '38', 'double', 'occupied'),
(83, '39', 'twin', 'empty'),
(84, '40', 'single', 'booked'),
(85, '41', 'single', 'empty'),
(86, '42', 'double', 'booked');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkin`
--
ALTER TABLE `checkin`
  ADD PRIMARY KEY (`checkin_ID`),
  ADD KEY `customer_ID` (`customer_ID`),
  ADD KEY `room_ID` (`room_ID`);

--
-- Indexes for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD PRIMARY KEY (`checkout_ID`),
  ADD KEY `customer_ID` (`customer_ID`),
  ADD KEY `roomID` (`room_ID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_ID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_ID`),
  ADD KEY `customer_ID` (`customer_ID`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_ID`),
  ADD KEY `user_ID` (`room_ID`),
  ADD KEY `room_ID` (`customer_ID`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkin`
--
ALTER TABLE `checkin`
  MODIFY `checkin_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `checkouts`
--
ALTER TABLE `checkouts`
  MODIFY `checkout_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkin`
--
ALTER TABLE `checkin`
  ADD CONSTRAINT `checkin_customer` FOREIGN KEY (`customer_ID`) REFERENCES `customers` (`customer_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `checkin_room` FOREIGN KEY (`room_ID`) REFERENCES `rooms` (`room_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD CONSTRAINT `checkout_customer` FOREIGN KEY (`customer_ID`) REFERENCES `customers` (`customer_ID`),
  ADD CONSTRAINT `checkout_room` FOREIGN KEY (`room_ID`) REFERENCES `rooms` (`room_ID`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payment_user` FOREIGN KEY (`customer_ID`) REFERENCES `customers` (`customer_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservation_customer` FOREIGN KEY (`customer_ID`) REFERENCES `customers` (`customer_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_room` FOREIGN KEY (`room_ID`) REFERENCES `rooms` (`room_ID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
