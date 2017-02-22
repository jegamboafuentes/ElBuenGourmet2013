CREATE DATABASE  IF NOT EXISTS `gourmet` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gourmet`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: gourmet
-- ------------------------------------------------------
-- Server version	5.5.27

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
-- Table structure for table `detalle_menu`
--

DROP TABLE IF EXISTS `detalle_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_menu` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NOT NULL,
  `id_plat` varchar(10) NOT NULL,
  `nombre_especial` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `id_menu_idx` (`id_menu`),
  KEY `id_plat_idx` (`id_plat`),
  CONSTRAINT `id_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_plat` FOREIGN KEY (`id_plat`) REFERENCES `platillo` (`id_plat`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=199 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_menu`
--

LOCK TABLES `detalle_menu` WRITE;
/*!40000 ALTER TABLE `detalle_menu` DISABLE KEYS */;
INSERT INTO `detalle_menu` VALUES (152,16,'114',NULL),(153,16,'21',NULL),(154,16,'199',NULL),(155,16,'99',NULL),(156,16,'97',NULL),(157,16,'4',NULL),(158,16,'197',NULL),(159,16,'198',NULL),(160,16,'159',NULL),(161,16,'193',NULL),(162,16,'192',NULL),(163,16,'2',NULL),(164,16,'320',NULL),(166,16,'6',NULL),(167,16,'10','algo'),(168,16,'11',NULL),(169,16,'36',NULL),(170,16,'39',NULL),(171,16,'44',NULL),(172,16,'83',NULL),(173,16,'85',NULL),(174,16,'86',NULL),(175,16,'5','pollo'),(176,16,'7',NULL),(177,16,'8',NULL),(178,16,'99',NULL),(179,16,'162',NULL),(180,17,'6',NULL),(181,19,'6',NULL),(182,19,'142',NULL),(183,19,'114',NULL),(184,19,'21',NULL),(185,19,'199',NULL),(186,19,'99',NULL),(187,19,'97',NULL),(188,19,'4',NULL),(189,19,'197',NULL),(190,19,'198',NULL),(191,19,'159',NULL),(192,19,'193',NULL),(193,19,'192',NULL),(194,19,'2',NULL),(195,19,'320',NULL),(196,19,'162',NULL),(198,19,'10','lhhlskfsakfsdakfÃ±sda lksajflsad kjsafjpasf');
/*!40000 ALTER TABLE `detalle_menu` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-13 13:01:17
