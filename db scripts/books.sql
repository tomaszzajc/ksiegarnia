-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 02 Gru 2017, 11:22
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
-- Struktura tabeli dla tabeli `books`
--

CREATE TABLE `books` (
  `bookid` int(11) NOT NULL,
  `seriestitle` tinytext COLLATE utf8_polish_ci NOT NULL,
  `subseriestitle` tinytext COLLATE utf8_polish_ci NOT NULL,
  `volumetitle` tinytext COLLATE utf8_polish_ci NOT NULL,
  `volumeno` tinyint(4) NOT NULL,
  `author` tinytext COLLATE utf8_polish_ci NOT NULL,
  `publisher` tinytext COLLATE utf8_polish_ci NOT NULL,
  `year` year(4) NOT NULL,
  `description` text COLLATE utf8_polish_ci NOT NULL,
  `isbn` bigint(13) UNSIGNED ZEROFILL NOT NULL,
  `price` float NOT NULL,
  `imageurl` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `books`
--

INSERT INTO `books` (`bookid`, `seriestitle`, `subseriestitle`, `volumetitle`, `volumeno`, `author`, `publisher`, `year`, `description`, `isbn`, `price`, `imageurl`) VALUES
(1, 'Batman', 'Nowe DC', 'Trybunał Sów', 1, 'Scott Snyder, Greg Capullo', 'Egmont Polska', 2013, 'W 2011 roku wydawnictwo DC Comics rozpoczęło wydawanie aż pięćdziesięciu dwóch nowych serii komiksowych. Tym samym przygody znanych od dziesięcioleci kultowych postaci komiksu i popkultury zaczęły się oficjalnie od początku. Rewolucyjny zamysł wydawców pozwala wszystkim fanom komiksu poznawać Batmana, Supermana czy członków Ligi Sprawiedliwości bez oglądania się na ich zawiłą przeszłość. Autorzy serii twórczo i ambitnie podeszli do wymagającego tematu, pozostawiając główne rysy osobowości i atrybuty postaci, a jednocześnie rozbudowując ich charakterystyczne światy. W pierwszym tomie zbiorczym nowego Batmana akcja zawiązuje się w oparciu o pewną miejską legendę. Batman nieraz słyszał opowieści o Trybunale Sów rzekomo działającym w Gotham. Jego członkowie uważali się za prawdziwych władców miasta. Podobno spotykali się w ciemnościach, naśladując pohukiwanie nocnego drapieżnika... Dotychczas Mroczny Rycerz nie traktował tych historii poważnie. Odkąd jednak w Gotham zaczął grasować brutalny morderca, likwidujący zarówno najważniejszych, jak i najniebezpieczniejszych mieszkańców miasta, Batman uświadomił sobie, że nie wie o Gotham wszystkiego…', 9788323761440, 7, 'lJSW4GhpqZTb4VdjZA,batman-trybunal-072.jpg'),
(2, 'Batman', 'Nowe DC', 'Miasto Sów', 2, 'Scott Snyder, Greg Capullo', 'Egmont Polska', 2013, 'Przez wiele lat Bruce Wayne był przekonany, że wiara w istnienie Trybunału Sów – tajnej organizacji rządzącej Gotham City – to tylko jedna z miejskich legend. Jednak pewnego dnia wszystko się zmieniło. Podczas spotkania z kandydatem na burmistrza Lincolnem Marchem doszło do zamachu, w wyniku którego Mroczny Rycerz omal nie stracił życia z rąk Szpona, słynnego mordercy Trybunału. Wkrótce Bruce odkrył gniazda Trybunału na tajnych piętrach budynków wzniesionych przez fundację założoną z inicjatywy jego przodka. Niektóre z nich powstały jeszcze w XIX wieku. Podczas śledztwa w jednym z takich miejsc Zamaskowany Krzyżowiec wpadł w pułapkę Szpona. Po morderczej walce zdołał ujść z życiem, lecz Trybunał nie porzucił swoich planów... Wybudził ze śpiączki wszystkie generacje Szponów i nakazał im zajęcie posiadłości Wayne’ów... Zagrożone zostanie wszystko, co ceni sobie Batman – jego tajna tożsamość, dom, jaskinia. Rozegra się bitwa o Gotham City. W trakcie ostatecznej konfrontacji wyjdzie na jaw szokująca nowina dotycząca Bruce’a Wayne’a – czy Batman zdoła unieść jej ciężar? Album jest kontynuacją historii rozpoczętej w tomie Batman. Trybunał Sów. ', 9788323761778, 7, 'lJSW4GhpqZTb4VdjZA,batman-miasto-sow-072.jpg'),
(3, 'Wiedźmin', '', 'Ostatnie życzenie', 1, 'Andrzej Sapkowski', 'SUPERNOWA - Niezależna Oficyna Wydawnicza NOWA', 2014, 'Andrzej Sapkowski, arcymistrz światowej fantasy, zaprasza do swojego Neverlandu i przedstawia uwielbianą przez czytelników i wychwalaną przez krytykę wiedźmińską sagę!\r\n\r\nPóźniej mówiono, że człowiek ów nadszedł od północy, od Bramy Powroźniczej. Nie był stary, ale włosy miał zupełnie białe. Kiedy ściągnął płaszcz, okazało się, że na pasie za plecami ma miecz.\r\nBiałowłosego przywiodło do miasta królewskie orędzie: trzy tysiące orenów nagrody za odczarowanie nękającej mieszkańców Wyzimy strzygi.\r\n \r\nTakie czasy nastały. Dawniej po lasach jeno wilki wyły, teraz namnożyło się rozmaitego paskudztwa – gdzie spojrzysz, tam upiory, bazyliszki, diaboły, żywiołaki, wiły i utopce plugawe. A i niebacznie uwolniony z amfory dżinn, potrafiący zamienić życie spokojnego miasta w koszmar, się trafi.\r\n \r\nTu nie wystarczą zwykłe czary ani osinowe kołki. Tu trzeba zawodowca. \r\nWiedźmina. Mistrza magii i miecza. Tajemną sztuką wyuczonego, by strzec na świecie moralnej i biologicznej równowagi.', 9788375780635, 8, 'wiedzmin-tom-1-ostatnie-zyczenie-b-iext41816720.jpg'),
(6, 'Wiedźmin', '', 'Miecz Przeznaczenia', 2, 'Andrzej Sapkowski', 'SUPERNOWA - Niezależna Oficyna Wydawnicza NOWA', 2014, 'Wiedźmiński kodeks stawia tę sprawę w sposób jednoznaczny: wiedźminowi smoka zabijać się nie godzi.\r\nTo gatunek zagrożony wymarciem. Aczkolwiek w powszechnej opinii to gad najbardziej wredny. Na oszluzgi, widłogony i latawce kodeks polować przyzwala.\r\nAle na smoki – nie.\r\n\r\nWiedźmin Geralt przyłącza się jednak do zorganizowanej przez króla Niedamira wyprawy na smoka, który skrył się w jaskiniach Gór Pustulskich. Na swej drodze spotyka trubadura Jaskra oraz – jakżeby inaczej – czarodziejkę Yennefer. Wśród zaproszonych przez króla co sławniejszych smokobójców jest Eyck z Denesle, rycerz bez skazy i zmazy, Rębacze z Cinfrid i szóstka krasnoludów pod komendą Yarpena Zigrina. Motywacje są różne, ale cel jeden.\r\nSmok nie ma szans.', 9788375780642, 8, 'wiedzmin-tom-2-miecz-przeznaczenia-b-iext44036396.jpg');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`bookid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `books`
--
ALTER TABLE `books`
  MODIFY `bookid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
