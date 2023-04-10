-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 21 mars 2023 à 11:38
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `rekonnect`
--

-- --------------------------------------------------------

--
-- Structure de la table `password_reset`
--

CREATE TABLE `password_reset` (
  `id` tinyint(4) NOT NULL,
  `email` varchar(55) DEFAULT NULL,
  `token` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `postrepare`
--

CREATE TABLE `postrepare` (
  `id` int(11) NOT NULL,
  `serviceName` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `postsell`
--

CREATE TABLE `postsell` (
  `id` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `pictureOne` varchar(255) DEFAULT NULL,
  `pictureTwo` varchar(255) DEFAULT NULL,
  `userName` varchar(100) NOT NULL,
  `users_id` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `postsell`
--

INSERT INTO `postsell` (`id`, `productName`, `description`, `price`, `pictureOne`, `pictureTwo`, `userName`, `users_id`) VALUES
(51, 'Iphone 14', 'Iphone fonctionnel, micro rayures sur la face arrière', '999.00', '9101035adfb4ea79f6d85153986c74cd.webp', NULL, 'Sam', 77),
(52, 'Iphone 12', 'Iphone neuf jamais déballé', '799.00', 'fbcd33ce7a3a4009bf569ea945205dc1.jpeg', NULL, 'Sam', 77),
(53, 'Iphone 13', 'Non fonctionnel, vente pour pièces détachées', '299.00', '622fd4953b2685bc8bb6bd7277b6655f.jpeg', NULL, 'Sam', 77),
(54, 'Samsung S22+', 'Téléphone quasi neuf, servi à peine une semaine pour test', '699.00', '1973320a5c15182a06e332d7b37fba2f.jpeg', NULL, 'Sam', 77),
(55, 'Samsung S21', 'Téléphone fonctionnel, écran fissuré à remplacer', '399.00', '7248e633f3c2cb81855fe32c6d861f5a.jpeg', NULL, 'Sam', 77),
(56, 'iphone 11', 'Iphone fonctionnel, micro rayures sur la face arrière', '699.00', 'b5e1320aa74f4fa4aa93726adad3db9e.jpeg', NULL, 'Sam', 77),
(57, 'Enceinte Alexa', 'Enceinte neuve, jamais déballée', '99.00', '36877759b28eeffd08ed843d7c83ce0c.jpeg', NULL, 'Sam', 77);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `adress` varchar(250) DEFAULT 'Aucune',
  `adress_delivery` varchar(250) DEFAULT 'Aucune',
  `seller` tinyint(1) UNSIGNED DEFAULT NULL,
  `buyer` tinyint(1) UNSIGNED DEFAULT NULL,
  `repairer` tinyint(1) UNSIGNED DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `wallet` mediumint(9) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `adress`, `adress_delivery`, `seller`, `buyer`, `repairer`, `phone`, `avatar`, `wallet`) VALUES
(77, 'Sam', 'sam@rekonnect.com', '$2y$10$PWgaWG5R9g1Z08r.k38LVOhT7ngHjMzPyetRR8nQn/OqlHYExrsdO', '30 AVENUE DE LA RECONNEXION', '50 AVENUE DE LA RECONNEXION', 1, 1, 1, '0123456789', 'fa2a326c831c24a995402baa1bd5b8de.jpg', 4901);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `postrepare`
--
ALTER TABLE `postrepare`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `postsell`
--
ALTER TABLE `postsell`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT pour la table `postrepare`
--
ALTER TABLE `postrepare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `postsell`
--
ALTER TABLE `postsell`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;