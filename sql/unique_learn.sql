-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 29 déc. 2025 à 16:05
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
-- Base de données : `unique_learn`
--

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

CREATE TABLE `formations` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `categorie` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `duree` varchar(50) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT 'logo.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `formations`
--

INSERT INTO `formations` (`id`, `titre`, `categorie`, `description`, `duree`, `prix`, `image_url`) VALUES
(11, 'Gestion de Projet Agile-SCRUM', 'Management', 'Cette formation offre une compréhension complète des méthodes Agile et du cadre SCRUM, permettant de planifier, piloter et livrer des projets efficacement, tout en favorisant la collaborat', '2 mois', 2000.00, '1766701943_5126.png'),
(12, 'Masterclass Design UI/UX', 'Design', 'Cette masterclass est dédiée à la conception d’interfaces digitales centrées sur l’utilisateur. Elle permet de maîtriser les principes du design UI/UX, de l’ergonomie à l’expérience utilisateur, afin de créer des produits digitaux intuitifs et efficaces.', '6 mois', 3999.99, '1766702464_4662.png'),
(13, 'Formation Développement Web', 'Informatique', 'Cette formation permet d’acquérir les compétences essentielles en developpement web afin de concevoir, développer et maintenir des sites et applications web modernes, performants et sécurisés, en utilisant les technologies actuelles du marché.', '1 ans', 20000.00, '1766702543_2350.png');

-- --------------------------------------------------------

--
-- Structure de la table `inscriptions`
--

CREATE TABLE `inscriptions` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `id_formation` int(11) NOT NULL,
  `commentaire` text DEFAULT NULL,
  `date_inscription` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `inscriptions`
--

INSERT INTO `inscriptions` (`id`, `nom`, `prenom`, `email`, `tel`, `id_formation`, `commentaire`, `date_inscription`) VALUES
(29, 'Hasker', 'Asmae', 'hasker.asm@gmail.com', '+212720365996', 11, 'fghjk', '2025-12-25 23:45:43'),
(30, 'Hasker', 'Asmae', 'hasker.asm@gmail.com', '+212720365996', 13, 'asdfghjkl;', '2025-12-26 14:59:37'),
(31, 'Faouzi', 'Maryam', 'faouzimaryam43@gmail.com', '0769160742', 11, 'je veux tester', '2025-12-26 16:47:38'),
(32, 'Faouzi', 'Maryam', 'jilali@gmail.com', '0769160742', 11, 'je veux tester seulement', '2025-12-26 17:53:25');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(10, 'arche', '$2y$10$krHvXrGvB8ROuttlcdwSSe9qiEE5yYoUAo551YAeFlaxfRp0lCSl.');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `date_creation` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `formations`
--
ALTER TABLE `formations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_formation` (`id_formation`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `formations`
--
ALTER TABLE `formations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `inscriptions`
--
ALTER TABLE `inscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD CONSTRAINT `fk_formation` FOREIGN KEY (`id_formation`) REFERENCES `formations` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
