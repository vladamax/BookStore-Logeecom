-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema probica
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema probica
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `probica` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `probica` ;

-- -----------------------------------------------------
-- Table `probica`.`Author`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `probica`.`Author` (
  `first_name` VARCHAR(30) NOT NULL,
  `last_name` VARCHAR(30) NOT NULL,
  `author_id` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`author_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 106
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `probica`.`Book`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `probica`.`Book` (
  `title` VARCHAR(50) NOT NULL,
  `year` INT NOT NULL,
  `author_id` INT NOT NULL,
  `book_id` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`book_id`),
  INDEX `author_id_idx` (`author_id` ASC) VISIBLE,
  CONSTRAINT `author_id`
    FOREIGN KEY (`author_id`)
    REFERENCES `probica`.`Author` (`author_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 85
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
