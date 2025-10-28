<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    header("Location:app/presentacion/paginas/applogin.php");
    exit();
}
$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Inicio - Alerta Ciudadana</title>

<link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
<h1>Alerta Ciudadana</h1>
<nav>
<a href="index.php">Inicio</a>
<a href="reportar.php">Reportar</a>
<a href="misreportes.php">Mis Reportes</a>
<a href="logout.php">Cerrar Sesion</a>

<?php echo $_SESSION['gmail'] ; ?>
</nav>
</header>

<main>
        <section class="bienvenida">
            <h2>Bienvenido a Alerta Ciudadana</h2>
            <p>Esta plataforma fue creada para que los ciudadanos puedan <strong>reportar problemas en la via publica</strong>, como:</p>
            <ul>
                <li>🚧 <strong>Baches</strong> en calles</li>
                <li>💡 <strong>Problemas de alumbrado</strong></li>
                <li>🛣️ <strong>Calles en mal estado</strong></li>
            </ul>

            <h3>¿Como funciona?</h3>
            <ol>
                <li>📌 Abri la pestaña <strong>Reportar</strong> y marca el lugar en el mapa.</li>
                <li>✍️ Completa el formulario con la descripcion, categoria y una foto.</li>
                <li>👀 Segui el estado de tu reporte en la seccion <strong>Mis Reportes</strong>.</li>
            </ol>

            <p>De esta manera, ayudamos entre todos a mejorar la ciudad y facilitar la reparacion de los problemas mas urgentes.</p>
        </section>
<h2>Bienvenido, <?php echo htmlspecialchars($usuario); ?> 👋</h2>
<p>Usa el menu para reportar problemas y ver tus reportes.</p>
<h1>🚧 Alerta Ciudadana 🚦</h1>

</main>

<footer>
<p>&copy; <?php echo date("Y"); ?> Alerta Ciudadana</p>
</footer>
</body>
</html>
