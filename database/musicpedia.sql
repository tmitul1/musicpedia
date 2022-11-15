-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2022 at 07:01 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `musicpedia`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `album_id` int(11) NOT NULL,
  `artist_id` int(11) DEFAULT NULL,
  `album_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `album_duration` int(11) DEFAULT NULL,
  `album_cover` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`album_id`, `artist_id`, `album_name`, `album_duration`, `album_cover`, `year`) VALUES
(151515, 141414, 'Mr.Morale and The Big Steppers', 4717, 'morale', 2022),
(162863, 141414, 'Damn', 3294, 'damn', 2017),
(476713, 345507, 'Harry\'s House', 2508, 'harrys_house', 2022),
(993698, 689140, 'Dr. Feelgood', 2707, 'feelgood', 1989);

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `artist_id` int(11) NOT NULL,
  `artist_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`artist_id`, `artist_name`) VALUES
(141414, 'Kendrick Lamar'),
(345507, 'Harry Styles'),
(689140, 'Mötley Crüe');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genre_id` int(11) NOT NULL,
  `genre_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `genre_desc` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`genre_id`, `genre_name`, `genre_desc`) VALUES
(21419, 'Rock', 'Rock music is a broad genre of popular music that originated as \"rock and roll\" in the United States in the late 1940s and early 1950s'),
(161616, 'Hip-Hop', 'Lorem Ipsum'),
(284897, 'Pop', 'Pop music is a genre of popular music that originated in its modern form during the mid-1950s in the United States and the United Kingdom.');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `liked_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `song_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`liked_id`, `user_id`, `song_id`) VALUES
(121212, 123456, 131313);

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `playlist_id` int(11) NOT NULL,
  `playlist_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `song_id` int(11) DEFAULT NULL,
  `playlist_desc` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`playlist_id`, `playlist_name`, `user_id`, `song_id`, `playlist_desc`) VALUES
(171717, 'Demo_playlist', 123456, 131313, 'lorem ipsum');

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `song_id` int(11) NOT NULL,
  `album_id` int(11) DEFAULT NULL,
  `artist_id` int(11) DEFAULT NULL,
  `genre_id` int(11) DEFAULT NULL,
  `song_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `song_duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`song_id`, `album_id`, `artist_id`, `genre_id`, `song_name`, `song_duration`) VALUES
(103042, 993698, 689140, 21419, 'Slice of Your Pie', 272),
(110094, 476713, 345507, 284897, 'Music for a Sushi Restaurant', 194),
(131313, 151515, 141414, 161616, 'N95', 195),
(161197, 476713, 345507, 284897, 'Daylight', 165),
(178408, 162863, 141414, 161616, 'Yah', 160),
(261432, 151515, 141414, 161616, 'Rich - Interlude', 103),
(282153, 151515, 141414, 161616, 'United In Grief', 255),
(306466, 162863, 141414, 161616, 'Feel', 214),
(388296, 476713, 345507, 284897, 'Little Freak', 203),
(401001, 993698, 689140, 21419, 'T.n.T. (Terror \'n Tinseltown)', 42),
(480102, 993698, 689140, 21419, 'Kickstart My Heart', 284),
(485887, 993698, 689140, 21419, 'Without You', 269),
(488797, 162863, 141414, 161616, 'Blood', 118),
(575225, 993698, 689140, 21419, 'Rattlesnake Shake', 220),
(624472, 162863, 141414, 161616, 'Loyalty', 227),
(633644, 151515, 141414, 161616, 'Die Hard', 239),
(636407, 151515, 141414, 161616, 'Worldwide Steppers', 203),
(739656, 162863, 141414, 161616, 'Element', 208),
(756066, 993698, 689140, 21419, 'Dr. Feelgood', 290),
(786991, 476713, 345507, 284897, 'As it Was', 167),
(801350, 162863, 141414, 161616, 'DNA', 185),
(830001, 476713, 345507, 284897, 'Grapejuice', 192),
(964312, 151515, 141414, 161616, 'Father Time', 222),
(974112, 476713, 345507, 284897, 'Late Night Talking', 178);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_bio` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`, `email`, `user_bio`) VALUES
(123456, 'Demo_User', 'password', 'demo_user@email.com', 'lorem ipsum'),
(411232, 'test_a', 'test', 'test@test.com', 'work work work'),
(654321, 'another', 'password1', 'another1@gmail.con', 'Another One\r\nAgain\r\nMore');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`album_id`),
  ADD KEY `artist_id` (`artist_id`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`artist_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`liked_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `song_id` (`song_id`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`playlist_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `song_id` (`song_id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`song_id`),
  ADD KEY `album_id` (`album_id`),
  ADD KEY `artist_id` (`artist_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`song_id`) REFERENCES `songs` (`song_id`);

--
-- Constraints for table `playlists`
--
ALTER TABLE `playlists`
  ADD CONSTRAINT `playlists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `playlists_ibfk_2` FOREIGN KEY (`song_id`) REFERENCES `songs` (`song_id`);

--
-- Constraints for table `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `songs_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `albums` (`album_id`),
  ADD CONSTRAINT `songs_ibfk_2` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`),
  ADD CONSTRAINT `songs_ibfk_3` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`genre_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
