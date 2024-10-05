<?php

    // se inicia una sesión
    session_start();

    // se llama el archivo conexion.php para conectarse a la base de datos
    include "../config/conexion.php";

    $titulo = $_POST['titulo'];
    $tipo = $_POST['tipo'];
    $descripcion = $_POST['descripcion'];
    $ruta = $_POST['ruta'];

    $query = "INSERT INTO contenido (titulo, tipo, descripcion, ruta) VALUES ('$titulo', '$tipo', '$descripcion', '$ruta')";
    if (mysqli_query($conexion, $query)) {
        echo '
            <script>
                alert("Contenido subido exitosamente");
                window.location = "../back/paises/colombia/contenido.php";
            </script>';
    } else {
        echo '
            <script>
                alert("Error al subir el contenido");
                window.location = "../back/paises/colombia/contenido.php";
            </script>';
    }
?>
