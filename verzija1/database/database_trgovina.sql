-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: spletna_trgovina
-- ------------------------------------------------------
-- Server version	5.7.19

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
-- Table structure for table `anonimniodjemalec`
--

DROP TABLE IF EXISTS `anonimniodjemalec`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anonimniodjemalec` (
  `ip` varchar(45) NOT NULL,
  `cas_dostopa` datetime NOT NULL,
  PRIMARY KEY (`ip`,`cas_dostopa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anonimniodjemalec`
--

LOCK TABLES `anonimniodjemalec` WRITE;
/*!40000 ALTER TABLE `anonimniodjemalec` DISABLE KEYS */;
/*!40000 ALTER TABLE `anonimniodjemalec` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `price` float NOT NULL,
  `description` varchar(220) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `active` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,'bb',100,'aa',1),(2,'ii',20,'ii',0),(3,'ll',22,'ll',0),(4,'Trousers',20,'Blue trousers for adults',1);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dnevnik`
--

DROP TABLE IF EXISTS `dnevnik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dnevnik` (
  `vloga` varchar(45) NOT NULL,
  `datum` datetime NOT NULL,
  `akcija` varchar(45) NOT NULL,
  PRIMARY KEY (`vloga`,`datum`,`akcija`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dnevnik`
--

LOCK TABLES `dnevnik` WRITE;
/*!40000 ALTER TABLE `dnevnik` DISABLE KEYS */;
/*!40000 ALTER TABLE `dnevnik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `order_id` varchar(32) COLLATE utf8_slovenian_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `state` varchar(20) COLLATE utf8_slovenian_ci DEFAULT 'pending',
  PRIMARY KEY (`order_id`,`user_id`,`article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES ('b37b5f0d66909d3cc26ac3dfa1787cb8',13,1,2,'confirmed');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin'),(2,'seller'),(3,'client'),(4,'anonymous');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shopping_cart`
--

DROP TABLE IF EXISTS `shopping_cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shopping_cart` (
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shopping_cart`
--

LOCK TABLES `shopping_cart` WRITE;
/*!40000 ALTER TABLE `shopping_cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `shopping_cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `last_name` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `street_address` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `city` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `postal_code` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `country` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `phone_number` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `password` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `role_id` int(11) DEFAULT '1',
  `active` varchar(45) COLLATE utf8_slovenian_ci DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'HELL','HELL',NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,'1'),(2,'Janez','Novak','googla 3','google','1000','Gugl','440404040','janez@email.com','password',4,'1'),(3,'sdf','jhghjgj','jhgkj','jhgkjghg','jhgkjgkj','ghjgkhgjkg','jhgkjgjkg','jhgjkgkjg','hjgkjgjkg',4,'1'),(4,'dfgdsfg','hgfhjf','hghgfhg','hgfhgf','jhfhgfghfhj','gfhjghjg','gfhgfjfj','fhgfjgfjhf','hjgfjgh',4,'1'),(5,'asdf','asdf','asdf','asdf','asfd','asfd','afds','asdf','asdf',4,'1'),(6,'Elon','Musk','','','','','','admin@admin.si','admin',1,'1'),(7,'','','','','','','','','',4,'1'),(8,'oiuipopouuoui','gfhg','h','ghfhj','fhgfh','fhgfhgf','hgfhj','aha','aha',4,'1'),(10,'Anka','Drobec',NULL,NULL,NULL,NULL,NULL,'anka@anka.si','anka',2,'1'),(11,'dada','ega',NULL,NULL,NULL,NULL,NULL,'da@da.si','dada',2,'1'),(12,'ja','ja',NULL,NULL,NULL,NULL,NULL,'ja','ja',2,'1'),(13,'Miha','Tanko','Zalozniška 20','Ljubljana','1000','Slovenija','031 553 396','miha@miha.si','miha',3,'1'),(14,'ff','ff','ff','ff','ff','ff','ff','ff','ff',3,'1');
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

-- Dump completed on 2018-01-14 22:04:08
