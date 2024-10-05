<?php

    include "../config/conexion.php";

    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $validar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contrasena = '$contrasena'");

    if (mysqli_num_rows($validar_usuario) > 0) {
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

