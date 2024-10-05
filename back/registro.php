<?php
    // se llama el archivo conexion.php para conectarse a la base de datos
    include "../config/conexion.php";

    // se obtienen los datos del formulario de registro
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    
    // se crea la consulta para insertar los datos en la base de datos
    $query = "INSERT INTO usuarios (usuario, email, contrasena) VALUES ('$usuario', '$email', '$contrasena')";

    // se verifica si ya existe un usuario con ese nombre
    $verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$usuario'");
    if (mysqli_num_rows($verificar_usuario) > 0) {
        echo '
            <script>
                alert("Ya existe un usuario con ese nombre");
                window.location = "../front/registro.html";
                </script>';
                
                exit();
    }

    // si no existe un usuario con ese nombre se ejecuta la consulta
    $registro = mysqli_query($conexion, $query);
    // se verifica si se ejecutó correctamente la consulta
    if (!$registro) {
        echo '
        <script>
            alert("Error al registrarse");
            window.location = "../front/registro.html";
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