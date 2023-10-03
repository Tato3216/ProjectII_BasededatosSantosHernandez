<?php
class Carrito {
    private $conex;

    public function __construct($conex) {
        $this->conex = $conex;
    }

    public function obtenerCarrito($usuarioId = null) {
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
        $stmt = mysqli_prepare($this->conex, $query);

        if ($stmt === false) {
            die("Error al preparar la consulta: " . mysqli_error($this->conex));
        }
        mysqli_stmt_bind_param($stmt, "s", $invitado);
        if (mysqli_stmt_execute($stmt)) {
            $resultado = mysqli_stmt_get_result($stmt);
            if (!$resultado) {
                die("Error al obtener el carrito: " . mysqli_error($this->conex));
            }

            if (mysqli_num_rows($resultado) > 0) {
                $carrito = mysqli_fetch_assoc($resultado);
                $carritoId = $carrito['car_id'];
                $detalleQuery = "SELECT * FROM car_detalle WHERE car_id = ?";
                $detalleStmt = mysqli_prepare($this->conex, $detalleQuery);

                if ($detalleStmt === false) {
                    die("Error al preparar la consulta de detalles: " . mysqli_error($this->conex));
                }

                mysqli_stmt_bind_param($detalleStmt, "i", $carritoId);

                if (mysqli_stmt_execute($detalleStmt)) {
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
