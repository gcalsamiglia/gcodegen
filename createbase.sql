-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1:3306

-- Généré le: Dim 11 Mai 2014 à 21:41
-- Version du serveur: 5.5.33
-- Version de PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `codegen`
--

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

CREATE TABLE `document` (
  `doc_id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_name` varchar(64) NOT NULL,
  `sc_id` int(11) NOT NULL COMMENT 'main source code ',
  PRIMARY KEY (`doc_id`),
  UNIQUE KEY `doc_name` (`doc_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `document`
--

INSERT INTO `document` (`doc_id`, `doc_name`, `sc_id`) VALUES
(1, 'gregdoc1', 4);

-- --------------------------------------------------------

--
-- Structure de la table `keyword`
--

CREATE TABLE `keyword` (
  `kw_id` int(11) NOT NULL AUTO_INCREMENT,
  `kw_syntaxic_code` varchar(64) NOT NULL,
  `kw_translated_value` text NOT NULL,
  PRIMARY KEY (`kw_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `keyword`
--

INSERT INTO `keyword` (`kw_id`, `kw_syntaxic_code`, `kw_translated_value`) VALUES
(1, 'author', 'Grégori Calsamiglia'),
(2, 'company', 'GTB international');

-- --------------------------------------------------------

--
-- Structure de la table `keyword_list`
--

CREATE TABLE `keyword_list` (
  `kwl_id` int(11) NOT NULL AUTO_INCREMENT,
  `kwl_document_id` int(11) NOT NULL,
  `kwl_keyword_id` int(11) NOT NULL,
  PRIMARY KEY (`kwl_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `keyword_list`
--

INSERT INTO `keyword_list` (`kwl_id`, `kwl_document_id`, `kwl_keyword_id`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `source_code`
--

CREATE TABLE `source_code` (
  `sc_id` int(11) NOT NULL AUTO_INCREMENT,
  `sc_name` varchar(16) NOT NULL,
  `sc_version` varchar(16) NOT NULL,
  `sc_value` text NOT NULL,
  PRIMARY KEY (`sc_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `source_code`
--

INSERT INTO `source_code` (`sc_id`, `sc_name`, `sc_version`, `sc_value`) VALUES
(1, 'header', '1.0', '{\r\nmain header\r\nauthor  : @sc@author@sc@\r\ncompany : @sc@company@sc@\r\n}'),
(2, 'footer', '1.0', '{\r\nmain footer\r\n}'),
(3, 'dialogpgm', '1.0', 'for i = 1 to 10\r\nrien\r\nnext i'),
(4, 'gregsource', '1.0', '');

-- --------------------------------------------------------

--
-- Structure de la table `source_code_list`
--

CREATE TABLE `source_code_list` (
  `scl_id` int(11) NOT NULL AUTO_INCREMENT,
  `scl_sc_id` int(11) NOT NULL COMMENT 'id of source_code master',
  `scl_sc_id_ext` int(11) NOT NULL COMMENT 'id of source_code link',
  PRIMARY KEY (`scl_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `source_code_list`
--

INSERT INTO `source_code_list` (`scl_id`, `scl_sc_id`, `scl_sc_id_ext`) VALUES
(1, 4, 1),
(2, 4, 2),
(3, 4, 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
