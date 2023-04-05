<?php 
session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location:../index.php");
    }else{
        if ($_SESSION['usuario']=="ok") {
            $nombreUsuario=$_SESSION["nombreUsuario"];
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio admin</title>
    <!--Fontawesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!--Links CSS-->
    <link rel="stylesheet" href="../css/adminestilos.css">
    <!--Icono en title-->
</head>
<body>
    <header>
        <div class="titulo-web">
            <img src="../img/logoPNG.png" alt="">
            <h1><a href="../index.html">El Diario de <span>Qatar 2022</span></a></h1>
        </div>
        <div class="menu">
            <ul>
                <div class="cuadradito"></div>
                <a href="inicio.php"><li>Inicio</li></a>
                <a href="seccion/noticias.php"><li>Noticias</li></a>
                <a href="seccion/cerrar.php"><li>Cerrar sesión</li></a>
                <a href="../index.html"><li>Ver sitio</li></a>
                <div class="cuadradito"></div>
            </ul>
        </div>
    </header>
    <main class="main-login main-bienvenida">
    <div class="mensaje-bienvenida">
        <h1>Bienvenido, <span>Administrador</span></h1>
    </div>

</main>
  
</body>
</html>