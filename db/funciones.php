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

function iniciar_seccion()
{
    $errores = [];
    $documento = $_POST['documento'];
    $contraseña = $_POST['contraseña'];

    if (!$documento) {
        $errores[] = "Ingrese el número de cédula";
    }

    if (!$contraseña) {
        $errores[] = "Ingrese su contraseña";
    }



    if (!$errores) {
        require 'conexion.php';

        $query = "SELECT * FROM usuarios WHERE documento = '$documento'";
        $resultado = mysqli_query($conex, $query);

        if ($resultado->num_rows == 0) {
            $errores[] = "El usuario no existe";
        } else {
            //si existe se guardara los datos en $usuario
            $usuario = mysqli_fetch_assoc($resultado);

            //se compara la contraseña que puso el usuario con la que está en la base de datos 
            if (!password_verify($contraseña, $usuario['contrasena'])) {
                $errores[] = "Contraseña incorrecta";
            }
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
