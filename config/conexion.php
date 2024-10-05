<?php
    // variables para la conexión a la base de datos tomadas de xampp
    $servidor = "localhost";
    $usuario = "root";
    $contrasena = "";
    $base_datos = "lets_travel";

    // Conexión a la base de datos
    $conexion = mysqli_connect($servidor, $usuario, $contrasena, $base_datos);
?>