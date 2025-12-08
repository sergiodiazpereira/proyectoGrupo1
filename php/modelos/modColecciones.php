<?php
require_once __DIR__ . '/../config/conexion.php';

class ModColecciones extends Conexion {

    public function __construct() {
        parent::__construct();
    }

    public function obtenerColeccionUsuario($idUsuario) {
        // SQL SENCILLO:
        // Seleccionamos los datos de la asociación
        // Y seleccionamos el 'idIntento' de la tabla intento.
        // Si el usuario no la ha adivinado, 'idIntento' vendrá VACÍO (NULL).
        $sql = "SELECT a.idAsoc, a.nombre, a.imagen, a.alcance, a.fecha_fun, t.nombre as nombre_tipo, i.idIntento
                FROM asociacion a
                INNER JOIN tipo_asoc t ON a.idTipoAsoc = t.idTipoAsoc
                -- LEFT JOIN: Busca si existe un intento para este usuario.
                LEFT JOIN intento i ON a.idAsoc = i.idAsoc AND i.idUsuario = :idUsuario
                ORDER BY a.nombre ASC";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>