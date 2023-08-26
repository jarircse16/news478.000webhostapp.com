-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 26, 2023 at 09:28 AM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id21083165_news_site`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_user`
--

CREATE TABLE `auth_user` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_user`
--

INSERT INTO `auth_user` (`id`, `username`, `password`) VALUES
(1, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99'),
(2, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `post` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `post`) VALUES
(34, 'Sports', 1),
(31, 'Entertainment', 2),
(32, 'Politics', 0),
(33, 'Health', 0),
(36, 'Business', 0),
(37, 'Personal', 1),
(38, 'International', 0),
(39, 'Mine', 0);

-- --------------------------------------------------------

--
-- Table structure for table `date`
--

CREATE TABLE `date` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `name`
--

CREATE TABLE `name` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `post_date` varchar(50) NOT NULL,
  `author` int(11) NOT NULL,
  `post_img` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `title`, `description`, `category`, `post_date`, `author`, `post_img`) VALUES
(36, 'First Post', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ultrices tempus eros, non porta risus cursus a. Pellentesque tempor justo at lectus faucibus mattis. Vestibulum interdum turpis orci, dapibus gravida lacus egestas id. Nunc quis egestas leo. Morbi eget pretium nulla, elementum placerat lacus. Phasellus fringilla mauris a mi scelerisque pretium. Vivamus lacus nisi, placerat ac mattis pharetra, tristique a urna. Aenean pharetra aliquet lacus, vitae tempor est tempus et. Sed sed nisi eleifend, tempus tortor ut, convallis massa. In mollis nisl a orci fermentum venenatis vel vitae turpis. Vivamus fermentum massa nibh, nec blandit est mattis iaculis.', '34', '19 Jan, 2020', 27, 'sports1.jpg'),
(45, 'Jarir Has Successfully Shifted to Talaimari from Munnaf er Mor !', 'Yesterday, it was a hectic day when Jarir was finally packing his goods to move on to talaimari from munnaf er mor. The previous room was so tiny that it was hard to live in there. Now he is in a larger room alhamdulillah and things are going fine. ', '37', '29 Jul, 2023', 14, '1690604297-photo.jpg'),
(42, 'Testing Recent Post ', 'Suspendisse sed ultrices tortor. In imperdiet sem fringilla, ultricies nunc non, condimentum nunc. Praesent ac sollicitudin enim, commodo pellentesque nunc. Integer bibendum sollicitudin augue in sagittis. Proin scelerisque lacus maximus mauris ornare semper. Aliquam mi ante, euismod vitae ligula quis, fermentum tincidunt arcu. Etiam elementum sed nisi et scelerisque. Integer aliquet venenatis aliquam. Proin tempor dui sed dui pulvinar facilisis. Etiam imperdiet molestie iaculis.', '31', '21 Jan, 2020', 27, 'entertainment2.jpg'),
(43, 'Everything is valuable', '                                                            Look at this woman wearing a cloth made of sack of rice. This is peculiar but a new fashion of 2023.                                                 ', '31', '27 Jul, 2023', 14, '1690477900-bosta.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `websitename` varchar(60) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `footerdesc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `websitename`, `logo`, `footerdesc`) VALUES
(1, 'Jarir Ahmed', 'news.jpg', '© Copyright 2020 News | Powered by <a href=\"https://jarircse16.github.io/\">Jarir Ahmed </a>');

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

CREATE TABLE `time` (
  `id` int(11) NOT NULL,
  `time` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `role` int(11) NOT NULL,
  `session_token` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `username`, `password`, `role`, `session_token`) VALUES
(30, 'Salman', 'Khan', 'salman', '03346657feea0490a4d4f677faa0583d', 0, NULL),
(27, 'Yahoo', 'Baba', 'yahoobaba', '7513640474ad801fc09a1a6352b87a4f', 1, NULL),
(31, 'Anil ', 'Kapoor', 'anil', '71b9b5bc1094ee6eaeae8253e787d654', 0, NULL),
(32, 'Madhuri', 'Dixit', 'madhuri', '7ebc2c8aa51f075ccc653a0f8e86fbb4', 0, NULL),
(33, 'Amir', 'Khan', 'amir', '63eefbd45d89e8c91f24b609f7539942', 1, NULL),
(34, 'Shahid', 'Kapoor', 'shahid', 'f3224d90c778d5e456b49c75f85dd668', 0, NULL),
(35, 'Kriti', 'Sanon', 'kriti', 'f19e1368ef58fde93d78ba396f9046e3', 0, NULL),
(36, 'Kajal', 'Aggarwal', 'kajal', '7faafcbcc6456af72597bc2f3a9306b4', 0, NULL),
(14, 'Jarir', 'Ahmed', 'jarir2023', '188f0e3180977c53b04f49a52f1b796e', 1, '1c4ade6cb7e15ecfc6b1bc36acc2b06445f08ddf863f7a5efe45e45cb24280d6'),
(364, 'Jarir', 'Ahmed', 'jarir2020', '7513640474ad801fc09a1a6352b87a4f', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_user`
--
ALTER TABLE `auth_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `date`
--
ALTER TABLE `date`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `name`
--
ALTER TABLE `name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD UNIQUE KEY `post_id` (`post_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `date`
--
ALTER TABLE `date`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `name`
--
ALTER TABLE `name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `time`
--
ALTER TABLE `time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=365;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
