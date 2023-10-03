<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Subcategorías</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Young+Serif">
    <style>
       
        .subcategory-button {
            font-family: 'Young Serif', sans-serif;
            font-size: 18px;
            color: white;
            padding: 10px 20px;
            margin: 10px;
            border: 2px solid #090909; 
            background-color: #5268b9; 
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); 
            text-align: center;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease, border-color 0.3s ease; 
        }

        .subcategory-button:hover {
            background-color: #e62200; 
            transform: translateY(-2px); 
            border-color: #e62200; 
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
    </style>
</head>
<body>
    <div class="top-bar">
    <?php
            if (isset($_GET['category_name'])) {
                $categoryName = $_GET['category_name'];
                echo "<h1>Subcategorías de $categoryName</h1>";
            } else {
                echo "<h1>Subcategorías</h1>";
            }?>
        <h1 class="title">LAS MEJORES COMPRAS ONLINE</h1>
    </div>

    <div>
        <?php
        include('conexion.php');
        if (isset($_GET['category_id'])) {
            $category_id = $_GET['category_id'];
            $selectsql = "SELECT subcategory_id, nombre FROM subcategory WHERE category_id = $category_id AND sub_subcategory_id IS NULL";
            $resultado = mysqli_query($conex, $selectsql);
            
            if (mysqli_num_rows($resultado) > 0) {
                while ($row = mysqli_fetch_assoc($resultado)) {
                    $subcategory_id = $row["subcategory_id"];
                    $subcategory_name = $row["nombre"];
                    echo "<a href='productos.php?subcategory_id=$subcategory_id&category_id=$category_id' class='subcategory-button' >$subcategory_name</a>";
                }
            } else {
                echo "No se encontraron subcategorías para esta categoría.";
            }
            
            // Cierra la conexión a la base de datos
            mysqli_close($conex);
        } else {
            echo "No se ha proporcionado un ID de categoría válido.";
        }
        ?>
    </div>
</body>
</html>
