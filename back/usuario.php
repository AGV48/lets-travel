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
    <form action="../index.php">
        <button class="btn_volver">Volver al inicio</button>
    </form>

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