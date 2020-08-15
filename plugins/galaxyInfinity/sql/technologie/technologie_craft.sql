CREATE TABLE IF NOT EXISTS `mybd`.`technologie_craft` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `technologie_id` INT NOT NULL,
  `niveau_id` INT NOT NULL,
  `craft_id` INT NOT NULL,
  `nombre_craft` INT NULL,
  `items_id` INT NOT NULL,
  `nombre_items` INT NULL,
  PRIMARY KEY (`id`),

  CONSTRAINT `fk_technologie_craft_craft1`
    FOREIGN KEY (`craft_id`)
    REFERENCES `galaxy-infinity`.`craft` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_technologie_craft_technologie1`
    FOREIGN KEY (`technologie_id`)
    REFERENCES `galaxy-infinity`.`technologie` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_technologie_craft_items1`
    FOREIGN KEY (`items_id`)
    REFERENCES `galaxy-infinity`.`items` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_technologie_craft_niveau1`
    FOREIGN KEY (`niveau_id`)
    REFERENCES `galaxy-infinity`.`niveau` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB