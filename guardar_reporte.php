<?php
session_start();
// Asegúrate de que 'conexiones.php' contiene la conexión MySQLi en la variable $conn
require_once 'conexiones.php'; 

// 1. VALIDACIÓN
if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario']['email'])) {
    echo "Error: Sesión no válida. Por favor, inicia sesión de nuevo.";
    exit;
}

// 2. RECEPCIÓN Y PREPARACIÓN DE DATOS
// Verifica si se enviaron los datos esenciales (lat y lng son cruciales)
if (!isset($_POST['descripcion'], $_POST['categoria'], $_POST['lat'], $_POST['lng'])) {
    echo "Error: Faltan datos necesarios (descripción, categoría o coordenadas).";
    exit();
}

$descripcion = $_POST['descripcion'];
$categoria = $_POST['categoria'];
$latitud = $_POST['lat'];
$longitud = $_POST['lng'];
// Usamos el email como identificador del usuario
$usuario_email = $_SESSION['usuario']['email']; 

$ruta_foto = NULL; // Por defecto, no hay foto

// 3. MANEJO DE LA FOTO (Guardar en servidor, no BLOB)
$directorio_destino = '../../uploads/reportes/'; // Ajusta esta ruta si es necesario
$archivo_temporal = $_FILES['foto'] ?? null;

if ($archivo_temporal && $archivo_temporal['error'] === UPLOAD_ERR_OK) {
    
    // Generar un nombre único (usamos el email del usuario para evitar colisiones)
    $extension = pathinfo($archivo_temporal['name'], PATHINFO_EXTENSION);
    $nombre_archivo_unico = uniqid(pathinfo($usuario_email, PATHINFO_FILENAME) . '_', true) . '.' . $extension;
    $ruta_destino_completa = $directorio_destino . $nombre_archivo_unico;
    
    // Mover el archivo subido
    if (move_uploaded_file($archivo_temporal['tmp_name'], $ruta_destino_completa)) {
        // Esta es la ruta que guardaremos en la BD y usaremos para mostrar la imagen
        $ruta_foto = 'app/uploads/reportes/' . $nombre_archivo_unico; 
    } else {
        echo "Error: No se pudo mover el archivo. Revise los permisos de la carpeta 'uploads/reportes/'.";
        exit();
    }
}


// 4. INSERCIÓN A LA BASE DE DATOS (MySQLi)
// Usamos $conn de 'conexiones.php'
$sql = "INSERT INTO reportes (descripcion, categoria, lat, lng, estado, usuario_email, ruta_foto, fecha_creacion) 
        VALUES (?, ?, ?, ?, 'Pendiente', ?, ?, NOW())";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo "Error en la preparación de la consulta: " . $conn->error;
    exit();
}

// Vinculación de parámetros
// s: string, d: double/float (para lat/lng), s: string (para usuario_email y ruta_foto)
// Asegúrate de que la columna 'ruta_foto' exista en tu tabla como VARCHAR/TEXT
$stmt->bind_param("ssddss", $descripcion, $categoria, $latitud, $longitud, $usuario_email, $ruta_foto);

if ($stmt->execute()) {
    echo "✅ Reporte guardado exitosamente. ";
} else {
    // Si falla la BD, eliminamos el archivo que pudimos haber subido
    if ($ruta_foto && file_exists($ruta_destino_completa)) {
        unlink($ruta_destino_completa);
    }
    echo "❌ Error al guardar el reporte: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>