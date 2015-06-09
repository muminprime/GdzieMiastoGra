-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 09 Cze 2015, 12:04
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

DELIMITER $$
--
-- Procedury
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `dodaj_kolumne`( IN tabela VARCHAR(30),  IN kolumna VARCHAR(30))
BEGIN
IF NOT EXISTS( (SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA=DATABASE()
        AND COLUMN_NAME=kolumna AND TABLE_NAME=tabela) )
THEN
SET @sql = CONCAT('ALTER TABLE `database`.',tabela,' ADD COLUMN ',kolumna,' INT NULL DEFAULT 0;'); 
    PREPARE s1 from @sql;
    EXECUTE s1;
#EXECUTE IMMEDIATE CONCAT('ALTER TABLE `database`.',tabela,' ADD COLUMN ',kolumna,' INT NULL DEFAULT 0');
#ALTER TABLE `database`.ulubione_gatunki
#ADD COLUMN kolumna INT NULL DEFAULT 0;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc`()
BEGIN
IF NOT EXISTS( (SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA=DATABASE()
        AND COLUMN_NAME='gat1' AND TABLE_NAME='ulubione_gatunki') )
THEN
ALTER TABLE `database`.`ulubione_gatunki` 
ADD COLUMN `gat1` INT NULL DEFAULT 0;
END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dane_uzytkownika`
--

CREATE TABLE IF NOT EXISTS `dane_uzytkownika` (
`id` int(11) NOT NULL,
  `imie` varchar(40) DEFAULT NULL,
  `nazwisko` varchar(45) DEFAULT NULL,
  `data_urodzenia` date NOT NULL,
  `ulubione_gatunki_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `dane_uzytkownika`
--

INSERT INTO `dane_uzytkownika` (`id`, `imie`, `nazwisko`, `data_urodzenia`, `ulubione_gatunki_id`) VALUES
(3, NULL, NULL, '2015-06-11', 15),
(4, NULL, NULL, '1998-01-28', 16);

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
-- Struktura tabeli dla tabeli `ulubione_gatunki`
--

