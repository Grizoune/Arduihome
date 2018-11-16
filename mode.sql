-- phpMyAdmin SQL Dump
-- version 4.6.4deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 30, 2017 at 10:26 AM
-- Server version: 5.7.17-0ubuntu0.16.10.1
-- PHP Version: 7.0.8-3ubuntu3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arduihome`
--

-- --------------------------------------------------------

--
-- Table structure for table `mode`
--

CREATE TABLE `mode` (
  `id` int(5) NOT NULL,
  `nom` varchar(35) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `active_code` text NOT NULL,
  `active_xml` text NOT NULL,
  `desactive_code` text NOT NULL,
  `desactive_xml` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mode`
--

INSERT INTO `mode` (`id`, `nom`, `active`, `active_code`, `active_xml`, `desactive_code`, `desactive_xml`) VALUES
(1, 'Persienne', 0, '$this->sendCommande(4);sleep(5);$this->sendCommande(4);', '<xml xmlns="http://www.w3.org/1999/xhtml"><block type="commande_domo" id=";_W%NxynCYtd]#2Bfcxg" x="420" y="71"><field name="VAR_ACTION">4</field><next><block type="sleep" id="fB4Ro`b=xw3(`y7KBd-R"><field name="VALUE_SLEEP">5</field><next><block type="commande_domo" id="BCZURKE5H6ASaMOTJqs{"><field name="VAR_ACTION">4</field></block></next></block></next></block></xml>', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mode`
--
ALTER TABLE `mode`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mode`
--
ALTER TABLE `mode`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
