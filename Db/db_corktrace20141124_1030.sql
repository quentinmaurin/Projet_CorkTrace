-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 24 Novembre 2014 à 10:29
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `db_corktrace`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_adresse_adr`
--

CREATE TABLE IF NOT EXISTS `t_adresse_adr` (
  `adr_id` int(11) NOT NULL AUTO_INCREMENT,
  `adr_adresse` varchar(255) NOT NULL,
  PRIMARY KEY (`adr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `t_adresse_adr`
--

INSERT INTO `t_adresse_adr` (`adr_id`, `adr_adresse`) VALUES
(1, '23 avenue Julien Panchot 66000 PERPIGNAN'),
(2, '19 avenue de Grande Bretagne 66006 Perpignan'),
(3, '26 rue des amandiers 66680 canohes'),
(4, '2 rue Moulin d''Orles 66000 Perpignan');

-- --------------------------------------------------------

--
-- Structure de la table `t_arrivagedetail_ard`
--

CREATE TABLE IF NOT EXISTS `t_arrivagedetail_ard` (
  `ard_id` int(11) NOT NULL AUTO_INCREMENT,
  `ari_id` int(11) NOT NULL COMMENT 'id arrivage',
  `pro_id` int(11) NOT NULL COMMENT 'id produit',
  `cfm_id` int(11) NOT NULL COMMENT 'id conformite',
  `ard_quantite` int(11) NOT NULL,
  PRIMARY KEY (`ard_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Déclencheurs `t_arrivagedetail_ard`
--
DROP TRIGGER IF EXISTS `AUTO_ADD_STOCK`;
DELIMITER //
CREATE TRIGGER `AUTO_ADD_STOCK` AFTER INSERT ON `t_arrivagedetail_ard`
 FOR EACH ROW UPDATE t_stock_stk
SET t_stock_stk.stk_stock = t_stock_stk.stk_stock+NEW.ard_quantite
WHERE t_stock_stk.pro_id = NEW.pro_id
//
DELIMITER ;
DROP TRIGGER IF EXISTS `AUTO_PICK_STOCK`;
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

CREATE TABLE IF NOT EXISTS `t_arrivage_ari` (
  `ari_id` int(11) NOT NULL AUTO_INCREMENT,
  `ari_num_arrivage` int(11) NOT NULL,
  `ari_date_recept` date NOT NULL,
  `ari_responsable` varchar(255) NOT NULL,
  PRIMARY KEY (`ari_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_cliadr_cla`
--

CREATE TABLE IF NOT EXISTS `t_cliadr_cla` (
  `cla_id` int(11) NOT NULL AUTO_INCREMENT,
  `cli_id` int(11) NOT NULL,
  `adr_id` int(11) NOT NULL,
  PRIMARY KEY (`cla_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_clicom_clc`
--

CREATE TABLE IF NOT EXISTS `t_clicom_clc` (
  `clc_id` int(11) NOT NULL AUTO_INCREMENT,
  `cli_id` int(11) NOT NULL COMMENT 'id client',
  `com_id` int(11) NOT NULL COMMENT 'id commercial',
  PRIMARY KEY (`clc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_client_cli`
--

CREATE TABLE IF NOT EXISTS `t_client_cli` (
  `cli_id` int(11) NOT NULL AUTO_INCREMENT,
  `cli_nom` varchar(255) NOT NULL,
  `cli_mail` varchar(255) NOT NULL,
  `cli_tel` varchar(255) NOT NULL,
  `cli_fax` varchar(255) NOT NULL,
  `cli_adr_fact` varchar(255) NOT NULL,
  `tyc_id` int(11) NOT NULL COMMENT 'id type client',
  PRIMARY KEY (`cli_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `t_client_cli`
--

INSERT INTO `t_client_cli` (`cli_id`, `cli_nom`, `cli_mail`, `cli_tel`, `cli_fax`, `cli_adr_fact`, `tyc_id`) VALUES
(1, 'Les Vignerons Catalans', 'loic.trichaud@imerir.com', '0607080910', '0407080910', '35 avenue Julien Panchot 66000 PERPIGNAN', 1),
(2, 'Les Vins du Roussillon', 'quentin.maurin@imerir.com', '0661091765', '0461091765', '19 avenue de Grande Bretagne 66006 Perpignan', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_cmdclidetail_ccd`
--

CREATE TABLE IF NOT EXISTS `t_cmdclidetail_ccd` (
  `ccd_id` int(11) NOT NULL AUTO_INCREMENT,
  `ccl_id` int(11) NOT NULL COMMENT 'id commande client',
  `pro_id` int(11) NOT NULL COMMENT 'id produit',
  `ccd_prix` decimal(10,2) NOT NULL,
  `ccd_quantite` int(11) NOT NULL,
  `ccd_marquage` varchar(255) NOT NULL,
  PRIMARY KEY (`ccd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_cmdclient_ccl`
--

CREATE TABLE IF NOT EXISTS `t_cmdclient_ccl` (
  `ccl_id` int(11) NOT NULL AUTO_INCREMENT,
  `ccl_dateCmd` date NOT NULL,
  `ccl_dateLiv` date NOT NULL,
  `clc_id` int(11) NOT NULL COMMENT 'commercial table t_clicom',
  `dpy_id` int(11) NOT NULL COMMENT 'id table t_delaipaye',
  `ccl_dateConfirm` date NOT NULL,
  `ccl_confirm` tinyint(1) NOT NULL,
  `cla_id` int(11) NOT NULL COMMENT 'id assignement adresse client',
  PRIMARY KEY (`ccl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_cmdfoudetail_cfd`
--

CREATE TABLE IF NOT EXISTS `t_cmdfoudetail_cfd` (
  `cfd_id` int(11) NOT NULL AUTO_INCREMENT,
  `cfo_id` int(11) NOT NULL COMMENT 'id commande fourni',
  `pro_id` int(11) NOT NULL COMMENT 'id produit',
  `cfd_quantite` int(11) NOT NULL,
  `cfd_prix` decimal(10,2) NOT NULL,
  PRIMARY KEY (`cfd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_cmdfourni_cfo`
--

CREATE TABLE IF NOT EXISTS `t_cmdfourni_cfo` (
  `cfo_id` int(11) NOT NULL AUTO_INCREMENT,
  `cfo_dateCmd` date NOT NULL,
  `cfo_dateRecept` date NOT NULL,
  `fou_id` int(11) NOT NULL COMMENT 'id fournisseur',
  `ari_id` int(11) NOT NULL COMMENT 'id arrivage',
  PRIMARY KEY (`cfo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_commercial_com`
--

CREATE TABLE IF NOT EXISTS `t_commercial_com` (
  `com_id` int(11) NOT NULL AUTO_INCREMENT,
  `com_nom` varchar(255) NOT NULL,
  `com_prenom` varchar(255) NOT NULL,
  `com_adresse` varchar(255) NOT NULL,
  `com_mail` varchar(255) NOT NULL,
  `com_tel` varchar(255) NOT NULL,
  `com_fax` varchar(255) NOT NULL,
  PRIMARY KEY (`com_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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

CREATE TABLE IF NOT EXISTS `t_conformite_cfm` (
  `cfm_id` int(11) NOT NULL AUTO_INCREMENT,
  `cfm_tca_fourni` decimal(10,2) NOT NULL,
  `cfm_tca_inter` decimal(10,2) NOT NULL,
  `cfm_gout` varchar(255) NOT NULL,
  `cfm_decision` enum('En attente','Conforme','Non Conforme','Exception') NOT NULL,
  `cfm_capilarite` int(1) NOT NULL,
  `cfm_humidite` decimal(10,2) NOT NULL,
  `cfm_diamcompr` decimal(10,2) NOT NULL,
  PRIMARY KEY (`cfm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_delaipaye_dpy`
--

CREATE TABLE IF NOT EXISTS `t_delaipaye_dpy` (
  `dpy_id` int(11) NOT NULL AUTO_INCREMENT,
  `dpy_jour` int(11) NOT NULL,
  PRIMARY KEY (`dpy_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

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

CREATE TABLE IF NOT EXISTS `t_fournisseur_fou` (
  `fou_id` int(11) NOT NULL AUTO_INCREMENT,
  `fou_nom` varchar(255) NOT NULL,
  `fou_adresse` varchar(255) NOT NULL,
  `fou_mail` varchar(255) NOT NULL,
  `fou_tel` varchar(255) NOT NULL,
  `fou_fax` varchar(255) NOT NULL,
  `tyf_id` int(11) NOT NULL,
  PRIMARY KEY (`fou_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `t_fournisseur_fou`
--

INSERT INTO `t_fournisseur_fou` (`fou_id`, `fou_nom`, `fou_adresse`, `fou_mail`, `fou_tel`, `fou_fax`, `tyf_id`) VALUES
(1, 'TRAVET LIEGE', '20, rue Alfred Sauvy 66602 RIVESALTES', 'loic.trichaud@imerir.com', '04 68 54 62 04', '04 68 54 62 04', 1),
(2, 'DIAM BOUCHAGE SAS', 'Espace Tech Ulrich 66400 CERET', 'loic.trichaud@imerir.com', '04 68 87 20 20', '04 68 87 20 20', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_livraison_liv`
--

CREATE TABLE IF NOT EXISTS `t_livraison_liv` (
  `liv_id` int(11) NOT NULL AUTO_INCREMENT,
  `ccl_id` int(11) NOT NULL COMMENT 'id commande client ',
  `liv_dateLiv` date NOT NULL,
  `liv_responsable` text NOT NULL,
  PRIMARY KEY (`liv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_livrdetail_lid`
--

CREATE TABLE IF NOT EXISTS `t_livrdetail_lid` (
  `lid_id` int(11) NOT NULL AUTO_INCREMENT,
  `liv_id` int(11) NOT NULL COMMENT 'id livraison',
  `ard_id` int(11) NOT NULL COMMENT 'id arrivage detail',
  `lid_quantite` int(11) NOT NULL,
  `cfm_id` int(11) NOT NULL COMMENT 'id conformite',
  `lid_prix` decimal(10,2) NOT NULL,
  `lid_marquage` varchar(255) NOT NULL,
  PRIMARY KEY (`lid_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Déclencheurs `t_livrdetail_lid`
--
DROP TRIGGER IF EXISTS `AUTO_ADD_STOCK_LIV`;
DELIMITER //
CREATE TRIGGER `AUTO_ADD_STOCK_LIV` AFTER INSERT ON `t_livrdetail_lid`
 FOR EACH ROW UPDATE t_stock_stk
INNER JOIN t_arrivagedetail_ard ON t_arrivagedetail_ard.pro_id =
t_stock_stk.pro_id
INNER JOIN t_livrdetail_lid ON t_livrdetail_lid.ard_id = t_arrivagedetail_ard.ard_id 
SET t_stock_stk.stk_stock = t_stock_stk.stk_stock-NEW.lid_quantite
WHERE t_stock_stk.pro_id = t_arrivagedetail_ard.pro_id
//
DELIMITER ;
DROP TRIGGER IF EXISTS `AUTO_PICK_STOCK_LIV`;
DELIMITER //
CREATE TRIGGER `AUTO_PICK_STOCK_LIV` AFTER DELETE ON `t_livrdetail_lid`
 FOR EACH ROW UPDATE t_stock_stk
INNER JOIN t_arrivagedetail_ard ON t_arrivagedetail_ard.pro_id =
t_stock_stk.pro_id
INNER JOIN t_livrdetail_lid ON t_livrdetail_lid.ard_id = t_arrivagedetail_ard.ard_id 
SET t_stock_stk.stk_stock = t_stock_stk.stk_stock+OLD.lid_quantite
WHERE t_stock_stk.pro_id = t_arrivagedetail_ard.pro_id
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `t_mesure_mes`
--

CREATE TABLE IF NOT EXISTS `t_mesure_mes` (
  `mes_id` int(11) NOT NULL AUTO_INCREMENT,
  `mes_longueur` decimal(10,2) NOT NULL,
  `mes_diam` decimal(10,2) NOT NULL,
  `mes_oval` decimal(10,2) NOT NULL,
  `cfm_id` int(11) NOT NULL COMMENT 'id conformite',
  PRIMARY KEY (`mes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_produit_pro`
--

CREATE TABLE IF NOT EXISTS `t_produit_pro` (
  `pro_id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_nom` varchar(255) NOT NULL,
  `pro_taille` decimal(10,2) NOT NULL,
  `pro_qualite` varchar(255) NOT NULL,
  PRIMARY KEY (`pro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `t_produit_pro`
--

INSERT INTO `t_produit_pro` (`pro_id`, `pro_nom`, `pro_taille`, `pro_qualite`) VALUES
(1, 'Bouchon Liège H38 D24', '38.00', 'bonne'),
(2, 'Bouchon Liège H49 D24', '49.00', 'bonne'),
(3, 'Bouchon Liège H44 D24', '44.00', 'bonne'),
(4, 'Bouchon Liège H44 D24', '44.00', 'supérieure');

-- --------------------------------------------------------

--
-- Structure de la table `t_stock_stk`
--

CREATE TABLE IF NOT EXISTS `t_stock_stk` (
  `stk_id` int(11) NOT NULL AUTO_INCREMENT,
  `stk_stock` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  PRIMARY KEY (`stk_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `t_stock_stk`
--

INSERT INTO `t_stock_stk` (`stk_id`, `stk_stock`, `pro_id`) VALUES
(1, 0, 1),
(2, 0, 2),
(3, 0, 3),
(4, 0, 4);

-- --------------------------------------------------------

--
-- Structure de la table `t_typecli_tyc`
--

CREATE TABLE IF NOT EXISTS `t_typecli_tyc` (
  `tyc_id` int(11) NOT NULL AUTO_INCREMENT,
  `tyc_nom` varchar(255) NOT NULL,
  PRIMARY KEY (`tyc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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

CREATE TABLE IF NOT EXISTS `t_typefou_tyf` (
  `tyf_id` int(11) NOT NULL AUTO_INCREMENT,
  `tyf_nom` varchar(255) NOT NULL,
  PRIMARY KEY (`tyf_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `t_typefou_tyf`
--

INSERT INTO `t_typefou_tyf` (`tyf_id`, `tyf_nom`) VALUES
(1, 'Entreprise Industriel'),
(2, 'Producteur');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
