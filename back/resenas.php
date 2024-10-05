<?php

    include "../config/conexion.php";

    $query = "SELECT * FROM resenas";
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
    <form action="../index.php">
        <button class="btn_volver">Volver al inicio</button>
    </form>

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
            <form action="../back/subir_resena.php" method="POST">
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