CREATE TABLE IF NOT EXISTS `ulubione_gatunki` (
`id` int(11) NOT NULL,
  `gat1` int(11) DEFAULT '0',
  `gat2` int(11) DEFAULT '0',
  `gat3` int(11) DEFAULT '0',
  `gat4` int(11) DEFAULT '0',
  `gat5` int(11) DEFAULT '0',
  `gat6` int(11) DEFAULT '0',
  `gat7` int(11) DEFAULT '0',
  `gat8` int(11) DEFAULT '0',
  `gat9` int(11) DEFAULT '0',
  `gat10` int(11) DEFAULT '0',
  `gat11` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `ulubione_gatunki`
--

INSERT INTO `ulubione_gatunki` (`id`, `gat1`, `gat2`, `gat3`, `gat4`, `gat5`, `gat6`, `gat7`, `gat8`, `gat9`, `gat10`, `gat11`) VALUES
(15, 1, 6, 11, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 1, 5, 6, 10, 11, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE IF NOT EXISTS `uzytkownicy` (
  `login` varchar(45) NOT NULL,
  `haslo` varchar(45) NOT NULL,
  `zespoly_id` int(11) DEFAULT NULL COMMENT 'W tej kolumnie będzie można umieścić id zespołu, jeśli konto użytkownika jest kontem zespołu. Dzięki temu będzie można korzystać z danych zespołu. Jeśli będzie wartość null, to znaczy, że dany użytkownik nie jest zespołem. W tym polu nie chodzi o to, że np dany użytkownik jest członkiem zespołu, tylko że jest to użytkownik typu "zespół"!\nTrzeba tylko będzie to jakoś weryfikować podczas tworzenia konta.',
  `lokale_id` int(11) DEFAULT NULL COMMENT 'analogicznie jak zespoly_id',
  `email` varchar(45) NOT NULL COMMENT 'potrzebny do weryfikacji konta itp, nie mylić go z emailem zawartym w tabeli "kontakty" - tam są kontakty przeznaczone do upublicznienia, ten tutaj jest tylko dla admina strony',
  `dane_uzytkownika_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`login`, `haslo`, `zespoly_id`, `lokale_id`, `email`, `dane_uzytkownika_id`) VALUES
('ekwlazlo', 'Zaq12wsx!', NULL, NULL, 'jakismail@op.pl', 4),
('framerowie666', 'haslo', 3, NULL, 'email', NULL),
('ichtroje', 'haslo', 1, NULL, 'jakisemail@jakasdomena.com', NULL),
('Janeks', 'Janek2@@', NULL, NULL, 'skowalski@o2.pl', 3);

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
  `gatunki_id2` int(11) DEFAULT NULL,
  `gatunki_id3` int(11) DEFAULT NULL,
  `gatunki` varchar(100) DEFAULT 'brak' COMMENT 'To pole zostawiamy puste. Jest nam potrzebne do zebrania ewentualnych trzech wybranych gatunków w jednym rekordzie, co dzieje się w kodzie php podczas wyświetlania.'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `zespoly`
--

INSERT INTO `zespoly` (`id`, `nazwa`, `sklad`, `opis`, `logo`, `kontakty_id`, `gatunki_id1`, `gatunki_id2`, `gatunki_id3`, `gatunki`) VALUES
(1, 'Ich Troje', 'Michal Wilniewski, Jacek Solywa, Marta Milan', 'Enej to polski zespl z ukrainskimi korzeniami.', '', 0, 2, 8, 1, 'Blues, Pop, Country'),
(2, 'InoRos', 'Kamil Kowalcze, Lukasz Bodura, Mateusz Janiczak, Piotr Moskala, Pawel Kowara, Rafal Nowak', 'Zespol powstal w 2006 roku, by tworzyc muzyke zainspirowana folklorem podhalanskim oraz muzyka folkowa z pasma Karpat.', '', 0, 11, 0, 0, 'Folk'),
(3, 'Framerowie', 'Zofia Szumer, Zbigniewa Frankiewicza', 'Framerowie – duet wokalny utworzony przez Zofie Szumer i Zbigniewa Frankiewicza w Lodzi (pseudonim estradowy duetu powstal z ich nazwisk)', '', 0, 4, 0, 0, 'PopRock'),
(4, 'Atrakcyjny Kazimierz', 'Jacek Bryndal', 'Atrakcyjny Kazimierz (rowniez Atrakcyjny Kazimierz i Cyganie oraz Atrakcyjny Kazimierz i zespol Wisnie) – polski zespol muzyczny zalozony w 1992 roku w Toruniu przez znanego z wystepow w zespole Kobranocka, torunskiego muzyka Jacka Bryndala.', '', 0, 9, 0, 0, 'Jazz'),
(5, 'Balkan Electrique', 'Violetta Najdenowicz, Slawomir Starosta', 'Balkan Electrique – polska grupa muzyczna grajaca muzyke pop wzbogacona elementami muzyki balkanskiej, byl to duet wokalno-instrumentalny.', '', 0, 3, 0, 0, 'Rock');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `dane_uzytkownika`
--
ALTER TABLE `dane_uzytkownika`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_dane_uzytkownika_ulubione_gatunki1_idx` (`ulubione_gatunki_id`);

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
-- Indexes for table `ulubione_gatunki`
--
ALTER TABLE `ulubione_gatunki`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
 ADD PRIMARY KEY (`login`), ADD KEY `fk_uzytkownicy_zespoly1_idx` (`zespoly_id`), ADD KEY `fk_uzytkownicy_lokale1_idx` (`lokale_id`), ADD KEY `fk_uzytkownicy_dane_uzytkownika1_idx` (`dane_uzytkownika_id`);

--
-- Indexes for table `zespoly`
--
ALTER TABLE `zespoly`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_zespoly_gatunki_idx` (`gatunki_id1`), ADD KEY `fk_zespoly_kontakty1_idx` (`kontakty_id`), ADD KEY `fk_zespoly_gatunki2_idx` (`gatunki_id2`), ADD KEY `fk_zespoly_gatunki3_idx` (`gatunki_id3`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `dane_uzytkownika`
--
ALTER TABLE `dane_uzytkownika`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
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
-- AUTO_INCREMENT dla tabeli `ulubione_gatunki`
--
ALTER TABLE `ulubione_gatunki`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT dla tabeli `zespoly`
--
ALTER TABLE `zespoly`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `dane_uzytkownika`
--
ALTER TABLE `dane_uzytkownika`
ADD CONSTRAINT `fk_dane_uzytkownika_ulubione_gatunki1` FOREIGN KEY (`ulubione_gatunki_id`) REFERENCES `ulubione_gatunki` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Ograniczenia dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
ADD CONSTRAINT `fk_uzytkownicy_dane_uzytkownika1` FOREIGN KEY (`dane_uzytkownika_id`) REFERENCES `dane_uzytkownika` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_uzytkownicy_lokale1` FOREIGN KEY (`lokale_id`) REFERENCES `lokale` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_uzytkownicy_zespoly1` FOREIGN KEY (`zespoly_id`) REFERENCES `zespoly` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
