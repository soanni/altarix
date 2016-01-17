-- MySQL dump 10.13  Distrib 5.7.9, for linux-glibc2.5 (x86_64)
--
-- Host: localhost    Database: altarix
-- ------------------------------------------------------
-- Server version	5.6.27-0ubuntu1

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
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startdate` datetime NOT NULL,
  `enddate` datetime NOT NULL,
  `request_time` decimal(10,5) NOT NULL,
  `result` int(1) unsigned NOT NULL,
  `body` text,
  `header` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests`
--

LOCK TABLES `requests` WRITE;
/*!40000 ALTER TABLE `requests` DISABLE KEYS */;
INSERT INTO `requests` VALUES (7,'2016-01-17 21:27:56','2016-01-17 21:27:56',0.13014,1,NULL,NULL),(8,'2016-01-17 21:27:58','2016-01-17 21:27:59',0.11359,1,NULL,NULL),(9,'2016-01-17 21:28:01','2016-01-17 21:28:01',0.11951,1,NULL,NULL),(10,'2016-01-17 21:28:08','2016-01-17 21:28:09',0.10841,0,'<s:Envelope xmlns:s=\"http://schemas.xmlsoap.org/soap/envelope/\"><s:Body xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\"><GetTaxiInfosResponse xmlns=\"http://dtis.mos.ru/taxi\"><GetTaxiInfosResult/></GetTaxiInfosResponse></s:Body></s:Envelope>','HTTP/1.1 200 OK\r\nContent-Type: text/xml; charset=utf-8\r\nServer: Microsoft-IIS/7.5\r\nX-Powered-By: ASP.NET\r\nDate: Sun, 17 Jan 2016 16:29:19 GMT\r\nContent-Length: 291\r\n'),(11,'2016-01-18 01:20:01','2016-01-18 01:20:01',0.08341,0,'<s:Envelope xmlns:s=\"http://schemas.xmlsoap.org/soap/envelope/\"><s:Body xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\"><GetTaxiInfosResponse xmlns=\"http://dtis.mos.ru/taxi\"><GetTaxiInfosResult/></GetTaxiInfosResponse></s:Body></s:Envelope>','HTTP/1.1 200 OK\r\nContent-Type: text/xml; charset=utf-8\r\nServer: Microsoft-IIS/7.5\r\nX-Powered-By: ASP.NET\r\nDate: Sun, 17 Jan 2016 20:21:11 GMT\r\nContent-Length: 291\r\n'),(12,'2016-01-18 01:25:06','2016-01-18 01:25:06',0.08422,1,NULL,NULL),(13,'2016-01-18 01:54:09','2016-01-18 01:54:10',0.08649,1,NULL,NULL),(14,'2016-01-18 01:54:19','2016-01-18 01:54:19',0.07929,1,NULL,NULL),(15,'2016-01-18 01:54:25','2016-01-18 01:54:25',0.07961,1,NULL,NULL),(16,'2016-01-18 02:48:43','2016-01-18 02:48:43',0.08514,1,NULL,NULL);
/*!40000 ALTER TABLE `requests` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-01-18  3:04:04
