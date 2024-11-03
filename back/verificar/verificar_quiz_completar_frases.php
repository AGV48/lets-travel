<?php
// Inicia sesión
session_start();

// Incluye el archivo de conexión a la base de datos
include "../../config/conexion.php";

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    echo '
    <script>
        alert("Debes iniciar sesión para acceder a esta página");
        location.href = "../../../index.php";
    </script>';
    exit();
}

// Recupera la frase y la respuesta del usuario
$frase = $_POST['frase'];
$respuesta_usuario = trim($_POST['respuesta_usuario']);

// Consulta la respuesta correcta para la frase de la base de datos
$query = "SELECT correcta FROM preguntas_completar_frases WHERE frase = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("s", $frase);
$stmt->execute();
$stmt->bind_result($respuesta_correcta);
$stmt->fetch();
$stmt->close();

// Verifica si la respuesta del usuario es correcta
if (strcasecmp($respuesta_usuario, $respuesta_correcta) == 0) {
    echo "
    <script>
        alert('¡Respuesta correcta!'); 
        location.href = '../paises/colombia/quiz_completar_frases.php';
    </script>";
} else {
    echo "
    <script>
        alert('Respuesta incorrecta. Intenta de nuevo.'); 
        location.href = '../paises/colombia/quiz_completar_frases.php';
    </script>";
}
?>
