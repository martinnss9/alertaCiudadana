<?php
include_once "conexiones.php"; 

class PersistenciaUsuario {
    public function obtenerUsuarioPorCredenciales($gmail, $password) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE gmail = ? AND contrasela = ?");
        $stmt->bind_param("ss", $gmail, $password);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            return $resultado->fetch_assoc();
        } else {
            return null;
        }
    }
    public function RegistrarUsuario($nombre, $gmail, $password) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE gmail = ?");
        $stmt->bind_param("s", $gmail);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            return true; // Usuario ya existe
        } else {
    
            $stmt = $conn->prepare("INSERT INTO usuarios (usuario, gmail, contrasela) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nombre, $gmail, $password);
            return $stmt->execute();
        }
    }

}
