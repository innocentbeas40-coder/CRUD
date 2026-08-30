<?php

require 'conexion.php';

function obtener_usuarios()
{
    try {
        //1. importar la conexión a la DB
        require 'conexion.php';
        //2. consultar la DB
        $sql = "SELECT * FROM usuarios;";


        //3. Ejecutar la consulta con mysqli
        $query = mysqli_query($conex, $sql,);

        //4. Acceder a los resultados

        // echo '<pre>';
        // var_dump(mysqli_fetch_assoc($query));

        // echo '</pre>';

        // //5. cierre de conexión (opcional)
        // $cierre = mysqli_close($th);
        // var_dump($cierre);

        return $query;
    } catch (\Throwable $th) {
        var_dump($th);
    }
}

// obtener_usuarios();


function agregar_usuario()
{
    require 'conexion.php';

    // try {
    //     require 'conexion.php';

    //     $sql  = "INSERT INTO estudiante (nombre) VALUES
    //  ('$nombre','');";

    //     $query = mysqli_query($conex, $sql);


    //     // echo '<pre>';
    //     // var_dump(mysqli_fetch_assoc($query2));

    //     // echo '</pre>';






    //     return $query;
    // } catch (\Throwable $th) {
    //     var_dump($th);
    // }
    $errores = [];
    $cedula = "";
    $nombre = "";
    $segundoNombre = "";
    $email = "";
    $contraseña = "";
    $c_contraseña = "";
    $telefono = "";

    if (isset($_POST['guardar'])) {
        // echo "agregando usuario";

        $nombre = $_POST['nombre'];
        $segundoNombre = $_POST['segundo_nombre'];
        $cedula = $_POST['documento'];
        $contraseña = $_POST['contraseña'];
        $c_contraseña = $_POST['c_contraseña'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
    }

    if (!$cedula) {
        $errores[] = "Ingrese el número de cédula";
    }
    if (!$nombre) {
        $errores[] = "Ingrese nombre";
    }
    if (!$segundoNombre) {
        $errores[] = "Ingrese segundo nombre";
    }
    if (!$email) {
        $errores[] = "Ingrese email";
    }

    if (!$contraseña) {
        $errores[] = "Ingrese contraseña";
    } else {
        if ($contraseña != $c_contraseña) {
            $errores[] = "Las contraseñas no coinciden";
        } else {
            $contraseña = password_hash($contraseña, PASSWORD_BCRYPT);
        }
    }

    if (!$telefono) {
        $errores[] = "Ingrese teléfono";
    }

    $query = "SELECT * FROM usuarios WHERE documento = '"  . $cedula . "';";
    $resultado = mysqli_query($conex, $query);

    if ($resultado->num_rows) {
        $errores[] = "El usuario ya existe";
    }


    if (!$errores) {

        $query = "INSERT INTO usuarios (documento, nombre, segundo_nombre, email, contrasena, telefono)  
    VALUES ('" . $cedula . "', '" . $nombre . "', '" . $segundoNombre . "', '" . $email . "', '" . $contraseña . "', '" . $telefono . "')";

        $resultado = mysqli_query($conex, $query);

        if ($resultado) {
            echo "Usuario agregado con éxito";
        } else {
            echo "Error al agregar usuario";
        }
    }

    return $errores;
}


function  procesar_usuario()
{
    $nombre = $_POST['nombre'];

    agregar_usuario($nombre);

    header('Location: index.php');
    exit;
}










// como ver los errores en php


// 
