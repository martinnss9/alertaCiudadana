<?php   

include "../../persistencia/PersistenciaUsuario.php";

class ServicioUsuario {
    public function LoguearUsuario($gmail, $password) 
    { // <-- ¡Faltaba esta llave de apertura!
        $persistencia = new PersistenciaUsuario();
        // Usamos $usuario (minúscula) para ser consistente
        // CORRECCIÓN: Cambiamos el nombre del método para que coincida con PersistenciaUsuario.php
        $usuario = $persistencia->IngresarUsuario($gmail, $password); 

        // Se eliminó la llave extra que estaba aquí
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
}