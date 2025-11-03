<?php
include "../../persistencia/conexiones.php";
class PersistenciaUsuario {

    public function obtenerPorUsuarioYContrasenia($usuario, $contrasenia){
     // Datos de la base de datos
$host = "localhost";
$user = "root";           // Usuario XAMPP
$password = "";           // Contraseña XAMPP
$database = "alertaciudadana";   // Tu base de datos

// Crear conexion
$conn = new mysqli($host, $user, $password, $database);

// Verifica conexion
if ($conn->connect_error) {
    die("Conexion fallida: " . $conn->connect_error);
}
$conn->set_charset("utf8");   
    
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE Gmail = ? AND Contrasela = ?");
        $stmt->bind_param("ss", $usuario, $contrasenia);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $usuario = [
                "Usuario" => $user['Usuario'],
                "Gmail" => $user['Gmail']
            ];
            return $usuario;
        } else {
            return null;
        }

    }

}