<?php
session_start();
require_once 'conexiones.php';

if (!isset($_SESSION['usuario'])) {
    echo "No estás autenticado.";
    exit;
}

$descripcion = $_POST['descripcion'];
$categoria = $_POST['categoria'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
$usuario = $_SESSION['usuario']['email']; // Ajusta si es necesario

// Manejo de la foto
$foto = null;
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $foto = file_get_contents($_FILES['foto']['tmp_name']);
}

// Inserción a la base de datos
$stmt = $conn->prepare("INSERT INTO reportes (descripcion, categoria, lat, lng, estado, usuario_email, foto) VALUES (?, ?, ?, ?, 'Pendiente', ?, ?)");
$stmt->bind_param("ssddsb", $descripcion, $categoria, $lat, $lng, $usuario, $foto);
$stmt->send_long_data(5, $foto); // index 5 = foto

if ($stmt->execute()) {
    echo "Reporte guardado exitosamente.";
} else {
    echo "Error al guardar el reporte: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
