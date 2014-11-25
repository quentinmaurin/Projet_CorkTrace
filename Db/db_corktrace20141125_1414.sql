-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Mar 25 Novembre 2014 à 14:20
-- Version du serveur :  5.5.38
-- Version de PHP :  5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `db_corktrace`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_adresse_adr`
--

CREATE TABLE `t_adresse_adr` (
`adr_id` int(11) NOT NULL,
  `adr_adresse` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_adresse_adr`
--

INSERT INTO `t_adresse_adr` (`adr_id`, `adr_adresse`) VALUES
(1, '23 avenue Julien Panchot 66000 PERPIGNAN'),
(2, '19 avenue de Grande Bretagne 66006 Perpignan'),
(3, '26 rue des amandiers 66680 canohes'),
(4, '2 rue Moulin d''Orles 66000 Perpignan'),
(5, 'Rue 1'),
(6, 'Rue 2');

-- --------------------------------------------------------

--
-- Structure de la table `t_arrivagedetail_ard`
--

CREATE TABLE `t_arrivagedetail_ard` (
`ard_id` int(11) NOT NULL,
  `ari_id` int(11) NOT NULL COMMENT 'id arrivage',
  `pro_id` int(11) NOT NULL COMMENT 'id produit',
  `cfm_id` int(11) NOT NULL COMMENT 'id conformite',
  `ard_quantite` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_arrivagedetail_ard`
--

INSERT INTO `t_arrivagedetail_ard` (`ard_id`, `ari_id`, `pro_id`, `cfm_id`, `ard_quantite`) VALUES
(1, 1, 3, 1, 120000),
(2, 1, 2, 2, 180000),
(3, 2, 3, 3, 120000);

--
-- Déclencheurs `t_arrivagedetail_ard`
--
DELIMITER //
CREATE TRIGGER `AUTO_ADD_STOCK` AFTER INSERT ON `t_arrivagedetail_ard`
 FOR EACH ROW UPDATE t_stock_stk
SET t_stock_stk.stk_stock = t_stock_stk.stk_stock+NEW.ard_quantite
WHERE t_stock_stk.pro_id = NEW.pro_id
//
DELIMITER ;
DELIMITER //
CREATE TRIGGER `AUTO_PICK_STOCK` AFTER DELETE ON `t_arrivagedetail_ard`
 FOR EACH ROW UPDATE t_stock_stk
SET t_stock_stk.stk_stock = t_stock_stk.stk_stock-OLD.ard_quantite
WHERE t_stock_stk.pro_id = OLD.pro_id
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `t_arrivage_ari`
--

CREATE TABLE `t_arrivage_ari` (
`ari_id` int(11) NOT NULL,
  `ari_num_arrivage` int(11) NOT NULL,
  `ari_date_recept` date NOT NULL,
  `ari_responsable` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_arrivage_ari`
--

INSERT INTO `t_arrivage_ari` (`ari_id`, `ari_num_arrivage`, `ari_date_recept`, `ari_responsable`) VALUES
(1, 0, '2014-11-24', 'NPG'),
(2, 0, '2014-11-24', 'NPG');

-- --------------------------------------------------------

--
-- Structure de la table `t_cliadr_cla`
--

CREATE TABLE `t_cliadr_cla` (
`cla_id` int(11) NOT NULL,
  `cli_id` int(11) NOT NULL,
  `adr_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_cliadr_cla`
--

INSERT INTO `t_cliadr_cla` (`cla_id`, `cli_id`, `adr_id`) VALUES
(1, 1, 5),
(2, 2, 6);

-- --------------------------------------------------------

--
-- Structure de la table `t_clicom_clc`
--

CREATE TABLE `t_clicom_clc` (
`clc_id` int(11) NOT NULL,
  `cli_id` int(11) NOT NULL COMMENT 'id client',
  `com_id` int(11) NOT NULL COMMENT 'id commercial'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_clicom_clc`
--

INSERT INTO `t_clicom_clc` (`clc_id`, `cli_id`, `com_id`) VALUES
(1, 2, 1),
(2, 1, 1),
(3, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `t_client_cli`
--

CREATE TABLE `t_client_cli` (
`cli_id` int(11) NOT NULL,
  `cli_nom` varchar(255) NOT NULL,
  `cli_mail` varchar(255) NOT NULL,
  `cli_tel` varchar(255) NOT NULL,
  `cli_fax` varchar(255) NOT NULL,
  `cli_adr_fact` varchar(255) NOT NULL,
  `tyc_id` int(11) NOT NULL COMMENT 'id type client'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_client_cli`
--

INSERT INTO `t_client_cli` (`cli_id`, `cli_nom`, `cli_mail`, `cli_tel`, `cli_fax`, `cli_adr_fact`, `tyc_id`) VALUES
(1, 'Les Vignerons Catalans', 'loic.trichaud@npgconseil.com', '0607080910', '0407080910', '35 avenue Julien Panchot 66000 PERPIGNAN', 1),
(2, 'Les Vins du Roussillon', 'quentin.maurin@npgconseil.com', '0661091765', '0461091765', '19 avenue de Grande Bretagne 66006 Perpignan', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_cmdclidetail_ccd`
--

CREATE TABLE `t_cmdclidetail_ccd` (
`ccd_id` int(11) NOT NULL,
  `ccl_id` int(11) NOT NULL COMMENT 'id commande client',
  `pro_id` int(11) NOT NULL COMMENT 'id produit',
  `ccd_prix` decimal(10,2) NOT NULL,
  `ccd_quantite` int(11) NOT NULL,
  `ccd_marquage` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_cmdclidetail_ccd`
--

INSERT INTO `t_cmdclidetail_ccd` (`ccd_id`, `ccl_id`, `pro_id`, `ccd_prix`, `ccd_quantite`, `ccd_marquage`) VALUES
(1, 1, 3, 169.00, 12000, 'MEB PR'),
(2, 1, 2, 239.00, 11000, 'MEB Chateau'),
(3, 2, 3, 200.00, 10000, 'MEB'),
(4, 3, 3, 200.00, 1000, 'MEB Pr');

-- --------------------------------------------------------

--
-- Structure de la table `t_cmdclient_ccl`
--

CREATE TABLE `t_cmdclient_ccl` (
`ccl_id` int(11) NOT NULL,
  `ccl_dateCmd` date NOT NULL,
  `ccl_dateLiv` date NOT NULL,
  `clc_id` int(11) NOT NULL COMMENT 'commercial table t_clicom',
  `dpy_id` int(11) NOT NULL COMMENT 'id table t_delaipaye',
  `ccl_dateConfirm` date NOT NULL,
  `ccl_confirm` tinyint(1) NOT NULL,
  `cla_id` int(11) NOT NULL COMMENT 'id assignement adresse client'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_cmdclient_ccl`
--

INSERT INTO `t_cmdclient_ccl` (`ccl_id`, `ccl_dateCmd`, `ccl_dateLiv`, `clc_id`, `dpy_id`, `ccl_dateConfirm`, `ccl_confirm`, `cla_id`) VALUES
(1, '2014-11-24', '2014-11-26', 1, 2, '2014-11-24', 0, 2),
(2, '2014-11-24', '2014-11-26', 3, 2, '2014-11-24', 0, 1),
(3, '2014-11-24', '2014-11-26', 3, 2, '2014-11-24', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_cmdfoudetail_cfd`
--

CREATE TABLE `t_cmdfoudetail_cfd` (
`cfd_id` int(11) NOT NULL,
  `cfo_id` int(11) NOT NULL COMMENT 'id commande fourni',
  `pro_id` int(11) NOT NULL COMMENT 'id produit',
  `cfd_quantite` int(11) NOT NULL,
  `cfd_prix` decimal(10,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_cmdfoudetail_cfd`
--

INSERT INTO `t_cmdfoudetail_cfd` (`cfd_id`, `cfo_id`, `pro_id`, `cfd_quantite`, `cfd_prix`) VALUES
(1, 1, 3, 100000, 100.00),
(2, 1, 2, 200000, 200.00),
(3, 2, 3, 120000, 134.00);

-- --------------------------------------------------------

--
-- Structure de la table `t_cmdfourni_cfo`
--

CREATE TABLE `t_cmdfourni_cfo` (
`cfo_id` int(11) NOT NULL,
  `cfo_dateCmd` date NOT NULL,
  `cfo_dateRecept` date NOT NULL,
  `fou_id` int(11) NOT NULL COMMENT 'id fournisseur',
  `ari_id` int(11) NOT NULL COMMENT 'id arrivage'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_cmdfourni_cfo`
--

INSERT INTO `t_cmdfourni_cfo` (`cfo_id`, `cfo_dateCmd`, `cfo_dateRecept`, `fou_id`, `ari_id`) VALUES
(1, '2014-11-24', '2014-11-26', 2, 1),
(2, '2014-11-24', '2014-11-25', 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `t_commercial_com`
--

CREATE TABLE `t_commercial_com` (
`com_id` int(11) NOT NULL,
  `com_nom` varchar(255) NOT NULL,
  `com_prenom` varchar(255) NOT NULL,
  `com_adresse` varchar(255) NOT NULL,
  `com_mail` varchar(255) NOT NULL,
  `com_tel` varchar(255) NOT NULL,
  `com_fax` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_commercial_com`
--

INSERT INTO `t_commercial_com` (`com_id`, `com_nom`, `com_prenom`, `com_adresse`, `com_mail`, `com_tel`, `com_fax`) VALUES
(1, 'Trichaud', 'Loïc', '25 rue perpignan', 'loic.trichaud@imerir.com', '0600', '0600'),
(2, 'Ortola', 'Adrien', '', 'adrien.ortola@imerir.com', '0600', '0600');

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

-- --------------------------------------------------------

--
-- Structure de la table `t_delaipaye_dpy`
--

CREATE TABLE `t_delaipaye_dpy` (
`dpy_id` int(11) NOT NULL,
  `dpy_jour` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_delaipaye_dpy`
--

INSERT INTO `t_delaipaye_dpy` (`dpy_id`, `dpy_jour`) VALUES
(1, 30),
(2, 45),
(3, 60);

-- --------------------------------------------------------

--
-- Structure de la table `t_fournisseur_fou`
--

CREATE TABLE `t_fournisseur_fou` (
`fou_id` int(11) NOT NULL,
  `fou_nom` varchar(255) NOT NULL,
  `fou_adresse` varchar(255) NOT NULL,
  `fou_mail` varchar(255) NOT NULL,
  `fou_tel` varchar(255) NOT NULL,
  `fou_fax` varchar(255) NOT NULL,
  `tyf_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_fournisseur_fou`
--

INSERT INTO `t_fournisseur_fou` (`fou_id`, `fou_nom`, `fou_adresse`, `fou_mail`, `fou_tel`, `fou_fax`, `tyf_id`) VALUES
(2, 'DIAM BOUCHAGE SAS', 'Espace Tech Ulrich 66400 CERET', 'loic.trichaud@imerir.com', '04 68 87 20 20', '04 68 87 20 20', 1),
(3, 'MAS', '2 rue de la montagne', 'mas@npgconseil.com', '055555', '060000', 2);

-- --------------------------------------------------------

--
-- Structure de la table `t_livraison_liv`
--

CREATE TABLE `t_livraison_liv` (
`liv_id` int(11) NOT NULL,
  `ccl_id` int(11) NOT NULL COMMENT 'id commande client ',
  `liv_dateLiv` date NOT NULL,
  `liv_responsable` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_livraison_liv`
--

INSERT INTO `t_livraison_liv` (`liv_id`, `ccl_id`, `liv_dateLiv`, `liv_responsable`) VALUES
(1, 1, '2014-11-24', 'NPG'),
(2, 2, '2014-11-24', 'NPG'),
(3, 3, '2014-11-24', 'NPG');

-- --------------------------------------------------------

--
-- Structure de la table `t_livrdetail_lid`
--

CREATE TABLE `t_livrdetail_lid` (
`lid_id` int(11) NOT NULL,
  `liv_id` int(11) NOT NULL COMMENT 'id livraison',
  `ard_id` int(11) NOT NULL COMMENT 'id arrivage detail',
  `lid_quantite` int(11) NOT NULL,
  `cfm_id` int(11) NOT NULL COMMENT 'id conformite',
  `lid_prix` decimal(10,2) NOT NULL,
  `lid_marquage` varchar(255) NOT NULL,
  `pro_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_livrdetail_lid`
--

INSERT INTO `t_livrdetail_lid` (`lid_id`, `liv_id`, `ard_id`, `lid_quantite`, `cfm_id`, `lid_prix`, `lid_marquage`, `pro_id`) VALUES
(1, 1, 1, 6000, 4, 169.00, 'MEB PR', 3),
(2, 1, 2, 11000, 5, 239.00, 'MEB Chateau', 2),
(3, 1, 3, 6000, 6, 169.00, 'MEB PR', 3),
(4, 2, 1, 10000, 7, 200.00, 'MEB', 3),
(5, 3, 3, 1000, 8, 200.00, 'MEB Pr', 3);

--
-- Déclencheurs `t_livrdetail_lid`
--
DELIMITER //
CREATE TRIGGER `AUTO_ADD_STOCK_LIV` AFTER INSERT ON `t_livrdetail_lid`
 FOR EACH ROW UPDATE t_stock_stk
SET t_stock_stk.stk_stock = t_stock_stk.stk_stock-NEW.lid_quantite
WHERE t_stock_stk.pro_id = NEW.pro_id
//
DELIMITER ;
DELIMITER //
CREATE TRIGGER `AUTO_PICK_STOCK_LIV` AFTER DELETE ON `t_livrdetail_lid`
 FOR EACH ROW UPDATE t_stock_stk
SET t_stock_stk.stk_stock = t_stock_stk.stk_stock+OLD.lid_quantite
WHERE t_stock_stk.pro_id = OLD.pro_id
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `t_mesure_mes`
--

CREATE TABLE `t_mesure_mes` (
`mes_id` int(11) NOT NULL,
  `mes_longueur` decimal(10,2) NOT NULL,
  `mes_diam` decimal(10,2) NOT NULL,
  `mes_diam2` decimal(10,2) NOT NULL,
  `mes_oval` decimal(10,2) NOT NULL,
  `mes_humidite` decimal(10,2) NOT NULL,
  `mes_compression` decimal(10,2) NOT NULL,
  `cfm_id` int(11) NOT NULL COMMENT 'id conformite'
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_mesure_mes`
--

INSERT INTO `t_mesure_mes` (`mes_id`, `mes_longueur`, `mes_diam`, `mes_diam2`, `mes_oval`, `mes_humidite`, `mes_compression`, `cfm_id`) VALUES
(1, 43.54, 23.52, 24.34, 0.82, 0.00, 0.00, 1),
(2, 44.70, 23.65, 24.50, 0.85, 0.00, 0.00, 1),
(3, 44.36, 24.17, 23.63, 0.54, 0.00, 0.00, 1),
(4, 44.68, 24.03, 24.48, 0.45, 0.00, 0.00, 1),
(5, 43.98, 24.10, 23.71, 0.39, 0.00, 0.00, 1),
(6, 44.44, 24.19, 23.68, 0.51, 0.00, 0.00, 1),
(7, 43.90, 23.54, 24.21, 0.67, 0.00, 0.00, 1),
(8, 44.26, 24.23, 24.40, 0.17, 0.00, 0.00, 1),
(9, 44.19, 24.23, 24.50, 0.27, 0.00, 0.00, 1),
(10, 43.62, 24.04, 24.07, 0.03, 0.00, 0.00, 1),
(11, 43.70, 23.88, 24.26, 0.38, 0.00, 0.00, 1),
(12, 43.62, 24.24, 23.59, 0.65, 0.00, 0.00, 1),
(13, 43.65, 23.74, 24.02, 0.28, 0.00, 0.00, 1),
(14, 43.96, 23.65, 23.90, 0.25, 0.00, 0.00, 1),
(15, 44.30, 23.98, 23.61, 0.37, 0.00, 0.00, 1),
(16, 44.20, 23.82, 23.90, 0.08, 0.00, 0.00, 1),
(17, 48.98, 23.96, 24.25, 0.29, 7.87, 92.11, 2),
(18, 48.83, 24.47, 24.39, 0.08, 7.51, 91.55, 2),
(19, 49.29, 24.33, 24.30, 0.03, 5.82, 92.27, 2),
(20, 48.72, 24.02, 23.67, 0.35, 5.58, 89.90, 2),
(21, 48.53, 23.54, 24.50, 0.96, 5.85, 90.00, 2),
(22, 48.61, 23.83, 23.92, 0.09, 5.60, 0.00, 2),
(23, 49.21, 24.26, 23.98, 0.28, 6.75, 0.00, 2),
(24, 49.11, 24.16, 23.71, 0.45, 7.00, 0.00, 2),
(25, 49.34, 23.79, 24.34, 0.55, 7.18, 0.00, 2),
(26, 48.84, 23.63, 24.16, 0.53, 4.32, 0.00, 2),
(27, 49.12, 23.86, 24.29, 0.43, 0.00, 0.00, 2),
(28, 48.71, 23.76, 23.78, 0.02, 0.00, 0.00, 2),
(29, 49.15, 23.72, 23.56, 0.16, 0.00, 0.00, 2),
(30, 48.51, 23.85, 24.41, 0.56, 0.00, 0.00, 2),
(31, 49.28, 24.35, 23.76, 0.59, 0.00, 0.00, 2),
(32, 48.70, 24.05, 24.27, 0.22, 0.00, 0.00, 2),
(33, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 3),
(34, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 3),
(35, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 3),
(36, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 3),
(37, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 3),
(38, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 3),
(39, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 3),
(40, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 3),
(41, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 3),
(42, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 3),
(43, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 3),
(44, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 3),
(45, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 3),
(46, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 3),
(47, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 3),
(48, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 3),
(49, 45.33, 23.93, 25.50, 1.57, 0.00, 0.00, 4),
(50, 45.75, 24.26, 25.11, 0.85, 0.00, 0.00, 4),
(51, 45.59, 23.54, 25.70, 2.16, 0.00, 0.00, 4),
(52, 44.32, 23.53, 23.75, 0.22, 0.00, 0.00, 4),
(53, 43.81, 23.87, 24.08, 0.21, 0.00, 0.00, 4),
(54, 44.09, 24.50, 23.87, 0.63, 0.00, 0.00, 4),
(55, 43.52, 23.81, 23.87, 0.06, 0.00, 0.00, 4),
(56, 43.63, 24.11, 24.33, 0.22, 0.00, 0.00, 4),
(57, 49.34, 23.78, 23.79, 0.01, 7.71, 93.39, 5),
(58, 49.17, 24.12, 24.40, 0.28, 4.05, 97.90, 5),
(59, 49.41, 24.24, 24.37, 0.13, 4.66, 98.89, 5),
(60, 50.78, 23.68, 29.04, 5.36, 6.58, 92.26, 5),
(61, 50.95, 23.89, 24.34, 0.45, 7.96, 99.32, 5),
(62, 48.60, 23.62, 23.84, 0.22, 0.00, 0.00, 5),
(63, 49.26, 23.69, 24.50, 0.81, 0.00, 0.00, 5),
(64, 49.46, 23.73, 24.10, 0.37, 0.00, 0.00, 5),
(65, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6),
(66, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6),
(67, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6),
(68, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6),
(69, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6),
(70, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6),
(71, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6),
(72, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6),
(73, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 7),
(74, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 7),
(75, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 7),
(76, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 7),
(77, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 7),
(78, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 7),
(79, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 7),
(80, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 7),
(81, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 8),
(82, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 8),
(83, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 8),
(84, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 8),
(85, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 8),
(86, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 8),
(87, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 8),
(88, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 8);

-- --------------------------------------------------------

--
-- Structure de la table `t_produit_pro`
--

CREATE TABLE `t_produit_pro` (
`pro_id` int(11) NOT NULL,
  `pro_nom` varchar(255) NOT NULL,
  `pro_taille` decimal(10,2) NOT NULL,
  `pro_qualite` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_produit_pro`
--

INSERT INTO `t_produit_pro` (`pro_id`, `pro_nom`, `pro_taille`, `pro_qualite`) VALUES
(1, 'Bouchon Liège H38 D24', 38.00, 'bonne'),
(2, 'Bouchon Liège H49 D24', 49.00, 'bonne'),
(3, 'Bouchon Liège H44 D24', 44.00, 'bonne'),
(4, 'Bouchon Liège H44 D24', 44.00, 'supérieure');

-- --------------------------------------------------------

--
-- Structure de la table `t_stock_stk`
--

CREATE TABLE `t_stock_stk` (
`stk_id` int(11) NOT NULL,
  `stk_stock` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_stock_stk`
--

INSERT INTO `t_stock_stk` (`stk_id`, `stk_stock`, `pro_id`) VALUES
(1, 0, 1),
(2, 169000, 2),
(3, 217000, 3),
(4, 0, 4);

-- --------------------------------------------------------

--
-- Structure de la table `t_typecli_tyc`
--

CREATE TABLE `t_typecli_tyc` (
`tyc_id` int(11) NOT NULL,
  `tyc_nom` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_typecli_tyc`
--

INSERT INTO `t_typecli_tyc` (`tyc_id`, `tyc_nom`) VALUES
(1, 'Entreprise'),
(2, 'Particulier');

-- --------------------------------------------------------

--
-- Structure de la table `t_typefou_tyf`
--

CREATE TABLE `t_typefou_tyf` (
`tyf_id` int(11) NOT NULL,
  `tyf_nom` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_typefou_tyf`
--

INSERT INTO `t_typefou_tyf` (`tyf_id`, `tyf_nom`) VALUES
(1, 'Entreprise Industriel'),
(2, 'Producteur');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `t_adresse_adr`
--
ALTER TABLE `t_adresse_adr`
 ADD PRIMARY KEY (`adr_id`);

--
-- Index pour la table `t_arrivagedetail_ard`
--
ALTER TABLE `t_arrivagedetail_ard`
 ADD PRIMARY KEY (`ard_id`);

--
-- Index pour la table `t_arrivage_ari`
--
ALTER TABLE `t_arrivage_ari`
 ADD PRIMARY KEY (`ari_id`);

--
-- Index pour la table `t_cliadr_cla`
--
ALTER TABLE `t_cliadr_cla`
 ADD PRIMARY KEY (`cla_id`);

--
-- Index pour la table `t_clicom_clc`
--
ALTER TABLE `t_clicom_clc`
 ADD PRIMARY KEY (`clc_id`);

--
-- Index pour la table `t_client_cli`
--
ALTER TABLE `t_client_cli`
 ADD PRIMARY KEY (`cli_id`);

--
-- Index pour la table `t_cmdclidetail_ccd`
--
ALTER TABLE `t_cmdclidetail_ccd`
 ADD PRIMARY KEY (`ccd_id`);

--
-- Index pour la table `t_cmdclient_ccl`
--
ALTER TABLE `t_cmdclient_ccl`
 ADD PRIMARY KEY (`ccl_id`);

--
-- Index pour la table `t_cmdfoudetail_cfd`
--
ALTER TABLE `t_cmdfoudetail_cfd`
 ADD PRIMARY KEY (`cfd_id`);

--
-- Index pour la table `t_cmdfourni_cfo`
--
ALTER TABLE `t_cmdfourni_cfo`
 ADD PRIMARY KEY (`cfo_id`);

--
-- Index pour la table `t_commercial_com`
--
ALTER TABLE `t_commercial_com`
 ADD PRIMARY KEY (`com_id`);

--
-- Index pour la table `t_conformite_cfm`
--
ALTER TABLE `t_conformite_cfm`
 ADD PRIMARY KEY (`cfm_id`);

--
-- Index pour la table `t_delaipaye_dpy`
--
ALTER TABLE `t_delaipaye_dpy`
 ADD PRIMARY KEY (`dpy_id`);

--
-- Index pour la table `t_fournisseur_fou`
--
ALTER TABLE `t_fournisseur_fou`
 ADD PRIMARY KEY (`fou_id`);

--
-- Index pour la table `t_livraison_liv`
--
ALTER TABLE `t_livraison_liv`
 ADD PRIMARY KEY (`liv_id`);

--
-- Index pour la table `t_livrdetail_lid`
--
ALTER TABLE `t_livrdetail_lid`
 ADD PRIMARY KEY (`lid_id`);

--
-- Index pour la table `t_mesure_mes`
--
ALTER TABLE `t_mesure_mes`
 ADD PRIMARY KEY (`mes_id`);

--
-- Index pour la table `t_produit_pro`
--
ALTER TABLE `t_produit_pro`
 ADD PRIMARY KEY (`pro_id`);

--
-- Index pour la table `t_stock_stk`
--
ALTER TABLE `t_stock_stk`
 ADD PRIMARY KEY (`stk_id`);

--
-- Index pour la table `t_typecli_tyc`
--
ALTER TABLE `t_typecli_tyc`
 ADD PRIMARY KEY (`tyc_id`);

--
-- Index pour la table `t_typefou_tyf`
--
ALTER TABLE `t_typefou_tyf`
 ADD PRIMARY KEY (`tyf_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `t_adresse_adr`
--
ALTER TABLE `t_adresse_adr`
MODIFY `adr_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `t_arrivagedetail_ard`
--
ALTER TABLE `t_arrivagedetail_ard`
MODIFY `ard_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `t_arrivage_ari`
--
ALTER TABLE `t_arrivage_ari`
MODIFY `ari_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `t_cliadr_cla`
--
ALTER TABLE `t_cliadr_cla`
MODIFY `cla_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `t_clicom_clc`
--
ALTER TABLE `t_clicom_clc`
MODIFY `clc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `t_client_cli`
--
ALTER TABLE `t_client_cli`
MODIFY `cli_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `t_cmdclidetail_ccd`
--
ALTER TABLE `t_cmdclidetail_ccd`
MODIFY `ccd_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `t_cmdclient_ccl`
--
ALTER TABLE `t_cmdclient_ccl`
MODIFY `ccl_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `t_cmdfoudetail_cfd`
--
ALTER TABLE `t_cmdfoudetail_cfd`
MODIFY `cfd_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `t_cmdfourni_cfo`
--
ALTER TABLE `t_cmdfourni_cfo`
MODIFY `cfo_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `t_commercial_com`
--
ALTER TABLE `t_commercial_com`
MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `t_conformite_cfm`
--
ALTER TABLE `t_conformite_cfm`
MODIFY `cfm_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `t_delaipaye_dpy`
--
ALTER TABLE `t_delaipaye_dpy`
MODIFY `dpy_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `t_fournisseur_fou`
--
ALTER TABLE `t_fournisseur_fou`
MODIFY `fou_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `t_livraison_liv`
--
ALTER TABLE `t_livraison_liv`
MODIFY `liv_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `t_livrdetail_lid`
--
ALTER TABLE `t_livrdetail_lid`
MODIFY `lid_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `t_mesure_mes`
--
ALTER TABLE `t_mesure_mes`
MODIFY `mes_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT pour la table `t_produit_pro`
--
ALTER TABLE `t_produit_pro`
MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `t_stock_stk`
--
ALTER TABLE `t_stock_stk`
MODIFY `stk_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `t_typecli_tyc`
--
ALTER TABLE `t_typecli_tyc`
MODIFY `tyc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `t_typefou_tyf`
--
ALTER TABLE `t_typefou_tyf`
MODIFY `tyf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;