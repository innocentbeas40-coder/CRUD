<?php

function obtener_usuarios()
{
    try {

        // Importamos la conexión a la base de datos
        require '../db/conexion.php';

        // Creamos la consulta para obtener todos los usuarios
        $sql = "SELECT * FROM usuarios;";

        // Ejecutamos la consulta
        $query = mysqli_query($conex, $sql);

        // Retornamos el resultado para poder utilizarlo en otra página
        return $query;

    } catch (\Throwable $th) {

        // Si ocurre algún error, lo mostramos
        var_dump($th);
    }
}