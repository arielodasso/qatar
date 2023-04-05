<?php
$host = "localhost";
$db = "qatar";
$usuario = "root";
$contrasenia = "";

try {
        
    
    $conexion = new PDO("mysql:host=$host;dbname=$db",$usuario,$contrasenia);


    } catch ( Exeption $ex) {
    echo $ex->getMessage();
}

?>