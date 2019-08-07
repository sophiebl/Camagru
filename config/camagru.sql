-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mer. 07 août 2019 à 11:06
-- Version du serveur :  5.6.43
-- Version de PHP :  5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `camagru`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `idImg` int(11) NOT NULL,
  `IdUser` int(11) NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `idImg`, `IdUser`, `content`, `date`) VALUES
(1, 30, 13, 'Nice pic!', '2019-08-07 14:25:25'),
(2, 31, 13, 'Oh This is Michael Jackson!!!!!', '2019-08-07 14:25:25'),
(3, 31, 13, 'Oh This is Michael Jackson!!!!!', '2019-08-07 14:25:25'),
(4, 32, 13, 'Jean paul! Nice pic!', '2019-08-07 14:25:25'),
(5, 51, 13, 'Chill', '2019-08-07 14:25:25'),
(6, 54, 14, 'Tellement styl&eacute;', '2019-08-07 15:57:04'),
(7, 31, 14, 'Hello', '2019-08-07 16:18:02'),
(8, 32, 14, 'WHAAAAOUUUUUU', '2019-08-07 17:40:36'),
(9, 32, 14, '&quot;YEEEEES&quot;', '2019-08-07 17:41:38'),
(10, 32, 14, '&quot;YEEEEES&quot;', '2019-08-07 17:42:02'),
(11, 33, 14, 'WATER', '2019-08-07 17:42:53');

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `path` varchar(800) NOT NULL,
  `idUsers` int(11) NOT NULL,
  `nbLike` int(11) NOT NULL,
  `legend` varchar(1000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `path`, `idUsers`, `nbLike`, `legend`, `date`) VALUES
(30, 'public/img/5d4ab76763811.png', 13, 0, 'Girl black & white', '2019-08-07 14:25:04'),
(31, 'public/img/5d4ab87d48cbd.png', 13, 0, '', '2019-08-07 14:25:04'),
(32, 'public/img/5d4ab8e6dd855.png', 13, 0, '', '2019-08-07 14:25:04'),
(33, 'public/img/5d4abf4e70b80.png', 13, 0, 'photographer', '2019-08-07 14:25:04'),
(34, 'public/img/5d4ac00284241.png', 13, 0, '', '2019-08-07 14:25:04'),
(35, 'public/img/5d4ac121cd15b.png', 13, 0, '', '2019-08-07 14:25:04'),
(51, 'public/img/5d4acc8be39df.png', 13, 0, '', '2019-08-07 14:25:04'),
(52, 'public/img/5d4ade1dedcf9.png', 14, 0, '', '2019-08-07 14:25:04'),
(53, 'public/img/5d4af3e081b68.png', 14, 0, '', '2019-08-07 15:53:04'),
(54, 'public/img/5d4af4c26e264.png', 14, 0, '', '2019-08-07 15:56:50');

-- --------------------------------------------------------

--
-- Structure de la table `like`
--

CREATE TABLE `like` (
  `id` int(11) NOT NULL,
  `isLiked` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `IdImg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `like`
--

INSERT INTO `like` (`id`, `isLiked`, `idUser`, `IdImg`) VALUES
(1, 0, 13, 30),
(2, 0, 13, 32),
(4, 0, 13, 51),
(5, 0, 14, 54),
(7, 1, 14, 30),
(8, 1, 14, 32),
(9, 1, 14, 34),
(10, 1, 14, 35),
(12, 1, 14, 51),
(13, 1, 14, 52),
(22, 1, 14, 31),
(23, 1, 14, 33);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `isVerif` tinyint(1) NOT NULL DEFAULT '0',
  `token` int(11) NOT NULL,
  `notifCom` tinyint(1) NOT NULL DEFAULT '1',
  `notifLike` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `isVerif`, `token`, `notifCom`, `notifLike`) VALUES
(1, 'test@testmail.com', 'Sophie', 'test', 0, 0, 1, 1),
(2, 'test2@testmail.com\r\n', 'Test', 'test', 0, 0, 1, 1),
(7, 'sophieboulaaouli@gmail.com3', 'sophiebl3', '123456789', 0, 0, 1, 1),
(8, 'sophie.boulaaouli@gmail.com', 'sophiebl4', '123456789', 0, 0, 1, 1),
(9, 'soso@gmail.com', 'hello', '123456789', 0, 0, 1, 1),
(10, 'ri@gmail.com', 'toto', '123456789', 0, 0, 1, 1),
(11, 'testregister', 'test@register.com', '123456789', 0, 0, 1, 1),
(13, 'sophieboulaaouli@gmail.com', 'BL', 'd9e6762dd1c8eaf6d61b3c6192fc408d4d6d5f1176d0c29169bc24e71c3f274ad27fcd5811b313d681f7e55ec02d73d499c95455b6b5bb503acf574fba8ffe85', 1, 8969, 1, 1),
(14, 'sophie_boulaaouli@hotmail.fr', 'sophie12', 'd9e6762dd1c8eaf6d61b3c6192fc408d4d6d5f1176d0c29169bc24e71c3f274ad27fcd5811b313d681f7e55ec02d73d499c95455b6b5bb503acf574fba8ffe85', 1, 2872, 1, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IdUser` (`IdUser`),
  ADD KEY `idImg` (`idImg`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsers` (`idUsers`);

--
-- Index pour la table `like`
--
ALTER TABLE `like`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `IdImg` (`IdImg`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `like`
--
ALTER TABLE `like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`idImg`) REFERENCES `image` (`id`);

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`idUsers`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `like`
--
ALTER TABLE `like`
  ADD CONSTRAINT `like_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `like_ibfk_2` FOREIGN KEY (`IdImg`) REFERENCES `image` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
