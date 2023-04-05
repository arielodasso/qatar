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
<?php

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";

$txtTitulo=(isset($_POST['txtTitulo']))?$_POST['txtTitulo']:"";

$txtSubtitulo=(isset($_POST['txtSubtitulo']))?$_POST['txtSubtitulo']:"";

$txtFecha=(isset($_POST['txtFecha']))?$_POST['txtFecha']:"";

$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";

$txtDescripcion=(isset($_POST['txtDescripcion']))?$_POST['txtDescripcion']:"";

$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("../config/db.php");

switch ($accion) {
    case "Agregar":
        //Agrego TITULO, SUBTITULO Y FECHA
        $sentenciaSQL = $conexion->prepare("INSERT INTO noticias (titulo, subtitulo, fecha, imagen, descripcion) VALUES (:titulo, :subtitulo,:fecha,:imagen,:descripcion);");
        $sentenciaSQL->bindParam(':titulo',$txtTitulo);
        $sentenciaSQL->bindParam(':subtitulo',$txtSubtitulo);
        $sentenciaSQL->bindParam(':fecha',$txtFecha);



        //Agrego IMAGEN
        $fecha= new DateTime();
        $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
        

        $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
        if($tmpImagen!=""){
            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);

        }
        $sentenciaSQL->bindParam(':imagen',$nombreArchivo);


        //Agrego DESCRIPCION
        $sentenciaSQL->bindParam(':descripcion',$txtDescripcion);
        $sentenciaSQL->execute();
        

        header("Location:noticias.php");
        break;

    case "Modificar":
        
        // Modifica TITULO
        $sentenciaSQL = $conexion->prepare("UPDATE noticias SET titulo=:titulo WHERE id=:id");
        $sentenciaSQL->bindParam(':titulo',$txtTitulo);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();

        // Modifica SUBTITULO
        $sentenciaSQL = $conexion->prepare("UPDATE noticias SET subtitulo=:subtitulo WHERE id=:id");
        $sentenciaSQL->bindParam(':subtitulo',$txtSubtitulo);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();

        // Modifica FECHA
        $sentenciaSQL = $conexion->prepare("UPDATE noticias SET fecha=:fecha WHERE id=:id");
        $sentenciaSQL->bindParam(':fecha',$txtFecha);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();

        // Modifica IMAGEN
        if($txtImagen!=""){

            $fecha= new DateTime();
            $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
            
            $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

            move_uploaded_file($tmpImagen,"../../imagenes/".$nombreArchivo);
            

            $sentenciaSQL = $conexion->prepare("SELECT imagen FROM noticias WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
            $noticia=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

            if (isset($noticia["imagen"]) &&($noticia["imagen"]!="imagen.jpg") ) {
            
                if(file_exists("../../imagenes/".$noticia["imagen"])){

                    unlink("../../imagenes/".$noticia["imagen"]);

                }
            }


            $sentenciaSQL = $conexion->prepare("UPDATE noticias SET imagen=:imagen WHERE id=:id");
            $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
        }
        // Modifica Descripcion
        $sentenciaSQL = $conexion->prepare("UPDATE noticias SET descripcion=:descripcion WHERE id=:id");
        $sentenciaSQL->bindParam(':descripcion',$txtDescripcion);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        



        header("Location:noticias.php");
        break;
    

    case "Cancelar":

        header("Location:noticias.php");

        break;

    case "Seleccionar":

        $sentenciaSQL = $conexion->prepare("SELECT * FROM noticias WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $noticia=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtTitulo=$noticia['titulo'];
        $txtSubtitulo=$noticia['subtitulo'];
        $txtFecha=$noticia['fecha'];
        $txtImagen=$noticia['imagen'];
        $txtDescripcion=$noticia['descripcion'];

        break;

    case "Borrar":

        $sentenciaSQL = $conexion->prepare("SELECT imagen FROM noticias WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $noticia=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if (isset($noticia["imagen"]) &&($noticia["imagen"]!="imagen.jpg") ) {
            
            if(file_exists("../../img/".$noticia["imagen"])){

                unlink("../../img/".$noticia["imagen"]);

            }
        }


        $sentenciaSQL = $conexion->prepare("DELETE FROM noticias WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();

        
        header("Location:noticias.php");
        break;
}

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
    <title>Noticias admin</title>
    <!--Fontawesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!--Links CSS-->
    <link rel="stylesheet" href="../../css/adminestilos.css">
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
             tinymce.init({
               selector: 'textarea#editor', });
        </script>

</head>
<body>
    <header>
        <div class="titulo-web">
            <img src="../../img/logoPNG.png" alt="">
            <h1><a href="../../index.html">El Diario de <span>Qatar 2022</span></a></h1>
        </div>
        <div class="menu">
            <ul>
                <div class="cuadradito"></div>
                <a href="../inicio.php"><li>Inicio</li></a>
                <a href="#"><li>Noticias</li></a>
                <a href="cerrar.php"><li>Cerrar sesión</li></a>
                <a href="../../index.html"><li>Ver sitio</li></a>
                <div class="cuadradito"></div>
            </ul>
        </div>
    </header>

    <main class="main-admin-noticias">
        <!-- Div formulario -->
        <div class="cont-datos-noticias">
            <h2>Datos de la noticia:</h2>
            <form class="form-edicion-noticia" method="POST" enctype = "multipart/form-data">
                <div class="form-izq">
                    <input class="titulo-not" type="text" required name="txtTitulo" id="txtTitulo" placeholder="Ingrese título" value="<?php echo $txtTitulo; ?>">
                    <input class="subtitulo-not" type="text" required name="txtSubtitulo" id="txtSubtitulo" placeholder="Ingrese subtitulo" value="<?php echo $txtSubtitulo; ?>">
                    <textarea class="descripcion-not" type="text" name="txtDescripcion" id="txtDescripcion" placeholder="Ingrese descripción" value="<?php echo $txtDescripcion; ?>"></textarea>
                    <!--<input type="text" required readonly name="txtID" id="txtID" placeholder="ID" value="<?php echo $txtID; ?>">-->
                </div>
                <div class="form-der">
                    <input class="fecha-not" type="date" required name="txtFecha" id="txtFecha" value="<?php echo $txtFecha; ?>">

                    <input class="selec-img-not" type="file" name="txtImagen" id="txtImagen">
                    <?php
                        if($txtImagen!=""){
                        ?>
                        <img src="../../imagenes/<?php echo $txtImagen ?>"  width="50px" alt="">
                    <?php
                    }?>
                    <div class="botonera-edicion-not">
                        <button class="btnagregar" type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":"";?> value="Agregar">Agregar</button>
                        <button class="btnmodificar" type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":"";?> value="Modificar">Modificar</button>
                        <button class="btncancelar" type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":"";?> value="Cancelar">Cancelar</button>
                    </div>
                </div>

            </form>
        </div>
        <!-- Div tabla con lo de db -->
        <div class="cont-noticias-cargadas">
            <h2>Noticias cargadas</h2>
            <table class="table">
                <thead>
                    <tr class="table-titulos-celdas">
                        <th>ID</th>
                        <th>Titulo</th>
                        <th>Subtitulo</th>
                        <th>Fecha</th>
                        <th>Imagen</th>
                        <th>Descripcion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listaNoticias as $noticia){ ?>
                    <tr>
                        <td class="table-id"><?php echo $noticia['id'] ?></td>
                        <td class="table-titulo"><?php echo $noticia['titulo'] ?></td>
                        <td class="table-subtitulo"><?php echo $noticia['subtitulo'] ?></td>
                        <td class="table-fecha"><?php echo $noticia['fecha'] ?></td>


                        <td class="table-imagen">

                            <img src="../../img/<?php echo $noticia['imagen'] ?>"  width="50px" alt="">
                        
                            


                        </td>
                        
                        
                        
                        <td class="table-descripcion"><?php echo $noticia['descripcion'] ?></td>

                        <td class="table-botonera">
                            
                            <form method="POST">

                                <input class="table-btnseleccionar" type="submit" name="accion" value="Seleccionar">
                                
                                <input class="table-btnborrar" type="submit" name="accion" value="Borrar">

                                <input type="hidden" name="txtID" id="txtID" value="<?php echo $noticia['id'] ?>">

                            </form>
                        </td>

                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
    <footer>

    </footer>

    <!-- Script del editor WYSIWYG -->
    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js" integrity="sha512-BmM0/BQlqh02wuK5Gz9yrbe7VyIVwOzD1o40yi1IsTjriX/NGF37NyXHfmFzIlMmoSIBXgqDiG1VNU6kB5dBbA==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
    tinymce.init({
        selector: 'textarea#txtDescripcion',
        skin: 'bootstrap',
        plugins: 'lists, link, image, media',
        toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help',
        menubar: false,
        });
    </script>

</body>
</html>