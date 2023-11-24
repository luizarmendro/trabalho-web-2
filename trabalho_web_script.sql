CREATE SCHEMA IF NOT EXISTS `trab_web2` DEFAULT CHARACTER SET utf8 ;
USE `trab_web2` ;

-- -----------------------------------------------------
-- Table `trab_web2`.`USR_LOGIN`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `trab_web2`.`USR_LOGIN` (
  `USR_LOGIN_ID` INT NOT NULL AUTO_INCREMENT,
  `USR_LOGIN_NOME` VARCHAR(45) NOT NULL,
  `SENHA` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`USR_LOGIN_ID`))
ENGINE = InnoDB;
-- -----------------------------------------------------
-- Table `mydb`.`PESSOAS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `trab_web2`.`PESSOAS` (
  `NOME` VARCHAR(45) NOT NULL,
  `CPF` VARCHAR(45) NOT NULL,
  `EMAIL` VARCHAR(45) NULL,
  `CARGO` VARCHAR(45) NULL,
  `HABILIDADE` VARCHAR(45) NULL,
  PRIMARY KEY (`CPF`))
ENGINE = InnoDB;

SELECT * FROM USR_LOGIN
SELECT * FROM PESSOAS
