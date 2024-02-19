-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Feb 19, 2024 at 08:39 PM
-- Server version: 11.2.2-MariaDB-1:11.2.2+maria~ubu2204
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `65162101_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `id` int(10) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `expires_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`id`, `user_email`, `token`, `expires_at`) VALUES
(7, 'admin@ex.io', '6755208f29aa257d1db39557db257e3de99e92611f2f6e44a5786980440c777a', '2024-02-20');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pro_id` int(10) NOT NULL,
  `pro_name` varchar(100) NOT NULL,
  `pro_detail` text NOT NULL,
  `pro_price` float(10,2) NOT NULL,
  `pro_unit` varchar(50) NOT NULL,
  `pro_img` varchar(100) NOT NULL,
  `type_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pro_id`, `pro_name`, `pro_detail`, `pro_price`, `pro_unit`, `pro_img`, `type_id`) VALUES
(7, 'FEATHER PILLOW 50X70 ', 'MUJI หมอนขนเป็ด รุ่น 4064600276\r\n\r\nหมอนขนเป็ด รุ่น 4064600276 จากแบรนด์ MUJI หมอนขนเป็ด ไส้ในทำจากขนเป็ดธรรมชาติมากถึง 99% และขนดาวน์ ขนอ่อนบริเวณช่วงอก อีก 1% ช่วยให้ตัวหมอนนั้นกักเก็บอากาศได้ดี ให้ความนุ่มฟูอย่างสูงสุด\r\n\r\n    ประเทศเจ้าของแบรนด์ : Japan\r\n    สี : ขาว\r\n    วัสดุ : ผ้า\r\n    วัสดุผ้า : ฝ้าย/ คอตตอน, ขนสัตว์\r\n    ความยาว : 70 ซม.\r\n    ความกว้าง : 50 ซม.\r\n    น้ำหนัก (ก.ก.) : 1.1', 490.00, 'as', 'uploads/FEATHER PILLOW 50X70 .jpg', 3),
(8, 'หมอนเมมโมรีโฟม Symphony with SmartCool Technology™ S รุ่น TPPWSMCWHS สีWhite Premium', 'TEMPUR หมอนเมมโมรีโฟม Symphony with SmartCool Technology™ S รุ่น TPPWSMCWHS\r\n\r\nหมอนเมมโมรีโฟม จากแบรนด์ TEMPUR ดีไซน์หมอนถูกออกแบบมาให้ลาดเอียงในองศาที่เหมาะสมกับผู้นอนที่ต้องการการรองรับบริเวณศีรษะ ลำคอ และหัวไหล่ที่เพิ่มมากขึ้น', 8385.00, 'tt', 'uploads/65d3b599e106d_3_.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `type_id` int(10) NOT NULL,
  `type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`type_id`, `type_name`) VALUES
(3, 'เครื่องดื่ม'),
(5, 'aaa'),
(6, 'aaaaaaaaaa'),
(9, 'o'),
(11, 'i'),
(12, 'r'),
(13, 'tt'),
(15, '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_passowrd` varchar(100) NOT NULL,
  `is_pri` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_passowrd`, `is_pri`) VALUES
(14, 'admin1', 'admin1@ex.io', '202cb962ac59075b964b07152d234b70', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pro_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `product_type` (`type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
