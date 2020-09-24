CREATE TABLE IF NOT EXISTS `mybd`.`items_planete` (
  `nombre_items` INT NULL,
  `planete_id` INT NOT NULL,
  `items_id` INT NOT NULL,
  PRIMARY KEY (`planete_id`, `items_id`),

  CONSTRAINT `fk_items_planete_planete1`
    FOREIGN KEY (`planete_id`)
    REFERENCES `galaxy-infinity`.`planete` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_items_planete_items1`
    FOREIGN KEY (`items_id`)
    REFERENCES `galaxy-infinity`.`items` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB