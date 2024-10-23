<?php

    //se inicia una sesión
    session_start();

    // Se llama el archivo conexión.php para conectarse a la base de datos
    include "../config/conexion.php";

    // Se verifica si el usuario no ha iniciado sesión
    if(!isset($_SESSION['usuario'])){
        echo '
        <script> 
            alert("Debes iniciar sesión para acceder a esta página");
            location.href = "../index.php";
        </script>';
        exit();
    }

    // se crea la consulta para obtener las reseñas de los usuarios
    $query = "SELECT * FROM resenas";
    // se ejecuta la consulta
    $resultado = mysqli_query($conexion, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reseñas y Acerca De</title>
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

    <br>

    <center>
        <h1><font color="#399ed8">¿Como Puedes Contactarnos?</font></h1>
        <div class="contacto">
            <h3>Correo: letstravel@gmail.com</h3>
            <h3>Intagram: @letstravel_</h3>
            <h3>WhatsApp: 3196102618</h3>
        </div>
        
        <br>

        <h1><font color="#399ed8">Reseñas</font></h1>
        <div class="subir_contenido">
            <h2>Comparte tu reseña</h2>
            <form action="../back/subir/subir_resena.php" method="POST">
                <input type="text" class="input" placeholder="Reseña" name="resena" autocomplete="off" required><br><br>
                <button type="submit" class="btn_subir">Enviar reseña</button>
            </form>
        </div>

        <!-- Aquí van las reseñas de los usuarios -->
        <div class="contenido_disponible">
            <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
                    <div class="contenido_item">
                        <h2><?php echo $fila['usuario']; ?></h2>
                        <p><?php echo $fila['resena']; ?></p>
                    </div>
            <?php endwhile; ?>
        </div>
    </center>
</body>
</html>