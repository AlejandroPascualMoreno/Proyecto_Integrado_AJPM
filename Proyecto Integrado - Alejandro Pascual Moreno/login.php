<?php
if (isset($_POST['user']) && isset($_POST['pass'])) {
    $usuario = $_POST['user'];
    $password = $_POST['pass'];
    
    // Consulta SQL para obtener el perfil del usuario
    try {
        $conexion = new PDO('mysql:host=localhost;dbname=proyecto_integrado', 'root', '');
    } catch (PDOException $e) {
        echo "Error:" . $e->getMessage();
    }

    $statement = $conexion->prepare('SELECT perfil FROM login_registro WHERE user like :user AND pass like :pass');
    $statement->execute(array(
        ':user' => $usuario,
        ':pass' => $password,
    ));

    $resultado = $statement->fetch();

    if ($resultado !== false) {
        // redirigir al usuario a la página correspondiente
        if ($resultado['perfil'] == 'comprador') {
            header('Location: index_compradores.php');
        } elseif ($resultado['perfil'] == 'vendedor') {
            header('Location: index_vendedores.php');
        }
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
    <script src="https://kit.fontawesome.com/9731384117.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Inicio de sesión</title>
</head>
<body>
    <div class= formulario_inicio>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <h2 class="textosesion">Inicio de sesión</h2>
       <input type="email" name="user" id="email" placeholder="Correo electrónico"><br>
       <br><input type="password" name="pass" placeholder="Contraseña" id="password" ><br>
       <br><button type="submit" class="botonlogin_inicio">Iniciar sesión</button>
    </form>
    </div>
</body>
</html>