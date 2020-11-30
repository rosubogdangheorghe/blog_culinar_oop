-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: blogculinar
-- ------------------------------------------------------
-- Server version	8.0.18

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
-- Table structure for table `postari`
--

DROP TABLE IF EXISTS `postari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `postari` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `poza` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `published` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `postari_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `utilizatori` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postari`
--

LOCK TABLES `postari` WRITE;
/*!40000 ALTER TABLE `postari` DISABLE KEYS */;
INSERT INTO `postari` VALUES (1,1,'LASAGNA','lasagna',0,'lasagna.jpg','&lt;p&gt;Cand nu mai stii ce sa gatesti (fie ca ai copii mofturosi fie ca nu sunt moftuosi) n-ai cum, dar chiar n-ai cum s-o dai in bara cu orice fel de paste: penne, spaghete, lasagna, tortellini, cannelloni&amp;hellip;Orisice fel de paste. Hai sa va zic acum cum fac eu lasagna, iar in alte postari voi povesti pe rand si despre celelelte retete cu paste. Din capul locului va spun ca eu prefer de departe pastele Barilla. Am incercat de-a lungul timpului si alte &amp;ldquo;modele&amp;rdquo; iar acum spun doar atat:&lt;/p&gt;\r\n',1,'2020-09-15 15:42:46','2020-09-15 15:42:46'),(13,1,'Shrimps','shrimps',0,'shrimps.jpg','&lt;p&gt;Shrimps&lt;/p&gt;\r\n',1,'2020-09-19 12:34:08','2020-09-19 12:34:08'),(14,3,'Supa crema de dovleac','supa-crema-de-dovleac',0,'supa_crema_de_ dovleac.jpg','&lt;p&gt;Supa crema de dovleac&lt;/p&gt;\r\n',1,'2020-09-15 15:39:45','2020-09-15 15:39:45'),(18,1,'Creme de la creme','creme-de-la-creme',0,'creme_de_la_creme.jpg','&lt;p&gt;Creme de la Creme&lt;/p&gt;\r\n',1,'2020-09-20 18:15:00','2020-09-20 18:15:00');
/*!40000 ALTER TABLE `postari` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-09-20 21:19:27
