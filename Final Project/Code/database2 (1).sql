-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`employee`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`employee` ;

CREATE TABLE IF NOT EXISTS `mydb`.`employee` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(16) NULL,
  `email` VARCHAR(255) NULL,
  `name_first` VARCHAR(30) NULL,
  `name_last` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `mydb`.`item`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`item` ;

CREATE TABLE IF NOT EXISTS `mydb`.`item` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(250) NULL,
  `available` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `mydb`.`location`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`location` ;

CREATE TABLE IF NOT EXISTS `mydb`.`location` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(250) NULL,
  `terminal_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `terminal_id`));


-- -----------------------------------------------------
-- Table `mydb`.`waiver`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`waiver` ;

CREATE TABLE IF NOT EXISTS `mydb`.`waiver` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(250) NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `mydb`.`item_category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`item_category` ;

CREATE TABLE IF NOT EXISTS `mydb`.`item_category` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(250) NULL,
  `waiver` INT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_waiver`
    FOREIGN KEY (`waiver`)
    REFERENCES `mydb`.`waiver` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX `FK_waiver_idx` ON `mydb`.`item_category` (`waiver` ASC);


-- -----------------------------------------------------
-- Table `mydb`.`employee_permissions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`employee_permissions` ;

CREATE TABLE IF NOT EXISTS `mydb`.`employee_permissions` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(250) NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `mydb`.`item_condition`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`item_condition` ;

