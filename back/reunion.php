<?php

    // se inicia una sesión
    session_start();

    // Se verifica si el usuario no ha iniciado sesión
    if(!isset($_SESSION['usuario'])){
        echo '
        <script> 
            alert("Debes iniciar sesión para acceder a esta página");
            location.href = "../index.php";
        </script>';
        exit();
    }

    // Duración del temporizador en segundos (5 minutos = 300 segundos)
    $duracion = 0.15 * 60; 

    // Obtener la hora actual
    $hora_actual = time();

    // Si no existe una hora de finalización almacenada en la sesión, calcularla
    if (!isset($_SESSION['tiempo_fin'])) {
        $_SESSION['tiempo_fin'] = $hora_actual + $duracion;
    }

    // Obtener la hora de finalización desde la sesión
    $tiempo_fin = $_SESSION['tiempo_fin'];

    // Calcular el tiempo restante
    $tiempo_restante = $tiempo_fin - $hora_actual;

    // Si el tiempo ya se acabó, reiniciar la cuenta regresiva
    if ($tiempo_restante <= 0) {
        // Reiniciar el temporizador
        $_SESSION['tiempo_fin'] = $hora_actual + $duracion;
        $tiempo_restante = $duracion;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contador de 5 Minutos</title>
    <link rel="shortcut icon" href="../front/sources/Logo.png">
    <link rel="stylesheet" href="../front/css/estilos.css">
</head>
<body>
    
    <form action="../index.php">
        <button class="btn_volver">Volver al inicio</button>
    </form>
    <br><br>

    <h1><font color="#399ed8">¡Conéctate con otras personas!</font></h1>

    <center>
        <div class="div_contador">
            <h2>Tiempo restante para la proxima reunion</h2>
            <div id="contador" class="contador"></div>
            <div class="mensaje" id="mensaje">
                <a href="https://meet.google.com/nkc-ttay-ptd">https://meet.google.com/nkc-ttay-ptd</a>
            </div>
        </div>
    </center>

    <script>
        // Obtener el tiempo restante desde PHP (convertido a milisegundos para JavaScript)
        let tiempoRestante = <?php echo $tiempo_restante; ?>;

        // Función para actualizar el contador
        function actualizarContador() {
            const contadorElement = document.getElementById('contador');

            // Calcular los minutos y segundos restantes
            const minutos = Math.floor(tiempoRestante / 60);
            const segundos = tiempoRestante % 60;

            // Mostrar el tiempo en formato MM:SS
            contadorElement.innerHTML = 
                (minutos < 10 ? "0" + minutos : minutos) + ":" + 
                (segundos < 10 ? "0" + segundos : segundos);

            // Reducir el tiempo en 1 segundo
            tiempoRestante--;

            // Si el tiempo se acaba
            if (tiempoRestante < 0) {
                clearInterval(intervalo); // Detener el contador
                mostrarMensaje(); // Mostrar mensaje de tiempo agotado
            }
        }

        // Mostrar el mensaje y ocultarlo después de 1 minuto
        function mostrarMensaje() {
            const mensajeElement = document.getElementById('mensaje');
            mensajeElement.style.display = 'block'; // Mostrar mensaje

            setTimeout(() => {
                mensajeElement.style.display = 'none'; // Ocultar mensaje después de 1 minuto

                // Recargar la página después de 1 minuto para reiniciar el contador
                window.location.reload();
            }, 60000); // 60,000 ms = 1 minuto
            
        }

        // Iniciar el contador y actualizarlo cada segundo
        const intervalo = setInterval(actualizarContador, 1000);
    </script>

</body>
</html>
