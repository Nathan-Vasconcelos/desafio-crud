-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: cadastro
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
-- Table structure for table `enderecos`
--

DROP TABLE IF EXISTS `enderecos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enderecos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_id` int(11) DEFAULT NULL,
  `cep` varchar(20) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cep` (`cep`),
  KEY `estado_id` (`estado_id`),
  CONSTRAINT `enderecos_ibfk_1` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enderecos`
--

LOCK TABLES `enderecos` WRITE;
/*!40000 ALTER TABLE `enderecos` DISABLE KEYS */;
INSERT INTO `enderecos` VALUES (1,1,'28920311','Rua Salvador Palmeiras Cabo Frio','04'),(2,2,'28924-215','avenida Augusta apartatamento 02','101'),(5,1,'28911232','Rua Carvalho Cabo Frio','25'),(6,25,'08090-284','Rua 03 de Outubro Jardim Helena','34'),(10,25,'04849-529','Rua 13 de Maio Cantinho do Céu','07'),(11,25,'04843-425','Viela 16 Parque São José','25'),(12,25,'05706-305','Rua 17 de Janeiro','Paraíso do'),(16,1,'23595-180','Rua 1 Santa Cruz','47'),(17,1,'28925211','Rua Bahia','55');
/*!40000 ALTER TABLE `enderecos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estados`
--

DROP TABLE IF EXISTS `estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uf` varchar(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uf` (`uf`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estados`
--

LOCK TABLES `estados` WRITE;
/*!40000 ALTER TABLE `estados` DISABLE KEYS */;
INSERT INTO `estados` VALUES (2,'AC'),(3,'AL'),(5,'AM'),(4,'AP'),(6,'BA'),(7,'CE'),(8,'DF'),(9,'ES'),(10,'GO'),(11,'MA'),(14,'MG'),(13,'MS'),(12,'MT'),(15,'PA'),(16,'PB'),(18,'PE'),(19,'PI'),(17,'PR'),(1,'RJ'),(20,'RN'),(22,'RO'),(23,'RR'),(21,'RS'),(24,'SC'),(26,'SE'),(25,'SP'),(27,'TO');
/*!40000 ALTER TABLE `estados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pessoas`
--

DROP TABLE IF EXISTS `pessoas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pessoas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `endereco_id` int(11) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `rg` varchar(50) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  `data_atualizacao` datetime DEFAULT NULL,
  `data_exclusao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf` (`cpf`),
  KEY `endereco_id` (`endereco_id`),
  CONSTRAINT `pessoas_ibfk_1` FOREIGN KEY (`endereco_id`) REFERENCES `enderecos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoas`
--

LOCK TABLES `pessoas` WRITE;
/*!40000 ALTER TABLE `pessoas` DISABLE KEYS */;
INSERT INTO `pessoas` VALUES (7,2,'Larissa Castro','22233344455','22.333.333-1','2004-05-18','2022-05-31 23:45:19','2022-06-02 01:57:09',NULL),(8,5,'Luciano Meira','12312312333','11.110.000-1','2013-03-06','2022-06-01 19:32:40','2022-06-02 01:57:38','2022-06-03 02:16:05'),(13,10,'Leticia Almeida','11101011111','11.000.111-0','2015-05-10','2022-06-02 00:49:51','2022-06-02 01:58:39','2022-06-03 02:16:15'),(14,11,'Paulo Almeida Souza','12311178910','00.111.201-9','2013-09-17','2022-06-02 01:00:59','2022-06-03 02:10:48',NULL),(15,12,'Barbara Nascimento','22233344425','11.11.125-1','2008-06-03','2022-06-02 01:04:11','2022-06-02 01:59:10',NULL),(19,16,'Douglas de Almeida','19345658910','12.222.951-2','2011-12-14','2022-06-02 02:03:11','2022-06-02 02:03:11',NULL),(20,16,'Antônio Rocha ','44422244422','22.424.424-4','1994-03-02','2022-06-02 19:12:03','2022-06-02 19:12:03',NULL),(21,16,'Angélica','12345678979','23.383.433-2','2014-02-18','2022-06-02 19:16:37','2022-06-02 19:16:37',NULL),(22,17,'Ana Clara Coelho','77772772777','77.777.258-8','2011-01-04','2022-06-03 02:11:10','2022-06-03 02:11:10',NULL);
/*!40000 ALTER TABLE `pessoas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telefones`
--

DROP TABLE IF EXISTS `telefones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `telefones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(11) DEFAULT NULL,
  `telefone` varchar(14) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `telefone` (`telefone`),
  KEY `pessoa_id` (`pessoa_id`),
  CONSTRAINT `telefones_ibfk_1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telefones`
--

LOCK TABLES `telefones` WRITE;
/*!40000 ALTER TABLE `telefones` DISABLE KEYS */;
INSERT INTO `telefones` VALUES (4,14,'11925252525'),(9,19,'(21)94192-6363'),(10,20,'(47)98888-8888');
/*!40000 ALTER TABLE `telefones` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-03  2:20:37
