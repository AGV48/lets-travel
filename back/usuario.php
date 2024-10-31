<?php

    // se inicia una sesión
    session_start();

    // se llama el archivo conexion.php para conectarse a la base de datos
    include "../config/conexion.php";


    include "buscar_usuario_en_bd.php";

    // se verifica si el usuario no ha iniciado sesión
    if(!isset($_SESSION['usuario'])){
        echo '
        <script> 
            alert("Debes iniciar sesión para acceder a esta página");
            location.href = "../index.php";
        </script>';
        exit();
    }

    // si el usuario ha iniciado sesión se obtienen los datos del usuario
    $nombre = $_SESSION['usuario']["nombre"];
    $email = $_SESSION['usuario']["email"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
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

    <div class="buscar_usuario">
        <h3>Buscar Usuarios</h3>
        <img src="../front/sources/lupa.png" onclick="abrirVentana()">
    </div>
    <dialog class="ventana">
        <button class="button" onclick="cerrarVentana()">
            <span class="X"></span>
            <span class="Y"></span>
            <div class="close">Close</div>
        </button>

        <br>
        <br>
        <br>

        <form action="buscar_usuario_en_bd.php" id="form_buscar" method="POST">
            <center>
                <h1>Buscar Usuarios</h1><br>
                <input type="text" placeholder="Ingresa el nombre del usuario" class="input_usuarios" name="usuario" autocomplete="off"><br><br>
                <button type="submit" class="btn_subir">Buscar</button>

                <br><br>

                <div id="encontrados" style="display: none;">
                    <h2>Nombre de Usuario:</h2>
                    <h3 class="h3_inferior" id="nombre"></h3>
                    
                    <h2>Correo Electrónico:</h2>
                    <h3 class="h3_inferior" id="correo"></h3>
                </div>
            </center>
        </form>
    </dialog>

    <br>
    <br>
    <br>
    <br>

    <div>
        <center>
            <img src="../front/sources/acceso.png" width="250" height="250">
            <!-- se muestran los datos del usuario -->
            <h1><?php echo $nombre; ?></h1>
            <h1><?php echo $email; ?></h1>
    
            <!-- Solo muestra el botón si el usuario no es "admin" -->
            <?php if ($nombre != "admin"): ?>
                <form action="../front/cambiar_datos.html">
                    <button class="btn_subir" id="btn_cambiar">Cambiar Datos</button>
                </form>
            <?php endif; ?>
        </center>
    </div>

    <script>
    function abrirVentana() {
        const modal = document.querySelector('dialog');
        modal.showModal();
        
        document.querySelector('#form_buscar').addEventListener('submit', function(event) {
            event.preventDefault();

            const usuario = document.querySelector('.input_usuarios').value;

            // Enviar la solicitud AJAX al archivo PHP
            fetch('buscar_usuario_en_bd.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `usuario=${encodeURIComponent(usuario)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                } else {
                    document.getElementById('encontrados').style.display = "block";
                    document.getElementById('nombre').innerText = data.usuario;
                    document.getElementById('correo').innerText = data.email;
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }

    function cerrarVentana() {
        const modal = document.querySelector('dialog');
        modal.close();
        
        // Limpia los datos mostrados
        document.querySelector('.input_usuarios').value = '';
        document.getElementById('nombre').innerText = '';
        document.getElementById('correo').innerText = '';
        document.getElementById('encontrados').style.display = "none";
    }
</script>
</body>
</html>