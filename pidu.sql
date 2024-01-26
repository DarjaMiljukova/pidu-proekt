-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Loomise aeg: Jaan 26, 2024 kell 11:22 EL
-- Serveri versioon: 10.4.27-MariaDB
-- PHP versioon: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Andmebaas: `darja`
--

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `pidu`
--

CREATE TABLE `pidu` (
  `Id` int(11) NOT NULL,
  `Tuup` text NOT NULL,
  `PiduNimi` text DEFAULT NULL,
  `Aeg` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Andmete tõmmistamine tabelile `pidu`
--

INSERT INTO `pidu` (`Id`, `Tuup`, `PiduNimi`, `Aeg`) VALUES
(1, 'Kontsert', 'Rokk-kontsert', '2024-01-30');

--
-- Indeksid tõmmistatud tabelitele
--

--
-- Indeksid tabelile `pidu`
--
ALTER TABLE `pidu`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT tõmmistatud tabelitele
--

--
-- AUTO_INCREMENT tabelile `pidu`
--
ALTER TABLE `pidu`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
