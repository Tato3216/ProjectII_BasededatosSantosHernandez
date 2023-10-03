<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <title>Las mejores compras Online</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Young+Serif">
    <style>
        .navbar {
            background-color: #f73309;
            overflow: hidden;
            font-family: 'Young Serif', sans-serif; 
        }

        .navbar a {
            float: left; /* Para alinear a la izquierda */
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
                            $selectsql = "SELECT category_id, name FROM category"; // Cambia 'name' a 'category_name'
                            $resultado = mysqli_query($conex, $selectsql); // Usa '$conex' para la conexión
                            
                            if (mysqli_num_rows($resultado) > 0) { // Cambia '$resultado->num_rows' a 'mysqli_num_rows($resultado)'
                                while ($row = mysqli_fetch_assoc($resultado)) { // Cambia '$resultado->fetch_assoc()' a 'mysqli_fetch_assoc($resultado)'
                                    $categoryId = $row["category_id"];
                                    $categoryName = $row["name"];
                                    echo "<a href='categoria.php?category_id=$categoryId'>$categoryName</a>";   
                                //     echo "<div class='subcategories'> ";
                                //     echo "<div class='subcategory-dropdown'>";
                                //         // echo "<button class='subcategory-dropbtn'>Subcategorías</button>";
                                //         echo "<div class='subcategory-content'>";
                                //         echo "</div>";
                                //     echo "</div>";
                                // echo "</div>";                                
                            }
                        } else {
                            echo "No se encontraron categorías.";
                        }
                        
                        // Cierra la conexión a la base de datos
                        mysqli_close($conex); // Usa '$conex' para cerrar la conexión
                        ?>
                </div>
                    <div class="subcategory-dropdown" id="subcategory-dropdown">
                        <select class="subcategory-content" id="subcategory-content">
                        </select>
                    </div>
                </div> 
        </div>
        <!-- <button class="dropbtn"></button>  -->
        <div class="search-container">
            <form action="#">
                        <input type="text" placeholder="Buscar..." name="search">
                        <button type="submit" class="search-button"><img src="images/lupa1.png" alt="Buscar" width="28" height="28"
                        ></button>
                    </form>
                </div>
                <a href="#" class="login-button">Iniciar Sesión</a>
                <a href="Carrito.php" id="cart-link" class="cart-button"><img src="images/carrito.png" alt="Carrito" width="28" height="28"></a>
            </div>
            <!-- Contenido de la página -->
            <div>
            <div class="season">
                <!-- <a>TEMPORADAS</a><br>    -->
                <a href="pagina-halloween.html" class="season-button season-button-halloween">Halloween</a>
                <a href="pagina-dia-ninos.html" class="season-button season-button-dia-ninos">Día de los niños</a>
                <a href="pagina-navidad.html" class="season-button season-button-navidad">Navidad</a>
            </div>
        </div>
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            var cartLink = document.getElementById("cart-link");

            cartLink.addEventListener("click", function(event) {
                event.preventDefault();

                window.open(this.href, "Carrito de Compras", "width=800,height=600");
            });
        });
        </script>

        <script>
        document.addEventListener("DOMContentLoaded", function () {
            // ... Tu código JavaScript existente ...

            // Agregar un controlador de eventos para cargar las subcategorías cuando se haga clic en una categoría
            var categoriesMenu = document.querySelector(".categories-menu");
            var subcategoriesDiv = document.querySelector(".subcategories");
            var subcategoryDropdown = document.querySelector(".subcategory-dropdown");
            var dropdowncat = document.getElementById("dropdown-content");
            var doprdownsub = document.getElementById(".subcategory-dropdown");

            categoriesMenu.addEventListener("click", function (event) {
                if (event.target.tagName === "A") {
                    event.preventDefault();

                    // Obtener el href del enlace, que contiene el ID de la categoría
                    var href = event.target.getAttribute("href");

                    // Extraer el category_id del href usando una expresión regular
                    var match = href.match(/category_id=(\d+)/);
                    if (match) {
                        var categoryId = match[1];

                        // Hacer una solicitud AJAX para obtener las subcategorías desde el servidor
                        var xhr = new XMLHttpRequest();
                        xhr.open("GET", "obtener_subcategorias.php?category_id=" + categoryId, true);
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                // Insertar las subcategorías en el nuevo dropdown list
                                subcategoryDropdown.innerHTML = xhr.responseText;
                            }
                        };
                        xhr.send();
                    }
                }
            });
            // dropdowncat.addEventListener("change", function () {
            //     // Mostrar el segundo dropdown cuando se selecciona una opción
            //     if (dropdowncat.value !== "") {
            //         doprdownsub.style.display = "block";
            //     } else {
            //         doprdownsub.style.display = "none";
            //     }
            // });
        });

        </script>
</html>

</body>
<?php
// index.php

// Incluye el archivo del controlador
include('controller.php');

// Verifica si se ha hecho clic en el enlace "Iniciar Sesión"
if (isset($_POST['iniciar_sesion'])) {
    // Llama a la función para iniciar sesión
    iniciarSesion();
}

// Obtén el estado actual (invitado o usuario)
$invitado = obtenerEstado();

// Resto del contenido de tu página
// ...
?>
