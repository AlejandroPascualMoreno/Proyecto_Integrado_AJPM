<?php
session_start();

$id = $_GET['id_producto'];

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'proyecto_integrado';
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Error de conexión a la base de datos: ' . $conn->connect_error);
}

$sql = "SELECT * FROM imagenes WHERE id_producto = $id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombreProducto = $row['nombre'];

    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <script src="https://kit.fontawesome.com/9731384117.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style.css">
        <link rel="icon" type="image/x-icon" href="images\WePop3.png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <title><?php echo $nombreProducto; ?></title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f8f9fa;
                margin: 0;
                padding: 20px;
                display: flex;
                flex-direction: column;
                align-items: center;
                min-height: 100vh;
            }

            .product-container {
                max-width: 600px;
                background-color: #fff;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                text-align: center;
            }

            h1 {
                color: #333;
                font-size: 24px;
                margin-bottom: 20px;
            }

            p {
                color: #666;
                margin: 0;
                margin-bottom: 10px;
            }

            .product-image {
                max-width: 100%;
                height: auto;
                margin-top: 30px;
                border-radius: 5px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }
        </style>
    </head>
    <body>
        <div class="container text-center mb-4">
            <img src="images/WePop2.png" alt="Logo de la empresa" width="300">
        </div>
     
        <div class="product-container">
            <h1 class="mb-4"><?php echo $nombreProducto; ?></h1>
            <p class="lead mb-3">Precio: <?php echo $row['precio']; ?> €</p>
            <p>Categoría: <?php echo ucfirst($row['category']); ?></p>
            <hr>
            <p class="mb-4"> Descripción: <?php echo $row['descripcion']; ?></p>
            <img src="<?php echo $row['images']; ?>" alt="Imagen del producto" class="product-image">
        </div>
        <?php 
        if (isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'comprador') {
            echo '<a href="chat.php?id_producto=' . $row['id_producto'] . '"><button class="botoncontactar"> Contacta con el proveedor <i class="fa-solid fa-phone"></i></button></a>';
        } elseif (isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'vendedor') {
            $_SESSION['perfil'] = 'comprador'; // Actualizar perfil a "comprador"
            echo '<a href="chat.php?id_producto=' . $row['id_producto'] . '"><button class="botoncontactar"> Contacta con el proveedor <i class="fa-solid fa-phone"></i></button></a>';
        } else {
            echo 'Error: Perfil de usuario desconocido.';
        }
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-3V0AF5YOltbESvlplle36y2GWzm3S7mk3G9geFyLtnR94v69azg+vaPohTDjupLz" crossorigin="anonymous"></script>
    </body>
    </html>
    <?php
} else {
    echo 'No se encontró el servicio en la base de datos.';
}

$conn->close();
?>