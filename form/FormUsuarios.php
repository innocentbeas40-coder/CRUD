<?php

require '../db/proteger.php';



function agregar_usuario()
{
    // Importamos la conexión
    require '../db/conexion.php';

    // Arreglo donde se guardarán los mensajes de error
    $errores = [];

    // Variables vacías para guardar los datos del formulario
    $cedula = "";
    $nombre = "";
    $segundoNombre = "";
    $email = "";
    $contraseña = "";
    $c_contraseña = "";
    $telefono = "";


    // Verificamos si el formulario fue enviado
    if (isset($_POST['guardar'])) {



        // Recibimos los datos escritos en el formulario
        $cedula = mysqli_real_escape_string($conex, $_POST['documento']);
        $nombre = mysqli_real_escape_string($conex, $_POST['nombre']);
        $segundoNombre = mysqli_real_escape_string($conex, $_POST['segundo_nombre']);
        $email = mysqli_real_escape_string($conex, $_POST['email']);
        $contraseña = mysqli_real_escape_string($conex, $_POST['contraseña']);
        $c_contraseña = mysqli_real_escape_string($conex, $_POST['c_contraseña']);
        $telefono = mysqli_real_escape_string($conex, $_POST['telefono']);
    }



    // VALIDACIONES


    //documento
    if (!$cedula) {
        $errores[] = "Ingrese el número de cédula";
    } elseif (!ctype_digit($cedula)) {
        $errores[] = "El documento solo debe contener números";
    } elseif (strlen($cedula) < 7 || strlen($cedula) > 10) {
        $errores[] = "El documento debe tener entre 7 y 10 dígitos";
    }


    //nombre
    if (!$nombre) {
        $errores[] = "Ingrese nombre";
    } elseif (!ctype_alpha(str_replace(' ', '', $nombre))) {
        $errores[] = "El nombre solo debe contener letras";
    }


    //segundo nombre
    if (!$segundoNombre) {
        $errores[] = "Ingrese segundo nombre";
    } elseif (!ctype_alpha(str_replace(' ', '', $segundoNombre))) {
        $errores[] = "El segundo nombre solo debe contener letras";
    }


    //correo
    if (!$email) {
        $errores[] = "Ingrese email";
    }


    //contraseña
    if (!$contraseña) {

        $errores[] = "Ingrese contraseña";
    } else {

        // Compara la contraseña con su confirmación
        if ($contraseña != $c_contraseña) {

            $errores[] = "Las contraseñas no coinciden";
        } else {

            // Encripta la contraseña antes de guardarla
            $contraseña = password_hash($contraseña, PASSWORD_BCRYPT);
        }
    }


    //teléfono
    if (!$telefono) {

        $errores[] = "Ingrese teléfono";
    } elseif (!ctype_digit($telefono)) {

        $errores[] = "El número de teléfono solo debe contener números";
    } elseif (strlen($telefono) != 10) {

        $errores[] = "El teléfono debe tener 10 dígitos";
    }



    // VERIFICA SI EL USUARIO YA EXISTE


    $query = "SELECT * FROM usuarios WHERE documento = '$cedula'";
    $resultado = mysqli_query($conex, $query);

    // Si se encuentra algún usuario con ese documento,
    // significa que ya existe
    if ($resultado->num_rows) {

        $errores[] = "El usuario ya existe";
    }



    // INSERTA EL USUARIO SI NO HAY ERRORES


    if (!$errores) {

        $query = "INSERT INTO usuarios 
        (documento, nombre, segundo_nombre, email, contrasena, telefono)
        VALUES 
        ('$cedula', '$nombre', '$segundoNombre', '$email', '$contraseña', '$telefono')";

        // Ejecuta la consulta para guardar el usuario
        $resultado = mysqli_query($conex, $query);

        if ($resultado) {

            echo "Usuario agregado con éxito";
        } else {

            echo "Error al agregar usuario";
            
        }
    }


    // Retorna los errores para mostrarlos en la página
    return $errores;
}


agregar_usuario();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../build/css/app.css" />
    <title>Document</title>
</head>

<body>

    <form method="post">
        <fieldset>
            <h3>crea un usuario</h3>

            <div class="contenedor_campos">

                <div class="campos">
                    <input type="text" name="nombre" placeholder="Nombre">
                </div>

                <div class="campos">
                    <input type="text" name="segundo_nombre" placeholder="Segundo Nombre">
                </div>

                <div class="campos">
                    <input type="string" name="documento" placeholder="Documento">
                </div>

                <div class="campos">
                    <input type="string" name="email" placeholder="Email">
                </div>

                <div class="campos">
                    <input type="string" name="telefono" placeholder="Teléfono">
                </div>

                <div class="campos">
                    <input type="password" name="contraseña" placeholder="Contraseña">
                </div>

                <div class="campos">
                    <input type="input" name="c_contraseña" placeholder="Confirma tu Contraseña">
                </div>

            </div>

            <div class="contenedor_boton">
                <input class="boton" type="submit" name="guardar" />
            </div>

        </fieldset>

        <div class=" contenedor_boton">
            <a class="boton" href="../pag/users.php">volver atrás</a>
        </div>








    </form>
</body>

</html>