<?php
session_start();

if (isset($_SESSION['user'])) {
	header('Location: index.php');
	die();
}


if($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$usuario = $_POST['user'];
	$password = $_POST['pass'];
	$perfil = $_POST['perfil'];
	

	$errores = '';

	if (empty($usuario) or empty($password) or empty($perfil)) {
		$errores = '<li>Por favor rellena todos los datos correctamente</li>';
	} else {

		try {
			$conexion = new PDO('mysql:host=localhost;dbname=proyecto_integrado', 'root', '');
		} catch (PDOException $e) {
			echo "Error:" . $e->getMessage();
		}

		$statement = $conexion->prepare('SELECT * FROM login_registro WHERE user = :user LIMIT 1');
		$statement->execute(array(':user' => $usuario));


		$resultado = $statement->fetch();

		if ($resultado != false) {
			$errores .= '<li>El nombre de usuario ya existe</li>';
		}

	
	}

	if ($errores == '') {
		$statement = $conexion->prepare('INSERT INTO login_registro (id, user, pass,perfil) VALUES (null, :user, :pass, :perfil)');
		$statement->execute(array(
				':user' => $usuario,
				':pass' => $password,
                ':perfil' => $perfil
			));

		// Despues de registrar al usuario redirigimos para que inicie sesion.
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
    <div class= formulario_inicio>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <h2 class="textosesion">Regístrate</h2>
       <input type="email" name="user" id="email" placeholder="Correo electrónico"><br>
       <br><input type="password" name="pass" placeholder="Contraseña" id="password"><br>
       <select name="perfil" id="cliente">
        <option disabled selected>Selecciona una opción</option>
        <option value="vendedor">Vendedor</option>
        <option value="comprador">Comprador</option>
      </select>    
       <br><button type="submit" class="botonregistro">Registrarse</button>
    </form>
    </div>
</body>
</html>