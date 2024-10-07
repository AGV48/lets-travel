<?php

    // se inicia una sesión
    session_start();

    // Se llama el archivo conexión.php para conectarse a la base de datos
    include "../../../config/conexion.php";

    // Se verifica si el usuario no ha iniciado sesión
    if (!isset($_SESSION['usuario'])) {
        echo '
        <script> 
            alert("Debes iniciar sesión para acceder a esta página");
            location.href = "../index.php";
        </script>';
        exit();
    }

    // Se obtienen los datos del usuario desde la sesión
    $nombre = $_SESSION['usuario']['nombre'];
    $email = $_SESSION['usuario']['email'];

    // Se consulta la base de datos para obtener el contenido disponible
    $query = "SELECT * FROM preguntas_completar_frases";
    $resultado = mysqli_query($conexion, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contenido</title>
    <link rel="shortcut icon" href="../../../front/sources/Logo.png">
    <link rel="stylesheet" href="../../../front/css/estilos.css">
</head>
<body>
    <form action="../../../index.php">
        <button class="btn_volver">Volver al inicio</button>
    </form>

    <center>
        <h1>Quiz Completar Frases</h1>

        <!-- Si el usuario es admin, mostrar la opción de subir contenido -->
        <?php if ($nombre === 'admin'): ?>
            <div class="subir_contenido">
                <h2>Subir Pregunta</h2>
                <form action="../../subir_quiz_completar_frases.php" method="POST">
                    <input type="text" class="input" placeholder="Frase" name="frase" autocomplete="off" required><br><br>
                    
                    <input type="text" class="input" placeholder="Correcta" name="correcta" autocomplete="off" required><br><br>
            
                    <button type="submit" class="btn_subir">Subir Frase</button>
                </form>
            </div>
        <?php endif; ?>
    </center>

    <center>
        <!-- Aquí van las preguntas disponibles que se cargan desde la base de datos -->
        <div class="contenido_disponible">
            <!-- Mostrar las preguntas cargadas -->
            <?php

        // Mostrar las preguntas cargadas desde la base de datos
        while ($fila = mysqli_fetch_assoc($resultado)): ?>
            <div class="contenido_item">
                <h2><?php echo $fila['frase']; ?></h2>
                <br>
                <input type="text" class="respuesta" placeholder="Escribe la palabra faltante" autocomplete="off" required>
                <br><br>

                <form action="">
                    <button class="btn_subir">Seleccionar</button>
                </form>
            </div>
        <?php endwhile; ?>

        </div>
    </center>

</body>
</html>
