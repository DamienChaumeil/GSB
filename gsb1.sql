-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 30 nov. 2022 à 16:40
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gsb1`
--

-- --------------------------------------------------------

--
-- Structure de la table `droit`
--

CREATE TABLE `droit` (
  `id_droit` int(4) NOT NULL,
  `Libelle` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `droit`
--

INSERT INTO `droit` (`id_droit`, `Libelle`) VALUES
(1, 'visiteur'),
(2, 'comptable'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `fiche_frais`
--

CREATE TABLE `fiche_frais` (
  `id_fiche` int(4) NOT NULL,
  `Id_statut` int(4) NOT NULL,
  `Id_user` int(6) NOT NULL,
  `DateFiche` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `fiche_frais`
--

INSERT INTO `fiche_frais` (`id_fiche`, `Id_statut`, `Id_user`, `DateFiche`) VALUES
(1, 1, 2, '11/2022'),
(11, 1, 3, '12/2022'),
(13, 1, 2, '12/2022'),
(15, 1, 15, '12/2022');

-- --------------------------------------------------------

--
-- Structure de la table `frais_forfaitaire`
--

CREATE TABLE `frais_forfaitaire` (
  `id_fiche` int(4) NOT NULL,
  `quantite_mensuelle` int(6) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `frais_forfaitaire`
--

INSERT INTO `frais_forfaitaire` (`id_fiche`, `quantite_mensuelle`, `id`) VALUES
(1, 122, 1),
(1, 33, 2),
(1, 43, 3),
(1, 305, 4),
(11, 5, 1),
(11, 644, 2),
(11, 4676, 3),
(11, 999, 4),
(13, 2223, 1),
(13, 5454, 2),
(13, 656, 3),
(13, 5655, 4),
(15, 14, 1),
(15, 12, 2),
(15, 22, 3),
(15, 37, 4);

-- --------------------------------------------------------

--
-- Structure de la table `frais_hors_forfait`
--

CREATE TABLE `frais_hors_forfait` (
  `id_fiche` int(4) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `date_frais_hf` varchar(10) NOT NULL,
  `montant` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `frais_hors_forfait`
--

INSERT INTO `frais_hors_forfait` (`id_fiche`, `libelle`, `date_frais_hf`, `montant`) VALUES
(1, 'libelleCredible', '01/11/22', 100),
(11, 'frfrfrf', '01/07/200', 7),
(13, 'gcsuyrsj', '01/07/2002', 3299),
(13, 'libellecredible', '27/11/2022', 234),
(15, 'libellecredible', '01/05/2002', 5678);

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

CREATE TABLE `statut` (
  `Id_statut` int(4) NOT NULL,
  `libelle_statut` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `statut`
--

INSERT INTO `statut` (`Id_statut`, `libelle_statut`) VALUES
(1, 'Saisie'),
(2, 'Validée'),
(3, 'Refusée'),
(4, 'Remboursée');

-- --------------------------------------------------------

--
-- Structure de la table `type_frais`
--

CREATE TABLE `type_frais` (
  `id` int(4) NOT NULL,
  `libelle` varchar(50) DEFAULT NULL,
  `multiplicateur` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `type_frais`
--

INSERT INTO `type_frais` (`id`, `libelle`, `multiplicateur`) VALUES
(1, 'ForfaitEtape', '1.00'),
(2, 'FraisKilometrique', '0.50'),
(3, 'NuiteeHotel', '1.00'),
(4, 'RepasRestaurant', '1.00');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `Id_user` int(6) NOT NULL,
  `Nom` varchar(15) NOT NULL,
  `Prenom` varchar(20) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `mdp` char(70) NOT NULL,
  `id_droit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`Id_user`, `Nom`, `Prenom`, `mail`, `mdp`, `id_droit`) VALUES
(2, 'Martinez', 'David', 'dav.martinez@gmail.com', '$2y$10$vpJbKO4.Ge2Z.2b3Pzdx4.diKVihYrSMhsphyBA7/9fnVYwJuutV2', 1),
(3, 'test', 'test', 'test@gmail.com', '$2y$10$/9vd1oRFvfzjCbRei4VamOwAxpvPQoyHoA2HShcRbf3Jii0DLotbm', 3),
(12, 'Cugnet', 'Lucas', 'lucas@gmail.com', '$2y$10$9slY7jh9lTaZJ1tE6euPTetSewNH3niH9bjtPGsQkEvi1o8InQJAm', 2),
(15, 'gsb', 'gsb', 'gsb@gmail.com', '$2y$10$Y5wIQzgLh/XW2KrCop8KgOvO/Z5KKDKtEBJKL6NsEtSNkpARPw58S', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `droit`
--
ALTER TABLE `droit`
  ADD PRIMARY KEY (`id_droit`);

--
-- Index pour la table `fiche_frais`
--
ALTER TABLE `fiche_frais`
  ADD PRIMARY KEY (`id_fiche`),
  ADD KEY `Id_statut` (`Id_statut`),
  ADD KEY `Id_user` (`Id_user`);

--
-- Index pour la table `frais_forfaitaire`
--
ALTER TABLE `frais_forfaitaire`
  ADD PRIMARY KEY (`id_fiche`,`id`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `frais_hors_forfait`
--
ALTER TABLE `frais_hors_forfait`
  ADD PRIMARY KEY (`id_fiche`,`libelle`,`date_frais_hf`);

--
-- Index pour la table `statut`
--
ALTER TABLE `statut`
  ADD PRIMARY KEY (`Id_statut`);

--
-- Index pour la table `type_frais`
--
ALTER TABLE `type_frais`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id_user`),
  ADD UNIQUE KEY `mdp` (`mdp`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD KEY `id_droit` (`id_droit`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `droit`
--
ALTER TABLE `droit`
  MODIFY `id_droit` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `fiche_frais`
--
ALTER TABLE `fiche_frais`
  MODIFY `id_fiche` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `statut`
--
ALTER TABLE `statut`
  MODIFY `Id_statut` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `type_frais`
--
ALTER TABLE `type_frais`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `Id_user` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `fiche_frais`
--
ALTER TABLE `fiche_frais`
  ADD CONSTRAINT `fiche_frais_ibfk_1` FOREIGN KEY (`Id_statut`) REFERENCES `statut` (`Id_statut`),
  ADD CONSTRAINT `fiche_frais_ibfk_2` FOREIGN KEY (`Id_user`) REFERENCES `users` (`Id_user`);

--
-- Contraintes pour la table `frais_forfaitaire`
--
ALTER TABLE `frais_forfaitaire`
  ADD CONSTRAINT `frais_forfaitaire_ibfk_2` FOREIGN KEY (`id`) REFERENCES `type_frais` (`id`),
  ADD CONSTRAINT `id_fiche` FOREIGN KEY (`id_fiche`) REFERENCES `fiche_frais` (`id_fiche`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `frais_hors_forfait`
--
ALTER TABLE `frais_hors_forfait`
  ADD CONSTRAINT `id_fiche_hf` FOREIGN KEY (`id_fiche`) REFERENCES `fiche_frais` (`id_fiche`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_droit`) REFERENCES `droit` (`id_droit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
