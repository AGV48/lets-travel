# Proyecto de una Biblioteca Cultural

## ¿Quién hizo esto?

- Alejandro Gutierrez Vallejo
- Nathalia Vélez Roldán
- Sara Pineda Valencia
- Tomas Ramírez Agudelo
- Walter Stephano Mejía

## ¿Qué es y para qué es?

Este proyecto tiene como objetivo implementar un software que funcione como una biblioteca cultural para aprender sobre el idioma, costumbres y cultura de un país

## ¿Cómo lo hago funcionar?

1. Prerrequisitos:
### Tener Instalado el software XAMPP:

Este software servirá para crear una base de datos local en la cual se guardarán todos los datos de los usuarios y todos los datos que la pagina va a cargar.

Puedes descargarlo en la pagina oficial de XAMPP: `https://www.apachefriends.org/es/index.html`.

2. Descargar el proyecto:
Descargar el proyecto de este GitHub para tener la carpeta con todos los archivos y comenzar a trabajar en el.

3. Guardar la carpeta con el proyecto en la carpeta raíz de XAMPP
- Luego de descargar el proyecto de este GitHub, tienes que buscar la carpeta raíz donde se instalo XAMPP (Normalmente es en el disco local (C:)).
- Luego, dentro de esta carpeta entrar a otra carpeta llamada `htdocs`, allí adentro es donde debes poner la carpeta que descargaste de este repositorio.

4. Cuando ya tengas el proyecto guardado dentro de XAMPP, el siguiente paso es ejecutar `XAMPP Control Panel`. Esto abrirá una ventana en la cual debes darle al botón de start en las opciones `Apache` y `MySQL`.

5. Por último en el navegador debes buscar `localhost/phpmyadmin` para abrir la base de datos; y tambien debes buscar `localhost/(nombre de la carpeta)` para abrir el proyecto, en este ultimo paso debes poner el nombre con el que guardaste la carpeta que contiene este proyecto.

## Estructura sugerida

La estructura del proyecto sigue las prácticas recomendadas para mantener un código organizado y modular. A continuación, se describe la estructura sugerida:

- back: Esta carpeta contiene todo el backend del proyecto, el cual está realizado en php.

- config: Esta carpeta contiene los archivos que realizan la creación de la base de datos, la creación de las tablas y 
la conexión con la base de datos.

- front: Esta carpeta contiene todo lo utilizado para el frontend del proyecto, el cual está realizado en html. ademas hay otras dos carpetas que son las siguientes:

* css: Contiene el css para darle estilos y colores al proyecto

* sources: Contiene todas las imágenes usadas dentro del proyecto, como: iconos, imágenes de fondo, etc.


