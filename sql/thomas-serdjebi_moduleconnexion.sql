-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 25 nov. 2021 à 11:11
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `thomas-serdjebi_moduleconnexion`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `prenom`, `nom`, `password`) VALUES
(37, 'jeanjacques', 'jean', 'charles', 'a501c5600d5c5de5c8536ff1b09fbbba'),
(51, 'chevremiel', 'chevre', 'miel', '8839e44a4147c04f732bf21d49b92d0d'),
(50, 'chuckbass', 'chuck', 'bass', '0f5f09584900036eb34cdad8394b3b49'),
(49, 'marsmars', 'mars', 'mars', 'd01f4e0678a689de8c323b1133c9cb42'),
(48, 'pataterousse', 'patate', 'rousse', '37b879e4b1bb9dccf594d273cca5298d'),
(47, 'marvinguy', 'marvin', 'guy', 'a96902211fa31aab6eda8110ff2c32d8'),
(46, 'lasttest', 'lasttest', 'lasttest', '609e039c90cd9f7af0f7483735089053'),
(45, 'bananejaune', 'banane', 'jaune', 'c6cebeb5770b0792419ca4e48ec956dd'),
(43, 'jeanpierre', 'jean', 'pirateur', 'a501c5600d5c5de5c8536ff1b09fbbba'),
(42, 'jeancanape', 'jean', 'canape', 'a501c5600d5c5de5c8536ff1b09fbbba'),
(39, 'jeanpatate', 'jean', 'patate', 'a501c5600d5c5de5c8536ff1b09fbbba'),
(38, 'jeanclaude', 'jean', 'claude', 'a501c5600d5c5de5c8536ff1b09fbbba'),
(40, 'thomasserdjebi', 'thomas', 'serdjebi', 'a501c5600d5c5de5c8536ff1b09fbbba');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
