<?php

include "../../persistencia/PersistenciaUsuario.php";

class ServicioUsuario {
    public function LoguearUsuario($gmail, $password) 
        $persistencia = new PersistenciaUsuario(); {
        $Usuario = $persistencia->obtenerPorUsuarioYContrasenia( $gmail, $password);
        {
        if ($usuario) {
            session_start();
            $_SESSION['usuario'] = $usuario['Usuario'];
            header("Location: ../../../index.php");
            echo $usuario['Usuario'];
            exit();
        } else {
            $error = "Credenciales invalidas. Por favor, intenta de nuevo.";
        header("Location: ../paginas/applogin.php?error=" . urlencode($error));
        exit();
        }
    }
}                                                                                                                                                             Parse error: syntax error, unexpected variable "$persistencia", expecting ";" or "{" in C:\xampp\htdocs\proyecto final\app\servicios\ServicioUsuario.php on line 7