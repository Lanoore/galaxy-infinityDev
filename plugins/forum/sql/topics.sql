CREATE TABLE IF NOT EXISTS `mydb`.`topics` (
  `id` INT NOT NULL AUTO_INCREMENT,
  'nom' VARCHAT(255) NULL,
  `auteur` VARCHAR(70) NULL,
  `message` LONGTEXT NULL,
  `dateCreation` DATETIME NULL,
  `dateModif` DATETIME NULL,
  `idCategorie` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_topics_categorie1`
    FOREIGN KEY (`idCategorie`)
    REFERENCES `mydb`.`categorie` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB