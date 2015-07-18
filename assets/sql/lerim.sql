DROP DATABASE IF EXISTS lerim;

CREATE DATABASE lerim;

USE lerim;

CREATE TABLE usuarios
(
	`id_usuario` INT NOT NULL AUTO_INCREMENT,
	`usuario` VARCHAR(20) NOT NULL,
	`password` VARCHAR(40) NOT NULL,
	PRIMARY KEY (`id_usuario`),
	UNIQUE INDEX `usuario_UNIQUE` (`usuario` ASC)
);

CREATE TABLE clientes
(
	`id_cliente` INT NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(200) NOT NULL,
	`representante` VARCHAR(100) NOT NULL,
	`telefono` VARCHAR(10) NOT NULL,
	`direccion` VARCHAR(100) NOT NULL,
	`RFC` VARCHAR(12) NOT NULL,
	PRIMARY KEY (`id_cliente`),
	UNIQUE INDEX `rfc_UNIQUE` (`RFC` ASC)
);

CREATE TABLE tipos_muestras
(
	`id_tipo_muestra` INT NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(50) NOT NULL,
	PRIMARY KEY (`id_tipo_muestra`)
);

CREATE TABLE tipos_analisis
(
	`id_tipo_analisis` INT NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(1) NOT NULL,
	`tipos_muestras` INT NOT NULL,
	`descripcion` VARCHAR(200) NULL,
	`medida` VARCHAR(50) NOT NULL,
	PRIMARY KEY (`id_tipo_analisis`),
	CONSTRAINT `fk_tipoanalisis_tipomuestra`
    	FOREIGN KEY (`tipos_muestras`)
    	REFERENCES `tipos_muestras` (`id_tipo_muestra` )
    	ON DELETE NO ACTION
    	ON UPDATE CASCADE
);

CREATE TABLE muestras
(
	`id_muestra` INT NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(100) NOT NULL,
	`tipo` INT NOT NULL,
	`hora` TIME NOT NULL,
	`fecha` DATE NOT NULL,
	`cliente` INT NOT NULL,
	PRIMARY KEY (`id_muestra`),
	CONSTRAINT `fk_clientes_muestras`
    	FOREIGN KEY (`cliente`)
    	REFERENCES `clientes` (`id_cliente` )
    	ON DELETE NO ACTION
    	ON UPDATE CASCADE,
    CONSTRAINT `fk_tipo_tipos_muestras`
    	FOREIGN KEY (`tipo`)
    	REFERENCES `tipos_muestras` (`id_tipo_muestra` )
    	ON DELETE NO ACTION
    	ON UPDATE CASCADE
);

CREATE TABLE analisis
(
	`tipo` INT NOT NULL,
	`muestra` INT NOT NULL,
	`resultado` VARCHAR(100) NOT NULL DEFAULT "",
	PRIMARY KEY (`tipo`, `muestra`),
	CONSTRAINT `fk_analisis_tipo_analisis`
    	FOREIGN KEY (`tipo`)
    	REFERENCES `tipos_analisis` (`id_tipo_analisis` )
    	ON DELETE NO ACTION
    	ON UPDATE CASCADE,
    CONSTRAINT `fk_analisis_muestras`
    	FOREIGN KEY (`muestra`)
    	REFERENCES `muestras` (`id_muestra` )
    	ON DELETE NO ACTION
    	ON UPDATE CASCADE

);


INSERT INTO `tipos_muestras` VALUES(NULL, "AGUA");
INSERT INTO `tipos_muestras` VALUES(NULL, "ALIMENTOS");
INSERT INTO `tipos_analisis` VALUES(NULL,"a",1,"Recuento de bacterias mesofilicas","UFC/mL");
INSERT INTO `tipos_analisis` VALUES(NULL,"b",1,"Numero Probable","NMP/100 mL");
INSERT INTO `tipos_analisis` VALUES(NULL,"a",2,"Recuento ALIMENTOS","NMP/100 mL");
INSERT INTO `tipos_analisis` VALUES(NULL,"b",2,"stapylos","NMP/100 mL");
INSERT INTO `tipos_analisis` VALUES(NULL,"c",2,"otro","NMP/100 mL");
INSERT INTO `usuarios` VALUES(NULL,"admin",SHA("admin"));
INSERT INTO `clientes` VALUES(NULL,"Empresa","Luis Polanco", "2221773973", "Su casa", "POBL901216UN6");
INSERT INTO `clientes` VALUES(NULL,"Empresa1","Luis Conde", "2224756890", "Tambien en su casa", "CORL941216UN6");
INSERT INTO `muestras` VALUES(NULL,"agua de sandia", 2,CURTIME(),CURDATE(), 1);
INSERT INTO `muestras` VALUES(NULL,"agua de contenedor", 1,CURTIME(),CURDATE(), 1);