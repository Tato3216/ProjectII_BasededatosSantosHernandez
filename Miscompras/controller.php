<?php
include('Carrito.php');
include('conexion.php');

// Ahora puedes crear una instancia de la clase Carrito pasando la conexión como parámetro
$carrito = new Carrito($conex);
function iniciarSesion() {
    // Aquí implementa la lógica de inicio de sesión
    // Por ejemplo, verifica si el usuario ha iniciado sesión correctamente y establece el estado
    // También puedes establecer otras variables de sesión aquí

    // Supongamos que el usuario ha iniciado sesión correctamente
    $_SESSION['invitado'] = "N"; // Cambia el estado a "N" (usuario registrado)
}

// Función para obtener el estado actual (invitado o usuario)
function obtenerEstado() {
    // Verifica si la variable de sesión 'invitado' está establecida
    if (isset($_SESSION['invitado'])) {
        return $_SESSION['invitado'];
    } else {
        return "Y"; // Valor por defecto si no se ha establecido
    }
}


?>
