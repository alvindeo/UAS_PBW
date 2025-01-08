-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2025 at 02:36 PM
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
(3, 'Film Inception', 'inception.jpg', '\"Inception\" adalah film fiksi ilmiah dan thriller yang dirilis pada tahun 2010, disutradarai oleh Christopher Nolan. Film ini dibintangi oleh Leonardo DiCaprio, Joseph Gordon-Levitt, Ellen Page, Tom Hardy, Ken Watanabe, dan Marion Cotillard.', '2025-01-08 01:24:38', 'admin'),
(4, 'Film Parasite', 'parasite.jpg', '\"Parasite\" adalah film Korea Selatan yang dirilis pada tahun 2019, disutradarai oleh Bong Joon-ho. Film ini menjadi terkenal secara internasional dan memenangkan beberapa penghargaan bergengsi, termasuk empat Academy Awards (Oscar), termasuk Film Terbaik.', '2025-01-08 01:24:58', 'admin'),
(5, 'Film The Dark Knight', 'the dark knight.jpg', '\"The Dark Knight\", film yang dirilis pada tahun 2008 yang disutradarai oleh Christopher Nolan. Film ini adalah bagian dari trilogi Batman oleh Nolan dan dibintangi oleh Christian Bale sebagai Batman, Heath Ledger sebagai Joker, Aaron Eckhart sebagai Harvey Dent, serta Maggie Gyllenhaal, Gary Oldman, dan Michael Caine.', '2025-01-08 01:25:22', 'admin'),
(6, 'Film The Lord Of The Rings', 'the lord of the rings.jpg', '\"The Lord of the Rings\" adalah trilogi film epik yang disutradarai oleh Peter Jackson, berdasarkan novel karya J.R.R. Tolkien. Triloginya terdiri dari tiga film: \"The Fellowship of the Ring\" (2001), \"The Two Towers\" (2002), dan \"The Return of the King\" (2003). Film-film ini mendapatkan pujian kritis luas dan meraih banyak penghargaan.', '2025-01-08 01:25:49', 'admin');

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
(1, 'end game.jpg', 'Film Marvel End Game', '2024-12-24 13:28:58'),
(2, 'inception.jpg', 'Film Inception', '2024-12-24 13:28:58'),
(3, 'interstellar.jpg', 'Film Interstellar\r\n', '2024-12-24 13:34:07');

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
(1, 'alvin', '9573534ee6a886f4831ac5bcdfe85565'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
