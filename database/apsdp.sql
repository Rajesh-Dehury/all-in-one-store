-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2021 at 06:49 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apsdp`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `img` varchar(150) NOT NULL,
  `title` varchar(200) NOT NULL,
  `para` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `logo` varchar(200) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `logo`, `userid`, `password`) VALUES
(1, 'APSDP SOLUTIONS', 'logo.png', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `contact_page`
--

CREATE TABLE `contact_page` (
  `id` int(11) NOT NULL,
  `address` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `open_time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_page`
--

INSERT INTO `contact_page` (`id`, `address`, `email`, `mobile`, `open_time`) VALUES
(1, '1618/1619, Satya Vihar, Bhubaneswar-10', 'info@apsdp.com', '7894561230', '10:00AM to 07:00PM');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `message` varchar(700) NOT NULL,
  `msg_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `mobile`, `message`, `msg_time`) VALUES
(1, 'Sanjaya Kumar Rout', 'himanshu@gmail.com', '0943856042', 'sdfsdfsf', '2021-01-03 15:51:04'),
(2, 'Sanjaya Kumar Rout', 'himanshu@gmail.com', '0943856042', 'SDSDSDF', '2021-01-10 12:10:08'),
(3, 'Deepak', 'deepak@gmail.com', '987987987', 'A quick brown fox over the lazy dog.', '2021-02-13 19:13:43');

-- --------------------------------------------------------

--
-- Table structure for table `prdct_provide_date`
--

CREATE TABLE `prdct_provide_date` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `provided_date` date NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prdct_provide_date`
--

INSERT INTO `prdct_provide_date` (`id`, `product_id`, `provided_date`, `status`) VALUES
(5, 43052, '2021-03-06', 2),
(6, 43052, '2021-03-08', 3);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `entry_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `entry_time`) VALUES
(7, 'Education', '2021-01-10 11:20:08'),
(8, 'Office', '2021-01-10 11:20:16'),
(9, 'Home & Construction', '2021-01-10 11:20:28'),
(10, 'Advertising & Banner', '2021-01-10 11:20:34'),
(11, 'Electrical Assesories', '2021-01-10 11:20:39'),
(12, 'Computer & Assesories', '2021-01-10 11:20:46'),
(13, 'dfssdsdfdsfsf', '2021-02-06 19:28:48'),
(14, '0000000000011111', '2021-02-10 17:46:54');

-- --------------------------------------------------------

--
-- Table structure for table `request_order`
--

