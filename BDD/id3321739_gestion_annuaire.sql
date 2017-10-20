-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 20, 2017 at 07:38 AM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id3321739_gestion_annuaire`
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
(111, 'Tous', NULL),
(120, 'Movies', 111),
(122, 'Comédie', 120),
(123, 'Animation', 120),
(124, 'Music', 111),
(125, 'Horeur', 120),
(127, 'Pop', 124),
(128, 'Jazz', 124),
(129, 'Mangas', 123),
(130, 'Disney', 123),
(131, '2D', 130),
(132, '3D', 130),
(133, '', 0),
(134, '', 0),
(135, '', 0),
(136, '', 0),
(137, '', 0);

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
(0, 96),
(1, 111),
(1, 122),
(2, 111),
(2, 120),
(2, 123),
(2, 132),
(3, 123),
(3, 129),
(4, 120),
(4, 123),
(4, 129),
(5, 125),
(6, 124),
(6, 127),
(6, 128);

-- --------------------------------------------------------

--
-- Table structure for table `fiches`
--

CREATE TABLE `fiches` (
  `id_fiche` int(11) NOT NULL,
  `libelle_fiche` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fiches`
--

INSERT INTO `fiches` (`id_fiche`, `libelle_fiche`, `description`) VALUES
(1, 'mr bean', 'film comedie de mr bean'),
(2, 'Zootopia', 'disney 3D'),
(3, 'naruto', 'mangas '),
(4, 'death note', 'mangas japonaise, le meilleur'),
(5, 'conjuring', 'horeur'),
(6, 'album yes de Jason mraz', 'album sorti par le chanteur americain Jason mraz');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_parent` (`id_pere`),
  ADD KEY `id_pere` (`id_pere`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;
--
-- AUTO_INCREMENT for table `fiches`
--
ALTER TABLE `fiches`
  MODIFY `id_fiche` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
