-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 03 Gru 2017, 09:25
-- Wersja serwera: 10.1.22-MariaDB
-- Wersja PHP: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `booksdb`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `addresses`
--

CREATE TABLE `addresses` (
  `addressid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `addresstype` tinytext CHARACTER SET utf16 COLLATE utf16_polish_ci NOT NULL,
  `street` tinytext CHARACTER SET utf16 COLLATE utf16_polish_ci NOT NULL,
  `number` tinytext CHARACTER SET utf16 COLLATE utf16_polish_ci NOT NULL,
  `aptno` tinytext CHARACTER SET utf16 COLLATE utf16_polish_ci,
  `zipcode` tinytext CHARACTER SET utf16 COLLATE utf16_polish_ci NOT NULL,
  `city` tinytext CHARACTER SET utf16 COLLATE utf16_polish_ci NOT NULL,
  `country` tinytext CHARACTER SET utf16 COLLATE utf16_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `addresses`
--

INSERT INTO `addresses` (`addressid`, `userid`, `addresstype`, `street`, `number`, `aptno`, `zipcode`, `city`, `country`) VALUES
(2, 2, 'Praca', 'Krawiecka', '3', '3', '52-149', 'Wrocław', 'Polska'),
(3, 0, 'Jacek Wolnicki', 'Semaforowa', '93', '2', '52-115', 'Wrocław', 'Polska'),
(4, 1, 'Jacek Wolnicki', 'Krawiecka', '3', '3', '52-149', 'Wrocław', 'Polska');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`addressid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `addresses`
--
ALTER TABLE `addresses`
  MODIFY `addressid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
