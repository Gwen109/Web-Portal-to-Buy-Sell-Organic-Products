-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2022 at 04:13 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `organic`
--

-- --------------------------------------------------------

--
-- Table structure for table `experts`
--

CREATE TABLE `experts` (
  `id` int(255) NOT NULL,
  `userid` int(255) NOT NULL,
  `topics` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `experts`
--

INSERT INTO `experts` (`id`, `userid`, `topics`) VALUES
(1, 10, 'Vegetable plants soil selection,\r\nBio pesticide suggestions'),
(2, 11, 'Crop disease');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(255) NOT NULL,
  `customerid` int(255) NOT NULL,
  `sellerid` int(255) NOT NULL,
  `productid` int(255) NOT NULL,
  `productname` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `date` varchar(50) NOT NULL,
  `price` int(255) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customerid`, `sellerid`, `productid`, `productname`, `quantity`, `date`, `price`, `status`) VALUES
(1, 11, 10, 1, 'Tomato', 2, '25-04-2022', 100, 'delivered'),
(2, 11, 12, 6, 'Carrot', 2, '08-05-2022', 140, 'Ordered'),
(3, 11, 10, 1, 'Tomato', 3, '08-05-2022', 150, 'delivered'),
(4, 11, 12, 9, 'Pomegranate', 5, '08-05-2022', 500, 'transported');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `productname` varchar(100) NOT NULL,
  `userid` int(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `price` int(255) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `photo` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `productname`, `userid`, `quantity`, `price`, `unit`, `photo`) VALUES
(1, 'Tomato', 10, 1, 50, 'Kg', 0x746f6d61746f2e6a7067),
(4, 'Onion', 12, 1, 40, 'kg', 0x6f6e696f6e2e6a7067),
(6, 'Carrot', 12, 1, 70, 'kg', 0x636172726f742e6a7067),
(9, 'Pomegranate', 12, 1, 100, 'kg', 0x706f6d656772616e6174652e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` int(255) NOT NULL,
  `userid` int(255) NOT NULL,
  `ShopName` varchar(100) NOT NULL,
  `ShopPhoneNo` varchar(100) NOT NULL,
  `ShopEmailId` varchar(100) NOT NULL,
  `ShopNoStreet` varchar(100) NOT NULL,
  `ShopArea` varchar(100) NOT NULL,
  `ShopCity` varchar(100) NOT NULL,
  `ShopDistrict` varchar(100) NOT NULL,
  `ShopState` varchar(100) NOT NULL,
  `CertificateLink` varchar(255) NOT NULL,
  `CertificatePhoto` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `userid`, `ShopName`, `ShopPhoneNo`, `ShopEmailId`, `ShopNoStreet`, `ShopArea`, `ShopCity`, `ShopDistrict`, `ShopState`, `CertificateLink`, `CertificatePhoto`) VALUES
(3, 10, 'abcd', '7654224', 'abc@g.com', '15,murugan street', 'Kilgudalur', 'Tindivanam', 'villupuram', 'tamil nadu', '', ''),
(4, 12, 'anantha organics company pvt ltd', '97865874', 'anuo@g.com', '', '', 'coimbatore', 'coimbatore', 'tamil nadu', 'https://jaivikbharat.fssai.gov.in/inner.php?state_id=&search-box=Anantha+Naturals+Private+Limited&data-id-company=Anantha+Naturals+Private+Limited&CompanySearch=', 0x6365727469666963617465332e706e67);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phoneno` int(100) NOT NULL,
  `emailid` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phoneno`, `emailid`, `address`, `password`) VALUES
(10, 'Bharghavi J', 9876654, 'jbg@g.com', '16,Ragavendra strt,mangadu,ch-122', '9876'),
(11, 'john', 9876654, 'jo@g.com', '15,hr street,Tnagr,chennai', '1234'),
(12, 'Anu', 56784, 'a@g.com', '67,sri street,chennai', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `experts`
--
ALTER TABLE `experts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `experts`
--
ALTER TABLE `experts`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
