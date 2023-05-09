CREATE SCHEMA IF NOT EXISTS `shop_mobile` DEFAULT CHARACTER SET utf8 ;
USE `shop_mobile` ;

-- -----------------------------------------------------
-- Table `shop_mobile`.`product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shop_mobile`.`product` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `uid` INT NOT NULL,
  `name` VARCHAR(150) NOT NULL,
  `price` DECIMAL(13,0) NULL DEFAULT NULL,
  `property` TEXT NULL DEFAULT NULL,
  `url` VARCHAR(200) NULL DEFAULT NULL,

  PRIMARY KEY (`id`),
  INDEX (`name`),
  INDEX (`price`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `shop_mobile`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shop_mobile`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `phone` VARCHAR(11) NOT NULL,
  `email` VARCHAR(50) NULL DEFAULT NULL,
  `password` VARCHAR(30) NULL DEFAULT NULL,
  `role` VARCHAR(15) NULL DEFAULT NULL,

  PRIMARY KEY (`id`),
  INDEX (`phone`),
  INDEX (`password`),
  INDEX (`role`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `shop_mobile`.`basket`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shop_mobile`.`basket` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `oid` INT NOT NULL,
  `uid` INT NOT NULL,
  `pid` INT NOT NULL,
  `quantity` INT DEFAULT 1,
  `state` enum('active', 'noactive', '', ''),

  PRIMARY KEY (`id`),
  INDEX (`oid`),
  INDEX (`uid`),
  INDEX (`pid`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `shop_mobile`.`orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shop_mobile`.`orders` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `address` TEXT NOT NULL,
  `plaque` VARCHAR(5) NOT NULL,
  `unit` VARCHAR(2) DEFAULT 1,
  `postalCode` VARCHAR(10) NOT NULL,
  `full_name` VARCHAR(100) NOT NULL,
  `phone` VARCHAR(11) NOT NULL,
  `data` date NOT NULL,
  `state` VARCHAR(10) DEFAULT 1,

  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;



-- -----------------------------------------------------
-- Table `shop_mobile`.`comments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shop_mobile`.`comments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `uid` INT NOT NULL,
  `prid` NULL,
  `pid` INT NOT NULL,
  `message` text,
  `state` enum('active', 'noactive', '', ''),

  PRIMARY KEY (`id`),
  INDEX (`uid`),
  INDEX (`prid`),
  INDEX (`pid`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;