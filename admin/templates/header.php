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
    <!--Fontawesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!--Links CSS-->

</head>
<body>
    <header>
        <div>
            <div>
                <div><img src=" " alt=""></div>
                <div>
                    <ul>
                        <a href=" "><li><i class="fas fa-angle-down"></i>Inicio</li></a>
                        <a href=" "><li><i class="fas fa-angle-down"></i>Noticias</li></a>
                        <a href=" "><li><i class="fas fa-angle-down"></i>Cerrar sesion</li></a>
                        <a href=" "><li><i class="fas fa-angle-down"></i>Ver sitio web</li></a>
                    </ul>
                </div>
            </div>
        </div>
    </header>
</body>
</html>