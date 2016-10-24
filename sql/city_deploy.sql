-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas generowania: 24 Paź 2016, 02:08
-- Wersja serwera: 5.5.52-0+deb8u1
-- Wersja PHP: 5.6.26-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `cityd`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `packages`
--

CREATE TABLE IF NOT EXISTS `packages` (
`id` int(6) NOT NULL,
  `senderid` int(11) NOT NULL,
  `start_address` varchar(250) COLLATE utf8_polish_ci NOT NULL,
  `start_city` varchar(75) COLLATE utf8_polish_ci NOT NULL,
  `start_zipcode` varchar(6) COLLATE utf8_polish_ci NOT NULL,
  `start_latlng` varchar(45) COLLATE utf8_polish_ci NOT NULL,
  `receiverid` int(11) NOT NULL,
  `end_address` varchar(250) COLLATE utf8_polish_ci NOT NULL,
  `end_city` varchar(75) COLLATE utf8_polish_ci NOT NULL,
  `end_zipcode` varchar(6) COLLATE utf8_polish_ci NOT NULL,
  `end_latlng` varchar(45) COLLATE utf8_polish_ci NOT NULL,
  `dimensions` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `mass` int(5) NOT NULL,
  `add_time` timestamp NULL DEFAULT NULL,
  `transporterid` int(11) DEFAULT NULL,
  `delivery_confirmation_code` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `delivery_time` timestamp NULL DEFAULT NULL,
  `prefered_send_time` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `packages`
--

INSERT INTO `packages` (`id`, `senderid`, `start_address`, `start_city`, `start_zipcode`, `start_latlng`, `receiverid`, `end_address`, `end_city`, `end_zipcode`, `end_latlng`, `dimensions`, `mass`, `add_time`, `transporterid`, `delivery_confirmation_code`, `delivery_time`, `prefered_send_time`) VALUES
(1, 2, 'Wyszyńskiego 8', 'Pabianice', '', '51.6615154,19.3454454', 0, 'Warszawska 7', '', '', '51.6639293,19.3630008', 'medium', 12, NULL, 0, '', '0000-00-00 00:00:00', 0),
(2, 2, 'Kilińskiego 33', 'Pabianice', '', '51.6605644,19.3518536', 0, 'Zamkowa 31', '', '', '51.6653123,19.348292', 'medium', 12, NULL, 0, '', '0000-00-00 00:00:00', 0),
(3, 2, 'Waryńskiego 15', 'Pabianice', '', '51.6628856,19.3489427', 0, 'Wyszyńskiego 2', '', '', '51.6638844,19.345749', '1', 3, '2016-10-20 10:02:18', 0, '', '0000-00-00 00:00:00', 0),
(4, 2, 'Wyszyńskiego 8', 'Pabianice', '', '51.6615154,19.3454454', 0, 'Warszawska 7', '', '', '51.6639293,19.3630008', 'medium', 12, NULL, 0, '', '0000-00-00 00:00:00', 0),
(5, 2, 'Kilińskiego 33', 'Pabianice', '', '51.6605644,19.3518536', 0, 'Zamkowa 31', '', '', '51.6653123,19.348292', 'medium', 12, NULL, 0, '', '0000-00-00 00:00:00', 0),
(6, 2, 'Waryńskiego 15', 'Pabianice', '', '51.6628856,19.3489427', 0, 'Wyszyńskiego 2', '', '', '51.6638844,19.345749', '1', 3, '2016-10-20 10:02:18', 0, '', '0000-00-00 00:00:00', 0),
(7, 2, 'Wyszyńskiego 8', 'Pabianice', '', '51.6615154,19.3454454', 0, 'Warszawska 7', '', '', '51.6639293,19.3630008', 'medium', 12, NULL, 0, '', '0000-00-00 00:00:00', 0),
(8, 2, 'Kilińskiego 33', 'Pabianice', '', '51.6605644,19.3518536', 0, 'Zamkowa 31', '', '', '51.6653123,19.348292', 'medium', 12, NULL, 0, '', '0000-00-00 00:00:00', 0),
(9, 2, 'Waryńskiego 15', 'Pabianice', '', '51.6628856,19.3489427', 0, 'Wyszyńskiego 2', '', '', '51.6638844,19.345749', '1', 3, '2016-10-20 10:02:18', 0, '', '0000-00-00 00:00:00', 0),
(10, 2, 'Wyszyńskiego 8', 'Pabianice', '', '51.6615154,19.3454454', 0, 'Warszawska 7', '', '', '51.6639293,19.3630008', 'medium', 12, NULL, 0, '', '0000-00-00 00:00:00', 0),
(11, 2, 'Kilińskiego 33', 'Pabianice', '', '51.6605644,19.3518536', 0, 'Zamkowa 31', '', '', '51.6653123,19.348292', 'medium', 12, NULL, 0, '', '0000-00-00 00:00:00', 0),
(12, 2, 'Waryńskiego 15', 'Pabianice', '', '51.6628856,19.3489427', 0, 'Wyszyńskiego 2', '', '', '51.6638844,19.345749', '1', 3, '2016-10-20 10:02:18', 0, '', '0000-00-00 00:00:00', 0),
(13, 2, 'krak', 'niciu', '98-200', '', 2, 'krak1', 'niciu1', '98-220', '', '1x2x3', 4, '2016-10-23 23:30:45', NULL, 'd09dc2abf2d1f305ee002c192dfe74b6', NULL, 0),
(14, 2, 'krak', 'niciu', '98-200', '', 2, 'krak1', 'niciu1', '98-220', '', '1x2x3', 4, '2016-10-23 23:33:34', NULL, '97b8890abf65ee2e2a50b6415153c78a', NULL, 2016),
(15, 2, 'krak', 'niciu', '98-200', '', 2, 'krak1', 'niciu1', '98-220', '', '1x2x3', 4, '2016-10-23 23:35:23', NULL, '460964b0d06498ebc873b8884a339e4e', NULL, 0),
(16, 2, 'krak', 'niciu', '98-200', '', 2, 'krak1', 'niciu1', '98-220', '', '1x2x3', 4, '2016-10-23 23:36:33', NULL, '87a5275e997e41e574efb5ffb96e6b2f', NULL, 0),
(17, 2, 'krak', 'niciu', '98-200', '', 2, 'krak1', 'niciu1', '98-220', '', '1x2x3', 4, '2016-10-23 23:37:44', NULL, '48e086f3b18d0ce65b529a6b4c6bdedd', NULL, 0),
(18, 2, 'krak', 'niciu', '98-200', '', 2, 'krak1', 'niciu1', '98-220', '', '1x2x3', 4, '2016-10-23 23:41:36', NULL, '1df24b0b30b423bdc22eaab2c7e09e82', NULL, 1477264944),
(19, 2, 'Åaska 21', 'ZduÅ„ska Wola', '98-220', '', 2, 'krak1', 'niciu1', '98-220', '', '1x2x3', 4, '2016-10-23 23:49:33', NULL, '4fc1a1d5f74a35ff7b1c7128f1643d67', NULL, 1477264944),
(20, 2, 'Åaska 21', 'ZduÅ„ska Wola', '98-220', '51.6002532,18.9374699', 2, 'krak1', 'niciu1', '98-220', '', '1x2x3', 4, '2016-10-23 23:52:42', NULL, 'd2d441c0d0346240c1e8f47845cfc8cb', NULL, 1477264944),
(21, 2, 'Åaska 21', 'ZduÅ„ska Wola', '98-220', '51.6002532,18.9374699', 2, 'krak1', 'niciu1', '98-220', ',', '1x2x3', 4, '2016-10-23 23:53:21', NULL, '74c3a3c2b8325ab190ab53cfe0aef52c', NULL, 1477264944),
(22, 2, 'Åaska 21', 'ZduÅ„ska Wola', '98-220', '51.6002532,18.9374699', 2, 'WyszyÅ„skiego 8', 'Pabianice', '95-200', '51.6615121,19.3476394', '1x2x3', 4, '2016-10-23 23:53:56', NULL, '9f85190f87b49a9f6f9a7970283b9d82', NULL, 1477264944),
(23, 2, 'Łaska 21', 'Zduńska Wola', '98-220', '51.6002532,18.9374699', 2, 'Wyszyńskiego 8', 'Pabianice', '95-200', '51.6615121,19.3476394', '1x2x3', 4, '2016-10-23 23:56:09', NULL, '564f4cec1b2b7929260b05cfbf97ffe9', NULL, 1477264944);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `login` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `phone`) VALUES
(1, 'kuba', '52061177421e1bde688d03ea8912f00a', '', ''),
(2, 'max', 'cda7ce810c6f6de77392203fce973095', 'noname@wp.pl', '123456789');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
 ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `packages`
--
ALTER TABLE `packages`
MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
