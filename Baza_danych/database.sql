-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 13 Kwi 2015, 18:42
-- Wersja serwera: 5.6.21
-- Wersja PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `database`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `gatunki`
--

CREATE TABLE IF NOT EXISTS `gatunki` (
`id_gatunku` int(11) NOT NULL,
  `nazwa` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `gatunki`
--

INSERT INTO `gatunki` (`id_gatunku`, `nazwa`) VALUES
(1, 'Blues'),
(2, 'Pop'),
(3, 'Rock'),
(4, 'PopRock'),
(5, 'Metal'),
(6, 'Poezja spiewana'),
(7, 'Szanty'),
(8, 'Country'),
(9, 'Jazz'),
(10, 'Synth Pop');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `koncerty`
--

CREATE TABLE IF NOT EXISTS `koncerty` (
`id_koncertu` int(11) NOT NULL,
  `nazwa_zespolu` varchar(30) NOT NULL,
  `logo_zespolu` varchar(30) NOT NULL,
  `gatunek` varchar(30) NOT NULL,
  `nazwa_lokalu` varchar(30) NOT NULL,
  `adres_lokalu` varchar(30) NOT NULL,
  `data_godzina` datetime NOT NULL,
  `cena` float NOT NULL,
  `wiek` varchar(30) NOT NULL,
  `dodatkowe_info` text NOT NULL,
  `id_gatunku` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `koncerty`
--

INSERT INTO `koncerty` (`id_koncertu`, `nazwa_zespolu`, `logo_zespolu`, `gatunek`, `nazwa_lokalu`, `adres_lokalu`, `data_godzina`, `cena`, `wiek`, `dodatkowe_info`, `id_gatunku`) VALUES
(1, 'Zespol1', 'logo1', 'Blues', 'Cotton', 'Politechniki 7', '2015-04-15 20:00:00', 10, 'Brak ograniczen', '', 0),
(2, 'Zespol2', 'Logo2', 'Jazz', 'Futurysta', 'Polietchniki 10', '2015-04-05 21:30:00', 0, 'od 21 lat', 'Pod koniec koncertu bedzie male jam sassion - kazdy chetny, kto wezmie wlasny instrument bedzie mogl dolaczyc do muzykow.', 0),
(3, 'Zespol3', 'Logo3', 'Poezja spiewana', 'Biblioteka', 'Kosciuszki 999', '2015-04-20 20:00:00', 0, 'Brak ograniczen', '', 0),
(4, 'Zespol4', 'Logo4', 'Poprock', 'Stereo Kroggs', 'Zielona 100', '2015-05-01 19:00:00', 20, 'Brak ograniczen', '', 0),
(5, 'Zespol5', 'Logo5', 'Szanty', 'Keja pub', 'Lakowa 18', '2015-05-05 19:00:00', 5, 'od 18 lat', '', 0),
(6, 'Bleble', 'jakies_logo', 'Rock', 'Wytwornia', 'Lakowa 18', '2015-05-01 20:00:00', 0, 'Brak', '', 6);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `gatunki`
--
ALTER TABLE `gatunki`
 ADD PRIMARY KEY (`id_gatunku`);

--
-- Indexes for table `koncerty`
--
ALTER TABLE `koncerty`
 ADD PRIMARY KEY (`id_koncertu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `gatunki`
--
ALTER TABLE `gatunki`
MODIFY `id_gatunku` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT dla tabeli `koncerty`
--
ALTER TABLE `koncerty`
MODIFY `id_koncertu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
