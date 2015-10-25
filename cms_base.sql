-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema base_cms
-- -----------------------------------------------------
-- 一些基础功能件的数据库

-- -----------------------------------------------------
-- Schema base_cms
--
-- 一些基础功能件的数据库
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `base_cms` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `base_cms` ;

-- -----------------------------------------------------
-- Table `base_cms`.`base_admin_group`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_cms`.`base_admin_group` (
  `group_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `group_name` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`group_id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_cms`.`base_admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_cms`.`base_admin` (
  `admin_id` INT NOT NULL COMMENT '',
  `admin_username` VARCHAR(45) NULL COMMENT '',
  `admin_password` CHAR(32) NULL COMMENT '',
  `admin_nickname` VARCHAR(45) NULL COMMENT '',
  `admin_group` INT NULL COMMENT '',
  PRIMARY KEY (`admin_id`)  COMMENT '',
  INDEX `base_admin_1_idx` (`admin_group` ASC)  COMMENT '',
  CONSTRAINT `base_admin_1`
    FOREIGN KEY (`admin_group`)
    REFERENCES `base_cms`.`base_admin_group` (`group_id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_cms`.`base_admin_power`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_cms`.`base_admin_power` (
  `power_id` INT NOT NULL COMMENT '',
  `power_name` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`power_id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_cms`.`base_admin_re_power`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_cms`.`base_admin_re_power` (
  `relation_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `relation_group_id` INT NULL COMMENT '',
  `relation_power_id` INT NULL COMMENT '',
  PRIMARY KEY (`relation_id`)  COMMENT '',
  INDEX `fk_base_admin_relation_2_idx` (`relation_power_id` ASC)  COMMENT '',
  INDEX `fk_base_admin_relation_1_idx` (`relation_group_id` ASC)  COMMENT '',
  CONSTRAINT `fk_base_admin_relation_1`
    FOREIGN KEY (`relation_group_id`)
    REFERENCES `base_cms`.`base_admin_group` (`group_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_base_admin_relation_2`
    FOREIGN KEY (`relation_power_id`)
    REFERENCES `base_cms`.`base_admin_power` (`power_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_cms`.`base_user_group`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_cms`.`base_user_group` (
  `group_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `group_name` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`group_id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_cms`.`base_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_cms`.`base_user` (
  `user_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `user_username` VARCHAR(45) NULL COMMENT '',
  `user_password` CHAR(32) NULL COMMENT '',
  `user_nickname` VARCHAR(45) NULL COMMENT '',
  `user_create_date` TIMESTAMP NULL COMMENT '',
  `user_update_date` TIMESTAMP NULL COMMENT '',
  `user_true` TINYINT(1) NULL COMMENT '',
  `user_age` INT NULL COMMENT '',
  `user_intro` VARCHAR(100) NULL COMMENT '',
  `user_sex` CHAR(4) NULL COMMENT '',
  `user_group` INT NULL COMMENT '',
  PRIMARY KEY (`user_id`)  COMMENT '',
  INDEX `base_user_1_idx` (`user_group` ASC)  COMMENT '',
  CONSTRAINT `base_user_1`
    FOREIGN KEY (`user_group`)
    REFERENCES `base_cms`.`base_user_group` (`group_id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_cms`.`base_user_power`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_cms`.`base_user_power` (
  `power_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `power_name` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`power_id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_cms`.`base_user_re_power`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_cms`.`base_user_re_power` (
  `relation_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `relation_group` INT NULL COMMENT '',
  `relation_power` INT NULL COMMENT '',
  PRIMARY KEY (`relation_id`)  COMMENT '',
  INDEX `base_user_re_power_2_idx` (`relation_power` ASC)  COMMENT '',
  INDEX `fk_base_user_re_power_1_idx` (`relation_group` ASC)  COMMENT '',
  CONSTRAINT `fk_base_user_re_power_1`
    FOREIGN KEY (`relation_group`)
    REFERENCES `base_cms`.`base_user_group` (`group_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `base_user_re_power_2`
    FOREIGN KEY (`relation_power`)
    REFERENCES `base_cms`.`base_user_power` (`power_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_cms`.`base_article_class`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_cms`.`base_article_class` (
  `class_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `class_user` INT NULL COMMENT '',
  `class_create_date` TIMESTAMP NULL COMMENT '',
  `class_update_date` TIMESTAMP NULL COMMENT '',
  `class_name` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`class_id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_cms`.`base_image`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_cms`.`base_image` (
  `image_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `image_name` VARCHAR(45) NULL COMMENT '',
  `image_intro` VARCHAR(100) NULL COMMENT '',
  `image_path` VARCHAR(45) NULL COMMENT '',
  `image_format` VARCHAR(45) NULL COMMENT '',
  `image_user` INT NULL COMMENT '',
  `image_folder` TINYINT(1) NULL COMMENT '',
  PRIMARY KEY (`image_id`)  COMMENT '',
  INDEX `base_image_idx` (`image_user` ASC)  COMMENT '',
  CONSTRAINT `base_image`
    FOREIGN KEY (`image_user`)
    REFERENCES `base_cms`.`base_user` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_cms`.`base_article`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_cms`.`base_article` (
  `article_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `article_create_date` TIMESTAMP NULL COMMENT '',
  `article_update_date` TIMESTAMP NULL COMMENT '',
  `article_true` TINYINT(1) NULL COMMENT '',
  `article_user` INT NULL COMMENT '',
  `article_title` VARCHAR(100) NULL COMMENT '',
  `article_intro` VARCHAR(300) NULL COMMENT '',
  `article_class` INT NULL COMMENT '',
  `article_detail` TEXT NULL COMMENT '',
  `article_sort` INT NULL COMMENT '',
  `article_click` INT NULL COMMENT '',
  `article_star` INT NULL COMMENT '',
  `article_image` INT NULL COMMENT '',
  PRIMARY KEY (`article_id`)  COMMENT '',
  INDEX `base_article_1_idx` (`article_class` ASC)  COMMENT '',
  INDEX `base_article_2_idx` (`article_user` ASC)  COMMENT '',
  INDEX `base_article_3_idx` (`article_image` ASC)  COMMENT '',
  CONSTRAINT `base_article_1`
    FOREIGN KEY (`article_class`)
    REFERENCES `base_cms`.`base_article_class` (`class_id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `base_article_2`
    FOREIGN KEY (`article_user`)
    REFERENCES `base_cms`.`base_user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `base_article_3`
    FOREIGN KEY (`article_image`)
    REFERENCES `base_cms`.`base_image` (`image_id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_cms`.`base_article_subject`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_cms`.`base_article_subject` (
  `subject_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `subject_name` VARCHAR(60) NULL COMMENT '',
  `subject_create_date` TIMESTAMP NULL COMMENT '',
  `subject_update_date` TIMESTAMP NULL COMMENT '',
  `subject_access` TINYINT(1) NULL COMMENT '',
  `subject_intro` VARCHAR(100) NULL COMMENT '',
  PRIMARY KEY (`subject_id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_cms`.`base_article_re_subject`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_cms`.`base_article_re_subject` (
  `relation_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `relation_subject` INT NULL COMMENT '',
  `relation_article` INT NULL COMMENT '',
  PRIMARY KEY (`relation_id`)  COMMENT '',
  INDEX `base_article_re_subject_1_idx` (`relation_article` ASC)  COMMENT '',
  INDEX `base_article_re_subject_2_idx` (`relation_subject` ASC)  COMMENT '',
  CONSTRAINT `base_article_re_subject_1`
    FOREIGN KEY (`relation_article`)
    REFERENCES `base_cms`.`base_article` (`article_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `base_article_re_subject_2`
    FOREIGN KEY (`relation_subject`)
    REFERENCES `base_cms`.`base_article_subject` (`subject_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_cms`.`base_article_label`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_cms`.`base_article_label` (
  `label_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `label_create_date` TIMESTAMP NULL COMMENT '',
  `label_update_date` TIMESTAMP NULL COMMENT '',
  `label_name` VARCHAR(50) NULL COMMENT '',
  PRIMARY KEY (`label_id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_cms`.`base_article_re_label`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_cms`.`base_article_re_label` (
  `relation_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `relation_article` INT NULL COMMENT '',
  `relation_label` INT NULL COMMENT '',
  PRIMARY KEY (`relation_id`)  COMMENT '',
  INDEX `base_article_re_label_1_idx` (`relation_article` ASC)  COMMENT '',
  INDEX `base_article_re_label_2_idx` (`relation_label` ASC)  COMMENT '',
  CONSTRAINT `base_article_re_label_1`
    FOREIGN KEY (`relation_article`)
    REFERENCES `base_cms`.`base_article` (`article_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `base_article_re_label_2`
    FOREIGN KEY (`relation_label`)
    REFERENCES `base_cms`.`base_article_label` (`label_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_cms`.`base_file`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_cms`.`base_file` (
  `file_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `file_user` INT NULL COMMENT '',
  `file_path` VARCHAR(1024) NULL COMMENT '',
  `file_folder` TINYINT(1) NULL COMMENT '',
  `file_own_read` TINYINT(1) NULL COMMENT '',
  `file_own_write` TINYINT(1) NULL COMMENT '',
  `file_own_execute` TINYINT(1) NULL COMMENT '',
  `file_group_read` TINYINT(1) NULL COMMENT '',
  `file_group_write` TINYINT(1) NULL COMMENT '',
  `file_group_execute` TINYINT(1) NULL COMMENT '',
  `file_other_read` TINYINT(1) NULL COMMENT '',
  `file_other_write` TINYINT(1) NULL COMMENT '',
  `file_other_execute` TINYINT(1) NULL COMMENT '',
  `file_create_date` TIMESTAMP NULL COMMENT '',
  `file_update_date` TIMESTAMP NULL COMMENT '',
  PRIMARY KEY (`file_id`)  COMMENT '',
  INDEX `base_file_1_idx` (`file_user` ASC)  COMMENT '',
  CONSTRAINT `base_file_1`
    FOREIGN KEY (`file_user`)
    REFERENCES `base_cms`.`base_user` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = 'image_class是指的虚拟文件系统节点类型，如果class为d,则为一个文件夹节点\n权限字段和unix系文件系统类似\n在初始化时，会初始化一个原始节点作为所有文件夹的父节点';


-- -----------------------------------------------------
-- Table `base_cms`.`base_file_relation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_cms`.`base_file_relation` (
  `relation_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `relation_parent` INT NULL COMMENT '',
  `relation_child` INT NULL COMMENT '',
  PRIMARY KEY (`relation_id`)  COMMENT '',
  INDEX `base_file_relation_idx` (`relation_parent` ASC)  COMMENT '',
  INDEX `base_file_relation_2_idx` (`relation_child` ASC)  COMMENT '',
  CONSTRAINT `base_file_relation_1`
    FOREIGN KEY (`relation_parent`)
    REFERENCES `base_cms`.`base_file` (`file_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `base_file_relation_2`
    FOREIGN KEY (`relation_child`)
    REFERENCES `base_cms`.`base_file` (`file_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = '虚拟文件系统关系树';


-- -----------------------------------------------------
-- Table `base_cms`.`base_image_relation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_cms`.`base_image_relation` (
  `relation_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `relation_parent` INT NULL COMMENT '',
  `relation_child` INT NULL COMMENT '',
  PRIMARY KEY (`relation_id`)  COMMENT '',
  INDEX `base_image_relation_1_idx` (`relation_parent` ASC)  COMMENT '',
  INDEX `base_image_relation_2_idx` (`relation_child` ASC)  COMMENT '',
  CONSTRAINT `base_image_relation_1`
    FOREIGN KEY (`relation_parent`)
    REFERENCES `base_cms`.`base_image` (`image_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `base_image_relation_2`
    FOREIGN KEY (`relation_child`)
    REFERENCES `base_cms`.`base_user` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_cms`.`base_message`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_cms`.`base_message` (
  `meessage_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `message_send_user` INT NULL COMMENT '',
  `message_send_admin` INT NULL COMMENT '',
  `message_recv_user` INT NULL COMMENT '',
  `message_recv_u_group` INT NULL COMMENT '',
  `message_recv_admin` INT NULL COMMENT '',
  `message_recv_a_group` INT NULL COMMENT '',
  `message_title` VARCHAR(100) NULL COMMENT '',
  `message_data` VARCHAR(1024) NULL COMMENT '',
  `message_create_date` TIMESTAMP NULL COMMENT '',
  PRIMARY KEY (`meessage_id`)  COMMENT '',
  INDEX `base_message_1_idx` (`message_recv_admin` ASC)  COMMENT '',
  INDEX `base_message_2_idx` (`message_send_admin` ASC)  COMMENT '',
  INDEX `base_message_3_idx` (`message_send_user` ASC)  COMMENT '',
  INDEX `base_message_4_idx` (`message_recv_user` ASC)  COMMENT '',
  INDEX `base_message_5_idx` (`message_recv_u_group` ASC)  COMMENT '',
  INDEX `base_message_6_idx` (`message_recv_a_group` ASC)  COMMENT '',
  CONSTRAINT `base_message_1`
    FOREIGN KEY (`message_recv_admin`)
    REFERENCES `base_cms`.`base_admin` (`admin_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `base_message_2`
    FOREIGN KEY (`message_send_admin`)
    REFERENCES `base_cms`.`base_admin` (`admin_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `base_message_3`
    FOREIGN KEY (`message_send_user`)
    REFERENCES `base_cms`.`base_user` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `base_message_4`
    FOREIGN KEY (`message_recv_user`)
    REFERENCES `base_cms`.`base_user` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `base_message_5`
    FOREIGN KEY (`message_recv_u_group`)
    REFERENCES `base_cms`.`base_user_group` (`group_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `base_message_6`
    FOREIGN KEY (`message_recv_a_group`)
    REFERENCES `base_cms`.`base_admin_group` (`group_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_cms`.`base_log`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_cms`.`base_log` (
  `log_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `log_level` INT NULL COMMENT '',
  `log_title` VARCHAR(50) NULL COMMENT '',
  `log_detail` VARCHAR(500) NULL COMMENT '',
  `log_data` VARCHAR(500) NULL COMMENT '',
  `log_date` TIMESTAMP NULL COMMENT '',
  `log_user` INT NULL COMMENT '',
  `log_admin` INT NULL COMMENT '',
  PRIMARY KEY (`log_id`)  COMMENT '',
  INDEX `base_log_1_idx` (`log_user` ASC)  COMMENT '',
  INDEX `base_log_2_idx` (`log_admin` ASC)  COMMENT '',
  CONSTRAINT `base_log_1`
    FOREIGN KEY (`log_user`)
    REFERENCES `base_cms`.`base_user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `base_log_2`
    FOREIGN KEY (`log_admin`)
    REFERENCES `base_cms`.`base_admin` (`admin_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'level';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
