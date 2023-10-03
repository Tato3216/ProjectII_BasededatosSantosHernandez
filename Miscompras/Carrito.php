<?php
class Carrito {
    private $conex;

    public function __construct($conex) {
        $this->conex = $conex;
    }

    public function obtenerCarrito($usuarioId = null) {
        // Variable para determinar si el usuario es invitado o registrado
        $invitado = ($usuarioId !== null) ? 'N' : 'Y';

        // Consulta SQL para obtener el carrito
        $query = "SELECT * FROM car WHERE ";

        if ($usuarioId !== null) {
            // Usuario registrado
            $query .= "user_id = ?";
        } else {
            // Invitado (inventario)
            $query .= "invitado = ?";
        }

        // Preparar la consulta
        $stmt = mysqli_prepare($this->conex, $query);

        if ($stmt === false) {
            die("Error al preparar la consulta: " . mysqli_error($this->conex));
        }

        // Asociar el valor a los marcadores de posición
        mysqli_stmt_bind_param($stmt, "s", $invitado);

        // Ejecutar la consulta
        if (mysqli_stmt_execute($stmt)) {
            // Obtener el resultado
            $resultado = mysqli_stmt_get_result($stmt);

            if (!$resultado) {
                die("Error al obtener el carrito: " . mysqli_error($this->conex));
            }

            // Si se encontraron carritos
            if (mysqli_num_rows($resultado) > 0) {
                $carrito = mysqli_fetch_assoc($resultado);

                // Obtener detalles del carrito
                $carritoId = $carrito['car_id'];
                $detalleQuery = "SELECT * FROM car_detalle WHERE car_id = ?";
                $detalleStmt = mysqli_prepare($this->conex, $detalleQuery);

                if ($detalleStmt === false) {
                    die("Error al preparar la consulta de detalles: " . mysqli_error($this->conex));
                }

                // Asociar el valor a los marcadores de posición
                mysqli_stmt_bind_param($detalleStmt, "i", $carritoId);

                // Ejecutar la consulta de detalles
                if (mysqli_stmt_execute($detalleStmt)) {
                    // Obtener el resultado de detalles
                    $detalleResultado = mysqli_stmt_get_result($detalleStmt);

                    if (!$detalleResultado) {
                        die("Error al obtener los detalles del carrito: " . mysqli_error($this->conex));
                    }

                    $carrito['detalles'] = array();

                    while ($detalle = mysqli_fetch_assoc($detalleResultado)) {
                        $carrito['detalles'][] = $detalle;
                    }

                    return $carrito;
                } else {
                    die("Error al ejecutar la consulta de detalles: " . mysqli_error($this->conex));
                }
            } else {
                return "No hay compras recientes";
            }
        } else {
            die("Error al ejecutar la consulta: " . mysqli_error($this->conex));
        }
    }
}
?>
