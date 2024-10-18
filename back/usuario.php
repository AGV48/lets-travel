<?php

    // se inicia una sesión
    session_start();

    // se llama el archivo conexion.php para conectarse a la base de datos
    include "../config/conexion.php";

    // se verifica si el usuario no ha iniciado sesión
    if(!isset($_SESSION['usuario'])){
        echo '
        <script> 
            alert("Debes iniciar sesión para acceder a esta página");
            location.href = "../index.php";
        </script>';
        exit();
    }

    // si el usuario ha iniciado sesión se obtienen los datos del usuario
    $nombre = $_SESSION['usuario']["nombre"];
    $email = $_SESSION['usuario']["email"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
    <link rel="shortcut icon" href="../front/sources/Logo.png">
    <link rel="stylesheet" href="../front/css/estilos.css">
</head>
<body>
    <div class="div_superior">
            <header>
                <nav>
                    <ul class="ul1">
                        <a href="../index.php"><li><h3>Let's Travel !</h3></li></a>
                        <a href="../index.php"><li><img src="../front/sources/guacamayo.png" width="50" height="50"></li></a>
                        <div class="div_interno">
                            <ul class="ul2">
                                <li><a href="reunion.php"><font color="white">Reuniones</font></a></li>
                                <li><a href=inicio><font color="white">Chats</font></a></li>
                                <li><a href="../front/aprendizaje.html"><font color="white">Aprendizaje</font></a></li>
                                <li><a href="../front/biblioteca_cultural.html"><font color="white">Biblioteca Cultural</font></a></li>
                                <li><a href="resenas.php"><font color="white">Reseñas y Acerca De</font></a></li>
                            </ul>
                        </div>
                        <li><a href="usuario.php"><img src="../front/sources/acceso.png" width="50" height="50"></a></li>
                    </ul>
                </nav>
            </header>
    </div>

    <center>
        <img src="../front/sources/acceso.png" width="300" height="300">
        <!-- se muestran los datos del usuario -->
        <h1><?php echo $nombre; ?></h1>
        <h1><?php echo $email; ?></h1>

        <!-- Solo muestra el botón si el usuario no es "admin" -->
        <?php if ($nombre != "admin"): ?>
            <form action="../front/cambiar_datos.html">
                <button class="btn_volver" id="btn_cambiar">Cambiar Datos</button>
            </form>
        <?php endif; ?>
    </center>
</body>
</html>