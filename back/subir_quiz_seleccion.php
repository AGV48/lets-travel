<?php

    // se inicia una sesión
    session_start();

    // se llama el archivo conexion.php para conectarse a la base de datos
    include "../config/conexion.php";

    // Recibir los datos del formulario
    $pregunta = $_POST['pregunta'];
    $respuesta_1 = $_POST['respuesta_1'];
    $respuesta_2 = $_POST['respuesta_2'];
    $respuesta_3 = $_POST['respuesta_3'];
    $respuesta_4 = $_POST['respuesta_4'];
    $correcta = $_POST['correcta'];  // Solo una correcta

    // Preparar la consulta
    $query = "INSERT INTO preguntas_seleccion (pregunta, respuesta_1, respuesta_2, respuesta_3, respuesta_4, correcta) 
            VALUES ('$pregunta', '$respuesta_1', '$respuesta_2', '$respuesta_3', '$respuesta_4', '$correcta')";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $query)) {
        echo '
            <script>
                alert("Pregunta subida exitosamente");
                window.location = "../back/paises/colombia/quiz_seleccion.php";
            </script>';
    } else {
        echo '
            <script>
                alert("Error al subir la pregunta");
                window.location = "../back/paises/colombia/quiz_seleccion.php";
            </script>';
    }
?>
