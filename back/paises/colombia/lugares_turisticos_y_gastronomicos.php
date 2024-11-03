<?php
    // Iniciar sesión y verificar si el usuario está autenticado
    session_start();
    include "../../../config/conexion.php";

    if(!isset($_SESSION['usuario'])){
        echo '
        <script> 
            alert("Debes iniciar sesión para acceder a esta página");
            location.href = "../../../index.php";
        </script>';
        exit();
    }

    // Obtener el usuario actual
    $nombre = $_SESSION['usuario']['nombre'];
    $email = $_SESSION['usuario']['email'];

    // Verificar si hay filtros aplicados
    $filtro = "";
    if (isset($_GET['categoria'])) {
        $categoria = $_GET['categoria'];
        $filtro = "WHERE categoria = '$categoria'";
    }
    if (isset($_GET['ubicacion'])) {
        $ubicacion = $_GET['ubicacion'];
        $filtro .= ($filtro ? " OR " : "WHERE ") . "ubicacion = '$ubicacion'";
    }

    // Consultar lugares según los filtros
    $query = "SELECT * FROM lugares $filtro";
    $resultado = mysqli_query($conexion, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lugares Turísticos</title>
    <link rel="shortcut icon" href="../../../front/sources/Logo.png">
    <link rel="stylesheet" href="../../../front/css/estilos.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        <h1>Lugares Turísticos y Gastronómicos de Colombia</h1>

        <!-- Filtros dinámicos -->
        <div class="filtros">
            <form id="formFiltros">
                <select name="categoria" id="categoria">
                    <option value="">Seleccione Categoría</option>
                    <option value="turistico">Turístico</option>
                    <option value="gastronomico">Gastronómico</option>
                </select>

                <select name="ubicacion" id="ubicacion">
                    <option value="">Seleccione Ubicación</option>
                    <option value="Bogotá">Bogotá</option>
                    <option value="Medellín">Medellín</option>
                    <option value="Cartagena">Cartagena</option>
                    <option value="Santa Marta">Santa Marta</option>
                    <!-- Agregar más ubicaciones -->
                </select>
            </form>
        </div>

        <div class="resultados" id="resultados">
            <!-- Mostrar lugares según los filtros -->
            <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>                
                <div class="contenido_item">
                    <h2><?php echo $fila['nombre']; ?></h2>
                    <p><?php echo $fila['descripcion']; ?></p>
                    <p>Ubicación: <?php echo $fila['ubicacion']; ?></p>
                    <a href="detalle_lugar.php?id=<?php echo $fila['id']; ?>">Más información</a>
                </div>
            <?php endwhile; ?>
        </div>
    </center>

    <script>
        // Filtrar resultados en tiempo real
        $(document).ready(function(){
            $('#formFiltros select').change(function(){
                $.ajax({
                    url: 'filtrar_lugares.php',
                    type: 'GET',
                    data: $('#formFiltros').serialize(),
                    success: function(data){
                        $('#resultados').html(data);
                    }
                });
            });
        });
    </script>
</body>
</html>
