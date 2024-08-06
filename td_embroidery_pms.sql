-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2024 at 02:33 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `td_embroidery_pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `buyerdetails`
--

CREATE TABLE `buyerdetails` (
  `InternalId` int(10) NOT NULL,
  `BuyerID` varchar(10) NOT NULL,
  `Title` varchar(5) NOT NULL,
  `BuyerName` varchar(255) NOT NULL,
  `NIC_BRNo` varchar(15) NOT NULL,
  `Address` text NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Telephone` int(10) NOT NULL,
  `Mobile` int(10) NOT NULL,
  `FaxNo` int(10) NOT NULL,
  `Website` varchar(100) NOT NULL,
  `ContactPersonName` varchar(100) NOT NULL,
  `ContactPersonNumber` int(10) NOT NULL,
  `RegisteredDate` date NOT NULL,
  `LastOrderDate` date NOT NULL,
  `TotalOrder` int(50) NOT NULL,
  `PendingPayments` int(50) NOT NULL,
  `UseStstus` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buyerdetails`
--

INSERT INTO `buyerdetails` (`InternalId`, `BuyerID`, `Title`, `BuyerName`, `NIC_BRNo`, `Address`, `Email`, `Telephone`, `Mobile`, `FaxNo`, `Website`, `ContactPersonName`, `ContactPersonNumber`, `RegisteredDate`, `LastOrderDate`, `TotalOrder`, `PendingPayments`, `UseStstus`) VALUES
(1, 'BUY000001', 'Mrs.', 'Amila Dissanayake', '12322245', '67 2 Dambuwawaththa Kinigama  Buthpitiya', 'amilasissa@gmail.com', 717788845, 717788845, 717766654, 'www.adDesign.com', '0000000PRABUDDHA ', 717766633, '2024-02-12', '0000-00-00', 0, 0, 'Active'),
(2, 'BUY000002', 'Mrs.', 'Sumith sandaruwan', '12322245', '420 A R A De Mel Mw Colombo 03', 'sampath121@gmail.com', 717788845, 717788845, 717766654, 'www.Sampathem .com', '0Sadun Kumara', 717766654, '2021-08-12', '0000-00-00', 0, 0, 'Active'),
(3, 'BUY000003', 'Mrs.', 'M.A.P. Dissanayake', '12322245', 'No 46 1/1 Lauries Road, Colombo 04SRI LANKA', 'dissagim@outlook.com', 713388845, 717988845, 717666654, 'www.gim.com', 'Sumith Kalupahana', 717586654, '2021-08-22', '0000-00-00', 0, 0, 'Active'),
(4, 'BUY000004', 'Mr.', 'Sudarshan Perera', '881230996V', '279 Dr Danister De Silva Mw Colombo 09', '43kjm6c3iet@temporary-mail.net', 717788845, 717788845, 717766654, 'www.sgs.com', 'Senaka Padmakumara', 777766654, '2021-09-12', '0000-00-00', 0, 0, 'Active'),
(5, 'BUY000005', 'Mr.', 'kamal sandaruwan', '12322245', '354 Andiris Mw Rattanapitiya Boralesgamuwa', 'clarissxsarias@gmail.com', 717788845, 717788845, 717766654, 'www.fiver.com', 'Kalinga  Pannaseeha', 777566654, '2021-09-12', '0000-00-00', 0, 0, 'Inactive'),
(6, 'BUY000006', 'Mrs.', 'Kamal Sandaruwan', '12322245', '045 Tissa Avenue Melder Place Nugegoda', 'kamal_ks@gmail.com', 717788845, 717788845, 717766654, 'www.ksgarment.com', '0Sumedaha Kularathne', 776366654, '2021-09-12', '0000-00-00', 0, 0, 'Active'),
(7, 'BUY000007', 'Mrs.', 'Sithum Sisara', '881230996V', '278,  Kandiroad, Peliyagoda', 'sithum@gmail.com', 717788845, 717788845, 717766654, 'www.domgamar.com', '0Namal perera', 717906654, '2021-09-12', '0000-00-00', 0, 0, 'Active'),
(8, 'BUY000008', 'Mrs.', 'Shashika  Jayasinghe', '12322245', '	Carlton House 466/2/2 Galle Road Colombo 033', 'clwwsarissarias@gmail.com', 717788845, 717788845, 355445, 'www.ooosparkly.com', 'Lasika  Athulathmudali', 778966654, '2021-09-12', '0000-00-00', 0, 0, 'Active'),
(9, 'BUY000009', 'Mr.', 'Amitha  Obeyesekere', '12322245', '81-3/F, Church Road', 'go1ppy4hr4v@temporary-mail.net', 717788845, 717788845, 717766654, 'www.fivzcer.com', 'Akila  Attygale', 775566654, '2021-09-12', '0000-00-00', 0, 0, 'Active'),
(10, 'BUY000010', 'Mr.', 'Sudath Perera', '1234', '122,Gampaha', 'sudath@gmail.com', 717788845, 717788845, 355445, 'www.sudath.com', '00Dilshani', 777766886, '2021-09-01', '0000-00-00', 0, 0, 'Active'),
(11, 'BUY000011', 'Mr.', 'Nimthaki  Herath', '12322245', '139/1 Kesbewa PYL', 'prabudzdedhafbs@gmail.com', 717788845, 717788845, 355445, 'www.opel.com', 'Krishani  Wichramasinghe', 777767854, '2021-10-01', '0000-00-00', 0, 0, 'Inactive'),
(12, 'BUY000012', 'Mr.', 'Sumeda Kumararathne', '781230996V', '65/3, Kandy Rd, Yakkala', 'sumeda.kuma@gmail.com', 717788221, 332222883, 0, '', 'Samantha Kumara', 0, '2021-04-01', '0000-00-00', 0, 0, 'Inactive'),
(13, 'BUY000013', 'Mr.', 'K.S.P. Thennakoon', '881230996V', '367, KandiRd, Yakkala', 'koon@gmail.com', 718877722, 718822288, 887727772, 'www.abc.com', 'senaka godahewa', 772277727, '2021-07-07', '0000-00-00', 0, 0, 'Inactive'),
(14, 'BUY000014', 'Miss.', 'Ssantha Perera', '07772', '67 2 Dambuwawaththa Kinigama  Buthpitiya', 'prabuddha1986@gmail.com', 717788845, 717788845, 717766654, 'www.ksgarment.com', 'PRABUDDHA LAKMAL SAMARASINGHE', 717766654, '2021-12-11', '0000-00-00', 0, 0, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `finished_order_details`
--

CREATE TABLE `finished_order_details` (
  `InternalId` int(11) NOT NULL,
  `OrderId` varchar(10) NOT NULL,
  `FinishDate` date NOT NULL,
  `GoodPcs` int(10) NOT NULL,
  `DamagedPcs` int(10) NOT NULL,
  `DamagePresentage` int(3) NOT NULL,
  `Remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `finished_order_details`
