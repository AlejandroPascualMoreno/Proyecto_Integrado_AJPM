<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $usuario = $_POST['correo'];
    $password = $_POST['contrasena'];
    $perfil = $_POST['perfil'];

    $errores = '';

    if (empty($nombre) || empty($usuario) || empty($password) || empty($perfil)) {
        $errores = '<li>Por favor rellena todos los datos correctamente</li>';
    } else {
        try {
            $conexion = new PDO('mysql:host=localhost;dbname=proyecto_integrado', 'root', '');
        } catch (PDOException $e) {
            echo "Error:" . $e->getMessage();
        }

        $statement = $conexion->prepare('SELECT * FROM vendedores WHERE correo = :correo LIMIT 1');
        $statement->execute(array(':correo' => $usuario));

        $resultado = $statement->fetch();

        if ($resultado != false) {
            $errores .= '<li>El nombre de usuario ya existe</li>';
        }
    }

    if ($errores == '') {
        if ($perfil === "vendedor") {
            $statement = $conexion->prepare('INSERT INTO vendedores (nombre, correo, contrasena) VALUES (:nombre, :correo, :contrasena)');
        } elseif ($perfil === "comprador") {
            $statement = $conexion->prepare('INSERT INTO compradores (nombre, correo, contrasena) VALUES (:nombre, :correo, :contrasena)');
        }

        $statement->execute(array(
            ':nombre' => $nombre,
            ':correo' => $usuario,
            ':contrasena' => $password
        ));

        header('Location: login.php');
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
    <title>Regístrate</title>
</head>
<body>
    <div class="formulario_inicio">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <h2 class="textosesion">Regístrate</h2><br>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre" required><br>
            <input type="email" name="correo" id="email" placeholder="Correo electrónico" required><br><br>
            <input type="password" name="contrasena" placeholder="Contraseña" id="password" required><br>
            <select name="perfil" id="cliente" required>
                <option disabled selected>Selecciona una opción</option>
                <option value="vendedor">Vendedor</option>
                <option value="comprador">Comprador</option>
            </select><br><br>
            <button type="submit" class="botonregistro">Registrarse</button>
        </form>
    </div>
</body>
</html>
