-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 19 Avril 2017 à 13:52
-- Version du serveur :  5.6.24
-- Version de PHP :  5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `jdr`
--

-- --------------------------------------------------------

--
-- Structure de la table `composer`
--

CREATE TABLE IF NOT EXISTS `composer` (
  `composer_partie_id` bigint(20) unsigned NOT NULL,
  `composer_ennemi_id` bigint(20) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ennemi`
--

CREATE TABLE IF NOT EXISTS `ennemi` (
  `ennemi_id` bigint(20) unsigned NOT NULL,
  `ennemi_nom` varchar(40) NOT NULL,
  `ennemi_espece` varchar(40) NOT NULL,
  `ennemi_vie` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ennemi`
--

INSERT INTO `ennemi` (`ennemi_id`, `ennemi_nom`, `ennemi_espece`, `ennemi_vie`) VALUES
(3, 'premer', 'gobr', 5);

-- --------------------------------------------------------

--
-- Structure de la table `joueur`
--

CREATE TABLE IF NOT EXISTS `joueur` (
  `joueur_id` bigint(20) unsigned NOT NULL,
  `joueur_pseudo` varchar(40) NOT NULL,
  `joueur_score` int(10) unsigned NOT NULL DEFAULT '0',
  `joueur_vie` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `joueur`
--

INSERT INTO `joueur` (`joueur_id`, `joueur_pseudo`, `joueur_score`, `joueur_vie`) VALUES
(1, 'rtr', 0, 1),
(5, 'deuzr', 0, 3);

-- --------------------------------------------------------

--
-- Structure de la table `partie`
--

CREATE TABLE IF NOT EXISTS `partie` (
  `partie_id` bigint(20) unsigned NOT NULL,
  `partie_joueur_id` bigint(20) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `composer`
--
ALTER TABLE `composer`
  ADD PRIMARY KEY (`composer_partie_id`,`composer_ennemi_id`), ADD KEY `fk_composer_ennemi` (`composer_ennemi_id`);

--
-- Index pour la table `ennemi`
--
ALTER TABLE `ennemi`
  ADD PRIMARY KEY (`ennemi_id`);

--
-- Index pour la table `joueur`
--
ALTER TABLE `joueur`
  ADD PRIMARY KEY (`joueur_id`), ADD UNIQUE KEY `pseudo_joueur` (`joueur_pseudo`);

--
-- Index pour la table `partie`
--
ALTER TABLE `partie`
  ADD PRIMARY KEY (`partie_id`,`partie_joueur_id`), ADD KEY `fk_partie_joueur` (`partie_joueur_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `ennemi`
--
ALTER TABLE `ennemi`
  MODIFY `ennemi_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `joueur`
--
ALTER TABLE `joueur`
  MODIFY `joueur_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `partie`
--
ALTER TABLE `partie`
  MODIFY `partie_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `composer`
--
ALTER TABLE `composer`
ADD CONSTRAINT `fk_composer_ennemi` FOREIGN KEY (`composer_ennemi_id`) REFERENCES `ennemi` (`ennemi_id`),
ADD CONSTRAINT `fk_composer_partie` FOREIGN KEY (`composer_partie_id`) REFERENCES `partie` (`partie_id`);

--
-- Contraintes pour la table `partie`
--
ALTER TABLE `partie`
ADD CONSTRAINT `fk_partie_joueur` FOREIGN KEY (`partie_joueur_id`) REFERENCES `joueur` (`joueur_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