--

INSERT INTO `finished_order_details` (`InternalId`, `OrderId`, `FinishDate`, `GoodPcs`, `DamagedPcs`, `DamagePresentage`, `Remarks`) VALUES
(1, 'ORD000008', '2021-10-08', 75, 3, 0, 'ddd'),
(2, 'ORD000001', '2021-10-08', 55, 3, 0, 'ttt'),
(6, 'ORD000007', '2021-11-11', 50, 5, 9, '44'),
(7, 'ORD000005', '2021-11-15', 64, 2, 3, 'dd'),
(9, 'ORD000015', '2021-12-10', 134, 6, 4, 'Done'),
(10, 'ORD000002', '2021-12-11', 63, 4, 6, 'dd'),
(11, 'ORD000016', '2024-04-17', 25, 8, 24, '');

-- --------------------------------------------------------

--
-- Table structure for table `good_issue_note`
--

CREATE TABLE `good_issue_note` (
  `InternalId` int(20) NOT NULL,
  `GIR_Number` varchar(10) NOT NULL,
  `Date` date NOT NULL,
  `OrderId` varchar(10) NOT NULL,
  `VehicleNo` varchar(15) NOT NULL,
  `DeliveryTo` varchar(50) NOT NULL,
  `Discription` text NOT NULL,
  `Remarks` text NOT NULL,
  `Status` varchar(10) NOT NULL,
  `RecordeStatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `good_issue_note`
--

INSERT INTO `good_issue_note` (`InternalId`, `GIR_Number`, `Date`, `OrderId`, `VehicleNo`, `DeliveryTo`, `Discription`, `Remarks`, `Status`, `RecordeStatus`) VALUES
(1, 'GIN000001', '2021-09-28', 'ORD000001', '123_112', 'Colombo', 'Quickly', 'xxx', 'Delivered', 'Active'),
(2, 'GIN000002', '2023-04-25', 'ORD000002', '43', 'test', 'test', '', 'Delivered', 'Active'),
(3, 'GIN000003', '2024-04-25', 'ORD000005', '43', 'test', '', '', 'Delivered', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `InternalId` int(10) NOT NULL,
  `invoiceId` varchar(10) NOT NULL,
  `Date` date NOT NULL,
  `BuyerID` varchar(10) NOT NULL,
  `GrossAmount` decimal(10,2) NOT NULL,
  `LastBalance` decimal(10,2) NOT NULL,
  `DiscountRate` decimal(10,2) NOT NULL,
  `TotalAmount` decimal(10,2) NOT NULL,
  `Remarks` text NOT NULL,
  `Status` varchar(10) NOT NULL,
  `RecordStatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`InternalId`, `invoiceId`, `Date`, `BuyerID`, `GrossAmount`, `LastBalance`, `DiscountRate`, `TotalAmount`, `Remarks`, `Status`, `RecordStatus`) VALUES
