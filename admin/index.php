<?php
session_start();

if ($_POST) {

    if (($_POST['usuario']=="qatar")&&($_POST['contrasenia']=="2022")) {

        $_SESSION['usuario']="ok";
        $_SESSION['nombreUsuario']="qatar";

        header('Location:inicio.php');


    }else {
        $mensaje="Error: el usuario o contraseña son incorrectos";

    }

    
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login admin</title>
    <!--Fontawesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!--Links CSS-->
    <link rel="stylesheet" href="../css/adminestilos.css">
</head>
<body>
<header>
    <div class="titulo-web">
        <img src="../img/logoPNG.png" alt="">
        <h1><a href="../index.html">El Diario de <span>Qatar 2022</span></a></h1>
    </div>
</header>
<main class="main-login">
    <div class="mensaje-bienvenida">
        <h1>Login de <span>Administrador</span></h1>
    </div>
    <div class="formulario-acceso">
        <form action="" method="POST" class="form-user">
                <label for="">Usuario:</label><br>
                <input type="name" name="usuario" placeholder="Ingrese usuario" autocomplete="off">

                <label for="">Contraseña:</label><br>
                <input type="password" name="contrasenia" placeholder="Ingrese contraseña" autocomplete="off">

                <button type="submit">Ingresar</button>
                <?php if(isset($mensaje)){?>
                <p><?php echo $mensaje; ?></p>
                <?php } ?>
        </form>
    </div>
</main>

   
</body>
</html>