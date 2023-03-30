-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 30, 2023 at 07:40 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `instaTrans`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `accountId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `saldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`accountId`, `userId`, `username`, `password`, `saldo`) VALUES
(2, 1, 'lefinek', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
(3, 3, 'brmickosz', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2),
(4, 4, 'klaudys12', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 3),
(5, 5, 'adminek14', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 4),
(6, 6, 'monia87', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 5),
(7, 7, 'wojtas99', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 7),
(8, 8, 'a.woj12', '8cb2237d0679ca88db6464eac60da96345513964', 8),
(9, 9, 'mikiaa87', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 9),
(10, 10, 'ojczulek99', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 10),
(11, 11, 'andrej', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 11),
(12, 12, 'slstrze76', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 12),
(13, 13, 'm.uzix', '8cb2237d0679ca88db6464eac60da96345513964', 13),
(2147483647, 2147483647, 'instaTrans', '7c222fb2927d828af22f592134e8932480637c0d', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` bigint(10) NOT NULL,
  `value` decimal(5,2) NOT NULL,
  `sendDate` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `nameFrom` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `idTo` int(11) NOT NULL,
  `addressFrom` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `addressTo` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `size` varchar(2) COLLATE utf8_polish_ci NOT NULL,
  `deliveryType` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `status` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `value`, `sendDate`, `nameFrom`, `idTo`, `addressFrom`, `addressTo`, `size`, `deliveryType`, `status`) VALUES
(202301997055, '41.44', '2023-02-16', 'FajneKlocki.pl', 2, 'ul. Wolna, 00-100 Warszawa', 'ul. Spacerowa 6, 05-135 Wieliszew', 'XL', 'KE', 'wysłano'),
(202301997056, '23.99', '2023-02-14', 'TwojeEtui.pl', 2, 'ul. Mazowiecka 6, 01-110 Warszawa', 'ul. Spacerowa 6, 05-135 Wieliszew', 'M', 'P', 'opłacono'),
(202301997057, '27.99', '2023-02-15', 'Samoloty.com', 2, 'ul. Zegrzyńska 5, 05-120 Legionowo', 'ul. Spacerowa 6, 05-135 Wieliszew', 'M', 'K', 'do_opłacenia'),
(202301997058, '23.99', '2023-02-17', 'PlanetaZabawek.com', 2, 'ul. Willowa 34, 02-123 Otwock', 'ul. Spacerowa 6, 05-135 Wieliszew', 'S', 'K', 'do_opłacenia'),
(202301997059, '45.99', '2023-02-16', 'DobreButy.pl', 2, 'ul. Spokojna 12, 01-123 Mińsk Mazowiecki', 'ul. Spacerowa 6, 05-135 Wieliszew', 'XL', 'KE', 'do_odebrania'),
(202301997060, '12.99', '2023-02-15', 'Sklep Elektroniczny x-kom', 2, 'ul. Marszałkowska 1, 01-100 Warszawa', 'ul. Spacerowa 6, 05-135 Wieliszew', 'S', 'P', 'opłacono'),
(202301997061, '13.99', '2023-02-16', 'Sklep modowy MODIVO', 2, 'ul. Witecka, 21-412 Gdańsk', 'ul. Spacerowa 6, 05-135 Wieliszew', 'S', 'K', 'opłacono'),
(202301997062, '13.99', '2023-02-16', 'NiezłeSamoloty.pl', 5, 'ul. Łąkowa 12, 02-982 Olsztyn', 'ul. Wolna 99A, 83-001 Kraków', 'S', 'K', 'odebrano'),
(202301997063, '13.99', '2023-02-20', 'FajoweAuta.pl', 2, 'ul. Mickiewicza 12, 01-100 Warszawa', 'ul. Spacerowa 6, 05-135 Wieliszew', 'S', 'P', 'opłacono'),
(202301997066, '29.98', '2023-02-20', 'FajoweAuta.pl', 2, 'ul. Mickiewicza 12, 01-100 Warszawa', 'ul. Spacerowa 6, 05-135 Wieliszew', 'XL', 'K', 'opłacono'),
(202301997067, '24.98', '2023-02-20', 'DobreLapki.pl', 3, 'ul. Kocia 33, 21-321 Szczecin', 'ul. Dobra 123C, 43-534 Legnica', 'M', 'K', 'do_opłacenia'),
(202301997068, '24.98', '2023-02-20', 'DobreLapki.pl', 3, 'ul. Kocia 33, 21-321 Szczecin', 'ul. Dobra 123C, 43-534 Legnica', 'M', 'K', 'do_opłacenia'),
(202301997090, '24.98', '2023-02-20', 'Sławomir Strzelczak', 4, 'ul. Spacerowa 6, 05-135 Wieliszew', 'ul. Świętego Mikołaja 12, 42-222 Konin', 'M', 'K', 'wysłano'),
(202301997091, '18.48', '2023-02-20', 'Jakub Strzelczak', 4, 'ul. Spacerowa 6, 05-135 Wieliszew', 'ul. Najmniejsza 12, 66-223 Morąg', 'S', 'K', 'wysłano'),
(202301997092, '29.98', '2023-02-20', 'Jakub Strzelczak', 4, 'ul. Spacerowa 6, 05-135 Wieliszew', 'ul. Dobrosielska 33A, 92-213 Sandomierz', 'XL', 'K', 'wysłano'),
(202301997093, '29.98', '2023-02-20', 'Jakub Strzelczak', 4, 'ul. Spacerowa 6, 05-135 Wieliszew', 'ul. Dobrosielska 33A, 92-213 Sandomierz', 'XL', 'K', 'wysłano'),
(202301997094, '29.98', '2023-02-20', 'Jakub Strzelczak', 4, 'ul. Spacerowa 6, 05-135 Wieliszew', 'ul. Dobrosielska 33A, 92-213 Sandomierz', 'XL', 'K', 'wysłano'),
(202301997095, '29.48', '2023-02-20', 'Jakub Strzelczak', 6, 'ul. Spacerowa 6, 05-135 Wieliszew', 'ul. Ogrodowa 6, 05-135 Wieliszew', 'M', 'KE', 'wysłano'),
(202301997096, '22.98', '2023-02-20', 'Sławomir Strzelczak', 4, 'ul. Spacerowa 6, 05-135 Wieliszew', 'ul. Magnacka 99, 42-532 Sopot', 'M', 'P', 'wysłano'),
(202301997097, '24.98', '2023-02-20', 'Jakub Strzelczak', 12, 'ul. Spacerowa 6, 05-135 Wieliszew', 'ul. Spacerowa 6, 05-135 Wieliszew', 'M', 'K', 'wysłano'),
(202301997098, '24.98', '2023-02-20', 'Jakub Strzelczak', 12, 'ul. Spacerowa 6, 05-135 Wieliszew', 'ul. Spacerowa 6, 05-135 Wieliszew', 'M', 'K', 'wysłano'),
(202301997099, '24.98', '2023-02-20', 'Jakub Strzelczak', 12, 'ul. Spacerowa 6, 05-135 Wieliszew', 'ul. Spacerowa 6, 05-135 Wieliszew', 'M', 'K', 'wysłano'),
(202301997100, '29.98', '2023-02-20', 'Sławomir Strzelczak', 4, 'isa', 'das', 'XL', 'K', 'wysłano'),
(202301997101, '22.98', '2023-02-20', 'Sławomir Strzelczak', 4, 'ul. Spacerowa 6, 05-135 Wieliszew', 'ul. Ujazdowska 88C, 01-100 Warszawa', 'M', 'P', 'wysłano'),
(202301997102, '22.98', '2023-02-20', 'Jakub Strzelczak', 7, 'jgjyg', 'hjghgj', 'S', 'KE', 'wysłano'),
(202301997103, '24.98', '2023-02-27', 'Maciej Uzar', 2, 'ul. Rowerowa 13, 31-321 Legionowo', 'ul. Spacerowa 6, 05-135 Wieliszew', 'M', 'K', 'wysłano'),
(202301997104, '45.22', '2023-03-01', 'SprzedawcaSuper124.com', 2, 'ul. Odległa 123, 91-421 Ostrów Mazowiecki', 'ul. Spacerowa 6, 05-135 Wieliszew', 'M', 'K', 'opłacono');

-- --------------------------------------------------------

--
-- Table structure for table `saldos`
--

CREATE TABLE `saldos` (
  `saldoId` int(11) NOT NULL,
  `value` decimal(11,2) NOT NULL DEFAULT 0.00,
  `lastUpdated` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `saldos`
--

INSERT INTO `saldos` (`saldoId`, `value`, `lastUpdated`) VALUES
(1, '500.00', '2023-03-07'),
(2, '0.00', '2023-02-17'),
(3, '75.13', '2023-02-17'),
(4, '12.10', '2023-02-17'),
(5, '75.13', '2023-02-17'),
(7, '0.00', '2023-02-17'),
(8, '0.00', '2023-02-17'),
(9, '0.00', '2023-02-17'),
(10, '0.00', '2023-02-18'),
(11, '0.00', '2023-02-18'),
(12, '7.13', '2023-02-20'),
(13, '475.02', '2023-02-20'),
(2147483647, '10686.88', '2023-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `lastName` varchar(30) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `name`, `lastName`) VALUES
(1, 'Jakub', 'Strzelczak'),
(3, 'Bartosz', 'Makulski'),
(4, 'Klaudia', 'Mikołajczyk'),
(5, 'Adam', 'Kowalski'),
(6, 'Monika', 'Dobrosielska'),
(7, 'Wojciech', 'Amanik'),
(8, 'Antek', 'Wojcicki'),
(9, 'Mikołaj', 'Adamski'),
(10, 'Mateusz', 'Ojciec'),
(11, 'Andrzej', 'Wojcicki'),
(12, 'Sławomir', 'Strzelczak'),
(13, 'Maciej', 'Uzar'),
(2147483647, 'instaTrans', 'instaTrans');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`accountId`),
  ADD UNIQUE KEY `userId` (`userId`),
  ADD KEY `FK_PersonOrder` (`saldo`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `FK_AccountOrder` (`idTo`);

--
-- Indexes for table `saldos`
--
ALTER TABLE `saldos`
  ADD PRIMARY KEY (`saldoId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `accountId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202301997105;

--
-- AUTO_INCREMENT for table `saldos`
--
ALTER TABLE `saldos`
  MODIFY `saldoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `FK_AccountUser` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `FK_PersonOrder` FOREIGN KEY (`saldo`) REFERENCES `saldos` (`saldoId`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_AccountOrder` FOREIGN KEY (`idTo`) REFERENCES `accounts` (`accountId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
