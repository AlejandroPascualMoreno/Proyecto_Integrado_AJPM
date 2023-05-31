<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyecto_integrado";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

if (isset($_FILES['image'])) {

  $tempFolder = 'temp/';

  $fileName = $_FILES['image']['name'];
  $fileTmpPath = $_FILES['image']['tmp_name'];

  $uniqueFileName = uniqid() . '_' . $fileName;
  $targetFilePath = $tempFolder . $uniqueFileName;

  if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
   
    $imagePath = $targetFilePath;

    echo "La imagen se ha subido correctamente.";
  } else {
    echo "Error al subir la imagen.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="images\WePop3.png">
    <script src="https://kit.fontawesome.com/9731384117.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Subir un servicio</title>
</head>
<body>
    <br>
    <h2>Publica tu servicio aquí</h2>
    <br>
<form action="upload.php" method="post" class="formuvendedor" enctype="multipart/form-data">
  <input type="text" name="nombre" placeholder="Nombre del servicio">
  <br>
  <input type="number" name="precio"  placeholder="Precio del servicio">
  <br>
  <textarea name="descripcion" id="descripcion" rows="4" cols="50" placeholder="Descripción del servicio"></textarea>
  <br>
  <select name="category" required>
        <option value="">Selecciona una categoría</option>
        <option value="Sastrería">Sastrería</option>
        <option value="Zapatería">Zapatería</option>
        <option value="Peluquería">Peluquería</option>
        <option value="Catering">Catering</option>
        <option value="Joyería">Joyería</option>
        <option value="Fotografía">Fotografía</option>
        <option value="Haciendas">Haciendas</option>
        <option value="Papelería">Papelería</option>
        <option value="Wedding planner">Wedding planner</option>
        <option value="Agencia de viajes">Agencia de viajes</option>
        <option value="Transporte">Transporte</option>
        <option value="Floristería">Floristería</option>
        <option value="Música">Música</option>
  </select>
  <br>
  <input type="file" name="image" class="imagenventa">
  <br>
  <button type="submit" class="botoncerrar">Subir</button>
</form>
</body>
</html>