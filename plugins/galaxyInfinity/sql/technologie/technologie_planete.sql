CREATE TABLE IF NOT EXISTS `mybd`.`technologie_planete` (
  `niveau` INT NULL,
  `planete_id` INT NOT NULL,
  `technologie_id` INT NOT NULL,
  PRIMARY KEY (`planete_id`, `technologie_id`),

  CONSTRAINT `fk_technologie_planete_technologie1`
    FOREIGN KEY (`technologie_id`)
    REFERENCES `galaxy-infinity`.`technologie` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_technologie_planete_planete1`
    FOREIGN KEY (`planete_id`)
    REFERENCES `galaxy-infinity`.`planete` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB