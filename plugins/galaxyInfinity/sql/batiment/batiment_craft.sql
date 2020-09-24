CREATE TABLE IF NOT EXISTS `mydb`.`batiment_craft` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `batiment_id` INT NOT NULL,
  `niveau_id` INT NOT NULL,
  `craft_id` INT NOT NULL,
  `nombre_craft` INT NULL,
  `items_id` INT NOT NULL,
  `nombre_items` INT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_batiment_craft_batiment1`
    FOREIGN KEY (`batiment_id`)
    REFERENCES `galaxy-infinity`.`batiment` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_batiment_craft_craft1`
    FOREIGN KEY (`craft_id`)
    REFERENCES `galaxy-infinity`.`craft` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_batiment_craft_items1`
    FOREIGN KEY (`items_id`)
    REFERENCES `galaxy-infinity`.`items` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_batiment_craft_niveau1`
    FOREIGN KEY (`niveau_id`)
    REFERENCES `galaxy-infinity`.`niveau` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB