-- phpMyAdmin SQL Dump
-- version 4.6.4deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 02, 2017 at 09:03 PM
-- Server version: 5.7.16-0ubuntu0.16.10.1
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
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `id_peripherique` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `contenu` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`id`, `id_peripherique`, `nom`, `contenu`) VALUES
(1, 1, 'ON', 'id_group=21876562\r\nid_bouton=0\r\netat=true'),
(2, 1, 'OFF', 'id_group=21876562\r\nid_bouton=0\r\netat=false'),
(3, 2, 'UP', 'id_group=21220650\r\nid_bouton=1\r\netat=false'),
(4, 2, 'DOWN', 'id_group=21220650\r\nid_bouton=1\r\netat=true'),
(5, 3, 'ON', 'id_group=21876562\r\nid_bouton=1\r\netat=true'),
(6, 3, 'OFF', 'id_group=21876562\r\nid_bouton=1\r\netat=false'),
(7, 4, 'ON', 'id_group=21876562\nid_bouton=2\netat=true'),
(8, 4, 'OFF', 'id_group=21876562\nid_bouton=2\netat=false'),
(9, 5, 'ON', 'id_group=23761518\nid_bouton=0\netat=true'),
(10, 5, 'OFF', 'id_group=23761518\nid_bouton=0\netat=false');

-- --------------------------------------------------------

--
-- Table structure for table `commande_has_groupe`
--

