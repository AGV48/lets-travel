<?php
    // se llama el archivo conexion.php para conectarse a la base de datos
    include "../config/conexion.php";

    // se obtienen los datos del formulario de registro
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    
    // se verifica si la contraseña tiene al menos 8 caracteres    
    if (strlen($contrasena) < 8){
        echo '
            <script>
                alert("La contraseña debe tener al menos 8 caracteres");
                window.location = "../front/registro.html";
            </script>';
        exit();
    }

    // se verifica si el email es de gmail, hotmail u outlook
    if (str_contains($email, "@gmail.com") or str_contains($email, "@hotmail.com") or str_contains($email, "@outlook.com")){
    } else {
        echo '
            <script>
                alert("Email inválido");
                window.location = "../front/registro.html";
            </script>';
        exit();
    }

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