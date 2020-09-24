CREATE TABLE IF NOT EXISTS `mybd`.`craft_craft` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `craft_id` INT NOT NULL,
  `ressource_id` INT NOT NULL,
  `nombre_ressource` INT NULL,
  `craft_id_travail` INT NOT NULL,
  `nombre_craft_travail` INT NULL,
  PRIMARY KEY (`id`),

  CONSTRAINT `fk_craft_craft_craft1`
    FOREIGN KEY (`craft_id`)
    REFERENCES `galaxy-infinity`.`craft` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_craft_craft_ressource1`
    FOREIGN KEY (`ressource_id`)
    REFERENCES `galaxy-infinity`.`ressource` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_craft_craft_craft2`
    FOREIGN KEY (`craft_id_travail`)
    REFERENCES `galaxy-infinity`.`craft` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB