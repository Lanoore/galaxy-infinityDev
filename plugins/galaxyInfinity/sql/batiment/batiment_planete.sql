CREATE TABLE IF NOT EXISTS `mybd`.`batiment_planete` (
  `niveau` INT NULL,
  `planete_id` INT NOT NULL,
  `batiment_id` INT NOT NULL,
  PRIMARY KEY (`planete_id`, `batiment_id`),

  CONSTRAINT `fk_batiment_planete_planete1`
    FOREIGN KEY (`planete_id`)
    REFERENCES `galaxy-infinity`.`planete` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_batiment_planete_batiment1`
    FOREIGN KEY (`batiment_id`)
    REFERENCES `galaxy-infinity`.`batiment` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB