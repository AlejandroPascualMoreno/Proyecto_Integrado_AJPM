<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyecto_integrado";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

// Verificar si se ha enviado una imagen
if (isset($_POST['submit'])) {
    $file = $_FILES['image'];

    // Obtener la información de la imagen
    $fileName = $file['name'];
    $fileType = $file['type'];
    $fileTempName = $file['tmp_name'];
    $fileError = $file['error'];
    $fileSize = $file['size'];

    // Verificar si la imagen es válida
    $allowedTypes = array('image/jpeg', 'image/png', 'image/gif');
    if (in_array($fileType, $allowedTypes)) {
        if ($fileError === 0) {
            if ($fileSize < 5000000) {
                // Convertir la imagen a una cadena de bytes para guardarla en la base de datos
                $imageData = addslashes(file_get_contents($fileTempName));
                $category = $_POST['category'];

                // Insertar la imagen y su categoría en la base de datos
                $sql = "INSERT INTO imagenes (images, category) VALUES ('$imageData', '$category')";
                if ($conn->query($sql) === TRUE) {
                    echo "La imagen se ha subido correctamente";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "La imagen es demasiado grande. El tamaño máximo permitido es de 5MB";
            }
        } else {
            echo "Ha ocurrido un error al subir la imagen. Por favor, intenta de nuevo";
        }
    } else {
        echo "El tipo de archivo no está permitido. Por favor, sube una imagen en formato JPEG, PNG o GIF";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Subir imagen a la base de datos</title>
</head>
<body>
    
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="image" required><br>
        <label for="category">Categoría:</label>
        <select id="category" name="category">
            <option value="catering">Catering</option>
            <option value="musica">Música</option>
            <option value="flores">Flores</option>
            <option value="fotografo">Fotógrafo</option>
            <option value="haciendas">Haciendas</option>
            <option value="estilistas">Estilistas</option>
        </select><br>
        <button type="submit" name="submit">Subir imagen</button>
    </form>
</body>
</html>
