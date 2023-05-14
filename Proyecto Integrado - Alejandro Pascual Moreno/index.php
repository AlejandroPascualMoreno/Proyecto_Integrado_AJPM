<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyecto_integrado";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Consulta para seleccionar todas las imágenes de la tabla 'imagenes'
$sql = "SELECT * FROM imagenes";
$result = mysqli_query($conn, $sql);

?>
  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/9731384117.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Inicio</title>
</head>
<body>
  <div class="logo">
    <img src="images/WePop2.png" width="300px">
    </div>
    <div class="botones">
    <a href="register.php"><button class="botonregistro">Regístrate</button></a>
    <a href="login.php"><button class="botonlogin">Inicio de sesión</button></a>
    </div>
    <hr>
    <h2>Encuentra aquí el servicio ideal</h2>
    <h5>sin tener que salir de casa</h5>
    <div class="barrabusqueda" action="">
      <input type="search" name="busqueda">
      <button type="submit"><i class="fas fa-search"></i></button>
</div>
   
    <div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
    <ul class="list-inline text-center">
  <li class="list-inline-item border-0 mx-3"><i class="fa fa-star"></i> Sastrería</li>
  <li class="list-inline-item border-0 mx-3"><i class="fa fa-heart"></i> Zapatería</li>
  <li class="list-inline-item border-0 mx-3"><i class="fa fa-check"></i> Peluquería</li>
  <li class="list-inline-item border-0 mx-3"><i class="fa fa-envelope"></i> Maquillaje</li>
  <li class="list-inline-item border-0 mx-3"><i class="fa fa-comment"></i> Joyería</li>
  <li class="list-inline-item border-0 mx-3"><i class="fa fa-bell"></i> Fotografía</li>
  <li class="list-inline-item border-0 mx-3"><i class="fa fa-book"></i> Haciendas</li>
  <li class="list-inline-item border-0 mx-3"><i class="fa fa-rocket"></i> Catering</li>
</ul>

    </div>
  </div>
</div>
    <?php
        // Iterar a través de cada imagen y mostrarla en pantalla
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<div class="col-md-4 mb-3">';
          echo '<div class="card">';
          echo '<img class="card-img-top" src="data:image/jpeg;base64,'.base64_encode($row['images']).'" alt="'.$row['category'].'">';
          echo '<div class="card-body">';
          echo '<h5 class="card-title">'.$row['category'].'</h5>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
        }
        ?>
        </div>
</div>
<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
    <footer>
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec nisi ante. Morbi ac leo vitae est euismod tincidunt id ac elit. Sed sit amet lorem lacus. Fusce eu urna ligula. Mauris porttitor augue ac neque sodales, at finibus nisl iaculis. Donec euismod risus vel diam ultricies, vel varius ex consectetur. Integer in tellus eget odio venenatis semper.</p>
      </div>
    </div>
  </div>
</footer>
</body>
</html>