-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2022 at 04:36 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `examdb`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `employee_delete_sp` (IN `_id` VARCHAR(10))  BEGIN
DELETE FROM `employee` WHERE `emp_id`=_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `employee_read_sp` ()  BEGIN
SELECT `emp_id` "ID", `emp_name` "Name", `gender` "Gender", `degree` "Degree", `title` "Title", `address` "Address", `phone` "Phone", `email` "Phone", `salary` "Salary", `user` "User", `status` "Status", `reg_date` "Registered Date" FROM `employee`;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `employee_sp` (IN `_id` VARCHAR(10), IN `_name` VARCHAR(100), IN `_gender` VARCHAR(10), IN `_degree` VARCHAR(30), IN `_title` VARCHAR(50), IN `_address` VARCHAR(30), IN `_phone` VARCHAR(13), IN `_email` VARCHAR(30), IN `_salary` FLOAT(10,2), IN `_user` VARCHAR(10), IN `_status` VARCHAR(10), IN `_reg_date` DATE, IN `_action` VARCHAR(10))  BEGIN
 if _action = 'insert' then 
 INSERT INTO `employee`(`emp_id`, `emp_name`, `gender`, `degree`, `title`, `address`, `phone`, `email`, `salary`, `user`, `status`, `reg_date`) VALUES (_id, _name, _gender, _degree, _title, _address, _phone, _email, _salary, _user, _status, _reg_date);
 SELECT 'Inserted' as message;
 ELSEIF _action = 'update' THEN
UPDATE `employee` SET 
`emp_name`=_name,`gender`=_gender,`degree`=_degree,`title`=_title,`address`=_address,`phone`=_phone,`email`=_email,`salary`=_salary,`user`=_user,`status`=_status,`reg_date`= _reg_date WHERE `emp_id` = _id; 
 SELECT 'Updated' as message;
 ELSE
 SELECT 'Unknwn command';
 end IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `menu_sp` (IN `_id` INT, IN `_name` VARCHAR(100), IN `_module` VARCHAR(100), IN `_user_id` VARCHAR(10), IN `_reg_date` DATE, IN `_action` VARCHAR(100))  BEGIN
if _action = "insert" then 
INSERT INTO `menus` (`name`, `module`, `user_id`, `reg_date`) VALUES (_name, _module, _user_id, _reg_date);
SELECT "Inserted" as message;
ELSEIF _action = "update" THEN
UPDATE `menus` SET`name`=_name,`module`=_module,`user_id`=_user_id,`reg_date`=_reg_date  WHERE `id`= _id;
SELECT "Updated" as message;
ELSE 
SELECT "Unkown Commands";
end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `student_delete_sp` (IN `_id` VARCHAR(10))  BEGIN
DELETE FROM `student` WHERE `std_id`=_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `student_read_sp` ()  BEGIN
SELECT `std_id` "ID", `std_name` "Name", `gender` "Gender", `address` "Address", `phone` "Phone", `curr_sem` "Current Semester", `class` "Class", `faculty` "Faculty", `reg_user` "Registered Date", `status` "Status", `user` "User ID", `reg_date` "Registered UserID" FROM `student`;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `student_sp` (IN `_id` VARCHAR(10), IN `_name` VARCHAR(100), IN `_gender` VARCHAR(10), IN `_address` VARCHAR(30), IN `_phone` VARCHAR(13), IN `_curr_sem` INT, IN `_class` VARCHAR(30), IN `_faculty` VARCHAR(50), IN `_reg_user` VARCHAR(10), IN `_status` VARCHAR(10), IN `_user` VARCHAR(10), IN `_reg_date` DATE, IN `_action` INT(10))  BEGIN
if _action = "insert" THEN
INSERT INTO `student`(`std_id`, `std_name`, `gender`, `address`, `phone`, `curr_sem`, `class`, `faculty`, `reg_user`, `status`, `user`, `reg_date`) VALUES (_id, _name, _gender, _address, _phone, _curr_sem, _class, _faculty, _reg_user, _status, _user, _reg_date);
select "Inserted" as message;
ELSEIF _action = "update" THEN
UPDATE `student` SET `std_name`=_name,`gender`=_gender,`address`=_address,`phone`=_phone,`curr_sem`=_curr_sem,`class`=_class,`faculty`=_faculty,`reg_user`=_reg_user,`status`=_status,`user`=_user,`reg_date`=_reg_date =_reg_date WHERE `std_id` = _id;
SELECT "Update" as message;
ELSE
SELECT "Unkown Command";
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_rolls_delete_sp` (IN `_id` INT)  BEGIN
DELETE FROM `user_rolls` WHERE `id`=_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_rolls_read_sp` ()  BEGIN
SELECT `id` "ID", `user_id` "User ID", `menu_id` "Menu ID", `reg_date` "Registered Date" FROM `user_rolls`;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_rolls_sp` (IN `_id` INT(10), IN `_user_id` VARCHAR(10), IN `_menu_id` INT(10), IN `_reg_date` DATE, IN `_action` INT(30))  BEGIN
if _action = "insert" THEN
INSERT INTO `user_rolls`( `user_id`, `menu_id`, `reg_date`) VALUES (_user_id, _menu_id, _reg_date);
SELECT "Inserted";
ELSEIF _action = "update" THEN
UPDATE `user_rolls` SET `user_id`=_user_id,`menu_id`=_menu_id,`reg_date`=_reg_date WHERE `id` = _id;
SELECT "Updated";
ELSE
SELECT "Unkown Command";
end IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cousre`
--

CREATE TABLE `cousre` (
  `course_id` varchar(10) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `credit_hours` int(11) NOT NULL,
  `reg_user` varchar(30) NOT NULL,
  `reg_date` date NOT NULL,
  `sys_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` varchar(10) NOT NULL,
  `emp_name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `degree` varchar(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `address` varchar(30) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(30) NOT NULL,
  `salary` float(10,2) NOT NULL,
  `user` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'active',
  `reg_date` date NOT NULL,
  `sys_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_name`, `gender`, `degree`, `title`, `address`, `phone`, `email`, `salary`, `user`, `status`, `reg_date`, `sys_date`) VALUES
('L001', 'Ali Mohamed', 'male', 'Bachler de', 'staff', 'Hodan', '61233222', '0', 500.00, '', 'active', '2021-12-21', '2022-04-02 08:01:31'),
('L002', 'Zafaah Abdi', 'female', 'Master deg', 'lecturer', 'Shibis', '61233229', '', 1200.00, '', 'active', '2022-01-12', '2022-04-03 15:01:51');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `module` varchar(100) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `reg_date` date NOT NULL,
  `sys_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `std_id` varchar(10) NOT NULL,
  `std_name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(30) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `curr_sem` int(11) NOT NULL,
  `class` varchar(20) NOT NULL,
  `faculty` varchar(30) NOT NULL,
  `reg_user` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `user` varchar(10) NOT NULL,
  `reg_date` date NOT NULL,
  `sys_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`std_id`, `std_name`, `gender`, `address`, `phone`, `curr_sem`, `class`, `faculty`, `reg_user`, `status`, `user`, `reg_date`, `sys_date`) VALUES
('S001', 'Adam Ali', '0', '0', '61233877', 6, 'BC012', '0', '', 'active', '', '2022-03-12', '2022-04-03 15:04:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_rolls`
--

CREATE TABLE `user_rolls` (
  `id` int(11) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `reg_date` date NOT NULL,
  `sys_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cousre`
--
ALTER TABLE `cousre`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`std_id`),
  ADD UNIQUE KEY `phone` (`phone`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
