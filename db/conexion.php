<?php

$hostname = "Localhost";
$username = "root";
$password = "1234";
$database = "Ejemplo_PSR";

$conex = mysqli_connect($hostname, $username, $password, $database);

// echo '<pre>';
// var_dump($conex);
// echo '</pre>';

// if ($conex){
//     echo "conexión exitosa";
// }



if(!$conex) {
    echo "hubo un error";
    exit;
}