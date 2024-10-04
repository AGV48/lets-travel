<?php
    include "../config/conexion.php";

    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    
    $query = "INSERT INTO usuarios (usuario, email, contrasena) VALUES ('$usuario', '$email', '$contrasena')";

    $verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$usuario'");
    if (mysqli_num_rows($verificar_usuario) > 0) {
        echo '
            <script>
                alert("Ya existe un usuario con ese nombre");
                window.location = "../index.php";
            </script>';
        
        exit();
    }

    $registro = mysqli_query($conexion, $query);
    if (!$registro) {
        echo '
            <script>
                alert("Error al registrarse");
                window.location = "../index.php";
            </script>';
    } else {
        echo '
            <script>
                alert("Usuario registrado exitosamente");
                window.location = "../front/inicio_sesion.html";
            </script>';
    }

    mysqli_close($conexion);
?>