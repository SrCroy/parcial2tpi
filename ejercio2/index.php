<?php

class Database
{
    private $host = "db"; 
    private $db_name = "appdb"; 
    private $username = "appuser"; 
    private $password = "apppass";      
    public $conn;

    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

$db = new Database();
$connection = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $direccion = $_POST['direccion'];

    $stmt = $connection->prepare("INSERT INTO estudiante (nombre, telefono, fecha_nacimiento, direccion) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nombre, $telefono, $fecha_nacimiento, $direccion]);

    echo "<p>Registro insertado correctamente.</p>";
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $connection->prepare("DELETE FROM estudiante WHERE id = ?");
    $stmt->execute([$id]);

    echo "<p>Registro eliminado correctamente.</p>";
}

$stmt = $connection->prepare("SELECT * FROM estudiante");
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Estudiantes</title>
</head>
<body>

    <h1>Formulario para insertar estudiante</h1>
    <form method="POST">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="telefono" required><br><br>
        
        <label for="fecha_nacimiento">Fecha de Nacimiento:</label><br>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required><br><br>
        
        <label for="direccion">Dirección:</label><br>
        <input type="text" id="direccion" name="direccion" required><br><br>
        
        <input type="submit" value="Insertar">
    </form>

    <h1>Lista de Estudiantes</h1>
    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Fecha de Nacimiento</th>
            <th>Dirección</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($students as $student): ?>
            <tr>
                <td><?= $student['nombre']?></td>
                <td><?= $student['telefono']?></td>
                <td><?= $student['fecha_nacimiento']?></td>
                <td><?= $student['direccion']?></td>
                <td><a href="?id=<?= $student['id']; ?>">Eliminar</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
