CREATE TABLE IF NOT EXISTS `mybd`.`ressource_planete` (
  `ressource_id` INT NOT NULL,
  `planete_id` INT NOT NULL,
  `nombre_ressource` INT NULL,
  PRIMARY KEY (`ressource_id`, `planete_id`),

  CONSTRAINT `fk_ressource_planete_ressource1`
    FOREIGN KEY (`ressource_id`)
    REFERENCES `galaxy-infinity`.`ressource` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ressource_planete_planete1`
    FOREIGN KEY (`planete_id`)
    REFERENCES `galaxy-infinity`.`planete` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB