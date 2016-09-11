

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
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `category` varchar(250) DEFAULT NULL,
  `location` varchar(250) DEFAULT NULL,
  `item_condition` varchar(250) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  `ischeckedout` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=123456790 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `student_has_waiver`
--

DROP TABLE IF EXISTS `student_has_waiver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_has_waiver` (
  `student_id` int(11) NOT NULL DEFAULT '0',
  `waiver_name` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`student_id`,`waiver_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `student_item_transaction`
--

DROP TABLE IF EXISTS `student_item_transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_item_transaction` (
  `student_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `condition_of_item` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `employee_username` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-11 23:25:54
