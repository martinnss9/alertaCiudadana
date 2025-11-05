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
<?php if (isset($_SESSION['usuario'])){?>
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
            <p>Esta plataforma fue creada para que los ciudadanos puedan <strong>reportar problemas en la via publica</strong>, especificamente:</p>
            <ul>
                <li>🚧 <strong>Baches</strong> en calles</li>
            </ul>

            <h3>¿Como funciona?</h3>
            <ol>
                <li>📌 Abri la pestaña <strong>Reportar</strong> y marca el lugar en el mapa.</li>
                <li>✍️ Completa el formulario con la descripcion, categoria y una foto.</li>
                <li>👀 Segui el estado de tu reporte en la seccion <strong>Mis Reportes</strong>.</li>
            </ol>

            <p>De esta manera, ayudamos entre todos a mejorar la ciudad y facilitar la reparacion de los problemas mas urgentes.</p>
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
