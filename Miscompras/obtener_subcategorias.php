<?php
include('conexion.php');

if (isset($_GET['category_id'])) {
    $categoryId = $_GET['category_id'];

    $selectsql1 = "SELECT subcategory_id, nombre FROM subcategory WHERE category_id = $categoryId AND sub_subcategory_id IS NULL";
    $resultado = mysqli_query($conex, $selectsql1);

    if (mysqli_num_rows($resultado) > 0) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $subcategoryId = $row["subcategory_id"];
            $subcategoryName = $row["nombre"];
            echo "<a href='subcategoria.php?subcategory_id=$subcategoryId'>$subcategoryName</a>";
        }
    } else {
        echo "No se encontraron subcategorías. $categoryId";
    }

    mysqli_close($conex);
}
?>
