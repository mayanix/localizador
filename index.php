<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('config.php');

// Crear (Create)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $number = $_POST['number'];
    $email = $_POST['email'];

    $sql = "INSERT INTO contactos (name, surname, number, email) VALUES ('$name', '$surname', '$number', '$email')";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Contacto agregado correctamente.</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Actualizar (Update)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $number = $_POST['number'];
    $email = $_POST['email'];

    $sql = "UPDATE contactos SET name='$name', surname='$surname', number='$number', email='$email' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Contacto actualizado correctamente.</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Borrar (Delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $id = $_POST['id'];

    $sql = "DELETE FROM contactos WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Contacto eliminado correctamente.</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Leer (Read)
$sql = "SELECT id, name, surname, number, email FROM contactos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio final</title>
    <link rel="stylesheet" href="estilo050824.css">
    <script src="script050824.js" defer></script>
</head>
<body>
    <div class="container">
        <h1>Lista de Contactos</h1>
        <form id="createForm" method="POST" action="index.php">
            <input type="hidden" name="action" value="create">
            <input type="text" name="name" id="name" placeholder="Nombre" required>
            <input type="text" name="surname" id="surname" placeholder="Apellido" required>
            <input type="text" name="number" id="number" placeholder="Número" required>
            <input type="email" name="email" id="email" placeholder="Email" required>
            <button type="submit">Agregar Contacto</button>
        </form>

        <ul id="userList">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<li>";
                    echo htmlspecialchars($row["name"]). " - " .htmlspecialchars($row["surname"]). " - " .htmlspecialchars($row["number"]). " - " .htmlspecialchars($row["email"]);
                    echo ' <button class="editBtn" data-id="' . $row["id"] . '" data-name="' . htmlspecialchars($row["name"]) . '" data-surname="' . htmlspecialchars($row["name"]) . '" data-number="' . htmlspecialchars($row["number"]) . '" data-email="' . htmlspecialchars($row["email"]) . '">Editar</button>';
                    echo ' <form class="deleteForm" method="POST" action="index.php" style="display:inline;">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="' . $row["id"] . '">
                        <button type="submit">Eliminar</button>
                    </form>';
                    echo "</li>";
                }
            } else {
                echo "<p>No existen contactos registrados.</p>";
            }
            ?>
        </ul>

        <div id="editFormContainer" style="display:none;">
            <h2>Editar Contacto</h2>
            <form id="editForm" method="POST" action="index.php">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" id="editId">
                <input type="text" name="name" id="editName" placeholder="Nombre" required>
                <input type="text" name="surname" id="editSurname" placeholder="Apellido" required>
                <input type="text" name="number" id="editNumber" placeholder="Número" required>
                <input type="email" name="email" id="editEmail" placeholder="Email" required>
                <button type="submit">Actualizar Contacto</button>
            </form>
        </div>
    </div>
</body>
</html>
