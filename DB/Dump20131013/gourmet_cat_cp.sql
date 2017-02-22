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
-- Table structure for table `cat_cp`
--

DROP TABLE IF EXISTS `cat_cp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cat_cp` (
  `cp` varchar(10) NOT NULL,
  `precio` double NOT NULL,
  `descripcion` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`cp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_cp`
--

LOCK TABLES `cat_cp` WRITE;
/*!40000 ALTER TABLE `cat_cp` DISABLE KEYS */;
INSERT INTO `cat_cp` VALUES ('42000',10,'Centro Historico'),('42004',0,'La Granada'),('42008',0,'Secretaria de Hacienda y Credito Publico'),('42009',0,'Palacio de Gobierno del Estado de Hidalgo'),('42010',0,'Arbolito'),('42014',0,'Nueva Estrella 1a Secc'),('42015',0,'Asta Bandera'),('42018',0,'San Nicolas'),('42020',0,'Jose Lopez Portillo'),('42026',0,'Lomas de Vista Hermosa'),('42027',0,'Antonio del Castillo'),('42029',0,'Union Popular'),('42030',0,'Javier Rojo Gomez 1a'),('42032',0,'Parque de Poblamiento'),('42033',0,'Los Cedros'),('42034',0,'Javier Rojo Gomez 2a Secc'),('42035',0,'Plutarco Elias Calles 1a Secc'),('42036',0,'Nuevo Hidalgo'),('42037',0,'Cereso Pachuca'),('42039',0,'15 de Septiembre'),('42040',0,'Morelos 2a Secc'),('42050',0,'La Surtidora'),('42055',0,'Anahuac'),('42056',0,'Cruz de los Ciegos'),('42057',0,'San Clemente'),('42058',0,'El lobo'),('42059',0,'Secretaria de Salud'),('42060',0,'Maestranza'),('42064',0,'Cuesco'),('42070',0,'Francico I Madero'),('42075',0,'Canutillo'),('42078',0,'Ciudad de los Ni??os'),('42079',0,'Guadalupe 1a Secc'),('42080',0,'Constitucion'),('42081',0,'Centro SCT Hidalgo'),('42082',35,'Haciendas la Herradura'),('42083',0,'Campo de Golf'),('42084',0,'Arboledas San Javier 1a Seccion'),('42086',0,'La Puerta de Hierro'),('42088',0,'El palmar'),('42090',0,'Cubitos'),('42092',0,'18 de Marzo'),('42094',0,'Bosques del Penar'),('42095',0,'La Raza'),('42096',0,'Unidad Minera 11 de Julio'),('42097',0,'Cerro de Animas'),('42098',0,'Las Terrazas'),('42099',0,'Ciudad de Pachuca'),('42100',0,'Aquiles Cerdan'),('42101',0,'Camelia'),('42103',0,'Santa Julia'),('42110',0,'Santiago Tlapacoya'),('42111',0,'Santa Gertrudis'),('42115',0,'El Huixmi'),('42119',0,'Caminera');
/*!40000 ALTER TABLE `cat_cp` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-13 13:01:05
