CREATE TABLE usuario(
	idUsuario SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    contrasenia VARCHAR(60) NOT NULL,
    permiso CHAR(1) NOT NULL DEFAULT 'U',
    correo VARCHAR(100) NOT NULL UNIQUE,
	fecha_registro DATE DEFAULT (CURRENT_DATE),
    visitas INT UNSIGNED DEFAULT '0'
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
    fecha_intento DATE DEFAULT (CURRENT_DATE),
    tiempo_empleado TIME NOT NULL,
    idUsuario SMALLINT UNSIGNED,
    idAsoc SMALLINT UNSIGNED,
    CONSTRAINT fk_usuario FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario) ON DELETE CASCADE,
    CONSTRAINT fk_asoc_intento FOREIGN KEY (idAsoc) REFERENCES asociacion(idAsoc) ON DELETE CASCADE
);

CREATE TABLE galeria(
    idImagen SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombreImagen VARCHAR(20),
    idAsoc SMALLINT UNSIGNED DEFAULT NULL,
    CONSTRAINT fk_idAsoc FOREIGN KEY (idAsoc) REFERENCES asociacion(idAsoc) ON DELETE SET NULL, -- Si se borra la asociacion, la imagen queda disponible para asignar pero no se borra
    CONSTRAINT unique_nombreImagen UNIQUE (nombreImagen)
);