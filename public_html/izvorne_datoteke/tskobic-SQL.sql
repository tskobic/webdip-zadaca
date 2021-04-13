-- MySQL Script generated by MySQL Workbench
-- Mon Apr 12 00:16:30 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema WebDiP2020x119
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema WebDiP2020x119
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `WebDiP2020x119` DEFAULT CHARACTER SET utf8 ;
USE `WebDiP2020x119` ;

-- -----------------------------------------------------
-- Table `WebDiP2020x119`.`uloga`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2020x119`.`uloga` (
  `uloga_id` INT NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(25) NOT NULL,
  `razina_autorizacije` INT NOT NULL,
  PRIMARY KEY (`uloga_id`))
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `WebDiP2020x119`.`korisnik`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2020x119`.`korisnik` (
  `korisnik_id` INT NOT NULL AUTO_INCREMENT,
  `uloga_id` INT NOT NULL,
  `ime` VARCHAR(45) NOT NULL,
  `prezime` VARCHAR(45) NOT NULL,
  `korisnicko_ime` VARCHAR(25) NOT NULL,
  `lozinka` VARCHAR(25) NOT NULL,
  `lozinka_sha256` CHAR(64) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `uvjeti` DATETIME NULL,
  `status` TINYINT(1) NOT NULL,
  PRIMARY KEY (`korisnik_id`),
  INDEX `fk_korisnik_uloga_idx` (`uloga_id` ASC),
  CONSTRAINT `fk_korisnik_uloga`
    FOREIGN KEY (`uloga_id`)
    REFERENCES `WebDiP2020x119`.`uloga` (`uloga_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `WebDiP2020x119`.`tip_dnevnika`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2020x119`.`tip_dnevnika` (
  `tip_id` INT NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`tip_id`))
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `WebDiP2020x119`.`dnevnik`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2020x119`.`dnevnik` (
  `dnevnik_id` INT NOT NULL AUTO_INCREMENT,
  `tip_id` INT NOT NULL,
  `korisnik_id` INT NOT NULL,
  `radnja` TEXT NOT NULL,
  `upit` TEXT NULL,
  `datum_vrijeme` DATETIME NOT NULL,
  PRIMARY KEY (`dnevnik_id`, `tip_id`, `korisnik_id`),
  INDEX `fk_dnevnik_korisnik1_idx` (`korisnik_id` ASC),
  INDEX `fk_dnevnik_tip1_idx` (`tip_id` ASC),
  CONSTRAINT `fk_dnevnik_korisnik1`
    FOREIGN KEY (`korisnik_id`)
    REFERENCES `WebDiP2020x119`.`korisnik` (`korisnik_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_dnevnik_tip1`
    FOREIGN KEY (`tip_id`)
    REFERENCES `WebDiP2020x119`.`tip_dnevnika` (`tip_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `WebDiP2020x119`.`grupa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2020x119`.`grupa` (
  `grupa_id` INT NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(45) NOT NULL,
  `godina` INT NOT NULL,
  `opis` TEXT NOT NULL,
  PRIMARY KEY (`grupa_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `WebDiP2020x119`.`status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2020x119`.`status` (
  `status_id` INT NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`status_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `WebDiP2020x119`.`rodjendan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2020x119`.`rodjendan` (
  `rodjendan_id` INT NOT NULL AUTO_INCREMENT,
  `korisnik_id` INT NOT NULL,
  `status_id` INT NOT NULL,
  `grupa_id` INT NOT NULL,
  `broj_djece` INT NOT NULL,
  `datum` DATE NOT NULL,
  `vrijeme` TIME NOT NULL,
  `naziv` VARCHAR(45) NULL,
  `opis` TEXT NULL,
  PRIMARY KEY (`rodjendan_id`),
  INDEX `fk_rezervacija_korisnik1_idx` (`korisnik_id` ASC),
  INDEX `fk_rodjendan_status1_idx` (`status_id` ASC),
  INDEX `fk_rodjendan_grupa1_idx` (`grupa_id` ASC),
  CONSTRAINT `fk_rezervacija_korisnik1`
    FOREIGN KEY (`korisnik_id`)
    REFERENCES `WebDiP2020x119`.`korisnik` (`korisnik_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rodjendan_status1`
    FOREIGN KEY (`status_id`)
    REFERENCES `WebDiP2020x119`.`status` (`status_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rodjendan_grupa1`
    FOREIGN KEY (`grupa_id`)
    REFERENCES `WebDiP2020x119`.`grupa` (`grupa_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `WebDiP2020x119`.`tip_materijala`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2020x119`.`tip_materijala` (
  `tip_id` INT NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`tip_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `WebDiP2020x119`.`materijal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2020x119`.`materijal` (
  `materijal_id` INT NOT NULL AUTO_INCREMENT,
  `tip_id` INT NOT NULL,
  `rodjendan_id` INT NOT NULL,
  `opis` TEXT NOT NULL,
  `suglasnost` TINYINT(1) NOT NULL,
  PRIMARY KEY (`materijal_id`),
  INDEX `fk_materijali_tip_materijala1_idx` (`tip_id` ASC),
  INDEX `fk_materijal_rodjendan1_idx` (`rodjendan_id` ASC),
  CONSTRAINT `fk_materijali_tip_materijala1`
    FOREIGN KEY (`tip_id`)
    REFERENCES `WebDiP2020x119`.`tip_materijala` (`tip_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_materijal_rodjendan1`
    FOREIGN KEY (`rodjendan_id`)
    REFERENCES `WebDiP2020x119`.`rodjendan` (`rodjendan_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `WebDiP2020x119`.`grupa_moderator`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2020x119`.`grupa_moderator` (
  `grupa_id` INT NOT NULL,
  `korisnik_id` INT NOT NULL,
  PRIMARY KEY (`grupa_id`, `korisnik_id`),
  INDEX `fk_grupa_has_korisnik_korisnik1_idx` (`korisnik_id` ASC),
  INDEX `fk_grupa_has_korisnik_grupa1_idx` (`grupa_id` ASC),
  CONSTRAINT `fk_grupa_has_korisnik_grupa1`
    FOREIGN KEY (`grupa_id`)
    REFERENCES `WebDiP2020x119`.`grupa` (`grupa_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_grupa_has_korisnik_korisnik1`
    FOREIGN KEY (`korisnik_id`)
    REFERENCES `WebDiP2020x119`.`korisnik` (`korisnik_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `WebDiP2020x119`.`uzvanik`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2020x119`.`uzvanik` (
  `korisnik_id` INT NOT NULL,
  `rodjendan_id` INT NOT NULL,
  PRIMARY KEY (`korisnik_id`, `rodjendan_id`),
  INDEX `fk_rodjendan_has_korisnik_korisnik1_idx` (`korisnik_id` ASC),
  INDEX `fk_rodjendan_has_korisnik_rodjendan1_idx` (`rodjendan_id` ASC),
  CONSTRAINT `fk_rodjendan_has_korisnik_rodjendan1`
    FOREIGN KEY (`rodjendan_id`)
    REFERENCES `WebDiP2020x119`.`rodjendan` (`rodjendan_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rodjendan_has_korisnik_korisnik1`
    FOREIGN KEY (`korisnik_id`)
    REFERENCES `WebDiP2020x119`.`korisnik` (`korisnik_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;