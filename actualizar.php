<?php
// Establecer los detalles de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "idealW2";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si hay algún error en la conexión
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

// Obtener los datos actualizados del formulario
$id = $_POST['id'];
$exerciseName = $_POST['exercise-name'];
$weight = $_POST['weight'];
$repetitions = $_POST['repetitions'];
$notes = $_POST['notes'];

// Actualizar los datos en la base de datos
$sql = "UPDATE weight_records SET exercise_name='$exerciseName', weight='$weight', repetitions='$repetitions', notes='$notes' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    // Redirigir al usuario a index.php después de la actualización exitosa
    header("Location: index.php");
    exit(); // Asegurarse de que el código se detenga después de la redirección
} else {
    echo "Error al actualizar los datos: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
