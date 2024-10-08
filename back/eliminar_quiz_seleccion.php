<?php
    // Se inicia la sesión
    session_start();

    // Se llama el archivo conexión.php para conectarse a la base de datos
    include "../config/conexion.php";

    // Obtener el ID del contenido a eliminar
    if (isset($_POST['pregunta'])) {
        $pregunta = $_POST['pregunta'];

        // Preparar la consulta para eliminar el contenido
        $query = "DELETE FROM preguntas_seleccion WHERE pregunta = '$pregunta'";

        // Ejecutar la consulta
        if (mysqli_query($conexion, $query)) {
            echo '
            <script>
                alert("Contenido eliminado correctamente");
                window.location = "../back/paises/colombia/quiz_seleccion.php";
            </script>';
        } else {
            echo '
            <script>
                alert("Error al eliminar el contenido");
                window.location = "../back/paises/colombia/quiz_seleccion.php";
            </script>';
        }
    } else {
        echo '
        <script>
            alert("ID de contenido no válido");
            window.location = "../back/paises/colombia/quiz_seleccion.php";
        </script>';
    }
?>
