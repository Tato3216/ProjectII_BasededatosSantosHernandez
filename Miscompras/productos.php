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
            <a href="carrito.php" class="product-button">Ver Carrito</a>
        </div>
    </div>
    <div>
        <?php
        if (isset($_GET['category_id']) || isset($_GET['search'])) {
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
                    <p>Unidades Disponibles:<?php echo $product_stock; ?></p>
                </div>
                <div class="product-controls">
                    <button class="product-button">Añadir al Carrito</button>
                    <input type="number" class="quantity-input" value="1" min="1">
                </div>
                </div>
            <?php
        }

        mysqli_close($conex);
        }
        ?>
    </div>
</body>
</html>
