<?php

    // Datos de conexión tomados de xampp
    $servidor = "localhost";
    $usuario = "root";
    $contrasena = "";

    $quey = "drop database lets_travel";
    $conexion = new mysqli($servidor, $usuario, $contrasena);
    $conexion->query($quey);
    echo '
        <script>
            alert("Base de datos eliminada exitosamente");
            window.location = "../index.php";
        </script>';
?>