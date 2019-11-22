-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: נובמבר 22, 2019 בזמן 01:50 PM
-- גרסת שרת: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buyapp`
--
CREATE DATABASE IF NOT EXISTS `buyapp` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `buyapp`;

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `categoryid` int(11) NOT NULL,
  `categoryname` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imgicon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- הוצאת מידע עבור טבלה `categories`
--

INSERT INTO `categories` (`categoryid`, `categoryname`, `imgicon`) VALUES
(24, 'Electronics', 'jpg'),
(25, 'Design', 'jpg'),
(26, 'Fashion', 'jpg'),
(27, 'Sports', 'jpg');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `citycode` int(11) NOT NULL,
  `cityname` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- הוצאת מידע עבור טבלה `cities`
--

INSERT INTO `cities` (`citycode`, `cityname`) VALUES
(49368, 'Brighton'),
(49372, 'Cambridge'),
(49373, 'Liverpool'),
(49369, 'London'),
(49367, 'Manchester'),
(49371, 'Norwich'),
(49370, 'York');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `prodid` int(11) NOT NULL,
  `prodname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prodpicture` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoryid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `price` decimal(9,2) NOT NULL DEFAULT '0.00',
  `prodcondition` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sold` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- הוצאת מידע עבור טבלה `products`
--

INSERT INTO `products` (`prodid`, `prodname`, `prodpicture`, `categoryid`, `userid`, `price`, `prodcondition`, `description`, `sold`) VALUES
(23, 'iPhone XS Max', 'jpg', 24, 26, '999.00', 'New', 'Brand New iPhone', 0),
(24, 'Apple Watch Series 5', 'jpg', 24, 26, '250.00', 'Renewed', 'Renewed Apple Watch', 0),
(25, 'Nintendo Switch', 'jpg', 24, 26, '150.00', 'Used', 'Black Nintendo Switch', 0),
(26, 'Ikea Lamp', 'jpg', 25, 26, '50.00', 'New', 'Cool Ikea Lamp', 0),
(27, 'Bikes', NULL, 26, 37, '80.00', 'New', 'New Red Bikes', 0),
(28, 'iPad Pro 32GB', 'jpg', 24, 26, '299.00', 'New', 'The New iPad', 0),
(29, 'Ray-Ban RB2140', 'jpg', 26, 26, '199.00', 'Used', 'Amazing Sunglasses', 0),
(30, 'FC Barcelona KIT', NULL, 27, 26, '105.00', 'Used', '2019-2010 Kit', 0),
(31, 'Apple TV', 'jpg', 24, 26, '79.00', 'New', 'Brand New Apple TV', 0),
(32, 'DJI Mavic Drone', 'jpg', 24, 37, '899.00', 'New', 'Quadcopter Drone', 0);

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `purchases`
--

DROP TABLE IF EXISTS `purchases`;
CREATE TABLE `purchases` (
  `idPurchase` int(10) NOT NULL,
  `userbuyerid` int(11) NOT NULL,
  `prodid` int(11) NOT NULL,
  `currentlyprice` decimal(9,2) NOT NULL,
  `request_date` date NOT NULL,
  `accept_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- הוצאת מידע עבור טבלה `purchases`
--

INSERT INTO `purchases` (`idPurchase`, `userbuyerid`, `prodid`, `currentlyprice`, `request_date`, `accept_date`) VALUES
(25, 26, 27, '81.00', '2019-11-22', NULL);

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `userID` int(20) NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `citycode` int(11) NOT NULL,
  `email` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- הוצאת מידע עבור טבלה `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `citycode`, `email`, `admin`) VALUES
(26, 'Admin', '$2y$10$VE6.LxzXC5R6TYzjflZpneFndbDksO.RIwYWbFX27mggJIFEO0B.y', 49369, 'admin@buyapp.com', 1),
(37, 'Omer', '$2y$10$D/xYYOBQDGV9ESKugjxztu52b7R0w7C65gCcfhq0deg5k8Pm1hMFS', 49373, 'omerdavid@gmail.com', 0);

--
-- Indexes for dumped tables
--

--
-- אינדקסים לטבלה `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryid`),
  ADD UNIQUE KEY `categoryname` (`categoryname`);

--
-- אינדקסים לטבלה `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`citycode`),
  ADD UNIQUE KEY `cityname` (`cityname`);

--
-- אינדקסים לטבלה `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prodid`),
  ADD KEY `categorycode` (`categoryid`),
  ADD KEY `username` (`userid`);

--
-- אינדקסים לטבלה `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`idPurchase`),
  ADD KEY `userbuyer` (`userbuyerid`),
  ADD KEY `prodid` (`prodid`);

--
-- אינדקסים לטבלה `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `citycode` (`citycode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `citycode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49376;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prodid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `idPurchase` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- הגבלות לטבלאות שהוצאו
--

--
-- הגבלות לטבלה `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`categoryid`) REFERENCES `categories` (`categoryid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_4` FOREIGN KEY (`userid`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- הגבלות לטבלה `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_3` FOREIGN KEY (`prodid`) REFERENCES `products` (`prodid`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `purchases_ibfk_4` FOREIGN KEY (`userbuyerid`) REFERENCES `users` (`userID`) ON DELETE CASCADE;

--
-- הגבלות לטבלה `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`citycode`) REFERENCES `cities` (`citycode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
