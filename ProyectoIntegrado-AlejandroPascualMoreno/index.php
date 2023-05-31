<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'proyecto_integrado';
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Error de conexión a la base de datos: ' . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="images\WePop1.png">
    <script src="https://kit.fontawesome.com/9731384117.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        .carousel-item .list-inline {
            margin-top: 50px; 
        }
    </style>
    <title>Inicio</title>
</head>

<body>

    <div class="logo">
        <a href="index.php"><img src="images/WePop2.png" width="250px"></a>
    </div>
    <div class="botones">
        <a href="register.php"><button class="botonregistro">Regístrate <i class="fa-solid fa-pen-to-square"></i></button></a>
        <a href="login.php"><button class="botonlogin">Inicio de sesión <i class="fa-solid fa-right-to-bracket"></i></button></a>
    </div>
    <hr>
    <h2>Encuentra aquí el servicio ideal</h2>
    <h5>sin tener que salir de casa</h5>
    <div class="barrabusqueda">
        <form action="" method="GET">
            <input type="search" id="form1" size="45" name="busqueda" />
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
    <div id="carouselExampleDark" class="carousel carousel-dark slide">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <ul class="list-inline text-center">
              <li class="list-inline-item border-0 mx-2" onclick="filterByCategory('Sastrería')"><i class="fa-solid fa-vest"></i> Sastrería</li>
              <li class="list-inline-item border-0 mx-2" onclick="filterByCategory('Zapatería')"><i class="fa-solid fa-shoe-prints"></i> Zapatería</li>
              <li class="list-inline-item border-0 mx-2" onclick="filterByCategory('Peluquería')"><i class="fa-solid fa-scissors"></i> Peluquería</li>
              <li class="list-inline-item border-0 mx-2" onclick="filterByCategory('Catering')"><i class="fa-solid fa-utensils"></i> Catering</li>
              <li class="list-inline-item border-0 mx-2" onclick="filterByCategory('Joyería')"><i class="fa-solid fa-ring"></i> Joyería</li>
              <li class="list-inline-item border-0 mx-2" onclick="filterByCategory('Fotografía')"><i class="fa-solid fa-camera-retro"></i> Fotografía</li>
              <li class="list-inline-item border-0 mx-2" onclick="filterByCategory('Haciendas')"><i class="fa-solid fa-house-chimney-window"></i> Haciendas</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <ul class="list-inline text-center">
            <li class="list-inline-item border-0 mx-2" onclick="filterByCategory('Papelería')"><i class="fa-solid fa-scroll"></i> Papelería</li>
              <li class="list-inline-item border-0 mx-2" onclick="filterByCategory('Wedding planner')"><i class="fa-solid fa-list"></i> Wedding planner</li>
              <li class="list-inline-item border-0 mx-2" onclick="filterByCategory('Agencia de viaje')"><i class="fa-solid fa-plane"></i> Agencia de viaje</li>
              <li class="list-inline-item border-0 mx-2" onclick="filterByCategory('Transporte')"><i class="fa-solid fa-car-side"></i> Transporte</li>
              <li class="list-inline-item border-0 mx-2" onclick="filterByCategory('Floristería')"><i class="fa-solid fa-tree"></i> Floristería</li>
              <li class="list-inline-item border-0 mx-2" onclick="filterByCategory('Pastelería')"><i class="fa-solid fa-cake-candles"></i> Pastelería</li>
              <li class="list-inline-item border-0 mx-2" onclick="filterByCategory('Música')"><i class="fa-solid fa-music"></i> Música</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <?php
    if (!isset($_GET['busqueda'])) {
        $sql = "SELECT * FROM imagenes";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $count = 0;

            while ($row = $result->fetch_assoc()) {
                $imagePath = $row['images'];
                $category = $row['category'];

                if ($count % 5 == 0) {
                    if ($count != 0) {
                        echo '</div>';
                    }
                    echo '<div class="row justify-content-center">'; 
                }

                echo '<div class="ms-2 col-md-2 mb-2 category-card category-' . $category . '">';
                echo '<div class="card">';
                echo '<img class="card-img-top custom-img" src="' . $imagePath . '" alt="Imagen">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . ucfirst($row['nombre']) . '</h5>';
                echo '<hr>';
                echo '<p class="card-title">' . $row['precio'] . ' €' . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

                $count++;
            }

            echo '</div>'; 
        } else {
            echo 'No se encontraron servicios en la base de datos.';
        }
    }

    ?>

    <?php

    if (isset($_GET['busqueda'])) {
        $searchTerm = $_GET['busqueda'];

        $sql = "SELECT * FROM imagenes WHERE nombre LIKE '%$searchTerm%' OR category LIKE '%$searchTerm%'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $count = 0;

            while ($row = $result->fetch_assoc()) {
                if ($count % 4 == 0) {
                    if ($count != 0) {
                        echo '</div>'; 
                    }
                    echo '<div class="row justify-content-center">'; 
                }
                $category = $row['category'];
                echo '<div class="ms-2 col-md-2 mb-2 category-card category-' . $category . '">';
                echo '<div class="card">';
                echo '<img class="card-img-top custom-img" src="' . $row['images'] . '" alt="Imagen" >';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . ucfirst($row['nombre']) . '</h5>';
                echo '<hr>';
                echo '<p class="card-title">' . $row['precio'] . ' €' . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

                $count++;
            }

            echo '</div>'; 
        } else {
            echo 'No se encontraron resultados para "' . $searchTerm . '".';
        }
    }

    ?>

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

    <script>
        function filterByCategory(category) {
            var categoryCards = document.getElementsByClassName("category-card");

            for (var i = 0; i < categoryCards.length; i++) {
                categoryCards[i].style.display = "none";
            }

            var selectedCategoryCards = document.getElementsByClassName("category-" + category);

            for (var i = 0; i < selectedCategoryCards.length; i++) {
                selectedCategoryCards[i].style.display = "block";
            }
        }
    </script>

    <?php
    $conn->close();
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>


</html>
