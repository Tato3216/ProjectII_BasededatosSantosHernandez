<?php
session_start();
include('Carrito.php');
include('conexion.php');

$carrito = new Carrito($conex);
function verificarCredenciales($username, $password, $conex) {
    $stmt = mysqli_prepare($conex, "SELECT id_user, nombre, password FROM user WHERE nombre = ?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_user, $nombre, $passwordHash);
        
        if (mysqli_stmt_fetch($stmt)) {
            mysqli_stmt_close($stmt);
            if (password_verify($password, $passwordHash)) {
                // La contraseña es correcta
                return array('id_user' => $id_user, 'username' => $nombre);
            }
        }
        mysqli_stmt_close($stmt);
    }
    return false;
}

function obtenerIDUsuario($username, $conex) {
    $stmt = mysqli_prepare($conex, "SELECT id_user FROM user WHERE nombre = ?");
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_user);
        
        if (mysqli_stmt_fetch($stmt)) {
            mysqli_stmt_close($stmt);
            return $id_user;
        }
        
        mysqli_stmt_close($stmt);
    }
    
    return null;
}
if (!isset($_SESSION['invitado'])) {
    $_SESSION['invitado'] = 'Y'; 
}

if (!isset($_SESSION['id_user'])) {
    $_SESSION['id_user'] = null; 
}

if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = ''; 
}

?>
