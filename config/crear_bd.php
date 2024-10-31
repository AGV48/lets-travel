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

        // Crea la tabla de eventos típicos de Colombia por mes en la base de datos
        $sql_crear_tabla_eventos_tipicos_por_mes = "
        CREATE TABLE eventos_colombia (
            id INT AUTO_INCREMENT PRIMARY KEY,
            fecha DATE NOT NULL,
            descripcion VARCHAR(255) NOT NULL
        )";
        // Ejecutar la consulta y verificar si se creó la tabla
        if ($conexion->query($sql_crear_tabla_eventos_tipicos_por_mes) === TRUE) {
        } else {
            die("Error al crear la tabla: " . $conexion->error);
        }

        // Insertamos eventos típicos de Colombia por mes

        $sql_insertar_eventos_tipicos_por_mes = "
        INSERT INTO eventos_colombia (fecha, descripcion) VALUES
            ('2024-01-01', 'Año Nuevo'),
            ('2024-03-25', 'Día de San José'),
            ('2024-04-07', 'Jueves Santo'),
            ('2024-04-08', 'Viernes Santo'),
            ('2024-05-01', 'Día del Trabajo'),
            ('2024-06-17', 'Día del Sagrado Corazón'),
            ('2024-07-20', 'Día de la Independencia'),
            ('2024-08-07', 'Batalla de Boyacá'),
            ('2024-10-12', 'Día de la Raza'),
            ('2024-11-01', 'Día de Todos los Santos'),
            ('2024-11-11', 'Independencia de Cartagena'),
            ('2024-12-08', 'Día de la Inmaculada Concepción'),
            ('2024-12-25', 'Navidad')";

        // Ejecutar la consulta y verificar si se insertaron los eventos
        if ($conexion->query($sql_insertar_eventos_tipicos_por_mes) === TRUE) {
        } else {
            die("Error al insertar eventos típicos de Colombia por mes: " . $conexion->error);
        }
        
        // Crea la tabla de lugares turísticos y gastronómicos en la base de datos
        $sql_crear_tabla_lugares = "
        CREATE TABLE lugares (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(100) NOT NULL,
            descripcion VARCHAR(255) NOT NULL,
            categoria ENUM('turistico', 'gastronomico') NOT NULL,
            ubicacion VARCHAR(50) NOT NULL
        )";
        // Ejecutar la consulta y verificar si se creó la tabla
        if ($conexion->query($sql_crear_tabla_lugares) === TRUE) {
        } else {
            die("Error al crear la tabla: " . $conexion->error);
        }

        // Insertamos lugares turísticos y gastronómicos

        $sql_insertar_lugares = "
        INSERT INTO lugares (nombre, descripcion, categoria, ubicacion) VALUES 
            ('Cerro Monserrate', 'Famoso santuario en lo alto de la montaña con vistas panorámicas de Bogotá.', 'turistico', 'Bogotá'),
            ('Museo del Oro', 'Museo que alberga una colección de oro y otros objetos precolombinos.', 'turistico', 'Bogotá'),
            ('Restaurante Andrés Carne de Res', 'Restaurante popular con ambiente único y platos colombianos.', 'gastronomico', 'Bogotá'),
            ('Parque Arví', 'Parque ecológico ubicado en las montañas cerca de Medellín.', 'turistico', 'Medellín'),
            ('Pueblito Paisa', 'Réplica de un pueblo típico de Antioquia con vistas a Medellín.', 'turistico', 'Medellín'),
            ('Mercado del Río', 'Centro gastronómico con una gran variedad de opciones de comida.', 'gastronomico', 'Medellín'),
            ('Castillo de San Felipe', 'Fuerte histórico de Cartagena con vistas impresionantes.', 'turistico', 'Cartagena'),
            ('Plaza Santo Domingo', 'Popular plaza con cafés y restaurantes en Cartagena.', 'gastronomico', 'Cartagena'),
            ('Parque Nacional Natural Tayrona', 'Parque natural en la costa caribeña con playas y biodiversidad.', 'turistico', 'Santa Marta'),
            ('Restaurante Donde Chucho', 'Restaurante famoso por su comida de mar en Santa Marta.', 'gastronomico', 'Santa Marta')";

        // Ejecutar la consulta y verificar si se insertaron los lugares
        if ($conexion->query($sql_insertar_lugares) === TRUE) {
        } else {
            die("Error al insertar lugares turísticos y gastronómicos: " . $conexion->error);
        }

        // Crear el usuario administrador
        $sql_crear_admin = "
            INSERT INTO usuarios (usuario, email, contrasena) VALUES ('admin', '', 'admin')";
        if ($conexion->query($sql_crear_admin) === TRUE) {
        } else {
            die("Error al crear el usuario administrador: " . $conexion->error);
        }

        $sql_crear_usuario = "
            INSERT INTO usuarios (usuario, email, contrasena) VALUES ('a', '', 'aa')";
        if ($conexion->query($sql_crear_usuario) === TRUE) {
        } else {
            die("Error al crear el usuario administrador: " . $conexion->error);
        }

    } else {
        // Seleccionar la base de datos si ya existe
        $conexion->select_db($nombre_bd);
    }
?>
