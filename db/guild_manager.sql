-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 10 déc. 2020 à 15:16
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `guild_manager`
--

-- --------------------------------------------------------

--
-- Structure de la table `boss`
--

CREATE TABLE `boss` (
  `id` int(11) NOT NULL,
  `name` char(50) NOT NULL DEFAULT '',
  `location_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `boss`
--

INSERT INTO `boss` (`id`, `name`, `location_id`) VALUES
(1, 'Lucifron', 1),
(2, 'Magmadar', 1),
(3, 'Gehennas', 1),
(4, 'Garr', 1),
(5, 'Shazzrah', 1),
(6, 'Baron Geddon', 1),
(7, 'Golemagg l\'Incinérateur', 1),
(8, 'Messager de Sulfuron', 1),
(9, 'Majordomo Executus', 1),
(10, 'Ragnaros', 1),
(11, 'Onyxia', 2),
(26, 'Anub\'Rekhan', 3),
(27, 'Grande veuve Faerlina', 3),
(28, 'Maexxna', 3);

-- --------------------------------------------------------

--
-- Structure de la table `character`
--

CREATE TABLE `character` (
  `id` int(11) NOT NULL,
  `name` char(50) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT 0,
  `guild_id` int(11) NOT NULL DEFAULT 0,
  `role_id` int(11) NOT NULL DEFAULT 0,
  `class_id` int(11) NOT NULL DEFAULT 0,
  `faction_id` int(11) NOT NULL DEFAULT 0,
  `server_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `character`
--

INSERT INTO `character` (`id`, `name`, `user_id`, `guild_id`, `role_id`, `class_id`, `faction_id`, `server_id`) VALUES
(1, 'ZugZug', 1, 1, 3, 1, 1, 2),
(2, 'Archange', 1, 2, 2, 3, 2, 1),
(3, 'Bulzator', 2, 1, 1, 1, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `name` char(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `class`
--

INSERT INTO `class` (`id`, `name`) VALUES
(1, 'Guerrier'),
(2, 'Mage'),
(3, 'Prêtre'),
(4, 'Voleur'),
(5, 'Paladin'),
(6, 'Chaman'),
(7, 'Chasseur'),
(8, 'Démoniste'),
(9, 'Druide');

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `name` char(50) NOT NULL DEFAULT '',
  `date` datetime NOT NULL,
  `deadline` datetime NOT NULL,
  `player_count` int(11) NOT NULL DEFAULT 40,
  `auto_bench` int(1) NOT NULL DEFAULT 0,
  `password` char(50) NOT NULL DEFAULT '',
  `guild_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `event_character`
--

CREATE TABLE `event_character` (
  `event_id` int(11) NOT NULL,
  `character_id` int(11) NOT NULL,
  `bench` tinyint(1) NOT NULL,
  `absent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `faction`
--

CREATE TABLE `faction` (
  `id` int(11) NOT NULL,
  `name` char(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `faction`
--

INSERT INTO `faction` (`id`, `name`) VALUES
(1, 'Horde'),
(2, 'Alliance');

-- --------------------------------------------------------

--
-- Structure de la table `gm_user`
--

CREATE TABLE `gm_user` (
  `id` int(11) NOT NULL,
  `name` char(50) NOT NULL DEFAULT '',
  `password` char(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `gm_user`
--

INSERT INTO `gm_user` (`id`, `name`, `password`) VALUES
(1, 'Jean', '1234'),
(2, 'Jacques', '4321');

-- --------------------------------------------------------

--
-- Structure de la table `guild`
--

CREATE TABLE `guild` (
  `id` int(11) NOT NULL,
  `name` char(50) NOT NULL DEFAULT '',
  `faction_id` int(11) NOT NULL,
  `server_id` int(11) NOT NULL,
  `password` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `guild`
--

INSERT INTO `guild` (`id`, `name`, `faction_id`, `server_id`, `password`) VALUES
(1, 'Harde', 1, 2, NULL),
(2, 'Reapers', 2, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `character_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `rarity` char(50) NOT NULL,
  `type` char(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `boss_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`id`, `name`, `rarity`, `type`, `icon`, `boss_id`) VALUES
(1, 'Tome de Tir tranquillisant', 'épique', 'Livre', '', 1),
(2, 'Bottes d\'arcaniste', 'épique', 'Pieds', '', 1),
(3, 'Gants de Gangrecoeur', 'épique', 'Mains', '', 1),
(4, 'Bottes cénariennes', 'épique', 'Pieds', '', 1),
(5, 'Bottes judiciaires', 'épique', 'Pieds', '', 1),
(6, 'Gantelets de puissance', 'épique', 'Mains', '', 1),
(7, 'Collier d\'illumination', 'épique', 'Cou', '', 1),
(8, 'Jambières d\'arcaniste', 'épique', 'Jambes', '', 2),
(9, 'Pantalon de Gangrecoeur', 'épique', 'Jambes', '', 2),
(10, 'Pantalon de prophétie', 'épique', 'Jambes', '', 2),
(11, 'Pantalon du tueur de la nuit', 'épique', 'Jambes', '', 2),
(12, 'Jambières cénariennes', 'épique', 'Jambes', '', 2),
(13, 'Jambières de traqueur de géant', 'épique', 'Jambes', '', 2),
(14, 'Jambières judiciaires', 'épique', 'Jambes', '', 2),
(15, 'Jambières de puissance', 'épique', 'Jambes', '', 2),
(16, 'Médaillon de Puissance inébranlable', 'épique', 'Cou', '', 2),
(17, 'Marque du Frappeur', 'épique', 'À distance', '', 2),
(18, 'Trembleterre', 'épique', 'Deux mains', '', 2),
(19, 'Griffe droite d\'Eskhandar', 'épique', 'Main droite', '', 2),
(20, 'Gants de prophétie', 'épique', 'Mains', '', 3),
(21, 'Gants du tueur de la nuit', 'épique', 'Mains', '', 3),
(22, 'Bottes de traqueur de géant', 'épique', 'Pieds', '', 3),
(23, 'Gantelets judiciaires', 'épique', 'Mains', '', 3),
(24, 'Sandales de puissance', 'épique', 'Pieds', '', 3),
(25, 'Couronne d\'arcaniste', 'épique', 'Tête', '', 4),
(26, 'Cornes de Gangrecoeur', 'épique', 'Tête', '', 4),
(27, 'Collerette de prophétie', 'épique', 'Tête', '', 4),
(28, 'Couvre-chef du tueur de la nuit', 'épique', 'Tête', '', 4),
(29, 'Casque cénarien', 'épique', 'Tête', '', 4),
(30, 'Casque de traqueur de géant', 'épique', 'Tête', '', 4),
(31, 'Heaume judiciaire', 'épique', 'Tête', '', 4),
(32, 'Casque de puissance', 'épique', 'Tête', '', 4),
(33, 'Disque Drillborer', 'épique', 'Bouclier', '', 4),
(34, 'Déchireur de Gutgore', 'épique', 'À une main', '', 4),
(35, 'Marteau d\'Aurastone', 'épique', 'À une main', '', 4),
(36, 'Lame de brutalité', 'épique', 'À une main', '', 4),
(37, 'Gants d\'arcaniste', 'épique', 'Mains', '', 5),
(38, 'Mules de Gangrecoeur', 'épique', 'Pieds', '', 5),
(39, 'Bottes de prophétie', 'épique', 'Pieds', '', 5),
(40, 'Bottes du tueur de la nuit', 'épique', 'Pieds', '', 5),
(41, 'Gants cénariens', 'épique', 'Mains', '', 5),
(42, 'Gants de traqueur de géant', 'épique', 'Mains', '', 5),
(43, 'Mantelet d\'arcaniste', 'épique', 'Épaules', '', 6),
(44, 'Protège-épaules de Gangrecoeur', 'épique', 'Épaules', '', 6),
(45, 'Spallières cénariennes', 'épique', 'Épaules', '', 6),
(46, 'Spallières judiciaires', 'épique', 'Épaules', '', 6),
(47, 'Sceau de l\'archimagus', 'épique', 'Doigt', '', 6),
(48, 'Robe d\'arcaniste', 'épique', 'Torse', '', 7),
(49, 'Robe de Gangrecoeur', 'épique', 'Torse', '', 7),
(50, 'Robe de prophétie', 'épique', 'Torse', '', 7),
(51, 'Plastron du tueur de la nuit', 'épique', 'Torse', '', 7),
(52, 'Habit cénarien', 'épique', 'Torse', '', 7),
(53, 'Cuirasse de traqueur de géant', 'épique', 'Torse', '', 7),
(54, 'Corselet judiciaire', 'épique', 'Torse', '', 7),
(55, 'Cuirasse de puissance', 'épique', 'Torse', '', 7),
(56, 'Lance-grenaille explosif', 'épique', 'À distance', '', 7),
(57, 'Magelame de Chante-azur', 'épique', 'Main droite', '', 7),
(58, 'Bâton de domination', 'épique', 'Deux mains', '', 7),
(59, 'Mantelet de prophétie', 'épique', 'Épaules', '', 8),
(60, 'Protège-épaules du tueur de la nuit', 'épique', 'Épaules', '', 8),
(61, 'Epaulettes de traqueur de géant', 'épique', 'Épaules', '', 8),
(62, 'Espauliers de puissance', 'épique', 'Épaules', '', 8),
(63, 'Frappe-ténèbres', 'épique', 'Deux mains', '', 8),
(64, 'Feuille ancienne pétrifiée', 'épique', 'Quête', '', 9),
(65, 'L\'Oeil de la divinité', 'épique', 'Bijou', '', 9),
(66, 'Gants de la flamme hypnotique', 'épique', 'Mains', '', 9),
(67, 'Anneau de cautérisation', 'épique', 'Doigt', '', 9),
(68, 'Grèves du Coeur du Magma', 'épique', 'Pieds', '', 9),
(69, 'Spallières de croissance sauvage', 'épique', 'Épaules', '', 9),
(70, 'Cape ignifugée', 'épique', 'Dos', '', 9),
(71, 'Drague-lave de Finkle', 'épique', 'Deux mains', '', 9),
(72, 'Dent de chien du magma', 'épique', 'À une main', '', 9),
(73, 'Echarpe des secrets murmurés', 'épique', 'Taille', '', 9),
(74, 'Epaulières de garde du feu', 'épique', 'Épaules', '', 9),
(75, 'Garde-poignets de vrai vol', 'épique', 'Poignets', '', 9),
(76, 'Jambières de Stormrage', 'épique', 'Jambes', '', 10),
(77, 'Pantalon Rougecroc', 'épique', 'Jambes', '', 10),
(78, 'Pantalon de Vent du néant', 'épique', 'Jambes', '', 10),
(79, 'Jambières de transcendance', 'épique', 'Jambes', '', 10),
(80, 'Jambières de Némésis', 'épique', 'Jambes', '', 10),
(81, 'Jambières de traqueur de dragon', 'épique', 'Jambes', '', 10),
(82, 'Jambières du jugement', 'épique', 'Jambes', '', 10),
(83, 'Jambières de courroux', 'épique', 'Jambes', '', 10),
(84, 'Anneau de Précisia', 'épique', 'Doigt', '', 10),
(85, 'Fléau de Bonereaver', 'épique', 'Deux mains', '', 10),
(86, 'Fragment de la Flamme', 'épique', 'Bijou', '', 10),
(87, 'Cape du Voile de brume', 'épique', 'Dos', '', 10),
(88, 'Arrache-moelle', 'épique', 'Deux mains', '', 10),
(89, 'Défenseur de Malistar', 'épique', 'Bouclier', '', 10),
(90, 'Cape sang-de-dragon', 'épique', 'Dos', '', 10),
(91, 'Oeil de Sulfuras', 'légendaire', 'Quête', '', 10),
(92, 'Collier du Seigneur du Feu', 'épique', 'Cou', '', 10),
(93, 'Essence de la Flamme pure', 'épique', 'Bijou', '', 10),
(94, 'Lame de la perdition', 'épique', 'À une main', '', 10),
(95, 'Couronne de destruction', 'épique', 'Tête', '', 10),
(96, 'Ceinturon d\'assaut', 'épique', 'Taille', '', 10),
(97, 'Anneau de Sulfuras', 'épique', 'Doigt', '', 10),
(98, 'Tête d\'Onyxia', 'épique', 'Quête', '', 11),
(99, 'Tendon de dragon noir adulte', 'épique', 'Quête', '', 11),
(100, 'Ancien Grimoire de Cornerstone', 'épique', 'Accessoire pour main gauche', '', 11),
(101, 'Anneau de lien', 'épique', 'Doigt', '', 11),
(102, 'Drapé de Saphiron', 'épique', 'Dos', '', 11),
(103, 'Couronne de Vent du néant', 'épique', 'Tête', '', 11),
(104, 'Crâne de Némésis', 'épique', 'Tête', '', 11),
(105, 'Couvre-chef de Stormrage', 'épique', 'Tête', '', 11),
(106, 'Cagoule Rougecroc', 'épique', 'Tête', '', 11),
(107, 'Casque de traqueur de dragon', 'épique', 'Tête', '', 11),
(108, 'Collier d\'Eskhandar', 'épique', 'Cou', '', 11),
(109, 'Heaume de courroux', 'épique', 'Tête', '', 11),
(110, 'Auréole de transcendance', 'épique', 'Tête', '', 11),
(111, 'Couronne du jugement', 'épique', 'Tête', '', 11),
(112, 'Eclat de l\'Ecaille', 'épique', 'Bijou', '', 11),
(113, 'Porte-mort', 'épique', 'Hache à une main', '', 11),
(114, 'Vis\'kag le Saigneur', 'épique', 'Épée à une main', '', 11),
(115, 'Sac à dos en cuir d\'Onyxia', 'épique', 'Sac', '', 11),
(116, 'Bague des prières inexaucées', 'épique', 'Doigt', '', 26),
(117, 'Larme de givre', 'épique', 'Cou', '', 26),
(118, 'Gemme de Nérubis', 'épique', 'Accessoire pour main gauche', '', 26),
(119, 'Cape en soie de démon des cryptes', 'épique', 'Dos', '', 26),
(120, 'Garde-poignets de vengeance', 'épique', 'Poignets', '', 26),
(121, 'L\'Etreinte de la veuve', 'épique', 'À une main', '', 27),
(122, 'Protège-épaules polaires', 'épique', 'Épaules', '', 27),
(123, 'Remords de la veuve', 'épique', 'À une main', '', 27),
(124, 'Espauliers plaie-de-glace', 'épique', 'Épaules', '', 27),
(125, 'Pendentif de la pierre pernicieuse', 'épique', 'Cou', '', 27),
(126, 'Baiser de l\'araignée', 'épique', 'Bijou', '', 28),
(127, 'Lame en peine', 'épique', 'À une main', '', 28),
(128, 'Pendentif des noms oubliés', 'épique', 'Cou', '', 28),
(129, 'Croc de Maexxna', 'épique', 'À une main', '', 28),
(130, 'Robe de toile cristalline', 'épique', 'Torse', '', 28);

-- --------------------------------------------------------

--
-- Structure de la table `item_character`
--

CREATE TABLE `item_character` (
  `item_id` int(11) NOT NULL,
  `enchant` char(50) DEFAULT '',
  `character_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `item_guild`
--

CREATE TABLE `item_guild` (
  `item_id` int(11) NOT NULL,
  `guild_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `name` char(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `location`
--

INSERT INTO `location` (`id`, `name`) VALUES
(1, 'Coeur du magma'),
(2, 'Repaire d\'Onyxia'),
(3, 'Naxxramas');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Tank'),
(2, 'Healer'),
(3, 'Dps');

-- --------------------------------------------------------

--
-- Structure de la table `server`
--

CREATE TABLE `server` (
  `id` int(11) NOT NULL,
  `name` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `server`
--

INSERT INTO `server` (`id`, `name`) VALUES
(1, 'Amnennar'),
(2, 'Sulfuron');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `boss`
--
ALTER TABLE `boss`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_boss_location` (`location_id`);

--
-- Index pour la table `character`
--
ALTER TABLE `character`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `FK_character_class` (`class_id`),
  ADD KEY `FK_character_faction` (`faction_id`),
  ADD KEY `FK_character_guild` (`guild_id`),
  ADD KEY `FK_character_role` (`role_id`),
  ADD KEY `FK_character_server` (`server_id`),
  ADD KEY `FK_character_user` (`user_id`);

--
-- Index pour la table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_event_guild` (`guild_id`),
  ADD KEY `FK_event_location` (`location_id`);

--
-- Index pour la table `event_character`
--
ALTER TABLE `event_character`
  ADD PRIMARY KEY (`event_id`,`character_id`),
  ADD KEY `FK_event_character_character` (`character_id`);

--
-- Index pour la table `faction`
--
ALTER TABLE `faction`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `gm_user`
--
ALTER TABLE `gm_user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `guild`
--
ALTER TABLE `guild`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `FK_guild_faction` (`faction_id`),
  ADD KEY `FK_guild_server` (`server_id`);

--
-- Index pour la table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_history_event` (`event_id`),
  ADD KEY `FK_history_character` (`character_id`),
  ADD KEY `FK_history_item` (`item_id`);

--
-- Index pour la table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_item_boss` (`boss_id`);

--
-- Index pour la table `item_character`
--
ALTER TABLE `item_character`
  ADD PRIMARY KEY (`item_id`,`character_id`),
  ADD KEY `FK_item_character_character` (`character_id`);

--
-- Index pour la table `item_guild`
--
ALTER TABLE `item_guild`
  ADD PRIMARY KEY (`item_id`,`guild_id`),
  ADD KEY `FK_item_guild_guild` (`guild_id`);

--
-- Index pour la table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `server`
--
ALTER TABLE `server`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `boss`
--
ALTER TABLE `boss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `character`
--
ALTER TABLE `character`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `event_character`
--
ALTER TABLE `event_character`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `faction`
--
ALTER TABLE `faction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `gm_user`
--
ALTER TABLE `gm_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `guild`
--
ALTER TABLE `guild`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT pour la table `item_character`
--
ALTER TABLE `item_character`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `item_guild`
--
ALTER TABLE `item_guild`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `server`
--
ALTER TABLE `server`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `boss`
--
ALTER TABLE `boss`
  ADD CONSTRAINT `FK_boss_location` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`);

--
-- Contraintes pour la table `character`
--
ALTER TABLE `character`
  ADD CONSTRAINT `FK_character_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`),
  ADD CONSTRAINT `FK_character_faction` FOREIGN KEY (`faction_id`) REFERENCES `faction` (`id`),
  ADD CONSTRAINT `FK_character_guild` FOREIGN KEY (`guild_id`) REFERENCES `guild` (`id`),
  ADD CONSTRAINT `FK_character_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`),
  ADD CONSTRAINT `FK_character_server` FOREIGN KEY (`server_id`) REFERENCES `server` (`id`),
  ADD CONSTRAINT `FK_character_user` FOREIGN KEY (`user_id`) REFERENCES `gm_user` (`id`);

--
-- Contraintes pour la table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `FK_event_guild` FOREIGN KEY (`guild_id`) REFERENCES `guild` (`id`),
  ADD CONSTRAINT `FK_event_location` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`);

--
-- Contraintes pour la table `event_character`
--
ALTER TABLE `event_character`
  ADD CONSTRAINT `FK_event_character_character` FOREIGN KEY (`character_id`) REFERENCES `character` (`id`),
  ADD CONSTRAINT `FK_event_character_event` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);

--
-- Contraintes pour la table `guild`
--
ALTER TABLE `guild`
  ADD CONSTRAINT `FK_guild_faction` FOREIGN KEY (`faction_id`) REFERENCES `faction` (`id`),
  ADD CONSTRAINT `FK_guild_server` FOREIGN KEY (`server_id`) REFERENCES `server` (`id`);

--
-- Contraintes pour la table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `FK_history_character` FOREIGN KEY (`character_id`) REFERENCES `character` (`id`),
  ADD CONSTRAINT `FK_history_event` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  ADD CONSTRAINT `FK_history_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`);

--
-- Contraintes pour la table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `FK_item_boss` FOREIGN KEY (`boss_id`) REFERENCES `boss` (`id`);

--
-- Contraintes pour la table `item_character`
--
ALTER TABLE `item_character`
  ADD CONSTRAINT `FK_item_character_character` FOREIGN KEY (`character_id`) REFERENCES `character` (`id`),
  ADD CONSTRAINT `FK_item_character_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`);

--
-- Contraintes pour la table `item_guild`
--
ALTER TABLE `item_guild`
  ADD CONSTRAINT `FK_item_guild_guild` FOREIGN KEY (`guild_id`) REFERENCES `guild` (`id`),
  ADD CONSTRAINT `FK_item_guild_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
