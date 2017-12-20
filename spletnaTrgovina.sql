-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema spletna
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema spletna
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `spletna` DEFAULT CHARACTER SET utf8 ;
USE `spletna` ;

-- -----------------------------------------------------
-- Table `spletna`.`Administrator`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `spletna`.`Administrator` (
  `ime` VARCHAR(45) NOT NULL,
  `priimek` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `geslo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`email`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `spletna`.`Prodajalec`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `spletna`.`Prodajalec` (
  `ime` VARCHAR(45) NOT NULL,
  `priimek` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `geslo` VARCHAR(45) NOT NULL,
  `aktiviran_racun` boolean NOT NULL,
  PRIMARY KEY (`email`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `spletna`.`Stranka`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `spletna`.`Stranka` (
  `ime` VARCHAR(45) NOT NULL,
  `priimek` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `geslo` VARCHAR(45) NOT NULL,
  `naslov` VARCHAR(45) NOT NULL,
  `telefonska_st` VARCHAR(45) NOT NULL,
  `aktiviran_racun` boolean NOT NULL,
  PRIMARY KEY (`email`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `spletna`.`AnonimniOdjemalec`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `spletna`.`AnonimniOdjemalec` (
  `ip` VARCHAR(45) NOT NULL,
  `cas_dostopa` DATETIME NOT NULL,
  PRIMARY KEY (`ip`, `cas_dostopa`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `spletna`.`Artikel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `spletna`.`Artikel` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ime` VARCHAR(45) NOT NULL,
  `cena` FLOAT NOT NULL,
  `aktiviran` boolean NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `spletna`.`Dnevnik`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `spletna`.`Dnevnik` (
  `vloga` VARCHAR(45) NOT NULL,
  `datum` DATETIME NOT NULL,
  `akcija` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`vloga`, `datum`, `akcija`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
