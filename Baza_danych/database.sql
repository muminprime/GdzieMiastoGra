-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Апр 14 2015 г., 01:48
-- Версия сервера: 5.6.21
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `database`
--

-- --------------------------------------------------------

--
-- Структура таблицы `gatunki`
--

CREATE TABLE IF NOT EXISTS `gatunki` (
`id_gatunku` int(11) NOT NULL,
  `nazwa` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `gatunki`
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
-- Структура таблицы `koncerty`
--

CREATE TABLE IF NOT EXISTS `koncerty` (
`id_koncertu` int(11) NOT NULL,
  `data_godzina` datetime NOT NULL,
  `cena` float NOT NULL,
  `wiek` varchar(30) NOT NULL,
  `dodatkowe_info` text NOT NULL,
  `id_gatunku` int(11) NOT NULL,
  `id_lokalu` int(11) NOT NULL,
  `id_zespolu` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `koncerty`
--

INSERT INTO `koncerty` (`id_koncertu`, `data_godzina`, `cena`, `wiek`, `dodatkowe_info`, `id_gatunku`, `id_lokalu`, `id_zespolu`) VALUES
(1, '2015-04-15 20:00:00', 10, 'Brak ograniczen', '', 1, 1, 0),
(2, '2015-04-05 21:30:00', 0, 'od 21 lat', 'Pod koniec koncertu bedzie male jam sassion - kazdy chetny, kto wezmie wlasny instrument bedzie mogl dolaczyc do muzykow.', 9, 1, 0),
(3, '2015-04-20 20:00:00', 0, 'Brak ograniczen', '', 5, 2, 0),
(4, '2015-05-01 19:00:00', 20, 'Brak ograniczen', '', 0, 0, 0),
(5, '2015-05-05 19:00:00', 5, 'od 18 lat', '', 0, 0, 0),
(6, '2015-05-01 20:00:00', 0, 'Brak', '', 6, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `lokale`
--

CREATE TABLE IF NOT EXISTS `lokale` (
`id` int(11) NOT NULL,
  `nazwa` varchar(20) NOT NULL,
  `adress` varchar(20) NOT NULL,
  `godziny` varchar(20) NOT NULL,
  `kontakt` varchar(20) NOT NULL,
  `logo` varchar(20) NOT NULL,
  `ograniczenia` varchar(20) NOT NULL,
  `atrakcje` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `lokale`
--

INSERT INTO `lokale` (`id`, `nazwa`, `adress`, `godziny`, `kontakt`, `logo`, `ograniczenia`, `atrakcje`) VALUES
(1, 'Stereo Krogs', 'Zielona 8', '18:00 - 24:00', '730 868 948', '', 'brak', ''),
(2, 'Szafa', 'Rewolucji 1905r nr 1', '13:00-24:00', '42 630 99 19', '', 'brak', '');

-- --------------------------------------------------------

--
-- Структура таблицы `zespol`
--

CREATE TABLE IF NOT EXISTS `zespol` (
`id` int(11) NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `gatunek` varchar(50) NOT NULL,
  `sklad` varchar(200) NOT NULL,
  `opis` varchar(400) NOT NULL,
  `kontakt` varchar(50) NOT NULL,
  `logo` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `zespol`
--

INSERT INTO `zespol` (`id`, `nazwa`, `gatunek`, `sklad`, `opis`, `kontakt`, `logo`) VALUES
(1, 'Ich Troje', 'pop', 'Michal Wilniewski, Jacek Solywa, Marta Milan', 'Enej to polski zespl z ukrainskimi korzeniami.', '', ''),
(2, 'InoRos', 'folk, folk rock, pop', 'Kamil Kowalcze, Lukasz Bodura, Mateusz Janiczak, Piotr Moskala, Pawel Kowara, Rafal Nowak', 'Zespol powstal w 2006 roku, by tworzyc muzyke zainspirowana folklorem podhalanskim oraz muzyka folkowa z pasma Karpat.', '', ''),
(3, 'Framerowie', 'Muzyka latynoamerykanska', 'Zofia Szumer, Zbigniewa Frankiewicza', 'Framerowie – duet wokalny utworzony przez Zofie Szumer i Zbigniewa Frankiewicza w Lodzi (pseudonim estradowy duetu powstal z ich nazwisk)', '', ''),
(4, 'Atrakcyjny Kazimierz', 'pop, rock', 'pop, rock', 'Atrakcyjny Kazimierz (rowniez Atrakcyjny Kazimierz i Cyganie oraz Atrakcyjny Kazimierz i zespol Wisnie) – polski zespol muzyczny zalozony w 1992 roku w Toruniu przez znanego z wystepow w zespole Kobranocka, torunskiego muzyka Jacka Bryndala.', '', ''),
(5, 'Balkan Electrique', 'pop', 'Violetta Najdenowicz, Slawomir Starosta', 'Balkan Electrique – polska grupa muzyczna grajaca muzyke pop wzbogacona elementami muzyki balkanskiej, byl to duet wokalno-instrumentalny.', '', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `gatunki`
--
ALTER TABLE `gatunki`
 ADD PRIMARY KEY (`id_gatunku`);

--
-- Индексы таблицы `koncerty`
--
ALTER TABLE `koncerty`
 ADD PRIMARY KEY (`id_koncertu`);

--
-- Индексы таблицы `lokale`
--
ALTER TABLE `lokale`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `zespol`
--
ALTER TABLE `zespol`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `gatunki`
--
ALTER TABLE `gatunki`
MODIFY `id_gatunku` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `koncerty`
--
ALTER TABLE `koncerty`
MODIFY `id_koncertu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `lokale`
--
ALTER TABLE `lokale`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `zespol`
--
ALTER TABLE `zespol`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
