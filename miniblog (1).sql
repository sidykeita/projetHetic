-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 27 nov. 2022 à 22:59
-- Version du serveur : 5.7.36
-- Version de PHP : 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `miniblog`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `date`) VALUES
(1, 'Article 1', 'Je suis le boss...\r\nI am the boss', '2022-11-26');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` char(2) NOT NULL,
  `libelle` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle`) VALUES
('ba', 'bouquet accueil'),
('bb', 'bouquet bureau'),
('bf', 'bouquet fetes'),
('pa', 'plantes artificielles'),
('pv', 'plantes vertes');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `dateCommande` date NOT NULL,
  `loginUtilisateur` varchar(7) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `loginUtilisateur` (`loginUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `dateCommande`, `loginUtilisateur`) VALUES
(1, '2020-09-02', 'Logitec'),
(2, '2020-09-15', 'Peps'),
(3, '2020-09-15', 'Logitec'),
(4, '2020-09-30', 'Peps'),
(7, '2020-10-05', 'Peps');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `articleId` int(11) NOT NULL,
  `author` varchar(100) NOT NULL,
  `comments` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `articleId` (`articleId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

DROP TABLE IF EXISTS `contenir`;
CREATE TABLE IF NOT EXISTS `contenir` (
  `idCommande` int(4) NOT NULL,
  `idProduit` int(3) NOT NULL,
  `qte` int(2) NOT NULL,
  PRIMARY KEY (`idCommande`,`idProduit`),
  KEY `idBouquet` (`idProduit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contenir`
--

INSERT INTO `contenir` (`idCommande`, `idProduit`, `qte`) VALUES
(1, 1, 1),
(1, 2, 1),
(2, 5, 3),
(3, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nom` varchar(32) NOT NULL,
  `image` varchar(32) NOT NULL,
  `description` varchar(128) NOT NULL,
  `prix` float NOT NULL,
  `idCategorie` char(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idCategorie` (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `nom`, `image`, `description`, `prix`, `idCategorie`) VALUES
(1, 'Blanc', 'accueilblanc.jpg', 'Fleurs blanches dans un panier en osier', 34, 'ba'),
(2, 'Exotica', 'accueilhaute.jpg', 'Fleurs exotiques en hauteur', 35, 'ba'),
(3, 'Tradition', 'accueilpanier.jpg', 'Bouquet traditionnel', 28, 'ba'),
(4, 'Arbuste', 'artifarbre.jpg', 'Plante artificielle arbuste', 155, 'pa'),
(5, 'Japon', 'artifjaponais.jpg', 'Plante style japonais', 210, 'pa'),
(6, 'Palmier', 'artifpalmier.jpg', 'Palmier 2m50', 240, 'pa'),
(7, 'Jaune', 'bouquetjaune.jpg', 'Tout en fleurs jaunes', 25, 'bb'),
(8, 'Prune', 'bouquetprune.jpg', 'Fleurs prunes', 29, 'bb'),
(9, 'Fete', 'fetecentretable.jpg', 'Pour d?corer une table', 45, 'bf'),
(10, 'Noel', 'fetenoel.jpg', 'Couronne de Noel', 42, 'bf'),
(11, 'Printemps', 'feteoffrir.jpg', 'Fleurs roses et blanches', 32, 'bb'),
(12, 'Mixte', 'bouquetmixte.jpg', 'Fleurs mixtes', 32, 'bb'),
(13, 'Ficus', 'planteficus.jpg', 'Ficus 1m50', 130, 'pv'),
(14, 'Plante', 'plantefleurie.jpg', 'Plante et fleurs', 68, 'pv'),
(15, 'Variation', 'plantemixte.jpg', 'Plante et fleurs', 64, 'pv'),
(16, 'Orchi', 'planteorchi.jpg', 'Orchid', 55, 'pv');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `login` varchar(7) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `adresse` varchar(64) DEFAULT NULL,
  `cp` char(5) DEFAULT NULL,
  `ville` varchar(32) DEFAULT NULL,
  `tel` varchar(10) DEFAULT NULL,
  `mail` varchar(32) DEFAULT NULL,
  `mdp` varchar(7) NOT NULL,
  `statut` varchar(6) NOT NULL DEFAULT 'client',
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`login`, `nom`, `adresse`, `cp`, `ville`, `tel`, `mail`, `mdp`, `statut`) VALUES
('admin', 'admin', NULL, NULL, NULL, NULL, NULL, 'admin', 'admin'),
('client', 'client', NULL, NULL, NULL, NULL, NULL, 'client', 'client'),
('Logitec', 'Logitec', '1 rue de Paris', '93000', 'Bobigny', '0140405050', NULL, '1234abc', 'client'),
('Peps', 'Peps', '50 rue Berlioz', '93230', 'Romainville', '0611223344', 'peps@laposte.net', 'peps', 'client');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`loginUtilisateur`) REFERENCES `utilisateur` (`login`);

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`articleId`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `contenir_ibfk_1` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `contenir_ibfk_2` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
