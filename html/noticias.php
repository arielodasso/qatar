<?php include("../admin/config/db.php") ;

$sentenciaSQL = $conexion->prepare("SELECT * FROM noticias");
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
                <a href="#"><li>Noticias</li></a>
                <a href="planteles.html"><li>Planteles</li></a>
                <div class="cuadradito"></div>
            </ul>
        </div>
    </header>
    <main class="main-nota">
        <div class="noticia-principal">
            <div class="img-not-main"><img src="../img/argentina.jpg" alt=""></div>
            <div class="texto-not-main">
                <div class="cont-cuadraditos">
                    <div class="cuadradito-grande"></div>
                    <div class="cuadradito-chico"></div>
                    <div class="cuadradito-grande"></div>
                    <div class="cuadradito-chico"></div>
                    <div class="cuadradito-grande"></div>
                    <div class="cuadradito-chico"></div>
                    <div class="cuadradito-grande"></div>
                    <div class="cuadradito-chico"></div>
                    <div class="cuadradito-grande"></div>
                </div>
                <div class="titulo-not-main">
                    <h1>Argentina campeón de la Finalissima</h1>
                    <p>La Albiceleste derrotó categóricamente 3-0 a Italia y se alzó con el trofeo. Es el segundo título en la Era Scaloni, y ahora van por la del mundo...</p>
                    <button><a href="noticias/notacompleta.html">Ver nota completa</a></button>
                </div>
            </div>
        </div>

    </main>

    <section class="section-notas">
        <div class="titulo-seccion">
            <h2>Noticias</h2>
            <div class="cont-cuadraditos">
                <div class="cuadradito-grande"></div>
                <div class="cuadradito-chico"></div>
                <div class="cuadradito-grande"></div>
                <div class="cuadradito-chico"></div>
                <div class="cuadradito-grande"></div>
                <div class="cuadradito-chico"></div>
                <div class="cuadradito-grande"></div>
            </div>
        </div>
        <div class="cont-noticias">
            <?php foreach($listaNoticias as $noticia) { ?>
            <a href="completa.php?noticia=<?php echo $noticia['titulo'];?>" role="button"><div class="noticia">
                <div class="img-noticia">
                    <img src="../img/<?php echo $noticia['imagen'] ?>" alt="">
                </div>
                <div class="text-noticia">
                    <h2><?php echo $noticia['titulo'] ?></h2>
                    <p><?php echo $noticia['subtitulo'] ?></p>
                </div>
            </div></a>
            <?php } ?>
    </section>


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