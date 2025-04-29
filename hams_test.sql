-- -------------------------------------------------------------
-- TablePlus 6.1.8(574)
--
-- https://tableplus.com/
--
-- Database: hms_test
-- Generation Time: 2025-04-29 11:14:18.1430 PM
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE TABLE `appointments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `doctor_id` bigint unsigned DEFAULT NULL,
  `patient_id` bigint unsigned NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `status` enum('pending','confirmed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `appointments_doctor_id_foreign` (`doctor_id`),
  KEY `appointments_patient_id_foreign` (`patient_id`),
  CONSTRAINT `appointments_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `appointments_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `doctor_infos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `doctor_fee` bigint NOT NULL,
  `patient_examination` bigint NOT NULL DEFAULT '10',
  `specialist` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `qualification` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `doctor_infos_user_id_foreign` (`user_id`),
  CONSTRAINT `doctor_infos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `doctor_schedules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `doctor_id` bigint unsigned NOT NULL,
  `day` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `doctor_schedules_doctor_id_foreign` (`doctor_id`),
  CONSTRAINT `doctor_schedules_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `appointments` (`id`, `doctor_id`, `patient_id`, `first_name`, `last_name`, `email`, `mobile`, `appointment_date`, `appointment_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 24, 27, 'Raphael', 'Wintheiser', 'qui', 'ea', '2025-04-29', '17:43:11', 'pending', '2025-04-29 17:43:11', '2025-04-29 17:43:11'),
(2, 24, 29, 'Mavis', 'Sawayn', 'eligendi', 'quia', '2025-04-29', '17:43:11', 'confirmed', '2025-04-29 17:43:11', '2025-04-29 17:43:11'),
(3, 22, 28, 'Edyth', 'Stehr', 'eum', 'aut', '2025-04-29', '17:43:11', 'confirmed', '2025-04-29 17:43:11', '2025-04-29 17:43:11'),
(4, 21, 28, 'Antoinette', 'McGlynn', 'nihil', 'numquam', '2025-04-29', '17:43:11', 'pending', '2025-04-29 17:43:11', '2025-04-29 17:43:11'),
(5, 22, 27, 'Emie', 'Bartoletti', 'est', 'sed', '2025-04-29', '17:43:11', 'pending', '2025-04-29 17:43:11', '2025-04-29 17:43:11'),
(6, 18, 28, 'Carey', 'Hagenes', 'asperiores', 'nam', '2025-04-29', '17:43:11', 'pending', '2025-04-29 17:43:11', '2025-04-29 17:43:11'),
(7, 24, 27, 'Jacquelyn', 'Bosco', 'suscipit', 'repellat', '2025-04-29', '17:43:11', 'confirmed', '2025-04-29 17:43:11', '2025-04-29 17:43:11'),
(8, 23, 28, 'Merle', 'Hintz', 'deleniti', 'suscipit', '2025-04-29', '17:43:11', 'confirmed', '2025-04-29 17:43:11', '2025-04-29 17:43:11'),
(9, 16, 27, 'Kane', 'Wiza', 'eius', 'corporis', '2025-04-29', '17:43:11', 'pending', '2025-04-29 17:43:11', '2025-04-29 17:43:11'),
(10, 21, 29, 'Aiyana', 'O\'Connell', 'sint', 'quo', '2025-04-29', '17:43:11', 'confirmed', '2025-04-29 17:43:11', '2025-04-29 17:43:11'),
(11, 16, 29, 'Tina', 'Robel', 'optio', 'soluta', '2025-04-29', '17:43:11', 'confirmed', '2025-04-29 17:43:11', '2025-04-29 17:43:11'),
(12, 19, 28, 'Jaquan', 'Ullrich', 'id', 'perferendis', '2025-04-29', '17:43:11', 'pending', '2025-04-29 17:43:11', '2025-04-29 17:43:11'),
(13, 21, 20, 'Rodrick', 'Mante', 'voluptatem', 'sunt', '2025-04-29', '17:43:11', 'confirmed', '2025-04-29 17:43:11', '2025-04-29 17:43:11'),
(14, 18, 20, 'Cordelia', 'Skiles', 'nostrum', 'vel', '2025-04-29', '17:43:11', 'pending', '2025-04-29 17:43:11', '2025-04-29 17:43:11'),
(15, 18, 30, 'Estefania', 'Ebert', 'non', 'cumque', '2025-04-29', '17:43:11', 'pending', '2025-04-29 17:43:11', '2025-04-29 17:43:11');

