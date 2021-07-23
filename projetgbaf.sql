-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 18 juil. 2021 à 20:59
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetgbaf`
--

-- --------------------------------------------------------

--
-- Structure de la table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(128) NOT NULL,
  `prenom` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `question` varchar(255) NOT NULL,
  `reponse` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `account`
--

INSERT INTO `account` (`id_user`, `nom`, `prenom`, `username`, `password`, `question`, `reponse`) VALUES
(1, 'RAJ', 'Anna', 'rajanna', '$2y$10$t/PctCJu/Xdx3bqCKlpNbOxUoxq7yUm5VqXJ8x1.zbf0wJX9E4EOO', '2+2', '4'),
(2, 'RAJ', 'Dina', 'rajdina', 'anna', 'Quel est votre animal préféré?', 'cheval'),
(3, 'JEAN', 'Jean', 'jean', '$2y$10$8KcVchn5si0Ywuxv3K5aPekx0CPLfnb6oLk2.zK978jr6pCr.NnJa', 'Quel est votre type de vêtement préféré?', 'jean'),
(4, 'Pierre', 'Jean', 'pierrejean', '$2y$10$JU7R6YWag0fgxD4BM8AyBO/z5dw5nSYNaC1QKGmsur3mZpHPtIGPi', 'quelle est la couleur de vos yeux?', 'bleu'),
(5, 'Paul', 'Paul', 'Paul', '$2y$10$tbzGEsqVGadjUBT4EmOz2uQcxXKaEGkJpvYlBm4A2cU/iS.TLUDPG', 'Votre age?', '37'),
(6, 'Salomon', 'Salomon', 'Salomon', '$2y$10$Y3o/iAn6j/efOIgDDxMHUOWGAxjkHbCFlwx85gKbeL1jXEJqA94NW', 'Age', '700'),
(7, 'France', 'France', 'Italie', '$2y$10$xOYY7JuWyGQtiBmych4idubzYAIPSU4CEAs2n1QYZvkJ3nersxIkS', '2+2', '4'),
(8, 'Arilova', 'Arilova', 'Arilova', '$2y$10$TDxS4dmR8fGdxL88lMu/.uqJXTHx4QF4CN2ZVHDLBQ7C0drxhIYBS', 'Nationalité', 'Madagascar'),
(9, 'Jean ', 'Marie', 'jeanmarie', '$2y$10$q2lrZTzDRAyGCHBfmz411OXE0yt/E1IXjgBH.Uqd.k76BbZcadOXG', 'Maitresse en maternelle?', 'Françoise');

-- --------------------------------------------------------

--
-- Structure de la table `acteur`
--

DROP TABLE IF EXISTS `acteur`;
CREATE TABLE IF NOT EXISTS `acteur` (
  `id_acteur` int NOT NULL AUTO_INCREMENT,
  `acteur` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `logo` varchar(255) NOT NULL,
  PRIMARY KEY (`id_acteur`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `acteur`
--

INSERT INTO `acteur` (`id_acteur`, `acteur`, `description`, `logo`) VALUES
(1, 'Formation&co', 'Formation&co est une association française présente sur tout le territoire.\r\nNous proposons à des personnes issues de tout milieu de devenir entrepreneur grâce à un crédit et un accompagnement professionnel et personnalisé.\r\nNotre proposition : \r\n- un financement jusqu’à 30 000€ ;\r\n- un suivi personnalisé et gratuit ;\r\n- une lutte acharnée contre les freins sociétaux et les stéréotypes.\r\n\r\nLe financement est possible, peu importe le métier : coiffeur, banquier, éleveur de chèvres… . Nous collaborons avec des personnes talentueuses et motivées.\r\nVous n’avez pas de diplômes ? Ce n’est pas un problème pour nous ! Nos financements s’adressent à tous.', 'image/formation_co'),
(2, 'Protectpeople', 'Protectpeople finance la solidarité nationale.\r\nNous appliquons le principe édifié par la Sécurité sociale française en 1945 : permettre à chacun de bénéficier d’une protection sociale.\r\n\r\nChez Protectpeople, chacun cotise selon ses moyens et reçoit selon ses besoins.\r\nProectecpeople est ouvert à tous, sans considération d’âge ou d’état de santé.\r\nNous garantissons un accès aux soins et une retraite.\r\nChaque année, nous collectons et répartissons 300 milliards d’euros.\r\nNotre mission est double :\r\nsociale : nous garantissons la fiabilité des données sociales ;\r\néconomique : nous apportons une contribution aux activités économiques.\r\n', 'image/protectpeople'),
(3, 'Dsa France', 'Dsa France accélère la croissance du territoire et s’engage avec les collectivités territoriales.\r\nNous accompagnons les entreprises dans les étapes clés de leur évolution.\r\nNotre philosophie : s’adapter à chaque entreprise.\r\nNous les accompagnons pour voir plus grand et plus loin et proposons des solutions de financement adaptées à chaque étape de la vie des entreprises.\r\n', 'image/DSA_france'),
(4, 'CDE', 'La CDE (Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation. \r\nSon président est élu pour 3 ans par ses pairs, chefs d’entreprises et présidents des CDE.\r\n', 'image/CDE');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_acteur` int NOT NULL,
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post` text NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `fk_account` (`id_user`),
  KEY `fk_acteur` (`id_acteur`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id_post`, `id_user`, `id_acteur`, `date_add`, `post`) VALUES
(1, 1, 1, '2021-06-28 15:04:01', 'Taux règlementé.'),
(3, 1, 2, '2021-06-29 11:15:14', 'Bon relation client.'),
(4, 1, 4, '2021-06-30 20:04:22', 'Très bien'),
(5, 1, 3, '2021-06-30 20:51:07', 'Bon retour client.'),
(6, 3, 4, '2021-06-30 21:14:11', 'Manque de réactivité.'),
(7, 3, 3, '2021-06-30 21:28:10', 'Manque de réactivité'),
(8, 4, 2, '2021-07-07 00:21:24', 'Bien'),
(9, 5, 1, '2021-07-07 20:26:06', 'Bien'),
(10, 6, 4, '2021-07-08 22:41:30', 'Très connu sur le marché'),
(11, 6, 2, '2021-07-08 22:54:48', 'Pas mal'),
(12, 6, 3, '2021-07-08 22:59:22', 'Bien'),
(13, 7, 1, '2021-07-15 20:19:38', 'france'),
(14, 9, 2, '2021-07-17 09:16:31', 'A une notoriété');

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

DROP TABLE IF EXISTS `vote`;
CREATE TABLE IF NOT EXISTS `vote` (
  `id_user` int NOT NULL,
  `id_acteur` int NOT NULL,
  `vote` int NOT NULL,
  KEY `fk_user` (`id_user`),
  KEY `fk_acteur` (`id_acteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `vote`
--

INSERT INTO `vote` (`id_user`, `id_acteur`, `vote`) VALUES
(1, 1, 0),
(2, 1, 0),
(1, 2, 1),
(3, 4, 0),
(3, 3, 0),
(1, 4, 1),
(4, 2, 0),
(5, 1, 0),
(6, 4, 1),
(6, 2, 0),
(6, 3, 1),
(7, 1, 0),
(1, 3, 1),
(9, 2, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `account` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`id_acteur`) REFERENCES `acteur` (`id_acteur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `account` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`id_acteur`) REFERENCES `acteur` (`id_acteur`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
