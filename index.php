<?php
    // llamamos el archivo crear_bd.php para verificar si la base de datos existe, y en caso de que no, crearla
    include "config/crear_bd.php";
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Let's Travel</title>
        <link rel="shortcut icon" href="front/sources/Logo.png">
        <link rel="stylesheet" href="front/css/estilos.css">
    </head>
    <body>
        <div class="div_superior">
            <header>
                <nav>
                    <ul class="ul1">
                        <li><h3>Let's Travel !</h3></li>
                        <li><img src="front/sources/guacamayo.png" width="50" height="50"></li>
                        <div class="div_interno">
                            <ul class="ul2">
                                <li><a href="back/reunion.php"><font color="white">Reuniones</font></a></li>
                                <li><a href=inicio><font color="white">Chats</font></a></li>
                                <li><a href="front/aprendizaje.html"><font color="white">Aprendizaje</font></a></li>
                                <li><a href="front/biblioteca_cultural.html"><font color="white">Biblioteca Cultural</font></a></li>
                                <li><a href="back/resenas.php"><font color="white">Reseñas y Acerca De</font></a></li>
                            </ul>
                        </div>
                        <li><a href="back/usuario.php"><img src="front/sources/acceso.png" width="50" height="50"></a></li>
                    </ul>
                </nav>
            </header>
        </div>

        <form action="config/borrar_bd.php">
            <button>Borrar BD</button>
        </form>

        <div class="contenedor">
            <img src="front/sources/paisaje.webp" width="700" height="325" class="img">
            <center>
                <div>
                    <h1>¡La forma más divertida y efectiva de aprender de una cultura!</h1>
                    <form action="front/registro.html">
                        <button class="btn_registro">Crear Cuenta</button>
                    </form>
                    <form action="front/inicio_sesion.html">
                        <button class="btn_inicio_sesion">Inciar Sesión</button>
                    </form>
                </div>
            </div>
            </center>

        <div class="paises">
            <ul class="ul-banderas-paises">
                <li><img src="front/sources/colombia.png" width="50" height="50"></li>
                <li><img src="front/sources/ecuador.png" width="50" height="50"></li>
                <li><img src="front/sources/argentina.png" width="50" height="50"></li>
                <li><img src="front/sources/brasil.png" width="50" height="50"></li>
                <li><img src="front/sources/peru.png" width="50" height="50"></li>
            </ul>
            <ul class="ul-nombres-paises">
                <li><h2>Colombia</h2></li>
                <li><h2>Ecuador</h2></li>
                <li><h2>Argentina</h2></li>
                <li><h2>Brasil</h2></li>
                <li><h2>Perú</h2></li>
            </ul>
            <ul class="ul-nombres-paises">
                <li><h3><font color="#399ed8">Disponible!</font></h3></li>
                <li><h3><font color="#399ed8">Próximamente!</font></h3></li>
                <li><h3><font color="#399ed8">Próximamente!</font></h3></li>
                <li><h3><font color="#399ed8">Próximamente!</font></h3></li>
                <li><h3><font color="#399ed8">Próximamente!</font></h3></li>
            </ul>
        </div>

        <div class="contenedor">
            <div class="div-botones">
                <h1><font color="#399ed8">Prepárate para sumergirte en nuevas culturas</font></h1>
                <h3>Descubre, Aprende y Conéctate antes de viajar. Vive una experiencia cultural enriquecida</h3>
            </div>
            <img src="front/sources/pueblo.jpeg" width="700" height="325" class="img">
        </div>

        <div class="contenedor">
            <img src="front/sources/roma.jpg" width="700" height="325" class="img">
            <div class="div-botones">
                <h1><font color="#399ed8">Explora el mundo desde tu pantalla</font></h1>
                <h3>Nuestro aplicativo está diseñado para ofrecer un conocimiento profundo y práctico de la cultura, costumbres y lenguaje
                    del destino que visitarás. Ya sea que estés planeando unas vacaciones o una estadía prolongada, nuestra plataforma te prepara para
                    sumergirte con confianza en tu nuevo entorno cultural
                </h3>
            </div>
        </div>

        <br>
        
        <div>
            <h1><font color="#399ed8">Chat y conexiones locales en tiempo real</font></h1>
            <h3 class="h3_inferior">Conecta con locales o viajeros experimentados que ya han visitado el destino. Resuelve tus dudas en tiempo real y obtén
                consejos sobre la cultura y el idioma. También podrás agendar encuentros presenciales o virtuales con otros viajeros
            </h3>
            <center>
                <img src="front/sources/burbuja-de-dialogo.png" alt="" width="50" height="50">
            </center>
        </div>

        <br>

        <div>
            <h1 class="h1_inferior"><font color="#399ed8">¿Listo para tu proxima aventura?</font></h1>
            <h3>Regístrate hoy y comienza a aprender sobre tu proximo destino. Sumérgete en una experiencia cultural enriquecida y prepara tu viaje
                como nunca antes
            </h3>
        </div>

        <br>
        <br>

        <center>
            <p>Tu puente hacia un viaje culturalmente enriquecido. © 2024 Let's Travel. Todos los Derechos Reservados</p>
        </center>
    </body>
</html>