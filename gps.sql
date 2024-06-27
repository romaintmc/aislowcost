-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 09 oct. 2020 à 10:43
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
-- Structure de la table `gps`
--

DROP TABLE IF EXISTS `gps`;
CREATE TABLE IF NOT EXISTS `gps` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DEVICE` text NOT NULL,
  `LAT` float NOT NULL,
  `LON` float NOT NULL,
  `ALT` float NOT NULL,
  `time` bigint(20) NOT NULL,
  `FRE` float NOT NULL,
  `RSSI` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `gps`
--

INSERT INTO `gps` (`ID`, `DEVICE`, `LAT`, `LON`, `ALT`, `time`, `FRE`, `RSSI`) VALUES
(1, 'tbeam2', 48.4096, -4.4874, 5.47, 1601996746970, 867.7, -42),
(2, 'tbeam2', 48.4096, -4.4874, -4.4874, 1602238588032, 867.7, -47),
(3, 'tbeam1', 48.4094, -4.4871, -4.4871, 1602238589197, 868.5, -77),
(4, 'tbeam2', 48.4096, -4.4874, -4.4874, 1602238620374, 867.9, -46),
(5, 'tbeam1', 48.4094, -4.4871, -4.4871, 1602238621526, 867.1, -84),
(6, 'tbeam2', 48.4096, -4.4874, -4.4874, 1602238652252, 868.1, -47),
(7, 'tbeam1', 48.4094, -4.4871, -4.4871, 1602238653581, 867.3, -85),
(8, 'tbeam1', 48.4094, -4.4871, -4.4871, 1602238685647, 867.5, -81),
(9, 'tbeam2', 48.4096, -4.4874, -4.4874, 1602238716677, 868.5, -47),
(10, 'tbeam1', 48.4094, -4.4871, -4.4871, 1602238717774, 867.7, -77),
(11, 'tbeam2', 48.4096, -4.4874, -4.4874, 1602238748571, 867.1, -48),
(12, 'tbeam1', 48.4094, -4.4871, -4.4871, 1602238749686, 867.9, -79),
(13, 'tbeam2', 48.4096, -4.4874, -4.4874, 1602238780821, 867.3, -46),
(14, 'tbeam1', 48.4094, -4.4871, -4.4871, 1602238781911, 868.1, -79),
(15, 'tbeam2', 48.4096, -4.4874, -4.4874, 1602238812786, 867.5, -47),
(16, 'tbeam1', 48.4094, -4.4871, -4.4871, 1602238813851, 868.3, -77),
(17, 'tbeam2', 48.4096, -4.4874, -4.4874, 1602238844790, 867.7, -47),
(18, 'tbeam1', 48.4094, -4.4871, -4.4871, 1602238846154, 868.5, -76),
(19, 'tbeam2', 48.4096, -4.4874, -4.4874, 1602238877168, 867.9, -48),
(20, 'tbeam1', 48.4094, -4.4871, -4.4871, 1602238878286, 867.1, -84),
(21, 'tbeam2', 48.4096, -4.4874, -4.4874, 1602238909062, 868.1, -46),
(22, 'tbeam1', 48.4094, -4.487, -4.487, 1602238910123, 867.3, -81),
(23, 'tbeam2', 48.4096, -4.4874, -4.4874, 1602238941389, 868.3, -45),
(24, 'tbeam1', 48.4094, -4.487, -4.487, 1602238942436, 867.5, -81),
(25, 'tbeam2', 48.4097, -4.4874, -4.4874, 1602238973422, 868.5, -43),
(26, 'tbeam1', 48.4094, -4.4871, -4.4871, 1602238974378, 867.7, -81),
(27, 'tbeam2', 48.4097, -4.4874, -4.4874, 1602239005354, 867.1, -47),
(28, 'tbeam1', 48.4094, -4.4871, -4.4871, 1602239006650, 867.9, -81),
(29, 'tbeam2', 48.4096, -4.4874, -4.4874, 1602239037472, 867.3, -45),
(30, 'tbeam1', 48.4094, -4.4871, -4.4871, 1602239038522, 868.1, -79),
(31, 'tbeam2', 48.4096, -4.4874, -4.4874, 1602239069485, 867.5, -47),
(32, 'tbeam1', 48.4094, -4.4871, -4.4871, 1602239070650, 868.3, -76),
(33, 'tbeam2', 48.4096, -4.4874, -4.4874, 1602239101799, 867.7, -43),
(34, 'tbeam1', 48.4094, -4.487, -4.487, 1602239103154, 868.5, -77),
(35, 'tbeam2', 48.4096, -4.4874, -4.4874, 1602239133749, 867.9, -45),
(36, 'tbeam1', 48.4094, -4.487, -4.487, 1602239135063, 867.1, -82),
(37, 'tbeam2', 48.4096, -4.4874, -4.4874, 1602239165868, 868.1, -47),
(38, 'tbeam1', 48.4094, -4.487, -4.487, 1602239167195, 867.3, -81),
(39, 'tbeam2', 48.4096, -4.4874, -4.4874, 1602239198158, 868.3, -43),
(40, 'tbeam1', 48.4094, -4.487, -4.487, 1602239199044, 867.5, -81),
(41, 'tbeam2', 48.4096, -4.4874, -4.4874, 1602239229991, 868.5, -45),
(42, 'tbeam1', 48.4094, -4.4872, -4.4872, 1602239231325, 867.7, -78),
(43, 'tbeam2', 48.4096, -4.4874, -4.4874, 1602239262369, 867.1, -46),
(44, 'tbeam1', 48.4094, -4.4872, -4.4872, 1602239263423, 867.9, -81),
(45, 'tbeam2', 48.4097, -4.4874, -4.4874, 1602239294175, 867.3, -46),
(46, 'tbeam1', 48.4094, -4.4872, -4.4872, 1602239295325, 868.1, -81),
(47, 'tbeam2', 48.4097, -4.4874, -4.4874, 1602239326400, 867.5, -45),
(48, 'tbeam1', 48.4094, -4.4872, -4.4872, 1602239327431, 868.3, -78),
(49, 'tbeam2', 48.4096, -4.4874, -4.4874, 1602239358463, 867.7, -45),
(50, 'tbeam1', 48.4094, -4.4872, -4.4872, 1602239359499, 868.5, -76),
(51, 'tbeam2', 48.4097, -4.4874, -4.4874, 1602239390852, 867.9, -45),
(52, 'tbeam1', 48.4094, -4.4872, -4.4872, 1602239391650, 867.1, -84),
(53, 'tbeam2', 48.4097, -4.4874, -4.4874, 1602239422835, 868.1, -47),
(54, 'tbeam1', 48.4094, -4.4872, -4.4872, 1602239423923, 867.3, -83),
(55, 'tbeam2', 48.4097, -4.4874, -4.4874, 1602239454721, 868.3, -45),
(56, 'tbeam1', 48.4094, -4.4872, -4.4872, 1602239455944, 867.5, -81),
(57, 'tbeam2', 48.4097, -4.4874, -4.4874, 1602239487055, 868.5, -43),
(58, 'tbeam1', 48.4094, -4.4872, -4.4872, 1602239488122, 867.7, -81),
(59, 'tbeam2', 48.4097, -4.4874, -4.4874, 1602239518867, 867.1, -47),
(60, 'tbeam1', 48.4094, -4.4872, -4.4872, 1602239520259, 867.9, -81),
(61, 'tbeam2', 48.4097, -4.4874, -4.4874, 1602239551018, 867.3, -44),
(62, 'tbeam1', 48.4094, -4.4872, -4.4872, 1602239552384, 868.1, -79),
(63, 'tbeam2', 48.4097, -4.4874, -4.4874, 1602239583069, 867.5, -45),
(64, 'tbeam1', 48.4094, -4.4872, -4.4872, 1602239584205, 868.3, -77),
(65, 'tbeam2', 48.4096, -4.4875, -4.4875, 1602239615448, 867.7, -43),
(66, 'tbeam1', 48.4094, -4.4872, -4.4872, 1602239616520, 868.5, -77),
(67, 'tbeam2', 48.4096, -4.4875, -4.4875, 1602239647223, 867.9, -44),
(68, 'tbeam1', 48.4094, -4.4872, -4.4872, 1602239648672, 867.1, -84),
(69, 'tbeam2', 48.4096, -4.4875, -4.4875, 1602239679487, 868.1, -47),
(70, 'tbeam1', 48.4094, -4.4872, -4.4872, 1602239680664, 867.3, -83),
(71, 'tbeam2', 48.4096, -4.4875, -4.4875, 1602239711688, 868.3, -43),
(72, 'tbeam1', 48.4094, -4.4872, -4.4872, 1602239712969, 867.5, -81),
(73, 'tbeam2', 48.4096, -4.4874, -4.4874, 1602239743966, 868.5, -45),
(74, 'tbeam1', 48.4094, -4.4872, -4.4872, 1602239744676, 867.7, -81),
(75, 'tbeam2', 48.4096, -4.4874, -4.4874, 1602239775682, 867.1, -47),
(76, 'tbeam1', 48.4094, -4.4872, -4.4872, 1602239777006, 867.9, -79),
(77, 'tbeam2', 48.4096, -4.4874, -4.4874, 1602239808289, 867.3, -47),
(78, 'tbeam1', 48.4094, -4.4872, -4.4872, 1602239809115, 868.1, -81),
(79, 'tbeam2', 48.4096, -4.4874, -4.4874, 1602239840183, 867.5, -45),
(80, 'tbeam1', 48.4094, -4.4872, -4.4872, 1602239841219, 868.3, -77),
(81, 'tbeam2', 48.4096, -4.4874, -4.4874, 1602239871948, 867.7, -45),
(82, 'tbeam1', 48.4094, -4.4872, -4.4872, 1602239873333, 868.5, -78),
(83, 'tbeam2', 48.4096, -4.4874, -4.4874, 1602239904214, 867.9, -44),
(84, 'tbeam1', 48.4094, -4.4871, -4.4871, 1602239905419, 867.1, -83),
(85, 'tbeam2', 48.4099, -4.4874, -4.4874, 1602239936154, 868.1, -44),
(86, 'tbeam1', 48.4094, -4.4872, -4.4872, 1602239937388, 867.3, -80),
(87, 'tbeam2', 48.4099, -4.4874, -4.4874, 1602239968243, 868.3, -42),
(88, 'tbeam1', 48.4094, -4.4872, -4.4872, 1602239969371, 867.5, -81),
(89, 'tbeam2', 48.41, -4.4874, -4.4874, 1602240000674, 868.5, -45),
(90, 'tbeam1', 48.4094, -4.4872, -4.4872, 1602240001893, 867.7, -81),
(91, 'tbeam2', 48.41, -4.4874, -4.4874, 1602240032474, 867.1, -45),
(92, 'tbeam1', 48.4094, -4.4872, -4.4872, 1602240033813, 867.9, -81),
(93, 'tbeam2', 48.4099, -4.4874, -4.4874, 1602240064939, 867.3, -47),
(94, 'tbeam1', 48.4095, -4.4872, -4.4872, 1602240065648, 868.1, -81),
(95, 'tbeam2', 48.4098, -4.4874, -4.4874, 1602240096880, 867.5, -42),
(96, 'tbeam1', 48.4095, -4.4872, -4.4872, 1602240098064, 868.3, -79),
(97, 'tbeam2', 48.4098, -4.4874, -4.4874, 1602240128964, 867.7, -42),
(98, 'tbeam1', 48.4095, -4.4872, -4.4872, 1602240129893, 868.5, -78),
(99, 'tbeam2', 48.4098, -4.4874, -4.4874, 1602240160850, 867.9, -45),
(100, 'tbeam1', 48.4095, -4.4872, -4.4872, 1602240162214, 867.1, -87);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;