CREATE TABLE IF NOT EXISTS `mybd`.`craft_planete` (
  `nombre_craft` INT NULL,
  `planete_id` INT NOT NULL,
  `craft_id` INT NOT NULL,
  PRIMARY KEY (`planete_id`, `craft_id`),

  CONSTRAINT `fk_craft_planete_planete1`
    FOREIGN KEY (`planete_id`)
    REFERENCES `galaxy-infinity`.`planete` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_craft_planete_craft1`
    FOREIGN KEY (`craft_id`)
    REFERENCES `galaxy-infinity`.`craft` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB