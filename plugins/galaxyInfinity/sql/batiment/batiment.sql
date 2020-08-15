CREATE TABLE IF NOT EXISTS `mybd`.`batiment` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(100) NULL,
  `description` LONGTEXT NULL,
  `tier` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB