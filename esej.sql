-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2020 at 12:55 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esej`
--

-- --------------------------------------------------------

--
-- Table structure for table `predmet`
--

CREATE TABLE `predmet` (
  `idPredmet` int(11) NOT NULL,
  `nazivPredmeta` varchar(60) NOT NULL,
  `idProfesor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `predmet`
--

INSERT INTO `predmet` (`idPredmet`, `nazivPredmeta`, `idProfesor`) VALUES
(1, 'UIS', 1),
(2, 'ITEH', 2),
(3, 'POIS', 1),
(4, 'Projektovanje Softvera', 1);

-- --------------------------------------------------------

--
-- Table structure for table `profesor`
--

CREATE TABLE `profesor` (
  `idProfesor` int(11) NOT NULL,
  `ime` varchar(64) CHARACTER SET utf16 COLLATE utf16_croatian_ci DEFAULT NULL,
  `prezime` varchar(64) CHARACTER SET utf16 COLLATE utf16_croatian_ci DEFAULT NULL,
  `username` varchar(64) CHARACTER SET utf16 COLLATE utf16_croatian_ci DEFAULT NULL,
  `katedra` varchar(64) CHARACTER SET utf16 COLLATE utf16_croatian_ci DEFAULT NULL,
  `password` varchar(64) CHARACTER SET utf16 COLLATE utf16_croatian_ci DEFAULT NULL,
  `slikaProf` longblob,
  `emailProf` varchar(64) COLLATE utf8_croatian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `profesor`
--

INSERT INTO `profesor` (`idProfesor`, `ime`, `prezime`, `username`, `katedra`, `password`, `slikaProf`, `emailProf`) VALUES
(1, 'Veljko', 'Veljkovic', 'veljko', 'veljko', '123', NULL, 'profa@gmail.com'),
(2, 'Milan', 'Milanovic', 'miki', 'Elab', '123', NULL, 'nekiMail\"gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `seminarski`
--

CREATE TABLE `seminarski` (
  `idSeminarski` int(64) NOT NULL,
  `idProfesor` int(64) NOT NULL,
  `idStudent` int(11) NOT NULL,
  `datumOdbrane` date DEFAULT NULL,
  `idPredmet` int(11) DEFAULT NULL,
  `azuriran` varchar(2) COLLATE utf16_croatian_ci NOT NULL DEFAULT 'ne',
  `vremeOdbrane` varchar(50) COLLATE utf16_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_croatian_ci;

--
-- Dumping data for table `seminarski`
--

INSERT INTO `seminarski` (`idSeminarski`, `idProfesor`, `idStudent`, `datumOdbrane`, `idPredmet`, `azuriran`, `vremeOdbrane`) VALUES
(1, 1, 1, '2020-05-29', 1, 'ne', 'ponedeljak, 10 ujutru'),
(3, 1, 1, '2020-05-28', 3, 'ne', '12:30');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `idStudent` int(11) NOT NULL,
  `idProfesor` int(11) NOT NULL DEFAULT '1',
  `ime` varchar(64) COLLATE utf16_croatian_ci NOT NULL,
  `prezime` varchar(64) COLLATE utf16_croatian_ci NOT NULL,
  `email` varchar(64) COLLATE utf16_croatian_ci NOT NULL,
  `password` varchar(64) COLLATE utf16_croatian_ci NOT NULL,
  `brojIndexa` varchar(64) COLLATE utf16_croatian_ci NOT NULL,
  `username` varchar(64) COLLATE utf16_croatian_ci NOT NULL,
  `slikaStudenta` longblob
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_croatian_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`idStudent`, `idProfesor`, `ime`, `prezime`, `email`, `password`, `brojIndexa`, `username`, `slikaStudenta`) VALUES
(1, 1, 'Marija', 'Maric', 'maki123@gmail.com', '123', '123/22', 'maki', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `predmet`
--
ALTER TABLE `predmet`
  ADD PRIMARY KEY (`idPredmet`);

--
-- Indexes for table `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`idProfesor`);

--
-- Indexes for table `seminarski`
--
ALTER TABLE `seminarski`
  ADD PRIMARY KEY (`idSeminarski`),
  ADD KEY `idProfesor` (`idProfesor`,`idStudent`),
  ADD KEY `idStudent` (`idStudent`),
  ADD KEY `idPredmet` (`idPredmet`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`idStudent`),
  ADD KEY `idProfesor` (`idProfesor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `predmet`
--
ALTER TABLE `predmet`
  MODIFY `idPredmet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `profesor`
--
ALTER TABLE `profesor`
  MODIFY `idProfesor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `seminarski`
--
ALTER TABLE `seminarski`
  MODIFY `idSeminarski` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `idStudent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `seminarski`
--
ALTER TABLE `seminarski`
  ADD CONSTRAINT `seminarski_ibfk_1` FOREIGN KEY (`idProfesor`) REFERENCES `profesor` (`idProfesor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seminarski_ibfk_2` FOREIGN KEY (`idStudent`) REFERENCES `student` (`idStudent`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`idProfesor`) REFERENCES `profesor` (`idProfesor`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
