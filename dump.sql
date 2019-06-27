-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: friendforanhour
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu0.17.10.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bans`
--

DROP TABLE IF EXISTS `bans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` bigint(20) NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `moderator_id_beginner` bigint(20) unsigned NOT NULL,
  `duration` int(10) unsigned NOT NULL,
  `ban_end_date` int(10) unsigned NOT NULL,
  `moderator_id_amnesty` bigint(20) unsigned DEFAULT NULL,
  `reason_amnesty` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bans_profile_id_foreign` (`profile_id`),
  KEY `bans_moderator_id_beginner_foreign` (`moderator_id_beginner`),
  KEY `bans_moderator_id_amnesty_foreign` (`moderator_id_amnesty`),
  CONSTRAINT `bans_moderator_id_amnesty_foreign` FOREIGN KEY (`moderator_id_amnesty`) REFERENCES `users` (`id`),
  CONSTRAINT `bans_moderator_id_beginner_foreign` FOREIGN KEY (`moderator_id_beginner`) REFERENCES `users` (`id`),
  CONSTRAINT `bans_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bans`
--

LOCK TABLES `bans` WRITE;
/*!40000 ALTER TABLE `bans` DISABLE KEYS */;
/*!40000 ALTER TABLE `bans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chats`
--

DROP TABLE IF EXISTS `chats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chats` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` bigint(20) NOT NULL,
  `friend_id` bigint(20) NOT NULL,
  `chat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chats_profile_id_foreign` (`profile_id`),
  KEY `chats_friend_id_foreign` (`friend_id`),
  CONSTRAINT `chats_friend_id_foreign` FOREIGN KEY (`friend_id`) REFERENCES `profiles` (`id`),
  CONSTRAINT `chats_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chats`
--

LOCK TABLES `chats` WRITE;
/*!40000 ALTER TABLE `chats` DISABLE KEYS */;
/*!40000 ALTER TABLE `chats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `city_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cities_country_id_foreign` (`country_id`),
  CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,'Волгоград',1,'2019-06-27 07:49:33','2019-06-27 07:49:33');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `complains`
--

DROP TABLE IF EXISTS `complains`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `complains` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `complain_from_profile_id` bigint(20) NOT NULL,
  `complain_against_profile_id` bigint(20) NOT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `complains_complain_from_profile_id_foreign` (`complain_from_profile_id`),
  KEY `complains_complain_against_profile_id_foreign` (`complain_against_profile_id`),
  CONSTRAINT `complains_complain_against_profile_id_foreign` FOREIGN KEY (`complain_against_profile_id`) REFERENCES `profiles` (`id`),
  CONSTRAINT `complains_complain_from_profile_id_foreign` FOREIGN KEY (`complain_from_profile_id`) REFERENCES `profiles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `complains`
--

LOCK TABLES `complains` WRITE;
/*!40000 ALTER TABLE `complains` DISABLE KEYS */;
/*!40000 ALTER TABLE `complains` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `country_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'Россия','2019-06-27 07:49:33','2019-06-27 07:49:33');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friends` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` bigint(20) NOT NULL,
  `friend_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `friends_profile_id_foreign` (`profile_id`),
  KEY `friends_friend_id_foreign` (`friend_id`),
  CONSTRAINT `friends_friend_id_foreign` FOREIGN KEY (`friend_id`) REFERENCES `profiles` (`id`),
  CONSTRAINT `friends_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friends`
--

LOCK TABLES `friends` WRITE;
/*!40000 ALTER TABLE `friends` DISABLE KEYS */;
/*!40000 ALTER TABLE `friends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genders`
--

DROP TABLE IF EXISTS `genders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `gender` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genders`
--

LOCK TABLES `genders` WRITE;
/*!40000 ALTER TABLE `genders` DISABLE KEYS */;
INSERT INTO `genders` VALUES (1,'female','2019-06-27 07:49:33','2019-06-27 07:49:33'),(2,'male','2019-06-27 07:49:33','2019-06-27 07:49:33');
/*!40000 ALTER TABLE `genders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_05_13_085010_create_profiles_table',1),(4,'2019_05_13_085021_create_countries_table',1),(5,'2019_05_13_085053_create_cities_table',1),(6,'2019_05_13_085128_create_genders_table',1),(7,'2019_05_13_085158_create_service_types_table',1),(8,'2019_05_13_085241_create_service_lists_table',1),(9,'2019_05_13_085310_create_profile_addresses_table',1),(10,'2019_05_13_085335_create_profile_photos_table',1),(11,'2019_05_13_085503_create_transaction_names_table',1),(12,'2019_05_13_085532_create_transactions_table',1),(13,'2019_05_13_144433_laratrust_setup_tables',1),(14,'2019_06_05_065511_create_complains_table',1),(15,'2019_06_07_070146_create_friends_table',1),(16,'2019_06_07_104421_create_chats_table',1),(17,'2019_06_14_150314_create_ticket_statuses_table',1),(18,'2019_06_14_150406_create_tickets_table',1),(19,'2019_06_19_134747_create_bans_table',1),(20,'2029_05_13_085756_create_foreign_key_relationships_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1),(2,1),(2,2),(3,3);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_user`
--

DROP TABLE IF EXISTS `permission_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_user` (
  `permission_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `user_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  KEY `permission_user_permission_id_foreign` (`permission_id`),
  CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_user`
--

LOCK TABLES `permission_user` WRITE;
/*!40000 ALTER TABLE `permission_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'create_moderators','create moderators','CRUD moderators','2019-06-27 07:49:32','2019-06-27 07:49:32'),(2,'RU_profiles','edit users profiles','edit (RU) users profiles','2019-06-27 07:49:32','2019-06-27 07:49:32'),(3,'edit_own_profile','RU own profile','RU own profile, CRUD own services, R other users profiles','2019-06-27 07:49:32','2019-06-27 07:49:32');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile_addresses`
--

DROP TABLE IF EXISTS `profile_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile_addresses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` double(10,6) DEFAULT NULL,
  `longitude` double(10,6) DEFAULT NULL,
  `city_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profile_addresses_city_id_foreign` (`city_id`),
  CONSTRAINT `profile_addresses_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_addresses`
--

LOCK TABLES `profile_addresses` WRITE;
/*!40000 ALTER TABLE `profile_addresses` DISABLE KEYS */;
INSERT INTO `profile_addresses` VALUES (1,'Адмирала Ушакова ул., 6',48.802045,44.619724,1,'2019-06-27 07:49:33','2019-06-27 07:49:33'),(2,'им Дзержинского ул., 49',48.806003,44.587780,1,'2019-06-27 07:49:33','2019-06-27 07:49:33'),(3,'им маршала Воронова ул., 14',48.646012,44.410983,1,'2019-06-27 07:49:33','2019-06-27 07:49:33'),(4,'им Грибанова ул., 13',48.662986,44.410534,1,'2019-06-27 07:49:33','2019-06-27 07:49:33'),(5,'им Солнечникова ул., 3',48.661177,44.419427,1,'2019-06-27 07:49:34','2019-06-27 07:49:34'),(6,'Костромской пер., 100',48.723082,44.495703,1,'2019-06-27 07:49:34','2019-06-27 07:49:34');
/*!40000 ALTER TABLE `profile_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile_photos`
--

DROP TABLE IF EXISTS `profile_photos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile_photos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `photo_path` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_id` bigint(20) NOT NULL,
  `main_photo_marker` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profile_photos_profile_id_foreign` (`profile_id`),
  CONSTRAINT `profile_photos_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_photos`
--

LOCK TABLES `profile_photos` WRITE;
/*!40000 ALTER TABLE `profile_photos` DISABLE KEYS */;
INSERT INTO `profile_photos` VALUES (1,'profilepictures/1/fennec1.jpg',1,1,0,'2019-06-27 07:49:35','2019-06-27 07:49:35'),(2,'profilepictures/1/fennec2.jpg',1,0,0,'2019-06-27 07:49:35','2019-06-27 07:49:35'),(3,'profilepictures/1/fennec3.jpg',1,0,0,'2019-06-27 07:49:35','2019-06-27 07:49:35'),(4,'profilepictures/1/fennec4.jpg',1,0,0,'2019-06-27 07:49:35','2019-06-27 07:49:35'),(5,'profilepictures/2/hamster1.jpg',2,1,0,'2019-06-27 07:49:35','2019-06-27 07:49:35'),(6,'profilepictures/2/hamster2.jpg',2,0,0,'2019-06-27 07:49:35','2019-06-27 07:49:35'),(7,'profilepictures/2/hamster3.jpg',2,0,0,'2019-06-27 07:49:35','2019-06-27 07:49:35'),(8,'profilepictures/2/hamster4.jpg',2,0,0,'2019-06-27 07:49:35','2019-06-27 07:49:35'),(9,'profilepictures/3/hedgehog1.jpg',3,1,0,'2019-06-27 07:49:35','2019-06-27 07:49:35'),(10,'profilepictures/3/hedgehog2.jpg',3,0,0,'2019-06-27 07:49:35','2019-06-27 07:49:35'),(11,'profilepictures/3/hedgehog3.jpg',3,0,0,'2019-06-27 07:49:35','2019-06-27 07:49:35'),(12,'profilepictures/3/hedgehog4.jpg',3,0,0,'2019-06-27 07:49:35','2019-06-27 07:49:35'),(13,'profilepictures/4/meerkat1.jpg',4,1,0,'2019-06-27 07:49:35','2019-06-27 07:49:35'),(14,'profilepictures/4/meerkat2.jpg',4,0,0,'2019-06-27 07:49:35','2019-06-27 07:49:35'),(15,'profilepictures/4/meerkat3.jpg',4,0,0,'2019-06-27 07:49:35','2019-06-27 07:49:35'),(16,'profilepictures/4/meerkat4.jpg',4,0,0,'2019-06-27 07:49:35','2019-06-27 07:49:35'),(17,'profilepictures/5/mole1.jpg',5,1,0,'2019-06-27 07:49:35','2019-06-27 07:49:35'),(18,'profilepictures/5/mole2.jpg',5,0,0,'2019-06-27 07:49:36','2019-06-27 07:49:36'),(19,'profilepictures/5/mole3.jpg',5,0,0,'2019-06-27 07:49:36','2019-06-27 07:49:36'),(20,'profilepictures/5/mole4.jpg',5,0,0,'2019-06-27 07:49:36','2019-06-27 07:49:36'),(21,'profilepictures/6/shark1.jpg',6,1,0,'2019-06-27 07:49:36','2019-06-27 07:49:36'),(22,'profilepictures/6/shark2.jpg',6,0,0,'2019-06-27 07:49:36','2019-06-27 07:49:36'),(23,'profilepictures/6/shark3.jpg',6,0,0,'2019-06-27 07:49:36','2019-06-27 07:49:36'),(24,'profilepictures/6/shark4.jpg',6,0,0,'2019-06-27 07:49:36','2019-06-27 07:49:36');
/*!40000 ALTER TABLE `profile_photos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `second_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `gender_id` bigint(20) unsigned DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_address_id` bigint(20) unsigned DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  `is_banned` tinyint(1) DEFAULT '0',
  `subscription_end_date` int(10) unsigned NOT NULL,
  `is_locked` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profiles_gender_id_foreign` (`gender_id`),
  KEY `profiles_profile_address_id_foreign` (`profile_address_id`),
  CONSTRAINT `profiles_gender_id_foreign` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`id`),
  CONSTRAINT `profiles_profile_address_id_foreign` FOREIGN KEY (`profile_address_id`) REFERENCES `profile_addresses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (1,'Спиридон','Лисицин','1999-12-01',185,57,'Я, Спиридон Лисицин, родился 1999-12-01. Тут может быть ваша реклама. Звоните по номеру: 88005553535',2,'88005553535',1,0,0,1564224574,0,'2019-06-27 07:49:34','2019-06-27 07:49:34'),(2,'Гертруда','Хомякова','1999-12-02',181,50,'Я, Гертруда Хомякова, родился 1999-12-02. Тут может быть ваша реклама. Звоните по номеру: 88005553536',1,'88005553536',2,0,0,1564224574,0,'2019-06-27 07:49:34','2019-06-27 07:49:34'),(3,'Берттрамфай','Йожькекъ','1999-12-03',189,90,'Я, Берттрамфай Йожькекъ, родился 1999-12-03. Тут может быть ваша реклама. Звоните по номеру: 88005553537',2,'88005553537',3,0,0,1564224574,0,'2019-06-27 07:49:34','2019-06-27 07:49:34'),(4,'Карамболла','Суррикатинова','1999-12-04',185,87,'Я, Карамболла Суррикатинова, родился 1999-12-04. Тут может быть ваша реклама. Звоните по номеру: 88005553538',1,'88005553538',4,0,0,1564224574,0,'2019-06-27 07:49:34','2019-06-27 07:49:34'),(5,'Серафим','Кротцкийн','1999-12-05',185,82,'Я, Серафим Кротцкийн, родился 1999-12-05. Тут может быть ваша реклама. Звоните по номеру: 88005553539',2,'88005553539',5,0,0,1564224574,0,'2019-06-27 07:49:34','2019-06-27 07:49:34'),(6,'Ибрагимина','Акуловница','1999-12-06',172,63,'Я, Ибрагимина Акуловница, родился 1999-12-06. Тут может быть ваша реклама. Звоните по номеру: 88005553530',1,'88005553530',6,0,0,1564224574,0,'2019-06-27 07:49:34','2019-06-27 07:49:34');
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `user_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1,'App\\User'),(2,2,'App\\User'),(3,3,'App\\User'),(3,4,'App\\User'),(3,5,'App\\User'),(3,6,'App\\User'),(3,7,'App\\User'),(3,8,'App\\User');
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','administrator','CRUD moderators','2019-06-27 07:49:32','2019-06-27 07:49:32'),(2,'moderator','moderator','RU other users profiles','2019-06-27 07:49:32','2019-06-27 07:49:32'),(3,'user','regular paid user','regular paid user for friendship, RU own profile, CRUD own services, R other users profiles','2019-06-27 07:49:32','2019-06-27 07:49:32');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_lists`
--

DROP TABLE IF EXISTS `service_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_lists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `service_name` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_description` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(10) unsigned NOT NULL DEFAULT '0',
  `service_type_id` bigint(20) unsigned NOT NULL,
  `profile_id` bigint(20) NOT NULL,
  `main_service_marker` tinyint(1) NOT NULL DEFAULT '0',
  `is_disabled` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_lists_service_type_id_foreign` (`service_type_id`),
  KEY `service_lists_profile_id_foreign` (`profile_id`),
  CONSTRAINT `service_lists_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`),
  CONSTRAINT `service_lists_service_type_id_foreign` FOREIGN KEY (`service_type_id`) REFERENCES `service_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_lists`
--

LOCK TABLES `service_lists` WRITE;
/*!40000 ALTER TABLE `service_lists` DISABLE KEYS */;
INSERT INTO `service_lists` VALUES (1,'сделаю массаж1','сделаю расслабляющий массаж 1',0,2,1,1,0,0,'2019-06-27 07:49:36','2019-06-27 07:49:36'),(2,'сделаю массаж2','сделаю расслабляющий массаж 2',600,2,2,1,0,0,'2019-06-27 07:49:36','2019-06-27 07:49:36'),(3,'сделаю массаж3','сделаю расслабляющий массаж 3',750,2,3,1,0,0,'2019-06-27 07:49:36','2019-06-27 07:49:36'),(4,'сделаю массаж4','сделаю расслабляющий массаж 4',150,2,4,1,0,0,'2019-06-27 07:49:36','2019-06-27 07:49:36'),(5,'сделаю массаж5','сделаю расслабляющий массаж 5',1650,2,5,1,0,0,'2019-06-27 07:49:36','2019-06-27 07:49:36'),(6,'сделаю массаж6','сделаю расслабляющий массаж 6',0,2,6,1,0,0,'2019-06-27 07:49:36','2019-06-27 07:49:36'),(7,'хочу массаж1','хочу расслабляющий массаж 1',1350,1,1,1,0,0,'2019-06-27 07:49:36','2019-06-27 07:49:36'),(8,'хочу массаж2','хочу расслабляющий массаж 2',300,1,2,1,0,0,'2019-06-27 07:49:37','2019-06-27 07:49:37'),(9,'хочу массаж3','хочу расслабляющий массаж 3',300,1,3,1,0,0,'2019-06-27 07:49:37','2019-06-27 07:49:37'),(10,'хочу массаж4','хочу расслабляющий массаж 4',300,1,4,1,0,0,'2019-06-27 07:49:37','2019-06-27 07:49:37'),(11,'хочу массаж5','хочу расслабляющий массаж 5',1050,1,5,1,0,0,'2019-06-27 07:49:37','2019-06-27 07:49:37'),(12,'хочу массаж6','хочу расслабляющий массаж 6',150,1,6,1,0,0,'2019-06-27 07:49:37','2019-06-27 07:49:37'),(13,'угощу пивом1','угощу пивасиком в баре 1',150,2,1,1,0,0,'2019-06-27 07:49:37','2019-06-27 07:49:37'),(14,'угощу пивом2','угощу пивасиком в баре 2',1200,2,2,1,0,0,'2019-06-27 07:49:37','2019-06-27 07:49:37'),(15,'угощу пивом3','угощу пивасиком в баре 3',1500,2,3,1,0,0,'2019-06-27 07:49:37','2019-06-27 07:49:37'),(16,'угощу пивом4','угощу пивасиком в баре 4',300,2,4,1,0,0,'2019-06-27 07:49:37','2019-06-27 07:49:37'),(17,'угощу пивом5','угощу пивасиком в баре 5',1650,2,5,1,0,0,'2019-06-27 07:49:37','2019-06-27 07:49:37'),(18,'угощу пивом6','угощу пивасиком в баре 6',900,2,6,1,0,0,'2019-06-27 07:49:37','2019-06-27 07:49:37'),(19,'угощусь пивом1','угощусь пивасиком в баре 1',300,1,1,1,0,0,'2019-06-27 07:49:37','2019-06-27 07:49:37'),(20,'угощусь пивом2','угощусь пивасиком в баре 2',750,1,2,1,0,0,'2019-06-27 07:49:37','2019-06-27 07:49:37'),(21,'угощусь пивом3','угощусь пивасиком в баре 3',1050,1,3,1,0,0,'2019-06-27 07:49:37','2019-06-27 07:49:37'),(22,'угощусь пивом4','угощусь пивасиком в баре 4',0,1,4,1,0,0,'2019-06-27 07:49:37','2019-06-27 07:49:37'),(23,'угощусь пивом5','угощусь пивасиком в баре 5',1050,1,5,1,0,0,'2019-06-27 07:49:37','2019-06-27 07:49:37'),(24,'угощусь пивом6','угощусь пивасиком в баре 6',1350,1,6,1,0,0,'2019-06-27 07:49:37','2019-06-27 07:49:37'),(25,'сделаю маник1','сделаю маникюр 1',1350,2,1,0,0,0,'2019-06-27 07:49:37','2019-06-27 07:49:37'),(26,'сделаю маник2','сделаю маникюр 2',900,2,2,0,0,0,'2019-06-27 07:49:37','2019-06-27 07:49:37'),(27,'сделаю маник3','сделаю маникюр 3',900,2,3,0,0,0,'2019-06-27 07:49:38','2019-06-27 07:49:38'),(28,'сделаю маник4','сделаю маникюр 4',1050,2,4,0,0,0,'2019-06-27 07:49:38','2019-06-27 07:49:38'),(29,'сделаю маник5','сделаю маникюр 5',1500,2,5,0,0,0,'2019-06-27 07:49:38','2019-06-27 07:49:38'),(30,'сделаю маник6','сделаю маникюр 6',600,2,6,0,0,0,'2019-06-27 07:49:38','2019-06-27 07:49:38'),(31,'хочу маник1','хочу маникюр 1',900,1,1,0,0,0,'2019-06-27 07:49:38','2019-06-27 07:49:38'),(32,'хочу маник2','хочу маникюр 2',300,1,2,0,0,0,'2019-06-27 07:49:38','2019-06-27 07:49:38'),(33,'хочу маник3','хочу маникюр 3',450,1,3,0,0,0,'2019-06-27 07:49:38','2019-06-27 07:49:38'),(34,'хочу маник4','хочу маникюр 4',1650,1,4,0,0,0,'2019-06-27 07:49:38','2019-06-27 07:49:38'),(35,'хочу маник5','хочу маникюр 5',1650,1,5,0,0,0,'2019-06-27 07:49:38','2019-06-27 07:49:38'),(36,'хочу маник6','хочу маникюр 6',1350,1,6,0,0,0,'2019-06-27 07:49:38','2019-06-27 07:49:38'),(37,'схожу в магаз1','схожу в магазин за продуктами 1',0,2,1,0,0,0,'2019-06-27 07:49:38','2019-06-27 07:49:38'),(38,'схожу в магаз2','схожу в магазин за продуктами 2',150,2,2,0,0,0,'2019-06-27 07:49:38','2019-06-27 07:49:38'),(39,'схожу в магаз3','схожу в магазин за продуктами 3',750,2,3,0,0,0,'2019-06-27 07:49:38','2019-06-27 07:49:38'),(40,'схожу в магаз4','схожу в магазин за продуктами 4',0,2,4,0,0,0,'2019-06-27 07:49:38','2019-06-27 07:49:38'),(41,'схожу в магаз5','схожу в магазин за продуктами 5',750,2,5,0,0,0,'2019-06-27 07:49:38','2019-06-27 07:49:38'),(42,'схожу в магаз6','схожу в магазин за продуктами 6',150,2,6,0,0,0,'2019-06-27 07:49:38','2019-06-27 07:49:38'),(43,'нужен курьер1','нужен курьер сходить в магазин за продуктами 1',1500,1,1,0,0,0,'2019-06-27 07:49:38','2019-06-27 07:49:38'),(44,'нужен курьер2','нужен курьер сходить в магазин за продуктами 2',300,1,2,0,0,0,'2019-06-27 07:49:38','2019-06-27 07:49:38'),(45,'нужен курьер3','нужен курьер сходить в магазин за продуктами 3',1500,1,3,0,0,0,'2019-06-27 07:49:39','2019-06-27 07:49:39'),(46,'нужен курьер4','нужен курьер сходить в магазин за продуктами 4',1350,1,4,0,0,0,'2019-06-27 07:49:39','2019-06-27 07:49:39'),(47,'нужен курьер5','нужен курьер сходить в магазин за продуктами 5',1050,1,5,0,0,0,'2019-06-27 07:49:39','2019-06-27 07:49:39'),(48,'нужен курьер6','нужен курьер сходить в магазин за продуктами 6',1050,1,6,0,0,0,'2019-06-27 07:49:39','2019-06-27 07:49:39');
/*!40000 ALTER TABLE `service_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_types`
--

DROP TABLE IF EXISTS `service_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `service_type_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_types`
--

LOCK TABLES `service_types` WRITE;
/*!40000 ALTER TABLE `service_types` DISABLE KEYS */;
INSERT INTO `service_types` VALUES (1,'спонсор','2019-06-27 07:49:34','2019-06-27 07:49:34'),(2,'друг','2019-06-27 07:49:34','2019-06-27 07:49:34');
/*!40000 ALTER TABLE `service_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_statuses`
--

DROP TABLE IF EXISTS `ticket_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_statuses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_statuses`
--

LOCK TABLES `ticket_statuses` WRITE;
/*!40000 ALTER TABLE `ticket_statuses` DISABLE KEYS */;
INSERT INTO `ticket_statuses` VALUES (1,'Отправленно','2019-06-27 07:49:40','2019-06-27 07:49:40'),(2,'Принято к обработке','2019-06-27 07:49:40','2019-06-27 07:49:40'),(3,'На рассмотрении','2019-06-27 07:49:40','2019-06-27 07:49:40'),(4,'Обработано','2019-06-27 07:49:40','2019-06-27 07:49:40'),(5,'Закрыто','2019-06-27 07:49:40','2019-06-27 07:49:40');
/*!40000 ALTER TABLE `ticket_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tickets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` bigint(20) DEFAULT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_from` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_id` bigint(20) unsigned NOT NULL DEFAULT '1',
  `moderator_id` bigint(20) unsigned DEFAULT NULL,
  `report` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tickets_status_id_foreign` (`status_id`),
  KEY `tickets_profile_id_foreign` (`profile_id`),
  KEY `tickets_moderator_id_foreign` (`moderator_id`),
  CONSTRAINT `tickets_moderator_id_foreign` FOREIGN KEY (`moderator_id`) REFERENCES `users` (`id`),
  CONSTRAINT `tickets_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`),
  CONSTRAINT `tickets_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `ticket_statuses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_names`
--

DROP TABLE IF EXISTS `transaction_names`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_names` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_names`
--

LOCK TABLES `transaction_names` WRITE;
/*!40000 ALTER TABLE `transaction_names` DISABLE KEYS */;
INSERT INTO `transaction_names` VALUES (1,'1 month','Subscription for 1 month',10000,'2019-06-27 07:49:40','2019-06-27 07:49:40');
/*!40000 ALTER TABLE `transaction_names` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` bigint(20) NOT NULL,
  `giving_access_moderator_id` bigint(20) unsigned DEFAULT NULL,
  `manual_access_reason` text COLLATE utf8mb4_unicode_ci,
  `transaction_name_id` bigint(20) unsigned NOT NULL,
  `crc_signature_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `me_crc_signature_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inv_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accepted` tinyint(1) NOT NULL,
  `request_json` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_transaction_name_id_foreign` (`transaction_name_id`),
  KEY `transactions_profile_id_foreign` (`profile_id`),
  KEY `transactions_giving_access_moderator_id_foreign` (`giving_access_moderator_id`),
  CONSTRAINT `transactions_giving_access_moderator_id_foreign` FOREIGN KEY (`giving_access_moderator_id`) REFERENCES `users` (`id`),
  CONSTRAINT `transactions_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`),
  CONSTRAINT `transactions_transaction_name_id_foreign` FOREIGN KEY (`transaction_name_id`) REFERENCES `transaction_names` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sms_code` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_checked` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `uid` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `network` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_profile` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identity` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_id` bigint(20) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_profile_id_foreign` (`profile_id`),
  CONSTRAINT `users_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@gmail.com',NULL,'$2y$10$PUtNwpsX.3AhGVylmfkaoeRD1nVBiKlMwQMhxaShys9C6GVibAwRq',NULL,1,0,NULL,NULL,NULL,NULL,NULL,NULL,'2019-06-27 07:49:33','2019-06-27 07:49:33'),(2,'moderator','moderator@gmail.com',NULL,'$2y$10$e98GNduDPiKPFmkSeigDV.v6Rh3gDSD4dVZfOlO5LpsrujYZ50cKC',NULL,1,0,NULL,NULL,NULL,NULL,NULL,NULL,'2019-06-27 07:49:33','2019-06-27 07:49:33'),(3,'user1','user1@gmail.com',NULL,'$2y$10$nBNFiT1uc4JG/AWMGLJkXOy4xZM.FD.XZ6Jnes03MkKwK.0QsHCvK',NULL,1,0,NULL,NULL,NULL,NULL,1,NULL,'2019-06-27 07:49:39','2019-06-27 07:49:39'),(4,'user2','user2@gmail.com',NULL,'$2y$10$3DebKIZrnJc1v1IvsYnTm.c6Xam1jCGmokgjGJCK7tpZKCM/xfVfm',NULL,1,0,NULL,NULL,NULL,NULL,2,NULL,'2019-06-27 07:49:39','2019-06-27 07:49:39'),(5,'user3','user3@gmail.com',NULL,'$2y$10$/3uIgXuDlpauj5A9h4.WyO2gAL69nZLbDrZjuV5c5PGYZ5ZdozEPS',NULL,1,0,NULL,NULL,NULL,NULL,3,NULL,'2019-06-27 07:49:39','2019-06-27 07:49:39'),(6,'user4','user4@gmail.com',NULL,'$2y$10$Qqm4IVuQs6jguBu3y6xrHOLFFloMaJJnL.DSR5SFD9jDUqOoidnR.',NULL,1,0,NULL,NULL,NULL,NULL,4,NULL,'2019-06-27 07:49:40','2019-06-27 07:49:40'),(7,'user5','user5@gmail.com',NULL,'$2y$10$S4q9Io8ymZC6G17xL595h.4I9jKSWttWiJaxpwG59STgt2Esazdem',NULL,1,0,NULL,NULL,NULL,NULL,5,NULL,'2019-06-27 07:49:40','2019-06-27 07:49:40'),(8,'user6','user6@gmail.com',NULL,'$2y$10$j7Q.rIhM4.7NywHeR44ayOHnwoLgmZWZihO8Z1KRr3hI2CaWElDTq',NULL,1,0,NULL,NULL,NULL,NULL,6,NULL,'2019-06-27 07:49:40','2019-06-27 07:49:40');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-06-27 13:54:42
