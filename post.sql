-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 30 avr. 2024 à 20:06
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `articles`
--

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `author`, `date`) VALUES
(1, 'NOTES DE PATCH 8.05 DE VALORANT', 'Maintenant que le Masters Madrid est terminé, il était temps pour Riot Games d’apporter du nouveau contenu dans Valorant avec le patch 8.05. Et par nouveauté on entend par là, un nouvel Agent ! Clove, c’est son patronyme, est un Contrôleur pensé pour la r', 'Valorant', '2024-04-20'),
(2, 'VCT 2024 – CLASSEMENT SELON LES POINTS DE CHAMPIONNAT', 'Avec le nouveau format, la qualification au Valorant Champions Tour se fait au travers du second segment de Ligue, mais aussi via le classement selon les points de Championnat. Dans chaque Ligue, le classement varie en fonction des performances dans les é', 'Alexis Laborie', '2024-04-20'),
(3, 'VCT 2024 – CLASSEMENT SELON LES POINTS DE CHAMPIONNAT', 'Avec le nouveau format, la qualification au Valorant Champions Tour se fait au travers du second segment de Ligue, mais aussi via le classement selon les points de Championnat. Dans chaque Ligue, le classement varie en fonction des performances dans les é', 'Alexis Laborie', '2024-04-20');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
