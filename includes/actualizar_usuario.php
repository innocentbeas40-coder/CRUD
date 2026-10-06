<?php


require __DIR__ . '/../db/conexion.php';



function actualizar_usuario()
{
    require __DIR__ . '/../db/conexion.php';

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

        header("Location: ../../pag/users.php?actualizado=$message");
        exit;
    }
}