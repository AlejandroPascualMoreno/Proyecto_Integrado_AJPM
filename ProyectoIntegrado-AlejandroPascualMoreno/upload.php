<?php

if (isset($_FILES['image']) && isset($_POST['category']) && isset($_POST['nombre']) && isset($_POST['precio'])) {
   
    $tempFolder = 'temp/';
  
   
    $fileName = $_FILES['image']['name'];
    $fileTmpPath = $_FILES['image']['tmp_name'];
  
    
    $uniqueFileName = uniqid() . '_' . $fileName;
    $targetFilePath = $tempFolder . $uniqueFileName;
  
  
    if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
      
      
        $imagePath = $targetFilePath;
        
        $category = $_POST['category'];
        $name = $_POST['nombre'];
        $price = $_POST['precio'];
        $description = $_POST['descripcion'];
  
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'proyecto_integrado';
        $conn = new mysqli($servername, $username, $password, $dbname);
  
     
        if ($conn->connect_error) {
            die('Error de conexión a la base de datos: ' . $conn->connect_error);
        }
  
       
        session_start();
        $idVendedor = $_SESSION['id_vendedor'];
        
        
        if (!$idVendedor) {
            die('Error: ID del vendedor no definido.');
        }
  
       
        $sql = "INSERT INTO imagenes (images, category, nombre, precio, descripcion, id_vendedor) VALUES ('$imagePath', '$category', '$name', '$price', '$description', '$idVendedor')";
  
       
        if ($conn->query($sql) === TRUE) {
            echo 'La imagen, la categoría, el nombre, el precio y la descripción se han insertado en la base de datos correctamente.' . "<br>";
        } else {
            echo 'Error al insertar la imagen, la categoría, el nombre, el precio y la descripción en la base de datos: ' . $conn->error;
        }
  
      
        $conn->close();
  
        echo "La imagen se ha subido correctamente." . "<br>";
    } else {
        echo "Error al subir la imagen.";
    }
  }
  
?>