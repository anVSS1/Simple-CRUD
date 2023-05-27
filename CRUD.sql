-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema g_client
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema g_client
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `g_client` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `g_client` ;

-- -----------------------------------------------------
-- Table `g_client`.`ville`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `g_client`.`ville` (
  `id_ville` INT NOT NULL,
  `nom_ville` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id_ville`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `g_client`.`client`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `g_client`.`client` (
  `id_client` INT NOT NULL,
  `nom_client` VARCHAR(45) NULL DEFAULT NULL,
  `telephone` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `adresse` VARCHAR(45) NULL DEFAULT NULL,
  `ville` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id_client`),
  INDEX `ville_idx` (`ville` ASC) VISIBLE,
  CONSTRAINT `ville`
    FOREIGN KEY (`ville`)
    REFERENCES `g_client`.`ville` (`id_ville`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
