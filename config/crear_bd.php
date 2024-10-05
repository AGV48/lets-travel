<?php

    $servidor = "localhost";
    $usuario = "root";
    $contrasena = "";
    $nombre_bd = "lets_travel";

    // Crear conexión sin seleccionar base de datos
    $conexion = new mysqli($servidor, $usuario, $contrasena);

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Verificar si la base de datos existe
    $sql = "SHOW DATABASES LIKE '$nombre_bd'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows == 0) {
        // Si no existe, crear la base de datos
        $sql_crear_bd = "CREATE DATABASE $nombre_bd";
        if ($conexion->query($sql_crear_bd) === TRUE) {
        } 
        else {
            die("Error al crear la base de datos: " . $conexion->error);
        }

        // Seleccionar la base de datos
        $conexion->select_db($nombre_bd);

        // Crear las tablas necesarias
        $sql_crear_tabla = "
            CREATE TABLE usuarios (
                usuario VARCHAR(50) NOT NULL PRIMARY KEY,
                email VARCHAR(50),
                contrasena VARCHAR(30)
            )
        ";
        if ($conexion->query($sql_crear_tabla) === TRUE) {
        } else {
            die("Error al crear la tabla: " . $conexion->error);
        }
    } else {
        // Seleccionar la base de datos si ya existe
        $conexion->select_db($nombre_bd);
    }
?>
