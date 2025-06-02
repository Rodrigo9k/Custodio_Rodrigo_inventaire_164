-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 21 mai 2025 à 10:18
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `rodrigo_inventaire`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_categorie`
--

CREATE TABLE `t_categorie` (
  `id_id_categorie` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_categorie`
--

INSERT INTO `t_categorie` (`id_id_categorie`, `nom`) VALUES
(1, 'Câble'),
(2, 'Périphérique'),
(3, 'Écran');

-- --------------------------------------------------------

--
-- Structure de la table `t_mouvement`
--

CREATE TABLE `t_mouvement` (
  `id_id_mouvement` int(11) NOT NULL,
  `id_id_objet` int(11) NOT NULL,
  `id_id_utilisateur` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `type` enum('sortie','entrée') NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_mouvement`
--

INSERT INTO `t_mouvement` (`id_id_mouvement`, `id_id_objet`, `id_id_utilisateur`, `date`, `type`, `quantite`) VALUES
(1, 1, 1, '2025-05-20 18:20:34', 'sortie', 3),
(2, 5, 2, '2025-05-20 18:20:34', 'sortie', 1),
(3, 2, 1, '2025-05-20 18:20:34', 'entrée', 2);

-- --------------------------------------------------------

--
-- Structure de la table `t_objet`
--

CREATE TABLE `t_objet` (
  `id_id_objet` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `id_id_categorie` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `quantite` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_objet`
--

INSERT INTO `t_objet` (`id_id_objet`, `nom`, `id_id_categorie`, `description`, `quantite`) VALUES
(1, 'Câble RJ45', 1, 'Câble réseau Ethernet', 20),
(2, 'Câble HDMI', 1, 'Câble vidéo HDMI', 10),
(3, 'Câble VGA', 1, 'Câble vidéo VGA', 8),
(4, 'Câble alimentation', 1, 'Câble secteur', 15),
(5, 'Souris', 2, 'Souris USB', 12),
(6, 'Clavier', 2, 'Clavier filaire', 9),
(7, 'Écran', 3, 'Écran 24 pouces', 5);

-- --------------------------------------------------------

--
-- Structure de la table `t_utilisateur`
--

CREATE TABLE `t_utilisateur` (
  `id_id_utilisateur` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_utilisateur`
--

INSERT INTO `t_utilisateur` (`id_id_utilisateur`, `nom`) VALUES
(1, 'Alice'),
(2, 'Bob'),
(3, 'Charlie');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_categorie`
--
ALTER TABLE `t_categorie`
  ADD PRIMARY KEY (`id_id_categorie`);

--
-- Index pour la table `t_mouvement`
--
ALTER TABLE `t_mouvement`
  ADD PRIMARY KEY (`id_id_mouvement`),
  ADD KEY `id_id_objet` (`id_id_objet`),
  ADD KEY `id_id_utilisateur` (`id_id_utilisateur`);

--
-- Index pour la table `t_objet`
--
ALTER TABLE `t_objet`
  ADD PRIMARY KEY (`id_id_objet`),
  ADD KEY `id_id_categorie` (`id_id_categorie`);

--
-- Index pour la table `t_utilisateur`
--
ALTER TABLE `t_utilisateur`
  ADD PRIMARY KEY (`id_id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_categorie`
--
ALTER TABLE `t_categorie`
  MODIFY `id_id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `t_mouvement`
--
ALTER TABLE `t_mouvement`
  MODIFY `id_id_mouvement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `t_objet`
--
ALTER TABLE `t_objet`
  MODIFY `id_id_objet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `t_utilisateur`
--
ALTER TABLE `t_utilisateur`
  MODIFY `id_id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `t_mouvement`
--
ALTER TABLE `t_mouvement`
  ADD CONSTRAINT `t_mouvement_ibfk_1` FOREIGN KEY (`id_id_objet`) REFERENCES `t_objet` (`id_id_objet`),
  ADD CONSTRAINT `t_mouvement_ibfk_2` FOREIGN KEY (`id_id_utilisateur`) REFERENCES `t_utilisateur` (`id_id_utilisateur`);

--
-- Contraintes pour la table `t_objet`
--
ALTER TABLE `t_objet`
  ADD CONSTRAINT `t_objet_ibfk_1` FOREIGN KEY (`id_id_categorie`) REFERENCES `t_categorie` (`id_id_categorie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
