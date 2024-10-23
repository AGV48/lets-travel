<?php
    session_start();
    include "../config/conexion.php"; // Conexión a la base de datos

    $nombre = $_SESSION['usuario']['nombre'];

    // Verificar si el usuario ha iniciado sesión
    if(!isset($_SESSION['usuario'])){
        echo '
        <script> 
            alert("Debes iniciar sesión para acceder a esta página");
            location.href = "../index.php";
        </script>';
        exit();
    }

    // Si se envía el formulario, guarda la fecha en la base de datos
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fecha_reunion = $_POST['fecha_reunion'];
        
        // Insertar la fecha de la reunión en la base de datos
        $query = "INSERT INTO reuniones (fecha_reunion) VALUES ('$fecha_reunion')";
        mysqli_query($conexion, $query);

        echo '
            <script>
                alert("Fecha de reunión guardada exitosamente.");
            </script>';
    }

    // Consultar la última reunión
    $query = "SELECT * FROM reuniones ORDER BY id DESC LIMIT 1";
    $resultado = mysqli_query($conexion, $query);
    $reunion = mysqli_fetch_assoc($resultado);

    // Obtener la fecha de la reunión guardada y la fecha actual
    $fecha_reunion_guardada = isset($reunion['fecha_reunion']) ? strtotime($reunion['fecha_reunion']) : null;
    $fecha_actual = time();

    // Comparar las fechas
    $mostrar_enlace = false;
    $tiempo_restante = 0;
    $reunion_finalizada = false;

    if ($fecha_reunion_guardada) {
        if ($fecha_reunion_guardada <= $fecha_actual) {
            // Si la reunión es ahora o ya pasó, mostramos el enlace
            $mostrar_enlace = true;

            // Calcular si ha pasado más de 10 minutos después de la reunión
            $diferencia = $fecha_actual - $fecha_reunion_guardada;
            if ($diferencia >= 5184000) { // 5184000 segundos = 1 día
                // Eliminar la reunión de la base de datos
                $query_delete = "DELETE FROM reuniones WHERE id = " . $reunion['id'];
                mysqli_query($conexion, $query_delete);
                $reunion_finalizada = true;
            }
        } else {
            // Si la reunión es futura, calculamos el tiempo restante
            $tiempo_restante = $fecha_reunion_guardada - $fecha_actual;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reuniones</title>
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

    <br><br>

    <center>
        <h1><font color="#399ed8">¡Conéctate Con Otras Personas!</font></h1>
    </center>

    <?php if ($nombre === 'admin'): ?>
        <center>
            <div class="crear_reunion">
                <h1><font color="#399ed8">¡Programa una reunión!</font></h1>
            
                <form method="POST" action="">
                    <label for="fecha_reunion"><font color="black">Selecciona la fecha y hora de la reunión:</font></label>
                    <input type="datetime-local" id="fecha_reunion" name="fecha_reunion" required>
                    <br><br>
                    <button type="submit" class="btn_subir">Guardar reunión</button>
                </form>
            </div>
        </center>
    <?php endif; ?>

    <br><br>

    <?php if ($reunion_finalizada): ?>
        <center><h2>La reunión ha finalizado y fue eliminada.</h2></center>
    <?php elseif ($fecha_reunion_guardada): ?>
        <?php if ($mostrar_enlace): ?>
            <!-- Mostrar el enlace si la reunión es ahora o ya pasó -->
            <center>
                <div>
                    <h1><a href="https://meet.google.com/nkc-ttay-ptd" target="_blank">Unirse a la Reunión</a></h1>
                </div>
            </center>
        <?php else: ?>
            <!-- Mostrar el contador si la reunión es futura -->
            <center>
            <div id="contador" class="contador"></div>
            <script>
                // Convertir el tiempo restante desde PHP a JavaScript (en milisegundos)
                let tiempoRestante = <?php echo $tiempo_restante; ?>;

                // Función para actualizar el contador
                function actualizarContador() {
                    const contadorElement = document.getElementById('contador');
                    
                    const dias = Math.floor(tiempoRestante / (60 * 60 * 24));
                    const horas = Math.floor((tiempoRestante % (60 * 60 * 24)) / (60 * 60));
                    const minutos = Math.floor((tiempoRestante % (60 * 60)) / 60);
                    const segundos = tiempoRestante % 60;

                    contadorElement.innerHTML = 
                        "Tiempo restante para la reunión: " +
                        (dias > 0 ? dias + "d " : "") +
                        (horas < 10 ? "0" + horas : horas) + ":" +
                        (minutos < 10 ? "0" + minutos : minutos) + ":" + 
                        (segundos < 10 ? "0" + segundos : segundos);

                    tiempoRestante--;

                    // Si el tiempo se acaba, recargar la página para mostrar el enlace
                    if (tiempoRestante <= 0) {
                        window.location.reload();
                    }
                }

                // Actualizar el contador cada segundo
                setInterval(actualizarContador, 1000);
            </script>
            </center>
        <?php endif; ?>
    <?php endif; ?>

</body>
</html>
