-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 17 déc. 2021 à 12:20
-- Version du serveur : 5.7.33
-- Version de PHP : 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cours_php`
--

-- --------------------------------------------------------

--
-- Structure de la table `acteur`
--

CREATE TABLE `acteur` (
  `id` int(11) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `prenom` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `acteur`
--

INSERT INTO `acteur` (`id`, `nom`, `prenom`) VALUES
(1, 'Di Caprio', 'Leonardo'),
(2, 'Winslet', 'Kate'),
(3, 'Gibson', 'Mel'),
(5, 'Depp', 'Johnny'),
(6, 'Cumberbatch', 'Benedict'),
(7, 'Connely', 'Jennifer'),
(8, 'Swamp', 'Shrek'),
(9, 'Leto', 'Jared');

-- --------------------------------------------------------

--
-- Structure de la table `casting`
--

CREATE TABLE `casting` (
  `id` int(11) NOT NULL,
  `idFilm` int(11) NOT NULL,
  `idActeur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `casting`
--

INSERT INTO `casting` (`id`, `idFilm`, `idActeur`) VALUES
(2, 6, 1),
(3, 30, 3),
(4, 23, 1),
(5, 11, 1),
(7, 11, 2),
(8, 11, 3),
(9, 11, 5),
(10, 11, 6),
(11, 1645, 1),
(12, 1645, 7),
(13, 1648, 9),
(14, 1648, 7);

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

CREATE TABLE `film` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `annee` int(8) NOT NULL,
  `score` float NOT NULL,
  `vote` int(11) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `film`
--

INSERT INTO `film` (`id`, `nom`, `annee`, `score`, `vote`, `path`) VALUES
(1, 'Star Wars', 1977, 8.9, 14182, ''),
(2, 'Pulp Fiction', 1994, 8.4, 11693, ''),
(3, 'Blade Runner', 1982, 8.6, 8665, ''),
(4, 'Titanic', 1997, 9.2, 8129, ''),
(5, 'Braveheart', 1995, 8.4, 8074, ''),
(6, 'Empire Strikes Back, The', 1980, 8.5, 8050, ''),
(7, 'Shawshank Redemption, The', 1994, 8.8, 7850, ''),
(8, 'Independence Day', 1996, 7, 7138, ''),
(9, 'Usual Suspects, The', 1995, 8.7, 6981, ''),
(10, 'Raiders of the Lost Ark', 1981, 8.4, 6488, ''),
(11, '2001: A Space Odyssey', 1972, 17.4, 1, ''),
(12, 'Forrest Gump', 1994, 7.8, 6269, ''),
(13, 'Aliens', 1986, 8.3, 5811, ''),
(14, 'Silence of the Lambs, The', 1991, 8.3, 5715, ''),
(15, 'Princess Bride, The', 1987, 8.4, 5522, ''),
(16, 'Terminator 2: Judgment Day', 1991, 8, 5513, ''),
(17, 'Casablanca', 1942, 8.7, 5489, ''),
(18, 'Monty Python and the Holy Grail', 1974, 8.4, 5319, ''),
(19, 'Star Trek: First Contact', 1996, 8.2, 5298, ''),
(20, 'Fargo', 1996, 8.2, 5293, ''),
(21, 'Twelve Monkeys', 1995, 8, 5287, ''),
(22, 'Trainspotting', 1996, 8.1, 5233, ''),
(23, 'Godfather, The', 1972, 8.7, 5211, ''),
(24, 'Se7en', 1995, 8.1, 5107, ''),
(25, 'Back to the Future', 1985, 7.8, 5103, ''),
(26, 'Rock, The', 1996, 8, 4938, ''),
(27, 'Reservoir Dogs', 1992, 8.3, 4861, ''),
(28, 'Apocalypse Now', 1979, 8.3, 4860, ''),
(30, 'Apollo 13', 1995, 7.8, 4778, ''),
(31, 'Clockwork Orange, A', 1971, 8.4, 4767, ''),
(32, 'Jurassic Park', 1993, 7.4, 4707, ''),
(33, 'English Patient, The', 1996, 8.1, 4689, ''),
(34, 'One Flew Over the Cuckoo\'s Nest', 1975, 8.5, 4545, ''),
(35, 'Dr. Strangelove or: How I Learned to Stop Worrying and Love the Bomb', 1963, 8.6, 4451, ''),
(39, 'Terminator, The', 1984, 7.8, 4225, ''),
(48, 'True Lies', 1994, 7.3, 3601, ''),
(94, 'Total Recall', 1990, 7.1, 2305, ''),
(180, 'Predator', 1987, 7.2, 1604, ''),
(263, 'Conan the Barbarian', 1981, 6.9, 1271, ''),
(321, 'Twins', 1988, 6.3, 1126, ''),
(334, 'Last Action Hero', 1993, 5.9, 1107, ''),
(410, 'Dave', 1993, 7.4, 962, ''),
(440, 'Kindergarten Cop', 1990, 6.2, 894, ''),
(471, 'Running Man, The', 1987, 6.3, 856, ''),
(629, 'Commando', 1985, 6.1, 673, ''),
(746, 'Conan the Destroyer', 1984, 5.4, 542, ''),
(793, 'Money Pit, The', 1986, 5.8, 482, ''),
(910, 'Brady Bunch Movie, The', 1995, 6.3, 412, ''),
(932, 'Red Heat', 1988, 5.8, 402, ''),
(960, 'Terminator 2: 3-D', 1996, 8.7, 384, ''),
(975, 'Night Shift', 1982, 6.6, 377, ''),
(1106, 'Junior', 1994, 5.9, 329, ''),
(1339, 'Jingle All the Way', 1996, 6, 262, ''),
(1353, 'Outrageous Fortune', 1987, 6.1, 258, ''),
(1551, 'Raw Deal', 1986, 5, 215, ''),
(1622, 'Batman and Robin', 1997, 3.9, 1925, ''),
(1644, 'Red Sonja', 1985, 4.6, 404, ''),
(1645, 'Dark City', 1998, 10, 1, 'upload/131225979851zIUQDAQtL._AC_.jpg'),
(1648, 'Requiem for a Dream', 2000, 9999, 1, 'upload/86127922369197536_af.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `privilege` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `pwd`, `privilege`) VALUES
(4, 'user@user.fr', '$2y$10$m9XejlkN8RdFfBYDwnhV/.UnWOYVorO/vubFMBTMIdYuBSBVtnpgu', 0),
(5, 'admin@admin.fr', '$2y$10$02knmGT0Y5YynPNHOsIhPONa.eLwcnmW9aoJnfE2WGdNtgrJyRLAS', 1);

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

CREATE TABLE `vote` (
  `movie_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `acteur`
--
ALTER TABLE `acteur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `casting`
--
ALTER TABLE `casting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_casting_acteur` (`idActeur`),
  ADD KEY `fk_casting_film` (`idFilm`);

--
-- Index pour la table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`movie_id`,`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `acteur`
--
ALTER TABLE `acteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `casting`
--
ALTER TABLE `casting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `film`
--
ALTER TABLE `film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1649;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `casting`
--
ALTER TABLE `casting`
  ADD CONSTRAINT `fk_casting_acteur` FOREIGN KEY (`idActeur`) REFERENCES `acteur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_casting_film` FOREIGN KEY (`idFilm`) REFERENCES `film` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
