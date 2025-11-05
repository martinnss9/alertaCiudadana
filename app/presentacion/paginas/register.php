<?php
require_once '../../servicios/ServicioRegister.php';
include_once '../../persistencia/PersistenciaUsuario.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$nombre = htmlspecialchars($_POST['nombre'] ?? '');
$gmail = htmlspecialchars($_POST['gmail'] ?? '');
$password = htmlspecialchars($_POST['password'] ?? '');

$servicioRegister = new ServicioRegister();
$servicioRegister->IngresarUsuario($nombre, $gmail, $password);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registro - Alerta Ciudadana</title>
<link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<header>
<h1>Alerta Ciudadana</h1>
<nav>
<a href="../../../index.php">Inicio</a>
<a href="applogin.php">Login</a>
</nav>
</header>

<main>
<h2>Registrarse</h2>

<?php 
if(isset($error)) echo "<p style='color:red;'>$error</p>";
if(isset($success)) echo "<p style='color:green;'>$success</p>";
?>

<form method="POST" action="register.php">
<label for="nombre">Nombre:</label>
<input type="text" id="nombre" name="nombre" required>

<label for="email">Correo:</label>
<input type="email" id="gmail" name="gmail" required>

<label for="password">Contraseña:</label>
<input type="password" id="password" name="password" required>

<button type="submit">Crear Cuenta</button>
</form>

<p>Ya tienes cuenta? <a href="login.php">Inicia sesion aqui</a></p>
</main>
<footer>
<p>&copy; <?php echo date("Y"); ?> Alerta Ciudadana</p>
</footer>
</body>
</html>
