-- phpMyAdmin SQL Dump
-- version 4.8.0-dev
-- https://www.phpmyadmin.net/
--
-- Host: 192.168.30.23
-- Generation Time: Feb 20, 2018 at 11:20 AM
-- Server version: 8.0.3-rc-log
-- PHP Version: 7.0.27-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CMS`
--

-- --------------------------------------------------------

--
-- Table structure for table `Bank`
--

CREATE TABLE `Bank` (
  `Bank_id` int(11) NOT NULL,
  `Branch_id` int(11) NOT NULL,
  `Employee_Id` int(11) NOT NULL,
  `Bank_name` int(11) NOT NULL,
  `Address` varchar(45) NOT NULL,
  `Number_of_branch` int(11) NOT NULL,
  `Remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Branches`
--

CREATE TABLE `Branches` (
  `Bank_id` int(11) NOT NULL,
  `Branch_id` int(11) NOT NULL,
  `Employee_Id` int(11) NOT NULL,
  `Branch_name` varchar(45) NOT NULL,
  `Address` varchar(45) NOT NULL,
  `Remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Building`
--

CREATE TABLE `Building` (
  `Project_id` int(11) NOT NULL,
  `Building_Id` int(11) NOT NULL,
  `Emploee_id` int(11) NOT NULL,
  `Name` varchar(45) NOT NULL,
  `Number_of_floors` int(11) NOT NULL,
  `Number_of_apartments` int(11) NOT NULL,
  `7od_id` int(11) NOT NULL,
  `Plot_id` int(11) NOT NULL,
  `Remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Checks`
--

CREATE TABLE `Checks` (
  `Project_id` int(11) NOT NULL,
  `Stage_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `Participant_id` int(11) NOT NULL,
  `Seq_num` int(11) NOT NULL,
  `Bank_id` int(11) NOT NULL,
  `Branch_id` int(11) NOT NULL,
  `Emploee_id` int(11) NOT NULL,
  `Check_Num` int(11) NOT NULL,
  `Account_number` int(11) NOT NULL,
  `Routing_number` int(11) NOT NULL,
  `Start_Date` date NOT NULL,
  `Amount` float NOT NULL,
  `Actual _date` date NOT NULL,
  `Remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `City`
--

CREATE TABLE `City` (
  `city_id` int(11) NOT NULL,
  `Emploee_id` int(11) NOT NULL,
  `Name` varchar(45) NOT NULL,
  `Remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Contract`
--

CREATE TABLE `Contract` (
  `Project_id` int(11) NOT NULL,
  `Building_id` int(11) NOT NULL,
  `Apartment_id` int(11) NOT NULL,
  `Customer_id` int(11) NOT NULL,
  `Contract_id` int(11) NOT NULL,
  `contract_type` int(11) NOT NULL,
  `Emploee_id` int(11) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Date` date NOT NULL,
  `Value` float NOT NULL,
  `Per_year` float NOT NULL,
  `Balance` float NOT NULL,
  `Remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contract Points`
--

