<?php
include('conexion.php');
include('controller.php');
// session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar el formulario de inicio de sesión
    $username = $_POST['username'];
    $password = $_POST['password'];

    $credenciales = verificarCredenciales($username, $password, $conex);

    if ($credenciales) {
        $_SESSION['invitado'] = 'N';
        $_SESSION['id_user'] = $credenciales['id_user'];
        $_SESSION['username'] = $credenciales['nombre'];
        header('Location: index.php');
        exit();
    } else {
        $error = 'Credenciales incorrectas';
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mis Mejores Compras Online - Iniciar Sesión</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Young+Serif">
    <style>
        body {
            font-family: 'Young Serif', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .gif-container {
            position: relative;
            width: 100%;
            height: 100vh; /* Esto establece la altura del contenedor al 100% de la ventana del navegador */
            overflow: hidden;
        }

        img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ajusta la imagen GIF al tamaño del contenedor */
            z-index: -1; /* Esto coloca la imagen GIF detrás de otros elementos */
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color:transparent;
            border-color: ffffff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            font-weight: 500;
            font-size: 24px;
            margin-top: 0;
            color: black;
            background-color:#f73309;
            text-shadow: #fff;
        }

        h2 {
            font-weight: 500;
            font-size: 17px;
            margin-top: 0;
            text-shadow: #e62200;
            border-color: #e62200;
            color: #ccc;
        }

        label {
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
            text-align: left;
            color: #fff;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #f73309;
            color: #fff;
            /* border:; */
            border-color: white;
            padding: 10px 20px;
            font-weight: 500;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #e62200;
        }

        .error-message {
            color: #ff0000;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="gif-container">
    <img src="images/begin.gif" alt="Fondo animado">
    <div class="container">
    <div class="container">
        <h1>Mis Mejores Compras Online</h1>
        <h2>Iniciar Sesión</h2>
        <?php if (isset($error)) { echo "<p class='error-message'>$error</p>"; } ?>
        <form method="post">
            <label for="username">Usuario:</label>
            <input type="text" name="username" required><br>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" required><br>
            <input type="submit" value="Iniciar Sesión">
            <p>¿No tienes una cuenta? <a href="registro.php">Crear una cuenta</a></p>
        </form>
    </div>
    </div>
</div>

</body>
</html>
