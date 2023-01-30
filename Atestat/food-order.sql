-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 10, 2022 at 07:58 AM
-- Server version: 5.0.67
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(100) collate utf8_unicode_ci NOT NULL,
  `username` varchar(100) collate utf8_unicode_ci NOT NULL,
  `password` varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=108 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`) VALUES
(102, 'Lorena', 'lorena', '8287458823facb8ff918dbfabcd22ccb'),
(104, 'Maria', 'maria03', '82fd68014135d2dd24432f5080f6d9d9'),
(106, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(100) collate utf8_unicode_ci NOT NULL,
  `image` varchar(255) collate utf8_unicode_ci NOT NULL,
  `featured` varchar(10) collate utf8_unicode_ci NOT NULL,
  `active` varchar(10) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=55 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `image`, `featured`, `active`) VALUES
(51, 'Pizza', 'food_category_29-04-2022-1651242712.webp', 'Da', 'Da'),
(52, 'Desert', 'food_category_29-04-2022-1651259459.jpg', 'Da', 'Da'),
(53, 'Paste', 'food_category_05-05-2022-1651762448.jpg', 'Da', 'Da'),
(54, 'Salate', 'food_category_05-05-2022-1651764668.jpg', 'Da', 'Da');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

DROP TABLE IF EXISTS `food`;
CREATE TABLE IF NOT EXISTS `food` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(150) collate utf8_unicode_ci NOT NULL,
  `description` varchar(255) collate utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) collate utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `featured` varchar(10) collate utf8_unicode_ci NOT NULL,
  `active` varchar(10) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=42 ;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `title`, `description`, `price`, `image`, `category_id`, `featured`, `active`) VALUES
(25, 'Pizza Caprese', 'Mozzarella, roÈ™ii, busuioc, ulei mÄƒsline, oÈ›et balsamic', 29.00, 'food_name_29-04-2022-1651243876.jpg', 51, 'Da', 'Da'),
(24, 'Pizza Quattro Formaggi', 'Mozzarella,  Gorgonzola, Fontina, Parmigiano-Reggiano', 25.00, 'food_name_29-04-2022-1651243160.jpg', 51, 'Da', 'Da'),
(26, 'Pizza cu Pui', 'Sos roÈ™ii, prosciutto, ciuperci, porumb, piept pui, ardei, mozzarella', 23.00, 'food_name_29-04-2022-1651244120.jpg', 51, 'Nu', 'Da'),
(27, 'Pizza Pepperoni', 'Sos roÈ™ii, pepperoni, jalapeno, mozzarella', 26.00, 'food_name_29-04-2022-1651258665.jpg', 51, 'Nu', 'Da'),
(28, 'Pizza Casei', 'Sos roÈ™ii, pepperoni, prosciutto, ciuperci, ardei, mÄƒsline, porumb, mozzarella', 22.00, 'food_name_29-04-2022-1651258963.jpg', 51, 'Nu', 'Da'),
(29, 'PapanaÈ™i', 'PapanaÈ™i cu smÃ¢ntÃ¢nÄƒ È™i gem de coacÄƒze negre', 18.00, 'food_name_29-04-2022-1651259746.jpg', 52, 'Da', 'Da'),
(30, 'Tiramisu', '', 15.00, 'food_name_29-04-2022-1651260000.jpg', 52, 'Da', 'Da'),
(31, 'ClÄƒtite', 'ClÄƒtite de ciocolatÄƒ, cremÄƒ de mascarpone È™i cÄƒpÈ™uni', 10.00, 'food_name_29-04-2022-1651260205.jpeg', 52, 'Nu', 'Da'),
(32, 'Tort Profiterol', '~1.7kg', 180.00, 'food_name_29-04-2022-1651261444.webp', 52, 'Da', 'Da'),
(33, 'Tort PÄƒdurea NeagrÄƒ', 'CremÄƒ de ciocolatÄƒ neagrÄƒ cu viÈ™ine È™i friÈ™cÄƒ', 200.00, 'food_name_29-04-2022-1651262090.jpg', 52, 'Da', 'Da'),
(35, 'Paste Pesto', 'Paste cu sos pesto de casÄƒ', 23.00, 'food_name_05-05-2022-1651762648.jpg', 53, 'Da', 'Da'),
(36, 'Spaghetti Carbonara', 'Spaghetti cu sos de parmezan, bacon È™i piper', 25.00, 'food_name_05-05-2022-1651762747.jpg', 53, 'Da', 'Da'),
(37, 'Spaghetti Bolognese', 'Spaghetti cu sos de roÈ™ii È™i carne de vitÄƒ, parmezan', 23.00, 'food_name_05-05-2022-1651762883.jpg', 53, 'Nu', 'Da'),
(38, 'Paste Quattro Formaggi', 'Mozzarella, Gorgonzola, Fontina, Parmigiano-Reggiano, smÃ¢ntÃ¢nÄƒ', 22.00, 'food_name_05-05-2022-1651763190.jpg', 53, 'Da', 'Da'),
(39, 'SalatÄƒ Caesar', 'SalatÄƒ verde, ouÄƒ, pui, prosciutto, crutoane, sos Caesar, parmezan', 18.00, 'food_name_05-05-2022-1651764794.jpg', 54, 'Da', 'Nu'),
(40, 'SalatÄƒ greceascÄƒ', 'castravete, roÈ™ii, ceapÄƒ roÈ™ie, mÄƒsline negre, brÃ¢nzÄƒ Feta, ulei de mÄƒsline, oÈ›et balsamic', 15.00, 'food_name_05-05-2022-1651764959.jpg', 54, 'Da', 'Da');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `food` varchar(150) collate utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) collate utf8_unicode_ci NOT NULL,
  `customer_name` varchar(150) collate utf8_unicode_ci NOT NULL,
  `customer_contact` varchar(20) collate utf8_unicode_ci NOT NULL,
  `customer_email` varchar(150) collate utf8_unicode_ci NOT NULL,
  `customer_address` varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `food`, `price`, `quantity`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(14, 'Pizza Caprese', 29.00, 2, 58.00, '2022-04-29 22:59:22', 'Finalizat', 'John Snow', '(405) 353-8591', 'john_snow@gmail.com', 'wonderland'),
(13, 'Tort PÄƒdurea NeagrÄƒ', 200.00, 1, 200.00, '2022-04-29 22:55:20', 'Comandat', 'Cristina Muller', '(223) 809-0586', 'chris@yahoo.com', 'Bd Republicii 80'),
(12, 'Tort Profiterol', 180.00, 1, 180.00, '2022-04-29 22:46:33', 'Livrare', 'Ion Preda', '(587) 386-5396', 'preda_ion@gmail.com', 'Victoriei 5, bloc 7, scara A, ap 3'),
(11, 'Pizza Caprese', 29.00, 1, 29.00, '2022-04-29 22:39:22', 'Anulat', 'Elena Ilie', '(223) 809-0586', 'elena@yahoo.com', 'EMinescu 56'),
(10, 'ClÄƒtite', 10.00, 1, 10.00, '2022-04-29 22:37:32', 'Finalizat', 'Crina Popescu', '(427) 213-2624', 'crina.popescu@gmail.com', '1 Mai nr64'),
(15, 'PapanaÈ™i', 18.00, 1, 18.00, '2022-05-03 10:30:25', 'Anulat', 'io', 'tot io', 'ioio@io.io', 'hey');
