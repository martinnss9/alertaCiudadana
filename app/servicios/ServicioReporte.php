<?php
session_start();
require_once '../presentacion/paginas/reportar.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Metodo no permitido.";
    exit;
}

$servicioReporte = new ServicioReporte();

$id_usuario = $_SESSION['id_usuario'];   
$descripcion = $_POST['descripcion'];
$categoria = $_POST['categoria'];
$latitud = $_POST['lat']; 
$longitud = $_POST['lng'];   


$foto_nombre = "";
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
    $foto_nombre = time() . "_" . basename($_FILES['foto']['name']);
    $ruta_destino = "../uploads/" . $foto_nombre;
    if (!file_exists("../uploads")) {
        mkdir("../uploads", 0777, true);
    }
    move_uploaded_file($_FILES['foto']['tmp_name'], $ruta_destino);
}

$resultado = $servicioReporte->crearReporte(
    $descripcion,
    $foto_nombre,
    $categoria,
    $latitud,
    $longitud,
    $id_usuario
);

if ($resultado['exito']) {
    echo "Reporte creado con exito.";
} else {
    echo "Error al crear el reporte: " . $resultado['mensaje'];
}
?>
