-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2018 at 02:44 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminid` int(11) NOT NULL,
  `adminname` varchar(255) NOT NULL,
  `adminuser` varchar(255) NOT NULL,
  `adminemail` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `adminpass` varchar(32) NOT NULL,
  `role` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminid`, `adminname`, `adminuser`, `adminemail`, `details`, `adminpass`, `role`) VALUES
(17, 'pappu', 'admin', 'admin@gmail.com', 'i am admin', '202cb962ac59075b964b07152d234b70', 0),
(18, 'pappu1', 'Editor', 'pappuakondo5453@gmail.com', '&lt;p&gt;I am admin&lt;/p&gt;', 'babc957dd8b7361bb522a4baa2dd2cfa', 2),
(19, 'pappu2', 'subadmin', 'subadmin@gmail.com', 'I am admin', '202cb962ac59075b964b07152d234b70', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brandid` int(11) NOT NULL,
  `brandname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandid`, `brandname`) VALUES
(1, 'iphone'),
(2, 'acer'),
(3, 'samsung'),
(4, 'xiaomi'),
(5, 'philips'),
(6, 'Nokia'),
(7, 'HP'),
(8, 'dell'),
(9, 'canon');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cartid` int(11) NOT NULL,
  `sessionid` varchar(255) NOT NULL,
  `productid` int(11) NOT NULL,
  `productname` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cartid`, `sessionid`, `productid`, `productname`, `price`, `quantity`, `image`) VALUES
(3, 'ajc21jjvl29fvqe5tm47558e0t', 2, 'iphone', 400.00, 1, 'uploads/0f87a64eb0.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catid` int(11) NOT NULL,
  `catname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`catid`, `catname`) VALUES
(1, 'Laptop'),
(2, 'Mobile'),
(3, 'Camera'),
(4, 'television'),
(5, 'DVD player'),
(6, 'headphone');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_compare`
--

CREATE TABLE `tbl_compare` (
  `id` int(11) NOT NULL,
  `cmrid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `productname` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `tbl_compare`
--

INSERT INTO `tbl_compare` (`id`, `cmrid`, `productid`, `productname`, `price`, `image`) VALUES
(2, 2, 7, 'camera', 222.00, 'uploads/337dcaf5b6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zip` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `name`, `address`, `city`, `country`, `zip`, `phone`, `email`, `password`) VALUES
(1, 'pappu', 'dhaka', 'dhaka', 'bangladesh', '2111', '01624709905', 'pappuakondo@gmail.com', '202cb962ac59075b964b07152d234b70'),
(2, 'akondo', 'jamalpur', 'jamalpur', 'bangladesh', '2311', '01624709906', 'akondo@gmail.com', '202cb962ac59075b964b07152d234b70'),
(3, 'aaa', 'hhh', 'hhh', 'jhhhh', '3333', '10', 'fff@gmail.com', '202cb962ac59075b964b07152d234b70'),
(4, 'rumi sir', 'dhaka', 'dhaka', 'ban', '1000', '019999', 'rumisir@gmail.com', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `orderid` int(11) NOT NULL,
  `cmrid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `productname` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`orderid`, `cmrid`, `productid`, `productname`, `quantity`, `price`, `image`, `date`, `status`) VALUES
(21, 1, 9, 'television', 1, 321.00, 'uploads/198555acfe.jpg', '2018-12-08 14:27:35', 2),
(22, 1, 4, 'dvd player', 1, 211.00, 'uploads/2c76f5e0ab.jpg', '2018-12-08 14:30:06', 2),
(23, 1, 8, 'computer', 1, 100.00, 'uploads/283c79efb5.jpg', '2018-12-02 14:30:50', 2),
(24, 1, 7, 'camera', 1, 222.00, 'uploads/337dcaf5b6.jpg', '2018-12-04 14:31:44', 2),
(25, 1, 9, 'television', 1, 321.00, 'uploads/198555acfe.jpg', '2018-12-08 14:33:49', 2),
(26, 2, 2, 'iphone', 1, 400.00, 'uploads/0f87a64eb0.jpg', '2018-12-08 14:40:23', 2),
(27, 2, 8, 'computer', 1, 100.00, 'uploads/283c79efb5.jpg', '2018-12-08 14:42:34', 2),
(28, 2, 7, 'camera', 1, 222.00, 'uploads/337dcaf5b6.jpg', '2018-12-08 14:42:34', 2),
(29, 2, 3, 'camera', 1, 121.00, 'uploads/8844843df6.jpg', '2018-12-08 14:42:34', 2),
(30, 2, 9, 'television', 1, 321.00, 'uploads/198555acfe.jpg', '2018-12-08 14:42:34', 2),
(31, 2, 4, 'dvd player', 1, 211.00, 'uploads/2c76f5e0ab.jpg', '2018-12-08 14:42:34', 2),
(32, 2, 10, 'headphone', 1, 213.00, 'uploads/884818c127.jpg', '2018-12-06 14:42:34', 2),
(33, 1, 2, 'iphone', 1, 400.00, 'uploads/0f87a64eb0.jpg', '2018-12-07 14:44:28', 2),
(34, 1, 8, 'computer', 1, 100.00, 'uploads/283c79efb5.jpg', '2018-12-08 15:03:33', 2),
(35, 1, 10, 'headphone', 5, 1065.00, 'uploads/884818c127.jpg', '2018-12-08 15:04:55', 2),
(36, 4, 4, 'dvd player', 1, 211.00, 'uploads/2c76f5e0ab.jpg', '2018-12-08 17:18:30', 2),
(37, 4, 10, 'headphone', 1, 213.00, 'uploads/884818c127.jpg', '2018-12-08 17:18:30', 2),
(38, 4, 9, 'television', 2, 642.00, 'uploads/198555acfe.jpg', '2018-12-08 17:18:30', 2),
(39, 1, 2, 'iphone', 1, 400.00, 'uploads/0f87a64eb0.jpg', '2018-12-08 17:28:32', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productid` int(11) NOT NULL,
  `productname` varchar(255) NOT NULL,
  `catid` int(11) NOT NULL,
  `brandid` int(11) NOT NULL,
  `body` text NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`productid`, `productname`, `catid`, `brandid`, `body`, `price`, `image`, `type`, `userid`) VALUES
(1, 'computer', 1, 3, 'Texting is confusing. When you can only read the words somebody types, without seeing their face or hearing their voice, itâ€™s so hard to truly understand what theyâ€™re trying to say. Thatâ€™s why texts donâ€™t always get across the message the texter intends. Thankfully, Iâ€™m here to explain some common text-message greetings to all you novice texters and/or alien life forms who plan to take over the earth some day with texting.', 300.00, 'uploads/fe1a5dcb0f.png', 0, 19),
(2, 'iphone', 2, 1, 'Texting is confusing. When you can only read the words somebody types, without seeing their face or hearing their voice, itâ€™s so hard to truly understand what theyâ€™re trying to say. Thatâ€™s why texts donâ€™t always get across the message the texter intends. Thankfully, Iâ€™m here to explain some common text-message greetings to all you novice texters and/or alien life forms who plan to take over the earth some day with texting.', 400.00, 'uploads/0f87a64eb0.jpg', 1, 19),
(3, 'camera', 3, 5, 'Texting is confusing. When you can only read the words somebody types, without seeing their face or hearing their voice, itâ€™s so hard to truly understand what theyâ€™re trying to say. Thatâ€™s why texts donâ€™t always get across the message the texter intends. Thankfully, Iâ€™m here to explain some common text-message greetings to all you novice texters and/or alien life forms who plan to take over the earth some day with texting sazzad.', 121.00, 'uploads/8844843df6.jpg', 0, 19),
(4, 'dvd player', 5, 3, 'Texting is confusing. When you can only read the words somebody types, without seeing their face or hearing their voice, itâ€™s so hard to truly understand what theyâ€™re trying to say. Thatâ€™s why texts donâ€™t always get across the message the texter intends. Thankfully, Iâ€™m here to explain some common text-message greetings to all you novice texters and/or alien life forms who plan to take over the earth some day with texting.', 211.00, 'uploads/2c76f5e0ab.jpg', 1, 19),
(5, 'headphone', 6, 4, 'Texting is confusing. When you can only read the words somebody types, without seeing their face or hearing their voice, itâ€™s so hard to truly understand what theyâ€™re trying to say. Thatâ€™s why texts donâ€™t always get across the message the texter intends. Thankfully, Iâ€™m here to explain some common text-message greetings to all you novice texters and/or alien life forms who plan to take over the earth some day with texting.', 50.00, 'uploads/b10e4f6def.jpg', 1, 19),
(6, 'television', 4, 5, 'Texting is confusing. When you can only read the words somebody types, without seeing their face or hearing their voice, itâ€™s so hard to truly understand what theyâ€™re trying to say. Thatâ€™s why texts donâ€™t always get across the message the texter intends. Thankfully, Iâ€™m here to explain some common text-message greetings to all you novice texters and/or alien life forms who plan to take over the earth some day with texting.', 100.00, 'uploads/0292a3cd65.jpg', 1, 19),
(7, 'camera', 3, 9, 'Texting is confusing. When you can only read the words somebody types, without seeing their face or hearing their voice, itâ€™s so hard to truly understand what theyâ€™re trying to say. Thatâ€™s why texts donâ€™t always get across the message the texter intends. Thankfully, Iâ€™m here to explain some common text-message greetings to all you novice texters and/or alien life forms who plan to take over the earth some day with texting.', 222.00, 'uploads/337dcaf5b6.jpg', 0, 19),
(8, 'computer', 1, 7, 'Texting is confusing. When you can only read the words somebody types, without seeing their face or hearing their voice, itâ€™s so hard to truly understand what theyâ€™re trying to say. Thatâ€™s why texts donâ€™t always get across the message the texter intends. Thankfully, Iâ€™m here to explain some common text-message greetings to all you novice texters and/or alien life forms who plan to take over the earth some day with texting.', 100.00, 'uploads/283c79efb5.jpg', 0, 19),
(9, 'television', 4, 4, 'Texting is confusing. When you can only read the words somebody types, without seeing their face or hearing their voice, itâ€™s so hard to truly understand what theyâ€™re trying to say. Thatâ€™s why texts donâ€™t always get across the message the texter intends. Thankfully, Iâ€™m here to explain some common text-message greetings to all you novice texters and/or alien life forms who plan to take over the earth some day with texting.', 321.00, 'uploads/198555acfe.jpg', 0, 19),
(10, 'headphone', 6, 2, 'Texting is confusing. When you can only read the words somebody types, without seeing their face or hearing their voice, itâ€™s so hard to truly understand what theyâ€™re trying to say. Thatâ€™s why texts donâ€™t always get across the message the texter intends. Thankfully, Iâ€™m here to explain some common text-message greetings to all you novice texters and/or alien life forms who plan to take over the earth some day with texting.', 213.00, 'uploads/884818c127.jpg', 1, 19),
(11, 'xiaomi 123', 2, 4, 'our username is Editor and Password is pap15398 Please Visit site for login.', 123.00, 'uploads/dc28dba658.jpg', 0, 17);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wlist`
--

CREATE TABLE `tbl_wlist` (
  `id` int(11) NOT NULL,
  `cmrid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `productname` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brandid`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cartid`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `tbl_compare`
--
ALTER TABLE `tbl_compare`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`orderid`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productid`);

--
-- Indexes for table `tbl_wlist`
--
ALTER TABLE `tbl_wlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brandid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_compare`
--
ALTER TABLE `tbl_compare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_wlist`
--
ALTER TABLE `tbl_wlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
