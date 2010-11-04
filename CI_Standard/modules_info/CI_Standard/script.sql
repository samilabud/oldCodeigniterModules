SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;

SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;

SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';



CREATE SCHEMA IF NOT EXISTS `dbname_to_replace` ;

USE `dbname_to_replace` ;


-- -----------------------------------------------------

-- Table `dbname_to_replace`.`tipo_usuario`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `dbname_to_replace`.`tipo_usuario` ;



CREATE  TABLE IF NOT EXISTS `dbname_to_replace`.`tipo_usuario` (

  `id_tipo_usuario` INT NOT NULL AUTO_INCREMENT ,

  `descripcion` VARCHAR(135) NOT NULL ,

  PRIMARY KEY (`id_tipo_usuario`) )

ENGINE = InnoDB

COMMENT = 'Conocer el tipo de usuario';


-- -----------------------------------------------------

-- Table `dbname_to_replace`.`usuario`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `dbname_to_replace`.`usuario` ;



CREATE  TABLE IF NOT EXISTS `dbname_to_replace`.`usuario` (

  `id_usuario` INT NOT NULL AUTO_INCREMENT ,

  `id_estado` INT NOT NULL ,

  `id_tipo_usuario` INT NOT NULL ,

  `nombre_usuario` VARCHAR(45) NOT NULL ,

  `nombres` VARCHAR(100) NULL ,

  `email` VARCHAR(135) NULL ,

  `clave` VARCHAR(32) NULL ,

  `fecha_registro` DATETIME NULL ,

  PRIMARY KEY (`id_usuario`, `id_estado`, `id_tipo_usuario`) ,

  INDEX `fk_usuario_estado1` (`id_estado` ASC) ,

  INDEX `fk_usuario_tipo_usuario1` (`id_tipo_usuario` ASC) ,

  CONSTRAINT `fk_usuario_estado1`

    FOREIGN KEY (`id_estado` )

    REFERENCES `dbname_to_replace`.`estado` (`id_estado` )

    ON DELETE CASCADE

    ON UPDATE NO ACTION,

  CONSTRAINT `fk_usuario_tipo_usuario1`

    FOREIGN KEY (`id_tipo_usuario` )

    REFERENCES `dbname_to_replace`.`tipo_usuario` (`id_tipo_usuario` )

    ON DELETE CASCADE

    ON UPDATE NO ACTION)

ENGINE = InnoDB

COMMENT = 'Tabla para el acceso al administrador';


DROP TABLE IF EXISTS `dbname_to_replace`.`estado` ;

CREATE  TABLE IF NOT EXISTS `dbname_to_replace`.`estado` (

  `id_estado` INT NOT NULL AUTO_INCREMENT ,

  `descripcion` VARCHAR(135) NULL ,

  PRIMARY KEY (`id_estado`) )

ENGINE = InnoDB

COMMENT = 'estado de cualquier entidad';


SET SQL_MODE=@OLD_SQL_MODE;

SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;

SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


insert into estado (id_estado,descripcion) values (1, "Activo");
insert into estado (id_estado,descripcion) values (0, "Inactivo");

insert into tipo_usuario (descripcion) values ("administrador");

insert into usuario (id_estado, id_tipo_usuario, nombre_usuario, nombres, email, clave, fecha_registro) values (1, 1, "admin", "Samil Abud", "samilabud@gmail.com", "e10adc3949ba59abbe56e057f20f883e", now());  
