-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2021 at 07:18 PM
-- Server version: 5.5.62-0+deb8u1
-- PHP Version: 7.2.25-1+0~20191128.32+debian8~1.gbp108445

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `WebDiP2020x119`
--

-- --------------------------------------------------------

--
-- Table structure for table `dnevnik`
--

CREATE TABLE `dnevnik` (
  `dnevnik_id` int(11) NOT NULL,
  `tip_id` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `radnja` text NOT NULL,
  `upit` text,
  `datum_vrijeme` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dnevnik`
--

INSERT INTO `dnevnik` (`dnevnik_id`, `tip_id`, `korisnik_id`, `radnja`, `upit`, `datum_vrijeme`) VALUES
(2, 1, 1, 'Prijava korisnika', NULL, '2021-04-01 00:00:00'),
(3, 1, 3, 'Prijava korisnika u bazu', NULL, '2021-04-01 00:00:00'),
(4, 3, 5, 'Slanje upita bazi.', 'Select * from rodjendan', '2021-03-11 11:25:00'),
(5, 2, 6, 'Odjava korisnika', NULL, '2021-04-01 08:00:00'),
(6, 2, 1, 'Odjava korisnika', NULL, '2021-04-01 08:26:00'),
(7, 4, 4, 'Ostala radnja.', NULL, '2021-04-02 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `grupa`
--

CREATE TABLE `grupa` (
  `grupa_id` int(11) NOT NULL,
  `naziv` varchar(45) NOT NULL,
  `godina` int(11) NOT NULL,
  `opis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grupa`
--

INSERT INTO `grupa` (`grupa_id`, `naziv`, `godina`, `opis`) VALUES
(1, 'Rođendan petogodišnjaka', 5, 'Rođendan za petogodišnjaka.'),
(2, 'Rođendan šestogodišnjaka', 6, 'Rođendan za šestogodišnjaka.'),
(3, 'Rođendan punoljetnika', 18, 'Rođendan za punoljetnika. Alkohol dozvoljen.'),
(4, 'Prvi rođendan', 1, 'Prvi rođendan.'),
(5, 'Rođendan desetogodišnjaka', 10, 'Rođendan za desetogodišnjaka.'),
(6, 'Pedeseti rođendan', 50, 'Pedeseti rođendan.');

-- --------------------------------------------------------

--
-- Table structure for table `grupa_moderator`
--

CREATE TABLE `grupa_moderator` (
  `grupa_id` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grupa_moderator`
--

INSERT INTO `grupa_moderator` (`grupa_id`, `korisnik_id`) VALUES
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `korisnik_id` int(11) NOT NULL,
  `uloga_id` int(11) NOT NULL,
  `ime` varchar(45) NOT NULL,
  `prezime` varchar(45) NOT NULL,
  `korisnicko_ime` varchar(25) NOT NULL,
  `lozinka` varchar(25) NOT NULL,
  `lozinka_sha256` char(64) NOT NULL,
  `email` varchar(45) NOT NULL,
  `uvjeti` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`korisnik_id`, `uloga_id`, `ime`, `prezime`, `korisnicko_ime`, `lozinka`, `lozinka_sha256`, `email`, `uvjeti`, `status`) VALUES
