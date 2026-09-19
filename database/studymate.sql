-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2026 at 10:47 PM
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
-- Database: `studymate`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` text NOT NULL,
  `answered_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `answer`, `answered_by`, `created_at`) VALUES
(5, 7, '*Encapsulation\r\n*Inheritance\r\n*Polymorphism\r\n*Abstraction', 8, '2026-09-02 19:31:58'),
(6, 8, 'Pick for vs while: Use for if you know the number of steps or are looping through a list. Use while if you are waiting for a condition to change.', 2, '2026-09-02 19:34:55');

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `joined_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `group_members`
--

INSERT INTO `group_members` (`id`, `group_id`, `user_id`, `joined_at`) VALUES
(8, 5, 2, '2026-08-29 17:23:40'),
(9, 7, 2, '2026-08-30 11:12:20');

-- --------------------------------------------------------

--
-- Table structure for table `group_messages`
--

CREATE TABLE `group_messages` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `question` text NOT NULL,
  `asked_by` int(11) NOT NULL,
  `faculty` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `title`, `question`, `asked_by`, `faculty`, `created_at`) VALUES
(4, 'Company Management', 'Principles of Management concepts ?', 3, 'Faculty of Business', '2026-08-30 05:28:07'),
(5, 'Fluid Mechanics', 'For a vertically submerged flat rectangular plate in a static liquid, where is the center of pressure located relative to the centroid of the plate?', 5, 'Faculty of Engineering', '2026-08-30 11:03:52'),
(7, 'Java(OOP concept)', 'What are the oop concepts in java?', 2, 'Faculty of Computing', '2026-09-02 19:25:08'),
(8, 'Python loops', 'How can I solve Python loops easily?', 8, 'Faculty of Computing', '2026-09-02 19:34:24');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `faculty` varchar(100) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `uploaded_by` int(11) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `title`, `description`, `faculty`, `file_name`, `uploaded_by`, `uploaded_at`, `status`) VALUES
(4, 'Test Resource', 'Testing approval system', 'Faculty of Business', '1788014658_ALGO - TUTE.pdf', 3, '2026-08-29 14:44:18', 'Rejected'),
(5, 'Test Resource', 'Testing approval system', 'Faculty of Business', '1788014850_ALGO - TUTE.pdf', 3, '2026-08-29 14:47:30', 'Approved'),
(6, 'Web', 'Connect PHP to a MySQL database', 'Faculty of Computing', '1788027875_Inclass Assignment 26.1 batch.pdf', 2, '2026-08-29 18:24:35', 'Approved'),
(7, 'Java Notes', 'Last week java notes', 'Faculty of Computing', '1788065223_ALGO - TUTE.pdf', 2, '2026-08-30 04:47:03', 'Rejected'),
(9, 'The Thermal Vent', 'Last week notes', 'Faculty of Engineering', '1788087674_ALGO - TUTE.pdf', 5, '2026-08-30 11:01:14', 'Approved'),
(10, 'Test', 'Test', 'Faculty of Computing', '1788354285_L7. Iteration and Recursion.pptx', 2, '2026-09-02 13:04:45', 'Approved'),
(12, 'Microbiology', 'Testing', 'Faculty of Science', '1788376861_L8. Complexity.pptx', 7, '2026-09-02 19:21:01', 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `resource_comments`
--

CREATE TABLE `resource_comments` (
  `id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resource_comments`
--

INSERT INTO `resource_comments` (`id`, `resource_id`, `user_id`, `comment`, `created_at`) VALUES
(1, 5, 1, 'Very Useful', '2026-08-29 17:54:12');

-- --------------------------------------------------------

--
-- Table structure for table `resource_ratings`
--

CREATE TABLE `resource_ratings` (
  `id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resource_ratings`
--

INSERT INTO `resource_ratings` (`id`, `resource_id`, `user_id`, `rating`, `created_at`) VALUES
(1, 5, 1, 5, '2026-08-29 17:54:18');

-- --------------------------------------------------------

--
-- Table structure for table `study_groups`
--

CREATE TABLE `study_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `faculty` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `study_groups`
--