(1, 'INV000001', '2021-10-08', 'BUY000001', '3080.00', '0.00', '0.00', '3080.00', ' ', 'null', 'Active'),
(3, 'INV000002', '2021-10-08', 'BUY000001', '10945.00', '0.00', '4.00', '10507.20', ' ', 'null', 'Active'),
(4, 'INV000003', '2021-10-09', 'BUY000001', '8580.00', '0.00', '4.00', '8236.80', ' ', 'null', 'Active'),
(5, 'INV000004', '2021-11-03', 'BUY000007', '4356.00', '0.00', '4.00', '4181.76', ' ', 'null', 'Inactive'),
(6, 'INV000005', '2021-11-10', 'BUY000011', '4840.00', '0.00', '0.00', '4840.00', ' ', 'null', 'Inactive'),
(8, 'INV000006', '2021-12-06', 'BUY000001', '1288.00', '0.00', '0.00', '1288.00', ' ', 'null', 'Active'),
(9, 'INV000007', '2021-12-06', 'BUY000001', '7260.00', '0.00', '0.00', '7260.00', ' ', 'null', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `InternalId` int(10) NOT NULL,
  `invoiceId` varchar(10) NOT NULL,
  `Date` date NOT NULL,
  `BuyerID` varchar(10) NOT NULL,
  `OrderId` varchar(10) NOT NULL,
  `Artwork` varchar(255) NOT NULL,
  `Qty` int(10) NOT NULL,
  `Unite_Price` decimal(10,2) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `RecordeStatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`InternalId`, `invoiceId`, `Date`, `BuyerID`, `OrderId`, `Artwork`, `Qty`, `Unite_Price`, `Amount`, `RecordeStatus`) VALUES
(1, 'INV000001', '2021-10-08', 'BUY000001', 'ORD000001', '../order_images/721338204.png', 56, '55.00', '3080.00', 'Active'),
(2, 'INV000002', '2021-10-08', 'BUY000001', 'ORD000001', '../order_images/721338204.png', 56, '77.00', '4312.00', 'Active'),
(3, 'INV000002', '2021-10-08', 'BUY000001', 'ORD000002', '../order_images/1851594752.png', 67, '99.00', '6633.00', 'Active'),
(4, 'INV000003', '2021-10-09', 'BUY000001', 'ORD000002', '../order_images/1851594752.png', 67, '55.00', '3685.00', 'Active'),
(5, 'INV000003', '2021-10-09', 'BUY000001', 'ORD000007', '../order_images/877656527.png', 55, '89.00', '4895.00', 'Active'),
(6, 'INV000004', '2021-11-03', 'BUY000007', 'ORD000005', '../order_images/744891173.png', 66, '66.00', '4356.00', 'Active'),
(7, 'INV000005', '2021-11-10', 'BUY000011', 'ORD000009', '../order_images/49284372.png', 88, '55.00', '4840.00', 'Active'),
(8, 'INV000005', '2021-11-10', 'BUY000011', 'ORD000009', '../order_images/49284372.png', 88, '55.00', '4840.00', 'Active'),
(9, 'INV000006', '2021-12-06', 'BUY000001', 'ORD000001', '../order_images/721338204.png', 56, '23.00', '1288.00', 'Active'),
(10, 'INV000007', '2021-12-06', 'BUY000001', 'ORD000002', '../order_images/1851594752.png', 67, '44.00', '2948.00', 'Active'),
(11, 'INV000007', '2021-12-06', 'BUY000001', 'ORD000001', '../order_images/721338204.png', 56, '77.00', '4312.00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `InternalId` int(20) NOT NULL,
  `MaterialID` varchar(15) NOT NULL,
  `MaterialName` varchar(255) NOT NULL,
  `UoM` varchar(15) NOT NULL,
  `Qt` int(20) NOT NULL,
  `RecordeStatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`InternalId`, `MaterialID`, `MaterialName`, `UoM`, `Qt`, `RecordeStatus`) VALUES
