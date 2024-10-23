<?php
    include "conexion.php";

    $query = "DROP DATABASE lets_travel";

    if ($conexion->query($query) === TRUE) {
        echo '
            <script>
                alert("Base de datos eliminada exitosamente");
                window.location = "../index.php";
            </script>';
    } else {
        echo '
            <script>
                alert("Error al eliminar la base de datos");
                window.location = "../index.php";
            </script>';
    }
?>