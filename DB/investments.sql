-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: investments
-- ------------------------------------------------------
-- Server version	8.0.27

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
-- Table structure for table `fd`
--

DROP TABLE IF EXISTS `fd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fd` (
  `fd_id` int NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(70) NOT NULL,
  `user_id` int NOT NULL,
  `fd_prin` decimal(10,2) DEFAULT NULL,
  `fd_rate` decimal(10,2) DEFAULT NULL,
  `fd_dur` int DEFAULT NULL,
  `compounding` int DEFAULT '1',
  `fd_return` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`fd_id`),
  KEY `userId_idx` (`user_id`),
  CONSTRAINT `userIdfd` FOREIGN KEY (`user_id`) REFERENCES `user_login` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE TRIGGER `fd_BEFORE_INSERT` BEFORE INSERT ON `fd` FOR EACH ROW BEGIN
DECLARE a DECIMAL(10,2);
DECLARE b DECIMAL(10,2);
DECLARE c DECIMAL(10,2);
DECLARE d DECIMAL(10,2);
DECLARE e DECIMAL(10,2);
DECLARE f DECIMAL(10,2);
DECLARE i int;
SET i=0;
SET d=1;
SET c = NEW.compounding * NEW.fd_dur;
SET f = NEW.fd_rate / 100;
SET a = f / NEW.compounding;
SET b = 1 + a;
WHILE i<c DO
	BEGIN
		Set d = d * b;
		Set i  = i + 1;
	END;
    END WHILE;
SET NEW.fd_return = NEW.fd_prin * d;
END;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE TRIGGER `fd_BEFORE_UPDATE` BEFORE UPDATE ON `fd` FOR EACH ROW BEGIN
DECLARE a DECIMAL(10,2);
DECLARE b DECIMAL(10,2);
DECLARE c DECIMAL(10,2);
DECLARE d DECIMAL(10,2);
DECLARE e DECIMAL(10,2);
DECLARE f DECIMAL(10,2);
DECLARE i int;
SET i=0;
SET d=1;
SET c = NEW.compounding * NEW.fd_dur;
SET f = NEW.fd_rate / 100;
SET a = f / NEW.compounding;
SET b = 1 + a;
WHILE i<c DO
	BEGIN
		Set d = d * b;
		Set i  = i + 1;
	END;
    END WHILE;
SET NEW.fd_return = NEW.fd_prin * d;
END;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `ppf`
--

DROP TABLE IF EXISTS `ppf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ppf` (
  `ppf_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `bank_name` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ppf_prin` decimal(10,2) DEFAULT NULL,
  `ppf_rate` decimal(10,2) DEFAULT NULL,
  `ppf_year` decimal(10,2) DEFAULT '15.00',
  `ppf_return` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`ppf_id`),
  KEY `userIdppf_idx` (`user_id`),
  CONSTRAINT `userIdppf` FOREIGN KEY (`user_id`) REFERENCES `user_login` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE TRIGGER `ppf_BEFORE_INSERT` BEFORE INSERT ON `ppf` FOR EACH ROW BEGIN
DECLARE si DECIMAL(10,2);
DECLARE i DECIMAL(10,2);
DECLARE t DECIMAL(10,2);
DECLARE a DECIMAL(10,2);
DECLARE p int;
DECLARE r DECIMAL(10,2);
SET p=NEW.ppf_prin;
SET r=NEW.ppf_rate;
SET i=0;
SET si=0;
SET a=0;
SET t=NEW.ppf_year-1;
WHILE i<t DO
    BEGIN
        SET si=p*r;
        SET si=si/100;
        SET a=p+si;
        SET a=a+5000;
        SET i=i+1;
        SET p=a;
    END;
    END WHILE;
