-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2025 at 09:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pbw_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `image`, `content`, `created_at`, `username`) VALUES
(1, 'Marvel End Game', 'end game.jpg', '\"Avengers: Endgame\" adalah film superhero Amerika yang dirilis pada 2019. Film ini adalah bagian dari Marvel Cinematic Universe (MCU) dan merupakan lanjutan dari \"Avengers: Infinity War\".', '2025-01-08 01:21:55', 'admin'),
(2, 'Interstellar', 'interstellar.jpg', 'film interstellar\r\n\"Interstellar\" adalah film fiksi ilmiah yang dirilis pada tahun 2014, disutradarai oleh Christopher Nolan dan dibintangi oleh Matthew McConaughey, Anne Hathaway, Jessica Chastain, dan Michael Caine.', '2025-01-08 01:23:05', 'admin'),
(10, 'Inception', 'inception.jpg', '\"Inception\" adalah film thriller fiksi ilmiah yang disutradarai oleh Christopher Nolan dan dirilis pada tahun 2010. Film ini dibintangi oleh Leonardo DiCaprio sebagai Dom Cobb, seorang pencuri profesional yang memiliki kemampuan untuk masuk ke dalam mimpi orang lain dan mencuri informasi dari alam bawah sadar mereka.', '2025-01-12 05:46:14', 'admin'),
(11, 'Parasite', 'parasite.jpg', '\"Parasite\" adalah film asal Korea Selatan yang disutradarai oleh Bong Joon-ho, dirilis pada tahun 2019. Film ini menjadi terkenal di seluruh dunia dan mendapatkan banyak penghargaan, termasuk Palme d\'Or di Festival Film Cannes dan empat piala Oscar, termasuk kategori Film Terbaik.', '2025-01-12 05:46:38', 'admin'),
(12, 'The Dark Knight', 'the dark knight.jpg', 'film the dark knight\r\n\"The Dark Knight\" adalah film superhero yang disutradarai oleh Christopher Nolan dan dirilis pada tahun 2008. Ini adalah film kedua dalam trilogi Batman karya Nolan, dan secara umum dianggap sebagai salah satu film superhero terbaik yang pernah dibuat.', '2025-01-12 05:46:58', 'admin'),
(13, 'The Lord Of The Rings', 'the lord of the rings.jpg', 'the lord of the rings\r\n\"The Lord of the Rings\" adalah trilogi film epik fantasi yang disutradarai oleh Peter Jackson, berdasar pada novel klasik karya J.R.R. Tolkien. Triloginya terdiri dari tiga film: \"The Fellowship of the Ring\" (2001), \"The Two Towers\" (2002), dan \"The Return of the King\" (2003).', '2025-01-12 05:47:25', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `image`, `description`, `created_at`) VALUES
(5, 'end game.jpg', NULL, '2025-01-12 05:36:52'),
(6, 'inception.jpg', NULL, '2025-01-12 05:43:35'),
(7, 'interstellar.jpg', NULL, '2025-01-12 05:47:37'),
(8, 'parasite.jpg', NULL, '2025-01-12 05:47:44'),
(9, 'the dark knight.jpg', NULL, '2025-01-12 05:56:37'),
(12, 'the lord of the rings.jpg', NULL, '2025-01-13 02:50:02');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
