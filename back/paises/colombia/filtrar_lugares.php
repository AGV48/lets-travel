<?php
include "../../../config/conexion.php";

// Construir consulta base
$filtro = "";

// Verificar si se ha seleccionado alguna categoría
if (!empty($_GET['categoria']) && $_GET['categoria'] !== "Seleccione Categoría") {
    $categoria = $_GET['categoria'];
    $filtro = "WHERE categoria = '$categoria'";
}

// Verificar si se ha seleccionado alguna ubicación
if (!empty($_GET['ubicacion']) && $_GET['ubicacion'] !== "Seleccione Ubicación") {
    $ubicacion = $_GET['ubicacion'];
    // Si ya hay un filtro de categoría, agregar "AND" para incluir el filtro de ubicación
    $filtro .= ($filtro ? " AND " : "WHERE ") . "ubicacion = '$ubicacion'";
}

// Consulta SQL con el filtro construido
$query = "SELECT * FROM lugares $filtro";
$resultado = mysqli_query($conexion, $query);

// Generar el HTML con los resultados
while ($fila = mysqli_fetch_assoc($resultado)): ?>
    <div class="contenido_item">
        <h2><?php echo $fila['nombre']; ?></h2>
        <p><?php echo $fila['descripcion']; ?></p>
        <p>Ubicación: <?php echo $fila['ubicacion']; ?></p>
        <a href="detalle_lugar.php?id=<?php echo $fila['id']; ?>">Más información</a>
    </div>
<?php endwhile; ?>