SET si=p*r;
SET si=si/100;
SET a=p+si;
SET NEW.ppf_return=a;
END;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE TRIGGER `ppf_BEFORE_UPDATE` BEFORE UPDATE ON `ppf` FOR EACH ROW BEGIN
DECLARE si DECIMAL(10,2);
DECLARE i DECIMAL(10,2);
DECLARE t DECIMAL(10,2);
DECLARE a DECIMAL(10,2);
DECLARE p int;
DECLARE r DECIMAL(10,2);
SET p=NEW.ppf_prin;
SET r=NEW.ppf_rate;
SET i=0;
SET si=0;
SET a=0;
SET t=NEW.ppf_year-1;
WHILE i<t DO
    BEGIN
        SET si=p*r;
        SET si=si/100;
        SET a=p+si;
        SET a=a+5000;
        SET i=i+1;
        SET p=a;
    END;
    END WHILE;
SET si=p*r;
SET si=si/100;
SET a=p+si;
SET NEW.ppf_return=a;
END;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `rd`
--

DROP TABLE IF EXISTS `rd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rd` (
  `rd_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `bank_name` varchar(45) DEFAULT NULL,
  `rd_prin` decimal(10,2) DEFAULT NULL,
  `rd_tenure` decimal(10,2) DEFAULT NULL,
  `rd_rate` decimal(10,2) DEFAULT NULL,
  `rd_return` int DEFAULT NULL,
  PRIMARY KEY (`rd_id`),
  KEY `userIdrd_idx` (`user_id`),
  CONSTRAINT `userIdrd` FOREIGN KEY (`user_id`) REFERENCES `user_login` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE TRIGGER `rd_BEFORE_INSERT` BEFORE INSERT ON `rd` FOR EACH ROW BEGIN
DECLARE i DECIMAL(10,4);
DECLARE n INT;
DECLARE a DECIMAL(10,4);
DECLARE b DECIMAL(10,4);
DECLARE c DECIMAL(10,4);
DECLARE d DECIMAL(10,4);
SET n = NEW.rd_tenure*4;
SET i=NEW.rd_rate/400;
SET i=1+i;
SET a = POW(i,n);
SET d=i;
CALL neg_expo(d);
SET c=1-d;
SET b=a-1;
SET b=b*NEW.rd_prin;
SET NEW.rd_return = b/c;
END;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE TRIGGER `rd_BEFORE_UPDATE` BEFORE UPDATE ON `rd` FOR EACH ROW BEGIN
DECLARE i DECIMAL(10,4);
DECLARE n INT;
DECLARE a DECIMAL(10,4);
DECLARE b DECIMAL(10,4);
DECLARE c DECIMAL(10,4);
DECLARE d DECIMAL(10,4);
SET n = NEW.rd_tenure*4;
SET i=NEW.rd_rate/400;
SET i=1+i;
SET a = POW(i,n);
SET d=i;
CALL neg_expo(d);
SET c=1-d;
SET b=a-1;
SET b=b*NEW.rd_prin;
SET NEW.rd_return = b/c;
END;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `stocks`
--

DROP TABLE IF EXISTS `stocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stocks` (
  `stock_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `stock_name` varchar(45) NOT NULL,
  `open_price` decimal(10,2) DEFAULT NULL,
  `close_price` decimal(10,2) DEFAULT NULL,
  `dividend` decimal(10,2) DEFAULT NULL,
  `stock_return` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`stock_id`),
  KEY `userId_idx` (`user_id`),
  CONSTRAINT `userIdstk` FOREIGN KEY (`user_id`) REFERENCES `user_login` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE TRIGGER `stocks_BEFORE_INSERT` BEFORE INSERT ON `stocks` FOR EACH ROW BEGIN
SET NEW.stock_return = NEW.close_price - NEW.open_price + NEW.dividend;
END;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE TRIGGER `stocks_BEFORE_UPDATE` BEFORE UPDATE ON `stocks` FOR EACH ROW BEGIN
SET NEW.stock_return = NEW.close_price - NEW.open_price + NEW.dividend;
END;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `user_login`
--

DROP TABLE IF EXISTS `user_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_login` (
  `user_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `last_login_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'investments'
--
DROP PROCEDURE IF EXISTS `neg_expo`;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `neg_expo`(INOUT var DECIMAL(10,4))
BEGIN
SET var = POW(var,-1/3);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-01-15 23:50:05
