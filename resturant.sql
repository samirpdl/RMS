-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 03, 2014 at 08:29 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `resturant`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bills`
--

CREATE TABLE IF NOT EXISTS `tbl_bills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total_amt` double NOT NULL,
  `datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `tbl_tables_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_bills_tbl_users1` (`created_by`),
  KEY `fk_tbl_bills_tbl_tables1` (`tbl_tables_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_bills`
--

INSERT INTO `tbl_bills` (`id`, `total_amt`, `datetime`, `created_by`, `tbl_tables_id`, `status`) VALUES
(2, 88, '2013-12-26 12:13:08', 1, 2, 2),
(4, 44, '2013-12-26 12:54:49', 1, 3, 2),
(5, 22, '2013-12-26 09:50:03', 1, 2, 2),
(6, 566, '2013-12-28 14:23:53', 1, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE IF NOT EXISTS `tbl_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `category` varchar(45) DEFAULT NULL,
  `price` double NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`id`, `name`, `category`, `price`, `status`) VALUES
(1, 'Chikcen Sizzler', 'Non Veg', 22, 1),
(2, 'Pizza', 'Non Veg', 250, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE IF NOT EXISTS `tbl_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timedate` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `quantity` int(5) NOT NULL,
  `tbl_menu_id` int(11) NOT NULL,
  `tbl_bills_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_order_tbl_menu1` (`tbl_menu_id`),
  KEY `fk_tbl_order_tbl_bills1` (`tbl_bills_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `timedate`, `status`, `quantity`, `tbl_menu_id`, `tbl_bills_id`) VALUES
(18, '2013-12-26 12:50:47', 1, 4, 1, 2),
(19, '2013-12-26 12:51:08', 1, 2, 1, 2),
(21, '2013-12-26 12:54:49', 1, 2, 1, 4),
(24, '2013-12-26 09:50:03', 1, 1, 1, 5),
(25, '2013-12-28 14:23:53', 1, 2, 2, 6),
(26, '2013-12-28 14:24:14', 1, 3, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales`
--

CREATE TABLE IF NOT EXISTS `tbl_sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bath_identifier` varchar(45) NOT NULL,
  `payment_method` varchar(45) NOT NULL,
  `tbl_order_id` int(11) NOT NULL,
  `tbl_users_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_sales_tbl_order1` (`tbl_order_id`),
  KEY `fk_tbl_sales_tbl_users1` (`tbl_users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_sales`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_tables`
--

CREATE TABLE IF NOT EXISTS `tbl_tables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(45) NOT NULL,
  `capacity` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_tables`
--

INSERT INTO `tbl_tables` (`id`, `table_name`, `capacity`, `status`) VALUES
(1, 'Table 1 Edited', 2, 0),
(2, 'Table 2', 2, 1),
(3, 'Table No 3', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userinformation`
--

CREATE TABLE IF NOT EXISTS `tbl_userinformation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone_number` varchar(45) DEFAULT NULL,
  `tbl_users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_userinformation_tbl_users` (`tbl_users_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_userinformation`
--

INSERT INTO `tbl_userinformation` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `tbl_users_id`) VALUES
(1, 'Samir', 'Poudel', 'samir@samirpdl.com.np', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `type` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `status`, `type`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_bills`
--
ALTER TABLE `tbl_bills`
  ADD CONSTRAINT `fk_tbl_bills_tbl_tables1` FOREIGN KEY (`tbl_tables_id`) REFERENCES `tbl_tables` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_bills_tbl_users1` FOREIGN KEY (`created_by`) REFERENCES `tbl_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `fk_tbl_order_tbl_bills1` FOREIGN KEY (`tbl_bills_id`) REFERENCES `tbl_bills` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_order_tbl_menu1` FOREIGN KEY (`tbl_menu_id`) REFERENCES `tbl_menu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  ADD CONSTRAINT `fk_tbl_sales_tbl_order1` FOREIGN KEY (`tbl_order_id`) REFERENCES `tbl_order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_sales_tbl_users1` FOREIGN KEY (`tbl_users_id`) REFERENCES `tbl_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_userinformation`
--
ALTER TABLE `tbl_userinformation`
  ADD CONSTRAINT `fk_tbl_userinformation_tbl_users` FOREIGN KEY (`tbl_users_id`) REFERENCES `tbl_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
