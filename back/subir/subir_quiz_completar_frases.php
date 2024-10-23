<?php

    // se inicia una sesión
    session_start();

    // se llama el archivo conexion.php para conectarse a la base de datos
    include "../../config/conexion.php";

    // Recibir los datos del formulario
    $frase = $_POST['frase'];
    $correcta = $_POST['correcta'];

    // Dividir la frase en palabras
    $palabras = explode(' ', $frase);

    // Elegir una palabra aleatoria (sin incluir palabras cortas si lo prefieres)
    do {
        $indiceAleatorio = rand(0, count($palabras) - 1);
        $palabraSeleccionada = $palabras[$indiceAleatorio];
    } while (strlen($palabraSeleccionada) < 4); // Puedes cambiar este criterio

    // Reemplazar la palabra seleccionada con un espacio en blanco (o input)
    $fraseIncompleta = str_replace($palabraSeleccionada, '_____', $frase);

    // Guardar la frase con la palabra faltante en la base de datos
    $query = "INSERT INTO preguntas_completar_frases (frase, correcta) VALUES ('$fraseIncompleta', '$palabraSeleccionada')";
    mysqli_query($conexion, $query);

    echo '
        <script>
            alert("Quiz subido exitosamente.");
            window.location = ../paises/colombia/quiz_completar_frases.php";
        </script>';
    header("Location: ../ruta_a_la_pagina_donde_se_muestra_el_quiz.php");
    exit();
?>