INSERT INTO `doctor_infos` (`id`, `user_id`, `doctor_fee`, `patient_examination`, `specialist`, `description`, `qualification`) VALUES
(1, 16, 2500, 10, 'Orthopedic Surgeon', 'Explicabo laboriosam minima aspernatur reprehenderit officiis. Est ipsam totam iusto sed aperiam. Impedit voluptate aliquid exercitationem porro est quod. Facilis debitis impedit veritatis consequatur facere autem vitae.', 'Et illo sapiente molestias dolores consequatur tenetur. Et enim saepe optio quod et non. Eligendi molestiae quae quia ipsum error est facilis sint. Quo est est non eos ea fugiat consequatur.'),
(2, 18, 2000, 15, 'Neurologist', 'Quibusdam repellat ipsam natus vel officiis accusantium. Sapiente consectetur ut error similique est excepturi qui dignissimos. Cum alias voluptatem eos vel pariatur. Beatae voluptatem in fugit nostrum omnis ipsa nulla.', 'Iusto maxime doloribus eos quod corporis. Aut laudantium quia ut enim.'),
(3, 21, 2000, 25, 'Obstetrician', 'Ut nisi hic et dolorem dolor. Sequi similique expedita velit fuga in. Consequatur dolorem nihil molestiae qui sed eos. Ad alias sint vitae quia sed sed.', 'Minima et molestias vel non a. Ut aut velit quo. Laboriosam quibusdam distinctio nemo iusto.'),
(4, 22, 1500, 15, 'Radiologist', 'Molestiae blanditiis ut tempora et iure aliquid quae. Vel aut beatae eos. Molestias omnis quis omnis quas ex sapiente. Commodi laudantium corrupti quo et adipisci atque minus. Quia quibusdam repellendus incidunt aliquam molestiae.', 'Quia beatae quis velit quo culpa facilis ratione. Enim dignissimos consequatur amet assumenda consequuntur. Officia temporibus est aut quia cum dolorem.'),
(5, 23, 2500, 15, 'Neurologist', 'Voluptates eos provident dolore repellat qui. Magni at et autem autem ea culpa optio.', 'Placeat dolor soluta sunt nobis voluptatem. Itaque quasi facere sapiente dolor. Voluptas asperiores magni enim rerum. Unde qui vel quae consequatur omnis.'),
(6, 24, 2000, 20, 'Dermatologist', 'Nesciunt repudiandae quos molestias esse et. Modi atque est ut autem dolor. Et eligendi officia unde fuga ea. Illo aut aut veniam non et natus eos.', 'Eum est voluptas est voluptatem et qui non. Adipisci sapiente aut perferendis voluptatem. Dicta necessitatibus et soluta aut autem sit. Itaque commodi unde quos dolores.'),
(7, 25, 1500, 10, 'Obstetrician', 'Voluptatem aliquid est placeat nemo ullam voluptas. Et voluptas dolorem similique et sunt voluptatem. Fuga eius et fugiat at nemo porro.', 'Vel laboriosam sit placeat blanditiis iste dicta molestiae. Aut facilis voluptatum enim adipisci voluptate est sit. Et doloribus voluptates quisquam est.');

