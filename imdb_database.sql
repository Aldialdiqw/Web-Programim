-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2024 at 07:19 PM
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
-- Database: `imdb_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `tmdb_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `tmdb_id`, `title`, `image_url`, `created_at`) VALUES
(1, 693134, 'Dune: Part Two', '/1pdfLvkbY9ohJlCjQH2CZjjYVvJ.jpg', '2024-04-15 19:27:07'),
(2, 1011985, 'Kung Fu Panda 4', '/kDp1vUBnMpe8ak4rjgl3cLELqjU.jpg', '2024-04-15 19:27:07'),
(3, 438631, 'Dune', '/d5NXSklXo0qyIYkgV94XAgMIckC.jpg', '2024-04-15 19:27:07'),
(4, 823464, 'Godzilla x Kong: The New Empire', '/tMefBSflR6PGQLv7WvFPpKLZkyk.jpg', '2024-04-15 19:27:07'),
(5, 359410, 'Road House', '/bXi6IQiQDHD00JFio5ZSZOeRSBh.jpg', '2024-04-15 19:27:07'),
(6, 929590, 'Civil War', '/sh7Rg8Er3tFcN9BpKIPOMvALgZd.jpg', '2024-04-15 19:27:07'),
(7, 792307, 'Poor Things', '/kCGlIMHnOm8JPXq3rXM6c5wMxcT.jpg', '2024-04-15 19:27:07'),
(8, 967847, 'Ghostbusters: Frozen Empire', '/6faYaQyiBPhqAizldJKq21mIVaE.jpg', '2024-04-15 19:27:07'),
(9, 872585, 'Oppenheimer', '/8Gxv8gSFCU0XGDykEGv7zR1n2ua.jpg', '2024-04-15 19:27:07'),
(10, 634492, 'Madame Web', '/rULWuutDcN5NvtiZi4FRPzRYWSh.jpg', '2024-04-15 19:27:07'),
(11, 1083658, 'Scoop', '/agWt9bJzr2m1HY3A5InxXveUyIe.jpg', '2024-04-15 19:27:07'),
(12, 437342, 'The First Omen', '/cIzk6GhxEZuweekGFXWEoAyuaMX.jpg', '2024-04-15 19:27:07'),
(13, 978592, 'Sleeping Dogs', '/5DwQhh1HvTo7edaOeMX49NUyZqy.jpg', '2024-04-15 19:27:07'),
(14, 763215, 'Damsel', '/AgHbB9DCE9aE57zkHjSmseszh6e.jpg', '2024-04-15 19:27:07'),
(15, 1127166, 'The Tearsmith', '/uoBHsxSgfc3PQsSn98RfnbePHOy.jpg', '2024-04-15 19:27:07'),
(16, 560016, 'Monkey Man', '/b4fn3VIdVTT3SX0rFMNFbl5xuvg.jpg', '2024-04-15 19:27:07'),
(17, 845783, 'Baghead', '/lbOyeiiRYAE6Nm2e7xiNAAaRwZB.jpg', '2024-04-15 19:27:07'),
(18, 1022796, 'Wish', '/vgJZSqKMXWDDx09iSIStGKfHMku.jpg', '2024-04-15 19:27:07'),
(19, 866398, 'The Beekeeper', '/A7EByudX0eOzlkQ2FIbogzyazm2.jpg', '2024-04-15 19:27:07'),
(20, 1239146, 'Woody Woodpecker Goes to Camp', '/uJsgT0jBw5q2g82dzZcLgYrROTs.jpg', '2024-04-15 19:27:07'),
(21, 106379, 'Fallout', 'https://image.tmdb.org/t/p/original/AnsSKR9LuK0T9bAOcPVA3PUvyWj.jpg', '2024-04-15 19:32:10'),
(22, 108545, '3 Body Problem', 'https://image.tmdb.org/t/p/original/ykZ7hlShkdRQaL2aiieXdEMmrLb.jpg', '2024-04-15 19:32:10'),
(23, 126308, 'Shōgun', 'https://image.tmdb.org/t/p/original/7O4iVfOMQmdCSxhOg1WnzG1AgYT.jpg', '2024-04-15 19:32:10'),
(24, 208825, 'Parasyte: The Grey', 'https://image.tmdb.org/t/p/original/rubaKfmdCvWGPXErgW9aQsgzKVr.jpg', '2024-04-15 19:32:10'),
(25, 37854, 'One Piece', 'https://image.tmdb.org/t/p/original/cMD9Ygz11zjJzAovURpO75Qg7rT.jpg', '2024-04-15 19:32:10'),
(26, 82684, 'That Time I Got Reincarnated as a Slime', 'https://image.tmdb.org/t/p/original/jQb1ztdko9qc4aCdnMXShcIHXRG.jpg', '2024-04-15 19:32:10'),
(27, 138502, 'X-Men \'97', 'https://image.tmdb.org/t/p/original/9Ycz7yYRf9V4jk3YXwcZhFtbNcF.jpg', '2024-04-15 19:32:10'),
(28, 94028, 'RIPLEY', 'https://image.tmdb.org/t/p/original/rpSo8z9alultGVTqQ3dkLEyU8xx.jpg', '2024-04-15 19:32:10'),
(29, 203744, 'Sugar', 'https://image.tmdb.org/t/p/original/dNrk52Rt13MxwahLneTZJezM6qD.jpg', '2024-04-15 19:32:10'),
(30, 94664, 'Mushoku Tensei: Jobless Reincarnation', 'https://image.tmdb.org/t/p/original/z4rvmhoqQiGMnwuBHY1QcH3OqUo.jpg', '2024-04-15 19:32:10'),
(31, 52814, 'Halo', 'https://image.tmdb.org/t/p/original/hmHA5jqxN3ESIAGx0jAwV7TJhTQ.jpg', '2024-04-15 19:32:10'),
(32, 206586, 'The Walking Dead: The Ones Who Live', 'https://image.tmdb.org/t/p/original/ywbacot78IuNhGW4uVZPxxxVTkm.jpg', '2024-04-15 19:32:10'),
(33, 95557, 'Invincible', 'https://image.tmdb.org/t/p/original/dMOpdkrDC5dQxqNydgKxXjBKyAc.jpg', '2024-04-15 19:32:10'),
(34, 1399, 'Game of Thrones', 'https://image.tmdb.org/t/p/original/1XS1oqL89opfnbLl8WnZY1O1uJx.jpg', '2024-04-15 19:32:10'),
(35, 67198, 'Star Trek: Discovery', 'https://image.tmdb.org/t/p/original/pDLjbZp93qaMhruz52sH0GsfcVr.jpg', '2024-04-15 19:32:10'),
(36, 65844, 'KONOSUBA - God\'s blessing on this wonderful world!', 'https://image.tmdb.org/t/p/original/oRaOeQlwktbGSd2T31FYAcgHZlh.jpg', '2024-04-15 19:32:10'),
(37, 127532, 'Solo Leveling', 'https://image.tmdb.org/t/p/original/geCRueV3ElhRTr0xtJuEWJt6dJ1.jpg', '2024-04-15 19:32:10'),
(38, 204541, 'Three-Body', 'https://image.tmdb.org/t/p/original/buXHm2shttFRQIBsCFlv5L2TmKh.jpg', '2024-04-15 19:32:10'),
(39, 1429, 'Attack on Titan', 'https://image.tmdb.org/t/p/original/hTP1DtLGFamjfu8WqjnuQdP1n4i.jpg', '2024-04-15 19:32:10'),
(40, 215720, 'Queen of Tears', 'https://image.tmdb.org/t/p/original/7ZXLZ3KYL3IVvsSHBZaHjcNQzNU.jpg', '2024-04-15 19:32:10');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `user_id`, `title`, `content`, `image_path`, `created_at`) VALUES
(2, 2, 'John Cena New Movie', 'John Cena ready to starr in a new movie', 'https://static0.thesportsterimages.com/wordpress/wp-content/uploads/wm/2024/02/10-best-john-cena-movies-ranked-according-to-imdb.jpg', '2024-04-12 20:44:41');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `movie_id`, `rating`, `comment`, `created_at`) VALUES
(3, 3, 1011985, 5, 'asd', '2024-04-15 22:24:01'),
(4, 3, 126308, 5, 'radswasd', '2024-04-15 22:25:40'),
(5, 3, 126308, 5, 'radswasd', '2024-04-15 22:31:54'),
(6, 3, 1011985, 5, 'asd', '2024-04-15 22:32:09'),
(7, 3, 823464, 5, 'asda', '2024-04-15 22:51:54'),
(8, 3, 359410, 5, 'asds', '2024-04-15 22:52:06');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `email`, `password`, `role`) VALUES
(1, 'name', 'name', 'name@gmail.com', 'password123', 'admin'),
(2, 'name', 'eralderald', 'aldi.keka@gmail.com', '$2y$10$M9jSJKzPfeBxhh2xEavpbuvacfn1UDTuQ08QoMpiKvfiX.NWozJ4G', 'user'),
(3, 'name', 'erald', 'erald@gmail.com', '$2y$10$a7EMWhUUKrs74uxvhbQYKuE1/31xYPKRAh0gq2/IiseUttJE1EQXi', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_reviews`
--

CREATE TABLE `user_reviews` (
  `review_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_reviews`
--

INSERT INTO `user_reviews` (`review_id`, `user_id`) VALUES
(7, 3),
(8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `watchlist`
--

CREATE TABLE `watchlist` (
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tmdb_id` (`tmdb_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_reviews`
--
ALTER TABLE `user_reviews`
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_review_id` (`review_id`);

--
-- Indexes for table `watchlist`
--
ALTER TABLE `watchlist`
  ADD KEY `USERRR` (`user_id`),
  ADD KEY `MOVIE` (`movie_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`tmdb_id`);

--
-- Constraints for table `user_reviews`
--
ALTER TABLE `user_reviews`
  ADD CONSTRAINT `fk_review_id` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `watchlist`
--
ALTER TABLE `watchlist`
  ADD CONSTRAINT `MOVIE` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`),
  ADD CONSTRAINT `USERRR` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
