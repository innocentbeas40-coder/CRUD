<?php
session_start();


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

$errores = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errores = iniciar_seccion();

    if (!$errores) {
        header('Location: pag/dashboard.php');
        exit;
    }
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="build/css/app.css" />

    <title>Ejemplo de conexión DB</title>
</head>

<body>


    <form method="post">


        <?php
        if ($errores) {
            foreach ($errores as $error) {
                echo "<p>$error</p>";
            }
        }
        ?>

        <fieldset>
            <h3>inicia sección </h3>

            <div class="contenedor_campos">

                <div class="campos">
                    <input type="string" name="documento" placeholder="Documento">
                </div>

                <div class="campos">
                    <input type="password" name="contraseña" placeholder="Contraseña">
                </div>

            </div>

            <div class=" contenedor_boton">
                <input class="boton" type="submit" value="enviar" />
            </div>

        </fieldset>

        </div>






    </form>

</body>

</html>