CREATE TABLE IF NOT EXISTS `mydb`.`item_condition` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(250) NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `mydb`.`employee_has_permissions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`employee_has_permissions` ;

CREATE TABLE IF NOT EXISTS `mydb`.`employee_has_permissions` (
  `employee_id` INT(11) NOT NULL,
  `employee_permissions_id` INT(11) NOT NULL,
  PRIMARY KEY (`employee_id`, `employee_permissions_id`),
  CONSTRAINT `fk_employee_has_employee_permissions_employee`
    FOREIGN KEY (`employee_id`)
    REFERENCES `mydb`.`employee` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_has_employee_permissions_employee_permissions1`
    FOREIGN KEY (`employee_permissions_id`)
    REFERENCES `mydb`.`employee_permissions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX `fk_employee_has_employee_permissions_employee_permissions1_idx` ON `mydb`.`employee_has_permissions` (`employee_permissions_id` ASC);

CREATE INDEX `fk_employee_has_employee_permissions_employee_idx` ON `mydb`.`employee_has_permissions` (`employee_id` ASC);


-- -----------------------------------------------------
-- Table `mydb`.`student`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`student` ;

CREATE TABLE IF NOT EXISTS `mydb`.`student` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(16) NULL,
  `email` VARCHAR(255) NULL,
  `name_first` VARCHAR(30) NULL,
  `name_last` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `mydb`.`student_item_transaction`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`student_item_transaction` ;

CREATE TABLE IF NOT EXISTS `mydb`.`student_item_transaction` (
  `student_id` INT(11) NOT NULL,
  `item_id` INT(11) NOT NULL,
  `item_condition_id_out` INT(11) NOT NULL,
  `location_id` INT(11) NOT NULL,
  `employee_id_out` INT(11) NOT NULL,
  `check_out` DATETIME(10) NOT NULL,
  `due` DATETIME(10) NULL,
  `check_in` DATETIME(10) NULL,
  `item_condition_id_in` INT(11) NULL,
  `employee_in` INT(11) NULL,
  `terminal_id_out` INT(11) NULL,
  `terminal_id_in` INT(11) NULL,
  PRIMARY KEY (`student_id`, `item_id`, `item_condition_id_out`, `location_id`, `employee_id_out`, `check_out`),
  CONSTRAINT `fk_student_has_item_student1`
    FOREIGN KEY (`student_id`)
    REFERENCES `mydb`.`student` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_student_has_item_item1`
    FOREIGN KEY (`item_id`)
    REFERENCES `mydb`.`item` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_student_has_item_item_condition1`
    FOREIGN KEY (`item_condition_id_out`)
    REFERENCES `mydb`.`item_condition` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_student_has_item_location1`
    FOREIGN KEY (`location_id`)
    REFERENCES `mydb`.`location` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_student_has_item_employee1`
    FOREIGN KEY (`employee_id_out`)
    REFERENCES `mydb`.`employee` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_terminal_in`
    FOREIGN KEY (`terminal_id_in`)
    REFERENCES `mydb`.`location` (`terminal_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_terminal_out`
    FOREIGN KEY (`terminal_id_out`)
    REFERENCES `mydb`.`location` (`terminal_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX `fk_student_has_item_item1_idx` ON `mydb`.`student_item_transaction` (`item_id` ASC);

CREATE INDEX `fk_student_has_item_item_condition1_idx` ON `mydb`.`student_item_transaction` (`item_condition_id_out` ASC);

CREATE INDEX `fk_student_has_item_location1_idx` ON `mydb`.`student_item_transaction` (`location_id` ASC);

CREATE INDEX `fk_student_has_item_employee1_idx` ON `mydb`.`student_item_transaction` (`employee_id_out` ASC);

CREATE INDEX `fk_terminal_in_idx` ON `mydb`.`student_item_transaction` (`terminal_id_in` ASC);

CREATE INDEX `fk_terminal_out_idx` ON `mydb`.`student_item_transaction` (`terminal_id_out` ASC);


-- -----------------------------------------------------
-- Table `mydb`.`student_has_waiver`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`student_has_waiver` ;

CREATE TABLE IF NOT EXISTS `mydb`.`student_has_waiver` (
  `student_id` INT(11) NOT NULL,
  `waiver_id` INT(11) NOT NULL,
  `initialized` DATETIME(10) NULL,
  `expires` DATETIME(10) NULL,
  PRIMARY KEY (`student_id`, `waiver_id`),
  CONSTRAINT `fk_student_has_waiver_student1`
    FOREIGN KEY (`student_id`)
    REFERENCES `mydb`.`student` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_student_has_waiver_waiver1`
    FOREIGN KEY (`waiver_id`)
    REFERENCES `mydb`.`waiver` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX `fk_student_has_waiver_waiver1_idx` ON `mydb`.`student_has_waiver` (`waiver_id` ASC);

CREATE INDEX `fk_student_has_waiver_student1_idx` ON `mydb`.`student_has_waiver` (`student_id` ASC);


-- -----------------------------------------------------
-- Table `mydb`.`item_has_category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`item_has_category` ;

CREATE TABLE IF NOT EXISTS `mydb`.`item_has_category` (
  `item_category_id` INT(11) NOT NULL,
  `item_id` INT(11) NOT NULL,
  PRIMARY KEY (`item_category_id`, `item_id`),
  CONSTRAINT `fk_item_category_has_item_item_category1`
    FOREIGN KEY (`item_category_id`)
    REFERENCES `mydb`.`item_category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_item_category_has_item_item1`
    FOREIGN KEY (`item_id`)
    REFERENCES `mydb`.`item` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX `fk_item_category_has_item_item1_idx` ON `mydb`.`item_has_category` (`item_id` ASC);

CREATE INDEX `fk_item_category_has_item_item_category1_idx` ON `mydb`.`item_has_category` (`item_category_id` ASC);


-- -----------------------------------------------------
-- Table `mydb`.`item_condition_update`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`item_condition_update` ;

CREATE TABLE IF NOT EXISTS `mydb`.`item_condition_update` (
  `item_condition_id_old` INT(11) NOT NULL,
  `item_id` INT(11) NOT NULL,
  `item_condition_id_new` INT(11) NOT NULL,
  `date_time` DATETIME(10) NOT NULL,
  `employee_id` INT(11) NOT NULL,
  PRIMARY KEY (`item_id`, `date_time`),
  CONSTRAINT `fk_item_condition_has_item_item_condition_in`
    FOREIGN KEY (`item_condition_id_old`)
    REFERENCES `mydb`.`item_condition` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_item_condition_has_item_item1`
    FOREIGN KEY (`item_id`)
    REFERENCES `mydb`.`item` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_item_out`
    FOREIGN KEY (`item_condition_id_old`)
    REFERENCES `mydb`.`item_condition` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_id`
    FOREIGN KEY (`employee_id`)
    REFERENCES `mydb`.`employee` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX `fk_item_condition_has_item_item1_idx` ON `mydb`.`item_condition_update` (`item_id` ASC);

CREATE INDEX `fk_item_condition_has_item_item_condition1_idx` ON `mydb`.`item_condition_update` (`item_condition_id_old` ASC);

CREATE INDEX `fk_employee_id_idx` ON `mydb`.`item_condition_update` (`employee_id` ASC);


-- -----------------------------------------------------
-- Table `mydb`.`expired_Waiver`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`expired_Waiver` ;

CREATE TABLE IF NOT EXISTS `mydb`.`expired_Waiver` (
  `student_id` INT(11) NOT NULL,
  `waiver_id` INT(11) NOT NULL,
  `initialized` DATETIME(10) NULL,
  `expires` DATETIME(10) NULL,
  PRIMARY KEY (`student_id`, `waiver_id`),
  CONSTRAINT `fk_student_has_waiver_student10`
    FOREIGN KEY (`student_id`)
    REFERENCES `mydb`.`student` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_student_has_waiver_waiver10`
    FOREIGN KEY (`waiver_id`)
    REFERENCES `mydb`.`waiver` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX `fk_student_has_waiver_waiver1_idx` ON `mydb`.`expired_Waiver` (`waiver_id` ASC);

CREATE INDEX `fk_student_has_waiver_student1_idx` ON `mydb`.`expired_Waiver` (`student_id` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
