<?php
session_start();
include('conexion.php');

function agregarProductoAlCarrito($product_id, $quantity, $product_price, $car_id) {
    include('conexion.php');

    $existing_product = obtenerProductoEnCarrito($product_id, $car_id);

    if ($existing_product) {
        $new_quantity = $existing_product['cantidad'] + $quantity;
        actualizarCantidadProductoEnCarrito($existing_product, $new_quantity);
    } else {
        agregarNuevoProductoAlCarrito($product_id, $quantity, $product_price, $car_id);
    }
}

function obtenerCarritoActivo($user_or_invitado_id) {
    include('conexion.php');
    
    if ($user_or_invitado_id === 'Y') {
        if (isset($_SESSION['carrito_invitado'])) {
            return $_SESSION['carrito_invitado'];
        }
        $carrito_id = crearCarrito('Y');
        $_SESSION['carrito_invitado'] = $carrito_id;
        return $carrito_id;
    } else {
        if ($user_or_invitado_id === 'Y') {
            $query = "SELECT car_id FROM car WHERE invitado = 'Y'";
        } else {
            $query = "SELECT car_id FROM car WHERE user_id = ? ";
        }
            
            $stmt = mysqli_prepare($conex, $query);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "i", $user_or_invitado_id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $car_id);
                
                if (mysqli_stmt_fetch($stmt)) {
                    mysqli_stmt_close($stmt);
                    return $car_id;
                }
                
                mysqli_stmt_close($stmt);
            }
    }
    return false;
}

function crearCarrito($user_or_invitado_id) {
    include('conexion.php');
    
    if ($user_or_invitado_id === 'Y') {
        $query = "INSERT INTO car (id_compra, user_id, invitado, fecha) VALUES (NULL, NULL, 'Y', NOW())";
    } else{
        $query = "INSERT INTO car (id_compra, user_id, invitado, fecha) VALUES (NULL, ?, NULL, NOW())";
        print $user_or_invitado_id;
        print $query;
    }
    
    $stmt = mysqli_prepare($conex, $query);
    if ($stmt) {
        if ($user_or_invitado_id !== 'Y') {
            mysqli_stmt_bind_param($stmt, "i", $user_or_invitado_id);
        }
        mysqli_stmt_execute($stmt);
        
        $car_id = mysqli_insert_id($conex);
        
        mysqli_stmt_close($stmt);
        
        return $car_id;
    }
    
    return false;
}


function obtenerProductoEnCarrito($product_id, $car_id) {
    include('conexion.php');
    
    $query = "SELECT id_line, cantidad FROM car_detalle WHERE product_id = ? AND car_id = ?";
    
    $stmt = mysqli_prepare($conex, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ii", $product_id, $car_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_line, $cantidad);
        
        if (mysqli_stmt_fetch($stmt)) {
            mysqli_stmt_close($stmt);
            return array('id_line' => $id_line, 'cantidad' => $cantidad);
        }
        
        mysqli_stmt_close($stmt);
    }
    
    return false;
}

