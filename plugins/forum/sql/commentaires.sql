CREATE TABLE IF NOT EXISTS `mydb`.`commentaires` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `auteur` VARCHAR(70) NULL,
  `message` LONGTEXT NULL,
  `dateCreation` DATETIME NULL,
  `dateModif` DATETIME NULL,
  `idTopic` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_commentaires_topics1`
    FOREIGN KEY (`idTopic`)
    REFERENCES `mydb`.`topics` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB