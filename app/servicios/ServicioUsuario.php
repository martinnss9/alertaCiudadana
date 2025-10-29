<?php

include "../../persistencia/PersistenciaUsuario.php";

class ServicioUsuario {

    public function loginUsuario($usuario, $contrasenia){
        
        $pUsuario = new PersistenciaUsuario();
        $datosUsuario = $pUsuario->obtenerPorUsuarioYContrasenia($usuario, $contrasenia);
        if ($datosUsuario != null){
            $_SESSION['Usuario'] = $datosUsuario['Usuario'];
            $_SESSION['Gmail'] = $datosUsuario['Gmail'];
            header("Location: ../../../index.php");
        } else {
            header("Location: error.php");
        }
    


    }

}