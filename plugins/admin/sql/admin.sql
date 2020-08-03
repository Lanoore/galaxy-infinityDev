CREATE TABLE IF NOT EXISTS `mydb`.`admin` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `identifiant` VARCHAR(70) NULL,
  `password` LONGTEXT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB