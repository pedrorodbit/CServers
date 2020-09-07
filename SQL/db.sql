SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `steam_id` varchar(32) NOT NULL,
  `steam_name` varchar(32) NOT NULL,
  `token` char(40) NOT NULL,
  `country` char(2) NOT NULL,
  `last_login` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  KEY `users` (`steam_id`,`steam_name`,`token`,`country`,`last_login`,`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `servers` (
  `id` int(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `owner_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(16) NOT NULL,
  `ip` varchar(45) NOT NULL,
  `port` int(11) NOT NULL,
  `rcon_pass` varchar(64) NOT NULL,
  KEY `servers` (`name`,`ip`,`port`,`rcon_pass`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
