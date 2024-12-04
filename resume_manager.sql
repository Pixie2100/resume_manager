-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2024 at 01:42 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resume_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `resume_id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `resume_id`, `company_name`, `link`, `status`, `created_at`, `updated_at`) VALUES
(3, 1, 'EcoTech Enterprises', 'https://fake.indeed.com/jobs/ecotech', 'Applied', '2024-12-03 15:57:27', '2024-12-03 15:57:27'),
(4, 1, 'NextGen Healthcare', 'https://fake.indeed.com/jobs/nextgen-healthcare', 'Applied', '2024-12-03 15:57:52', '2024-12-03 15:57:52'),
(5, 2, 'TechSphere Solutions', 'https://linkedin.com/jobs/techsphere', 'For Interview', '2024-12-03 15:58:21', '2024-12-03 16:09:58'),
(6, 2, 'FinCore Analytics', 'https://linkedin.com/jobs/fincore', 'Applied', '2024-12-03 15:58:45', '2024-12-03 15:58:45'),
(7, 3, 'Visionary Designs Co', 'https://fake.upwork.com/clients/visionary-designs', 'Accepted Offer', '2024-12-03 16:08:56', '2024-12-03 16:09:47'),
(8, 3, 'ContentCraft Media', 'https://fake.upwork.com/clients/contentcraft', 'Offer Extended', '2024-12-03 16:09:30', '2024-12-03 16:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `educations`
--

CREATE TABLE `educations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `resume_id` bigint(20) UNSIGNED NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `degree` varchar(255) DEFAULT NULL,
  `year_started` year(4) DEFAULT NULL,
  `year_ended` year(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `educations`
--

INSERT INTO `educations` (`id`, `resume_id`, `school_name`, `degree`, `year_started`, `year_ended`, `created_at`, `updated_at`) VALUES
(1, 1, 'AdCity College', 'Bachelor of Science in Marketing', '2017', NULL, '2024-12-03 04:12:44', '2024-12-03 04:12:44'),
(2, 2, 'Techville University', 'Bachelor of Science in Computer Science', '2018', '2022', '2024-12-03 04:20:18', '2024-12-03 04:20:18'),
(3, 3, 'DesignTown College', 'Bachelor of Arts in Graphic Design', '2014', '2018', '2024-12-03 16:03:26', '2024-12-03 16:03:26');

-- --------------------------------------------------------

--
-- Table structure for table `employments`
--

CREATE TABLE `employments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `resume_id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `year_started` year(4) DEFAULT NULL,
  `year_ended` year(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employments`
--

INSERT INTO `employments` (`id`, `resume_id`, `company_name`, `position`, `year_started`, `year_ended`, `created_at`, `updated_at`) VALUES
(1, 1, 'AdCity Marketing Group', 'Digital Marketing Specialist', '2017', NULL, '2024-12-03 04:12:44', '2024-12-03 04:12:44'),
(2, 2, 'TechCorp Solutions', 'Junior Software Developer Intern', '2022', '2023', '2024-12-03 04:20:18', '2024-12-03 04:20:18'),
(3, 3, 'Creative Agency X', 'Graphic Designer', '2018', NULL, '2024-12-03 16:03:26', '2024-12-03 16:03:26');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_11_28_034718_create_resumes_table', 1),
(5, '2024_11_28_034941_create_educations_table', 1),
(6, '2024_11_28_035014_create_employments_table', 1),
(7, '2024_11_28_035119_create_skills_table', 1),
(8, '2024_11_28_035135_create_references_table', 1),
(9, '2024_11_28_054255_create_applications_table', 1),
(10, '2024_11_30_002620_add_photo_to_resumes_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `references`
--

CREATE TABLE `references` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `resume_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `references`
--

INSERT INTO `references` (`id`, `resume_id`, `name`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mr. James Taylor', 'james.taylor@adcity.com', '(987) 123-4567', '2024-12-03 04:12:44', '2024-12-03 04:12:44'),
(2, 1, 'Ms. Laura Green', 'laura.green@adcity.com', '(654) 321-9876', '2024-12-03 04:12:44', '2024-12-03 04:12:44'),
(3, 2, 'Dr. Linda Parker', 'linda.parker@example.com', '(123) 456-7890', '2024-12-03 04:20:18', '2024-12-03 04:20:18'),
(4, 2, 'Mr. Mark Adams', 'mark.adams@techcorp.com', '(456) 789-1234', '2024-12-03 04:20:18', '2024-12-03 04:20:18'),
(5, 3, 'Mr. Kevin Adams', 'kevin.adams@agencyx.com', '(333) 456-7890', '2024-12-03 16:03:26', '2024-12-03 16:03:26'),
(6, 3, 'Ms. Lisa Turner', 'lisa.turner@agencyx.com', '(444) 321-0987', '2024-12-03 16:03:26', '2024-12-03 16:03:26');

-- --------------------------------------------------------

--
-- Table structure for table `resumes`
--

CREATE TABLE `resumes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `objectives` text NOT NULL,
  `address` text NOT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `birthplace` varchar(255) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `civil_status` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resumes`
--

INSERT INTO `resumes` (`id`, `name`, `email`, `phone`, `objectives`, `address`, `nickname`, `age`, `sex`, `birthday`, `birthplace`, `father_name`, `mother_name`, `civil_status`, `nationality`, `religion`, `created_at`, `updated_at`, `photo`) VALUES
(1, 'Michael Johnson', 'j.doe@example.com', '(123) 456-7890', 'Creative marketing specialist with expertise in digital marketing and brand management. Adept at developing campaigns that increase online engagement and drive revenue growth.', '123 Market Avenue, AdCity, State,45678', 'Mike', 29, 'Male', '1995-12-06', 'AdCity, State', 'Henry Johnson', 'Lucy Johnson', 'Married', 'American', 'Christianity', '2024-12-03 04:12:44', '2024-12-03 16:31:42', 'photos/NJaFWBXUhBwx6jyORye5RcWeIqIJuRmdOiOPjeys.jpg'),
(2, 'Jane Smith', 'jane.smith@example.com', '(987) 654-3210', 'Innovative IT professional with 2+ years of experience in system administration and software development. Seeking a role as a Systems Analyst to optimize IT infrastructure and deliver scalable solutions.', '456 Elm Street, Techville, State, 67890', 'Jane', 24, 'Female', '2000-12-03', 'Techville City, State', 'Robert Smith', 'Anna Smith', 'Single', 'American', 'Christianity', '2024-12-03 04:20:18', '2024-12-03 15:44:04', 'photos/nr0SG7D7IEvZGIsO1ELlAnaIPuWcR2XPO08TKIDy.jpg'),
(3, 'Sarah Lee', 'sarah.lee@example.com', '(555) 678-9012', 'Experienced graphic designer skilled in creating impactful visual content. Seeking to contribute my design expertise to a dynamic creative team.', '12 Art Street, DesignTown, State, 67890', 'Sarah', 27, 'Female', '1996-05-12', 'DesignTown, State', 'Michael Lee', 'Susan Lee', 'Single', 'Australian', 'Buddhism', '2024-12-03 16:03:26', '2024-12-03 16:05:00', 'photos/EDaNfi4ZPuGal9SfmsV7Xu6SndmZ7ZVpAUGBg2Vt.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2RhMXqWK6Cj5KMP3m8wqrwuIgsFRnT1rJ2yqEp3i', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZWloRlprdHUyRnU1eFNaTFIzMTlNM0ExeUNxb1VVQmp1S1NGZVhmUSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZXN1bWVzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1733272383);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `resume_id` bigint(20) UNSIGNED NOT NULL,
  `skill_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `resume_id`, `skill_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'SEO/SEM strategies', '2024-12-03 04:12:44', '2024-12-03 04:12:44'),
(2, 1, 'Social Media Marketing (Facebook, Instagram)', '2024-12-03 04:12:44', '2024-12-03 04:12:44'),
(3, 1, 'Analytics: Google Analytics, HubSpot', '2024-12-03 04:12:44', '2024-12-03 04:12:44'),
(4, 2, 'Programming: Python, Java, C#', '2024-12-03 04:20:18', '2024-12-03 04:20:18'),
(5, 2, 'Databases: MySQL, PostgreSQL', '2024-12-03 04:20:18', '2024-12-03 04:20:18'),
(6, 2, 'Cloud Platforms: AWS, Azure', '2024-12-03 04:20:18', '2024-12-03 04:20:18'),
(7, 3, 'Adobe Creative Suite (Photoshop, Illustrator, InDesign)', '2024-12-03 16:03:26', '2024-12-03 16:03:26'),
(8, 3, 'Motion Graphics: After Effects', '2024-12-03 16:03:26', '2024-12-03 16:03:26'),
(9, 3, 'Branding and Visual Identity', '2024-12-03 16:03:26', '2024-12-03 16:03:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Angelica Evangelista', 'aevanz0521@gmail.com', NULL, '$2y$12$NwheqDimxWvvq/nSyFIdMOgwY.G6TBEIQnWJWsyRy39zA6ZZeN1Ru', 'nGyaZLgbO6bsnaYpt0v5ClyYxnp7ZJnVZqRICRnlLEMF8voMF3Xph9432aMd', '2024-12-03 03:36:15', '2024-12-03 15:41:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applications_resume_id_foreign` (`resume_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `educations`
--
ALTER TABLE `educations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `educations_resume_id_foreign` (`resume_id`);

--
-- Indexes for table `employments`
--
ALTER TABLE `employments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employments_resume_id_foreign` (`resume_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `references`
--
ALTER TABLE `references`
  ADD PRIMARY KEY (`id`),
  ADD KEY `references_resume_id_foreign` (`resume_id`);

--
-- Indexes for table `resumes`
--
ALTER TABLE `resumes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `skills_resume_id_foreign` (`resume_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `educations`
--
ALTER TABLE `educations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employments`
--
ALTER TABLE `employments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `references`
--
ALTER TABLE `references`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `resumes`
--
ALTER TABLE `resumes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_resume_id_foreign` FOREIGN KEY (`resume_id`) REFERENCES `resumes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `educations`
--
ALTER TABLE `educations`
  ADD CONSTRAINT `educations_resume_id_foreign` FOREIGN KEY (`resume_id`) REFERENCES `resumes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employments`
--
ALTER TABLE `employments`
  ADD CONSTRAINT `employments_resume_id_foreign` FOREIGN KEY (`resume_id`) REFERENCES `resumes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `references`
--
ALTER TABLE `references`
  ADD CONSTRAINT `references_resume_id_foreign` FOREIGN KEY (`resume_id`) REFERENCES `resumes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `skills`
--
ALTER TABLE `skills`
  ADD CONSTRAINT `skills_resume_id_foreign` FOREIGN KEY (`resume_id`) REFERENCES `resumes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
