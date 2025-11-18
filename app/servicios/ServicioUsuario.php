<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include __DIR__ . "/../persistencia/PersistenciaUsuario.php";

class ServicioUsuario {
    public function LoguearUsuario($gmail, $password) {
        $persistencia = new PersistenciaUsuario();
        $usuario = $persistencia->obtenerUsuarioPorCredenciales($gmail, $password);
    
        if ($usuario) {

            // ❌ NO LLAMAR session_start() de nuevo
            $_SESSION['usuario'] = $usuario['usuario']; 
            $_SESSION['id_usuario'] = $usuario['id'];  
        
            header("Location: ../paginas/misreportes.php");
            exit();
        } else {
            echo "Datos incorrectos";
        }
    }
}
