USE `elbuengo_master`;
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
INSERT INTO `cat_cp` VALUES ('42000',0,'Centro Historico'),('42004',0,'La granada'),('42008',0,'Secretaria de Hacienda y Credito Publico'),('42009',0,'Palacio de Gobierno del Estado de Hidalgo'),('42010',0,'Arbolito'),('42014',0,'Nueva Estrella 1a Secc'),('42015',0,'Asta Bandera'),('42018',0,'San Nicolas'),('42020',0,'Jose Lopez Portillo'),('42026',0,'Lomas de Vista Hermosa'),('42027',0,'Antonio del Castillo'),('42029',0,'Union Popular'),('42030',0,'Javier Rojo Gomez 1a'),('42032',0,'Parque de Poblamiento'),('42033',0,'Los Cedros'),('42034',0,'Javier Rojo Gomez 2a Secc'),('42035',0,'Plutarco Elias Calles 1a Secc'),('42036',0,'Nuevo Hidalgo'),('42037',0,'Cereso Pachuca'),('42039',0,'15 de Septiembre'),('42040',0,'Morelos 2a Secc'),('42050',0,'La Surtidora'),('42055',0,'Anahuac'),('42056',0,'Cruz de los Ciegos'),('42057',0,'San Clemente'),('42058',0,'El lobo'),('42059',0,'Secretaria de Salud'),('42060',0,'Maestranza'),('42064',0,'Cuesco'),('42070',0,'Francico I Madero'),('42075',0,'Canutillo'),('42078',0,'Ciudad de los Ni??os'),('42079',0,'Guadalupe 1a Secc'),('42080',0,'Constitucion'),('42081',0,'Centro SCT Hidalgo'),('42082',35,'Haciendas la Herradura'),('42083',0,'Campo de Golf'),('42084',0,'Arboledas San Javier 1a Seccion'),('42086',0,'La Puerta de Hierro'),('42088',0,'El palmar'),('42090',0,'Cubitos'),('42092',0,'18 de Marzo'),('42094',0,'Bosques del Penar'),('42095',0,'La Raza'),('42096',0,'Unidad Minera 11 de Julio'),('42097',0,'Cerro de Animas'),('42098',0,'Las Terrazas'),('42099',0,'Ciudad de Pachuca'),('42100',0,'Aquiles Cerdan'),('42101',0,'Camelia'),('42103',0,'Santa Julia'),('42110',0,'Santiago Tlapacoya'),('42111',0,'Santa Gertrudis'),('42115',0,'El Huixmi'),('42119',0,'Caminera');
/*!40000 ALTER TABLE `cat_cp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `id_cliente` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `telefono1` varchar(50) NOT NULL,
  `telefono2` varchar(50) DEFAULT NULL,
  `calle` varchar(50) NOT NULL,
  `no` varchar(50) NOT NULL,
  `colonia` varchar(50) NOT NULL,
  `cp` varchar(50) NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_menu`
--

LOCK TABLES `detalle_menu` WRITE;
/*!40000 ALTER TABLE `detalle_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_ordenes`
--

DROP TABLE IF EXISTS `detalle_ordenes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_ordenes` (
  `id_detalleordenes` int(11) NOT NULL AUTO_INCREMENT,
  `id_ordenes` int(11) NOT NULL,
  `id_plat` varchar(10) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id_detalleordenes`),
  KEY `id_ordenes_idx` (`id_ordenes`),
  KEY `id_plat_idx` (`id_plat`),
  CONSTRAINT `id_ordenes` FOREIGN KEY (`id_ordenes`) REFERENCES `ordenes` (`id_ordenes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_platt` FOREIGN KEY (`id_plat`) REFERENCES `platillo` (`id_plat`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_ordenes`
--

LOCK TABLES `detalle_ordenes` WRITE;
/*!40000 ALTER TABLE `detalle_ordenes` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_ordenes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `telefono1` varchar(50) DEFAULT NULL,
  `telefono2` varchar(50) DEFAULT NULL,
  `direccion` varchar(225) NOT NULL,
  `sucursal` varchar(50) NOT NULL,
  `puesto` varchar(50) DEFAULT NULL,
  `dias_laborales` varchar(225) NOT NULL,
  `horaE` varchar(10) DEFAULT NULL,
  `horaS` varchar(10) DEFAULT NULL,
  `horaC` varchar(10) DEFAULT NULL,
  `fechainicio` varchar(10) DEFAULT NULL,
  `activo` int(11) NOT NULL,
  PRIMARY KEY (`id_empleado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(225) DEFAULT NULL,
  `fecha` varchar(10) NOT NULL,
  `sucursal` varchar(50) NOT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordenes`
--

LOCK TABLES `ordenes` WRITE;
/*!40000 ALTER TABLE `ordenes` DISABLE KEYS */;
/*!40000 ALTER TABLE `ordenes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `platillo`
--

DROP TABLE IF EXISTS `platillo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `platillo` (
  `id_plat` varchar(10) NOT NULL,
  `nombre_plat` varchar(50) NOT NULL,
  `precio` double NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `descripcion_plat` varchar(50) DEFAULT NULL,
  `especial` int(11) NOT NULL,
  PRIMARY KEY (`id_plat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `platillo`
--

LOCK TABLES `platillo` WRITE;
/*!40000 ALTER TABLE `platillo` DISABLE KEYS */;
INSERT INTO `platillo` VALUES ('1','Pastel de carne',12,'Antojito',NULL,0),('10','Sopa del dia',25,'Sopa',NULL,1),('101','Crema de pinon',30,'Sopa',NULL,0),('102','Caldo tlalpeño',27,'Sopa',NULL,1),('103','Caldo de camaron',27,'Sopa',NULL,0),('104','Sopa azteca',27,'Sopa',NULL,0),('105','Bacalao 1/2 Lt.',150,'Guisado',NULL,0),('106','Pepinos con aderezo',26,'Ensalada',NULL,0),('11','Pluma',29,'Sopa',NULL,0),('110','Vegetales con pollo',39,'Guisado',NULL,0),('111','Ensalada de acelgas',30,'Ensalada',NULL,0),('112','Lomo a la ciruela',46,'Guisado',NULL,0),('113','Lomo al tamarindo ',46,'Guisado',NULL,0),('114','Arroz con leche',25,'Postre',NULL,0),('115','Chayotes rellenos',39,'Guisado',NULL,0),('116','Lasagna',240,'Sopa',NULL,0),('117','Budin',30,'Ensalada','Papa, Chayote,Coliflor, Brocoli, Calabaza',1),('12','Chicharron',37,'Guisado',NULL,0),('121','Ravioles',35,'Sopa',NULL,0),('122','Canelones',35,'Sopa',NULL,0),('123','Paste bocadillo',8,'Antojito',NULL,0),('124','Ensalada de nochebuena',35,'Ensalada',NULL,0),('125','Rollito pechuga',43,'Guisado',NULL,0),('126','Sopa de medula',30,'Sopa',NULL,0),('127','Pierna enchilada',46,'Guisado',NULL,0),('128','Ensalada griega',37,'Ensalada',NULL,0),('129','Nopales',30,'Ensalada',NULL,0),('13','Tortas de camaron',43,'Guisado',NULL,0),('130','Rusa',32,'Ensalada',NULL,0),('131','Papas con apio',30,'Ensalada',NULL,0),('132','Ensalada de zanahoria',30,'Ensalada',NULL,0),('133','Ponche 1 Lt.',45,'Bebida',NULL,0),('134','Ensalada de jimaca',30,'Ensalada',NULL,0),('135','Empana de atun ',18,'Antojito',NULL,0),('136','Ensalada de calabaza',30,'Ensalada',NULL,0),('137','Ensalada de verduras al vapor',30,'Ensalada','Verduras Slateadas o al vapor',1),('138','Ensalada de chayotes',30,'Ensalada',NULL,0),('139','Ensalada de lechugas mixtas',28,'Ensalada',NULL,0),('14','Emapanada cazon',16,'Antojito',NULL,0),('140','Filete empapelado',43,'Guisado','Empapelado, Talla',1),('141','Mixiote de pollo',45,'Guisado',NULL,0),('142','Arroz rojo',12,'Sopa',NULL,0),('143','Spaghetti rojo',29,'Sopa','Italiana Bolognesa',1),('144','Refreco de 600 ml.',10,'Bebida',NULL,0),('145','Refresco de lata',7,'Bebida',NULL,0),('146','Ensalada de betabel',32,'Ensalada',NULL,0),('147','Refreco de vidrio',6,'Bebida',NULL,0),('148','Ensalada de rajas',28,'Ensalada',NULL,0),('149','Arrachera',46,'Guisado',NULL,0),('15','Fajitas',42,'Guisado',NULL,0),('150','Ensalada de surimi',32,'Ensalada',NULL,0),('151','Vegetales mixtos',31,'Ensalada',NULL,0),('152','Ensalada de ejotes',28,'Ensalada','Huevo, Fantasia, almendras',1),('153','Ensalada de col con manzana',31,'Ensalada',NULL,0),('154','Ensalada fantasia',30,'Ensalada',NULL,0),('155','Volovan',15,'Antojito',NULL,0),('156','Fetuccini',29,'Sopa',NULL,0),('157','Ensalada Waldorf',35,'Ensalada',NULL,0),('158','Pasta de salmon',60,'Guisado',NULL,0),('16','Paella',110,'Guisado',NULL,0),('161','Vaso de salsa',13,'Antojito','Verde o roja',1),('162','Pay rebanada',35,'Postre','Limon, Queso, Manzana',1),('164','Paste de pollo',12,'Antojito',NULL,0),('165','Frijoles refritos',18,'Guisado',NULL,0),('166','Paste de frijoles',12,'Antojito',NULL,0),('167','Brochetas',43,'Guisado',NULL,0),('168','Tartaleta',25,'Postre',NULL,0),('169','Milanesa de pollo',42,'Guisado',NULL,0),('170','Dulce de calabeza',45,'Postre',NULL,0),('171','Dulce de camote',45,'Postre',NULL,0),('172','Pieza de pan ',10,'Postre',NULL,0),('173','Parrillada',43,'Guisado',NULL,0),('177','Papas a la fracesa',30,'Ensalada',NULL,0),('178','Empana de bacalao',18,'Antojito',NULL,0),('179','Yakimeshi',39,'Sopa',NULL,0),('18','Manitas vinagreta',37,'Guisado',NULL,0),('180','Papas con crorizo',30,'Ensalada',NULL,0),('183','Atun con papas',32,'Ensalada',NULL,0),('184','Poblano de elote',39,'Guisado','Poblano horneado, Relleno de esquites',1),('185','Pierna adobada',45,'Guisado',NULL,0),('186','Cheese cake',40,'Postre',NULL,0),('188','Papas gourmet',32,'Ensalada',NULL,0),('189','Tostadas de pata',13,'Antojito',NULL,0),('19','Codos',29,'Sopa',NULL,0),('191','Pastel helado',35,'Postre',NULL,0),('192','Panque de elote',12,'Postre',NULL,0),('193','Panna cotta',22,'Postre',NULL,0),('194','Tostada de chorizo',11,'Antojito',NULL,0),('195','Quesadilla de cuitlacoche',11,'Antojito',NULL,0),('196','Quesadilla de picadillo',11,'Antojito',NULL,0),('197','Gelatina de queso',22,'Postre',NULL,0),('198','Gelatina de rompope',22,'Postre',NULL,0),('199','Empanada de piña',14,'Postre',NULL,0),('2','Pastel (rebanada) ',40,'Postre',NULL,0),('20','Spaghetti blanco',29,'Sopa',NULL,0),('200','Empanada de manzana',14,'Postre',NULL,0),('21','Empanada de arroz',14,'Postre',NULL,0),('22','Tortas de ejote',37,'Guisado',NULL,0),('23','Pechuga asada',42,'Guisado',NULL,0),('24','Mole de olla',39,'Guisado',NULL,0),('25','Pipian',39,'Guisado',NULL,0),('26','Estofado',39,'Guisado',NULL,0),('27','Almendrado',39,'Guisado',NULL,0),('28','Mole verde',39,'Guisado',NULL,0),('288','Choux',10,'Postre',NULL,0),('29','Aguayon',39,'Guisado',NULL,0),('3','Agua 500 ml.',8,'Bebida','500 ml.',0),('30','Crema',27,'Sopa',NULL,1),('300','Dulce de calabaza 1/2 Lt.',45,'Postre',NULL,0),('301','Vaso de dulce de calabaza',15,'Postre',NULL,0),('302','Pan de muerto',30,'Postre',NULL,0),('303','Dulce de camote 1/2 Lt.',45,'Postre',NULL,0),('306','Vaso de dulce de camote',15,'Postre',NULL,0),('307','Tamal de jitomate',10,'Antojito',NULL,0),('309','Tamal de mole poblano',10,'Antojito',NULL,0),('31','Cuete',42,'Guisado',NULL,0),('310','Tamal de piloncillo',10,'Antojito',NULL,0),('311','Atole de cajeta 1 Lt.',60,'Bebida',NULL,0),('312','Atole de guayaba',60,'Bebida',NULL,0),('313','Atole de limon 1 Lt.',60,'Bebida','',0),('315','Atole de fresa 1 Lt.',60,'Bebida',NULL,0),('316','Atole de 1 Lt.',60,'Bebida',NULL,0),('317','Atole de masa 1 Lt.',60,'Bebida',NULL,0),('318','Champurrado 1Lt.',60,'Bebida','',0),('319','Tamal de hoja de platano',8,'Antojito',NULL,0),('32','Res',39,'Guisado',NULL,1),('325','Tiramisu',35,'Postre',NULL,0),('33','Puchero',39,'Guisado','',1),('34','Adobo',39,'Guisado',NULL,0),('35','Espirales',29,'Sopa',NULL,0),('36','Pure de manzana',30,'Ensalada',NULL,0),('37','Lengua',42,'Guisado',NULL,0),('38','Bisteces molidos',39,'Guisado',NULL,0),('39','Pure de papa',30,'Ensalada',NULL,0),('4','Gelatina de durazno',22,'Postre',NULL,0),('40','Asado',39,'Guisado',NULL,0),('41','Jalapeños',39,'Guisado',NULL,0),('42','Fusilli',29,'Sopa',NULL,1),('43','Puntas',42,'Guisado',NULL,1),('44','Ensalada chicharos',29,'Ensalada',NULL,0),('45','Tiras',42,'Guisado',NULL,1),('46','Salpicon',39,'Guisado',NULL,1),('47','Tortas de pollo',39,'Guisado',NULL,1),('48','Tortas de carne',39,'Guisado',NULL,1),('49','Tinga',39,'Guisado',NULL,1),('5','Pollo',39,'Guisado',NULL,1),('50','Pastel carne',43,'Guisado',NULL,0),('51','Picadillo',39,'Guisado',NULL,1),('52','Albondigas',39,'Guisado',NULL,1),('53','Hamburguesas',39,'Guisado',NULL,1),('54','Bisteck',39,'Guisado',NULL,1),('55','Rollito de pescado',42,'Guisado',NULL,1),('56','Costilla',46,'Guisado',NULL,1),('57','Cerdo',39,'Guisado',NULL,1),('58','Espinazo',39,'Guisado',NULL,1),('59','Pozole',39,'Guisado',NULL,1),('6','Arroz blanco',12,'Sopa',NULL,0),('60','Fabada',39,'Guisado',NULL,0),('62','Cochinita pibil',39,'Guisado','',0),('63','Ensalada del chef',37,'Ensalada',NULL,0),('64','Menudo',39,'Guisado',NULL,0),('65','Lomo enchilado',46,'Guisado',NULL,0),('66','Ensalada fresca',28,'Ensalada',NULL,0),('67','Milanesa de res',42,'Guisado',NULL,0),('68','Chuleta',39,'Guisado',NULL,1),('69','Filete de pescado',42,'Guisado',NULL,0),('7','Mole poblano',39,'Guisado',NULL,0),('70','Croquetas',36,'Guisado',NULL,1),('71','Tortas de papa',36,'Guisado','',1),('72','Huauzontle',37,'Guisado',NULL,0),('73','Poblano de queso',39,'Guisado',NULL,0),('74','Calabacitas rellenas',37,'Guisado',NULL,1),('76','Higado',39,'Guisado',NULL,0),('77','Aguacate relleno',39,'Guisado',NULL,0),('78','Ploblano picadillo',39,'Guisado',NULL,0),('79','Chipotles rellenos',39,'Guisado',NULL,0),('8','Mixiote carnero',45,'Guisado',NULL,0),('80','Chile en nogada',70,'Guisado',NULL,0),('81','Ensalada de manzana',33,'Ensalada',NULL,1),('83','Sope de pollo',11,'Antojito',NULL,0),('84','Cocktail de frutas',30,'Ensalada',NULL,1),('85','Sope  tierritas',11,'Antojito',NULL,0),('86','Quesadilla de flor',11,'Antojito',NULL,0),('87','Hamburguesita',14,'Antojito',NULL,0),('88','Sope chrorizo',11,'Antojito',NULL,1),('89','Tulancinguena',11,'Antojito',NULL,0),('9','Frijoles',13,'Guisado',NULL,0),('90','Tortitta de jamon',14,'Antojito',NULL,0),('91','Chalupa',5,'Antojito',NULL,0),('92','Memela',11,'Antojito',NULL,0),('93','Pambazo',14,'Antojito','Pollo o chorizo',1),('94','Hojaldra',14,'Antojito',NULL,0),('95','Taco dorado',8,'Antojito','Frijol, Papa, Pollo, Res',1),('97','Flan napolitano',35,'Postre',NULL,0),('98','Tostada de pollo',11,'Antojito',NULL,0),('99','Emparedado',10,'Postre',NULL,0);
/*!40000 ALTER TABLE `platillo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sucursales`
--

DROP TABLE IF EXISTS `sucursales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sucursales` (
  `id_sucursal` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(225) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_sucursal`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sucursales`
--

LOCK TABLES `sucursales` WRITE;
/*!40000 ALTER TABLE `sucursales` DISABLE KEYS */;
INSERT INTO `sucursales` VALUES (1,'Todas',NULL,NULL);
/*!40000 ALTER TABLE `sucursales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id_user` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `tipo` int(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES ('agg@elbuengourmet.mx','Alfonso','Godinez',1,'Moraleja'),('marisol@elbuengourmet.mx','Marisol','Hernandez Enriquez',2,'16682'),('mb_agusta@hotmail.com','Sergio','Ramirez',1,'12345'),('mimi_reichel@hotmail.com','Raquel','Marquez',1,'12345'),('root','root','root',1,'123'),('rubeniel@hotmail.com','Ruben','Ramirez',1,'12345'),('snake2209@hotmail.com','Enrique','Gamboa',1,'pumas2209'),('susy@elbuengourmet.mx','Susana','Rubio',1,'Moraleja'),('user','user','user',2,'123');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-09-16 19:48:18
