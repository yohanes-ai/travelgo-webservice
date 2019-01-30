-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 29, 2019 at 07:59 PM
-- Server version: 5.6.39-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travelgo`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_invoice`
--

CREATE TABLE `m_invoice` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_invoice`
--

INSERT INTO `m_invoice` (`id`, `user_id`, `tanggal`, `status`) VALUES
(1, 36, '2019-01-23 07:29:00', 0),
(2, 26, '2019-01-23 11:40:05', 0),
(6, 24, '2019-01-24 05:55:14', 0),
(5, 42, '2019-01-24 05:09:17', 0),
(7, 24, '2019-01-24 05:55:21', 0),
(8, 25, '2019-01-24 06:12:44', 0),
(9, 25, '2019-01-24 06:14:59', 0),
(10, 24, '2019-01-24 09:17:51', 0),
(11, 42, '2019-01-24 09:28:22', 0),
(12, 25, '2019-01-25 03:44:40', 0),
(13, 42, '2019-01-25 07:51:04', 0),
(14, 48, '2019-01-25 10:07:02', 0),
(15, 48, '2019-01-25 10:11:16', 0),
(16, 48, '2019-01-25 10:21:50', 0),
(17, 0, '2019-01-25 10:51:27', 0),
(18, 0, '2019-01-25 10:51:32', 0);

-- --------------------------------------------------------

--
-- Table structure for table `m_invoice_detail`
--

CREATE TABLE `m_invoice_detail` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `tourpack_id` int(11) NOT NULL,
  `jumlah_orang` int(11) NOT NULL,
  `total` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_invoice_detail`
--

INSERT INTO `m_invoice_detail` (`id`, `invoice_id`, `tourpack_id`, `jumlah_orang`, `total`) VALUES
(5, 1, 6, 1, 56454),
(6, 1, 7, 1, 564564),
(7, 2, 6, 1, 56454),
(8, 2, 7, 0, 0),
(11, 5, 6, 1, 56454),
(12, 8, 6, 2, 112908),
(13, 9, 6, 2, 112908),
(14, 10, 15, 3, 16674),
(15, 11, 15, 2, 11116),
(16, 12, 19, 1, 123456),
(17, 13, 19, 2, 246912),
(18, 14, 26, 1, 4250000),
(19, 15, 28, 1, 850000),
(20, 16, 27, 1, 8520100),
(21, 17, 26, 1, 4250000),
(22, 18, 26, 1, 4250000);

-- --------------------------------------------------------

--
-- Table structure for table `m_location`
--

CREATE TABLE `m_location` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `map_photo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_location`
--

