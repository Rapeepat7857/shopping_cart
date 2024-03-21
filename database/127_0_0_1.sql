-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2021 at 05:09 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping_cart`
--
CREATE DATABASE IF NOT EXISTS `shopping_cart` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `shopping_cart`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank`
--

CREATE TABLE `tbl_bank` (
  `b_id` int(11) NOT NULL,
  `b_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `b_type` varchar(100) CHARACTER SET utf8 NOT NULL,
  `b_number` varchar(20) NOT NULL,
  `b_owner` varchar(100) CHARACTER SET utf8 NOT NULL,
  `bn_name` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'ชื่อสาขา',
  `b_logo` varchar(250) NOT NULL,
  `b_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='bank';

--
-- Dumping data for table `tbl_bank`
--

INSERT INTO `tbl_bank` (`b_id`, `b_name`, `b_type`, `b_number`, `b_owner`, `bn_name`, `b_logo`, `b_date`) VALUES
(1, 'ไทยพาณิชย์', 'ออมทรัพย์', '4066699249', 'นายวัยวุฒ ชุมเมืองปัก', 'บางปะกอก', '75457166820210802_221351.jpg', '2021-08-02 15:13:51'),
(2, 'กสิกรไทย', 'ออมทรัพย์', '4066699249', 'นายวัยวุฒ ชุมเมืองปัก', 'เจ้าพระยา', '129704908120210802_221417.jpg', '2021-08-02 15:14:17'),
(3, 'กรุงไทย', 'ออมทรัพย์', '4066699249', 'นายวัยวุฒ ชุมเมืองปัก', 'บางปะกอก', '36944162920210802_221505.jpg', '2021-08-02 15:14:38'),
(4, 'กรุงเทพ', 'ออมทรัพย์', '4066699249', 'นายวัยวุฒ ชุมเมืองปัก', 'เจ้าพระยา', '176049151720210802_221453.jpg', '2021-08-02 15:14:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE `tbl_member` (
  `member_id` int(11) NOT NULL,
  `m_user` varchar(20) NOT NULL,
  `m_pass` varchar(20) NOT NULL,
  `m_level` varchar(50) NOT NULL,
  `m_name` varchar(100) NOT NULL,
  `m_email` varchar(100) NOT NULL,
  `m_tel` varchar(20) NOT NULL,
  `m_address` varchar(200) NOT NULL,
  `m_img` varchar(250) NOT NULL,
  `date_save` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`member_id`, `m_user`, `m_pass`, `m_level`, `m_name`, `m_email`, `m_tel`, `m_address`, `m_img`, `date_save`) VALUES
(1, 'admin', 'admin', 'admin', 'วัยวุฒิ', 'waiyawootlove@gmail.com', '0898767681', 'กรุงเทพมหานคร 10140', '117610518620210814_174325.png', '2021-08-14 10:35:11'),
(2, 'mm', 'mm', 'member', 'วัยวุฒิ', 'waiyawoot@gmail.com', '0988878882', '517/181 Suksawat 38', '38376643120210814_174459.png', '2021-08-14 10:35:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `member_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `order_status` int(1) NOT NULL,
  `pay_slip` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `b_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ชื่อธนาคาร',
  `b_number` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'เลข บช',
  `pay_date` date DEFAULT NULL,
  `pay_amount` float(10,2) DEFAULT NULL,
  `postcode` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `member_id`, `name`, `address`, `email`, `phone`, `order_status`, `pay_slip`, `b_name`, `b_number`, `pay_date`, `pay_amount`, `postcode`, `order_date`) VALUES
(0000000001, 2, 'วัยวุฒิ', '517/181 Suksawat 38', 'waiyawoot@gmail.com', '0988878882', 1, '', '', '', '0000-00-00', 0.00, '', '2021-08-14 18:45:59'),
(0000000002, 2, 'วัยวุฒิ', '517/181 Suksawat 38', 'waiyawoot@gmail.com', '0988878882', 1, '', '', '', '0000-00-00', 0.00, '', '2021-08-14 18:46:03'),
(0000000003, 2, 'วัยวุฒิ', '517/181 Suksawat 38', 'waiyawoot@gmail.com', '0988878882', 1, '', '', '', '0000-00-00', 0.00, '', '2021-08-14 18:46:18'),
(0000000004, 2, 'วัยวุฒิ', '517/181 Suksawat 38', 'waiyawoot@gmail.com', '0988878882', 1, '', '', '', '0000-00-00', 0.00, '', '2021-08-14 18:47:19'),
(0000000005, 2, 'วัยวุฒิ', '517/181 Suksawat 38', 'waiyawoot@gmail.com', '0988878882', 1, '', '', '', '0000-00-00', 0.00, '', '2021-08-14 18:49:10'),
(0000000006, 2, 'วัยวุฒิ', '517/181 Suksawat 38', 'waiyawoot@gmail.com', '0988878882', 1, '', '', '', '0000-00-00', 0.00, '', '2021-08-14 18:50:10'),
(0000000007, 2, 'วัยวุฒิ', '517/181 Suksawat 38', 'waiyawoot@gmail.com', '0988878882', 1, '', '', '', '0000-00-00', 0.00, '', '2021-08-14 18:51:09'),
(0000000008, 2, 'วัยวุฒิ', '517/181 Suksawat 38', 'waiyawoot@gmail.com', '0988878882', 1, '', '', '', '0000-00-00', 0.00, '', '2021-08-14 18:52:31'),
(0000000009, 2, 'วัยวุฒิ', '517/181 Suksawat 38', 'waiyawoot@gmail.com', '0988878882', 2, '57163710320210814_192450.png', 'กสิกรไทย', '4066699249', '2021-08-14', 33000.00, '', '2021-08-14 18:53:02'),
(0000000010, 2, 'วัยวุฒิ', '517/181 Suksawat 38', 'waiyawoot@gmail.com', '0988878882', 1, '', '', '', '0000-00-00', 0.00, '', '2021-08-14 18:55:41'),
(0000000011, 2, 'วัยวุฒิ', '517/181 Suksawat 38', 'waiyawoot@gmail.com', '0988878882', 1, '', '', '', '0000-00-00', 0.00, '', '2021-08-14 19:04:19'),
(0000000012, 2, 'วัยวุฒิ', '517/181 Suksawat 38', 'waiyawoot@gmail.com', '0988878882', 1, '', '', '', '0000-00-00', 0.00, '', '2021-08-14 19:33:46'),
(0000000013, 2, 'วัยวุฒิ', '517/181 Suksawat 38', 'waiyawoot@gmail.com', '0988878882', 1, '', '', '', '0000-00-00', 0.00, '', '2021-08-14 19:35:11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_detail`
--

CREATE TABLE `tbl_order_detail` (
  `d_id` int(10) NOT NULL,
  `order_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `p_name` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `p_c_qty` int(11) NOT NULL,
  `total` float NOT NULL,
  `datesave` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_order_detail`
--

INSERT INTO `tbl_order_detail` (`d_id`, `order_id`, `p_id`, `p_name`, `p_c_qty`, `total`, `datesave`) VALUES
(1, 4, 15, 'macbook pro 2020', 1, 33000, '2021-08-14 11:47:19'),
(2, 5, 13, 'macbook pro 2020', 1, 33000, '2021-08-14 11:49:10'),
(3, 6, 13, 'macbook pro 2020', 1, 33000, '2021-08-14 11:50:10'),
(4, 7, 13, 'macbook pro 2020', 1, 33000, '2021-08-14 11:51:09'),
(5, 8, 13, 'macbook pro 2020', 1, 33000, '2021-08-14 11:52:31'),
(6, 9, 13, 'macbook pro 2020', 1, 33000, '2021-08-14 11:53:02'),
(7, 10, 13, 'macbook pro 2020', 1, 33000, '2021-08-14 11:55:41'),
(8, 10, 14, 'macbook pro 2020', 1, 33000, '2021-08-14 11:55:41'),
(9, 11, 14, 'macbook pro 2020', 1, 33000, '2021-08-14 12:04:19'),
(10, 12, 13, 'macbook pro 2020', 1, 33000, '2021-08-14 12:33:46'),
(11, 12, 14, 'macbook pro 2020', 1, 33000, '2021-08-14 12:33:46'),
(12, 13, 13, 'macbook pro 2020', 1, 33000, '2021-08-14 12:35:11'),
(13, 13, 11, 'macbook pro 2020', 1, 33000, '2021-08-14 12:35:11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(200) NOT NULL,
  `type_id` int(11) NOT NULL,
  `p_detail` text NOT NULL,
  `p_img` varchar(200) NOT NULL,
  `p_price` int(11) NOT NULL,
  `p_qty` varchar(11) NOT NULL,
  `p_unit` varchar(20) NOT NULL,
  `p_view` int(10) NOT NULL DEFAULT '0',
  `datesave` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`p_id`, `p_name`, `type_id`, `p_detail`, `p_img`, `p_price`, `p_qty`, `p_unit`, `p_view`, `datesave`) VALUES
(1, 'macbook pro 2020', 4, 'หน่วยความจำ\r\nสูงสุด 16GB2\r\n\r\nสูงสุด 64GB\r\n\r\nพื้นที่จัดเก็บข้อมูล\r\nสูงสุด 2TB2\r\n\r\nสูงสุด 8TB3\r\n\r\nระยะเวลาการใช้งานแบตเตอรี่\r\nสูงสุด 20 ชั่วโมง4\r\n\r\nสูงสุด 11 ชั่วโมง5\r\n\r\nคีย์บอร์ดและแทร็คแพด\r\nMagic Keyboard แบ็คไลท์, Touch Bar, Touch ID\r\nและแทร็คแพด Force Touch\r\n\r\nMagic Keyboard แบ็คไลท์, Touch Bar, Touch ID\r\nและแทร็คแพด Force Touch', '104183846820210803_183226.jpg', 33000, '12', 'กล่อง', 1, '2021-06-26 16:38:28'),
(9, 'macbook pro 2020', 4, 'หน่วยความจำ\r\nสูงสุด 16GB2\r\n\r\nสูงสุด 64GB\r\n\r\nพื้นที่จัดเก็บข้อมูล\r\nสูงสุด 2TB2\r\n\r\nสูงสุด 8TB3\r\n\r\nระยะเวลาการใช้งานแบตเตอรี่\r\nสูงสุด 20 ชั่วโมง4\r\n\r\nสูงสุด 11 ชั่วโมง5\r\n\r\nคีย์บอร์ดและแทร็คแพด\r\nMagic Keyboard แบ็คไลท์, Touch Bar, Touch ID\r\nและแทร็คแพด Force Touch\r\n\r\nMagic Keyboard แบ็คไลท์, Touch Bar, Touch ID\r\nและแทร็คแพด Force Touch', '104183846820210803_183226.jpg', 33000, '12', 'กล่อง', 1, '2021-06-26 16:38:28'),
(10, 'macbook pro 2020', 4, 'หน่วยความจำ\r\nสูงสุด 16GB2\r\n\r\nสูงสุด 64GB\r\n\r\nพื้นที่จัดเก็บข้อมูล\r\nสูงสุด 2TB2\r\n\r\nสูงสุด 8TB3\r\n\r\nระยะเวลาการใช้งานแบตเตอรี่\r\nสูงสุด 20 ชั่วโมง4\r\n\r\nสูงสุด 11 ชั่วโมง5\r\n\r\nคีย์บอร์ดและแทร็คแพด\r\nMagic Keyboard แบ็คไลท์, Touch Bar, Touch ID\r\nและแทร็คแพด Force Touch\r\n\r\nMagic Keyboard แบ็คไลท์, Touch Bar, Touch ID\r\nและแทร็คแพด Force Touch', '104183846820210803_183226.jpg', 33000, '12', 'กล่อง', 1, '2021-06-26 16:38:28'),
(11, 'macbook pro 2020', 4, 'หน่วยความจำ\r\nสูงสุด 16GB2\r\n\r\nสูงสุด 64GB\r\n\r\nพื้นที่จัดเก็บข้อมูล\r\nสูงสุด 2TB2\r\n\r\nสูงสุด 8TB3\r\n\r\nระยะเวลาการใช้งานแบตเตอรี่\r\nสูงสุด 20 ชั่วโมง4\r\n\r\nสูงสุด 11 ชั่วโมง5\r\n\r\nคีย์บอร์ดและแทร็คแพด\r\nMagic Keyboard แบ็คไลท์, Touch Bar, Touch ID\r\nและแทร็คแพด Force Touch\r\n\r\nMagic Keyboard แบ็คไลท์, Touch Bar, Touch ID\r\nและแทร็คแพด Force Touch', '104183846820210803_183226.jpg', 33000, '11', 'กล่อง', 1, '2021-06-26 16:38:28'),
(12, 'macbook pro 2020', 4, 'หน่วยความจำ\r\nสูงสุด 16GB2\r\n\r\nสูงสุด 64GB\r\n\r\nพื้นที่จัดเก็บข้อมูล\r\nสูงสุด 2TB2\r\n\r\nสูงสุด 8TB3\r\n\r\nระยะเวลาการใช้งานแบตเตอรี่\r\nสูงสุด 20 ชั่วโมง4\r\n\r\nสูงสุด 11 ชั่วโมง5\r\n\r\nคีย์บอร์ดและแทร็คแพด\r\nMagic Keyboard แบ็คไลท์, Touch Bar, Touch ID\r\nและแทร็คแพด Force Touch\r\n\r\nMagic Keyboard แบ็คไลท์, Touch Bar, Touch ID\r\nและแทร็คแพด Force Touch', '104183846820210803_183226.jpg', 33000, '12', 'กล่อง', 2, '2021-06-26 16:38:28'),
(13, 'macbook pro 2020', 4, 'หน่วยความจำ\r\nสูงสุด 16GB2\r\n\r\nสูงสุด 64GB\r\n\r\nพื้นที่จัดเก็บข้อมูล\r\nสูงสุด 2TB2\r\n\r\nสูงสุด 8TB3\r\n\r\nระยะเวลาการใช้งานแบตเตอรี่\r\nสูงสุด 20 ชั่วโมง4\r\n\r\nสูงสุด 11 ชั่วโมง5\r\n\r\nคีย์บอร์ดและแทร็คแพด\r\nMagic Keyboard แบ็คไลท์, Touch Bar, Touch ID\r\nและแทร็คแพด Force Touch\r\n\r\nMagic Keyboard แบ็คไลท์, Touch Bar, Touch ID\r\nและแทร็คแพด Force Touch', '104183846820210803_183226.jpg', 33000, '4', 'กล่อง', 8, '2021-06-26 16:38:28'),
(14, 'macbook pro 2020', 4, 'หน่วยความจำ\r\nสูงสุด 16GB2\r\n\r\nสูงสุด 64GB\r\n\r\nพื้นที่จัดเก็บข้อมูล\r\nสูงสุด 2TB2\r\n\r\nสูงสุด 8TB3\r\n\r\nระยะเวลาการใช้งานแบตเตอรี่\r\nสูงสุด 20 ชั่วโมง4\r\n\r\nสูงสุด 11 ชั่วโมง5\r\n\r\nคีย์บอร์ดและแทร็คแพด\r\nMagic Keyboard แบ็คไลท์, Touch Bar, Touch ID\r\nและแทร็คแพด Force Touch\r\n\r\nMagic Keyboard แบ็คไลท์, Touch Bar, Touch ID\r\nและแทร็คแพด Force Touch', '104183846820210803_183226.jpg', 33000, '9', 'กล่อง', 36, '2021-06-26 16:38:28'),
(15, 'macbook pro 2020', 4, 'หน่วยความจำ\r\nสูงสุด 16GB2\r\n\r\nสูงสุด 64GB\r\n\r\nพื้นที่จัดเก็บข้อมูล\r\nสูงสุด 2TB2\r\n\r\nสูงสุด 8TB3\r\n\r\nระยะเวลาการใช้งานแบตเตอรี่\r\nสูงสุด 20 ชั่วโมง4\r\n\r\nสูงสุด 11 ชั่วโมง5\r\n\r\nคีย์บอร์ดและแทร็คแพด\r\nMagic Keyboard แบ็คไลท์, Touch Bar, Touch ID\r\nและแทร็คแพด Force Touch\r\n\r\nMagic Keyboard แบ็คไลท์, Touch Bar, Touch ID\r\nและแทร็คแพด Force Touch', '104183846820210803_183226.jpg', 33000, '11', 'กล่อง', 2, '2021-06-26 16:38:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_type`
--

CREATE TABLE `tbl_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_type`
--

INSERT INTO `tbl_type` (`type_id`, `type_name`) VALUES
(1, 'อุปกรณ์เครื่องใช้'),
(2, 'อาหารและเครื่องดื่ม'),
(3, 'เครื่องตกแต่งภายใน'),
(4, 'อุปกรณ์เทคโนโลยี');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `tbl_type`
--
ALTER TABLE `tbl_type`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  MODIFY `d_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_type`
--
ALTER TABLE `tbl_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
