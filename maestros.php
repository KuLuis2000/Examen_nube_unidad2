<?php
// Configuración de conexión a la base de datos desde variables de entorno
$host = getenv('MYSQL_IP_DB');  // Dirección del servicio de la base de datos
$dbname = 'maestros';  // Nombre de la base de datos de maestros
$user = getenv('MYSQL_APP_USER');  // Usuario de la base de datos
$password = getenv('MYSQL_APP_PASSWORD');  // Contraseña de la base de datos

// Conectar a la base de datos de maestros usando mysqli
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error al conectar a la base de datos de maestros: " . $conn->connect_error);
}

// Obtener la lista de maestros
$sql = "SELECT DISTINCT nombre FROM maestros";
$result = $conn->query($sql);

$maestros = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $maestros[] = $row;
    }
}

// Inicializar la lista de alumnos
$alumnos = [];

// Verificar si se hizo clic en el botón para mostrar los alumnos
if (isset($_POST['mostrar_alumnos'])) {
    // Hacer una solicitud HTTP al servicio de alumnos
    $alumnosServiceUrl = "http://alumnos/index.php?format=json";
    $alumnosJson = file_get_contents($alumnosServiceUrl);
    $alumnos = json_decode($alumnosJson, true);
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Maestros</title>
</head>
<body>
    <h1>Lista de Maestros</h1>
    <ul>
        <?php if (!empty($maestros)): ?>
            <?php foreach ($maestros as $maestro): ?>
                <li><?php echo htmlspecialchars($maestro['nombre']); ?></li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>No hay maestros registrados.</li>
        <?php endif; ?>
    </ul>

    <!-- Formulario para mostrar alumnos -->
    <form method="post">
        <button type="submit" name="mostrar_alumnos">Mostrar Base de Datos Alumnos</button>
    </form>

    <?php if (!empty($alumnos)): ?>
        <h2>Lista de Alumnos</h2>
        <ul>
            <?php foreach ($alumnos as $alumno): ?>
                <li><?php echo htmlspecialchars($alumno['nombre']); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
