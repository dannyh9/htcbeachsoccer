-- MySQL Script generated by MySQL Workbench
-- 11/28/17 12:41:34
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema HTC
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema HTC
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `HTC` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `HTC` ;

-- -----------------------------------------------------
-- Table `HTC`.`Persoon`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HTC`.`Persoon` (
  `PersoonID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `Pasfoto` VARCHAR(255) NULL COMMENT '',
  `Voornaam` VARCHAR(45) NOT NULL COMMENT '',
  `Tussenvoegsel` VARCHAR(45) NULL COMMENT '',
  `Achternaam` VARCHAR(45) NOT NULL COMMENT '',
  `Email` VARCHAR(45) NULL COMMENT '',
  `Functie` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`PersoonID`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HTC`.`Authorisatie`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HTC`.`Authorisatie` (
  `RolID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `Rolnaam` VARCHAR(45) NOT NULL COMMENT '',
  `Rechten` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`RolID`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HTC`.`Authenticatie`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HTC`.`Authenticatie` (
  `Username` VARCHAR(20) NOT NULL COMMENT '',
  `Password` VARCHAR(255) NOT NULL COMMENT '',
  `RolID` INT NOT NULL COMMENT '',
  `PersoonID` INT NOT NULL COMMENT '',
  PRIMARY KEY (`Username`)  COMMENT '',
  INDEX `fk_Authenticatie_Persoon_idx` (`PersoonID` ASC)  COMMENT '',
  INDEX `fk_Authenticatie_Authorisatie1_idx` (`RolID` ASC)  COMMENT '',
  CONSTRAINT `fk_Authenticatie_Persoon`
    FOREIGN KEY (`PersoonID`)
    REFERENCES `HTC`.`Persoon` (`PersoonID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Authenticatie_Authorisatie1`
    FOREIGN KEY (`RolID`)
    REFERENCES `HTC`.`Authorisatie` (`RolID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HTC`.`Media`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HTC`.`Media` (
  `MediaID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `Titel` VARCHAR(255) NOT NULL COMMENT '',
  `Afbeelding` VARCHAR(255) NOT NULL COMMENT '',
  `Beschrijving` VARCHAR(255) NULL COMMENT '',
  PRIMARY KEY (`MediaID`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HTC`.`Nieuwsartikel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HTC`.`Nieuwsartikel` (
  `ArtikelID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `Titel` VARCHAR(255) NOT NULL COMMENT '',
  `Inhoud` LONGTEXT NOT NULL COMMENT '',
  `MediaID` INT NULL COMMENT '',
  `Username` VARCHAR(20) NOT NULL COMMENT '',
  `Datum` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '',
  `Afbeeling` VARCHAR(255) NULL COMMENT '',
  PRIMARY KEY (`ArtikelID`)  COMMENT '',
  INDEX `fk_Nieuwsartikelen_Authenticatie1_idx` (`Username` ASC)  COMMENT '',
  INDEX `fk_Nieuwsartikelen_Media1_idx` (`MediaID` ASC)  COMMENT '',
  CONSTRAINT `fk_Nieuwsartikelen_Authenticatie1`
    FOREIGN KEY (`Username`)
    REFERENCES `HTC`.`Authenticatie` (`Username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Nieuwsartikelen_Media1`
    FOREIGN KEY (`MediaID`)
    REFERENCES `HTC`.`Media` (`MediaID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HTC`.`Agenda`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HTC`.`Agenda` (
  `EventID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `Titel` VARCHAR(45) NOT NULL COMMENT '',
  `Beschrijving` VARCHAR(45) NULL COMMENT '',
  `DatumVan` DATETIME NOT NULL COMMENT '',
  `DatumTot` DATETIME NOT NULL COMMENT '',
  PRIMARY KEY (`EventID`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HTC`.`Contactformulier`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HTC`.`Contactformulier` (
  `FormID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `Email` VARCHAR(45) NOT NULL COMMENT '',
  `Naam` VARCHAR(45) NOT NULL COMMENT '',
  `Telefoonnummer` VARCHAR(20) NULL COMMENT '',
  `Bericht` MEDIUMTEXT NOT NULL COMMENT '',
  `Timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '',
  PRIMARY KEY (`FormID`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HTC`.`Sponsor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HTC`.`Sponsor` (
  `SponisorID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `SponsorAfbeelding` VARCHAR(255) NOT NULL COMMENT '',
  `SponsorLink` VARCHAR(255) NOT NULL COMMENT '',
  `SponsorNaam` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`SponisorID`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HTC`.`Content`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HTC`.`Content` (
  `ContentID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `Titel` VARCHAR(255) NOT NULL COMMENT '',
  `Omschrijving` LONGTEXT NOT NULL COMMENT '',
  `Afbeelding` VARCHAR(255) NULL COMMENT '',
  PRIMARY KEY (`ContentID`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HTC`.`Accounting`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HTC`.`Accounting` (
  `LogID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `Username` VARCHAR(20) NOT NULL COMMENT '',
  `Datum` DATETIME(6) NOT NULL COMMENT '',
  `Beschrijving` VARCHAR(255) NOT NULL COMMENT '',
  PRIMARY KEY (`LogID`)  COMMENT '',
  INDEX `fk_Accounting_Authenticatie1_idx` (`Username` ASC)  COMMENT '',
  CONSTRAINT `fk_Accounting_Authenticatie1`
    FOREIGN KEY (`Username`)
    REFERENCES `HTC`.`Authenticatie` (`Username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HTC`.`Team`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HTC`.`Team` (
  `TeamID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `Teamnaam` VARCHAR(45) NULL COMMENT '',
  `Klasse` VARCHAR(45) NULL COMMENT '',
  `TeamAfbeelding` VARCHAR(255) NULL COMMENT '',
  PRIMARY KEY (`TeamID`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HTC`.`Wedstrijduitslag`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HTC`.`Wedstrijduitslag` (
  `WedstrijdID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `Datum` DATE NOT NULL COMMENT '',
  `TeamThuis` VARCHAR(45) NOT NULL COMMENT '',
  `TeamUit` VARCHAR(45) NOT NULL COMMENT '',
  `Uitslag` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`WedstrijdID`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HTC`.`Teamlid`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HTC`.`Teamlid` (
  `TeamID` INT NOT NULL COMMENT '',
  `PersoonID` INT NOT NULL COMMENT '',
  `Speelpositie` VARCHAR(45) NULL COMMENT '',
  `Functie` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`TeamID`, `PersoonID`)  COMMENT '',
  INDEX `fk_Teamlid_Persoon1_idx` (`PersoonID` ASC)  COMMENT '',
  CONSTRAINT `fk_Teamlid_Persoon1`
    FOREIGN KEY (`PersoonID`)
    REFERENCES `HTC`.`Persoon` (`PersoonID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Teamlid_Team1`
    FOREIGN KEY (`TeamID`)
    REFERENCES `HTC`.`Team` (`TeamID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
