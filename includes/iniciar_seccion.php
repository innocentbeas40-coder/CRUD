<?php

function iniciar_seccion()
{
    // Arreglo donde se guardarán los errores
    $errores = [];

    // Recibimos los datos escritos en el login
    $documento = $_POST['documento'];
    $contraseña = $_POST['contraseña'];


    // VALIDACIONES DEL LOGIN

    if (!$documento) {

        $errores[] = "Ingrese el número de cédula";
    }


    if (!$contraseña) {

        $errores[] = "Ingrese su contraseña";
    }



    // BUSCAR EL USUARIO EN LA BASE DE DATOS


    if (!$errores) {

        
        require 'db/conexion.php';

        // Busca usuario que tenga ese documento
        $query = "SELECT * FROM usuarios WHERE documento = '$documento'";

    
        $resultado = mysqli_query($conex, $query);


        // Si no se encuentra ningún usuario
        if ($resultado->num_rows == 0) {

            $errores[] = "Usuario o contraseña incorrecta";
        } else {

            // Guarda los datos encontrados en una variable
            $usuario = mysqli_fetch_assoc($resultado);


            // Compara la contraseña escrita con la contraseña
            // encriptada que está guardada en la base de datos
            if (!password_verify($contraseña, $usuario['contrasena'])) {

                $errores[] = "Usuario o contraseña incorrecta";
            } else {

                // Guarda los datos del usuario en la sesión
                $_SESSION['usuario'] = $usuario;
            }
        }
    }

    return $errores;
}