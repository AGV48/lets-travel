<?php
// Iniciar sesión y conexión a la base de datos
session_start();
include "../../config/conexion.php";

// Obtener datos del formulario
$pregunta = $_POST['pregunta'];
$respuesta_usuario = $_POST['respuesta'];

// Consultar la respuesta correcta de la pregunta en la base de datos
$query = "SELECT correcta FROM preguntas_seleccion WHERE pregunta = '$pregunta'";
$resultado = mysqli_query($conexion, $query);
$fila = mysqli_fetch_assoc($resultado);
$respuesta_correcta = $fila['correcta'];

// Verificar si la respuesta es correcta o incorrecta
if ($respuesta_usuario == $respuesta_correcta) {
    echo '
        <script>
            alert("¡Correcto!");
            window.location = "../paises/colombia/quiz_seleccion.php";
        </script>';
} else {
    echo '
        <script>
            alert("Incorrecto. Intenta nuevamente.");
            window.location = "../paises/colombia/quiz_seleccion.php";
        </script>';
}
?>
