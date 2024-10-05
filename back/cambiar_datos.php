<?php

    // se inicia una sesión
    session_start();

    // se llama el archivo conexion.php para conectarse a la base de datos
    include "../config/conexion.php";

    // se obtienen los datos del formulario de cambio de datos
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $nuevo_usuario = $_POST['nuevo_usuario'];
    
    // se crea la consulta para cambiar el nombre de usuario
    $query = "UPDATE usuarios SET usuario = '$nuevo_usuario' WHERE usuario = '$usuario'";

    // se verifica si el usuario y la contraseña son correctos
    $verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contrasena = '$contrasena'");

    // si el usuario y la contraseña son correctos se ejecuta la consulta
    if (mysqli_num_rows($verificar_usuario) > 0) {
        mysqli_query($conexion, $query);
        
        // se obtienen los datos del usuario con los cambios realizados
        $verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$nuevo_usuario' AND contrasena = '$contrasena'");
        $datos_usuario = mysqli_fetch_assoc($verificar_usuario);

        // se almacenan los datos del usuario en la sesión
        $_SESSION['usuario'] = [
            'nombre' => $datos_usuario['usuario'],
            'email' => $datos_usuario['email'], 
        ];
        echo '
            <script>
                alert("Datos cambiados exitosamente");
                window.location = "../index.php";
                </script>';
                exit();
    }
    else{
        echo '
        <script>
            alert("Usuario o contraseña incorrectos");
            window.location = "../front/cambiar_datos.html";
            </script>';
    }

    mysqli_close($conexion);
?>