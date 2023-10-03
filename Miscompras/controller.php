<?php
include('Carrito.php');
include('conexion.php');

$carrito = new Carrito($conex);
function iniciarSesion() {
    $_SESSION['invitado'] = "N";
}

function obtenerEstado() {
    if (isset($_SESSION['invitado'])) {
        return $_SESSION['invitado'];
    } else {
        return "Y"; 
    }
}
?>
