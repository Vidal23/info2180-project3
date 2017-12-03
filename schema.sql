CREATE DATABASE IF NOT EXISTS `cheapomail`;

USE `cheapomail`;

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `recipient_ids` int(11) NOT NULL,
  `sender_id` int(10) unsigned NOT NULL,
  `subject` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `date_sent` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `messages_read` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message_id` int(10) unsigned NOT NULL,
  `reader_id` int(10) unsigned NOT NULL,
  `date_read` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_messages_read_messages` (`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`) VALUES
	(1, 'admin', 'istrator', 'admin', '482c811da5d5b4bc6d497ffa98491e38');