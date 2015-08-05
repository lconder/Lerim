DROP DATABASE IF EXISTS lerim;

CREATE DATABASE lerim;

USE lerim;

CREATE TABLE usuarios
(
	`id_usuario` INT NOT NULL AUTO_INCREMENT,
	`usuario` VARCHAR(20) NOT NULL,
	`password` VARCHAR(40) NOT NULL,
	`nivel` INT NOT NULL,
	PRIMARY KEY (`id_usuario`),
	UNIQUE INDEX `usuario_UNIQUE` (`usuario` ASC)
);

CREATE TABLE clientes
(
	`id_cliente` INT NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(200) NOT NULL,
	`representante` VARCHAR(100) NOT NULL,
	`telefono` VARCHAR(10) NOT NULL,
	`email` VARCHAR(50) NOT NULL DEFAULT "",
	`direccion` VARCHAR(100) NOT NULL,
	`RFC` VARCHAR(12) NOT NULL,
	PRIMARY KEY (`id_cliente`),
	UNIQUE INDEX `rfc_UNIQUE` (`RFC` ASC)
);

CREATE TABLE tipos_muestras
(
	`id_tipo_muestra` INT NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(50) NOT NULL,
	`nativo` INT NOT NULL,
	PRIMARY KEY (`id_tipo_muestra`)
);

CREATE TABLE tipos_analisis
(
	`id_tipo_analisis` INT NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(1) NOT NULL,
	`tipos_muestras` INT NOT NULL,
	`descripcion` VARCHAR(200) NULL,
	`medida` VARCHAR(50) NOT NULL,
	`nativo` INT NOT NULL,
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
	`referencia` VARCHAR(200) NOT NULL DEFAULT "",
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


INSERT INTO `tipos_muestras` VALUES(NULL, "Agua",1);
INSERT INTO `tipos_muestras` VALUES(NULL, "Alimentos",1);
INSERT INTO `tipos_muestras` VALUES(NULL, "Superficies Inertes",1);
INSERT INTO `tipos_muestras` VALUES(NULL, "Manos",1);

INSERT INTO `tipos_analisis` VALUES(NULL,"a",1,"Recuento de bacterias mesofílicas aerobias en placas con agar cuenta estándar, incubadas a 35ºC/24 h.","UFC/mL",1);
INSERT INTO `tipos_analisis` VALUES(NULL,"b",1,"Número más probable de bacterias coliformes totales, realizando prueba presuntiva en tubos con caldo lactosado y prueba confirmatoria en tubos con caldo lactosa bilis verde brillante, incubados a 35ºC hasta por 48 h, respectivamente.","NMP/100 mL",1);

INSERT INTO `tipos_analisis` VALUES(NULL,"a",2,"Recuento de bacterias mesofílicas aerobias en placas con agar cuenta estándar, incubadas a 35ºC/48 h.","NMP/100 mL",1);
INSERT INTO `tipos_analisis` VALUES(NULL,"b",2,"Recuento de bacterias coliformes totales en placas con agar rojo violeta bilis, incubadas a 35ºC/24 h.","NMP/100 mL",1);
INSERT INTO `tipos_analisis` VALUES(NULL,"c",2,"Recuento de bacterias ácido lácticas en placas con agar polisorbato triptona (APT), incubadas a 30ºC/48 h.","NMP/100 mL",1);
INSERT INTO `tipos_analisis` VALUES(NULL,"d",2,"Recuento de Staphylococcus aureus en placas con agar Baird – Parker, incubadas a 35°C/48 h y realizando pruebas de coagulasa y termonucleasa.","NMP/100 mL",1);
INSERT INTO `tipos_analisis` VALUES(NULL,"e",2,"Número más probable de bacterias coliformes fecales, realizando prueba presuntiva y prueba confirmatoria a 35 y 44.5ºC por 48 y 24 h de incubación, respectivamente.","NMP/100 mL",1);
INSERT INTO `tipos_analisis` VALUES(NULL,"f",2,"Número más probable de Escherichia coli, realizando prueba presuntiva y prueba confirmatoria a 35 y 44.5ºC por 48 y 24 h de incubación, respectivamente.","NMP/100 mL",1);
INSERT INTO `tipos_analisis` VALUES(NULL,"g",2,"Investigación de Salmonella spp en 25 g de muestra, realizando pre enriquecimiento, enriquecimiento, aislamiento, identificación bioquímica y confirmación serológica.","NMP/100 mL",1);
INSERT INTO `tipos_analisis` VALUES(NULL,"h",2,"Investigación de Vibrio cholerae O1 y O139 en 50 g de muestra, realizando  enriquecimiento, aislamiento, identificación bioquímica y confirmación serológica.","NMP/100 mL",1);
INSERT INTO `tipos_analisis` VALUES(NULL,"i",2,"Investigación de Vibrio parahaemolyticus realizando enriquecimiento, aislamiento, identificación bioquímica y confirmación serológica.","NMP/100 mL",1);

INSERT INTO `tipos_analisis` VALUES(NULL,"a",3,"Recuento de bacterias mesofílicas aerobias en placas con agar cuenta estándar, incubadas a 35ºC/48 h.","NMP/100 mL",1);
INSERT INTO `tipos_analisis` VALUES(NULL,"b",3,"Recuento de bacterias coliformes totales en placas con agar rojo violeta bilis, incubadas a 35ºC/24 h.","NMP/100 mL",1);
INSERT INTO `tipos_analisis` VALUES(NULL,"c",3,"Recuento de Staphylococcus aureus en placas con agar Baird – Parker, incubadas a 35°C/48 h y realizando pruebas de coagulasa y termonucleasa.","NMP/100 mL",1);

INSERT INTO `tipos_analisis` VALUES(NULL,"a",4,"Recuento de bacterias mesofílicas aerobias en placas con agar cuenta estándar, incubadas a 35ºC/48 h.","NMP/100 mL",1);
INSERT INTO `tipos_analisis` VALUES(NULL,"b",4,"Recuento de bacterias coliformes totales en placas con agar rojo violeta bilis, incubadas a 35ºC/24 h.","NMP/100 mL",1);
INSERT INTO `tipos_analisis` VALUES(NULL,"c",4,"Recuento de Staphylococcus aureus en placas con agar Baird – Parker, incubadas a 35°C/48 h y realizando pruebas de coagulasa y termonucleasa.","NMP/100 mL",1);

INSERT INTO `usuarios` VALUES(NULL,"admin",SHA("admin"),1);
INSERT INTO `clientes` VALUES(NULL,"Empresa","Luis Polanco", "2221773973","", "Su casa", "POBL901216UN6");
INSERT INTO `clientes` VALUES(NULL,"Empresa1","Luis Conde", "2224756890", "","Tambien en su casa", "CORL941216UN6");
INSERT INTO `muestras` VALUES(NULL,"agua de sandia", 2,CURTIME(),CURDATE(), 1);
INSERT INTO `muestras` VALUES(NULL,"agua de contenedor", 1,CURTIME(),CURDATE(), 1);

