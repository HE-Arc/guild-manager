-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour lootmasterclassic
CREATE DATABASE IF NOT EXISTS `lootmasterclassic` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `lootmasterclassic`;

-- Listage de la structure de la table lootmasterclassic. boss
CREATE TABLE IF NOT EXISTS `boss` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL DEFAULT '',
  `location_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_boss_location` (`location_id`),
  CONSTRAINT `FK_boss_location` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table lootmasterclassic. character
CREATE TABLE IF NOT EXISTS `character` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `guild_id` int(11) NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL DEFAULT '0',
  `class_id` int(11) NOT NULL DEFAULT '0',
  `faction_id` int(11) NOT NULL DEFAULT '0',
  `server_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `FK_character_class` (`class_id`),
  KEY `FK_character_faction` (`faction_id`),
  KEY `FK_character_guild` (`guild_id`),
  KEY `FK_character_role` (`role_id`),
  KEY `FK_character_server` (`server_id`),
  KEY `FK_character_user` (`user_id`),
  CONSTRAINT `FK_character_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`),
  CONSTRAINT `FK_character_faction` FOREIGN KEY (`faction_id`) REFERENCES `faction` (`id`),
  CONSTRAINT `FK_character_guild` FOREIGN KEY (`guild_id`) REFERENCES `guild` (`id`),
  CONSTRAINT `FK_character_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`),
  CONSTRAINT `FK_character_server` FOREIGN KEY (`server_id`) REFERENCES `server` (`id`),
  CONSTRAINT `FK_character_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table lootmasterclassic. class
CREATE TABLE IF NOT EXISTS `class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table lootmasterclassic. event
CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL DEFAULT '',
  `date` date NOT NULL,
  `password` char(50) NOT NULL DEFAULT '',
  `guild_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_event_guild` (`guild_id`),
  KEY `FK_event_location` (`location_id`),
  CONSTRAINT `FK_event_guild` FOREIGN KEY (`guild_id`) REFERENCES `guild` (`id`),
  CONSTRAINT `FK_event_location` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table lootmasterclassic. event_character
CREATE TABLE IF NOT EXISTS `event_character` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `character_id` int(11) NOT NULL,
  `bench` tinyint(1) NOT NULL,
  `absent` tinyint(1) NOT NULL,
  PRIMARY KEY (`event_id`,`character_id`),
  KEY `FK_event_character_character` (`character_id`),
  CONSTRAINT `FK_event_character_character` FOREIGN KEY (`character_id`) REFERENCES `character` (`id`),
  CONSTRAINT `FK_event_character_event` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table lootmasterclassic. faction
CREATE TABLE IF NOT EXISTS `faction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table lootmasterclassic. guild
CREATE TABLE IF NOT EXISTS `guild` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL DEFAULT '',
  `faction_id` int(11) NOT NULL,
  `server_id` int(11) NOT NULL,
  `password` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `FK_guild_faction` (`faction_id`),
  KEY `FK_guild_server` (`server_id`),
  CONSTRAINT `FK_guild_faction` FOREIGN KEY (`faction_id`) REFERENCES `faction` (`id`),
  CONSTRAINT `FK_guild_server` FOREIGN KEY (`server_id`) REFERENCES `server` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table lootmasterclassic. history
CREATE TABLE IF NOT EXISTS `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `character_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_history_event` (`event_id`),
  KEY `FK_history_character` (`character_id`),
  KEY `FK_history_item` (`item_id`),
  CONSTRAINT `FK_history_character` FOREIGN KEY (`character_id`) REFERENCES `character` (`id`),
  CONSTRAINT `FK_history_event` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  CONSTRAINT `FK_history_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table lootmasterclassic. item
CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `rarity` char(50) NOT NULL,
  `type` char(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `boss_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_item_boss` (`boss_id`),
  CONSTRAINT `FK_item_boss` FOREIGN KEY (`boss_id`) REFERENCES `boss` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table lootmasterclassic. item_character
CREATE TABLE IF NOT EXISTS `item_character` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `enchant` char(50) DEFAULT '',
  `character_id` int(11) NOT NULL,
  PRIMARY KEY (`item_id`,`character_id`),
  KEY `FK_item_character_character` (`character_id`),
  CONSTRAINT `FK_item_character_character` FOREIGN KEY (`character_id`) REFERENCES `character` (`id`),
  CONSTRAINT `FK_item_character_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table lootmasterclassic. item_guild
CREATE TABLE IF NOT EXISTS `item_guild` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `guild_id` int(11) NOT NULL,
  PRIMARY KEY (`item_id`,`guild_id`),
  KEY `FK_item_guild_guild` (`guild_id`),
  CONSTRAINT `FK_item_guild_guild` FOREIGN KEY (`guild_id`) REFERENCES `guild` (`id`),
  CONSTRAINT `FK_item_guild_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table lootmasterclassic. location
CREATE TABLE IF NOT EXISTS `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table lootmasterclassic. role
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table lootmasterclassic. server
CREATE TABLE IF NOT EXISTS `server` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table lootmasterclassic. user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL DEFAULT '',
  `password` char(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Les données exportées n'étaient pas sélectionnées.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