CREATE TABLE `contract Points` (
  `Project_Id` int(11) NOT NULL,
  `Building_id` int(11) NOT NULL,
  `Section_id` int(11) NOT NULL,
  `Customer_ID` int(11) NOT NULL,
  `Contract_id` int(11) NOT NULL,
  `Seq` int(11) NOT NULL,
  `Emploee_id` int(11) NOT NULL,
  `Detail` varchar(300) NOT NULL,
  `Remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Contract_Check`
--

CREATE TABLE `Contract_Check` (
  `Project_Id` int(11) NOT NULL,
  `Building_id` int(11) NOT NULL,
  `Apartment_id` int(11) NOT NULL,
  `Customer_Id` int(11) NOT NULL,
  `Contract_id` int(11) NOT NULL,
  `Seq_Num` int(11) NOT NULL,
  `Bank_id` int(11) NOT NULL,
  `Branch_id` int(11) NOT NULL,
  `Emploee_id` int(11) NOT NULL,
  `Check_num` int(11) NOT NULL,
  `Account_number` int(11) NOT NULL,
  `Routing_number` int(11) NOT NULL,
  `Bank_name` int(11) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Expiry _date` date NOT NULL,
  `Start_date` date NOT NULL,
  `Remark` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Contract_type`
--

CREATE TABLE `Contract_type` (
  `type_id` int(11) NOT NULL,
  `Emploee_id` int(11) NOT NULL,
  `TypeDetail` varchar(45) NOT NULL,
  `Remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE `Customer` (
  `Customer_id` int(11) NOT NULL,
  `Emploee_id` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `Name` varchar(45) NOT NULL,
  `Address` varchar(45) NOT NULL,
  `Date` date NOT NULL,
  `Rate` varchar(45) NOT NULL,
  `Organization_name` varchar(45) NOT NULL,
  `State` varchar(45) NOT NULL,
  `City` varchar(45) NOT NULL,
  `Phone` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Customor_payments`
--

CREATE TABLE `Customor_payments` (
  `Project_Id` int(11) NOT NULL,
  `Building_id` int(11) NOT NULL,
  `Apartment_id ,` int(11) NOT NULL,
  `Customer_id` int(11) NOT NULL,
  `Contract_id` int(11) NOT NULL,
  `Seq_num` int(11) NOT NULL,
  `Emploee_id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `payments_amount` float NOT NULL,
  `Remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Finishing Table`
--

CREATE TABLE `Finishing Table` (
  `Project_Id` int(11) NOT NULL,
  `Building_id` int(11) NOT NULL,
  `Section_id` int(11) NOT NULL,
  `Contract_id` int(11) NOT NULL,
  `Seq` int(11) NOT NULL,
  `Emploee_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `Unit` varchar(100) NOT NULL,
  `Area` float NOT NULL,
  `Remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `General Point`
--

CREATE TABLE `General Point` (
  `Seq` int(11) NOT NULL,
  `Emploee_id` int(11) NOT NULL,
  `Details` varchar(200) NOT NULL,
  `Remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `level Details`
--

CREATE TABLE `level Details` (
  `Project_id` int(11) NOT NULL,
  `Stage_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `Emploee_id` int(11) NOT NULL,
  `Start_date` date NOT NULL,
  `End_date` date NOT NULL,
  `Status` varchar(45) NOT NULL,
  `Details` varchar(100) NOT NULL,
  `Remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Levels`
--

CREATE TABLE `Levels` (
  `stage_id` int(11) NOT NULL,
  `Levels_id` int(11) NOT NULL,
  `Emploee_id` int(11) NOT NULL,
  `Remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Participants`
--

CREATE TABLE `Participants` (
  `Project_id` int(11) NOT NULL,
  `Stages_id` int(11) NOT NULL,
  `levels_id` int(11) NOT NULL,
  `Participants_id` int(11) NOT NULL,
  `Emploee_id` int(11) NOT NULL,
  `Start_date` date NOT NULL,
  `End_date` date NOT NULL,
  `Price` int(11) NOT NULL,
  `Paid` int(11) NOT NULL,
  `Un_paid` int(11) NOT NULL,
  `Remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Payment`
--

CREATE TABLE `Payment` (
  `Project_id` int(11) NOT NULL,
  `Stages_id` int(11) NOT NULL,
  `levels_id` int(11) NOT NULL,
  `Participant_id` int(11) NOT NULL,
  `Emploee_id` int(11) NOT NULL,
  `Seq_number` int(11) NOT NULL,
  `Payment_date` date NOT NULL,
  `Amount` float NOT NULL,
  `Remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Project`
--

CREATE TABLE `Project` (
  `Project_id` int(11) NOT NULL,
  `Employee_id` int(11) NOT NULL,
  `Project_name` varchar(48) NOT NULL,
  `Start_date` date NOT NULL,
  `Expected_finish` date NOT NULL,
  `Actual_finish` date NOT NULL,
  `City_id` int(11) NOT NULL,
  `quarter_id` int(11) NOT NULL,
  `coordination_x` float NOT NULL,
  `coordination_y` float NOT NULL,
  `Address` varchar(100) NOT NULL,
  `7od_id` int(11) NOT NULL,
  `PLot_id` int(11) NOT NULL,
  `Land_area` float NOT NULL,
  `Building_area` float NOT NULL,
  `Number_of_building` int(11) NOT NULL,
  `Contract_expected_value` float NOT NULL,
  `Total_balance` float NOT NULL,
  `income` float NOT NULL,
  `Expenses` float NOT NULL,
  `Remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `Project_customer`
--

CREATE TABLE `Project_customer` (
  `Project_id` int(11) NOT NULL,
  `Contract_id` int(11) NOT NULL,
  `Customer_id` int(11) NOT NULL,
  `Emploee_id` int(11) NOT NULL,
  `Percantage` float NOT NULL,
  `Remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Project_stakeholder`
--

CREATE TABLE `Project_stakeholder` (
  `Project_id` int(11) NOT NULL,
  `Stackholder_id` int(11) NOT NULL,
  `Emploee_id` int(11) NOT NULL,
  `Percentage` float NOT NULL,
  `Balance` float NOT NULL,
  `Remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `Quarter`
--

CREATE TABLE `Quarter` (
  `City_id` int(11) NOT NULL,
  `Quarter_id` int(11) NOT NULL,
  `Emploee_id` int(11) NOT NULL,
  `Name` varchar(45) NOT NULL,
  `Remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Sections`
--

CREATE TABLE `Sections` (
  `Project_id` int(11) NOT NULL,
  `Building_id` int(11) NOT NULL,
  `Section_id` int(11) NOT NULL,
  `Type_id` int(11) NOT NULL,
  `Emploee_id` int(11) NOT NULL,
  `Directions` varchar(45) NOT NULL,
  `Floor_number` int(11) NOT NULL,
  `Apartment_area` float NOT NULL,
  `Number_of_rooms` int(11) NOT NULL,
  `Number_of_balcon` int(11) NOT NULL,
  `Has_stairs` tinyint(1) NOT NULL,
  `Has_barking` tinyint(1) NOT NULL,
  `Barking_number` int(11) NOT NULL,
  `Has_store` tinyint(1) NOT NULL,
  `Type` varchar(45) NOT NULL,
  `State` varchar(45) NOT NULL,
  `Remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Services`
--

CREATE TABLE `Services` (
  `project_id` int(11) NOT NULL,
  `Building_id` int(11) NOT NULL,
  `Emploee_id` int(11) NOT NULL,
  `Has_elevator` tinyint(1) NOT NULL,
  `Has_garden` tinyint(1) NOT NULL,
  `Has_meating_room` tinyint(1) NOT NULL,
  `Supervisor_name` varchar(45) NOT NULL,
  `Remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Stackholder_check`
--

CREATE TABLE `Stackholder_check` (
  `Project_ID` int(11) NOT NULL,
  `Stakeholders_Id` int(11) NOT NULL,
  `Seq_Num` int(11) NOT NULL,
  `Bank_id` int(11) NOT NULL,
  `Branch_id` int(11) NOT NULL,
  `Emploee_id` int(11) NOT NULL,
  `Check_Num` int(11) NOT NULL,
  `account_Number` int(11) NOT NULL,
  `routing_number` int(11) NOT NULL,
  `Bank_name` varchar(45) NOT NULL,
  `Start_date` date NOT NULL,
  `Amount` float NOT NULL,
  `Expiry _Date` date NOT NULL,
  `Remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Stage Details`
--

CREATE TABLE `Stage Details` (
  `Poject_id` int(11) NOT NULL,
  `Stage_id` int(11) NOT NULL,
  `Employee_id` int(11) NOT NULL,
  `State` varchar(45) NOT NULL,
  `Start_date` date NOT NULL,
  `End_date` date NOT NULL,
  `Remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Stages`
--

CREATE TABLE `Stages` (
  `Stage_id` int(11) NOT NULL,
  `Employee_id` int(11) NOT NULL,
  `Stage_name` int(11) NOT NULL,
  `Amount` float NOT NULL,
  `Remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Stakeholder`
--

CREATE TABLE `Stakeholder` (
  `Stakeholders_Id` int(11) NOT NULL,
  `Emploee_id` int(11) NOT NULL,
  `Name` int(45) NOT NULL,
  `Phone_number` int(11) NOT NULL,
  `address` int(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `Stakeholder_payement`
--

CREATE TABLE `Stakeholder_payement` (
  `Project_id` int(11) NOT NULL,
  `Stakeholder_id` int(11) NOT NULL,
  `Seq_Num` int(11) NOT NULL,
  `Emploee_id` int(11) NOT NULL,
  `Amount` float NOT NULL,
  `Date` date NOT NULL,
  `Remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
