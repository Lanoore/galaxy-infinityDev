CREATE TABLE IF NOT EXISTS `mybd`.`planete` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `systeme` INT NULL,
  `position` INT NULL,
  `situation` INT NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),

  CONSTRAINT `fk_planete_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `galaxy-infinity`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB