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
-- Table structure for table `ordenes`
--

DROP TABLE IF EXISTS `ordenes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ordenes` (
  `id_ordenes` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_ordenes` varchar(45) NOT NULL,
  `hora_ordenes` varchar(45) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `direccion` varchar(225) NOT NULL,
  `cod_postal` varchar(5) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `moneda` float DEFAULT NULL,
  `envio` double DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  PRIMARY KEY (`id_ordenes`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordenes`
--

LOCK TABLES `ordenes` WRITE;
/*!40000 ALTER TABLE `ordenes` DISABLE KEYS */;
INSERT INTO `ordenes` VALUES (1,'16/09/2013','20:43:22','vdsbv','hihl','lnkn','nlÃ±nÃ±','62829','Pachuca',NULL,NULL,NULL,NULL),(2,'16/09/2013','21:11:53','slf','hophp','hph','Â´jpj','98989','Pachuca',NULL,NULL,NULL,NULL),(3,'16/09/2013','21:13:46','knlk','jpojop','jpjp','npo','89709','Pachuca',NULL,NULL,NULL,NULL),(4,'16/09/2013','21:15:44','nsg','hpoh','phooh','Â´pjÂ´j','87987','Pachuca',NULL,NULL,NULL,NULL),(5,'16/09/2013','21:17:31','Jose ','sfsa','7789131','algunlugar','23456','Pachuca',50,0,36,36),(6,'20/09/2013','20:12:37','Alguien','afa','ijpi','jpijfp','42000','Pachuca',NULL,NULL,NULL,NULL),(7,'20/09/2013','20:48:19','Jorge Enrique','Gamboa Fuentes','7711852074','Privada Hacienda de Chicavasco # 126 Col. Haciendas de Hidalgo','42082','Pachuca',200,35,120,155),(8,'20/09/2013','21:06:54','Petro','ofs','njno','nok','78678','Pachuca',1,0,12,12),(9,'20/09/2013','21:46:46','Juanito','Perez','71810313','Priv haaafwqfs col afsaf','42083','Pachuca',350,0,324,324),(10,'28/09/2013','15:43:00','jose jose','principe','55972131','Algun lugar','42098','Pachuca',1,0,59,59),(11,'06/10/2013','23:00:03','Jorge Enrique ','Gamboa Fuentes','7711852074','Privada Hacienda de Chicavasco # 126','42082','Pachuca',NULL,NULL,NULL,NULL),(12,'06/10/2013','23:01:26','Jorbg','dsgf','24324','dgds','34564','Pachuca',NULL,NULL,NULL,NULL),(13,'06/10/2013','23:03:53','alguien','que ','77118','ihph','43567','Pachuca',NULL,NULL,NULL,NULL),(14,'06/10/2013','23:06:37','una persona','akgsf','772214','safsa','42082','Pachuca',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `ordenes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-13 13:01:10
