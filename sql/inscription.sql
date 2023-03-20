-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 01 juin 2022 à 12:28
-- Version du serveur :  5.7.34
-- Version de PHP : 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `inscription`
--

-- --------------------------------------------------------

--
-- Structure de la table `avoir`
--

CREATE TABLE `avoir` (
  `id` int(11) NOT NULL,
  `id_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `centre_interet`
--

CREATE TABLE `centre_interet` (
  `sport` varchar(11) DEFAULT NULL,
  `musique` varchar(11) DEFAULT NULL,
  `photo` varchar(8) DEFAULT NULL,
  `musee` varchar(8) DEFAULT NULL,
  `sortir` varchar(8) DEFAULT NULL,
  `jeux_societe` varchar(8) DEFAULT NULL,
  `dessin` varchar(8) DEFAULT NULL,
  `cuisine` varchar(8) DEFAULT NULL,
  `danse` varchar(8) DEFAULT NULL,
  `jeux_video` varchar(8) DEFAULT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `centre_interet`
--

INSERT INTO `centre_interet` (`sport`, `musique`, `photo`, `musee`, `sortir`, `jeux_societe`, `dessin`, `cuisine`, `danse`, `jeux_video`, `id_users`) VALUES
('', 'on', '', '', 'on', 'on', '', '', 'on', '', 1),
('', '', 'on', '', 'on', '', '', 'on', '', '', 2),
('', 'on', '', '', '', '', '', '', '', '', 4),
('', 'on', 'on', '', 'on', '', '', '', '', '', 56),
('', '', 'on', '', 'on', '', '', 'on', '', '', 58),
('', '', 'on', '', '', '', '', 'on', '', 'on', 59),
('', '', 'on', '', 'on', '', 'on', '', '', '', 60),
('', '', '', '', 'on', '', '', 'on', 'on', '', 61),
('', '', '', 'on', 'on', 'on', '', '', '', '', 62),
('', '', '', '', '', '', '', 'on', 'on', 'on', 63),
('', '', '', '', '', '', '', '', '', '', 64),
('', '', 'on', '', 'on', 'on', '', '', '', '', 66),
('', '', '', '', '', '', '', '', '', '', 67),
('', 'on', '', '', 'on', '', 'on', 'on', '', '', 68);

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `ID_event` int(11) NOT NULL,
  `ID_client` int(11) NOT NULL,
  `Description` text,
  `Adresse` text,
  `Type` text,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`ID_event`, `ID_client`, `Description`, `Adresse`, `Type`, `Date`) VALUES
(2, 1, 'Asian food', 'FoodASIA', 'Go to eat', '2022-05-17'),
(4, 3, 'Pool Party', '33 street VICTOR HUGO', 'Evening & Party', '2022-05-19'),
(6, 1, 'Asian food', 'FoodASIA', 'Go to eat', '2022-05-17'),
(24, 4, 'aa', 'villejuif', 'soiree', '2022-06-03'),
(25, 4, 'soiree', 'villejuif', 'soiree', '2022-06-02'),
(27, 68, 'velo', 'paris', 'balade', '2022-06-01');

-- --------------------------------------------------------

--
-- Structure de la table `lier_amitie_avec`
--

CREATE TABLE `lier_amitie_avec` (
  `id` int(11) NOT NULL,
  `id_1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `relation`
--

CREATE TABLE `relation` (
  `id_relation` int(255) NOT NULL,
  `id_demandeur` int(255) NOT NULL,
  `id_receveur` int(255) NOT NULL,
  `statut` int(255) NOT NULL,
  `id_bloqueur` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `relation`
--

INSERT INTO `relation` (`id_relation`, `id_demandeur`, `id_receveur`, `statut`, `id_bloqueur`) VALUES
(7, 1, 11, 3, NULL),
(10, 4, 12, 2, NULL),
(12, 10, 4, 2, NULL),
(21, 1, 67, 2, NULL),
(22, 4, 2, 1, NULL),
(24, 4, 1, 1, NULL),
(27, 68, 1, 1, NULL),
(28, 68, 4, 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `pays` varchar(255) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `psw` text NOT NULL,
  `ip` varchar(20) NOT NULL,
  `token` text NOT NULL,
  `biographie` text,
  `ref_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `age`, `pays`, `ville`, `mail`, `psw`, `ip`, `token`, `biographie`, `ref_image`) VALUES
(1, 'Ma', 'Lilou', 22, 'France', 'Paris', 'email@email.com', 'jsp', 'IP145213', 'lalal', 'blablablablablablabla blablablablabla', ''),
(2, 'THIRION', 'Maxime', 19, 'France', 'Montrouge', 'maxime@gmail.com', 'maxime', 'ip123456', 'ababab', 'bio', ''),
(4, 'HERSAND', 'Melline', 22, 'Italie', 'Rome', 'melline@gmail.Com', 'AZE', 'ip123456', 'ababab', 'bbbbb', 'melline'),
(5, 'MARCHETTI', 'Berenice', 19, 'France', 'Marne-la-vallée', 'berenice@gmail.com', 'AZE', 'ip123456', 'ababab', 'bio', ''),
(6, 'MACHARD', 'Paul', 19, 'France', 'Cachan', 'machard@gmail.com', 'AZE', 'ip123456', 'ababab', 'bio', ''),
(7, 'GUILLAUME', 'Antoine', 19, 'France', 'Muids', 'antoine@gmail.com', 'AZE', 'ip123456', 'ababab', 'bio', ''),
(8, 'HUGO', 'Victor', 19, 'France', 'Hanfleur', 'hugo@gmail.com', 'AZE', 'ip123456', 'ababab', 'bio', ''),
(9, 'ELUARD', 'Paul', 19, 'France', 'Metz', 'eluard@gmail.com', 'AZE', 'ip123456', 'ababab', 'bio', ''),
(10, 'COSTA', 'Thomas', 19, 'France', 'Paris', 'costa@gmail.com', 'AZE', 'ip123456', 'ababab', 'bio', ''),
(11, 'JURASUNAS', 'Remi', 19, 'France', 'Metz', 'remi@gmail.com', 'AZE', 'ip123456', 'ababab', 'bio', ''),
(12, 'LABBE', 'Luc', 19, 'France', 'Metz', 'labe@gmail.com', 'AZE', 'ip123456', 'ababab', 'bio', ''),
(13, 'DUPONT', 'Jules', 19, 'France', 'Metz', 'dupont@gmail.com', 'AZE', 'ip123456', 'ababab', 'bio', ''),
(14, 'TERRIEUR', 'Alain', 19, 'France', 'Metz', 'alainter@gmail.com', 'AZE', 'ip123456', 'ababab', 'bio', ''),
(15, 'TERRIEUR', 'Alex', 19, 'France', 'Metz', 'alexter@gmail.Com', 'AZE', 'ip123456', 'ababab', 'bio', ''),
(16, 'LARDEAU', 'Alixia', 19, 'France', 'Charenton', 'Lardeau@gmail.com', 'ert', 'ip123456', 'ababab', 'bio', ''),
(67, 'coco', 'rico', 22, 'Canada', 'Montréal', 'cocorico@gmail.com', 'AZE', '::1', '40c19f6e407d303055b71f190be9e37d4d187c7a4f2b05b8549709d53035ce6799715408a018480e7eab60de260f70ce97f2fc01a29fe37e30eab1516f22653e', NULL, ''),
(68, 'cocorico', 'oiseau', 21, 'Canada', 'quebec', 'cocorico.oiseau@gmail.com', 'chant', '::1', '6de8abe9b82869a03ee87665543d0e7bc1d7add4b947d2e781fd73b26a646c9ae3b7a3a74003333e7a8d8197b0abf19778dbceade0c4d8ee48e5c9edf0c61a9c', 'bonjour', ''),
(69, 'aaa', 'aaa', 18, 'France', 'Paris', 'aa@aa.com', 'AZE', '::1', '520e081e81865cb3b2cd08e6d1fbcfa98faea817525c353b19c703e3962ed0fae3889871679a6c8ad1248964d3df8ce2b40eccaed7483cec95be24d9852b5ab4', NULL, ''),
(70, 'coco', 'rico', 18, 'Canada', 'Montréal', 'aaaa@a.com', 'AZE', '::1', '1e564dbf1bbfa600286ec385e2b3b2ec01ac8c0357805c8d690b7289123c9daca6ee539890aeae66429ea05ab23f44771084e3a39f9689aab069864607487442', NULL, ''),
(71, 'Ma', 'Lilou', 22, 'France', 'Paris', 'email@email.com', 'jsp', 'IP145213', 'lalal', 'blablablablablablabla blablablablabla', 'melline');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avoir`
--
ALTER TABLE `avoir`
  ADD PRIMARY KEY (`id`,`id_activity`),
  ADD KEY `activity` (`id_activity`);

--
-- Index pour la table `centre_interet`
--
ALTER TABLE `centre_interet`
  ADD PRIMARY KEY (`id_users`);

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`ID_event`);

--
-- Index pour la table `lier_amitie_avec`
--
ALTER TABLE `lier_amitie_avec`
  ADD PRIMARY KEY (`id`,`id_1`),
  ADD KEY `id_1` (`id_1`);

--
-- Index pour la table `relation`
--
ALTER TABLE `relation`
  ADD PRIMARY KEY (`id_relation`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `ID_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `relation`
--
ALTER TABLE `relation`
  MODIFY `id_relation` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avoir`
--
ALTER TABLE `avoir`
  ADD CONSTRAINT `users` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `lier_amitie_avec`
--
ALTER TABLE `lier_amitie_avec`
  ADD CONSTRAINT `lier_amitie_avec_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `lier_amitie_avec_ibfk_2` FOREIGN KEY (`id_1`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