INSERT INTO `m_location` (`id`, `name`, `description`, `map_photo`) VALUES
(4, 'Surabaya', 'Surabaya adalah ibu kota Provinsi Jawa Timur, Indonesia, sekaligus kota metropolitan terbesar di provinsi tersebut. Surabaya merupakan kota terbesar kedua di Indonesia setelah Jakarta. Kota ini terletak 796 km sebelah timur Jakarta, atau 415 km sebelah barat laut Denpasar, Bali. Surabaya terletak di pantai utara Pulau Jawa bagian timur dan berhadapan dengan Selat Madura serta Laut Jawa. ', 'surabayaMap.PNG'),
(5, 'Jakarta', 'Daerah Khusus Ibukota Jakarta adalah ibu kota negara dan kota terbesar di Indonesia. Jakarta merupakan satu-satunya kota di Indonesia yang memiliki status setingkat provinsi. Jakarta terletak di pesisir bagian barat laut Pulau Jawa.', 'jakarta-map.png'),
(6, 'Bandung', 'Kota Bandung merupakan kota metropolitan terbesar di Provinsi Jawa Barat, sekaligus menjadi ibu kota provinsi tersebut. Kota ini terletak 140 km sebelah tenggara Jakarta, dan merupakan kota terbesar di wilayah Pulau Jawa bagian selatan. ', 'bandung.png'),
(7, 'Bangka Belitung', 'The Bangka-Belitung Islands form an Indonesian province off the east coast of Sumatra. ', 'peta-bangka_20160422_233821.jpg'),
(8, 'Raja Ampat', 'Kepulauan Raja Ampat merupakan rangkaian empat gugusan pulau yang berdekatan dan berlokasi di barat bagian Kepala Burung Pulau Papua. Secara administrasi, gugusan ini berada di bawah Kabupaten Raja Ampat, Provinsi Papua Barat.', 'images.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `m_location_photo`
--

CREATE TABLE `m_location_photo` (
  `id` int(11) NOT NULL,
  `urlPhoto` varchar(100) DEFAULT NULL,
  `mimePhoto` varchar(100) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `primaryPhoto` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_location_photo`
--

INSERT INTO `m_location_photo` (`id`, `urlPhoto`, `mimePhoto`, `location_id`, `primaryPhoto`) VALUES
(9, 'wisata-surabaya.jpg', 'image/jpeg', 4, 0),
(8, 'tunjungan.jpg', 'image/jpeg', 4, 0),
(7, 'tugu_pahlawan-diptawahyu_copy.jpg', 'image/jpeg', 4, 1),
(11, 'jakarta.jpg', 'image/jpeg', 5, 1),
(12, 'monas.jpg', 'image/jpeg', 5, 0),
(13, 'download (1).jpg', 'image/jpeg', 7, 1),
(14, 'Paket-Wisata-Bangka-Belitung-Tawarkan-Keindahan-Babel-900x530.jpg', 'image/jpeg', 7, 0),
(16, 'asia_indonesia_dive_raja_ampat_gallery_misool_eco_resort.jpg', 'image/jpeg', 8, 1),
(17, 'shutterstock_636529283.jpg', 'image/jpeg', 8, 0),
(18, 'Raja-Ampat.jpg', 'image/jpeg', 8, 0),
(19, '1c36f4cc51e21c5a4234ceaf40020681bc29d5ccef847152e889f46c.jpg', 'image/jpeg', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_package`
--

CREATE TABLE `m_package` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `approval` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_package`
--

INSERT INTO `m_package` (`id`, `user_id`, `location_id`, `date_start`, `date_end`, `approval`) VALUES
(1, 24, 1, '2019-01-16', '2019-01-24', 1),
(2, 26, 4, '2019-01-22', '2019-01-25', 1),
(8, 36, 4, '2019-01-15', '2019-01-29', 0),
(9, 36, 4, '2019-01-15', '2019-01-29', 0),
(11, 36, 4, '2019-01-15', '2019-01-29', 0),
(12, 36, 4, '2019-01-15', '2019-01-29', 0),
(13, 36, 4, '2019-01-15', '2019-01-29', 0),
(14, 36, 4, '2019-01-15', '2019-01-29', 0),
(15, 36, 4, '2019-01-15', '2019-01-29', 0),
(16, 36, 4, '2019-01-15', '2019-01-29', 0),
(17, 36, 4, '2019-01-15', '2019-01-29', 0),
(18, 36, 4, '2019-01-15', '2019-01-30', 0),
(20, 24, 5, '2019-01-15', '2019-01-22', 0),
(21, 36, 4, '2019-01-15', '2019-01-30', 0),
(22, 36, 5, '2019-01-28', '2019-02-07', 1),
(26, 24, 4, '2019-01-17', '2019-01-31', 1),
(27, 24, 6, '2019-01-24', '2019-01-31', 1),
(29, 42, 4, '2019-01-25', '2019-01-28', 1),
(30, 35, 4, '2019-01-25', '2019-01-29', 0),
(32, 48, 4, '2019-01-25', '2019-01-27', 1),
(35, 48, 5, '2019-01-26', '2019-01-28', 1),
(37, 47, 4, '2019-01-25', '2019-01-30', 1),
(38, 48, 8, '2019-01-28', '2019-01-30', 1),
(39, 47, 5, '2019-01-25', '2019-01-29', 1),
(41, 47, 8, '2019-01-28', '2019-01-31', 1),
(42, 47, 7, '2019-01-26', '2019-01-29', 1),
(43, 24, 8, '2019-01-25', '2019-01-31', 1),
(46, 24, 4, '2019-01-30', '2019-02-02', 0),
(47, 36, 4, '2019-02-11', '2019-02-15', 1),
(48, 48, 5, '2019-01-29', '2019-01-31', 1),
(50, 24, 8, '2019-01-30', '2019-02-01', 1),
(51, 24, 4, '2019-01-31', '2019-02-02', 0),
(52, 24, 5, '2019-01-31', '2019-02-03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `m_package_photo`
--

CREATE TABLE `m_package_photo` (
  `id` int(11) NOT NULL,
  `urlPhoto` varchar(100) NOT NULL,
  `mimePhoto` varchar(100) NOT NULL,
  `packageID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_package_photo`
--

INSERT INTO `m_package_photo` (`id`, `urlPhoto`, `mimePhoto`, `packageID`) VALUES
(3, '2-1.png', 'image/png', 2),
(5, '16-1.png', 'image/png', 16),
(6, '17-1.png', 'image/png', 17),
(7, '18-1.png', 'image/png', 18),
(8, '19-1.png', 'image/png', 19),
(9, '20-1.png', 'image/png', 20),
(10, '21-1.png', 'image/png', 21),
(13, '24-1.png', 'image/png', 24),
(54, '50-1.png', 'image/png', 50),
(24, '27-1.png', 'image/png', 27),
(23, '26-1.png', 'image/png', 26),
(22, '25-1.png', 'image/png', 25),
(26, '29-1.png', 'image/png', 29),
(27, '29-2.png', 'image/png', 29),
(28, '29-3.png', 'image/png', 29),
(29, '30-1.png', 'image/png', 30),
(55, '52-1.png', 'image/png', 52),
(31, '32-1.png', 'image/png', 32),
(32, '34-1.png', 'image/png', 34),
(33, '35-1.png', 'image/png', 35),
(34, '36-1.png', 'image/png', 36),
(35, '32-2.png', 'image/png', 32),
(36, '37-1.png', 'image/png', 37),
(37, '37-2.png', 'image/png', 37),
(38, '37-3.png', 'image/png', 37),
(39, '38-1.png', 'image/png', 38),
(40, '39-1.png', 'image/png', 39),
(41, '39-2.png', 'image/png', 39),
(42, '41-1.png', 'image/png', 41),
(44, '42-1.png', 'image/png', 42),
(45, '42-2.png', 'image/png', 42),
(46, '43-1.png', 'image/png', 43),
(47, '44-1.png', 'image/png', 44),
(48, '45-1.png', 'image/png', 45),
(49, '22-1.png', 'image/png', 22),
(50, '46-1.png', 'image/png', 46),
(51, '47-1.png', 'image/png', 47),
(52, '48-1.png', 'image/png', 48),
(53, '49-1.png', 'image/png', 49);

-- --------------------------------------------------------

--
-- Table structure for table `m_tour`
--

CREATE TABLE `m_tour` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `url_photo` varchar(100) DEFAULT NULL,
  `mime_photo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_tour`
--

INSERT INTO `m_tour` (`id`, `name`, `description`, `address`, `phone`, `user_id`, `url_photo`, `mime_photo`) VALUES
(2, 'asdasd123', '', 'adsdas', 'asdasd', 4, NULL, NULL),
(3, 'asdas asdas', 'qweqwe', NULL, NULL, 5, NULL, NULL),
(4, '', '', NULL, NULL, 15, NULL, NULL),
(5, 'gkgogogo', '', NULL, NULL, 21, NULL, NULL),
(6, 'hsjsjs', '', NULL, NULL, 22, NULL, NULL),
(7, 'hdjs', '', NULL, NULL, 23, NULL, NULL),
(8, 'Rodex tour', '', NULL, NULL, 24, '8.png', 'image/png'),
(10, 'asdasd', 'asdasd', NULL, NULL, 36, '10.png', 'image/png'),
(11, 'Ronaldo Tour', 'tour ke kota bola', NULL, NULL, 46, NULL, NULL),
(13, 'Sweet Escape Tour', 'Sweet escape tour for couple in love. Korean Love Package,  Japan Cherry Blossom Tour, France Love T', NULL, NULL, 35, NULL, NULL),
(14, 'TX Travel', 'Biro perjalanan wisata dengan konsep Full Service Travel Agent', NULL, NULL, 48, '14.png', 'image/png'),
(15, 'Golden Rama Tour', 'European Tour : English, France, Italy, Germany, Netherland, Turky. Asian Tour : China, Japan, SG', NULL, NULL, 47, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_tourpack`
--

CREATE TABLE `m_tourpack` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `price` bigint(20) NOT NULL,
  `url_photo` varchar(100) NOT NULL,
  `mime_photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_tourpack`
--

INSERT INTO `m_tourpack` (`id`, `package_id`, `name`, `description`, `price`, `url_photo`, `mime_photo`) VALUES
(2, 1, 'half day', 'half day', 10000000, '', ''),
(3, 1, 'full day', 'asdad', 1000, '', ''),
(6, 2, 'adas', 'qweqw', 56454, '', ''),
(7, 2, 'asdasd', 'qweqw', 564564, '1.png', 'image/png'),
(8, 22, 'qweqwe', 'qweqw', 564564, '8.png', 'image/png'),
(12, 22, 'qweqw', 'ewrewr', 798797, '12.png', 'image/png'),
(14, 26, 'fhgt', '', 22554, '14.png', 'image/png'),
(15, 27, 'vhghh', '', 5558, '15.png', 'image/png'),
(16, 8, 'asdasd', '', 5646456, '', ''),
(17, 20, 'rrrr', 'gsdgh', 25000, '17.png', 'image/png'),
(19, 29, 'dydkg', 'hxhcug', 123456, '19.png', 'image/png'),
(21, 32, 'Full Day', '', 250000, '21.png', 'image/png'),
(24, 35, 'Historic Package', '', 800000, '24.png', 'image/png'),
(26, 37, 'Half Day Package', 'Tidak termasuk tiket untuk Masuk ke arena', 4250000, '25.png', 'image/png'),
(27, 37, 'Full Day Package', 'Termasuk tiket Masuk arena', 8520100, '27.png', 'image/png'),
(28, 38, 'Snorkling Tour', '', 850000, '28.png', 'image/png'),
(29, 39, 'Full Day Pack', 'Include breakfast, transportation from airport to hotel, Superior hotel room five stars, fully air conditioner room, bathub, premium quality handsoap, welcome snack, air purifier, humidifiers, aroma therapy', 12185000, '29.png', 'image/png'),
(30, 39, 'Half Day Your Package', 'Only Hotel Ticket, free breakfast, WiFi, no transportation from airport to hotel', 8900000, '30.png', 'image/png'),
(32, 41, 'Private Tour', 'Private your with personal tour guide, airplane ticket, hotel ticket with five stars, breakfast, lunch, dinner, diving activity, fishing activity, fine dinning for two people. This package available for two people. ', 39000500, '32.png', 'image/png'),
(33, 41, 'Standard Package', 'Standard package for personal include airplane ticket, hotel ticket', 18320000, '33.png', 'image/png'),
(34, 42, 'Basic Pack', 'Basic Pack', 15200, '34.png', 'image/png'),
(35, 42, 'Standard Pack', 'Standard Pack', 25000000, '35.png', 'image/png'),
(36, 43, 'Night View Tour', 'With star gazing', 1250000, '36.png', 'image/png'),
(39, 46, 'Full day', 'jgjcufuggu', 25000, '39.png', 'image/png'),
(40, 47, 'jalanjalan', 'abcde', 150000, '40.png', 'image/png'),
(41, 48, 'Full Day', 'Jakarta full history journey', 4250000, '41.png', 'image/png'),
(43, 50, 'Beach Day', 'A full adventure on the beach', 1250000, '42.png', 'image/png'),
(44, 51, 'Full Day', 'Full day on the beach', 850000, '44.png', 'image/png'),
(45, 51, 'Half Day', 'Half day on history sites', 350000, '45.png', 'image/png'),
(46, 52, 'Full Day', '', 950000, '46.png', 'image/png'),
(47, 52, 'Half Day', '', 350000, '47.png', 'image/png');

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`id`, `email`, `password`, `name`, `phone`) VALUES
(1, 'admin@admin.com', '827ccb0eea8a706c4c34a16891f84e7b', 'admin', '12321'),
(24, 'lydia.emanuella@hotmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Lydia', '081234567'),
(25, 'markusdg14@gmail.com', NULL, 'Markus', NULL),
(35, 'yohanes.ai@qreatiq.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Yohanes AI', '0817885585'),
(36, 'asd@asd.asd', '202cb962ac59075b964b07152d234b70', 'qweqwew', '54564654'),
(46, 'qaz@gmail.com', '4eae18cf9e54a0f62b44176d074cbe2f', 'Ronaldo', '08456497'),
(47, 'yunike.cherry@qreatiq.com', 'bcbe3365e6ac95ea2c0343a2395834dd', 'Yunike Cherry', '+62218871410'),
(48, 'tx.travel@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Wawan TX Travel', '082436797');

-- --------------------------------------------------------

--
-- Table structure for table `m_visit_place`
--

CREATE TABLE `m_visit_place` (
  `id` int(11) NOT NULL,
  `urlPhoto` varchar(100) NOT NULL,
  `mimePhoto` varchar(100) NOT NULL,
  `location_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_visit_place`
--

INSERT INTO `m_visit_place` (`id`, `urlPhoto`, `mimePhoto`, `location_id`) VALUES
(1, 'monkasel.jpg', 'image/jpeg', 4),
(2, 'tugu_pahlawan-diptawahyu_copy.jpg', 'image/jpeg', 4),
(3, 'tunjungan.jpg', 'image/jpeg', 4),
(4, 'wisata-surabaya.jpg', 'image/jpeg', 4),
(7, '0f4f3d9b01e664b52ec241da315f1972_XL.jpg', 'image/jpeg', 7),
(8, 'Bangka-Belitung-Fokuskan-Program-Sadar-Wisata-2018-Di-Empat-Kabupaten.jpg', 'image/jpeg', 7),
(9, 'camoi-aek-biru2.jpg', 'image/jpeg', 7),
(21, 'pianemo-island-raja-ampat-06294.jpg', 'image/jpeg', 8),
(22, 'raja-ampat-papua-tour.jpg', 'image/jpeg', 8),
(12, 'camoi-aek-biru2.jpg', 'image/jpeg', 8),
(13, 'indonesia train airport.jpg', 'image/jpeg', 5),
(14, 'jakarta-old-town.jpg', 'image/jpeg', 5),
(15, 'capital-city-e1499234398826-720x400.jpg', 'image/jpeg', 5),
(16, 'transportation-jakarta.jpg', 'image/jpeg', 5),
(17, '1491918835_1491557082_screen_shot_2017_04_07_at_2_53_57_pm.png', 'image/jpeg', 6),
(18, 'images (1).jpg', 'image/jpeg', 6),
(19, 'alun-alun bandung 2018 a.jpg', 'image/jpeg', 6),
(20, 'malam-tahun-baru-bandung.jpg', 'image/jpeg', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_invoice`
--
ALTER TABLE `m_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_invoice_detail`
--
ALTER TABLE `m_invoice_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_location`
--
ALTER TABLE `m_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_location_photo`
--
ALTER TABLE `m_location_photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_package`
--
ALTER TABLE `m_package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_package_photo`
--
ALTER TABLE `m_package_photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_tour`
--
ALTER TABLE `m_tour`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `m_tourpack`
--
ALTER TABLE `m_tourpack`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_visit_place`
--
ALTER TABLE `m_visit_place`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_invoice`
--
ALTER TABLE `m_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `m_invoice_detail`
--
ALTER TABLE `m_invoice_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `m_location`
--
ALTER TABLE `m_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `m_location_photo`
--
ALTER TABLE `m_location_photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `m_package`
--
ALTER TABLE `m_package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `m_package_photo`
--
ALTER TABLE `m_package_photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `m_tour`
--
ALTER TABLE `m_tour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `m_tourpack`
--
ALTER TABLE `m_tourpack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `m_user`
--
ALTER TABLE `m_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `m_visit_place`
--
ALTER TABLE `m_visit_place`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
