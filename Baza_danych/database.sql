-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 11 Maj 2015, 23:49
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
  `id` int(11) NOT NULL,
  `nazwa` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `gatunki`
--

INSERT INTO `gatunki` (`id`, `nazwa`) VALUES
(0, ' '),
(1, 'Blues'),
(2, 'Pop'),
(3, 'Rock'),
(4, 'PopRock'),
(5, 'Metal'),
(6, 'Poezja spiewana'),
(7, 'Szanty'),
(8, 'Country'),
(9, 'Jazz'),
(10, 'Synth Pop'),
(11, 'Folk');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `koncerty`
--

CREATE TABLE IF NOT EXISTS `koncerty` (
  `id` int(11) NOT NULL,
  `data_godzina` datetime NOT NULL,
  `cena` float NOT NULL,
  `wiek` varchar(30) NOT NULL,
  `dodatkowe_info` text NOT NULL,
  `zespoly_id` int(11) NOT NULL,
  `lokale_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `koncerty`
--

INSERT INTO `koncerty` (`id`, `data_godzina`, `cena`, `wiek`, `dodatkowe_info`, `zespoly_id`, `lokale_id`) VALUES
(1, '2015-04-15 20:00:00', 10, 'Brak', '', 1, 3),
(2, '2015-04-05 21:30:00', 0, 'od 21 lat', 'Pod koniec koncertu bedzie male jam sassion - kazdy chetny, kto wezmie wlasny instrument bedzie mogl dolaczyc do muzykow.', 1, 4),
(3, '2015-04-20 20:00:00', 0, 'Brak', '', 3, 2),
(4, '2015-05-01 19:00:00', 20, 'Brak', '', 5, 1),
(5, '2015-05-05 19:00:00', 5, 'od 18 lat', '', 4, 4),
(6, '2015-05-01 20:00:00', 0, 'Brak', '', 2, 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kontakty`
--

CREATE TABLE IF NOT EXISTS `kontakty` (
`id` int(11) NOT NULL,
  `telefon` varchar(45) NOT NULL DEFAULT '000 000 000',
  `e-mail` varchar(45) NOT NULL DEFAULT 'Nie podano e-maila',
  `www` varchar(45) NOT NULL DEFAULT 'Nie podano adresu www',
  `facebook` varchar(45) DEFAULT 'brak'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `kontakty`
--

INSERT INTO `kontakty` (`id`, `telefon`, `e-mail`, `www`, `facebook`) VALUES
(1, '691 376 649', 'Nie podano e-maila', 'Nie podano adresu www', 'brak'),
(2, '42 630 99 19', 'Nie podano e-maila', 'Nie podano adresu www', 'brak'),
(3, '609 152 420', 'Nie podano e-maila', 'Nie podano adresu www', 'brak'),
(4, '691 376 649', 'Nie podano e-maila', 'Nie podano adresu www', 'brak');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lokale`
--

CREATE TABLE IF NOT EXISTS `lokale` (
`id` int(11) NOT NULL,
  `nazwa` varchar(30) NOT NULL,
  `adres` varchar(30) NOT NULL,
  `godziny` varchar(20) NOT NULL,
  `logo` varchar(20) NOT NULL,
  `ograniczenia` varchar(20) NOT NULL,
  `atrakcje` varchar(20) NOT NULL,
  `kontakty_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `lokale`
--

INSERT INTO `lokale` (`id`, `nazwa`, `adres`, `godziny`, `logo`, `ograniczenia`, `atrakcje`, `kontakty_id`) VALUES
(1, 'Stereo Krogs', 'Zielona 8', '18:00 - 24:00', '', 'brak', '', 0),
(2, 'Szafa', 'Rewolucji 1905r nr 10', '13:00 - 24:00', '', 'brak', '', 0),
(3, 'Keja pub', 'Kopernika 46', '16:00 - do ostatnieg', '', 'brak', '', 0),
(4, 'Tektura', 'Tymienieckiego 3', '09:00 - 23:00', '', 'brak', '', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zespoly`
--

CREATE TABLE IF NOT EXISTS `zespoly` (
`id` int(11) NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `sklad` varchar(200) NOT NULL,
  `opis` varchar(400) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `kontakty_id` int(11) NOT NULL,
  `gatunki_id1` int(11) NOT NULL,
  `gatunki_id2` int(11) DEFAULT '0',
  `gatunki_id3` int(11) DEFAULT '0',
  `gatunki` varchar(100) DEFAULT 'brak' COMMENT 'To pole zostawiamy puste. Jest nam potrzebne do zebrania ewentualnych trzech wybranych gatunków w jednym rekordzie, co dzieje się w kodzie php podczas wyświetlania.'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `zespoly`
--

INSERT INTO `zespoly` (`id`, `nazwa`, `sklad`, `opis`, `logo`, `kontakty_id`, `gatunki_id1`, `gatunki_id2`, `gatunki_id3`, `gatunki`) VALUES
(1, 'Ich Troje', 'Michal Wilniewski, Jacek Solywa, Marta Milan', 'Enej to polski zespl z ukrainskimi korzeniami.', '', 0, 2, 0, 1, ' Blues, Pop'),
(2, 'InoRos', 'Kamil Kowalcze, Lukasz Bodura, Mateusz Janiczak, Piotr Moskala, Pawel Kowara, Rafal Nowak', 'Zespol powstal w 2006 roku, by tworzyc muzyke zainspirowana folklorem podhalanskim oraz muzyka folkowa z pasma Karpat.', '', 0, 11, 0, 0, ' Folk'),
(3, 'Framerowie', 'Zofia Szumer, Zbigniewa Frankiewicza', 'Framerowie – duet wokalny utworzony przez Zofie Szumer i Zbigniewa Frankiewicza w Lodzi (pseudonim estradowy duetu powstal z ich nazwisk)', '', 0, 4, 0, 0, ' PopRock'),
(4, 'Atrakcyjny Kazimierz', 'Jacek Bryndal', 'Atrakcyjny Kazimierz (rowniez Atrakcyjny Kazimierz i Cyganie oraz Atrakcyjny Kazimierz i zespol Wisnie) – polski zespol muzyczny zalozony w 1992 roku w Toruniu przez znanego z wystepow w zespole Kobranocka, torunskiego muzyka Jacka Bryndala.', '', 0, 6, 0, 0, ' Poezja spiewana'),
(5, 'Balkan Electrique', 'Violetta Najdenowicz, Slawomir Starosta', 'Balkan Electrique – polska grupa muzyczna grajaca muzyke pop wzbogacona elementami muzyki balkanskiej, byl to duet wokalno-instrumentalny.', '', 0, 2, 0, 0, ' Pop');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `gatunki`
--
ALTER TABLE `gatunki`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `koncerty`
--
ALTER TABLE `koncerty`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_koncerty_lokale1_idx` (`lokale_id`), ADD KEY `fk_koncerty_zespoly1_idx` (`zespoly_id`);

--
-- Indexes for table `kontakty`
--
ALTER TABLE `kontakty`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokale`
--
ALTER TABLE `lokale`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_lokale_kontakty1_idx` (`kontakty_id`);

--
-- Indexes for table `zespoly`
--
ALTER TABLE `zespoly`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_zespoly_gatunki_idx` (`gatunki_id1`), ADD KEY `fk_zespoly_kontakty1_idx` (`kontakty_id`), ADD KEY `fk_zespoly_gatunki2_idx` (`gatunki_id2`), ADD KEY `fk_zespoly_gatunki3_idx` (`gatunki_id3`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `kontakty`
--
ALTER TABLE `kontakty`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `lokale`
--
ALTER TABLE `lokale`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `zespoly`
--
ALTER TABLE `zespoly`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `koncerty`
--
ALTER TABLE `koncerty`
ADD CONSTRAINT `fk_koncerty_lokale1` FOREIGN KEY (`lokale_id`) REFERENCES `lokale` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_koncerty_zespoly1` FOREIGN KEY (`zespoly_id`) REFERENCES `zespoly` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `lokale`
--
ALTER TABLE `lokale`
ADD CONSTRAINT `fk_lokale_kontakty1` FOREIGN KEY (`kontakty_id`) REFERENCES `kontakty` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `zespoly`
--
ALTER TABLE `zespoly`
ADD CONSTRAINT `fk_zespoly_gatunki1` FOREIGN KEY (`gatunki_id1`) REFERENCES `gatunki` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_zespoly_gatunki2` FOREIGN KEY (`gatunki_id2`) REFERENCES `gatunki` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_zespoly_gatunki3` FOREIGN KEY (`gatunki_id3`) REFERENCES `gatunki` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_zespoly_kontakty1` FOREIGN KEY (`kontakty_id`) REFERENCES `kontakty` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
