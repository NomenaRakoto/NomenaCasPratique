-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 19, 2017 at 07:49 AM
-- Server version: 10.1.20-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id2826919_hcoannuaire`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `libelle` varchar(100) CHARACTER SET utf8 NOT NULL,
  `id_pere` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `libelle`, `id_pere`) VALUES
(89, 'High tech', 104),
(90, 'Smartphone', 89),
(91, 'Ordinateur', 89),
(92, 'Samsung', 90),
(93, 'htc', 90),
(94, 'iPhone', 90),
(96, 'Laptop', 91),
(97, 'Série S', 92),
(98, 'Série J', 92),
(102, 'Desktop', 91),
(103, 'Gameur', 96),
(104, 'Tous', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categorie_fiche`
--

CREATE TABLE `categorie_fiche` (
  `id_fiche` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categorie_fiche`
--

INSERT INTO `categorie_fiche` (`id_fiche`, `id_categorie`) VALUES
(26, 90),
(26, 92),
(27, 90),
(27, 92),
(27, 97),
(28, 90),
(28, 92),
(28, 97),
(29, 90),
(29, 93),
(30, 91),
(30, 96),
(31, 91),
(31, 96),
(32, 94);

-- --------------------------------------------------------

--
-- Table structure for table `fiches`
--

CREATE TABLE `fiches` (
  `id_fiche` int(11) NOT NULL,
  `libelle_fiche` varchar(100) CHARACTER SET utf8 NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fiches`
--

INSERT INTO `fiches` (`id_fiche`, `libelle_fiche`, `description`) VALUES
(26, 'Galaxy S6', 'Smartphone par samsung disponible à la vente depuis 2015'),
(27, 'Galaxy S7', 'Smartphone par samsung disponible à la vente depuis 2016'),
(28, 'Galaxy S8', 'Dernier smartphone sortie par Samsung'),
(29, 'M9', 'Dernier Smartphone de la marque htc '),
(30, 'MSI', 'Marque taiwan | laptop gameur '),
(31, 'Asus ROG', 'Ordinateur gameur de la marque asus'),
(32, 'iPhone8', 'Dernier Smartphone de apple');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_parent` (`id_pere`);

--
-- Indexes for table `categorie_fiche`
--
ALTER TABLE `categorie_fiche`
  ADD PRIMARY KEY (`id_fiche`,`id_categorie`),
  ADD KEY `fk_id_categorie` (`id_categorie`);

--
-- Indexes for table `fiches`
--
ALTER TABLE `fiches`
  ADD PRIMARY KEY (`id_fiche`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT for table `fiches`
--
ALTER TABLE `fiches`
  MODIFY `id_fiche` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `categorie_fiche`
--
ALTER TABLE `categorie_fiche`
  ADD CONSTRAINT `fk_id_categorie` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_id_fiche` FOREIGN KEY (`id_fiche`) REFERENCES `fiches` (`id_fiche`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