(1, 1, 'Petar', 'Šiljeg', 'piljeg', 'piljeg123', 'b84d577e7c888ba84c1c52cd8197c894ec4e3ea513ae55be2e03d20247d6d2c3', 'petar.siljeg@outlook.com', '2021-04-12 01:00:00', 1),
(2, 2, 'Ante', 'Antić', 'antisha', 'drvenistol22', 'b96c5739100e7b5363fa67712957b9c6f5258eaea75ba5437d7c2a06947cd3c6', 'ante.antic@gmail.com', '2021-04-05 00:00:00', 1),
(3, 3, 'Marko', 'Markić', 'markeroni23', 'marka321', 'c5cf4fe58cc8df27bcac631e3657af7cf3c9497eb109585cd7d6c95351ed777a', 'marko.markic@yahoo.com', '0000-00-00 00:00:00', 1),
(4, 4, 'Toni', 'Tonić', 'tonimakaroni', 'tjestenina99', '878f41d3f04daf2c4fc7e86d6c1a47f298546a857246c94051000754100850a7', 'tonkic.toni22@gmail.com', '2021-04-09 00:00:00', 1),
(5, 2, 'Luka', 'Marković', 'lukaaa', 'vrlojakasifra23', '14bf7cf91c8fc8f9b59aac7368922396eb1209d4e38cd746a6ebc9982b5363cb', 'luka.markovic@hotmail.com', '2021-04-01 00:00:00', 1),
(6, 2, 'Ivana', 'Ivanić', 'ivanka23', 'lozinka34', 'a2f795c9eb92462d43596eb74f229241c6f394b6a6dce3cd391c3b0ece0c51b8', 'ivana.ivanic@gmail.com', '2021-03-04 17:16:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `materijal`
--

CREATE TABLE `materijal` (
  `materijal_id` int(11) NOT NULL,
  `tip_id` int(11) NOT NULL,
  `rodjendan_id` int(11) NOT NULL,
  `opis` text NOT NULL,
  `suglasnost` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `materijal`
--

INSERT INTO `materijal` (`materijal_id`, `tip_id`, `rodjendan_id`, `opis`, `suglasnost`) VALUES
(1, 1, 1, 'Audio snimka', 1),
(2, 1, 3, 'Audio snimka rođendana.', 0),
(3, 3, 5, 'Rođendanska galerija.', 1),
(4, 2, 5, 'Video zapis rođendanske zabave.', 1),
(5, 2, 3, 'Video zapis rođendanske proslave.', 0),
(6, 2, 5, 'Video snimka.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rodjendan`
--

CREATE TABLE `rodjendan` (
  `rodjendan_id` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `grupa_id` int(11) NOT NULL,
  `broj_djece` int(11) NOT NULL,
  `datum` date NOT NULL,
  `vrijeme` time NOT NULL,
  `naziv` varchar(45) DEFAULT NULL,
  `opis` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rodjendan`
--

INSERT INTO `rodjendan` (`rodjendan_id`, `korisnik_id`, `status_id`, `grupa_id`, `broj_djece`, `datum`, `vrijeme`, `naziv`, `opis`) VALUES
(1, 1, 1, 1, 12, '2021-04-05', '09:37:00', NULL, NULL),
(2, 2, 1, 2, 3, '2021-04-01', '16:17:29', NULL, NULL),
(3, 3, 3, 3, 55, '2021-04-01', '15:00:00', NULL, NULL),
(4, 4, 1, 4, 33, '2021-04-01', '17:00:00', NULL, NULL),
(5, 5, 1, 5, 13, '2021-04-11', '23:00:00', NULL, NULL),
(6, 6, 2, 6, 11, '2021-04-01', '05:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `naziv` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `naziv`) VALUES
(1, 'u tijeku'),
(2, 'prihvaćeni'),
(3, 'odbijeni');

-- --------------------------------------------------------

--
-- Table structure for table `tip_dnevnika`
--

CREATE TABLE `tip_dnevnika` (
  `tip_id` int(11) NOT NULL,
  `naziv` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tip_dnevnika`
--

INSERT INTO `tip_dnevnika` (`tip_id`, `naziv`) VALUES
(1, 'prijava'),
(2, 'odjava'),
(3, 'rad s bazom'),
(4, 'ostale radnje');

-- --------------------------------------------------------

--
-- Table structure for table `tip_materijala`
--

CREATE TABLE `tip_materijala` (
  `tip_id` int(11) NOT NULL,
  `naziv` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tip_materijala`
--

INSERT INTO `tip_materijala` (`tip_id`, `naziv`) VALUES
(1, 'audio'),
(2, 'video'),
(3, 'slika');

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `uloga_id` int(11) NOT NULL,
  `naziv` varchar(25) NOT NULL,
  `razina_autorizacije` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`uloga_id`, `naziv`, `razina_autorizacije`) VALUES
(1, 'neregistrirani korisnik', 1),
(2, 'registrirani korisnik', 2),
(3, 'moderator', 3),
(4, 'administrator', 4);

-- --------------------------------------------------------

--
-- Table structure for table `uzvanik`
--

CREATE TABLE `uzvanik` (
  `korisnik_id` int(11) NOT NULL,
  `rodjendan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uzvanik`
--

INSERT INTO `uzvanik` (`korisnik_id`, `rodjendan_id`) VALUES
(1, 1),
(1, 2),
(2, 2),
(2, 4),
(3, 4),
(6, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dnevnik`
--
ALTER TABLE `dnevnik`
  ADD PRIMARY KEY (`dnevnik_id`,`tip_id`,`korisnik_id`),
  ADD KEY `fk_dnevnik_korisnik1_idx` (`korisnik_id`),
  ADD KEY `fk_dnevnik_tip1_idx` (`tip_id`);

--
-- Indexes for table `grupa`
--
ALTER TABLE `grupa`
  ADD PRIMARY KEY (`grupa_id`);

--
-- Indexes for table `grupa_moderator`
--
ALTER TABLE `grupa_moderator`
  ADD PRIMARY KEY (`grupa_id`,`korisnik_id`),
  ADD KEY `fk_grupa_has_korisnik_korisnik1_idx` (`korisnik_id`),
  ADD KEY `fk_grupa_has_korisnik_grupa1_idx` (`grupa_id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`korisnik_id`),
  ADD KEY `fk_korisnik_uloga_idx` (`uloga_id`);

--
-- Indexes for table `materijal`
--
ALTER TABLE `materijal`
  ADD PRIMARY KEY (`materijal_id`),
  ADD KEY `fk_materijali_tip_materijala1_idx` (`tip_id`),
  ADD KEY `fk_materijal_rodjendan1_idx` (`rodjendan_id`);

--
-- Indexes for table `rodjendan`
--
ALTER TABLE `rodjendan`
  ADD PRIMARY KEY (`rodjendan_id`),
  ADD KEY `fk_rezervacija_korisnik1_idx` (`korisnik_id`),
  ADD KEY `fk_rodjendan_status1_idx` (`status_id`),
  ADD KEY `fk_rodjendan_grupa1_idx` (`grupa_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `tip_dnevnika`
--
ALTER TABLE `tip_dnevnika`
  ADD PRIMARY KEY (`tip_id`);

--
-- Indexes for table `tip_materijala`
--
ALTER TABLE `tip_materijala`
  ADD PRIMARY KEY (`tip_id`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`uloga_id`);

--
-- Indexes for table `uzvanik`
--
ALTER TABLE `uzvanik`
  ADD PRIMARY KEY (`korisnik_id`,`rodjendan_id`),
  ADD KEY `fk_rodjendan_has_korisnik_korisnik1_idx` (`korisnik_id`),
  ADD KEY `fk_rodjendan_has_korisnik_rodjendan1_idx` (`rodjendan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dnevnik`
--
ALTER TABLE `dnevnik`
  MODIFY `dnevnik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `grupa`
--
ALTER TABLE `grupa`
  MODIFY `grupa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `korisnik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `materijal`
--
ALTER TABLE `materijal`
  MODIFY `materijal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `rodjendan`
--
ALTER TABLE `rodjendan`
  MODIFY `rodjendan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tip_dnevnika`
--
ALTER TABLE `tip_dnevnika`
  MODIFY `tip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tip_materijala`
--
ALTER TABLE `tip_materijala`
  MODIFY `tip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `uloga_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `dnevnik`
--
ALTER TABLE `dnevnik`
  ADD CONSTRAINT `fk_dnevnik_korisnik1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`korisnik_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dnevnik_tip1` FOREIGN KEY (`tip_id`) REFERENCES `tip_dnevnika` (`tip_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `grupa_moderator`
--
ALTER TABLE `grupa_moderator`
  ADD CONSTRAINT `fk_grupa_has_korisnik_grupa1` FOREIGN KEY (`grupa_id`) REFERENCES `grupa` (`grupa_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_grupa_has_korisnik_korisnik1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`korisnik_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `fk_korisnik_uloga` FOREIGN KEY (`uloga_id`) REFERENCES `uloga` (`uloga_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `materijal`
--
ALTER TABLE `materijal`
  ADD CONSTRAINT `fk_materijali_tip_materijala1` FOREIGN KEY (`tip_id`) REFERENCES `tip_materijala` (`tip_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_materijal_rodjendan1` FOREIGN KEY (`rodjendan_id`) REFERENCES `rodjendan` (`rodjendan_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rodjendan`
--
ALTER TABLE `rodjendan`
  ADD CONSTRAINT `fk_rezervacija_korisnik1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`korisnik_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rodjendan_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rodjendan_grupa1` FOREIGN KEY (`grupa_id`) REFERENCES `grupa` (`grupa_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `uzvanik`
--
ALTER TABLE `uzvanik`
  ADD CONSTRAINT `fk_rodjendan_has_korisnik_rodjendan1` FOREIGN KEY (`rodjendan_id`) REFERENCES `rodjendan` (`rodjendan_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rodjendan_has_korisnik_korisnik1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`korisnik_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
