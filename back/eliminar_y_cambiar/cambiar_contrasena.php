<?php

    // se llama el archivo conexion.php para conectarse a la base de datos
    include "../../config/conexion.php";

    // se obtienen los datos del formulario de cambio de contraseña
    $usuario = $_POST['usuario'];
    $nueva_contrasena = $_POST['nueva_contrasena'];
    
    // se verifica si el usuario es el administrador
    if ($usuario == "admin") {
        echo'
        <script>
            alert("No se puede cambiar la contraseña del administrador");
            window.location = "../index.php";
            </script>';
            exit();
    }

    if (strlen($nueva_contrasena) < 8){
        echo '
            <script>
                alert("La contraseña debe tener al menos 8 caracteres");
                window.location = "../../front/cambiar_contrasena.html";
            </script>';
        exit();
    }

    // se crea la consulta para cambiar la contraseña
    $query = "UPDATE usuarios SET contrasena = '$nueva_contrasena' WHERE usuario = '$usuario'";

    // se verifica si el usuario es correcto
    $verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$usuario'");
    if (mysqli_num_rows($verificar_usuario) > 0) {
        
        // si el usuario es correcto se ejecuta la consulta
        mysqli_query($conexion, $query);
        echo '
            <script>
                alert("contraseña cambiada exitosamente");
                window.location = "../../front/inicio_sesion.html";
                </script>';
                exit();
    }
    else{
        echo '
        <script>
            alert("Usuario incorrecto");
            window.location = "../../front/cambiar_contrasena.html";
            </script>';
    }

    mysqli_close($conexion);
?>