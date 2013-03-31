-- phpMyAdmin SQL Dump
-- version 3.5.2.1
-- http://www.phpmyadmin.net
--
-- Gazda: localhost
-- Timp de generare: 28 Oct 2012 la 09:45
-- Versiune server: 5.5.8
-- Versiune PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza de date: `watchmystuff`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Salvarea datelor din tabel `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `token`) VALUES
(1, 'Alex Tincu', 'alex.tincu@ymail.com', '', '466d9797658a85ed018ff2a6daa6a7f0'),
(2, 'Alex', 'alex.tincu@yahoo.com', 'bf1c2f751f3286030a13fd2fef560069', ''),
(3, 'Alex 2', 'alex.tincu2@ymail.com', 'bf1c2f751f3286030a13fd2fef560069', '');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `user_stuffs`
--

CREATE TABLE IF NOT EXISTS `user_stuffs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` text CHARACTER SET latin1 NOT NULL,
  `text` text CHARACTER SET latin1 NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `tag` text COLLATE utf8_unicode_ci NOT NULL,
  `plaintext` text COLLATE utf8_unicode_ci NOT NULL,
  `tags` text COLLATE utf8_unicode_ci NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_modified` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Salvarea datelor din tabel `user_stuffs`
--

INSERT INTO `user_stuffs` (`id`, `user_id`, `title`, `text`, `url`, `tag`, `plaintext`, `tags`, `created_on`, `time_modified`, `status`) VALUES
(12, 1, '', '', 'http://www.zoso.ro/', 'div#postswrap', 'c9cded53923c13b57fea17062b6b3cfc', '', '2012-10-28 05:13:20', NULL, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