CREATE TABLE `request_order` (
  `id` int(11) NOT NULL,
  `per_name` varchar(150) NOT NULL,
  `org_name` varchar(150) NOT NULL,
  `quantity` int(11) NOT NULL,
  `pdct_type` varchar(150) NOT NULL,
  `mobile` varchar(150) NOT NULL,
  `send_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_order`
--

INSERT INTO `request_order` (`id`, `per_name`, `org_name`, `quantity`, `pdct_type`, `mobile`, `send_time`) VALUES
(1, 'ddd', 'jkhkjh', 0, 'jkhjkh', 'jkhkjh', '2021-03-09 16:49:19'),
(2, 'Sanjaya Kumar Rout', 'Info Tech', 15, 'Student Books', '9556539031', '2021-03-09 17:08:17');

-- --------------------------------------------------------

--
-- Table structure for table `select_product`
--

CREATE TABLE `select_product` (
  `id` int(11) NOT NULL,
  `userid` varchar(150) NOT NULL,
  `pdct_id` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `sub_total` int(150) NOT NULL,
  `order_number` int(11) NOT NULL,
  `status` int(5) NOT NULL COMMENT '0=order continue,\r\n1=order place,\r\n2=order will be coming\r\n3=product provided, \r\n4=Order Cancel',
  `entry_date` date NOT NULL DEFAULT current_timestamp(),
  `entry_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `select_product`
--

INSERT INTO `select_product` (`id`, `userid`, `pdct_id`, `quantity`, `sub_total`, `order_number`, `status`, `entry_date`, `entry_time`) VALUES
(2, '1', '5', '1', 45, 33779, 1, '2021-02-24', '2021-01-25 03:24:19'),
(3, '3', '4', '1', 0, 0, 0, '2021-02-24', '2021-01-25 03:48:11'),
(6, '1', '4', '3', 240, 33779, 1, '2021-02-24', '2021-01-26 07:28:44'),
(23, '1', '5', '6', 270, 33779, 1, '2021-03-07', '2021-03-07 11:23:03'),
(26, '1', '7', '11', 495, 33779, 1, '2021-03-07', '2021-03-07 11:56:26'),
(27, '1', '6', '18', 810, 33779, 1, '2021-03-07', '2021-03-07 11:56:50'),
(28, '1', '8', '1', 455, 33779, 1, '2021-03-07', '2021-03-07 11:57:30'),
(29, '1', '4', '1', 80, 43052, 3, '2021-03-07', '2021-03-07 12:04:51'),
(30, '1', '7', '1', 45, 43052, 3, '2021-03-07', '2021-03-07 12:05:01'),
(31, '1', '5', '1', 45, 43052, 3, '2021-03-07', '2021-03-07 12:05:09'),
(32, '1', '6', '1', 45, 43052, 3, '2021-03-07', '2021-03-07 12:05:21'),
(33, '1', '8', '1', 455, 43052, 3, '2021-03-07', '2021-03-07 12:06:18');

-- --------------------------------------------------------

--
-- Table structure for table `single_product`
--

CREATE TABLE `single_product` (
  `id` int(11) NOT NULL,
  `prdct_id` varchar(100) NOT NULL,
  `sprdct_id` varchar(150) NOT NULL,
  `img` varchar(150) NOT NULL,
  `s_prdct_name` varchar(150) NOT NULL,
  `price` varchar(50) NOT NULL,
  `ratting` varchar(10) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `availability` varchar(150) NOT NULL,
  `shipping` varchar(100) NOT NULL,
  `entry_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `single_product`
--

INSERT INTO `single_product` (`id`, `prdct_id`, `sprdct_id`, `img`, `s_prdct_name`, `price`, `ratting`, `description`, `availability`, `shipping`, `entry_time`) VALUES
(4, '7', '10', 'cart-3_01102021161752.jpg', 'Banana', '80', '4', 'sdfgdsfgdfg', 'dfgdf', 'dfgdfg', '2021-01-10 15:17:52'),
(5, '7', '10', 'lp-2_01172021123519.jpg', 'Apple', '45', '3', 'sdfgdsfgdfg', 'dfgdf', '1111111111111', '2021-01-17 11:35:19'),
(6, '7', '10', 'lp-2_01172021124238.jpg', 'ssss', '45', '4', 'sdfgdsfgdfg', 'dfgdf', '1111111111111', '2021-01-17 11:42:38'),
(7, '7', '9', 'lp-1_01172021125433.jpg', 'Books', '45', '4', 'sdfgdsfgdfg', 'dfgdf', 'dfgdfg', '2021-01-17 11:54:33'),
(8, '8', '17', 'sl3_0262021203144.jpg', 'ssss', '455', '5', 'sdfgdsfgdfg', '111111111', 'dfgdfg', '2021-02-06 19:31:44');

-- --------------------------------------------------------

--
-- Table structure for table `singup`
--

CREATE TABLE `singup` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `address` varchar(200) NOT NULL,
  `otp` varchar(5) NOT NULL,
  `password` varchar(150) NOT NULL,
  `entry_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `singup`
--

INSERT INTO `singup` (`id`, `name`, `email`, `mobile`, `address`, `otp`, `password`, `entry_time`) VALUES
(1, 'Sanjaya Kumar Rout', 'sanjay.rout131@gmail.com', '09438560424', 'Kandarpur, Biribati', '29211', 'ssss', '2021-01-26 04:45:22'),
(3, 'Deepak Das', 'deepak@gmail.com', '09438560424', 'Kandarpur, Biribati', '61051', 'ssss', '2021-01-26 05:06:17');

-- --------------------------------------------------------

--
-- Table structure for table `sub_product`
--

CREATE TABLE `sub_product` (
  `id` int(11) NOT NULL,
  `pdct_id` int(100) NOT NULL,
  `name` varchar(150) NOT NULL,
  `entry_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_product`
--

INSERT INTO `sub_product` (`id`, `pdct_id`, `name`, `entry_time`) VALUES
(8, 7, 'KIDS SCISSORS', '2021-01-10 11:21:27'),
(9, 7, 'CAMBO & GIFT SETS', '2021-01-10 11:21:33'),
(10, 7, 'GEOMETRY BOXES & DRAFTING TOOLS', '2021-01-10 11:21:42'),
(13, 8, 'SDanjaya', '2021-01-16 14:18:53'),
(15, 9, '534534354000000000', '2021-01-16 14:22:11'),
(16, 10, 'xcxvxcvxcv222', '2021-01-17 10:50:52'),
(17, 8, 'asdsada sdfsdfdsf', '2021-02-06 19:30:26'),
(18, 13, '0000000000000', '2021-02-10 17:44:19'),
(19, 14, 'asdasdsadasd 111', '2021-02-10 17:47:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_page`
--
ALTER TABLE `contact_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prdct_provide_date`
--
ALTER TABLE `prdct_provide_date`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_order`
--
ALTER TABLE `request_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `select_product`
--
ALTER TABLE `select_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `single_product`
--
ALTER TABLE `single_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `singup`
--
ALTER TABLE `singup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_product`
--
ALTER TABLE `sub_product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_page`
--
ALTER TABLE `contact_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prdct_provide_date`
--
ALTER TABLE `prdct_provide_date`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `request_order`
--
ALTER TABLE `request_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `select_product`
--
ALTER TABLE `select_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `single_product`
--
ALTER TABLE `single_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `singup`
--
ALTER TABLE `singup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_product`
--
ALTER TABLE `sub_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
