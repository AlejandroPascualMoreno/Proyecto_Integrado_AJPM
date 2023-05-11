<?php
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
<body class="indexbody">
<div class="divbody">
    <a href="index_vendedores.php"><img class="logo" src="images/WePop2.png" width="100"></a>
</div>
    <hr>
    <h2>Publica aquí lo que los demás necesitan</h2>
    <h5>y sácale partido</h5>
   
<div class="divbody">
    <form>
        <select name="categoria" id="categoria">
            <option disabled selected>Selecciona una categoría</option>
            <option value="Catering">Catering</option>
            <option value="Musica">Música</option>
            <option value="Flores">Flores</option>
            <option value="Fotografia">Fotografía</option>
            <option value="Haciendas">Haciendas</option>
            <option value="Estilistas">Estilistas</option>
        </select>
    <input type="file">
    <button type="submit">Suba su servicio</button>
    </form>
    
</div>
   
  
   
</body>
</html>