-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
-- 
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2024 at 02:23 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `animals`
--

-- Table structure for table `favorite_animals_users`

CREATE TABLE `favorite_animals_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `animal_id` int(11) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Table structure for table `animals`

CREATE TABLE `animals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Dumping data for table `animals`

INSERT INTO `animals` (`id`, `name`, `image`, `description`) VALUES
(1, 'Лъв', 'https://example.com/lion.jpg', 'Голяма, хищна котка от Африка.'),
(2, 'Тигър', 'https://example.com/tiger.jpg', 'Голям тигър с оранжеви ивици.'),
(3, 'Слон', 'https://example.com/elephant.jpg', 'Най-голямото сухоземно животно, родом от Африка и Азия.');
-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `names` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  'is_admin' enum ('0', '1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `names`, `email`, `password`) VALUES
(6, 'Kristian', 'kristian@abv.bg', '$argon2i$v=19$m=65536,t=4,p=1$QndnNTB3b0RmdUhTV2VVZQ$QfKHIMfaObI+KUoAMDhyxVKnxTQ3QvMBD+YYvy3Niks'),
(7, 'SDimitrov', 'Sdimitrov@abv.bg', '$argon2i$v=19$m=65536,t=4,p=1$VmF4OGYzQjNWb0pOSU43bw$YUvVoKEoa5ibI9p0BG90ZYIWo38E26MewdZ3t8owjJM'),
(10, '<script>alert(\"HACKED!!\");</script>', 'kristian123@abv.bg', '$argon2i$v=19$m=65536,t=4,p=1$Mk9TZElRV1NQY2ZSVTROUg$Q6voVoJX4KkpwYl5zUjxbwK4UL4NLhJUOfqGWLoRT9s');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favorite_animals_users`
--
ALTER TABLE `favorite_animals_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favorite_animals_users`
--
ALTER TABLE `favorite_animals_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Първичен ключ', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
