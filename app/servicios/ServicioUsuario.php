<?php   
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "../../persistencia/PersistenciaUsuario.php";

class ServicioUsuario {
    public function LoguearUsuario($gmail, $password) {
        $persistencia = new PersistenciaUsuario();
        $usuario = $persistencia->obtenerUsuarioPorCredenciales($gmail, $password);
    
        if ($usuario) {
            session_start();
            $_SESSION['usuario'] = $usuario['Usuario']; 
            $_SESSION['id_usuario'] = $usuario['id'];  
        
            header("Location: ../paginas/misreportes.php");
            exit();
        } else {
            echo "Datos incorrectos";
        }
    }
}
