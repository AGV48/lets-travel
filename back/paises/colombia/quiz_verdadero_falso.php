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
    $query = "SELECT * FROM preguntas_verdadero_falso";
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
    <div class="div_superior">
            <header>
                <nav>
                    <ul class="ul1">
                        <a href="../../../index.php"><li><h3>Let's Travel !</h3></li></a>
                        <a href="../../../index.php"><li><img src="../../../front/sources/guacamayo.png" width="50" height="50"></li></a>
                        <div class="div_interno">
                            <ul class="ul2">
                                <li><a href="../../reunion.php"><font color="white">Reuniones</font></a></li>
                                <li><a href=inicio><font color="white">Chats</font></a></li>
                                <li><a href="../../../front/aprendizaje.html"><font color="white">Aprendizaje</font></a></li>
                                <li><a href="../../../front/biblioteca_cultural.html"><font color="white">Biblioteca Cultural</font></a></li>
                                <li><a href="../../resenas.php"><font color="white">Reseñas y Acerca De</font></a></li>
                            </ul>
                        </div>
                        <li><a href="usuario.php"><img src="../../../front/sources/acceso.png" width="50" height="50"></a></li>
                    </ul>
                </nav>
            </header>
    </div>

    <center>
        <h1>Quiz Verdadero o Falso</h1>

        <!-- Si el usuario es admin, mostrar la opción de subir contenido -->
        <?php if ($nombre === 'admin'): ?>
            <div class="subir_contenido">
                <h2>Subir Pregunta</h2>
                <form action="../../subir_quiz_verdadero_falso.php" method="POST">
                    <input type="text" class="input" placeholder="Pregunta" name="pregunta" autocomplete="off" required><br><br>
                    
                    <br>
                    
                    <div class="respuestas">
                        <input type="radio" name="correcta" value="verdadero"><h3>Verdadero</h3>
                    </div>
                    
                    <div class="respuestas">
                        <input type="radio" name="correcta" value="falso"><h3>Falso</h3>
                    </div>

            
                    <button type="submit" class="btn_subir">Subir Pregunta</button>
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
                        <form action="../../eliminar_quiz_verdadero_falso.php" method="POST">
                            <input type="hidden" name="pregunta" value="<?php echo $fila['pregunta']; ?>">
                            <!-- /* From Uiverse.io by boryanakrasteva */ -->
                            <button class="btn">
                            <svg viewBox="0 0 15 17.5" height="17.5" width="15" xmlns="http://www.w3.org/2000/svg" class="icon">
                            <path transform="translate(-2.5 -1.25)" d="M15,18.75H5A1.251,1.251,0,0,1,3.75,17.5V5H2.5V3.75h15V5H16.25V17.5A1.251,1.251,0,0,1,15,18.75ZM5,5V17.5H15V5Zm7.5,10H11.25V7.5H12.5V15ZM8.75,15H7.5V7.5H8.75V15ZM12.5,2.5h-5V1.25h5V2.5Z" id="Fill"></path>
                            </svg>
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
                <h2><?php echo $fila['pregunta']; ?></h2>
                <div class="respuestas">
                    <input type="radio" value="1">
                    <h3>Verdadero</h3>
                </div>
                <div class="respuestas">
                    <input type="radio" value="2">
                    <h3>Falso</h3>
                </div>

                <form action="">
                    <button class="btn_subir">Seleccionar</button>
                </form>
            </div>
        <?php endwhile; ?>

        </div>
    </center>

</body>
</html>
