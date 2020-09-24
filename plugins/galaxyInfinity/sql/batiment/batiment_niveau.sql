CREATE TABLE IF NOT EXISTS `mybd`.`batiment_niveau` (
  `batiment_id` INT NOT NULL,
  `niveau_id` INT NOT NULL,
  `temps_construction` INT NULL,
  PRIMARY KEY (`batiment_id`, `niveau_id`),

  CONSTRAINT `fk_batiment_has_niveau_batiment1`
    FOREIGN KEY (`batiment_id`)
    REFERENCES `galaxy-infinity`.`batiment` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_batiment_has_niveau_niveau1`
    FOREIGN KEY (`niveau_id`)
    REFERENCES `galaxy-infinity`.`niveau` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB