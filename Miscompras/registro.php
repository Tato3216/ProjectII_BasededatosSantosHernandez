<?php
include('controller.php'); // Incluye controller.php al comienzo del archivo

// Define variables e inicializa con valores vacíos
$nombre = $correo = $contrasena = '';
$nombre_err = $correo_err = $contrasena_err = '';

// Procesa el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Valida y obtén los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Realiza la validación de datos (agrega validaciones más robustas según tus necesidades)

    if (empty($nombre)) {
        $nombre_err = 'Por favor ingresa tu nombre.';
    }

    if (empty($correo)) {
        $correo_err = 'Por favor ingresa tu correo electrónico.';
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $correo_err = 'Por favor ingresa un correo electrónico válido.';
    }

    if (empty($contrasena)) {
        $contrasena_err = 'Por favor ingresa tu contraseña.';
    }

    // Si no hay errores de validación, procede a insertar los datos en la base de datos
    if (empty($nombre_err) && empty($correo_err) && empty($contrasena_err)) {
        // Hash y salting de la contraseña (debes implementar esta función)
        $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

        // Realiza la inserción en la base de datos (reemplaza con tu propia lógica y consultas SQL)
        include('conexion.php'); // Incluye tu archivo de conexión a la base de datos
        $insertsql = "INSERT INTO user (nombre, password, correo) VALUES (?, ?, ?)";
        if ($stmt = mysqli_prepare($conex, $insertsql)) {
            mysqli_stmt_bind_param($stmt, 'sss', $nombre, $hashed_password, $correo);
            if (mysqli_stmt_execute($stmt)) {
                // Redirige al usuario a la página de inicio de sesión
                header('Location: login.php');
                exit;
            } else {
                // Manejo de errores en la inserción en la base de datos
                echo 'Error al crear la cuenta. Por favor, inténtalo de nuevo más tarde.';
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($conex);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Young+Serif">
    <style>
        /* Estilos CSS aquí */
    </style>
</head>
<body>
    <div>
        <h2>Registro</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div>
                <label for="nombre">Nombre(nombre de usuario):</label>
                <input type="text" name="nombre" value="<?php echo $nombre; ?>">
                <span class="error"><?php echo $nombre_err; ?></span>
            </div>
            <div>
                <label for="correo">Correo Electrónico:</label>
                <input type="text" name="correo" value="<?php echo $correo; ?>">
                <span class="error"><?php echo $correo_err; ?></span>
            </div>
            <div>
                <label for="contrasena">Contraseña:</label>
                <input type="password" name="contrasena">
                <span class="error"><?php echo $contrasena_err; ?></span>
            </div>
            <div>
                <input type="submit" value="Registrarse">
            </div>
            <p>¿Ya tienes una cuenta? <a href="login.php">Iniciar sesión</a></p>
        </form>
    </div>
</body>
</html>
