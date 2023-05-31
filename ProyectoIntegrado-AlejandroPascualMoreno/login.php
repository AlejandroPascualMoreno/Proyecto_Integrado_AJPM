<?php
session_start();

if (isset($_POST['user']) && isset($_POST['pass'])) {
    $usuario = $_POST['user'];
    $contrasena = $_POST['pass'];

    try {
        $conexion = new PDO('mysql:host=localhost;dbname=proyecto_integrado', 'root', '');
    } catch (PDOException $e) {
        echo "Error:" . $e->getMessage();
    }

    $statement = $conexion->prepare('SELECT id_vendedor, contrasena FROM vendedores WHERE correo = :user');
    $statement->execute(array(
        ':user' => $usuario,
    ));

    $resultado = $statement->fetch();

    if ($resultado && password_verify($contrasena, $resultado['contrasena'])) {
        // El usuario y la contraseña son correctos para el vendedor
        $_SESSION['id_vendedor'] = $resultado['id_vendedor'];
        $_SESSION['user'] = $usuario;
        header('Location: index_vendedores.php');
    } else {
        $statement = $conexion->prepare('SELECT id_comprador, contrasena FROM compradores WHERE correo = :user');
        $statement->execute(array(
            ':user' => $usuario,
        ));

        $resultado = $statement->fetch();

        if ($resultado && password_verify($contrasena, $resultado['contrasena'])) {
            // El usuario y la contraseña son correctos para el comprador
            $_SESSION['id_comprador'] = $resultado['id_comprador'];
            $_SESSION['user'] = $usuario;
            header('Location: index_compradores.php');
        } else {
            echo "Usuario o contraseña incorrectos";
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
    <link rel="icon" type="image/x-icon" href="images\WePop3.png">
    <script src="https://kit.fontawesome.com/9731384117.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Inicio de sesión</title>
</head>
<body>
    <div class="formulario_inicio">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <h2 class="textosesion">Inicio de sesión</h2>
            <input type="email" name="user" id="email" placeholder="Correo electrónico"><br><br>
            <input type="password" name="pass" placeholder="Contraseña" id="password"><br><br>
            <button type="submit" class="botonlogin_inicio">Iniciar sesión</button>
        </form>
    </div>
</body>
</html>
