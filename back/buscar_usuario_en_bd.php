<?php

    include "../config/conexion.php";
function buscar_usuario($usuario) {
        global $conexion;
        $query = "SELECT usuario, email FROM usuarios WHERE usuario = '$usuario'";
        
        $resultado = mysqli_query($conexion, $query);
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $fila = mysqli_fetch_assoc($resultado);
            return $fila; // Devuelve el resultado como un arreglo
        }
        return null; // Devuelve null si no se encontró el usuario
    }

    // Verifica si la solicitud es POST y contiene el usuario
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario'])) {
        $usuario = $_POST['usuario'];
        $datosUsuario = buscar_usuario($usuario);

        if ($datosUsuario) {
            echo json_encode($datosUsuario);
        } else {
            echo json_encode(["error" => "Usuario no encontrado"]);
        }
    }
?>
