-- MariaDB dump 10.18  Distrib 10.4.17-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: fgw
-- ------------------------------------------------------
-- Server version	10.4.17-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `pproc`
--

DROP TABLE IF EXISTS `pproc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pproc` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `e-1` int(11) NOT NULL DEFAULT 0,
  `e-2` int(11) NOT NULL DEFAULT 0,
  `e-3` int(11) NOT NULL DEFAULT 0,
  `e-4` int(11) NOT NULL DEFAULT 0,
  `e-5` int(11) NOT NULL DEFAULT 0,
  `k-1` int(11) NOT NULL DEFAULT 0,
  `k-2` int(11) NOT NULL DEFAULT 0,
  `k-3` int(11) NOT NULL DEFAULT 0,
  `k-4` int(11) NOT NULL DEFAULT 0,
  `k-5` int(11) NOT NULL DEFAULT 0,
  `k-6` int(11) NOT NULL DEFAULT 0,
  `k-7` int(11) NOT NULL DEFAULT 0,
  `q-1` int(11) NOT NULL DEFAULT 0,
  `w-1` int(11) NOT NULL DEFAULT 0,
  `w-2` int(11) NOT NULL DEFAULT 0,
  `w-3` int(11) NOT NULL DEFAULT 0,
  `w-4` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pproc`
--

LOCK TABLES `pproc` WRITE;
/*!40000 ALTER TABLE `pproc` DISABLE KEYS */;
INSERT INTO `pproc` VALUES (1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(2,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(3,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(4,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(5,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(6,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(7,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(8,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(9,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(10,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(11,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(12,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(13,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(14,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(15,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(16,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(17,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(18,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(19,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(20,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(21,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(22,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(23,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(24,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(25,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(26,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(27,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(28,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(29,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(30,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(31,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(32,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(33,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(34,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(35,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(36,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(37,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(38,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(39,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(40,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(41,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(42,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(43,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(44,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(45,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(46,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(47,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(48,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(49,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(50,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(51,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(52,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(53,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(54,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(55,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(56,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(57,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(58,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(59,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(60,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(61,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(62,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(63,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(64,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(65,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(66,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(67,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(68,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(69,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(70,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(71,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(72,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(73,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(74,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(75,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(76,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(77,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(78,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(79,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(80,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(81,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(82,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(83,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(84,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(85,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(86,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(87,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(88,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(89,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(90,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(91,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(92,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(93,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(94,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(95,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(96,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(97,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(98,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(99,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(100,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(101,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(102,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(103,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(104,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(105,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
/*!40000 ALTER TABLE `pproc` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-02-23 11:56:43