(1, 'MAT000001', 'Paddings', 'Meters', 2137483647, 'Active'),
(2, 'MAT000002', 'Fusing', 'Yard', 365, 'Active'),
(3, 'MAT000003', 'String-Red', 'Cones', 490, 'Active'),
(4, 'MAT000007', 'String-Blue', 'Cones', 6, 'Active'),
(5, 'MAT000004', 'String-White', 'Cones', 0, 'Active'),
(6, 'MAT000005', 'String-Yellow', 'Cones', 0, 'Active'),
(15, 'MAT000006', 'string-black', 'Cones', 5, 'Active'),
(17, 'MAT000008', 'string-off White', 'Cones', 34, 'Active'),
(18, 'MAT000009', 'string-black', 'Meters', 1, 'Active'),
(19, ' MAT000010 ', 'String-Pink', 'Cones', 0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `materials_stocks_in`
--

CREATE TABLE `materials_stocks_in` (
  `InternalId` int(11) NOT NULL,
  `MaterialID` varchar(20) NOT NULL,
  `StockInDate` date NOT NULL,
  `Qt` int(20) NOT NULL,
  `Remarks` varchar(250) NOT NULL,
  `SupplerName` varchar(255) NOT NULL,
  `SupplerTP` int(10) NOT NULL,
  `SupplerEmail` varchar(100) NOT NULL,
  `SupplerAddress` varchar(255) NOT NULL,
  `RecordeStatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materials_stocks_in`
--

INSERT INTO `materials_stocks_in` (`InternalId`, `MaterialID`, `StockInDate`, `Qt`, `Remarks`, `SupplerName`, `SupplerTP`, `SupplerEmail`, `SupplerAddress`, `RecordeStatus`) VALUES
(1, 'MAT000008', '2021-10-09', 34, 'hhh', 'kumara & sons', 717558457, 'prabu@gmail.com', '67 2 Dambuwawaththa Kinigama  Buthpitiya', 'Active'),
(2, 'MAT000009', '2021-10-09', 44, 'gg', 'kumara & sons', 717788845, 'prabu@gmail.com', '67 2 Dambuwawaththa Kinigama  Buthpitiya', 'Active'),
(3, 'MAT000003', '2021-11-10', 500, 'hhh', 'Suresh&Son', 716633362, 'suresh@gmail.com', '678,Kandy Rd, Kiribathgoda', 'Active'),
(4, 'MAT000001', '2022-10-04', 2147483647, '', '', 0, '', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `materials_stocks_out`
--

CREATE TABLE `materials_stocks_out` (
  `InternalId` int(20) NOT NULL,
  `MaterialID` varchar(15) NOT NULL,
  `Qt` int(50) NOT NULL,
  `StockOutDate` date NOT NULL,
  `StockOutTime` time NOT NULL,
  `HandoverTo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materials_stocks_out`
--

INSERT INTO `materials_stocks_out` (`InternalId`, `MaterialID`, `Qt`, `StockOutDate`, `StockOutTime`, `HandoverTo`) VALUES
(0, 'MAT000001', 60000, '2021-09-15', '11:27:07', '');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `InternalId` int(11) NOT NULL,
  `operationId` varchar(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `activityDoneBy` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` int(1) NOT NULL,
  `RecordeStatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`InternalId`, `operationId`, `message`, `activityDoneBy`, `date`, `time`, `status`, `RecordeStatus`) VALUES
(1, 'SAM000018', 'New Sample added', 'By Tharanga Roopasinghe', '2021-11-11', '04:40:47', 1, ''),
(2, '', 'New Material added', 'By Tharanga Roopasinghe', '2021-11-11', '10:12:05', 1, ''),
(3, 'ORD000005', 'order is Finished', '', '2021-11-15', '10:31:46', 1, ''),
(4, 'ORD000005', 'order is Finished', '', '2021-11-15', '10:33:14', 1, ''),
(5, 'SAM000004', 'New Order added', 'By Tharanga Roopasinghe', '2021-11-15', '10:40:02', 1, ''),
(6, '', 'New Payment added', 'By Tharanga Roopasinghe', '2021-11-21', '01:07:53', 1, ''),
(7, '', 'New Payment added', 'By Tharanga Roopasinghe', '2021-11-23', '06:11:30', 1, ''),
(8, '', 'New Payment added', 'By Tharanga Roopasinghe', '2021-11-23', '08:53:52', 1, ''),
(9, '', 'New Payment added', 'By Tharanga Roopasinghe', '2021-11-23', '08:54:08', 1, ''),
(10, '', 'New Payment added', 'By Tharanga Roopasinghe', '2021-11-23', '08:54:22', 1, ''),
(11, '', 'New Payment added', 'By Tharanga Roopasinghe', '2021-11-23', '09:29:06', 1, ''),
(12, 'SAM000019', 'New Sample added', 'By Dakshina SriMal', '2021-11-24', '09:27:39', 1, ''),
(13, '', 'New Buyer added', 'By Tharanga Roopasinghe', '2021-11-26', '02:41:07', 1, ''),
(14, 'SAM000020', 'New Sample added', 'By Tharanga Roopasinghe', '2021-11-29', '07:24:08', 1, ''),
(15, 'SAM000021', 'New Sample added', 'By Tharanga Roopasinghe', '2021-11-29', '07:39:04', 1, ''),
(16, '', 'New Quotation Created', 'By Tharanga Roopasinghe', '2021-12-06', '06:42:05', 1, ''),
(17, '', 'New Quotation Created', 'By Tharanga Roopasinghe', '2021-12-06', '06:42:05', 1, ''),
(18, '', 'New Invoice Created', 'By Tharanga Roopasinghe', '2021-12-06', '06:44:00', 1, ''),
(19, '', 'New Invoice Created', 'By Tharanga Roopasinghe', '2021-12-06', '06:45:02', 1, ''),
(20, '', 'New Invoice Created', 'By Tharanga Roopasinghe', '2021-12-06', '06:45:02', 1, ''),
(21, 'SAM000022', 'New Sample added', 'By Tharanga Roopasinghe', '2021-12-10', '05:25:47', 1, ''),
(22, 'SAM000023', 'New Sample added', 'By Tharanga Roopasinghe', '2021-12-10', '05:32:23', 1, ''),
(23, 'SAM000001', 'New Sample added', 'By Tharanga Roopasinghe', '2021-12-10', '05:33:30', 1, ''),
(24, 'ORD000015', 'order is Finished', '', '2021-12-11', '07:12:04', 1, ''),
(25, '', 'New Buyer added', 'By Tharanga Roopasinghe', '2021-12-11', '11:34:32', 1, ''),
(26, 'SAM000002', 'New Sample added', 'By Tharanga Roopasinghe', '2021-12-11', '11:35:15', 1, ''),
(27, 'SAM000001', 'New Order added', 'By Tharanga Roopasinghe', '2021-12-11', '11:36:34', 1, ''),
(28, 'ORD000002', 'order is Finished', '', '2021-12-11', '11:37:14', 1, ''),
(29, '', 'New Quotation Created', 'By Tharanga Roopasinghe', '2021-12-11', '11:39:11', 1, ''),
(30, '', 'New Quotation Created', 'By Tharanga Roopasinghe', '2021-12-11', '11:39:11', 1, ''),
(31, '', 'New Material added', 'By Tharanga Roopasinghe', '2021-12-11', '11:40:35', 1, ''),
(32, '', 'New Quotation Created', 'By Tharanga Roopasinghe', '2021-12-11', '01:10:38', 1, ''),
(33, 'QUO000005', 'New Quotation Created', 'By Tharanga Roopasinghe', '2021-12-11', '01:12:31', 1, ''),
(34, '', 'New Material added', 'By Tharanga Roopasinghe', '2022-08-23', '11:12:51', 1, ''),
(35, '', 'Material Stocks added ', 'By  ', '2022-10-04', '07:18:30', 1, ''),
(36, '', 'Material Used ', 'By Tharanga Roopasinghe', '2022-10-04', '07:18:47', 1, ''),
(37, '', 'New GIN added', 'By Tharanga Roopasinghe', '2023-04-25', '08:42:59', 1, ''),
(38, 'SAM000003', 'New Sample added', 'By Tharanga Roopasinghe', '2024-04-11', '08:17:41', 1, ''),
(39, 'Amila Dissa', 'Buyer Details Updated', 'By  ', '2024-04-11', '09:53:47', 0, ''),
(40, 'Amila Dissa', 'Buyer Details Updated', 'By Tharanga Roopasinghe', '2024-04-11', '09:54:59', 1, ''),
(41, 'Amila Dissa', 'Buyer Details Updated', 'By Tharanga Roopasinghe', '2024-04-11', '09:57:10', 0, ''),
(42, 'Sudath Pere', 'Buyer Details Updated', 'By Tharanga Roopasinghe', '2024-04-11', '09:57:17', 0, ''),
(43, 'Kamal Sanda', 'Buyer Details Updated', 'By Tharanga Roopasinghe', '2024-04-11', '09:57:20', 0, ''),
(44, 'Sudath Pere', 'Buyer Details Updated', 'By Tharanga Roopasinghe', '2024-04-11', '10:00:03', 0, ''),
(45, 'Sithum Sisa', 'Buyer Details Updated', 'By Tharanga Roopasinghe', '2024-04-11', '10:09:57', 0, ''),
(46, 'ORD000016', 'order is Finished', '', '2024-04-12', '06:10:03', 0, ''),
(47, '', 'New GIN added', 'By Tharanga Roopasinghe', '2024-04-12', '06:12:18', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `InternalId` int(11) NOT NULL,
  `OrderId` varchar(10) NOT NULL,
  `OrderDate` date NOT NULL,
  `BuyerID` varchar(10) NOT NULL,
  `OrderDescription` text NOT NULL,
  `Cost` decimal(10,2) NOT NULL,
  `StyleNo` varchar(20) NOT NULL,
  `BundleNumber` varchar(20) NOT NULL,
  `Qty` int(20) NOT NULL,
  `Ordermaterial` text NOT NULL,
  `Artwork` varchar(255) NOT NULL,
  `Remarks` text NOT NULL,
  `Status` varchar(10) NOT NULL,
  `RecordeStatus` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`InternalId`, `OrderId`, `OrderDate`, `BuyerID`, `OrderDescription`, `Cost`, `StyleNo`, `BundleNumber`, `Qty`, `Ordermaterial`, `Artwork`, `Remarks`, `Status`, `RecordeStatus`) VALUES
(1, 'ORD000001', '2021-10-06', '', ' ', '44.00', 'CD1124', 'X116', 77, ' ', '../order_images/2008549182.jpg', ' ', 'Ongoing', 'Active'),
(2, 'ORD000002', '2021-10-08', '', ' ', '0.00', 'CD1124', 'X1s121', 67, ' ', '../order_images/98458573.jpg', ' ', 'Ongoing', 'Active'),
(3, 'ORD000003', '2021-10-06', '--Select B', ' ', '0.00', 'CD1124', 'X1s121', 150, ' ', '', ' ', 'Ongoing', 'Active'),
(4, 'ORD000004', '2021-10-09', 'BUY000003', ' ', '0.00', 'C11ss24', 'X1121sd', 70, ' ', '', ' ', 'Ongoing', 'Active'),
(5, 'ORD000005', '2021-10-09', 'BUY000007', ' Lorem ipsum dolor sit amet', '0.00', 'VSD1124', 'XCDs121', 66, ' Lorem ipsum dolor sit amet', '../order_images/744891173.png', ' Lorem ipsum dolor sit amet', 'Delivered', 'Active'),
(6, 'ORD000006', '2021-10-09', 'BUY000008', ' Definitions is', '0.00', 'VVD1124', 'X14451sd', 90, 'Padding, Black String', '../order_images/1453328381.png', ' Definition list', 'Ongoing', 'Active'),
(7, 'ORD000007', '2021-10-09', 'BUY000001', ' ', '0.00', 'CD1124', 'X1121sd', 55, ' ', '', ' ', 'Finish', 'Inactive'),
(8, 'ORD000008', '2021-10-09', 'BUY000002', ' consectetuer adipiscing elit.', '0.00', 'C1124', 'X1121', 78, ' consectetuer adipiscing elit.', '../order_images/2031281205.png', ' consectetuer adipiscing elit.', 'Finish', 'Active'),
(9, 'ORD000009', '2021-10-08', 'BUY000011', ' Pellentesque habitant morbi ', '0.00', 'CD1124', 'X1s121', 88, ' habitant morbi ', '../order_images/49284372.png', ' Pellentesque morbi ', 'Ongoing', ''),
(10, 'ORD000010', '2021-10-09', 'BUY000001', ' sss  ', '0.00', '22', 'X1s121', 34, ' ss  ', '../order_images/1364054822.png', ' ss  ', 'Ongoing', 'Active'),
(11, 'ORD000011', '2021-11-11', 'BUY000002', ' cap  ', '0.00', 'CD1124', 'X1121', 75, '  cap  ', '../order_images/919685221.png', '  cap  ', 'Ongoing', 'Inactive'),
(12, 'ORD000012', '2021-11-11', 'BUY000002', ' c', '0.00', 'CD1124', 'X1121', 55, ' c', '../order_images/162738030.png', ' c', 'Ongoing', 'Inactive'),
(13, 'ORD000013', '2021-11-11', 'BUY000002', ' a', '0.00', 'CD1124', 'X1121', 77, ' a', '../order_images/17174154.png', ' a', 'Ongoing', 'Inactive'),
(15, 'ORD000014', '2021-11-11', 'BUY000002', ' f  ', '0.00', 'CD1124', 'X1121', 75, ' f  ', '../order_images/558599057.png', ' f  ', 'Ongoing', 'Inactive'),
(16, 'ORD000015', '2021-11-09', 'BUY000001', ' A', '56.60', 'CD1124', 'X1121', 140, ' A', '../order_images/1218515022.png', ' A', 'Finish', 'Inactive'),
(17, 'ORD000016', '2021-12-11', 'BUY000001', ' ss', '55.00', '22', 'X1121', 33, ' ss', '../order_images/579645968.png', ' ss', 'Finish', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `InternalId` int(11) NOT NULL,
  `BuyerID` varchar(10) NOT NULL,
  `Paid_Total` decimal(10,2) NOT NULL,
  `Invoice_total` decimal(10,2) NOT NULL,
  `BalancePayment` decimal(10,2) NOT NULL,
  `RecordStatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`InternalId`, `BuyerID`, `Paid_Total`, `Invoice_total`, `BalancePayment`, `RecordStatus`) VALUES
(1, 'BUY00001', '0.00', '0.00', '0.00', ''),
(2, 'BUY000001', '28757.00', '13548.00', '23757.00', 'Active'),
(3, 'BUY000007', '6654.00', '818.24', '5835.76', ''),
(4, 'BUY000002', '2500.00', '5000.00', '2500.00', ''),
(5, 'BUY000003', '3566.00', '0.00', '3566.00', ''),
(6, 'BUY000004', '0.00', '0.00', '0.00', ''),
(7, 'BUY000005', '0.00', '0.00', '0.00', ''),
(8, 'BUY000006', '0.00', '0.00', '0.00', ''),
(9, 'BUY000007', '6654.00', '818.24', '5835.76', ''),
(10, 'BUY000008', '0.00', '0.00', '0.00', ''),
(11, 'BUY000010', '4455.00', '0.00', '4455.00', ''),
(12, 'BUY000009', '0.00', '0.00', '0.00', ''),
(13, 'BUY000013', '0.00', '0.00', '0.00', ''),
(14, 'BUY000014', '0.00', '0.00', '0.00', '');

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

CREATE TABLE `quotations` (
  `InternalId` int(11) NOT NULL,
  `quotationId` varchar(10) NOT NULL,
  `BuyerID` varchar(10) NOT NULL,
  `Date` date NOT NULL,
  `GrossAmount` decimal(10,2) NOT NULL,
  `DiscountRate` decimal(10,2) NOT NULL,
  `NetAmount` decimal(10,2) NOT NULL,
  `RecordStstus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quotations`
--

INSERT INTO `quotations` (`InternalId`, `quotationId`, `BuyerID`, `Date`, `GrossAmount`, `DiscountRate`, `NetAmount`, `RecordStstus`) VALUES
(1, 'QUO000001', 'BUY000001', '2021-11-04', '7029.00', '5.00', '6677.55', 'Active'),
(2, 'QUO000002', 'BUY000006', '2021-11-05', '12309.00', '5.00', '11693.55', 'Active'),
(3, 'QUO000003', 'BUY000001', '2021-12-06', '2948.00', '5.00', '2800.60', 'Active'),
(4, 'QUO000004', 'BUY000001', '2021-12-11', '6358.00', '4.00', '6103.68', 'Active'),
(5, 'QUO000005', 'BUY000001', '2021-12-11', '3344.00', '5.00', '3176.80', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `quotations_items`
--

CREATE TABLE `quotations_items` (
  `InternalId` int(10) NOT NULL,
  `quotationId` varchar(10) NOT NULL,
  `BuyerID` varchar(10) NOT NULL,
  `Date` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `qty` int(10) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `RecordStstus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quotations_items`
--

INSERT INTO `quotations_items` (`InternalId`, `quotationId`, `BuyerID`, `Date`, `description`, `qty`, `rate`, `amount`, `RecordStstus`) VALUES
(1, 'QUO000001', 'BUY000001', '2021-11-04', 'Pocket', 76, '44.00', '3344.00', 'Active'),
(2, 'QUO000001', 'BUY000001', '2021-11-04', 'Coler', 55, '67.00', '3685.00', 'Active'),
(3, 'QUO000002', 'BUY000006', '2021-11-05', 'Pocket', 76, '44.00', '3344.00', 'Active'),
(4, 'QUO000002', 'BUY000006', '2021-11-05', 'hand', 55, '67.00', '3685.00', 'Active'),
(5, 'QUO000002', 'BUY000006', '2021-11-05', 'cap', 80, '66.00', '5280.00', 'Active'),
(6, 'QUO000003', 'BUY000001', '2021-12-06', 'Pocket', 44, '23.00', '1012.00', 'Active'),
(7, 'QUO000003', 'BUY000001', '2021-12-06', 'Pocket', 44, '44.00', '1936.00', 'Active'),
(8, 'QUO000004', 'BUY000001', '2021-12-11', 'Pocket', 76, '55.00', '4180.00', 'Active'),
(9, 'QUO000004', 'BUY000001', '2021-12-11', 'Frount', 66, '33.00', '2178.00', 'Active'),
(10, 'QUO000005', 'BUY000001', '2021-12-11', 'dd', 76, '44.00', '3344.00', 'Active'),
(11, 'QUO000005', 'BUY000001', '2021-12-11', 'dd', 76, '44.00', '3344.00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `samples`
--

CREATE TABLE `samples` (
  `InternalIdS` int(10) NOT NULL,
  `SampleId` varchar(10) NOT NULL,
  `Date` date NOT NULL,
  `OrderId` varchar(15) NOT NULL,
  `BuyerID` varchar(10) NOT NULL,
  `SampleDescription` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `RecordeStatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `samples`
--

INSERT INTO `samples` (`InternalIdS`, `SampleId`, `Date`, `OrderId`, `BuyerID`, `SampleDescription`, `image`, `RecordeStatus`) VALUES
(1, 'SAM000001', '2021-12-10', 'ORD000016', 'BUY000001', 'Cap', '../sample_images/2025402167.jpg', 'Active'),
(2, 'SAM000002', '2021-12-11', '--Select Order ', 'BUY000001', 'Cpa', '../sample_images/1731237624.png', 'Active'),
(3, 'SAM000003', '2024-04-10', '--Select Order ', 'BUY000002', 'Test Sample', '../sample_images/986965728.jpg', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `InternalId2` int(10) NOT NULL,
  `PaymentID` varchar(10) NOT NULL,
  `BuyerID` varchar(10) NOT NULL,
  `PaymentDate` date NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `Remarks` text NOT NULL,
  `RecordeStatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`InternalId2`, `PaymentID`, `BuyerID`, `PaymentDate`, `Amount`, `Remarks`, `RecordeStatus`) VALUES
(1, 'PAY000001', 'BUY000006', '2021-11-23', '3500.00', 'ccc', 'Active'),
(2, 'PAY000002', 'BUY000003', '2021-11-09', '3566.00', 'gggg', 'Active'),
(3, 'PAY000003', 'BUY000007', '2021-11-17', '6654.00', 'XXX', 'Active'),
(4, 'PAY000004', 'BUY000010', '2021-11-18', '4455.00', 'ZZZ', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `ID` int(20) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `IsAdmin` varchar(5) NOT NULL,
  `useStatus` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`ID`, `UserName`, `Password`, `FirstName`, `LastName`, `Email`, `IsAdmin`, `useStatus`) VALUES
(1, 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'Saman', 'Franando', 'saman@gmail.com', 'Admin', ''),
(3, 'kasun', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Kasun', 'Kumara', 'kasun@gmail.com', 'User', ''),
(4, 'prabuddha', 'c32aecb07f844057067e362fde8898d0921bea31', 'Prabuddha', 'Samarasinghe', 'prabuddha@gmail.com', 'User', ''),
(5, 'Tharanga123', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Tharanga', 'Roopasinghe', 'tharanga@gmail.com', 'Admin', ''),
(6, 'Dakshina', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Dakshina', 'Sri Mal', 'Srimal@gmail.com', 'User', ''),
(7, 'Amal', 'a5d54b3002ab8bcea36e76781bacf0d3058360df', 'Amal', 'Rukshan', 'amal@gmail.com', 'User', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buyerdetails`
--
ALTER TABLE `buyerdetails`
  ADD PRIMARY KEY (`BuyerID`),
  ADD UNIQUE KEY `InternalId` (`InternalId`);

--
-- Indexes for table `finished_order_details`
--
ALTER TABLE `finished_order_details`
  ADD PRIMARY KEY (`InternalId`),
  ADD UNIQUE KEY `OrderId` (`OrderId`);

--
-- Indexes for table `good_issue_note`
--
ALTER TABLE `good_issue_note`
  ADD PRIMARY KEY (`InternalId`),
  ADD UNIQUE KEY `GIR_Number` (`GIR_Number`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`InternalId`),
  ADD UNIQUE KEY `invoiceId` (`invoiceId`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`InternalId`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`InternalId`),
  ADD UNIQUE KEY `MaterialID` (`MaterialID`);

--
-- Indexes for table `materials_stocks_in`
--
ALTER TABLE `materials_stocks_in`
  ADD PRIMARY KEY (`InternalId`);

--
-- Indexes for table `materials_stocks_out`
--
ALTER TABLE `materials_stocks_out`
  ADD PRIMARY KEY (`InternalId`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`InternalId`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`InternalId`),
  ADD UNIQUE KEY `OrderId` (`OrderId`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`InternalId`);

--
-- Indexes for table `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`InternalId`),
  ADD UNIQUE KEY `quotationId` (`quotationId`);

--
-- Indexes for table `quotations_items`
--
ALTER TABLE `quotations_items`
  ADD PRIMARY KEY (`InternalId`);

--
-- Indexes for table `samples`
--
ALTER TABLE `samples`
  ADD PRIMARY KEY (`InternalIdS`),
  ADD UNIQUE KEY `SampleId` (`SampleId`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`InternalId2`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buyerdetails`
--
ALTER TABLE `buyerdetails`
  MODIFY `InternalId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `finished_order_details`
--
ALTER TABLE `finished_order_details`
  MODIFY `InternalId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `good_issue_note`
--
ALTER TABLE `good_issue_note`
  MODIFY `InternalId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `InternalId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `InternalId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `InternalId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `materials_stocks_in`
--
ALTER TABLE `materials_stocks_in`
  MODIFY `InternalId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `InternalId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `InternalId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `InternalId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `quotations`
--
ALTER TABLE `quotations`
  MODIFY `InternalId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quotations_items`
--
ALTER TABLE `quotations_items`
  MODIFY `InternalId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `samples`
--
ALTER TABLE `samples`
  MODIFY `InternalIdS` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `InternalId2` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
