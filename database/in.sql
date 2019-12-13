-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2019 at 10:44 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `in`
--

-- --------------------------------------------------------

--
-- Table structure for table `investor`
--

CREATE TABLE `investor` (
  `id_investor` int(11) NOT NULL,
  `nama_investor` varchar(50) NOT NULL,
  `username_investor` varchar(15) NOT NULL,
  `password_investor` text NOT NULL,
  `uang_investor` varchar(50) NOT NULL,
  `nisbah_investor` varchar(10) NOT NULL,
  `id_pengelola` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengelola`
--

CREATE TABLE `pengelola` (
  `id_pengelola` int(11) NOT NULL,
  `nama_pengelola` varchar(50) NOT NULL,
  `username_pengelola` varchar(15) NOT NULL,
  `password_pengelola` text NOT NULL,
  `nisbah_pengelola` varchar(10) NOT NULL,
  `sharing_pengelola` date NOT NULL,
  `link_pengelola` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengelola`
--

INSERT INTO `pengelola` (`id_pengelola`, `nama_pengelola`, `username_pengelola`, `password_pengelola`, `nisbah_pengelola`, `sharing_pengelola`, `link_pengelola`) VALUES
(1, 'Adit', 'adit', '$2y$10$x5t2mpUZhT.4PEy0FuLbhOUqEUiE2G0/B/1gIDm4l4gt2FPuRzrGK', '0.5', '2019-12-09', 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTgDqTyolKmapcXp4DelpF0JdMDwa2LbRFf10VZGGATnBkA-IjeatYrhW2V5uIg70YNNa3jCpeNNovr/pubhtml?widget=true&amp;headers=false');

-- --------------------------------------------------------

--
-- Table structure for table `profit`
--

CREATE TABLE `profit` (
  `id_profit` int(11) NOT NULL,
  `tgl_profit` date NOT NULL,
  `bln_profit` varchar(5) NOT NULL,
  `total_profit` varchar(50) NOT NULL,
  `status_profit` varchar(15) NOT NULL,
  `time_profit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_pengelola` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `investor`
--
ALTER TABLE `investor`
  ADD PRIMARY KEY (`id_investor`),
  ADD KEY `id_pengelola` (`id_pengelola`);

--
-- Indexes for table `pengelola`
--
ALTER TABLE `pengelola`
  ADD PRIMARY KEY (`id_pengelola`);

--
-- Indexes for table `profit`
--
ALTER TABLE `profit`
  ADD PRIMARY KEY (`id_profit`),
  ADD KEY `id_pengelola` (`id_pengelola`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `investor`
--
ALTER TABLE `investor`
  MODIFY `id_investor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pengelola`
--
ALTER TABLE `pengelola`
  MODIFY `id_pengelola` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profit`
--
ALTER TABLE `profit`
  MODIFY `id_profit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
