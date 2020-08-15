CREATE TABLE IF NOT EXISTS `mybd`.`craft` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(100) NULL,
  `description` LONGTEXT NULL,
  `tier` INT NULL,
  `temps_base` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB