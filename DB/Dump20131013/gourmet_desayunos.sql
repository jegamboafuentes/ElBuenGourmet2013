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
-- Table structure for table `desayunos`
--

DROP TABLE IF EXISTS `desayunos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `desayunos` (
  `id_desayunos` int(11) NOT NULL,
  `nombre_desayuno` varchar(50) NOT NULL,
  `precio` double NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `descripcion_desayuno` varchar(50) DEFAULT NULL,
  `especial` int(11) NOT NULL,
  PRIMARY KEY (`id_desayunos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `desayunos`
--

LOCK TABLES `desayunos` WRITE;
/*!40000 ALTER TABLE `desayunos` DISABLE KEYS */;
INSERT INTO `desayunos` VALUES (1,'Paste',12,'desayuno',NULL,1),(2,'Pastel de la casa',40,'postre',NULL,0),(3,'Torta de tamal ',15,'desayuno',NULL,0),(4,'Atole',10,'bebida',NULL,0),(5,'Agua',8,'bebida',NULL,0),(6,'Cafe de olla',8,'bebida',NULL,0),(7,'Cafe con leche',11,'bebida',NULL,0),(8,'Chilaquiles verdes',20,'desayuno',NULL,0),(9,'Chilaquiles rojos',20,'desayuno',NULL,0),(10,'Cuerno de jamos y queso',19,'desayuno',NULL,0),(11,'Nescafe',10,'bebida',NULL,0),(12,'Hot cakes (dos)',13,'desayuno',NULL,0),(13,'Burritos norte?os',31,'desayuno',NULL,0),(14,'Enchiladas',31,'desayuno',NULL,0),(15,'Hot dog',19,'desayuno',NULL,0),(16,'Jugo de naranja',18,'bebida',NULL,0),(17,'Licuado sencillo',17,'bebida',NULL,0),(18,'Licuado dos ingredientes',19,'bebida',NULL,0),(19,'Sandwich de jamon',16,'desayuno',NULL,0),(20,'Sincronizada',15,'desayuno',NULL,0),(21,'Empanada de arroz',14,'postre',NULL,0),(22,'Sandwich de pollo ',22,'desayuno',NULL,0),(23,'Sandwich jamon y pavo',22,'desayuno',NULL,0),(24,'Torta de milanesa',31,'desayuno',NULL,0),(25,'Torta de jamon',26,'desayuno','',0),(26,'Torta de pollo',29,'desayuno',NULL,0),(27,'Torta de pierna',29,'desayuno',NULL,0),(28,'Torta de huevo',25,'desayuno',NULL,0),(29,'Torta de salchicha',29,'desayuno',NULL,0),(30,'Torta combinada',33,'desayuno',NULL,0),(31,'Telera',3,'desayuno',NULL,0),(32,'Chocolate caliente',14,'bebida',NULL,0),(33,'Sope',11,'desayuno',NULL,0),(34,'Hamburguesa sencilla',23,'desayuno',NULL,0),(35,'Hojaldra con mole y pollo',17,'desayuno',NULL,0),(36,'Hojaldra c/jamon y queso',16,'desayuno',NULL,0),(37,'Pambazo pollo o chorizo',17,'desayuno',NULL,1),(38,'Taco de bisteck',9,'desayuno',NULL,0),(39,'Taco de chorizo',9,'desayuno',NULL,0),(40,'Taco de arrachera',13,'desayuno',NULL,0),(41,'Molletes (dos)',20,'desayuno',NULL,0),(42,'Taco dorado (orden de tres)',19,'desayuno',NULL,0),(43,'Tulancingue?as',12,'desayuno',NULL,0),(44,'Vaso de arrroz con leche',13,'bebida',NULL,0),(45,'Refresco de lata',10,'bebida',NULL,0),(46,'Refresco de 600 ml',12,'bebida',NULL,0),(47,'Jugo del valle',10,'bebida',NULL,0),(48,'Pan de dulce',7,'postre',NULL,0),(49,'Cuernito con mermelada',11,'desayuno',NULL,0),(50,'Vaso de te',8,'bebida',NULL,0),(51,'Vaso de leche',10,'bebida',NULL,0),(52,'Ensalada del dia',20,'desayuno',NULL,1),(53,'Sandwich vegetariano',18,'desayuno',NULL,0),(54,'Cuerno pavo y panela',20,'desayuno',NULL,0),(55,'Cocktail de fruta',16,'desayuno',NULL,0),(56,'Taco loco',12,'desayuno',NULL,0),(57,'Taco de alambre',12,'desayuno',NULL,0),(58,'Sandwich Club',40,'desayuno',NULL,0),(59,'Pepeito de arrachera',36,'desayuno',NULL,0),(60,'Ensalada de mi abuela',23,'desayuno',NULL,0),(61,'Hamburguesa Mafer',35,'desayuno',NULL,0),(62,'Hamburguesa Gourmet',45,'desayuno',NULL,0),(63,'Hot cakes panzones',20,'desayuno',NULL,0),(64,'Omelet al gusto',30,'desayuno',NULL,0),(65,'Omelet de claras al gusto',30,'desayuno',NULL,0),(66,'Rajas jalape?os',0,'desayuno',NULL,0),(67,'Rajas chipotle',0,'desayuno',NULL,0),(99,'Emparedado',10,'postre',NULL,0),(119,'Rosca (rebanada)',25,'postre',NULL,0),(144,'Gelatina',20,'postre',NULL,0),(162,'Pay',35,'postre',NULL,0),(189,'Special salad',40,'desayuno',NULL,0),(190,'Huevo (uno)',6,'desayuno',NULL,0),(191,'Pastel helado',35,'postre',NULL,0),(192,'Panque',12,'postre',NULL,0),(193,'Panna Cotta',22,'postre',NULL,0),(199,'Empanada de manzana o pi?a',14,'postre',NULL,1),(200,'Ni?o envuelto',35,'postre',NULL,0),(201,'Agua de fruta',14,'bebida',NULL,0),(202,'Smottie',20,'bebida',NULL,0),(204,'Tortillas',8,'desayuno',NULL,0);
/*!40000 ALTER TABLE `desayunos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-13 13:01:11
