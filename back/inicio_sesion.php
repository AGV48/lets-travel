<?php

    // se inicia una sesión
    session_start();
    
    // se llama el archivo conexion.php para conectarse a la base de datos
    include "../config/conexion.php";

    // se obtienen los datos del formulario de inicio de sesión
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // se crea la consulta para verificar si el usuario y la contraseña son correctos
    $validar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contrasena = '$contrasena'");

    // si el usuario y la contraseña son correctos se almacenan los datos del usuario en la sesión
    if (mysqli_num_rows($validar_usuario) > 0) {
        $datos_usuario = mysqli_fetch_assoc($validar_usuario);

        // Almacenar datos del usuario en la sesión
        $_SESSION['usuario'] = [
            'nombre' => $datos_usuario['usuario'],
            'email' => $datos_usuario['email'], 
        ];        
        echo '
            <script>
                alert("Bienvenido");
                window.location = "../index.php";
                </script>';
            }else{
                echo '
                <script>
                alert("Usuario o contraseña incorrectos");
                window.location = "../front/inicio_sesion.html";
            </script>';
    }
?>

