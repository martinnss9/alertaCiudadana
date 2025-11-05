<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: applogin.php"); // redirige al login si no hay sesion
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reportar - Alerta Ciudadana</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        #map { height: 400px; width: 100%; margin-bottom: 20px; }
        main { display: flex; gap: 20px; }
    </style>
</head>
<body>
    <header>
        <h1>Alerta Ciudadana</h1>
        <nav>
            <a href="../../../index.php">Inicio</a>
            <a href="reportar.php">Reportar</a>
            <a href="misreportes.php">Mis Reportes</a>
            <a href="logout.php">Cerrar sesión</a>
        </nav>
    </header>

    <main>
        <div id="map" style="flex: 2; height: 500px;"></div>
        <div style="flex: 1;">
            <h2>Reportar un Problema</h2>
            <form id="reporteForm">
                <label>Descripción:</label>
                <textarea id="descripcion" required></textarea>
                <br>
                <select id="categoria">
                    <option value="bache">Bache</option>
                </select>

                <label>Foto (opcional):</label>
                <input type="file" id="foto" accept="image/*">

                <button type="submit">Enviar Reporte</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; <?= date("Y") ?> Alerta Ciudadana</p>
    </footer>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        const map = L.map('map').setView([-33.233, -54.383], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        let marcador = null;
        map.on('click', function(e) {
            if (marcador) marcador.setLatLng(e.latlng);
            else marcador = L.marker(e.latlng, {draggable: true}).addTo(map);
        });

        document.getElementById("reporteForm").addEventListener("submit", function(e) {
            e.preventDefault();
            if (!marcador) return alert("Selecciona la ubicación en el mapa.");

            const coords = marcador.getLatLng();
            const formData = new FormData();
            formData.append("descripcion", document.getElementById("descripcion").value);
            formData.append("categoria", document.getElementById("categoria").value);
            formData.append("lat", coords.lat);
            formData.append("lng", coords.lng);
            formData.append("usuario", JSON.stringify(<?= json_encode($usuario) ?>));

            const foto = document.getElementById("foto").files[0];
            if (foto) formData.append("foto", foto);

            fetch('guardar_reporte.php', { method: 'POST', body: formData })
                .then(r => r.text())
                .then(d => {
                    alert(d);
                    document.getElementById("reporteForm").reset();
                    if (marcador) { map.removeLayer(marcador); marcador = null; }
                });
        });
    </script>
</body>
</html>   