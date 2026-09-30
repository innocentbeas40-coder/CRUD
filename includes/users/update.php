<?php

require '../../db/proteger.php';
require __DIR__ . '/../../db/conexion.php';
require '../../db/funciones.php';


function actualizar_usuario()
{
    require '../../db/conexion.php';

    $id = $_GET['id'];

    $query = "SELECT * FROM usuarios WHERE id = '$id'";

    $resultado = mysqli_query($conex, $query);

    $usuario = mysqli_fetch_assoc($resultado);

    return $usuario;
}

$usuario = actualizar_usuario();

$id = $_GET['id'];

$errores = [];


if (isset($_POST['actualizar'])) {

    $nombre = mysqli_real_escape_string($conex, $_POST['nombre']);
    $segundoNombre = mysqli_real_escape_string($conex, $_POST['segundo_nombre']);
    $documento = mysqli_real_escape_string($conex, $_POST['documento']);
    $email = mysqli_real_escape_string($conex, filter_var($_POST['email']));
    $telefono = mysqli_real_escape_string($conex, $_POST['telefono']);

    $contraseñaAntigua = $_POST['contraseña_antigua'];
    $contraseña = $_POST['contraseña'];
    $c_contraseña = $_POST['c_contraseña'];


    // Validar nombre
    if (!$nombre) {
        $errores[] = "Ingrese nombre";
    } elseif (!ctype_alpha(str_replace(' ', '', $nombre))) {
        $errores[] = "El nombre solo debe contener letras";
    }


    // Validar segundo nombre
    if (!$segundoNombre) {
        $errores[] = "Ingrese segundo nombre";
    } elseif (!ctype_alpha(str_replace(' ', '', $segundoNombre))) {
        $errores[] = "El segundo nombre solo debe contener letras";
    }


    // Validar documento
    if (!$documento) {
        $errores[] = "Ingrese el número de cédula";
    } elseif (!ctype_digit($documento)) {
        $errores[] = "El documento solo debe contener números";
    } elseif (strlen($documento) < 7 || strlen($documento) > 10) {
        $errores[] = "El documento debe tener entre 7 y 10 dígitos";
    }


    // Validar email
    if (!$email) {
        $errores[] = "Ingrese email";
    }


    // Validar teléfono
    if (!$telefono) {
        $errores[] = "Ingrese teléfono";
    } elseif (!ctype_digit($telefono)) {
        $errores[] = "El teléfono solo debe contener números";
    } elseif (strlen($telefono) != 10) {
        $errores[] = "El teléfono debe tener 10 dígitos";
    }


    // Validar contraseña solamente si quiere cambiarla
    if ($contraseñaAntigua || $contraseña || $c_contraseña) {

        if (!$contraseñaAntigua) {
            $errores[] = "Ingrese la contraseña antigua";
        } elseif (!password_verify($contraseñaAntigua, $usuario['contrasena'])) {
            $errores[] = "La contraseña antigua es incorrecta";
        }

        if (!$contraseña) {
            $errores[] = "Ingrese la nueva contraseña";
        }

        if (!$c_contraseña) {
            $errores[] = "Confirme la nueva contraseña";
        }

        if ($contraseña && $c_contraseña) {

            if ($contraseña != $c_contraseña) {
                $errores[] = "Las nuevas contraseñas no coinciden";
            }
        }
    }


    // Actualizar usuario si no hay errores
    if (!$errores) {

        if ($contraseña) {

            $contraseñaNueva = password_hash($contraseña, PASSWORD_BCRYPT);

            $query = "UPDATE usuarios SET
            nombre = '$nombre',
            segundo_nombre = '$segundoNombre',
            documento = '$documento',
            email = '$email',
            telefono = '$telefono',
            contrasena = '$contraseñaNueva'
            WHERE id = '$id'";
        } else {

            $query = "UPDATE usuarios SET
            nombre = '$nombre',
            segundo_nombre = '$segundoNombre',
            documento = '$documento',
            email = '$email',
            telefono = '$telefono'
            WHERE id = '$id'";
        }


        $resultado = mysqli_query($conex, $query);

        $message = $resultado ? 1 : 2;

        header("Location: ../../pag/users.php?mensaje=$message");
        exit;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../build/css/app.css">

    <title>Actualizar usuario</title>

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

            <h3>Actualiza tu usuario</h3>


            <div class="contenedor_campos">


                <div class="campos">

                    <input
                        type="text"
                        name="nombre"
                        placeholder="Nombre"
                        value="<?php echo $usuario['nombre']; ?>">

                </div>


                <div class="campos">

                    <input
                        type="text"
                        name="segundo_nombre"
                        placeholder="Segundo Nombre"
                        value="<?php echo $usuario['segundo_nombre']; ?>">

                </div>


                <div class="campos">

                    <input
                        type="text"
                        name="documento"
                        placeholder="Documento"
                        value="<?php echo $usuario['documento']; ?>">

                </div>


                <div class="campos">

                    <input
                        type="text"
                        name="email"
                        placeholder="Email"
                        value="<?php echo $usuario['email']; ?>">

                </div>


                <div class="campos">

                    <input
                        type="text"
                        name="telefono"
                        placeholder="Teléfono"
                        value="<?php echo $usuario['telefono']; ?>">

                </div>


                <div class="campos">

                    <input
                        type="password"
                        name="contraseña_antigua"
                        placeholder="Contraseña antigua">

                </div>


                <div class="campos">

                    <input
                        type="password"
                        name="contraseña"
                        placeholder="Nueva contraseña">

                </div>


                <div class="campos">

                    <input
                        type="password"
                        name="c_contraseña"
                        placeholder="Confirmar nueva contraseña">

                </div>


            </div>


            <div class="contenedor_boton">

                <input
                    class="boton"
                    type="submit"
                    name="actualizar"
                    value="Actualizar">

            </div>


        </fieldset>


        <div class="contenedor_boton">

            <a
                class="boton"
                href="../../pag/users.php">
                Volver atrás
            </a>

        </div>


    </form>

</body>

</html>