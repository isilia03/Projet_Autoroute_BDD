-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 24 Avril 2017 à 17:45
-- Version du serveur :  10.1.9-MariaDB
-- Version de PHP :  5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_autoroutes`
--

-- --------------------------------------------------------

--
-- Structure de la table `autoroutes`
--

CREATE TABLE `autoroutes` (
  `codA` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `autoroutes`
--

INSERT INTO `autoroutes` (`codA`, `date_debut`, `date_fin`) VALUES
(1, '2017-04-01', '2030-04-01'),
(2, '2017-04-01', '2030-04-01'),
(3, '2017-04-01', '2030-04-01'),
(4, '2017-04-01', '2030-04-01'),
(5, '2017-04-01', '2030-04-01'),
(6, '2017-04-01', '2030-04-01');

-- --------------------------------------------------------

--
-- Structure de la table `changement`
--

CREATE TABLE `changement` (
  `nb_sortie` int(11) NOT NULL,
  `codA` int(11) NOT NULL,
  `codT` int(11) NOT NULL,
  `position` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `intersection`
--

CREATE TABLE `intersection` (
  `autoroute` int(11) NOT NULL,
  `nb_troncon` int(11) NOT NULL,
  `ID_intersection` int(11) NOT NULL,
  `debut_fin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `proprietaire`
--

CREATE TABLE `proprietaire` (
  `ID` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `CA` double NOT NULL,
  `debut_contrat` date NOT NULL,
  `fin_contrat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `proprietaire`
--

INSERT INTO `proprietaire` (`ID`, `nom`, `CA`, `debut_contrat`, `fin_contrat`) VALUES
(1, 'Pognon', 0, '2017-04-04', '2017-04-29'),
(2, 'troll', 0, '2017-04-01', '2030-04-26');

-- --------------------------------------------------------

--
-- Structure de la table `troncons`
--

CREATE TABLE `troncons` (
  `codA` int(11) NOT NULL,
  `CodT` int(11) NOT NULL,
  `vistesse_moyenne` int(11) NOT NULL,
  `etat` int(11) NOT NULL,
  `distance` int(11) NOT NULL,
  `cout` double NOT NULL,
  `proprietaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `troncons`
--

INSERT INTO `troncons` (`codA`, `CodT`, `vistesse_moyenne`, `etat`, `distance`, `cout`, `proprietaire`) VALUES
(1, 0, 120, 1, 100, 0, 1),
(1, 1, 120, 1, 100, 0, 1),
(1, 2, 120, 1, 100, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `villes`
--

CREATE TABLE `villes` (
  `ville` varchar(50) NOT NULL,
  `CodA` int(11) NOT NULL,
  `CodT` int(11) NOT NULL,
  `COD_sortie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `autoroutes`
--
ALTER TABLE `autoroutes`
  ADD PRIMARY KEY (`codA`);

--
-- Index pour la table `changement`
--
ALTER TABLE `changement`
  ADD KEY `codT` (`codT`),
  ADD KEY `codA` (`codA`),
  ADD KEY `nb_sortie` (`nb_sortie`);

--
-- Index pour la table `intersection`
--
ALTER TABLE `intersection`
  ADD PRIMARY KEY (`autoroute`,`nb_troncon`,`ID_intersection`),
  ADD KEY `autoroute1` (`autoroute`),
  ADD KEY `nb_troncon1` (`nb_troncon`);

--
-- Index pour la table `proprietaire`
--
ALTER TABLE `proprietaire`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- Index pour la table `troncons`
--
ALTER TABLE `troncons`
  ADD PRIMARY KEY (`CodT`,`codA`),
  ADD KEY `codA` (`codA`),
  ADD KEY `proprietaire` (`proprietaire`),
  ADD KEY `CodT` (`CodT`);

--
-- Index pour la table `villes`
--
ALTER TABLE `villes`
  ADD KEY `CodA` (`CodA`),
  ADD KEY `CodT` (`CodT`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `autoroutes`
--
ALTER TABLE `autoroutes`
  MODIFY `codA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `proprietaire`
--
ALTER TABLE `proprietaire`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `changement`
--
ALTER TABLE `changement`
  ADD CONSTRAINT `changement_ibfk_1` FOREIGN KEY (`codT`) REFERENCES `troncons` (`CodT`),
  ADD CONSTRAINT `changement_ibfk_2` FOREIGN KEY (`codA`) REFERENCES `troncons` (`codA`);

--
-- Contraintes pour la table `intersection`
--
ALTER TABLE `intersection`
  ADD CONSTRAINT `intersection_ibfk_1` FOREIGN KEY (`autoroute`) REFERENCES `troncons` (`codA`),
  ADD CONSTRAINT `intersection_ibfk_2` FOREIGN KEY (`nb_troncon`) REFERENCES `troncons` (`CodT`);

--
-- Contraintes pour la table `troncons`
--
ALTER TABLE `troncons`
  ADD CONSTRAINT `troncons_ibfk_1` FOREIGN KEY (`codA`) REFERENCES `autoroutes` (`codA`),
  ADD CONSTRAINT `troncons_ibfk_2` FOREIGN KEY (`proprietaire`) REFERENCES `proprietaire` (`ID`);

--
-- Contraintes pour la table `villes`
--
ALTER TABLE `villes`
  ADD CONSTRAINT `villes_ibfk_1` FOREIGN KEY (`CodT`) REFERENCES `changement` (`codT`),
  ADD CONSTRAINT `villes_ibfk_2` FOREIGN KEY (`CodA`) REFERENCES `changement` (`codA`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
