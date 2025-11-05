<?php
//Desloguearse y redirigir al login
session_start();
session_unset();
session_destroy();
header("Location:applogin.php");
exit();
?>
