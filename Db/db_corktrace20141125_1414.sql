-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Mar 25 Novembre 2014 à 14:14
-- Version du serveur :  5.5.38
-- Version de PHP :  5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `db_corktrace`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_conformite_cfm`
--

CREATE TABLE `t_conformite_cfm` (
`cfm_id` int(11) NOT NULL,
  `cfm_tca_fourni` decimal(10,2) NOT NULL,
  `cfm_tca_inter` decimal(10,2) NOT NULL,
  `cfm_gout` varchar(255) NOT NULL,
  `cfm_decision` enum('En attente','Conforme','Non Conforme','Exception') NOT NULL,
  `cfm_capilarite` decimal(10,2) NOT NULL,
  `cfm_humidite` decimal(10,2) NOT NULL,
  `cfm_diamcompr` decimal(10,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_conformite_cfm`
--

INSERT INTO `t_conformite_cfm` (`cfm_id`, `cfm_tca_fourni`, `cfm_tca_inter`, `cfm_gout`, `cfm_decision`, `cfm_capilarite`, `cfm_humidite`, `cfm_diamcompr`) VALUES
(1, 1.25, 1.77, 'oui', 'Non Conforme', 1.00, 5.00, 99.70),
(2, 1.25, 1.21, 'oui', 'Non Conforme', 0.00, 0.00, 0.00),
(3, 0.00, 0.00, 'En attente', 'En attente', 0.00, 0.00, 0.00),
(4, 0.61, 2.10, 'oui', 'Non Conforme', 0.00, 4.73, 80.00),
(5, 2.00, 0.00, 'oui', 'Non Conforme', 0.90, 0.00, 0.00),
(6, 0.00, 0.00, 'En attente', 'En attente', 0.00, 0.00, 0.00),
(7, 0.00, 0.00, 'En attente', 'En attente', 0.00, 0.00, 0.00),
(8, 0.00, 0.00, 'En attente', 'En attente', 0.00, 0.00, 0.00);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `t_conformite_cfm`
--
ALTER TABLE `t_conformite_cfm`
 ADD PRIMARY KEY (`cfm_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `t_conformite_cfm`
--
ALTER TABLE `t_conformite_cfm`
MODIFY `cfm_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;