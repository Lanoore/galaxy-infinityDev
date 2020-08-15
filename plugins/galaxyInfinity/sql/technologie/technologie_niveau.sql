CREATE TABLE IF NOT EXISTS `mybd`.`technologie_niveau` (
  `technologie_id` INT NOT NULL,
  `niveau_id` INT NOT NULL,
  `temps_construction` INT NULL,
  PRIMARY KEY (`technologie_id`, `niveau_id`),

  CONSTRAINT `fk_technologie_niveau_technologie1`
    FOREIGN KEY (`technologie_id`)
    REFERENCES `galaxy-infinity`.`technologie` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_technologie_niveau_niveau1`
    FOREIGN KEY (`niveau_id`)
    REFERENCES `galaxy-infinity`.`niveau` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB