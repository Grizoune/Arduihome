-- phpMyAdmin SQL Dump
-- version 4.6.4deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 05, 2017 at 11:08 PM
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
  `contenu` text NOT NULL,
  `nouvelle_valeur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`id`, `id_peripherique`, `nom`, `contenu`, `nouvelle_valeur`) VALUES
(1, 1, 'ON', 'id_group=21876562\r\nid_bouton=0\r\netat=true', 1),
(2, 1, 'OFF', 'id_group=21876562\r\nid_bouton=0\r\netat=false', 0),
(3, 2, 'UP', 'id_group=21220650\r\nid_bouton=1\r\netat=false', 0),
(4, 2, 'DOWN', 'id_group=21220650\r\nid_bouton=1\r\netat=true', 1),
(5, 3, 'ON', 'id_group=21876562\r\nid_bouton=1\r\netat=true', 1),
(6, 3, 'OFF', 'id_group=21876562\r\nid_bouton=1\r\netat=false', 0),
(7, 4, 'ON', 'id_group=21876562\nid_bouton=2\netat=true', 1),
(8, 4, 'OFF', 'id_group=21876562\nid_bouton=2\netat=false', 0),
(9, 5, 'ON', 'id_group=23761518\nid_bouton=0\netat=true', 1),
(10, 5, 'OFF', 'id_group=23761518\nid_bouton=0\netat=false', 0);

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
(5, 'test', NULL),
(6, 'Alarme', 5);

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
  `valeur` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `peripherique`
--

INSERT INTO `peripherique` (`id`, `id_type_peripherique`, `id_zone`, `id_fonction`, `nom`, `masque`, `target`, `favoris`, `last_heartbeat`, `valeur`) VALUES
(1, 1, 1, 2, 'Lumiere table', 0, 'xpl-ardui.relais', 0, NULL, NULL),
(2, 2, 2, 4, 'Volet bureau', 0, 'xpl-ardui.relais', 0, NULL, 1),
(3, 1, 3, 1, 'Sous toiture', 0, 'xpl-ardui.relais', 0, NULL, NULL),
(4, 1, 1, 3, 'Sapin', 0, 'xpl-ardui.relais', 0, NULL, NULL),
(5, 1, 4, 5, 'Prise bureau', 0, 'xpl-ardui.relais', 0, NULL, NULL),
(6, 3, 1, 6, 'Alarme maison', 0, 'xpl-ardui.alarme', 1, NULL, 0);

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
-- Table structure for table `scenario`
--

CREATE TABLE `scenario` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `priorite` int(2) NOT NULL DEFAULT '1',
  `code` text,
  `xml` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scenario`
--

INSERT INTO `scenario` (`id`, `nom`, `priorite`, `code`, `xml`) VALUES
(1, 'Gestion alarme', 1, 'if ($this->getValeur(6) == 1) {\n  $this->sendCommande(4);}\n', '<xml xmlns="http://www.w3.org/1999/xhtml"><block type="controls_if" id="1v4o#*PLQ.!CD^wTM*?J" x="763" y="151"><value name="IF0"><block type="logic_compare" id="k9JqBp[me.nwk@IaK`Aa"><field name="OP">EQ</field><value name="A"><block type="valeur_domo" id="Qq/Dy5=o=;loUhccT:.o"><field name="VAR_VALEUR">6</field></block></value><value name="B"><block type="math_number" id="sGK{Z*$[[}aIPDIY.TiS"><field name="NUM">1</field></block></value></block></value><statement name="DO0"><block type="commande_domo" id="Rc:OU{Ag*hDp|R^LYR_f"><field name="VAR_ACTION">4</field></block></statement></block></xml>'),
(2, 'Fermeture automatique volet', 2, 'if (false) {\n}\n', 'PHhtbCB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94aHRtbCI PGJsb2NrIHR5cGU9ImNvbnRyb2xzX2lmIiBpZD0iQnpzT2lfSXctOldDekk/cy18XlsiIHg9Ijc5MCIgeT0iMTAwIj48L2Jsb2NrPjwveG1sPg==');

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
(2, 'Volet roulant', 'homeeasy.basic'),
(3, 'Capteur', 'sensor.basic');

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
(4, 'Bureau Sylvain', 'bureau'),
(5, 'Garage', 'garage');

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
-- Indexes for table `scenario`
--
ALTER TABLE `scenario`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `peripherique`
--
ALTER TABLE `peripherique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `planification`
--
ALTER TABLE `planification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `scenario`
--
ALTER TABLE `scenario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `type_peripherique`
--
ALTER TABLE `type_peripherique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `zone`
--
ALTER TABLE `zone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
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
