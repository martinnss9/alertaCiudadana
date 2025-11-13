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

}