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
    $query = "SELECT * FROM preguntas_seleccion";
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
                                <li><a href="../../../front/aprendizaje.html"><font color="white">Aprendizaje</font></a></li>
                                <li><a href="../../../front/biblioteca_cultural.html"><font color="white">Biblioteca Cultural</font></a></li>
                                <li><a href="../../resenas.php"><font color="white">Reseñas y Acerca De</font></a></li>
                            </ul>
                        </div>
                        <li><a href="../../usuario.php"><img src="../../../front/sources/acceso.png" width="50" height="50"></a></li>
                    </ul>
                </nav>
            </header>
    </div>

    <center>
        <h1>Quiz Selección Múltiple</h1>

        <!-- Si el usuario es admin, mostrar la opción de subir contenido -->
        <?php if ($nombre === 'admin'): ?>
            <div class="subir_contenido">
                <h2>Subir Pregunta</h2>
                <form action="../../subir/subir_quiz_seleccion.php" method="POST">
                    <input type="text" class="input" placeholder="Pregunta" name="pregunta" autocomplete="off" required><br><br>
                    
                    <br>

                    <div class="respuestas">
                        <input type="text" class="input" placeholder="Respuesta 1" name="respuesta_1" autocomplete="off" required><br><br>
                        <input type="radio" name="correcta" value="1"> Correcta
                    </div>

                    <div class="respuestas">
                        <input type="text" class="input" placeholder="Respuesta 2" name="respuesta_2" autocomplete="off" required><br><br>
                        <input type="radio" name="correcta" value="2"> Correcta
                    </div>

                    <div class="respuestas">
                        <input type="text" class="input" placeholder="Respuesta 3" name="respuesta_3" autocomplete="off" required><br><br>
                        <input type="radio" name="correcta" value="3"> Correcta
                    </div>
                    
                    <div class="respuestas">
                        <input type="text" class="input" placeholder="Respuesta 4" name="respuesta_4" autocomplete="off" required><br><br>
                        <input type="radio" name="correcta" value="4"> Correcta
                    </div>

            
                    <button type="submit" class="btn_subir">Subir Pregunta</button>
                </form>
            </div>
        <?php endif; ?>
    </center>

    <center>
        <!-- Aquí van las preguntas disponibles que se cargan desde la base de datos -->
        <div class="contenido_disponible">
        <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
            <div class="contenido_item">
                <?php if ($nombre === 'admin'): ?>
                    <div class="div_eliminar">
                        <form action="../../eliminar_y_cambiar/eliminar_quiz_seleccion.php" method="POST">
                            <input type="hidden" name="pregunta" value="<?php echo $fila['pregunta']; ?>">
                            <button class="btn">
                                <svg viewBox="0 0 15 17.5" height="17.5" width="15" xmlns="http://www.w3.org/2000/svg" class="icon">
                                    <path transform="translate(-2.5 -1.25)" d="M15,18.75H5A1.251,1.251,0,0,1,3.75,17.5V5H2.5V3.75h15V5H16.25V17.5A1.251,1.251,0,0,1,15,18.75ZM5,5V17.5H15V5Zm7.5,10H11.25V7.5H12.5V15ZM8.75,15H7.5V7.5H8.75V15ZM12.5,2.5h-5V1.25h5V2.5Z" id="Fill"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                <?php endif; ?>
                
                <h2><?php echo $fila['pregunta']; ?></h2>
                
                <!-- Formulario para enviar la respuesta del usuario -->
                <form action="../../verificar/verificar_quiz_seleccion.php" method="POST">
                    <input type="hidden" name="pregunta" value="<?php echo $fila['pregunta']; ?>">
                    
                    <div class="respuestas">
                        <input type="radio" name="respuesta" value="1" required>
                        <label><?php echo $fila['respuesta_1']; ?></label>
                    </div>
                    
                    <div class="respuestas">
                        <input type="radio" name="respuesta" value="2" required>
                        <label><?php echo $fila['respuesta_2']; ?></label>
                    </div>
                    
                    <div class="respuestas">
                        <input type="radio" name="respuesta" value="3" required>
                        <label><?php echo $fila['respuesta_3']; ?></label>
                    </div>
                    
                    <div class="respuestas">
                        <input type="radio" name="respuesta" value="4" required>
                        <label><?php echo $fila['respuesta_4']; ?></label>
                    </div>
                    
                    <button type="submit" class="btn_subir">Seleccionar</button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>
    </center>

</body>
</html>
