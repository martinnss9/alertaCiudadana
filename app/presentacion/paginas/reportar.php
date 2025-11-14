<?php
session_start();
require_once "../../servicios/ServicioUsuario.php";

<<<<<<< HEAD
=======
require_once '../../servicio/ServicioReporte.php';

>>>>>>> 3834902e2f0249fa32f00703b801fcd06c615d22
if (!isset($_SESSION['usuario'])) {
    header("Location: applogin.php"); 
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
        /* Estilo para que el mapa y el formulario estén lado a lado */
        main { 
            display: flex; 
            gap: 20px; 
            padding: 20px; /* Añadido para un mejor espaciado */
        }
        /* Definimos el tamaño del mapa para que domine la pantalla */
        #map { 
            flex: 3; /* El mapa ocupa 3/4 partes del espacio */
            height: 70vh; /* Ajustado a 70% de la altura de la vista (viewport) */
            min-height: 500px; 
        }
        /* El formulario ocupa 1/4 parte */
        #formulario-columna {
            flex: 1;
        }
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
        <div id="map"></div>
        
        <div id="formulario-columna">
            <h2>Reportar un Problema</h2>
            <p>**Clic en el mapa** para seleccionar la ubicación del problema.</p>
            <form id="reporteForm">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" required></textarea>
                <br>
                <label for="categoria">Categoría:</label>
                <select id="categoria">
                    <option value="Bache">Bache</option>
                </select>
                <br>
                <label for="foto">Foto (opcional):</label>
                <input type="file" id="foto" accept="image/*">
                <br>
                <button type="submit">Enviar Reporte</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; <?= date("Y") ?> Alerta Ciudadana</p>
    </footer>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Coordenadas de Treinta y Tres, Uruguay: Lat: -33.2268, Lng: -54.3831
        // Ajustado el zoom a 14 para ver la ciudad de cerca
        const latTYS = -33.2268;
        const lngTYS = -54.3831;
        
        const map = L.map('map').setView([latTYS, lngTYS], 14);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        let marcador = null;
        
        // Manejador de clic para agregar o mover el marcador
        map.on('click', function(e) {
            if (marcador) {
                marcador.setLatLng(e.latlng);
            } else {
                // Crear un nuevo marcador y hacerlo arrastrable
                marcador = L.marker(e.latlng, {draggable: true}).addTo(map);
                marcador.bindPopup("Ubicación del Reporte").openPopup();
            }
        });

        document.getElementById("reporteForm").addEventListener("submit", function(e) {
            e.preventDefault();
            if (!marcador) return alert("🔴 ¡Importante! Selecciona la ubicación en el mapa haciendo click.");

            const coords = marcador.getLatLng();
            const formData = new FormData();
            
            // Datos a enviar (el ID del usuario se obtiene del lado del servidor, NO aquí)
            formData.append("lat", coords.lat);
            formData.append("lng", coords.lng);
            
            const foto = document.getElementById("foto").files[0];
            if (foto) formData.append("foto", foto);

            // Fetch a servicio para enviar el reporte
            formData.append("descripcion", document.getElementById("descripcion").value);
            formData.append("categoria", document.getElementById("categoria").value);
            fetch("../../servicios/ServicioReporte.php", {
                method: "POST",
                body: formData
            }).then(response => response.text())
            .then(data => {
                alert(data);
                  // Opcional: Resetear el formulario y el marcador
                document.getElementById("reporteForm").reset();
                map.removeLayer(marcador);
                marcador = null;
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Error al enviar el reporte."); 
                
                });
        });
    </script>
</body>
</html> 