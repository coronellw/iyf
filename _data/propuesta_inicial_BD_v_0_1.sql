CREATE DATABASE  IF NOT EXISTS `IYF` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `IYF`;
-- MySQL dump 10.13  Distrib 5.5.37, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: IYF
-- ------------------------------------------------------
-- Server version	5.5.37-0ubuntu0.14.04.1

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
-- Table structure for table `contact_type`
--

DROP TABLE IF EXISTS `contact_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_type` (
  `id_contact_type` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_contact_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_type`
--

LOCK TABLES `contact_type` WRITE;
/*!40000 ALTER TABLE `contact_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_user`
--

DROP TABLE IF EXISTS `contact_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_user` (
  `id_contact` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_contact`,`id_user`),
  KEY `fk_contact_user_2_idx` (`id_user`),
  CONSTRAINT `fk_contact_user_1` FOREIGN KEY (`id_contact`) REFERENCES `contacts` (`id_contact`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_contact_user_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_user`
--

LOCK TABLES `contact_user` WRITE;
/*!40000 ALTER TABLE `contact_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id_contact` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `value` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`id_contact`),
  KEY `fk_contacts_1_idx` (`type`),
  CONSTRAINT `fk_contacts_1` FOREIGN KEY (`type`) REFERENCES `contact_type` (`id_contact_type`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id_country` int(11) NOT NULL,
  `name` varchar(75) NOT NULL,
  PRIMARY KEY (`id_country`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id_group` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `group_master` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_group`),
  KEY `fk_groups_1_idx` (`group_master`),
  CONSTRAINT `fk_groups_1` FOREIGN KEY (`group_master`) REFERENCES `users` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modalities`
--

DROP TABLE IF EXISTS `modalities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modalities` (
  `id_modality` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_modality`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modalities`
--

LOCK TABLES `modalities` WRITE;
/*!40000 ALTER TABLE `modalities` DISABLE KEYS */;
/*!40000 ALTER TABLE `modalities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_type`
--

DROP TABLE IF EXISTS `payment_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_type` (
  `id_pyament_type` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_pyament_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_type`
--

LOCK TABLES `payment_type` WRITE;
/*!40000 ALTER TABLE `payment_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_user`
--

DROP TABLE IF EXISTS `payment_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_user` (
  `id_payment` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_payment`,`id_user`),
  KEY `fk_payment_user_2_idx` (`id_user`),
  CONSTRAINT `fk_payment_user_1` FOREIGN KEY (`id_payment`) REFERENCES `payments` (`id_payment`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_payment_user_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_user`
--

LOCK TABLES `payment_user` WRITE;
/*!40000 ALTER TABLE `payment_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id_payment` int(11) NOT NULL AUTO_INCREMENT,
  `amount` decimal(5,2) NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `id_paymennt_type` int(11) DEFAULT '1',
  PRIMARY KEY (`id_payment`),
  KEY `fk_payments_1_idx` (`id_paymennt_type`),
  CONSTRAINT `fk_payments_1` FOREIGN KEY (`id_paymennt_type`) REFERENCES `payment_type` (`id_pyament_type`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scolarships`
--

DROP TABLE IF EXISTS `scolarships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `scolarships` (
  `id_scolarship` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_scolarship`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scolarships`
--

LOCK TABLES `scolarships` WRITE;
/*!40000 ALTER TABLE `scolarships` DISABLE KEYS */;
/*!40000 ALTER TABLE `scolarships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `names` varchar(100) DEFAULT NULL,
  `last_names` varchar(100) DEFAULT NULL,
  `genre` varchar(1) NOT NULL,
  `born` date DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `scolarship` int(11) DEFAULT NULL,
  `assistance` varchar(1) DEFAULT 'N',
  `id_group` int(11) DEFAULT NULL,
  `usrnm` varchar(20) NOT NULL,
  `id_usertype` int(11) DEFAULT NULL,
  `id_modality` int(11) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  `registered` timestamp NULL DEFAULT NULL,
  `country` int(11) DEFAULT '1',
  `psswrd` text NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username_UNIQUE` (`usrnm`),
  KEY `fk_users_1_idx` (`scolarship`),
  KEY `fk_users_2_idx` (`id_usertype`),
  KEY `fk_users_3_idx` (`id_modality`),
  KEY `fk_users_4_idx` (`id_group`),
  KEY `fk_users_5_idx` (`country`),
  CONSTRAINT `fk_users_1` FOREIGN KEY (`scolarship`) REFERENCES `scolarships` (`id_scolarship`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_users_2` FOREIGN KEY (`id_usertype`) REFERENCES `usertypes` (`id_usertype`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_users_3` FOREIGN KEY (`id_modality`) REFERENCES `modalities` (`id_modality`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_users_4` FOREIGN KEY (`id_group`) REFERENCES `groups` (`id_group`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_5` FOREIGN KEY (`country`) REFERENCES `countries` (`id_country`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usertypes`
--

DROP TABLE IF EXISTS `usertypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usertypes` (
  `id_usertype` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_usertype`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usertypes`
--

LOCK TABLES `usertypes` WRITE;
/*!40000 ALTER TABLE `usertypes` DISABLE KEYS */;
/*!40000 ALTER TABLE `usertypes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-06-30 16:34:14
