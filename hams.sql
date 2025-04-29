-- -------------------------------------------------------------
-- TablePlus 6.1.8(574)
--
-- https://tableplus.com/
--
-- Database: hms
-- Generation Time: 2025-04-29 11:06:28.7620 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `medical_records` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` bigint unsigned NOT NULL,
  `doctor_id` bigint unsigned NOT NULL,
  `diagnosis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `record_date` date NOT NULL DEFAULT '2025-04-29',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `medical_records_patient_id_foreign` (`patient_id`),
  KEY `medical_records_doctor_id_foreign` (`doctor_id`),
  CONSTRAINT `medical_records_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `medical_records_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `prescriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `doctor_id` bigint unsigned DEFAULT NULL,
  `patient_id` bigint unsigned DEFAULT NULL,
  `medication_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dosage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `frequency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `prescribed_date` date NOT NULL DEFAULT '2025-04-29',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prescriptions_doctor_id_foreign` (`doctor_id`),
  KEY `prescriptions_patient_id_foreign` (`patient_id`),
  CONSTRAINT `prescriptions_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `prescriptions_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `appointments` (`id`, `doctor_id`, `patient_id`, `first_name`, `last_name`, `email`, `mobile`, `appointment_date`, `appointment_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, 11, 'Yvonne', 'Grady', 'aut', 'vel', '2025-04-29', '03:36:06', 'pending', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(2, 5, 12, 'Antonina', 'Kiehn', 'labore', 'quas', '2025-04-29', '03:36:06', 'confirmed', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(3, 4, 9, 'Keyon', 'Smith', 'repudiandae', 'in', '2025-04-29', '03:36:06', 'pending', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(4, 2, 12, 'Flavie', 'Hartmann', 'enim', 'aut', '2025-04-29', '03:36:06', 'pending', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(5, 6, 11, 'Enoch', 'Kling', 'qui', 'quam', '2025-04-29', '03:36:06', 'confirmed', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(6, 2, 9, 'Lulu', 'Hauck', 'accusamus', 'sit', '2025-04-29', '03:36:06', 'confirmed', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(7, 5, 12, 'Emanuel', 'Howell', 'magnam', 'quam', '2025-04-29', '03:36:06', 'confirmed', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(8, 4, 11, 'Yessenia', 'Runte', 'beatae', 'et', '2025-04-29', '03:36:06', 'confirmed', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(9, 6, 9, 'Scotty', 'Hansen', 'id', 'delectus', '2025-04-29', '03:36:06', 'pending', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(10, 6, 10, 'Marcelle', 'Huel', 'laboriosam', 'aperiam', '2025-04-29', '03:36:06', 'confirmed', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(11, 2, 10, 'Grayson', 'Goodwin', 'illum', 'cupiditate', '2025-04-29', '03:36:06', 'confirmed', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(12, 2, 8, 'Pablo', 'Bins', 'ut', 'reprehenderit', '2025-04-29', '03:36:06', 'confirmed', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(13, 2, 9, 'Arne', 'Watsica', 'commodi', 'quas', '2025-04-29', '03:36:06', 'pending', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(14, 3, 12, 'Georgianna', 'Dickinson', 'facilis', 'et', '2025-04-29', '03:36:06', 'confirmed', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(15, 6, 11, 'Corine', 'Rath', 'quod', 'et', '2025-04-29', '03:36:06', 'confirmed', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(16, 3, 13, 'Mother', 'Name', 'mother@gmail.com', '433345', '2025-05-01', '03:46:00', 'pending', '2025-04-29 11:27:03', '2025-04-29 11:27:03'),
(17, 2, 13, 'John', 'Test', 'test@gmail.com', '132456', '2025-05-01', '03:51:00', 'confirmed', '2025-04-29 17:13:34', '2025-04-29 17:15:04');

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_patient@gmai.com|127.0.0.1', 'i:1;', 1745944857),
('laravel_cache_patient@gmai.com|127.0.0.1:timer', 'i:1745944857;', 1745944857),
('laravel_cache_spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:22:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:14:\"view dashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:13:\"create doctor\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:11:\"edit doctor\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:13:\"delete doctor\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:11:\"view doctor\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:15:\"create patients\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:13:\"view patients\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:12:\"edi patients\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:15:\"delete patients\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:17:\"view appointments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:17:\"edit appointments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:19:\"create appointments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:19:\"delete appointments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:28:\"approveOrCancel appointments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:20:\"view medical records\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:20:\"edit medical records\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:22:\"create medical records\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:22:\"delete medical records\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:18:\"view prescriptions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:18:\"edit prescriptions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:20:\"create prescriptions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:20:\"delete prescriptions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}}s:5:\"roles\";a:3:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:6:\"doctor\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:8:\"patients\";s:1:\"c\";s:3:\"web\";}}}', 1745985925);

INSERT INTO `doctor_infos` (`id`, `user_id`, `doctor_fee`, `patient_examination`, `specialist`, `description`, `qualification`) VALUES
(1, 2, 1000, 15, 'Obstetrician', 'Aut id ut expedita tempore dolorum reiciendis quisquam. Non ut mollitia vel vel eos expedita. Vitae praesentium provident ipsum aut optio.', 'Autem quam aut eligendi minima atque provident. Amet consequatur in sunt porro nesciunt vero. Eum et qui delectus.'),
(2, 3, 1500, 10, 'Rheumatologist', 'Nam vero quia consequatur accusantium quia. Quod et dolor in. Cumque non officia cupiditate omnis nemo minima.', 'Laboriosam voluptatibus officia atque occaecati est. Libero harum corporis dolorum ab. Eum id porro qui et accusamus.'),
(3, 4, 1000, 25, 'Obstetrician', 'Eaque et ea dolor. Voluptas sint et et deleniti et labore voluptate. Quia quas deserunt laboriosam ut molestiae natus quia esse. Et aut dolorum voluptatem eos iusto voluptatem consectetur.', 'Aut dignissimos suscipit eius quidem. Quia nihil provident hic. Earum autem quasi id voluptate non saepe quibusdam illo.'),
(4, 5, 1500, 20, 'Neurologist', 'Consequatur doloribus debitis voluptatem qui. Illo sit quia est voluptas inventore. Rem incidunt omnis consequuntur.', 'Possimus quod quidem sed veritatis labore. Dolore tempore in non porro dolorem. Quasi recusandae illo et est dicta quis.'),
(5, 6, 1000, 25, 'Neurologist', 'Sunt quia dolor blanditiis nihil at. Itaque commodi vero rerum iste architecto. Explicabo maxime placeat fuga fugit voluptates. Iure qui non nostrum minima corrupti.', 'Provident accusamus nihil praesentium possimus qui voluptatem ut. Asperiores ducimus unde qui vel molestiae et dolor.'),
(6, 7, 1000, 15, 'Dermatologist', 'Hic tempora ut ad. Autem voluptatum officia est voluptatem reiciendis. Rerum commodi blanditiis quia explicabo eius.', 'Ut et et molestiae amet. Aperiam similique vel qui impedit. Ducimus iste ut inventore quod in corrupti animi. Maiores vitae esse sit.');

INSERT INTO `doctor_schedules` (`id`, `doctor_id`, `day`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(1, 3, 'Thursday', '03:36:06', '11:36:06', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(2, 4, 'Thursday', '03:36:06', '11:36:06', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(3, 5, 'Thursday', '03:36:06', '11:36:06', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(4, 6, 'Thursday', '03:36:06', '11:36:06', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(5, 2, 'Thursday', '03:36:06', '11:36:06', '2025-04-29 03:36:06', '2025-04-29 03:36:06');

INSERT INTO `medical_records` (`id`, `patient_id`, `doctor_id`, `diagnosis`, `notes`, `record_date`, `created_at`, `updated_at`) VALUES
(1, 10, 6, 'Qui beatae consectetur.', 'Adipisci iusto modi dolorem voluptatem quis fugit. Voluptatem quisquam nam cum sed debitis impedit. Sequi magnam saepe ipsa ipsam in deserunt.', '1994-08-25', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(2, 10, 6, 'Ipsam voluptates sint.', 'Soluta et ea amet et qui in. Aut quaerat eaque aspernatur deserunt. Excepturi deleniti voluptates optio ea excepturi. Corporis sequi qui numquam omnis sint dolores.', '2020-06-27', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(3, 10, 6, 'Animi voluptas hic ea.', 'Architecto odit quod rerum. Consequuntur ut qui sit sit vitae iusto soluta sapiente. Delectus non consectetur sint voluptatem pariatur et. Vero laboriosam sed quas praesentium ipsum earum eligendi.', '1973-10-26', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(4, 10, 6, 'Ut modi repudiandae.', 'Quos incidunt sit quibusdam odit. Non aut delectus labore. Facilis voluptatem quis magni ex eum corrupti laudantium quisquam.', '1988-03-01', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(5, 10, 6, 'Rerum minus quam.', 'Libero deleniti et quisquam. Non ullam in nihil dolor. Maxime quaerat non exercitationem explicabo modi.', '2017-11-15', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(6, 10, 6, 'Harum velit perspiciatis.', 'Maxime aut fugiat quo. Cupiditate mollitia non vitae alias. Qui quia corrupti alias. Illum enim occaecati explicabo id qui sunt.', '1994-10-25', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(7, 10, 6, 'Est eveniet sed.', 'Aut quibusdam ipsa sunt. Repudiandae amet dignissimos quisquam fuga eum et officia. Voluptatum fugiat veritatis nihil excepturi sed similique aperiam. Autem ipsa eum reprehenderit explicabo nemo sed non.', '1972-08-18', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(8, 10, 6, 'Quos nisi.', 'Ex autem qui eum in non. Fugiat quod totam id molestiae et doloremque delectus.', '2018-12-26', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(9, 10, 6, 'Sed aliquam voluptatem sit adipisci.', 'Rerum velit rem omnis id explicabo. Magni laborum ut tempore facere. Nulla et qui quibusdam unde. Perferendis laboriosam ex consequuntur quidem omnis distinctio.', '2007-07-02', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(10, 10, 6, 'Facere suscipit amet qui.', 'Dolorem qui quia iusto possimus enim id quod. Ut nemo aut sequi voluptatem officia est sint odio. Enim quis repellendus laboriosam omnis qui ad modi. Doloribus optio ex ipsum cum soluta quia rerum ratione. Doloremque consectetur esse earum non aliquid ipsam.', '1993-03-28', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(11, 10, 6, 'Distinctio et adipisci.', 'Corporis corrupti laborum quis. Et unde quam perferendis est sint harum. Ab adipisci aliquam fugiat eos ut aperiam vel. Non quia veritatis est hic odit.', '1983-11-24', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(12, 10, 6, 'Ad repudiandae sit eaque.', 'Sit nesciunt quo est vel. A qui tempora repudiandae officia voluptatem. Est eligendi ducimus laboriosam recusandae sit. Pariatur placeat voluptas et unde rerum.', '1996-10-13', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(13, 10, 6, 'Sed optio delectus.', 'Veniam alias quam mollitia aut aut reprehenderit voluptates temporibus. Recusandae impedit velit ratione natus dolores neque laborum. Occaecati excepturi repudiandae et quam eligendi unde aspernatur quia.', '2011-01-07', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(14, 10, 6, 'Aut itaque et.', 'Autem nemo perferendis et est assumenda temporibus eius eius. Sunt quo voluptatem eligendi non voluptatum repellat. Quia autem illum natus vero.', '1996-07-24', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(15, 10, 6, 'Distinctio et.', 'Aut voluptatibus et qui veritatis molestiae ex dignissimos. Accusantium porro perspiciatis id deserunt. Velit deleniti excepturi ducimus molestiae. Ea consequatur magni dolores.', '1987-01-28', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(16, 10, 6, 'Distinctio voluptatibus.', 'Deserunt quod autem est provident eaque distinctio voluptatem. Quia porro quibusdam quis rerum deserunt. Repudiandae laborum et repudiandae expedita sit consequatur quo corporis. Aut vel dolores ut cupiditate expedita error in.', '2000-10-12', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(17, 10, 6, 'Iure sit voluptatibus id facere.', 'Aut consectetur perspiciatis voluptate nisi. Quis et vel sunt quam. In dolore dolore quidem qui et perspiciatis. In facilis doloremque dolore. Atque facere et mollitia ut omnis velit.', '2001-12-23', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(18, 10, 6, 'Odio id aliquam.', 'Harum distinctio commodi voluptatem. Unde commodi nulla aliquam qui alias dolorum est velit. Nisi nihil voluptate similique commodi mollitia.', '1996-08-25', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(19, 10, 6, 'Ut molestiae excepturi et.', 'Enim autem et est. Corporis reprehenderit vel libero dolore quis illo ipsa. Maiores distinctio non dignissimos et explicabo. Et est porro alias nesciunt aliquid praesentium sit.', '1972-08-24', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(20, 10, 6, 'Molestias rerum impedit aperiam.', 'Est veritatis accusantium voluptatem sint quis. Officiis animi sit consequatur omnis eum. Voluptatibus quisquam odio aut. Ratione molestiae nihil aliquid.', '1978-07-19', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(21, 8, 2, 'Headache', 'drink much water', '2025-04-29', '2025-04-29 11:29:08', '2025-04-29 11:29:08'),
(22, 10, 2, 'test', 'test', '2025-04-29', '2025-04-29 16:59:47', '2025-04-29 16:59:47'),
(23, 13, 2, 'test', 'test', '2025-04-29', '2025-04-29 17:17:15', '2025-04-29 17:17:15');

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
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 8),
(3, 'App\\Models\\User', 9),
(3, 'App\\Models\\User', 10),
(3, 'App\\Models\\User', 11),
(3, 'App\\Models\\User', 12),
(3, 'App\\Models\\User', 13);

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view dashboard', 'web', '2025-04-29 03:36:05', '2025-04-29 03:36:05'),
(2, 'create doctor', 'web', '2025-04-29 03:36:05', '2025-04-29 03:36:05'),
(3, 'edit doctor', 'web', '2025-04-29 03:36:05', '2025-04-29 03:36:05'),
(4, 'delete doctor', 'web', '2025-04-29 03:36:05', '2025-04-29 03:36:05'),
(5, 'view doctor', 'web', '2025-04-29 03:36:05', '2025-04-29 03:36:05'),
(6, 'create patients', 'web', '2025-04-29 03:36:05', '2025-04-29 03:36:05'),
(7, 'view patients', 'web', '2025-04-29 03:36:05', '2025-04-29 03:36:05'),
(8, 'edi patients', 'web', '2025-04-29 03:36:05', '2025-04-29 03:36:05'),
(9, 'delete patients', 'web', '2025-04-29 03:36:05', '2025-04-29 03:36:05'),
(10, 'view appointments', 'web', '2025-04-29 03:36:05', '2025-04-29 03:36:05'),
(11, 'edit appointments', 'web', '2025-04-29 03:36:05', '2025-04-29 03:36:05'),
(12, 'create appointments', 'web', '2025-04-29 03:36:05', '2025-04-29 03:36:05'),
(13, 'delete appointments', 'web', '2025-04-29 03:36:05', '2025-04-29 03:36:05'),
(14, 'approveOrCancel appointments', 'web', '2025-04-29 03:36:05', '2025-04-29 03:36:05'),
(15, 'view medical records', 'web', '2025-04-29 03:36:05', '2025-04-29 03:36:05'),
(16, 'edit medical records', 'web', '2025-04-29 03:36:05', '2025-04-29 03:36:05'),
(17, 'create medical records', 'web', '2025-04-29 03:36:05', '2025-04-29 03:36:05'),
(18, 'delete medical records', 'web', '2025-04-29 03:36:05', '2025-04-29 03:36:05'),
(19, 'view prescriptions', 'web', '2025-04-29 03:36:05', '2025-04-29 03:36:05'),
(20, 'edit prescriptions', 'web', '2025-04-29 03:36:05', '2025-04-29 03:36:05'),
(21, 'create prescriptions', 'web', '2025-04-29 03:36:05', '2025-04-29 03:36:05'),
(22, 'delete prescriptions', 'web', '2025-04-29 03:36:05', '2025-04-29 03:36:05');

INSERT INTO `prescriptions` (`id`, `doctor_id`, `patient_id`, `medication_name`, `dosage`, `frequency`, `notes`, `prescribed_date`, `created_at`, `updated_at`) VALUES
(1, 5, 11, 'consequatur', '10mg', 'Twice a day', 'Aut dolor quia deleniti dicta voluptas.', '2003-11-22', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(2, 5, 11, 'sed', '1 tablet', 'Every 6 hours', 'Maiores sunt nesciunt nihil reiciendis ullam id iste.', '1988-12-17', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(3, 5, 11, 'sit', '1 tablet', 'Every 6 hours', 'Omnis consequatur qui eveniet.', '2014-08-23', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(4, 5, 11, 'mollitia', '1 tablet', 'Every 6 hours', 'Accusantium voluptatibus ut possimus corrupti natus quas facere.', '1998-08-01', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(5, 5, 11, 'id', '5mg', 'Twice a day', 'Veniam id sit accusantium nam est.', '1971-10-07', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(6, 5, 11, 'aut', '1 tablet', 'Every 6 hours', 'Sunt fugit quia at quia aut dolorem in.', '1973-03-27', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(7, 5, 11, 'aut', '1 tablet', 'Every 6 hours', 'Quis quod molestiae sint reiciendis omnis.', '2007-04-01', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(8, 5, 11, 'incidunt', '10mg', 'Twice a day', 'Alias voluptate quis tempore illum et quia.', '1988-05-23', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(9, 5, 11, 'et', '5mg', 'Every 6 hours', 'Aliquam laborum occaecati voluptas expedita nihil sit reprehenderit.', '2005-01-21', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(10, 5, 11, 'autem', '1 tablet', 'Twice a day', 'Id et ut velit veritatis.', '1970-04-23', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(11, 5, 11, 'vero', '10mg', 'Once a day', 'Reiciendis sit qui nam consequatur qui eius ut.', '1992-11-08', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(12, 5, 11, 'rerum', '10mg', 'Every 6 hours', 'Aut non voluptatem neque maiores ipsum.', '1975-06-14', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(13, 5, 11, 'facilis', '1 tablet', 'Twice a day', 'Reprehenderit id sed consequatur non.', '2008-04-17', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(14, 5, 11, 'nemo', '1 tablet', 'Twice a day', 'Fuga dolores quia ratione ratione nihil aut animi.', '2020-05-04', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(15, 5, 11, 'quia', '1 tablet', 'Once a day', 'Voluptate sed ad sed adipisci quia.', '1976-05-19', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(16, 5, 11, 'ipsam', '1 tablet', 'Once a day', 'Voluptas omnis recusandae debitis et.', '1986-01-16', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(17, 5, 11, 'id', '5mg', 'Every 6 hours', 'Aspernatur voluptas id est quia porro voluptatem possimus.', '2011-07-24', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(18, 5, 11, 'necessitatibus', '5mg', 'Every 6 hours', 'Molestias et omnis autem in.', '1986-03-22', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(19, 5, 11, 'aut', '10mg', 'Twice a day', 'Et similique amet nihil voluptas iste impedit non eos.', '1980-05-27', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(20, 5, 11, 'illo', '1 tablet', 'Once a day', 'Minima magni quasi et autem quia eaque.', '1972-12-02', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(21, 2, 8, 'Panadol', '2 tables', '8 hours', 'drink water instantly', '2025-04-29', '2025-04-29 11:30:11', '2025-04-29 11:30:11'),
(22, 2, 10, 'test', 'test', 'test', 'test', '2025-04-29', '2025-04-29 17:00:46', '2025-04-29 17:00:46'),
(23, 2, 13, 'Test medication', '123456', 'test', 'test', '2025-04-29', '2025-04-29 17:16:15', '2025-04-29 17:16:15');

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
(1, 'admin', 'web', '2025-04-29 03:36:05', '2025-04-29 03:36:05'),
(2, 'doctor', 'web', '2025-04-29 03:36:05', '2025-04-29 03:36:05'),
(3, 'patients', 'web', '2025-04-29 03:36:05', '2025-04-29 03:36:05');

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('8cPg1MSRJIGAei0H4ocAkT1wqHfFFlncDxfnsTlI', 13, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoib3puZXB4UWVXSTMzMVFFNGF4R3FEc0FLMU9sUXROVFl4Y1dvVXVZNyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQvYXBwb2ludG1lbnRzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTM7fQ==', 1745947821),
('YxMKzT58BSv9GK22FOSc4RpwhftANJQTxuv7NcnU', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidmV4VWU2dXduTVMxeG9ocU14NjNMVlVWRXhHVnd6bHVNbzRXN01zTSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1745944347);

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `mobile`, `password`, `address`, `city`, `zip`, `image`, `date_of_birth`, `gender`, `status`, `remember_token`, `email_verified_at`, `created_at`, `updated_at`) VALUES
(1, 'Ortiz', 'Harvey', 'admin@gmail.com', '484526652', '$2y$12$RijbrwJAIzd4UK6hKU71fOditVN4ggflxxULcjKXcRvxj/VKXvI0C', '2805 Stamm Mill\nLake Nashside, IL 27064-4946', 'West Aniyah', '09077', NULL, '2003-12-30', 'male', 'inactive', 'EVkjpdTsukAxQXgiD4BsF39GeUv1aIfdhHSBeyTDKXJDPDRuRC93TXhCtEnw', '2025-04-29 03:36:06', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(2, 'Heaney', 'Wuckert', 'doctor@gmail.com', '63140396', '$2y$12$C72KTsBSoNlJw0mKyGEe2ee3nP9pji7E2dq7x9csb72BWUwUI5kFq', '3069 Darian Springs Apt. 835\nLake Laviniastad, DC 59598-3810', 'East Gabrielmouth', '54828-4703', NULL, '1976-01-18', 'female', 'active', 'CU9LsGqjvWdSYejAzFV8UYUJ3O2L9kYhlhN6thu7aO2H390eguvbbaL1GhQz', '2025-04-29 03:36:06', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(3, 'Bergnaum', 'Schamberger', 'barney.kilback@example.org', '248478820', '$2y$12$jkkcBo9MtDnx3GDk4YbdNOgz2KsKCf9LwUtzWg1fP3.wbKXjaAfUa', '51907 Taryn Points Apt. 970\nPort Justus, NE 66919', 'Toytown', '28659-7952', NULL, '2004-03-04', 'male', 'inactive', 'Ajl0SVaVEZSZ8gWSG3AOpHvPOI8suFTvh093028Vch1apVVqNEOQrdZPCa58', '2025-04-29 03:36:06', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(4, 'Russel', 'Ondricka', 'laurel.kirlin@example.org', '56187013', '$2y$12$jkkcBo9MtDnx3GDk4YbdNOgz2KsKCf9LwUtzWg1fP3.wbKXjaAfUa', '14639 Kirlin Junctions\nKunzeberg, TX 54541', 'Swaniawskichester', '64698-3590', NULL, '2005-03-14', 'male', 'active', '4WBPpnqAfv', '2025-04-29 03:36:06', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(5, 'Will', 'Smith', 'cassin.loren@example.com', '552472177', '$2y$12$jkkcBo9MtDnx3GDk4YbdNOgz2KsKCf9LwUtzWg1fP3.wbKXjaAfUa', '177 Jacklyn Crossroad Suite 418\nLake Cleorabury, DE 11182-4828', 'Mitchelfort', '29722', NULL, '1994-07-27', 'male', 'inactive', 'ZoEkpDITqW', '2025-04-29 03:36:06', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(6, 'Gorczany', 'Hauck', 'wunsch.ora@example.net', '858232126', '$2y$12$jkkcBo9MtDnx3GDk4YbdNOgz2KsKCf9LwUtzWg1fP3.wbKXjaAfUa', '1884 Herbert Squares\nNorth Natchester, GA 29983', 'Lake Anahi', '92941', NULL, '1990-09-08', 'female', 'active', 'EVP5rZPusd', '2025-04-29 03:36:06', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(7, 'Johnston', 'Powlowski', 'ihoppe@example.net', '896071879', '$2y$12$jkkcBo9MtDnx3GDk4YbdNOgz2KsKCf9LwUtzWg1fP3.wbKXjaAfUa', '302 Macejkovic Ramp Suite 969\nVandervortborough, MN 90759-6761', 'Sengermouth', '92673-9357', NULL, '1984-09-26', 'male', 'inactive', 'wqVg86ieTp', '2025-04-29 03:36:06', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(8, 'Roberts', 'Bednar', 'vlegros@example.net', '421041305', '$2y$12$jkkcBo9MtDnx3GDk4YbdNOgz2KsKCf9LwUtzWg1fP3.wbKXjaAfUa', '485 Julie Forks\nWeberborough, CO 81536', 'Oniefurt', '75117-1319', NULL, '1983-05-13', 'male', 'active', 'cRcOiqBw82', '2025-04-29 03:36:06', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(9, 'Kris', 'Hudson', 'andreanne.muller@example.net', '8349047', '$2y$12$jkkcBo9MtDnx3GDk4YbdNOgz2KsKCf9LwUtzWg1fP3.wbKXjaAfUa', '2320 Price Manor\nLake Okey, MO 76320', 'Port Buckburgh', '18472-1752', NULL, '1984-10-15', 'female', 'active', 'C8HzYvin6E', '2025-04-29 03:36:06', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(10, 'Feil', 'Olson', 'gussie73@example.com', '634849350', '$2y$12$jkkcBo9MtDnx3GDk4YbdNOgz2KsKCf9LwUtzWg1fP3.wbKXjaAfUa', '8519 Huel Estate\nNorth Keyon, CO 68109-9713', 'Norbertshire', '50510', NULL, '1978-09-27', 'female', 'inactive', 'seuxUIwPwH', '2025-04-29 03:36:06', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(11, 'Kihn', 'Heathcote', 'antwon.rogahn@example.org', '212124143', '$2y$12$jkkcBo9MtDnx3GDk4YbdNOgz2KsKCf9LwUtzWg1fP3.wbKXjaAfUa', '288 Bartoletti Square Suite 421\nEast Danykafurt, NV 22612-2691', 'Lake Gerdahaven', '52545-6495', NULL, '1984-07-27', 'female', 'inactive', 'qYCjFQDdaY', '2025-04-29 03:36:06', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(12, 'Fay', 'Upton', 'howell01@example.net', '340437530', '$2y$12$jkkcBo9MtDnx3GDk4YbdNOgz2KsKCf9LwUtzWg1fP3.wbKXjaAfUa', '42176 Kellen Fall Apt. 887\nLake Della, OK 14625', 'East Linafort', '18265', NULL, '1994-07-27', 'male', 'inactive', 'MKH8Mvy6bh', '2025-04-29 03:36:06', '2025-04-29 03:36:06', '2025-04-29 03:36:06'),
(13, 'Patient', 'One', 'patient@gmail.com', '23123123123', '$2y$12$stvu9r7wbbL/J/dle670lOHYNEOgP/kxAufOdszjuK.8ScuSdKqXC', NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, NULL, '2025-04-29 11:26:09', '2025-04-29 11:26:09');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;