-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 01, 2021 at 04:09 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cr11_petadoption_MichaelR`
--
CREATE DATABASE IF NOT EXISTS `cr11_petadoption_MichaelR` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cr11_petadoption_MichaelR`;

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `animal_id` int(11) UNSIGNED NOT NULL,
  `location_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `hobbies` varchar(255) NOT NULL,
  `age` varchar(10) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` enum('available','adopted') DEFAULT 'available',
  `type` enum('small','large') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`animal_id`, `location_id`, `name`, `description`, `hobbies`, `age`, `picture`, `status`, `type`) VALUES
(1, 3, 'Cate', 'Smudge cat', 'Smudges', '14', 'https://www.masala.com/public/styles/msl_redesign_article_832px_415px/public/images/2019/11/16/SmudgeCat.jpg?itok=C2ZWKCjp', 'available', 'small'),
(2, 2, 'Good Girl', 'Merell', 'Being a good girl', '1', 'https://preview.redd.it/67822n6vn6s41.jpg?width=640&crop=smart&auto=webp&s=40477cca47e98e938f03d94273bbc46a44fd1407', 'available', 'large'),
(3, 4, 'Doge', 'Such Doge', 'Much Wow', '13', 'https://dogecoin.org/static/11cf6c18151cbb22c6a25d704ae7b313/709e3/doge-main.webp', 'available', 'large'),
(4, 1, 'Moon Moon', 'Husky', 'Such awe', '11', 'https://external-preview.redd.it/Yt-9eOXz4nEqhbDObQrAWoA9C7eoF818tKgfH7RPnjw.jpg?width=960&crop=smart&auto=webp&s=4a975cfd46f0eeb417023c4d62c03846c7f1f1d4', 'available', 'large'),
(5, 4, 'Grumpy Cat', 'Beryl', 'Meh', '7', 'https://f8n-ipfs-production.imgix.net/QmfWtxAM2qwKrEXVoeasArDBrR12qL7HCuD2B4Tqe5R8Bs/nft.jpg?fit=fill&q=100&w=2560', 'available', 'small'),
(6, 3, 'Snek', 'Susannah', 'Programming Python', '4', 'https://i.redd.it/oseg6ok7ss031.jpg', 'available', 'small'),
(7, 1, 'Hedge', 'Hog', 'Chillin', '4', 'http://memes.ucoz.com/_nw/46/29135571.jpg', 'available', 'small'),
(8, 3, 'Nyan Cat', 'Nyan', 'Nyan Nyan', '4', 'https://images.gutefrage.net/media/fragen/bilder/wie-spricht-man-nyan-aus/0_big.jpg?v=1350585008000', 'available', 'small'),
(9, 3, 'Trash Panda', 'Bert', 'Diving trash', '2', 'https://i.redd.it/umkotiptjgs61.jpg', 'available', 'small'),
(10, 2, 'Good Boy', 'Buddy', 'Being a good boy', '4', 'https://hg1.funnyjunk.com/comments/Gt+goodest+boy+_b5d60b16e0bc61ccaa8c7098d207b19f.jpg', 'available', 'large'),
(11, 2, 'Da Snoot', 'Boop', 'Boops da snoot', '5', 'https://i.redd.it/mqzanygpexix.jpg', 'available', 'large'),
(12, 3, 'Crow', 'Of judgment', 'Judges', '14', 'https://i.kym-cdn.com/photos/images/newsfeed/001/432/217/b03.jpeg', 'available', 'large'),
(16, 4, 'Snek2', 'Test Snek', 'Sneaking', '14', 'https://www.dictionary.com/e/wp-content/uploads/2018/06/snek-3.jpg', 'available', 'small');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) UNSIGNED NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `city`, `zip`, `address`) VALUES
(1, 'Sobotín', '788 16', '73568 Ryan Way'),
(2, 'San Antonio', '71200', '6210 Crownhardt Plaza'),
(3, 'Vairão', '4485-048', '6 Golden Leaf Parkway'),
(4, 'Stare Pole', '82-220', '23068 Scott Pass');

-- --------------------------------------------------------

--
-- Table structure for table `petadoption`
--

CREATE TABLE `petadoption` (
  `adoption_id` int(11) UNSIGNED NOT NULL,
  `animal_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `date_collected` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `petadoption`
--

INSERT INTO `petadoption` (`adoption_id`, `animal_id`, `user_id`, `date_collected`) VALUES
(1, 3, 1, '2021-05-01'),
(2, 16, 1, '2021-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `password`, `email`, `picture`, `status`) VALUES
(1, 'User', 'User', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 'user@user.com', 'avatar.webp', 'user'),
(2, 'Admin', 'Admin', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 'admin@admin.com', 'avatar.webp', 'adm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`animal_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `petadoption`
--
ALTER TABLE `petadoption`
  ADD PRIMARY KEY (`adoption_id`),
  ADD KEY `animal_id` (`animal_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `animal_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `petadoption`
--
ALTER TABLE `petadoption`
  MODIFY `adoption_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `animals`
--
ALTER TABLE `animals`
  ADD CONSTRAINT `animals_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `petadoption`
--
ALTER TABLE `petadoption`
  ADD CONSTRAINT `petadoption_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `animals` (`animal_id`),
  ADD CONSTRAINT `petadoption_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
