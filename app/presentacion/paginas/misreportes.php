<?php
session_start();

require_once "../../servicios/ServicioReporte.php";

$servicio = new ServicioReporte();
$id_usuario = $_SESSION['id_usuario'];

$reportes = $servicio->obtenerReportesUsuario($id_usuario);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Mis Reportes</title>
<link rel="stylesheet" href="/proyecto final/app/presentacion/css/styles.css">

<!-- Leaflet para mapas -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<style>
/* Animacion general fade-in */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.reporte-card {
    width: 90%;
    margin: 25px auto;
    padding: 18px;
    border: 1px solid #444;
    border-radius: 15px;
    background: #f5f5f5;
    box-shadow: 0 3px 10px rgba(0,0,0,0.15);
    animation: fadeIn 0.6s ease forwards;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.reporte-card:hover {
    transform: scale(1.02);
    box-shadow: 0 8px 25px rgba(0,0,0,0.25);
}

.reporte-foto {
    width: 230px;
    border-radius: 12px;
    margin-top: 10px;
    animation: fadeIn 1s ease forwards;
}

.mapa {
    width: 100%;
    height: 310px;
    margin-top: 15px;
    border-radius: 12px;
    animation: fadeIn 1.2s ease forwards;
}

/* Titulo del tipo */
.reporte-card h3 {
    margin-bottom: 8px;
    font-size: 22px;
    animation: fadeIn 0.7s ease forwards;
}

/* Texto de descripcion */
.reporte-card p {
    font-size: 16px;
    animation: fadeIn 0.8s ease forwards;
}
</style>

</head>
<body>
<header>
<h1>Alerta Ciudadana</h1>
<nav>
<a href="./../../../index.php">Inicio</a>
<a href="reportar.php">Reportar</a>
<a href="misreportes.php">Mis Reportes</a>
<a href="logout.php">Cerrar Sesion</a>
</nav>
</header>

<main>
<h2>Bienvenido <?php echo htmlspecialchars($_SESSION['usuario']); ?></h2>
<p>Aqui estan tus reportes.</p>

<?php if (empty($reportes)): ?>
    <p>No tienes reportes aun.</p>

<?php else: ?>

<?php foreach ($reportes as $r): ?>
<div class="reporte-card">
    <h3>Tipo: <?php echo htmlspecialchars($r['tipo']); ?></h3>

    <p><strong>Descripcion:</strong> <?php echo htmlspecialchars($r['Descripcion']); ?></p>


    <?php if ($r['Foto'] != ""): ?>
        <img class="reporte-foto" src="../../uploads/<?php echo $r['Foto']; ?>">
    <?php else: ?>
        <p>Sin foto</p>
    <?php endif; ?>

    <!-- Mapa -->
    <div id="map_<?php echo $r['id']; ?>" class="mapa"></div>

    <script>
        var map = L.map("map_<?php echo $r['id']; ?>").setView(
            [<?php echo $r['Latitud']; ?>, <?php echo $r['Longitud']; ?>],
            15
        );

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            maxZoom: 19
        }).addTo(map);

        L.marker([<?php echo $r['Latitud']; ?>, <?php echo $r['Longitud']; ?>]).addTo(map);
    </script>

</div>
<?php endforeach; ?>

<?php endif; ?>

</main>

<footer>
<p>&copy; <?php echo date("Y"); ?> Alerta Ciudadana</p>
</footer>
</body>
</html>