INSERT INTO `doctor_schedules` (`id`, `doctor_id`, `day`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(1, 19, 'Tuesday', '16:46:13', '00:46:13', '2025-04-28 16:46:13', '2025-04-28 16:46:13'),
(2, 19, 'Thursday', '16:46:13', '00:46:13', '2025-04-28 16:46:13', '2025-04-28 16:46:13'),
(3, 19, 'Tuesday', '16:46:13', '00:46:13', '2025-04-28 16:46:13', '2025-04-28 16:46:13'),
(4, 19, 'Thursday', '16:46:13', '00:46:13', '2025-04-28 16:46:13', '2025-04-28 16:46:13'),
(5, 19, 'Thursday', '16:46:13', '00:46:13', '2025-04-28 16:46:13', '2025-04-28 16:46:13'),
(6, 19, 'Wednesday', '16:46:13', '00:46:13', '2025-04-28 16:46:13', '2025-04-28 16:46:13'),
(7, 19, 'Tuesday', '16:46:13', '00:46:13', '2025-04-28 16:46:13', '2025-04-28 16:46:13'),
(8, 21, 'Monday', '17:43:11', '01:43:11', '2025-04-29 17:43:11', '2025-04-29 17:43:11'),
(9, 22, 'Thursday', '17:43:11', '01:43:11', '2025-04-29 17:43:11', '2025-04-29 17:43:11'),
(10, 23, 'Friday', '17:43:11', '01:43:11', '2025-04-29 17:43:11', '2025-04-29 17:43:11'),
(11, 24, 'Tuesday', '17:43:11', '01:43:11', '2025-04-29 17:43:11', '2025-04-29 17:43:11'),
(12, 25, 'Friday', '17:43:11', '01:43:11', '2025-04-29 17:43:11', '2025-04-29 17:43:11');

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2025_01_01_000000_create_users_table', 1),
(4, '2025_04_21_084404_create_permission_tables', 1),
(5, '2025_04_22_061804_create_doctor_info', 1),
(6, '2025_04_24_152451_create_doctor_schedules_table', 1),
(7, '2025_04_26_152158_create_appointments_table', 1),
(8, '2025_04_28_153910_create_medical_records_table', 1),
(9, '2025_04_28_154149_create_prescriptions_table', 1);

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 15),
(2, 'App\\Models\\User', 16),
(2, 'App\\Models\\User', 17),
(2, 'App\\Models\\User', 18),
(2, 'App\\Models\\User', 19),
(2, 'App\\Models\\User', 21),
(2, 'App\\Models\\User', 22),
(2, 'App\\Models\\User', 23),
(2, 'App\\Models\\User', 24),
(2, 'App\\Models\\User', 25),
(3, 'App\\Models\\User', 20),
(3, 'App\\Models\\User', 26),
(3, 'App\\Models\\User', 27),
(3, 'App\\Models\\User', 28),
(3, 'App\\Models\\User', 29),
(3, 'App\\Models\\User', 30);

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view dashboard', 'web', '2025-04-29 17:43:10', '2025-04-29 17:43:10'),
(2, 'create doctor', 'web', '2025-04-29 17:43:10', '2025-04-29 17:43:10'),
(3, 'edit doctor', 'web', '2025-04-29 17:43:10', '2025-04-29 17:43:10'),
(4, 'delete doctor', 'web', '2025-04-29 17:43:10', '2025-04-29 17:43:10'),
(5, 'view doctor', 'web', '2025-04-29 17:43:10', '2025-04-29 17:43:10'),
(6, 'create patients', 'web', '2025-04-29 17:43:10', '2025-04-29 17:43:10'),
(7, 'view patients', 'web', '2025-04-29 17:43:10', '2025-04-29 17:43:10'),
(8, 'edi patients', 'web', '2025-04-29 17:43:10', '2025-04-29 17:43:10'),
(9, 'delete patients', 'web', '2025-04-29 17:43:10', '2025-04-29 17:43:10'),
(10, 'view appointments', 'web', '2025-04-29 17:43:10', '2025-04-29 17:43:10'),
(11, 'edit appointments', 'web', '2025-04-29 17:43:10', '2025-04-29 17:43:10'),
(12, 'create appointments', 'web', '2025-04-29 17:43:10', '2025-04-29 17:43:10'),
(13, 'delete appointments', 'web', '2025-04-29 17:43:10', '2025-04-29 17:43:10'),
(14, 'approveOrCancel appointments', 'web', '2025-04-29 17:43:10', '2025-04-29 17:43:10'),
(15, 'view medical records', 'web', '2025-04-29 17:43:10', '2025-04-29 17:43:10'),
(16, 'edit medical records', 'web', '2025-04-29 17:43:10', '2025-04-29 17:43:10'),
(17, 'create medical records', 'web', '2025-04-29 17:43:10', '2025-04-29 17:43:10'),
(18, 'delete medical records', 'web', '2025-04-29 17:43:10', '2025-04-29 17:43:10'),
(19, 'view prescriptions', 'web', '2025-04-29 17:43:10', '2025-04-29 17:43:10'),
(20, 'edit prescriptions', 'web', '2025-04-29 17:43:10', '2025-04-29 17:43:10'),
(21, 'create prescriptions', 'web', '2025-04-29 17:43:10', '2025-04-29 17:43:10'),
(22, 'delete prescriptions', 'web', '2025-04-29 17:43:10', '2025-04-29 17:43:10');

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(10, 2),
(10, 3),
(11, 1),
(11, 3),
(12, 1),
(12, 2),
(12, 3),
(13, 1),
(13, 2),
(13, 3),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(15, 3),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(19, 3),
(20, 1),
(20, 2),
(21, 1),
(21, 2),
(22, 1),
(22, 2);

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-04-29 17:43:10', '2025-04-29 17:43:10'),
(2, 'doctor', 'web', '2025-04-29 17:43:10', '2025-04-29 17:43:10'),
(3, 'patients', 'web', '2025-04-29 17:43:10', '2025-04-29 17:43:10');

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `mobile`, `password`, `address`, `city`, `zip`, `image`, `date_of_birth`, `gender`, `status`, `remember_token`, `email_verified_at`, `created_at`, `updated_at`) VALUES
(15, 'Kautzer', 'Metz', 'admin@gmail.com', '706943973', '$2y$04$Gz5jfhHJSHD3jpyyzS5Z6Otr36d4IpgeQMTMQuTu0HycST2cZgatK', '578 Santino Fort\nSouth Katrina, GA 83448-0550', 'South Soniashire', '36872-5141', NULL, '1984-03-17', 'female', 'inactive', 'Fa1j6YqzVZ', '2025-04-28 16:46:13', '2025-04-28 16:46:13', '2025-04-28 16:46:13'),
(16, 'Zulauf', 'Moore', 'doctor@gmail.com', '504415971', '$2y$04$M8ugYC5hZ.p4Wr6VP/BSlORjjzqRK2RejJFRKSx15XCCT7BcPjr3e', '6930 Chaim Plains\nNew Lorenzo, MN 02177-2938', 'West Barrett', '45778', NULL, '1991-01-12', 'female', 'active', 'Em26Fm7FVx', '2025-04-28 16:46:13', '2025-04-28 16:46:13', '2025-04-28 16:46:13'),
(17, 'Friesen', 'Corwin', 'nienow.elenor@example.net', '133544429', '$2y$04$S0PpP1EVJKCE.PFgTtTDJO9Y7kjr1nvEoyzwRW12S8Y/9A78/SzY6', '1485 Lorenzo Forest\nTerryhaven, OH 21868', 'Lake Taurean', '98298-1594', NULL, '1981-08-15', 'female', 'inactive', 'y5gQazJ2UO', '2025-04-28 16:46:13', '2025-04-28 16:46:13', '2025-04-28 16:46:13'),
(18, 'Pagac', 'Bergnaum', 'qmurphy@example.net', '15953827', '$2y$04$S0PpP1EVJKCE.PFgTtTDJO9Y7kjr1nvEoyzwRW12S8Y/9A78/SzY6', '412 Erdman Ramp\nBrookebury, WY 20350-6911', 'Anitaport', '88615', NULL, '2000-06-22', 'male', 'inactive', 'dWc8ODgQcv', '2025-04-28 16:46:13', '2025-04-28 16:46:13', '2025-04-28 16:46:13'),
(19, 'Hansen', 'Walker', 'daisha75@example.org', '476647556', '$2y$04$S0PpP1EVJKCE.PFgTtTDJO9Y7kjr1nvEoyzwRW12S8Y/9A78/SzY6', '84180 Gaylord Freeway Suite 171\nMillstown, IN 00385', 'Mohrfort', '69359', NULL, '1991-05-14', 'male', 'inactive', 'T0xEXBE4Op', '2025-04-28 16:46:13', '2025-04-28 16:46:13', '2025-04-28 16:46:13'),
(20, 'Boehm', 'Schneider', 'patients@gmail.com', '806572902', '$2y$12$.80Fau6v5GdpVqqkswfviOlObuzGgAEDGxM4cuS62zm3RBmzCCdSm', '45659 Cleveland Hollow\nEast Salma, AL 42875', 'Buckridgeland', '83552-9543', NULL, '1980-02-26', 'male', 'inactive', 'v0pYTDH6JP', '2025-04-29 17:43:10', '2025-04-29 17:43:10', '2025-04-29 17:43:10'),
(21, 'Shanahan', 'O\'Conner', 'cronin.louvenia@example.com', '240474151', '$2y$12$JcdILpR2nSQuCzU5ULQmr.HDnKu9gQWvNSVFyjV0EFc1jbPyGfily', '94198 Ernser Drives Suite 876\nRylanborough, OR 29609-6605', 'Jeremiehaven', '04144', NULL, '2002-05-15', 'male', 'active', 'Kc154ewxjg', '2025-04-29 17:43:11', '2025-04-29 17:43:11', '2025-04-29 17:43:11'),
(22, 'Ritchie', 'Braun', 'cheyenne84@example.net', '372658361', '$2y$12$JcdILpR2nSQuCzU5ULQmr.HDnKu9gQWvNSVFyjV0EFc1jbPyGfily', '2902 Janiya Parks\nDanialton, NC 57453', 'Wayneborough', '01795', NULL, '1995-04-26', 'female', 'inactive', 'Ptexmao63Q', '2025-04-29 17:43:11', '2025-04-29 17:43:11', '2025-04-29 17:43:11'),
(23, 'Hermiston', 'Schaefer', 'tillman.benedict@example.org', '105877058', '$2y$12$JcdILpR2nSQuCzU5ULQmr.HDnKu9gQWvNSVFyjV0EFc1jbPyGfily', '494 Lura Cliffs Suite 618\nNew Clarabelleborough, MO 15305', 'Brianneview', '03296-1893', NULL, '1991-04-26', 'male', 'inactive', 'aGoOh0xhuN', '2025-04-29 17:43:11', '2025-04-29 17:43:11', '2025-04-29 17:43:11'),
(24, 'Macejkovic', 'Streich', 'ajakubowski@example.org', '460320821', '$2y$12$JcdILpR2nSQuCzU5ULQmr.HDnKu9gQWvNSVFyjV0EFc1jbPyGfily', '7417 Shaniya Lane\nMyashire, AK 48958-6071', 'North Antonio', '42171-1288', NULL, '1981-02-25', 'female', 'active', 'IZn93Xrtwq', '2025-04-29 17:43:11', '2025-04-29 17:43:11', '2025-04-29 17:43:11'),
(25, 'Gulgowski', 'Schmitt', 'loyce74@example.com', '229656465', '$2y$12$JcdILpR2nSQuCzU5ULQmr.HDnKu9gQWvNSVFyjV0EFc1jbPyGfily', '80781 Hermann Forks Suite 576\nNew Angela, VA 23759', 'Thompsonhaven', '36891-2443', NULL, '1981-11-29', 'female', 'inactive', 'QTEOnZHca8', '2025-04-29 17:43:11', '2025-04-29 17:43:11', '2025-04-29 17:43:11'),
(26, 'Hansen', 'Rempel', 'ernestina.orn@example.org', '368428668', '$2y$12$JcdILpR2nSQuCzU5ULQmr.HDnKu9gQWvNSVFyjV0EFc1jbPyGfily', '56205 Shakira Spring\nElroychester, MO 14999-4027', 'New Maymieport', '87247-3328', NULL, '1975-05-06', 'female', 'active', 'pJzg29EVRV', '2025-04-29 17:43:11', '2025-04-29 17:43:11', '2025-04-29 17:43:11'),
(27, 'Klocko', 'Stark', 'tbeatty@example.net', '411008627', '$2y$12$JcdILpR2nSQuCzU5ULQmr.HDnKu9gQWvNSVFyjV0EFc1jbPyGfily', '857 Makenna Centers Suite 240\nRandifort, NV 75701', 'East Emmetburgh', '87463', NULL, '1979-05-25', 'female', 'inactive', 'j3v9vX6Nq1', '2025-04-29 17:43:11', '2025-04-29 17:43:11', '2025-04-29 17:43:11'),
(28, 'Rau', 'Kuhlman', 'lynn.maggio@example.org', '711415745', '$2y$12$JcdILpR2nSQuCzU5ULQmr.HDnKu9gQWvNSVFyjV0EFc1jbPyGfily', '663 Ritchie Circles\nNorth Anaisberg, AK 45414-2451', 'Roweport', '29822', NULL, '1985-11-17', 'male', 'active', 'v16ZxURD4f', '2025-04-29 17:43:11', '2025-04-29 17:43:11', '2025-04-29 17:43:11'),
(29, 'Aufderhar', 'Kihn', 'pfeffer.maxie@example.net', '547295563', '$2y$12$JcdILpR2nSQuCzU5ULQmr.HDnKu9gQWvNSVFyjV0EFc1jbPyGfily', '3077 Jamarcus Crescent Suite 877\nNew Tomasa, IL 97753-6492', 'South Augustineport', '19162-2371', NULL, '2004-03-23', 'male', 'active', 'hCPo1LX4qs', '2025-04-29 17:43:11', '2025-04-29 17:43:11', '2025-04-29 17:43:11'),
(30, 'Larson', 'Gottlieb', 'kskiles@example.net', '542415864', '$2y$12$JcdILpR2nSQuCzU5ULQmr.HDnKu9gQWvNSVFyjV0EFc1jbPyGfily', '7362 Carmine Landing\nSouth Raymondside, MS 95237-4755', 'Destineybury', '93714-4897', NULL, '1986-08-10', 'female', 'active', 'BHsSQERVec', '2025-04-29 17:43:11', '2025-04-29 17:43:11', '2025-04-29 17:43:11');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;