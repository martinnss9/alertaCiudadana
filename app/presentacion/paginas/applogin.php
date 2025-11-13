<?php
session_start();
require_once '../../servicios/ServicioUsuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {	
$gmail = htmlspecialchars($_POST['email'] ?? '');
$password = htmlspecialchars($_POST['password'] ?? '');

$servicioUsuario = new ServicioUsuario();
$servicioUsuario->LoguearUsuario($gmail, $password);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Login - Alerta Ciudadana</title>
<link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<header>
<h1>Alerta Ciudadana</h1>
<nav>
<a href="../../../index.php">Inicio</a>
<a href="register.php">Registrarse</a>
</nav>
</header>

<main>
<h2>Iniciar Sesion</h2>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="POST">
    <label for="email">Correo:</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Ingresar</button>
</form>

<p>Si no tienes cuenta, <a href="register.php">Registrate aqui</a></p>
</main>

<footer>
<p>&copy; <?php echo date("Y"); ?> Alerta Ciudadana</p>
</footer>
</body>
</html>
