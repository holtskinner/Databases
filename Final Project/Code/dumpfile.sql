-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: group_database
-- ------------------------------------------------------
-- Server version	5.5.47-0ubuntu0.14.04.1

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
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `username` varchar(16) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `name_first` varchar(30) NOT NULL,
  `name_last` varchar(45) NOT NULL,
  `permission_id` varchar(250) DEFAULT NULL,
  `hashed_password` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (24601,'admin','','Jean','Valjean','admin','$2y$10$stWMdvUpcH9AjHz2w26QAeDK2smSwNnPPXZ7RkQj9BAHoSt1Kor.i'),(123456,'employee','','Holt','Skinner','student','$2y$10$Id3iADda4Yc9U0tNHJH7au2FypVY/i8Z/zZ78xldq5x3PLH4cw4dK');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_has_permissions`
--

DROP TABLE IF EXISTS `employee_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_has_permissions` (
  `employee_id` int(11) NOT NULL,
  `employee_permissions_id` int(11) NOT NULL,
  PRIMARY KEY (`employee_id`,`employee_permissions_id`),
  KEY `fk_employee_has_employee_permissions_employee_permissions1_idx` (`employee_permissions_id`),
  CONSTRAINT `fk_employee_has_employee_permissions_employee` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_has_employee_permissions_employee_permissions1` FOREIGN KEY (`employee_permissions_id`) REFERENCES `employee_permissions` (`permission_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_has_permissions`
--

LOCK TABLES `employee_has_permissions` WRITE;
/*!40000 ALTER TABLE `employee_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_permissions`
--

DROP TABLE IF EXISTS `employee_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_permissions` (
  `permission_id` int(11) NOT NULL,
  `permission_name` varchar(250) NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_permissions`
--

LOCK TABLES `employee_permissions` WRITE;
/*!40000 ALTER TABLE `employee_permissions` DISABLE KEYS */;
INSERT INTO `employee_permissions` VALUES (1234,'Admin');
/*!40000 ALTER TABLE `employee_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expiredWaiver`
--

DROP TABLE IF EXISTS `expiredWaiver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expiredWaiver` (
  `student_id` int(11) NOT NULL DEFAULT '0',
  `waiver_name` varchar(250) NOT NULL,
  `initialized` datetime DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  PRIMARY KEY (`student_id`,`waiver_name`),
  KEY `fk_student_has_waiver_waiver1_idx` (`waiver_name`),
  KEY `fk_student_has_waiver_student1_idx` (`student_id`),
  CONSTRAINT `fk_student_has_waiver_student1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_student_has_waiver_waiver1` FOREIGN KEY (`waiver_name`) REFERENCES `waiver` (`waiver_name`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expiredWaiver`
--

LOCK TABLES `expiredWaiver` WRITE;
/*!40000 ALTER TABLE `expiredWaiver` DISABLE KEYS */;
/*!40000 ALTER TABLE `expiredWaiver` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(250) DEFAULT NULL,
  `category` varchar(250) DEFAULT NULL,
  `location` varchar(250) DEFAULT NULL,
  `item_condition` varchar(250) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  `ischeckedout` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES (4444,'PC7','PC','Student Center','Good','Brand spanking new',0),(1234567,'Laptop 50','PC','Student Center','Good','',0),(1234577,'Laptop2','Laptop','Student Center','Good','Brand new',0),(1234578,'Laptop3','Laptop','Memorial Union','Good','Slightly Damaged',0),(1234579,'Laptop5','Mac','Student Center',NULL,'Cracked Screen',0),(1234582,'Bike 67','Bike','Student Center','Broken','Terrible!!!',0),(123456789,'iPhone Charger 1','Phone Charger','Memorial Union',NULL,'Brand New',0),(123456790,'Bike 40','Bike','Memorial Union','Good','Good',0),(123456791,'Laptop 10','Bike','Student Center','Good','',0);
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_category`
--

DROP TABLE IF EXISTS `item_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_category` (
  `cat_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `time_limit` int(11) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_category`
--

LOCK TABLES `item_category` WRITE;
/*!40000 ALTER TABLE `item_category` DISABLE KEYS */;
INSERT INTO `item_category` VALUES (0,'Mac',120),(1,'Bike',24),(2,'PC',120),(5,'Phone Charger',NULL);
/*!40000 ALTER TABLE `item_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_condition`
--

DROP TABLE IF EXISTS `item_condition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_condition` (
  `name` varchar(250) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_condition`
--

LOCK TABLES `item_condition` WRITE;
/*!40000 ALTER TABLE `item_condition` DISABLE KEYS */;
INSERT INTO `item_condition` VALUES ('Broken',NULL),('Good',NULL);
/*!40000 ALTER TABLE `item_condition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_condition_update`
--

DROP TABLE IF EXISTS `item_condition_update`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_condition_update` (
  `item_id` int(11) NOT NULL DEFAULT '0',
  `updateTime` datetime NOT NULL,
  `condition_name` varchar(250) NOT NULL DEFAULT '',
  `employee_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_id`,`condition_name`,`updateTime`),
  KEY `fk_item_condition_has_item_item1_idx` (`item_id`),
  KEY `fk_employee_id_idx` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_condition_update`
--

LOCK TABLES `item_condition_update` WRITE;
/*!40000 ALTER TABLE `item_condition_update` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_condition_update` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_has_category`
--

DROP TABLE IF EXISTS `item_has_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_has_category` (
  `item_category_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`item_category_id`,`item_id`),
  KEY `fk_item_category_has_item_item1_idx` (`item_id`),
  KEY `fk_item_category_has_item_item_category1_idx` (`item_category_id`),
  CONSTRAINT `fk_item_category_has_item_item_category1` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_item_category_has_item_item1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_has_category`
--

LOCK TABLES `item_has_category` WRITE;
/*!40000 ALTER TABLE `item_has_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_has_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `location` (
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location`
--

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` VALUES ('Ellis Library'),('Memorial Union'),('Student Center');
/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name_first` varchar(30) NOT NULL,
  `name_last` varchar(45) NOT NULL,
  `waiver` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1234,'holt','hastg2@mail.missouri.edu','Holt','Skinner',NULL),(4444,'4s','anemail','yes','alsoyes',NULL),(112345,'holt','Holtwashere@gmail.com','Holt','Skinner',NULL),(1234567,'holt','Holtwashere@gmail.com','Holt','Skinner',NULL);
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_has_waiver`
--

DROP TABLE IF EXISTS `student_has_waiver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_has_waiver` (
  `student_id` int(11) DEFAULT NULL,
  `waiver_name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_has_waiver`
--

LOCK TABLES `student_has_waiver` WRITE;
/*!40000 ALTER TABLE `student_has_waiver` DISABLE KEYS */;
INSERT INTO `student_has_waiver` VALUES (1234,'Waiver');
/*!40000 ALTER TABLE `student_has_waiver` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_item_transaction`
--

DROP TABLE IF EXISTS `student_item_transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_item_transaction` (
  `student_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `employee_username` varchar(16) DEFAULT NULL,
  `condition_of_item_in` varchar(250) DEFAULT NULL,
  `condition_of_item_out` varchar(250) DEFAULT NULL,
  `location_in` varchar(250) DEFAULT NULL,
  `location_out` varchar(250) DEFAULT NULL,
  `check_in` datetime DEFAULT NULL,
  `due_at` datetime DEFAULT NULL,
  `check_out` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_item_transaction`
--

LOCK TABLES `student_item_transaction` WRITE;
/*!40000 ALTER TABLE `student_item_transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_item_transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `waiver`
--

DROP TABLE IF EXISTS `waiver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `waiver` (
  `waiver_name` varchar(250) NOT NULL,
  `is_filed` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`waiver_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `waiver`
--

LOCK TABLES `waiver` WRITE;
/*!40000 ALTER TABLE `waiver` DISABLE KEYS */;
INSERT INTO `waiver` VALUES ('Waiver',1);
/*!40000 ALTER TABLE `waiver` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-12 22:37:38
