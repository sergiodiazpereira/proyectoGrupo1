-- Script SQL Asociaciondle

-- Tabla Usuario
CREATE TABLE usuario(
	idUsuario smallint unsigned PRIMARY KEY AUTO_INCREMENT,
    nombre varchar(50) NOT NULL,
    contrasenia varchar(50) NOT NULL,
    permiso char(1) NOT NULL DEFAULT 'U',
    correo varchar(100) NOT NULL UNIQUE,
	fecha_registro date NOT NULL
);

-- Tabla Tipo-Asoc
CREATE TABLE tipo_asoc(
	idTipoAsoc smallint unsigned PRIMARY KEY AUTO_INCREMENT,
    nombre varchar(40) NOT NULL UNIQUE
);

-- Tabla Contribucion
CREATE TABLE contribucion(
	idContribucion smallint unsigned PRIMARY KEY AUTO_INCREMENT,
    descripcion varchar(100) NOT NULL UNIQUE
);

-- Tabla Asociacion
CREATE TABLE asociacion(
	idAsoc smallint unsigned PRIMARY KEY AUTO_INCREMENT,
    nombre varchar(50) NOT NULL UNIQUE,
    fecha_fun date NOT NULL,
    pista_facil varchar(120) NOT NULL,
    pista_media varchar(120) NOT NULL,
    pista_dificil varchar(120) NOT NULL,
    imagen varchar(200) NOT NULL,
    idTipoAsoc smallint unsigned,
    alcance char(1) NOT NULL CHECK (alcance IN ('I','N','L')),
    CONSTRAINT fk_tipo_asoc FOREIGN KEY (idTipoAsoc) REFERENCES tipo_asoc(idTipoAsoc)
);

-- Tabla Asoc-Contribucion
CREATE TABLE asoc_contribucion (
    idAsoc smallint unsigned NOT NULL,
    idContribucion smallint unsigned NOT NULL,
    PRIMARY KEY (idAsoc, idContribucion),
    CONSTRAINT fk_ac_asoc FOREIGN KEY (idAsoc) REFERENCES asociacion(idAsoc),
    CONSTRAINT fk_ac_contri FOREIGN KEY (idContribucion) REFERENCES contribucion(idContribucion)
);

-- Tabla Intento
CREATE TABLE intento(
	idIntento smallint unsigned PRIMARY KEY AUTO_INCREMENT,
    tiempo_empleado time NOT NULL,
    idUsuario smallint unsigned,
    idAsoc smallint unsigned,
    CONSTRAINT fk_usuario FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario) ON DELETE CASCADE,
    CONSTRAINT fk_asoc_intento FOREIGN KEY (idAsoc) REFERENCES asociacion(idAsoc) ON DELETE CASCADE
);

-- Inserciones de prueba en las tablas --

-- Inserción Tabla Usuario

-- Insertamos 4 filas de usuarios
INSERT INTO usuario (nombre,contrasenia,permiso,correo) VALUES ("Pedro","pedro1234",DEFAULT,"pedro@gmail.com"),
("Juan","juan1234",DEFAULT,"juan@gmail.com"),
("Marta","marta1234",DEFAULT,"marta@gmail.com"),
("Aitana","aitana1234",DEFAULT,"aitana@gmail.com")

-- Insertamos 2 filas de administrador
INSERT INTO usuario (nombre,contrasenia,permiso,correo) VALUES ("Kiko","kiko5678","A","kiko@gmail.com"),
("Sergio","sergio5678","A","sergio@gmail.com")


-- Inserción Tabla Tipo-Asoc

-- Insertamos 3 filas de los tipos (Jóvenes, Discapacitados y Personas)
INSERT INTO tipo_asoc (nombre) VALUES ("Jóvenes"),
("Discapacitados"),
("Personas")

-- Inserción Tabla Contribución

-- Insertamos 4 filas de contribuciones
INSERT INTO contribucion (descripcion) VALUES ("Eduación, Salud"),
("Eduación, Protección Infantil, Salud"),
("Inclusión, Autonomía"),
("Eduación, Formación")


-- Inserción Tabla Asociación

-- Insertamos 4 filas de asociaciones
INSERT INTO asociacion (nombre, fecha_fun, pista_dificil, pista_media, pista_facil, imagen, idTipoAsoc, alcance)
VALUES ("Cruz Roja", '1938-11-27',"Se fundó en el año 1938", "Es una asociación Nacional", "Va dirigida a Jóvenes","https://www.ejemplo.com/imagenes/cruz_roja.jpg",1,'I');

INSERT INTO asociacion (nombre, fecha_fun, pista_dificil, pista_media, pista_facil, imagen, idTipoAsoc, idAlcance)
VALUES ("Fundación Loyola", '1948-11-27',"Se fundó en el año 1948", "Es una asociación Internacional", "Va dirigida a Jóvenes","https://www.ejemplo.com/imagenes/fundacion.jpg",2,'N');

INSERT INTO asociacion (nombre, fecha_fun, pista_dificil, pista_media, pista_facil, imagen, idTipoAsoc, idAlcance)
VALUES ("Unicef", '2002-08-10',"Se fundó en el año 2002", "Es una asociación Internacional", "Va dirigida a Personas","https://www.ejemplo.com/imagenes/unicef.jpg",3,'N');

INSERT INTO asociacion (nombre, fecha_fun, pista_dificil, pista_media, pista_facil, imagen, idTipoAsoc, idAlcance)
VALUES ("Fundación Once", '2000-10-14',"Se fundó en el año 2000", "Es una asociación Local", "Va dirigida a Discapacitados","https://www.ejemplo.com/imagenes/fundacion_once.jpg",2,'L');