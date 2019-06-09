-- MySQL dump 10.13  Distrib 5.7.26, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: db_ecommerce
-- ------------------------------------------------------
-- Server version	5.7.26-0ubuntu0.16.04.1

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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `image_original_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Вода','5ce7118c8d23c377722940.jpeg','2019-05-24 00:33:00','water.jpeg'),(2,'Техника','5ce711a24063f097520543.jpeg','2019-05-24 00:33:22','tekhnica.jpeg'),(3,'Книги','5ce711b0c6ad2618781039.jpg','2019-05-24 00:33:36','books.jpg'),(4,'Инструмент','5ce711bc235f8018026327.jpg','2019-05-24 00:33:48','instrument.jpg'),(5,'Одежда','5ce711c7594b5069850334.jpg','2019-05-24 00:33:59','clothes.jpg'),(6,'Тест','5ce711d51b940201021185.png','2019-05-24 00:34:13','test'),(7,'Бытовая техника','5ce711e1afa8f704649502.jpeg','2019-05-24 00:34:25','bit_tekhnic.jpeg'),(8,'Продукты','5ce71200defad070711812.jpg','2019-05-24 00:34:56','products.jpg');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback_request`
--

DROP TABLE IF EXISTS `feedback_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `topic` int(11) NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback_request`
--

