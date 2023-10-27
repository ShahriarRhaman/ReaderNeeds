-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2023 at 08:09 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `readerneeds`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `b_id` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `author` varchar(40) NOT NULL,
  `price` float(10,2) NOT NULL,
  `quantity` int(5) NOT NULL,
  `status` char(1) NOT NULL,
  `category` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `condition` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`b_id`, `title`, `author`, `price`, `quantity`, `status`, `category`, `created_at`, `image`, `file`, `condition`, `user_id`) VALUES
(67, 'C++ Programming Fundamentals', 'D. Malhotra || N. Malhotra', 12.00, 100, 'B', 'CSE', '2023-08-27 15:54:42', 'Image/BuyBooks/c++.jpg', '', '', 4),
(68, 'C Programming Fundamentals', 'Rajiv Chopra', 10.00, 100, 'B', 'CSE', '2023-08-27 15:54:42', 'Image\\BuyBooks\\c.jpg', '', '', 4),
(71, 'Software Quality Assurance', 'Rajiv Chopra', 13.00, 100, 'B', 'CSE', '2023-08-27 16:13:43', 'Image\\BuyBooks\\s.jpg', '', '', 4),
(72, 'Database System Concepts', 'Silberschatz, Korth and Sudarshan', 13.00, 100, 'B', 'CSE', '2023-08-27 16:13:43', 'Image\\BuyBooks\\d.jpg', '', '', 4),
(73, 'Beginning Programming All-in-One', 'Wallace Wang', 15.00, 100, 'B', 'CSE', '2023-08-27 16:18:18', 'Image\\BuyBooks\\a.jpg', '', '', 4),
(74, 'Computer & Network', 'Richard R. Brooks', 14.00, 100, 'B', 'CSE', '2023-08-27 16:18:18', 'Image\\BuyBooks\\b.jpg', '', '', 4),
(75, 'Anton Calculus Early Transcendentals 10t', 'HOWARD ANTON, IRL BIVENS, STEPHEN DAVIS', 0.00, 1, 'R', 'Math', '2023-08-27 19:45:23', 'Books\\image\\anton.jpg', 'Books\\Anton Calculus Early Transcendentals 10th.pdf', '', 4),
(76, 'Artificial Intelligence - A Modern Appro', 'Stuart J. Russell and Peter Norvig', 0.00, 1, 'R', 'CSE', '2023-08-27 19:45:23', 'Books\\image\\ai.jpg', 'Books\\Artificial Intelligence - A Modern Approach (3rd Edition).pdf', '', 4),
(77, 'Biology FOR DUMMIES (2ND EDITION)', 'Rene Fester Kratz, PhD, and Donna Rae Si', 0.00, 1, 'R', 'Science', '2023-08-27 19:45:23', 'Books\\image\\bio.jpg', 'Books\\Biology For Dummies, Second Edition by Rene Fester Kratz PhD, Donna Rae Siegfried (z-lib.org).pdf', '', 4),
(78, 'Contemporary Linear Algebra', 'howard Anton || Robert C.Busby', 0.00, 1, 'R', 'Math', '2023-08-27 19:45:23', 'Books\\image\\cn.jpg', 'Books\\Contemporary Linear Algebra - Howard Anton, Robert C. Busby.pdf', '', 4),
(79, 'Computer Organization and Design', 'David A. Patterson || John L. Hennessy', 0.00, 1, 'R', 'CSE', '2023-08-27 19:45:23', 'Books\\image\\ca.jpg', 'Books\\CS422-Computer-Architecture-ComputerOrganizationAndDesign5thEdition2014.pdf', '', 4),
(80, '', '', 0.00, 1, '', '', '2023-08-28 04:23:01', 'Books/image/', '', 'Average', 5),
(82, 'Ai book', 'test', 0.00, 1, 'E', '', '2023-08-28 05:23:38', 'Books/image/a.jpg', '', 'Average', 5),
(83, 'title', 'test', 0.00, 1, 'E', '', '2023-08-28 05:26:13', 'Books/image/d.jpg', '', 'Average', 6),
(85, 'askjh', 'sasd', 0.00, 1, 'F', '', '2023-08-28 18:41:31', 'Books/image/a.jpg', '', 'Average', 5);

-- --------------------------------------------------------

--
-- Table structure for table `book_order`
--

CREATE TABLE `book_order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `items` int(11) NOT NULL,
  `total_amount` float(10,2) NOT NULL,
  `note` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_order`
--

