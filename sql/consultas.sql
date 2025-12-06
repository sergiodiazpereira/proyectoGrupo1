CREATE TABLE usuario(
	idUsuario SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    contrasenia VARCHAR(50) NOT NULL,
    permiso CHAR(1) NOT NULL DEFAULT 'U',
    correo VARCHAR(100) NOT NULL UNIQUE,
	fecha_registro DATE DEFAULT (CURRENT_DATE)
);

CREATE TABLE tipo_asoc(
	idTipoAsoc SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(40) NOT NULL UNIQUE
);

CREATE TABLE contribucion(
	idContribucion SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    descripcion VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE asociacion(
	idAsoc SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    fecha_fun SMALLINT NOT NULL,
    pista_facil VARCHAR(120) NOT NULL,
    pista_media VARCHAR(120) NOT NULL,
    pista_dificil VARCHAR(120) NOT NULL,
    imagen VARCHAR(200) NOT NULL UNIQUE,
    idTipoAsoc SMALLINT UNSIGNED,
    alcance CHAR(1) NOT NULL CHECK (alcance IN ('I','N','L')),
    CONSTRAINT fk_tipo_asoc FOREIGN KEY (idTipoAsoc) REFERENCES tipo_asoc(idTipoAsoc)
);

CREATE TABLE asoc_contribucion (
    idAsoc SMALLINT UNSIGNED NOT NULL,
    idContribucion SMALLINT UNSIGNED NOT NULL,
    PRIMARY KEY (idAsoc, idContribucion),
    CONSTRAINT fk_ac_asoc FOREIGN KEY (idAsoc) REFERENCES asociacion(idAsoc),
    CONSTRAINT fk_ac_contri FOREIGN KEY (idContribucion) REFERENCES contribucion(idContribucion)
);

CREATE TABLE intento(
	idIntento SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    tiempo_empleado TIME NOT NULL,
    idUsuario SMALLINT UNSIGNED,
    idAsoc SMALLINT UNSIGNED,
    CONSTRAINT fk_usuario FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario) ON DELETE CASCADE,
    CONSTRAINT fk_asoc_intento FOREIGN KEY (idAsoc) REFERENCES asociacion(idAsoc) ON DELETE CASCADE
);

-- Insertar Usuarios
INSERT INTO usuario (nombre,contrasenia,permiso,correo) VALUES
("Pedro","pedro1234",DEFAULT,"pedro@gmail.com"),
("Juan","juan1234",DEFAULT,"juan@gmail.com"),
("Marta","marta1234",DEFAULT,"marta@gmail.com"),
("Aitana","aitana1234",DEFAULT,"aitana@gmail.com"),
("Kiko","kiko5678","A","kiko@gmail.com"),
("Sergio","sergio5678","A","sergio@gmail.com");

-- Insertar Tipos de Asociación
INSERT INTO tipo_asoc (nombre) VALUES
("Jóvenes"),("Discapacitados"),("Personas");

-- Insertar Contribuciones
INSERT INTO contribucion (descripcion) VALUES
("Educación"),
("Protección Infantil"),
("Inclusión"),
("Formación");

-- Insertar Asociaciones (orden corregido)
INSERT INTO asociacion (nombre, fecha_fun, pista_facil, pista_media, pista_dificil, imagen, idTipoAsoc, alcance) VALUES
("Cruz Roja", 1938, "Va dirigida a Jóvenes", "Es una asociación Nacional", "Se fundó en el año 1938", "https://www.ejemplo.com/imagenes/cruz_roja.jpg", 1, 'I'),

("Fundación Loyola", 1948, "Va dirigida a Jóvenes", "Es una asociación Internacional", "Se fundó en el año 1948", "https://www.ejemplo.com/imagenes/fundacion.jpg", 2, 'N'),

-- Insertamos 4 filas de contribuciones
INSERT INTO contribucion (descripcion) VALUES ("Salud"),
("Protección Infantil"),
("Inclusión"),
("Eduación");


-- Inserción Tabla Asociación

-- Insertamos 4 filas de asociaciones
INSERT INTO asociacion (nombre, fecha_fun, pista_facil, pista_media, pista_dificil, imagen, idTipoAsoc, alcance)
VALUES ("Cruz Roja", '1938', "Va dirigida a Jóvenes", "Es una asociación Nacional", "Se fundó en el año 1938","cruz_roja.png",1,'I');

INSERT INTO asociacion (nombre, fecha_fun, pista_facil, pista_media, pista_dificil, imagen, idTipoAsoc, alcance)
VALUES ("Fundación Loyola", '1948', "Va dirigida a Jóvenes", "Es una asociación Internacional", "Se fundó en el año 1948","fundacion_loyola.jpg",2,'N');

INSERT INTO asociacion (nombre, fecha_fun, pista_facil, pista_media, pista_dificil, imagen, idTipoAsoc, alcance)
VALUES ("Unicef", '2002',"Va dirigida a Personas", "Es una asociación Internacional","Se fundó en el año 2002","unicef.jpg",3,'N');

INSERT INTO asociacion (nombre, fecha_fun, pista_facil, pista_media, pista_dificil, imagen, idTipoAsoc, alcance)
VALUES ("Fundación Once", '2000',"Va dirigida a Discapacitados", "Es una asociación Local","Se fundó en el año 2000","fundacion_once.jpg",2,'L');

-- Relaciones Cruz Roja (1)
INSERT INTO asoc_contribucion (idAsoc, idContribucion) VALUES
(1, 1), -- Salud
(1, 2), -- Protección Infantil
(1, 4); -- Eduación

-- Relaciones Fundación Loyola (2)
INSERT INTO asoc_contribucion (idAsoc, idContribucion) VALUES
(2, 1), -- Salud
(2, 4); -- Eduación

-- Relaciones UNICEF (3)
INSERT INTO asoc_contribucion (idAsoc, idContribucion) VALUES
(3, 1), -- Salud
(3, 2), -- Protección Infantil
(3, 3); -- Inclusión

-- Relaciones Fundación Once (4)
INSERT INTO asoc_contribucion (idAsoc, idContribucion) VALUES
(4, 3), -- Inclusión
(4, 4); -- Eduación
