<?php
require_once __DIR__ . '/../config/conexion.php';

class ModColecciones extends Conexion {

    public function __construct() {
        parent::__construct();
    }
    /**
     * Summary of obtenerColeccionUsuario
     * @param mixed $idUsuario es el id del usuario conectado
     * @return array me devuelve un array con las colecciones para saber la que ha acertado
     */
    public function obtenerColeccionUsuario($idUsuario) {
        $sql = "SELECT a.idAsoc, a.nombre, a.imagen, a.alcance, a.fecha_fun, t.nombre as nombre_tipo, MAX(i.idIntento) as idIntento
                FROM asociacion a
                INNER JOIN tipo_asoc t ON a.idTipoAsoc = t.idTipoAsoc
                LEFT JOIN intento i ON a.idAsoc = i.idAsoc AND i.idUsuario = :idUsuario
                GROUP BY a.idAsoc
                ORDER BY a.nombre ASC";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>