<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Productos</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Young+Serif">
    <style>
        /* Estilos para los botones y el campo de cantidad */
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
            background-color: #e62200; /* Cambio de color al pasar el ratón por encima */
        }

        .quantity-input {
            width: 40px;
            padding: 2px;
            font-size: 16px;
        }

        /* Estilos para la barra superior */
        .top-bar {
            font-family: 'Young Serif', sans-serif;
            background-color: #f73309;
            color: black;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        /* Estilos para el título en la barra superior */
        .title {
            margin: 0;
        }

        /* Estilos para los productos */
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

        /* Estilos para el carrito de compras */
        .cart {
            float: right;
            margin-top: 10px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <!-- Barra superior -->
    <div class="top-bar">
        <h1 class="title">LAS MEJORES COMPRAS ONLINE</h1>
        <div class="cart">
            <!-- Agregar icono del carrito aquí -->
            <a href="carrito.php" class="product-button">Ver Carrito</a>
        </div>
    </div>

    <!-- Contenido de la página -->
    <div>
        <?php
        if (isset($_GET['category_id']) || isset($_POST['search'])) {
        $nameProduct = $_POST['search'];
        if (isset($_GET['category_id'])) {
        // Recibe los parámetros category_id y subcategory_id desde subcategorias.php
        $category_id = $_GET['category_id'];
        $subcategory_id = $_GET['subcategory_id'];

        // Realiza el query para obtener los productos de la categoría y subcategoría
        // Asegúrate de ajustar esto según la estructura de tu base de datos
        include('conexion.php');
        $query = "SELECT P.product_id, P.nombre, P.descripcion, L.price_list AS precio FROM product P INNER JOIN price L ON L.product_id = P.product_id 
            WHERE P.category_id = $category_id AND P.sub_category_id = $subcategory_id";
        $result = mysqli_query($conex, $query);
        }

        if (isset($_POST['buscar'])) {
            // $nameProduct = $_GET['search'];
            // echo "No se encontraron subcatego $nameProduct";
            echo "<h1>Subcategorías de $nameProduct</h1>";
        }
        
        // Muestra los productos
        while ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row['product_id'];
            $product_name = $row['nombre'];
            $product_description = $row['descripcion'];
            $product_price = $row['precio'];
            
            // Genera un bloque de producto para cada resultado
            ?>
            <div class="product-container">
                <div class="product-info">
                    <h2><?php echo $product_name; ?></h2>
                    <p><?php echo $product_description; ?></p>
                    <p>Precio: Q<?php echo $product_price; ?></p>
                </div>
                <div class="product-controls">
                    <button class="product-button">Añadir al Carrito</button>
                    <input type="number" class="quantity-input" value="1" min="1">
                </div>
                </div>
            <?php
        }

        // Cierra la conexión a la base de datos
        mysqli_close($conex);
        }
        ?>
    </div>
</body>
</html>
