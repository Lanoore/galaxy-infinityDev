CREATE TABLE IF NOT EXISTS `mydb`.`user` (/*Changer mydb par le nom de votre base de données*/
  `id` INT NOT NULL AUTO_INCREMENT,
  `pseudo` VARCHAR(70) NULL,
  `email` VARCHAR(70) NULL,
  `pswoasrd` LONGTEXT NULL,
  `lastConnexion` DATETIME NULL,
  `dateInscription` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB