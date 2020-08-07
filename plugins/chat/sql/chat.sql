CREATE TABLE IF NOT EXISTS `mydb`.`chat` ( /*Changer mydb par le nom de votre base de données*/
  `id` INT NOT NULL AUTO_INCREMENT,
  `idUser` INT NOT NULL,
  `message` LONGTEXT NULL,
  `dateMessage` DATETIME NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_chat_user`
    FOREIGN KEY (`idUser`)
    REFERENCES `mydb`.`user` (`id`) /*Changer mydb par le nom de votre base de données*/
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB