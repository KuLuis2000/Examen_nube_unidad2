<?php
// Configuración de conexión a la base de datos desde variables de entorno
$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');

// Conectar a la base de datos usando mysqli
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error al conectar a la base de datos: " . $conn->connect_error);
}

// Consulta para obtener la lista de 10 alumnos
$sql = "SELECT nombre FROM alumnos LIMIT 10";
$result = $conn->query($sql);

// Manejar el resultado de la consulta
$alumnos = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $alumnos[] = $row;
    }
}

// Verificar si se solicita JSON en la URL
if (isset($_GET['format']) && $_GET['format'] === 'json') {
    header('Content-Type: application/json');
    echo json_encode($alumnos);
} else {
    echo "<h1>Lista de Alumnos</h1><ul>";
    foreach ($alumnos as $alumno) {
        echo "<li>" . htmlspecialchars($alumno['nombre']) . "</li>";
    }
    echo "</ul>";
}

// Cerrar la conexión
$conn->close();
?>
