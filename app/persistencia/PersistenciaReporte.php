<?php
include_once "conexiones.php";
class PersistenciaReporte {

public function crearReporte($descripcion, $foto, $categoria, $latitud, $longitud, $id_usuario) {
    global $conn;
        $stmt = $conn->prepare("INSERT INTO reportes (Descripcion, Foto, tipo, Latitud, Longitud, id_usuario) 
        VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssi", $descripcion, $foto, $categoria, $latitud, $longitud, $id_usuario);
            return $stmt->execute() ? ['exito' => true] : ['exito' => false, 'mensaje' => 'Error al guardar'];
}   

<<<<<<< HEAD
public function ObtenerReportesPorUsuario($id_usuario) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM reportes WHERE id_usuario = ?");
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $reportes = [];
    while ($fila = $resultado->fetch_assoc()) {
        $reportes[] = $fila;
    }
    return $reportes;

}
=======
>>>>>>> 3834902e2f0249fa32f00703b801fcd06c615d22
}