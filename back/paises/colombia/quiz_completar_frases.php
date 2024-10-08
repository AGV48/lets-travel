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
            location.href = "../../../index.php";
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
                <div class="div_eliminar">
                    <?php if ($nombre === 'admin'): ?>
                        <form action="../../eliminar_quiz_completar_frases.php" method="POST">
                            <input type="hidden" name="frase" value="<?php echo $fila['frase']; ?>">
                            <!-- /* From Uiverse.io by boryanakrasteva */ -->
                            <button class="btn">
                            <svg viewBox="0 0 15 17.5" height="17.5" width="15" xmlns="http://www.w3.org/2000/svg" class="icon">
                            <path transform="translate(-2.5 -1.25)" d="M15,18.75H5A1.251,1.251,0,0,1,3.75,17.5V5H2.5V3.75h15V5H16.25V17.5A1.251,1.251,0,0,1,15,18.75ZM5,5V17.5H15V5Zm7.5,10H11.25V7.5H12.5V15ZM8.75,15H7.5V7.5H8.75V15ZM12.5,2.5h-5V1.25h5V2.5Z" id="Fill"></path>
                            </svg>
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
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
