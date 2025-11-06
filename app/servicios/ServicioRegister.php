<?php
include_once __DIR__ . '/../persistencia/PersistenciaUsuario.php';

class ServicioRegister {

    public function IngresarUsuario($nombre, $gmail, $password){
        
        $pUsuario = new PersistenciaUsuario();
        $datosUsuario = $pUsuario->RegistrarUsuario($nombre, $gmail, $password);
        //return $datosUsuario;
    }
}