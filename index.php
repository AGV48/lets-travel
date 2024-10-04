<?php
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
                                <li><a href=inicio>Meetings</a></li>
                                <li><a href=inicio>Chats</a></li>
                                <li><a href=inicio>Learning</a></li>
                                <li><a href=inicio>Lugares y Comida</a></li>
                                <li><a href=inicio>Acerca</a></li>
                            </ul>
                        </div>
                        <li><a href="front/inicio_sesion.html" title="iniciar sesión iconos"><img src="front/sources/acceso.png" width="50" height="50"></a></li>
                    </ul>
                </nav>
            </header>
        </div>

        <div class="contenedor">
            <img src="front/sources/paisaje.webp" width="700" height="325" class="img">
            <div class="div-botones">
                <h1>¡La forma más divertida y efectiva de aprender de una cultura!</h1>
                <form action="front/registro.html">
                    <button class="btn">Crear Cuenta</button>
                </form>
                <form action="front/inicio_sesion.html">
                    <button class="btn">Inciar Sesión</button>
                </form>
            </div>
        </div>

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
                <li><h3>Disponible!</h3></li>
                <li><h3>Próximamente!</h3></li>
                <li><h3>Próximamente!</h3></li>
                <li><h3>Próximamente!</h3></li>
                <li><h3>Próximamente!</h3></li>
            </ul>
        </div>

        <div class="contenedor">
            <div class="div-botones">
                <h1>Prepárate para sumergirte en nuevas culturas</h1>
                <h3>Descubre, Aprende y Conéctate antes de viajar. Vive una experiencia cultural enriquecida</h3>
            </div>
            <img src="front/sources/pueblo.jpeg" width="700" height="325" class="img">
        </div>

        <div class="contenedor">
            <img src="front/sources/roma.jpg" width="700" height="325" class="img">
            <div class="div-botones">
                <h1>Explora el mundo desde tu pantalla</h1>
                <h3>Nuestro aplicativo está diseñado para ofrecer un conocimiento profundo y practico de la cultura, costumbres y lenguaje
                    del destino que visitarás. Ya sea que estés planeando unas vacaciones o una estadía prolongada, nuestra plataforma te prepara para
                    sumergirte con confianza en tu nuevo entorno cultural
                </h3>
            </div>
        </div>

        <br>
        
        <div>
            <h1>Chat y conexiones locales en tiempo real</h1>
            <h3 class="h3-inferior">Conecta con locales o viajeros experimentados que ya han visitado el destino. Resuelve tus dudas en tiempo real y obtén
                consejos sobre la cultura y el idioma. También podrás agendar encuentros presenciales o virtuales con otros viajeros
            </h3>
            <center>
                <img src="front/sources/burbuja-de-dialogo.png" alt="" width="50" height="50">
            </center>
        </div>

        <br>

        <div>
            <h1 class="h1-inferior">¿Listo para tu proxima aventura?</h1>
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