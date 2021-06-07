CREATE DATABASE  IF NOT EXISTS `lamp` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `lamp`;
-- MySQL dump 10.13  Distrib 8.0.24, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: lamp
-- ------------------------------------------------------
-- Server version	5.7.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `announcement_facilities`
--

DROP TABLE IF EXISTS `announcement_facilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `announcement_facilities` (
  `idannouncement` int(10) unsigned NOT NULL,
  `idfacility` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idannouncement`,`idfacility`),
  KEY `FK_facility_idx` (`idfacility`),
  CONSTRAINT `FK_annoucement` FOREIGN KEY (`idannouncement`) REFERENCES `announcements` (`idannouncement`),
  CONSTRAINT `FK_facility` FOREIGN KEY (`idfacility`) REFERENCES `facilities` (`idfacility`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Lien entre les deux tables (many to many)';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcement_facilities`
--

LOCK TABLES `announcement_facilities` WRITE;
/*!40000 ALTER TABLE `announcement_facilities` DISABLE KEYS */;
INSERT INTO `announcement_facilities` VALUES (1,1),(1,2),(2,2),(1,3),(1,4),(2,4),(1,5),(1,6),(2,6);
/*!40000 ALTER TABLE `announcement_facilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `announcements` (
  `idannouncement` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city` varchar(45) NOT NULL,
  `country` varchar(45) NOT NULL,
  `title` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `rent_type` varchar(45) NOT NULL,
  `price` varchar(45) NOT NULL,
  `owner_id` int(10) unsigned NOT NULL,
  `persons` int(4) unsigned NOT NULL COMMENT 'max de personne',
  PRIMARY KEY (`idannouncement`),
  KEY `FK_owner_id_idx` (`owner_id`),
  CONSTRAINT `FK_owner_id` FOREIGN KEY (`owner_id`) REFERENCES `users` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Les annonces des annonceurs ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcements`
--

LOCK TABLES `announcements` WRITE;
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
INSERT INTO `announcements` VALUES (1,'Cerbere','France','Tout au sud','Vue sur la cote','maison individuelle','185',1,8),(2,'Cadaques','Espagne','Tout au nord','Vue sur la cote (sans blague)','chambre collective','40',3,3);
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookings` (
  `idbookings` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `begin_at` date NOT NULL,
  `end_at` date NOT NULL,
  `iduser` int(10) unsigned NOT NULL,
  `idannouncement` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idbookings`),
  KEY `FK_renter_id_idx` (`iduser`),
  KEY `FK_annoucement_id_idx` (`idannouncement`),
  CONSTRAINT `FK_annoucement_id` FOREIGN KEY (`idannouncement`) REFERENCES `announcements` (`idannouncement`),
  CONSTRAINT `FK_renter_id` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Liste des réservations ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (1,'2021-07-15','2021-07-28',2,1),(2,'2021-07-29','2021-08-05',2,1);
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facilities`
--

DROP TABLE IF EXISTS `facilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `facilities` (
  `idfacility` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_facility` varchar(45) NOT NULL,
  PRIMARY KEY (`idfacility`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Table des équipements possibles des locations';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facilities`
--

LOCK TABLES `facilities` WRITE;
/*!40000 ALTER TABLE `facilities` DISABLE KEYS */;
INSERT INTO `facilities` VALUES (1,'animaux acceptés'),(2,'cafetière'),(3,'machine a laver'),(4,'grille-pain'),(5,'micro-onde'),(6,'box-internet');
/*!40000 ALTER TABLE `facilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `iduser` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `passsword` varchar(45) NOT NULL,
  `mail` varchar(45) NOT NULL,
  `role` int(2) unsigned NOT NULL COMMENT '0 annonceur\n1 utilisateur',
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='table des utilisateurs';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Pierre','caillou','rocher@montagne.com',0),(2,'Paul','walker','rip@heaven.com',1),(3,'Ken','hadoken','chunlilabg@street.fr',0),(4,'Hacker','smith','jecassetout@np.bro',2);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'lamp'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-03  8:25:04