INSERT INTO `book_order` (`order_id`, `user_id`, `address`, `items`, `total_amount`, `note`) VALUES
(1, 5, 'kamarpara turag dhaka', 1, 23.00, ''),
(2, 5, 'dhaka', 1, 22.00, '');

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE `conversation` (
  `c_id` int(11) NOT NULL,
  `i_id` int(11) NOT NULL,
  `msg` varchar(255) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `sender_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conversation`
--

INSERT INTO `conversation` (`c_id`, `i_id`, `msg`, `time`, `sender_id`) VALUES
(42, 23, 'hi', '2023-08-28 05:36:46', 9),
(43, 23, 'hi', '2023-08-28 05:42:41', 9),
(44, 23, 'hello..kemon acho?', '2023-08-28 05:43:39', 5),
(45, 24, NULL, '2023-08-28 06:14:47', 10),
(46, 24, 'hi', '2023-08-28 06:14:57', 10),
(47, 24, 'hi', '2023-08-28 18:17:19', 5),
(48, 24, 'hi', '2023-08-28 18:41:54', 5),
(49, 24, 'hi', '2023-08-28 18:41:59', 5),
(50, 24, 'hi', '2023-08-28 18:42:15', 5);

-- --------------------------------------------------------

--
-- Table structure for table `exchange`
--

CREATE TABLE `exchange` (
  `e_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at_exchange` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exchange`
--

INSERT INTO `exchange` (`e_id`, `b_id`, `user_id`, `description`, `image`, `created_at_exchange`) VALUES
(27, 82, 5, 'description...', 'Books/image/a.jpg', '2023-08-28 05:23:38'),
(28, 85, 5, 'asd', 'Books/image/a.jpg', '2023-08-28 18:41:31');

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `i_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Reciver_id` int(11) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`i_id`, `user_id`, `Reciver_id`, `time`) VALUES
(18, 1, NULL, '2023-08-27 18:28:01'),
(19, 1, 3, '2023-08-27 18:28:01'),
(20, 5, NULL, '2023-08-28 04:25:46'),
(22, 4, NULL, '2023-08-28 04:42:57'),
(23, 5, 9, '2023-08-28 05:36:38'),
(24, 5, 10, '2023-08-28 06:14:44');

-- --------------------------------------------------------

--
-- Table structure for table `offerbook`
--

CREATE TABLE `offerbook` (
  `id` int(11) NOT NULL,
  `e_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `p_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `post` varchar(255) NOT NULL,
  `p_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`p_id`, `user_id`, `created_at`, `post`, `p_image`) VALUES
(12, 6, '2023-08-28 05:07:41', 'need some resource for java ', 'Post/img/'),
(13, 10, '2023-08-28 05:57:32', 'All in one programming soltution.', 'Post/img/a.jpg'),
(17, 5, '2023-08-28 18:40:56', 'hi. how are you doing?', 'Post/img/');

-- --------------------------------------------------------

--
-- Table structure for table `react`
--

CREATE TABLE `react` (
  `react_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `likes` tinyint(1) DEFAULT NULL,
  `dislikes` tinyint(1) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `reacted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `react`
--

INSERT INTO `react` (`react_id`, `p_id`, `user_id`, `likes`, `dislikes`, `comment`, `reacted_at`) VALUES
(14, 12, 6, 1, NULL, NULL, '2023-08-28 05:07:48'),
(15, 12, 6, NULL, 1, NULL, '2023-08-28 05:07:51'),
(18, 12, 10, NULL, NULL, 'for which topic ,bro?\r\n', '2023-08-28 05:58:16'),
(19, 13, 5, NULL, NULL, 'vwery nice', '2023-08-28 06:17:50'),
(20, 13, 5, 1, NULL, NULL, '2023-08-28 06:18:12');

-- --------------------------------------------------------

--
-- Table structure for table `rent_order`
--

CREATE TABLE `rent_order` (
  `rent_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `items` varchar(255) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `order_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `return_at` datetime DEFAULT NULL,
  `return_by` varchar(255) NOT NULL,
  `note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rent_order`
--

INSERT INTO `rent_order` (`rent_id`, `user_id`, `address`, `items`, `total_amount`, `order_at`, `return_at`, `return_by`, `note`) VALUES
(1, 5, 'kamarpara turag dhaka', '      1. C Programming Fundamentals\r\n2. Software Quality Assurance\r\n      ', 22.00, '2023-08-27 19:26:57', '2023-09-07 01:26:57', '', ''),
(2, 5, 'kamarpara turag dhaka', '      1. C Programming Fundamentals\r\n2. Database System Concepts\r\n      ', 22.00, '2023-08-27 19:28:08', '2023-09-07 01:28:08', 'sundarban courier Address: Name:ReaderNeeds,Phone Number:01745345312, Address: Sector:6,Uttara,Dhaka', ''),
(3, 5, 'asdfg', '      1. C   Programming Fundamentals\r\n2. C Programming Fundamentals\r\n      ', 22.00, '2023-08-28 06:12:01', '2023-09-07 12:12:01', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sell_post`
--

CREATE TABLE `sell_post` (
  `sell_post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `book_condition` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `user_type` tinyint(1) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `image` varchar(255) NOT NULL,
  `pass` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_type`, `user_name`, `email`, `phone_number`, `image`, `pass`) VALUES
(4, 1, 'admin', 'admin@rn.com', '01303277836', 'Image\\Profile\\1.jpg', '1234'),
(5, 0, 'test', 'test@rn.com', '01745347312', 'uploads/2.jpg', '123'),
(6, 0, 'Shakil', 'amarnaamshakil@gmail.com', '', '', '1234'),
(7, 0, 'Shakil', 'amarnaamshakil@gmail.com', '01400900413', 'uploads/f.jpg', '1234'),
(8, 0, 'ami', 'ami@rn.com', '019', 'uploads/3.jpg', '123'),
(9, 0, 'nejhum', 'ne@gmail.com', '01624678', 'uploads/3.jpg', '00'),
(10, 0, 'Dewan Md. Easun', 'raisuljohala420@gmai.com', '01635020204', 'uploads/2.jpg', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`b_id`),
  ADD KEY `fk20` (`user_id`);

--
-- Indexes for table `book_order`
--
ALTER TABLE `book_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk1` (`user_id`);

--
-- Indexes for table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `fk76` (`sender_id`),
  ADD KEY `fk67` (`i_id`);

--
-- Indexes for table `exchange`
--
ALTER TABLE `exchange`
  ADD PRIMARY KEY (`e_id`),
  ADD KEY `fk7` (`user_id`),
  ADD KEY `fk8` (`b_id`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`i_id`),
  ADD KEY `fk24` (`user_id`),
  ADD KEY `fk25` (`Reciver_id`);

--
-- Indexes for table `offerbook`
--
ALTER TABLE `offerbook`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk15` (`user_id`),
  ADD KEY `fk16` (`b_id`),
  ADD KEY `fk17` (`e_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `fk4` (`user_id`);

--
-- Indexes for table `react`
--
ALTER TABLE `react`
  ADD PRIMARY KEY (`react_id`),
  ADD KEY `fk5` (`user_id`),
  ADD KEY `fk6` (`p_id`);

--
-- Indexes for table `rent_order`
--
ALTER TABLE `rent_order`
  ADD PRIMARY KEY (`rent_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sell_post`
--
ALTER TABLE `sell_post`
  ADD PRIMARY KEY (`sell_post_id`),
  ADD KEY `fk2` (`user_id`),
  ADD KEY `fk3` (`book_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `book_order`
--
ALTER TABLE `book_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `exchange`
--
ALTER TABLE `exchange`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `i_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `offerbook`
--
ALTER TABLE `offerbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `react`
--
ALTER TABLE `react`
  MODIFY `react_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `rent_order`
--
ALTER TABLE `rent_order`
  MODIFY `rent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sell_post`
--
ALTER TABLE `sell_post`
  MODIFY `sell_post_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `fk20` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `book_order`
--
ALTER TABLE `book_order`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `conversation`
--
ALTER TABLE `conversation`
  ADD CONSTRAINT `fk67` FOREIGN KEY (`i_id`) REFERENCES `inbox` (`i_id`);

--
-- Constraints for table `exchange`
--
ALTER TABLE `exchange`
  ADD CONSTRAINT `fk7` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `fk8` FOREIGN KEY (`b_id`) REFERENCES `books` (`b_id`);

--
-- Constraints for table `offerbook`
--
ALTER TABLE `offerbook`
  ADD CONSTRAINT `fk15` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `fk16` FOREIGN KEY (`b_id`) REFERENCES `books` (`b_id`),
  ADD CONSTRAINT `fk17` FOREIGN KEY (`e_id`) REFERENCES `exchange` (`e_id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk4` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `react`
--
ALTER TABLE `react`
  ADD CONSTRAINT `fk5` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `fk6` FOREIGN KEY (`p_id`) REFERENCES `post` (`p_id`);

--
-- Constraints for table `rent_order`
--
ALTER TABLE `rent_order`
  ADD CONSTRAINT `rent_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `sell_post`
--
ALTER TABLE `sell_post`
  ADD CONSTRAINT `fk2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `fk3` FOREIGN KEY (`book_id`) REFERENCES `books` (`b_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
