<?php
include_once __DIR__ . '/../persistencia/PersistenciaUsuario.php';

class ServicioRegister {

    public function IngresarUsuario($nombre, $gmail, $password){
        
        $pUsuario = new PersistenciaUsuario();
        $datosUsuario = $pUsuario->IngresarUsuario($nombre, $gmail, $password);
        if($datosUsuario){
            $error = "El usuario ya existe.";
            header("Location: ../../presentacion/paginas/register.php?error=" . urlencode($error));
            exit();
        }else{
        }
    }
}