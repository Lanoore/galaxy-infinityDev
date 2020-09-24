CREATE TABLE IF NOT EXISTS `mybd`.`technologie` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(100) NULL,
  `description` LONGTEXT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB