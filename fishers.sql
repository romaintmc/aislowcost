-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 05 oct. 2020 à 16:04
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `test`
--

-- --------------------------------------------------------

--
-- Structure de la table `fishers`
--

DROP TABLE IF EXISTS `fishers`;
CREATE TABLE IF NOT EXISTS `fishers` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DEVICE` text NOT NULL,
  `NAME` text NOT NULL,
  `PHONE` text NOT NULL,
  `EMAIL` text NOT NULL,
  `AGE` text NOT NULL,
  `GENDER` varchar(1) NOT NULL,
  `BOAT_NUMBER` int(11) NOT NULL,
  `BOAT_TYPE` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fishers`
--

INSERT INTO `fishers` (`ID`, `DEVICE`, `NAME`, `PHONE`, `EMAIL`, `AGE`, `GENDER`, `BOAT_NUMBER`, `BOAT_TYPE`) VALUES
(1, 'tbeam1', 'VO QUOC THONG', '', '', '', 'F', 123, 'Panier'),
(2, 'tbeam2', 'LE NGOC TRAN', '', '', '', 'F', 1235, 'Panier'),
(3, 'tbeam3', 'VINCENT MARIETTE', '0601889469', 'thong.vo@cegetel.net', '32', 'F', 678, 'Panier'),
(4, 'tbeam4', 'S', '0601889469', 'thong.vo@cegetel.net', '12', 'F', 456, 'Panier'),
(5, 'tbeam5', 'VO QUOC THONG', '', '', '', 'F', 234609, 'Panier'),
(6, 'tbeam6', 'new', '', '', '', 'F', 1234598, 'Little Boat'),
(7, 'tbeam7', 'VO QUOC THONG', '', '', '', 'F', 2345, 'Panier');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
