-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema estacionamento
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema estacionamento
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `estacionamento` DEFAULT CHARACTER SET utf8 ;
USE `estacionamento` ;

-- -----------------------------------------------------
-- Table `estacionamento`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estacionamento`.`usuarios` (
  `PK_Usuario` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `Nome` VARCHAR(200) NOT NULL,
  `Sobrenome` VARCHAR(200) NOT NULL,
  `CPF` CHAR(11) NOT NULL,
  `Login` VARCHAR(200) NOT NULL UNIQUE,
  `Senha` VARCHAR(200) NOT NULL,
  `Data_Criacao` DATETIME NOT NULL,
  `Tipo` ENUM('Adm', 'Fun') NOT NULL,
  PRIMARY KEY (`PK_Usuario`)
)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `estacionamento`.`registros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estacionamento`.`registros` (
  `PK_Registro` INT NOT NULL AUTO_INCREMENT,
  `FK_Usuario` INT UNSIGNED NOT NULL,
  `Nome` VARCHAR(200) NOT NULL,
  `Telefone` CHAR(11) NOT NULL,
  `Placa` CHAR(7) NOT NULL,
  `Data` DATE NOT NULL,
  `Horario_ent` TIME NOT NULL,
  `Horario_saida` TIME NULL,
  `Valor_pago` FLOAT NULL,
  PRIMARY KEY (`PK_Registro`),
  CONSTRAINT `Usuario_Registro`
    FOREIGN KEY (`FK_Usuario`)
    REFERENCES `estacionamento`.`usuarios` (`PK_Usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)

ENGINE = InnoDB;

insert into usuarios values
(default, 'Violett', 'Vohor', '11122233396', 'teste', 
'b123e9e19d217169b981a61188920f9d28638709a5132201684d792b9264271b7f09157ed4321b1c097f7a4abecfc0977d40a7ee599c845883bd1074ca23c4af',
'2023-03-23',
'Adm');

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;