<?php
include_once "conexiones.php"; 

class PersistenciaUsuario {
    public function obtenerUsuarioPorCredenciales($gmail, $password) {
        global $conn;
        $stmt = $conn->prepare("SELECT id, usuario, gmail, contrasela FROM usuarios WHERE gmail = ? AND contrasela = ?");
        $stmt->bind_param("ss", $gmail, $password);
        $stmt->execute();
        $resultado = $stmt->get_result();
<<<<<<< HEAD

        if ($resultado->num_rows === 1) {
            return $resultado->fetch_assoc();
=======
    
        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
            // Guardar el ID en la sesión
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['id_usuario'] = $usuario['id'];
            $_SESSION['usuario'] = $usuario['usuario']; 
            return $usuario;
>>>>>>> 3834902e2f0249fa32f00703b801fcd06c615d22
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
            return true; 
        } else {
    
            $stmt = $conn->prepare("INSERT INTO usuarios (Usuario, gmail, contrasela) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nombre, $gmail, $password);
            return $stmt->execute();
        }
    }

}
