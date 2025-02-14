Enter password: 
/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.8.0-MariaDB, for Android (armv7-a)
--
-- Host: localhost    Database: db_xamon
-- ------------------------------------------------------
-- Server version	11.8.0-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `data_todo`
--

DROP TABLE IF EXISTS `data_todo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_todo` (
  `id_todo` int(11) NOT NULL AUTO_INCREMENT,
  `judul_todo` varchar(255) NOT NULL,
  `deskripsi_todo` text DEFAULT NULL,
  `created_at` datetime DEFAULT curdate(),
  `updated_at` datetime DEFAULT curtime(),
  `status` enum('pending','completed') NOT NULL DEFAULT 'pending',
  `pinned` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_todo`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_todo`
--

LOCK TABLES `data_todo` WRITE;
/*!40000 ALTER TABLE `data_todo` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `data_todo` VALUES
(31,'hdydud','ydyyuff','2025-02-12 00:00:00','2025-02-12 21:16:48','completed',0),
(32,'hdjdjd','hdujd','2025-02-12 00:00:00','2025-02-12 21:26:45','pending',0),
(33,'bdhdhd','hdudud','2025-02-12 00:00:00','2025-02-12 21:26:50','pending',1),
(34,'hdhdhud','ydyudud','2025-02-12 00:00:00','2025-02-12 21:26:58','pending',0),
(35,'naon anijng','ppppp','2025-02-12 00:00:00','2025-02-12 21:55:24','pending',0);
/*!40000 ALTER TABLE `data_todo` ENABLE KEYS */;
UNLOCK TABLES;
commit;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2025-02-12 22:18:02
