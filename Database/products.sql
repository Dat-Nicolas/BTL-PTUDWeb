-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2024 at 12:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `old_price` decimal(10,2) DEFAULT NULL,
  `current_price` decimal(10,2) NOT NULL,
  `sold` int(10) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `origin` varchar(50) NOT NULL,
  `discount` float(5,2) NOT NULL,
  `rating` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `old_price`, `current_price`, `sold`, `brand`, `origin`, `discount`, `rating`) VALUES
(1, 'PC Gaming cho sinh viên', 'https://phongvu.vn/cong-nghe/wp-content/uploads/sites/2/2022/08/PC-gaming.jpg', 25000000.00, 15000000.00, 2435, 'PC', 'VIỆT NAM', 40.00, 5),
(2, 'Laptop DELL cho nhân viên văn phòng', 'https://cdn.tgdd.vn/Products/Images/44/309293/dell-inspiron-3520-i3-71003264-thumb-600x600.jpg', 10000000.00, 8000000.00, 1231, 'DELL', 'TRUNG QUỐC', 20.00, 5),
(3, 'Bún chả hà nội', 'https://thenguyen.vn/files/products/product_1832/bun-cha-ha-noi-chi-lay-cha-vien.jpg', 35000.00, 30000.00, 131, 'Bún', 'Hà Nội', 14.29, 5),
(4, 'Phở bò lý quốc sư', 'https://i.ytimg.com/vi/0Z__e-gagx4/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJ', 50000.00, 45000.00, 465, 'Phở lý quốc sư', 'Hà Nội', 10.00, 4),
(5, 'Quần áo nam', 'https://down-vn.img.susercontent.com/file/vn-11134201-23030-1ichzzy6niovdc', 200000.00, 100000.00, 1745, 'Quần áo việt', 'VIỆT Nam', 50.00, 5),
(7, 'Quần áo nam', 'https://bizweb.dktcdn.net/100/399/392/products/1-8eb26542-c8e6-4cd3-a4da-5d9461d6ab49.jpg?v=17103014', 200000.00, 180000.00, 6367, 'Quần áo việt', 'VIỆT NAM', 10.00, 4),
(8, 'Quần áo cho nam giới', 'https://vn-test-11.slatic.net/p/32a7af196f0974b250d4a763ea04a512.jpg', 364000.00, 270000.00, 35846, 'GUCCI', 'ÚC', 25.82, 5),
(9, 'Quần áo cho nam giới', 'https://down-vn.img.susercontent.com/file/c7db377b177fc8e2ff75a769022dcc23', 99999915.00, 35250000.00, 1452, 'LUXURY', 'HÀ LAN', 64.75, 5),
(10, 'Quần áo cho nam', 'https://inhat.vn/wp-content/uploads/2022/01/shop-quan-ao-nam-BMT-6-min-1.jpg', 1362960.00, 152450.00, 15235, 'ucii', 'china', 88.81, 3),
(11, 'Quần áo cho phái nữ', 'https://down-vn.img.susercontent.com/file/vn-11134207-7qukw-lis2o7vnzggcb4', 14266790.00, 1532524.00, 15235, 'ucii', 'china', 88.81, 3),
(12, 'Quần áo cho phái nữ', 'https://bizweb.dktcdn.net/thumb/1024x1024/100/403/511/products/o1cn01nev0rh25ztvssferx2996017.jpg', 136260.00, 32520.00, 15235, 'ucii', 'china', 88.81, 4),
(13, 'Quần áo cho phái nữ', 'https://hoyang.vn/wp-content/uploads/2022/01/set-do-nu-dep.jpg', 32592375.00, 1550.00, 15235, 'ucii', 'china', 88.81, 3),
(14, 'Quần áo cho phái nữ', 'https://down-vn.img.susercontent.com/file/699a163b1142165ced239331aeb3dcdc', 34523235.00, 352355.00, 15235, 'ucii', 'china', 88.81, 5),
(15, 'Quần áo cho phái nữ', 'https://bizweb.dktcdn.net/thumb/1024x1024/100/403/511/products/o1cn01bpf0g71tu1denfufn2564852.jpg', 41647747.00, 24134.00, 15235, 'ucii', 'china', 88.81, 3),
(16, 'Quần áo cho phái nữ', 'https://pos.nvncdn.com/888555-3379/ps/20190410_0dOyOUqiuqcPzIWVgxV0Ow5X.jpg', 21513662.00, 3532552.00, 15235, 'ucii', 'china', 88.81, 5),
(17, 'Quần áo cho phái nữ', 'https://doboinam.vn/upload/product/dbn-232/bo-quan-ao-di-bien-nu-cao-cap.jpg', 57357388.00, 82354.00, 15235, 'ucii', 'china', 88.81, 5),
(18, 'Quần áo cho phái nữ', 'https://thieuhoa.com.vn/wp-content/uploads/2023/06/qRLT4xVfwiEruJtJBPZVuw3zO6vEUOv9uDjAGlRH.webp', 21143256.00, 235626.00, 15235, 'ucii', 'china', 88.81, 2),
(19, 'Quần áo cho phái nữ', 'https://cdn.chonongsanonline.com/uploads/all/AdDlwSs9cwTWPsEYDSmh0igzCfTF4bgvu3ns2nK0.jpg', 3242626.00, 315235.00, 15235, 'ucii', 'china', 88.81, 3),
(20, 'Quần áo cho phái nữ', 'https://cdn.kkfashion.vn/16221-large_default/ao-thun-nu-hoa-tiet-chu-nhieu-mau-asm10-33.jpg', 241235.00, 315325.00, 15235, 'ucii', 'china', 88.81, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
