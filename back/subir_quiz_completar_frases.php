<?php

    // se inicia una sesión
    session_start();

    // se llama el archivo conexion.php para conectarse a la base de datos
    include "../config/conexion.php";

    // Recibir los datos del formulario
    $frase = $_POST['frase'];
    $correcta = $_POST['correcta'];

    // Preparar la consulta
    $query = "INSERT INTO preguntas_completar_frases (frase, correcta) 
            VALUES ('$frase', '$correcta')";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $query)) {
        echo '
            <script>
                alert("Pregunta subida exitosamente");
                window.location = "../back/paises/colombia/quiz_completar_frases.php";
            </script>';
    } else {
        echo '
            <script>
                alert("Error al subir la pregunta");
                window.location = "../back/paises/colombia/quiz_completar_frases.php";
            </script>';
    }
?>