function actualizarCantidadProductoEnCarrito($existing_product, $quantity) {
    include('conexion.php');
    
    $query = "UPDATE car_detalle SET cantidad = ? WHERE id_line = ?";
    
    $stmt = mysqli_prepare($conex, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ii", $quantity, $existing_product['id_line']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

function agregarNuevoProductoAlCarrito($product_id, $quantity, $product_price, $car_id) {
    include('conexion.php');
    
    $query = "INSERT INTO car_detalle (product_id, cantidad, precio, car_id) VALUES (?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conex, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "iiid", $product_id, $quantity, $product_price, $car_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}


if (isset($_GET['category_id']) || isset($_GET['search'])) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Productos</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Young+Serif">
        <style>
            .product-button {
                font-family: 'Young Serif', sans-serif;
                font-size: 16px;
                color: white;
                padding: 8px 16px;
                margin: 10px;
                border: none;
                background-color: #5268b9;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .product-button:hover {
                background-color: #e62200; 
            }

            .quantity-input {
                width: 40px;
                padding: 2px;
                font-size: 16px;
            }

            .top-bar {
                font-family: 'Young Serif', sans-serif;
                background-color: #f73309;
                color: black;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px 20px;
            }

            .title {
                margin: 0;
            }

            .product-container {
                display: flex;
                align-items: center;
                margin: 20px;
                padding: 10px;
                border: 1px solid #ccc;
                background-color: #f9f9f9;
            }

            .product-info {
                flex: 1;
                padding: 10px;
            }

            .cart {
                float: right;
                margin-top: 10px;
                margin-right: 10px;
            }
        </style>
    </head>
    <body>
        <div class="top-bar">
            <h1 class="title">LAS MEJORES COMPRAS ONLINE</h1>
            <div class="cart">
                <a href="Carrito.php" id="cart-link" class="product-button"><img src="images/carrito.png" alt="Carrito" width="28" height="28"></a>
            </div>
        </div>
        <div>
            <?php
            // if (isset($_GET['category_id']) || isset($_GET['search'])) {
                if (isset($_GET['category_id'])) {
                    $category_id = $_GET['category_id'];
                    $subcategory_id = $_GET['subcategory_id'];
                    
                    include('conexion.php');
                    $query = "SELECT P.product_id, P.nombre, P.descripcion, P.stock, L.price_list AS precio FROM product P INNER JOIN price L ON L.product_id = P.product_id 
                    WHERE P.category_id = $category_id AND P.sub_category_id = $subcategory_id";
                    $result = mysqli_query($conex, $query);
                }
            
                if (isset($_GET['search'])) {
                    $nameProduct = $_GET['search'];
                    echo "<h1>Resultados para '$nameProduct'</h1>";
                    include('conexion.php');
                    $query = "SELECT P.product_id, P.nombre, P.descripcion, P.stock, L.price_list AS precio FROM product P INNER JOIN price L ON L.product_id = P.product_id 
                    WHERE P.nombre LIKE '%$nameProduct%'";
                    $result = mysqli_query($conex, $query);
                    if (mysqli_num_rows($result) > 0) {}
                    else {
                        echo "No se encontraron productos...";
                    }
                }
            
                // <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $product_id = $row['product_id'];
                    $product_name = $row['nombre'];
                    $product_description = $row['descripcion'];
                    $product_price = $row['precio'];
                    $product_stock = $row['stock'];
                ?>
                <div class="product-container">
                        <div class="product-info">
                            <h2><?php echo $product_name; ?></h2>
                            <p><?php echo $product_description; ?></p>
                            <p>Precio: Q<?php echo $product_price; ?></p>
                            <p>Unidades Disponibles: <?php echo $product_stock; ?></p>
                        </div>
                        <div class="product-controls">
                            <form method="post">
                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                <input type="hidden" name="product_price" value="<?php echo $product_price; ?>">
                                <input type="number" class="quantity-input" name="quantity" value="1" min="1">
                                <button type="submit" class="product-button" name="add_to_cart">Añadir al Carrito</button>
                            </form>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </body>
        </html>
    
    <?php
    mysqli_close($conex);
}

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity'];

    if (isset($_SESSION['id_user'])) {
        $user_id = $_SESSION['id_user'];
        
        $carrito_activo = obtenerCarritoActivo($user_id);
        
        if ($carrito_activo) {
            agregarProductoAlCarrito($product_id, $quantity, $product_price, $carrito_activo);
        } else {
            $carrito_nuevo = crearCarrito($user_id);
            agregarProductoAlCarrito($product_id, $quantity, $product_price, $carrito_nuevo);
        }
    } elseif (isset($_SESSION['invitado']) && $_SESSION['invitado'] === 'Y') {
        $invitado = 'Y';
        
        $carrito_invitado = obtenerCarritoActivo($invitado);
        
        agregarProductoAlCarrito($product_id, $quantity, $product_price, $carrito_invitado);
    }
}
?>
