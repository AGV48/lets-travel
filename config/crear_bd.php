<?php
    // Datos de conexión tomados de xampp
    $servidor = "localhost";
    $usuario = "root";
    $contrasena = "";

    // Nombre de la base de datos que se va a crear
    $nombre_bd = "lets_travel";

    // Crear conexión sin seleccionar base de datos
    $conexion = new mysqli($servidor, $usuario, $contrasena);

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Verificar si la base de datos existe
    $sql = "SHOW DATABASES LIKE '$nombre_bd'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows == 0) {
        // Si no existe, crear la base de datos
        $sql_crear_bd = "CREATE DATABASE $nombre_bd";
        if ($conexion->query($sql_crear_bd) === TRUE) {
        } 
        else {
            die("Error al crear la base de datos: " . $conexion->error);
        }

        // Seleccionar la base de datos
        $conexion->select_db($nombre_bd);

        // crea la tabla usuarios en la base de datos
        $sql_crear_tabla_usuarios = "
            CREATE TABLE usuarios (
                usuario VARCHAR(50) NOT NULL PRIMARY KEY,
                email VARCHAR(50),
                contrasena VARCHAR(30)
            )";
        // Ejecutar la consulta y verificar si se creó la tabla
        if ($conexion->query($sql_crear_tabla_usuarios) === TRUE) {
        } else {
            die("Error al crear la tabla: " . $conexion->error);
        }

        // crea la tabla contenido en la base de datos
        $sql_crear_tabla_contenido = "
            CREATE TABLE contenido (
                titulo VARCHAR(100) NOT NULL PRIMARY KEY,
                tipo ENUM('Noticia','Video','Podcast') NOT NULL,
                descripcion text NOT NULL,
                ruta text NOT NULL
            )";
        // Ejecutar la consulta y verificar si se creó la tabla
        if ($conexion->query($sql_crear_tabla_contenido) === TRUE) {
        } else {
            die("Error al crear la tabla: " . $conexion->error);
        }

        // crea la tabla reseñas en la base de datos
        $sql_crear_tabla_resenas = "
            CREATE TABLE resenas (
                usuario VARCHAR(50) NOT NULL,
                resena text NOT NULL
            )";
        // Ejecutar la consulta y verificar si se creó la tabla
        if ($conexion->query($sql_crear_tabla_resenas) === TRUE) {
        } else {
            die("Error al crear la tabla: " . conexion->error);
        }

        // crea la tabla reuniones en la base de datos
        $sql_crear_tabla_reuniones = "
            CREATE TABLE reuniones (
                id INT AUTO_INCREMENT PRIMARY KEY,
                fecha_reunion DATETIME NOT NULL
            )";
        // Ejecutar la consulta y verificar si se creó la tabla
        if ($conexion->query($sql_crear_tabla_reuniones) === TRUE) {
        } else {
            die("Error al crear la tabla: " . conexion->error);
        }

        // crea la tabla preguntas selección en la base de datos
        $sql_crear_tabla_preguntas_seleccion = "
            CREATE TABLE preguntas_seleccion (
                pregunta VARCHAR(100) NOT NULL PRIMARY KEY,
                respuesta_1 VARCHAR(100) NOT NULL,
                respuesta_2 VARCHAR(100) NOT NULL,
                respuesta_3 VARCHAR(100) NOT NULL,
                respuesta_4 VARCHAR(100) NOT NULL,
                correcta INT NOT NULL
            )";
        // Ejecutar la consulta y verificar si se creó la tabla
        if ($conexion->query($sql_crear_tabla_preguntas_seleccion) === TRUE) {
        } else {
            die("Error al crear la tabla: " . $conexion->error);
        }

        // crea la tabla preguntas verdadero_falso en la base de datos
        $sql_crear_tabla_preguntas_verdadero_falso = "
            CREATE TABLE preguntas_verdadero_falso (
                pregunta VARCHAR(100) NOT NULL PRIMARY KEY,
                correcta INT NOT NULL
            )";
        // Ejecutar la consulta y verificar si se creó la tabla
        if ($conexion->query($sql_crear_tabla_preguntas_verdadero_falso) === TRUE) {
        } else {
            die("Error al crear la tabla: " . $conexion->error);
        }

        // Crea la tabla preguntas completar_frases en la base de datos
        $sql_crear_tabla_preguntas_completar_frases = "
        CREATE TABLE preguntas_completar_frases (
            frase VARCHAR(250) NOT NULL PRIMARY KEY,
            correcta VARCHAR(100) NOT NULL
        )";
        // Ejecutar la consulta y verificar si se creó la tabla
        if ($conexion->query($sql_crear_tabla_preguntas_completar_frases) === TRUE) {
        } else {
            die("Error al crear la tabla: " . $conexion->error);
        }
        
        // Crear el usuario administrador
        $sql_crear_admin = "
            INSERT INTO usuarios (usuario, email, contrasena) VALUES ('admin', '', 'admin')";
        if ($conexion->query($sql_crear_admin) === TRUE) {
        } else {
            die("Error al crear el usuario administrador: " . $conexion->error);
        }
    } else {
        // Seleccionar la base de datos si ya existe
        $conexion->select_db($nombre_bd);
    }
?>
