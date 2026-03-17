-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Sam 24 Novembre 2018 à 21:33
-- Version du serveur :  10.1.21-MariaDB
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `m2l`
--
USE `m2l`;

--
-- Contenu de la table `faq`
--

INSERT INTO `faq` (`id_faq`, `question`, `reponse`, `dat_question`, `dat_reponse`, `id_user`) VALUES
(1, 'Est ce que le ballon est rond ?', 'Bien sûr que oui', NULL, '2015-01-03 14:57:14', 1),
(2, 'Quel est l\'âge du Capitaine', 'Ce qu\'il faut', '2015-01-03 15:26:29', '2015-01-03 15:26:47', 1),
(3, 'Est ce qu\'on va gagner ?', 'Peut-être', '2015-01-03 15:27:04', '2015-01-03 16:19:33', 1),
(6, 'Est ça c\'est du cochon ?', NULL, '2015-01-03 15:46:10', NULL, 1),
(7, 'Quel est le tél. de Nabila ?', NULL, '2015-01-03 15:46:22', NULL, 1),
(8, 'Que signifie les initiales P.S.G ?', 'Pas Sûr de Gagner', '2015-01-03 15:48:31', '2015-01-03 15:48:57', 1),
(10, '<b>gras</b>', 'C\'est malin', '2015-01-03 15:34:35', '2015-01-03 15:34:59', 1),
(11, 'Est ce que vous prenez des chiens ?', '', '2017-11-26 15:16:22', '2018-11-24 21:31:15', 1),
(12, 'Est ce que vous avez vu mes chaussettes ?', NULL, '2017-11-26 15:17:10', NULL, 1),
(13, 'Où sont mes baskets ?', NULL, '2017-11-26 15:19:39', NULL, 1),
(14, 'Est ce que le ballon est rouge ?', NULL, '2018-11-24 21:23:04', NULL, 2),
(15, 'Combien de joueurs ?', NULL, '2018-11-24 21:23:23', NULL, 2),
(16, 'Est ce qu\'il faut des chaussures ?', NULL, '2018-11-24 21:23:40', NULL, 2),
(17, 'Est ce que le filet est haut ?', 'Ca dépend de ta taille !', '2018-11-24 21:24:32', '2018-11-24 21:29:59', 3),
(18, 'Est ce que ça fait mal ?', NULL, '2018-11-24 21:24:43', NULL, 3),
(19, 'Pourquoi c\'est si pénible à voir ?', NULL, '2018-11-24 21:25:14', NULL, 3),
(20, 'Pourquoi ça fait mal aux genoux ?', NULL, '2018-11-24 21:25:47', NULL, 3),
(21, 'Pourquoi c\'est si violent ?', 'Tu peux faire tricot si cela ne te convient pas.', '2018-11-24 21:26:41', '2018-11-24 21:30:36', 4),
(22, 'Est ce que ça passe à la télé ?', NULL, '2018-11-24 21:26:52', NULL, 4);

--
-- Contenu de la table `ligue`
--

INSERT INTO `ligue` (`id_ligue`, `lib_ligue`) VALUES
(1, 'Ligue de football'),
(2, 'Ligue de basket'),
(3, 'Ligue de volley'),
(4, 'Ligue de handball'),
(5, 'Toutes les ligues');

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id_user`, `pseudo`, `mdp`, `mail`, `id_usertype`, `id_ligue`) VALUES
(1, 'jef', '$2y$10$Xaes8DuWAdbRxfQqW.bekekmRJZmSGuQVPnQj6hUvu8sXuO0HuyKK', 'jef@m2l.com', 1, 1),
(2, 'basketman', '$2y$10$ApKnCR6JuED1sYlQbITvbeIGyBqxSFXJB9B.g7zgZReXWK86cjspq', 'basketman@m2l.com', 1, 2),
(3, 'volleyman', '$2y$10$OVRmtndF7.4.2DWPq5f0z.3ppTGzkRWdzO1DM96W0/n05U7QM6zLW', 'volleyman@m2l.com', 1, 3),
(4, 'handballman', '$2y$10$uLWSGN4ANWY6KDUF3vC8O.wHh7eZOfGV1k8JrST/xZR92eSJwR07y', 'handballman@m2l.com', 1, 4),
(5, 'superman', '$2y$10$nRgdifAI1O39k28AtAv7WeMCrsHRGVPm7oWl7uHaBIChUjHxpUtke', 'superman@m2l.com', 3, 5);

--
-- Contenu de la table `usertype`
--

INSERT INTO `usertype` (`id_usertype`, `lib_usertype`, `description`) VALUES
(1, 'utilisateur', 'Utilisateur de base'),
(2, 'admin', 'Administrateur de ligue'),
(3, 'superadmin', 'Administrateur de toutes les ligues');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
