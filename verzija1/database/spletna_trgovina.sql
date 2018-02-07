-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `articles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `articles` ;

CREATE TABLE IF NOT EXISTS `articles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `price` FLOAT NOT NULL,
  `description` VARCHAR(220) NULL,
  `image` MEDIUMBLOB NULL,
  `image_type` VARCHAR(45) NULL,
  `active` TINYINT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `roles` ;

CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` INT NOT NULL AUTO_INCREMENT,
  `role_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`role_id`, `role_name`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users` ;

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NULL,
  `last_name` VARCHAR(45) NULL,
  `street_address` VARCHAR(45) NULL,
  `city` VARCHAR(45) NULL,
  `postal_code` VARCHAR(45) NULL,
  `country` VARCHAR(45) NULL,
  `phone_number` VARCHAR(45) NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(64) NULL,
  `active` VARCHAR(45) NULL DEFAULT '1',
  `role_id` INT NOT NULL,
  PRIMARY KEY (`id`, `email`),
  INDEX `fk_users_roles1_idx` (`role_id` ASC),
  CONSTRAINT `fk_users_roles1`
    FOREIGN KEY (`role_id`)
    REFERENCES `roles` (`role_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `articles_rating`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `articles_rating` ;

CREATE TABLE IF NOT EXISTS `articles_rating` (
  `rating` INT NOT NULL,
  `article_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`rating`, `article_id`, `user_id`),
  INDEX `fk_articles_rating_articles_idx` (`article_id` ASC),
  INDEX `fk_articles_rating_users1_idx` (`user_id` ASC),
  CONSTRAINT `fk_articles_rating_articles`
    FOREIGN KEY (`article_id`)
    REFERENCES `articles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_articles_rating_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `orders`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `orders` ;

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` VARCHAR(32) NOT NULL,
  `quantity` INT NULL,
  `state` VARCHAR(20) NULL DEFAULT 'pending',
  `article_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`order_id`, `article_id`, `user_id`),
  INDEX `fk_orders_articles1_idx` (`article_id` ASC),
  INDEX `fk_orders_users1_idx` (`user_id` ASC),
  CONSTRAINT `fk_orders_articles1`
    FOREIGN KEY (`article_id`)
    REFERENCES `articles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_orders_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `shopping_cart`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `shopping_cart` ;

CREATE TABLE IF NOT EXISTS `shopping_cart` (
  `serial` INT NOT NULL AUTO_INCREMENT,
  `article_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`serial`, `article_id`, `user_id`),
  INDEX `fk_shopping_cart_users1_idx` (`user_id` ASC),
  CONSTRAINT `fk_shopping_cart_articles1`
    FOREIGN KEY (`article_id`)
    REFERENCES `articles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_shopping_cart_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `roles`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `roles` (`role_id`, `role_name`) VALUES (1, 'admin');
INSERT INTO `roles` (`role_id`, `role_name`) VALUES (2, 'seller');
INSERT INTO `roles` (`role_id`, `role_name`) VALUES (3, 'client');
INSERT INTO `roles` (`role_id`, `role_name`) VALUES (4, 'anonymous');

COMMIT;


-- -----------------------------------------------------
-- Data for table `users`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `users` (`id`, `first_name`, `last_name`, `street_address`, `city`, `postal_code`, `country`, `phone_number`, `email`, `password`, `active`, `role_id`) VALUES (1, 'Elon', 'Musk', NULL, NULL, NULL, NULL, NULL, 'admin@admin.si', 'f212bd60369e4bf2b09320cab3d2e8b14e13a3a5006ab20e0a39858d560a27ee', '1', 1);

COMMIT;

