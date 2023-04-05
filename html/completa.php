<?php include("../admin/config/db.php") ;

$titulo_noticia = $_GET["noticia"];
$sentenciaSQL=$conexion->prepare("SELECT * FROM noticias where titulo='$titulo_noticia'");
$sentenciaSQL->execute();
$listaNoticias=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">


    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../img/logoPNG.png" type="image/x-icon">
    <title>Diario de Qatar - Noticias</title>
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
                <a href="fixture.html"><li>Fixture</li></a>
                <a href="sedes.html"><li>Sede</li></a>
                <a href="noticias.php"><li>Noticias</li></a>
                <a href="planteles.html"><li>Planteles</li></a>
                <div class="cuadradito"></div>
            </ul>
        </div>
    </header>
    <main class="main-nota">
        <?php foreach($listaNoticias as $noticia) { ?>
        <div class="img-noticia">
            <img src="../img/<?php echo $noticia['imagen'] ?>" alt="">
        </div>
        <div class="titulo-noticia">
            <h1><?php echo $noticia['titulo'] ?></h1>
            <p><?php echo $noticia['subtitulo'] ?></p>
            <div class="cuadrados">
                <div class="figura-grande"></div>
                <div class="figura-chica"></div>
                <div class="figura-grande"></div>
                <div class="figura-chica"></div>
                <div class="figura-grande"></div>
                <div class="figura-chica"></div>
                <div class="figura-grande"></div>
                <div class="figura-chica"></div>
                <div class="figura-grande"></div>
                <div class="figura-chica"></div>
                <div class="figura-grande"></div>
            </div>
        </div>
    </main>
    <section class="desarrollo">
        <div class="cont-cuadraditos">
            <div class="cuadradito-grande"></div>
            <div class="cuadradito-chico"></div>
            <div class="cuadradito-grande"></div>
            <div class="cuadradito-chico"></div>
            <div class="cuadradito-grande"></div>
            <div class="cuadradito-chico"></div>
            <div class="cuadradito-grande"></div>
        </div>
        <div class="cont-desarrollo">
            <p><?php echo $noticia['descripcion'] ?></p>
        <div class="cont-cuadraditos cont-cuadraditos-reverse">
            <div class="cuadradito-grande"></div>
            <div class="cuadradito-chico"></div>
            <div class="cuadradito-grande"></div>
            <div class="cuadradito-chico"></div>
            <div class="cuadradito-grande"></div>
            <div class="cuadradito-chico"></div>
            <div class="cuadradito-grande"></div>
        </div>
    </section>

    <?php } ?>

    <footer>
        <h4>El Diario de Qatar 2022</h4>
        <p>Desarrollado por Ariel Odasso | Tandil, Buenos Aires, Argentina</p>

        <div class="social">
            <div class="cont-cuadraditos">
                <div class="cuadradito-grande"></div>
                <div class="cuadradito-chico"></div>
            </div>

            <div class="logos">
                <a href=""><img src="../img/twitter.png" alt=""></a>
                <a href=""><img src="../img/instagram.png" alt=""></a>
                <a href=""><img src="../img/facebook.png" alt=""></a>
            </div>

            <div class="cont-cuadraditos">
                <div class="cuadradito-chico"></div>
                <div class="cuadradito-grande"></div>
            </div>

        </div>
    </footer>
</body>
</html>