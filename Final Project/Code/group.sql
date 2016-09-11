DROP DATABASE if EXISTS group_database;
CREATE DATABASE group_database;

use group_database;

DROP TABLE if EXISTS permissions;

CREATE TABLE `permissions` (
  'permission_id' varchar(250),
  PRIMARY KEY(permission_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `employee`;

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `username` varchar(16) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `name_first` varchar(30) NOT NULL,
  `name_last` varchar(45) NOT NULL,
  `permission_id` varchar(250) REFERENCES permissions(permission_id),
  `hashed_password` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
DROP TABLE IF EXISTS `expiredWaiver`;

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
*/

DROP TABLE IF EXISTS `item`;

CREATE TABLE `item` (
  `id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(250) DEFAULT NULL,
  `category` varchar(250) REFERENCES item_category(name),
  `location` varchar(250) REFERENCES location(name),
  `item_condition` varchar(250) REFERENCES item_condition(name),
  `notes` varchar(500) DEFAULT NULL,
  `ischeckedout` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `item_category`;

CREATE TABLE `item_category` (
  `name` varchar(250) NOT NULL,
  `time_limit` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `item_condition`;
CREATE TABLE `item_condition` (
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `item_condition_update`;

CREATE TABLE `item_condition_update` (
  `item_id` int(11) NOT NULL DEFAULT '0',
  `updateTime` datetime NOT NULL,
  `condition_name` varchar(250) NOT NULL DEFAULT '',
  `employee_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_id`,`condition_name`,`updateTime`),
  KEY `fk_item_condition_has_item_item1_idx` (`item_id`),
  KEY `fk_employee_id_idx` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
DROP TABLE IF EXISTS `item_has_category`;

CREATE TABLE `item_has_category` (
  `item_category_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`item_category_id`,`item_id`),
  KEY `fk_item_category_has_item_item1_idx` (`item_id`),
  KEY `fk_item_category_has_item_item_category1_idx` (`item_category_id`),
  CONSTRAINT `fk_item_category_has_item_item_category1` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_item_category_has_item_item1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
*/

DROP TABLE IF EXISTS `location`;

CREATE TABLE `location` (
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `student`;

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name_first` varchar(30) NOT NULL,
  `name_last` varchar(45) NOT NULL,
  `waiver` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `student_item_transaction`;

CREATE TABLE `student_item_transaction` (
  `student_id` int(11) REFERENCES student(student_id),
  `item_id` int(11) REFERENCES item(id),
  `employee_username` varchar(16),
  `condition_of_item_in` varchar(250) REFERENCES item_condition(name),
  `condition_of_item_out` varchar(250) REFERENCES item_condition(name),
  `location_in` varchar(250) REFERENCES location(name),
  `location_out` varchar(250) REFERENCES location(name),
  `check_in` datetime DEFAULT NULL,
  `due_at` datetime DEFAULT NULL,
  `check_out` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
DROP TABLE IF EXISTS `waiver`;

CREATE TABLE `waiver` (
  `waiver_name` varchar(250) NOT NULL,
  `is_filed` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`waiver_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
*/

--
-- Table structure for table `student_has_waiver`
/*
DROP TABLE IF EXISTS `student_has_waiver`;

CREATE TABLE `student_has_waiver` (
  `student_id` int(11) DEFAULT NULL,
  `waiver_name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
*/
