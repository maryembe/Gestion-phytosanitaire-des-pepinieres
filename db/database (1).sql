-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 04 juin 2023 à 02:51
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `database`
--

-- --------------------------------------------------------

--
-- Structure de la table `acp`
--

CREATE TABLE `acp` (
  `id_acp` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `destination` varchar(100) NOT NULL,
  `id_DECL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `courrier`
--

CREATE TABLE `courrier` (
  `Num` int(11) NOT NULL,
  `id_ctrl_doc` int(11) DEFAULT NULL,
  `Result_ctrl_doc` varchar(150) DEFAULT NULL,
  `id_ctrl1` int(11) DEFAULT NULL,
  `Result_ctr1` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ctrl1`
--

CREATE TABLE `ctrl1` (
  `id_ctrl1` int(11) NOT NULL,
  `date_ctrl1` date NOT NULL,
  `conform` varchar(50) NOT NULL,
  `id_ctrl_doc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ctrl2`
--

CREATE TABLE `ctrl2` (
  `id_ctrl2` int(11) NOT NULL,
  `date_ctrl2` date NOT NULL,
  `conform` varchar(50) NOT NULL,
  `id_ctrl1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ctrl_doc`
--

CREATE TABLE `ctrl_doc` (
  `id_ctrl_doc` int(11) NOT NULL,
  `conform` varchar(50) NOT NULL,
  `id_decl` varchar(50) NOT NULL,
  `date_ctrl_doc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `declaration`
--

CREATE TABLE `declaration` (
  `N_enregistr` int(11) NOT NULL,
  `date_decl` date NOT NULL DEFAULT current_timestamp(),
  `Etat` enum('Non prise en charge','Control documentaire non conforme','Control documentaire conforme','Control Physique 1 non conforme','Control Physique 1 conforme','Control Physique 2 conforme','Control Physique 2 non conforme') NOT NULL,
  `id_pep` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pep`
--

CREATE TABLE `pep` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('Pepinieriste','Agent') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pep`
--

INSERT INTO `pep` (`username`, `password`, `role`) VALUES
('yuki', '81dc9bdb52d04dc20036dbd8313ed055', 'Agent');

-- --------------------------------------------------------

--
-- Structure de la table `personne_morale`
--

CREATE TABLE `personne_morale` (
  `ICE` int(11) NOT NULL,
  `RC` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `adresse` varchar(75) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `id_pep` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personne_physique`
--

CREATE TABLE `personne_physique` (
  `CIN` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `adresse` varchar(75) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `adresse_pep` varchar(75) NOT NULL,
  `nom_pep` varchar(50) NOT NULL,
  `id_pep` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `plant`
--

CREATE TABLE `plant` (
  `id_plant` int(11) NOT NULL,
  `espece` varchar(50) NOT NULL,
  `variete` varchar(50) NOT NULL,
  `porte_greffe` varchar(50) NOT NULL,
  `nb` int(11) NOT NULL,
  `id_decl` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `acp`
--
ALTER TABLE `acp`
  ADD PRIMARY KEY (`id_acp`);

--
-- Index pour la table `courrier`
--
ALTER TABLE `courrier`
  ADD PRIMARY KEY (`Num`);

--
-- Index pour la table `ctrl1`
--
ALTER TABLE `ctrl1`
  ADD PRIMARY KEY (`id_ctrl1`);

--
-- Index pour la table `ctrl2`
--
ALTER TABLE `ctrl2`
  ADD PRIMARY KEY (`id_ctrl2`);

--
-- Index pour la table `ctrl_doc`
--
ALTER TABLE `ctrl_doc`
  ADD PRIMARY KEY (`id_ctrl_doc`);

--
-- Index pour la table `declaration`
--
ALTER TABLE `declaration`
  ADD PRIMARY KEY (`N_enregistr`);

--
-- Index pour la table `pep`
--
ALTER TABLE `pep`
  ADD PRIMARY KEY (`username`);

--
-- Index pour la table `personne_morale`
--
ALTER TABLE `personne_morale`
  ADD PRIMARY KEY (`ICE`);

--
-- Index pour la table `personne_physique`
--
ALTER TABLE `personne_physique`
  ADD PRIMARY KEY (`CIN`);

--
-- Index pour la table `plant`
--
ALTER TABLE `plant`
  ADD PRIMARY KEY (`id_plant`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `acp`
--
ALTER TABLE `acp`
  MODIFY `id_acp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT pour la table `courrier`
--
ALTER TABLE `courrier`
  MODIFY `Num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `ctrl1`
--
ALTER TABLE `ctrl1`
  MODIFY `id_ctrl1` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `ctrl2`
--
ALTER TABLE `ctrl2`
  MODIFY `id_ctrl2` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `ctrl_doc`
--
ALTER TABLE `ctrl_doc`
  MODIFY `id_ctrl_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `declaration`
--
ALTER TABLE `declaration`
  MODIFY `N_enregistr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `plant`
--
ALTER TABLE `plant`
  MODIFY `id_plant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