LOCK TABLES `feedback_request` WRITE;
/*!40000 ALTER TABLE `feedback_request` DISABLE KEYS */;
INSERT INTO `feedback_request` VALUES (1,'gffff','fffff',2,'fffff'),(2,'Воландеморд','fffff@gmail.com',2,'1234567891011'),(3,'Test','Test@gmail.com',2,'Test567890');
/*!40000 ALTER TABLE `feedback_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_versions`
--

LOCK TABLES `migration_versions` WRITE;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
INSERT INTO `migration_versions` VALUES ('20190505215238','2019-05-05 21:54:48'),('20190505221444','2019-05-05 22:15:06'),('20190506143955','2019-05-06 14:40:02'),('20190511143122','2019-05-11 14:32:05'),('20190511145845','2019-05-11 14:58:56'),('20190512152322','2019-05-12 15:23:30'),('20190512214107','2019-05-12 21:41:18'),('20190513113923','2019-05-13 11:39:36'),('20190517110818','2019-05-17 11:08:31'),('20190517114558','2019-05-17 11:46:03'),('20190517123347','2019-05-17 12:33:52'),('20190606202457','2019-06-06 20:25:05');
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `is_paid` tinyint(1) NOT NULL,
  `amount` int(11) NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F5299398A76ED395` (`user_id`),
  CONSTRAINT `FK_F5299398A76ED395` FOREIGN KEY (`user_id`) REFERENCES `site_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (3,NULL,'2019-05-13 14:40:18',1,0,4623600,NULL,NULL,NULL),(4,NULL,'2019-05-14 14:58:23',1,0,2320000,NULL,NULL,NULL),(5,NULL,'2019-05-14 22:06:31',1,0,7778000,NULL,NULL,NULL),(6,NULL,'2019-05-15 00:04:36',1,0,9287200,NULL,NULL,NULL),(7,NULL,'2019-05-22 17:28:09',1,0,4643600,NULL,NULL,NULL),(8,NULL,'2019-05-22 20:57:32',1,0,7681800,NULL,NULL,NULL),(9,NULL,'2019-05-22 23:51:50',1,0,700000,NULL,NULL,NULL),(10,NULL,'2019-05-24 00:22:20',1,0,3221800,NULL,NULL,NULL),(11,NULL,'2019-06-06 23:22:18',1,0,2321800,NULL,NULL,NULL),(12,NULL,'2019-06-07 00:14:53',1,0,2301800,NULL,NULL,NULL),(13,NULL,'2019-06-07 12:52:15',1,0,2321800,'887878787','нлнглнглнглнг','нлнглнглнглнг'),(14,NULL,'2019-06-07 12:54:12',1,0,2320000,'46636346','ierwjtehrjyth@gmail.com','34е34еуке'),(15,NULL,'2019-06-07 13:02:29',1,0,2321800,'+380777777777','test777@gmail.com','вул козинця 54'),(16,NULL,'2019-06-09 22:01:27',1,0,0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_item`
--

DROP TABLE IF EXISTS `order_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_52EA1F094584665A` (`product_id`),
  KEY `IDX_52EA1F098D9F6D38` (`order_id`),
  CONSTRAINT `FK_52EA1F094584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `FK_52EA1F098D9F6D38` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_item`
--

LOCK TABLES `order_item` WRITE;
/*!40000 ALTER TABLE `order_item` DISABLE KEYS */;
INSERT INTO `order_item` VALUES (1,1,2,1800,3600,3),(2,2,1,20000,20000,3),(3,3,2,1600000,3200000,3),(4,4,2,700000,1400000,3),(5,4,1,700000,700000,4),(6,2,1,20000,20000,4),(7,3,1,1600000,1600000,4),(8,3,2,1600000,3200000,5),(9,4,6,700000,4200000,5),(10,2,18,20000,360000,5),(11,1,10,1800,18000,5),(12,1,4,1800,7200,6),(13,4,4,700000,2800000,6),(14,2,4,20000,80000,6),(15,3,4,1600000,6400000,6),(16,1,2,1800,3600,7),(17,2,2,20000,40000,7),(18,3,2,1600000,3200000,7),(19,4,2,700000,1400000,7),(20,2,4,20000,80000,8),(21,3,3,1600000,4800000,8),(22,4,4,700000,2800000,8),(23,1,1,1800,1800,8),(28,4,1,700000,700000,9),(30,3,2,1600000,3200000,10),(31,2,1,20000,20000,10),(32,1,1,1800,1800,10),(33,4,1,700000,700000,11),(34,3,1,1600000,1600000,11),(35,2,1,20000,20000,11),(36,1,1,1800,1800,11),(37,1,1,1800,1800,12),(38,3,1,1600000,1600000,12),(39,4,1,700000,700000,12),(40,1,1,1800,1800,13),(41,2,1,20000,20000,13),(42,3,1,1600000,1600000,13),(43,4,1,700000,700000,13),(44,2,1,20000,20000,14),(45,3,1,1600000,1600000,14),(46,4,1,700000,700000,14),(47,2,1,20000,20000,15),(48,3,1,1600000,1600000,15),(49,4,1,700000,700000,15),(50,1,1,1800,1800,15);
/*!40000 ALTER TABLE `order_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `price` int(11) NOT NULL,
  `count` int(11) DEFAULT NULL,
  `is_top` tinyint(1) NOT NULL DEFAULT '0',
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `image_original_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Вода Моршинська 0.5',NULL,1800,NULL,0,'5ce711110d18f844313569.jpg',NULL,'morsh.jpg','2019-06-07 13:02:33'),(2,'Мишка Vinga',NULL,20000,NULL,1,'5ce711584208e531665858.jpg',NULL,'vinga.jpg','2019-06-09 22:11:39'),(3,'Ноутбук Asus',NULL,1600000,NULL,0,'5ce7116ab27b6420661050.jpg',NULL,'asus.jpg','2019-06-09 22:11:40'),(4,'Смартфон',NULL,700000,NULL,0,'5ce7117c97dd0220975407.png',NULL,'xiaomi.png','2019-06-09 22:01:27');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_category`
--

DROP TABLE IF EXISTS `product_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`category_id`),
  KEY `IDX_CDFC73564584665A` (`product_id`),
  KEY `IDX_CDFC735612469DE2` (`category_id`),
  CONSTRAINT `FK_CDFC735612469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_CDFC73564584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_category`
--

LOCK TABLES `product_category` WRITE;
/*!40000 ALTER TABLE `product_category` DISABLE KEYS */;
INSERT INTO `product_category` VALUES (1,1),(1,8),(2,2),(2,7),(3,2),(3,6),(3,7);
/*!40000 ALTER TABLE `product_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_user`
--

DROP TABLE IF EXISTS `site_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B6096BB092FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_B6096BB0A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_B6096BB0C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_user`
--

LOCK TABLES `site_user` WRITE;
/*!40000 ALTER TABLE `site_user` DISABLE KEYS */;
INSERT INTO `site_user` VALUES (1,'admin','admin','admin@supershop.com','admin@supershop.com',1,NULL,'$2y$13$YAR8fhGt.uCd9klWnAd4Eu5JzJJptes.x3K/uflsdt6V1SAHk3WRq','2019-05-24 00:22:51',NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}',NULL,NULL);
/*!40000 ALTER TABLE `site_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-06-09 22:15:37
