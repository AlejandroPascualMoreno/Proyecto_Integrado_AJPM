<?php
session_start();
$_SESSION['perfil'] = 'vendedor';

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'proyecto_integrado';
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Error de conexión a la base de datos: ' . $conn->connect_error);
}

$vendedorId = $_SESSION['id_vendedor'];

$productosSql = "SELECT * FROM imagenes WHERE id_vendedor = $vendedorId";
$productosResult = $conn->query($productosSql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/9731384117.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Gestión de servicios</title>
    <style>
        .custom-card {
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 20px;
        }
        .custom-card .card-img-top {
            object-fit: cover;
            height: 300px;
        }
        .custom-card .card-body {
            padding: 10px;
        }
        .custom-card .card-title {
            font-size: 20px;
            font-weight: bold;
            margin: 10px 0;
        }
      
    </style>
</head>
<body>
    <div class="container text-center mb-4">
        <img src="images/WePop2.png" alt="Logo de la empresa" width="300">
    </div>

    <h2 class="textogestion">Listado de tus productos:</h2>

    <div class="container">
        <div class="row">
            <?php
            if ($productosResult->num_rows > 0) {
                while ($productoRow = $productosResult->fetch_assoc()) {
                    echo '<div class="col-md-4 d-flex justify-content-center">';
                    echo '<div class="card w-100 text-center custom-card">';
                    echo '<img src="' . $productoRow['images'] . '" alt="Imagen del producto" class="card-img-top">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $productoRow['nombre'] . '</h5>';
                    echo '<a href="chat.php?id_producto=' . $productoRow['id_producto'] .  '">';
                    echo '<button class="botonsubir">Chat <i class="fa-solid fa-comments"></i></button>';
                    echo '</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo 'No se encontraron productos para este vendedor.';
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-3V0AF5YOltbESvlplle36y2GWzm3S7mk3G9geFyLtnR94v69azg+vaPohTDjupLz" crossorigin="anonymous"></script>
</body>
<footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>Somos una empresa que se dedica a conectar a parejas a punto de unirse en matrimonio con los proveedores dispuestos a hacerles
                      pasar el mejor día de sus vidas, de una forma sencilla e intuitiva para todos. Nuestra misión es que todos puedan 
                      disfrutar de un servicio optimizado, fácil de usar, y eficaz a la hora de obtener el resultado esperado.
                      ¿A qué esperas? ¡Pruébalo!
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <ul>
                        <li><a href="politica_cookies.php">Política de Cookies</a></li>
                        <li><a href="quienes_somos.php">Quiénes Somos</a></li>
                        <li><a href="https://www.facebook.com/tu_pagina" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="https://www.twitter.com/tu_pagina" target="_blank"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="https://www.instagram.com/tu_pagina" target="_blank"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</html>

<?php
$conn->close();
?>

