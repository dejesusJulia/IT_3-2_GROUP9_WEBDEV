-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2021 at 12:15 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `darymvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment_body` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `post_id`, `comment_body`, `created_at`) VALUES
(2, 11, 26, 'What a wacky dude!!!', '2021-02-17 10:45:29'),
(7, 9, 27, 'grilled cheese', '2021-02-18 03:09:19'),
(8, 10, 41, 'Ui ka rin ', '2021-02-25 09:09:54'),
(9, 10, 27, 'duel', '2021-02-25 09:40:56'),
(10, 10, 30, 'wswswswsws', '2021-02-25 09:50:03');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `body` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `show_author` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `body`, `img`, `user_id`, `show_author`, `created_at`) VALUES
(21, 'ljopiropieopiweporipwoeir', NULL, 10, 0, '2021-02-15 07:45:11'),
(22, 'werwerwerwerwerwerwerwerwr', NULL, 10, 0, '2021-02-15 07:45:19'),
(23, 'panget ang user', '../public/img/posts/602b79c4985f83.57160910.jpg', 10, 1, '2021-02-15 07:45:41'),
(24, 'werwerwerwerwerwerwerwr', NULL, 10, 0, '2021-02-15 07:46:16'),
(26, 'werwerwerwerwerwerwer', NULL, 10, 1, '2021-02-15 07:54:00'),
(27, 'It&#39;s me', NULL, 11, 1, '2021-02-17 10:44:59'),
(28, 'Hi, I&#39;m Jendeuk', NULL, 14, 1, '2021-02-19 23:54:19'),
(29, 'meow', NULL, 17, 1, '2021-02-20 03:18:22'),
(30, 'Meow', NULL, 18, 1, '2021-02-20 03:18:44'),
(31, 'Dance!', NULL, 15, 1, '2021-02-20 03:19:34'),
(32, 'I have a bike now hehe', NULL, 19, 1, '2021-02-20 03:20:10'),
(33, 'hmmmm', NULL, 13, 0, '2021-02-20 03:20:41'),
(34, 'I&#39;m a fashion editor now!', NULL, 14, 1, '2021-02-20 03:22:12'),
(35, 'I told u to smile. Why didn&#39;t you smile?', NULL, 16, 0, '2021-02-20 03:34:34'),
(36, 'sdfsdfsdd', '../public/img/posts/6032180f9d8be6.16135843.png', 10, 0, '2021-02-21 08:21:35'),
(37, 'aaaaaaaa', NULL, 10, 1, '2021-02-21 08:23:54'),
(38, 'aaaaa', NULL, 10, 0, '2021-02-21 08:23:57'),
(39, 'sdfsdf', NULL, 10, 0, '2021-02-21 08:32:30'),
(40, 'sdasdasd', NULL, 10, 1, '2021-02-25 04:29:40'),
(41, 'Ui!', NULL, 10, 0, '2021-02-25 04:30:33'),
(42, 'fuk u dispatch', NULL, 14, 1, '2021-02-25 09:58:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_email`, `user_type`, `password`, `avatar`, `created_at`) VALUES
(9, 'juliaaa', 'juliadj13@gmail.com', 'admin', '$2y$10$So5cfMLOs0hCVZ6Rs3SnxOcpj/zIupJCs8gsFjZLg8uvsufKR4QWG', 'img/avatar/female_avatar.png', '2021-02-14 04:16:09'),
(10, 'epoyPanget09', 'epoy@gmail.com', 'user', '$2y$10$O7yJ4Y.62T6YHdPQMgmBlOA3Gt6GRjGMyNRAc4hAPC3E92TK4M7K.', 'img/avatar/male_avatar.png', '2021-02-14 04:17:35'),
(11, 'berd', 'berd@email.com', 'user', '$2y$10$y7NwPfX9SD4zvZsJnyOG/uULeuDNVOdq/L1LXQFWy/sVVVVNjCwJC', 'img/avatar/male_avatar.png', '2021-02-17 09:44:49'),
(12, 'philbert', 'philbert@gmail.com', 'admin', '$2y$10$A6HVtUzLHIE4u0l.OT2lReRrtG79vf0ipxpz8q22VO2qduFN3lvSe', 'img/avatar/male_avatar.png', '2021-02-17 09:46:00'),
(13, 'lobster', 'lobster@gmail.com', 'user', '$2y$10$.sqf13Ig7CDhksWgroa/jeq0M2Vdewz/k6ZqzBa3Weetbnx8wPrYW', 'img/avatar/male_avatar.png', '2021-02-17 09:48:37'),
(14, 'jennie', 'jennie@gmail.com', 'admin', '$2y$10$vFF.YNyTYGPVV2U5AacYw.scSdfRBVgEq.G7cXyh0jIIwgWwHLBqy', 'img/avatar/female_avatar.png', '2021-02-19 23:53:27'),
(15, 'jisoo', 'jisoo@gmail.com', 'user', '$2y$10$UlEw.bVYzTG4tzRnwh9sMeQDJVRpRYC6JXpeFBC29lf7OkIc.iEaG', 'img/avatar/female_avatar.png', '2021-02-19 23:55:17'),
(16, 'lisa', 'lisa@gmail.com', 'user', '$2y$10$83/TTv5rPaIKrG5l49nzPesHGzvgnZHSbrkb1hwl3r8Qys..mDwTW', 'img/avatar/female_avatar.png', '2021-02-19 23:56:28'),
(17, 'leo', 'leo@gmail.com', 'user', '$2y$10$kJWuSJf6FmOFpe.PSolqs.JPUAEr1MWWmCkrNXuYoA5x2JdTSrVgK', 'img/avatar/male_avatar.png', '2021-02-19 23:57:01'),
(18, 'lily', 'lily@gmail.com', 'user', '$2y$10$FaNI7cDHCZf3YQrRGGR9dOaJ9Pc6.DoCFcf8.4MLpRh1Aa2YJw646', 'img/avatar/female_avatar.png', '2021-02-19 23:57:35'),
(19, 'rose', 'rose@gmail.com', 'user', '$2y$10$JUYtGhNPyfxZKe2oldt9ou4yPHUTYwqDCOknZquMnL6f.ygWCIrFu', 'img/avatar/female_avatar.png', '2021-02-20 00:13:12'),
(20, 'jacksonWang', 'jackson@gmail.com', 'admin', '$2y$10$4aahfeKxEXBrdhJxpBhlZOHQU.UmnHRpjWWba37Ulv5TexkeP1P86', 'img/avatar/male_avatar.png', '2021-02-20 00:13:37'),
(21, 'luca', 'luca@gmail.com', 'user', '$2y$10$GJxQecvEEH9AD8QD/g60qeHeSkwXr8/UT.HA9oRo9AJZL9UO1SyS2', 'img/avatar/male_avatar.png', '2021-02-20 00:22:54'),
(22, 'louis', 'louis@gmail.com', 'user', '$2y$10$lu2lMxqG8rJBIKXuCIG5yOjcZBIpKoWf/or7/OvosFd6Ts/O/7sta', 'img/avatar/male_avatar.png', '2021-02-20 00:23:15'),
(23, 'lego', 'lego@gmail.com', 'user', '$2y$10$LToQBMoZL8cjjD.ljZr1qehoRkI7EMVyH3tss7ARaYWXfVf0YTWmG', 'img/avatar/male_avatar.png', '2021-02-20 00:24:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
