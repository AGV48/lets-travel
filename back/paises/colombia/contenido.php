<?php
    session_start();

    // Se llama el archivo conexión.php para conectarse a la base de datos
    include "../../../config/conexion.php";

    // Se verifica si el usuario no ha iniciado sesión
    if(!isset($_SESSION['usuario'])){
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
    $query = "SELECT * FROM contenido";
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
        <h1>Noticias, Videos y Podcasts Disponibles</h1>

        <!-- Si el usuario es admin, mostrar la opción de subir contenido -->
        <?php if ($nombre === 'admin'): ?>
            <div class="subir_contenido">
                <h2>Subir Noticias, Videos o Podcasts</h2>
                <form action="../../subir_contenido.php" method="POST">
                    <input type="text" class="input" placeholder="Título" name="titulo" autocomplete="off" required><br><br>
                    
                    <label for="tipo">Tipo de contenido:</label>
                    <select name="tipo" id="tipo">
                        <option value="noticia">Noticia</option>
                        <option value="video">Video</option>
                        <option value="podcast">Podcast</option>
                    </select><br><br>

                    <input type="text" class="input" placeholder="Descripción" name="descripcion" autocomplete="off" required><br><br>
                    <input type="text" class="input" placeholder="Link" name="ruta" autocomplete="off" required><br><br>

                    <button type="submit" class="btn_subir">Subir Contenido</button>
                </form>
            </div>
        <?php endif; ?>
    </center>

    <center>
        <!-- Aquí va el contenido disponible que se carga desde la base de datos o archivos -->
        <div class="contenido_disponible">
            <!-- Mostrar contenido cargado: noticias, videos o podcasts -->
            <?php 
            $contador = 0;
            while ($fila = mysqli_fetch_assoc($resultado)): ?>
                <?php if ($contador == 0): 
                    $contador = $contador + 1;?>    
                
                <?php else: ?>
                    <div class="contenido_item">
                        <h2><?php echo $fila['titulo']; ?></h2>
                        <p><?php echo $fila['descripcion']; ?></p>

                        <a href="<?php echo $fila['ruta']; ?>">Ver contenido</a>
                    </div>
                <?php endif; ?>
            <?php endwhile; ?>
        </div>
    </center>

</body>
</html>
