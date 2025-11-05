<?php
include_once "conexiones.php"; 

class PersistenciaUsuario {
    public function IngresarUsuario($gmail, $password) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE gmail = ? AND contrasela = ?");
        $stmt->bind_param("ss", $gmail, $password);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            return $resultado->fetch_assoc();
        } else {
            return null;
        }
    }             
}
