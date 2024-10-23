<?php

    // se inicia una sesión
    session_start();

    // se llama el archivo conexion.php para conectarse a la base de datos
    include "../../config/conexion.php";

    // se obtienen los datos del usuario que subió la reseña
    $usuario = $_SESSION['usuario']['nombre'];

    // se obtienen los datos del formulario de subir reseña
    $resena = $_POST['resena'];

    // se crea la consulta para subir la reseña
    $query = "INSERT INTO resenas (usuario, resena) VALUES ('$usuario', '$resena')";
    if (mysqli_query($conexion, $query)) {
        echo '
            <script>
                alert("Reseña subida exitosamente");
                window.location = "../resenas.php";
            </script>';
    } else {
        echo '
            <script>
                alert("Error al subir la reseña");
                window.location = "../resenas.php";
            </script>';
    }

?>