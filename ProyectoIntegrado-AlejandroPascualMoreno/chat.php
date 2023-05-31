<?php


session_start();


$profile = $_SESSION['perfil'];


$host = "localhost";
$db = "proyecto_integrado";
$user = "root";
$password = "";


try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}


if (isset($_GET['id_producto'])) {
    $id_producto = $_GET['id_producto'];
} else {
    die("No se proporcionó el id_producto");
}


if (isset($_POST['mensaje'])) {
    $sender = $profile; 
    $receiver = $_POST['receiver']; 
    $message = $_POST['mensaje'];

  
    $stmt = $pdo->prepare("INSERT INTO messages (sender, receiver, mensaje, id_producto) VALUES (?, ?, ?, ?)");
    $stmt->execute([$sender, $receiver, $message, $id_producto]);

 
   
}

// Obtención de mensajes
$stmt = $pdo->prepare("SELECT * FROM messages WHERE (sender = ? OR receiver = ?) AND id_producto = ?");
$stmt->execute([$profile, $profile, $id_producto]);
$messages = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chat en PHP</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="icon" type="image/x-icon" href="images\WePop3.png">
</head>
<body>
<style>
    body {
        font-family: Arial, sans-serif;
    }

    #chatbox {
        padding: 20px;
        background-color: #f2f2f2;
        height: 300px;
        overflow-y: scroll;
    }

    #chatbox p {
        margin: 10px 0;
    }

    #inputbox {
        padding: 20px;
        background-color: #fff;
        border-top: 1px solid #ddd;
        display: flex;
        align-items: center;
    }

    #message-input {
        flex: 1;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    select {
        margin-right: 10px;
        padding: 5px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    button {
        padding: 8px 16px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }

    select {
        display: none;
    }
</style>
<div id="chatbox">
    <?php
   
    foreach ($messages as $message) {
        $sender = $message['sender'];
        $receiver = $message['receiver'];
        $content = $message['mensaje'];

       
        if ($sender === $profile) {
            echo "<p><strong>Tú:</strong> $content</p>";
        } else {
            echo "<p><strong>$sender:</strong> $content</p>";
        }
    }
    ?>
</div>
<div id="inputbox">
    <form id="message-form" action="chat.php?id_producto=<?php echo $id_producto; ?>" method="POST">
        <input type="text" name="mensaje" id="message-input" placeholder="Escribe tu mensaje aquí" autocomplete="off">
        <select name="receiver">
            <?php
           
            if ($profile === "vendedor") {
                echo "<option value='comprador'>Comprador</option>";
            } elseif ($profile === "comprador") {
                echo "<option value='vendedor'>Vendedor</option>";
            }
            ?>
        </select>
        <button type="submit">Enviar</button>
    </form>
</div>
</body>
</html>
