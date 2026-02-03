-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 03 fév. 2026 à 16:37
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `faq_ligue`
--
CREATE DATABASE IF NOT EXISTS `faq_ligue` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `faq_ligue`;

--
-- Déchargement des données de la table `faq`
--

INSERT INTO `faq` (`id_faq`, `question`, `reponse`, `dat_question`, `dat_reponse`, `id_user`) VALUES
(1, 'Est ce que le ballon est rond ?', 'Bien sûr que oui', '2026-02-01 10:00:00', '2026-02-01 11:00:00', 2),
(2, 'Quel est l\'âge du Capitaine ?', 'Ce qu\'il faut', '2026-02-01 10:05:00', '2026-02-01 11:05:00', 2),
(3, 'Que signifie PSG ?', 'Pas Sûr de Gagner', '2026-02-01 10:10:00', '2026-02-01 11:10:00', 2);

--
-- Déchargement des données de la table `ligue`
--

INSERT INTO `ligue` (`id_ligue`, `lib_ligue`) VALUES
(1, 'Football'),
(2, 'Handball'),
(3, 'Basketball'),
(4, 'Volley'),
(5, 'Tennis');

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `pseudo`, `mdp`, `mail`, `id_usertype`, `id_ligue`) VALUES
(1, 'user1', 'passuser1', 'user1@example.com', 1, 1),
(2, 'admin1', 'passadmin1', 'admin1@example.com', 2, 1),
(3, 'super1', 'passsuper1', 'super1@example.com', 3, 2);

--
-- Déchargement des données de la table `usertype`
--

INSERT INTO `usertype` (`id_usertype`, `lib_usertype`, `description`) VALUES
(1, 'utilisateur', 'Utilisateur simple pouvant poser des questions'),
(2, 'administrateur', 'Administrateur pouvant répondre, modifier et supprimer des questions'),
(3, 'super-administrateur', 'Super administrateur avec tous les droits');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
