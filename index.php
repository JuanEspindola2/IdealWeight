<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>

<body>
    <nav>
        <ul>
            <li><a href="index.html">Agregar</a></li>
            <li><a href="index.php">Registros</a></li>
            <li><a href="login.html">Login</a></li>
            <li><a href="registrarse.html">registrarse</a></li>
        </ul>
    </nav>

       
</body>

</html>
<?php
// Establecer los detalles de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "idealW2";
// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);



// Verificar si se envió el formulario de inserción
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $exerciseName = $_POST['exercise-name'];
    $weight = $_POST['weight'];
    $repetitions = $_POST['repetitions'];
    $notes = $_POST['notes'];

    // Verificar si se proporcionaron todos los campos necesarios
    if (!empty($exerciseName) && !empty($weight) && !empty($repetitions)) {
        // Insertar los datos en la base de datos
        $sql = "INSERT INTO weight_records (exercise_name, weight, repetitions, notes)
                VALUES ('$exerciseName', '$weight', '$repetitions', '$notes')";

        if ($conn->query($sql) === TRUE) {
            echo "El registro se ha insertado correctamente.";
            // Redireccionar al mismo archivo para evitar el reenvío del formulario
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Error al insertar el registro: " . $conn->error;
        }
    } else {
        echo "Por favor, complete todos los campos obligatorios.";
    }
}

// Verificar si se envió el formulario de eliminación
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete'])) {
    // Obtener el ID del registro a eliminar
    $deleteId = $_GET['delete'];

    // Eliminar el registro de la base de datos
    $sql = "DELETE FROM weight_records WHERE id='$deleteId'";

    if ($conn->query($sql) === TRUE) {
        echo "El registro se ha eliminado correctamente.";
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }
}

// Obtener los registros almacenados en la base de datos
$sql = "SELECT * FROM weight_records";
$result = $conn->query($sql);

// Verificar si se encontraron registros
if ($result->num_rows > 0) {
    echo "<h2>Registros almacenados:</h2>";
    echo "<ul>";
    // Variable de contador
    $count = 1;
    
    echo "<div class='container'>";
        while ($row = $result->fetch_assoc()) {
            echo "<div class='registro'>";
            echo "<h3 class='registro-id'>Registro ID: " . $count . "</h3>";
            echo "<ul>";
            echo "<li class='ejercicio'>Ejercicio: " . $row['exercise_name'] . "</li>";
            echo "<li class='peso'>Peso (kg): " . $row['weight'] . "</li>";
            echo "<li class='repeticiones'>Repeticiones: " . $row['repetitions'] . "</li>";
            echo "<li class='notas'>Notas: " . $row['notes'] . "</li>";
            echo "<li class='eliminar'><a href='index.php?delete=" . $row['id'] . "' onclick=\"return confirm('¿Estás seguro de eliminar este registro?')\">Eliminar</a></li>";
            echo "<li class='editar'><a href='editar.php?id=" . $row['id'] . "'>Editar</a></li>";
            echo "</ul>";
            echo "</div>";

            // Incrementar el contador
            $count++;
        }
    echo "</div>";  
} else {
    echo "No se encontraron registros almacenados.";
}

// Cerrar la conexión
$conn->close();
?>
