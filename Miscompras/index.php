<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Las mejores compras Online</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Young+Serif">
    <style>
        /* Estilos CSS para la barra de navegación */
        .navbar {
            background-color: #f73309;
            overflow: hidden;
            font-family: 'Young Serif', sans-serif; 
        }

        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-family: 'Young Serif', sans-serif; 
        }

        .season {
            display: flex;
            flex-wrap: wrap;
            gap: 10px; 
        }

        .season a {
            display: block;
            color: black;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-family: 'Young Serif', sans-serif; 
        }

        /* Cambiar color al pasar el ratón por encima */
        .navbar a:hover {
            background-color: #ddd;
            color: black;
            font-family: 'Young Serif', sans-serif; 
        }

        /* Dropdown list */
        .dropdown {
            float: left;
            overflow: hidden;
        }

        .dropdown .dropbtn {
            font-size: 16px;
            border: none;
            outline: none;
            color: black;
            background-color: inherit;
            margin: 0;
            margin-top: 10px;
        }

        .navbar a, .dropdown:hover .dropbtn {
            background-color: #f73309;
            color: black;
            font-family: 'Young Serif', sans-serif; 
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border: 1px solid #ccc;
        }

        .dropdown-content a {
            float: none;
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Barra de búsqueda */
        .search-container {
            float: left;
            margin-top: 10px;
            margin-left: 20px;
        }

        .subcategory-content {
            background: #333;
            display: none;
            position: absolute;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border: 1px solid #ccc;
        }

        .search-container input[type=text] {
            padding: 6px;
            margin-top: 0px;
            font-size: 14px;
            border: none;
        }

        .search-container button {
            padding: 6px 10px;
            margin-top: 5px;
            margin-left: 5px;
            background: #333;
            color: white;
            border: none;
            cursor: pointer;
        }

        .search-container button:hover {
            background: #ddd;
            color: black;
        }

        .login-button {
            float: right; 
            margin-top: 10px;
            margin-right: 20px;
        }

        .search-button {
            background-color: red;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }

        /* Botón de Carrito de Compras */
        .cart-button {
            float: right;
            margin-top: 10px;
            margin-right: 10px;
        }

        .dropbtn {
            background-color: #f73309;
            color: black;
            font-family: 'Young Serif', sans-serif; 
        }

        .season-button {
            font-family: 'Young Serif', sans-serif;
            font-size: 24px;
            color: black;
            text-shadow: -1px -1px 1px white, 1px -1px 1px white, -1px 1px 1px white, 1px 1px 1px white;
            padding: 20px 40px;
            border: none;
            cursor: pointer;
            margin: 10px;
            height: 150px;
            width: 250px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .season-button-halloween {
            background-image: url('images/halloween.jpg');
        }

        .season-button-dia-ninos {
            background-image: url('images/ninos.jpg');
        }

        .season-button-navidad {
            background-image: url('images/navidad.jpg');
        }
    </style>
</head>
<body>
    <!-- Barra de navegación -->
    <div class="navbar">
        <a>LAS MEJORES COMPRAS ONLINE</a>
        <div class="dropdown">
            <a href="#">Categorías</a>
            <div id="dropdown-content" class="dropdown-content">
                <div class="categories-menu">
                    <?php
                    include('conexion.php');
                    // Consulta SQL para obtener las categorías
                    $selectsql = "SELECT category_id, name FROM category";
                    $resultado = mysqli_query($conex, $selectsql);
                    
                    if (mysqli_num_rows($resultado) > 0) {
                        while ($row = mysqli_fetch_assoc($resultado)) {
                            $categoryId = $row["category_id"];
                            $categoryName = $row["name"];
                            // Agregar enlace a la página de subcategorías con el category_id
                            echo "<a href='subcategorias.php?category_id=$categoryId&category_name=$categoryName'>$categoryName</a>";
                        }
                    } else {
                        echo "No se encontraron categorías.";
                    }
                    
                    // Cierra la conexión a la base de datos
                    mysqli_close($conex);
                    ?>
                </div>
            </div>
        </div>
        <div class="search-container">
            <form action="productos.php" method="GET">
                <input type="text" id="search" placeholder="Buscar..." name="search">
                <button type="submit" name="buscar" class="search-button"><img src="images/lupa1.png" alt="Buscar" width="28" height="28"></button>
            </form>
        </div>
        <a href="#" class="login-button">Iniciar Sesión</a>
        <a href="Carrito.php" id="cart-link" class="cart-button"><img src="images/carrito.png" alt="Carrito" width="28" height="28"></a>
    </div>
    <!-- Contenido de la página -->
    <div>
        <div class="season">
            <a href="pagina-halloween.html" class="season-button season-button-halloween">Halloween</a>
            <a href="pagina-dia-ninos.html" class="season-button season-button-dia-ninos">Día de los niños</a>
            <a href="pagina-navidad.html" class="season-button season-button-navidad">Navidad</a>
        </div>
    </div>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var cartLink = document.getElementById("cart-link");

        cartLink.addEventListener("click", function(event) {
            event.preventDefault();
            
            window.open(this.href, "Carrito de Compras", "width=800,height=600");
        });
    });
</script>
<?php
// include('subcategorias.php');
?>
</html>
