<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../persistencia/PersistenciaReporte.php';


class ServicioReporte {

    private $persistencia;

    public function __construct() {
        $this->persistencia = new PersistenciaReporte();
    }

    // Crear un reporte nuevo
    public function crearReporte($descripcion, $foto, $categoria, $latitud, $longitud, $id_usuario) {
        return $this->persistencia->crearReporte(
            $descripcion,
            $foto,
            $categoria,
            $latitud,
            $longitud,
            $id_usuario
        );
    }

    // Obtener reportes del usuario logueado
    public function obtenerReportesUsuario($id_usuario) {
        return $this->persistencia->ObtenerReportesPorUsuario($id_usuario);
    }
}
// Manejo de la solicitud POST para crear un reporte
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_SESSION['id_usuario'])) {
        echo "No hay sesion activa.";
        exit;
    }

    $servicio = new ServicioReporte();

    $descripcion = $_POST['descripcion'];
    $categoria   = $_POST['categoria'];
    $latitud     = $_POST['lat'];
    $longitud    = $_POST['lng'];
    $id_usuario  = $_SESSION['id_usuario'];

    // FOTO
    $foto_nombre = "";
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $foto_nombre = time() . "_" . basename($_FILES['foto']['name']);
        $ruta_destino = "../uploads/" . $foto_nombre;

        if (!file_exists("../uploads")) {
            mkdir("../uploads", 0777, true);
        }

        move_uploaded_file($_FILES['foto']['tmp_name'], $ruta_destino);
    }

    
    $resultado = $servicio->crearReporte(
        $descripcion,
        $foto_nombre,
        $categoria,
        $latitud,
        $longitud,
        $id_usuario
    );

    if ($resultado['exito']) {
        echo "Reporte creado con exito.";
    } else {
        echo "Error al crear el reporte: " . $resultado['mensaje'];
    }

    exit;
}

?>