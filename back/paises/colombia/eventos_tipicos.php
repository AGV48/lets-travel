<?php
// Iniciar sesión
session_start();

// Conexión a la base de datos
include "../../../config/conexion.php";

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    echo '
    <script> 
        alert("Debes iniciar sesión para acceder a esta página");
        location.href = "../../../index.php";
    </script>';
    exit();
}

// Obtener mes y año actual o de la navegación
$mes = isset($_GET['mes']) ? (int)$_GET['mes'] : date('m');
$año = isset($_GET['año']) ? (int)$_GET['año'] : date('Y');

// Ajustar el mes y año al navegar
if ($mes < 1) {
    $mes = 12;
    $año--;
} elseif ($mes > 12) {
    $mes = 1;
    $año++;
}

// Consulta para obtener eventos del mes actual
$query = "SELECT fecha, descripcion FROM eventos_colombia WHERE MONTH(fecha) = $mes AND YEAR(fecha) = $año ORDER BY fecha";
$resultado = mysqli_query($conexion, $query);

// Almacenar los eventos en un arreglo
$eventos = [];
while ($row = mysqli_fetch_assoc($resultado)) {
    $eventos[$row['fecha']] = $row['descripcion'];
}

// Función para generar el calendario del mes actual
function mostrarCalendario($año, $mes, $eventos) {
    $primer_dia = date('N', strtotime("$año-$mes-01"));
    $dias_en_mes = date('t', strtotime("$año-$mes-01"));
    
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th colspan='7'>" . date('F Y', strtotime("$año-$mes-01")) . "</th></tr>";
    echo "<tr><th>Lun</th><th>Mar</th><th>Mié</th><th>Jue</th><th>Vie</th><th>Sáb</th><th>Dom</th></tr><tr>";

    // Espacios en blanco antes del primer día del mes
    for ($i = 1; $i < $primer_dia; $i++) {
        echo "<td></td>";
    }

    // Llenar los días del mes
    for ($dia = 1; $dia <= $dias_en_mes; $dia++) {
        $fecha_actual = "$año-$mes-" . str_pad($dia, 2, '0', STR_PAD_LEFT);

        // Verificar si hay un evento para la fecha actual
        if (isset($eventos[$fecha_actual])) {
            echo "<td style='background-color: #ffeb3b;'><strong>$dia</strong><br>{$eventos[$fecha_actual]}</td>";
        } else {
            echo "<td>$dia</td>";
        }

        // Saltar a la siguiente fila después del domingo
        if (($dia + $primer_dia - 1) % 7 == 0) {
            echo "</tr><tr>";
        }
    }

    // Espacios en blanco al final de la última fila
    $dias_restantes = 7 - (($dias_en_mes + $primer_dia - 1) % 7);
    for ($i = 0; $i < $dias_restantes && $dias_restantes < 7; $i++) {
        echo "<td></td>";
    }

    echo "</tr></table><br>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario de Eventos</title>
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
                            <li><a href="reunion.php"><font color="white">Reuniones</font></a></li>
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

    <br>

    <center>
        <h1><font color="#399ed8">Calendario de Eventos en Colombia</font></h1>
        
        <div class="calendario">
            <!-- Navegación para moverse entre meses -->
            <form method="GET" action="">
                <input type="hidden" name="mes" value="<?php echo $mes - 1; ?>">
                <input type="hidden" name="año" value="<?php echo $año; ?>">
                <button type="submit" class= "btn_avanzar"><img src="../../../front/sources/retroceder.png" width = "25" height = "25"></button>
            </form>
            
            <?php mostrarCalendario($año, str_pad($mes, 2, '0', STR_PAD_LEFT), $eventos); ?>

            <form method="GET" action="">
                <input type="hidden" name="mes" value="<?php echo $mes + 1; ?>">
                <input type="hidden" name="año" value="<?php echo $año; ?>">
                <button type="submit" class= "btn_avanzar"><img src="../../../front/sources/avanzar.png" width = "25" height = "25"></button>
            </form>
        </div>
    </center>
</body>
</html>
