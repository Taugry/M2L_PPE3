CREATE DATABASE m2l character set = 'utf8' COLLATE = 'utf8_general_ci';

use m2l;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `m2l`
--

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE `faq` (
  `id_faq` int(11) NOT NULL,
  `question` varchar(50) NOT NULL,
  `reponse` varchar(50) NOT NULL,
  `dat_question` datetime NOT NULL,
  `dat_reponse` datetime NOT NULL,
  `ID_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `faq`
--

INSERT INTO `faq` (`id_faq`, `question`, `reponse`, `dat_question`, `dat_reponse`, `ID_user`) VALUES
(4, 'Question 1', 'Reponse 26', '2019-07-11 12:52:15', '2020-03-18 08:58:59', 1),
(5, 'Question 1', ' sse', '2019-07-11 12:52:15', '2020-03-10 22:13:55', 2),
(6, 'Question 1', 'Reponse 1', '2019-07-11 12:52:15', '2019-07-13 16:22:16', 2),
(7, 'Question 1', 'Reponse 1', '2019-07-11 12:52:15', '2019-07-13 16:22:16', 1),
(24, '\"php.validate.executablePath\": \"F:xamppphpphp.exe\"', '', '2020-03-18 08:44:50', '0000-00-00 00:00:00', 15),
(25, 'administrateur_football\r\nadministrateur_football\r\n', '', '2020-03-18 11:25:29', '0000-00-00 00:00:00', 15),
(26, 'sssssfdssssssssssssssssssssssssssssssdfdsfdsfdsfds', ' ', '2020-03-18 11:35:29', '2020-03-18 11:35:39', 15),
(28, 'yy', '', '2020-03-24 21:35:08', '0000-00-00 00:00:00', 18),
(29, 'sqdqsd', '', '2020-03-24 21:35:10', '0000-00-00 00:00:00', 18),
(30, 'sdqsd', '', '2020-03-24 21:35:12', '0000-00-00 00:00:00', 18),
(31, 'sdqsd', '', '2020-03-24 21:35:13', '0000-00-00 00:00:00', 18),
(32, 'sûr là ?', '', '2020-03-25 11:11:54', '0000-00-00 00:00:00', 15),
(33, 'sa', '', '2020-03-25 11:18:20', '0000-00-00 00:00:00', 15),
(34, 'sasss', '', '2020-03-25 11:25:01', '0000-00-00 00:00:00', 15),
(35, 'ddd', '', '2020-03-25 11:25:10', '0000-00-00 00:00:00', 18);

-- --------------------------------------------------------

--
-- Structure de la table `ligue`
--

CREATE TABLE `ligue` (
  `ID_ligue` int(11) NOT NULL,
  `lib_ligue` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ligue`
--

INSERT INTO `ligue` (`ID_ligue`, `lib_ligue`) VALUES
(1, 'Ligue de football'),
(2, 'Ligue de basket'),
(3, 'Ligue de volley'),
(4, 'Ligue de handball'),
(5, 'Toutes les ligues');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `ID_user` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `ID_usertype` int(11) NOT NULL,
  `ID_ligue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`ID_user`, `pseudo`, `mdp`, `mail`, `ID_usertype`, `ID_ligue`) VALUES
(1, 'utilisateur', '$2y$10$BlmwBuFmrfUeKhjNDuj5KuQpOt.RMJe3w6QSTll8RBvzChZHRmPFS', 'utilisateur@m2l.fr', 1, 1),
(2, 'administrateur_football', '$2y$10$dSJJiVk9oq7YokbjRxTzvOQHgwWj.bwGr4qvGVY.RlkNoWzwvo/3W', 'administrateur_football@m2l.fr', 2, 1),
(14, 'superadmin', '$2y$10$DfLRSUPz9j4vWx86u4HBp.v6vlX3xwANa7lU5fQ58EdH7tYOPLQPq', 'admin@m2l.fr', 3, 5),
(15, 'Arnaud', '$2y$10$Yv.VKyVxAixgMUZ4YEgJT.vVgIqyvbvaW4SjKycjWC.3RhWxt1rMq', 'arnaud@m2l.fr', 3, 5),
(16, 'Benjamin', '$2y$10$29wqgCtDTLDv.x/CcQ.yTOqE87SyhFjnfTQg6tjYfDbelcEc5dzfa', 'benjamin.michoux@limayrac.fr', 1, 1),
(17, 'foot', '$2y$10$ygAGTegejRIOPo9o1NGcDeB0uNW7KM4/dx4Mtuk7RDpUY1SmV/T2K', 'foot@m2l.fr', 1, 1),
(18, 'basket', '$2y$10$2TmHLVuCkAAchOrl9M7jEeuVxfM/zBa7FUBVNknVSuDU4n4incboq', 'basket@m2l.fr', 1, 2),
(19, 'volley', '$2y$10$wiBhWaHliduuTRigfzLMPOE87/3CB281O6mzYyBp0KgHvZPjI5km2', 'volley@m2l.fr', 1, 3),
(20, 'uservolleyadmin', '$2y$10$nU4dIq/HIf41FIdwPpVw3OCVZMRlisayWtXDk1AocdTik3dUn3vI6', 'volleyadmin@m2l.fr', 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `usertype`
--

CREATE TABLE `usertype` (
  `ID_usertype` int(11) NOT NULL,
  `lib_usertype` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `usertype`
--

INSERT INTO `usertype` (`ID_usertype`, `lib_usertype`, `description`) VALUES
(1, 'utilisateur', 'Utilisateur de base'),
(2, 'admin', 'Administrateur de ligue'),
(3, 'superadmin', 'Administrateur de toutes les ligues');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id_faq`),
  ADD KEY `FAQ_USER_FK` (`ID_user`);

--
-- Index pour la table `ligue`
--
ALTER TABLE `ligue`
  ADD PRIMARY KEY (`ID_ligue`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_user`),
  ADD KEY `USER_USERTYPE_FK` (`ID_usertype`),
  ADD KEY `USER_LIGUE0_FK` (`ID_ligue`);

--
-- Index pour la table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`ID_usertype`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `faq`
--
ALTER TABLE `faq`
  MODIFY `id_faq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `ligue`
--
ALTER TABLE `ligue`
  MODIFY `ID_ligue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `ID_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `ID_usertype` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `faq`
--
ALTER TABLE `faq`
  ADD CONSTRAINT `FAQ_USER_FK` FOREIGN KEY (`ID_user`) REFERENCES `user` (`ID_user`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `USER_LIGUE0_FK` FOREIGN KEY (`ID_ligue`) REFERENCES `ligue` (`ID_ligue`),
  ADD CONSTRAINT `USER_USERTYPE_FK` FOREIGN KEY (`ID_usertype`) REFERENCES `usertype` (`ID_usertype`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
