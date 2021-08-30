-- MySQL dump 10.13  Distrib 8.0.25, for Linux (x86_64)
--
-- Host: localhost    Database: reserved
-- ------------------------------------------------------
-- Server version	8.0.25-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `iiko_booking_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint DEFAULT NULL,
  `organization_id` bigint DEFAULT NULL,
  `organization_table_list_id` bigint DEFAULT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `status` enum('CHECKING','on','came','off','COMPLETED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'CHECKING',
  `comment` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on',
  `payment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` bigint DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` smallint NOT NULL DEFAULT '1',
  `card_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bookings_user_id_index` (`user_id`),
  KEY `bookings_organization_id_index` (`organization_id`),
  KEY `bookings_organization_table_list_id_index` (`organization_table_list_id`),
  KEY `bookings_card_id_index` (`card_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (1,NULL,8,1,3,'14:00:00','2021-07-04','COMPLETED','off','https://api.paybox.money/v1/merchant/538109/card/pay',497219423,'100',1,34544926,'2021-07-04 05:35:20','2021-07-04 05:36:16'),(2,NULL,2,1,2,'14:00:00','2021-07-04','off','on','https://api.paybox.money/v1/merchant/538109/card/pay',497236721,'100',1,34475868,'2021-07-04 07:17:09','2021-07-04 07:17:45'),(3,NULL,2,1,1,'14:00:00','2021-07-04','off','on','https://api.paybox.money/v1/merchant/538109/card/pay',497237846,'100',1,34475868,'2021-07-04 07:23:34','2021-07-04 07:23:48'),(4,NULL,9,1,4,'14:00:00','2021-07-04','off','on','https://api.paybox.money/v1/merchant/538109/card/pay',497238352,'100',1,34545817,'2021-07-04 07:26:10','2021-07-04 07:28:42'),(5,NULL,9,1,7,'16:00:00','2021-07-04','on','on','https://api.paybox.money/v1/merchant/538109/card/pay',497239204,'50',1,34545817,'2021-07-04 07:30:46','2021-07-04 07:31:11'),(6,NULL,2,1,4,'16:00:00','2021-07-04','on','on','https://api.paybox.money/v1/merchant/538109/card/pay',497239513,'50',1,34475868,'2021-07-04 07:32:15','2021-07-04 07:32:30'),(7,NULL,2,1,1,'13:00:00','2021-07-05','on','on','https://api.paybox.money/v1/merchant/538109/card/pay',497349390,'50',1,34475868,'2021-07-04 23:02:36','2021-07-04 23:02:55'),(8,NULL,2,1,2,'13:00:00','2021-07-05','on','on','https://api.paybox.money/v1/merchant/538109/card/pay',497352850,'50',1,34475868,'2021-07-04 23:27:25','2021-07-04 23:27:41'),(9,NULL,5,1,4,'12:00:00','2021-07-05','CHECKING','on','https://api.paybox.money/pay.html?customer=6ee3b88ed004df264078bb02011c06f6',NULL,'50',1,NULL,'2021-07-04 23:45:50','2021-07-04 23:45:51'),(10,NULL,2,1,4,'12:00:00','2021-07-05','CHECKING','on','https://api.paybox.money/v1/merchant/538109/card/pay',497393005,'50',1,34475868,'2021-07-05 03:35:03','2021-07-05 03:35:03'),(11,NULL,2,1,2,'18:00:00','2021-07-07','CHECKING','on','https://api.paybox.money/v1/merchant/538109/card/pay',497494770,'50',1,34475868,'2021-07-05 12:15:12','2021-07-05 12:15:12'),(12,NULL,2,1,2,'07:00:00','2021-07-07','CHECKING','on','https://api.paybox.money/v1/merchant/538109/card/pay',497797090,'50',1,34475868,'2021-07-06 21:39:42','2021-07-06 21:39:43'),(13,NULL,2,1,2,'17:00:00','2021-07-07','on','on','https://api.paybox.money/v1/merchant/538109/card/pay',497946442,'50',1,34475868,'2021-07-07 09:41:06','2021-07-07 09:41:22'),(14,NULL,2,1,2,'07:00:00','2021-07-08','COMPLETED','off','https://api.paybox.money/v1/merchant/538109/card/pay',498078380,'50',1,34475868,'2021-07-07 21:32:40','2021-07-08 03:27:31'),(15,NULL,2,1,1,'12:00:00','2021-07-08','COMPLETED','off','https://api.paybox.money/v1/merchant/538109/card/pay',498144167,'50',1,34475868,'2021-07-08 03:31:08','2021-07-08 03:33:16'),(16,NULL,2,1,4,'10:00:00','2021-07-08','COMPLETED','off','https://api.paybox.money/v1/merchant/538109/card/pay',498145855,'50',1,34475868,'2021-07-08 03:38:16','2021-07-08 03:39:00'),(17,NULL,2,1,8,'17:00:00','2021-07-08','COMPLETED','off','https://api.paybox.money/v1/merchant/538109/card/pay',498147436,'50',1,34475868,'2021-07-08 03:45:43','2021-07-08 03:46:32'),(18,NULL,2,1,2,'05:00:00','2021-07-08','CHECKING','on','https://api.paybox.money/pay.html?customer=16edde413f98ccc2b47cb109c9578c5a',NULL,'50',1,NULL,'2021-07-08 06:04:42','2021-07-08 06:04:42'),(19,NULL,2,1,1,'16:00:00','2021-07-08','COMPLETED','off','https://api.paybox.money/pay.html?customer=2df790bc388ce1ce8109d7f487b7f2f4',NULL,'50',1,NULL,'2021-07-08 06:34:12','2021-07-08 08:38:24'),(20,NULL,2,1,1,'16:00:00','2021-07-08','COMPLETED','off','https://api.paybox.money/v1/merchant/538109/card/pay',498206224,'50',1,34475868,'2021-07-08 08:15:33','2021-07-08 08:38:31'),(21,NULL,2,1,12,'16:00:00','2021-07-08','COMPLETED','off','https://api.paybox.money/v1/merchant/538109/card/pay',498214556,'50',1,34475868,'2021-07-08 08:51:29','2021-07-08 08:53:31'),(22,NULL,13,1,1,'16:00:00','2021-07-08','CHECKING','on','https://api.paybox.money/pay.html?customer=c1a58ce010e07ce5a47402ac8361c8f2',NULL,'50',1,NULL,'2021-07-08 09:14:01','2021-07-08 09:14:01'),(23,NULL,2,1,2,'17:00:00','2021-07-08','CHECKING','on','https://api.paybox.money/pay.html?customer=cf782672c84d2aafa167958b2e94cd22',NULL,'50',1,NULL,'2021-07-08 09:34:52','2021-07-08 09:34:52'),(24,NULL,9,1,3,'17:00:00','2021-07-08','CHECKING','on','https://api.paybox.money/pay.html?customer=bc627f217ae1b79ae8e4b3f1e951b318',NULL,'50',1,NULL,'2021-07-08 09:43:41','2021-07-08 09:43:41'),(25,NULL,2,1,4,'17:00:00','2021-07-08','CHECKING','on','https://api.paybox.money/pay.html?customer=e8c43effca8b01ac72562f3072ef9644',NULL,'50',1,NULL,'2021-07-08 09:53:45','2021-07-08 09:53:45'),(26,NULL,9,1,2,'17:00:00','2021-07-08','CHECKING','on','https://api.paybox.money/pay.html?customer=586ef80655cdadc5ea9d51eaef1255de',NULL,'50',1,NULL,'2021-07-08 10:01:00','2021-07-08 10:01:00'),(27,NULL,9,1,3,'17:00:00','2021-07-08','on','on','https://api.paybox.money/pay.html?customer=9f6a02e748fb410918d63795f652f3b0',NULL,'50',1,NULL,'2021-07-08 10:05:15','2021-07-08 10:05:58'),(28,NULL,2,1,8,'17:00:00','2021-07-09','CHECKING','on','https://api.paybox.money/v1/merchant/538109/card/pay',498474867,'50',1,34475868,'2021-07-09 10:04:52','2021-07-09 10:04:52'),(29,NULL,2,1,1,'17:00:00','2021-07-12','COMPLETED','off','https://api.paybox.money/pay.html?customer=67f5a2425e5bd2eebdb7a5255af79ada',NULL,'50',1,NULL,'2021-07-12 00:20:22','2021-07-12 00:23:28'),(30,NULL,2,1,2,'15:00:00','2021-07-12','COMPLETED','off','https://api.paybox.money/v1/merchant/538109/card/pay',499247674,'50',1,34475868,'2021-07-12 06:27:40','2021-07-12 06:30:06'),(31,NULL,15,1,1,'16:00:00','2021-07-13','CHECKING','on','https://api.paybox.money/pay.html?customer=675b779e0c2fb1ffa1687c8694436945',NULL,'50',1,NULL,'2021-07-13 01:30:02','2021-07-13 01:30:03'),(32,NULL,15,1,1,'08:00:00','2021-07-13','CHECKING','on','https://api.paybox.money/pay.html?customer=e60931ea6e8c01cd3403c6669a67ff5a',NULL,'50',1,NULL,'2021-07-13 01:49:58','2021-07-13 01:49:59'),(33,NULL,9,1,1,'04:00:00','2021-07-14','CHECKING','on','https://api.paybox.money/pay.html?customer=a5e74991030887adb5db1aa8b63df457',NULL,'50',1,NULL,'2021-07-14 13:35:49','2021-07-14 13:35:50'),(34,NULL,9,1,2,'13:00:00','2021-07-15','off','on','https://api.paybox.money/v1/merchant/538109/card/pay',499959820,'50',1,34545817,'2021-07-14 14:19:28','2021-07-14 14:49:52'),(35,NULL,9,1,1,'17:00:00','2021-07-14','CHECKING','on','https://api.paybox.money/pay.html?customer=4d7d52d5d0644b86f494506cb6bb0105',499971442,'50',1,NULL,'2021-07-14 15:46:08','2021-07-14 15:46:09'),(36,NULL,9,1,1,'16:00:00','2021-07-14','CHECKING','on','https://api.paybox.money/pay.html?customer=3909d19bfab76fbb04d27be1bb81b4a3',499974733,'50',1,NULL,'2021-07-14 16:18:29','2021-07-14 16:18:30'),(37,NULL,9,1,1,'16:00:00','2021-07-15','off','on','https://api.paybox.money/pay.html?customer=e7b9c7c6bc22ef47f6fa7573ed4a1bb6',499977908,'50',1,NULL,'2021-07-14 16:43:57','2021-07-14 16:45:06'),(38,NULL,9,1,1,'16:00:00','2021-07-15','off','on','https://api.paybox.money/pay.html?customer=aacebf1b207d5866b29052e26b3072b2',499978211,'50',1,NULL,'2021-07-14 16:46:13','2021-07-14 16:47:26'),(39,NULL,9,1,1,'16:00:00','2021-07-15','off','on','https://api.paybox.money/pay.html?customer=d7ed67df769ea1ce5765bcae886b53ab',499978732,'50',1,NULL,'2021-07-14 16:50:36','2021-07-14 16:51:47'),(40,NULL,9,1,1,'15:00:00','2021-07-15','off','on','https://api.paybox.money/pay.html?customer=67800b33a416b7281448bf10c58630c8',499979342,'50',1,NULL,'2021-07-14 16:56:02','2021-07-14 16:56:54'),(41,NULL,9,1,1,'15:00:00','2021-07-15','off','on','https://api.paybox.money/pay.html?customer=4c8332bbd74eb99d5dc4407704db51ef',499979568,'50',1,NULL,'2021-07-14 16:58:06','2021-07-14 16:58:55'),(42,NULL,9,1,1,'15:00:00','2021-07-15','off','on','https://api.paybox.money/pay.html?customer=cd9b7d82b9c2a1d1452ae47e386bb196',499979748,'50',1,NULL,'2021-07-14 16:59:41','2021-07-14 17:00:38'),(43,NULL,9,1,1,'16:00:00','2021-07-15','off','on','https://api.paybox.money/pay.html?customer=ebd73c8501c9839704cf81a2e7f2c17d',499980180,'30',1,NULL,'2021-07-14 17:03:31','2021-07-14 17:04:09'),(44,NULL,9,1,1,'16:00:00','2021-07-15','off','on','https://api.paybox.money/pay.html?customer=852fd9b4d396140bb4b77edb5a8df2f1',499980268,'30',1,NULL,'2021-07-14 17:04:25','2021-07-14 17:07:02'),(45,NULL,9,1,1,'16:00:00','2021-07-15','off','on','https://api.paybox.money/pay.html?customer=6d662fc8ebbefe2561005741a8fea093',499981481,'30',1,NULL,'2021-07-14 17:16:51','2021-07-14 17:17:52'),(46,NULL,2,1,1,'11:00:00','2021-07-24','off','on',NULL,NULL,'0',1,0,'2021-07-24 03:06:13','2021-07-24 06:36:18'),(47,NULL,2,1,1,'11:00:00','2021-07-25','COMPLETED','off',NULL,NULL,'0',1,0,'2021-07-25 02:50:13','2021-07-25 02:51:32'),(48,NULL,2,1,1,'15:00:00','2021-07-25','on','on',NULL,NULL,'0',1,0,'2021-07-25 07:07:31','2021-07-25 07:07:31'),(49,NULL,2,1,1,'05:00:00','2021-07-26','COMPLETED','on',NULL,NULL,'0',1,0,'2021-07-25 22:37:58','2021-07-25 22:38:11');
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cards`
--

DROP TABLE IF EXISTS `cards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cards` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `card_id` bigint NOT NULL,
  `hash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_3d` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cards`
--

LOCK TABLES `cards` WRITE;
/*!40000 ALTER TABLE `cards` DISABLE KEYS */;
INSERT INTO `cards` VALUES (1,2,34475868,'5169-49XX-XXXX-1511','08','22','АО \"Kaspi Bank\"','KZ','1','on','2021-06-29 09:30:41','2021-06-29 09:30:41'),(2,8,34544926,'4263-43XX-XXXX-9479','02','26','АО \"Сбербанк\"','KZ','1','on','2021-07-04 05:34:13','2021-07-04 05:34:13'),(3,9,34545817,'4263-43XX-XXXX-9479','02','26','АО \"Сбербанк\"','KZ','1','on','2021-07-04 07:23:09','2021-07-04 07:23:09');
/*!40000 ALTER TABLE `cards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_kz` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Рестораны',NULL,NULL,'2021-06-28 03:01:30','2021-06-28 03:01:30'),(2,'Кафе',NULL,NULL,'2021-06-28 03:01:37','2021-06-28 03:01:37'),(3,'Бары',NULL,NULL,'2021-06-28 03:01:42','2021-06-28 03:01:42');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `country_id` bigint DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_kz` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,1,'Алматы',NULL,'Almaty','2021-07-09 13:11:24','2021-07-09 13:11:24'),(2,1,'Нур-Султан',NULL,'Nur-Sultan','2021-07-09 13:11:39','2021-07-09 13:11:39');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contracts`
--

DROP TABLE IF EXISTS `contracts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contracts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `json` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contracts`
--

LOCK TABLES `contracts` WRITE;
/*!40000 ALTER TABLE `contracts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contracts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_kz` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
INSERT INTO `countries` VALUES (1,'Казахстан',NULL,'Kazakhstan','2021-07-09 13:10:58','2021-07-09 13:10:58');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `iiko_table_lists`
--

DROP TABLE IF EXISTS `iiko_table_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `iiko_table_lists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `iiko_main_id` bigint NOT NULL,
  `iiko_table_id` bigint NOT NULL,
  `organization_table_list_id` bigint DEFAULT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `limit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `status` enum('ENABLED','FROZEN','DISABLED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ENABLED',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `iiko_table_lists_iiko_main_id_index` (`iiko_main_id`),
  KEY `iiko_table_lists_organization_table_list_id_index` (`organization_table_list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `iiko_table_lists`
--

LOCK TABLES `iiko_table_lists` WRITE;
/*!40000 ALTER TABLE `iiko_table_lists` DISABLE KEYS */;
/*!40000 ALTER TABLE `iiko_table_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `iiko_tables`
--

DROP TABLE IF EXISTS `iiko_tables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `iiko_tables` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `iiko_main_id` bigint NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('ENABLED','FROZEN','DISABLED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ENABLED',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `iiko_tables`
--

LOCK TABLES `iiko_tables` WRITE;
/*!40000 ALTER TABLE `iiko_tables` DISABLE KEYS */;
/*!40000 ALTER TABLE `iiko_tables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `iikos`
--

DROP TABLE IF EXISTS `iikos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `iikos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `organization_id` bigint NOT NULL,
  `iiko_organization_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iiko_id` bigint DEFAULT NULL,
  `api_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('ENABLED','FROZEN','DISABLED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ENABLED',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `iikos_organization_id_index` (`organization_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `iikos`
--

LOCK TABLES `iikos` WRITE;
/*!40000 ALTER TABLE `iikos` DISABLE KEYS */;
/*!40000 ALTER TABLE `iikos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (1,'Русский','2021-07-18 11:27:31','2021-07-18 11:27:31');
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `links`
--

DROP TABLE IF EXISTS `links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `links` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` timestamp NOT NULL,
  `status` enum('ENABLED','DISABLED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ENABLED',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `links`
--

LOCK TABLES `links` WRITE;
/*!40000 ALTER TABLE `links` DISABLE KEYS */;
INSERT INTO `links` VALUES (1,'81453416a7d37185c24e9ca7d1ebba37','https://api.paybox.money/pay.html?customer=969e9219968c8d2d846212049cf404e1','2021-07-01 11:22:24','DISABLED','2021-07-01 10:22:24','2021-07-01 10:23:01'),(2,'446b84a9391c26d1a5387692013067d9','https://api.paybox.money/pay.html?customer=5c9d3bbba22efe084b1f37103f629cba','2021-07-02 03:08:27','DISABLED','2021-07-02 02:08:27','2021-07-02 02:08:43'),(3,'b1d1c04f39adcce4ad558f0c2a71811a','https://api.paybox.money/pay.html?customer=f1aa37a3c56045a0b2264838ea712109','2021-07-02 03:14:58','DISABLED','2021-07-02 02:14:58','2021-07-02 02:15:12'),(4,'763719a5001ed4ea147d57cc2ae7d07a','https://api.paybox.money/pay.html?customer=7613c7fadf97d2bce6e9f004e661d991','2021-07-02 03:26:43','DISABLED','2021-07-02 02:26:43','2021-07-02 02:26:57'),(5,'c683329ac85daa66a020565a54c6c0c0','https://api.paybox.money/pay.html?customer=8e29e8112ab57a4f868386a3b50bcf3a','2021-07-02 03:28:25','DISABLED','2021-07-02 02:28:25','2021-07-02 02:28:39'),(6,'096d853d1e032fece0f492616a2271b1','https://api.paybox.money/pay.html?customer=16edde413f98ccc2b47cb109c9578c5a','2021-07-08 07:04:42','ENABLED','2021-07-08 06:04:42','2021-07-08 06:04:42'),(7,'b9ed9edb41e434e3f85d42fad8a86c5d','https://api.paybox.money/pay.html?customer=2df790bc388ce1ce8109d7f487b7f2f4','2021-07-08 07:34:13','DISABLED','2021-07-08 06:34:13','2021-07-08 06:34:32'),(8,'a07fa45d1b57e0866d5a2b4c2b1df5a4','https://api.paybox.money/pay.html?customer=cf782672c84d2aafa167958b2e94cd22','2021-07-08 10:34:52','DISABLED','2021-07-08 09:34:52','2021-07-08 09:35:15'),(9,'ec714ff01dc6e0a41a25bb9eaed842ee','https://api.paybox.money/pay.html?customer=bc627f217ae1b79ae8e4b3f1e951b318','2021-07-08 10:43:41','DISABLED','2021-07-08 09:43:41','2021-07-08 09:45:17'),(10,'363ab66b979fcf97264e88c0cf2d1fd9','https://api.paybox.money/pay.html?customer=586ef80655cdadc5ea9d51eaef1255de','2021-07-08 11:01:00','DISABLED','2021-07-08 10:01:00','2021-07-08 10:01:27'),(11,'6e0c1f07ed1fe31cd16e2f57be113c49','https://api.paybox.money/pay.html?customer=9f6a02e748fb410918d63795f652f3b0','2021-07-08 11:05:15','DISABLED','2021-07-08 10:05:15','2021-07-08 10:05:29'),(12,'d8ba2473c8011968feab11ae52b0b88a','https://api.paybox.money/pay.html?customer=67f5a2425e5bd2eebdb7a5255af79ada','2021-07-12 01:20:23','DISABLED','2021-07-12 00:20:23','2021-07-12 00:20:49'),(13,'71199f208ea848118782a30e79676cfb','https://api.paybox.money/pay.html?customer=675b779e0c2fb1ffa1687c8694436945','2021-07-13 02:30:03','DISABLED','2021-07-13 01:30:03','2021-07-13 01:36:16'),(14,'820d8e749046d5feaae79d707b31f299','https://api.paybox.money/pay.html?customer=a5e74991030887adb5db1aa8b63df457','2021-07-14 14:35:50','ENABLED','2021-07-14 13:35:50','2021-07-14 13:35:50'),(15,'434fe955159f60c870b46923f8873544','https://api.paybox.money/pay.html?customer=4d7d52d5d0644b86f494506cb6bb0105','2021-07-14 16:46:09','ENABLED','2021-07-14 15:46:09','2021-07-14 15:46:09'),(16,'1d7e02ebe540b724f1f053d13bafd72c','https://api.paybox.money/pay.html?customer=3909d19bfab76fbb04d27be1bb81b4a3','2021-07-14 17:18:30','ENABLED','2021-07-14 16:18:30','2021-07-14 16:18:30'),(17,'c15d116bce7a702e416afaac81cbbdcd','https://api.paybox.money/pay.html?customer=e7b9c7c6bc22ef47f6fa7573ed4a1bb6','2021-07-14 17:43:57','DISABLED','2021-07-14 16:43:57','2021-07-14 16:44:30'),(18,'ac0bc11297c74a8298ef688aff7c978e','https://api.paybox.money/pay.html?customer=aacebf1b207d5866b29052e26b3072b2','2021-07-14 17:46:13','DISABLED','2021-07-14 16:46:13','2021-07-14 16:46:26'),(19,'dc1a96abd906dcd851aacf44ce288a00','https://api.paybox.money/pay.html?customer=d7ed67df769ea1ce5765bcae886b53ab','2021-07-14 17:50:36','DISABLED','2021-07-14 16:50:36','2021-07-14 16:50:55'),(20,'e7075e44226cb37697b37d9c781dcca3','https://api.paybox.money/pay.html?customer=67800b33a416b7281448bf10c58630c8','2021-07-14 17:56:03','DISABLED','2021-07-14 16:56:03','2021-07-14 16:56:15'),(21,'e006f7765a7a136fd2704f41fa1992c9','https://api.paybox.money/pay.html?customer=4c8332bbd74eb99d5dc4407704db51ef','2021-07-14 17:58:07','DISABLED','2021-07-14 16:58:07','2021-07-14 16:58:16'),(22,'52fef76537b0f1565055e3b448df90d5','https://api.paybox.money/pay.html?customer=cd9b7d82b9c2a1d1452ae47e386bb196','2021-07-14 17:59:41','DISABLED','2021-07-14 16:59:41','2021-07-14 16:59:54'),(23,'556241a6529d70f07cd40c886109f8cf','https://api.paybox.money/pay.html?customer=ebd73c8501c9839704cf81a2e7f2c17d','2021-07-14 18:03:31','DISABLED','2021-07-14 17:03:31','2021-07-14 17:03:42'),(24,'5433c9ec8ff8363a8560a3b3ac8b7399','https://api.paybox.money/pay.html?customer=852fd9b4d396140bb4b77edb5a8df2f1','2021-07-14 18:04:25','DISABLED','2021-07-14 17:04:25','2021-07-14 17:04:37'),(25,'2dc6ecc8469ba258007f4d481584e47d','https://api.paybox.money/pay.html?customer=6d662fc8ebbefe2561005741a8fea093','2021-07-14 18:16:52','DISABLED','2021-07-14 17:16:52','2021-07-14 17:17:06');
/*!40000 ALTER TABLE `links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (21,'2014_10_12_000000_create_users_table',1),(22,'2014_10_12_100000_create_password_resets_table',1),(23,'2019_08_19_000000_create_failed_jobs_table',1),(24,'2021_04_22_111832_create_cities_table',1),(25,'2021_04_22_113934_create_countries_table',1),(27,'2021_04_22_115049_create_categories_table',1),(28,'2021_04_22_122927_create_organization_cities_table',1),(34,'2021_05_18_164923_create_payments_table',1),(35,'2021_05_19_183200_create_tests_table',1),(36,'2021_05_19_194853_create_jobs_table',1),(37,'2021_05_28_162043_create_links_table',1),(38,'2021_06_01_081301_create_contracts_table',1),(39,'2021_06_01_082609_create_privacies_table',1),(40,'2021_06_17_080149_create_cards_table',1),(43,'2021_04_23_084853_create_bookings_table',2),(44,'2021_04_23_094416_create_reviews_table',3),(45,'2021_04_29_081852_create_organization_images_table',4),(46,'2021_07_18_131810_create_languages_table',5),(47,'2021_07_19_162430_create_iikos_table',6),(48,'2021_07_19_173402_create_iiko_tables_table',6),(49,'2021_07_20_121842_create_iiko_table_lists_table',6),(50,'2021_04_29_091847_create_organization_tables_table',7),(51,'2021_04_22_114551_create_organizations_table',8),(52,'2021_05_14_152828_create_organization_table_lists_table',9);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organization_images`
--

DROP TABLE IF EXISTS `organization_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organization_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `organization_id` bigint unsigned NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('ENABLED','DISABLED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ENABLED',
  `parent_id` int DEFAULT '0',
  `lft` int NOT NULL DEFAULT '0',
  `rgt` int NOT NULL DEFAULT '0',
  `depth` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `organization_images_organization_id_index` (`organization_id`),
  KEY `organization_images_parent_id_index` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organization_images`
--

LOCK TABLES `organization_images` WRITE;
/*!40000 ALTER TABLE `organization_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `organization_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organization_table_lists`
--

DROP TABLE IF EXISTS `organization_table_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organization_table_lists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `organization_id` bigint NOT NULL,
  `organization_table_id` bigint NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `limit` int NOT NULL DEFAULT '2',
  `status` enum('ENABLED','FROZEN','DISABLED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ENABLED',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `organization_table_lists_organization_id_index` (`organization_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organization_table_lists`
--

LOCK TABLES `organization_table_lists` WRITE;
/*!40000 ALTER TABLE `organization_table_lists` DISABLE KEYS */;
INSERT INTO `organization_table_lists` VALUES (1,1,1,'Стол № 13',5,'ENABLED','2021-07-23 11:00:07','2021-07-25 06:51:00'),(2,2,3,'Стол №1',4,'ENABLED','2021-07-26 00:10:16','2021-07-26 00:10:16'),(3,2,3,'Стол №2',4,'ENABLED','2021-07-26 00:10:46','2021-07-26 00:10:46'),(4,2,5,'Стол №1',5,'ENABLED','2021-07-26 00:11:12','2021-07-26 00:11:12'),(5,2,3,'Стол №1',10,'ENABLED','2021-07-26 00:11:32','2021-07-26 00:11:32');
/*!40000 ALTER TABLE `organization_table_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organization_tables`
--

DROP TABLE IF EXISTS `organization_tables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organization_tables` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `organization_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('ENABLED','FROZEN','DISABLED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ENABLED',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `organization_tables_organization_id_index` (`organization_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organization_tables`
--

LOCK TABLES `organization_tables` WRITE;
/*!40000 ALTER TABLE `organization_tables` DISABLE KEYS */;
INSERT INTO `organization_tables` VALUES (1,1,'Зал','ENABLED','2021-07-23 10:59:42','2021-07-23 10:59:42'),(2,1,'Зал','DISABLED','2021-07-26 00:03:40','2021-07-26 00:05:57'),(3,2,'Терасса','ENABLED','2021-07-26 00:04:52','2021-07-26 00:07:50'),(4,2,'Общий зал','ENABLED','2021-07-26 00:06:49','2021-07-26 00:08:19'),(5,2,'Зал для курящих','ENABLED','2021-07-26 00:08:31','2021-07-26 00:08:31');
/*!40000 ALTER TABLE `organization_tables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organizations`
--

DROP TABLE IF EXISTS `organizations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organizations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `city_id` bigint NOT NULL,
  `category_id` bigint NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_kz` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` double(8,2) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallpaper` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `description_kz` text COLLATE utf8mb4_unicode_ci,
  `description_en` text COLLATE utf8mb4_unicode_ci,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_kz` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `timezone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tables` int DEFAULT NULL,
  `start_monday` time DEFAULT '00:00:00',
  `end_monday` time DEFAULT '00:00:00',
  `start_tuesday` time DEFAULT '00:00:00',
  `end_tuesday` time DEFAULT '00:00:00',
  `start_wednesday` time DEFAULT '00:00:00',
  `end_wednesday` time DEFAULT '00:00:00',
  `start_thursday` time DEFAULT '00:00:00',
  `end_thursday` time DEFAULT '00:00:00',
  `start_friday` time DEFAULT '00:00:00',
  `end_friday` time DEFAULT '00:00:00',
  `start_saturday` time DEFAULT '00:00:00',
  `end_saturday` time DEFAULT '00:00:00',
  `start_sunday` time DEFAULT '00:00:00',
  `end_sunday` time DEFAULT '00:00:00',
  `status` enum('ENABLED','FROZEN','DISABLED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ENABLED',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `organizations_city_id_index` (`city_id`),
  KEY `organizations_category_id_index` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organizations`
--

LOCK TABLES `organizations` WRITE;
/*!40000 ALTER TABLE `organizations` DISABLE KEYS */;
INSERT INTO `organizations` VALUES (1,2,2,3,'Ocean Bear',NULL,NULL,5.00,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','Asia/Almaty',NULL,NULL,NULL,NULL,'00:00:00','00:00:00','00:00:00','00:00:00','00:00:00','00:00:00','00:00:00','00:00:00','00:00:00','00:00:00','00:00:00','00:00:00','09:00:00','23:00:00','ENABLED','2021-07-23 10:41:49','2021-07-25 03:10:21'),(2,17,2,1,'Шансон',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','Asia/Almaty',NULL,NULL,NULL,NULL,'00:00:00','00:00:00','00:00:00','00:00:00','00:00:00','00:00:00','00:00:00','00:00:00','00:00:00','00:00:00','00:00:00','00:00:00','00:00:00','00:00:00','ENABLED','2021-07-25 22:56:31','2021-07-26 00:09:10');
/*!40000 ALTER TABLE `organizations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pg_payment_id` bigint unsigned DEFAULT NULL,
  `pg_redirect_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pg_sig` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('ENABLED','payed','DISABLED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ENABLED',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `privacies`
--

DROP TABLE IF EXISTS `privacies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `privacies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `json` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `privacies`
--

LOCK TABLES `privacies` WRITE;
/*!40000 ALTER TABLE `privacies` DISABLE KEYS */;
/*!40000 ALTER TABLE `privacies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint NOT NULL,
  `organization_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `rating` double(8,2) DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `status` enum('ENABLED','DISABLED','CHECKING','CANCELED','DELETED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'CHECKING',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reviews_booking_id_unique` (`booking_id`),
  KEY `reviews_organization_id_index` (`organization_id`),
  KEY `reviews_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,1,1,8,5.00,'Hello world!','ENABLED','2021-07-04 05:36:16','2021-07-06 13:25:39'),(2,14,1,2,5.00,'Круто','CHECKING','2021-07-08 03:27:31','2021-07-08 03:27:31'),(3,15,1,2,5.00,'Еруто','CHECKING','2021-07-08 03:33:16','2021-07-08 03:33:16'),(4,16,1,2,5.00,'😋','CHECKING','2021-07-08 03:39:00','2021-07-08 03:39:00'),(5,17,1,2,5.00,'🔥','CHECKING','2021-07-08 03:46:32','2021-07-08 03:46:32'),(6,19,1,2,5.00,'👍','CHECKING','2021-07-08 08:38:24','2021-07-08 08:38:24'),(7,20,1,2,5.00,'👍','CHECKING','2021-07-08 08:38:31','2021-07-08 08:38:31'),(8,21,1,2,5.00,'С','CHECKING','2021-07-08 08:53:31','2021-07-08 08:53:31'),(9,29,1,2,5.00,'👍','CHECKING','2021-07-12 00:23:28','2021-07-12 00:23:28'),(10,30,1,2,5.00,'👍','CHECKING','2021-07-12 06:30:06','2021-07-12 06:30:06'),(11,47,1,2,2.00,'Круто','CHECKING','2021-07-25 02:51:32','2021-07-25 02:51:32');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tests`
--

DROP TABLE IF EXISTS `tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `test` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tests`
--

LOCK TABLES `tests` WRITE;
/*!40000 ALTER TABLE `tests` DISABLE KEYS */;
/*!40000 ALTER TABLE `tests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `role` enum('administrator','moderator','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `blocked` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` char(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_verified_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language_id` bigint DEFAULT NULL,
  `email_notification` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on',
  `push_notification` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_phone_unique` (`phone`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_api_token_unique` (`api_token`),
  KEY `users_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,NULL,'administrator','on','Administrator',NULL,'77777777777','790762','2021-06-30 06:02:34',NULL,NULL,'$2y$10$rojXQFGEgHQLbLWFt2X1mui4RyUCUYEZDNfZiyqAohFFVeTxm.tL6','Kir8jbU2owAqddRJnknvAIVuC3u9KPeXhiWjGWMg50DEbat72pIGv0fj37u7',NULL,'on','on',NULL,NULL,'2021-06-28 02:57:21','2021-06-30 06:02:34'),(2,NULL,'moderator','on','Azim',NULL,'77021366697','302215','2021-07-08 09:53:45',NULL,NULL,'$2y$10$WBB89EpiM75zCR6efvrTQunYMXFAg6wg5zsPFNxzZ1WmPXmQQV/eW','WawGBibFrEM3BcRIheXLmwfhsF3H5AW1hBfJdeUOOJMlgBGoDyQa1sSKfH30',NULL,'on','on',NULL,NULL,'2021-06-28 02:58:36','2021-07-08 09:53:45'),(3,NULL,'user','on','Azim',NULL,'77784139423','184954',NULL,NULL,NULL,'$2y$10$sD1bFthgU9GTj7BFGUkdJ.TygJnXWE4bBUff28RyBDC9yFeFGH0Hm','7lD5GUQpxjM9m5NKl1a2bMuXSGsvzZcy41MisELyy4521IeJVMgjiPnFIyXt',NULL,'on','on',NULL,NULL,'2021-06-28 14:59:19','2021-06-28 14:59:19'),(4,NULL,'user','on','Кенже',NULL,'77009625297','979082',NULL,NULL,NULL,'$2y$10$qxwgRox2Jt5mxJ8iR5CaRe.2eQszHXh5iX5NAcRVf9USgiNHmhAnK','PsCI1sKQi6sQRmoqKemlM8fJPtmDdVP8sOiE2ZWHMjmKWciY1PU3Urbq53dM',NULL,'on','on',NULL,NULL,'2021-06-28 21:06:40','2021-06-28 21:06:40'),(5,NULL,'user','on','Нурлан',NULL,'77017804242','389120','2021-07-04 23:45:50',NULL,NULL,'$2y$10$9iPfYZKTmaOgRMsoWhsXPONJ/NiayF8E3jYKcaFnzJkmztLWAGXoe','aglgAFbUHD7e2iXa1aY5CMxoVHeT1vFE08bc1y1mvDs1kbf1GaKrkoIYHJbX',NULL,'on','on',NULL,NULL,'2021-06-30 05:33:38','2021-07-04 23:45:50'),(6,NULL,'user','on','Кенже',NULL,'77009725297','923377',NULL,NULL,NULL,'$2y$10$pw8xcCBjf7SeWsrey5STbuR8oga.KFDAiomFjtpmFDSfmFnmGpeYu','YJME59fPPykp0Mp7zhXhwHi0CETMXuRbM4ArzM94A8FNFB0cgn4LTj5lpf3E',NULL,'on','on',NULL,NULL,'2021-06-30 21:42:55','2021-06-30 21:42:56'),(7,NULL,'user','on','Алибек',NULL,'77471720275','488559',NULL,NULL,NULL,'$2y$10$KCzLMoZ2jvg095DGUfx9xuZ3I58lZlROvR02kCoCl02SsCn8Vqqia','k0AWzFcfqLkmXf9RvtY5j8UXD0RJhnziwNyn5EZXHKAh9n86qfXF4NRIQTq2',NULL,'on','on',NULL,NULL,'2021-07-03 12:03:46','2021-07-03 12:13:13'),(8,NULL,'user','on','Ersa',NULL,'77784139400','592392','2021-07-04 05:28:29',NULL,NULL,'$2y$10$08Q47Q1JmL.2wZ.eHss45./8.AOsbE03x764J8wmCxskWVuoI2zn6','r7KzRcKE1c7S0M2foYaSdBuNgVwuXCsuW6An3B9zK3Pph7weQKcCs7USDxEg',NULL,'on','on',NULL,NULL,'2021-07-04 05:26:17','2021-07-04 05:28:29'),(9,NULL,'user','on','Ersa',NULL,'77784139424','537162','2021-07-04 07:21:33',NULL,NULL,'$2y$10$OsTXJ2gghJB1HaKWls.t3e3Ku2KPFgoa/YXJqQ0XISFZmtyHwESoC','SIlWkD5ONXB9SSzI0x1sKWNkA93dTD1x6Zq6CfCaS2CtxM9HM3wA4iDspBlD',1,'on','on',NULL,NULL,'2021-07-04 07:21:12','2021-07-21 15:26:54'),(10,2,'user','on','Бабенов Нурлан',NULL,'77011366697','758550',NULL,NULL,NULL,'$2y$10$To8TK3vmefah5hTYi2jEu.M.Qk7egAEXm/QA08XgPJSg/rM/v8Dcm','YTB1S6b2TELk3MkuFMFHu0usEWiGHzZcXxoGqhGRAjdJ9wQ1UqarZfHFX3n7',NULL,'on','on',NULL,NULL,'2021-07-08 03:37:19','2021-07-08 03:37:19'),(11,2,'user','on','Бабенов Нурлан',NULL,'77701780424','657473',NULL,NULL,NULL,'$2y$10$0qTGGnyLUQkkDMHaTwC.qe2WLDhJNEF9UgiENNDyxEZI01hf.qfZe','MdkUjig8SUt31aW0wbq7lgFkO8dlsZjxanlqosPQESL1b01znkJ5vIuvP7t6',NULL,'on','on',NULL,NULL,'2021-07-08 03:47:23','2021-07-08 03:47:23'),(12,NULL,'user','on','Кенже',NULL,'77014459329','251807',NULL,NULL,NULL,'$2y$10$zNsHNu27e6wEBRKp481UJ.2LON3tNJiNTCKDjQuQ4rFi1Zifvfc2y','cB0oeqraSkf8K4tksKSTZwuKaeHasINQZKwyz7BxORxjVy4d9V5XmKK4zZsx',NULL,'on','on',NULL,NULL,'2021-07-08 04:16:24','2021-07-08 04:16:24'),(13,NULL,'user','on','Сымбат',NULL,'77078114458','356562','2021-07-08 09:14:01',NULL,NULL,'$2y$10$zvPjwu4sqLy3zto8dLuwoO7VJclOTJT.FMkqFsqDu9Quyu8qC0i/O','73XqV0UoxxEgMCDr8gSZ3Trih3q8FASCyeGxpjJiCRdCcD6kRCbIuiiFQlUn',NULL,'on','on',NULL,NULL,'2021-07-08 09:13:19','2021-07-08 09:14:01'),(14,NULL,'user','on','Бекжан',NULL,'77015008822','907885','2021-07-08 13:58:11',NULL,NULL,'$2y$10$rUTld9vZVY0E8uYOxBGEUe2JQ/Jje5TvKvs8Z70SHnMwWD4u.ITSa','qPNBCIRSM40CR1UN0mnFJyantwlEHvib3C06JxnEH9P76VqEukNfLACnDxlM',NULL,'on','on',NULL,NULL,'2021-07-08 13:57:57','2021-07-08 13:58:11'),(15,NULL,'user','on','Ернар',NULL,'77023480800','467465','2021-07-13 01:49:58',NULL,NULL,'$2y$10$onMmjgiRn8EHzltGk4ZrIuYQncVwZL.MbiSbMmYajR8bl.sd0BZNq','H2R89eXt290C2ed6yvfgnOnaLvA25GhKXOiBqhOAAnKxqF9axVCjkgEU4M2s',NULL,'on','on',NULL,NULL,'2021-07-09 04:38:29','2021-07-13 01:49:58'),(16,NULL,'user','on','Роза',NULL,'77016358380','392412',NULL,NULL,NULL,'$2y$10$wjaRc22O3svD.irS7eUOWOq0GUKbNwq.J2hFlrhatzenlAMHQ0LLO','yPyFQO99j4wlZgK0HLlw3eWNWezRzFELcwqdFjJ6bvZhphDewRroJydRneha',NULL,'on','on',NULL,NULL,'2021-07-09 05:14:54','2021-07-09 05:17:24'),(17,1,'moderator','on','Диас',NULL,'77052395112','586585','2021-07-25 22:49:36',NULL,NULL,'$2y$10$PBf48/fHbGfnHuVkx3Qzl.vtEmzELrpf/RKQwsuSCvmxkJGVZ5oZ.','YqJDtHIyUBKpOnAuaRdZYzAYBGxa4euYMrmS3P7ODDtCPHJXvGBJAEyH2Yqn',NULL,'on','on',NULL,NULL,'2021-07-25 22:44:07','2021-07-25 23:52:52');
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

-- Dump completed on 2021-07-26 12:19:12
