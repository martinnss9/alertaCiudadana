<?php

class PersistenciaUsuario {

    public function obtenerPorUsuarioYContrasenia($usuario, $contrasenia){
        
    
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE Gmail = ? AND Contrasenia = ?");
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