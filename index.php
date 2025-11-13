<?php
session_start();
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
<?php if (isset($_SESSION['usuario']) && isset($_SESSION['id_usuario'])) {?>
        <a href="app/presentacion/paginas/reportar.php">Reportar</a>
        <a href="app/presentacion/paginas/misreportes.php">Mis Reportes</a>
        <a href="app/presentacion/paginas/logout.php">Cerrar Sesion</a>
    <?php } else {?>
        <a href="app/presentacion/paginas/applogin.php">Iniciar Sesion</a>
        <a href="app/presentacion/paginas/register.php">Registrarse</a>
    <?php } ?>
</nav>
</header>

<main>
        <section class="bienvenida">
            <h2>Bienvenido a Alerta Ciudadana</h2>
            <p>
    Esta plataforma fue creada para que los ciudadanos puedan reportar problemas en la vía pública, específicamente:
    <br>
    🚧 <strong>Baches en calles</strong>
</p>

            <h3>¿Como funciona?</h3>
            <ol>
                <li>📌 Abri la pestaña <strong>Reportar</strong> y marca el lugar en el mapa.</li>
                <li>✍️ Completa el formulario con la descripcion y una foto del incidente.</li>
                <li>👀 Segui el estado de tu reporte en la seccion <strong>Mis Reportes</strong>.</li>
            </ol>

            <p>Gracias a esta colaboración, logramos identificar y priorizar rápidamente las reparaciones más urgentes para mejorar nuestra ciudad.</p>
        </section>
<?php
if (isset($_SESSION['usuario'])) {
    echo "<h2>Hola, " . htmlspecialchars($_SESSION['usuario']) . "!</h2>";
} else {
    echo "<h2>Hola, Invitado!</h2>";
}
?>
<p>Usa el menu para reportar problemas y ver tus reportes.</p>
<h1>🚧 Alerta Ciudadana 🚦</h1>

</main>

<footer>
<p>&copy; <?php echo date("Y"); ?> Alerta Ciudadana</p>
</footer>
</body>
</html>