INSERT INTO `study_groups` (`id`, `group_name`, `description`, `faculty`, `created_by`, `created_at`) VALUES
(5, 'New Test Group', 'Testing', 'Faculty of Computing', 2, '2026-08-29 16:20:06'),
(7, 'Team Avatar', 'Java', 'Faculty of Computing', 2, '2026-08-30 11:12:20');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `faculty` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `university_email` varchar(100) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `faculty` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(20) NOT NULL DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `university_email`, `student_id`, `faculty`, `password`, `created_at`, `role`) VALUES
(1, 'Admin', 'admin@test.com', 'NSBM001', 'None', '$2y$10$3mSaAHHQ2D1Oc6VCrwM4ZukOzZjnNWr3JAyCT3OHpwui7CZqym6P6', '2026-07-27 10:37:15', 'admin'),
(2, 'Ama Rathnayaka', 'ama@test.com', 'NSBM002', 'Faculty of Computing', '$2y$10$ioLMyCjdHqM9XuP9aB1O/OrI76UrCTEtgaEzCG4xrYHbR8kTMIPU6', '2026-07-27 11:56:04', 'student'),
(3, 'Pasindu Fernando', 'pasindu@test.com', 'NSBM003', 'Faculty of Business', '$2y$10$V.T4TNtZMs3eZIo1ud0XLexuE9V.OhPB6H0/8m0yrglvkQb.846J6', '2026-07-27 15:33:56', 'student'),
(5, 'Senura Rathnayaka', 'senura@test.com', 'NSBM004', 'Faculty of Engineering', '$2y$10$ASfzq35NBAKhz0GDUGi9i.eyD/coSJl9Bt5gJ3C14wJdsrrT.A3Le', '2026-08-30 05:32:33', 'student'),
(7, 'Kasun Perera', 'kasun@test.com', 'NSBM005', 'Faculty of Science', '$2y$10$Rtizv0INoX3vDevo9iHUdei3EmUFDyCza3HTTnDZ9vi14Arcb9h9K', '2026-09-02 19:10:40', 'student'),
(8, 'Chanithu Rathnayaka', 'chanithu@test.com', 'NSBM006', 'Faculty of Computing', '$2y$10$31/h6GCsmngikJ/mz5eoVu7/MXLRiqAiwvirnFaQjLEGAwhU/19wO', '2026-09-02 19:28:29', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `answered_by` (`answered_by`);

--
-- Indexes for table `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_group_user` (`group_id`,`user_id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `group_messages`
--
ALTER TABLE `group_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asked_by` (`asked_by`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uploaded_by` (`uploaded_by`);

--
-- Indexes for table `resource_comments`
--
ALTER TABLE `resource_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resource_id` (`resource_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `resource_ratings`
--
ALTER TABLE `resource_ratings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_resource_user` (`resource_id`,`user_id`),
  ADD KEY `resource_id` (`resource_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `study_groups`
--
ALTER TABLE `study_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `university_email` (`university_email`),
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `group_members`
--
ALTER TABLE `group_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `group_messages`
--
ALTER TABLE `group_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `resource_comments`
--
ALTER TABLE `resource_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `resource_ratings`
--
ALTER TABLE `resource_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `study_groups`
--
ALTER TABLE `study_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`answered_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `group_members`
--
ALTER TABLE `group_members`
  ADD CONSTRAINT `group_members_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `study_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_members_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `group_messages`
--
ALTER TABLE `group_messages`
  ADD CONSTRAINT `group_messages_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `study_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_messages_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`asked_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `resources`
--
ALTER TABLE `resources`
  ADD CONSTRAINT `resources_ibfk_1` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `resource_comments`
--
ALTER TABLE `resource_comments`
  ADD CONSTRAINT `resource_comments_ibfk_1` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `resource_comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `resource_ratings`
--
ALTER TABLE `resource_ratings`
  ADD CONSTRAINT `resource_ratings_ibfk_1` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `resource_ratings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `study_groups`
--
ALTER TABLE `study_groups`
  ADD CONSTRAINT `study_groups_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
