-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2019 at 05:25 AM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `michaelangelo`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CUSTOMER_ID` int(11) NOT NULL,
  `CUSTOMER_NAME` char(30) DEFAULT NULL,
  `PRIORITY_NUMBER` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

CREATE TABLE `customer_order` (
  `CUSTOMER_ORDERID` int(11) NOT NULL,
  `CUSTOMER_NAME` varchar(30) DEFAULT NULL,
  `PRODUCT_ID` int(11) DEFAULT NULL,
  `PRODUCT_NAME` int(11) DEFAULT NULL,
  `PRODUCT_QTY` int(11) DEFAULT NULL,
  `PRODUCT_PRICE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `MATERIAL_ID` int(11) NOT NULL,
  `SUPPLIER_NAME` varchar(30) NOT NULL,
  `MATERIAL_NAME` char(20) DEFAULT NULL,
  `MATERIAL_UNIT` varchar(10) DEFAULT NULL,
  `MATERIAL_QTY` int(11) DEFAULT NULL,
  `MATERIAL_PRICE` int(11) DEFAULT NULL,
  `MATERIAL_TIMEDATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `material_order`
--

CREATE TABLE `material_order` (
  `MATERIAL_ORDERID` int(11) NOT NULL,
  `MATERIAL_ID` int(11) DEFAULT NULL,
  `ORDER_DATE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_invoice`
--

CREATE TABLE `order_invoice` (
  `ORDER_INVOICEID` int(11) NOT NULL,
  `CUSTOMER_ORDERID` int(11) DEFAULT NULL,
  `ORDER_INVOICE_AMOUNT` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `PRODUCT_ID` int(11) NOT NULL,
  `PRODUCT_NAME` varchar(30) NOT NULL,
  `PRODUCT_PRICE` varchar(30) NOT NULL,
  `PRODUCT_IMAGE` longtext(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `SUPPLIER_ID` int(11) NOT NULL,
  `SUPPLIER_NAME` char(20) DEFAULT NULL,
  `SUPPLIER_ADDRESS` char(20) DEFAULT NULL,
  `SUPPLIER_NUM` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CUSTOMER_ID`);

--
-- Indexes for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD PRIMARY KEY (`CUSTOMER_ORDERID`),
  ADD KEY `CUSTOMER_NAME` (`CUSTOMER_NAME`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`MATERIAL_ID`),

--
-- Indexes for table `material_order`
--
ALTER TABLE `material_order`
  ADD PRIMARY KEY (`MATERIAL_ORDERID`),
  ADD KEY `MATERIAL_ID` (`MATERIAL_ID`);

--
-- Indexes for table `order_invoice`
--
ALTER TABLE `order_invoice`
  ADD PRIMARY KEY (`ORDER_INVOICEID`),
  ADD KEY `CUSTOMER_ORDERID` (`CUSTOMER_ORDERID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`PRODUCT_ID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`SUPPLIER_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CUSTOMER_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `CUSTOMER_ORDERID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `MATERIAL_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `PRODUCT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `SUPPLIER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD CONSTRAINT `customer_order_ibfk_1` FOREIGN KEY (`PRODUCT_ID`) REFERENCES `product` (`PRODUCT_ID`),
  ADD CONSTRAINT `customer_order_ibfk_2` FOREIGN KEY (`CUSTOMER_NAME`) REFERENCES `customer` (`CUSTOMER_NAME`);

--
-- Constraints for table `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `material_ibfk_1` FOREIGN KEY (`SUPPLIER_ID`) REFERENCES `supplier` (`SUPPLIER_ID`);

--
-- Constraints for table `material_order`
--
ALTER TABLE `material_order`
  ADD CONSTRAINT `material_order_ibfk_1` FOREIGN KEY (`MATERIAL_ID`) REFERENCES `material` (`MATERIAL_ID`);

--
-- Constraints for table `order_invoice`
--
ALTER TABLE `order_invoice`
  ADD CONSTRAINT `order_invoice_ibfk_1` FOREIGN KEY (`CUSTOMER_ORDERID`) REFERENCES `customer_order` (`CUSTOMER_ORDERID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`PRODUCT_ORDERID`) REFERENCES `product_order` (`PRODUCT_ORDERID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
