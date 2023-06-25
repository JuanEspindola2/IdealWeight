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

// Obtener el ID del registro a editar desde la URL
$id = $_GET['id'];

// Obtener los datos del registro seleccionado
$sql = "SELECT * FROM weight_records WHERE id = '$id'";
$result = $conn->query($sql);

// Verificar si se encontró el registro
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $exerciseName = $row['exercise_name'];
    $weight = $row['weight'];
    $repetitions = $row['repetitions'];
    $notes = $row['notes'];
} else {
    echo "No se encontró el registro.";
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Mostrar el formulario con los datos del registro seleccionado -->
  <div class="exercise-form">
    <h2>Editar Registro de Peso del Gimnasio</h2>
    <form action="actualizar.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <div class="form-group">
        <label for="exercise-name">Ejercicio:</label>
        <input type="text" id="exercise-name" name="exercise-name" value="<?php echo $exerciseName; ?>" required>
      </div>
      <div class="form-group">
        <label for="weight">Peso (kg):</label>
        <input type="number" id="weight" name="weight" value="<?php echo $weight; ?>" required>
      </div>
      <div class="form-group">
        <label for="repetitions">Repeticiones:</label>
        <input type="number" id="repetitions" name="repetitions" value="<?php echo $repetitions; ?>" required>
      </div>
      <div class="form-group">
        <label for="notes">Notas:</label>
        <textarea id="notes" name="notes"><?php echo $notes; ?></textarea>
      </div>
      <button type="submit">Actualizar</button>
    </form>
  </div>
</body>
</html>
