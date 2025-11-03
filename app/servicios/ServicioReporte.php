<?php
session_start();
require_once '../presentacion/paginas/reportar.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Método no permitido.";
    exit;
}

// Llama directamente a la función del servicio (que contiene toda la lógica: validación, base de datos, archivos)
guardar_reporte(); // Toda la lógica está ahora en ServicioReporte.php
?>   