CREATE TABLE `commande_has_groupe` (
  `id_commande` int(11) NOT NULL,
  `id_groupe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `commande_planifiees`
--

CREATE TABLE `commande_planifiees` (
  `id_commande` int(11) NOT NULL,
  `id_planification` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commande_planifiees`
--

INSERT INTO `commande_planifiees` (`id_commande`, `id_planification`) VALUES
(9, 1),
(10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `fonction`
--

CREATE TABLE `fonction` (
  `id` int(11) NOT NULL,
  `fonction` varchar(45) NOT NULL,
  `id_zone` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fonction`
--

INSERT INTO `fonction` (`id`, `fonction`, `id_zone`) VALUES
(1, 'Eclairage exterieur', 3),
(2, 'Eclairage table', 1),
(3, 'Sapin', 1),
(4, 'Volet Roulant', 2),
(5, 'test', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groupe`
--

CREATE TABLE `groupe` (
  `id` int(11) NOT NULL,
  `nom_groupe` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `peripherique`
--

CREATE TABLE `peripherique` (
  `id` int(11) NOT NULL,
  `id_type_peripherique` int(11) NOT NULL,
  `id_zone` int(11) NOT NULL,
  `id_fonction` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `masque` tinyint(1) NOT NULL DEFAULT '0',
  `target` varchar(45) NOT NULL,
  `favoris` tinyint(1) NOT NULL DEFAULT '0',
  `last_heartbeat` datetime DEFAULT NULL,
  `etat` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `peripherique`
--

INSERT INTO `peripherique` (`id`, `id_type_peripherique`, `id_zone`, `id_fonction`, `nom`, `masque`, `target`, `favoris`, `last_heartbeat`, `etat`) VALUES
(1, 1, 1, 2, 'Lumiere table', 0, 'xpl-ardui.relais', 0, NULL, NULL),
(2, 2, 2, 4, 'Volet bureau', 0, 'xpl-ardui.relais', 0, NULL, NULL),
(3, 1, 3, 1, 'Sous toiture', 0, 'xpl-ardui.relais', 0, NULL, NULL),
(4, 1, 1, 3, 'Sapin', 0, 'xpl-ardui.relais', 0, NULL, NULL),
(5, 1, 4, 5, 'Prise bureau', 0, 'xpl-ardui.relais', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `planification`
--

CREATE TABLE `planification` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `interval` varchar(45) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `last_exec` datetime DEFAULT NULL,
  `next_exec` datetime DEFAULT NULL,
  `dead` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `planification`
--

INSERT INTO `planification` (`id`, `nom`, `interval`, `active`, `last_exec`, `next_exec`, `dead`) VALUES
(1, 'Allumage du sapin', 'T120S', 0, '2017-01-01 22:25:01', '2017-01-01 22:27:01', NULL),
(2, 'Extinction du sapin', 'T120S', 0, '2017-01-01 22:24:01', '2017-01-01 22:26:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `type_peripherique`
--

CREATE TABLE `type_peripherique` (
  `id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `type_message` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type_peripherique`
--

INSERT INTO `type_peripherique` (`id`, `type`, `type_message`) VALUES
(1, 'Prise commandée', 'homeeasy.basic'),
(2, 'Volet roulant', 'homeeasy.basic');

-- --------------------------------------------------------

--
-- Table structure for table `zone`
--

CREATE TABLE `zone` (
  `id` int(11) NOT NULL,
  `zone` varchar(45) NOT NULL,
  `image` varchar(45) DEFAULT 'default'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `zone`
--

INSERT INTO `zone` (`id`, `zone`, `image`) VALUES
(1, 'Cuisine/Salon', 'canape'),
(2, 'Bureau Lucie', 'bureau'),
(3, 'Jardin', 'jardin'),
(4, 'Bureau Sylvain', 'bureau');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_etat_peripherique1_idx` (`id_peripherique`);

--
-- Indexes for table `commande_has_groupe`
--
ALTER TABLE `commande_has_groupe`
  ADD PRIMARY KEY (`id_commande`,`id_groupe`),
  ADD KEY `fk_commande_has_commandes_groupees_commandes_groupees1_idx` (`id_groupe`),
  ADD KEY `fk_commande_has_commandes_groupees_commande1_idx` (`id_commande`);

--
-- Indexes for table `commande_planifiees`
--
ALTER TABLE `commande_planifiees`
  ADD PRIMARY KEY (`id_commande`,`id_planification`),
  ADD KEY `fk_commande_has_planification_planification1_idx` (`id_planification`),
  ADD KEY `fk_commande_has_planification_commande1_idx` (`id_commande`);

--
-- Indexes for table `fonction`
--
ALTER TABLE `fonction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fonction_zone1_idx` (`id_zone`);

--
-- Indexes for table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peripherique`
--
ALTER TABLE `peripherique`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_peripherique_type_peripherique_idx` (`id_type_peripherique`),
  ADD KEY `fk_peripherique_zone1_idx` (`id_zone`),
  ADD KEY `fk_peripherique_fonction1_idx` (`id_fonction`);

--
-- Indexes for table `planification`
--
ALTER TABLE `planification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_peripherique`
--
ALTER TABLE `type_peripherique`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zone`
--
ALTER TABLE `zone`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `fonction`
--
ALTER TABLE `fonction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `peripherique`
--
ALTER TABLE `peripherique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `planification`
--
ALTER TABLE `planification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `type_peripherique`
--
ALTER TABLE `type_peripherique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `zone`
--
ALTER TABLE `zone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `fk_etat_peripherique1` FOREIGN KEY (`id_peripherique`) REFERENCES `peripherique` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `commande_has_groupe`
--
ALTER TABLE `commande_has_groupe`
  ADD CONSTRAINT `fk_commande_has_commandes_groupees_commande1` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_commande_has_commandes_groupees_commandes_groupees1` FOREIGN KEY (`id_groupe`) REFERENCES `groupe` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `commande_planifiees`
--
ALTER TABLE `commande_planifiees`
  ADD CONSTRAINT `fk_commande_has_planification_commande1` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_commande_has_planification_planification1` FOREIGN KEY (`id_planification`) REFERENCES `planification` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `fonction`
--
ALTER TABLE `fonction`
  ADD CONSTRAINT `fk_fonction_zone1` FOREIGN KEY (`id_zone`) REFERENCES `zone` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `peripherique`
--
ALTER TABLE `peripherique`
  ADD CONSTRAINT `fk_peripherique_fonction1` FOREIGN KEY (`id_fonction`) REFERENCES `fonction` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_peripherique_type_peripherique` FOREIGN KEY (`id_type_peripherique`) REFERENCES `type_peripherique` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_peripherique_zone1` FOREIGN KEY (`id_zone`) REFERENCES `zone` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
